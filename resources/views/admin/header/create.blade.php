@extends('layouts.backend.app',[
	'title' => 'Create Header',
	'pageTitle' => 'Create Header',
])
@section('content')
@include('layouts.components.datatables')
@include('layouts.components.alert-dismissible')
<div class="card shadow mb-4">
    <div class="card-header py-3">
    	<a href="{{ route('header.index') }}" class="btn btn-danger btn-sm"><- Volver al Listado</a>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('header.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Titulo</label>
                <input class="form-control @error('title') is-invalid @enderror" name="title" id="title" type="">
                @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="navbar_title">Navbar Titulo</label>
                <input class="form-control @error('navbar_title') is-invalid @enderror" name="navbar_title" id="navbar_title" type="">
                @error('navbar_title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="up_text">Up Text</label>
                <input class="form-control @error('up_text') is-invalid @enderror" name="up_text" id="up_text" type="">
                @error('up_text')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="down_text">Down Text</label>
                <input placeholder="por ejemplo : una descripcion del evento" class="form-control @error('down_text') is-invalid @enderror" name="down_text" id="down_text" type="">
                @error('down_text')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="down_text">Imagen</label>

                <label for="customFile">Imagen</label>
                <div class="custom-file">
                  <input type="file" name="file" class="custom-file-input @error('file') is-invalid @enderror" id="customFile">
                  <label class="custom-file-label" for="customFile">Seccione una Imagen</label>
                </div>
                @error('file')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success btn-sm">Agregar Registro</button>
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