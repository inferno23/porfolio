<?php


namespace App\Http\Controllers\Admin;

use App\Models\Chart;
use App\Models\Localidad;
use App\Models\Provincia;
use App\Models\Pais;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Telegrama;
use App\Models\Institute;
use App\Models\Grupo;
use App\Models\User;
use Carbon\Carbon;

class ChartController extends Controller
{
    
    

    public function index()
    {

      
        $userId = Auth::id();
       //borrrrrrrrrar $userId = 20;

        //  debug($userId);
        if($userId==1){
            $record = DB::table('telegramas')
            ->join('candidatos', 'telegramas.candidato_id', '=', 'candidatos.id')
            ->select('candidatos.*', DB::raw('sum(votos_senador) as sum'), DB::raw('sum(votos_senador) as sum'), DB::raw('sum(votos_diputado) as votos_diputado'))
            ->groupBy('candidato_id')
            ->orderBy('candidatos.orden', 'Asc')
            ->get();

           
            $total_padron= DB::table('telegramas')->select('mesa', 'total_padron', 'cantidad_votantes' )
          
                ->groupBy('mesa')
                ->get();
          //  debug ($total_padron);
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
    
            $record = DB::table('telegramas')
            ->join('candidatos', 'telegramas.candidato_id', '=', 'candidatos.id')
            ->select('candidatos.*', DB::raw('sum(votos_senador) as sum'), DB::raw('sum(votos_diputado) as votos_diputado'))
            ->whereIn('telegramas.user_id',$users) 
            ->groupBy('candidato_id')
            ->orderBy('candidatos.orden', 'Asc')
            ->get();

            $total_padron= DB::table('telegramas')->select('mesa', 'total_padron', 'cantidad_votantes' )
            ->whereIn('telegramas.user_id',$users) 
            ->groupBy('mesa')->get();

            
              
          }else{
            // no tiene grupo solo muestro los q el cargo 
            $record = DB::table('telegramas')
            ->join('candidatos', 'telegramas.candidato_id', '=', 'candidatos.id')
            ->select('candidatos.*', DB::raw('sum(votos_senador) as sum'), DB::raw('sum(votos_diputado) as votos_diputado'))
            ->where('telegramas.user_id',$userId) 
            ->groupBy('candidato_id')
            ->orderBy('candidatos.orden', 'Asc')
            ->get();
            $total_padron= DB::table('telegramas')->select('mesa', 'total_padron', 'cantidad_votantes' )
          
           ->where('telegramas.user_id',$userId) 
            ->groupBy('mesa')->get();
          
          }
        }
       
        $total=$total_votantes=0;
        foreach($total_padron as $row) {
            $total_padron_mesa[] =(int) $row->total_padron;
            $total=$total+(int) $row->total_padron;
            $cantidad_votantes_mesa[] =(int) $row->cantidad_votantes;
            $total_votantes=$total_votantes+(int) $row->cantidad_votantes;


            
        }
      //  debug ($cantidad_votantes_mesa);
     //   debug ($total_votantes);
        $year = $user = [];
       
      
        $diputado=$data = [];
     
         
        $comando_diputado=  $impugnada_diputado=  $Recurridos_diputado= $comando =$Recurridos=$impugnada=$blanco=0;
        $nulos=0;$negativo=0;$positivo=0;$j=0;
         $blanco_diputado=0;$nulos_diputado=0;$negativo_diputado=0;$positivo_diputado=0;$j=0;
         foreach($record as $row) {

            $titulo=$row->lista;
            $frase=$row->partido;
            //Sin saltos de lineas para dibujar 
            $frase = preg_replace("/[\r\n|\n|\r]+/", " ", $frase);

             if(empty($row->lista))  {

                $frase=$row->partido;
                //Sin saltos de lineas para dibujar 
                $frase = preg_replace("/[\r\n|\n|\r]+/", " ", $frase);


                $array_palabras = explode(' ', $frase);
                 $longitud_array = count($array_palabras);

                  $ultima_palabra = $array_palabras[$longitud_array - 1];
                
                 $titulo=$ultima_palabra; 
                 $j++;
            }

            $data['label'][] =$year[] = $frase;
            $data['data'][] = $user[] =(int) $row->sum;
            $diputado[] =(int) $row->votos_diputado;
            //1 nulo 5 blancos
            if ($row->id==1 ){
                $nulos= $nulos + (int) $row->sum; 
                $negativo= $negativo+ (int) $row->sum;
                $nulos_diputado= $nulos_diputado + (int) $row->votos_diputado; 
                $negativo_diputado= $negativo_diputado+ (int) $row->votos_diputado; 
            }
            if ($row->id==2 ){
                $Recurridos= $Recurridos  + (int) $row->sum;
                $Recurridos_diputado= $Recurridos_diputado + (int) $row->votos_diputado;
         
              
            }
            if ($row->id==3 ){
                $impugnada= $impugnada  + (int) $row->sum; 
                $impugnada_diputado= $impugnada_diputado + (int) $row->votos_diputado;
         
              
            }
            if ($row->id==4 ){
                $comando = $comando   + (int) $row->sum; 
                $comando_diputado= $comando_diputado + (int) $row->votos_diputado;
         
            }


            if ($row->id==5){
                $blanco= $blanco + (int) $row->sum;
                $negativo= $negativo+ (int) $row->sum;  
                $blanco_diputado= $blanco_diputado + (int) $row->votos_diputado;
                $negativo_diputado= $negativo_diputado+ (int) $row->votos_diputado; 
       
            }
            if ($row->id>6){
                
                $positivo= $positivo+ (int) $row->sum;
                $positivo_diputado= $positivo_diputado+ (int) $row->votos_diputado;   
            }


           // $data['label'][] = $row->day_name;
           // $data['data'][] = (int) $row->count;
          }
     
        $data['chart_data'] = json_encode($data);
        
///  CAMBIAR A INDEX EL PDFFFFFFFFFFFFFFFFFFFFF
    	return view('admin.charts.pdf')
        ->with('registros',($record))
        ->with('data',json_encode($data))
        ->with('year',json_encode($year,JSON_NUMERIC_CHECK))
        ->with('diputado',json_encode($diputado,JSON_NUMERIC_CHECK))
        ->with('total_padron',json_encode($total,JSON_NUMERIC_CHECK))
        ->with('total_votantes',json_encode($total_votantes,JSON_NUMERIC_CHECK))
       
        ->with('Recurridos',json_encode($Recurridos,JSON_NUMERIC_CHECK))
        ->with('Recurridos_diputado',json_encode($Recurridos_diputado,JSON_NUMERIC_CHECK))
       
        ->with('impugnada',json_encode($impugnada,JSON_NUMERIC_CHECK))
        ->with('impugnada_diputado',json_encode($impugnada_diputado,JSON_NUMERIC_CHECK))
       
        ->with('comando',json_encode($comando,JSON_NUMERIC_CHECK))
        ->with('comando_diputado',json_encode($comando_diputado,JSON_NUMERIC_CHECK))
       

         ->with('user2',json_encode($diputado,JSON_NUMERIC_CHECK))
        ->with('nulos',json_encode($nulos,JSON_NUMERIC_CHECK))
        ->with('blanco',json_encode($blanco,JSON_NUMERIC_CHECK))
        ->with('positivo',json_encode($positivo,JSON_NUMERIC_CHECK))
        ->with('negativo',json_encode($negativo,JSON_NUMERIC_CHECK))
        ->with('nulos_diputado',json_encode($nulos_diputado,JSON_NUMERIC_CHECK))
        ->with('blanco_diputado',json_encode($blanco_diputado,JSON_NUMERIC_CHECK))
        ->with('positivo_diputado',json_encode($positivo_diputado,JSON_NUMERIC_CHECK))
        ->with('negativo_diputado',json_encode($negativo_diputado,JSON_NUMERIC_CHECK))
        ->with('user',json_encode($user,JSON_NUMERIC_CHECK));
   


    }

    public function indexDiputadoProvincial()
    {

      
        $userId = Auth::id();
        //  debug($userId);
        if($userId==1){
            $record = DB::table('telegramas')
            ->join('candidatos', 'telegramas.candidato_id', '=', 'candidatos.id')
            ->select('candidatos.*', DB::raw('sum(votos_diputado_prov) as sum'))
            ->groupBy('candidato_id')
            ->orderBy('candidatos.orden', 'Asc')
            ->get();

            $total_padron= DB::table('telegramas')->select('mesa', 'total_padron', 'cantidad_votantes' )
           ->groupBy('mesa')
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
    
            $record = DB::table('telegramas')
            ->join('candidatos', 'telegramas.candidato_id', '=', 'candidatos.id')
            ->select('candidatos.*', DB::raw('sum(votos_diputado_prov) as sum'))
            ->whereIn('telegramas.user_id',$users) 
            ->groupBy('candidato_id')
            ->orderBy('candidatos.orden', 'Asc')
            ->get();
            
            $total_padron= DB::table('telegramas')->select('mesa', 'total_padron', 'cantidad_votantes' )
            ->whereIn('telegramas.user_id',$users) 
            ->groupBy('mesa')->get();

              
          }else{
            // no tiene grupo solo muestro los q el cargo 
            $record = DB::table('telegramas')
            ->join('candidatos', 'telegramas.candidato_id', '=', 'candidatos.id')
            ->select('candidatos.*', DB::raw('sum(votos_diputado_prov) as sum'))
            ->where('telegramas.user_id',$userId) 
            ->groupBy('candidato_id')
            ->orderBy('candidatos.orden', 'Asc')
            ->get();
          
            $total_padron= DB::table('telegramas')->select('mesa', 'total_padron', 'cantidad_votantes' )
             ->where('telegramas.user_id',$userId) 
             ->groupBy('mesa')->get();
           
          
          }
        }

        $total=$total_votantes=0;
        foreach($total_padron as $row) {
            $total_padron_mesa[] =(int) $row->total_padron;
            $total=$total+(int) $row->total_padron;
            $cantidad_votantes_mesa[] =(int) $row->cantidad_votantes;
            $total_votantes=$total_votantes+(int) $row->cantidad_votantes;


            
        }
        $year = $user = [];
       
        $diputado=$data = [];
     
         
        $comando_diputado=  $impugnada_diputado=  $Recurridos_diputado= $comando =$Recurridos=$impugnada=$blanco=0;
        
         $blanco=0;$nulos=0;$negativo=0;$positivo=0;$j=0;
         $blanco_diputado=0;$nulos_diputado=0;$negativo_diputado=0;$positivo_diputado=0;$j=0;
         foreach($record as $row) {

            $titulo=$row->lista;
            $frase=$row->partido;
            //Sin saltos de lineas para dibujar 
            $frase = preg_replace("/[\r\n|\n|\r]+/", " ", $frase);

             if(empty($row->lista))  {

                $frase=$row->partido;
                //Sin saltos de lineas para dibujar 
                $frase = preg_replace("/[\r\n|\n|\r]+/", " ", $frase);


                $array_palabras = explode(' ', $frase);
                 $longitud_array = count($array_palabras);

                  $ultima_palabra = $array_palabras[$longitud_array - 1];
                
                 $titulo=$ultima_palabra; 
                 $j++;
            }

            $data['label'][] =$year[] = $frase;
            $data['data'][] = $user[] =(int) $row->sum;
          
            //1 nulo 5 blancos
            if ($row->id==1 ){
                $nulos= $nulos + (int) $row->sum; 
                $negativo= $negativo+ (int) $row->sum;
            }
            if ($row->id==2 ){
                $Recurridos= $Recurridos  + (int) $row->sum;
            }
            if ($row->id==3 ){
                $impugnada= $impugnada  + (int) $row->sum;               
            }
            if ($row->id==4 ){
                $comando = $comando   + (int) $row->sum; 
            }

            if ($row->id==5){
                $blanco= $blanco + (int) $row->sum;
                $negativo= $negativo+ (int) $row->sum;  
               
            }
            if ($row->id>6){
                
                $positivo= $positivo+ (int) $row->sum;
               
            }


           // $data['label'][] = $row->day_name;
           // $data['data'][] = (int) $row->count;
          }
     
        $data['chart_data'] = json_encode($data);
        
