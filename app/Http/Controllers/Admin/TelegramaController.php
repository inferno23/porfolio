<?php

namespace App\Http\Controllers\Admin;

use App\Models\Telegrama;
use App\Models\Localidad;
use App\Models\Grupo;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\telegramaRequest;
use Illuminate\Support\Facades\Auth;
/// excel insert
use DB;
//use Excel;
use App\Imports\PersonasImport;
use App\Models\Candidato;
use App\Exports\TelegramaExport;
use App\Exports\TelegramaMesaExport;
use Maatwebsite\Excel\Facades\Excel;

use File;

use App\Models\About;

use App\Http\Controllers\Admin\UploadController;
use App\Models\Pais;
use App\Models\Provincia;

class TelegramaController extends Controller
{



    public function show($id){
        $hoy=date("d-m-Y H");
        $nombre='telegrama-mesa-'.$id.'_'.$hoy;
        return Excel::download(new TelegramaMesaExport($id), $nombre.'.xlsx');
    }


    public function export(){
        $hoy=date("d-m-Y H");
        $nombre='telegramas '.$hoy;
        return Excel::download(new TelegramaExport, $nombre.'.xlsx');
    }

    public function modificar($id)
    {

        $telegramas = Telegrama::where('mesa', $id)->orderBy('orden', 'Asc')->get();
      
        $candidatos = Candidato::where('cargo', 'Senador')->orWhere('cargo' , "0") ->orderBy('orden', 'Asc')->get();
       // $candidatosDiputado = Candidato::where('cargo', 'Diputado')->orWhere('cargo' , "0") ->orderBy('orden', 'Asc')->get();
       
       // $personas  = Persona::get();
      
      
        return view('admin.telegrama.modificar', compact('candidatos','telegramas'));
    }
   
    
    public function index()
    {
        $userId = Auth::id();
        //  debug($userId);
          if($userId==1){
            $telegramas = Telegrama::orderBy('id', 'desc')->get();
            $votos_senador = DB::table('telegramas')
            ->join('candidatos', 'telegramas.candidato_id', '=', 'candidatos.id')
            ->select('candidatos.*', DB::raw('sum(votos_senador) as sum'),
             DB::raw('sum(votos_presidente) as votos_presidente'),
             DB::raw('sum(votos_diputado) as votos_diputado'),
             DB::raw('sum(votos_gobernador) as votos_gobernador'),
             DB::raw('sum(votos_intendente) as votos_intendente'),
             DB::raw('sum(votos_diputado_prov) as votos_diputado_prov'),
             DB::raw('sum(votos_comunal) as votos_comunal'),
             DB::raw('sum(votos_consejal) as votos_consejal'))
            ->groupBy('candidato_id')
            ->orderBy('candidatos.orden', 'Asc')
            ->get();
         }else{  
  
         
          $grupo=Grupo::select(['descripcion'])
          ->where('user_id',$userId)
          ->first();
         // debug($grupo['descripcion']);
        if (!empty($grupo)){
          $usuariosgrupo=Grupo::select(['user_id'])
          ->where('descripcion',$grupo['descripcion'])
          ->get();
          //debug($usuariosgrupo);
  
          foreach($usuariosgrupo as $model){
             // debug($model['user_id']);
              $users[]=$model['user_id'];
  
          }
          // debug($users);
  
          $telegramas = Telegrama::whereIn('user_id',$users)    
          ->get();
          $votos_senador = DB::table('telegramas')
          ->join('candidatos', 'telegramas.candidato_id', '=', 'candidatos.id')
          ->select('candidatos.*', DB::raw('sum(votos_senador) as sum'),
           DB::raw('sum(votos_presidente) as votos_presidente'),
           DB::raw('sum(votos_diputado) as votos_diputado'),
           DB::raw('sum(votos_gobernador) as votos_gobernador'),
           DB::raw('sum(votos_intendente) as votos_intendente'),
           DB::raw('sum(votos_consejal) as votos_consejal'),
           DB::raw('sum(votos_comunal) as votos_comunal'),
           DB::raw('sum(votos_diputado_prov) as votos_diputado_prov'))
          ->whereIn('telegramas.user_id',$users) 
          ->groupBy('candidato_id')
          ->orderBy('candidatos.orden', 'Asc')
          ->get();

  
        }else{
            // no tiene grupo solo muestro los q el cargo 
            $telegramas = Telegrama::where('user_id',$userId)
          
            ->get();
            $votos_senador = DB::table('telegramas')
          ->join('candidatos', 'telegramas.candidato_id', '=', 'candidatos.id')
          ->select('candidatos.*', DB::raw('sum(votos_senador) as sum'),
           DB::raw('sum(votos_presidente) as votos_presidente'),
           DB::raw('sum(votos_diputado) as votos_diputado'),
           DB::raw('sum(votos_gobernador) as votos_gobernador'),
           DB::raw('sum(votos_intendente) as votos_intendente'),
           DB::raw('sum(votos_consejal) as votos_consejal'),
           DB::raw('sum(votos_comunal) as votos_comunal'),
           DB::raw('sum(votos_diputado_prov) as votos_diputado_prov'))
          ->where('telegramas.user_id',$userId) 
          ->groupBy('candidato_id')
          ->orderBy('candidatos.orden', 'Asc')
          ->get();
          
         }
         // $registros = Registro::get();
  
      }
    
   
   

       
      
        return view('admin.telegrama.index', compact('telegramas','votos_senador'));
    }

