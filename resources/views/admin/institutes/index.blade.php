@extends('layouts.backend.app',[
    'title' => 'Instituciones - Consulting Group',
    'pageTitle' => 'Instituciones',
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
        <a href="{{ route('institutes.create') }}" class="btn btn-primary btn-sm">Nuevo</a>

        <a href="{{ route('institutes.import_excel') }}" class="btn btn-sm btn-success btn-round btn-icon" >
     <i class="fas fa-file-excel"></i> <i class="fa fa-file-excel-o"></i> {{__('Importar Excel')}}
      </a>
    </div>
    


    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                      
                        <th>País</th>
                        <th>Provicia</th>
                        <th>Institución</th>
                        <th>Domicilio</th>
                        <th>Desde</th>
                        <th>Hasta</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($institutes as $user)
                    <tr>

                    
                        <td>
                            
                        <?php    
                        
                        if (!empty($user->pais_id)) {
                           if (array_key_exists($user->pais_id, $paises)) {
                            echo $paises [$user->pais_id];
                            }else
                            echo "Sin Asignar-"   ;

                        
                    }else {
                            echo "Sin Asignar"   ;
                        }
                         
                ?>

                        </td>
                        
                        <td>{{ $user->provincia }}</td>

                        <td>{{ !empty($user->name) ? $user->name:$user->escuela  }}</td>
  
                        
                        <td>{{ $user->domicilio }}</td>
                        <td>{{ $user->mdesde }}</td>
                        <td>{{ $user->mhasta}}</td>
                        <td>
                            <div class="row mx-auto">
                                <a href="{{ route('institutes.edit',$user->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit fa-fw"></i></a>
                                <form method="POST" action="{{ route('institutes.destroy',$user->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Desea Eliminar este registro ?')" class="btn btn-danger btn-sm ml-2"><i class="fas fa-trash fa-fw"></i></button>
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