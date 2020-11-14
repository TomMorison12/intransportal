<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];



    public function getRouteKeyName()
    {
        return 'name';

    }
    public function subcategory()
    {
        return $this->hasMany(Subcategory::class, 'category_id');
    }

    public function getCitiesCountAttribute() {
    	return $this->cities()->count();
    }









}
