<?php

namespace App\Http\Controllers;

use App\Country;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Country::orderBy('name', 'asc')->get();

        return view('categories.index', ['categories' => $categories]);
    }

    public function show(Country $country)
    {
        return view('categories.list')->with([
            'country' => $country->name,
            'slug' => $country->slug,
            'cid' => $country->id,
            'cities' => $country->cities()->orderBy('name')->get(),
        ]);
    }

    public function create()
    {
        return view('categories.add');
    }
}
