@extends('layouts.backend.app',[
	'title' => 'Crear Organización - Consulting Group',
	'pageTitle' => 'Crear Organización',
])
@section('content')
@include('layouts.components.datatables')
@include('layouts.components.alert-dismissible')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
 
<div class="card shadow mb-4">
    <div class="card-header py-3">Crear Organización Política</div>
    <div class="card-body">
    	<a href="{{ route('organizacion.index') }}" class="btn btn-danger btn-sm">Listado</a>
    </div>
    <div class="card-body">
<form method="POST" action="{{ route('organizacion.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
    <div class="col-xs-6 col-sm-6 col-md-6"> 
      <label for="country">País:</label>
   <select required id="pais_id" name="pais_id" class="form-control">
        <option value="" selected disabled>Seleccione un País</option>
         @foreach($paises as  $model)
         <option value="{{$model->id}}"> {{$model->paisnombre}}</option>
         @endforeach
         </select>
    </div>
    </div>


    <div class="form-group">
    <div class="col-xs-6 col-sm-6 col-md-6"> 
      <label for="state">Provincia:</label>
      <select name="provincia_id" id="provincia_id" class="form-control"></select>
    </div>
    </div>
 <div class="form-group">
 <div class="col-xs-6 col-sm-6 col-md-6"> 
      <label for="city">Localidad:</label>
      <select name="localidad_id" id="localidad_id" class="form-control"></select>
    </div>
    </div>

<script type=text/javascript>
  $('#pais_id').change(function(){
  var id=countryID = $(this).val();  
  if(countryID){
    $.ajax({
      type:"GET",
    
      url:'../provincia/getProvinciaxpais/'+id,
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

                     
                       var primero = "<option value='0'>La Organización es Nacional (en caso contrario seleccione una Provincia)</option>"; 

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
  $('#provincia_id').on('change',function(){
  var stateID = $(this).val();  
  //alert(stateID);
  if(stateID){
    $.ajax({
      type:"GET",
     
      url:'../localidad/getLocalidadxprovincia/'+stateID,
      dataType:'json',
      success:function (response) {
                    var len = 0;
                    if (response.data != null) {
                        len = response.data.length;
                    }
                    var primero = "<option value='0'>La Organización es Provincial. (en caso contrario seleccione una Localidad)</option>"; 

                    $("#localidad_id").append(primero);
                    if (len>0) {
                        $("#localidad_id").empty();
                        var primero = "<option value='0'>La Organización es Provincial. (en caso contrario seleccione una Localidad)</option>"; 

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
</script>

            <div class="form-group">
                <label for="organizacion">Nombre de la Organización</label>
                <input class="form-control @error('organizacion') is-invalid @enderror" name="organizacion" id="organizacion" type="">
                @error('organizacion')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
           
           
            <div class="form-group">
                <label for="lista">N° de Lista</label>
                <input class="form-control @error('lista') is-invalid @enderror" name="lista" id="lista" type="">
                @error('lista')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="d-none">
                <label for="ejecutivo_nacional">Ejecutivo Nacional</label>
                <input class="form-control @error('escuela') is-invalid @enderror" name="ejecutivo_nacional" id="ejecutivo_nacional" type="">
                @error('ejecutivo_nacional')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="d-none">
                <label for="domicilio">Ejecutivo Provincial</label>
                <input class="form-control @error('ejecutivo_provincial') is-invalid @enderror" name="ejecutivo_provincial" id="ejecutivo_provincial" type="">
                @error('ejecutivo_provincial')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>


            <div class="d-none">
                <label for="ejecutivo_municipal">Ejecutivo Municipal</label>
                <input class="form-control @error('ejecutivo_municipal') is-invalid @enderror" name="ejecutivo_municipal" id="ejecutivo_municipal" type="">
                @error('ejecutivo_municipal')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="d-none">
                <label for="ejecutivo_comunal">Ejecutivo Comunal</label>
                <input class="form-control @error('ejecutivo_comunal') is-invalid @enderror" name="ejecutivo_comunal" id="ejecutivo_comunal" type="">
                @error('ejecutivo_comunal')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="d-none">
                <label for="senador">Senador</label>
                <input class="form-control @error('senador') is-invalid @enderror" name="senador" id="senador" type="">
                @error('senador')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>


            <div class="d-none">
                <label for="diputado">Diputado Nacional</label>
                <input class="form-control @error('diputado') is-invalid @enderror" name="diputado" id="diputado" type="">
                @error('diputado')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            
            <div class="d-none">
                <label for="diputado_provincial">Legislador / Diputado Provincial</label>
                <input class="form-control @error('diputado_provincial') is-invalid @enderror" name="diputado_provincial" id="diputado_provincial" type="">
                @error('diputado_provincial')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>        

            <div class="d-none">
                <label for="concejal">Concejal</label>
                <input class="form-control @error('concejal') is-invalid @enderror" name="concejal" id="concejal" type="">
                @error('concejal')
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