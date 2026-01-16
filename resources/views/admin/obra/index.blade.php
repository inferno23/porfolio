@extends('layouts.backend.app',[
    'title' => 'Administrador obra',
    'pageTitle' => 'Administrador obra',
])
@section('content')
@include('layouts.components.datatables')
@include('layouts.components.alert-dismissible')
<div class="card shadow mb-4">
    <div class="card-footer py-3">
        <a href="{{ route('obra.create') }}" class="btn btn-primary btn-sm">Agregar obra</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th style="width: 150px;">Titulo</th>
                          <th style="width: 150px;">Descripcion</th>

                        <th style="width: 150px;">Fecha</th>
                         <th style="width: 150px;">Hora</th>
                        <th style="width: 150px;">Accion</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($obras as $obra)
                    <tr>
                        <td>
                            <img src="{{ asset('storage/uploads/image/obra/'.$obra->image) }}" width="100" height="100">
                        </td>
                        <td>{{ $obra->titulo }}</td>
                        <td>{{ $obra->descripcion }}</td>
                        <td>{{ $obra->fecha }}</td>
                         <td>{{ $obra->horainicio }}</td>
                        <td>
                            <div class="row mx-auto">
                                <a href="{{ route('obra.edit',$obra->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit fa-fw"></i></a>
                                <form method="POST" action="{{ route('obra.destroy',$obra->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Esta seguro de eliminar este obra?')" class="btn btn-danger btn-sm ml-2"><i class="fas fa-trash fa-fw"></i></button>
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