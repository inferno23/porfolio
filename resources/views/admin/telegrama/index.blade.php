@extends('layouts.backend.app',[
    'title' => 'Telegrama - Consulting Group',
    'pageTitle' => 'Telegrama',
])
@section('content')
@include('layouts.components.datatables')
@include('layouts.components.alert-dismissible')

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript">
  

        $(document).ready(function () {
/////dataTable//////////////////////////////////////
            $('#dataTable').DataTable( {
              
                
                    language: {
                        "sProcessing":    "Procesando...",
                        "sLengthMenu":    "Mostrar _MENU_ registros",
                        "sZeroRecords":   "No se encontraron resultados",
                        "sEmptyTable":    "Ningún dato disponible en esta tabla",
                        "sInfo":          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                        "sInfoEmpty":     "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
                        "sInfoPostFix":   "",
                        search: "Buscar:",
                        "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },
                    }
          } );
          /////////




           
           
        });
    </script>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="{{ route('telegrama.create') }}" class="btn btn-primary btn-sm">Nuevo</a>
        <a href="{{ route('telegrama.export') }}" class="btn btn-success btn-sm"><i class="fa fa-file-excel" aria-hidden="true" style="color:whie"> Exportar</i></a>

        
    </div>
    <div class="card-body">
   
       
            <table  width="100%" cellspacing="0">
                <thead>
                    <tr>
                                                
                                               
                       
                        <th>Lista</th>
                        <th>Organización Política</th>
                        <th>Senador</th>
                        <th>Diputados</th>
                        <th>Presidente</th>
                        <th>Gobernador</th>
                        <th>Diputado Prov</th>
                        <th>Intendente</th>
                        <th>Concejal</th>
                        <th>Comunal</th>
                        
                    </tr>
                </thead>

                <tbody>
                    @foreach($votos_senador as $model)
                    <tr>
                    <td>{{ !empty($model->lista	) ? $model->lista:' ' }}</td>
                    <td>{{ !empty($model->partido	) ? $model->partido:' ' }}</td>
                                   <td>{{ !empty($model->sum	) ? $model->sum:'0' }}</td>
                                   <td>{{ !empty($model->votos_diputado	) ? $model->votos_diputado:'0' }}</td>
                                   <td>{{ !empty($model->votos_presidente	) ? $model->votos_presidente:'0' }}</td>
                                   <td>{{ !empty($model->votos_gobernador	) ? $model->votos_gobernador:'0' }}</td>
                                   <td>{{ !empty($model->votos_diputado_prov	) ? $model->votos_diputado_prov:'0' }}</td>
                                   <td>{{ !empty($model->votos_intendente	) ? $model->votos_intendente:'0' }}</td>
                                   <td>{{ !empty($model->votos_consejal	) ? $model->votos_consejal:'0' }}</td>
                                   <td>{{ !empty($model->votos_comunal	) ? $model->votos_comunal:'0' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
   


    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                                               
                                                <th>Mesa</th>
                       
                        <th>Lista</th>
                       
                        <th>Partido</th>
                        <th>Presidente</th>
                        <th>Senador</th>
                        <th>Diputado</th>
                        <th>Gobernador</th>
                        <th>Dip Prov</th>
                        <th>Intendente</th>
                        <th>Concejal</th>
                        <th>Comunal</th>
                       
                      
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($telegramas as $model)
                    <tr>
                       
                        <td>{{ !empty($model->mesa) ? ''.$model->mesa:'' }}</td>
  
                        <td>{{ !empty($model->candidato_id) && $model->candidato_id > 0 ? $model->candidato->lista:'- ' }}</td>
                         <td>{{ !empty($model->candidato_id) && $model->candidato_id > 0 ? $model->candidato->partido:'- ' }}</td>
                         <td>{{ !empty($model->votos_presidente	) ? $model->votos_presidente:'0' }}</td>
                        <td>{{ !empty($model->votos_senador	) ? $model->votos_senador:'0' }}</td>
                        <td>{{ !empty($model->votos_diputado	) ? $model->votos_diputado:'0' }}</td>
                        <td>{{ !empty($model->votos_gobernador	) ? $model->votos_gobernador:'0' }}</td>
                        <td>{{ !empty($model->votos_diputado_prov	) ? $model->votos_diputado_prov:'0' }}</td>
                        <td>{{ !empty($model->votos_intendente	) ? $model->votos_intendente:'0' }}</td>
                        <td>{{ !empty($model->votos_consejal	) ? $model->votos_consejal:'0' }}</td>
                        <td>{{ !empty($model->votos_comunal	) ? $model->votos_comunal:'0' }}</td>
                      
                      
                       
                        <td>
                            <div class="row mx-auto">
                            <a href="{{ asset('/uploads/telegrama/'.$model->imagen) }}" target="_blank">
                             <img src="{{ asset('/uploads/telegrama/'.$model->imagen) }}" width="50" height="50">
                         
</a>
                            <a href="{{ route('telegrama.show',$model->mesa) }}" class="btn btn-success btn-sm" title="Excel de la mesa" alt="Excel de la mesa"><i class="fas fa-eye fa-fw"></i></a>
                           
                                 <form method="POST" action="{{ route('telegrama.destroy',$model->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Desea Eliminar este telegrama {{ $model->nombre }}  ?')" class="btn btn-danger btn-sm ml-2"><i class="fas fa-trash fa-fw"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop