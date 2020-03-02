<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'nombres','fechaNac','direccion','email','destino','aerolinea','telefono'
    ];

    public function cotizacion(){
        return $this->hasMany(Cotizacion::class);
    }
}
