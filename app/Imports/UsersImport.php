<?php

namespace App\Imports;

use App\Models\Institute;
use Maatwebsite\Excel\Concerns\ToModel;

use Maatwebsite\Excel\Concerns\WithHeadingRow;


class UsersImport implements ToModel, WithHeadingRow
{

    private $localidad_id; 
    private $provincia_id; 
    private $pais_id; 


    public function __construct(int $localidad_id,int $provincia_id,int $pais_id) 
    {
       /// debug($localidad_id);
        $this->localidad_id = $localidad_id;

        $this->provincia_id = $provincia_id;
        $this->pais_id = $pais_id;
    }
    /**
     * 
     * php artisan make:export TelegramaExport --model=Telegrama

    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        //debug($this->localidad_id);
        return new Institute([
            'country'  => $row['pais'],
            'name'  =>$row['escuela'],
            'provincia'  => $row['provincia'],
            'seccion'   => $row['seccion'],
            'departamento'   => $row['departamento'],
            'localidad'    => $row['localidad'],
            'localidad_id'  => $this->localidad_id,
            'provincia_id'  => $this->provincia_id,
            'pais_id'  => $this->pais_id,

            'circuito'  => $row['circuito'],
            'escuela'  => $row['escuela'],
           'domicilio'  => $row['domicilio'],
            'mdesde'   => $row['mdesde'],
            'mhasta'   => $row['mhasta'],
            'cant_mes'   => $row['cant_mes']
        ]);
    }
}
