@extends('dashboard.master')
@section('titulo', 'AgregarPost')
@section('contenido')
@include('dashboard.partials.validation-error')
<div class="container">  

    <form action="{{ route('category.store') }}" method="post">
        @csrf
        {{-- fila1 --}}
        <main>
            <div class="container py-4">
                <h1>Registrar Categoria</h1>

            </div>
            <div class="row">
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input class="form-control" type="text" name="name" id="name">
                </div>
            </div>
            {{-- fila2 --}}
            <div class="row form-group">
                <label for="description">Descripcion</label>
                <textarea class="form-control" name="description" id="description" cols="30" rows="10"></textarea>
            </div>
            {{-- fila3 --}}
            <div class="row center">
                <div class="col s6">
                    <button class="btn btn-success btn-sm" type="submit">Registrar</button>
                    <a href="{{ url('dashboard/category') }}" class="btn btn-secundary btn-sm">Cancelar</a>
                </div>

            </div>
        </main>

    </form>
</div>
@endsection 