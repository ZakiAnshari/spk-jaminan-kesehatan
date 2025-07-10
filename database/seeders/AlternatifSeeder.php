<?php

namespace Database\Seeders;

use App\Models\Masyarakat;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AlternatifSeeder extends Seeder
{
    public function run(): void
    {
        Masyarakat::create([
            'nik'                => '1378010101010001',
            'nama_lengkap'       => 'Ahmad Fauzi',
            'alamat'             => 'Jl. Mawar No. 12, Padang',
            'jenis_kelamin'      => 'Laki-laki',
            'tanggal_lahir'      => '1985-04-15',
            'penghasilan'        => 1500000,
            'jumlah_tanggungan'  => 4,
            'status_pekerjaan'   => 'Buruh',
            'status_rumah'       => 'Sewa',
            'kondisi_rumah'      => 'Kurang Layak',
            'upload_dokumen'     => 'dokumen_ahmad.pdf',
        ]);

        Masyarakat::create([
            'nik'                => '1378010202020002',
            'nama_lengkap'       => 'Siti Aminah',
            'alamat'             => 'Komplek Griya Permata, Padang Panjang',
            'jenis_kelamin'      => 'Perempuan',
            'tanggal_lahir'      => '1990-06-22',
            'penghasilan'        => 2500000,
            'jumlah_tanggungan'  => 2,
            'status_pekerjaan'   => 'Ibu Rumah Tangga',
            'status_rumah'       => 'Milik Sendiri',
            'kondisi_rumah'      => 'Layak',
            'upload_dokumen'     => 'dokumen_siti.pdf',
        ]);

        Masyarakat::create([
            'nik'                => '1378010303030003',
            'nama_lengkap'       => 'Rahmat Hidayat',
            'alamat'             => 'Jl. Kenanga, Bukittinggi',
            'jenis_kelamin'      => 'Laki-laki',
            'tanggal_lahir'      => '1978-12-01',
            'penghasilan'        => 1000000,
            'jumlah_tanggungan'  => 5,
            'status_pekerjaan'   => 'Petani',
            'status_rumah'       => 'Menumpang',
            'kondisi_rumah'      => 'Tidak Layak',
            'upload_dokumen'     => 'dokumen_rahmat.pdf',
        ]);

        Masyarakat::create([
            'nik'                => '1378010404040004',
            'nama_lengkap'       => 'Linda Oktaviani',
            'alamat'             => 'Perumahan Bumi Asri, Solok',
            'jenis_kelamin'      => 'Perempuan',
            'tanggal_lahir'      => '1995-10-10',
            'penghasilan'        => 1800000,
            'jumlah_tanggungan'  => 3,
            'status_pekerjaan'   => 'Pedagang',
            'status_rumah'       => 'Sewa',
            'kondisi_rumah'      => 'Kurang Layak',
            'upload_dokumen'     => 'dokumen_linda.pdf',
        ]);

        Masyarakat::create([
            'nik'                => '1378010505050005',
            'nama_lengkap'       => 'Doni Saputra',
            'alamat'             => 'Jl. Merpati No. 7, Payakumbuh',
            'jenis_kelamin'      => 'Laki-laki',
            'tanggal_lahir'      => '1988-09-09',
            'penghasilan'        => 900000,
            'jumlah_tanggungan'  => 6,
            'status_pekerjaan'   => 'Tidak Bekerja',
            'status_rumah'       => 'Menumpang',
            'kondisi_rumah'      => 'Tidak Layak',
            'upload_dokumen'     => 'dokumen_doni.pdf',
        ]);
    }
}
