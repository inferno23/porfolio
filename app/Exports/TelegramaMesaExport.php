<?php

namespace App\Exports;

use App\Models\Telegrama;
use App\Models\Candidato;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use DB;

class TelegramaMesaExport  implements FromView
{
    
        protected $id;

        function __construct($id) {
            $this->id = $id;
        }

    public function view(): View
    {

        $mesa=$this->id;
        


        return view('admin.telegrama.export_mesa', [
            'telegramas' => Telegrama::where('mesa', $mesa)->orderBy('id', 'Asc')->get(),
            'mesa' => $mesa
            
        ]);
    }

}
