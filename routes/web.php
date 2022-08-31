<?php

use App\Http\Controllers\EtudiantController;
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

Route::get('/', function () {
    return view('accueil');
})->name("accueilPage");

Route::get('/Etudiant',[EtudiantController::class,"index"])->name("etudiantsPage");
Route::get('/Etudiant/Create',[EtudiantController::class,"create"])->name("etudiant.create");
Route::post('/Etudiant/Create',[EtudiantController::class,"ajouter"])->name("etudiant.ajouter");
Route::post('/Etudiant/DeleteSelected',[EtudiantController::class,"DeleteSelected"])->name("etudiant.deleteSelected");