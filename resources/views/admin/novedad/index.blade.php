@extends('layouts.backend.app',[
    'title' => 'Administrador novedad',
    'pageTitle' => 'Administrador novedad',
])
@section('content')
@include('layouts.components.datatables')
@include('layouts.components.alert-dismissible')
<div class="card shadow mb-4">
    <div class="card-footer py-3">
        <a href="{{ route('novedad.create') }}" class="btn btn-primary btn-sm">Agregar novedad</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Titulo</th>
                         <th>Subtitulo</th>
                          <th>Cuerpo</th>

                        <th>Fecha</th>
                        
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($novedades as $novedad)
                    <tr>
                        <td>
                            <img src="{{ asset('storage/uploads/image/novedad/'.$novedad->image) }}" width="50" height="50">
                        </td>
                        <td>{{ $novedad->titulo }}</td>
                        <td>{{ substr($novedad->subtitulo, 0, 50) }}</td>
                        <td>{{ substr($novedad->cuerpo, 0, 50) }}</td>
                        <td>{{ $novedad->fecha }}</td>
                        <td>
                            <div class="row mx-auto">
                                <a href="{{ route('novedad.edit',$novedad->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit fa-fw"></i></a>
                                <form method="POST" action="{{ route('novedad.destroy',$novedad->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Esta seguro de eliminar este novedad?')" class="btn btn-danger btn-sm ml-2"><i class="fas fa-trash fa-fw"></i></button>
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