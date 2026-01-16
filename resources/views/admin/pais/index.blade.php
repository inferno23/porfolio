@extends('layouts.backend.app',[
    'title' => 'Geo País - Consulting Group',
    'pageTitle' => 'Geo País',
])
@section('content')
@include('layouts.components.datatables')
@include('layouts.components.alert-dismissible')


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
 
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

  });

    </script>
    
<div class="card shadow mb-4">
<div class="card-header py-3">Geo</div>
</div>  
    
    
<div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            País</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"> 
                     <a href="{{ route('pais.create') }}" class="btn btn-primary btn-sm">Crear Nuevo</a>
                    </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-flag fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        Provincia</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"> 
                        <a href="{{ route('provincia.create') }}" class="btn btn-success btn-sm">Crear Nueva</a>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-map-marker-alt fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Localidad
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                <a href="{{ route('localidad.create') }}" class="btn btn-info btn-sm">Cargar Nueva</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-location-arrow fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>    
    
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                                                <th>id</th>
                        <th>País</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($paises as $model)
                    <tr>
                        <td>{{ $model->id }}</td>
                        <td>{{ $model->paisnombre }}</td>
                        <td>
                            <div class="row mx-auto">
                                <a href="{{ route('pais.edit',$model->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit fa-fw"></i></a>
                                <form method="POST" action="{{ route('pais.destroy',$model) }}">
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