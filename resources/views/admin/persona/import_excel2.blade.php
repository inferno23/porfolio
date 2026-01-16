@extends('layouts.backend.app',[
    'title' => 'Padron',
    'pageTitle' => 'Padron',
])
@section('content')
@include('layouts.components.datatables')
@include('layouts.components.alert-dismissible')

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{__('Padron')}}</h1>
               
            </div>
            <div class="section-body">
            <div class="container">
   <h3 align="center">Importar Excel para las votantesqqq</h3>
    <br />
  

  
   <form method="post" enctype="multipart/form-data" action="{{ url('admin/persona/import') }}">
    {{ csrf_field() }}
    <div class="form-group">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
 

<div class="card shadow mb-4">
<div class="container">
  
    <div class="form-group">
    <div class="col-xs-6 col-sm-6 col-md-6"> 
      <label for="country">pais:</label>
   <select required id="pais_id" name="pais_id" class="form-control" style='border-color: #1cc88a;'>
        <option value="" selected disabled>Seleccione un pais</option>
         @foreach($paises as  $model)
         <option value="{{$model->id}}"   > {{$model->paisnombre}}</option>
         @endforeach
         </select>
    </div>
    </div>
    <div class="form-group">
    <div class="col-xs-6 col-sm-6 col-md-6"> 
      <label for="state">provincia:</label>
      <select required name="provincia_id" id="provincia_id" class="form-control" >
      
         </select>
    </div>
    </div>
 <div class="form-group">
 <div class="col-xs-6 col-sm-6 col-md-6"> 
      <label for="city">localidad:</label>
      <select required name="localidad_id" id="localidad_id" class="form-control" >
      <option value="" selected disabled>Seleccione una localidad</option>
     
      </select>
    </div>
    </div>


     <table class="table">
      <tr>
       <td width="40%" align="right"><label>Seleccione el archivo excel a procesar</label></td>
       <td width="30">
        <input type="file" name="select_file" />
       </td>
       <td width="30%" align="left">
        <input required  type="submit" name="upload" class="btn btn-primary" value="Procesar Archivo excel">
       </td>
      </tr>
      <tr>
       <td width="40%" align="right"></td>
       <td width="30"><span class="text-muted">.xls, .xslx</span></td>
       <td width="30%" align="left"></td>
      </tr>
     </table>
    </div>
   </form>
   
             </div>
                
        </section>
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

                     
                       var primero = "<option value=''>Seleccione Una provincia</option>"; 

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
                    var primero = "<option value=''>Seleccione Una Localidad</option>"; 

$("#localidad_id").append(primero);
                    if (len>0) {
                        $("#localidad_id").empty();
                        var primero = "<option value=''>Seleccione Una Localidad</option>"; 

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


//////////////////


</script>

@endsection


