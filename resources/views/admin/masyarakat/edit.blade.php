@extends('layouts.admin')
@section('title', 'Edit')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold d-flex align-items-center my-4">


            <i class="bx bx-user me-2 text-primary" style="font-size: 1.5rem;"></i>
            <span class="text-muted fw-light me-1"></span> Karyawan User
        </h4>
        <div class="card">
            <div class="d-flex align-items-center justify-content-between border-bottom pb-2 mb-3">
                <a class="mx-4 my-4" href="/masyarakat">
                    <button class="btn btn-outline-primary border-1 rounded-1 px-3 py-1 d-flex align-items-center"
                        data-bs-toggle="tooltip" title="Kembali">
                        <i class="bi bi-arrow-left fs-5 mx-1"></i>
                        <span class="fw-normal">Kembali</span>
                    </button>
                </a>
            </div>
            <div class="card-body">
                <div class="text-nowrap">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ url('masyarakat-edit/' . $masyarakats->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <!-- Kolom Kiri -->
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="nik" class="form-label">NIK</label>
                                    <input type="text" name="nik" class="form-control" id="nik" maxlength="16"
                                        pattern="\d{16}" required value="{{ $masyarakats->nik }}"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,16);">
                                </div>

                                <div class="mb-3">
                                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                    <input type="text" name="nama_lengkap" class="form-control" id="nama_lengkap"
                                        value="{{ $masyarakats->nama_lengkap }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-select" required>
                                        <option value="" disabled>-- Pilih --</option>
                                        <option value="Laki-laki"
                                            {{ $masyarakats->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                                        </option>
                                        <option value="Perempuan"
                                            {{ $masyarakats->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan
                                        </option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir"
                                        value="{{ $masyarakats->tanggal_lahir }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea name="alamat" id="alamat" class="form-control" rows="1" required>{{ $masyarakats->alamat }}</textarea>
                                </div>




                            </div>

                            <!-- Kolom Kanan -->
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="penghasilan" class="form-label">Penghasilan (Rp)</label>
                                    <input type="text" name="penghasilan" class="form-control" id="penghasilan"
                                        oninput="formatRupiah(this)" placeholder="Rp."
                                        value="Rp. {{ number_format($masyarakats->penghasilan, 0, ',', '.') }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="jumlah_tanggungan" class="form-label">Jumlah Tanggungan</label>
                                    <input type="number" name="jumlah_tanggungan" class="form-control"
                                        id="jumlah_tanggungan" value="{{ $masyarakats->jumlah_tanggungan }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="status_pekerjaan" class="form-label">Status Pekerjaan</label>
                                    <select name="status_pekerjaan" id="status_pekerjaan" class="form-select" required>
                                        <option value="" disabled>-- Pilih --</option>
                                        <option value="Pengangguran"
                                            {{ $masyarakats->status_pekerjaan == 'Pengangguran' ? 'selected' : '' }}>
                                            Pengangguran</option>
                                        <option value="Pekerja Tidak Tetap"
                                            {{ $masyarakats->status_pekerjaan == 'Pekerja Tidak Tetap' ? 'selected' : '' }}>
                                            Pekerja Tidak Tetap</option>
                                        <option value="Pekerja Tetap"
                                            {{ $masyarakats->status_pekerjaan == 'Pekerja Tetap' ? 'selected' : '' }}>
                                            Pekerja Tetap</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="status_rumah" class="form-label">Status Rumah</label>
                                    <select name="status_rumah" id="status_rumah" class="form-select" required>
                                        <option value="" disabled>-- Pilih --</option>
                                        <option value="Menumpang"
                                            {{ $masyarakats->status_rumah == 'Menumpang' ? 'selected' : '' }}>Menumpang
                                        </option>
                                        <option value="Sewa"
                                            {{ $masyarakats->status_rumah == 'Sewa' ? 'selected' : '' }}>Sewa</option>
                                        <option value="Milik Sendiri"
                                            {{ $masyarakats->status_rumah == 'Milik Sendiri' ? 'selected' : '' }}>Milik
                                            Sendiri</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="kondisi_rumah" class="form-label">Kondisi Rumah</label>
                                    <select name="kondisi_rumah" id="kondisi_rumah" class="form-select" required>
                                        <option value="" disabled>-- Pilih --</option>
                                        <option value="Tidak Layak"
                                            {{ $masyarakats->kondisi_rumah == 'Tidak Layak' ? 'selected' : '' }}>Tidak
                                            Layak
                                        </option>
                                        <option value="Kurang Layak"
                                            {{ $masyarakats->kondisi_rumah == 'Kurang Layak' ? 'selected' : '' }}>Kurang
                                            Layak</option>
                                        <option value="Layak"
                                            {{ $masyarakats->kondisi_rumah == 'Layak' ? 'selected' : '' }}>Layak</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="mb-3">
                                        <label for="upload_dokumen" class="form-label">Kartu Keluarga (KK)</label>
                                        <input type="file" name="upload_dokumen" class="form-control"
                                            id="upload_dokumen">

                                        @php
                                            $ext = $masyarakats->upload_dokumen
                                                ? strtolower(pathinfo($masyarakats->upload_dokumen, PATHINFO_EXTENSION))
                                                : null;

                                            $dokumenPath = $masyarakats->upload_dokumen
                                                ? asset('storage/' . $masyarakats->upload_dokumen)
                                                : null;
                                        @endphp

                                        <div class="mt-3 text-center">
                                            @if ($dokumenPath && in_array($ext, ['jpg', 'jpeg', 'png']))
                                                <img src="{{ $dokumenPath }}" alt="Dokumen Sebelumnya"
                                                    style="max-width: 30%; height: auto; border: 1px solid #ccc; padding: 4px; border-radius: 4px;">
                                            @else
                                                <p class="text-muted fst-italic">Dokumen tidak ada.</p>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="text-end mt-3">
                                <a href="{{ route('masyarakat.index') }}" class="btn btn-outline-secondary">Batal</a>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>

                        </div>
                        <!-- Tombol -->

                    </form>
                </div>
            </div>
        </div>


    </div>

    <script>
        function formatRupiah(el) {
            let value = el.value.replace(/[^,\d]/g, '').toString();
            let split = value.split(',');
            let sisa = split[0].length % 3;
            let rupiah = split[0].substr(0, sisa);
            let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
            el.value = 'Rp. ' + rupiah;
        }
    </script>
    @include('sweetalert::alert')
@endsection
