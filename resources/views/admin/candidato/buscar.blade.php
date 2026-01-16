@extends('layouts.backend.app',[
    'title' => 'Buscar Persona para fiscal',
    'pageTitle' => 'Buscar Persona para fiscal',
])
@section('content')
@include('layouts.components.datatables')
@include('layouts.components.alert-dismissible')
<div class="card shadow mb-4">
    <div class="card-header py-3">
     


    
    </div>
    <div class="card-body">
    <form id="form1"  method="POST" action="{{ route('persona.buscar') }}" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label for="dni">Dni</label>
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
                        <th>Dni</th>
                        <th>Nombre</th>
                        <th>Instituto</th>
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
                                <a href="{{ route('registro.fiscal',$model->id) }}" class="btn btn-warning btn-sm">   Asignar como fiscal mesa <i class="fa fa-hand-peace" aria-hidden="true"></i></a>
                                <a href="{{ route('registro.general',$model->id) }}" class="btn btn-success btn-sm">   Asignar como fiscal general <i class="fa fa-hand-peace" aria-hidden="true"></i></a>
                              
                              
                                <a href="{{ route('registro.create','persona_id='.$model->id) }}" class="btn btn-primary btn-sm">   Asignar en otra mesa<i class="fa fa-hand-peace" aria-hidden="true"></i></a>
                              
                              
                                
                                

                               
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