@extends('layouts.backend.app',[
	'title' => 'Crear Usuario - Consulting Group',
	'pageTitle' => 'Crear Usuario',
])
@section('content')
@include('layouts.components.datatables')
@include('layouts.components.alert-dismissible')
<div class="card shadow mb-4">
    <div class="card-header py-3">
    	<a href="{{ route('user.index') }}" class="btn btn-danger btn-sm">Listado de usuarios</a>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('user.store') }}">
            @csrf
            <div class="form-group">
            <div class="col-xs-6 col-sm-6 col-md-6"> 
                <label for="name">Nombre y Apellido</label>
                <input required class="form-control @error('name') is-invalid @enderror" type="" name="name" id="name">
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            </div>

            <div class="form-group">
            <div class="col-xs-6 col-sm-6 col-md-6"> 
                <label for="email">Email</label>
                <input required class="form-control @error('email') is-invalid @enderror" type="email" name="email" id="email">
                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            </div>
            <div class="form-group">
            <div class="col-xs-6 col-sm-6 col-md-6"> 
                <label for="password">Clave de Acceso</label>
                <input required class="form-control @error('password') is-invalid @enderror" type="password" name="password" id="password">
                @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            </div>
            
            
            
            

            <div class="form-group">
            <div class="col-xs-6 col-sm-6 col-md-6"> 
                <label for="name">Cargo</label>
                <input required class="form-control @error('cargo') is-invalid @enderror" type="" name="cargo" id="cargo">
                @error('cargo')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            </div>
            
            <div class="form-group">
            <div class="col-xs-6 col-sm-6 col-md-6"> 
                <label for="celular">N° de Celular</label>
                <input class="form-control @error('celular') is-invalid @enderror" type="" name="celular" id="celular">
                @error('celular')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            </div>
            
            
           
           
            
           

            <div class="form-group">
            <div class="col-xs-6 col-sm-6 col-md-6"> 
            <label for="name">Estado</label>
            <select class="form-control" name="is_active" id="is_active">
            
            <option value="1">Activo</option>
            <option value="0">Inactivo</option>
            </select>
            </div>
            </div>
            
         
            <div class="form-group">
                <button class="btn btn-primary btn-sm">Crear usuario</button>
            </div>
        </form>
    </div>
</div>
@stop