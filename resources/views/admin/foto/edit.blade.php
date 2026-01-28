@extends('layouts.backend.app',[
	'title' => 'Edit foto',
	'pageTitle' => 'Edit foto',
])
@section('content')
@include('layouts.components.datatables')
@include('layouts.components.alert-dismissible')
<div class="card shadow mb-4">
    <div class="card-header py-3">
    	<a href="{{ route('foto.index') }}" class="btn btn-danger btn-sm"><- Volver al Listado</a>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('foto.update',$foto->id) }}"  enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="title">Titulo</label>
                <input required="" value="{{ $foto->titulo }}" class="form-control @error('titulo') is-invalid @enderror" name="titulo" id="titulo" type="">
                @error('titulo')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
           

             <div class="form-group">
                                <label for="description">Imagen</label>

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
                <label for="description">activo</label>
                <input required="" value="{{ $foto->activo }}" class="form-control @error('activo') is-invalid @enderror" name="activo" id="activo" type="">
                @error('activo')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success btn-sm">Actualizar foto</button>
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