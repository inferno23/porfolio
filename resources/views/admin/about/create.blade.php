@extends('layouts.backend.app',[
	'title' => 'Create About',
	'pageTitle' => 'Create About',
])
@section('content')
@include('layouts.components.datatables')
@include('layouts.components.alert-dismissible')
<div class="card shadow mb-4">
    <div class="card-header py-3">
    	<a href="{{ route('about.index') }}" class="btn btn-danger btn-sm"> <- Volver al Listado</a>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('about.store') }}" enctype="multipart/form-data">
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
                <label for="description">Descripcion</label>
                <input class="form-control @error('description') is-invalid @enderror" name="description" id="description" type="">
                @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Nombre</label>
                <input class="form-control @error('name') is-invalid @enderror" name="name" id="name" type="">
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control @error('email') is-invalid @enderror" name="email" id="email" type="">
                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="phone">Telefono</label>
                <input class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" type="">
                @error('phone')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <input value="administrador" class="form-control @error('role') is-invalid @enderror" name="role" id="role" type="">
                @error('role')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="customFile">Imagen</label>
                <div class="custom-file">
                  <input type="file" name="file" class="custom-file-input @error('file') is-invalid @enderror" id="customFile">
                  <label class="custom-file-label" for="customFile">Seleccione una Imagen</label>
                </div>
                @error('file')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success btn-sm">Crear Registro</button>
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