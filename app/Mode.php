<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mode extends Model
{
    public function city() {
        return $this->belongsTo(City::class);
    }

    public function country() {
        return $this->belongsTo(Country::class);
}
}
