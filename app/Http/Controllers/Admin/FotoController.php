<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FotoRequest;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\File;

use App\Models\Foto;
use PhpParser\Node\Stmt\Echo_;

class FotoController extends Controller
{
    public function index()
    {
        $fotos = Foto::get();
        return view('admin.foto.index',['fotos' => $fotos]);
    }

    public function create()
    {
        return view('admin.foto.create');
    }

    public function store(FotoRequest $request)
    {   

       
                $image = UploadController::uploadSingleImage('image/foto');
                if ($image) {
                 $request->request->add(['image' => $image]);
                }
                        
                Foto::create($request->all());
                return redirect()->route('foto.index')->with('success', 'Registro creado correctamente');
    }

    public function edit(Foto $foto)
    {
        return view('admin.foto.edit',['foto' => $foto]);
    }

    public function update(Request $request, Foto $foto)
    {

        
        $image = UploadController::uploadSingleImage('image/foto');
       // dd($image);  
        if ($image) {
                     //   $request->merge(['imagen' => $image]);
                                $request->request->add(['image' => $image]);

                }
        $foto->update($request->all());
        return redirect()->route('Foto.index')->with('success','Datos modificados correctamente');
    }

    public function destroy(Foto $foto)
    {
        File::delete(storage_path('app/public/uploads/image/foto/'.$foto->image));
        $foto->delete();
        return redirect()->route('foto.index')->with('success','Datos eliminados correctamente');
    }
}
