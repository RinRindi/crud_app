<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Media;
use Illuminate\Support\Facades\Validator;

class MediaController extends Controller
{
    /**
     * + index(): menampilkan semua data media beserta relasinya
     */
    public function index()
    {
        // Mengambil data media beserta detail mahasiswa dan kategorinya (Eager Loading)
        $media = Media::with(['mahasiswa', 'kategori'])->get();
        return response()->json($media, 200);
    }

    /**
     * + simpan(): menyimpan data media baru
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mahasiswa_id'     => 'required|exists:mahasiswa,mahasiswa_id',
            'kategori_id'      => 'required|exists:kategori,kategori_id',
            'judul'            => 'required|string|max:255',
            'deskripsi'        => 'required|string',
            'judul_penelitian' => 'required|string|max:255',
            'tahun_terbit'     => 'required|digits:4',
            'link_media'       => 'required|url',
            'gambar_cover'     => 'required|string', // Jika API, biasanya kirim nama file atau base64
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $media = Media::create($request->all());

        return response()->json([
            'status' => 'success',
            'data'   => $media
        ], 201);
    }

    /**
     * Menampilkan detail satu media
     */
    public function show(string $id)
    {
        $media = Media::with(['mahasiswa', 'kategori'])->find($id);

        if (!$media) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Data media tidak ditemukan'
            ], 404);
        }

        return response()->json($media, 200);
    }

    /**
     * + update(): memperbarui data media
     */
    public function update(Request $request, string $id)
    {
        $media = Media::find($id);

        if (!$media) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'mahasiswa_id'     => 'required|exists:mahasiswa,mahasiswa_id',
            'kategori_id'      => 'required|exists:kategori,kategori_id',
            'judul'            => 'required|string|max:255',
            'deskripsi'        => 'required|string',
            'judul_penelitian' => 'required|string|max:255',
            'tahun_terbit'     => 'required|digits:4',
            'link_media'       => 'required|url',
            'gambar_cover'     => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $media->update($request->all());

        return response()->json([
            'status' => 'success',
            'data'   => $media
        ], 200);
    }

    /**
     * + hapus(): menghapus data media
     */
    public function destroy(string $id)
    {
        $media = Media::find($id);

        if (!$media) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $media->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Media berhasil dihapus',
        ], 200);
    }
}