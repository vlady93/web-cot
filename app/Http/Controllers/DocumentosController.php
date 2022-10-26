<?php

namespace App\Http\Controllers;

use App\Models\Documentos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentosController extends Controller
{
   
    public function store(Request $request)
    {
        dd($request);
        $id_liquidacion=$request->liquidacion_id;
        $documentos = $request->file('file')->store('public/documentos');
        $nombre = ($request->nombre);
        $url = Storage::url($nombre);
        Documentos::create([
            'url'=> $url,
            'proyecto_id'=>$id_liquidacion,
        ]);
    }

   
}
