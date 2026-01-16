<?php

namespace App\Imports;

use App\Models\Organizacion;
use Maatwebsite\Excel\Concerns\ToModel;

use Maatwebsite\Excel\Concerns\WithHeadingRow;


class OrganizacionesImport implements ToModel, WithHeadingRow
{

    
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        //print_r($row);
        $nombre=$row['organizacion'];
         if(!empty($nombre) ){
        
            return new Organizacion([
                'id'  => null,
               'country'  => $row['pais'],
            'provincia'  => $row['provincia'],
            'localidad'    => $row['localidad'],
              'organizacion'  => $row['organizacion'],
            'ejecutivo_nacional'  => $row['ejecutivo_nacional'],
                'lista'   => $row['n_de_lista'],
                'ejecutivo_provincial'   => $row['ejecutivo_provincial'],
                'ejecutivo_municipal'   => $row['ejecutivo_municipal'],
                'ejecutivo_comunal'   => $row['ejecutivo_comunal'],
                'senador'   => $row['senador'],
                
                'diputado'   => $row['diputado'],
                'concejal'   => $row['concejal']        
            ]);
        }
    }
}
