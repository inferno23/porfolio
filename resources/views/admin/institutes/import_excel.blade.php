@extends('layouts.backend.app',[
    'title' => 'Instituciones',
    'pageTitle' => 'Instituciones',
])
@section('content')
@include('layouts.components.datatables')
@include('layouts.components.alert-dismissible')

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{__('Instituciones')}}</h1>
               
            </div>
            <div class="section-body">
            <div class="container">
   <h3 align="center">Importar Excel para las Instituciones</h3>
    <br />
  

  
   <form method="post" enctype="multipart/form-data" action="{{ url('admin/import_excel/import') }}">
    {{ csrf_field() }}
    <div class="form-group">
     <table class="table">
      <tr>
       <td width="40%" align="right"><label>Seleccione el archivo excel a procesar</label></td>
       <td width="30">
        <input type="file" name="select_file" />
       </td>
       <td width="30%" align="left">
        <input type="submit" name="upload" class="btn btn-primary" value="Procesar Archivo excel">
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
@endsection


