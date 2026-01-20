<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CursoRequest;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\File;

use App\Models\Curso;
use PhpParser\Node\Stmt\Echo_;

class CursoController extends Controller
{
    public function index()
    {
        $cursos = Curso::get();
        return view('admin.curso.index',['cursos' => $cursos]);
    }

    public function create()
    {
        return view('admin.curso.create');
    }

    public function store(CursoRequest $request)
    {   

       
                $image = UploadController::uploadSingleImage('image/curso');
                if ($image) {
                 $request->request->add(['image' => $image]);
                }
                        
                Curso::create($request->all());
                return redirect()->route('curso.index')->with('success', 'Registro creado correctamente');
    }

    public function edit(Curso $curso)
    {
        return view('admin.curso.edit',['curso' => $curso]);
    }

    public function update(Request $request, Curso $curso)
    {

        
        $image = UploadController::uploadSingleImage('image/curso');
       // dd($image);  
        if ($image) {
                     //   $request->merge(['imagen' => $image]);
                                $request->request->add(['image' => $image]);

                }
        $curso->update($request->all());
        return redirect()->route('curso.index')->with('success','Datos modificados correctamente');
    }

    public function destroy(Curso $curso)
    {
        File::delete(storage_path('app/public/uploads/image/curso/'.$curso->image));
        $curso->delete();
        return redirect()->route('curso.index')->with('success','Datos eliminados correctamente');
    }
}
