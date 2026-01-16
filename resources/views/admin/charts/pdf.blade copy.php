@extends('layouts.backend.app',[
    'title' => 'Grafico ',
    'pageTitle' => 'Grafico ',
])
@section('content')
@include('layouts.components.datatables')
@include('layouts.components.alert-dismissible')
@section('content')

<!-- Donut Chart -->

<?php //print_r($diputado) ; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
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



    var barChartData = {
        labels: year,
        datasets: [{
            label: 'Senadores ',
            backgroundColor: [
                "rgba(255, 99, 132, 0.2)",
                "rgba(22,160,133, 0.2)",
                "rgba(255, 205, 86, 0.2)",
                "rgba(51,105,232, 0.2)",
                "rgba(244,67,54, 0.2)",
                "rgba(34,198,246, 0.2)",
                "rgba(153, 102, 255, 0.2)",
                "rgba(255, 159, 64, 0.2)",
                "rgba(233,30,99, 0.2)",
                "rgba(205,220,57, 0.2)"
            ],
            borderColor: [
                "rgba(255, 99, 132, 1.0)",
                "rgba(22,160,133, 1.0)",
                "rgba(255, 205, 86, 1.0)",
                "rgba(51,105,232, 1.0)",
                "rgba(244,67,54, 1.0)",
                "rgba(34,198,246, 1.0)",
                "rgba(153, 102, 255, 1.0)",
                "rgba(255, 159, 64, 1.0)",
                "rgba(233,30,99, 1.0)",
                "rgba(205,220,57, 1.0)"
            ],
           // borderWidth: [2,3,4,1, 1, 5, 1, 1,1,4],
            data: user
        }]
    };


    var barChartData2 = {
        labels: year,
        datasets: [{
            label: 'Diputados ',
            backgroundColor: [
                "rgba(255, 99, 132, 0.2)",
                "rgba(22,160,133, 0.2)",
                "rgba(255, 205, 86, 0.2)",
                "rgba(51,105,232, 0.2)",
                "rgba(244,67,54, 0.2)",
                "rgba(34,198,246, 0.2)",
                "rgba(153, 102, 255, 0.2)",
                "rgba(255, 159, 64, 0.2)",
                "rgba(233,30,99, 0.2)",
                "rgba(205,220,57, 0.2)"
            ],
            borderColor: [
                "rgba(255, 99, 132, 1.0)",
                "rgba(22,160,133, 1.0)",
                "rgba(255, 205, 86, 1.0)",
                "rgba(51,105,232, 1.0)",
                "rgba(244,67,54, 1.0)",
                "rgba(34,198,246, 1.0)",
                "rgba(153, 102, 255, 1.0)",
                "rgba(255, 159, 64, 1.0)",
                "rgba(233,30,99, 1.0)",
                "rgba(205,220,57, 1.0)"
            ],
           // borderWidth: [2,3,4,1, 1, 5, 1, 1,1,4],
            data: diputado
        }]
    };

    window.onload = function() {
        var ctx = document.getElementById("canvas").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartData,
            options: {
                elements: {
                    rectangle: {
                        borderWidth: 2,
                        borderColor: '#c1c1c1',
                        borderSkipped: 'bottom'
                    }
                },
                responsive: true,
                title: {
                    display: true,
                    text: 'Elecciones 2021'
                }
            }
        });

        ////////////////////////////
        var ctx2 = document.getElementById("canvas2").getContext("2d");
        window.myBar = new Chart(ctx2, {
            type: 'bar',
            data: barChartData2,
            options: {
                elements: {
                    rectangle: {
                        borderWidth: 2,
                        borderColor: '#c1c1c1',
                        borderSkipped: 'bottom'
                    }
                },
                responsive: true,
                title: {
                    display: true,
                    text: 'Elecciones 2021'
                }
            }
        });

//////////////////
var ctx4 = document.getElementById("myChart");
var myChart = new Chart(ctx4, {
  type: 'pie',
  data: {
    labels: ['Positivos ' +positivo, 'Blancos y Nulos '+negativo],
    datasets: [{
      label: '# of Tomatoes',
      data: [positivo, negativo],
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
    labels: ['Positivos ' +positivo_diputado, 'Blancos y Nulos '+negativo_diputado],
    datasets: [{
      label: '# of Tomatoes',
      data: [positivo_diputado, negativo_diputado],
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

<div class="card-header py-3" >
        <a href="{{ route('charts.create') }}" class="btn btn-primary btn-sm">graficos por localidad - escuelass - mesas </a>

        <a href="{{ route('chart.indexPresidente') }}" class="btn btn-secondary btn-sm">Graficos Presidente </a>
        <a href="{{ route('chart.indexGobernador') }}" class="btn btn-secondary btn-sm">Graficos Gobernador </a>

        <a href="{{ route('chart.indexIntendente') }}" class="btn btn-warning btn-sm">Graficos Intendente </a>

        <a href="{{ route('chart.indexConsejal') }}" class="btn btn-success btn-sm">Graficos Consejal </a>
        <a href="{{ route('chart.indexComunal') }}" class="btn btn-primary btn-sm">Delegado Comunal </a>
        <a href="{{ route('chart.indexDiputadoProvincial') }}" class="btn btn-primary btn-sm">Diputado Provincial </a>

        
    <a href="#" class="btn btn-danger" onclick="saveAsPDF()"><span class="fa fa-download"> Descargar  en PDF   </span></a>
  
    
</div>
<div  id="printableArea">

total_padron <?php echo $total_padron; ?>-  total_votantes <?php echo $total_votantes; ?>
                              



   <div class="col-xl-4 col-lg-5" >
                            <div class="card shadow mb-4 pull-left">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Participacion Senadores</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    


                                    <canvas id="myChart" width="250" height="350"></canvas>
                                    <hr>
                                    Positivos <?php echo $positivo; ?>-  Blancos <?php echo $blanco; ?>
                                    <code> - Nulos <?php echo $nulos; ?></code> .
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4 pull-right">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Participacion Diputados</h6>
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



<div class="d-none" >
    <div class="row" >
        <div class="col-md-10 offset-md-1">
            <div class="panel panel-default ">
                <div class="panel-heading">Senadores</div>
                <div class="panel-body">
                    <canvas id="canvas" height="380" width="600"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>




<div class="d-none">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="panel panel-default">
                <div class="panel-heading">Diputados</div>
                <div class="panel-body">
                    <canvas id="canvas2" height="380" width="600"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
<script type="text/javascript" src="{{ asset('js/html2pdf.bundle.min.js') }}"></script>
<script>

    function saveAsPDF() {
        var element = document.getElementById('printableArea');
        var hoy = <?php echo date("d-m-Y");?>;
        const date_format = new Date();
       
        fecha= 'Graficos '+date_format.getDate()+'/'+ (date_format.getMonth()+ 1) +'/'+date_format.getFullYear();
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