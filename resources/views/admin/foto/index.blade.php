@extends('layouts.backend.app',[
    'title' => 'Administrador foto',
    'pageTitle' => 'Administrador foto',
])
@section('content')
@include('layouts.components.datatables')
@include('layouts.components.alert-dismissible')
<div class="card shadow mb-4">
    <div class="card-footer py-3">
        <a href="{{ route('foto.create') }}" class="btn btn-success btn-sm">Agregar foto +</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" >
                <thead>
                    <tr>
                        <th style="width: 200px;">Image</th>
                        <th style="width: 150px;">Titulo</th>
                       
                        <th style="width: 150px;">Accion</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($fotos as $foto)
                    <tr>
                        <td>
                            <img src="{{ asset('storage/uploads/image/foto/'.$foto->image) }}" width="100" height="80">
                        </td>
                        <td>{{ $foto->titulo }}</td>
                       
                        <td>
                            <div class="row mx-auto">
                                <a href="{{ route('foto.edit',$foto->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit fa-fw"></i></a>
                                <form method="POST" action="{{ route('foto.destroy',$foto->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Esta seguro de eliminar esta foto?')" class="btn btn-danger btn-sm ml-2"><i class="fas fa-trash fa-fw"></i></button>
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