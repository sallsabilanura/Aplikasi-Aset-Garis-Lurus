<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\KategoriAset;
use App\Models\PenghapusanAset;
use App\Models\Penyusutan;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('welcome');
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $latestAsets = Aset::where('user_id', auth()->id())
        ->latest()
        ->take(5)
        ->get();
        $asetStats = Aset::selectRaw('Status, COUNT(*) as count')
        ->where('user_id', auth()->id()) // Filter berdasarkan UserID yang sedang login
        ->groupBy('Status')
        ->pluck('count', 'Status');
    
        $user = Auth::user(); // Ambil user yang sedang login
    
        if ($user->role == 'Instansi') {
            // Hanya data milik user yang login
            $asetCount = Aset::where('user_id', $user->id)->count();
            $kategoriCount = KategoriAset::whereHas('asets', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->count();
            $penyusutanCount = Penyusutan::whereHas('aset', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->count();
            $penghapusanCount = PenghapusanAset::whereHas('aset', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->count();
    
            // Tambahkan testimonialCount agar tidak error
            $testimonialCount = 0;
    
        } else {
            // Jika Admin, tampilkan semua data
            $asetCount = Aset::count();
            $kategoriCount = KategoriAset::count();
            $penyusutanCount = Penyusutan::count();
            $testimonialCount = Testimonial::count();
        }
    
        return view('dashboard', compact('asetCount', 'kategoriCount', 'penyusutanCount', 'latestAsets', 'asetStats', 'testimonialCount'));
    }
    
    public function welcome()
    {
        $testimonials = Testimonial::with('user')->latest()->get();
        $averageRating = Testimonial::average('Rating');
    
        return view('welcome', compact('testimonials', 'averageRating'));
    }
    
    
}    