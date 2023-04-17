@extends('dashboard.master')
@section('titulo','poster')
@section('contenido')


<main>
    <div class="container py-4">   

   
                <div class="p-6 text-gray-900">
                    <h2>Usuarios </h2>
            
                    @can('crear-usuarios')
                    <a href="{{ route('usuarios.create') }}" class="btn btn-primary btn-sm">Nuevo usuario</a>
                    @endcan
                    <table class="table table-dark table-striped">
                        <thead>
                            <tr>
                                <th>Rol</th>
                                <th>Usuario</th>
                                <th>Contraseña</th>
                            </tr>    
                        </thead> 
                        <tbody>
                            @forelse ($usuarios as $usuario )
                                <tr>
                                    <td>{{ $usuario->name }}</td>
                                    

                                    <td>
                                    </td>  
                                    <td>
                                    </td>  
                                </tr>    
                            @empty
                                No hay registros
                            @endforelse
                        </tbody>       
                    </table>    
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
                console.log(boton);
                let accion=$('#formDelete').attr('data-action').slice(0,-1);
                accion+=id;
                $('#formDelete').attr('action',accion);
                let modal=$(this);
                modal.find('.modal-title').text('Eliminar publicacion');
                
             });
        }
</script>
@endsection