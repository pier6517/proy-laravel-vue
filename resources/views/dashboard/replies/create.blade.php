@extends('dashboard.master')
@section('titulo', 'AgregarPost')
@section('contenido')
@include('dashboard.partials.validation-error')
<div class="container">  

    <form action="{{ route('reply.store') }}" method="post">
        @csrf
        {{-- fila1 --}}
        <main>
            <div class="container py-4">
                <h1>Registar respuesta</h1>

            </div>
            <div class="row">
                <div class="form-group">
                    <label for="name">publicacion</label>
                    <select name="post_id" id="post_id" class="form-controll">
                        <option value="">Seleccione una opcion</option>
                        @foreach ($posts as $post )
                        <option value="{{ $post->id }}">{{ $post->name }}</option>  
                        @endforeach
                    </select>
                </div>
            </div>
            {{-- fila2 --}}
            <div class="row form-group">
                <label for="content">contenido</label>
                <textarea class="form-control" name="content" id="content" cols="30" rows="10"></textarea>
            </div>
            {{-- fila3 --}}
            <div class="row center">
                <div class="col s6">
                    <button class="btn btn-success btn-sm" type="submit">Registrar</button>
                    <a href="{{ url('dashboard/reply') }}" class="btn btn-secundary btn-sm">Cancelar</a>
                </div>

            </div>
        </main>

    </form>
</div>
@endsection 