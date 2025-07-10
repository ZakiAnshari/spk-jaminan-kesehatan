<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Masyarakat extends Model
{
    protected $fillable = [
        'nik',
        'nama_lengkap',
        'alamat',
        'jenis_kelamin',
        'tanggal_lahir',
        'penghasilan',
        'jumlah_tanggungan',
        'status_pekerjaan',
        'status_rumah',
        'kondisi_rumah',
        'upload_dokumen',
    ];

}

