<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MediaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Prodi
Route ::get('/prodi', [ProdiController::class, 'index']);
Route ::post('/prodi', [ProdiController::class, 'store']);
Route ::put('/prodi/{id}', [ProdiController::class, 'update']);
Route ::delete('/prodi/{id}', [ProdiController::class, 'destroy']);

// Mahasiswa
Route ::get('/mahasiswa', [MahasiswaController::class, 'index']);
Route ::post('/mahasiswa', [MahasiswaController::class, 'store']);
Route ::put('/mahasiswa/{id}', [MahasiswaController::class, 'update']);
Route ::delete('/mahasiswa/{id}', [MahasiswaController::class, 'destroy']);

// Kategori
Route ::get('/kategori', [KategoriController::class, 'index']);
Route ::post('/kategori', [KategoriController::class, 'store']);
Route ::put('/kategori/{id}', [KategoriController::class, 'update']);
Route ::delete('/kategori/{id}', [KategoriController::class, 'destroy']);

// Media
Route ::get('/media', [MediaController::class, 'index']);
Route ::post('/media', [MediaController::class, 'store']);
Route ::put('/media/{id}', [MediaController::class, 'update']);
Route ::delete('/media/{id}', [MediaController::class, 'destroy']);
