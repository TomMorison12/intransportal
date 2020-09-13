<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use test\Mockery\ReturnTypeObjectTypeHint;

class UsersController extends Controller
{
    public function index() {
        $search = request('name');
        $users = User::where('name', 'LIKE', "$search%")->take(5)->get();


        return $users->map(function($user) {
            return ['key' => $user->name, 'value' => $user->name];
        });






    }

}
