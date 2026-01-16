@extends('layouts.backend.app',[
	'title' => 'Registrar Nueva Provincia - Consulting Group',
	'pageTitle' => 'Registrar Nueva Provincia',
])
@section('content')
@include('layouts.components.datatables')
@include('layouts.components.alert-dismissible')
<div class="card shadow mb-4">
    <div class="card-header py-3">Registrar Nueva Provincia</div>
    <div class="card-body">
    	<a href="{{ route('provincia.index') }}" class="btn btn-danger btn-sm">Listado de Provincias</a>
    	<a href="{{ route('pais.index') }}" class="btn btn-secondary btn-sm">Volver a Geo</a>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('provincia.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                        <div class="col-xs-8 col-sm-8 col-md-8"> 
                            <label>País:</label>
                            
                            <select required name="pais_id" id="pais_id" class="form-control">
                                <option value="">Seleccione un País</option>
                                @foreach($paises as $model)
                                  <option value="{{ $model->id }}"  >{{$model->paisnombre}}</option>
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
                <button type="submit" class="btn btn-primary btn-sm">Registrar</button>
            </div>
        </form>
    </div>
</div>
@stop

@section('js-script')
<script type="text/javascript">
    $(".custom-file-input").on("change",function(){
        let filename = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(filename)
    })
</script>
@stop