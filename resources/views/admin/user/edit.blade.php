@extends('layouts.backend.app',[
	'title' => 'Modificar Usuario - Consulting Group',
	'pageTitle' => 'Modificar Usuario',
])
@section('content')
@include('layouts.components.datatables')
@include('layouts.components.alert-dismissible')
<div class="card shadow mb-4">
    <div class="card-header py-3">
    	<a href="{{ route('user.index') }}" class="btn btn-danger btn-sm">Listado</a>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('user.update',$user->id) }}">
            @csrf
            @method('PATCH')
            <div class="form-group">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <label for="name">Nombre y Apellido</label>
                <input required value="{{ $user->name }}" class="form-control @error('name') is-invalid @enderror" type="" name="name" id="name">
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>


            <div class="form-group">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <label for="name">Email</label>
                <input required value="{{ $user->email }}" class="form-control @error('email') is-invalid @enderror" type="" name="email" id="email">
                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <label for="password">Clave de Acceso</label>
                <input  class="form-control @error('password') is-invalid @enderror" type="password" name="password" id="password">
                <small class="text-danger">Deje el campo vacío si no desea cambiar la clave</small>
                @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            </div>
            
            <div class="form-group">
            <div class="col-xs-6 col-sm-6 col-md-6"> 
            <label for="name">Rol</label>
            <select required class="form-control" name="role" id="role">
                <option value="1"  <?php if( $user->role == 1) echo "selected"; else echo "mm"; ?>>Administrador General</option>
                <option value="2" <?php if( $user->role == 2) echo "selected"; else echo "mm"; ?>>Administrativo Comun</option>
                    </select>
            </div>
            </div>

            <div class="mb-3">
           
            </div>


           
            
            <div class="form-group">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <label for="celular">N° de Celular</label>
                <input required value="{{ $user->celular }}" class="form-control @error('celular') is-invalid @enderror" type="" name="celular" id="celular">
                @error('celular')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            </div>

            <div class="form-group">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <label for="telefono">N° de Teléfono</label>
                <input required value="{{ $user->telefono }}" class="form-control @error('telefono') is-invalid @enderror" type="" name="telefono" id="telefono">
                @error('celular')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            </div>

          

           

            
           
            <div class="form-group">
            <div class="col-xs-4 col-sm-4 col-md-4"> 
            <label for="name">Estado</label>
            <select class="form-control" name="is_active" id="is_active">
            
            <option value="1"   <?php if( $user->is_active == 1) echo "selected"; else echo "mm"; ?>>Activo</option>
            <option value="0"  <?php if( $user->is_active == 0) echo "selected"; else echo "mm"; ?>>Inactivo</option>
            </select>
            </div>
            </div>

            <input class="form-control"  name="pais_id" id="pais_id" type="hidden">

            <div class="form-group">
                <button class="btn btn-primary btn-sm">Actualizar Usuario</button>
            </div>
        </form>
    </div>
</div>
@stop