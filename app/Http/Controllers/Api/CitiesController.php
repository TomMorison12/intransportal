<?php

namespace App\Http\Controllers\Api;

use App\City;
use App\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class CitiesController extends Controller
{
    public function __construct() {
        $this->middleware('verified')->except('show');
    }
    public function store() {

        City::create(request()->validate([
            'name' => 'required',
            'country_id' => 'required'
        ]));

       return response('City created', 201);
    }

    public function show(Country $country) {
       return $country->cities()->orderBy('name')->get();
    }
}
