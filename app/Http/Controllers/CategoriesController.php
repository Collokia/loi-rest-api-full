<?php

namespace App\Http\Controllers;


use App\Models\Category;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class CategoriesController extends Controller
{

    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
    }

    function index(Request $request){
        if($request->isJson()){
            $categories = Category::all();
            return response()->json($categories, 200);
        }

        return response()->json(['Error'=>'Unauthorized'],401, []);
    }
}