@extends('layouts.backend.app',[
    'title' => 'Administrador paginas de Inicio',
    'pageTitle' => 'Administrador paginas de Inicio',
])
@section('content')
@include('layouts.components.datatables')
@include('layouts.components.alert-dismissible')

<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<div class="card shadow mb-4">
    <div class="card-footer py-3">
        <a href="{{ route('page.create') }}" class="btn btn-success btn-sm">Agregar Registro +</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>Titulo</th>
                        <th>Descripcion</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pages as $page)
                    <tr>
                        <td>
                            <img src="{{ asset('storage/uploads/image/page/'.$page->image) }}" width="50" height="50">
                        </td>
                        <td>{{ $page->title }}</td>
                        <td>
                            <div class="quill-view-content">
                                <!-- This is the key part: unescaped output -->
                              

                                {{ Str::limit(strip_tags($page->description), 60) }}
                            </div>
                            
                            
                          </td>
                        <td>
                            <div class="row mx-auto">

                                <a href="{{ route('page.show',$page->id) }}" class="btn btn-secondary btn-sm"><i class="fa fa-eye"></i></a>

                                <a href="{{ route('page.edit',$page->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit fa-fw"></i></a>
                                <form method="POST" action="{{ route('page.destroy',$page->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Esta seguro de eliminar el registro ?')" class="btn btn-danger btn-sm ml-2"><i class="fas fa-trash fa-fw"></i></button>
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