///  CAMBIAR A INDEX EL PDFFFFFFFFFFFFFFFFFFFFF
    	return view('admin.charts.diputado_provincial')
        ->with('year',json_encode($year,JSON_NUMERIC_CHECK))
        ->with('registros',($record))
        ->with('total_padron',json_encode($total,JSON_NUMERIC_CHECK))
        ->with('total_votantes',json_encode($total_votantes,JSON_NUMERIC_CHECK))
       
        ->with('Recurridos',json_encode($Recurridos,JSON_NUMERIC_CHECK))
      
        ->with('impugnada',json_encode($impugnada,JSON_NUMERIC_CHECK))
        
        ->with('comando',json_encode($comando,JSON_NUMERIC_CHECK))
       
        ->with('nulos',json_encode($nulos,JSON_NUMERIC_CHECK))
        ->with('blanco',json_encode($blanco,JSON_NUMERIC_CHECK))
        ->with('positivo',json_encode($positivo,JSON_NUMERIC_CHECK))
        ->with('negativo',json_encode($negativo,JSON_NUMERIC_CHECK))
         ->with('user',json_encode($user,JSON_NUMERIC_CHECK));
   


    }

    public function indexComunal()
    {

      
        $userId = Auth::id();
        //  debug($userId);
        if($userId==1){
            $record = DB::table('telegramas')
            ->join('candidatos', 'telegramas.candidato_id', '=', 'candidatos.id')
            ->select('candidatos.*', DB::raw('sum(votos_comunal) as sum'))
            ->groupBy('candidato_id')
            ->orderBy('candidatos.orden', 'Asc')
            ->get();

            $total_padron= DB::table('telegramas')->select('mesa', 'total_padron', 'cantidad_votantes' )
           ->groupBy('mesa')
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
    
            $record = DB::table('telegramas')
            ->join('candidatos', 'telegramas.candidato_id', '=', 'candidatos.id')
            ->select('candidatos.*', DB::raw('sum(votos_comunal) as sum'))
            ->whereIn('telegramas.user_id',$users) 
            ->groupBy('candidato_id')
            ->orderBy('candidatos.orden', 'Asc')
            ->get();
            $total_padron= DB::table('telegramas')->select('mesa', 'total_padron', 'cantidad_votantes' )
            ->whereIn('telegramas.user_id',$users) 
            ->groupBy('mesa')->get();

              
          }else{
            // no tiene grupo solo muestro los q el cargo 
            $record = DB::table('telegramas')
            ->join('candidatos', 'telegramas.candidato_id', '=', 'candidatos.id')
            ->select('candidatos.*', DB::raw('sum(votos_comunal) as sum'))
            ->where('telegramas.user_id',$userId) 
            ->groupBy('candidato_id')
            ->orderBy('candidatos.orden', 'Asc')
            ->get();
            $total_padron= DB::table('telegramas')->select('mesa', 'total_padron', 'cantidad_votantes' )
             ->where('telegramas.user_id',$userId) 
             ->groupBy('mesa')->get();
           
          
          }
        }

        $total=$total_votantes=0;
        foreach($total_padron as $row) {
            $total_padron_mesa[] =(int) $row->total_padron;
            $total=$total+(int) $row->total_padron;
            $cantidad_votantes_mesa[] =(int) $row->cantidad_votantes;
            $total_votantes=$total_votantes+(int) $row->cantidad_votantes;


            
        }
        $year = $user = [];
        $diputado=$data = [];
     
         
        $comando_diputado=  $impugnada_diputado=  $Recurridos_diputado= $comando =$Recurridos=$impugnada=$blanco=0;
       
         
         $blanco=0;$nulos=0;$negativo=0;$positivo=0;$j=0;
         $blanco_diputado=0;$nulos_diputado=0;$negativo_diputado=0;$positivo_diputado=0;$j=0;
         foreach($record as $row) {

            $titulo=$row->lista;
            $frase=$row->partido;
            //Sin saltos de lineas para dibujar 
            $frase = preg_replace("/[\r\n|\n|\r]+/", " ", $frase);

             if(empty($row->lista))  {

                $frase=$row->partido;
                //Sin saltos de lineas para dibujar 
                $frase = preg_replace("/[\r\n|\n|\r]+/", " ", $frase);


                $array_palabras = explode(' ', $frase);
                 $longitud_array = count($array_palabras);

                  $ultima_palabra = $array_palabras[$longitud_array - 1];
                
                 $titulo=$ultima_palabra; 
                 $j++;
            }

            $data['label'][] =$year[] = $frase;
            $data['data'][] = $user[] =(int) $row->sum;
          
            //1 nulo 5 blancos
            if ($row->id==1 ){
                $nulos= $nulos + (int) $row->sum; 
                $negativo= $negativo+ (int) $row->sum;
            }
            if ($row->id==2 ){
                $Recurridos= $Recurridos  + (int) $row->sum;
            }
            if ($row->id==3 ){
                $impugnada= $impugnada  + (int) $row->sum;               
            }
            if ($row->id==4 ){
                $comando = $comando   + (int) $row->sum; 
            }
            if ($row->id==5){
                $blanco= $blanco + (int) $row->sum;
                $negativo= $negativo+ (int) $row->sum;  
               
            }
            if ($row->id>6){
                
                $positivo= $positivo+ (int) $row->sum;
               
            }


           // $data['label'][] = $row->day_name;
           // $data['data'][] = (int) $row->count;
          }
     
        $data['chart_data'] = json_encode($data);
        
///  CAMBIAR A INDEX EL PDFFFFFFFFFFFFFFFFFFFFF
    	return view('admin.charts.comunal')
        ->with('year',json_encode($year,JSON_NUMERIC_CHECK))
        ->with('registros',($record))
        ->with('total_padron',json_encode($total,JSON_NUMERIC_CHECK))
        ->with('total_votantes',json_encode($total_votantes,JSON_NUMERIC_CHECK))
       
        ->with('Recurridos',json_encode($Recurridos,JSON_NUMERIC_CHECK))
      
        ->with('impugnada',json_encode($impugnada,JSON_NUMERIC_CHECK))
        
        ->with('comando',json_encode($comando,JSON_NUMERIC_CHECK))
       
        ->with('nulos',json_encode($nulos,JSON_NUMERIC_CHECK))
        ->with('blanco',json_encode($blanco,JSON_NUMERIC_CHECK))
        ->with('positivo',json_encode($positivo,JSON_NUMERIC_CHECK))
        ->with('negativo',json_encode($negativo,JSON_NUMERIC_CHECK))
         ->with('user',json_encode($user,JSON_NUMERIC_CHECK));
   


    }

    public function indexConsejal()
    {

      
        $userId = Auth::id();
        //  debug($userId);
        if($userId==1){
            $record = DB::table('telegramas')
            ->join('candidatos', 'telegramas.candidato_id', '=', 'candidatos.id')
            ->select('candidatos.*', DB::raw('sum(votos_consejal) as sum'))
            ->groupBy('candidato_id')
            ->orderBy('candidatos.orden', 'Asc')
            ->get();
            $total_padron= DB::table('telegramas')->select('mesa', 'total_padron', 'cantidad_votantes' )
            ->groupBy('mesa')
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
    
            $record = DB::table('telegramas')
            ->join('candidatos', 'telegramas.candidato_id', '=', 'candidatos.id')
            ->select('candidatos.*', DB::raw('sum(votos_consejal) as sum'))
            ->whereIn('telegramas.user_id',$users) 
            ->groupBy('candidato_id')
            ->orderBy('candidatos.orden', 'Asc')
            ->get();
            $total_padron= DB::table('telegramas')->select('mesa', 'total_padron', 'cantidad_votantes' )
            ->whereIn('telegramas.user_id',$users) 
            ->groupBy('mesa')->get();
              
          }else{
            // no tiene grupo solo muestro los q el cargo 
            $record = DB::table('telegramas')
            ->join('candidatos', 'telegramas.candidato_id', '=', 'candidatos.id')
            ->select('candidatos.*', DB::raw('sum(votos_consejal) as sum'))
            ->where('telegramas.user_id',$userId) 
            ->groupBy('candidato_id')
            ->orderBy('candidatos.orden', 'Asc')
            ->get();
            $total_padron= DB::table('telegramas')->select('mesa', 'total_padron', 'cantidad_votantes' )
            ->where('telegramas.user_id',$userId) 
            ->groupBy('mesa')->get();
          
          }
        }
        $total=$total_votantes=0;
        foreach($total_padron as $row) {
            $total_padron_mesa[] =(int) $row->total_padron;
            $total=$total+(int) $row->total_padron;
            $cantidad_votantes_mesa[] =(int) $row->cantidad_votantes;
            $total_votantes=$total_votantes+(int) $row->cantidad_votantes;
            
        }
        $year = $user = [];
        $diputado=$data = [];
     
        $comando_diputado=  $impugnada_diputado=  $Recurridos_diputado= $comando =$Recurridos=$impugnada=$blanco=0;
         $blanco=0;$nulos=0;$negativo=0;$positivo=0;$j=0;
         $blanco_diputado=0;$nulos_diputado=0;$negativo_diputado=0;$positivo_diputado=0;$j=0;
         foreach($record as $row) {

            $titulo=$row->lista;
            $frase=$row->partido;
            //Sin saltos de lineas para dibujar 
            $frase = preg_replace("/[\r\n|\n|\r]+/", " ", $frase);

             if(empty($row->lista))  {

                $frase=$row->partido;
                //Sin saltos de lineas para dibujar 
                $frase = preg_replace("/[\r\n|\n|\r]+/", " ", $frase);


                $array_palabras = explode(' ', $frase);
                 $longitud_array = count($array_palabras);

                  $ultima_palabra = $array_palabras[$longitud_array - 1];
                
                 $titulo=$ultima_palabra; 
                 $j++;
            }

            $data['label'][] =$year[] = $frase;
            $data['data'][] = $user[] =(int) $row->sum;
          
            //1 nulo 5 blancos
            if ($row->id==1 ){
                $nulos= $nulos + (int) $row->sum; 
                $negativo= $negativo+ (int) $row->sum;
            }
            if ($row->id==2 ){
                $Recurridos= $Recurridos  + (int) $row->sum;
            }
            if ($row->id==3 ){
                $impugnada= $impugnada  + (int) $row->sum;               
            }
            if ($row->id==4 ){
                $comando = $comando   + (int) $row->sum; 
            }
            if ($row->id==5){
                $blanco= $blanco + (int) $row->sum;
                $negativo= $negativo+ (int) $row->sum;  
               
            }
            if ($row->id>6){
                
                $positivo= $positivo+ (int) $row->sum;
               
            }


           // $data['label'][] = $row->day_name;
           // $data['data'][] = (int) $row->count;
          }
     
        $data['chart_data'] = json_encode($data);
        
