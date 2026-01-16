@extends('layouts.backend.app',[
    'title' => 'Datos de Perfil - Consulting Group',
    'pageTitle' => 'Datos de Perfil',
])
@section('content')
@include('layouts.components.alert-dismissible')
    <div class="row">
        
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">Datos de Perfil</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.profile.update',Auth::user()->id) }}">
                    @csrf
                    @method("PATCH")
                    <div class="form-group">
                        <label for="name">Nombre y Apellido</label>
                        <input required="" type="" class="form-control" name="name" id="name" value="{{ Auth::user()->name }}">
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Clave de Acceso</label>
                        <input type="hidden" class="form-control" id="old_password" value="{{ Auth::user()->password }}" name="old_password">
                        <input type="password" class="form-control" name="password" id="password">
                        <small>Deje el campo en blanco si no desea cambiar la clave de acceso.</small>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                        <label for="cargo">Cargo</label>
                        <input required value="{{ $user->cargo }}" class="form-control @error('cargo') is-invalid @enderror" type="" name="cargo" id="cargo">
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
                        <button class="btn btn-primary btn-sm">Actualizar datos</button>
                    </div>
                </form>
                </div>
            </div>
        </div>

    </div>
@stop