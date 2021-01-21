<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Convite extends Model
{
    protected $table= 'convites';



    function usuario()
    {
        return $this->belongsTo('App\Usuario','id_usuario','idusuario');
    }

   


}
