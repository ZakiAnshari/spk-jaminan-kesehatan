<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subkriteria extends Model
{
    // Mass assignment protection
    protected $fillable = [
        'kriteria_id',
        'subkriteria_nama',
        'subkriteria_berat',
    ];

    // Relasi ke model Kriteria
    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'kriteria_id');
    }
}
