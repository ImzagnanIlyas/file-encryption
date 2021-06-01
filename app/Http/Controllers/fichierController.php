<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SoareCostin\FileVault\FileVault;

class fichierController extends Controller
{
    public function crypter(Request $request){
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
        //return view('crypted');
        return Storage::download(rtrim($storedFile, '.enc'));
    }
}
