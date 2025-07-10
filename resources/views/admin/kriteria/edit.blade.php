@extends('layouts.admin')
@section('title', 'Edit')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold d-flex align-items-center my-4">


            <i class="bx bx-user me-2 text-primary" style="font-size: 1.5rem;"></i>
            <span class="text-muted fw-light me-1"></span> Kriteria Edit
        </h4>
        <div class="card">
            <div class="d-flex align-items-center justify-content-between border-bottom pb-2 mb-3">
                <a class="mx-4 my-4" href="/kriteria">
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
                    <form action="{{ url('kriteria-edit/' . $kriterias->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('POST') <!-- Gunakan method PUT untuk update data -->
                        <div class="row">
                            <!-- Kolom Kiri -->
                            <div class="col-lg-6 ">
                                <div class="form-group my-2">
                                    <label class="form-label">Kode</label>
                                    <input type="text" name="kriteria_code" class="form-control"
                                        value="{{ $kriterias->kriteria_code }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Nama Kriteria</label>
                                    <input type="text" name="kriteria_nama" class="form-control"
                                        value="{{ $kriterias->kriteria_nama }}">
                                </div>
                            </div>

                            <!-- Kolom Kanan -->
                            <div class="col-lg-6 ">
                                <div class="form-group my-2">
                                    <label class="form-label">Jenis Kriteria</label>
                                    <select class="form-select" name="kriteria_jenis" required>
                                        <option value="Benefit"
                                            {{ $kriterias->kriteria_jenis == 'Benefit' ? 'selected' : '' }}>Benefit</option>
                                        <option value="Cost" {{ $kriterias->kriteria_jenis == 'Cost' ? 'selected' : '' }}>
                                            Cost</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Berat</label>
                                    <select class="form-select" name="kriteria_berat" required>
                                        <option value="">Pilih</option>
                                        <option value="1" {{ $kriterias->kriteria_berat == 1 ? 'selected' : '' }}>(1)
                                            Tidak Penting</option>
                                        <option value="2" {{ $kriterias->kriteria_berat == 2 ? 'selected' : '' }}>(2)
                                            Lumayan Penting</option>
                                        <option value="3" {{ $kriterias->kriteria_berat == 3 ? 'selected' : '' }}>(3)
                                            Penting</option>
                                        <option value="4" {{ $kriterias->kriteria_berat == 4 ? 'selected' : '' }}>(4)
                                            Sangat Penting</option>
                                        <option value="5" {{ $kriterias->kriteria_berat == 5 ? 'selected' : '' }}>(5)
                                            Sangat Penting Sekali</option>
                                    </select>
                                </div>
                            </div>
                            <div class="text-end mt-3">
                                <a href="{{ route('kriteria.index') }}" class="btn btn-outline-secondary">Batal</a>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>

                        </div>
                        <!-- Tombol -->

                    </form>
                </div>
            </div>
        </div>


    </div>

    @include('sweetalert::alert')
@endsection
