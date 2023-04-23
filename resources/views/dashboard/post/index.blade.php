@extends('dashboard.master')
@section('titulo','poster')
@section('contenido')
    <main>
        <div class="container py-4">
            <h2>Post Publicados</h2>
            <a href="{{ url('dashboard/post/create') }}" class="btn btn-primary btn-sm">Nuevo post</a>
            <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Categoria</th>
                    <th>Descripcion</th>
                    <th>Estado</th>
                    <th>Fecha de creacion</th>
                    <th>Feha de modificacion</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post )
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->name }}</td>
                    <td>{{ $post->category->name }}</td>
                    <td>{{ $post->description }}</td>
                    <td>{{ $post->state }}</td>
                    <td>{{ $post->created_at }}</td>
                    <td>{{ $post->updated_at }}</td>
                    <td><a href="{{ url('dashboard/post/'.$post->id.'/edit') }}" class="bi bi-pencil"></a></td>
                    <td>
                        <button class="bi bi-eraser-fill" type="button" data-bs-toggle="modal"
                        data-bs-target="#deleteModal" data-id="{{ $post->id }}"></button>
                    </form>
                    </td>
                </tr>
                    
                @endforeach
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

                        <form id="formDelete" method="POST" action="{{ route('post.destroy', 0) }}"
                            data-action="{{ route('post.destroy', 0) }}">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
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