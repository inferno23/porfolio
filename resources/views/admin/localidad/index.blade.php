@extends('layouts.backend.app',[
    'title' => 'Geo Localidad - Consulting Group',
    'pageTitle' => 'Geo Localidad',
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
    <div class="card-header py-3">Geo Localidad</div>
    <div class="card-body">
        <a href="{{ route('localidad.create') }}" class="btn btn-primary btn-sm">Nueva Localidad</a>
        <a href="{{ route('pais.index') }}" class="btn btn-secondary btn-sm">Volver a Geo</a>
    </div>
    
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Localidad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($localidads as $model)
                    <tr>
                        <td>{{ $model->id }}</td>
                        <td>{{ $model->localidad }}</td>
                        <td>
                            <div class="row mx-auto">
                                <a href="{{ route('localidad.edit',$model->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit fa-fw"></i></a>
                                <form method="POST" action="{{ route('localidad.destroy',$model->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Desea Eliminar este registro {{ $model->nombre }}  ?')" class="btn btn-danger btn-sm ml-2"><i class="fas fa-trash fa-fw"></i></button>
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