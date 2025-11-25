<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display all products.
     */
    public function index()
    {
        try {
            $products = Product::with('CategoryProduct','ProductVariant')->get();

            return response()->json([
                'type' => 'Success',
                'data' => $products
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'type' => 'Error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created product.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                
                "name"                => 'required|string|max:255',
                "code"                => 'required|string|max:50',
                 "description"         => 'required|string|max:255',
                 "price"               => 'required',
                 "product_category_id"=> 'required|exists:category_products,id',
            ]);
            $product = Product::create($validated);
            $product->load('CategoryProduct');
            return response()->json([
                'type'    => 'Success',
                'message' => 'Product berhasil ditambahkan',
                'data'    => $product
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'type'    => 'Error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified product.
     */
    public function show($id)
    {
        try {
            $product = Product::with('CategoryProduct','ProductVariant')->findOrFail($id);

            return response()->json([
                'type' => 'Success',
                'data' => $product
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'type'    => 'Error',
                'message' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Update the specified product.
     */
    public function update(Request $request, $id)
    {
        try {
            $product = Product::findOrFail($id);

            $validated = $request->validate([
                
                "name"                => 'required|string|max:255',
                "code"                => 'required|string|max:50',
                 "description"         => 'required|string|max:255',
                 "price"               => 'required',
                 "product_category_id"=> 'required',
                
             
                
            ]);
            $product->load('CategoryProduct');
            $product->update($validated);
           

            return response()->json([
                'type'    => 'Success',
                'message' => 'Product berhasil diubah',
                'data'    => $product
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'type'    => 'Error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified product.
     */
    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();

            return response()->json([
                'type'    => 'Success',
                'message' => 'Product berhasil dihapus'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'type'    => 'Error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}