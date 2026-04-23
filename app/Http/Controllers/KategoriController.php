<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    /**
     * + index(): menampilkan semua data kategori dalam bentuk JSON
     */
    public function index()
    {
        $kategori = Kategori::all();
        return response()->json($kategori, 200);
    }

    /**
     * + simpan(): menyimpan data kategori baru
     * (Dalam Laravel Resource disebut store)
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_kategori' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $kategori = Kategori::create($request->all());

        return response()->json([
            'status' => 'success',
            'data'   => $kategori
        ], 201);
    }

    /**
     * + show(): menampilkan detail satu kategori berdasarkan ID
     */
    public function show(string $id)
    {
        $kategori = Kategori::find($id);

        if (!$kategori) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Data kategori tidak ditemukan'
            ], 404);
        }

        return response()->json($kategori, 200);
    }

    /**
     * + update(): memperbarui data kategori
     */
    public function update(Request $request, string $id)
    {
        $kategori = Kategori::find($id);

        if (!$kategori) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nama_kategori' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $kategori->update($request->all());

        return response()->json([
            'status' => 'success',
            'data'   => $kategori
        ], 200);
    }

    /**
     * + hapus(): menghapus data kategori
     * (Dalam Laravel Resource disebut destroy)
     */
    public function destroy(string $id)
    {
        $kategori = Kategori::find($id);

        if (!$kategori) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $kategori->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Kategori berhasil dihapus',
        ], 200);
    }
}