    public function create(Request $request )
    {

        
        $pais_id=5;// 5 argentina
        $provincia_id=0;// 
        $localidad_id=0;//
        $email=   \Auth::user()->email;
        $name=   \Auth::user()->name;
        $user = User::where('email', $email)->first();
        if (!empty($user)){
                    $pais_id=$user->pais_id;// 5 argentina
                    $provincia_id=$user->provincia_id;// 25 tucuman
                    $localidad_id=$user->localidad_id;// 
                    
            //debug($pais_id);
        }
                
     /// solo nmuewstro candidatos senador pero puede ser q sea solo municipal 

     // por mas q este cargado el municipal no sale si o si tengo q habilitar el senador o diputado
     $blancos = Candidato::where('pais_id', $pais_id)->Where('cargo' , "0") ->orderBy('orden', 'Asc')->get();
     
     $presidentes = Candidato::where('presidente',  '!=', NULL)->where('presidente', '<>', '')->where('pais_id', $pais_id)->orderBy('orden', 'Asc')->get();
     $candidatos = $candidatosDiputado = $diputado_provincial =  $diputado_provincial = $gobernadores = $intendentes = $concejales  =$municipales  = [] ;
          
        if (!empty($provincia_id) && $provincia_id>0){
            $candidatos = Candidato::where('senador',  '!=', NULL)->where('senador', '<>', '')->Where('provincia_id', $provincia_id)->orderBy('orden', 'Asc')->get();
            $candidatosDiputado = Candidato::where('diputado',  '!=', NULL)->where('diputado', '<>', '')->Where('provincia_id', $provincia_id)->orderBy('orden', 'Asc')->get();
           
            $diputado_provincial = Candidato::where('diputado_provincial',  '!=', NULL)->where('diputado_provincial', '<>', '')->Where('provincia_id', $provincia_id)->orderBy('orden', 'Asc')->get();
            $gobernadores = Candidato::where('gobernador',  '!=', NULL)->where('gobernador', '<>', '')->Where('provincia_id', $provincia_id) ->orderBy('orden', 'Asc')->get();
            
        }
        if (!empty($localidad_id) && $localidad_id>0){
            $intendentes = Candidato::where('intendente',  '!=', NULL)->where('intendente', '<>', '')->where('localidad_id', $localidad_id) ->orderBy('orden', 'Asc')->get();
       
            $concejales = Candidato::where('concejal',  '!=', NULL)->where('concejal', '<>', '')->where('localidad_id', $localidad_id)->orderBy('orden', 'Asc')->get();

            $municipales = Candidato::where('municipal',  '!=', NULL)->where('municipal', '<>', '')->where('localidad_id', $localidad_id)->orderBy('orden', 'Asc')->get();

        }
        /** 
       debug (count($presidentes));
        debug (count($candidatos));
        debug (count($candidatosDiputado));
        debug (count($diputado_provincial));
        debug (count($gobernadores));
       debug (count($intendentes));
       debug (count($concejales));
       debug (count($municipales));
       */
       //////////// hay  senadores  agreguo los nulos y blancos ///////////////////////
       if( (count($candidatos)>0)  ){
           $candidatos = Candidato::where('senador',  '!=', NULL)->where('senador', '<>', '')->Where('provincia_id', $provincia_id)->orWhere('cargo' , "0")->orderBy('orden', 'Asc')->get();
           

          }
      //////////// solo presidentes///////////////////////
        if( (count($candidatos)<1) && (count($gobernadores)<1) && (count($diputado_provincial)<1)  && (count($intendentes)<1) && (count($concejales)<1) && (count($municipales)<1)  ){
            $pais = Pais::find($pais_id);
            $presidentes = Candidato::where('presidente',  '!=', NULL)->where('presidente', '<>', '')->where('pais_id', $pais_id)->orWhere('cargo' , "0")->orderBy('orden', 'Asc')->get();
           
            
            return view('admin.telegrama.presidentes', compact('pais','presidentes', 'blancos'));
           }
 //////////// solo consejales///////////////////////
           if( (count($presidentes)<8) && (count($candidatos)<1) && (count($gobernadores)<1) && (count($diputado_provincial)<1)  && (count($intendentes)<1) && (count($municipales)<1)  ){
              $localidad = Localidad::find($localidad_id);
              $concejales = Candidato::where('concejal',  '!=', NULL)->where('concejal', '<>', '')->where('localidad_id', $localidad_id)->orWhere('cargo' , "0") ->orderBy('orden', 'Asc')->get();
                  
            $municipales = Candidato::where('municipal',  '!=', NULL)->where('municipal', '<>', '')->where('localidad_id', $localidad_id)->orWhere('cargo' , "0") ->orderBy('orden', 'Asc')->get();

            return view('admin.telegrama.concejales', compact('localidad','concejales', 'municipales'));
           }

//////////// solo diputado_provincial///////////////////////
if( (count($presidentes)<8) && (count($candidatos)<1) && (count($gobernadores)<1)  && (count($intendentes)<1) && (count($concejales)<1) && (count($municipales)<1)  ){
  $provincia = Provincia::find($provincia_id);

  $diputados_provinciales = Candidato::where('diputado_provincial',  '!=', NULL)->where('diputado_provincial', '<>', '')->Where('provincia_id', $provincia_id)->orWhere('cargo' , "0")->orderBy('orden', 'Asc')->get();
 
  return view('admin.telegrama.diputados_provinciales', compact('provincia','diputados_provinciales'));
 }

//////////// solo delegad  municipales///////////////////////
if( (count($presidentes)<8) && (count($candidatos)<1) && (count($gobernadores)<1) && (count($diputado_provincial)<1) && (count($intendentes)<1)  && (count($concejales)<1)  ){
  $localidad = Localidad::find($localidad_id);
     
$municipales = Candidato::where('municipal',  '!=', NULL)->where('municipal', '<>', '')->where('localidad_id', $localidad_id)->orWhere('cargo' , "0") ->orderBy('orden', 'Asc')->get();

return view('admin.telegrama.municipales', compact('localidad', 'municipales'));
}


       // CAMBIAR 8 por q toma presi con votos en blanco  y demas
       if( (count($presidentes)<8) && (count($candidatos)<1) && (count($candidatosDiputado)<1)  && (count($diputado_provincial)<1)  && (count($gobernadores)<1) ){
        $localidad = Localidad::find($localidad_id);

        $intendentes = Candidato::where('intendente',  '!=', NULL)->where('intendente', '<>', '')->where('localidad_id', $localidad_id)->orWhere('cargo' , "0") ->orderBy('orden', 'Asc')->get();
       
        $concejales = Candidato::where('concejal',  '!=', NULL)->where('concejal', '<>', '')->where('localidad_id', $localidad_id)->orWhere('cargo' , "0") ->orderBy('orden', 'Asc')->get();
        $municipales = Candidato::where('municipal',  '!=', NULL)->where('municipal', '<>', '')->where('localidad_id', $localidad_id)->orWhere('cargo' , "0") ->orderBy('orden', 'Asc')->get();

        return view('admin.telegrama.localidad', compact('localidad','intendentes','concejales', 'blancos'));
       }

 /////////////////////// gobernadores y diputado_provincial /////////////////////////////////
     
       if( (count($presidentes)<8) && (count($candidatos)<1) && (count($candidatosDiputado)<1)  && (count($intendentes)<1) && (count($concejales)<1)  ){
        $provincia = Provincia::find($provincia_id);

        $diputado_provincial = Candidato::where('diputado_provincial',  '!=', NULL)->where('diputado_provincial', '<>', '')->Where('provincia_id', $provincia_id)->orderBy('orden', 'Asc')->get();
        $gobernadores = Candidato::where('gobernador',  '!=', NULL)->where('gobernador', '<>', '')->Where('provincia_id', $provincia_id) ->orWhere('cargo' , "0") ->orderBy('orden', 'Asc')->get();
 
        return view('admin.telegrama.provincia', compact('provincia','gobernadores','diputado_provincial', 'blancos'));
       }
       /////////////////////// senadores y candidatosDiputado /////////////////////////////////
       if( (count($presidentes)<8) && (count($gobernadores)<1) && (count($diputado_provincial)<1)  && (count($intendentes)<1) && (count($concejales)<1)  ){
        $provincia = Provincia::find($provincia_id);

        $senadores = Candidato::where('senador',  '!=', NULL)->where('senador', '<>', '')->Where('provincia_id', $provincia_id)->orWhere('cargo' , "0")->where('id',  '!=', 6)->orderBy('orden', 'Asc')->get();
        $candidatosDiputado = Candidato::where('id',  '!=', 6)->where('diputado',  '!=', NULL)->where('diputado', '<>', '')->Where('provincia_id', $provincia_id)->orWhere('cargo' , "0")->where('id',  '!=', 6) ->orderBy('orden', 'Asc')->get();
       
        return view('admin.telegrama.senadores', compact('provincia','senadores','candidatosDiputado', 'blancos'));
       }
       


        return view('admin.telegrama.create', compact('candidatos','candidatosDiputado','candidatos','presidentes','diputado_provincial','gobernadores','intendentes','concejales','municipales'));
    }

