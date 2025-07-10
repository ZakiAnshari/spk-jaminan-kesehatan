<?php

namespace App\Http\Controllers;

use App\Models\Masyarakat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class MasyarakatController extends Controller
{
    public function index(Request $request)
    {
        // Ambil input keyword pencarian dan jumlah item per halaman
        $nama_masyarakat = $request->input('search'); // bisa nama atau NIK
        $paginate = $request->input('itemsPerPage', 5); // default 5 item per halaman

        // Mulai query
        $query = Masyarakat::query();

        // Jika ada keyword pencarian
        if (!empty($nama_masyarakat)) {
            $query->where(function ($q) use ($nama_masyarakat) {
                $q->where('nama_lengkap', 'like', '%' . $nama_masyarakat . '%')
                    ->orWhere('nik', 'like', '%' . $nama_masyarakat . '%');
            });
        }

        // Eksekusi query dengan paginasi
        $masyarakats = $query->paginate($paginate);

        // Kirim data ke view
        return view('admin.masyarakat.index', compact('masyarakats', 'nama_masyarakat'));
    }

    public function store(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'nik'               => 'required|string|max:20|unique:masyarakats,nik',
            'nama_lengkap'      => 'required|string|max:255',
            'alamat'            => 'required|string',
            'jenis_kelamin'     => 'required|in:Laki-laki,Perempuan',
            'tanggal_lahir'     => 'required|date',
            'penghasilan'       => 'required',
            'jumlah_tanggungan' => 'required|integer|min:0',
            'status_pekerjaan'  => 'required|string|max:100',
            'status_rumah'      => 'required|string|max:100',
            'kondisi_rumah'     => 'required|string|max:100',
            'upload_dokumen'    => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        // Bersihkan format rupiah (misal Rp. 1.000.000 => 1000000)
        $cleanPenghasilan = preg_replace('/[^\d]/', '', $request->input('penghasilan'));
        $validated['penghasilan'] = (int) $cleanPenghasilan;

        // Proses upload dokumen jika ada
        $filePath = null;
        if ($request->hasFile('upload_dokumen')) {
            $filePath = $request->file('upload_dokumen')->store('dokumen', 'public');
        }

        // Simpan ke database
        Masyarakat::create([
            'nik'               => $validated['nik'],
            'nama_lengkap'      => $validated['nama_lengkap'],
            'alamat'            => $validated['alamat'],
            'jenis_kelamin'     => $validated['jenis_kelamin'],
            'tanggal_lahir'     => $validated['tanggal_lahir'],
            'penghasilan'       => $validated['penghasilan'],
            'jumlah_tanggungan' => $validated['jumlah_tanggungan'],
            'status_pekerjaan'  => $validated['status_pekerjaan'],
            'status_rumah'      => $validated['status_rumah'],
            'kondisi_rumah'     => $validated['kondisi_rumah'],
            'upload_dokumen'    => $filePath,
        ]);

        // Redirect dengan notifikasi
        Alert::success('Sukses', 'Data masyarakat berhasil ditambahkan');
        return redirect()->route('masyarakat.index');
    }

    public function edit($id)
    {
        $masyarakats = Masyarakat::find($id);
        // Validasi apakah data ditemukan
        if (!$masyarakats) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
        return view('admin.masyarakat.edit', compact('masyarakats'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data
        $validated = $request->validate([
            'nik'               => 'required|string|max:20|unique:masyarakats,nik,' . $id,
            'nama_lengkap'      => 'required|string|max:255',
            'alamat'            => 'required|string',
            'jenis_kelamin'     => 'required|in:Laki-laki,Perempuan',
            'tanggal_lahir'     => 'required|date',
            'penghasilan'       => 'required',
            'jumlah_tanggungan' => 'required|integer|min:0',
            'status_pekerjaan'  => 'required|string|max:100',
            'status_rumah'      => 'required|string|max:100',
            'kondisi_rumah'     => 'required|string|max:100',
            'upload_dokumen'    => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        // Ambil data lama
        $masyarakat = Masyarakat::findOrFail($id);

        // Bersihkan format rupiah (misal: Rp. 1.000.000 => 1000000)
        $cleanPenghasilan = preg_replace('/[^\d]/', '', $request->input('penghasilan'));
        $validated['penghasilan'] = (int) $cleanPenghasilan;

        // Proses upload dokumen baru jika ada
        if ($request->hasFile('upload_dokumen')) {
            // Hapus file lama jika ada
            if ($masyarakat->upload_dokumen && Storage::disk('public')->exists($masyarakat->upload_dokumen)) {
                Storage::disk('public')->delete($masyarakat->upload_dokumen);
            }

            // Simpan file baru
            $filePath = $request->file('upload_dokumen')->store('dokumen', 'public');
            $masyarakat->upload_dokumen = $filePath;
        }

        // Update semua field
        $masyarakat->nik               = $validated['nik'];
        $masyarakat->nama_lengkap      = $validated['nama_lengkap'];
        $masyarakat->alamat            = $validated['alamat'];
        $masyarakat->jenis_kelamin     = $validated['jenis_kelamin'];
        $masyarakat->tanggal_lahir     = $validated['tanggal_lahir'];
        $masyarakat->penghasilan       = $validated['penghasilan'];
        $masyarakat->jumlah_tanggungan = $validated['jumlah_tanggungan'];
        $masyarakat->status_pekerjaan  = $validated['status_pekerjaan'];
        $masyarakat->status_rumah      = $validated['status_rumah'];
        $masyarakat->kondisi_rumah     = $validated['kondisi_rumah'];

        // Simpan ke database
        $masyarakat->save();

        // Redirect dengan notifikasi
        Alert::success('Sukses', 'Data masyarakat berhasil diperbarui');
        return redirect()->route('masyarakat.index');
    }

    public function show($id)
    {
        $masyarakats = Masyarakat::findOrFail($id);
        return view('admin.masyarakat.show', compact('masyarakats'));
    }

    public function destroy($id)
    {

        $masyarakats = Masyarakat::where('id', $id)->first();
        $masyarakats->delete();

        Alert::success('Success', 'Data berhasil di Hapus');
        return redirect()->route('masyarakat.index');
    }
}
