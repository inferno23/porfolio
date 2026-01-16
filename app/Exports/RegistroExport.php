<?php

namespace App\Exports;

use App\Models\Registro;
use App\Models\Grupo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\Auth;
use DB;

class RegistroExport  implements FromView
{
    /**
     * 
     * php artisan make:export registroExport --model=registro
     * 
    * @return \Illuminate\Support\Collection
    */
    

    public function view(): View
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
       

        return view('admin.registro.export', [
            'registros' => $registros
            
            
        ]);
    }

}
