<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pais;
use App\Repository\Interfaces\IInstituteRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
/// excel insert
use DB;
use Excel;
use App\Imports\PersonasImport;
class PaisController extends Controller
{
   
    function import_excel()
    {
     $data = 1;//DB::table('users')->orderBy('id', 'DESC')->get();

     //print_r($data);
     return view('admin.pais.import_excel', compact('data'));
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
     return redirect()->route('pais.index')->with('success','Carga de archivo exitosa.');
    }


    public function index()
    {

        $paises = Pais::get();
      
        return view('admin.pais.index', compact('paises'));
    }

    public function create()
    {
        return view('admin.pais.create');
    }

    public function store(Request $request)
    {
        pais::create($request->all());
        return redirect()->route('pais.index')->with('success','País registrado con éxito.');

        
    }

    public function show(pais $pais)
    {
        return view('admin.pais.show', compact('pais'));
    }

    public function edit( $id)
    {
        $pais = Pais::find($id);
    
        return view('admin.pais.edit', compact('pais'));
    }

    public function update(Request $request, pais $pais)
    {
       

        $pais->update($request->all());
        return redirect()->route('pais.index')->with('success','Registro Actualizado');
    
    }

    public function destroy(pais $pais)
    {
        $pais->delete();
        return redirect()->route('pais.index')->with('success','Registro Eliminado');
    }
}
