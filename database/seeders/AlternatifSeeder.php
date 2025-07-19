<?php

namespace Database\Seeders;

use App\Models\Masyarakat;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AlternatifSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['AFRIZAL', '1378010101010001', 'Laki-laki', 'SOPIR', 2500000, 2, 'Kontrak'],
            ['AGUNG P', '1378010202020002', 'Laki-laki', 'BURUH', 1200000, 2, 'Menumpang'],
            ['ASMIAR', '1378010303030003', 'Perempuan', 'PEDAGANG', 1800000, 4, 'Sewa'],
            ['ARNILUS', '1378010404040004', 'Laki-laki', 'PETANI', 1000000, 1, 'Menumpang'],
            ['ASRIZAL', '1378010505050005', 'Laki-laki', 'BURUH', 1300000, 1, 'Kontrak'],
            ['BUSRA K', '1378010606060006', 'Perempuan', 'PENJAHIT', 1100000, 1, 'Menumpang'],
            ['DAFRIZAL', '1378010707070007', 'Laki-laki', 'SOPIR', 1400000, 2, 'Sewa'],
            ['DEKO HADI', '1378010808080008', 'Laki-laki', 'BURUH', 1250000, 1, 'Sewa'],
            ['DESSY A', '1378010909090009', 'Perempuan', 'TIDAK BEKERJA', 950000, 1, 'Menumpang'],
            ['EKO P', '1378011010100010', 'Laki-laki', 'BURUH', 1500000, 2, 'Sewa'],
            ['ELMITA R', '1378011111110011', 'Perempuan', 'TIDAK BEKERJA', 1000000, 1, 'Menumpang'],
            ['ERIKA SARI', '1378011212120012', 'Perempuan', 'IBU RUMAH TANGGA', 900000, 1, 'Menumpang'],
            ['FIKA RESKI', '1378011313130013', 'Perempuan', 'KARYAWAN SWASTA', 1700000, 2, 'Kontrak'],
            ['GADISMAR', '1378011414140014', 'Laki-laki', 'PETANI', 950000, 1, 'Menumpang'],
            ['HENDRI O', '1378011515150015', 'Laki-laki', 'SOPIR', 1500000, 2, 'Menumpang'],
            ['HERMANO', '1378011616160016', 'Laki-laki', 'PEDAGANG', 2000000, 1, 'Menumpang'],
            ['IMAM M', '1378011717170017', 'Laki-laki', 'BURUH', 1350000, 1, 'Kontrak'],
            ['ISKANDAR', '1378011818180018', 'Laki-laki', 'SOPIR', 1600000, 2, 'Sewa'],
            ['ISWADI', '1378011919190019', 'Laki-laki', 'PETANI', 1100000, 3, 'Menumpang'],
            ['JAMILAH', '1378012020200020', 'Perempuan', 'PENJUAL KUE', 1000000, 1, 'Menumpang'],
        ];

        foreach ($data as $item) {
            \App\Models\Masyarakat::create([
                'nik'                => $item[1],
                'nama_lengkap'       => $item[0],
                'alamat'             => 'Alamat dummy - ' . $item[0],
                'jenis_kelamin'      => $item[2],
                'tanggal_lahir'      => '1985-01-01', // bisa disesuaikan random bila perlu
                'penghasilan'        => $item[4],
                'jumlah_tanggungan'  => $item[5],
                'status_pekerjaan'   => $item[3],
                'status_rumah'       => $item[6],
                'kondisi_rumah'      => $item[4] <= 1200000 ? 'Tidak Layak' : 'Kurang Layak',
                'upload_dokumen'     => 'dokumen_' . strtolower(str_replace(' ', '_', $item[0])) . '.pdf',
            ]);
        }
    }
}
