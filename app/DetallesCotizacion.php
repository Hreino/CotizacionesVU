<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cotizacion;

class DetallesCotizacion extends Model
{
    public function cotizacion(){
        return  $this->belongsTo(Cotizacion::class, 'id_cotizacions');
    }
}
