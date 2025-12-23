<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of users.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {   
        // Fetch all categories
        $categories = Category::all();

        return response()->json($categories);
    }

    /**
     * Store a newly created user in database.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreCategoryRequest $request)
    {
         $validated = $request->validated();

        // 2. Create new category
        $category = Category::create($validated);

        // 3. Return created category
        return response()->json($category, 201);
    }

   /**
     * Display the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id)
    {
        // 1. Find category by ID
        $category = Category::find($id);

        // 2. Check if category exists
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        // 3. Return category
        return response()->json($category);
    }

     /**
     * Update the specified user in database.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateCategoryRequest $request, string $id)
    {
        // 1. Find category
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        // 2. Validate input
        $validated = $request->validated();

        // 3. Update category
        $category->update($validated);

        // 4. Return updated category
        return response()->json($category);
    }

    /**
     * Remove the specified user from database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $id)
    {
        // 1. Find category
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        // 2. Delete category
        $category->delete();

        // 3. Return success message
        return response()->json(['message' => 'Category deleted successfully']);
    }
}
