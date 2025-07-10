@extends('layouts.admin')
@section('title', 'User')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold d-flex align-items-center my-4">


            <i class="bx bx-user me-2 text-primary" style="font-size: 1.5rem;"></i>
            <span class="text-muted fw-light me-1"></span> Lihat Alternatif
        </h4>
        <div class="card">
            <div class="d-flex align-items-center justify-content-between border-bottom pb-2 mb-3">
                <a class="mx-4 my-4" href="{{ route('masyarakat.index') }}">
                    <button class="btn btn-outline-primary border-1 rounded-1 px-3 py-1 d-flex align-items-center"
                        data-bs-toggle="tooltip" title="Kembali">
                        <i class="bi bi-arrow-left fs-5 mx-1"></i>
                        <span class="fw-normal">Kembali</span>
                    </button>
                </a>
            </div>


            <div class="card-body">
                <div class="text-nowrap">
                    <div class="row">
                        <!-- Kartu Kiri (Foto dan Identitas Dasar) -->
                        <div class="col-lg-4 mb-4">
                            <div class="card h-100">
                                <div class="card-body position-relative">
                                    <!-- Badge Jenis Kelamin -->
                                    <div class="position-absolute end-0 top-0 p-3">
                                        <span class="badge bg-primary">
                                            {{ $masyarakats->jenis_kelamin }}
                                        </span>
                                    </div>

                                    <!-- Foto Avatar -->
                                    <div class="text-center mt-3">
                                        <div class="chat-avatar d-inline-flex mx-auto mb-3">
                                            <img src="{{ asset('backend/assets/img/avatars/provil.jpg') }}" alt="user-image"
                                                class="user-avatar img-fluid"
                                                style="width: 150px; height: 150px; object-fit: cover; border-radius: 11px;">
                                        </div>


                                        <h5 class="mb-1">{{ $masyarakats->nama_lengkap }}</h5>
                                        <hr class="my-3">

                                        <!-- NIK -->
                                        <div class="d-flex align-items-center justify-content-center mb-2">
                                            <i class="ti ti-id-badge me-2 text-primary"></i>
                                            <p class="mb-0">{{ $masyarakats->nik }}</p>
                                        </div>

                                        <!-- Upload Dokumen -->
                                        <div class="text-center mt-3">
                                            @php
                                                $dokumenPath = $masyarakats->upload_dokumen
                                                    ? asset('storage/' . $masyarakats->upload_dokumen)
                                                    : null;
                                                $ext = $masyarakats->upload_dokumen
                                                    ? strtolower(
                                                        pathinfo($masyarakats->upload_dokumen, PATHINFO_EXTENSION),
                                                    )
                                                    : null;
                                            @endphp

                                            @if ($dokumenPath && in_array($ext, ['jpg', 'jpeg', 'png']))
                                                <img src="{{ $dokumenPath }}" alt="Dokumen KK" class="img-thumbnail"
                                                    style="max-width: 100%; height: auto; cursor: pointer; border: 1px solid #ccc; padding: 4px; border-radius: 4px;"
                                                    data-bs-toggle="modal" data-bs-target="#modalDokumen">
                                            @else
                                                <p class="text-muted fst-italic mt-2">Dokumen tidak ada.</p>
                                            @endif
                                            <!-- Modal Preview Dokumen -->
                                            <div class="modal fade" id="modalDokumen" tabindex="-1"
                                                aria-labelledby="modalDokumenLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Preview Dokumen</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Tutup"></button>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            @if ($dokumenPath && in_array($ext, ['jpg', 'jpeg', 'png']))
                                                                <img src="{{ $dokumenPath }}" alt="Preview Dokumen"
                                                                    class="img-fluid"
                                                                    style="max-height: 500px; border-radius: 10px;">
                                                            @else
                                                                <p class="text-muted">Dokumen tidak tersedia.</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Kartu Kanan (Detail Lengkap) -->
                        <div class="col-lg-8 mb-4">
                            <div class="card h-100">
                                <div class="card-header">
                                    <h5 class="mb-0">Detail Data</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">

                                        <!-- Baris 1 -->
                                        <div class="col-md-6 border-bottom pb-3 mb-3">
                                            <label class="text-muted mb-1">Nama Lengkap</label>
                                            <div class="fw-semibold">{{ $masyarakats->nama_lengkap }}</div>
                                        </div>
                                        <div class="col-md-6 border-bottom pb-3 mb-3">
                                            <label class="text-muted mb-1">NIK</label>
                                            <div class="fw-semibold">{{ $masyarakats->nik }}</div>
                                        </div>

                                        <!-- Baris 2 -->
                                        <div class="col-md-6 border-bottom pb-3 mb-3">
                                            <label class="text-muted mb-1">Jenis Kelamin</label>
                                            <div class="fw-semibold">{{ $masyarakats->jenis_kelamin }}</div>
                                        </div>
                                        <div class="col-md-6 border-bottom pb-3 mb-3">
                                            <label class="text-muted mb-1">Tanggal Lahir</label>
                                            <div class="fw-semibold">
                                                {{ \Carbon\Carbon::parse($masyarakats->tanggal_lahir)->format('d-m-Y') }}
                                            </div>
                                        </div>

                                        <!-- Baris 3 -->
                                        <div class="col-md-6 border-bottom pb-3 mb-3">
                                            <label class="text-muted mb-1">Penghasilan</label>
                                            <div class="fw-semibold">
                                                Rp {{ number_format($masyarakats->penghasilan, 0, ',', '.') }}
                                            </div>
                                        </div>
                                        <div class="col-md-6 border-bottom pb-3 mb-3">
                                            <label class="text-muted mb-1">Jumlah Tanggungan</label>
                                            <div class="fw-semibold">{{ $masyarakats->jumlah_tanggungan }}</div>
                                        </div>

                                        <!-- Baris 4 -->
                                        <div class="col-md-6 border-bottom pb-3 mb-3">
                                            <label class="text-muted mb-1">Status Pekerjaan</label>
                                            <div class="fw-semibold">{{ $masyarakats->status_pekerjaan }}</div>
                                        </div>
                                        <div class="col-md-6 border-bottom pb-3 mb-3">
                                            <label class="text-muted mb-1">Status Rumah</label>
                                            <div class="fw-semibold">{{ $masyarakats->status_rumah }}</div>
                                        </div>

                                        <!-- Baris 5 -->
                                        <div class="col-md-12 border-bottom pb-3 mb-3">
                                            <label class="text-muted mb-1">Kondisi Rumah</label>
                                            <div class="fw-semibold">{{ $masyarakats->kondisi_rumah }}</div>
                                        </div>

                                        <!-- Baris 6 -->
                                        <div class="col-md-12">
                                            <label class="text-muted mb-1">Alamat</label>
                                            <div class="fw-semibold">{{ $masyarakats->alamat }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


        </div>


    </div>

    @include('sweetalert::alert')
@endsection
