<?php

namespace App\Http\Controllers;


use App\Exceptions\Handler;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tymon\JWTAuth\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class CategoriesController extends Controller
{

    public function __construct(JWTAuth $jwt, Handler $handler)
    {
        $this->jwt = $jwt;
        $this->handler = $handler;
    }

    function index(Request $request)
    {
        if ($request->isJson()) {
            $categories = Category::all();
            return response()->json($categories, Response::HTTP_OK);
        }

        return $this->handler->error( 'Unauthorized', Response::HTTP_UNAUTHORIZED);
    }
}