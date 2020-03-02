@extends('layouts.app')
@section('content')
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
    <h1>Cliente</h1>

<div class="card">
    <div class="card-header">
        Cliente: {{$cliente->nombres}}
    </div>
    <div class="card-body">
        <form action="{{route('clientes.update', $cliente->id)}}" method="POST" >
            {{csrf_field()}}
            <input name="_method" type="hidden" value="PUT">
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <label for="nombres" class="label"><b>Nombres:</b></label>
                        <input type="text" name="nombres" id="nombres" value="{{$cliente->nombres}}" class="form-control">
                    </div>
                    <div class="row">
                        <label for="fechaNac" class="label"><b>Fecha de Nacimiento:</b></label>
                        <input type="date" name="fechaNac" id="fechaNac" value="{{$cliente->fechaNac}}" class="form-control">
                    </div>
                    <div class="row">
                        <label for="direccion" class="label"><b>Direccion:</b></label>
                        <input type="text" name="direccion" id="direccion" class="form-control" value="{{$cliente->direccion}}">
                    </div>
                    <div class="row">
                        <label for="email" class="label"><b>E-mail:</b></label>
                        <input type="text" name="email" id="direccion" class="form-control" value="{{$cliente->email}}">
                    </div>
                    <div class="row">
                        <label for="destino" class="label"><b>Destino:</b></label>
                        <input type="text" name="destino" id="destino" value="{{$cliente->destino}}" class="form-control">
                    </div>
                    <div class="row">
                        <label for="aerolinea" class="label"><b>Aerolinea:</b></label>
                        <input type="text" name="aerolinea" id="aerolinea" value="{{$cliente->aerolinea}}" class="form-control">
                    </div>
                    <div class="row">
                        <label for="telefono" class="label"><b>Telefono:</b></label>
                        <input type="text" name="telefono" id="telefono" value="{{$cliente->telefono}}" class="form-control">
                    </div>
                </div>
                
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
                
            </div>
        </form>
    </div>
</div>
@endsection