<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SoareCostin\FileVault\FileVault;

class fichierController extends Controller
{
    public function crypter(Request $request){
        $fichier = $request->input('fichier');
        (new FileVault)->
        encryptCopy($fichier);
        return view('crypted');
    }
}
