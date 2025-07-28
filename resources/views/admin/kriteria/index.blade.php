@extends('layouts.admin')
@section('title', 'Alternatif')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <h4 class="fw-bold d-flex align-items-center my-4">
                    <i class="menu-icon tf-icons bx bx-id-card" style="font-size: 1.5rem;"></i>
                    <span class="text-muted fw-light me-1"></span> Data Kriteria
                </h4>

                <div class="col-lg-12">
                    <div class="card">
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
                                <h5 class="pb-2 border-bottom">Table Kriteria</h5>

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
                                                <h5 class="modal-title" id="addProductModalLabel">Tambah Kriteria</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('kriteria.store') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <!-- Kolom Kiri -->
                                                        <div class="col-lg-6">
                                                            <!-- Kode Kriteria -->
                                                            <div class="form-group mb-3">
                                                                <label for="kriteria_code" class="form-label">Kode
                                                                    Kriteria</label>
                                                                <input type="text" id="kriteria_code"
                                                                    name="kriteria_code" class="form-control"
                                                                    placeholder="Masukkan Kode Kriteria" required>
                                                            </div>
                                                            <!-- Nama Kriteria -->
                                                            <div class="form-group mb-3">
                                                                <label for="kriteria_nama" class="form-label">Nama
                                                                    Kriteria</label>
                                                                <input type="text" id="kriteria_nama"
                                                                    name="kriteria_nama" class="form-control"
                                                                    placeholder="Masukkan Nama Kriteria" required>
                                                            </div>
                                                        </div>

                                                        <!-- Kolom Kanan -->
                                                        <div class="col-lg-6">
                                                            <!-- Jenis Kriteria -->
                                                            <div class="form-group mb-3">
                                                                <label for="kriteria_jenis" class="form-label">Jenis
                                                                    Kriteria</label>
                                                                <select id="kriteria_jenis" name="kriteria_jenis"
                                                                    class="form-select" required>
                                                                    <option value="">Pilih Jenis</option>
                                                                    <option value="Benefit">Benefit</option>
                                                                    <option value="Cost">Cost</option>
                                                                </select>
                                                            </div>

                                                            <!-- Bobot Kriteria -->
                                                            <div class="form-group mb-3">
                                                                <label for="kriteria_berat" class="form-label">Tingkat
                                                                    Kepentingan (Berat)</label>
                                                                <select id="kriteria_berat" name="kriteria_berat"
                                                                    class="form-select" required>
                                                                    <option value="">Pilih Berat</option>
                                                                    <option value="1">(1) Tidak Penting</option>
                                                                    <option value="2">(2) Lumayan Penting</option>
                                                                    <option value="3">(3) Penting</option>
                                                                    <option value="4">(4) Sangat Penting</option>
                                                                    <option value="5">(5) Sangat Penting Sekali
                                                                    </option>
                                                                </select>
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
                                            <th>Kode</th>
                                            <th>Nama Kriteria</th>
                                            <th>Jenis Kriteria</th>
                                            <th>Berat</th>
                                            <th style="width: 80px; text-align: center;">Aksi</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        @forelse ($kriterias  as $index => $item)
                                            <tr>
                                                <td>{{ $kriterias->firstItem() + $index }}</td>
                                                <td>{{ $item->kriteria_code }}</td>
                                                <td>{{ $item->kriteria_nama }}</td>
                                                <td>{{ $item->kriteria_jenis }}</td>
                                                <td>{{ $item->kriteria_berat }}</td>
                                                <td>
                                                    <a href="{{ route('kriteria.sub', ['kriteria' => $item->id]) }}"
                                                        class="btn btn-icon btn-outline-info" title="Lihat Sub-Kriteria">
                                                        <i class="bx bx-git-branch"></i>
                                                    </a>
                                                    <a href="kriteria-edit/{{ $item->id }}"
                                                        class="btn btn-icon btn-outline-primary" title="Edit Data">
                                                        <i class="bx bx-edit-alt"></i>
                                                    </a>

                                                    <a href="javascript:void(0)"
                                                        onclick="confirmDeleteKriteria({{ $item->id }}, @js($item->kriteria_nama))"
                                                        style="display:inline;">
                                                        <button class="btn btn-icon btn-outline-danger">
                                                            <i class="bx bx-trash"></i>
                                                        </button>
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center">Data Kosong</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                                <!-- Pagination -->
                                <div class="d-flex justify-content-end mt-3">
                                    {{ $kriterias->appends(request()->input())->links('pagination::bootstrap-4') }}
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
        function confirmDeleteKriteria(id, nama) {
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
                    window.location.href = `/kriteria-destroy/${id}`;
                }
            });
        }
    </script>



    <script>
        const today = new Date().toISOString().split('T')[0];

        document.getElementById('tanggal').setAttribute('min', today);
        document.getElementById('jatuh_tempo').setAttribute('min', today);
    </script>
    @include('sweetalert::alert')
@endsection
