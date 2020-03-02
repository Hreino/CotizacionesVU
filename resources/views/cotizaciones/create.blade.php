@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row card">
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
            <div class="col-md-12 text-center">
                <h2>Crear Cotizacion</h2>
            </div>
            <div class="card-body text-center">
                <form action="{{route('cotizaciones.store')}}" method="post">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">Clientes</label>

                        <div class="col-md-5">
                            <select name="id_cliente" id="id_cliente" class="form-control">
                                @foreach ($clientes as $cliente)
                                <option value="{{$cliente->id}}">{{$cliente->nombres}}</option>
                                @endforeach
                            </select>                           
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-info btn-small" data-toggle="modal" data-target="#exampleModal">+</button>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="proveedor" class="col-md-4 col-form-label text-md-right">Proveedor:</label>
                        <div class="col-md-5">
                            <select name="proveedor" id="proveedor" class="form-control">
                                <option value="---">---</option>
                                <option value="AVILES">AVILES</option>
                                <option value="PANAMEX">PANAMEX</option>
                                <option value="ALL AMERICAN">ALL AMERICAN</option>
                                <option value="OTRO">OTRO</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="medio" class="col-md-4 col-form-label text-md-right">Medio de cotizacion:</label>
                        <div class="col-md-5">
                            <select name="medio" id="medio" class="form-control">
                                <option value="---">---</option>
                                <option value="Facebook Messenger">Facebook Messenger</option>
                                <option value="WhatsApp Agencia">WhatsApp Agencia</option>
                                <option value="WhatsApp Personal">WhatsApp Personal</option>
                                <option value="Otro">Otro</option>

                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status" class="col-md-4 col-form-label text-md-right">Estado de Cotizacion:</label>
                        <div class="col-md-5">
                            <select name="status" id="status" class="form-control">
                                <option value="---">---</option>
                                <option value="Cotizacion Enviada">Cotizacion Enviada</option>
                                <option value="Cotizacion en Espera">Cotizacion en Espera</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-success" id="submitC">Agregar Itinerario</button>
                    </div>

                </form>
                

    {{-- Modal Itinerarios --}}
  
  <!-- Modal -->
    <div class="modal fade" id="AgregrarItinerarioModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Detalles Itinerario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form >
                        <div class="form-group">
                            <label for="detallesItinerario">Detalles Itinerario</label><br>
                            <textarea name="itinerario" id="itinerario" cols="50" rows="8"></textarea>
                        </div>

                        
                        <div class="form-group">
                            <label for="detallesEquipaje">Incluye Equipaje de Carga?</label>
                            <select name="equipaje" id="equipaje" class="form-control">
                                <option value="---">---</option>
                                <option value="Si Incluye">Si Incluye</option>
                                <option value="No Incluye">No Incluye</option>
                                <option value="No Aplica">No Aplica</option>
                            </select>
                        </div>
                        
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="AgregarDetalles" data-dismiss="modal">Agregar Detalles</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal Itinerarios --}}



        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar Nuevo Cliente</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <form method="POST" action="{{route('cliente.fromCotizacion')}}" >
                                @csrf
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">Nombres</label>
                
                                    <div class="col-md-6">
                                        <input id="nombres" 
                                        type="text" 
                                        class="form-control" 
                                        name="nombres" value="{{ old('nombres') }}" required autofocus>
                
                                        @if ($errors->has('nombres'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('nombres') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="fechaNac" class="col-md-4 col-form-label text-md-right">Fecha de Nacimiento</label>
                
                                    <div class="col-md-6">
                                        <input type="date" name="fechaNac" id="fechaNac" class="form-control">
                                        {{-- <input id="nombres" 
                                        type="text" 
                                        class="form-control" 
                                        name="nombres" value="{{ old('nombres') }}" required autofocus> --}}
                
                                        @if ($errors->has('nombres'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('nombres') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="direccion" class="col-md-4 col-form-label text-md-right">Direccion</label>
                
                                    <div class="col-md-6">
                                        <input id="direccion" 
                                        type="text" 
                                        class="form-control" 
                                        name="direccion" value="{{ old('direccion') }}" required autofocus>
                
                                        @if ($errors->has('direccion'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('direccion') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
                
                                    <div class="col-md-6">
                                        <input id="email" 
                                        type="email" 
                                        class="form-control" 
                                        name="email" value="{{ old('email') }}" required autofocus>
                
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="destino" class="col-md-4 col-form-label text-md-right">Destino</label>
                
                                    <div class="col-md-6">
                                        <input id="destino" 
                                        type="text" 
                                        class="form-control" 
                                        name="destino" value="{{ old('destino') }}" required autofocus>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="aerolinea" class="col-md-4 col-form-label text-md-right">Aerolinea de preferencia:</label>
                                    <div class="col-md-6">
                                        <input type="text" name="aerolinea" id="aerolinea" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="telefono" class="col-md-4 col-form-label text-md-right">Telefono:</label>
                                    <div class="col-md-6">
                                        <input type="text" name="telefono" id="telefono" class="form-control">
                                    </div>
                                </div>
                                
                
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            Crear Cliente
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                </div>
            </div>
        </div>


@endsection