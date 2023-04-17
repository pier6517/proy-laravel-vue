@extends('dashboard.master')
@section('titulo','poster')
@section('contenido')


<main>
    <div class="container py-4">   

        @include('dashboard.partials.validation-error')
                <div class="p-6 text-gray-900">
                    <h2>Roles </h2>
            
                    @can('crear-rol')
                    <a href="{{ url('dashboard/roles/create') }}" class="btn btn-primary btn-sm">Nuevo rol</a>
                    @endcan
                    <table class="table table-dark table-striped">
                        <thead>
                            <tr>
                                <th>Rol</th>
                                <th>Editar</th>
                                <th>Elimiar</th>
                            </tr>    
                        </thead> 
                        <tbody>
                            @forelse ($roles as $rol )
                                <tr>
                                    <td>{{ $rol->name }}</td>
                                    

                                    <td><a href="{{ url('dashboard/roles/' . $rol->id . '/edit') }}" class="bi bi-pencil"></a>
                                    </td>
                                    <td>
        
                                        <button class="bi bi-eraser-fill" type="button" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal" data-id="{{ $rol->id }}"></button>
        
                                    </td>  
                                </tr>    
                            @empty
                                No hay registros
                            @endforelse
                        </tbody>       
                    </table>
                    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="deleteModalLabel"></h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>¿se borrara definitivamente estas seguro ?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        
                                    <form id="formDelete" method="POST" action="{{ route('roles.destroy', 0) }}"
                                        data-action="{{ route('roles.destroy', 0) }}">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>    
                </div>
    </div>
</main>

@endsection

@section('script')
    <script>
        window.onload=function(){
            
            $('#deleteModal').on('show.bs.modal',function(e){
                let boton=$(e.relatedTarget);
                let id=boton.data('id');
                console.log (id)
                let accion=$('#formDelete').attr('data-action').slice(0,-1);
                accion+=id;
                console.log(accion);
                $('#formDelete').attr('action',accion);
                let modal=$(this);
                modal.find('.modal-title').text('Eliminar rol');
                
             });
        }
</script>
@endsection