@extends('layouts.backend.app',[
    'title' => 'Datos ddel padron ',
    'pageTitle' => 'Datos ddel padron - fiscal',
])
@section('content')
@include('layouts.components.datatables')
@include('layouts.components.alert-dismissible')
    <div class="row mt-4">
        <div class="col">
            <table width="600">
                <tr>
                    <td>Nombre</td>
                    <td>{{ $persona->nombre }}</td>
                </tr>
                <tr>
                    <td>Dni</td>
                    <td>{{ $persona->dni }}</td>
                </tr>
               
                <tr>
                    <td>Institucion</td>
                    <td>{{ $persona->institucion }}</td>
                </tr>
                <tr>
                    <td>Domicilio</td>
                    <td>{{ $persona->domicilio }}</td>
                </tr>
                <tr>
                    <td>Mesa</td>
                    <td>{{ $persona->mesa }}</td>
                </tr>
                <tr>
                    <td>Orden</td>
                    <td>{{ $persona->orden }}</td>
                </tr>
                <tr>
                    <td>Creado</td>
                    <td>{{ date('d-m-Y', strtotime($persona->created_at)) }}</td>
                </tr>
                <tr>
                    <td>Actualizado </td>
                    <td>{{ date('d-m-Y', strtotime($persona->updated_at)) }}</td>
                </tr>
                <tr>
                    <td>Registrado por</td>
                    <td>{{ $persona->user->name }}</td>
                </tr>
            </table>
            <br>
            <div class="row mx-auto">

<a href="{{ route('persona.index') }}" class="btn btn-secondary btn-sm">Listado del padron <i class="fas fa-user fa-fw"></i></a> 
                 
                    <a href="{{ route('persona.edit',$persona->id) }}" class="btn btn-primary btn-sm">Editar datos de la persona <i class="fas fa-edit fa-fw"></i></a> 
                 
                    </div>

                    <br>
            <div class="row mx-auto">
                     <a href="{{ route('registro.fiscal',$persona->id) }}" class="btn btn-danger btn-sm">   Asignar como fiscal mesa <i class="fa fa-hand-peace" aria-hidden="true"></i></a>
                                <a href="{{ route('registro.general',$persona->id) }}" class="btn btn-success btn-sm">   Asignar como fiscal general <i class="fa fa-hand-peace" aria-hidden="true"></i></a>
                              
                              
                                <a href="{{ route('registro.create','persona_id='.$persona->id) }}" class="btn btn-primary btn-sm">   Asignar en otra mesa<i class="fa fa-hand-peace" aria-hidden="true"></i></a>
                              
                              
                  
</div>
            <div class="form-group">
                        <div class="col-xs-10 col-sm-10 col-md-10"> 

                        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                       
                    <tr>
                                               
                        <th>Nombre</th>
                        <th>Escuela</th>
                        <th>general</th>
                        <th>Fiscal mesa</th>
                        <th>Registrado por</th>
                    </tr>
                </thead>
                <tbody>
                            
                @foreach($fiscales as $model)
                                 <tr>
                       
                        <td>{{ !empty($model->persona) ? $model->persona->nombre:'Sin asignar' }}</td>
  
                        <td>{{ !empty($model->escuela) ? $model->escuela->name:'Sin asignar' }}</td>
                        <td {{ !empty($model->fiscal_general) ? 'class=btn-success ':'' }}>{{ !empty($model->fiscal_general) ? 'Es fiscal_general':'' }}</td>
                        <td>{{ !empty($model->fiscal_mesa) ? 'Mesa:'.$model->mesa:'' }}</td>
                        <td>{{ $model->user->name }}</td>
                        <tr>
             @endforeach
                        </tbody>
            </table>
                            
                            </div>
            </div>

            
        </div>
    </div>
@endsection