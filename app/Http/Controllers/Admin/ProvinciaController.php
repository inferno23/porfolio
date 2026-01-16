<?php

namespace App\Http\Controllers\Admin;

use App\Models\Provincia;
use App\Models\Pais;
use App\Repository\Interfaces\IInstituteRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
/// excel insert
use DB;
use Excel;
use App\Imports\PersonasImport;


class ProvinciaController extends Controller
{
   


    public function getProvinciaxpais($pais_id)
    {
        $data = Provincia::where('pais_id',$pais_id)->get();
       // print_r($data);
        return response()->json(['data' => $data]);

        //return view('admin.localidad.index', compact('data'));
    }


    function import_excel()
    {
     $data = 1;//DB::table('users')->orderBy('id', 'DESC')->get();

     //print_r($data);
     return view('admin.provincia.import_excel', compact('data'));
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
     return redirect()->route('provincia.index')->with('success','Carga de archivo exitosa.');
    }


    public function index()
    {

        $provincias = provincia::get();
       // return view('admin.user.index',['users' => $users]);
       // $institutes = $this->instituteRepository->allByUser(Auth::id());
       //print($institutes);
        return view('admin.provincia.index', compact('provincias'));
    }

    public function create()
    {
        $paises = Pais::get();
        return view('admin.provincia.create', compact('paises'));
    }

    public function store(Request $request)
    {
        provincia::create($request->all());
        return redirect()->route('provincia.index')->with('success','Provincia registrada con éxito.');

        
    }

    public function show(provincia $provincia)
    {
        return view('admin.provincia.show', compact('provincia'));
    }

    public function edit($id)
    {
            
            $provincia = Provincia::find($id);
    

        $paises = Pais::get();
        return view('admin.provincia.edit', compact('provincia','paises'));
    }

    public function update(Request $request, provincia $provincia)
    {
        $this->validate($request, [
            'provincia' => 'required|max:200',
           
        ]);

        $provincia->update($request->all());
        return redirect()->route('provincia.index')->with('success','Registro Actualizado');
    
    }

    public function destroy(provincia $provincia)
    {
        $provincia->delete();
        return redirect()->route('provincia.index')->with('success','Registro Eliminado');
    }
}
