@extends('layouts.backend.app',[
	'title' => 'Cargar Telegrama - Consulting Group',
	'pageTitle' => 'Cargar Telegrama',
])
@section('content')
@include('layouts.components.datatables')
@include('layouts.components.alert-dismissible')
<div class="card shadow mb-4">
    
    @if(\Auth::user()->role== 1 ||\Auth::user()->role== 2 || \Auth::user()->role== 4 || \Auth::user()->role== 5 || \Auth::user()->role== 6 || \Auth::user()->role== 7 || \Auth::user()->role== 8)
    <div class="card-header py-3">
    	<a href="{{ route('telegrama.index') }}" class="btn btn-danger btn-sm">Listado</a>
    </div>
    @endif
    
    <div class="card-body"><h1>Elecciones Nacionales</h1>
        <form method="POST" action="{{ route('telegrama.store') }}" enctype="multipart/form-data">
            @csrf
          
            <div class="form-group">
                <label for="mesa">N° de Mesa</label>
                <div class="col-xs-3 col-sm-3 col-md-3"> 
                <input required class="form-control @error('mesa') is-invalid @enderror" name="mesa" id="mesa" type="number" min="1">
                @error('mesa')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="mesa">Cantidad de Electores habilitados según Padrón</label>
                <div class="col-xs-3 col-sm-3 col-md-3"> 
                <input required class="form-control @error('total_padron') is-invalid @enderror" name="total_padron" id="total_padron" type="number" min="1">
                @error('total_padron')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                </div>
            </div>
           
            <div class="form-group">
                <label for="mesa">Cantidad de Electores que votaron</label>
                <div class="col-xs-3 col-sm-3 col-md-3"> 
                <input required class="form-control @error('cantidad_votantes') is-invalid @enderror" name="cantidad_votantes" id="cantidad_votantes" type="number" min="1">
                @error('cantidad_votantes')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                </div>
            </div>
           
            <div class="form-group">
                <label for="mesa">Cantidad de Sobres en la Urna</label>
                <div class="col-xs-3 col-sm-3 col-md-3"> 
                <input required class="form-control @error('cantidad_sobres') is-invalid @enderror" name="cantidad_sobres" id="cantidad_sobres" type="number" min="1">
                @error('cantidad_sobres')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                </div>
            </div>
            
            <div class="form-group">
                <label for="customFile">Foto del Telegrama</label>
                <div class="col-xs-3 col-sm-3 col-md-3"> 
                <div class="custom-file">
                  <input required type="file" name="file" class="custom-file-input @error('file') is-invalid @enderror" id="customFile">
                  <label class="custom-file-label" for="customFile">Subir imagen</label>
                </div>
                @error('file')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-12 col-sm-12 col-md-12"> 
                    <label>A continuación copie los datos del telegrama según el partido político correspondiente:</label>
                </div>
            </div>
            
            <div class="content">
                <div class="hack1">
                    <div class="hack2">
                        <table  width="100%" cellspacing="0">
                        <thead>
                            <tr>
                            <th>Lista</th>
                            <th width="100%" colspan="3">Partido Político</th>
                            <th>Senador</th>
                            <th>Diputado</th>
                            <th>Presidente</th>
                            <th>Gobernador</th>
                            <th>Diputado Prov</th>
                            <th>Intendente</th>
                            <th>Concejal</th>
                            <th>Delegado Comunal</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                                   @foreach($candidatos as $model)
                                   <tr>
                                   <td  >
                                   @if(!empty($model->lista ))    
                                   <label>{{ $model->lista }}</label>
                                   @else
                                   <label>-</label>
                                   @endif
                                    </td> 
                                    <td  width="100%" colspan="3" >   <label>{{ $model->partido }}</label>
                                    </td>
                                    <td> 
                                        
                                    @if(!empty($model->senador ))    
                                    <input class="form-control @error('valor') is-invalid @enderror" name="valor[]" id="valor" type="">
                                    @else
                                    <input class="form-control" name="valor[]" id="valor" readonly  placeholder=" XXX "  style = "background-color:red;" >
                                    @endif
                                   </td>
        
                                    <td> 
                                    @if(!empty($model->diputado ))    
                                    <input class="form-control @error('valor2') is-invalid @enderror" name="valor2[]" id="valor2" type="">
                                    @else
                                    <input class="form-control" name="valor2[]" id="valor2" readonly  placeholder=" XXX "  style = "background-color:red;" >
                                    @endif                        
                                    </td>
        
                                    <td>
        
                                    @if(!empty($model->presidente )) 
                                    <input class="form-control @error('valor3') is-invalid @enderror" name="valor3[]" id="valor3" type="">   
                                    
                                    @else
                                    <input class="form-control" name="valor3[]" id="valor3" readonly  placeholder=" XXX "  style = "background-color:red;" >
                                    @endif 
        
                                    </td>
        
                                    <td>
                                        
                                    @if(!empty($model->gobernador )) 
                                    <input class="form-control @error('valor4') is-invalid @enderror" name="valor4[]" id="valor4" type=""> 
                                    @else
                                    <input class="form-control" name="valor4[]" id="valor4" readonly  placeholder=" XXX "  style = "background-color:red;" >
                                    @endif 
                                    
                                    
                                     </td>
                                     <td>
                                        
                                        @if(!empty($model->diputado_provincial )) 
                                        <input class="form-control" name="valor5[]" id="valor5" type=""> 
                                        @else
                                        <input class="form-control" name="valor5[]" id="valor5" readonly  placeholder=" XXX "  style = "background-color:red;" >
                                        @endif 
                                        
                                        
                                         </td>
                                     <td>
                                        
                                        @if(!empty($model->intendente )) 
                                        <input class="form-control" name="valor6[]" id="valor6" type=""> 
                                        @else
                                        <input class="form-control" name="valor6[]" id="valor6" readonly  placeholder=" XXX "  style = "background-color:red;" >
                                        @endif 
                                                                        
                                         </td>
        
                                         <td>
                                        
                                        @if(!empty($model->concejal )) 
                                        <input class="form-control" name="valor7[]" id="valor7" type=""> 
                                        @else
                                        <input class="form-control" name="valor7[]" id="valor7" readonly  placeholder=" XXX "  style = "background-color:red;" >
                                        @endif 
                                        
                                        
                                         </td>
                                         <td>
                                        
                                        @if(!empty($model->municipal )) 
                                        <input class="form-control" name="valor8[]" id="valor8" type=""> 
                                        @else
                                        <input class="form-control" name="valor8[]" id="valor8" readonly  placeholder=" CXXX "  style = "background-color:red;" >
                                        @endif 
                                        
                                        
                                         </td>
        
        
                                    <td > <input class="form-control @error('candidato') is-invalid @enderror" name="candidato[]"   value="{{ $model->id }}"  type="hidden">
                                    </td> 
                                   @endforeach
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="mesa">Registrado por: {{ Auth::user()->name}} - {{ Auth::user()->id}}</label>
                <input class="form-control @error('user_id') is-invalid @enderror" value="{{ Auth::user()->id}}" name="user_id" id="user_id" type="hidden">
               
                <input class="form-control @error('localidad_id') is-invalid @enderror" value="{{ Auth::user()->localidad_id}}" name="localidad_id" id="localidad_id" type="hidden">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-sm">Registrar Telegrama</button>
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