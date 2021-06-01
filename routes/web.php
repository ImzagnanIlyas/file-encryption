<?php

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
    return view('welcome');
})->name("welcome");

Route::get('/crypter_fichier/{id}', function ($id) {
    return view('crypter', ['id'=>$id]);
})->name("crypter_fichier");

Route::post('crypted', [App\Http\Controllers\fichierController::class, 'crypter'])->name('crypted');

Route::post('decrypt', [App\Http\Controllers\fichierController::class, 'decrypt'])->name('decrypt');

