@extends('layouts.backend.app',[
	'title' => 'Asignar Fiscal General - Consulting Group',
	'pageTitle' => 'Asignar Fiscal General',
])
@section('content')
@include('layouts.components.datatables')
@include('layouts.components.alert-dismissible')


<script src="https://code.jquery.com/jquery-3.3.1.js"></script>

<script type="text/javascript">
        $(document).ready(function () {
           $('#institucion_id').change(function () {
             var id = $(this).val();
            // alert(id);

             $('#mesa').find('option').not(':first').remove();

             $.ajax({
                url:'getMesasxEscuela/'+id,
                type:'get',
                dataType:'json',
                success:function (response) {
                    var len = 0;
                    if (response.data != null) {
                        len = response.data.length;
                    }
                   // alert(len);
                    if (len>0) {
                        $("#mesa option[value='0']").remove();
                        $("#mesa").empty();
                        for (var i = 0; i<len; i++) {
                           // alert(response.data[i]);
                             var id = response.data[i];
                             var name = response.data[i];

                             var option = "<option value='"+id+"'>"+name+"</option>"; 

                             $("#mesa").append(option);
                        }
                        $( "#mesa" ).focus();
                      //  $("#subCategory").css("background-color", "rgb(234 245 233)");
                       // $("#subCategory").css("border-color", "#bac8f3");
                        $("#mesa").css("border-color", "#002060");
                        
                    }
                }
             })
           });
        });
    </script>
<div class="card shadow mb-4">
    <div class="card-header py-3">
    	<a href="{{ route('admin.registro.listado') }}" class="btn btn-danger btn-sm">Listado</a>
    	<a href="{{ route('persona.buscar2') }}" class="btn btn-primary btn-sm">Atrás</a>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('registro.store') }}" enctype="multipart/form-data">
            @csrf
          
           
            <div class="form-group">
                <label for="title">Fiscal: </label>
                <label class="btn-success">{{ $persona->nombre }} - DNI {{ $persona->dni }} - Institución: {{ $persona->institucion }} - Mesa: {{ $persona->mesa }} - N° de Orden: {{ $persona->orden }}</label>
            <input  value="{{ $persona->id }}" class="form-control @error('persona_id') is-invalid @enderror" name="persona_id" id="persona_id" type="hidden">
             
            @error('persona_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <input  value="." class="hidden"  name="descripcion" id="descripcion" type="hidden">
            <input  value="{{ Auth::id()}}" class="hidden"  name="user_id" id="user_id" type="hidden">
          
            <div class="form-group">
                        <div class="col-xs-8 col-sm-8 col-md-8"> 
                            <label>Institución</label>
                            
                            <select required name="institucion_id" id="institucion_id" class="form-control">
                                <option value="">-- Seleccione una escuela --</option>
                                @foreach($instituciones as $model)
                                  <option value="{{ $model->id }}" <?php if( $persona->mesa >= $model->mdesde  && $persona->mesa <= $model->mhasta) echo "selected"; else echo "mm"; ?> >{{$model->name}} - Mesas desde: {{ $model->mdesde }} hasta: {{ $model->mhasta }}</option>
                                @endforeach
                            </select>
                            </div>
            </div>




            <div class="form-group">
                <label for="dni">Fiscal General</label>
                <div class="col-xs-3 col-sm-3 col-md-3"> 
                <select class="form-control" name="fiscal_general" id="fiscal_general">
                <option value="0">Sin asignar</option>
            <option value="1" class="btn-success"> Asignar como Fiscal General</option>
       
            
        
              </select>
              </div>
            </div>
            <div class="form-group">
                <label for="dni">Fiscal de Mesa</label>
                <div class="col-xs-3 col-sm-3 col-md-3"> 
                <select class="form-control" name="fiscal_mesa" id="fiscal_mesa">
                <option value="0">Sin asignar</option>
            <option value="1" class="btn-success"> Asignar como Fiscal de Mesa</option>
       
            
        
              </select>
            </div>
            </div>
           

            <div class="form-group">
                        <div class="col-xs-6 col-sm-6 col-md-6"> 
                            <label>Mesa</label>
                            <select name="mesa" id="mesa" class="form-control">
                                <option value="0">-- Seleccione una mesa para asignar Fiscal --</option>
                                <?php
$mensaje='Esta Institución, no tiene asignado un FG';
$class='btn-warning';
                                $array_num = count($data);
                                for ($i = 0; $i < $array_num; ++$i){
                                    //print $data[$i];
                                    $cadena_buscada   = 'FISCAL GENERAL';
                                    $posicion_coincidencia = strpos($data[$i], $cadena_buscada);
                                    
                                    //se puede hacer la comparacion con 'false' o 'true' y los comparadores '===' o '!=='
                                    if ($posicion_coincidencia === false) {
                                        echo '<option value="'.$data[$i].'">'.$data[$i].'</option>'; 
                                        } else {
                                            $mensaje='FISCAL GENERAL'. $data[$i];
                                            $class='btn-success';
                                            echo '<option class="btn-success" value="'.$data[$i].'">'.$data[$i].'</option>'; 
                                                }

                                    //echo '<option value="'.$data[$i].'">'.$data[$i].'</option>'; 
                                }

                                ?>
                            </select>
                            


                            </div>
            </div>


            <div class="form-group {{ $class }}">
            <div class="col-xs-4 col-sm-4 col-md-4"> 
                <label for="mensaje">{{ $mensaje }}</label>
                </div>
            </div>
            <div class="form-group">
                <label for="mesa">Domicilio de Contacto</label>
                <div class="col-xs-4 col-sm-4 col-md-4"> 
                <input class="form-control @error('domicilio_real') is-invalid @enderror" name="domicilio_real" id="domicilio_real" type="">
                @error('domicilio_real')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="mesa">Teléfono de Contacto</label>
                <div class="col-xs-3 col-sm-3 col-md-3"> 
                <input class="form-control @error('telefono') is-invalid @enderror" name="telefono" id="telefono" type="">
                @error('telefono')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="mesa">Registrado por: {{ Auth::user()->name}}</label>
               
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