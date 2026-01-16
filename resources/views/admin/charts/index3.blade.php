
@extends('layouts.backend.app',[
    'title' => 'Reportes - Consulting Group',
    'pageTitle' => 'Grafico',
])
@section('content')
@include('layouts.components.datatables')
@include('layouts.components.alert-dismissible')
@section('content')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
 
 </head>
   <body>
     <h2 style="text-align: center;">Google Bar Chart Integration in Laravel 8 Tutorial</h2>
     <div class="container-fluid p-5">
     <div id="barchart_material" style="width: 100%; height: 500px;"></div>
     </div>
  
     <script type="text/javascript">
  
       google.charts.load('current', {'packages':['bar']});
       google.charts.setOnLoadCallback(drawChart);
  
       function drawChart() {
         var data = google.visualization.arrayToDataTable([
             ['Order Id', 'senador', 'diputado'],
  
             @php
               foreach($orders as $order) {
                   echo "['".$order->id."', '".$order->votos_senador."', '".$order->votos_diputado."'],";
               }
             @endphp
         ]);
  
         var options = {
           chart: {
             title: 'Bar Graph | Price',
             subtitle: 'Price, and Product Name: @php echo $orders[0]->created_at @endphp',
           },
           bars: 'vertical'
         };
         var chart = new google.charts.Bar(document.getElementById('barchart_material'));
         chart.draw(data, google.charts.Bar.convertOptions(options));
       }
     </script>

@endsection