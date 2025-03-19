<?php

use App\Http\Controllers\AsetController;
use App\Http\Controllers\KategoriAsetController;
use App\Http\Controllers\PenghapusanAsetController;
use App\Http\Controllers\PenyusutanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\Profile;
use App\Notifications\MasaManfaatAsetHampirHabis;
use App\Models\User;
use App\Models\Aset;

use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'welcome']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

route::resource('asets', AsetController::class);
route::resource('users', UserController::class);
route::resource('kategoris', KategoriAsetController::class);
route::resource('penyusutans', PenyusutanController::class);
route::resource('testimonials', TestimonialController::class);
Route::post('/asets/update-status', [AsetController::class, 'updateStatus'])->name('asets.updateStatus');
Route::PUT('/asets/{AsetID}/update-location', [AsetController::class, 'updateLocation'])->name('asets.updateLocation');
Route::get('/penghapusan', [AsetController::class, 'penghapusan'])->name('asets.penghapusan');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes(['reset' => true]);
Route::get('/user-chart', [UserController::class, 'showUserChart'])->name('user.chart');
Route::get('/profile', [UserController::class, 'showProfile'])->name('user.profile');
Route::put('/profile', [UserController::class, 'update'])->name('profile.update');



Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');


Route::get('/aset/stats', [AsetController::class, 'getAsetStats'])->name('api.aset.stats');
// routes/web.php

Route::get('/kontak', function () {
    return view('contact');
});

