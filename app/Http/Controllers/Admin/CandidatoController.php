<?php

namespace App\Http\Controllers\Admin;

use App\Models\Candidato;
use App\Models\Pais;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\candidatoRequest;
use Illuminate\Support\Facades\Auth;
/// excel insert
use DB;
use Excel;
use App\Imports\PersonasImport;


class CandidatoController extends Controller
{
   
    
    public function index()
    {

        $candidatos = candidato::orderBy('lista', 'desc')->get();
        $paises = Pais::where('paisnombre','!=',null)->pluck('paisnombre','id')->toArray();

       
      
        return view('admin.candidato.index', compact('candidatos','paises'));
    }

    public function create( )
    
    {
        $paises = Pais::get();
      
        return view('admin.candidato.create', compact('paises'));
        
    }

    public function store(Request $request)
    {
      
        Candidato::create($request->all());
        return redirect()->route('candidato.index')->with('success','Candidato registrado con éxito');
 
        
    }

    public function show(Candidato $candidato)
    {
        return view('admin.candidato.show', compact('candidato'));
    }

    public function edit(Candidato $candidato)
    {

        
         
        return view('admin.candidato.edit', compact('candidato'));
    }

    public function update(Request $request, Candidato $candidato)
    {
        $this->validate($request, [
            'partido' => 'required|max:100',
            'lista' => 'required',
            
        ]);

        $candidato->update($request->all());
        return redirect()->route('candidato.index')->with('success','Candidato Actualizado');
    
    }

    public function destroy(Candidato $candidato)
    {
        $candidato->delete();
        return redirect()->route('candidato.index')->with('success','Candidato Eliminado');
    }
}
