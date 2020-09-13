<?php

namespace App\Http\Controllers\Api;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class CategoryController extends Controller
{
    public function show() {
        return Category::orderBy('name', 'asc')->get();

    }

    public function store() {

        $this->validate(request(), [
            'name' => 'required'
        ]);
        return Category::create(['name' => request('name')]);

    }

}
