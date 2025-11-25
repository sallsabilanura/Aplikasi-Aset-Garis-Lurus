<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\User;
use App\Models\Aset; // ✅ tambahkan ini
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\BarangExport;
use Maatwebsite\Excel\Facades\Excel;


use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


public function exportExcel(Request $request)
{
    $search = $request->input('search');
    return Excel::download(new BarangExport($search), 'daftar_barang.xlsx');
}
     
public function exportPDF(Request $request)
{
    $user = auth()->user();
    $query = Barang::with(['lokasis', 'user']);

    // Kalau role Instansi → filter sesuai user login
    if ($user->role === 'Instansi') {
        $query->where('user_id', $user->id);
    }

    // Filter pencarian (optional)
    if ($request->filled('search')) {
        $query->where('NamaBarang', 'like', '%' . $request->search . '%');
    }

    $barangs = $query->get();

    // Generate PDF (landscape)
    $pdf = Pdf::loadView('barangs.pdf', compact('barangs'))
        ->setPaper('a4', 'landscape');

    return $pdf->download('daftar_barang.pdf');
}

public function index(Request $request)
{
    $user = auth()->user();
    $query = Barang::with('aset'); // relasi aset

    if ($user->role === 'Instansi') {
        $query->where('user_id', $user->id);
    }

    if ($request->has('search')) {
        $search = $request->input('search');
        $query->where('NamaBarang', 'like', "%$search%");
    }

    // --- paginate 30 ---
    $barangs = $query->orderBy('created_at', 'desc')
                     ->paginate(30)
                     ->withQueryString(); // biar search tetap jalan

    $user = User::all();

    return view('barangs.index', compact('barangs', 'user'));
}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function create()
{
    $asets = \App\Models\Aset::all();
        $asets = Aset::whereNotIn('AsetID', Barang::pluck('AsetID'))->get();
    return view('barangs.create', compact('asets'));
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
 public function store(Request $request)
{
    $request->validate([
        'AsetID' => 'required|exists:asets,AsetID',
        'Kuantitas' => 'required|array',
        'LokasiBarang' => 'required|array',
        'LokasiBarang.*' => 'required|string|max:255',
        'Kuantitas.*' => 'required|integer|min:1',
        'Gambar.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'Invoice' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // Ambil aset yang dipilih
    $aset = Aset::findOrFail($request->AsetID);
    $totalInput = array_sum($request->Kuantitas);

    // Cek apakah total kuantitas melebihi aset
    if ($totalInput > $aset->Kuantitas) {
        return back()
            ->withErrors(['Kuantitas' => 'Total kuantitas lokasi melebihi jumlah aset yang tersedia ('.$aset->Kuantitas.').'])
            ->withInput();
    }

    // Simpan data barang utama
    $barang = Barang::create([
        'AsetID' => $request->AsetID,
        'Invoice' => $request->hasFile('Invoice')
            ? $request->file('Invoice')->store('invoice', 'public')
            : null,
        'user_id' => auth()->id(),
    ]);

    // Simpan lokasi dan gambar per lokasi
    foreach ($request->LokasiBarang as $i => $lokasi) {
        $gambarPaths = [];

        // Jika ada file gambar
        if ($request->hasFile('Gambar')) {
            // Karena pakai multiple upload, Gambar[$i] bisa berisi beberapa file
            foreach ($request->file('Gambar') as $fileGroup) {
                if (is_array($fileGroup)) {
                    // kalau input multiple per lokasi
                    foreach ($fileGroup as $img) {
                        $gambarPaths[] = $img->store('lokasi_gambar', 'public');
                    }
                } else {
                    // kalau tidak multiple
                    $gambarPaths[] = $fileGroup->store('lokasi_gambar', 'public');
                }
            }
        }

        $barang->lokasis()->create([
            'LokasiBarang' => $lokasi,
            'Kuantitas' => $request->Kuantitas[$i],
            'Gambar' => !empty($gambarPaths) ? json_encode($gambarPaths) : null, // simpan array jadi JSON
        ]);
    }

    return redirect()->route('barangs.index')->with('success', 'Data barang berhasil ditambahkan!');
}



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
   public function show($id)
{
    $barang = Barang::with(['lokasis', 'gambar'])->findOrFail($id);
    return view('barangs.show', compact('barang'));
}

public function exportPdfShow($id)
{
    $barang = Barang::with(['aset', 'lokasis', 'user'])->findOrFail($id);

    $pdf = Pdf::loadView('barangs.export_pdf_show', compact('barang'))
              ->setPaper('a4', 'portrait');

    return $pdf->stream('Detail_Barang_' . ($barang->aset->NamaAset ?? 'Aset') . '.pdf');
}



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
   public function edit($id)
{
    $barang = Barang::with('lokasis')->findOrFail($id);
    return view('barangs.edit', compact('barang'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'NamaBarang' => 'required|string|max:255',
        'LokasiBarang' => 'required|array',
        'LokasiBarang.*' => 'required|string|max:255',
        'Kuantitas.*' => 'required|integer|min:1',
        'Gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $barang = Barang::findOrFail($id);

    // Update data barang utama
    $barang->update([
        'NamaBarang' => $request->NamaBarang,
        'Gambar' => $request->hasFile('Gambar')
            ? $request->file('Gambar')->store('barangs', 'public')
            : $barang->Gambar,
    ]);

    // Hapus lokasi lama lalu input ulang (biar simpel)
    $barang->lokasis()->delete();

    foreach ($request->LokasiBarang as $i => $lokasi) {
        $barang->lokasis()->create([
            'LokasiBarang' => $lokasi,
            'Kuantitas' => $request->Kuantitas[$i],
        ]);
    }

    return redirect()->route('barangs.index')->with('success', 'Data barang berhasil diperbarui!');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
{
    $barang = Barang::with('lokasis')->findOrFail($id);

    // Hapus gambar dari storage kalau ada
    if ($barang->Gambar && \Storage::disk('public')->exists($barang->Gambar)) {
        \Storage::disk('public')->delete($barang->Gambar);
    }

    // Hapus semua lokasi terkait
    $barang->lokasis()->delete();

    // Hapus barang utama
    $barang->delete();

    return redirect()->route('barangs.index')->with('success', 'Data barang berhasil dihapus!');
}

}
