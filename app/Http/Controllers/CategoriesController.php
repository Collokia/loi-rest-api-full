<?php

namespace App\Http\Controllers;


use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController
{

    function index(Request $request){
        if($request->isJson()){
            $categories = Category::all();
            return response()->json($categories, 200);
        }

        return response()->json(['Error'=>'Unauthorized'],401, []);
    }
}