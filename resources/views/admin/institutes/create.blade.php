@extends('layouts.backend.app',[
	'title' => 'Crear Institución - Consulting Group',
	'pageTitle' => 'Crear Institución',
])
@section('content')
@include('layouts.components.datatables')
@include('layouts.components.alert-dismissible')

<div class="card shadow mb-4">
    <div class="card-header py-3">Crear Institución</div>
    <div class="card-body">
    	<a href="{{ route('institutes.index') }}" class="btn btn-danger btn-sm">Listado</a>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('institutes.store') }}" enctype="multipart/form-data">
            @csrf
            

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
 
  
            <div class="card shadow mb-4">
                <div class="container">
                  
                    <div class="form-group">
                        <div class="col-xs-6 col-sm-6 col-md-6"> 
                          <label for="country">País:</label>
                            <select required id="pais_id" name="pais_id" class="form-control"  style='border-color: #002060;'  >
                                <option value="" selected disabled>Seleccione un País</option>
                                 @foreach($paises as  $model)
                                 <option value="{{$model->id}}"    > {{$model->paisnombre}}</option>
                                 @endforeach
                             </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-xs-6 col-sm-6 col-md-6"> 
                            <label for="state">Provincia:</label>
                            <select required name="provincia_id" id="provincia_id" class="form-control" >
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-xs-6 col-sm-6 col-md-6"> 
                              <label for="city">Localidad:</label>
                              <select required name="localidad_id" id="localidad_id" class="form-control" >
                              </select>
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label for="description">Institución</label>
                            <input class="form-control @error('name') is-invalid @enderror" name="name" id="name" type="">
                            @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                    </div>
                    
                    <div class="d-none">
                        <label for="provincia">Provincia</label>
                            <input class="form-control @error('provincia') is-invalid @enderror" name="provincia" id="provincia" type="">
                            @error('provincia')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="seccion">Sección</label>
                            <input class="form-control @error('seccion') is-invalid @enderror" name="seccion" id="seccion" type="">
                            @error('seccion')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                    </div>
                
                    <div class="d-none">
                        <label for="departamento">Departamento</label>
                            <input class="form-control @error('departamento') is-invalid @enderror" name="departamento" id="departamento" type="">
                            @error('departamento')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                    </div>
                    
                    <div class="d-none">
                        <label for="localidad">Localidad</label>
                            <input class="form-control @error('localidad') is-invalid @enderror" name="localidad" id="localidad" type="">
                            @error('localidad')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="circuito">Circuito</label>
                            <input class="form-control @error('circuito') is-invalid @enderror" name="circuito" id="circuito" type="">
                            @error('circuito')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                    </div>
                            
                    <div class="d-none">
                        <label for="escuela">Institución</label>
                            <input class="form-control @error('escuela') is-invalid @enderror" name="escuela" id="escuela" type="">
                            @error('escuela')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                            @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="domicilio">Domicilio</label>
                            <input class="form-control @error('domicilio') is-invalid @enderror" name="domicilio" id="domicilio" type="">
                            @error('domicilio')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                            @enderror
                    </div>
                
                    <div class="form-group">
                        <label for="mdesde">Desde Mesa</label>
                            <input class="form-control @error('mdesde') is-invalid @enderror" name="mdesde" id="mdesde" type="">
                            @error('mdesde')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                    </div>
                
                    <div class="form-group">
                        <label for="mhasta">Hasta Mesa</label>
                            <input class="form-control @error('mhasta') is-invalid @enderror" name="mhasta" id="mhasta" type="">
                            @error('mhasta')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                    </div>
                
                    <div class="form-group">
                        <label for="cant_mes">Cantidad de Mesas</label>
                            <input class="form-control @error('cant_mes') is-invalid @enderror" name="cant_mes" id="cant_mes" type="">
                            @error('cant_mes')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                            @enderror
                    </div>
                
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-sm">Registrar Institución</button>
                    </div>
                </div>
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

                     
                       var primero = "<option value=''>Seleccione una Provincia</option>"; 

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