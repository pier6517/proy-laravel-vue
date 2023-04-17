@extends('dashboard.master')
@section('titulo', 'EditarCategoria')
@section('contenido')
    @include('dashboard.partials.validation-error')
    <div class="container">
    <h1>Editar Categoria</h1>

    <form action="{{ url('dashboard/category',$category->id) }}" method="post">
        @method('PUT')
        @csrf
        {{-- fila1 --}}
        <main>
            <div class="row">
                <div class="form-group">
                    <label for="name">Articulo1</label>
                    <input class="form-control" type="text" name="name" id="name" value="{{ $category->name }}">
                </div>
            </div>
            {{-- fila2 --}}
            <div class="row form-group">
                <label for="description">Contenido2</label>
                <textarea class="form-control" name="description" id="description" cols="30" rows="10">{{ $category->description }}</textarea>
            </div>
            {{-- fila3 --}}
            <div class="row center">
                <div class="col s6">
                    <button class="btn btn-success btn-sm" type="submit">Guardar</button>
                    <a href="{{ url('dashboard/category') }}" class="btn btn-secundary btn-sm">Cancelar</a>
                </div>

            </div>
        </main>

    </form>
</div> 
@endsection
