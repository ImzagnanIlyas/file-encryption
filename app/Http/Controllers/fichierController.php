<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SoareCostin\FileVault\FileVault;

class fichierController extends Controller
{
    public function encrypt(Request $request){
        $fichier = $request->file('fichier');
        $storedFile = Storage::putFileAS("/", $fichier, $fichier->getClientOriginalName());
        (new FileVault)->encryptCopy($storedFile);
        //return view('crypted');
        return Storage::download($storedFile.".enc");
    }

    public function decrypt(Request $request){
        $fichier = $request->file('fichier');
        $storedFile = Storage::putFileAS("/", $fichier, $fichier->getClientOriginalName());
        (new FileVault)->decryptCopy($storedFile);
        return Storage::download(rtrim($storedFile, '.enc'));
    }

    public function custom_encrypt(Request $request){
        $fichier = $request->file('fichier');
        $key = hex2bin($request->input('key'));
        $storedFile = Storage::putFileAS("/", $fichier, $fichier->getClientOriginalName());
        (new FileVault)->key($key)->encryptCopy($storedFile);
        return Storage::download($storedFile.".enc");
    }
}
