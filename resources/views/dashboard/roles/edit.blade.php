
@extends('dashboard.master')
@section('titulo', 'EditarCategoria')
@section('contenido')
    @include('dashboard.partials.validation-error')
    <div class="container">


                @include('dashboard.partials.validation-error')

                <form action="{{ route('roles.update', $role->id) }}" method="post">
                    @csrf
                    @method("PUT")


                    <div class="mb-3 row">
                        <label for="name">Nombre del rol</label>
                        <div class="col-sm-5">
                            <input class="form-control" type="text" name="name" id="name"
                            value="{{ $role->name }}">
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
                                            value="{{ $permiso->id }}" {{ in_array($permiso->id, $rolePermissions) ? "checked" : "" }}>
                                            {{ $permiso->name }}
                                    </td>
                                </tr>
                              @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row center">

                        <div class="col s6">
                            <button class="btn btn-success btn-sm" type="submit">Guardar</button>
                            <a href="{{ ('roles') }}" class="btn btn-secondary btn-sm">Cancelar</a>

                        </div>
                    </div>

                </form>
            </div>
     @endsection