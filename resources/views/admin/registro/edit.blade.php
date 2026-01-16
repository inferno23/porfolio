@extends('layouts.backend.app',[
	'title' => 'Modificar Fiscal Asignado - Consulting Group',
	'pageTitle' => 'Modificar Fiscal Asignado',
])
@section('content')
@include('layouts.components.datatables')
@include('layouts.components.alert-dismissible')
<div class="card shadow mb-4">
    <div class="card-header py-3">
    	<a href="{{ route('admin.registro.listado') }}" class="btn btn-danger btn-sm">Listado</a>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('registro.update',$registro->id) }}">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="nombre" class="btn-success" >{{ !empty($registro->persona) ? $registro->persona->nombre.' - DNI: ' .$registro->persona->dni.' - Institución: ' .$registro->persona->institucion.' - Mesa: ' .$registro->persona->mesa.'- Orden: ' .$registro->persona->orden:'Sin asignar' }}</label>
                <input  value="{{ $registro->persona->id }}" class="hidden"  name="persona_id" id="persona_id" type="hidden">

                </div>

                <div class="form-group">
                        <div class="col-xs-8 col-sm-8 col-md-8"> 
                            <label>Institución:</label>
                            
                            <select name="institucion_id" id="institucion_id" class="form-control">
                                <option value="0">Seleccione una Institución</option>
                                @foreach($instituciones as $model)
                                  <option value="{{ $model->id }}" <?php if( $registro->institucion_id == $model->id) echo "selected"; else echo "mm"; ?> >{{$model->name}}- Mesas desde: {{$model->mdesde}} hasta: {{$model->mhasta}}</option>
                                @endforeach
                            </select>
                            </div>
            </div>

            <div class="form-group">
                <label for="dni">Fiscal General</label>
                <div class="col-xs-4 col-sm-4 col-md-4"> 
                <select class="form-control" name="fiscal_general" id="fiscal_general">
                <option value="0" <?php if( $registro->fiscal_general == 0) echo "selected"; else echo "mm"; ?>>Sin asignar</option>
            <option value="1" <?php if( $registro->fiscal_general == 1) echo "selected"; else echo "mm"; ?>>Asignar como Fiscal General</option>
       
            
        
              </select>
              </div>
            </div>
            <div class="form-group">
                <label for="dni">Fiscal de Mesa</label>
                <div class="col-xs-3 col-sm-3 col-md-3"> 
                <select class="form-control" name="fiscal_mesa" id="fiscal_mesa">
                <option value="0" <?php if( $registro->fiscal_mesa == 0) echo "selected"; else echo "mm"; ?> >Sin asignar</option>
            <option value="1" <?php if( $registro->fiscal_mesa == 1) echo "selected"; else echo "mm"; ?>>Asignar como Fiscal de Mesa</option>
       
            
        
              </select>
            </div>
            </div>
           


            <div class="form-group">
            <div class="col-xs-3 col-sm-3 col-md-3"> 
                <label for="mesa">N° de Mesa</label>
                <input required="" value="{{ $registro->mesa }}" class="form-control @error('mesa') is-invalid @enderror" name="mesa" id="mesa" type="">
                @error('mesa')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            </div>


            <div class="form-group">
                <label for="mesa">Domicilio de Contacto</label>
                <div class="col-xs-4 col-sm-4 col-md-4"> 
                <input class="form-control @error('domicilio_real') is-invalid @enderror" name="domicilio_real" id="domicilio_real" type="">
                @error('domicilio_real')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="mesa">Teléfono de Contacto</label>
                <div class="col-xs-3 col-sm-3 col-md-3"> 
                <input class="form-control @error('telefono') is-invalid @enderror" name="telefono" id="telefono" type="">
                @error('telefono')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                </div>
            </div>
           
            <div class="form-group">
                <label for="mesa">Modificado por: {{ Auth::user()->name}}</label>
                <input  value="{{ Auth::id()}}" class="hidden"  name="user_id" id="user_id" type="hidden">
          
          
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
            </div>
        </form>
    </div>
</div>
@stop