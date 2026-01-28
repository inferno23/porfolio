<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail; 



class ContactoController extends Controller
{


	public function show( )
    {
		

        return view('home.contacto');
    }

	public function submit(Request $request) {
		$data = $request->validate([
			'name' => 'required|min:3',
			'email' => 'required|email',
			'message' => 'required'
		]);
	
		// Aquí puedes enviar un correo o guardar en BD


		Mail::send('email.contacto',  function($message) use($request){
			$message->to($request->email);
			$message->subject($request->name); 
			$message->message($request->message); 
		});

	  //  return back()->with('message', 'Hemos enviado su enlace de restablecimiento de contraseña por correo electrónico!');
 



		return back()->with('success', '¡Mensaje enviado!');
	}
}
