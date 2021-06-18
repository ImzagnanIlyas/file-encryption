<?php

use Illuminate\Support\Facades\Route;
use SoareCostin\FileVault\FileVault;

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
Route::redirect('/', '/fr');

Route::group(['prefix' => '{locale}'], function() {
    Route::get('/', function () {
        return view('welcome');
    })->name("welcome");

    Route::get('/crypter_fichier/{id}', function ($locale, $id) {
        return view('crypter', ['id'=>$id]);
    })->name("crypter_fichier");
});

Route::post('encrypt', [App\Http\Controllers\fichierController::class, 'encrypt'])->name('encrypt');

Route::post('decrypt', [App\Http\Controllers\fichierController::class, 'decrypt'])->name('decrypt');

Route::post('custom_encrypt', [App\Http\Controllers\fichierController::class, 'custom_encrypt'])->name('custom_encrypt');

Route::post('custom_decrypt', [App\Http\Controllers\fichierController::class, 'custom_decrypt'])->name('custom_decrypt');

