<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tymon\JWTAuth\JWTAuth;

class CategoriesController extends Controller
{

    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
    }

    function index(Request $request)
    {
        if ($request->isJson()) {
            $categories = Category::all();
            return response()->json($categories, Response::HTTP_OK);
        }

        return response()->json(['error' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
    }
}