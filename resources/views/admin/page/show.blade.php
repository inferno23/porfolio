@extends('layouts.backend.app',[
    'title' => 'Manage page',
    'pageTitle' => 'Manage page',
])
@section('content')
@include('layouts.components.datatables')
@include('layouts.components.alert-dismissible')

<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">


@section('content')
<div class="card-header py-3">
    <a href="{{ route('page.index') }}" class="btn btn-danger btn-sm"><- volver al Listado</a>
</div>
    <div class="row mt-4">

        <img src="{{ asset('storage/uploads/image/page/'.$page->image) }}" width="950" height="550">

       
       
        
        <div class="col">
            <table width="600">
                <tr>

                    
                    <td>Titulo</td>
                    <td>{{ $page->title }}</td>
                </tr>
               
                <tr>
                    <td>Creada</td>
                    <td>{{ date('d-m-Y', strtotime($page->created_at)) }}</td>
                </tr>
                <tr>
                    <td>Ultima Modificacion</td>
                    <td>{{ date('d-m-Y', strtotime($page->updated_at)) }}</td>
                </tr>
                
            </table>
        </div>

        
    </div>
    <div class="quill-view-content">
        <!-- This is the key part: unescaped output -->
        {!! $page->description !!}
    </div>
@endsection