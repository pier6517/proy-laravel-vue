@extends('dashboard.master')
@section('titulo', 'poster')
@section('contenido')
    <main>
        <div class="container py-4">
            <h2>Comentarios</h2>
            <a href="{{ url('dashboard/reply/create') }}" class="btn btn-primary btn-sm">Nuevo Comentario</a>
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>publicacion</th>
                        <th>usuario</th>
                        <th>texto</th>
                        <th>Fecha de modificacion</th>
                        <th>Acciones</th>
                        
                       
                    </tr>
                </thead>
                <tbody>
                    @foreach ($replies as $reply)
                        <tr>
                            <td>{{ $reply->id }}</td>
                            <td>{{ $reply->post->name }}</td>
                            <td>{{ $reply->author->name }}</td>
                            <td>{{ $reply->created_at }}</td>
                            <td>{{ $reply->updated_at }}</td>
                            <td><a href="{{ url('dashboard/replies/' . $reply->id . '/edit') }}" class="bi bi-pencil"></a>
                                &nbsp;&nbsp;&nbsp;

                                <button class="bi bi-eraser-fill" type="button" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal" data-id="{{ $reply->id }}"></button>

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
                            <form id="formDelete" method="POST" action="{{ route('reply.destroy', 0) }}"
                    data-action="{{ route('reply.destroy', 0) }}">
                            
                                
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
                modal.find('.modal-title').text('Eliminar categoria');
                
             });
        }
</script>
@endsection