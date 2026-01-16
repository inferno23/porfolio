@extends('layouts.backend.app',[
	'title' => 'Modificar Provincia - Consulting Group',
	'pageTitle' => 'Modificar Provincia',
])
@section('content')
@include('layouts.components.datatables')
@include('layouts.components.alert-dismissible')
<div class="card shadow mb-4">
    <div class="card-header py-3">
    	<a href="{{ route('provincia.index') }}" class="btn btn-danger btn-sm">Listado de Provincias</a>
    	<a href="{{ route('pais.index') }}" class="btn btn-primary btn-sm">Volver a Geo</a>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('provincia.update',$provincia->id) }}">
            @csrf
            @method('PATCH')
            <div class="form-group">
                        <div class="col-xs-8 col-sm-8 col-md-8"> 
                            <label>Pais:</label>
                            
                            <select required name="pais_id" id="pais_id" class="form-control">
                                <option value="">Seleccione un País</option>
                                @foreach($paises as $model)
                                  <option value="{{ $model->id }}" <?php if( $provincia->pais_id == $model->id) echo "selected"; else echo "mm"; ?>  >{{$model->paisnombre}}</option>
                                @endforeach
                            </select>
                            </div>
            </div>
            <div class="form-group">
                <label for="nombre">Nombre de la Provincia:</label>
                <input required=""  class="form-control @error('provincia') is-invalid @enderror" name="provincia" id="provincia" type="">
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