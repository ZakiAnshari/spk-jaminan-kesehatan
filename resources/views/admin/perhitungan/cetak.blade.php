<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Perhitungan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
            font-size: 14px;
            color: #000;
        }

        /* Tebalkan isi dan garis tabel */
        table {
            border: 2px solid #000;
        }

        table th,
        table td {
            font-weight: bold;
            font-size: 14px;
            padding: 8px;
            border: 2px solid #000 !important;
        }

        @media print {
            .no-print {
                display: none;
            }

            body {
                font-size: 12px;
                color: #000;
            }

            table {
                border: 2px solid #000 !important;
            }

            table th,
            table td {
                font-size: 12px !important;
                padding: 8px !important;
                font-weight: bold !important;
                border: 2px solid #000 !important;
            }

            .print-no-scroll {
                overflow: visible !important;
            }

            .print-no-scroll::-webkit-scrollbar {
                display: none !important;
            }

            .table-responsive {
                overflow-x: visible !important;
            }
        }
    </style>
</head>

<body class="bg-light">

    <div class="container py-4">
        <!-- Judul Laporan -->
        <div class="text-center mb-4">
            <h2 class="fw-bold text-uppercase">LAPORAN HASIL PERHITUNGAN</h2>
            <h5 class="mt-2">Sistem Pendukung Keputusan Penentuan Penerima Jaminan Kesehatan Masyarakat</h5>
            <h6 class="text-muted">BPJS Kesehatan Kota Padang Panjang</h6>
        </div>

        <!-- Tabel Hasil Perhitungan -->
        <div class="table-responsive text-nowrap print-no-scroll">
            <table class="table table-bordered align-middle text-nowrap mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 5px">No</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Status Pekerjaan</th>
                        <th>Kondisi Rumah</th>
                        <th>Status Rumah</th>
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
                            <td>{{ $masyarakat->nik }}</td>
                            <td>{{ $masyarakat->nama_lengkap }}</td>
                            <td>{{ $masyarakat->status_pekerjaan }}</td>
                            <td>{{ $masyarakat->kondisi_rumah }}</td>
                            <td>{{ $masyarakat->status_rumah }}</td>
                            <td>{{ number_format($nilai, 4) }}</td>
                            <td>{{ $rank++ }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Data Kosong</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Tanda Tangan Kanan Bawah -->
        <div style="position: absolute; bottom: 50px; right: 10%; text-align: right; width: 80%;">
            <p class="mb-1">{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</p>
            <p class="mb-5">Kepala Cabang BPJS Kesehatan</p>
            <p class="fw-bold text-uppercase mb-1">Haris Wahyudi</p>
            <p class="mb-0">NIP: 19720304 199601 1 003</p>
        </div>

        <!-- Auto Print -->
        <script type="text/javascript">
            window.print();
        </script>
    </div>

    <!-- Bootstrap Icons (optional) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</body>

</html>
