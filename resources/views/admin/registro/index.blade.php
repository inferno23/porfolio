@extends('layouts.backend.app',[
    'title' => 'Registro de Fiscales',
    'pageTitle' => 'Registro de Fiscales',
])
@section('content')
@include('layouts.components.datatables')
@include('layouts.components.alert-dismissible')

@if(\Auth::user()->role== 1 ||\Auth::user()->role== 2 || \Auth::user()->role== 4 || \Auth::user()->role== 5 || \Auth::user()->role== 6 || \Auth::user()->role== 7 || \Auth::user()->role== 8)
<div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-light shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-3">
                            <div class="text-lg font-weight-bold text-gray-5 text-uppercase mb-1">
                                Fiscal de Mesa</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-5"> 
                                <a href="{{ route('persona.buscar') }}" class="btn btn-light btn-sm">Asignar Nuevo Fiscal</a>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chalkboard-teacher fa-4x text-gray-5"></i>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-lg font-weight-bold text-primary text-uppercase mb-1">
                        Fiscal de Institución</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-1"> 
                            <a href="{{ route('persona.buscar2') }}" class="btn btn-primary btn-sm">Asignar Nuevo Fiscal</a>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-tie fa-4x text-gray-1"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Agrego Listado -->
    <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-lg font-weight-bold text-danger text-uppercase mb-1">Fiscales Asignados
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-5">
                                    <a href="{{ route('admin.registro.listado') }}" class="btn btn-danger btn-sm">Ver Planilla</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-list fa-4x text-danger"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-lg font-weight-bold text-info text-uppercase mb-1">Carga de Telegrama
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-4">
                                    <a href="{{ route('telegrama.create') }}" class="btn btn-info btn-sm">Telegrama</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-edit fa-4x text-info"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>





    
</div>
@stop