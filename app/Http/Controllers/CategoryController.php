<?php

namespace App\Http\Controllers;

use App\Category;
use App\Country;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name', 'asc')->get();

        return view('categories.index', ['categories' => $categories]);
    }

    public function show(Category $category)
    {
        return view('categories.list')->with([
            'country' => $category->name,
            'slug' => $category->slug,
            'cid' => $category->id,
            'cities' => $category->cities()->orderBy('name')->get(),

        ]);
    }

    public function create()
    {
        return view('categories.add');
    }
}
