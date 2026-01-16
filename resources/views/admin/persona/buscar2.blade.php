@extends('layouts.backend.app',[
    'title' => 'Asignar Fiscal General - Consulting Group',
    'pageTitle' => 'Buscar Persona para Asignar como Fiscal',
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
    <div class="card-header py-3">Buscar Elector</div>
    <div class="card-body">
    <form id="form1"  method="POST" action="{{ route('persona.buscar2') }}" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label for="dni">DNI</label>
                <div class="col-xs-3 col-sm-3 col-md-3"> 
                <input class="form-control" name="dni" id="dni" type="">
               
                   
                </div>
               
            </div>

           
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-sm">Buscar</button>
            </div>
        </form>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>DNI</th>
                        <th>Nombre y Apellido</th>
                        <th>Institución</th>
                        <th>Domicilio</th>
                        <th>Mesa</th>
                        <th>Orden</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($personas as $model)
                    <tr>
                        <td>{{ $model->dni }}</td>
                        <td>{{ $model->nombre }}</td>
                        <td>{{ $model->institucion }}</td>
                        <td>{{ $model->domicilio }}</td>
                        <td>{{ $model->mesa }}</td>
                        <td>{{ $model->orden}}</td>
                        <td>
                            <div class="row mx-auto">
                                <a href="{{ route('registro.general',$model->id) }}" class="btn btn-primary btn-sm">Asignar como Fiscal General</a>
                                <a href="{{ route('registro.create2','persona_id='.$model->id) }}" class="btn btn-success btn-sm">Asignar en otra Institución</a>
                              
                              
                                
                                

                               
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