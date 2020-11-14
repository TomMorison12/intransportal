<?php

namespace App;

use Illuminate\Support\Facades\Auth;

trait Favorable
{
    protected static function bootFavorable()
    {
        static::deleting(function ($model) {
            $model->favorites->each->delete();
        });
    }

    public function isFavorited()
    {
        return (bool) $this->favorites->where('user_id', auth()->id())->count();
    }

    public function getIsFavoritedAttribute()
    {
        return $this->isFavorited();
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
        if (! $this->favorites()->where($attributes)->exists()) {
            return $this->favorites()->create([
                'user_id' => Auth::user()->id,
            ]);
        }
    }

    public function unfavorite()
    {
        $attributes = ['user_id' => Auth::user()->id];
        $this->favorites()->where($attributes)->get()->each->delete();
    }
}
