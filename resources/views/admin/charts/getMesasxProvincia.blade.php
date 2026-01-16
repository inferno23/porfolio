@extends('layouts.backend.app23',[
    'title' => 'Grafico',
    'pageTitle' => 'Grafico de Datos '.$Nombreprovincia,
])
@section('content')

<script src="http://sepconsulting.hol.es/portfolio/public/templates/backend/sb-admin-2/vendor/jquery/jquery.min.js"></script>
<script src="http://sepconsulting.hol.es/portfolio/public/js/jquery.knob.min.js"></script>



<!-- ajax  prov - localidad -->


<div class="card shadow mb-4">
<div class="container">
  
    <div class="form-group">
    <div class="col-xs-6 col-sm-6 col-md-6"> 
      <label for="country">pais:</label>
   <select required id="pais_id" name="pais_id" class="form-control">
        <option value="" selected disabled>Seleccione un pais</option>
         @foreach($paises as  $model)
         <option value="{{$model->id}}"    <?php if( $model->id == $pais_id) echo "selected"; else echo "mm"; ?>> {{$model->paisnombre}}</option>
         @endforeach
         </select>
    </div>
    </div>
    <div class="form-group">
    <div class="col-xs-6 col-sm-6 col-md-6"> 
      <label for="state">provincia:</label>
      <select name="provincia_id" id="provincia_id" class="form-control" style='border-color: #1cc88a;'>
      
      @foreach($provincias as  $model)
         <option value="{{$model->id}}"    <?php if( $model->id == $provincia_id) echo "selected style='background-color:#1cc88a;'  "; else echo "mm"; ?>> {{$model->provincia}}</option>
         @endforeach
         </select>
    </div>
    </div>
 <div class="form-group">
 <div class="col-xs-6 col-sm-6 col-md-6"> 
      <label for="city">localidad:</label>
      <select name="localidad_id" id="localidad_id" class="form-control" >
      <option value="" selected disabled>Seleccione una localidad</option>
      <option value='TODO' style='background-color: #ffce56;'>Mostrar Datos de toda la  Provincia seleccionada Arriba</option>
    
      @foreach($localidades as  $model)
         <option value="{{$model->id}}"  > {{$model->localidad}}</option>
         @endforeach
      </select>
    </div>
    </div>

    <div class="form-group">
 <div class="col-xs-6 col-sm-6 col-md-6"> 
      <label for="city">Escuela o Establecimiento:</label>
      <select name="escuela_id" id="escuela_id" class="form-control" >

     
      </select>
    </div>
    </div>

    <div class="form-group">
 <div class="col-xs-6 col-sm-6 col-md-6"> 
      <label for="city">mesa:</label>
      <select name="mesa_id" id="mesa_id" class="form-control" >
    
      </select>
    </div>
    </div>


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

                     
                       var primero = "<option value='0'>Candidato es solo nacional . Caso contrario seleccione Una provincia</option>"; 

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

////////////////// provincia_id //////////////////
$('#provincia_id').on('change',function(){
  var  provincia_id= $(this).val();  
 
    if(provincia_id){
       if(provincia_id=='TODO'){
        var pais_id = $('#pais_id').val(); 
      window.location.href=  location.origin +ruta+'/charts/getMesasxPais/'+pais_id;
      }
   }

    
});




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
                    var primero = "<option value='0'>Candidato Provincial. Caso contrario seleccione Una Localidad</option>"; 

