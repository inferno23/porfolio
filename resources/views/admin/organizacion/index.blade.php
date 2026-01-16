@extends('layouts.backend.app',[
    'title' => 'Organizaciones Políticas - Consulting Group',
    'pageTitle' => 'Organizaciones Políticas',
])
@section('content')
@include('layouts.components.datatables')
@include('layouts.components.alert-dismissible')

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>

<script type="text/javascript">
 
        $(document).ready(function () {

                /////dataTable//////////////////////////////////////
                $('#dataTable').DataTable( {
                            
                                
                            language: {
                                "sProcessing":    "Procesando...",
                                "sLengthMenu":    "Mostrar _MENU_ registros",
                                "sZeroRecords":   "No se encontraron resultados",
                                "sEmptyTable":    "Ningún dato disponible en esta tabla",
                                "sInfo":          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                                "sInfoEmpty":     "Mostrando registros del 0 al 0 de un total de 0 registros",
                                "sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
                                "sInfoPostFix":   "",
                                search: "Buscar:",
                                "paginate": {
                                "first": "Primero",
                                "last": "Último",
                                "next": "Siguiente",
                                "previous": "Anterior"
                            },
                            }
                    } );
                    /////////


        });
    </script>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="{{ route('organizacion.create') }}" class="btn btn-primary btn-sm">Nuevo</a>

        <a href="{{ route('organizacion.import_excel') }}" class="btn btn-sm btn-success btn-round btn-icon" >
     <i class="fas fa-file-excel"></i> <i class="fa fa-file-excel-o"></i> {{__('Importar Excel')}}
      </a>
    </div>
    


    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Organización</th>
                        <th>Lista</th>
                        <th>Pais</th>
                        <th>Provincia</th>
                        <th>Localidad</th>
                        <th>Creado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($organizaciones as $model)
                    <tr>
                        <td>{{ $model->organizacion }}</td>
                        <td>{{ $model->lista }}</td>
                        <td>
                        <?php    
                        
                        if (!empty($model->pais_id)) {
                           if (array_key_exists($model->pais_id, $paises)) {
                            echo $paises [$model->pais_id];
                            }else
                            echo "Sin Asignar-"   ;

                        
                    }else {
                            echo "Sin Asignar"   ;
                        }
                         
                ?>
</td>
                        <td>{{ !empty($model->provincia_id) && $model->provincia_id > 0 ? $model->provincias->provincia:'- ' }}</td>
                      
                        <td>{{ !empty($model->localidad_id) && $model->localidad_id > 0 ? $model->localidades->localidad:'- ' }}</td>
                        <td>{{ !empty($model->user_id) && $model->user_id > 0 ? $model->user->name:'- ' }}</td>
                      
                       
                       
                       
                        <td>
                            <div class="row mx-auto">
                                <a href="{{ route('organizacion.edit',$model->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit fa-fw"></i></a>
                                <form method="POST" action="{{ route('organizacion.destroy',$model->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Desea Eliminar este Registro ?')" class="btn btn-danger btn-sm ml-2"><i class="fas fa-trash fa-fw"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop