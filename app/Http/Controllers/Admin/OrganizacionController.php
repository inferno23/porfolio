<?php

namespace App\Http\Controllers\Admin;

use App\Models\Organizacion;
use App\Models\Pais;
use App\Models\Provincia;
use App\Models\Localidad;



use App\Repository\Interfaces\IInstituteRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
/// excel insert
use DB;
use Excel;
use App\Imports\OrganizacionesImport;
class OrganizacionController extends Controller
{
   
    function import_excel()
    {
     $data = 1;//DB::table('users')->orderBy('id', 'DESC')->get();

     //print_r($data);
     return view('admin.organizacion.import_excel', compact('data'));
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
     $data = Excel::import(new OrganizacionesImport,$path);

    // return back()->with('success', 'Carga de archivo exitosa.');
     return redirect()->route('organizacion.index')->with('success','Carga de archivo exitosa.');
    }


    public function index()
    {

        $organizaciones = organizacion::get();
        $paises = Pais::where('paisnombre','!=',null)->pluck('paisnombre','id')->toArray();

      
     
     return view('admin.organizacion.index', compact('organizaciones','paises'));
    }

    public function create()
    {

        $paises = Pais::get();
      
        return view('admin.organizacion.create', compact('paises'));
       
       
    }

    public function store(Request $request)
    {
        Organizacion::create($request->all());
        return redirect()->route('organizacion.index')->with('success','Organización Partidaria registrada con éxito.');

        
    }

    public function show(Organizacion $organizacion)
    {
        return view('admin.organizacion.show', compact('organizacion'));
    }

    public function edit(Organizacion $organizacion)
    {

        $paises = Pais::get();
        $provincias = Provincia::get();
        $localidades = Localidad::get();
            return view('admin.organizacion.edit', compact('organizacion','paises','provincias','localidades'));
    
       // return view('admin.organizacion.edit', compact('organizacion'));
    }

    public function update(Request $request, Organizacion $organizacion)
    {
        $this->validate($request, [
            'organizacion' => 'required|max:200',
            'description' => 'nullable',
            'address' => 'nullable',
            'city' => 'nullable',
            'state' => 'nullable',
            'country' => 'nullable',
        ]);

        $organizacion->update($request->all());
        return redirect()->route('organizacion.index')->with('success','Registro Actualizado');
    }

    public function destroy(Organizacion $organizacion)
    {
        $organizacion->delete();
        return redirect()->route('organizacion.index')->with('success','Registro Eliminado');
    }
}