    public function store(Request $request)
    {
      
          $cantidad_votantes = $request->cantidad_votantes;
         $cantidad_sobres = $request->cantidad_sobres;
         $mesa = $request->mesa;
         $user_id = $request->user_id;
         $localidad_id = $request->localidad_id;
         $total_padron = $request->total_padron;
         


         if($request->hasFile("file")){

            $imagen = $request->file("file");
            $nombreimagen = "TelegramaMesa_". $mesa .".".$imagen->guessExtension();
            $ruta = public_path("uploads/telegrama/");

           // debug($ruta); 

            //$imagen->move($ruta,$nombreimagen);
            copy($imagen->getRealPath(),$ruta.$nombreimagen);
           
          // request()->file->storeAs($ruta.'/',$nombreimagen);


            $imagen = $nombreimagen;   
            $image = UploadController::uploadSingleImage2($imagen,'telegrama');
          //  debug($nombreimagen);         
            
        }
         
         if(!empty($mesa)) {
         $axc = Telegrama::where('mesa', '=', $mesa)->where('localidad_id', '=', $localidad_id)-> get();

          $axc ->each-> delete();

        }
         
         $votos = count($request->valor);
         $votosDiputado = count($request->valor2);

         $valores = $request->valor;
         $valores2 = $request->valor2;
         $valores3 = $request->valor3;
         $valores4 = $request->valor4;
         $valores5 = $request->valor5;
         $valores6 = $request->valor6;
         $valores7 = $request->valor7;
         $valores8 = $request->valor8;
         $candidato = $request->candidato;

       //  debug ($valores);
        // debug ($candidato);
         for($i=0; $i < $votos; $i++){
 
             $telegrma = new Telegrama;
             $telegrma->mesa = $mesa;
             $telegrma->localidad_id = $localidad_id;
             $telegrma->total_padron = $total_padron;
             
             $telegrma->user_id = $user_id;
             $telegrma->imagen = $image;
             $telegrma->cantidad_votantes = $cantidad_votantes;
             $telegrma->cantidad_sobres = $cantidad_sobres;
             $cantidad=0;
             if(!empty($valores[$i]))
                  $cantidad=$valores[$i];


                  $cantidad2=0;
            if(!empty($valores2[$i]))
                 $cantidad2=$valores2[$i];

                 $cantidad3=0;
                 if(!empty($valores3[$i]))
                 $cantidad3=$valores3[$i];

                 $cantidad4=0;
                 if(!empty($valores4[$i]))
                 $cantidad4=$valores4[$i];

                 $cantidad5=0;
                 if(!empty($valores5[$i]))
                 $cantidad5=$valores5[$i];

                 $cantidad6=0;
                 if(!empty($valores6[$i]))
                 $cantidad6=$valores6[$i];


                 
                 $cantidad7=0;
                 if(!empty($valores7[$i]))
                 $cantidad6=$valores7[$i];
                 $cantidad8=0;
                 if(!empty($valores8[$i]))
                 $cantidad8=$valores8[$i];


            $telegrma->imagen = $image;
             $telegrma->votos_senador = $cantidad;
             $telegrma->votos_diputado = $cantidad2;
             $telegrma->votos_presidente= $cantidad3;
             $telegrma->votos_gobernador= $cantidad4;
             $telegrma->votos_diputado_prov	= $cantidad5;
             $telegrma->votos_intendente= $cantidad6;
             $telegrma->votos_consejal= $cantidad7;
             $telegrma->votos_comunal= $cantidad8;

           
             $telegrma->candidato_id =$candidato[$i];
             $telegrma->save();
         }


         ////diputados DELETE FROM `telegramas` ;
        /// sacar solo para debug return view('admin.telegrama.create');
        return redirect()->route('telegrama.index')->with('success','telegrama creado');

        
    }


