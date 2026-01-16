@extends('layouts.backend.app',[
    'title' => 'Grupos de Trabajo - Consulting Group',
    'pageTitle' => 'Grupos de Trabajo',
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
        <a href="{{ route('grupo.create') }}" class="btn btn-primary btn-sm">Nuevo</a>

        
    </div>
    <div class="card-body">
                       
    </div>


    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                                                <th>País</th>
                                                <th>Provincia</th>
                                                <th>Grupo</th>
                        <th>Integrante</th>
                        <th>Administrador</th>
                        <th>Acciones</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($grupos as $model)
                    <tr>
                    <td>
                            
                            <?php    
                            
                            if (!empty($model->user_id)) {
                               if (array_key_exists($model->user->pais_id, $paises)) {
                                echo $paises [$model->user->pais_id];
                                }else
                                echo "Sin Asignar-"   ;
    
                            
                        }else {
                                echo "Sin Asignar"   ;
                            }
                             
                    ?>
    
                            </td>
                            
                    <td>{{ !empty($model->provincia_id) ? $model->user->name:'Sin asignar' }}</td>
                            
                    <td>{{ !empty($model->user_id) ? $model->user->name:'Sin asignar' }}</td>
  
                    
                        <td>{{ !empty($model->user_id) ? $model->user->name:'Sin asignar' }}</td>
  
                        <td>{{ !empty($model->admin_id) ? $model->administrador->name:'Sin asignar' }}</td>
                        
                        <td>
                            <div class="row mx-auto">
                                <form method="POST" action="{{ route('grupo.destroy',$model->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Desea Eliminar del grupo a {{$model->user_id}}  ?')" class="btn btn-danger btn-sm ml-2"><i class="fas fa-trash fa-fw"></i></button>
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