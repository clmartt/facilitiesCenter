<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReservaSala extends Model
{
    protected $table = 'reservas_salas';

    function usuario()
    {
        return $this->belongsTo('App\Usuario','id_user','idusuario');
    }
    
}
