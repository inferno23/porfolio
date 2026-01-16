<?php

namespace App\Http\Controllers\Admin;

use App\Models\Registro;
use App\Models\Grupo;
use App\Models\Institute;
use App\Models\Persona;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegistroRequest;
use Illuminate\Support\Facades\Auth;
/// excel insert
use DB;
//use Excel;
use App\Imports\PersonasImport;
use App\Exports\RegistroExport;
use Maatwebsite\Excel\Facades\Excel;

class RegistroController extends Controller
{

    public function export(){
        $hoy=date("d-m-Y H");
        $nombre='Fiscales '.$hoy;
        return Excel::download(new RegistroExport, $nombre.'.xlsx');
    }

    public function listado()
    {
        $userId = Auth::id();
      //  debug($userId);
        if($userId==1){
        $registros = Registro::get();
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

        $registros = Registro::whereIn('user_id',$users)
        
        ->get();

      }else{
          // no tiene grupo solo muestro los q el cargo 
          $registros = Registro::where('user_id',$userId)
        
          ->get();
        
       }
       // $registros = Registro::get();

    }

      
        return view('admin.registro.index2', compact('registros'));
    }

    public function general($id)
    {
        $persona  = Persona::find($id);
       if(!empty($persona)){
            $mesa = $persona->mesa;
           $institucion = Institute::query()
           ->where('mdesde', '<=',$mesa)
           ->where('mhasta', '>=',$mesa)
           ->first();
           //debug($institucion);
           $personaDuplicado2 = Registro::query()
           ->where('persona_id',  $persona ->id)
           
           ->first();
       if(!empty($personaDuplicado2) && $personaDuplicado2->count() > 0){
           //  print_r($registroDuplicado2);
           if (!empty($personaDuplicado2->fiscal_mesa))
              return back()->with('error','La persona seleccionada ya es Fiscal en mesa:'.$personaDuplicado2->mesa. '- '.$persona ->nombre);
          else
          return back()->with('error','La persona seleccionada ya es Fiscal General:'. '- '.$persona ->nombre);
         
           
       }
       if(!empty($institucion)){
                    $registroDuplicado2 = Registro::query()
                    ->where('institucion_id',  $institucion ->id)
                    ->where('fiscal_general', 1)
                    
                    ->first();
                if(!empty($registroDuplicado2) && $registroDuplicado2->count() > 0){
                    //  print_r($registroDuplicado2);
                    return back()->with('error','La Institución seleccionada ya registra un Fiscal General:');
                    //return view('admin.registro.create');
                    
                }

                $model = new Registro;
                $model->mesa = 0;
                $model->persona_id = $persona->id;
                $model->institucion_id = $institucion->id;
                $model->fiscal_mesa = 0;
                $model->fiscal_general = 1;
                $model->descripcion = 'Fiscal de General';
                $model->user_id = Auth::id();
                $model->save();


            }

        }
               
        return redirect()->route('registro.index')->with('success','Registro Creado.');

        
    }





    public function fiscal($id)
    {
        $persona  = Persona::find($id);
       if(!empty($persona)){
            $mesa = $persona->mesa;
           $institucion = Institute::query()
           ->where('mdesde', '<=',$mesa)
           ->where('mhasta', '>=',$mesa)
           ->first();
           //debug($institucion);
           $personaDuplicado2 = Registro::query()
           ->where('persona_id',  $persona ->id)
           
           ->first();
       if(!empty($personaDuplicado2) && $personaDuplicado2->count() > 0){
           //  print_r($registroDuplicado2);
           return back()->with('error','La persona seleccionada ya es Fiscal en mesa:'.$personaDuplicado2->mesa. '- '.$persona ->nombre);
           //return view('admin.registro.create');
           
       }
       if(!empty($institucion)){
                    $registroDuplicado2 = Registro::query()
                    ->where('institucion_id',  $institucion ->id)
                    ->where('fiscal_mesa', 1)
                    ->where('mesa',  $mesa)
                    ->first();
                if(!empty($registroDuplicado2) && $registroDuplicado2->count() > 0){
                    //  print_r($registroDuplicado2);
                    return back()->with('error','La mesa seleccionada ya registra un Fiscal en esa mesa:'.$mesa);
                    //return view('admin.registro.create');
                    
                }

                $model = new Registro;
                $model->mesa = $mesa;
                $model->persona_id = $persona->id;
                $model->institucion_id = $institucion->id;
                $model->fiscal_mesa = 1;
                $model->fiscal_general = 0;
                $model->descripcion = 'Fiscal de Mesa';
                $model->user_id = Auth::id();
                $model->save();


            }

        }
               
        return redirect()->route('registro.index')->with('success','Registro Creado');

        
    }
