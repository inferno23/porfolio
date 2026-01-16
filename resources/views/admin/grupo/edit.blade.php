@extends('layouts.backend.app',[
	'title' => 'Actualizar',
	'pageTitle' => 'Modificar datos personales',
])
@section('content')
@include('layouts.components.datatables')
@include('layouts.components.alert-dismissible')
<div class="card shadow mb-4">
    <div class="card-header py-3">
    	<a href="{{ route('registro.index') }}" class="btn btn-danger btn-sm">Listado</a>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('registro.update',$registro->id) }}">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="nombre" class="btn-success" >{{ !empty($registro->persona) ? $registro->persona->nombre.'- Dni:' .$registro->persona->dni.'- Mesa:' .$registro->persona->mesa .'- Orden:' .$registro->persona->ordewn :'Sin asignar' }}</label>
                <input  value="{{ $registro->persona->id }}" class="hidden"  name="persona_id" id="persona_id" type="hidden">

                </div>

                <div class="form-group">
                        <div class="col-xs-6 col-sm-6 col-md-6"> 
                            <label>escuela:</label>
                            
                            <select name="institucion_id" id="institucion_id" class="form-control">
                                <option value="0">-- Seleccione una escuela --</option>
                                @foreach($instituciones as $model)
                                  <option value="{{ $model->id }}" <?php if( $registro->institucion_id == $model->id) echo "selected"; else echo "mm"; ?> >{{ $model->name }} - mesas: {{ $model->mdesde }} -{{ $model->mhasta }}</option>
                                @endforeach
                            </select>
                            </div>
            </div>

            <div class="form-group">
                <label for="dni">Fiscal general</label>
                <div class="col-xs-4 col-sm-4 col-md-4"> 
                <select class="form-control" name="fiscal_general" id="fiscal_general">
                <option value="0" <?php if( $registro->fiscal_general == 0) echo "selected"; else echo "mm"; ?>>Sin asignar</option>
            <option value="1" <?php if( $registro->fiscal_general == 1) echo "selected"; else echo "mm"; ?>>Asignar como fiscal_general</option>
       
            
        
              </select>
              </div>
            </div>
            <div class="form-group">
                <label for="dni">Fiscal mesa</label>
                <div class="col-xs-3 col-sm-3 col-md-3"> 
                <select class="form-control" name="fiscal_mesa" id="fiscal_mesa">
                <option value="0" <?php if( $registro->fiscal_mesa == 0) echo "selected"; else echo "mm"; ?> >Sin asignar</option>
            <option value="1" <?php if( $registro->fiscal_mesa == 1) echo "selected"; else echo "mm"; ?>>Asignar como fiscal mesa</option>
       
            
        
              </select>
            </div>
            </div>
           


            <div class="form-group">
            <div class="col-xs-3 col-sm-3 col-md-3"> 
                <label for="mesa">mesa</label>
                <input required="" value="{{ $registro->mesa }}" class="form-control @error('mesa') is-invalid @enderror" name="mesa" id="mesa" type="">
                @error('mesa')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            </div>
           

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
            </div>
        </form>
    </div>
</div>
@stop