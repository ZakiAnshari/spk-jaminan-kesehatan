@extends('layouts.admin')
@section('title', 'Alternatif')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <h4 class="fw-bold d-flex align-items-center my-4">
                    <i class="menu-icon tf-icons bx bx-id-card" style="font-size: 1.5rem;"></i>
                    <span class="text-muted fw-light me-1"></span> Data Alternatif
                </h4>
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive text-nowrap">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <h5 class="pb-2 border-bottom">Table Alternatif</h5>
                                <div class="d-flex justify-content-between align-items-center">
                                    <!-- Form Search -->
                                    <form method="GET" class="d-flex align-items-center my-3" style="max-width: 350px;">
                                        <div class="input-group shadow-sm" style="height: 38px; width: 100%;">
                                            <input type="text" name="nama_lengkap" value="{{ request('nama_lengkap') }}"
                                                class="form-control border-end-0 py-2 px-3" style="font-size: 0.9rem;"
                                                placeholder="Cari Nama..." aria-label="Search">
                                            <button class="btn btn-outline-primary px-3" type="submit"
                                                style="font-size: 0.9rem;">
                                                <i class="bx bx-search"></i>
                                            </button>
                                        </div>
                                    </form>
                                    <!-- Judul -->
                                    <!-- Tombol Aksi -->
                                    <div class="d-flex gap-2">
                                        <!-- Tombol Tambah -->
                                        <button type="button"
                                            class="btn btn-outline-success account-image-reset  d-flex align-items-center"
                                            data-bs-toggle="modal" data-bs-target="#addProductModal">
                                            <i class="bx bx-plus me-2 d-block"></i>
                                            <span>Tambah</span>
                                        </button>

                                    </div>
                                </div>

                                <!-- Modal tambah Data -->
                                <div class="modal fade" id="addProductModal" tabindex="-1"
                                    aria-labelledby="addProductModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <!-- Judul -->
                                            <div class="modal-header">
                                                <h5 class="modal-title pb-2 border-bottom" id="addProductModalLabel">Tambah Alternatif</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="masyarakat-add" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <!-- Kolom Kiri -->
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="nik" class="form-label">NIK</label>
                                                                <input type="text" name="nik" class="form-control"
                                                                    id="nik" maxlength="16" pattern="\d{16}" required
                                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,16);">
                                                            </div>


                                                            <div class="mb-3">
                                                                <label for="nama_lengkap" class="form-label">Nama
                                                                    Lengkap</label>
                                                                <input type="text" name="nama_lengkap"
                                                                    class="form-control" id="nama_lengkap" required>
                                                            </div>




                                                            <div class="mb-3">
                                                                <label for="jenis_kelamin" class="form-label">Jenis
                                                                    Kelamin</label>
                                                                <select name="jenis_kelamin" id="jenis_kelamin"
                                                                    class="form-select" required>
                                                                    <option value="" disabled selected>-- Pilih --
                                                                    </option>
                                                                    <option value="Laki-laki">Laki-laki</option>
                                                                    <option value="Perempuan">Perempuan</option>
                                                                </select>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="tanggal_lahir" class="form-label">Tanggal
                                                                    Lahir</label>
                                                                <input type="date" name="tanggal_lahir"
                                                                    class="form-control" id="tanggal_lahir" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="alamat" class="form-label">Alamat</label>
                                                                <textarea name="alamat" id="alamat" class="form-control" rows="1" required></textarea>
                                                            </div>


                                                            
                                                        </div>

                                                        <!-- Kolom Kanan -->
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="penghasilan" class="form-label">Penghasilan
                                                                    (Rp)</label>
                                                                <input type="text" name="penghasilan"
                                                                    class="form-control" id="jumlah"
                                                                    oninput="formatRupiah(this)" placeholder="Rp."
                                                                    required>

                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="jumlah_tanggungan" class="form-label">Jumlah
                                                                    Tanggungan</label>
                                                                <input type="number" name="jumlah_tanggungan"
                                                                    class="form-control" id="jumlah_tanggungan" required>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="status_pekerjaan" class="form-label">Status
                                                                    Pekerjaan</label>
                                                                <select name="status_pekerjaan" id="status_pekerjaan"
                                                                    class="form-select" required>
                                                                    <option value="" disabled selected>-- Pilih
                                                                        --</option>
                                                                    <option value="Pengangguran">Pengangguran</option>
                                                                    <option value="Pekerja Tidak Tetap">Pekerja Tidak Tetap
                                                                    </option>
                                                                    <option value="Pekerja Tetap">Pekerja Tetap</option>
                                                                </select>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="status_rumah" class="form-label">Status
                                                                    Rumah</label>
                                                                <select name="status_rumah" id="status_rumah"
                                                                    class="form-select" required>
                                                                    <option value="" disabled selected>-- Pilih
                                                                        --</option>
                                                                    <option value="Menumpang">Menumpang</option>
                                                                    <option value="Sewa">Sewa</option>
                                                                    <option value="Milik Sendiri">Milik Sendiri</option>
                                                                </select>
                                                            </div>


                                                            <div class="mb-3">
                                                                <label for="kondisi_rumah" class="form-label">Kondisi
                                                                    Rumah</label>
                                                                <select name="kondisi_rumah" id="kondisi_rumah"
                                                                    class="form-select" required>
                                                                    <option value="" disabled selected>-- Pilih
                                                                        --</option>
                                                                    <option value="Tidak Layak">Tidak Layak</option>
                                                                    <option value="Kurang Layak">Kurang Layak</option>
                                                                    <option value="Layak">Layak</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="row">
                                                                <div class="mb-3">
                                                                <label for="upload_dokumen" class="form-label">Kartu
                                                                    Keluarga (KK)</label>
                                                                <input type="file" name="upload_dokumen"
                                                                    class="form-control" id="upload_dokumen">
                                                            </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Tombol -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>

                                <!-- Table Data -->
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%">No</th>
                                            <th>NIK</th>
                                            <th>Nama Lengkap</th>
                                            <th>Jenis Kelamin</th>
                                            <th style="width: 80px; text-align: center;">Aksi</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        @forelse ($masyarakats as $index => $item)
                                            <tr>
                                                <td>{{ $masyarakats->firstItem() + $index }}</td>
                                                <td>{{ $item->nik }}</td>
                                                <td>{{ $item->nama_lengkap }}</td>
                                                <td>{{ $item->jenis_kelamin }}</td>
                                                <td>
                                                    <a href="masyarakat-show/{{ $item->id }}"
                                                        class="btn btn-icon btn-outline-info" title="Lihat Data">
                                                        <i class="bx bx-show"></i> {{-- atau gunakan bx-eye jika bx-show tidak tersedia --}}
                                                    </a>
                                                    <a href="masyarakat-edit/{{ $item->id }}"
                                                        class="btn btn-icon btn-outline-primary" title="Edit Data">
                                                        <i class="bx bx-edit-alt"></i>
                                                    </a>

                                                    <a href="javascript:void(0)"
                                                        onclick="confirmDeleteMasyarakat({{ $item->id }}, @js($item->nama_lengkap))"
                                                        style="display:inline;">
                                                        <button class="btn btn-icon btn-outline-danger">
                                                            <i class="bx bx-trash"></i>
                                                        </button>
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center">Data Alternatif kosong.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                                <!-- Pagination -->
                                <div class="d-flex justify-content-end mt-3">
                                    {{ $masyarakats->appends(request()->input())->links('pagination::bootstrap-4') }}

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDeleteMasyarakat(id, nama) {
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: `"${nama}" akan dihapus secara permanen!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `/masyarakat-destroy/${id}`;
                }
            });
        }
    </script>

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

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            el.value = 'Rp. ' + rupiah;
        }
    </script>

    <script>
        const today = new Date().toISOString().split('T')[0];

        document.getElementById('tanggal').setAttribute('min', today);
        document.getElementById('jatuh_tempo').setAttribute('min', today);
    </script>
    @include('sweetalert::alert')
@endsection