// $id mesa de la escuela
    public function getMesasxEscuela($id)
    {
        $escuela  = Institute::find($id);
       if(!empty($escuela)){
        $mdesde=$escuela->mdesde;
        $mhasta=$escuela->mhasta;
        $cant_mes=$escuela->cant_mes;

       }
        $mesasOcupadas = Registro::where('institucion_id',$id)->get();
       // debug($mesasOcupadas);
        $data=array();
        if(!empty($mdesde) && !empty($mhasta) ){
            for ($i = $mdesde; $i <= $mhasta; $i++) {
                             
                 $data[]=$i;
            }
           // debug($data);
        }
        if(!empty($mesasOcupadas)){
            foreach($mesasOcupadas as $model){
                $sacarmesaocupada= $model->mesa;
              //  print_r($sacarmesaocupada);
                //debug($model);
                //unset($data[$sacarmesaocupada]);
                if (($clave = array_search($sacarmesaocupada, $data)) !== false) {
                    //unset($data[$clave]);
                    if(!empty($model->persona) )
                     $data[$clave]=$sacarmesaocupada.' mesa con fiscal:'.$model->persona->nombre;
                    else
                    $data[$clave]=$sacarmesaocupada.' mesa con fiscal id:'.$model->persona_id;
                    
   
                }
            }
           // print_r($mesasOcupadas);
            
        }
       
       // print_r($data);
        return response()->json(['data' => $data]);

        //return view('admin.localidad.index', compact('data'));
    }

   
    
    public function index()
    {
        $userId = Auth::id();
      //  debug($userId);
        if($userId==1){
        $registros = Registro::get();
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

        $registros = Registro::whereIn('user_id',$users)
        
        ->get();

      }else{
          // no tiene grupo solo muestro los q el cargo 
          $registros = Registro::where('user_id',$userId)
        
          ->get();
        
       }
       // $registros = Registro::get();

    }

      
        return view('admin.registro.index', compact('registros'));
    }

    public function create(Request $request )
    {

       // var_dump(request->ref);
       $data=array();
        $persona_id = $request->persona_id;
       // print_r($persona_id);
        $persona  = Persona::find($persona_id);
       // print_r($persona);
        $instituciones = Institute::get();
        //if( $persona->mesa >= $model->mdesde  && $persona->mesa <= $model->mhasta) 
        $mesa = $persona->mesa;
       //debug($persona->mesa);
        if(!empty($mesa)){
           $escuela = Institute::query()
           ->where('mdesde', '<=',$mesa)
           ->where('mhasta', '>=',$mesa)
           ->first();
           //debug($institucion);
   
           $fiscales = array();
           


        if(!empty($escuela)){
         $id=   $escuela->id;
         $mdesde=$escuela->mdesde;
         $mhasta=$escuela->mhasta;
         $cant_mes=$escuela->cant_mes;
 
        }
         $mesasOcupadas = Registro::where('institucion_id',$id)->get();
        // debug($mesasOcupadas);
        
         if(!empty($mdesde) && !empty($mhasta) ){
             for ($i = $mdesde; $i <= $mhasta; $i++) {
                              
                  $data[]=$i;
             }
             //debug($data);
         }
         if(!empty($mesasOcupadas)){
             foreach($mesasOcupadas as $model){
                 $sacarmesaocupada= $model->mesa;
                 $fiscal_general= $model->fiscal_general;

                    if(!empty($fiscal_general)){
                        if(!empty($model->persona) )
                        array_push($data, "FISCAL GENERAL ".$model->persona->nombre);
                     else             
                     
                        array_push($data, "FISCAL GENERAL ".$model->persona_id);

                    }

                 if (($clave = array_search($sacarmesaocupada, $data)) !== false) {
                     //unset($data[$clave]);


                     if(!empty($model->persona) )
                      $data[$clave]=$sacarmesaocupada.' Fiscal:'.$model->persona->nombre;
                     else
                     $data[$clave]=$sacarmesaocupada.' Fiscal id:'.$model->persona_id;
                     
    
                 }
             }
            // print_r($mesasOcupadas);
             
         }
         // debug($data);
        }//if si  hay mesa
        return view('admin.registro.create', compact('instituciones','persona', 'data'));
    }
    
    
    
    
    
    
    public function create2(Request $request )
    {

       // var_dump(request->ref);
       $data=array();
        $persona_id = $request->persona_id;
       // print_r($persona_id);
        $persona  = Persona::find($persona_id);
       // print_r($persona);
        $instituciones = Institute::get();
        //if( $persona->mesa >= $model->mdesde  && $persona->mesa <= $model->mhasta) 
        $mesa = $persona->mesa;
       //debug($persona->mesa);
        if(!empty($mesa)){
           $escuela = Institute::query()
           ->where('mdesde', '<=',$mesa)
           ->where('mhasta', '>=',$mesa)
           ->first();
           //debug($institucion);
   
           $fiscales = array();
           


        if(!empty($escuela)){
         $id=   $escuela->id;
         $mdesde=$escuela->mdesde;
         $mhasta=$escuela->mhasta;
         $cant_mes=$escuela->cant_mes;
 
        }
         $mesasOcupadas = Registro::where('institucion_id',$id)->get();
        // debug($mesasOcupadas);
        
         if(!empty($mdesde) && !empty($mhasta) ){
             for ($i = $mdesde; $i <= $mhasta; $i++) {
                              
                  $data[]=$i;
             }
             //debug($data);
         }
         if(!empty($mesasOcupadas)){
             foreach($mesasOcupadas as $model){
                 $sacarmesaocupada= $model->mesa;
                 $fiscal_general= $model->fiscal_general;

                    if(!empty($fiscal_general)){
                        if(!empty($model->persona) )
                        array_push($data, "FISCAL GENERAL ".$model->persona->nombre);
                     else             
                     
                        array_push($data, "FISCAL GENERAL ".$model->persona_id);

                    }

                 if (($clave = array_search($sacarmesaocupada, $data)) !== false) {
                     //unset($data[$clave]);


                     if(!empty($model->persona) )
                      $data[$clave]=$sacarmesaocupada.' Fiscal:'.$model->persona->nombre;
                     else
                     $data[$clave]=$sacarmesaocupada.' Fiscal id:'.$model->persona_id;
                     
    
                 }
             }
            // print_r($mesasOcupadas);
             
         }
         // debug($data);
        }//if si  hay mesa
        return view('admin.registro.create2', compact('instituciones','persona', 'data'));
    }
    
    
    
    
    
    
    

    public function store(RegistroRequest $request)
    {
      
         $persona_id = $request->persona_id;
         $fiscal_general = $request->fiscal_general;
         $fiscal_mesa = $request->fiscal_mesa;
         $mesa = $request->mesa;
         $institucion_id = $request->institucion_id;
         /// hay un fiscal general en esa escuela
    if(!empty($fiscal_general)){
         $registroDuplicado = Registro::query()
         ->where('institucion_id', $institucion_id)
         ->where('fiscal_general', 1)
         ->first();
         if(!empty($registroDuplicado) && $registroDuplicado->count() > 0){
          //  print_r($registroDuplicado);
            return back()->with('error','La Institución seleccionada ya registra un Fiscal General');
    
            
        }
    }

    if(!empty($fiscal_mesa)){
        
        $registroDuplicado2 = Registro::query()
        ->where('institucion_id', $institucion_id)
        ->where('fiscal_mesa', 1)
        ->where('mesa',  $mesa)
        ->first();
        if(!empty($registroDuplicado2) && $registroDuplicado2->count() > 0){
          //  print_r($registroDuplicado2);
           return back()->with('error','La mesa seleccionada ya registra un Fiscal de Mesa'.$mesa);
          //return view('admin.registro.create');
           
       }
   }


        registro::create($request->all());
        return redirect()->route('registro.index')->with('success','Registro Creado');

        
    }

    public function show(Registro $registro)
    {
        return view('admin.registro.show', compact('registro'));
    }

    public function edit(registro $registro)
    {

         $instituciones = Institute::get();
         
        return view('admin.registro.edit', compact('instituciones','registro'));
    }

    public function update(Request $request, registro $registro)
    {
        $this->validate($request, [
            'persona_id' => 'required|max:20',
            'institucion_id' => 'required',
            
        ]);

        $registro->update($request->all());
        return redirect()->route('registro.index')->with('success','Registro Actualizado');
    
    }

    public function destroy(registro $registro)
    {
        $registro->delete();
        return redirect()->route('registro.index')->with('success','Registro Eliminado');
    }
}
