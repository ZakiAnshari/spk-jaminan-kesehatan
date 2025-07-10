<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Models\Masyarakat;
use App\Models\Perhitungan;
use Illuminate\Http\Request;

class PerhitunganController extends Controller
{
    public function index()
    {
        $penilaians = Penilaian::with(['subkriteria.kriteria', 'masyarakat'])->get();
        $masyarakatIds = $penilaians->pluck('masyarakat_id')->unique();
        $masyarakats = Masyarakat::whereIn('id', $masyarakatIds)->get();
        $kriterias = Kriteria::all();

        $nilaiMax = [];
        $nilaiMin = [];
        $matrixNormalisasi = [];

        // Hitung MAX dan MIN nilai per Kriteria
        foreach ($kriterias as $kriteria) {
            $nilaiKriteria = $penilaians->filter(function ($p) use ($kriteria) {
                return $p->subkriteria->kriteria_id == $kriteria->id;
            })->pluck('nilai');

            $nilaiMax[$kriteria->id] = $nilaiKriteria->max() ?: 1;
            $nilaiMin[$kriteria->id] = $nilaiKriteria->min() ?: 1;
        }

        // Hitung nilai ternormalisasi R_ij
        foreach ($masyarakats as $masyarakat) {
            foreach ($kriterias as $kriteria) {
                $penilaian = $penilaians->first(function ($p) use ($masyarakat, $kriteria) {
                    return $p->masyarakat_id == $masyarakat->id &&
                        $p->subkriteria->kriteria_id == $kriteria->id;
                });

                $nilai = $penilaian->nilai ?? 0;

                if ($kriteria->kriteria_jenis === 'Benefit') {
                    $normal = $nilai / $nilaiMax[$kriteria->id];
                } else {
                    $normal = $nilaiMin[$kriteria->id] / ($nilai ?: 1);
                }

                $matrixNormalisasi[$masyarakat->id][$kriteria->id] = round($normal, 4);
            }
        }

        // Hitung preferensi akhir dan peringkat
        $nilaiPreferensi = [];

        foreach ($masyarakats as $masyarakat) {
            $total = 0;
            foreach ($kriterias as $kriteria) {
                $r_ij = $matrixNormalisasi[$masyarakat->id][$kriteria->id] ?? 0;
                $w_j = $kriteria->kriteria_bobot; // dari accessor getKriteriaBobotAttribute()
                $total += $r_ij * $w_j;
            }
            $nilaiPreferensi[$masyarakat->id] = round($total, 4); // nilai akhir
        }

        // Urutkan dari nilai tertinggi ke terendah
        $peringkat = collect($nilaiPreferensi)->sortDesc()->toArray();

        // Kirim semua ke view
        return view('admin.perhitungan.index', compact(
            'masyarakats',
            'kriterias',
            'penilaians',
            'matrixNormalisasi',
            'nilaiPreferensi',
            'peringkat'
        ));
    }

    public function cetakperhitungan()
    {
        $penilaians = Penilaian::with(['subkriteria.kriteria', 'masyarakat'])->get();
        $masyarakatIds = $penilaians->pluck('masyarakat_id')->unique();
        $masyarakats = Masyarakat::whereIn('id', $masyarakatIds)->get();
        $kriterias = Kriteria::all();

        $nilaiMax = [];
        $nilaiMin = [];
        $matrixNormalisasi = [];

        // Hitung nilai maksimum dan minimum per kriteria
        foreach ($kriterias as $kriteria) {
            $nilaiKriteria = $penilaians->filter(function ($p) use ($kriteria) {
                return $p->subkriteria->kriteria_id == $kriteria->id;
            })->pluck('nilai');

            $nilaiMax[$kriteria->id] = $nilaiKriteria->max() ?: 1;
            $nilaiMin[$kriteria->id] = $nilaiKriteria->min() ?: 1;
        }

        // Hitung nilai ternormalisasi R_ij
        foreach ($masyarakats as $masyarakat) {
            foreach ($kriterias as $kriteria) {
                $penilaian = $penilaians->first(function ($p) use ($masyarakat, $kriteria) {
                    return $p->masyarakat_id == $masyarakat->id &&
                        $p->subkriteria->kriteria_id == $kriteria->id;
                });

                $nilai = $penilaian->nilai ?? 0;

                if ($kriteria->kriteria_jenis === 'Benefit') {
                    $normal = $nilai / $nilaiMax[$kriteria->id];
                } else {
                    $normal = $nilaiMin[$kriteria->id] / ($nilai ?: 1);
                }

                $matrixNormalisasi[$masyarakat->id][$kriteria->id] = round($normal, 4);
            }
        }

        // Hitung nilai preferensi akhir
        $nilaiPreferensi = [];

        foreach ($masyarakats as $masyarakat) {
            $total = 0;
            foreach ($kriterias as $kriteria) {
                $r_ij = $matrixNormalisasi[$masyarakat->id][$kriteria->id] ?? 0;
                $w_j = $kriteria->kriteria_bobot; // bobot dari accessor
                $total += $r_ij * $w_j;
            }
            $nilaiPreferensi[$masyarakat->id] = round($total, 4);
        }

        // Urutkan untuk peringkat (dari nilai terbesar ke terkecil)
        $peringkat = collect($nilaiPreferensi)->sortDesc()->toArray();

        // Kirim ke view cetak
        return view('admin.perhitungan.cetak', compact(
            'masyarakats',
            'kriterias',
            'penilaians',
            'matrixNormalisasi',
            'nilaiPreferensi',
            'peringkat'
        ));
    }
}
