<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest as Request;

use App\Models\User;
use App\Models\Organizacion;
use App\Exports\UsersExport;
use Excel;

use Hash;

class UserController extends Controller
{


    public function export() 
    {
        $date=date("d-m-Y");
        $nombre='usuarios_'.$date.'.xlsx';
        return Excel::download(new UsersExport, $nombre);
    }
   


    public function index()
    {
        $users = User::get();
       // $organizaciones = Organizacion::get();

        $organizaciones = Organizacion::where('organizacion','!=',null)->pluck('organizacion','id')->toArray();
    //debug($organizaciones);
        return view('admin.user.index', compact('users','organizaciones'));
    }

    public function create()
    {
        $organizaciones = Organizacion::get();
        
        return view('admin.user.create', compact('organizaciones'));
    }

    public function store(Request $request)
    {   
       /// agregar el modelo user el pais_id
        $organizacion_id = $request->organizacion_id;
       
         $organizacion  = Organizacion::find($organizacion_id);
         $request->request->add(['pais_id' => $organizacion->pais_id  ]);
         $request->request->add(['provincia_id' => $organizacion->provincia_id  ]);
         $request->request->add(['localidad_id' => $organizacion->localidad_id  ]);

        $request->request->add(['password' => Hash::make($request->password)]);
        User::create($request->all());
      //  debug($organizacion->pais_id);
        return redirect()->route('user.index')->with('success','Usuario registrado con éxito.');
    }

    public function edit(User $user)
    {
        $organizaciones = Organizacion::get();
        return view('admin.user.edit', compact('user','organizaciones'));
    }

    public function update(User $user)
    {
        // agregar el modelo user el pais_id
      /**  
       $organizacion_id = $request->organizacion_id;
       
         $organizacion  = Organizacion::find($organizacion_id);
          $user->pais_id= $organizacion->pais_id ;
         
          $user->provincia_id= $organizacion->provincia_id ;
          $user->localidad_id= $organizacion->localidad_id ;
        */
        
        $user->update(array_merge(request()->all(),['password' => Hash::make(request()->password)]));
        return redirect()->route('user.index')->with('success','Registro Actualizado');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')->with('success','Registro Eliminado');
    }
}
