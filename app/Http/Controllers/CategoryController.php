<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(): JsonResponse
    {
        $categories = Category::all();

        return response()->json($categories);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            "name" => "required|string|max:255",
            "description" => "nullable|string",
            "icon" => "nullable|string|max:255",
        ]);

        $category = Category::create($request->all());

        return response()->json(["message" => "category stored"]);
    }

    public function show(Category $category): JsonResponse
    {
        return response()->json($category);
    }

    public function update(Category $category, Request $request): JsonResponse
    {
        $request->validate([
            "name" => "required|string|max:255",
            "description" => "nullable|string",
            "icon" => "nullable|string|max:255",
        ]);

        $category->update($request->all());

        return response()->json(["message" => "Category updated successfully"]);
    }

    public function destroy(Category $category): JsonResponse
    {
        $category->delete();

        return response()->json(["message" => "Category deleted successfully"]);
    }
}