///  CAMBIAR A INDEX EL PDFFFFFFFFFFFFFFFFFFFFF
    	return view('admin.charts.consejal')
        ->with('year',json_encode($year,JSON_NUMERIC_CHECK))
        ->with('registros',($record))
        ->with('total_padron',json_encode($total,JSON_NUMERIC_CHECK))
        ->with('total_votantes',json_encode($total_votantes,JSON_NUMERIC_CHECK))
       
        ->with('Recurridos',json_encode($Recurridos,JSON_NUMERIC_CHECK))
      
        ->with('impugnada',json_encode($impugnada,JSON_NUMERIC_CHECK))
        
        ->with('comando',json_encode($comando,JSON_NUMERIC_CHECK))
       
        ->with('nulos',json_encode($nulos,JSON_NUMERIC_CHECK))
        ->with('blanco',json_encode($blanco,JSON_NUMERIC_CHECK))
        ->with('positivo',json_encode($positivo,JSON_NUMERIC_CHECK))
        ->with('negativo',json_encode($negativo,JSON_NUMERIC_CHECK))
         ->with('user',json_encode($user,JSON_NUMERIC_CHECK));
   


    }

 
    public function indexIntendente()
    {

      
        $userId = Auth::id();
        //  debug($userId);
        if($userId==1){
            $record = DB::table('telegramas')
            ->join('candidatos', 'telegramas.candidato_id', '=', 'candidatos.id')
            ->select('candidatos.*', DB::raw('sum(votos_intendente) as sum'))
            ->groupBy('candidato_id')
            ->orderBy('candidatos.orden', 'Asc')
            ->get();
            $total_padron= DB::table('telegramas')->select('mesa', 'total_padron', 'cantidad_votantes' )
            ->groupBy('mesa')
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
    
            $record = DB::table('telegramas')
            ->join('candidatos', 'telegramas.candidato_id', '=', 'candidatos.id')
            ->select('candidatos.*', DB::raw('sum(votos_intendente) as sum'))
            ->whereIn('telegramas.user_id',$users) 
            ->groupBy('candidato_id')
            ->orderBy('candidatos.orden', 'Asc')
            ->get();
            $total_padron= DB::table('telegramas')->select('mesa', 'total_padron', 'cantidad_votantes' )
            ->whereIn('telegramas.user_id',$users) 
            ->groupBy('mesa')->get();
          
              
          }else{
            // no tiene grupo solo muestro los q el cargo 
            $record = DB::table('telegramas')
            ->join('candidatos', 'telegramas.candidato_id', '=', 'candidatos.id')
            ->select('candidatos.*', DB::raw('sum(votos_intendente) as sum'))
            ->where('telegramas.user_id',$userId) 
            ->groupBy('candidato_id')
            ->orderBy('candidatos.orden', 'Asc')
            ->get();
            $total_padron= DB::table('telegramas')->select('mesa', 'total_padron', 'cantidad_votantes' )
            ->where('telegramas.user_id',$userId) 
            ->groupBy('mesa')->get();
          
          
          }
        }
        $total=$total_votantes=0;
        foreach($total_padron as $row) {
            $total_padron_mesa[] =(int) $row->total_padron;
            $total=$total+(int) $row->total_padron;
            $cantidad_votantes_mesa[] =(int) $row->cantidad_votantes;
            $total_votantes=$total_votantes+(int) $row->cantidad_votantes;
        }
        $year = $user = [];
        $diputado=$data = [];
     
        $comando_diputado=  $impugnada_diputado=  $Recurridos_diputado= $comando =$Recurridos=$impugnada=$blanco=0;
   
         $blanco=0;$nulos=0;$negativo=0;$positivo=0;$j=0;
         $blanco_diputado=0;$nulos_diputado=0;$negativo_diputado=0;$positivo_diputado=0;$j=0;
         foreach($record as $row) {

            $titulo=$row->lista;
            $frase=$row->partido;
            //Sin saltos de lineas para dibujar 
            $frase = preg_replace("/[\r\n|\n|\r]+/", " ", $frase);

             if(empty($row->lista))  {

                $frase=$row->partido;
                //Sin saltos de lineas para dibujar 
                $frase = preg_replace("/[\r\n|\n|\r]+/", " ", $frase);


                $array_palabras = explode(' ', $frase);
                 $longitud_array = count($array_palabras);

                  $ultima_palabra = $array_palabras[$longitud_array - 1];
                
                 $titulo=$ultima_palabra; 
                 $j++;
            }

            $data['label'][] =$year[] = $frase;
            $data['data'][] = $user[] =(int) $row->sum;
          
            //1 nulo 5 blancos
            if ($row->id==1 ){
                $nulos= $nulos + (int) $row->sum; 
                $negativo= $negativo+ (int) $row->sum;
            }
            if ($row->id==2 ){
                $Recurridos= $Recurridos  + (int) $row->sum;
            }
            if ($row->id==3 ){
                $impugnada= $impugnada  + (int) $row->sum;               
            }
            if ($row->id==4 ){
                $comando = $comando   + (int) $row->sum; 
            }
            if ($row->id==5){
                $blanco= $blanco + (int) $row->sum;
                $negativo= $negativo+ (int) $row->sum;  
               
            }
            if ($row->id>6){
                
                $positivo= $positivo+ (int) $row->sum;
               
            }
        }
     
        $data['chart_data'] = json_encode($data);
        
///  CAMBIAR A INDEX EL PDFFFFFFFFFFFFFFFFFFFFF
    	return view('admin.charts.intendente')
        ->with('year',json_encode($year,JSON_NUMERIC_CHECK))
        ->with('registros',($record))
        ->with('total_padron',json_encode($total,JSON_NUMERIC_CHECK))
        ->with('total_votantes',json_encode($total_votantes,JSON_NUMERIC_CHECK))
       
        ->with('Recurridos',json_encode($Recurridos,JSON_NUMERIC_CHECK))
      
        ->with('impugnada',json_encode($impugnada,JSON_NUMERIC_CHECK))
        
        ->with('comando',json_encode($comando,JSON_NUMERIC_CHECK))
       
        ->with('nulos',json_encode($nulos,JSON_NUMERIC_CHECK))
        ->with('blanco',json_encode($blanco,JSON_NUMERIC_CHECK))
        ->with('positivo',json_encode($positivo,JSON_NUMERIC_CHECK))
        ->with('negativo',json_encode($negativo,JSON_NUMERIC_CHECK))
         ->with('user',json_encode($user,JSON_NUMERIC_CHECK));
   


    }

    public function indexGobernador()
    {

      
        $userId = Auth::id();
        //  debug($userId);
        if($userId==1){
            $record = DB::table('telegramas')
            ->join('candidatos', 'telegramas.candidato_id', '=', 'candidatos.id')
            ->select('candidatos.*', DB::raw('sum(votos_gobernador) as sum'))
            ->groupBy('candidato_id')
            ->orderBy('candidatos.orden', 'Asc')
            ->get();

            $total_padron= DB::table('telegramas')->select('mesa', 'total_padron', 'cantidad_votantes' )
            ->groupBy('mesa')
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
    
            $record = DB::table('telegramas')
            ->join('candidatos', 'telegramas.candidato_id', '=', 'candidatos.id')
            ->select('candidatos.*', DB::raw('sum(votos_gobernador) as sum'))
            ->whereIn('telegramas.user_id',$users) 
            ->groupBy('candidato_id')
            ->orderBy('candidatos.orden', 'Asc')
            ->get();
            $total_padron= DB::table('telegramas')->select('mesa', 'total_padron', 'cantidad_votantes' )
            ->whereIn('telegramas.user_id',$users) 
            ->groupBy('mesa')->get();
                                
          }else{
            // no tiene grupo solo muestro los q el cargo 
            $record = DB::table('telegramas')
            ->join('candidatos', 'telegramas.candidato_id', '=', 'candidatos.id')
            ->select('candidatos.*', DB::raw('sum(votos_gobernador) as sum'))
            ->where('telegramas.user_id',$userId) 
            ->groupBy('candidato_id')
            ->orderBy('candidatos.orden', 'Asc')
            ->get();
          
            $total_padron= DB::table('telegramas')->select('mesa', 'total_padron', 'cantidad_votantes' )
            ->where('telegramas.user_id',$userId) 
            ->groupBy('mesa')->get();
          
          }
        }
        $total=$total_votantes=0;
        foreach($total_padron as $row) {
            $total_padron_mesa[] =(int) $row->total_padron;
            $total=$total+(int) $row->total_padron;
            $cantidad_votantes_mesa[] =(int) $row->cantidad_votantes;
            $total_votantes=$total_votantes+(int) $row->cantidad_votantes;
        }
        $year = $user = [];
        $diputado=$data = [];
     
        $comando_diputado=  $impugnada_diputado=  $Recurridos_diputado= $comando =$Recurridos=$impugnada=$blanco=0;
   
         $blanco=0;$nulos=0;$negativo=0;$positivo=0;$j=0;
         $blanco_diputado=0;$nulos_diputado=0;$negativo_diputado=0;$positivo_diputado=0;$j=0;
         foreach($record as $row) {

            $titulo=$row->lista;
            $frase=$row->partido;
            //Sin saltos de lineas para dibujar 
            $frase = preg_replace("/[\r\n|\n|\r]+/", " ", $frase);

             if(empty($row->lista))  {

                $frase=$row->partido;
                //Sin saltos de lineas para dibujar 
                $frase = preg_replace("/[\r\n|\n|\r]+/", " ", $frase);


                $array_palabras = explode(' ', $frase);
                 $longitud_array = count($array_palabras);

                  $ultima_palabra = $array_palabras[$longitud_array - 1];
                
                 $titulo=$ultima_palabra; 
                 $j++;
            }

            $data['label'][] =$year[] = $frase;
            $data['data'][] = $user[] =(int) $row->sum;
          
            //1 nulo 5 blancos
            if ($row->id==1 ){
                $nulos= $nulos + (int) $row->sum; 
                $negativo= $negativo+ (int) $row->sum;
            }
            if ($row->id==2 ){
                $Recurridos= $Recurridos  + (int) $row->sum;
            }
            if ($row->id==3 ){
                $impugnada= $impugnada  + (int) $row->sum;               
            }
            if ($row->id==4 ){
                $comando = $comando   + (int) $row->sum; 
            }
            if ($row->id==5){
                $blanco= $blanco + (int) $row->sum;
                $negativo= $negativo+ (int) $row->sum;  
               
            }
            if ($row->id>6){
                
                $positivo= $positivo+ (int) $row->sum;
               
            }
        }
     
        $data['chart_data'] = json_encode($data);
        