$("#localidad_id").append(primero);
                    if (len>0) {
                        $("#localidad_id").empty();
                        var primero = "<option value='0'>Candidato Provincial. Caso contrario seleccione Una Localidad</option>"; 

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


////////////////// localidad_id ////////////////////////////////////
$('#localidad_id').on('change',function(){
  var  localidad_id= $(this).val();  
 
  if(localidad_id){


    if(localidad_id=='TODO'){
    var provincia_id = $('#provincia_id').val(); 
    window.location.href= location.origin +ruta+'/chart/getMesasxProvincia/'+provincia_id;
    }
  }

    
});

  //////////////////
  $('#localidad_id').on('change',function(){
  var localidad_id = $(this).val();  
  //alert(localidad_id);
  if(localidad_id){
    $.ajax({
      type:"GET",
     
      url:location.origin +ruta+'/instituto/getEscuelaxLocalidad/'+localidad_id,
      dataType:'json',
      success:function (response) {
                    var len = 0;
                    if (response.data != null) {
                        len = response.data.length;
                    }
                    var primero = "<option value='0'>seleccione una Escuela de la  Localidad</option>"; 

                    $("#escuela_id").append(primero);
                    if (len>0) {
                        $("#escuela_id").empty();
                        var primero = "<option value='0'>seleccione una Escuela de la  Localidad</option>"; 
                     $("#escuela_id").append(primero);
                     var primero = "<option value='TODO' style='background-color: #ffce56;'>Mostrar Datos de toda la  Localidad seleccionada</option>"; 

                        $("#escuela_id").append(primero);
                        for (var i = 0; i<len; i++) {
                             var id = response.data[i].id;
                             var name = response.data[i].name;

                             var option = "<option value='"+id+"'>"+name+"</option>"; 

                             $("#escuela_id").append(option);
                        }
                        $( "#escuela_id" ).focus();
                       $("#localidad_id").css("border-color", "#3a3b45");
                       // $("#subCategory").css("border-color", "#bac8f3");
                        $("#escuela_id").css("border-color", "#1aef3e");
                        
                    }
                }
    });
  }else{
    $("#escuela_id").empty();
  }
    
  });
///////////

  //////////////////
  $('#escuela_id').on('change',function(){
  var escuela_id = $(this).val();  
  //alert(localidad_id);
  if(escuela_id){
    $.ajax({
      type:"GET",
     
      url:location.origin +ruta+'/registro/getMesasxEscuela/'+escuela_id,
      dataType:'json',
      success:function (response) {
                    var len = 0;
                    if (response.data != null) {
                        len = response.data.length;
                    }
                    var primero = "<option value='0'>seleccione una Mesa de la  Escuela</option>"; 

                    $("#mesa_id").append(primero);
                    if (len>0) {
                        $("#mesa_id").empty();
                        var primero = "<option value='0'>seleccione una Mesa de la  Escuela</option>"; 

                         $("#mesa_id").append(primero);
                         var primero = "<option value='TODO' style='background-color: #ffce56;'>Mostrar Datos de toda la  Escuela seleccionada</option>"; 

                        $("#mesa_id").append(primero);  
                        for (var i = 0; i<len; i++) {
                            var id = response.data[i];
                             var name = response.data[i];

                             var option = "<option value='"+id+"'>"+name+"</option>"; 


                            
                             $("#mesa_id").append(option);
                        }
                        $( "#mesa_id" ).focus();
                       $("#escuela_id").css("border-color", "#3a3b45");
                       // $("#subCategory").css("border-color", "#bac8f3");
                        $("#mesa_id").css("border-color", "#1aef3e");
                        
                    }
                }
    });
  }else{
    $("#mesa_id").empty();
  }
    
  });

////////////////// escuela_id ////////////////// ////////////////// ///////////
$('#escuela_id').on('change',function(){
  var  escuela_id= $(this).val();  
  var mesa_id = $('#mesa_id').val(); 
  
  if(escuela_id=='TODO'){
    var localidad_id = $('#localidad_id').val(); 
   // alert(localidad_id);
    window.location.href=location.origin +ruta+'/chart/getMesasxLocalidad/'+localidad_id;
  }


    
});
  //////////////////
  $('#escuela_id').on('change',function(){
  var escuela_id = $(this).val();  
  //alert(localidad_id);
  if(escuela_id){
    $.ajax({
      type:"GET",
     
      url:location.origin +ruta+'/registro/getMesasxEscuela/'+escuela_id,
      dataType:'json',
      success:function (response) {
                    var len = 0;
                    if (response.data != null) {
                        len = response.data.length;
                    }
                    var primero = "<option value='0'>seleccione una Mesa de la  Escuela</option>"; 

                    $("#mesa_id").append(primero);
                    if (len>0) {
                        $("#mesa_id").empty();
                        var primero = "<option value='0'>seleccione una Mesa de la  Escuela</option>"; 

                         $("#mesa_id").append(primero);
                         var primero = "<option value='TODO' style='background-color: #ffce56;'>Mostrar Datos de toda la  Escuela seleccionada</option>"; 

$("#mesa_id").append(primero);
                        for (var i = 0; i<len; i++) {
                            var id = response.data[i];
                             var name = response.data[i];

                             var option = "<option value='"+id+"'>"+name+"</option>"; 


                            
                             $("#mesa_id").append(option);
                        }
                        $( "#mesa_id" ).focus();
                       $("#escuela_id").css("border-color", "#3a3b45");
                       // $("#subCategory").css("border-color", "#bac8f3");
                        $("#mesa_id").css("border-color", "#1aef3e");
                        
                    }
                }
    });
  }else{
    $("#mesa_id").empty();
  }
    
  });
 ////////////////// mesa_id
 $('#mesa_id').on('change',function(){
  var mesa_id = $(this).val();  
  var escuela_id = $('#escuela_id').val(); 

  //alert(mesa_id+escuela_id);
  if(mesa_id=='TODO'){
    //alert(mesa_id+escuela_id);
    window.location.href= location.origin +ruta+'/charts/'+escuela_id+'/edit';
  }else{
    window.location.href= location.origin +ruta+'/charts/'+mesa_id;
  }
  
  });


</script>

<div class="card-header py-3" >
       
        
    <a href="#" class="btn btn-danger" onclick="saveAsPDF()"><span class="fa fa-download"> Descargar  en PDF   </span></a>
  
    
</div>
<div  id="printableArea">
<div class="col-xl-4 col-lg-5">
  
<?php echo '<br>Reporte de : '.$Nombreprovincia.' total_padron: '.$total_padron;

echo '<br>total_votantes: '.$total_votantes;
$nombre_format_francais =$porcentaje=0;
if($total_padron>0){
  $porcentaje=($total_votantes / $total_padron)*100;
 // echo '<br>procentaje: '. $porcentaje;

  $nombre_format_francais = number_format($porcentaje, 2, '.', ' ');
  echo '<br>procentaje: '. $nombre_format_francais;
}else {
    /// evitar divisiones con cero 0
$total_padron=1;

}
?>
 <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Participacion ciudadana</h6>
                                </div>
    <input type="text" value="<?php echo $nombre_format_francais; ?>" class="dial"> 


    </div>

    <div class="col-xl-4 col-lg-5" >
<?php 
echo '<br>Recurridos: '.$Recurridos;

echo '<br>Recurridos_diputado: '.$Recurridos_diputado;
if($total_votantes>0){
$porcentajeRecurridos=($Recurridos / $total_votantes)*100;
 $porcentajeRecurridos = number_format($porcentajeRecurridos, 2, '.', ' ');
 echo '<br>porcentaje Recurridos: '. $porcentajeRecurridos;
}else {
  /// evitar divisiones con cero 0
$total_votantes=1;

}

 $porcentajeRecurridosDiputados=($Recurridos_diputado / $total_votantes)*100;
  
  $porcentajeRecurridosDiputados = number_format($porcentajeRecurridosDiputados, 2, '.', ' ');
  echo '<br>porcentaje Recurridos diputad: '. $porcentajeRecurridosDiputados;
 

///////////////////////////////////////
echo '<br>impugnada: '.$impugnada;
$porcentajeimpugnada=($impugnada / $total_votantes)*100;
 $porcentajeimpugnada = number_format($porcentajeimpugnada, 2, '.', ' ');
 echo '<br>porcentaje Recurridos: '. $porcentajeimpugnada;
echo '<br>impugnada_diputado: '.$impugnada_diputado;
$porcentajeimpugnadadiputado=($impugnada_diputado / $total_votantes)*100;
 $porcentajeimpugnadadiputado = number_format($porcentajeimpugnadadiputado, 2, '.', ' ');
 echo '<br>porcentaje impugnada diputado: '. $porcentajeimpugnadadiputado;
 ////////////////////////////////////////
echo '<br>comando: '.$comando;
$porcentajecomando=($comando / $total_votantes)*100;
 $porcentajecomando = number_format($porcentajecomando, 2, '.', ' ');
 echo '<br>porcentaje comando: '. $porcentajecomando;

echo '<br>comando_diputado: '.$comando_diputado;
$porcentajecomandodiputado=($comando_diputado / $total_votantes)*100;
 $porcentajecomandodiputado = number_format($porcentajecomandodiputado, 2, '.', ' ');
 echo '<br>porcentaje comando diputado: '. $porcentajecomandodiputado;
 /////////////////////////////////////////////
echo '<br>nulos: '.$nulos;
$porcentajenulos=($nulos / $total_votantes)*100;
 $porcentajenulos = number_format($porcentajenulos, 2, '.', ' ');
 echo '<br>porcentaje nulos: '. $porcentajenulos;
echo '<br>nulos_diputado: '.$nulos_diputado;
$porcentajenulosdiputado=($nulos_diputado / $total_votantes)*100;
 $porcentajenulosdiputado = number_format($porcentajenulosdiputado, 2, '.', ' ');
 echo '<br>porcentaje comando diputados: '. $porcentajenulosdiputado;
 ///////////////////////////////
echo '<br>blanco: '.$blanco;
$porcentajeblanco=($blanco / $total_votantes)*100;
 $porcentajeblanco = number_format($porcentajeblanco, 2, '.', ' ');
 echo '<br>porcentaje blanco: '. $porcentajeblanco;
echo '<br>blanco_diputado: '.$blanco_diputado;
$porcentajeblancodiputado=($blanco_diputado / $total_votantes)*100;
 $porcentajeblancodiputado = number_format($porcentajeblancodiputado, 2, '.', ' ');
 echo '<br>porcentaje blanco diputado: '. $porcentajeblancodiputado;

 ////////////////////////////////////
 echo '<br>positivo: '.$positivo;
$porcentajepositivo=($positivo / $total_votantes)*100;
 $porcentajepositivo = number_format($porcentajepositivo, 2, '.', ' ');
 echo '<br>porcentaje positivo: '. $porcentajepositivo;
echo '<br>positivo_diputado: '.$positivo_diputado;
$porcentajepositivo_diputado=($positivo_diputado / $total_votantes)*100;
 $porcentajepositivo_diputado = number_format($porcentajepositivo_diputado, 2, '.', ' ');
 echo '<br>porcentaje positivo_diputado: '. $porcentajepositivo_diputado;

 
?>

  





    </div>
    <script type="text/javascript">
        $(function() {
            $(".dial").knob();
        });
    </script>


<script>
  var year = <?php echo $year; ?>;
    var user = <?php echo $user; ?>;
    var diputado = <?php echo $diputado; ?>;
    var nulos = <?php echo $nulos; ?>;
    var blanco = <?php echo $blanco; ?>;
    var negativo = <?php echo $negativo; ?>;
    var positivo = <?php echo $positivo; ?>;
    var nulos_diputado = <?php echo $nulos_diputado; ?>;
    var blanco_diputado = <?php echo $blanco_diputado; ?>;
    var positivo_diputado = <?php echo $positivo_diputado; ?>;
    var negativo_diputado = <?php echo $negativo_diputado; ?>;
    var total_padron = <?php echo $total_padron; ?>;
    var total_votantes = <?php echo $total_votantes; ?>;
    var Recurridos = <?php echo $Recurridos; ?>;
    var Recurridos_diputado = <?php echo $Recurridos_diputado; ?>;
    var impugnada = <?php echo $impugnada; ?>;
    var impugnada_diputado = <?php echo $impugnada_diputado; ?>;
    var comando = <?php echo $comando; ?>;
    var comando_diputado = <?php echo $comando_diputado; ?>;
    var otros = Recurridos+impugnada+comando;
    var otros_diputado = Recurridos_diputado+impugnada_diputado+comando_diputado;

window.onload = function() {

//////////////////
var ctx4 = document.getElementById("myChart");
var myChart = new Chart(ctx4, {
  type: 'pie',
  data: {
    labels: ['Positivos ' +positivo, 'Blancos '+blanco, 'Nulos ' +nulos, 'Otros '+otros],
    datasets: [{
      label: '# de votos',
      data: [positivo, blanco,nulos,otros],
      backgroundColor: [
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 99, 132, 0.5)',
        
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)'
      ],
      borderColor: [
        'rgba(54, 162, 235, 1)',
        'rgba(255,99,132,1)',
       
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)'
      ],
      borderWidth: 1
    }]
  },
  options: {
   	//cutoutPercentage: 40,
    responsive: false,

  }
});


//////////////////
var ctx5 = document.getElementById("myChart5");
var myChart5 = new Chart(ctx5, {
  type: 'pie',
  data: {
    labels: ['Positivos ' +positivo_diputado, 'Blancos '+blanco_diputado, 'Nulos ' +nulos_diputado, 'Otros '+otros_diputado],
   datasets: [{
      label: '# de votos',
      data: [positivo_diputado, blanco_diputado, nulos_diputado, otros_diputado],
    
      backgroundColor: [
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 99, 132, 0.5)',
        
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)'
      ],
      borderColor: [
        'rgba(54, 162, 235, 1)',
        'rgba(255,99,132,1)',
       
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)'
      ],
      borderWidth: 1
    }]
  },
  options: {
   	//cutoutPercentage: 40,
    responsive: false,

  }
});





    };
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

<div class="col-xl-4 col-lg-5" >
                            <div class="card shadow mb-4 pull-left">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Resumen General Senadores</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    


                                    <canvas id="myChart" width="250" height="350"></canvas>
                                    <hr>
                                    Positivos <?php echo $porcentajepositivo; ?>-  Blancos <?php echo $porcentajeblanco; ?>
                                    <code> - Nulos <?php echo $porcentajenulos; ?></code> .
                                </div>
                            </div>

                        
                            <div class="card shadow mb-4 pull-right">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Resumen General Diputados</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    


                                    <canvas id="myChart5" width="250" height="350"></canvas>
                                    <hr>
                                    Positivos <?php echo $positivo_diputado; ?>-  Blancos <?php echo $blanco_diputado; ?>
                                    <code> - Nulos <?php echo $nulos_diputado; ?></code> .
                                </div>
                            </div>
                        
  </div>
  <div class="col-xl-12 col-lg-8" >


