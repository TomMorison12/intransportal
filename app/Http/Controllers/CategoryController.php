<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function  __construct()
    {
        $this->middleware('verified');
    }

    public function store(Request $request)  {
        $request->validate([
            'type' => 'required',
            'name' => 'required'

        ]);

        if(request()->type == 'Country' || request()->type == 'City' || request()->type === 'Mode') {
            app('App\\'.request()->type)->create(['name' => request()->title, 'created_by' => auth()->id()]);
            return response( 'Category added successfully', 200);
        }

        return response('Whoops! Something went wrong', 422);




    }
}