///  CAMBIAR A INDEX EL PDFFFFFFFFFFFFFFFFFFFFF
    	return view('admin.charts.gobernador')
        ->with('year',json_encode($year,JSON_NUMERIC_CHECK))
        ->with('registros',($record))
        ->with('total_padron',json_encode($total,JSON_NUMERIC_CHECK))
        ->with('total_votantes',json_encode($total_votantes,JSON_NUMERIC_CHECK))
       
        ->with('Recurridos',json_encode($Recurridos,JSON_NUMERIC_CHECK))
      
        ->with('impugnada',json_encode($impugnada,JSON_NUMERIC_CHECK))
        
        ->with('comando',json_encode($comando,JSON_NUMERIC_CHECK))
       
        ->with('nulos',json_encode($nulos,JSON_NUMERIC_CHECK))
        ->with('blanco',json_encode($blanco,JSON_NUMERIC_CHECK))
        ->with('positivo',json_encode($positivo,JSON_NUMERIC_CHECK))
        ->with('negativo',json_encode($negativo,JSON_NUMERIC_CHECK))
         ->with('user',json_encode($user,JSON_NUMERIC_CHECK));
   


    }

    public function indexPresidente()
    {

      
        $userId = Auth::id();
        //  debug($userId);
        if($userId==1){
            $record = DB::table('telegramas')
            ->join('candidatos', 'telegramas.candidato_id', '=', 'candidatos.id')
            ->select('candidatos.*', DB::raw('sum(votos_presidente) as sum'))
            ->groupBy('candidato_id')
            ->orderBy('candidatos.orden', 'Asc')
            ->get();
            $total_padron= DB::table('telegramas')->select('mesa', 'total_padron', 'cantidad_votantes' )
            ->groupBy('mesa')
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
    
            $record = DB::table('telegramas')
            ->join('candidatos', 'telegramas.candidato_id', '=', 'candidatos.id')
            ->select('candidatos.*', DB::raw('sum(votos_presidente) as sum'))
            ->whereIn('telegramas.user_id',$users) 
            ->groupBy('candidato_id')
            ->orderBy('candidatos.orden', 'Asc')
            ->get();
            $total_padron= DB::table('telegramas')->select('mesa', 'total_padron', 'cantidad_votantes' )
            ->whereIn('telegramas.user_id',$users) 
            ->groupBy('mesa')->get();
 
              
          }else{
            // no tiene grupo solo muestro los q el cargo 
            $record = DB::table('telegramas')
            ->join('candidatos', 'telegramas.candidato_id', '=', 'candidatos.id')
            ->select('candidatos.*', DB::raw('sum(votos_presidente) as sum'))
            ->where('telegramas.user_id',$userId) 
            ->groupBy('candidato_id')
            ->orderBy('candidatos.orden', 'Asc')
            ->get();
            $total_padron= DB::table('telegramas')->select('mesa', 'total_padron', 'cantidad_votantes' )
            ->where('telegramas.user_id',$userId) 
            ->groupBy('mesa')->get();
          
          
          }
        }
        $total=$total_votantes=0;
        foreach($total_padron as $row) {
            $total_padron_mesa[] =(int) $row->total_padron;
            $total=$total+(int) $row->total_padron;
            $cantidad_votantes_mesa[] =(int) $row->cantidad_votantes;
            $total_votantes=$total_votantes+(int) $row->cantidad_votantes;
        }
        $year = $user = [];
        $diputado=$data = [];
     
        $comando_diputado=  $impugnada_diputado=  $Recurridos_diputado= $comando =$Recurridos=$impugnada=$blanco=0;
         $blanco=0;$nulos=0;$negativo=0;$positivo=0;$j=0;
         $blanco_diputado=0;$nulos_diputado=0;$negativo_diputado=0;$positivo_diputado=0;$j=0;
         foreach($record as $row) {

            $titulo=$row->lista;
            $frase=$row->partido;
            //Sin saltos de lineas para dibujar 
            $frase = preg_replace("/[\r\n|\n|\r]+/", " ", $frase);

             if(empty($row->lista))  {

                $frase=$row->partido;
                //Sin saltos de lineas para dibujar 
                $frase = preg_replace("/[\r\n|\n|\r]+/", " ", $frase);


                $array_palabras = explode(' ', $frase);
                 $longitud_array = count($array_palabras);

                  $ultima_palabra = $array_palabras[$longitud_array - 1];
                
                 $titulo=$ultima_palabra; 
                 $j++;
            }

            $data['label'][] =$year[] = $frase;
            $data['data'][] = $user[] =(int) $row->sum;
          
            //1 nulo 5 blancos
            if ($row->id==1 ){
                $nulos= $nulos + (int) $row->sum; 
                $negativo= $negativo+ (int) $row->sum;
            }
            if ($row->id==2 ){
                $Recurridos= $Recurridos  + (int) $row->sum;
            }
            if ($row->id==3 ){
                $impugnada= $impugnada  + (int) $row->sum;               
            }
            if ($row->id==4 ){
                $comando = $comando   + (int) $row->sum; 
            }
            if ($row->id==5){
                $blanco= $blanco + (int) $row->sum;
                $negativo= $negativo+ (int) $row->sum;  
               
            }
            if ($row->id>6){
                
                $positivo= $positivo+ (int) $row->sum;
               
            }


           // $data['label'][] = $row->day_name;
           // $data['data'][] = (int) $row->count;
          }
     
        $data['chart_data'] = json_encode($data);
        
///  CAMBIAR A INDEX EL PDFFFFFFFFFFFFFFFFFFFFF
    	return view('admin.charts.presidente')
        ->with('year',json_encode($year,JSON_NUMERIC_CHECK))
        ->with('registros',($record))
        ->with('total_padron',json_encode($total,JSON_NUMERIC_CHECK))
        ->with('total_votantes',json_encode($total_votantes,JSON_NUMERIC_CHECK))
       
        ->with('Recurridos',json_encode($Recurridos,JSON_NUMERIC_CHECK))
      
        ->with('impugnada',json_encode($impugnada,JSON_NUMERIC_CHECK))
        
        ->with('comando',json_encode($comando,JSON_NUMERIC_CHECK))
       
        ->with('nulos',json_encode($nulos,JSON_NUMERIC_CHECK))
        ->with('blanco',json_encode($blanco,JSON_NUMERIC_CHECK))
        ->with('positivo',json_encode($positivo,JSON_NUMERIC_CHECK))
        ->with('negativo',json_encode($negativo,JSON_NUMERIC_CHECK))
         ->with('user',json_encode($user,JSON_NUMERIC_CHECK));
   


    }






/**
 * 
 *    getMesasxProvincia muetra todas las mesaass  de una Provincia 
 */

public function getMesasxProvincia($id)
{
   // debug($id);
    $paises = Pais::get();
    $provincias = Provincia::get();
    $localidades = Localidad::where('id_privincia',$id)-> get();
    $provincia = Provincia::find($id);

    $Nombreprovincia= $pais_id=$provincia_id=0;
    if(!empty($provincia)){
        $Nombreprovincia = $provincia->provincia;
        $provincia_id = $provincia->id;
        $pais_id = $provincia->pais_id;
          
    }
    $year = $user = [];
   
    $escuelas = DB::table('institutes')->where('provincia_id',$id)->orderBy('mdesde', 'Asc');
   



    $mdesde= $mhasta=0;
    if(!empty($escuelas) &&  ($escuelas->count() >0 )){
        $mdesde = $escuelas->min('mdesde');
        $mhasta = $escuelas->max('mhasta');
          
    }

  // debug($mdesde);
  //debug($escuelas);
    $userId = Auth::id();
    //borrrrrrrrrar $userId = 20;

     //  debug($userId);
     if($userId==1){
         $record = DB::table('telegramas')
         ->join('candidatos', 'telegramas.candidato_id', '=', 'candidatos.id')
         ->select('candidatos.*', DB::raw('sum(votos_senador) as sum'), DB::raw('sum(votos_diputado) as votos_diputado'))
         ->where('mesa', '>=',$mdesde)
         ->where('mesa', '<=',$mhasta)
         ->groupBy('candidato_id')
         ->orderBy('candidatos.orden', 'Asc')
         ->get();

        
         $total_padron= DB::table('telegramas')->select('mesa', 'total_padron', 'cantidad_votantes' )
       
             ->groupBy('mesa')
             ->get();
       //  debug ($total_padron);
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
 
         $record = DB::table('telegramas')
         ->join('candidatos', 'telegramas.candidato_id', '=', 'candidatos.id')
         ->select('candidatos.*', DB::raw('sum(votos_senador) as sum'), DB::raw('sum(votos_diputado) as votos_diputado'))
         ->whereIn('telegramas.user_id',$users)
         ->where('mesa', '>=',$mdesde)
         ->where('mesa', '<=',$mhasta) 
         ->groupBy('candidato_id')
         ->orderBy('candidatos.orden', 'Asc')
         ->get();

         $total_padron= DB::table('telegramas')->select('mesa', 'total_padron', 'cantidad_votantes' )
         ->whereIn('telegramas.user_id',$users) 
         ->where('mesa', '>=',$mdesde)
         ->where('mesa', '<=',$mhasta) 
         ->groupBy('mesa')->get();

         
           
       }else{
         // no tiene grupo solo muestro los q el cargo 
         $record = DB::table('telegramas')
         ->join('candidatos', 'telegramas.candidato_id', '=', 'candidatos.id')
         ->select('candidatos.*', DB::raw('sum(votos_senador) as sum'), DB::raw('sum(votos_diputado) as votos_diputado'))
         ->where('telegramas.user_id',$userId) 
         ->where('mesa', '>=',$mdesde)
         ->where('mesa', '<=',$mhasta)
         ->groupBy('candidato_id')
         ->orderBy('candidatos.orden', 'Asc')
         ->get();

         $total_padron= DB::table('telegramas')->select('mesa', 'total_padron', 'cantidad_votantes' )
        ->where('mesa', '>=',$mdesde)
         ->where('mesa', '<=',$mhasta)
        ->where('telegramas.user_id',$userId) 
         ->groupBy('mesa')->get();
       
       }
     }
    
     $total=$total_votantes=0;
     foreach($total_padron as $row) {
         $total_padron_mesa[] =(int) $row->total_padron;
         $total=$total+(int) $row->total_padron;
         $cantidad_votantes_mesa[] =(int) $row->cantidad_votantes;
         $total_votantes=$total_votantes+(int) $row->cantidad_votantes;


         
     }
