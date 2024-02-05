<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends Controller
{
    public function store(Request $request)
    {
        $category = Auth::user()->categories()->create($request->all());

        return response()->json($category);
    }
}
