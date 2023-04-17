@extends('dashboard.master')
@section('titulo', 'AgregarPost')
@section('contenido')
@include('dashboard.partials.validation-error')
<div class="container">  

    <form action="{{ route('roles.store') }}" method="post">
        @csrf
        {{-- fila1 --}}
        <main>
            <div class="container py-4">
                <h1>Registrar rol</h1>

            </div>
            <div class="row">
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input class="form-control" type="text" name="name" id="name" value="{{ old('name') }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="name">Permisos de rol</label>
                <div class="col-sm-5">
                    <table>
                        <tbody>
                            @foreach ($permission as $permiso )
                            <tr>
                                <td>
                                    <input class="form-check-input" type="checkbox" name="permission[]"
                                    value="{{ $permiso->id }}" >
                                    {{ $permiso->name }}
                            </td>
                        </tr>
                      @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- fila3 --}}
            <div class="row center">
                <div class="col s6">
                    <button class="btn btn-success btn-sm" type="submit">Registrar</button>
                    <a href="{{ url('dashboard/roles') }}" class="btn btn-secundary btn-sm">Cancelar</a>
                </div>

            </div>
        </main>

    </form>
</div>
@endsection 