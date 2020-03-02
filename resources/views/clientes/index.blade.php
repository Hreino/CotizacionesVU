@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if(session()->has('success'))
                    <div class="alert alert-success col-md-12">
                        {{ session()->get('success') }}
                    </div>
                @endif
                @if(session()->has('error'))
                    <div class="alert alert-danger col-md-12">
                        {{ session()->get('error') }}
                    </div>
                @endif
            </div>
            <div class="col-md-12">
                <h1>Listado de clientes</h1>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-2">
                <a href="{{route('clientes.create')}}" class="btn btn-info">
                    Agregar Cliente
                </a>
            </div>
            <hr>
        </div>
        <div class="row justify-content-center card-body">
            <table class="table text-center" id="myTable">
                <thead>
                    <tr>
                        <th>ID Cliente</th>
                        <th>Nombres</th>
                        <th>Destino</th>
                        <th>Acciones</th>
                    </tr>
                    
                        
                    
                </thead>
                <tbody>
                    @foreach ($clientes as $cliente)
                        <tr>
                            <td>{{$cliente->id}}</td>
                            <td>{{$cliente->nombres}}</td>
                            <td>{{$cliente->destino}}</td>
                            <td>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalDetalles{{$cliente->id}}">
                                    Ver Detalles
                                </button>
                               
                                <a href="{{route('clientes.edit',$cliente->id)}}" class="btn btn-success">Editar</a>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#ModalEliminar{{$cliente->id}}">
                                    Eliminar
                                </button>
                                
                                {{--  --}}

                            </td>
                        </tr>

                    <!-- Modal Detalles-->
                    <div class="modal fade" id="ModalDetalles{{$cliente->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header text-center">
                                    <h5 class="modal-title " id="exampleModalCenterTitle">Detalles de Cliente</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="container">
                                        <div class="row">
                                            <label for="nombres" class="label"><b>Nombres: </b></label>
                                            <p>{{$cliente->nombres}}</p>
                                        </div>
                                        <div class="row">
                                            <label for="nombres" class="label"><b>Fecha de Nacimiento: </b></label>
                                            <p>{{$cliente->fechaNac}}</p>
                                        </div>
                                        <div class="row">
                                            <label for="nombres" class="label"><b>Direccion: </b></label>
                                            <p>{{$cliente->direccion}}</p>
                                        </div>
                                        <div class="row">
                                            <label for="nombres" class="label"><b>E-mail: </b></label>
                                            <p>{{$cliente->email}}</p>
                                        </div>
                                        <div class="row">
                                            <label for="destino" class="label"><b>Destino: </b></label><br>
                                            <p>{{$cliente->destino}}</p>
                                        </div>
                                        <div class="row">
                                            <label for="aerolinea" class="label"><b>Aerolinea: </b></label><br>
                                            <p>{{$cliente->aerolinea}}</p>
                                        </div>
                                        <div class="row">
                                            <label for="telefono" class="label"><b>Telefono: </b></label><br>
                                            <p>{{$cliente->telefono}}</p>
                                        </div>
                                    </div>
                                    
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                     <!-- Modal Eliminar-->
                     <div class="modal fade" id="ModalEliminar{{$cliente->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header text-center">
                                    <h5 class="modal-title " id="exampleModalCenterTitle">¿Seguro que desea Eliminar Cliente?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="container">
                                        <form action="{{Route('clientes.destroy',$cliente->id)}}" method="post">
                                            {{csrf_field()}}
                                            <input name="_method" type="hidden" value="DELETE">
                                            <button class="btn btn-danger" type="Submit">Eliminar Cliente</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        </form>
                                        </div>
                                    </div>
                                    
                                    
                                </div>
                                <div class="modal-footer">
                                    
                                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection