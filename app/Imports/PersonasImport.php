<?php

namespace App\Imports;

use App\Models\Persona;
use Maatwebsite\Excel\Concerns\ToModel;

use Maatwebsite\Excel\Concerns\WithHeadingRow;


class PersonasImport implements ToModel, WithHeadingRow
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
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
       // print_r($row);
        $nombre=$row['nombre_y_apellido'];
         if(!empty($nombre) ){
        
            return new Persona([
                'dni'  => $row['dni'],
                'nombre'  =>$row['nombre_y_apellido'],
                'institucion'  => $row['institucion'],
                'localidad_id'  => $this->localidad_id,
                'provincia_id'  => $this->provincia_id,
                'pais_id'  => $this->pais_id,
                'domicilio'  => $row['domicilio'],
                'mesa'   => $row['mesa'],
            'orden'   => $row['n_de_orden']
            ]);
        }
    }
}
