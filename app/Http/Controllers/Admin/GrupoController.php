<?php

namespace App\Http\Controllers\Admin;

use App\Models\Grupo;
use App\Models\Institute;
use App\Models\User;
use App\Models\Pais;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\grupoRequest;
use Illuminate\Support\Facades\Auth;
/// excel insert
use DB;
use Excel;
use App\Imports\PersonasImport;


class GrupoController extends Controller
{
   


   
    
    public function index()
    {

        $grupos = Grupo::get();

        $paises = Pais::where('paisnombre','!=',null)->pluck('paisnombre','id')->toArray();

       
        return view('admin.grupo.index', compact('grupos','paises'));
    }

    public function create( )
    {

       // usuarios con grupo
       $usuariosgrupo=Grupo::select(['user_id'])->get();
       foreach($usuariosgrupo as $model){
        // debug($model['user_id']);
         $ocupados[]=$model['user_id'];

       }
        $users  = User::whereNotIn("id",$ocupados)->get();

        $administadores  = User::where("role", "=",2)->whereNotIn("id",$ocupados)->get();
       // print_r($users);
       
      
      
        return view('admin.grupo.create', compact('users','administadores'));
    }

    public function store(Request $request)
    {
      
         $descripcion = $request->descripcion;
         $admin_id = $request->admin_id;
        
         /// hay un fiscal general en esa escuela
    
         $usuarios = $request->usuarios;

        // print(count($usuarios)); 1  Array ( [0] => 2 )   2

       //  print_r($usuarios);
       $date = date('Y-m-d H:i:s');
         foreach($usuarios as $key => $user){
          //  print_r($user);
            if(!empty($user) && $user <>''  ){
              DB::table('grupo')->insert([
                'descripcion' => $descripcion,
                'admin_id' => $admin_id,
                'user_id' => $user,
                'created_at' => $date,
              ]);
            }
         }
    

        
        return redirect()->route('grupo.index')->with('success','Grupo de Trabajo creado con éxito.');

        
    }

    public function show(grupo $grupo)
    {
        return view('admin.grupo.show', compact('grupo'));
    }

    public function edit(grupo $grupo)
    {

         $instituciones = Institute::get();
         
        return view('admin.grupo.edit', compact('instituciones','grupo'));
    }

    public function update(Request $request, grupo $grupo)
    {
        $this->validate($request, [
            'persona_id' => 'required|max:20',
            'institucion_id' => 'required',
            
        ]);

        $grupo->update($request->all());
        return redirect()->route('grupo.index')->with('success','Grupo de Trabajo Actualizado.');
    
    }

    public function destroy(grupo $grupo)
    {
        $grupo->delete();
        return redirect()->route('grupo.index')->with('success','Usuario Eliminado del Grupo.');
    }
}
