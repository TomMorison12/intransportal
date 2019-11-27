<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Reply extends Model
{
    protected $guarded = [];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
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
