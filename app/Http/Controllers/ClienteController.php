<?php

namespace App\Http\Controllers;

use App\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // Retorna Listado de Clientes
    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes.index',['clientes'=>$clientes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // Retorna Vista para crear Cliente
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //  Funcion para almacenar cliente en BD
    public function store(Request $request)
    {
        $cliente = new Cliente();
        $cliente->nombres = $request->input('nombres');
        $cliente->fechaNac = $request->input('fechaNac');
        $cliente->direccion = $request->input('direccion');
        $cliente->email = $request->input('email');

        $cliente->destino = $request->input('destino');
        $cliente->aerolinea = $request->input('aerolinea');
        $cliente->telefono = $request->input('telefono');
        $cliente->save();
        return redirect()->action('ClienteController@index')->with('success','Cliente agregado Exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    // Funcion que retorna vista para editar cliente.
    public function edit($id)
    {
        $cliente = Cliente::find($id);
        // echo($cliente);
        return view('clientes.edit', ['cliente'=>$cliente]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    // Funcion para actualizar datos del cliente
    public function update(Request $request, $id)
    {
        $cliente = Cliente::find($id);
        $cliente->nombres = $request->input('nombres');
        $cliente->fechaNac = $request->input('fechaNac');
        $cliente->direccion = $request->input('direccion');
        $cliente->email = $request->input('email');
        $cliente->destino = $request->input('destino');
        $cliente->aerolinea = $request->input('aerolinea');
        $cliente->telefono = $request->input('telefono');
        $cliente->update();
        return redirect()->action('ClienteController@index')->with('success', 'Datos Actualizados');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    // Funcion para eliminar Cliente
    public function destroy($id)
    {
        try {
            $cliente = Cliente::find($id);
            $cliente->delete();
            return redirect()->action('ClienteController@index')->with('success','Cliente Eliminado');
        } catch (\Throwable $th) {
            return back()->with('error','Cliente no se puede eliminar, tiene cotizaciones vigentes.');
        }
        
    }

    public function fromCotizacion(Request $request){
        $cliente = new Cliente();
        $cliente->nombres = $request->input('nombres');
        $cliente->fechaNac = $request->input('fechaNac');
        $cliente->direccion = $request->input('direccion');
        $cliente->email = $request->input('email');
        $cliente->destino = $request->input('destino');
        $cliente->aerolinea = $request->input('aerolinea');
        $cliente->telefono = $request->input('telefono');
        $cliente->save();
        return redirect()->action('CotizacionController@create')->with('success','Cliente agregado exitosamente');
    }
}
