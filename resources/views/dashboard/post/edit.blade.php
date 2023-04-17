@extends('dashboard.master')
@section('titulo', 'EditarPost')
@section('contenido')
 @include('dashboard.partials.validation-error')
 <div class="container">
    <h1>Editar post</h1>

    <form action="{{ url('dashboard/post/'.$post->id) }}" method="post">
        @method("PUT")
        @csrf
        {{-- fila1 --}}
        <main>
            <div class="row">
                <div class="form-group">
                    <label for="name">Articulo</label>
                    <input class="form-control" type="text" name="name" id="name" value="{{ $post->name }}">
                </div>
            </div>
            {{-- fila2 --}}
            <div class="row form-group">
                <label for="description">Contenido</label>
                <textarea class="form-control" name="description" id="description" cols="30" rows="10">{{ $post->description }}</textarea>
            </div>

            <div class="row form-group">
                <label for="description">Categoria</label>
                <select name="category" id="category">
                    <option value="">Seleccionar una categoria</option>
                    @foreach ($category as $category  )
                    <option value="{{ $category->id }}" @if($category->id==$post->category_id){{ 'selected' }} @endif>{{ $category->name }}</option>                        
                    @endforeach
                </select>
            {{-- fila4 --}}
            <div class="row center">
                <div class="col s6">
                    <button class="btn btn-success btn-sm" type="submit">Guardar</button>
                    <a href="{{ url('dashboard/post') }}" class="btn btn-secundary btn-sm">Cancelar</a>
                </div>

            </div>
        </main>

    </form>
</div>
@endsection
