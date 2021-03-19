<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuario';

    function grupo(){

        return $this->belongsTo('App\Grupo','id_grupo','id_grupo');
    }
}
