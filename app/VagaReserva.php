<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VagaReserva extends Model
{
    protected $table = 'vagasreserva';


    function usuario()
    {
        return $this->belongsTo('App\Usuario','id_usuario','idusuario');
    }
}
