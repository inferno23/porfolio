<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ObraRequest;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\File;

use App\Models\Obra;
use PhpParser\Node\Stmt\Echo_;

class ObraController extends Controller
{

    public function ver(Obra $obra)
    {
        return view('home.obra',['obra' => $obra]);
    }


    public function index()
    {
        $obras = Obra::get();
        return view('admin.obra.index',['obras' => $obras]);
    }

    public function create()
    {
        return view('admin.obra.create');
    }

    public function store(ObraRequest $request)
    {   

       
                $image = UploadController::uploadSingleImage('image/obra');
                if ($image) {
                 $request->request->add(['image' => $image]);
                }
                        
                Obra::create($request->all());
                return redirect()->route('obra.index')->with('success', 'Registro creado correctamente');
    }

    public function edit(Obra $obra)
    {
        return view('admin.obra.edit',['obra' => $obra]);
    }

    public function update(Request $request, Obra $obra)
    {

        
        $image = UploadController::uploadSingleImage('image/obra');
       // dd($image);  
        if ($image) {
                     //   $request->merge(['imagen' => $image]);
                                $request->request->add(['image' => $image]);

                }
        $obra->update($request->all());
        return redirect()->route('obra.index')->with('success','Datos modificados correctamente');
    }

    public function destroy(Obra $obra)
    {
        File::delete(storage_path('app/public/uploads/image/obra/'.$obra->image));
        $obra->delete();
        return redirect()->route('obra.index')->with('success','Datos eliminados correctamente');
    }
}
