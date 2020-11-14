<?php

namespace App;

use App\Providers\App\Events\ThreadHasNewReply;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

class Thread extends Model
{
    use RecordActivity, RecordsViews;
    protected $guarded = [];
    protected $appends = ['isSubscribedTo'];

    protected $with = ['creator', 'channel'];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($thread) {
            $thread->replies->each->delete();
        });

        static::created(function ($thread) {
            $thread->update(['slug' => $thread->title]);
        });
    }

    public function path()
    {
        return page_url('forum', 'threads/'.$this->channel->slug.'/'.$this->slug);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function addReply($reply)
    {
        $reply = $this->replies()->create($reply);

        event(new ThreadHasNewReply($this, $reply));

        return $reply;
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

    public function subscribe($userId = null)
    {
        $this->subscriptions()->create([
            'user_id' => $userId ?: auth()->id(),

        ]);

        return $this;
    }

    public function unsubscribe($userId = null)
    {
        $this->subscriptions()->where('user_id', $userId ?: auth()->id())->delete();
    }

    public function subscriptions()
    {
        return $this->hasMany(ThreadSubscription::class);
    }

    public function getIsSubscribedToAttribute()
    {
        return $this->subscriptions()->where('user_id', auth()->id())->exists();
    }

    public function hasUpdatesFor($user)
    {
        $key = $user->visitedThreadCacheKey($this);

        return $this->updated_at > cache($key);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function setSlugAttribute($value)
    {
        $slug = Str::slug($value);
        $original = $slug;
        $count = 2;

        while (static::whereSlug($slug)->exists()) {
            $slug = strtolower($original.'-'.$count++);
        }

//        $slug = Str::slug($value);
//        if (static::where('slug', $slug)->exists()) {;
//            $slug = $this->incrementSlug($slug);
//        }

        $this->attributes['slug'] = $slug;
    }

    public function markBestReply(Reply $reply)
    {
        $this->update(['best_reply_id' => $reply->id]);
    }

    public function lock()
    {
        $this->update(['locked' => true]);
    }

    public function unlock()
    {
        $this->update(['locked' => false]);
    }
}
