<?php

namespace App\Http\Controllers\Admin;

use App\Models\Institute;
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
use App\Imports\UsersImport;
class InstituteController extends Controller
{


    //ALTER TABLE `institutes` CHANGE `escuela` `escuela` VARCHAR(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;
    //select localidad , count(*) as localidadessss from institutes group by localidad ORDER BY `localidadessss` DESC
   
//UPDATE `institutes` SET `localidad_id` = '2381' WHERE `institutes`.`localidad` = 'MUNIC. DE YERBA BUENA';
//UPDATE `institutes` SET `localidad_id` = '2312' WHERE `institutes`.`localidad` = 'MUNIC. DE FAMAILLA';
//UPDATE `institutes` SET `localidad_id` = '2371' WHERE `institutes`.`localidad` = 'MUNIC. DE TAFI VIEJO';
//UPDATE `institutes` SET `localidad_id` = '2284' WHERE `institutes`.`localidad` = 'MUNIC. BANDA DEL RIO SALI';
//UPDATE `institutes` SET `localidad_id` = '2327' WHERE `institutes`.`localidad` = 'MUNIC. DE LAS TALITAS';
//UPDATE `institutes` SET `localidad_id` = '2276' WHERE `institutes`.`localidad` = 'MUNIC. DE ALDERETES';

//UPDATE `institutes` SET `localidad_id` = '2294' WHERE `institutes`.`localidad` = 'MUNIC. DE CONCEPCION';
//UPDATE `institutes` SET `localidad_id` = '2275' WHERE `institutes`.`localidad` = 'MUNIC. AGUILARES';
//UPDATE `institutes` SET `localidad_id` = '2337' WHERE `institutes`.`localidad` = 'MUNICIPALIDAD DE LULES';
//UPDATE `institutes` SET `localidad_id` = '2290' WHERE `institutes`.`localidad` = 'C. CHOROMORO';

//UPDATE `institutes` SET `localidad_id` = '2318' WHERE `institutes`.`localidad` = 'MUNIC. DE JUAN BAUTISTA ALBERDI';
//UPDATE `institutes` SET `localidad_id` = '2316' WHERE `institutes`.`localidad` = 'MUNIC. DE GRANEROS';
//UPDATE `institutes` SET `localidad_id` = '2374' WHERE `institutes`.`localidad` = 'MUNIC. DE TRANCAS';
//UPDATE `institutes` SET `localidad_id` = '2348' WHERE `institutes`.`localidad` = 'C. RANCHILLOS Y SAN MIGUEL';


    public function getEscuelaxLocalidad($localidad_id)
    {
        $data = Institute::where('localidad_id',$localidad_id)->get();
       // print_r($data);
        return response()->json(['data' => $data]);

       
    }


    function import_excel()
    {
     $data = 1;//DB::table('users')->orderBy('id', 'DESC')->get();
     $paises = Pais::get();
     //print_r($data);
     return view('admin.institutes.import_excel2', compact('paises'));
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
    
     $localidad_id = $request->localidad_id;
     $provincia_id = $request->provincia_id;
     $pais_id = $request->pais_id;
     //debug($localidad_id);
          //$data = Excel::load($path)->get(); //  Excel::import($yourImport)
     $data = Excel::import(new UsersImport($localidad_id, $provincia_id, $pais_id),$path);

    
    // $data = Excel::import(new UsersImport,$path);
   // return view('admin.institutes.import_excel2', compact('paises'));
 
     //return back()->with('success', 'Carga de archivo exitosa.');
     return redirect()->route('institutes.index')->with('success','Carga de archivo exitosa.');
    }


    public function index()
    {

        $institutes = Institute::get();
        $paises = Pais::where('paisnombre','!=',null)->pluck('paisnombre','id')->toArray();

        return view('admin.institutes.index', compact('institutes','paises'));
    }

    public function create()
    {
        $paises = Pais::get();
        return view('admin.institutes.create', compact('paises'));
    }

    public function store(Request $request)
    {

        $request->escuela=$request->name;
      //  debug($request->escuela);
        Institute::create($request->all());
        return redirect()->route('institutes.index')->with('success','Institución registrada con éxito.');

        
    }

    public function show(Institute $institute)
    {
        return view('admin.institutes.show', compact('institute'));
    }

    public function edit(Institute $institute)
    {

        

        $paises = Pais::get();
    $provincias = Provincia::get();
    $localidades = Localidad::get();
        return view('admin.institutes.edit', compact('institute','paises','provincias','localidades'));
    }

    public function update(Request $request, Institute $institute)
    {
        $this->validate($request, [
            'name' => 'required|max:200',
            'description' => 'nullable',
            'address' => 'nullable',
            'city' => 'nullable',
            'state' => 'nullable',
            'country' => 'nullable',
        ]);

        $institute->update($request->all());
        return redirect()->route('institutes.index')->with('success','Registro Actualizado');
 
    }

    public function destroy(Institute $institute)
    {

        $institute->delete();
        return redirect()->route('institutes.index')->with('success','Registro Eliminado');
  


        }
}
