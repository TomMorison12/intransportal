<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index() {
        $categories = Category::orderBy('name', 'asc')->get();
        return view('categories.index', ['categories' => $categories]);
    }


    public function show(Category $category) {
        return view('categories.list',  ['country' => $category->name, 'cid' => $category->id]);
    }

    public function create()
    {
        return view('categories.add');
    }




}
