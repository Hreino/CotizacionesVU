@extends('layouts.app')
@section('content')
     <div class="row">
         <div class="col-md-12">
             <div class="card">
                 <div class="card-header text-center">
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

                     <h4>  Agregar Itinerario: <b>{{$cotizacion->codigo}}</b></h4>
                     <h5>Cliente: {{$cliente->nombres}}</h5>
                     <h5>Telefono: {{$cliente->telefono}}</h5>

                     <!-- Button trigger modal -->
                     @if ($cotizacion->status == 'Finalizado' || $cotizacion->status == 'Vendido' )
                        <h6><b>Status:</b> {{$cotizacion->status}}</h6>
                        <h6><b>Posventa:</b> {{$cotizacion->posventa}}</h6>
                    @else
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter">
                            Finalizar
                        </button>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#Vendido">
                            Vendido
                        </button>
                    @endif
                    
  
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Finalizar Cotizacion {{$cotizacion->codigo}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <div class="card-body">
                                    <form action="{{route('cotizaciones.updateStatus', $cotizacion->id)}}" method="POST" >
                                        {{csrf_field()}}
                                        <input name="_method" type="hidden" value="PUT">
                                        <div class="form-group row">
                                            <label for="posventa" class="col-md-4 col-form-label text-md-right">Detalles Posventa:</label>
                
                                            <div class="col-md-6">
                                                <textarea name="posventa" id="posventa" cols="30" rows="10"></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="Vendido" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Finalizar Cotizacion {{$cotizacion->codigo}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <div class="card-body">
                                    <form action="{{route('cotizaciones.vendido', $cotizacion->id)}}" method="POST" >
                                        {{csrf_field()}}
                                        <input name="_method" type="hidden" value="PUT">
                                        <div class="form-group row">
                                            <label for="posventa" class="col-md-4 col-form-label text-md-right">Detalles Posventa:</label>
                
                                            <div class="col-md-6">
                                                <textarea name="posventa" id="posventa" cols="30" rows="10"></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                        </div>

                                    </form>
                                </div>
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
                            <label for="equipaje" class="col-md-4 col-form-label text-md-right">¿Incluye Equipaje de Carga?</label>
                            <div class="col-md-5">
                                <select name="equipaje" id="equipaje" class="form-control">
                                    <option value="---">---</option>
                                    <option value="Si Incluye">Si Incluye</option>
                                    <option value="Incluye equipaje (solo ida)">Incluye equipaje (solo ida)</option>
                                    <option value="Incluye equipaje (solo retorno)">Incluye equipaje (solo retorno)</option>
                                    <option value="Solo Objeto Personal">Solo Objeto Personal</option>
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
                                        <th>OPCIONES</th>
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
                                                        <div class="form-group">
                                                            <button class="btn btn-success" type="button"data-toggle="modal" data-target="#modificarItinerario{{$item->id}}">
                                                                Editar
                                                            </button>
                                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                                        </div>
                                                        
                                                    </form>
                                                </td>
                                            </tr>  


                                            <!-- Modal -->
                                            <div class="modal fade" id="modificarItinerario{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Editando Itinerario:</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{route('cotizaciones.edit', $item->id)}}" method="POST" >
                                                            {{csrf_field()}}
                                                            <input name="_method" type="hidden" value="PUT">
                                                            <div class="form-group row">
                                                                {{-- <label for="detalles" class="col-md-4 col-form-label text-md-right">Itinerario</label> --}}
                                                                Itinerario:
                                                                <div class="col-md-5">
                                                                    <textarea name="detalles" id="" cols="50" rows="6">{{$item->detalles}}</textarea>
                                                                    </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="equipaje" class="col-md-4 col-form-label text-md-right">¿Incluye Equipaje de Carga?</label>
                                                                <div class="col-md-5">
                                                                    <select name="equipaje" id="equipaje" class="form-control">
                                                                        <option value="---">---</option>
                                                                        <option value="Si Incluye">Si Incluye</option>
                                                                        <option value="Incluye equipaje (solo ida)">Incluye equipaje (solo ida)</option>
                                                                        <option value="Incluye equipaje (solo retorno)">Incluye equipaje (solo retorno)</option>
                                                                        <option value="Solo Objeto Personal">Solo Objeto Personal</option>
                                                                        <option value="No Incluye">No Incluye</option>
                                                                        <option value="No Aplica">No Aplica</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                                            </div>
                                                        </form>
                                                        
                                                    </div>
                                                    
                                                    </div>
                                                </div>
                                            </div>

                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                 </div>
                 
             </div>
         </div>
         <div class="container">
            <div class="row">
                <div class="col-md-12">
                   <a href="{{ url()->previous() }}" class="btn btn-info">Atras</a>
                </div>
            </div>
         </div> 
         
     </div>

@endsection
