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
                    <td>Lista</td>
                    <td>{{ $candidato->lista }}</td>
                </tr>
               
                <tr>
                    <td>Partido</td>
                    <td>{{ $candidato->partido }}</td>
                </tr>
                <tr>
                    <td>Presidente</td>
                    <td>{{ $candidato->presidente }}</td>
                </tr>
                <tr>
                    <td>Senador</td>
                    <td>{{ $candidato->senador }}</td>
                </tr>
                <tr>
                    <td>Diputado</td>
                    <td>{{ $candidato->diputado }}</td>
                </tr>
                <tr>
                    <td>Gobernador</td>
                    <td>{{ $candidato->gobernador }}</td>
                </tr>

                <tr>
                    <td>Diputado provincial</td>
                    <td>{{ $candidato->diputado_provincial }}</td>
                </tr>
                <tr>
                    <td>Intendente</td>
                    <td>{{ $candidato->intendente }}</td>
                </tr>

                <tr>
                    <td>Concejal</td>
                    <td>{{ $candidato->concejal }}</td>
                </tr>
                <tr>
                    <td>Delegado Comunal</td>
                    <td>{{ $candidato->municipal }}</td>
                </tr>
                <tr>
                    <td>Orden</td>
                    <td>{{ $candidato->orden }}</td>
                </tr>
                <tr>
                    <td>Creado</td>
                    <td>{{ date('d-m-Y', strtotime($candidato->created_at)) }}</td>
                </tr>
                <tr>
                    <td>Actualizado </td>
                    <td>{{ date('d-m-Y', strtotime($candidato->updated_at)) }}</td>
                </tr>
                <tr>
                    <td>Registrado por</td>
                    <td>{{ $candidato->user->name }}</td>
                </tr>
            </table>

            <div class="row mx-auto">

            <a href="{{ route('candidato.index') }}" class="btn btn-secondary btn-sm">Listado <i class="fas fa-user fa-fw"></i></a> 
                             
                                <a href="{{ route('candidato.edit',$candidato->id) }}" class="btn btn-primary btn-sm">Editar datos <i class="fas fa-edit fa-fw"></i></a> 
                             

                              
                                

     
                              
           </div>
        </div>
    </div>
@endsection