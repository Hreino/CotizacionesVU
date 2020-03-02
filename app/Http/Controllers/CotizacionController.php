<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Cotizacion;
use App\DetallesCotizacion;
use App\Cliente;
use App\User;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Carbon\Carbon;

class CotizacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // Retorna cotizaciones pendientes
    public function index()
    {
        $cotizaciones = Cotizacion::where([
            ['status','<>','Finalizado'],
            ['status','<>','Vendido']
        ])->latest()->get();
        return view('cotizaciones.index', ['cotizaciones'=>$cotizaciones]);
    }
    // Retorna Cotizaciones del Usuario en Sesion
    public function misCotizacionesP(){
        $userID = Auth::user()->id;
        $cotizaciones = Cotizacion::where('id_user','=',$userID)->orderBy('id', 'desc')->get();
        return view('cotizaciones.misCotizacionesP', ['cotizaciones'=>$cotizaciones]);
    }
    // Retorna Cotizaciones finalizadas sin compra  
    public function finalizadas()
    {
        $cotizaciones = Cotizacion::where('status','=','Finalizado')->latest()->get();
        return view('cotizaciones.finalizados', ['cotizaciones'=>$cotizaciones]);
    }
    // Retorna cotizaciones Vendidas
    public function vendidas()
    {
        $cotizaciones = Cotizacion::where('status','=','Vendido')->latest()->get();
        return view('cotizaciones.vendidas', ['cotizaciones'=>$cotizaciones]);
    }
    


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // Retorna vista para crear cotizaciones
    public function create()
    {
        $clientes=Cliente::all();
        return view('cotizaciones.create',['clientes'=>$clientes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //  Almacena detalles iniciales de cotizacion
    public function store(Request $request)
    {

        $cliente = Cliente::find($request->input('id_cliente'));
       $iniciales = Auth::user()->initials;
       $asesor = Auth::user()->name;
       $id_user =Auth::user()->id;
       $fecha = Carbon::today()->toDateString();
       $correlativo = Cotizacion::count() + 1;

       $inicialesCliente = CotizacionController::getInitials($cliente->nombres);
       
       $codigo = $iniciales.$correlativo.$fecha.$inicialesCliente;

       

        $cotizacion = new Cotizacion();
    
        $cotizacion->codigo = $codigo;
        $cotizacion->fecha = $fecha;
        $cotizacion->asesor = $asesor;
        $cotizacion->id_user = $id_user ;
        $cotizacion->id_cliente = $request->input('id_cliente');
        $cotizacion->proveedor = $request->input('proveedor');
        $cotizacion->medio = $request->input('medio');
        $cotizacion->status = $request->input('status');
        $cotizacion->save();

        return redirect()->route('cotizaciones.show', [$cotizacion->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cotizacion  $cotizacion
     * @return \Illuminate\Http\Response
     */
    // Muestra la cotizacion seleccionada
    public function show($id)
    {
       $cotizacion = Cotizacion::find($id);
       $iniciales = Auth::user()->initials;
       $fecha = Carbon::today()->toDateString();
       $correlativo = Cotizacion::count() + 1;
       $codigo = $iniciales.$correlativo.$fecha;
       $user = User::find($cotizacion->id_user);
       $cliente = Cliente::find($cotizacion->id_cliente);
       $inicialesCliente = substr($cliente->nombres,0,3);
       $nombresCliente= $cliente->nombres;
        
       $detallesCotizacion = DetallesCotizacion::where('id_cotizacions', '=', $cotizacion->id)->latest()->get();
        $str=CotizacionController::getInitials($nombresCliente);
       return view('cotizaciones.show',
       ['cotizacion'=>$cotizacion,
       'iniciales'=>$iniciales, 
       'correlativo'=>$correlativo,
       'fecha'=>$fecha,
       'codigo'=>$codigo,
       'user'=>$user,
       'cliente'=>$cliente,
       'inicialesCliente' => $inicialesCliente,
        'detallesCotizacion'=>$detallesCotizacion,
        'str'=>$str
       ]);
    }

    // Funcion Inservible
    public function showD($id)
    {
       $cotizacion = Cotizacion::find($id);
       $iniciales = Auth::user()->initials;
       $fecha = Carbon::today()->toDateString();
       $correlativo = Cotizacion::count() + 1;
       $codigo = $iniciales.$correlativo.$fecha;
       $user = User::find($cotizacion->id_user);
       $cliente = Cliente::find($cotizacion->id_cliente);
       $inicialesCliente = substr($cliente->nombres,0,3);
       $nombresCliente= $cliente->nombres;
        
       $detallesCotizacion = DetallesCotizacion::where('id_cotizacions', '=', $cotizacion->id)->latest()->get();
        $str=CotizacionController::getInitials($nombresCliente);
       return view('cotizaciones.showD',
       ['cotizacion'=>$cotizacion,
       'iniciales'=>$iniciales, 
       'correlativo'=>$correlativo,
       'fecha'=>$fecha,
       'codigo'=>$codigo,
       'user'=>$user,
       'cliente'=>$cliente,
       'inicialesCliente' => $inicialesCliente,
        'detallesCotizacion'=>$detallesCotizacion,
        'str'=>$str
       ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cotizacion  $cotizacion
     * @return \Illuminate\Http\Response
     */

    //  Funcion para agregar itinerario
    public function addIti(Request $request){
        $id_cotizacion = Cotizacion::find($request->input('id'));
        $detallesCotizacion = new DetallesCotizacion();
        $detallesCotizacion->detalles= $request->input('detalles');
        $detallesCotizacion->equipaje = $request->input('equipaje');
        $detallesCotizacion->id_cotizacions = $request->input('id');
        $detallesCotizacion->save();
        return redirect()->route('cotizaciones.show', [$id_cotizacion])->with('success','Itinerario Agregado');
        // echo($cotizacion);
    }

    // Funcion para eliminar itinerario
    public function destroyIti($id){
        try {
            DetallesCotizacion::find($id)->delete();
        return back()->with('success','Itinerario Eliminado');
        } catch (\Throwable $th) {
            return back()->with('error','Error al eliminar');
        }
        
    }

    // Funcion para Finalizar cotizacion sin venta
    public function updateCotizacion($id, Request $request){
        $cotizacion = Cotizacion::find($id);
        $cotizacion->status = 'Finalizado';
        $cotizacion->posventa = $request->input('posventa');
        $cotizacion->update();
        return back()->with('success','Cotizacion Finalizada');
    }

    // Funcion para finalizar cotizacion con venta
    public function vendido($id, Request $request){
        $cotizacion = Cotizacion::find($id);
        $cotizacion->status = 'Vendido';
        $cotizacion->posventa = $request->input('posventa');
        $cotizacion->update();
        return back()->with('success','Cotizacion Vendida');
    }
    public function edit(Cotizacion $cotizacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cotizacion  $cotizacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cotizacion $cotizacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cotizacion  $cotizacion
     * @return \Illuminate\Http\Response
     */

    //  Funcion para eliminar cotizacion 
    public function deleteCotizacion($id){
        try {
            $cotizacion = Cotizacion::find($id);
            
            $detallesCotizacion = DetallesCotizacion::where('id_cotizacions','=',$id)->get();
            // echo($detallesCotizacion);
            foreach ($detallesCotizacion as $key ) {
                $key->delete();
            }
            $cotizacion->delete();
            return back()->with('success','Cotizacion Eliminada');
        } catch (\Throwable $th) {
            return back();
        }
    }
    public function destroy(Cotizacion $cotizacion)
    {
        //
    }

    // Funcion estatica para obtener iniciales del Usuario
    /** * @return string */ 
    function getInitials($string = null) 
    { 
        return array_reduce(explode(' ', $string),
         function ($initials, $word) {
              return sprintf('%s%s', $initials, substr($word, 0, 1));
             },
         '' ); 
    } 
}