    public function storeLocalidad(Request $request)
    {
      
          $cantidad_votantes = $request->cantidad_votantes;
         $cantidad_sobres = $request->cantidad_sobres;
         $mesa = $request->mesa;
         $user_id = $request->user_id;
         $total_padron = $request->total_padron;
        


         $localidad_id = $request->localidad_id;


         if($request->hasFile("file")){

            $imagen = $request->file("file");
            $nombreimagen = "TelegramaMesa_". $mesa .".".$imagen->guessExtension();
            $ruta = public_path("uploads/telegrama/");

           // debug($ruta); 

            //$imagen->move($ruta,$nombreimagen);
            copy($imagen->getRealPath(),$ruta.$nombreimagen);
           
          // request()->file->storeAs($ruta.'/',$nombreimagen);


            $imagen = $nombreimagen;   
            $image = UploadController::uploadSingleImage2($imagen,'telegrama');
          //  debug($nombreimagen);         
            
        }
         
         if(!empty($mesa)) {
        
         $axc = Telegrama::where('mesa', '=', $mesa)->where('localidad_id', '=', $localidad_id)-> get();

          $axc ->each-> delete();

        }
         
         $votos = count($request->valor6);
         $valores6 = $request->valor6;
       
         $valores7 = $request->valor7;
         $candidato = $request->candidato;

      
         for($i=0; $i < $votos; $i++){
 
             $telegrma = new Telegrama;
             $telegrma->mesa = $mesa;
             $telegrma->total_padron = $total_padron;
             $telegrma->user_id = $user_id;
             $telegrma->imagen = $image;
             $telegrma->cantidad_votantes = $cantidad_votantes;
             $telegrma->cantidad_sobres = $cantidad_sobres;
             $cantidad6=0;
             
                 if(!empty($valores6[$i]))
                 $cantidad6=$valores6[$i];


                 
                 $cantidad7=0;
                 if(!empty($valores7[$i]))
                 $cantidad7=$valores7[$i];

            $telegrma->imagen = $image;
           
             $telegrma->votos_intendente= $cantidad6;
             $telegrma->votos_consejal= $cantidad7;

             $telegrma->localidad_id = $localidad_id;
             $telegrma->candidato_id =$candidato[$i];
             $telegrma->save();
         }


         ////diputados DELETE FROM `telegramas` ;
        /// sacar solo para debug return view('admin.telegrama.create');
        return redirect()->route('telegrama.index')->with('success','telegrama creado');

        
    }



