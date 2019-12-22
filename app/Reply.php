<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Reply extends Model
{
    use Favorable, RecordActivity;
    protected $guarded = [];

    protected $with = ['owner', 'favorites'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function thread() {
        return $this->belongsTo(Thread::class);
    }


}
