@extends('layouts.backend.app',[
	'title' => 'Crear Candidato - Consulting Group',
	'pageTitle' => 'Crear Candidato',
])
@section('content')
@include('layouts.components.datatables')
@include('layouts.components.alert-dismissible')
<div class="card shadow mb-4">
    <div class="card-header py-3">
    	<a href="{{ route('candidato.index') }}" class="btn btn-danger btn-sm">Listado</a>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('candidato.store') }}" enctype="multipart/form-data">
            @csrf





            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
 
<script type="text/javascript">


           $('#category').change(function () {
             var id = $(this).val();
             alert(id);
             alert(location.origin);
         //    $('#subCategory').find('option').not(':first').remove();

             $.ajax({
                url:location.origin +'/provincia/getProvinciaxpais/'+id,
                type:'get',
                dataType:'json',
                success:function (response) {
                    var len = 0;
                    if (response.data != null) {
                        len = response.data.length;
                    }

                    if (len>0) {
                       // $("#subCategory option[value='0']").remove();
                        for (var i = 0; i<len; i++) {
                             var id = response.data[i].id;
                             var name = response.data[i].provincia;

                             var option = "<option value='"+id+"'>"+name+"</option>"; 

                             $("#subCategory").append(option);
                        }
                        $( "#subCategory" ).focus();
                    
                        $("#subCategory").css("border-color", "#1aef3e");
                        
                    }
                }
             })
           });
           $('#sub_category').on('change',function(){
      
             var id = $(this).val();
              // alert(id);
             $('#localidad').find('option').not(':first').remove();

             $.ajax({
                url:'localidad/getLocalidadxprovincia/'+id,
                          
                type:'get',
                dataType:'json',
                success:function (response) {
                    var len = 0;
                    if (response.data != null) {
                        len = response.data.length;
                    }

                    if (len>0) {
                       // $("#subCategory option[value='0']").remove();
                        for (var i = 0; i<len; i++) {
                             var id = response.data[i].id;
                             var name = response.data[i].localidad;
                             var option = "<option value='"+id+"'>"+name+"</option>"; 

                             $("#localidad").append(option);
                        }
                        $( "#localidad" ).focus();
                    
                        $("#localidad").css("border-color", "#1aef3e");
                        
                    }
                }
             })
           });




      
       
    
    </script>
<div class="card shadow mb-4">
<div class="container">
  
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

                     
                       var primero = "<option value='0'>El Candidato es Nacional. (En caso contrario seleccione una Provincia)</option>"; 

                      $("#provincia_id").append(primero);
                        for (var i = 0; i<len; i++) {
                             var id = response.data[i].id;
                             var name = response.data[i].provincia;

                             var option = "<option value='"+id+"'>"+name+"</option>"; 

                             $("#provincia_id").append(option);
                        }
                        $( "#provincia_id" ).focus();
                    
                        $("#provincia_id").css("border-color", "#1aef3e");
                        
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
                    var primero = "<option value='0'>El Candidato es Provincial. (En caso contrario seleccione una Localidad)</option>"; 

$("#localidad_id").append(primero);
                    if (len>0) {
                        $("#localidad_id").empty();
                        var primero = "<option value='0'>El Candidato es Provincial. (En caso contrario seleccione una Localidad)</option>"; 

                         $("#localidad_id").append(primero);
                        for (var i = 0; i<len; i++) {
                             var id = response.data[i].id;
                             var name = response.data[i].localidad;

                             var option = "<option value='"+id+"'>"+name+"</option>"; 

                             $("#localidad_id").append(option);
                        }
                        $( "#localidad_id" ).focus();
                       $("#provincia_id").css("border-color", "#3a3b45");
                       // $("#subCategory").css("border-color", "#bac8f3");
                        $("#localidad_id").css("border-color", "#1aef3e");
                        
                    }
                }
    });
  }else{
    $("#localidad_id").empty();
  }
    
  });
