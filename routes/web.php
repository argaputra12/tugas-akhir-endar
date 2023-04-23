<?php

use App\Http\Controllers\PasienController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

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

Route::get('/', function () {
    return view('welcome');
})
->middleware(['dokter'])
->name('welcome');

Route::middleware(['admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/pasien', [PasienController::class, 'index'])->name('pasien.index');
    Route::post('/pasien', [PasienController::class, 'store'])->name('pasien.store');
    Route::put('/pasien/{id}', [PasienController::class, 'update'])->name('pasien.update');
    Route::get('/pasien/{id}', [PasienController::class, 'update'])->name('pasien.update');
    Route::delete('/pasien/{id}', [PasienController::class, 'destroy'])->name('pasien.destroy');

});

Route::get('/dashboard', function () {
    return view('dashboard');
})
->middleware(['admin'])
->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// useless routes
// Just to demo sidebar dropdown links active states.
Route::get('/buttons/text', function () {
    return view('buttons-showcase.text');
})->middleware(['auth'])->name('buttons.text');

Route::get('/buttons/icon', function () {
    return view('buttons-showcase.icon');
})->middleware(['auth'])->name('buttons.icon');

Route::get('/buttons/text-icon', function () {
    return view('buttons-showcase.text-icon');
})->middleware(['auth'])->name('buttons.text-icon');

require __DIR__ . '/auth.php';