    public function storeConsejal(Request $request)
    {
      
          $cantidad_votantes = $request->cantidad_votantes;
         $cantidad_sobres = $request->cantidad_sobres;
         $mesa = $request->mesa;
         $user_id = $request->user_id;

         $total_padron = $request->total_padron;
        

         $localidad_id = $request->localidad_id;


         if($request->hasFile("file")){

            $imagen = $request->file("file");
            $nombreimagen = "TelegramaMesa_". $mesa .".".$imagen->guessExtension();
            $ruta = public_path("uploads/telegrama/");

           // debug($ruta); 

            //$imagen->move($ruta,$nombreimagen);
            copy($imagen->getRealPath(),$ruta.$nombreimagen);
           
          // request()->file->storeAs($ruta.'/',$nombreimagen);


            $imagen = $nombreimagen;   
            $image = UploadController::uploadSingleImage2($imagen,'telegrama');
          //  debug($nombreimagen);         
            
        }
         
         if(!empty($mesa)) {
               $axc = Telegrama::where('mesa', '=', $mesa)->where('localidad_id', '=', $localidad_id)-> get();

          $axc ->each-> delete();

        }
         
         $votos = count($request->valor7);
        
       
         $valores7 = $request->valor7;
         $candidato = $request->candidato;

      
         for($i=0; $i < $votos; $i++){
 
             $telegrma = new Telegrama;
             $telegrma->mesa = $mesa;

             $telegrma->total_padron = $total_padron;
             
             $telegrma->localidad_id = $localidad_id;


             $telegrma->user_id = $user_id;
             $telegrma->imagen = $image;
             $telegrma->cantidad_votantes = $cantidad_votantes;
             $telegrma->cantidad_sobres = $cantidad_sobres;
             
             
                


                 
                 $cantidad7=0;
                 if(!empty($valores7[$i]))
                 $cantidad7=$valores7[$i];


            $telegrma->imagen = $image;
           
          
             $telegrma->votos_consejal= $cantidad7;

           
             $telegrma->candidato_id =$candidato[$i];
             $telegrma->save();
         }


         ////diputados DELETE FROM `telegramas` ;
        /// sacar solo para debug return view('admin.telegrama.create');
        return redirect()->route('telegrama.index')->with('success','telegrama creado');

        
    }

    
    public function storeMunicipal(Request $request)
    {
      
          $cantidad_votantes = $request->cantidad_votantes;
         $cantidad_sobres = $request->cantidad_sobres;
         $mesa = $request->mesa;
         $user_id = $request->user_id;
         $localidad_id = $request->localidad_id;
         $total_padron = $request->total_padron;
        


         if($request->hasFile("file")){

            $imagen = $request->file("file");
            $nombreimagen = "TelegramaMesa_". $mesa .".".$imagen->guessExtension();
            $ruta = public_path("uploads/telegrama/");

           // debug($ruta); 

            //$imagen->move($ruta,$nombreimagen);
            copy($imagen->getRealPath(),$ruta.$nombreimagen);
           
          // request()->file->storeAs($ruta.'/',$nombreimagen);


            $imagen = $nombreimagen;   
            $image = UploadController::uploadSingleImage2($imagen,'telegrama');
          //  debug($nombreimagen);         
            
        }
         
         if(!empty($mesa)) {
        
         $axc = Telegrama::where('mesa', '=', $mesa)->where('localidad_id', '=', $localidad_id)-> get();

          $axc ->each-> delete();

        }
         
         $votos = count($request->valor8);
        
       
         $valores8 = $request->valor8;
         $candidato = $request->candidato;

       //  debug ($valores);
        // debug ($candidato);
         for($i=0; $i < $votos; $i++){
 
             $telegrma = new Telegrama;
             $telegrma->mesa = $mesa;
             $telegrma->localidad_id = $localidad_id;
             $telegrma->user_id = $user_id;
             $telegrma->imagen = $image;
             $telegrma->cantidad_votantes = $cantidad_votantes;
             $telegrma->cantidad_sobres = $cantidad_sobres;
             
             
                


                 
                 $cantidad8=0;
                 if(!empty($valores8[$i]))
                 $cantidad8=$valores8[$i];


            $telegrma->imagen = $image;
           
          
             $telegrma->votos_comunal= $cantidad8;

           
             $telegrma->candidato_id =$candidato[$i];
             $telegrma->save();
         }


         ////diputados DELETE FROM `telegramas` ;
        /// sacar solo para debug return view('admin.telegrama.create');
        return redirect()->route('telegrama.index')->with('success','telegrama creado');

        
    }



