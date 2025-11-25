<?php

namespace App\Http\Controllers;

use App\Models\KategoriAset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class KategoriAsetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  public function index(Request $request)
{
    $user = auth()->user();

    // Query awal
    $query = KategoriAset::query();
    
    // Filter berdasarkan role Instansi
    if ($user->role === 'Instansi') {
        $query->where('user_id', $user->id);
    }

    // Filter pencarian
    if ($request->has('search')) {
        $search = $request->input('search');
        $query->where('NamaKategori', 'like', "%$search%");
    }

    // Paginate 30 data per halaman
    $kategori = $query->orderBy('created_at', 'desc')
                      ->paginate(30)
                      ->withQueryString(); // penting agar search tidak hilang saat berpindah halaman

    $user = User::all();

    return view('kategoris.index', compact('kategori', 'user'));
}

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kategoris.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        // Validasi input dengan aturan 'unique' yang mempertimbangkan user_id
        $request->validate([
            'NamaKategori' => [
                'required', 
                'string', 
                'max:255', 
                Rule::unique('kategori_asets')->where(function ($query) {
                    return $query->where('user_id', auth()->id());
                }),
            ],
            'Deskripsi' => 'required|string',
        ]);
    
        // Simpan kategori aset baru
        KategoriAset::create([
            'NamaKategori' => $request->NamaKategori,
            'Deskripsi' => $request->Deskripsi,
            'user_id' => auth()->id(), // Set user_id otomatis
        ]);
    
        // Redirect ke daftar kategori aset dengan pesan sukses
        return redirect()->route('kategoris.index')->with('success', 'Kategori Aset berhasil ditambahkan!');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KategoriAset  $kategoriAset
     * @return \Illuminate\Http\Response
     */
    public function show(KategoriAset $kategoriAset)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KategoriAset  $kategoriAset
     * @return \Illuminate\Http\Response
     */
    public function edit($KategoriID)
    {
        // Ambil data kategori berdasarkan KategoriID
        $kategori = KategoriAset::findOrFail($KategoriID);
        
        // Kirim data kategori ke view edit
        return view('kategoris.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $KategoriID
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $KategoriID)
    {
        // Validasi input
        $request->validate([
            'NamaKategori' => 'required|string|max:255',
            'Deskripsi' => 'required|string',
        ]);

        // Cari kategori berdasarkan KategoriID
        $kategori = KategoriAset::findOrFail($KategoriID);

        // Update data kategori
        $kategori->update([
            'NamaKategori' => $request->NamaKategori,
            'Deskripsi' => $request->Deskripsi,
        ]);

        // Redirect ke daftar kategori aset dengan pesan sukses
        return redirect()->route('kategoris.index')->with('success', 'Kategori Aset berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KategoriAset  $kategoriAset
     * @return \Illuminate\Http\Response
     */
    public function destroy($KategoriID)
    {
        // Cari kategori berdasarkan KategoriID
        $kategori = KategoriAset::findOrFail($KategoriID);

        // Hapus kategori
        $kategori->delete();

        // Redirect ke daftar kategori aset dengan pesan sukses
        return redirect()->route('kategoris.index')->with('success', 'Kategori Aset berhasil dihapus!');
    }
}
