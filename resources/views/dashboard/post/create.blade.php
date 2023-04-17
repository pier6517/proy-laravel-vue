@extends('dashboard.master')
@section('titulo', 'AgregarPost')
@section('contenido')
    @include('dashboard.partials.validation-error')
    <div class="container">
    <h1>Registrar post</h1>

    <form action="{{ route('post.store') }}" method="post">
        @csrf
        {{-- fila1 --}}
        <main>
            <div class="row">
                <div class="form-group">
                    <label for="name">Articulo</label>
                    <input class="form-control" type="text" name="name" id="name">
                </div>
            </div>
            {{-- fila2 --}}
            <div class="row form-group">
                <label for="description">Contenido</label>
                <textarea class="form-control" name="description" id="description" cols="30" rows="10"></textarea>
            </div>
            {{-- fila3 --}}
            <div class="row form-group">
                <label for="category_id">Categoria</label>
                <select name="category_id" id="category_id">
                    <option value="">Seleccionar una categoria</option>
                    @foreach ($category as $category  )
                    <option value="{{ $category->id }}">{{ $category->name }}</option>                        
                    @endforeach
                </select>
            </div>


            <div class="row center">
                <div class="col s6">
                    <button class="btn btn-success btn-sm" type="submit">Publicar</button>
                    <a href="{{ url('dashboard/post') }}" class="btn btn-secundary btn-sm">Cancelar</a>
                </div>

            </div>
        </main>

    </form>
    </div>
@endsection 
