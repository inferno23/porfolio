@extends('layouts.backend.app',[
	'title' => 'Edit About',
	'pageTitle' => 'Edit About',
])
@section('content')
@include('layouts.components.datatables')
@include('layouts.components.alert-dismissible')
<div class="card shadow mb-4">
    <div class="card-header py-3">
    	<a href="{{ route('about.index') }}" class="btn btn-danger btn-sm"><- Volver al Listado</a>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('about.update',$about->id) }}">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="title">Titulo</label>
                <input required value="{{ $about->title }}" class="form-control @error('title') is-invalid @enderror" name="title" id="title" type="">
                @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Descripcion</label>
                <input required value="{{ $about->description }}" class="form-control @error('description') is-invalid @enderror" name="description" id="description" type="">
                @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Nombre</label>
                <input required value="{{ $about->name }}" class="form-control @error('name') is-invalid @enderror" name="name" id="name" type="">
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input required value="{{ $about->email }}" class="form-control @error('email') is-invalid @enderror" name="email" id="email" type="">
                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="phone">Telefono</label>
                <input required value="{{ $about->phone }}" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" type="">
                @error('phone')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="role">Rol</label>
                <input required value="{{ $about->role }}"  class="form-control @error('role') is-invalid @enderror" name="role" id="role" type="">
                @error('role')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-sm">Modificar Registro</button>
            </div>
        </form>
    </div>
</div>
@stop