@extends('layouts.backend.app',[
	'title' => 'Modificar Candidato - Consulting Group',
	'pageTitle' => 'Modificar Candidato',
])
@section('content')
@include('layouts.components.datatables')
@include('layouts.components.alert-dismissible')
<div class="card shadow mb-4">
    <div class="card-header py-3">
    	<a href="{{ route('candidato.index') }}" class="btn btn-danger btn-sm">Listado</a>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('candidato.update',$candidato->id) }}">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="nombre">N° de Lista</label>
                <div class="col-xs-3 col-sm-3 col-md-3"> 
                <input required="" value="{{ $candidato->lista }}" class="form-control @error('lista') is-invalid @enderror" name="lista" id="lista" type="">
                @error('lista')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="partido">Organización</label>
                <div class="col-xs-3 col-sm-3 col-md-3"> 
                <input required="" value="{{ $candidato->partido }}" class="form-control @error('partido') is-invalid @enderror" name="partido" id="partido" type="">
                @error('partido')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="partido">Ejecutivo Nacional</label>
                <div class="col-xs-3 col-sm-3 col-md-3"> 
                <input  value="{{ $candidato->presidente }}" class="form-control @error('presidente') is-invalid @enderror" name="presidente" id="presidente" type="">
                @error('presidente')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                </div>
            </div>
            
            <div class="form-group">
                <label for="senador">Ejecutivo Provincial</label>
                <div class="col-xs-6 col-sm-6 col-md-6"> 
                <input  value="{{ $candidato->gobernador }}" class="form-control @error('gobernador') is-invalid @enderror" name="gobernador" id="gobernador" type="">
                @error('gobernador')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                </div>
            </div>
            
            <div class="form-group">
                <label for="senador">Ejecutivo Municipal</label>
                <div class="col-xs-6 col-sm-6 col-md-6"> 
                <input  value="{{ $candidato->intendente }}" class="form-control @error('intendente') is-invalid @enderror" name="intendente" id="intendente" type="">
                @error('intendente')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                </div>
            </div>
            
            <div class="form-group">
                <label for="municipal">Ejecutivo Comunal</label>
                <div class="col-xs-6 col-sm-6 col-md-6"> 
                <input  value="{{ $candidato->municipal }}" class="form-control @error('municipal') is-invalid @enderror" name="municipal" id="municipal" type="">
                @error('municipal')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="senador">Senador</label>
                <div class="col-xs-6 col-sm-6 col-md-6"> 
                <input  value="{{ $candidato->senador }}" class="form-control @error('senador') is-invalid @enderror" name="senador" id="senador" type="">
                @error('senador')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="diputado">Diputado Nacional</label>
                <div class="col-xs-6 col-sm-6 col-md-6"> 
                <input  value="{{ $candidato->diputado }}" class="form-control @error('diputado') is-invalid @enderror" name="diputado" id="diputado" type="">
                @error('diputado')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                </div>
            </div>
            
            <div class="form-group">
                <label for="diputado_provincial">Legislador / Diputado Provincial</label>
                <div class="col-xs-6 col-sm-6 col-md-6"> 
                <input  value="{{ $candidato->diputado_provincial }}" class="form-control @error('diputado_provincial') is-invalid @enderror" name="diputado_provincial" id="diputado_provincial" type="">
                @error('diputado_provincial')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="concejal">Concejal</label>
                <div class="col-xs-6 col-sm-6 col-md-6"> 
                <input  value="{{ $candidato->concejal }}" class="form-control @error('concejal') is-invalid @enderror" name="concejal" id="concejal" type="">
                @error('concejal')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                </div>
            </div>


            <div class="form-group">
                <label for="title">Color a Mostar en los Reportes y graficos</label>
                <div class="col-xs-3 col-sm-3 col-md-3"> 
                <input value="{{ $candidato->color }}" class="form-control @error('color') is-invalid @enderror" name="color" id="color" type="color">
                @error('color')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                </div>
            </div>


            <div class="form-group">
                <label for="orden">N° de Orden en el Telegrama</label>
                <div class="col-xs-3 col-sm-3 col-md-3"> 
                <input required="" value="{{ $candidato->orden }}" class="form-control @error('orden') is-invalid @enderror" name="orden" id="orden" type="">
                @error('orden')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="mesa">Registrado por: {{ Auth::user()->name}}</label>
                <input class="form-control @error('user_id') is-invalid @enderror" value="{{ Auth::user()->id}}" name="user_id" id="user_id" type="hidden">
               
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
            </div>
        </form>
    </div>
</div>
@stop