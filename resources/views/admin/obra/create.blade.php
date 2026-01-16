@extends('layouts.backend.app',[
	'title' => 'Create obra',
	'pageTitle' => 'Create obra',
])
@section('content')
@include('layouts.components.datatables')
@include('layouts.components.alert-dismissible')
<div class="card shadow mb-4">
    <div class="card-header py-3">
    	<a href="{{ route('obra.index') }}" class="btn btn-danger btn-sm"> <- Volver al listado</a>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('obra.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Titulo</label>
                <input class="form-control @error('titulo') is-invalid @enderror" name="titulo" id="titulo" type="">
                @error('titulo')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>


            <div class="form-group">
                <label for="title">Descripcion</label>
                <input class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" id="descripcion" type="">
                @error('descripcion')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

           
            <div class="form-group">
                            <label for="name">Imagen</label>

                <div class="custom-file">
                  <input type="file" name="file" class="custom-file-input @error('file') is-invalid @enderror" id="customFile">
                  <label class="custom-file-label" for="customFile">Seleccionar Imagen</label>
                </div>
                @error('file')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
             <div class="form-group">
                <label for="fecha">Fecha</label>
                <input class="form-control  @error('fecha') is-invalid @enderror  col-xs-4 col-sm-4 col-md-4" name="fecha" id="fecha" type="date">
                @error('fecha')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>


            <div class="form-group">
                <label for="fecha">hora</label>
                <input class="form-control  @error('horainicio') is-invalid @enderror  col-xs-4 col-sm-4 col-md-4" name="horainicio" id="horainicio" type="time">
                @error('horainicio')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
            <div class="col-xs-4 col-sm-4 col-md-4"> 
            <label for="name">Estado</label>
            <select class="form-control" name="activo" id="activo">
            
            <option value="1">Activo</option>
            <option value="0">Inactivo</option>
            </select>
            </div>
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-success btn-sm">Agregar obra</button>
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