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
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
      
        return view('admin.user.create');
    }

    public function store(Request $request)
    {   
       /// agregar el modelo user el pais_id
       /// $organizacion_id = $request->organizacion_id;
       
        /// $organizacion  = Organizacion::find($organizacion_id);
        // $request->request->add(['pais_id' => $organizacion->pais_id  ]);
        // $request->request->add(['provincia_id' => $organizacion->provincia_id  ]);
         //$request->request->add(['localidad_id' => $organizacion->localidad_id  ]);

        $request->request->add(['password' => Hash::make($request->password)]);
        User::create($request->all());
      //  debug($organizacion->pais_id);
        return redirect()->route('user.index')->with('success','Usuario registrado con éxito.');
    }

    public function edit(User $user)
    {
       
        return view('admin.user.edit', compact('user'));
    }

    public function update(User $user)
    {
                
        $user->update(array_merge(request()->all(),['password' => Hash::make(request()->password)]));
        return redirect()->route('user.index')->with('success','Registro Actualizado');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')->with('success','Registro Eliminado');
    }
}
