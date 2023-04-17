@extends('dashboard.master')
@section('titulo', 'Agregarusuario')
@section('contenido')
    @include('dashboard.partials.validation-error')
    <div class="container">
        <h1>Registrar Usuario</h1>

        <form action="{{ route('usuarios.store') }}" method="post">
            @csrf
            {{-- fila1 --}}
            <main>
                <div class="row">
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input class="form-control" type="text" name="name" id="name">
                    </div>
                </div>
                {{-- fila2 --}}
                <div class="row ">
                    <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" type="email" name="email" id="email">
                </div>
                </div>
                {{-- fila3 --}}
                <div class="row ">
                    <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input class="form-control" type="password" name="password" id="password">
                </div>
                </div>

                {{-- fila3 --}}
                <div class="row ">
                    <div class="form-group">
                    <label for="roles">Rol de usuario</label>
                    <select class="form-control" name="roles" id="roles">
                        <option value="">Seleccione...</option>
                        @foreach ($roles as $rol)
                            <option value="{{ $rol }}" {{ $rol == old('roles') ? 'selected' : '' }}>
                                {{ $rol }}</option>
                        @endforeach
                    </select>
                </div>
                </div>


                <div class="row center">
                    <div class="col s6">
                        <button class="btn btn-success btn-sm" type="submit">Guardar</button>
                        <a href="{{ route('usuarios.index') }}" class="btn btn-secundary btn-sm">Cancelar</a>
                    </div>

                </div>
            </main>

        </form>
    </div>
@endsection
