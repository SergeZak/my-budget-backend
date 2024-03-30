<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends Controller
{

    public function index(): JsonResponse
    {
        $categories = Auth::user()->categories()->orderBy('title')->get();

        return response()->json($categories);
    }

    public function store(Request $request): JsonResponse
    {
        $category = Auth::user()->categories()->create($request->all());

        return response()->json($category);
    }

    /**
     * @param Category $category
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Category $category, Request $request): JsonResponse
    {
        if (Auth::user()->id !== $category->user_id) {
            abort(403);
        }

        $category->update($request->all());

        return response()->json($category);
    }


    /**
     * @param Category $category
     * @param Request $request
     * @return JsonResponse
     */
    public function delete(Category $category, Request $request): JsonResponse
    {
        if (Auth::user()->id !== $category->user_id) {
            abort(403);
        }

        $category->delete();

        return response()->json(['success' => 'ok']);
    }
}