//debug($record);
if (!empty($record) &&  count ($record)> 0 ){
  
     $data = [];
 
     $comando_diputado=  $impugnada_diputado=  $Recurridos_diputado= $comando =$Recurridos=$impugnada=$blanco=0;
      
     $blanco=0;$nulos=0;$negativo=0;$positivo=0;$j=0;
     $blanco_diputado=0;$nulos_diputado=0;$negativo_diputado=0;$positivo_diputado=0;$j=0;
     foreach($record as $row) {

        $titulo=$row->lista;
        $frase=$row->partido;
        //Sin saltos de lineas para dibujar 
        $frase = preg_replace("/[\r\n|\n|\r]+/", " ", $frase);

         if(empty($row->lista))  {

            $frase=$row->partido;
            //Sin saltos de lineas para dibujar 
            $frase = preg_replace("/[\r\n|\n|\r]+/", " ", $frase);


            $array_palabras = explode(' ', $frase);
             $longitud_array = count($array_palabras);

              $ultima_palabra = $array_palabras[$longitud_array - 1];
            
             $titulo=$ultima_palabra; 
             $j++;
        }

        $data['label'][] =$year[] = $frase;
        $data['data'][] = $user[] =(int) $row->sum;
        $diputado[] =(int) $row->votos_diputado;
        //1 nulo 5 blancos
        if ($row->id==1 ){
            $nulos= $nulos + (int) $row->sum; 
            $negativo= $negativo+ (int) $row->sum;
            $nulos_diputado= $nulos_diputado + (int) $row->votos_diputado; 
            $negativo_diputado= $negativo_diputado+ (int) $row->votos_diputado; 
        }
        if ($row->id==2 ){
            $Recurridos= $Recurridos  + (int) $row->sum;
            $Recurridos_diputado= $Recurridos_diputado + (int) $row->votos_diputado;
     
          
        }
        if ($row->id==3 ){
            $impugnada= $impugnada  + (int) $row->sum; 
            $impugnada_diputado= $impugnada_diputado + (int) $row->votos_diputado;
     
          
        }
        if ($row->id==4 ){
            $comando = $comando   + (int) $row->sum; 
            $comando_diputado= $comando_diputado + (int) $row->votos_diputado;
     
        }
        if ($row->id==5){
            $blanco= $blanco + (int) $row->sum;
            $negativo= $negativo+ (int) $row->sum;  
            $blanco_diputado= $blanco_diputado + (int) $row->votos_diputado;
            $negativo_diputado= $negativo_diputado+ (int) $row->votos_diputado; 
   
        }
        if ($row->id>6){
            
            $positivo= $positivo+ (int) $row->sum;
            $positivo_diputado= $positivo_diputado+ (int) $row->votos_diputado;   
        }


       // $data['label'][] = $row->day_name;
       // $data['data'][] = (int) $row->count;
      }
 
    $data['chart_data'] = json_encode($data);


    return view('admin.charts.getMesasxProvincia')
    ->with('paises',$paises)
    ->with('provincias',$provincias)
    ->with('localidades',$localidades)
    ->with('Nombreprovincia',$Nombreprovincia)
    ->with('provincia_id',$provincia_id)
    ->with('pais_id',$pais_id)
    ->with('registros',($record))
    ->with('total_padron',json_encode($total,JSON_NUMERIC_CHECK))
    ->with('total_votantes',json_encode($total_votantes,JSON_NUMERIC_CHECK))
   
    ->with('Recurridos',json_encode($Recurridos,JSON_NUMERIC_CHECK))
    ->with('Recurridos_diputado',json_encode($Recurridos_diputado,JSON_NUMERIC_CHECK))
   
    ->with('impugnada',json_encode($impugnada,JSON_NUMERIC_CHECK))
    ->with('impugnada_diputado',json_encode($impugnada_diputado,JSON_NUMERIC_CHECK))
   
    ->with('comando',json_encode($comando,JSON_NUMERIC_CHECK))
    ->with('comando_diputado',json_encode($comando_diputado,JSON_NUMERIC_CHECK))
   
    ->with('year',json_encode($year,JSON_NUMERIC_CHECK))
    ->with('diputado',json_encode($diputado,JSON_NUMERIC_CHECK))
    ->with('user2',json_encode($diputado,JSON_NUMERIC_CHECK))
    ->with('nulos',json_encode($nulos,JSON_NUMERIC_CHECK))
    ->with('blanco',json_encode($blanco,JSON_NUMERIC_CHECK))
    ->with('positivo',json_encode($positivo,JSON_NUMERIC_CHECK))
    ->with('negativo',json_encode($negativo,JSON_NUMERIC_CHECK))
    ->with('nulos_diputado',json_encode($nulos_diputado,JSON_NUMERIC_CHECK))
    ->with('blanco_diputado',json_encode($blanco_diputado,JSON_NUMERIC_CHECK))
    ->with('positivo_diputado',json_encode($positivo_diputado,JSON_NUMERIC_CHECK))
    ->with('negativo_diputado',json_encode($negativo_diputado,JSON_NUMERIC_CHECK))
    ->with('user',json_encode($user,JSON_NUMERIC_CHECK));
}else
return back()->with('error',' No registra telegramas  La mesa seleccionada :'.$id.'. Pro favor seleccione otra mesa');

}

/**
 * 
 *    getMesasxLocalidad muetra todas las mesaass  de una Localidad 
 */

public function getMesasxLocalidad($id)
{
    $paises = Pais::get();
    
   
    $escuelas = DB::table('institutes')->where('localidad_id',$id)->orderBy('mdesde', 'Asc');
   

    $Nombreprovincia= $pais_id=$provincia_id=$localidad_id =0;

    $mdesde= $mhasta=0;
    if(!empty($escuelas) &&  ($escuelas->count() >0 )){
        $mdesde = $escuelas->min('mdesde');
        $mhasta = $escuelas->max('mhasta');
        $provincia_id = $escuelas->max('provincia_id');
        $pais_id = $escuelas->max('pais_id');
        $localidades = Localidad::where('id_privincia',$provincia_id)-> get();
        $localidad  = Localidad::find($id);
        $localidad_id =$id;
       if(!empty($localidad)){
        $Nombreprovincia=$localidad->localidad;
        

       }
          
    }
    $provincias = Provincia::get();
  
    $mesas=  $year = $user = [];
      //debug($mdesde);
  // debug($escuela);


   
    $userId = Auth::id();
    if($userId==1){
        $record = DB::table('telegramas')
        ->join('candidatos', 'telegramas.candidato_id', '=', 'candidatos.id')
        ->select('candidatos.*', DB::raw('sum(votos_senador) as sum'), DB::raw('sum(votos_diputado) as votos_diputado'))
        ->where('mesa', '>=',$mdesde)
        ->where('mesa', '<=',$mhasta)
        ->groupBy('candidato_id')
        ->orderBy('candidatos.orden', 'Asc')
        ->get();

       
        $total_padron= DB::table('telegramas')->select('mesa', 'total_padron', 'cantidad_votantes' )
      
            ->groupBy('mesa')
            ->get();
      //  debug ($total_padron);
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

        $record = DB::table('telegramas')
        ->join('candidatos', 'telegramas.candidato_id', '=', 'candidatos.id')
        ->select('candidatos.*', DB::raw('sum(votos_senador) as sum'), DB::raw('sum(votos_diputado) as votos_diputado'))
        ->whereIn('telegramas.user_id',$users)
        ->where('mesa', '>=',$mdesde)
        ->where('mesa', '<=',$mhasta) 
        ->groupBy('candidato_id')
        ->orderBy('candidatos.orden', 'Asc')
        ->get();

        $total_padron= DB::table('telegramas')->select('mesa', 'total_padron', 'cantidad_votantes' )
        ->whereIn('telegramas.user_id',$users) 
        ->where('mesa', '>=',$mdesde)
        ->where('mesa', '<=',$mhasta) 
        ->groupBy('mesa')->get();

        
          
      }else{
        // no tiene grupo solo muestro los q el cargo 
        $record = DB::table('telegramas')
        ->join('candidatos', 'telegramas.candidato_id', '=', 'candidatos.id')
        ->select('candidatos.*', DB::raw('sum(votos_senador) as sum'), DB::raw('sum(votos_diputado) as votos_diputado'))
        ->where('telegramas.user_id',$userId) 
        ->where('mesa', '>=',$mdesde)
        ->where('mesa', '<=',$mhasta)
        ->groupBy('candidato_id')
        ->orderBy('candidatos.orden', 'Asc')
        ->get();

        $total_padron= DB::table('telegramas')->select('mesa', 'total_padron', 'cantidad_votantes' )
       ->where('mesa', '>=',$mdesde)
        ->where('mesa', '<=',$mhasta)
       ->where('telegramas.user_id',$userId) 
        ->groupBy('mesa')->get();
      
      }
    }
   
    $total=$total_votantes=0;
    foreach($total_padron as $row) {
        $total_padron_mesa[] =(int) $row->total_padron;
        $total=$total+(int) $row->total_padron;
        $cantidad_votantes_mesa[] =(int) $row->cantidad_votantes;
        $total_votantes=$total_votantes+(int) $row->cantidad_votantes;


        
    }


