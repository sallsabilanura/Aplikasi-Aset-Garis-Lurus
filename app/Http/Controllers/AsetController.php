<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\KategoriAset;
use App\Models\User;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
<<<<<<< HEAD
use Illuminate\Http\Request;
=======
use Illuminate\Http\Request;     
use Barryvdh\DomPDF\Facade\Pdf;
>>>>>>> eeb912e (Tambah semua file awal project)




class AsetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


<<<<<<< HEAD

    public function index(Request $request)
    {
        $query = Aset::query();

        // Cek apakah pengguna memiliki role 'Instansi'
        if (auth()->user()->role == 'Instansi') {
            // Jika 'Instansi', filter berdasarkan user_id
            $query->where('user_id', auth()->id());
        }

        // Cek apakah ada parameter pencarian
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('NamaAset', 'like', "%{$search}%")
                    ->orWhere('KodeAset', 'like', "%{$search}%")
                    ->orWhereHas('kategori', function ($q) use ($search) {
                        $q->where('NamaKategori', 'like', "%{$search}%");
                    });
            });
        }


        // Urutkan berdasarkan waktu pembuatan data terbaru
        $asets = $query->orderBy('created_at', 'desc')->paginate(30);

        return view('asets.index', compact('asets'));
    }
    public function penghapusan(Request $request)
    {
        $query = Aset::query();
    
        // Cek apakah pengguna ingin mencari berdasarkan NamaAset / KodeAset
        if ($request->filled('search') && $request->input('filter') === 'search') {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('NamaAset', 'like', "%{$search}%")
                  ->orWhere('KodeAset', 'like', "%{$search}%")
                  ->orWhereHas('kategori', function ($q) use ($search) {
                      $q->where('NamaKategori', 'like', "%{$search}%");
                  });
            });
        }
    
        // Cek apakah pengguna ingin mencari berdasarkan Status
        if ($request->filled('status') && $request->input('filter') === 'status') {
            $query->where('Status', $request->status);
        }
    
        // Jika pengguna adalah Instansi, hanya tampilkan aset miliknya
        if (auth()->user()->role == 'Instansi') {
            $query->where('user_id', auth()->id());
        }
    
        // Urutkan berdasarkan waktu pembuatan data terbaru
        $asets = $query->orderBy('created_at', 'desc')->paginate(30);
    
        return view('asets.penghapusan', compact('asets'));
    }
=======
     public function exportPDF(Request $request)
{
    $kategoriId = $request->input('kategori'); // Ambil kategori yang dipilih

    // Mengambil aset berdasarkan kategori yang dipilih, atau semua aset jika tidak ada kategori yang dipilih
    $asets = Aset::query();

    if ($kategoriId) {
        // Filter berdasarkan kategori yang dipilih
        $asets = $asets->where('KategoriID', $kategoriId);
    }

    // Ambil data aset bersama kategori dan user
    $asets = $asets->with(['kategori', 'user'])->get();

    // Load view dan generate PDF
    $pdf = Pdf::loadView('asets.pdf', compact('asets'));

    return $pdf->download('daftar_aset.pdf');
}

     
public function index(Request $request)
{
    $query = Aset::query();

    // Hanya user Instansi yang melihat aset sendiri
    if (auth()->user()->role == 'Instansi') {
        $query->where('user_id', auth()->id());
    }

    // Pencarian
    if ($request->has('search')) {
        $search = $request->input('search');
        $query->where(function ($q) use ($search) {
            $q->where('NamaAset', 'like', "%{$search}%")
              ->orWhere('KodeAset', 'like', "%{$search}%")
              ->orWhereHas('kategori', function ($q) use ($search) {
                  $q->where('NamaKategori', 'like', "%{$search}%");
              });

            // Jika admin, bisa cari berdasarkan nama instansi
            if (auth()->user()->role == 'Admin') {
                $q->orWhereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
            }
        });
    }

    // Filter berdasarkan instansi (khusus admin)
    if (auth()->user()->role == 'Admin' && $request->filled('instansi')) {
        $query->where('user_id', $request->input('instansi'));
    }

    $kategori = KategoriAset::all();

    // Ambil semua user dengan role Instansi
    $instansis = \App\Models\User::where('role', 'Instansi')->get();

    $asets = $query->orderBy('created_at', 'desc')->paginate(30);

    return view('asets.index', compact('asets', 'kategori', 'instansis'));
}
public function penghapusan(Request $request)
{
    $query = Aset::query();

    // Filter berdasarkan search
    if ($request->filled('search') && $request->input('filter') === 'search') {
        $search = $request->input('search');
        $query->where(function ($q) use ($search) {
            $q->where('NamaAset', 'like', "%{$search}%")
              ->orWhere('KodeAset', 'like', "%{$search}%")
              ->orWhereHas('kategori', function ($q) use ($search) {
                  $q->where('NamaKategori', 'like', "%{$search}%");
              });
        });
    }

    // Filter status
    if ($request->filled('status')) {
        $query->where('Status', $request->status);
    }

    // Filter instansi untuk Admin
    if (auth()->user()->role == 'Admin' && $request->filled('instansi')) {
        $query->where('user_id', $request->instansi);
    }

    // Filter hanya aset milik user Instansi
    if (auth()->user()->role == 'Instansi') {
        $query->where('user_id', auth()->id());
    }

    $asets = $query->orderBy('created_at', 'desc')->paginate(30);

    // Kirim daftar instansi hanya jika Admin
    $instansis = auth()->user()->role == 'Admin' ? User::where('role', 'Instansi')->get() : [];

    return view('asets.penghapusan', compact('asets', 'instansis'));
}

