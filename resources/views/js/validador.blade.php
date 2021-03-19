<script>
 var idUser = '{{session()->get("idusuario")}}';
 var posicao= '{{session()->get("posicao")}}';
 var estacionamento= '{{session()->get("estacionamento")}}';
 var sala= '{{session()->get("salas")}}';
 var visitante= '{{session()->get("visitantes")}}';

if(posicao !="sim"){
    $('#clienteGestaoPosicoes').hide();
}


if(estacionamento !="sim"){
    $('#clienteGestaoEstacionamento').hide();
}


if(sala !="sim"){
    $('#clienteGestaoSala').hide();
}


if(visitante !="sim"){
    $('#clienteGestaoVisitante').hide();
}

</script>