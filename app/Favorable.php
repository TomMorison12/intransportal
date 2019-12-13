<?php
namespace App;
use Illuminate\Support\Facades\Auth;

trait Favorable {

    public function isFavorited()
    {
        return !!$this->favorites->where('user_id', auth()->id())->count();

    }

    public function getFavoritesCountAttribute()
    {
        return $this->favorites->count();
    }

    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favorited');
    }

    public function favorite()
    {
        $attributes = ['user_id' => Auth::user()->id];
        if (!$this->favorites()->where($attributes)->exists()) {

            return $this->favorites()->create([
                'user_id' => Auth::user()->id
            ]);
        }
    }
}
