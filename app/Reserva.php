<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $table = 'reservas';

// faz relacionamento com usuario
    function usuario()
    {
        return $this->belongsTo('App\Usuario','usuario_idusuario','idusuario');
    }

    function posicao()
    {
        return $this->belongsTo('App\Posicao','posicoes_idposicoes','idposicoes');
    }
}
