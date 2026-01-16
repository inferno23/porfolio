@extends('layouts.backend.app',[
	'title' => 'Registrar Nuevo País - Consulting Group',
	'pageTitle' => 'Registrar Nuevo País',
])
@section('content')
@include('layouts.components.datatables')
@include('layouts.components.alert-dismissible')
<div class="card shadow mb-4">
    <div class="card-header py-3">Registrar Nuevo País</div>
    <div class="card-body">
    	<a href="{{ route('pais.index') }}" class="btn btn-danger btn-sm">Listado de Países</a>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('pais.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Nombre del País:</label>
                <input class="form-control @error('paisnombre') is-invalid @enderror" name="paisnombre" id="paisnombre" type="">
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