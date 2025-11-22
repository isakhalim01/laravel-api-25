<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CategoryProduct;
use Exception;
use Illuminate\Http\Request;

class CategoryProductController extends Controller

    {
        // ===============================
        // 1. MENAMPILKAN SEMUA KATEGORI
        // ===============================
        public function index()
        {
            try {
                $categories = CategoryProduct::all();
    
                return response()->json([
                    'message' => 'Data kategori berhasil ditampilkan',
                    'data' => $categories
                ], 200);
    
            } catch (Exception $e) {
    
                return response()->json([
                    'message' => $e->getMessage(),
                    'data' => null
                ], 500);
            }
        }
    
        // ===============================
        // 2. MENAMBAHKAN KATEGORI
        // ===============================
        public function store(Request $request)
        {
            try {
                $validateData = $request->validate([
                    'name' => 'required|max:255',
                    'description' => 'nullable|string|max:255',
                ]);
                $category = CategoryProduct::create($validateData);
                return response()->json([
                    'message' => 'Kategori berhasil ditambahkan',
                    'data' => $category
                ], 201);
    
            } catch (Exception $e) {
    
                return response()->json([
                    'message' => $e->getMessage(),
                    'data' => null
                ], 500);
            }
        }
    
        // ===============================
        // 3. MENAMPILKAN DETAIL KATEGORI
        // ===============================
        public function show($id)
        {
            try {
                $category = CategoryProduct::find($id);
    
                if (!$category) {
                    return response()->json([
                        'message' => 'Kategori tidak ditemukan',
                        'data' => null
                    ], 404);
                }
    
                return response()->json([
                    'message' => 'Detail kategori ditemukan',
                    'data' => $category
                ], 200);
    
            } catch (Exception $e) {
    
                return response()->json([
                    'message' => $e->getMessage(),
                    'data' => null
                ], 500);
            }
        }
    
        // ===============================
        // 4. UPDATE KATEGORI
        // ===============================
        public function update(Request $request, $id)
        {
            try {
                $category = CategoryProduct::find($id);
    
                if (!$category) {
                    return response()->json([
                        'message' => 'Kategori tidak ditemukan',
                        'data' => null
                    ], 404);
                }
    
                $validateData = $request->validate([
                    'name' => 'required|max:255',
                    'description' => 'nullable|string|max:255',
                ]);
    
                $category->update($validateData);
    
                return response()->json([
                    'message' => 'Kategori berhasil diperbarui',
                    'data' => $category
                ], 200);
    
            } catch (Exception $e) {
    
                return response()->json([
                    'message' => $e->getMessage(),
                    'data' => null
                ], 500);
            }
        }
    
        // ===============================
        // 5. MENGHAPUS KATEGORI
        // ===============================
        public function destroy($id)
        {
            try {
                $category = CategoryProduct::find($id);
    
                if (!$category) {
                    return response()->json([
                        'message' => 'Kategori tidak ditemukan',
                        'data' => null
                    ], 404);
                }
    
                $category->delete();
    
                return response()->json([
                    'message' => 'Kategori berhasil dihapus',
                    'data' => $category
                ], 200);
    
            } catch (Exception $e) {
    
                return response()->json([
                    'message' => $e->getMessage(),
                    'data' => null
                ], 500);
            }
        } //
}
