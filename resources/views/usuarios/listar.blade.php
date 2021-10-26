@extends('layouts.base')
@section('content')
 <div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h2 class="text-center mb-5">Usuarios admin</h2>
            <a class="btn btn-success mb-4" href="{{ url('/form')}}">Agregar Usuario</a>
            <!-- esto es el mensaje flash-->
            @if(session('usuarioEliminado'))
                <div class="alert alert-success">
                    {{ session ('usuarioEliminado')}}
                </div>
            @endif
            <table class="table table-bordered table-striped text-center">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                 </tr>
                </thead>

                <tbody>
                    @foreach($users as $user)
                    <tr>
                       <td>{{ $user->nombre }}</td>
                       <td>{{ $user->email }}</td>
                       <td>{{ $user->descripcion }}</td>
                        <td>

                            <a href = "{{ route ('editform', $user->id) }}" class="btn  btn-primary mb-2">
                                <i class=" fas fa-pencil-alt"></i>
                            </a>

                            <form action="{{route('delete', $user->id)}}" method="post">
                                @csrf @method('DELETE')

                                <button type="submit" onclick="return confirm('¿borrar?');" class="btn btn-danger">
                                    <i class="fas fa-trash-alt"></i>
                                </button>


                            </form>

                        </td>

                     </tr>
                    @endforeach

                </tbody>

            </table>
            {{ $users->links() }}

        </div>

    </div>
 </div>
 @endsection