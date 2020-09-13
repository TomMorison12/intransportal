<?php

namespace App\Http\Controllers\Api;
use App\Category;
use App\Subcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubcategoryController extends Controller
{

    function show(Category $category) {
       return $category->subcategory()->orderBy('name', 'asc')->get();
    }

    public function store() {

        return Subcategory::create(['name' => request('name'), 'category_id' => request('category_id')]);

    }
}
