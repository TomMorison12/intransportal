<?php

namespace App\Http\Controllers\Api;

use App\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('verified')->except(['destroy', 'show']);
    }

    public function show()
    {
        return Category::orderBy('name', 'asc')->get();
    }

    public function store() {

       request()->validate([
            'name' => 'required'
        ]);

       Category::create(['name' => request('name'), 'slug' => Str::slug(request('name'))]);

        return response('country created', 201);
    }
}
