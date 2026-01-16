@extends('layouts.backend.app',[
	'title' => 'Nueva telegrama',
	'pageTitle' => 'Nueva telegrama',
])
@section('content')
@include('layouts.components.datatables')
@include('layouts.components.alert-dismissible')
<div class="card shadow mb-4">
    <div class="card-header py-3">
    	<a href="{{ route('telegrama.index') }}" class="btn btn-danger btn-sm">Listado</a>
    </div>
    <div class="card-body"><h1>Solo Consejales de la Localidad: {{ $localidad->localidad }}</h1>
        <form method="POST" action="{{ route('telegrama.storeConsejal') }}" enctype="multipart/form-data">
            @csrf
          
                     

            <div class="form-group">
                <label for="mesa">Mesa</label>
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
                <label for="mesa">Total que figura en el padron</label>
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
                <label for="mesa">Cantidad de Personas que han votado</label>
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
                <label for="customFile">Imagen</label>
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
                        <div class="col-xs-6 col-sm-6 col-md-6"> 
                            <label>Datos:</label>
                <table  width="100%" cellspacing="0">
                <thead>
                    <tr>
                    <th>Lista</th>
                        
                                            
                        <th width="100%" colspan="3">Partido</th>
                        
                      
                        <th>Consejal</th>
                    </tr>
                </thead>
                <tbody>
                           @foreach($concejales as $model)
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
                                
                                @if(!empty($model->concejal )) 
                                <input class="form-control" name="valor7[]" id="valor7" type=""> 
                                @else
                                <input class="form-control" name="valor7[]" id="valor7" readonly  placeholder=" CXXX "  style = "background-color:red;" >
                                @endif 
                                
                                
                                 </td>



                            <td > <input class="form-control @error('candidato') is-invalid @enderror" name="candidato[]"   value="{{ $model->id }}"  type="hidden">
                            </td> 
                           @endforeach
                </tbody>
            </table>
                            
            </div>




            <div class="form-group">
                <label for="mesa">Registrado por:{{ Auth::user()->name}} - {{ Auth::user()->id}}</label>
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