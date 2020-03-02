@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="justify-content-center">
            <div class="row">
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
                    <h1>Listado de Cotizaciones</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <a href="{{route('cotizaciones.create')}}" class="btn btn-info">
                        Agregar Cotizacion
                    </a>
                </div>
            </div>
            <hr>
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-10">
                            <table class="table table-responsive table-stripped" id="myTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Codigo</th>
                                        <th>Cliente</th>
                                        <th>Responsable</th>
                                        <th>Telefono</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cotizaciones  as $item)
                                        <tr>
                                            <td>{{$item->id}}</td>
                                            <td>{{$item->codigo}}</td>
                                            <td>{{$item->cliente->nombres}}</td>
                                            <td>{{$item->asesor}}</td>
                                            <td>{{$item->cliente->telefono}}</td>
                                            

                                            <td>
                                                <a href="{{route('cotizaciones.show',[$item->id])}}" class="btn btn-info">Detalles</a>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#ModalEliminar{{$item->id}}">
                                                    Eliminar
                                                </button>
                                            </td>
                                        </tr>
                                        <!-- Modal Eliminar-->
                                        <div class="modal fade" id="ModalEliminar{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header text-center">
                                                        <h5 class="modal-title " id="exampleModalCenterTitle">¿Seguro que desea Eliminar Cotizacion?</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="container">
                                                            <form action="{{Route('cotizaciones.deleteCotizacion',$item->id)}}" method="post">
                                                                {{csrf_field()}}
                                                                <input name="_method" type="hidden" value="DELETE">
                                                                <button class="btn btn-danger" type="Submit">Eliminar Cotizacion</button>
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                            </form>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                </div>
                                                <div class="modal-footer">
                                                    
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                        
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
@endsection