    public function storeDiputadoProv(Request $request)
    {
      
          $cantidad_votantes = $request->cantidad_votantes;
         $cantidad_sobres = $request->cantidad_sobres;
         $mesa = $request->mesa;
         $user_id = $request->user_id;
         $localidad_id = $request->localidad_id;
         $total_padron = $request->total_padron;
         

         if($request->hasFile("file")){

            $imagen = $request->file("file");
            $nombreimagen = "TelegramaMesa_". $mesa .".".$imagen->guessExtension();
            $ruta = public_path("uploads/telegrama/");

           // debug($ruta); 

            //$imagen->move($ruta,$nombreimagen);
            copy($imagen->getRealPath(),$ruta.$nombreimagen);
           
          // request()->file->storeAs($ruta.'/',$nombreimagen);


            $imagen = $nombreimagen;   
            $image = UploadController::uploadSingleImage2($imagen,'telegrama');
          //  debug($nombreimagen);         
            
        }
         
         if(!empty($mesa)) {
         
         $axc = Telegrama::where('mesa', '=', $mesa)->where('localidad_id', '=', $localidad_id)-> get();

          $axc ->each-> delete();

        }
         
         $votos = count($request->valor7);
        
       
         $valores7 = $request->valor7;
         $candidato = $request->candidato;

       //  debug ($valores);
        // debug ($candidato);
         for($i=0; $i < $votos; $i++){
 
             $telegrma = new Telegrama;
             $telegrma->mesa = $mesa;
             $telegrma->total_padron = $total_padron;
            
             $telegrma->localidad_id = $localidad_id;
             $telegrma->user_id = $user_id;
             $telegrma->imagen = $image;
             $telegrma->cantidad_votantes = $cantidad_votantes;
             $telegrma->cantidad_sobres = $cantidad_sobres;
             
                 
                 $cantidad7=0;
                 if(!empty($valores7[$i]))
                 $cantidad7=$valores7[$i];


            $telegrma->imagen = $image;
           
          
             $telegrma->votos_diputado_prov= $cantidad7;

           
             $telegrma->candidato_id =$candidato[$i];
             $telegrma->save();
         }


         ////diputados DELETE FROM `telegramas` ;
        /// sacar solo para debug return view('admin.telegrama.create');
        return redirect()->route('telegrama.index')->with('success','telegrama creado');

        
    }




