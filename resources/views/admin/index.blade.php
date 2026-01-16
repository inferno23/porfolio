@extends('layouts.backend.app')
@section('content')

@if(\Auth::user()->role== 1)

    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-usuarios shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-usuarios text-uppercase mb-1">
                                Administradores Generales</div>
                            <div class="h2 mb-0 font-weight-bold text-gray-1">{{ $users }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-tie fa-4x text-gray-1"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-rol3 shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-rol3 text-uppercase mb-1">Cursos Activos
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h2 mb-0 mr-3 font-weight-bold text-gray-3">{{ $skills }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-marker fa-4x text-gray-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
    
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-rol5 shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-gray-5 text-uppercase mb-1">
                                Obras en Cartelera</div>
                            <div class="h2 mb-0 font-weight-bold text-gray-5">{{ $bronce }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-award fa-4x text-gray-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>



           


        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-rol12 shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-gray-12 text-uppercase mb-1">
                                Usuarios Comunes</div>
                            <div class="h2 mb-0 font-weight-bold text-gray-12">{{ $diamante }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-gem fa-4x text-gray-12"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>
    
@endif

        



@stop