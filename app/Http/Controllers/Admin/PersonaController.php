<?php

namespace App\Http\Controllers\Admin;

use App\Models\Persona;
use App\Models\Institute;
use App\Models\Registro;
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
use App\Imports\PersonasImport;
class PersonaController extends Controller
{
//ALTER TABLE `personas` ADD `pais_id` INT(8) NULL AFTER `dni`;

//ALTER TABLE `personas` CHANGE `pais_id` `pais_id` INT(8) NULL DEFAULT '5';
    //ALTER TABLE `personas` ADD `localidad_id` INT(8) NULL AFTER `dni`;
    //ALTER TABLE `personas` CHANGE `provincia_id` `provincia_id` INT(8) NULL DEFAULT '25';
//ALTER TABLE `personas` ADD `provincia_id` INT(8) NULL AFTER `dni`;

    public function buscar (Request $request)
    {
       
        $personas = array();
        $pais=   \Auth::user()->pais_id;
        //debug($pais);
        if(!empty($pais)){
             $pais=5;
        }

      //  debug($request);    
     if(!empty($request) && !empty($request->dni) ){
        $personas = Persona::query()
        ->where('dni', '=',$request->dni)
        ->where('pais_id', '=',$pais)
        ->get();
       }
        return view('admin.persona.buscar', compact('personas'));
    }


    public function buscar2 (Request $request)
    {
       
        $personas = array();
        $pais=   \Auth::user()->pais_id;
        //debug($pais);
        if(!empty($pais)){
             $pais=5;
        }

      //  debug($request);    
     if(!empty($request) && !empty($request->dni) ){
        $personas = Persona::query()
        ->where('dni', '=',$request->dni)
        ->where('pais_id', '=',$pais)
        ->get();
       }
        return view('admin.persona.buscar2', compact('personas'));
    }



   
    function import_excel()
    {
     $data = 1;
     $paises = Pais::get();
     
    
     return view('admin.persona.import_excel2', compact('paises'));
    }



    function import(Request $request)
    {
     $this->validate($request, [
      'select_file'  => 'required|mimes:xls,xlsx'
     ]);

     //$path = $request->file('select_file')->getRealPath();
     $path = $request->file('select_file');


    // debug($path);

    $localidad_id = $request->localidad_id;
     $provincia_id = $request->provincia_id;
     $pais_id = $request->pais_id;
     //debug($localidad_id);
     
     $data = Excel::import(new PersonasImport($localidad_id, $provincia_id, $pais_id),$path);

    
     
    // $data = Excel::import(new PersonasImport,$path);

    // return back()->with('success', 'Carga de archivo exitosa.');
     return redirect()->route('persona.index')->with('success','Carga de archivo exitosa.');
    }


    public function index()
    {

        $personas = Persona::get();
        $paises = Pais::where('paisnombre','!=',null)->pluck('paisnombre','id')->toArray();

      
        return view('admin.persona.index', compact('personas','paises'));
    }

    public function create()
    {

        $paises = Pais::get();
        return view('admin.persona.create', compact('paises'));
    }

    public function store(Request $request)
    {
        Persona::create($request->all());
        return redirect()->route('persona.index')->with('success','Elector registrado con  éxito.');

        
    }

    public function show(Persona $persona)
    {
        $mesa = $persona->mesa;
     //   debug($persona->mesa);
      //  $persona->mesa >= $model->mdesde  && $persona->mesa <= $model->mhasta
       if(!empty($mesa)){
        $institucion = Institute::query()
        ->where('mdesde', '<=',$mesa)
        ->where('mhasta', '>=',$mesa)
        ->first();
        //debug($institucion);

        $fiscales = array();
        if(!empty($institucion)){

            $fiscales = Registro::query()
            ->where('institucion_id', $institucion->id)
            ->get();
        }
         //debug($fiscales);
         return view('admin.persona.fiscal', compact('fiscales','institucion','persona'));
 
       }

        return view('admin.persona.show', compact('persona'));
    }

    public function edit(Persona $persona)
    {

        $paises = Pais::get();
        $provincias = Provincia::get();
        $localidades = Localidad::get();
            return view('admin.persona.edit', compact('persona','paises','provincias','localidades'));
    
      //  return view('admin.persona.edit', compact('persona'));
    }

    public function update(Request $request, Persona $persona)
    {
        $this->validate($request, [
            'nombre' => 'required|max:200',
            'description' => 'nullable',
            'address' => 'nullable',
            'city' => 'nullable',
            'state' => 'nullable',
            'country' => 'nullable',
        ]);

        $persona->update($request->all());
        return redirect()->route('persona.index')->with('success','Registro Actualizado');
    
    }

    public function destroy(Persona $persona)
    {
        $persona->delete();
        return redirect()->route('persona.index')->with('success','Registro Eliminado');
    }
}
