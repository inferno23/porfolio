<?php

namespace App\Exports;

use App\Models\Telegrama;
use App\Models\Grupo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\Auth;
use DB;

class TelegramaExport  implements FromView
{
    /**
     * 
     * php artisan make:export TelegramaExport --model=Telegrama
     * 
    * @return \Illuminate\Support\Collection
    */
    

    public function view(): View
    {
        $userId = Auth::id();
        //  debug($userId);
          if($userId==1){
            $telegramas = Telegrama::orderBy('mesa', 'Asc')->get();
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
  
          $telegramas = Telegrama::whereIn('user_id',$users)->orderBy('mesa', 'Asc')   
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
            $telegramas = Telegrama::where('user_id',$userId)->orderBy('mesa', 'Asc')
          
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
        }
       

        return view('admin.telegrama.export', [
            'telegramas' => $telegramas,
            'votos_senador' => $votos_senador
            
        ]);
    }

}
