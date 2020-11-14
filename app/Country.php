<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Country extends Model
{
    protected $fillable = ['name', 'slug'];
    protected $appends = ['cities_count'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function getCitiesCountAttribute()
    {
        return $this->cities()->count();
    }
}
