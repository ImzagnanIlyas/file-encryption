<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SoareCostin\FileVault\FileVault;
use Throwable;

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
        $keyhex= $request->input('key');
        if(ctype_xdigit($keyhex) && strlen($keyhex)==64){
            $keybin = hex2bin($keyhex);
            $storedFile = Storage::putFileAS("/", $fichier, $fichier->getClientOriginalName());
            (new FileVault)->key($keybin)->encryptCopy($storedFile);
            return Storage::download($storedFile.".enc");
        }else dd("no");
    }

    public function custom_decrypt(Request $request){
        $fichier = $request->file('fichier');
        $keyhex= $request->input('key');
        if(ctype_xdigit($keyhex) && strlen($keyhex)==64){
            $keybin = hex2bin($keyhex);
            $storedFile = Storage::putFileAS("/", $fichier, $fichier->getClientOriginalName());
            try {
                (new FileVault)->key($keybin)->decryptCopy($storedFile);

            } catch (Throwable $t) {
                dd("Can't be");
            }

            return Storage::download(rtrim($storedFile, '.enc'));
        }else dd("no");
    }
}
