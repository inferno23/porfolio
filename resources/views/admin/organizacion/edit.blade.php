@extends('layouts.backend.app',[
	'title' => 'Modificar Organización - Consulting Group',
	'pageTitle' => 'Modificar Organizacion',
])
@section('content')
@include('layouts.components.datatables')
@include('layouts.components.alert-dismissible')
  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
 
  <?php
   $pais_id= $organizacion->pais_id;
   $provincia_id= $organizacion->provincia_id;
   $localidad_id= $organizacion->localidad_id;
  
  
  ?>
<div class="card shadow mb-4">
    <div class="card-header py-3">Modificar Organización</div>
    <div class="card-body">
    	<a href="{{ route('organizacion.index') }}" class="btn btn-danger btn-sm">Listado</a>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('organizacion.update',$organizacion->id) }}">
            @csrf
            @method('PATCH')

            <div class="form-group">
    <div class="col-xs-6 col-sm-6 col-md-6"> 
      <label for="country">País:</label>
   <select required id="pais_id" name="pais_id" class="form-control">
        <option value="" selected disabled>Seleccione un País</option>
         @foreach($paises as  $model)
         <option value="{{$model->id}}"    <?php if( $model->id == $pais_id) echo "selected"; else echo "mm"; ?>> {{$model->paisnombre}}</option>
         @endforeach
         </select>
    </div>
    </div>
    <div class="form-group">
    <div class="col-xs-6 col-sm-6 col-md-6"> 
      <label for="state">Provincia:</label>
      <select  name="provincia_id" id="provincia_id" class="form-control" style='border-color: #002060;'>
      <option value="">La Organización es Nacional (en caso contrario seleccione una Provincia</option>
      
      @foreach($provincias as  $model)
         <option value="{{$model->id}}"    <?php if( $model->id == $provincia_id) echo "selected style='background-color:#002060;'  "; else echo "mm"; ?>> {{$model->provincia}}</option>
         @endforeach
         </select>
    </div>
    </div>
 <div class="form-group">
 <div class="col-xs-6 col-sm-6 col-md-6"> 
      <label for="city">Localidad:</label>
      <select  name="localidad_id" id="localidad_id" class="form-control" >
      <option value="" >Seleccione una Localidad</option>
    
      @foreach($localidades as  $model)
         <option value="{{$model->id}}"  <?php if( $model->id == $localidad_id) echo "selected style='background-color:#002060;'  "; else echo "mm"; ?>> {{$model->localidad}}</option>
         @endforeach
      </select>
    </div>
    </div>
            <div class="form-group">
                <label for="organizacion">Nombre de la Organización</label>
                <input required="" value="{{ $organizacion->organizacion }}" class="form-control @error('organizacion') is-invalid @enderror" name="organizacion" id="organizacion" type="">
                @error('organizacion')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="lista">N° de Lista</label>
                <input required="" value="{{ $organizacion->lista }}" class="form-control @error('lista') is-invalid @enderror" name="lista" id="lista" type="">
                @error('lista')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="d-none">
                <label for="ejecutivo_nacional">Ejecutivo Nacional</label>
                <input  value="{{ $organizacion->ejecutivo_nacional }}" class="form-control @error('ejecutivo_nacional') is-invalid @enderror" name="ejecutivo_nacional" id="ejecutivo_nacional" type="">
                @error('ejecutivo_nacional')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="d-none">
                <label for="ejecutivo_provincial">Ejecutivo Provincial</label>
                <input value="{{ $organizacion->ejecutivo_provincial }}" class="form-control @error('ejecutivo_provincial') is-invalid @enderror" name="ejecutivo_provincial" id="ejecutivo_provincial" type="">
                @error('ejecutivo_provincial')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
           
            <div class="d-none">
                <label for="ejecutivo_municipal">Ejecutivo Municipal</label>
                <input  value="{{ $organizacion->ejecutivo_municipal }}" class="form-control @error('ejecutivo_municipal') is-invalid @enderror" name="ejecutivo_municipal" id="ejecutivo_municipal" type="">
                @error('ejecutivo_municipal')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="d-none">
                <label for="ejecutivo_comunal">Ejecutivo Comunal</label>
                <input  value="{{ $organizacion->ejecutivo_comunal }}" class="form-control @error('cant_mes') is-invalid @enderror" name="ejecutivo_comunal" id="ejecutivo_comunal" type="">
                @error('ejecutivo_comunal')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="d-none">
                <label for="senador">Senador</label>
                <input  value="{{ $organizacion->senador }}" class="form-control @error('senador') is-invalid @enderror" name="senador" id="senador" type="">
                @error('senador')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="d-none">
                <label for="diputado">Diputado Nacional</label>
                <input value="{{ $organizacion->diputado }}" class="form-control @error('diputado') is-invalid @enderror" name="diputado" id="diputado" type="">
                @error('diputado')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            
            <div class="d-none">
                <label for="diputado_provincial">Legislador / Diputado Provincial</label>
                <input  value="{{ $organizacion->diputado_provincial }}" class="form-control @error('diputado_provincial') is-invalid @enderror" name="diputado_provincial" id="diputado_provincial" type="">
                @error('diputado_provincial')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="d-none">
                <label for="concejal">Concejal</label>
                <input  value="{{ $organizacion->concejal }}" class="form-control @error('concejal') is-invalid @enderror" name="concejal" id="concejal" type="">
                @error('concejal')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
            </div>
        </form>
    </div>
</div>


<script type=text/javascript>
ruta="/portfolio/public/admin";

 
  
  $('#pais_id').change(function(){
  var id=countryID = $(this).val();  
  


  if(countryID){
    $.ajax({
      type:"GET",
    //doble  ../../  por que vienen chart / create
  //   url:'../../provincia/getProvinciaxpais/'+id,
     url:location.origin +ruta+'/provincia/getProvinciaxpais/'+id,
                type:'get',
                dataType:'json',
              
      
      success:function(response){        
        var len = 0;
                    if (response.data != null) {
                        len = response.data.length;
                    }
                    $("#provincia_id").empty();
                       $("#city").empty();
                    if (len>0) {
                       // $("#subCategory option[value='0']").remove();

                     
                       var primero = "<option value=''>La Organizacion es Nacional. (en caso contrario seleccione una Provincia)</option>"; 

                      $("#provincia_id").append(primero);
                        for (var i = 0; i<len; i++) {
                             var id = response.data[i].id;
                             var name = response.data[i].provincia;

                             var option = "<option value='"+id+"'>"+name+"</option>"; 

                             $("#provincia_id").append(option);
                        }
                        $( "#provincia_id" ).focus();
                    
                        $("#provincia_id").css("border-color", "#002060");
                        
                    }
      }
    });
  }else{
    $("#provincia_id").empty();
    $("#localidad_id").empty();
  }   
  });

//////////////////


$('#provincia_id').on('change',function(){
  var stateID = $(this).val();  
  //alert(stateID);
  if(stateID){
    $.ajax({
      type:"GET",
       //doble  ../../  por que vienen chart / create
      url:location.origin +ruta+'/localidad/getLocalidadxprovincia/'+stateID,
      dataType:'json',
      success:function (response) {
                    var len = 0;
                    if (response.data != null) {
                        len = response.data.length;
                    }
                    var primero = "<option value=''>Seleccione una Localidad</option>"; 

$("#localidad_id").append(primero);
                    if (len>0) {
                        $("#localidad_id").empty();
                        var primero = "<option value=''>Seleccione una Localidad</option>"; 

                         $("#localidad_id").append(primero);
                        for (var i = 0; i<len; i++) {
                             var id = response.data[i].id;
                             var name = response.data[i].localidad;

                             var option = "<option value='"+id+"'>"+name+"</option>"; 

                             $("#localidad_id").append(option);
                        }
                        $( "#localidad_id" ).focus();
                       $("#provincia_id").css("border-color", "#002060");
                       // $("#subCategory").css("border-color", "#bac8f3");
                        $("#localidad_id").css("border-color", "#002060");
                        
                    }
                }
    });
  }else{
    $("#localidad_id").empty();
  }
    
  });


//////////////////


</script>

@stop