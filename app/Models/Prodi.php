<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    protected $table = 'prodi';
    protected $primaryKey = 'prodi_id';

    protected $fillable = [
        'nama_prodi',
        'singkatan'
    ];

    // relasi ke mahasiswa
    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class, 'prodi_id');
    }
}