</script>


        
            <div class="form-group">
                <label for="lista">N° de Lista</label>
                <div class="col-xs-3 col-sm-3 col-md-3"> 
                <input  required class="form-control @error('lista') is-invalid @enderror" name="lista" id="lista" type="">
                @error('lista')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="Partido">Organización</label>
                <div class="col-xs-3 col-sm-3 col-md-3"> 
                <input  required class="form-control @error('partido') is-invalid @enderror" name="partido" id="partido" type="">
                @error('partido')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="title">Ejecutivo Nacional</label>
                <div class="col-xs-3 col-sm-3 col-md-3"> 
                <input  class="form-control @error('presidente') is-invalid @enderror" name="presidente" id="presidente" type="">
                @error('presidente')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                </div>
            </div>
            
            <div class="form-group">
                <label for="title">Ejecutivo Provincial</label>
                <div class="col-xs-3 col-sm-3 col-md-3"> 
                <input  class="form-control @error('gobernador') is-invalid @enderror" name="gobernador" id="gobernador" type="">
                @error('gobernador')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                </div>
            </div>
            
            <div class="form-group">
                <label for="title">Ejecutivo Municipal</label>
                <div class="col-xs-3 col-sm-3 col-md-3"> 
                <input  class="form-control @error('intendente') is-invalid @enderror" name="intendente" id="intendente" type="">
                @error('intendente')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                </div>
            </div>
            
            <div class="form-group">
                <label for="title">Ejecutivo Comunal</label>
                <div class="col-xs-3 col-sm-3 col-md-3"> 
                <input  class="form-control @error('municipal') is-invalid @enderror" name="municipal" id="municipal" type="">
                @error('municipal')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                </div>
            </div>
            
            <div class="form-group">
                <label for="title">Senador</label>
                <div class="col-xs-3 col-sm-3 col-md-3"> 
                <input  class="form-control @error('senador') is-invalid @enderror" name="senador" id="senador" type="">
                @error('senador')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                </div>
            </div>
            
            <div class="form-group">
                <label for="title">Diputado</label>
                <div class="col-xs-3 col-sm-3 col-md-3"> 
                <input  class="form-control @error('diputado') is-invalid @enderror" name="diputado" id="diputado" type="">
                @error('diputado')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="title">Legislador / Diputado Provincial</label>
                <div class="col-xs-3 col-sm-3 col-md-3"> 
                <input  class="form-control @error('diputado_provincial') is-invalid @enderror" name="diputado_provincial" id="diputado_provincial" type="">
                @error('diputado_provincial')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="title">Concejal</label>
                <div class="col-xs-3 col-sm-3 col-md-3"> 
                <input  class="form-control @error('concejal') is-invalid @enderror" name="concejal" id="concejal" type="">
                @error('concejal')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                </div>
            </div>
            


            <div class="d-none">
            <div class="col-xs-6 col-sm-6 col-md-6"> 
            <label for="cargo">Cargo</label>
            <select  class="d-none" name="cargo" id="cargo">
            
            <option value="Presidente">Presidente</option>
            <option value="Senador">Senador</option>
            <option value="Diputado">Diputado nacional</option>
            <option value="Diputado Provincial">Diputado Provincial</option>
            <option value="Intendente">Intendente</option>
            <option value="Concejal">Concejal</option>
            <option value="Ejecutivo Comunal">Ejecutivo Comunal</option>
        
        </select>
            </div>

            </div>
           
            <div class="form-group">
            <div class="col-xs-6 col-sm-6 col-md-6"> 
            <label for="orden">Orden a mostrar en el Telegrama</label>
            <select class="form-control" name="orden" id="orden">
            
            <option value="1">1 Primero</option>
            <option value="2">2 Segundo</option>
            <option value="3">3 Tercero</option>
            <option value="4">4 Cuarto</option>
            <option value="5">5 Quinto</option>
            <option value="6">6 Sexto</option>
            <option value="7">7 Séptimo</option>
            <option value="8">8 Octavo</option>
            <option value="9">9 Noveno</option>
            <option value="10">10 Décimo</option>
            <option value="11">11 Onceavo</option>
            <option value="12">12 Doceavo</option>
            </select>
            </div>
            </div>


            <div class="form-group">
                <label for="title">Color a Mostar en los Reportes y graficos</label>
                <div class="col-xs-3 col-sm-3 col-md-3"> 
                <input  class="form-control @error('color') is-invalid @enderror" name="color" id="color" type="color">
                @error('color')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                </div>
            </div>
           

           
            <div class="form-group">
                <label for="mesa">Registrado por: {{ Auth::user()->name}}</label>
                <input class="form-control @error('user_id') is-invalid @enderror" value="{{ Auth::user()->id}}" name="user_id" id="user_id" type="hidden">
               
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