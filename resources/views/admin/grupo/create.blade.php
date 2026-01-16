@extends('layouts.backend.app',[
	'title' => 'Crear Grupo de Trabajo - Consulting Group',
	'pageTitle' => 'Crear Grupo de Trabajo',
])
@section('content')
@include('layouts.components.datatables')
@include('layouts.components.alert-dismissible')
<div class="card shadow mb-4">
    <div class="card-header py-3">Crear Grupo de Trabajo</div>
    <div class="card-body">
    	<a href="{{ route('grupo.index') }}" class="btn btn-danger btn-sm">Listado</a>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('grupo.store') }}" enctype="multipart/form-data">
            @csrf
          
           
           
            
            <div class="form-group">
            <div class="col-xs-6 col-sm-6 col-md-6"> 
                <label  for="descripcion">Nombre del Grupo</label>
                <input required class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" id="descripcion" type="">
                @error('descripcion')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            </div>





            <div class="mb-3">
        <label for="Administrador">Encargado/a</label>
        <select required class="form-control" id="admin_id" name="admin_id" >
        <option value="">Seleccione al Administrador del Grupo</option>
                                @foreach($administadores as $model)
                                  <option value="{{ $model->id }}" > {{ $model->name }}</option>
                                @endforeach
        </select>
    </div>

           
           
            <div class="mb-3">
        <label for="Usuarios">Seleccione los otros miembros (mantenga presionada la tecla Ctrl para seleccionar más de un usuario como miembro)</label>
        <select required class="form-control" id="usuarios[]" name="usuarios[]" multiple="">
                               @foreach($users as $model)
                                  <option value="{{ $model->id }}" > {{ $model->name }}</option>
                                @endforeach
        </select>
    </div>
           


           

           

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-sm">Crear</button>
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