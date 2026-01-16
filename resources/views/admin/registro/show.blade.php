@extends('layouts.backend.app',[
    'title' => 'Fiscales',
    'pageTitle' => 'Fiscales',
])
@section('content')
@include('layouts.components.datatables')
@include('layouts.components.alert-dismissible')
    <div class="row mt-4">
        <div class="col">
            <table width="600">
                <tr>
                    <td>Id</td>
                    <td>{{ $registro->id }}</td>
                </tr>
                <tr>
                    <td>Nombre</td>
                    <td>{{ !empty($registro->persona) ? $registro->persona->nombre:'Sin asignar'  }}</td>
                </tr>
                <tr>
                    <td>Escuela</td>
                    <td>{{  !empty($registro->escuela) ? $registro->escuela->name:'Sin asignar'}}</td>
                </tr>
                <tr>
                    <td>Es fiscal general</td>
                   
                    <td {{ !empty($registro->fiscal_general) ? 'class=btn-success ':'' }}>{{ !empty($registro->fiscal_general) ? 'Es fiscal_general':'' }}</td>
                     


                </tr>
                <tr>
                    <td>Fiscal mesa</td>
                    <td>{{!empty($registro->fiscal_mesa) ? 'Mesa:'.$registro->mesa:''}}</td>
                </tr>

                <tr>
                    <td>Domicilio de contacto</td>
                    <td>{{!empty($registro->domicilio_real) ? ''.$registro->domicilio_real:''}}</td>
                </tr> <tr>
                    <td>Telefono de contacto</td>
                    <td>{{!empty($registro->telefono) ? ''.$registro->telefono:''}}</td>
                </tr>


                <tr>
                    <td>Registrado el</td>
                    <td>{{ date('d-m-Y', strtotime($registro->created_at)) }}</td>
                </tr>
                <tr>
                    <td>Actualizado</td>
                    <td>{{ date('d-m-Y', strtotime($registro->updated_at)) }}</td>
                </tr>
                <tr>
                    <td>Registrado por:</td>
                    <td>{{ $registro->user->name ?? ''}}</td>
                </tr>
            </table>

            <div class="row mx-auto">

<a href="{{ route('admin.registro.listado') }}" class="btn btn-success btn-sm">Listado <i class="fas fa-user fa-fw"></i></a> 
                 
                  
                  
</div>
        </div>
    </div>
@endsection