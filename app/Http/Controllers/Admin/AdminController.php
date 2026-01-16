<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DB;
use Hash;

class AdminController extends Controller
{	
    public function index()
    {
    	return view('admin.index',[
    		'users' 	=> DB::table('users')->count(),
    		'bronce' 	=> DB::table('obras')->where('activo',1)->count(),
    		'skills' => DB::table('cursos')->where('activo',1)->count(),
    		'diamante'	    => DB::table('novedades')->where('activo',1)->count(),
    			'basico'	    => DB::table('users')->where('role','>',1)->count(),
    		  	]);
    }

    public function profile()
    {

        $email=   \Auth::user()->email;
        $name=   \Auth::user()->name;
        $user = User::where('email', $email)->first();
// debug( $user);
        return view('admin.profile', compact('user'));
    }

    public function update(Request $request, $id)
    {
        if ($request->password) {
            $password = Hash::make($request->password);
        }else{  
            $password = $request->old_password;
        }   

        DB::table('users')->where('id',$id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>  $password,
            'celular' => $request->celular,
            'telefono' =>   $request->telefono,
            'cargo' =>   $request->cargo,
        ]);

        return redirect()->route('admin.profile')->with('success','Datos Actualizados');
    }
}