    public function storeProvincia(Request $request)
    {
      
          $cantidad_votantes = $request->cantidad_votantes;
         $cantidad_sobres = $request->cantidad_sobres;
         $mesa = $request->mesa;
         $user_id = $request->user_id;
         $total_padron = $request->total_padron;
         


         $localidad_id = $request->localidad_id;


         if($request->hasFile("file")){

            $imagen = $request->file("file");
            $nombreimagen = "TelegramaMesa_". $mesa .".".$imagen->guessExtension();
            $ruta = public_path("uploads/telegrama/");

           // debug($ruta); 

            //$imagen->move($ruta,$nombreimagen);
            copy($imagen->getRealPath(),$ruta.$nombreimagen);
           
          // request()->file->storeAs($ruta.'/',$nombreimagen);


            $imagen = $nombreimagen;   
            $image = UploadController::uploadSingleImage2($imagen,'telegrama');
          //  debug($nombreimagen);         
            
        }
         
         if(!empty($mesa)) {
        
         $axc = Telegrama::where('mesa', '=', $mesa)->where('localidad_id', '=', $localidad_id)-> get();

          $axc ->each-> delete();

        }
         
         $votos = count($request->valor6);
         $valores6 = $request->valor6;
       
         $valores7 = $request->valor7;
         $candidato = $request->candidato;

       //  debug ($valores);
        // debug ($candidato);
         for($i=0; $i < $votos; $i++){
 
             $telegrma = new Telegrama;
             $telegrma->mesa = $mesa;
             $telegrma->localidad_id = $localidad_id;
             $telegrma->total_padron = $total_padron;
            
             $telegrma->user_id = $user_id;
             $telegrma->imagen = $image;
             $telegrma->cantidad_votantes = $cantidad_votantes;
             $telegrma->cantidad_sobres = $cantidad_sobres;
             $cantidad6=0;
             
                 if(!empty($valores6[$i]))
                 $cantidad6=$valores6[$i];


                 
                 $cantidad7=0;
                 if(!empty($valores7[$i]))
                 $cantidad7=$valores7[$i];


              
            $telegrma->imagen = $image;
           
             $telegrma->votos_gobernador= $cantidad6;
             $telegrma->votos_diputado_prov= $cantidad7;

           
             $telegrma->candidato_id =$candidato[$i];
             $telegrma->save();
         }


         ////diputados DELETE FROM `telegramas` ;
        /// sacar solo para debug return view('admin.telegrama.create');
        return redirect()->route('telegrama.index')->with('success','telegrama creado');

        
    }




    public function storePresidente(Request $request)
    {
      
          $cantidad_votantes = $request->cantidad_votantes;
         $cantidad_sobres = $request->cantidad_sobres;
         $mesa = $request->mesa;
         $user_id = $request->user_id;
         $total_padron = $request->total_padron;

         $localidad_id = $request->localidad_id;


         if($request->hasFile("file")){

            $imagen = $request->file("file");
            $nombreimagen = "TelegramaMesa_". $mesa .".".$imagen->guessExtension();
            $ruta = public_path("uploads/telegrama/");

           

            //$imagen->move($ruta,$nombreimagen);
            copy($imagen->getRealPath(),$ruta.$nombreimagen);
           
          // request()->file->storeAs($ruta.'/',$nombreimagen);


            $imagen = $nombreimagen;   
            $image = UploadController::uploadSingleImage2($imagen,'telegrama');
                  
            
        }
         
         if(!empty($mesa)) {
        
         $axc = Telegrama::where('mesa', '=', $mesa)->where('localidad_id', '=', $localidad_id)-> get();

          $axc ->each-> delete();

        }
         
         $votos = count($request->valor6);
         $valores6 = $request->valor6;
       
       
         $candidato = $request->candidato;

       
         for($i=0; $i < $votos; $i++){
 
             $telegrma = new Telegrama;
             $telegrma->mesa = $mesa;
             $telegrma->localidad_id = $localidad_id;
             $telegrma->total_padron = $total_padron;
           
             $telegrma->user_id = $user_id;
             $telegrma->imagen = $image;
             $telegrma->cantidad_votantes = $cantidad_votantes;
             $telegrma->cantidad_sobres = $cantidad_sobres;
             $cantidad6=0;
             
                 if(!empty($valores6[$i]))
                 $cantidad6=$valores6[$i];


              
            $telegrma->imagen = $image;
           
             $telegrma->votos_presidente= $cantidad6;
            

           
             $telegrma->candidato_id =$candidato[$i];
             $telegrma->save();
         }

        return redirect()->route('telegrama.index')->with('success','telegrama creado');

        
    }


