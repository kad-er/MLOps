<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageUploadController;

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
});
Route::get('/driveup', function () {
    return view('imageUpload');
});
Route::get('/index', function () {
    return view('accueil');
});
Route::get('/services', function () {
    return view('services');
});
Route::get('/about', function () {
    return view('about');
});
Route::get('/contact', function () {
    return view('contact');
});
Route::get('traitement-image-medicale', [ ImageUploadController::class, 'imageUpload' ])->name('traitement.image.medicale');
Route::post('traitement-image-medicale', [ ImageUploadController::class, 'imageUploadPost' ])->name('traitement.image.medicale.post');
Route::get('/test', function () {
    return view('test');});

Route::get('/.well-known/pki-validation/', function()
    {
        include public_path().'EB66CEF2D726F671BF469E4AFEEAF509.txt';
    });


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
