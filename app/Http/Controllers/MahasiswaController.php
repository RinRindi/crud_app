<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Validator;

class MahasiswaController extends Controller
{
    /**
     * Tampilkan semua mahasiswa beserta data prodinya.
     */
    public function index()
    {
        $mahasiswa = Mahasiswa::with('prodi')->get();
        return response()->json($mahasiswa, 200);
    }

    /**
     * Menyimpan data mahasiswa baru.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nim'          => 'required|unique:mahasiswa,nim',
            'nama_lengkap' => 'required',
            'prodi_id'     => 'required|exists:prodi,prodi_id', 
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error'  => $validator->errors(),
            ], 422);
        }

        $mahasiswa = Mahasiswa::create($request->all());

        return response()->json([
            'status' => 'success',
            'data'   => $mahasiswa
        ], 201);
    }

    /**
     * Menampilkan detail satu mahasiswa.
     */
    public function show(string $id)
    {
        $mahasiswa = Mahasiswa::with('prodi')->find($id);

        if (!$mahasiswa) {
            return response()->json([
                'status'  => 'error', 
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        return response()->json($mahasiswa, 200);
    }

    /**
     * Memperbarui data mahasiswa.
     */
    public function update(Request $request, string $id)
    {
        $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return response()->json([
                'status'  => 'error', 
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            // id di sini untuk mengecualikan NIM milik mahasiswa ini sendiri agar tidak dianggap duplikat
            'nim'          => 'required|unique:mahasiswa,nim,' . $id . ',mahasiswa_id',
            'nama_lengkap' => 'required',
            'prodi_id'     => 'required|exists:prodi,prodi_id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error', 
                'error'  => $validator->errors()
            ], 422);
        }

        $mahasiswa->update($request->all());

        return response()->json([
            'status' => 'success', 
            'data'   => $mahasiswa
        ], 200);
    }

    /**
     * Menghapus data mahasiswa.
     */
    public function destroy(string $id)
    {
        $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return response()->json([
                'status'  => 'error', 
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $mahasiswa->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Data berhasil dihapus',
        ], 200);
    }
}