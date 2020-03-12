@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row card">
        <div class="col-md-12 text-center">
            <h1>Crear Cliente</h1>
        </div>
        <div class="card-body text-center">
            <form method="POST" action="{{route('clientes.store')}}" >
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
                    <label for="destino" class="col-md-4 col-form-label text-md-right">Destino:</label>

                    <div class="col-md-6">
                        <input id="destino" 
                        type="text" 
                        class="form-control" 
                        name="destino" value="{{ old('destino') }}" required autofocus>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="fechaNac" class="col-md-4 col-form-label text-md-right">Fecha de Nacimiento:</label>

                    <div class="col-md-6">
                        <input type="date" name="fechaNac" id="fechaNac" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="direccion" class="col-md-4 col-form-label text-md-right">Dirección:</label>

                    <div class="col-md-6">
                        <input id="direccion" 
                        type="text" 
                        class="form-control" 
                        name="direccion" value="{{ old('direccion') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">E-mail:</label>

                    <div class="col-md-6">
                        <input id="email" 
                        type="text" 
                        class="form-control" 
                        name="email" value="{{ old('email') }}" >
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
                        <input type="phone" name="telefono" id="telefono" class="phone form-control" value="503">
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
    

@endsection