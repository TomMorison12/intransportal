<?php

namespace App\Filters;

use Illuminate\Http\Request;
use App\User;


class ThreadFilters extends Filter {
    protected $filters = ['by', 'popular'];


    /**
     * @param $builder
     * @param $username
     * @return mixed
     */
    protected function by($username)
    {
        $user = User::where('name', $username)->firstOrFail();
        return $this->builder->where('user_id', $user->id);
    }

    protected function popular() {
        $this->builder->getQuery()->orders = [];
        return $this->builder->orderBy('replies_count', 'desc');
    }
}
