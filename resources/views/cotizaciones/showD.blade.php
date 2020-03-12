@extends('layouts.app')
@section('content')
     <div class="row">
         <div class="col-md-12">
             <div class="card">
                 <div class="card-header text-center">
                     <h3>Agregar Itinerario:{{$cotizacion->codigo}}</h3>
                     <h5>Cliente: {{$cliente->nombres}}</h5>
                     <h5>Telefono: {{$cliente->telefono}}</h5>
                     <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                        Finalizar Cotizacion
                    </button>
  
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Desea finalizar la cotizacion {{$cotizacion->codigo}} </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                        </div>
                    </div>

                 </div>
                 <div class="card-body">
                    <form action="{{route('cotizaciones.addIti')}}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{$cotizacion->id}}">
                        <div class="form-group row">
                            <label for="detalles" class="col-md-4 col-form-label text-md-right">Detalles Itinerario</label>
                            <div class="col-md-5">
                                <textarea name="detalles" id="detalles" cols="30" rows="7" class="form-control"></textarea>
                               
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="equipaje" class="col-md-4 col-form-label text-md-right">Incluye Equipaje de Carga?</label>
                            <div class="col-md-5">
                                <select name="equipaje" id="equipaje" class="form-control">
                                    <option value="---">---</option>
                                    <option value="Si Incluye">Si Incluye</option>
                                    <option value="No Incluye">No Incluye</option>
                                    <option value="No Aplica">No Aplica</option>
                                </select>
                            </div>
                        </div>
                      <div class="text-center">
                        <button type="submit" class="btn btn-success" id="">Agregar Itinerario</button>
                      </div> 
                    </form>
                    <hr>
                    <div class="row justify-content-center">
                        <div class="col-8">
                            <table class="table table-stripped table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Itinerario</th>
                                        <th>Equipaje</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($detallesCotizacion)>0)
                                        @foreach ($detallesCotizacion as $item)
                                            <tr>
                                                <td>
                                                    {{$item->created_at}}
                                                </td>
                                                <td>
                                                    <textarea name="" id="" cols="50" rows="6" disabled> {{$item->detalles}}</textarea>
                                                    
                                                </td>
                                                <td>{{$item->equipaje}}</td>
                                                <td>
                                                    <form action="{{route('cotizaciones.destroyIti',[$item->id])}}" method="post">
                                                        {{csrf_field()}}
                                                        <input name="_method" type="hidden" value="DELETE">
                                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                                    </form>
                                                </td>
                                            </tr>  
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                 </div>
                 
             </div>
         </div>
     </div>

@endsection
