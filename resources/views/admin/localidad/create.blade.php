@extends('layouts.backend.app',[
	'title' => 'Geo Localidad - Consulting Group',
	'pageTitle' => 'Geo Localidad',
])
@section('content')
@include('layouts.components.datatables')
@include('layouts.components.alert-dismissible')
<div class="card shadow mb-4">
    <div class="card-header py-3">Registrar Nueva Localidad</div>
    <div class="card-body">
    	<a href="{{ route('localidad.index') }}" class="btn btn-danger btn-sm">Listado de Localidades</a>
    	<a href="{{ route('pais.index') }}" class="btn btn-secondary btn-sm">Volver a Geo</a>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('localidad.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                        <div class="col-xs-8 col-sm-8 col-md-8"> 
                            <label>Provincia: </label>
                            
                            <select required name="id_privincia" id="id_privincia" class="form-control">
                                <option value="">Seleccione una Provincia</option>
                                @foreach($provincias as $model)
                                  <option value="{{ $model->id }}"  >{{$model->provincia}}</option>
                                @endforeach
                            </select>
                            </div>
            </div>
            <div class="form-group">
                <label for="nombre">Nombre de la Localidad:</label>
                <input required=""  class="form-control @error('localidad') is-invalid @enderror" name="localidad" id="localidad" type="">
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