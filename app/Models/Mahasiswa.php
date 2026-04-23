<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;
    // deklarasi nama tabel database
    protected $table = 'mahasiswa';

    //deklarasi primary key
    protected $primaryKey = 'mahasiswa_id';

    // deklarasi kolom yang bisa di ubah
    protected $fillable = [
        'nim',
        'nama_lengkap',
        'kelas',
        'prodi_id',
    ];
    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id', 'prodi_id');
    }

    public function media()
    {
        return $this->hasMany(Media::class, 'mahasiswa_id', 'mahasiswa_id');
    }
}