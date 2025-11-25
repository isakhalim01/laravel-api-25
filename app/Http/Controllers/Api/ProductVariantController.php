<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductVariant;

class ProductVariantController extends Controller
{
    // =========================
    // GET: Menampilkan semua variant
    // =========================
    public function index()
    {
        try {
            $variants = ProductVariant::with('product','CategoryProduct')->get();

            return response()->json([
                'type' => 'Success',
                'message' => 'Data berhasil diambil',
                'data' => $variants
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'type' => 'Error',
                'message' => $e->getMessage(),
                'data' => null
            ], 500);
        }
    }

    // =========================
    // POST: Menambah variant
    // =========================
    public function store(Request $request)
    {
        try {
            $validate = $request->validate([
                'product_id' => 'required|exists:products,id',
                'name' => 'required|string|max:255',
                'description' => 'nullable|string'
            ]);

            $variant = ProductVariant::create($validate);
            $variant->load('product');

            return response()->json([
                'type' => 'Success',
                'message' => 'Variant berhasil ditambahkan',
                'data' => $variant
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'type' => 'Error/Gagal',
                'message' => $e->getMessage(),
                'data' => null
            ], 500);
        }
    }

    // =========================
    // GET: Detail variant
    // =========================
    public function show($id)
    {
        try {
            $variant = ProductVariant::with('product','CategoryProduct')->find($id);

            if (!$variant) {
                return response()->json([
                    'type' => 'Error',
                    'message' => 'Variant tidak ditemukan',
                    'data' => null
                ], 404);
            }

            return response()->json([
                'type' => 'Success',
                'data' => $variant
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'type' => 'Error/Gagal',
                'message' => $e->getMessage(),
                'data' => null
            ], 500);
        }
    }

    // =========================
    // PUT: Update variant
    // =========================
    public function update(Request $request, $id)
    {
        try {
            $variant = ProductVariant::find($id);

            if (!$variant) {
                return response()->json([
                    'type' => 'Error',
                    'message' => 'Variant tidak ditemukan',
                    'data' => null
                ], 404);
            }

            $validate = $request->validate([
                'product_id' => 'required|exists:products,id',
                'name' => 'required|string|max:255',
                'description' => 'nullable|string'
            ]);

            $variant->update($validate);
            $variant->load('product');

            return response()->json([
                'type' => 'Success',
                'message' => 'Variant berhasil diupdate',
                'data' => $variant
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'type' => 'Error/Gagal',
                'message' => $e->getMessage(),
                'data' => null
            ], 500);
        }
    }

    // =========================
    // DELETE
    // =========================
    public function destroy($id)
    {
        try {
            $variant = ProductVariant::find($id);

            if (!$variant) {
                return response()->json([
                    'type' => 'Error',
                    'message' => 'Variant tidak ditemukan',
                    'data' => null
                ], 404);
            }

            $variant->delete();

            return response()->json([
                'type' => 'Success',
                'message' => 'Variant berhasil dihapus',
                'data' => $variant
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'type' => 'Error/Gagal',
                'message' => $e->getMessage(),
                'data' => null
            ], 500);
        }
    }
}
    //

