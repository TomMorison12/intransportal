<?php

namespace App\Http\Controllers\Api;

use App\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('verified')->except(['destroy', 'show']);
    }

    public function show() {
        return Country::orderBy('name', 'asc')->get();

    }

    public function store() {

        $this->validate(request(), [
            'name' => 'required',
        ]);
        try {
            Country::create(['name' => request('name'), 'slug' => Str::slug(request('name'))]);

        } catch(\Exception $e) {
            throw new \Exception("The category could not be created");
       }

       return response('Category created', 201);

    }

       public function destroy(Country $country) {
        $country->delete();
       }


}