//debug($record);
if (!empty($record) &&  count ($record)> 0 ){
  
     $data = [];
 
     
     $comando_diputado=  $impugnada_diputado=  $Recurridos_diputado= $comando =$Recurridos=$impugnada=$blanco=0;
     
     $blanco=0;$nulos=0;$negativo=0;$positivo=0;$j=0;
     $blanco_diputado=0;$nulos_diputado=0;$negativo_diputado=0;$positivo_diputado=0;$j=0;
     foreach($record as $row) {

        $titulo=$row->lista;
        $frase=$row->partido;
        //Sin saltos de lineas para dibujar 
        $frase = preg_replace("/[\r\n|\n|\r]+/", " ", $frase);

         if(empty($row->lista))  {

            $frase=$row->partido;
            //Sin saltos de lineas para dibujar 
            $frase = preg_replace("/[\r\n|\n|\r]+/", " ", $frase);


            $array_palabras = explode(' ', $frase);
             $longitud_array = count($array_palabras);

              $ultima_palabra = $array_palabras[$longitud_array - 1];
            
             $titulo=$ultima_palabra; 
             $j++;
        }

        $data['label'][] =$year[] = $frase;
        $data['data'][] = $user[] =(int) $row->sum;
        $diputado[] =(int) $row->votos_diputado;
        //1 nulo 5 blancos
        if ($row->id==1 ){
            $nulos= $nulos + (int) $row->sum; 
            $negativo= $negativo+ (int) $row->sum;
            $nulos_diputado= $nulos_diputado + (int) $row->votos_diputado; 
            $negativo_diputado= $negativo_diputado+ (int) $row->votos_diputado; 
        }
        if ($row->id==2 ){
            $Recurridos= $Recurridos  + (int) $row->sum;
            $Recurridos_diputado= $Recurridos_diputado + (int) $row->votos_diputado;
     
          
        }
        if ($row->id==3 ){
            $impugnada= $impugnada  + (int) $row->sum; 
            $impugnada_diputado= $impugnada_diputado + (int) $row->votos_diputado;
     
          
        }
        if ($row->id==4 ){
            $comando = $comando   + (int) $row->sum; 
            $comando_diputado= $comando_diputado + (int) $row->votos_diputado;
     
        }
        if ($row->id==5){
            $blanco= $blanco + (int) $row->sum;
            $negativo= $negativo+ (int) $row->sum;  
            $blanco_diputado= $blanco_diputado + (int) $row->votos_diputado;
            $negativo_diputado= $negativo_diputado+ (int) $row->votos_diputado; 
   
        }
        if ($row->id>6){
            
            $positivo= $positivo+ (int) $row->sum;
            $positivo_diputado= $positivo_diputado+ (int) $row->votos_diputado;   
        }


       // $data['label'][] = $row->day_name;
       // $data['data'][] = (int) $row->count;
      }
 
    $data['chart_data'] = json_encode($data);


    return view('admin.charts.getMesasxLocalidad')
    ->with('paises',$paises)
        ->with('provincias',$provincias)
        ->with('localidades',$localidades)
        ->with('Nombreprovincia',$Nombreprovincia)
        ->with('provincia_id',$provincia_id)
        ->with('pais_id',$pais_id)
        ->with('localidad_id',$localidad_id)
        ->with('registros',($record))
        ->with('total_padron',json_encode($total,JSON_NUMERIC_CHECK))
        ->with('total_votantes',json_encode($total_votantes,JSON_NUMERIC_CHECK))
       
        ->with('Recurridos',json_encode($Recurridos,JSON_NUMERIC_CHECK))
        ->with('Recurridos_diputado',json_encode($Recurridos_diputado,JSON_NUMERIC_CHECK))
       
        ->with('impugnada',json_encode($impugnada,JSON_NUMERIC_CHECK))
        ->with('impugnada_diputado',json_encode($impugnada_diputado,JSON_NUMERIC_CHECK))
       
        ->with('comando',json_encode($comando,JSON_NUMERIC_CHECK))
        ->with('comando_diputado',json_encode($comando_diputado,JSON_NUMERIC_CHECK))
       
       
    ->with('year',json_encode($year,JSON_NUMERIC_CHECK))
    ->with('diputado',json_encode($diputado,JSON_NUMERIC_CHECK))
    ->with('user2',json_encode($diputado,JSON_NUMERIC_CHECK))
    ->with('nulos',json_encode($nulos,JSON_NUMERIC_CHECK))
    ->with('blanco',json_encode($blanco,JSON_NUMERIC_CHECK))
    ->with('positivo',json_encode($positivo,JSON_NUMERIC_CHECK))
    ->with('negativo',json_encode($negativo,JSON_NUMERIC_CHECK))
    ->with('nulos_diputado',json_encode($nulos_diputado,JSON_NUMERIC_CHECK))
    ->with('blanco_diputado',json_encode($blanco_diputado,JSON_NUMERIC_CHECK))
    ->with('positivo_diputado',json_encode($positivo_diputado,JSON_NUMERIC_CHECK))
    ->with('negativo_diputado',json_encode($negativo_diputado,JSON_NUMERIC_CHECK))
    ->with('user',json_encode($user,JSON_NUMERIC_CHECK));
}else
return back()->with('error',' No registra telegramas  La mesa seleccionada :'.$id.'. Pro favor seleccione otra mesa');

}


/**
 * 
 * edit muetra todas las mesaass  de una institucion 
 */

    public function edit($id)
    {
        $paises = Pais::get();
        $year = $user = [];
        $escuela  = Institute::find($id);

        $provincias = Provincia::get();
        $escuela_id=  $Nombreprovincia= $pais_id=$provincia_id=$localidad_id =0;
        $mesas=  $year = $user = [];
        $mdesde= $mhasta=0;
        if(!empty($escuela)){
            $mdesde=$escuela->mdesde;
            $mhasta=$escuela->mhasta;
            $escuela_id=   $escuela->id;
            $Nombreprovincia = $escuela->name .' ';
            $localidad_id = $escuela->localidad_id;
            $provincia_id = $escuela->provincia_id;
            $pais_id = $escuela->pais_id;
            $localidades = Localidad::where('id_privincia',$provincia_id)-> get();
            $mdesde= $escuela->mdesde;
            $mhasta= $escuela->mhasta;
            for ($i = $mdesde; $i <=  $mhasta; $i++) {
                $mesas[]= $i;
            }
        }

        $escuelas = Institute::get();

        $userId = Auth::id();
        if($userId==1){
            $record = DB::table('telegramas')
            ->join('candidatos', 'telegramas.candidato_id', '=', 'candidatos.id')
            ->select('candidatos.*', DB::raw('sum(votos_senador) as sum'), DB::raw('sum(votos_diputado) as votos_diputado'))
            ->where('mesa', '>=',$mdesde)
            ->where('mesa', '<=',$mhasta)
            ->groupBy('candidato_id')
            ->orderBy('candidatos.orden', 'Asc')
            ->get();
    
           
            $total_padron= DB::table('telegramas')->select('mesa', 'total_padron', 'cantidad_votantes' )
                 ->where('mesa', '>=',$mdesde)
                 ->where('mesa', '<=',$mhasta)
                ->groupBy('mesa')
                ->get();
          //  debug ($total_padron);
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
    
            $record = DB::table('telegramas')
            ->join('candidatos', 'telegramas.candidato_id', '=', 'candidatos.id')
            ->select('candidatos.*', DB::raw('sum(votos_senador) as sum'), DB::raw('sum(votos_diputado) as votos_diputado'))
            ->whereIn('telegramas.user_id',$users)
            ->where('mesa', '>=',$mdesde)
            ->where('mesa', '<=',$mhasta) 
            ->groupBy('candidato_id')
            ->orderBy('candidatos.orden', 'Asc')
            ->get();
    
            $total_padron= DB::table('telegramas')->select('mesa', 'total_padron', 'cantidad_votantes' )
            ->whereIn('telegramas.user_id',$users) 
            ->where('mesa', '>=',$mdesde)
            ->where('mesa', '<=',$mhasta) 
            ->groupBy('mesa')->get();
    
            
              
          }else{
            // no tiene grupo solo muestro los q el cargo 
            $record = DB::table('telegramas')
            ->join('candidatos', 'telegramas.candidato_id', '=', 'candidatos.id')
            ->select('candidatos.*', DB::raw('sum(votos_senador) as sum'), DB::raw('sum(votos_diputado) as votos_diputado'))
            ->where('telegramas.user_id',$userId) 
            ->where('mesa', '>=',$mdesde)
            ->where('mesa', '<=',$mhasta)
            ->groupBy('candidato_id')
            ->orderBy('candidatos.orden', 'Asc')
            ->get();
    
            $total_padron= DB::table('telegramas')->select('mesa', 'total_padron', 'cantidad_votantes' )
           ->where('mesa', '>=',$mdesde)
            ->where('mesa', '<=',$mhasta)
           ->where('telegramas.user_id',$userId) 
            ->groupBy('mesa')->get();
          
          }
        }
       
        $total=$total_votantes=0;
        foreach($total_padron as $row) {
            $total_padron_mesa[] =(int) $row->total_padron;
            $total=$total+(int) $row->total_padron;
            $cantidad_votantes_mesa[] =(int) $row->cantidad_votantes;
            $total_votantes=$total_votantes+(int) $row->cantidad_votantes;
    
    
            
        }




//debug($record);
if (!empty($record) &&  count ($record)> 0 ){
      
         $data = [];
     
          
      $comando_diputado=  $impugnada_diputado=  $Recurridos_diputado= $comando =$Recurridos=$impugnada=$blanco=0;
    
      $blanco=0;$nulos=0;$negativo=0;$positivo=0;$j=0;
      $blanco_diputado=0;$nulos_diputado=0;$negativo_diputado=0;$positivo_diputado=0;$j=0;
      foreach($record as $row) {

            $titulo=$row->lista;
            $frase=$row->partido;
            //Sin saltos de lineas para dibujar 
            $frase = preg_replace("/[\r\n|\n|\r]+/", " ", $frase);

             if(empty($row->lista))  {

                $frase=$row->partido;
                //Sin saltos de lineas para dibujar 
                $frase = preg_replace("/[\r\n|\n|\r]+/", " ", $frase);


                $array_palabras = explode(' ', $frase);
                 $longitud_array = count($array_palabras);

                  $ultima_palabra = $array_palabras[$longitud_array - 1];
                
                 $titulo=$ultima_palabra; 
                 $j++;
            }

            $data['label'][] =$year[] = $frase;
            $data['data'][] = $user[] =(int) $row->sum;
            $diputado[] =(int) $row->votos_diputado;
            //1 nulo 5 blancos
            if ($row->id==1 ){
                $nulos= $nulos + (int) $row->sum; 
                $negativo= $negativo+ (int) $row->sum;
                $nulos_diputado= $nulos_diputado + (int) $row->votos_diputado; 
                $negativo_diputado= $negativo_diputado+ (int) $row->votos_diputado; 
            }
            if ($row->id==2 ){
                $Recurridos= $Recurridos  + (int) $row->sum;
                $Recurridos_diputado= $Recurridos_diputado + (int) $row->votos_diputado;
         
              
            }
            if ($row->id==3 ){
                $impugnada= $impugnada  + (int) $row->sum; 
                $impugnada_diputado= $impugnada_diputado + (int) $row->votos_diputado;
         
              
            }
            if ($row->id==4 ){
                $comando = $comando   + (int) $row->sum; 
                $comando_diputado= $comando_diputado + (int) $row->votos_diputado;
         
            }
            if ($row->id==5){
                $blanco= $blanco + (int) $row->sum;
                $negativo= $negativo+ (int) $row->sum;  
                $blanco_diputado= $blanco_diputado + (int) $row->votos_diputado;
                $negativo_diputado= $negativo_diputado+ (int) $row->votos_diputado; 
       
            }
            if ($row->id>6){
                
                $positivo= $positivo+ (int) $row->sum;
                $positivo_diputado= $positivo_diputado+ (int) $row->votos_diputado;   
            }


           // $data['label'][] = $row->day_name;
           // $data['data'][] = (int) $row->count;
          }
     
        $data['chart_data'] = json_encode($data);


        return view('admin.charts.edit')
        ->with('paises',$paises)
        ->with('provincias',$provincias)
        ->with('localidades',$localidades)
        ->with('Nombreprovincia',$Nombreprovincia)
        ->with('provincia_id',$provincia_id)
        ->with('pais_id',$pais_id)
        ->with('localidad_id',$localidad_id)
        ->with('escuela_id',$escuela_id)
        ->with('escuelas',$escuelas)
        ->with('mesas',$mesas)
        
        ->with('registros',($record))
        ->with('total_padron',json_encode($total,JSON_NUMERIC_CHECK))
        ->with('total_votantes',json_encode($total_votantes,JSON_NUMERIC_CHECK))
       
        ->with('Recurridos',json_encode($Recurridos,JSON_NUMERIC_CHECK))
        ->with('Recurridos_diputado',json_encode($Recurridos_diputado,JSON_NUMERIC_CHECK))
       
        ->with('impugnada',json_encode($impugnada,JSON_NUMERIC_CHECK))
        ->with('impugnada_diputado',json_encode($impugnada_diputado,JSON_NUMERIC_CHECK))
       
        ->with('comando',json_encode($comando,JSON_NUMERIC_CHECK))
        ->with('comando_diputado',json_encode($comando_diputado,JSON_NUMERIC_CHECK))
       
       
        ->with('year',json_encode($year,JSON_NUMERIC_CHECK))
        ->with('diputado',json_encode($diputado,JSON_NUMERIC_CHECK))
        ->with('user2',json_encode($diputado,JSON_NUMERIC_CHECK))
        ->with('nulos',json_encode($nulos,JSON_NUMERIC_CHECK))
        ->with('blanco',json_encode($blanco,JSON_NUMERIC_CHECK))
        ->with('positivo',json_encode($positivo,JSON_NUMERIC_CHECK))
        ->with('negativo',json_encode($negativo,JSON_NUMERIC_CHECK))
        ->with('nulos_diputado',json_encode($nulos_diputado,JSON_NUMERIC_CHECK))
        ->with('blanco_diputado',json_encode($blanco_diputado,JSON_NUMERIC_CHECK))
        ->with('positivo_diputado',json_encode($positivo_diputado,JSON_NUMERIC_CHECK))
        ->with('negativo_diputado',json_encode($negativo_diputado,JSON_NUMERIC_CHECK))
        ->with('user',json_encode($user,JSON_NUMERIC_CHECK));
    }else
    return back()->with('error',' No registra telegramas  La mesa seleccionada :'.$id.'. Pro favor seleccione otra mesa');

    }



