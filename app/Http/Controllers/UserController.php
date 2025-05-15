<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Carbon\Carbon;



class UserController extends Controller
{
    public function index()
    {
        $users = User::all();  // Mengambil semua data pengguna dari database
        return view('user.index', compact('users'));
    }

    public function destroy($id)
{
    $user = User::findOrFail($id);

   

    // Setelah semua relasi dihapus, hapus user
    $user->delete();

    return redirect()->back()->with('success', 'Pengguna dan seluruh data terkait berhasil dihapus.');
}

public function showUserChart()
{
    // Mendapatkan jumlah pengguna yang mendaftar per hari dalam 30 hari terakhir
    $userCounts = User::selectRaw('count(*) as count, DATE(created_at) as date')
                      ->groupBy('date')
                      ->where('created_at', '>=', Carbon::now()->subDays(30)) // 30 hari terakhir
                      ->orderBy('date', 'asc')
                      ->get();

    // Mengirim data ke view
    return view('user.chart', compact('userCounts'));
}

public function showProfile()
    {
        $user = auth()->user(); // Mengambil data user yang sedang login
        return view('user.profile', compact('user')); // Mengirim data user ke view profile
    }

    public function update(Request $request)
{
    // Validasi input
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'Alamat' => 'nullable|string|max:255',
        'NoTelp' => 'nullable|string|max:15',
        'NamaPetugas' => 'nullable|string|max:255',
        'Gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $user = auth()->user(); // Ambil data user yang sedang login

    // Jika ada file gambar baru yang di-upload
    if ($request->hasFile('Gambar')) {
        // Hapus gambar lama jika ada
        if ($user->Gambar && Storage::exists('public/' . $user->Gambar)) {
            Storage::delete('public/' . $user->Gambar);
        }

        // Simpan gambar baru dan update path-nya di database
        $path = $request->file('Gambar')->store('profile_pictures', 'public');
        $validated['Gambar'] = $path;
    }

    // Perbarui data user di database
    $user->update($validated);

    return back()->with('success', 'Profil berhasil diperbarui!');
}

public function updateStatus(Request $request, $id)
{
    $user = User::findOrFail($id); // Mencari pengguna berdasarkan ID
    $user->Status = $request->input('Status'); // Mengubah status
    $user->save(); // Menyimpan perubahan

    return redirect()->back()->with('success', 'Status akun berhasil diupdate');
}


}
