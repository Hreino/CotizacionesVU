<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\DetallesCotizacion;

class Cotizacion extends Model
{
    protected $fillable = [
        'codigo', 'fecha', 'asesor','id_user','id_cliente','proveedor','medio','status','posventa'
    ];
    public function detalles(){
        return $this->hasMany(DetallesCotizacion::class, 'id');
    }

    public function user(){
        return $this->belongsTo(User::class,'id_user');
    }
    public function cliente(){
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }


}
