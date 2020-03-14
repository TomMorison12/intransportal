<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function Mode() {
        return $this->hasMany(Mode::class);
    }
}
