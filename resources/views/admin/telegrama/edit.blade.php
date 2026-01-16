@extends('layouts.backend.app',[
	'title' => 'Actualizar',
	'pageTitle' => 'Modificar datos del telegrama',
])
@section('content')
@include('layouts.components.datatables')
@include('layouts.components.alert-dismissible')
<div class="card shadow mb-4">
    <div class="card-header py-3">
    	<a href="{{ route('telegrama.index') }}" class="btn btn-danger btn-sm">Listado</a>
    </div>
    <div class="card-body">Partido
        <form method="POST" action="{{ route('telegrama.update',$telegrama->id) }}">
        
        
        @csrf
            @method('PATCH')
            

            <div class="form-group">
            <div class="col-xs-3 col-sm-3 col-md-3"> 
                <label for="mesa">{{ !empty($telegrama->candidato_id) && $telegrama->candidato_id > 0 ? $telegrama->candidato->partido:'- ' }}</label>
                
            </div>
            </div>
                     
            <div class="form-group">
            <div class="col-xs-3 col-sm-3 col-md-3"> 
                <label for="mesa">mesa</label>
                <input required="" value="{{ $telegrama->mesa }}" class="form-control @error('mesa') is-invalid @enderror" name="mesa" id="mesa" type="">
                @error('mesa')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            </div>
            <div class="form-group">
            <div class="col-xs-3 col-sm-3 col-md-3"> 
                <label for="mesa">candidato_id</label>
                <input required="" value="{{ $telegrama->candidato_id }}" class="form-control @error('candidato_id') is-invalid @enderror" name="candidato_id" id="candidato_id" type="">
                @error('candidato_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            </div>




            <div class="form-group">
            <div class="col-xs-3 col-sm-3 col-md-3"> 
                <label for="mesa">votos senador</label>
                <input required="" value="{{ $telegrama->votos_senador }}" class="form-control @error('votos_senador') is-invalid @enderror" name="votos_senador" id="votos_senador" type="">
                @error('votos_senador')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            </div>
           
            <div class="form-group">
            <div class="col-xs-3 col-sm-3 col-md-3"> 
                <label for="mesa">votos diputado</label>
                <input required="" value="{{ $telegrama->votos_diputado }}" class="form-control @error('votos_diputado') is-invalid @enderror" name="votos_diputado" id="votos_diputado" type="">
                @error('votos_diputado')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            </div>
            <div class="form-group">
                <label for="mesa">Registrado por:{{ Auth::user()->name}}</label>
                <input class="form-control @error('user_id') is-invalid @enderror" value="{{ Auth::user()->id}}" name="user_id" id="user_id" type="hidden">
               
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
            </div>
        </form>
    </div>
</div>
@stop