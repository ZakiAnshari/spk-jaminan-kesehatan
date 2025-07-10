<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    protected $fillable = [
        'kriteria_code',
        'kriteria_nama',
        'kriteria_jenis',
        'kriteria_berat'
    ];

    // Relasi ke subkriteria
    public function subkriterias()
    {
        return $this->hasMany(Subkriteria::class);
    }

    // RUMUS Hitung Normalisasi
    public static function totalBobot()
    {
        return self::sum('kriteria_berat');
    }
    public function getBobotNormalisasiAttribute()
    {
        $total = self::totalBobot();
        return $total > 0 ? $this->kriteria_berat / $total : 0;
    }
    public function getKriteriaBobotAttribute()
    {
        return $this->bobot_normalisasi;
    }

}