>>>>>>> eeb912e (Tambah semua file awal project)
    

    public function updateStatus(Request $request)
    {
        $aset = Aset::findOrFail($request->AsetID);
        $aset->Status = $request->Status;
        $aset->save();

        return response()->json(['message' => 'Status berhasil diperbarui!']);
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Ambil hanya kategori milik user yang sedang login
        $kategoris = KategoriAset::where('user_id', auth()->id())->get();

        return view('asets.create', compact('kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi input dengan memastikan KodeAset unik
        $request->validate([
            'NamaAset' => 'required|string|max:255',
            'KodeAset' => 'required|string|max:255|unique:asets,KodeAset',
            'KategoriID' => 'required|exists:kategori_asets,KategoriID',
            'NilaiPerolehan' => 'required|numeric|min:0|max:999999999999.99', // Nilai masuk akal
            'NilaiResidu' => 'required|numeric|min:0|max:999999999999.99', // Sama seperti di atas
            'MasaManfaat' => 'required|string|max:255',
            'TanggalPerolehan' => 'required|date|before_or_equal:today',
            'LokasiAset' => 'required|string|max:255',
            'Status' => 'required|string|max:255',

        ]);

        // Menyimpan data aset
        Aset::create([
            'NamaAset' => $request->NamaAset,
            'KodeAset' => $request->KodeAset,
            'KategoriID' => $request->KategoriID,
            'NilaiPerolehan' => $request->NilaiPerolehan,
            'NilaiResidu' => $request->NilaiResidu,
            'MasaManfaat' => $request->MasaManfaat,
            'TanggalPerolehan' => $request->TanggalPerolehan,
            'LokasiAset' => $request->LokasiAset,
            'Status' => $request->Status,
            'user_id' => auth()->id(), // Set user_id otomatis

        ]);

        return redirect()->route('asets.index')->with('success', 'Aset berhasil disimpan!');
    }




    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Aset  $aset
     * @return \Illuminate\Http\Response
     */
    public function show($AsetID)
    {
        // Ambil data aset berdasarkan ID
        $aset = Aset::findOrFail($AsetID);

        // Buat data JSON untuk QR code, termasuk Kode Aset
        $data = [
            'Kode Aset' => $aset->KodeAset, // Tambahkan Kode Aset
            'Nama Aset' => $aset->NamaAset,
            'Masa Manfaat' => $aset->MasaManfaat,
            'Tanggal Perolehan' => $aset->TanggalPerolehan,
            'Lokasi Aset' => $aset->LokasiAset,
        ];

        // Generate QR code dari data JSON
        $qrCode = QrCode::size(300)->generate(json_encode($data));

        // Kirim data aset dan QR code ke view
        return view('asets.show', compact('aset', 'qrCode'));
    }





    public function updateLocation(Request $request, $AsetID)
    {
        $request->validate([
            'LokasiAset' => 'required|string|max:255',
        ]);

        $aset = Aset::findOrFail($AsetID);
        $aset->LokasiAset = $request->LokasiAset;
        $aset->save();

        return redirect()->route('asets.index')->with('success', 'Lokasi aset berhasil diperbarui.');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Aset  $aset
     * @return \Illuminate\Http\Response
     */
    public function edit($AsetID)
    {
        // Ambil data aset berdasarkan ID
        $aset = Aset::findOrFail($AsetID);

        // Ambil semua kategori aset untuk dropdown
        $kategoris = KategoriAset::all();

        // Tampilkan view edit dengan data aset dan kategori
        return view('asets.edit', compact('aset', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $AsetID
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $AsetID)
    {
        // Validasi input
        $request->validate([
            'NamaAset' => 'required|string|max:255',
            'KodeAset' => 'required|string|max:255',
            'KategoriID' => 'required|exists:kategori_asets,KategoriID',
            'NilaiPerolehan' => 'required|numeric|min:0|max:999999999999.99',
            'NilaiResidu' => 'required|numeric|min:0|max:999999999999.99',
            'MasaManfaat' => 'required|string|max:255',
            'TanggalPerolehan' => 'required|date|before_or_equal:today',
            'LokasiAset' => 'required|string|max:255',
        ]);

        // Cari data aset berdasarkan ID
        $aset = Aset::findOrFail($AsetID);

        // Update data aset
        $aset->update([
            'NamaAset' => $request->NamaAset,
            'KodeAset' => $request->KodeAset,
            'KategoriID' => $request->KategoriID,
            'NilaiPerolehan' => $request->NilaiPerolehan,
            'NilaiResidu' => $request->NilaiResidu,
            'MasaManfaat' => $request->MasaManfaat,
            'TanggalPerolehan' => $request->TanggalPerolehan,
            'LokasiAset' => $request->LokasiAset,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('asets.index')->with('success', 'Aset berhasil diperbarui');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Aset  $aset
     * @return \Illuminate\Http\Response
     */
    public function destroy($AsetID)
    {
        // Cari kategori berdasarkan KategoriID
        $aset = Aset::findOrFail($AsetID);
        $aset->Status = 'Tidak Aktif';
        $aset->save();

        // Redirect ke daftar kategori aset dengan pesan sukses
        return redirect()->route('asets.index')->with('success', 'Aset berhasil dihapus!');
    }

    public function getAsetStats()
    {
        $userId = auth()->id(); // Ambil user yang sedang login
        $asetStats = Aset::where('user_id', $userId)
            ->selectRaw('MONTH(TanggalPerolehan) as bulan, COUNT(*) as jumlah')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('jumlah', 'bulan');

        return response()->json([
            'labels' => $asetStats->keys(),
            'values' => $asetStats->values()
        ]);
    }
<<<<<<< HEAD
    
=======
 

>>>>>>> eeb912e (Tambah semua file awal project)
}
