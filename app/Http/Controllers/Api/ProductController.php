<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
     /**
     * Display a listing of products.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {   
        $search  = $request->get('search');
        $perPage = $request->get('per_page', 10);

        $products = Product::with(['supplier', 'category'])
            ->when($search, function ($q) use ($search) {
                $q->where(function ($query) use ($search) {

                    // 🔍 Product fields
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('sku', 'like', "%{$search}%")
                        ->orWhere('purchase_price', 'like', "%{$search}%")
                        ->orWhere('selling_price', 'like', "%{$search}%");

                    // 🔍 Supplier name
                    $query->orWhereHas('supplier', function ($supplier) use ($search) {
                        $supplier->where('name', 'like', "%{$search}%");
                    });

                    // 🔍 Category name
                    $query->orWhereHas('category', function ($category) use ($search) {
                        $category->where('name', 'like', "%{$search}%");
                    });
                });
            })
            ->latest()
            ->paginate($perPage);

        return response()->json([
            'success' => true,
            'data'    => $products, // pagination object
            'message' => 'Products fetched successfully'
        ], 200);
    }

    /**
     * Store a newly created product in database.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreProductRequest $request)
    {     
        // 1. Validate request data
         $validated = $request->validated();

        // 2. Create new product
        $product = Product::create($validated);

        // 3. Return created category
        return response()->json($product, 201);
    }

   /**
     * Display the specified product.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id)
    {
        // 1. Find product by ID
        $product = Product::find($id);

        // 2. Check if category exists
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        // 3. Return category
        return response()->json($product);
    }

     /**
     * Update the specified product in database.
     *
     * @param  \App\Http\Requests\UpdateProductRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateProductRequest $request, string $id)
    {
        // 1. Find product
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        // 2. Validate input
        $validated = $request->validated();

        // 3. Update category
        $product->update($validated);

        // 4. Return updated category
        return response()->json($product);
    }

    /**
     * Remove the specified product from database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $id)
    {
        // 1. Find product
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        // 2. Delete product
        $product->delete();

        // 3. Return success response
        return response()->json(['message' => 'Product deleted successfully']);
    }
}
