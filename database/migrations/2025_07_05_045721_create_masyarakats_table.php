<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('masyarakats', function (Blueprint $table) {
            $table->id(); // Primary key otomatis
            $table->string('nik')->unique(); // Nomor Induk Kependudukan, harus unik
            $table->string('nama_lengkap');
            $table->text('alamat')->nullable(); // Alamat, bisa kosong
            $table->string('jenis_kelamin'); // Menggunakan enum untuk pilihan terbatas
            $table->date('tanggal_lahir')->nullable(); // Tanggal lahir, bisa kosong
            $table->decimal('penghasilan', 15, 2)->nullable(); // Penghasilan dengan 2 angka di belakang koma, bisa kosong
            $table->string('jumlah_tanggungan')->default(0); // Jumlah tanggungan, default 0
            $table->string('status_pekerjaan')->nullable(); // Status pekerjaan, bisa kosong
            $table->string('status_rumah')->nullable(); // Status rumah, bisa kosong
            $table->string('kondisi_rumah')->nullable(); // Kondisi rumah, bisa kosong
            $table->text('upload_dokumen')->nullable(); // Nama file atau path dokumen, bisa kosong
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('masyarakats');
    }
};
