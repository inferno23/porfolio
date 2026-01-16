@extends('layouts.backend.app',[
    'title' => 'Planilla de Fiscales - Consulting Group',
    'pageTitle' => 'Planilla de Fiscales',
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


           $('#category').change(function () {
             var id = $(this).val();

             $('#subCategory').find('option').not(':first').remove();

             $.ajax({
                url:'localidad/getLocalidadxregistro/'+id,
                type:'get',
                dataType:'json',
                success:function (response) {
                    var len = 0;
                    if (response.data != null) {
                        len = response.data.length;
                    }

                    if (len>0) {
                        $("#subCategory option[value='0']").remove();
                        for (var i = 0; i<len; i++) {
                             var id = response.data[i].id;
                             var name = response.data[i].localidad;

                             var option = "<option value='"+id+"'>"+name+"</option>"; 

                             $("#subCategory").append(option);
                        }
                        $( "#subCategory" ).focus();
                      //  $("#subCategory").css("background-color", "rgb(234 245 233)");
                       // $("#subCategory").css("border-color", "#bac8f3");
                        $("#subCategory").css("border-color", "#002060");
                        
                    }
                }
             })
           });
        });
    </script>
<div class="card shadow mb-4">
    <div class="card-header py-3">

<a href="{{ route('persona.buscar') }}" class="btn btn-primary btn-sm">Nuevo</a>
<a href="{{ route('registro.export') }}" class="btn btn-success btn-sm"><i class="fa fa-file-excel" aria-hidden="true" style="color:whie"> Exportar</i></a>

    
        
    </div>
    <div class="card-body">
                       
    </div>


    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                                             
                        <th>Nombre y Apellido</th>
                        <th>DNI</th>
                        <th>Domicilio</th>
                        <th>Contacto</th>
                        <th>Escuela</th>
                        <th>FG</th>
                        <th>FM</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($registros as $model)
                    <tr>
                      
                        <td>{{ !empty($model->persona) ? $model->persona->nombre:'Sin asignar' }}</td>
                        <td>{{ !empty($model->persona) ? $model->persona->dni:'Sin asignar' }}</td>
                        <td>{{ $model->domicilio_real }}</td>
                        <td>{{ $model->telefono }}</td>
                        <td>{{ !empty($model->escuela) ? $model->escuela->name:'Sin asignar' }}</td>
                        <td {{ !empty($model->fiscal_general) ? 'class=btn-success ':'' }}>{{ !empty($model->fiscal_general) ? 'fiscal_general':'' }}</td>
                        <td>{{ !empty($model->fiscal_mesa) ? 'Mesa:'.$model->mesa:'' }}</td>
  
                        <td>
                            <div class="row mx-auto">
                                <a href="{{ route('registro.edit',$model->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit fa-fw"></i></a>
                                <a href="{{ route('registro.show',$model->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-eye fa-fw"></i></a>
                           
                               
                                <form method="POST" action="{{ route('registro.destroy',$model->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Desea Eliminar este registro {{ $model->nombre }}  ?')" class="btn btn-danger btn-sm ml-2"><i class="fas fa-trash fa-fw"></i></button>
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