<?php 
foreach($registros as $row) {
    if ($row->id!=6 ){

    $lista=$row->lista;
    if ($lista==0 ){
        $lista='';
    } else
    $lista=" Lista:".$row->lista;

    $frase=$row->partido;
    $color=$row->color;
    $votos=(int) $row->sum;
    $votos_diputado=(int) $row->votos_diputado;
    $porcentajePartido=($votos / $total_padron)*100;
    $porcentajePartido = number_format($porcentajePartido, 2, '.', ' ');
    

            //Sin saltos de lineas para dibujar 
            $frase = preg_replace("/[\r\n|\n|\r]+/", " ", $frase);
            echo "<br> ".$lista." ".$frase."  ".$votos." ".$votos_diputado.' porcentaje %: '. $porcentajePartido;


            echo '<div class="progress" style="height: 40px;">';
            echo ' <div class="progress-bar" role="progressbar" style="background-color: '.$color.';width: '.$porcentajePartido.'%" aria-valuenow="'.$porcentajePartido.'" aria-valuemin="0" aria-valuemax="100">'.$porcentajePartido.'%</div> ';

            echo '</div>';
        }
}
?>




                            
                        </div>
    </div>
   
                        <script type="text/javascript" src="{{ asset('js/html2pdf.bundle.min.js') }}"></script>
<script>

    function saveAsPDF() {
        var element = document.getElementById('printableArea');
        var hoy = <?php echo date("d-m-Y");?>;
        const date_format = new Date();
        provincia = '<?php echo $Nombreprovincia;?>';
        fecha= 'GraficosProvincia_'+provincia+date_format.getDate()+'/'+ (date_format.getMonth()+ 1) +'/'+date_format.getFullYear();
        var opt = {
            margin: 0.2,
            filename:  fecha,
            image: {type: 'jpeg', quality: 1},
            html2canvas: {scale: 4, dpi: 72, letterRendering: true},
            jsPDF: {unit: 'in', format: 'A4'}
        };
        html2pdf().set(opt).from(element).save();
    }

</script>


@endsection