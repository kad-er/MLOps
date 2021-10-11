<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\ImageUploadControllerObjectDetection;
use App\Http\Controllers\ImageUploadControllerFaceAndGenderDetection;
use App\Http\Controllers\MailController;
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
//accueil
Route::get('/', function () {
    return view('accueil');
});
//index
Route::get('/index', function () {
    return view('accueil');
});
//services
Route::get('/services', function () {
    return view('services');
});
//about
Route::get('/about', function () {
    return view('about');
});
//contact page
Route::get('/contact', function () {
    return view('contact');
});
Route::get('contact', [ MailController::class, 'retview' ])->name('contactus');
Route::post('contact',[MailController::class, 'html_email'])->name('send.email');

//yolo
Route::get('traitement-image-detection-objet', [ ImageUploadControllerObjectDetection::class, 'imageUpload' ])->name('traitement.image.detection.objet');
Route::post('traitement-image-detection-objet', [ ImageUploadControllerObjectDetection::class, 'imageUploadPost' ])->name('traitement.image.detection.objet.post');

//skin segmentation
Route::get('traitement-image-medicale', [ ImageUploadController::class, 'imageUpload' ])->name('traitement.image.medicale');
Route::post('traitement-image-medicale', [ ImageUploadController::class, 'imageUploadPost' ])->name('traitement.image.medicale.post');

//cvlib
Route::get('traitement-image-detection-genre-&-visage', [ ImageUploadControllerFaceAndGenderDetection::class, 'imageUpload' ])->name('traitement.image.detection.genre.visage');
Route::post('traitement-image-detection-genre-&-visage', [ ImageUploadControllerFaceAndGenderDetection::class, 'imageUploadPost' ])->name('traitement.image.detection.genre.visage.post');


Route::get('/.well-known/pki-validation/', function()
    {
        include public_path().'EB66CEF2D726F671BF469E4AFEEAF509.txt';
    });

    
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
