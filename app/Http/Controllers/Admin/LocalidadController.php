<?php

namespace App\Http\Controllers\Admin;

use App\Models\Localidad;
use App\Repository\Interfaces\IInstituteRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
/// excel insert
use DB;
use Excel;
use App\Imports\PersonasImport;
use App\Models\Provincia;

class LocalidadController extends Controller
{
    public function getLocalidadxprovincia($id_privincia)
    {
        $data = Localidad::where('id_privincia',$id_privincia)->get();
       // print_r($data);
        return response()->json(['data' => $data]);

        //return view('admin.localidad.index', compact('data'));
    }



    public function index()
    {

        $localidads = localidad::get();
      
        return view('admin.localidad.index', compact('localidads'));
    }
   
    function import_excel()
    {
     $data = 1;//DB::table('users')->orderBy('id', 'DESC')->get();

     //print_r($data);
     return view('admin.localidad.import_excel', compact('data'));
    }

    function import(Request $request)
    {
     $this->validate($request, [
      'select_file'  => 'required|mimes:xls,xlsx'
     ]);

     //$path = $request->file('select_file')->getRealPath();
     $path = $request->file('select_file');
    // debug($path);
     //$data = Excel::load($path)->get(); //  Excel::import($yourImport)
     $data = Excel::import(new PersonasImport,$path);

    // return back()->with('success', 'Carga de archivo exitosa.');
     return redirect()->route('localidad.index')->with('success','Carga de archivo exitosa.');
    }


    

    public function create()
    {
        $provincias = Provincia::get();
        return view('admin.localidad.create', compact('provincias'));
    }

    public function store(Request $request)
    {
        return redirect()->route('localidad.index')->with('success','Localidad registrada con éxito.');
        localidad::create($request->all());

        
    }

    public function show(localidad $localidad)
    {
        return view('admin.localidad.show', compact('localidad'));
    }

    public function edit(localidad $localidad)
    {
        $provincias = Provincia::get();
      //  return view('admin.localidad.create', compact('localidades'));

        return view('admin.localidad.edit', compact('localidad','provincias'));
    }

    public function update(Request $request, localidad $localidad)
    {
        $this->validate($request, [
            'localidad' => 'required|max:200',
            'id_privincia' => 'required',
            
        ]);

        $localidad->update($request->all());
        return redirect()->route('localidad.index')->with('success','Registro Actualizado');
    
    }

    public function destroy(localidad $localidad)
    {
        $localidad->delete();
        return redirect()->route('localidad.index')->with('success','Registro Eliminado');
    }
}
