<?php

namespace App\Providers;
use App\Models\Profile;
use App\Models\Aset;
use App\Models\KategoriAset;
use App\Models\PenghapusanAset;
use App\Models\Penyusutan;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Support\Facades\View;



use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $asetCount = Aset::count();
            $view->with('asetCount', $asetCount);
        });
        View::composer('*', function ($view) {
            $penyusutanCount = Penyusutan::count();
            $view->with('penyusutanCount', $penyusutanCount);
        });
        View::composer('*', function ($view) {
            $userCount = User::count();
            $view->with('userCount', $userCount);
        });
        View::composer('*', function ($view) {
            $penghapusanCount = PenghapusanAset::count();
            $view->with('penghapusanCount', $penghapusanCount);
        });
        View::composer('*', function ($view) {
            $kategoriCount = KategoriAset::count();
            $view->with('kategoriCount', $kategoriCount);
        });
        View::composer('*', function ($view) {
            $testimonialCount = Testimonial::count();
            $view->with('testimonialCount', $testimonialCount);
        });
    }
}
