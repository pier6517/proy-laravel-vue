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
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Rol</th>
                                <th>Acciones</th>
                            </tr>    
                        </thead> 
                        <tbody>
                            @foreach ($usuarios as $usuario )
                                <tr>
                                    <td>{{ $usuario->name }}</td>
                                    

                                    <td>
                                        {{ $usuario->email }}
                                    </td>  
                                    <td>
                                        {{ $usuario->roles->first()->name }}
                                        
                                    </td> 
                                    <td> 
                                    </td>    
                                </tr>    
                        
                                
                            @endforeach
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