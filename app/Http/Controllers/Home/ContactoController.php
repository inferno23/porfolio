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
			'message' => 'required|min:3' 
		]);
	
		// Aquí puedes enviar un correo o guardar en BD
		// 1. Limpiamos los datos para evitar caracteres extraños o etiquetas HTML
		$datosLimpios = [
			'name'    => strip_tags($request->name),
			'email'   => filter_var($request->email, FILTER_SANITIZE_EMAIL),
			'mensaje' => strip_tags($request->message) // Suponiendo que el campo se llama 'mensaje'
		];

		// 2. Enviamos el mail con copia al admin
		Mail::send('email.contacto', $datosLimpios, function($message) use ($datosLimpios) {
			$message->to($datosLimpios['email'])
					->bcc('licenciadomarcofarfan@gmail.com') // Envía la copia oculta al admin
					->subject('Nuevo mensaje de la web de: ' . $datosLimpios['name']);
		});
         /*
		Mail::send('email.contacto',  function($message) use($request){
			$message->to($request->email);
			$message->subject($request->name); 
			
		});*/

	  //  return back()->with('message', 'Hemos enviado su enlace de restablecimiento de contraseña por correo electrónico!');
 



		return back()->with('success', '¡Mensaje enviado!');
	}
}
