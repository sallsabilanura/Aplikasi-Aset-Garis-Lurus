<?php

namespace App\Http\Controllers;

use App\Models\Penyusutan;
use App\Models\Aset;
use Illuminate\Http\Request;
<<<<<<< HEAD
=======
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Instansi; // Pastikan sudah import model Instansi

>>>>>>> eeb912e (Tambah semua file awal project)

class PenyusutanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
<<<<<<< HEAD
    public function index(Request $request)
    {
        // Mulai dengan query untuk Penyusutan
        $query = Penyusutan::query();
    
        // Cek jika user adalah 'Instansi' dan tambahkan filter berdasarkan 'user_id'
=======
    public function cetak(Request $request)
    {
        $tahun = $request->input('TahunPenyusutan');
    
        $penyusutan = Penyusutan::with(['aset', 'user'])
            ->when($tahun, function ($query, $tahun) {
                return $query->where('TahunPenyusutan', $tahun);
            })
            ->get();
    
        $pdf = Pdf::loadView('penyusutans.cetak', compact('penyusutan', 'tahun'));
    
        return $pdf->stream('laporan_penyusutan_' . $tahun . '.pdf');
    }


    public function index(Request $request)
    {
        $query = Penyusutan::query();
    
>>>>>>> eeb912e (Tambah semua file awal project)
        if (auth()->user()->role == 'Instansi') {
            $query->where('user_id', auth()->id());
        }
    
<<<<<<< HEAD
        // Ambil nilai pencarian
        $search = $request->input('search');
        
        // Menambahkan filter pencarian jika ada input 'search'
        $penyusutan = $query->when($search, function ($query, $search) {
            return $query->whereHas('aset', function ($query) use ($search) {
                $query->where('NamaAset', 'like', "%$search%")
                      ->orWhere('KodeAset', 'like', "%$search%");
            });
        })
        ->orderBy('created_at', 'desc') // Urutkan berdasarkan data terbaru
        ->paginate(30); // Gunakan pagination agar sesuai dengan query sebelumnya
    
        // Kembalikan ke view dengan data penyusutan
        return view('penyusutans.index', compact('penyusutan'));
=======
        $search = $request->input('search');
        $tahun = $request->input('TahunPenyusutan');
        $instansiId = $request->input('instansi');
    
        // Filter instansi (khusus untuk Admin)
        if (auth()->user()->role == 'Admin' && $instansiId) {
            $query->where('user_id', $instansiId);
        }
    
        $penyusutan = $query
            ->when($search, function ($query, $search) {
                return $query->whereHas('aset', function ($query) use ($search) {
                    $query->where('NamaAset', 'like', "%$search%")
                          ->orWhere('KodeAset', 'like', "%$search%");
                });
            })
            ->when($tahun, function ($query, $tahun) {
                return $query->where('TahunPenyusutan', $tahun);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(30);
    
        $daftar_tahun = Penyusutan::select('TahunPenyusutan')->distinct()->pluck('TahunPenyusutan');
    
        $instansis = []; // default
        if (auth()->user()->role == 'Admin') {
            $instansis = \App\Models\User::where('role', 'Instansi')->get(); // atau model Instansi kalau kamu pakai relasi khusus
        }
    
        return view('penyusutans.index', compact('penyusutan', 'daftar_tahun', 'instansis'));
>>>>>>> eeb912e (Tambah semua file awal project)
    }
    
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
{
    // Ambil aset yang dimiliki user dan belum ada di penyusutan
    $asets = Aset::where('user_id', auth()->id())
                 ->whereNotIn('AsetID', function ($query) {
                     $query->select('AsetID')->from('penyusutans');
                 })->get();

    return view('penyusutans.create', compact('asets'));
}

    
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'AsetID' => 'required|exists:asets,AsetID',
        'TahunPenyusutan' => 'required|string|max:4',
        'NilaiAwal' => 'required|numeric|min:0',
        'PenyusutanTahunan' => 'required|numeric|min:0',
        'NilaiAkhir' => 'required|numeric|min:0',
    ]);

    // Menyimpan data penyusutan
    Penyusutan::create([
        'AsetID' => $request->AsetID,
        'TahunPenyusutan' => $request->TahunPenyusutan,
        'NilaiAwal' => $request->NilaiAwal,
        'PenyusutanTahunan' => $request->PenyusutanTahunan,
        'NilaiAkhir' => $request->NilaiAkhir,
        'user_id' => auth()->id(), // Set user_id otomatis
    ]);

    return redirect()->route('penyusutans.index')->with('success', 'Data penyusutan berhasil ditambahkan!');
}

    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penyusutan  $penyusutan
     * @return \Illuminate\Http\Response
     */
  

    
     public function show($PenyusutanID)
{
    $penyusutan = Penyusutan::with('aset')->findOrFail($PenyusutanID);
    
    // Menghitung rincian penyusutan per tahun
    $rincian = [];
    $nilaiAwal = $penyusutan->NilaiAwal;
    $nilaiResidu = $penyusutan->aset->NilaiResidu; // Ambil nilai residu dari aset
    $penyusutanTahunan = $penyusutan->PenyusutanTahunan;
    $masaManfaat = $penyusutan->aset->MasaManfaat; // Ambil masa manfaat dari aset
    
    for ($tahun = $penyusutan->TahunPenyusutan; $tahun < ($penyusutan->TahunPenyusutan + $masaManfaat); $tahun++) {
        // Menghitung nilai akhir tahun setelah penyusutan
        $nilaiAkhirTahun = $nilaiAwal - $penyusutanTahunan;

        // Pastikan nilai akhir tidak kurang dari nilai residu
        if ($nilaiAkhirTahun < $nilaiResidu) {
            $nilaiAkhirTahun = $nilaiResidu;
        }

        // Menambahkan rincian penyusutan ke dalam array
        $rincian[] = [
            'tahun' => $tahun,
            'nilai_awal' => $nilaiAwal,
            'penyusutan' => $nilaiAwal > $nilaiResidu ? $penyusutanTahunan : 0,
            'nilai_akhir' => $nilaiAkhirTahun
        ];

        // Jika nilai akhir sudah mencapai nilai residu, hentikan perhitungan
        if ($nilaiAkhirTahun <= $nilaiResidu) {
            break;
        }

        // Update nilai awal untuk iterasi berikutnya
        $nilaiAwal = $nilaiAkhirTahun;
    }

    // Mengirim data ke view
    return view('penyusutans.show', compact('penyusutan', 'rincian'));
}


     
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penyusutan  $penyusutan
     * @return \Illuminate\Http\Response
     */
    public function edit($PenyusutanID)
    {
        // Find the depreciation data based on ID
        $penyusutan = Penyusutan::findOrFail($PenyusutanID);
        // Get all assets for the dropdown
        $asets = Aset::all();
        // Return the edit view with the retrieved data
        return view('penyusutans.edit', compact('penyusutan', 'asets'));
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $PenyusutanID
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $PenyusutanID)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'AsetID' => 'required|exists:asets,AsetID',
            'TahunPenyusutan' => 'required|string|max:4',
            'NilaiAwal' => 'required|numeric|min:0',
            'PenyusutanTahunan' => 'required|numeric|min:0',
            'NilaiAkhir' => 'required|numeric|min:0',
        ]);

        // Temukan data penyusutan berdasarkan ID
        $penyusutan = Penyusutan::findOrFail($PenyusutanID);

        // Update data penyusutan dengan data yang baru
        $penyusutan->update([
            'AsetID' => $request->AsetID,
            'TahunPenyusutan' => $request->TahunPenyusutan,
            'NilaiAwal' => $request->NilaiAwal,
            'PenyusutanTahunan' => $request->PenyusutanTahunan,
            'NilaiAkhir' => $request->NilaiAkhir,
        ]);

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('penyusutans.index')->with('success', 'Data penyusutan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penyusutan  $penyusutan
     * @return \Illuminate\Http\Response
     */
    public function destroy($PenyusutanID)
    {
        // Temukan data penyusutan berdasarkan ID
        $penyusutan = Penyusutan::findOrFail($PenyusutanID);
    
        // Hapus data penyusutan
        $penyusutan->delete();
    
        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('penyusutans.index')->with('success', 'Data penyusutan berhasil dihapus!');
    }
    
}
