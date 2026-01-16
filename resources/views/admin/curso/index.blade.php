@extends('layouts.backend.app',[
    'title' => 'Administrador curso',
    'pageTitle' => 'Administrador curso',
])
@section('content')
@include('layouts.components.datatables')
@include('layouts.components.alert-dismissible')
<div class="card shadow mb-4">
    <div class="card-footer py-3">
        <a href="{{ route('curso.create') }}" class="btn btn-success btn-sm">Agregar Curso +</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" >
                <thead>
                    <tr>
                        <th style="width: 200px;">Image</th>
                        <th style="width: 150px;">Titulo</th>
                          <th style="width: 150px;">Subitulo</th>

                        <th style="width: 250px;">Cuerpo</th>
                        <th style="width: 150px;">Accion</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cursos as $curso)
                    <tr>
                        <td>
                            <img src="{{ asset('storage/uploads/image/curso/'.$curso->image) }}" width="100" height="80">
                        </td>
                        <td>{{ $curso->titulo }}</td>
                        <td>{{ $curso->subtitulo }}</td>
                        <td>{{ $curso->cuerpo }}</td>
                        <td>
                            <div class="row mx-auto">
                                <a href="{{ route('curso.edit',$curso->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit fa-fw"></i></a>
                                <form method="POST" action="{{ route('curso.destroy',$curso->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Esta seguro de eliminar este curso?')" class="btn btn-danger btn-sm ml-2"><i class="fas fa-trash fa-fw"></i></button>
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