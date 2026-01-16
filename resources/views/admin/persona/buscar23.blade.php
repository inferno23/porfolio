@extends('layouts.backend.app',[
    'title' => 'Datos',
    'pageTitle' => 'Datos',
])
@section('content')
@include('layouts.components.datatables')
@include('layouts.components.alert-dismissible')
    <div class="row mt-4">
        <div class="col">
            <table width="600">
                <tr>
                    <td>nombre</td>
                    <td>{{ $persona->nombre }}</td>
                </tr>
                <tr>
                    <td>dni</td>
                    <td>{{ $persona->dni }}</td>
                </tr>
               
                <tr>
                    <td>institucion</td>
                    <td>{{ $persona->institucion }}</td>
                </tr>
                <tr>
                    <td>domicilio</td>
                    <td>{{ $persona->domicilio }}</td>
                </tr>
                <tr>
                    <td>mesa</td>
                    <td>{{ $persona->mesa }}</td>
                </tr>
                <tr>
                    <td>orden</td>
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

            <div class="row mx-auto">

            <a href="{{ route('persona.index') }}" class="btn btn-secondary btn-sm">Listado <i class="fas fa-user fa-fw"></i></a> 
                             
                                <a href="{{ route('persona.edit',$persona->id) }}" class="btn btn-primary btn-sm">Editar datos <i class="fas fa-edit fa-fw"></i></a> 
                             
                                <a href="{{ route('registro.create','persona_id='.$persona->id) }}" class="btn btn-success btn-sm">   Asignar como fiscal <i class="fa fa-hand-peace" aria-hidden="true"></i></a>
                             
                              
           </div>
        </div>
    </div>
@endsection