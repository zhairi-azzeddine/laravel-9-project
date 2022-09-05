<?php

use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/accueil', function () {
    return view('accueil');
})->name("accueilPage");

Route::get('/', [HomeController::class, 'checkUserType']);

Route::get('/admin/dashboard',function(){
    return view('accueil');
})->name('admin.dashboard');

Route::get('/user/dashboard',function(){
    return view('accueil');
})->name('user.dashboard');


Route::get('/Etudiant',[EtudiantController::class,"index"])->name("etudiantsPage");

Route::get('/Etudiant/Create',[EtudiantController::class,"create"])->name("etudiant.create");
Route::post('/Etudiant/Create',[EtudiantController::class,"ajouter"])->name("etudiant.ajouter");

Route::post('/Etudiant/DeleteSelected',[EtudiantController::class,"DeleteSelected"])->name("etudiant.deleteSelected");

Route::put('/Etudiant/{etudiant}',[EtudiantController::class,"update"])->name("etudiant.update");
Route::get('/Etudiant/{etudiant}',[EtudiantController::class,"edit"])->name("etudiant.edit");

Route::get('/Etudiant/print/{etudiantPrint}',[EtudiantController::class,"downloadPDF"])->name("etudiant.downloadPDF");

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
