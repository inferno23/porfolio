@extends('layouts.backend.app',[
	'title' => 'Modificar País - Consulting Grou',
	'pageTitle' => 'Modificar País',
])
@section('content')
@include('layouts.components.datatables')
@include('layouts.components.alert-dismissible')
<div class="card shadow mb-4">
    <div class="card-header py-3">Modificar País</div>
    <div class="card-body">
    	<a href="{{ route('pais.index') }}" class="btn btn-danger btn-sm">Listado de Países</a>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('pais.update',$pais->id) }}">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input required="" value="{{ $pais->paisnombre }}" class="form-control @error('paisnombre') is-invalid @enderror" name="paisnombre" id="paisnombre" type="">
                @error('nombre')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
           

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
            </div>
        </form>
    </div>
</div>
@stop