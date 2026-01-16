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
            <label for="name">Rol</label>
            <select required class="form-control" name="role" id="role">
            <option value="1">Administrador</option>
            <option value="2">Administrador de Cliente</option>
            <option value="3">Fiscal</option>
            <option value="4">Administrador Plan Básico</option>
            <option value="5">Administrador Plan Bronce</option>
            <option value="6">Administrador Plan Plata</option>
            <option value="7">Administrador Plan Oro</option>
            <option value="8">Administrador Plan Platino</option>
            <option value="9">Suscriptor Plan Básico</option>
            <option value="10">Suscriptor Plan Estándar</option>
            <option value="11">Suscriptor Plan Premium</option>
            <option value="12">Administrador Plan Diamante</option>
            </select>
            </div>
            </div>
            
            <div class="mb-3">
            <div class="col-xs-6 col-sm-6 col-md-6"> 
            <label for="Administrador">Organización Política</label>
            <select required class="form-control" id="organizacion_id" name="organizacion_id" >
        
                                @foreach($organizaciones as $model)
                                  <option value="{{ $model->id }}" > {{ $model->organizacion }}</option>
                                @endforeach
            </select>
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
                <label for="telefono">N° de Teléfono</label>
                <input class="form-control @error('telefono') is-invalid @enderror" type="" name="telefono" id="telefono">
                @error('telefono')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            </div>
            
            <div class="form-group">
            <div class="col-xs-6 col-sm-6 col-md-6"> 
                <label for="detalle">Campaña para el cargo de</label>
                <input class="form-control @error('detalle') is-invalid @enderror" type="" name="detalle" id="detalle">
                @error('detalle')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            </div>
            
            <div class="form-group">
            <div class="col-xs-6 col-sm-6 col-md-6"> 
                <label for="precandidato">Precandidato</label>
                <input class="form-control @error('detalle') is-invalid @enderror" type="" name="precandidato" id="precandidato">
                @error('precandidato')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            </div>
            
            <div class="form-group">
            <div class="col-xs-6 col-sm-6 col-md-6"> 
            <label for="name">Tiempo de Suscripción</label>
            <select class="form-control" name="tiempo_suscripcion" id="tiempo_suscripcion">
            
            <option value="1">1 Mes</option>
            <option value="2">2 Meses</option>
            <option value="3">3 Meses</option>
            <option value="4">4 Meses</option>
            <option value="5">5 Meses</option>
            <option value="6">6 Meses</option>
            <option value="7">7 Meses</option>
            <option value="8">8 Meses</option>
            <option value="9">9 Meses</option>
            <option value="10">10 Meses</option>
            <option value="11">11 Meses</option>
            <option value="12">12 Meses</option>
            </select>
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
            
         
             <input class="form-control"  name="pais_id" id="pais_id" type="hidden">  
             <input class="form-control"  name="provincia_id" id="provincia_id" type="hidden">
             <input class="form-control"  name="localidad_id" id="localidad_id" type="hidden">
            <div class="form-group">
                <button class="btn btn-primary btn-sm">Crear usuario</button>
            </div>
        </form>
    </div>
</div>
@stop