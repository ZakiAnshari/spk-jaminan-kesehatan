<?php

namespace Database\Seeders;

use App\Models\Kriteria;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KriteriaSeeder extends Seeder
{
    public function run(): void
    {
        Kriteria::create([
            'kriteria_code'  => 'C1',
            'kriteria_nama'  => 'Penghasilan',
            'kriteria_jenis' => 'Benefit',
            'kriteria_berat' => 0.5,
        ]);

        Kriteria::create([
            'kriteria_code'  => 'C2',
            'kriteria_nama'  => 'Jumlah Tanggungan',
            'kriteria_jenis' => 'Benefit',
            'kriteria_berat' => 0.4,
        ]);

        Kriteria::create([
            'kriteria_code'  => 'C3',
            'kriteria_nama'  => 'Status Pekerjaan',
            'kriteria_jenis' => 'Benefit',
            'kriteria_berat' => 0.3,
        ]);

        Kriteria::create([
            'kriteria_code'  => 'C4',
            'kriteria_nama'  => 'Status Rumah',
            'kriteria_jenis' => 'Cost',
            'kriteria_berat' => 0.2,
        ]);

        Kriteria::create([
            'kriteria_code'  => 'C5',
            'kriteria_nama'  => 'Kondisi Rumah',
            'kriteria_jenis' => 'Cost',
            'kriteria_berat' => 0.1,
        ]);
    }
}
