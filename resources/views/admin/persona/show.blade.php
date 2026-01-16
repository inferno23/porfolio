@extends('layouts.backend.app',[
    'title' => 'Consulting Group - Datos del Elector',
    'pageTitle' => 'Datos del Elector',
])
@section('content')
@include('layouts.components.datatables')
@include('layouts.components.alert-dismissible')
    <div class="row mt-4">
        <div class="col">
            <table width="600">
                <tr>
                    <td>Nombre y Apellido</td>
                    <td>{{ $persona->nombre }}</td>
                </tr>
                <tr>
                    <td>DNI</td>
                    <td>{{ $persona->dni }}</td>
                </tr>
               
                <tr>
                    <td>Institución</td>
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
                    <td>N° de Orden</td>
                    <td>{{ $persona->orden }}</td>
                </tr>
                <tr>
                    <td>Creado</td>
                    <td>{{ date('d-m-Y', strtotime($persona->created_at)) }}</td>
                </tr>
                <tr>
                    <td>Actualizado</td>
                    <td>{{ date('d-m-Y', strtotime($persona->updated_at)) }}</td>
                </tr>
                <tr>
                    <td>Registrado por:</td>
                    <td>{{ $persona->user->name }}</td>
                </tr>
            </table>

            <div class="row mx-auto">

            <a href="{{ route('persona.index') }}" class="btn btn-secondary btn-sm">Listado<i class="fas fa-user fa-fw"></i></a> 
                             
                                <a href="{{ route('persona.edit',$persona->id) }}" class="btn btn-primary btn-sm">Editar datos <i class="fas fa-edit fa-fw"></i></a> 
                             

                                <a href="{{ route('registro.create','persona_id='.$persona->id) }}" class="btn btn-success btn-sm">   Asignar como Fiscal en otra Escuela<i class="fa fa-hand-peace" aria-hidden="true"></i></a>
                                <a href="{{ route('registro.fiscal',$persona->id) }}" class="btn btn-warning btn-sm">   Asignar como Fiscal de Mesa <i class="fa fa-hand-peace" aria-hidden="true"></i></a>
                                <a href="{{ route('registro.general',$persona->id) }}" class="btn btn-success btn-sm">   Asignar como Fiscal General <i class="fa fa-hand-peace" aria-hidden="true"></i></a>
                              
                              
                                <a href="{{ route('registro.create','persona_id='.$persona->id) }}" class="btn btn-primary btn-sm">   Asignar Fiscal en otra Mesa<i class="fa fa-hand-peace" aria-hidden="true"></i></a>
                              
                              
                                

     
                              
           </div>
        </div>
    </div>
@endsection