/**
 * 
 * show  muetra Una sola mesaas de una institucion 
 */
    public function show($id)
    {
        $paises = Pais::get();
        $provincias = Provincia::get();
        
        $escuelas = Institute::get();

        $escuela = Institute::query()
           ->where('mdesde', '<=',$id)
           ->where('mhasta', '>=',$id)
           ->first();

           $escuela_id=  $Nombreprovincia= $pais_id=$provincia_id=$localidad_id =0;
           $mesas=  $year = $user = [];
        if(!empty($escuela)){
            $mesa_id=   $id;
            $escuela_id=   $escuela->id;
            $Nombreprovincia = $escuela->name .' Mesa:'.$id;
            $localidad_id = $escuela->localidad_id;
            $provincia_id = $escuela->provincia_id;
            $pais_id = $escuela->pais_id;
            $localidades = Localidad::where('id_privincia',$provincia_id)-> get();
            $mdesde= $escuela->mdesde;
            $mhasta= $escuela->mhasta;
            for ($i = $mdesde; $i <=  $mhasta; $i++) {
                $mesas[]= $i;
            }
            
         }

    
        
     
       
       

        
        $userId = Auth::id();
        if($userId==1){
            $record = DB::table('telegramas')
            ->join('candidatos', 'telegramas.candidato_id', '=', 'candidatos.id')
            ->select('candidatos.*', DB::raw('sum(votos_senador) as sum'), DB::raw('sum(votos_diputado) as votos_diputado'))
            ->where('mesa',$id)
            ->groupBy('candidato_id')
            ->orderBy('candidatos.orden', 'Asc')
            ->get();
    
            $total_padron= DB::table('telegramas')->select('mesa', 'total_padron', 'cantidad_votantes' )
               ->where('mesa',$id)
                ->groupBy('mesa')
                ->get();
          //  debug ($total_padron);
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
    
            $record = DB::table('telegramas')
            ->join('candidatos', 'telegramas.candidato_id', '=', 'candidatos.id')
            ->select('candidatos.*', DB::raw('sum(votos_senador) as sum'), DB::raw('sum(votos_diputado) as votos_diputado'))
            ->whereIn('telegramas.user_id',$users)
            ->where('mesa',$id)
            ->groupBy('candidato_id')
            ->orderBy('candidatos.orden', 'Asc')
            ->get();
    
            $total_padron= DB::table('telegramas')->select('mesa', 'total_padron', 'cantidad_votantes' )
            ->whereIn('telegramas.user_id',$users) 
            ->where('mesa',$id) 
            ->groupBy('mesa')->get();
    
            
              
          }else{
            // no tiene grupo solo muestro los q el cargo 
            $record = DB::table('telegramas')
            ->join('candidatos', 'telegramas.candidato_id', '=', 'candidatos.id')
            ->select('candidatos.*', DB::raw('sum(votos_senador) as sum'), DB::raw('sum(votos_diputado) as votos_diputado'))
            ->where('telegramas.user_id',$userId) 
            ->where('mesa',$id)
            ->groupBy('candidato_id')
            ->orderBy('candidatos.orden', 'Asc')
            ->get();
    
            $total_padron= DB::table('telegramas')->select('mesa', 'total_padron', 'cantidad_votantes' )
            ->where('mesa',$id)
           ->where('telegramas.user_id',$userId) 
            ->groupBy('mesa')->get();
          
          }
        }
       
        $total=$total_votantes=0;
        foreach($total_padron as $row) {
            $total_padron_mesa[] =(int) $row->total_padron;
            $total=$total+(int) $row->total_padron;
            $cantidad_votantes_mesa[] =(int) $row->cantidad_votantes;
            $total_votantes=$total_votantes+(int) $row->cantidad_votantes;
    
    
            
        }


//debug($record);
if (!empty($record) &&  count ($record)> 0 ){
      
         $data = [];
         $comando_diputado=  $impugnada_diputado=  $Recurridos_diputado= $comando =$Recurridos=$impugnada=$blanco=0;
             
         $blanco=0;$nulos=0;$negativo=0;$positivo=0;$j=0;
         $blanco_diputado=0;$nulos_diputado=0;$negativo_diputado=0;$positivo_diputado=0;$j=0;
         foreach($record as $row) {

            $titulo=$row->lista;
            $frase=$row->partido;
            //Sin saltos de lineas para dibujar 
            $frase = preg_replace("/[\r\n|\n|\r]+/", " ", $frase);

             if(empty($row->lista))  {

                $frase=$row->partido;
                //Sin saltos de lineas para dibujar 
                $frase = preg_replace("/[\r\n|\n|\r]+/", " ", $frase);


                $array_palabras = explode(' ', $frase);
                 $longitud_array = count($array_palabras);

                  $ultima_palabra = $array_palabras[$longitud_array - 1];
                
                 $titulo=$ultima_palabra; 
                 $j++;
            }

            $data['label'][] =$year[] = $frase;
            $data['data'][] = $user[] =(int) $row->sum;
            $diputado[] =(int) $row->votos_diputado;
            //1 nulo 5 blancos
            if ($row->id==1 ){
                $nulos= $nulos + (int) $row->sum; 
                $negativo= $negativo+ (int) $row->sum;
                $nulos_diputado= $nulos_diputado + (int) $row->votos_diputado; 
                $negativo_diputado= $negativo_diputado+ (int) $row->votos_diputado; 
            }
            if ($row->id==2 ){
                $Recurridos= $Recurridos  + (int) $row->sum;
                $Recurridos_diputado= $Recurridos_diputado + (int) $row->votos_diputado;
         
              
            }
            if ($row->id==3 ){
                $impugnada= $impugnada  + (int) $row->sum; 
                $impugnada_diputado= $impugnada_diputado + (int) $row->votos_diputado;
         
              
            }
            if ($row->id==4 ){
                $comando = $comando   + (int) $row->sum; 
                $comando_diputado= $comando_diputado + (int) $row->votos_diputado;
         
            }
            if ($row->id==5){
                $blanco= $blanco + (int) $row->sum;
                $negativo= $negativo+ (int) $row->sum;  
                $blanco_diputado= $blanco_diputado + (int) $row->votos_diputado;
                $negativo_diputado= $negativo_diputado+ (int) $row->votos_diputado; 
       
            }
            if ($row->id>6){
                
                $positivo= $positivo+ (int) $row->sum;
                $positivo_diputado= $positivo_diputado+ (int) $row->votos_diputado;   
            }


           // $data['label'][] = $row->day_name;
           // $data['data'][] = (int) $row->count;
          }
     
        $data['chart_data'] = json_encode($data);


        return view('admin.charts.show')
        ->with('paises',$paises)
        ->with('provincias',$provincias)
        ->with('localidades',$localidades)
        ->with('Nombreprovincia',$Nombreprovincia)
        ->with('provincia_id',$provincia_id)
        ->with('pais_id',$pais_id)
        ->with('localidad_id',$localidad_id)
        ->with('escuela_id',$escuela_id)
        ->with('escuelas',$escuelas)
        ->with('mesas',$mesas)
        ->with('mesa_id',$mesa_id)

        ->with('registros',($record))
        ->with('total_padron',json_encode($total,JSON_NUMERIC_CHECK))
        ->with('total_votantes',json_encode($total_votantes,JSON_NUMERIC_CHECK))
       
        ->with('Recurridos',json_encode($Recurridos,JSON_NUMERIC_CHECK))
        ->with('Recurridos_diputado',json_encode($Recurridos_diputado,JSON_NUMERIC_CHECK))
       
        ->with('impugnada',json_encode($impugnada,JSON_NUMERIC_CHECK))
        ->with('impugnada_diputado',json_encode($impugnada_diputado,JSON_NUMERIC_CHECK))
       
        ->with('comando',json_encode($comando,JSON_NUMERIC_CHECK))
        ->with('comando_diputado',json_encode($comando_diputado,JSON_NUMERIC_CHECK))
       

        ->with('year',json_encode($year,JSON_NUMERIC_CHECK))
        ->with('diputado',json_encode($diputado,JSON_NUMERIC_CHECK))
        ->with('user2',json_encode($diputado,JSON_NUMERIC_CHECK))
        ->with('nulos',json_encode($nulos,JSON_NUMERIC_CHECK))
        ->with('blanco',json_encode($blanco,JSON_NUMERIC_CHECK))
        ->with('positivo',json_encode($positivo,JSON_NUMERIC_CHECK))
        ->with('negativo',json_encode($negativo,JSON_NUMERIC_CHECK))
        ->with('nulos_diputado',json_encode($nulos_diputado,JSON_NUMERIC_CHECK))
        ->with('blanco_diputado',json_encode($blanco_diputado,JSON_NUMERIC_CHECK))
        ->with('positivo_diputado',json_encode($positivo_diputado,JSON_NUMERIC_CHECK))
        ->with('negativo_diputado',json_encode($negativo_diputado,JSON_NUMERIC_CHECK))
        ->with('user',json_encode($user,JSON_NUMERIC_CHECK));
    }else
    return back()->with('error',' No registra telegramas  La mesa seleccionada :'.$id.'. Pro favor seleccione otra mesa');

    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $paises = Pais::get();
        $year = $user = [];
        $userId = Auth::id();
       //borrrrrrrrrar $userId = 20;

        //  debug($userId);
