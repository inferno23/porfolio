@extends('layouts.backend.app',[
    'title' => 'Manage Header',
    'pageTitle' => 'Manage Header',
])
@section('content')
@include('layouts.components.datatables')
@include('layouts.components.alert-dismissible')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="{{ route('header.create') }}" class="btn btn-success btn-sm">Agregar Registro +</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>Titulo</th>
                        <th>Navbar Titulo</th>
                        <th>Texto Superior</th>
                        <th>Texto Inferior</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($headers as $header)
                    <tr>
                        <td><img src="{{ asset('storage/uploads/image/header/'.$header->image) }}" width="50" height="50"></td>
                        <td>{{ $header->title }}</td>
                        <td>{{ $header->navbar_title }}</td>
                       
                          <td>{{ Str::limit($header->up_text,50) }}</td>
                          <td>{{ Str::limit($header->down_text,50) }}</td>
                        <td>
                            <div class="row mx-auto">
                                <a href="{{ route('header.edit',$header->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit fa-fw"></i></a>
                                <form method="POST" action="{{ route('header.destroy',$header->id) }}">
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