@extends('layouts.backend.app',[
	'title' => 'Modificar Usuario - Consulting Group',
	'pageTitle' => 'Modificar Usuario',
])
@section('content')
@include('layouts.components.datatables')
@include('layouts.components.alert-dismissible')
<div class="card shadow mb-4">
    <div class="card-header py-3">
    	<a href="{{ route('user.index') }}" class="btn btn-danger btn-sm">Listado</a>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('user.update',$user->id) }}">
            @csrf
            @method('PATCH')
            <div class="form-group">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <label for="name">Nombre y Apellido</label>
                <input required value="{{ $user->name }}" class="form-control @error('name') is-invalid @enderror" type="" name="name" id="name">
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>


            <div class="form-group">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <label for="name">Email</label>
                <input required value="{{ $user->email }}" class="form-control @error('email') is-invalid @enderror" type="" name="email" id="email">
                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <label for="password">Clave de Acceso</label>
                <input  class="form-control @error('password') is-invalid @enderror" type="password" name="password" id="password">
                <small class="text-danger">Deje el campo vacío si no desea cambiar la clave</small>
                @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            </div>
            
            <div class="form-group">
            <div class="col-xs-6 col-sm-6 col-md-6"> 
            <label for="name">Rol</label>
            <select required class="form-control" name="role" id="role">
                <option value="1"  <?php if( $user->role == 1) echo "selected"; else echo "mm"; ?>>Administrador General</option>
                <option value="2" <?php if( $user->role == 2) echo "selected"; else echo "mm"; ?>>Administrador de Cliente</option>
                <option value="3"  <?php if( $user->role == 3) echo "selected"; else echo "mm"; ?>>Fiscal</option>
                <option value="4" <?php if( $user->role == 4) echo "selected"; else echo "mm"; ?>>Administrador Plan Básico</option>
                <option value="5" <?php if( $user->role == 5) echo "selected"; else echo "mm"; ?>>Administrador Plan Bronce</option>
                <option value="6" <?php if( $user->role == 6) echo "selected"; else echo "mm"; ?>>Administrador Plan Plata</option>
                <option value="7" <?php if( $user->role == 7) echo "selected"; else echo "mm"; ?>>Administrador Plan Oro</option>
                <option value="8" <?php if( $user->role == 8) echo "selected"; else echo "mm"; ?>>Administrador Plan Platino</option>
                <option value="9" <?php if( $user->role == 9) echo "selected"; else echo "mm"; ?>>Suscriptor Plan Básico</option>
                <option value="10" <?php if( $user->role == 10) echo "selected"; else echo "mm"; ?>>Suscriptor Plan Estándar</option>
                <option value="11" <?php if( $user->role == 11) echo "selected"; else echo "mm"; ?>>Suscriptor Plan Premium</option>
                <option value="12" <?php if( $user->role == 12) echo "selected"; else echo "mm"; ?>>Administrador Plan Diamante</option>
            </select>
            </div>
            </div>

            <div class="mb-3">
           
            </div>


            <div class="form-group">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <label for="cargo">Cargo</label>
                <input required value="{{ $user->cargo }}" class="form-control @error('cargo') is-invalid @enderror" type="" name="cargo" id="cargo">
                @error('cargo')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            </div>
            
            <div class="form-group">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <label for="celular">N° de Celular</label>
                <input required value="{{ $user->celular }}" class="form-control @error('celular') is-invalid @enderror" type="" name="celular" id="celular">
                @error('celular')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            </div>

            <div class="form-group">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <label for="telefono">N° de Teléfono</label>
                <input required value="{{ $user->telefono }}" class="form-control @error('telefono') is-invalid @enderror" type="" name="telefono" id="telefono">
                @error('celular')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            </div>

            <div class="form-group">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <label for="detalle">Campaña para el cargo de:</label>
                <input required value="{{ $user->detalle }}" class="form-control @error('detalle') is-invalid @enderror" type="" name="detalle" id="detalle">
                @error('detalle')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            </div>

            <div class="form-group">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <label for="cargo">Precandidato</label>
                <input required value="{{ $user->precandidato }}" class="form-control @error('precandidato') is-invalid @enderror" type="" name="precandidato" id="precandidato">
                @error('precandidato')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            </div>

            
            <div class="form-group">
            <div class="col-xs-6 col-sm-6 col-md-6"> 
            <label for="name">Tiempo de Suscripción</label>
            <select class="form-control" name="tiempo_suscripcion" id="tiempo_suscripcion">
            
            <option value="1"  <?php if( $user->tiempo_suscripcion == 1) echo "selected"; else echo "mm"; ?>>1 Mes</option>
            <option value="2"  <?php if( $user->tiempo_suscripcion == 2) echo "selected"; else echo "mm"; ?>>2 Meses</option>
            <option value="3"  <?php if( $user->tiempo_suscripcion == 3) echo "selected"; else echo "mm"; ?>>3 Meses</option>
            <option value="4"  <?php if( $user->tiempo_suscripcion == 4) echo "selected"; else echo "mm"; ?>>4 Meses</option>
            <option value="5"  <?php if( $user->tiempo_suscripcion == 5) echo "selected"; else echo "mm"; ?>>5 Meses</option>
            <option value="6"  <?php if( $user->tiempo_suscripcion == 6) echo "selected"; else echo "mm"; ?>>6 Meses</option>
            <option value="7"  <?php if( $user->tiempo_suscripcion == 7) echo "selected"; else echo "mm"; ?>>7 Meses</option>
            <option value="8"  <?php if( $user->tiempo_suscripcion == 8) echo "selected"; else echo "mm"; ?>>8 Meses</option>
            <option value="9"  <?php if( $user->tiempo_suscripcion == 9) echo "selected"; else echo "mm"; ?>>9 Meses</option>
            <option value="10"  <?php if( $user->tiempo_suscripcion == 10) echo "selected"; else echo "mm"; ?>>10 Meses</option>
            <option value="11"  <?php if( $user->tiempo_suscripcion == 11) echo "selected"; else echo "mm"; ?>>11 Meses</option>
            <option value="12"  <?php if( $user->tiempo_suscripcion == 12) echo "selected"; else echo "mm"; ?>>12 Meses</option>
          

            </select>
            </div>
            </div>

            <div class="form-group">
            <div class="col-xs-4 col-sm-4 col-md-4"> 
            <label for="name">Estado</label>
            <select class="form-control" name="is_active" id="is_active">
            
            <option value="1"   <?php if( $user->is_active == 1) echo "selected"; else echo "mm"; ?>>Activo</option>
            <option value="0"  <?php if( $user->is_active == 0) echo "selected"; else echo "mm"; ?>>Inactivo</option>
            </select>
            </div>
            </div>

            <input class="form-control"  name="pais_id" id="pais_id" type="hidden">

            <div class="form-group">
                <button class="btn btn-primary btn-sm">Actualizar Usuario</button>
            </div>
        </form>
    </div>
</div>
@stop