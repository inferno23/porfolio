@extends('layouts.backend.app23',[
    'title' => 'Grafico ',
    'pageTitle' => 'Grafico ',
])
@section('content')

<script src="http://sepconsulting.hol.es/portfolio/public/templates/backend/sb-admin-2/vendor/jquery/jquery.min.js"></script>
<script src="http://sepconsulting.hol.es/portfolio/public/js/jquery.knob.min.js"></script>


<div class="card-header py-3" >
       
        
    <a href="#" class="btn btn-danger" onclick="saveAsPDF()"><span class="fa fa-download"> Descargar  en PDF   </span></a>
  
    
</div>

<div  id="printableArea">
   <div class="col-xl-4 col-lg-5" >
                            <div class="card shadow mb-4 pull-left">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Participacion Diputado Provincial</h6>
                                </div>
               
                            </div>
                              
<?php echo '<br> total_padron: '.$total_padron;

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


if($total_votantes>0){
$porcentajeRecurridos=($Recurridos / $total_votantes)*100;
 $porcentajeRecurridos = number_format($porcentajeRecurridos, 2, '.', ' ');
 echo '<br>porcentaje Recurridos: '. $porcentajeRecurridos;
}else {
  /// evitar divisiones con cero 0
$total_votantes=1;

}


///////////////////////////////////////
echo '<br>impugnada: '.$impugnada;
$porcentajeimpugnada=($impugnada / $total_votantes)*100;
 $porcentajeimpugnada = number_format($porcentajeimpugnada, 2, '.', ' ');
 echo '<br>porcentaje Recurridos: '. $porcentajeimpugnada;

 ////////////////////////////////////////
echo '<br>comando: '.$comando;
$porcentajecomando=($comando / $total_votantes)*100;
 $porcentajecomando = number_format($porcentajecomando, 2, '.', ' ');
 echo '<br>porcentaje comando: '. $porcentajecomando;

 /////////////////////////////////////////////
echo '<br>nulos: '.$nulos;
$porcentajenulos=($nulos / $total_votantes)*100;
 $porcentajenulos = number_format($porcentajenulos, 2, '.', ' ');
 echo '<br>porcentaje nulos: '. $porcentajenulos;

 ///////////////////////////////
echo '<br>blanco: '.$blanco;
$porcentajeblanco=($blanco / $total_votantes)*100;
 $porcentajeblanco = number_format($porcentajeblanco, 2, '.', ' ');
 echo '<br>porcentaje blanco: '. $porcentajeblanco;

 ////////////////////////////////////
 echo '<br>positivo: '.$positivo;
$porcentajepositivo=($positivo / $total_votantes)*100;
 $porcentajepositivo = number_format($porcentajepositivo, 2, '.', ' ');
 echo '<br>porcentaje positivo: '. $porcentajepositivo;

 
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
  
    var nulos = <?php echo $nulos; ?>;
    var blanco = <?php echo $blanco; ?>;
   
    var positivo = <?php echo $positivo; ?>;
   
  
    var total_padron = <?php echo $total_padron; ?>;
    var total_votantes = <?php echo $total_votantes; ?>;
    var Recurridos = <?php echo $Recurridos; ?>;
   
    var impugnada = <?php echo $impugnada; ?>;
    
    var comando = <?php echo $comando; ?>;
   var otros = Recurridos+impugnada+comando;
   
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





    };
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

<div class="col-xl-4 col-lg-5" >
                            <div class="card shadow mb-4 pull-left">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Resumen General </h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    


                                    <canvas id="myChart" width="250" height="350"></canvas>
                                    <hr>
                                    Positivos <?php echo $porcentajepositivo; ?>-  Blancos <?php echo $porcentajeblanco; ?>
                                    <code> - Nulos <?php echo $porcentajenulos; ?></code> .
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
   
    $porcentajePartido=($votos / $total_padron)*100;
    $porcentajePartido = number_format($porcentajePartido, 2, '.', ' ');
    

            //Sin saltos de lineas para dibujar 
            $frase = preg_replace("/[\r\n|\n|\r]+/", " ", $frase);
            echo "<br> ".$lista." ".$frase."  ".$votos.' porcentaje %: '. $porcentajePartido;


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
       
        fecha= 'GraficosDiputadoProvincial_'+date_format.getDate()+'/'+ (date_format.getMonth()+ 1) +'/'+date_format.getFullYear();
      
      //  fecha= 'Graficos '+date_format.getDate()+'/'+ (date_format.getMonth()+ 1) +'/'+date_format.getFullYear();
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