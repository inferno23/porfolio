<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NovedadRequest;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\File;

use App\Models\Novedad;
use PhpParser\Node\Stmt\Echo_;

class NovedadController extends Controller
{
    public function index()
    {
        $novedades = Novedad::get();
        return view('admin.novedad.index',['novedades' => $novedades]);
    }

    public function create()
    {
        return view('admin.novedad.create');
    }

    public function store(novedadRequest $request)
    {   

       
                $image = UploadController::uploadSingleImage('image/novedad');
                if ($image) {
                 $request->request->add(['image' => $image]);
                }
                        
                Novedad::create($request->all());
                return redirect()->route('novedad.index')->with('success', 'Registro creado correctamente');
    }

    public function edit(Novedad $novedad)
    {
        return view('admin.novedad.edit',['novedad' => $novedad]);
    }

    public function update(Request $request, Novedad $novedad)
    {

        
        $image = UploadController::uploadSingleImage('image/novedad');
       // dd($image);  
        if ($image) {
                     //   $request->merge(['imagen' => $image]);
                                $request->request->add(['image' => $image]);

                }
        $novedad->update($request->all());
        return redirect()->route('novedad.index')->with('success','Datos modificados correctamente');
    }

    public function destroy(Novedad $novedad)
    {
        File::delete(storage_path('app/public/uploads/image/novedad/'.$novedad->image));
        $novedad->delete();
        return redirect()->route('novedad.index')->with('success','Datos eliminados correctamente');
    }
}