    public function storeSenador(Request $request)
    {
      
          $cantidad_votantes = $request->cantidad_votantes;
         $cantidad_sobres = $request->cantidad_sobres;
         $mesa = $request->mesa;
         $user_id = $request->user_id;
         $total_padron = $request->total_padron;

        

         $localidad_id = $request->localidad_id;


         if($request->hasFile("file")){

            $imagen = $request->file("file");
            $nombreimagen = "TelegramaMesa_". $mesa .".".$imagen->guessExtension();
            $ruta = public_path("uploads/telegrama/");

          

            //$imagen->move($ruta,$nombreimagen);
            copy($imagen->getRealPath(),$ruta.$nombreimagen);
           
          // request()->file->storeAs($ruta.'/',$nombreimagen);


            $imagen = $nombreimagen;   
            $image = UploadController::uploadSingleImage2($imagen,'telegrama');
                   
            
        }
         
        if(!empty($mesa)) {
       
         $axc = Telegrama::where('mesa', '=', $mesa)->where('localidad_id', '=', $localidad_id)-> get();

          $axc ->each-> delete();

        }
         
         $votos = count($request->valor6);
         $valores6 = $request->valor6;
       
         $valores7 = $request->valor7;
         $candidato = $request->candidato;

       //  debug ($valores);
        // debug ($candidato);
         for($i=0; $i < $votos; $i++){
 
             $telegrma = new Telegrama;
             $telegrma->mesa = $mesa;
             $telegrma->total_padron = $total_padron;
            
             $telegrma->localidad_id = $localidad_id;
             $telegrma->user_id = $user_id;
             $telegrma->imagen = $image;
             $telegrma->cantidad_votantes = $cantidad_votantes;
             $telegrma->cantidad_sobres = $cantidad_sobres;
             $cantidad6=0;
             
                 if(!empty($valores6[$i]))
                 $cantidad6=$valores6[$i];


                 
                 $cantidad7=0;
                 if(!empty($valores7[$i]))
                 $cantidad7=$valores7[$i];


            $telegrma->imagen = $image;
           
             $telegrma->votos_senador= $cantidad6;
             $telegrma->votos_diputado= $cantidad7;

           
             $telegrma->candidato_id =$candidato[$i];
             $telegrma->save();
         }

             $telegrma = new Telegrama;
             $telegrma->mesa = $mesa;
             $telegrma->total_padron = $total_padron;
            
             $telegrma->localidad_id = $localidad_id;
             $telegrma->user_id = $user_id;
             $telegrma->imagen = $image;
             $telegrma->cantidad_votantes = $cantidad_votantes;
             $telegrma->cantidad_sobres = $cantidad_sobres;
             $total = $request->total;
             $totaldiputado = $request->totaldiputado;
             $cantidad6=0;      
             if(!empty($total))
                $cantidad6=$total;;


             
             $cantidad7=0;
             if(!empty($totaldiputado))
             $cantidad7=$totaldiputado;

             $telegrma->votos_senador= $cantidad6;
             $telegrma->votos_diputado= $cantidad7;

           
             $telegrma->candidato_id =6;// votos total
             $telegrma->save();
         ////diputados DELETE FROM `telegramas` ;
        /// sacar solo para debug return view('admin.telegrama.create');
        return redirect()->route('telegrama.index')->with('success','telegrama creado');

        
    }


























    public function show23(telegrama $telegrama)
    {
        return view('admin.telegrama.show', compact('telegrama'));
    }

    public function edit(telegrama $telegrama)
    {

        
        return view('admin.telegrama.edit', compact('telegrama'));
    }

    public function update(Request $request, telegrama $telegrama)
    {
        $this->validate($request, [
            'votos_senador' => 'required|max:20',
            'votos_diputado' => 'required',
            
        ]);

        $telegrama->update($request->all());

        //return view('admin.telegrama.edit', compact('telegrama'));
        return redirect()->route('telegrama.index')->with('success','Datos del telegrama Actualizado');
    
    }

    public function destroy(telegrama $telegrama)
    {
        $telegrama->delete();
        return redirect()->route('telegrama.index')->with('success','telegrama eliminado');
    }


    
}
