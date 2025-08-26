@extends('layouts.admin')
@section('title', 'Alternatif')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-lg-12 mb-3">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="pb-2 border-bottom mb-0">Table Hitung Normalisasi</h5>
                                <a href="{{ route('perhitungan.cetak') }}" class="btn btn-warning d-flex align-items-center"
                                    role="button" target="_blank">
                                    <i class="bx bx-printer me-1"></i> Cetak
                                </a>
                            </div>

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

                                <!-- Table Data -->
                                <table class="table table-hover table-bordered align-middle text-nowrap mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th style="width: 5px">No</th>
                                            <th>Kriteria</th>
                                            <th>Bobot</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($kriterias as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>({{ $item->kriteria_code }}) {{ $item->kriteria_nama }}</td>
                                                <td>{{ number_format($item->bobot_normalisasi, 4) }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">Data Kosong</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 mb-3 ">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="pb-2 border-bottom">Table Hasil Matrix X</h5>
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
                                <!-- Table Data -->
                                <table class="table table-hover table-bordered align-middle text-nowrap mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th style="width: 5px">No</th>
                                            <th>Nama Masyarakat</th>

                                            @foreach ($kriterias as $kriteria)
                                                <th>({{ $kriteria->kriteria_code }}) {{ $kriteria->kriteria_nama }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1; @endphp
                                        @foreach ($masyarakats as $item)
                                            @php
                                                // Ambil penilaian untuk masyarakat ini
                                                $penilaianMasyarakat = $penilaians->where('masyarakat_id', $item->id);

                                                // Cek apakah lengkap (jumlah kriteria = jumlah penilaian unik)
                                                $lengkap =
                                                    $penilaianMasyarakat
                                                        ->pluck('subkriteria.kriteria_id')
                                                        ->unique()
                                                        ->count() === $kriterias->count();
                                            @endphp

                                            @if ($lengkap)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $item->nama_lengkap }}</td>

                                                    @foreach ($kriterias as $kriteria)
                                                        @php
                                                            $nilai = $penilaianMasyarakat
                                                                ->where('subkriteria.kriteria_id', $kriteria->id)
                                                                ->first();
                                                        @endphp
                                                        <td>
                                                            {{ $nilai?->subkriteria?->subkriteria_berat ?? '-' }}
                                                        </td>
                                                    @endforeach


                                                </tr>
                                            @endif
                                        @endforeach

                                        @if ($no === 1)
                                            <tr>
                                                <td colspan="{{ 2 + count($kriterias) }}" class="text-center">Data Kosong
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="pb-2 border-bottom">Table Matrix Ternormalisasi</h5>

                            <div class="table-responsive text-nowrap">
                                <table class="table table-hover table-bordered align-middle text-nowrap mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th style="width: 5px">No</th>
                                            <th>Alternatif</th>
                                            @foreach ($kriterias as $kriteria)
                                                <th>({{ $kriteria->kriteria_code }}) {{ $kriteria->kriteria_nama }} </th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1; @endphp
                                        @forelse ($masyarakats as $masyarakat)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $masyarakat->nama_lengkap }}</td>
                                                @foreach ($kriterias as $kriteria)
                                                    <td>{{ $matrixNormalisasi[$masyarakat->id][$kriteria->id] ?? '-' }}
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="{{ 2 + count($kriterias) }}" class="text-center">Data Kosong
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div> <!-- End card-body -->
                    </div> <!-- End card -->
                </div>

                <div class="col-lg-12 mb-3">
                    <div class="card">
                        <div class="card-body">

                            <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
                                <h5 class="mb-0">Tabel Hasil Preferensi & Peringkat</h5>

                            </div>
                            <div class="table-responsive text-nowrap">
                                <table class="table table-hover table-bordered align-middle text-nowrap mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th style="width: 5px">No</th>
                                            <th>Alternatif</th>
                                            <th>Nilai Preferensi</th>
                                            <th style="width: 5px">Peringkat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $rank = 1; @endphp
                                        @forelse ($peringkat as $id => $nilai)
                                            @php
                                                $masyarakat = $masyarakats->firstWhere('id', $id);
                                            @endphp
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $masyarakat->nama_lengkap }}</td>
                                                <td>{{ number_format($nilai, 4) }}</td>
                                                <td>{{ $rank++ }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center">Data Kosong</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div> <!-- End card-body -->
                    </div> <!-- End card -->
                </div>

            </div>
        </div>
    </div>
    @include('sweetalert::alert')
@endsection