if($userId==1){
        $record = DB::table('telegramas')
        ->join('candidatos', 'telegramas.candidato_id', '=', 'candidatos.id')
        ->select('candidatos.*', DB::raw('sum(votos_senador) as sum'), DB::raw('sum(votos_diputado) as votos_diputado'))
        ->groupBy('candidato_id')
        ->orderBy('candidatos.orden', 'Asc')
        ->get();

        $total_padron= DB::table('telegramas')->select('mesa', 'total_padron', 'cantidad_votantes' )
          
        ->groupBy('mesa')
        ->get();
  //  debug ($total_padron);
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

    $record = DB::table('telegramas')
    ->join('candidatos', 'telegramas.candidato_id', '=', 'candidatos.id')
    ->select('candidatos.*', DB::raw('sum(votos_senador) as sum'), DB::raw('sum(votos_diputado) as votos_diputado'))
    ->whereIn('telegramas.user_id',$users) 
    ->groupBy('candidato_id')
    ->orderBy('candidatos.orden', 'Asc')
    ->get();

    $total_padron= DB::table('telegramas')->select('mesa', 'total_padron', 'cantidad_votantes' )
    ->whereIn('telegramas.user_id',$users) 
    ->groupBy('mesa')->get();

    
      
  }else{
    // no tiene grupo solo muestro los q el cargo 
    $record = DB::table('telegramas')
    ->join('candidatos', 'telegramas.candidato_id', '=', 'candidatos.id')
    ->select('candidatos.*', DB::raw('sum(votos_senador) as sum'), DB::raw('sum(votos_diputado) as votos_diputado'))
    ->where('telegramas.user_id',$userId) 
    ->groupBy('candidato_id')
    ->orderBy('candidatos.orden', 'Asc')
    ->get();
    $total_padron= DB::table('telegramas')->select('mesa', 'total_padron', 'cantidad_votantes' )
  
   ->where('telegramas.user_id',$userId) 
    ->groupBy('mesa')->get();
  
  }
}
$total=$total_votantes=0;
foreach($total_padron as $row) {
    $total_padron_mesa[] =(int) $row->total_padron;
    $total=$total+(int) $row->total_padron;
    $cantidad_votantes_mesa[] =(int) $row->cantidad_votantes;
    $total_votantes=$total_votantes+(int) $row->cantidad_votantes;


    
}
//  debug ($cantidad_votantes_mesa);
//   debug ($total_votantes);
$year = $user = [];
       
      
$diputado=$data = [];
     
$comando_diputado=  $impugnada_diputado=  $Recurridos_diputado= $comando =$Recurridos=$impugnada=$blanco=0;
        
         $blanco=0;$nulos=0;$negativo=0;$positivo=0;$j=0;
         $blanco_diputado=0;$nulos_diputado=0;$negativo_diputado=0;$positivo_diputado=0;$j=0;
         foreach($record as $row) {

            $titulo=$row->lista;
            $frase=$row->partido;
            //Sin saltos de lineas para dibujar 
            $frase = preg_replace("/[\r\n|\n|\r]+/", " ", $frase);

             if(empty($row->lista))  {

                $frase=$row->partido;
                //Sin saltos de lineas para dibujar 
                $frase = preg_replace("/[\r\n|\n|\r]+/", " ", $frase);


                $array_palabras = explode(' ', $frase);
                 $longitud_array = count($array_palabras);

                  $ultima_palabra = $array_palabras[$longitud_array - 1];
                
                 $titulo=$ultima_palabra; 
                 $j++;
            }

            $data['label'][] =$year[] = $frase;
            $data['data'][] = $user[] =(int) $row->sum;
            $diputado[] =(int) $row->votos_diputado;
            //1 nulo 5 blancos
            if ($row->id==1 ){
                $nulos= $nulos + (int) $row->sum; 
                $negativo= $negativo+ (int) $row->sum;
                $nulos_diputado= $nulos_diputado + (int) $row->votos_diputado; 
                $negativo_diputado= $negativo_diputado+ (int) $row->votos_diputado; 
            }
            if ($row->id==2 ){
                $Recurridos= $Recurridos  + (int) $row->sum;
                $Recurridos_diputado= $Recurridos_diputado + (int) $row->votos_diputado;
         
              
            }
            if ($row->id==3 ){
                $impugnada= $impugnada  + (int) $row->sum; 
                $impugnada_diputado= $impugnada_diputado + (int) $row->votos_diputado;
         
              
            }
            if ($row->id==4 ){
                $comando = $comando   + (int) $row->sum; 
                $comando_diputado= $comando_diputado + (int) $row->votos_diputado;
         
            }

            if ($row->id==5){
                $blanco= $blanco + (int) $row->sum;
                $negativo= $negativo+ (int) $row->sum;  
                $blanco_diputado= $blanco_diputado + (int) $row->votos_diputado;
                $negativo_diputado= $negativo_diputado+ (int) $row->votos_diputado; 
       
            }
            if ($row->id>6){
                
                $positivo= $positivo+ (int) $row->sum;
                $positivo_diputado= $positivo_diputado+ (int) $row->votos_diputado;   
            }


           // $data['label'][] = $row->day_name;
           // $data['data'][] = (int) $row->count;
          }
     
        $data['chart_data'] = json_encode($data);




//debug($diputado);


        

    	return view('admin.charts.index4')
        ->with('paises',$paises)
        ->with('registros',($record))
        ->with('total_padron',json_encode($total,JSON_NUMERIC_CHECK))
        ->with('total_votantes',json_encode($total_votantes,JSON_NUMERIC_CHECK))
       
        ->with('Recurridos',json_encode($Recurridos,JSON_NUMERIC_CHECK))
        ->with('Recurridos_diputado',json_encode($Recurridos_diputado,JSON_NUMERIC_CHECK))
       
        ->with('impugnada',json_encode($impugnada,JSON_NUMERIC_CHECK))
        ->with('impugnada_diputado',json_encode($impugnada_diputado,JSON_NUMERIC_CHECK))
       
        ->with('comando',json_encode($comando,JSON_NUMERIC_CHECK))
        ->with('comando_diputado',json_encode($comando_diputado,JSON_NUMERIC_CHECK))
       
        ->with('year',json_encode($year,JSON_NUMERIC_CHECK))
        ->with('diputado',json_encode($diputado,JSON_NUMERIC_CHECK))
        ->with('user2',json_encode($diputado,JSON_NUMERIC_CHECK))
        ->with('nulos',json_encode($nulos,JSON_NUMERIC_CHECK))
        ->with('blanco',json_encode($blanco,JSON_NUMERIC_CHECK))
        ->with('positivo',json_encode($positivo,JSON_NUMERIC_CHECK))
        ->with('negativo',json_encode($negativo,JSON_NUMERIC_CHECK))
        ->with('nulos_diputado',json_encode($nulos_diputado,JSON_NUMERIC_CHECK))
        ->with('blanco_diputado',json_encode($blanco_diputado,JSON_NUMERIC_CHECK))
        ->with('positivo_diputado',json_encode($positivo_diputado,JSON_NUMERIC_CHECK))
        ->with('negativo_diputado',json_encode($negativo_diputado,JSON_NUMERIC_CHECK))
        ->with('user',json_encode($user,JSON_NUMERIC_CHECK));
   


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Chart  $chart
     * @return \Illuminate\Http\Response
     */
    public function show23(Chart $chart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Chart  $chart
     * @return \Illuminate\Http\Response
     */
    public function edit23(Chart $chart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Chart  $chart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chart $chart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Chart  $chart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chart $chart)
    {
        //
    }



    

    public function index23()
    {

        $record = DB::table('telegramas')
        ->join('candidatos', 'telegramas.candidato_id', '=', 'candidatos.id')
        ->select('candidatos.*', DB::raw('sum(votos_senador) as sum'), DB::raw('sum(votos_diputado) as votos_diputado'))
        ->groupBy('candidato_id')
        ->orderBy('candidatos.orden', 'Asc')
        ->get();
        //debug($record);

      
         $data = [];
     
         $blanco=0;$nulos=0;$negativo=0;$positivo=0;$j=0;
         foreach($record as $row) {

            $titulo=$row->lista;
            $frase=$row->partido;
            //Sin saltos de lineas para dibujar 
            $frase = preg_replace("/[\r\n|\n|\r]+/", " ", $frase);

             if(empty($row->lista))  {

                $frase=$row->partido;
                //Sin saltos de lineas para dibujar 
                $frase = preg_replace("/[\r\n|\n|\r]+/", " ", $frase);


                $array_palabras = explode(' ', $frase);
                 $longitud_array = count($array_palabras);

                  $ultima_palabra = $array_palabras[$longitud_array - 1];
                
                 $titulo=$ultima_palabra; 
                 $j++;
            }

            $data['label'][] = $frase;
            $data['data'][] = (int) $row->sum;

            //1 nulo 5 blancos
            if ($row->id==1 ){
            }
            if ($row->id==5){
            }
           // $data['label'][] = $row->day_name;
           // $data['data'][] = (int) $row->count;
          }
     
        $data['chart_data'] = json_encode($data);

       // debug($data);
       
        //return view('admin.charts.index3', $data);

        $orders = Telegrama::all();
        
        return view('admin.charts.index3', compact('orders'));

   
    }


     
    public function indexok()
    {

      /**  $record = User::select(\DB::raw("COUNT(*) as count"), \DB::raw("DAYNAME(created_at) as day_name"), \DB::raw("DAY(created_at) as day"))
        ->where('created_at', '>', Carbon::today()->subDay(686))
        ->groupBy('day_name','day')
        ->orderBy('day')
        ->get();
*/
        $record = DB::table('telegramas')
        ->join('candidatos', 'telegramas.candidato_id', '=', 'candidatos.id')
        ->select('candidatos.*', DB::raw('sum(votos_senador) as sum'))
        ->groupBy('candidato_id')
        ->orderBy('candidatos.orden', 'Asc')
        ->get();


      
         $data = [];
     
         $j=0;
         foreach($record as $row) {

            $titulo=$row->lista;
            $frase=$row->partido;
            //Sin saltos de lineas para dibujar 
            $frase = preg_replace("/[\r\n|\n|\r]+/", " ", $frase);

             if(empty($row->lista))  {

                $frase=$row->partido;
                //Sin saltos de lineas para dibujar 
                $frase = preg_replace("/[\r\n|\n|\r]+/", " ", $frase);


                $array_palabras = explode(' ', $frase);
                 $longitud_array = count($array_palabras);

                  $ultima_palabra = $array_palabras[$longitud_array - 1];
                
                 $titulo=$ultima_palabra; 
                 $j++;
            }

            $data['label'][] = $frase;
            $data['data'][] = (int) $row->sum;
           // $data['label'][] = $row->day_name;
           // $data['data'][] = (int) $row->count;
          }
     
        $data['chart_data'] = json_encode($data);

        //debug($data);
        return view('admin.charts.index2', $data);
        

   
    }



}
