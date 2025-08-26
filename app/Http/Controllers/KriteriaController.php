<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class KriteriaController extends Controller
{
    public function index(Request $request)
    {
        // Ambil input pencarian dan jumlah per halaman
        $kriteria_nama = $request->input('kriteria_nama');
        $paginate = $request->input('itemsPerPage', 5);
        $countData = Kriteria::count(); // ganti Product dgn modelmu
        // Inisialisasi query
        $query = Kriteria::query();

        // Filter pencarian jika ada input nama
        if (!empty($kriteria_nama)) {
            $query->where('kriteria_nama', 'LIKE', '%' . $kriteria_nama . '%');
        }

        // Eksekusi query dengan paginasi
        $kriterias = $query->paginate($paginate);

        // Kirim ke view
        return view('admin.kriteria.index', compact('kriterias', 'kriteria_nama','countData'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kriteria_code'  => 'required|string|max:255',
            'kriteria_nama'  => 'required|string|max:255|unique:kriterias,kriteria_nama',
            'kriteria_jenis' => 'required',
            'kriteria_berat' => 'required',
        ]);

        Kriteria::create($validated);

        Alert::success('Success', 'Data Kriteria berhasil ditambahkan');
        return back();
    }

    public function edit($id)
    {
        $kriterias = Kriteria::find($id);
        if (!$kriterias) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
        return view('admin.kriteria.edit', compact('kriterias'));
    }

    public function update(Request $request, $id)
    {
        // Temukan data berdasarkan ID
        $kriterias = Kriteria::findOrFail($id);

        // Validasi data yang masuk
        $validatedData = $request->validate([
            'kriteria_code'  => 'required|string|max:255',
            'kriteria_nama'  => 'required|string|max:255',
            'kriteria_jenis' => 'required',
            'kriteria_berat' => 'required',
        ]);

        // Perbarui data di database
        $kriterias->update($validatedData);

        // Redirect kembali dengan pesan sukses
        Alert::success('Success', 'Data berhasil diperbarui');
        return redirect()->route('kriteria.index');
    }

    public function destroy($id)
    {
        $kriteria = Kriteria::with('subkriterias')->findOrFail($id);

        // Hapus semua subkriterias yang terkait
        $kriteria->subkriterias()->delete();

        // Hapus kriteria-nya
        $kriteria->delete();

        Alert::success('Success', 'Kriteria dan semua subkriteria berhasil dihapus');
        return redirect()->route('kriteria.index');
    }
}
