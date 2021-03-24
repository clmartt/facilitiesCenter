<?php

use Illuminate\Support\Facades\Route;

//Route::get('/', 'HomeController@welcome');
// rotas da api microsoft
Route::get('/signin', 'AuthController@signin');
Route::get('/callback', 'AuthController@callback');
Route::get('/signout', 'AuthController@signout');
Route::get('/calendar/{sala?}/{dia?}', 'CalendarController@calendar')->name('calendar');
Route::get('/calendar/new', 'CalendarController@getNewEventForm');
Route::post('/calendar/new', 'CalendarController@createNewEvent');
Route::get('/calendar/new/{sala}/{horaInicio}/{horaFim}','ControladorDataHora@EnviaDataHora');

Route::get('/teste', function()
{
    return view('template.templayout');
});
//--------------------------------------------------------------------------------------------------------

// rotas de POST
Route::post('/modulo','ControladorLogar@logar')->name('modulos');
Route::post('/salvaPosicao','ControladorPosicao@store')->name('salvaPosicao');
Route::post('/block','ControladorPosicao@bloquear')->name('block');
Route::post('/salvaruser','ControladorUsuario@store')->name('salvauser');
Route::post('newpass','ControladorUsuario@atualizasenha')->name("newpass");
Route::post('/salvaVaga','ControladorVaga@store')->name('salvarVaga');
Route::post('/upVaga','ControladorVaga@qtdUp')->name('upVaga');
Route::post('/salvagrupo','ControladorGrupo@salvaGrupo')->name('salvaGrupo');
Route::post('/definirGrupo','ControladorPosicao@definirGrupo')->name('definirGrupo');
Route::post('/salvaEditarGrupo','ControladorGrupo@salvaEditarGrupo')->name('salvaEditarGrupo');
Route::post('/deletaGrupo','ControladorGrupo@deletaGrupo')->name('deletaGrupo');
Route::post('/atualizaUser','ControladorUsuario@atualizaUser')->name('atualizaUser');
Route::post('/deletaUsuario','ControladorUsuario@deletaUsuario')->name('deletaUsuario');

//Rotas de DELETE
Route::delete('/cancela/{id?}/{layout?}','ControladorCancela@destroy')->name('cancelar');
Route::delete('/cancelaVaga/{id?}/{layout?}','ControladorCancelaVaga@destroy')->name('cancelarVaga');




// ROTAS DE GET DAS POSIÇÕES LAYOUT E LOGIN
Route::get('/','ControladorLogar@login');
Route::get('/modulo','ControladorLogar@index')->name('backmodulo');
Route::get('/posicoes','ControladorPosicao@index')->name('posicoes');
Route::get('/sair','ControladorSair@Sair')->name('sair');
Route::get('/reservas/{dia?}','ControladorReserva@index')->name('reservas');
Route::get('/bloqueadas','ControladorPosicao@bloqueada')->name('bloqueadas');
Route::get('/colaborador','ControladorUsuario@index')->name('colaborador');
Route::get('/confirm','ControladorConfirm@index')->name('confirm');
Route::get('/desbloqueio/{posicao?}','ControladorDesbloqueio@desbloquear')->name("desbloqueio");
Route::get('/newuser','ControladorUsuario@create')->name('novoUsuario');
Route::get('/formgrupo','ControladorGrupo@formGrupo')->name('formGrupo');
Route::get('/listaGrupos','ControladorGrupo@listaGrupos')->name('listaGrupos');
Route::get('/listaUsuario','ControladorUsuario@listaUsuario')->name('listaUsuario');
Route::get('/editUser','ControladorUsuario@editUser')->name('editUser');
Route::get('/formNovoCentroCusto','ControladorCentroCusto@formNovoCentroCusto')->name('formNovoCentroCusto');
Route::get('/listaCentroCusto','ControladorCentroCusto@listaCentroCusto')->name('listaCentroCusto');
Route::get('/editCentroCusto','ControladorCentroCusto@editCentroCusto')->name('editCentroCusto');
Route::post('/salvaNovoCentroCusto','ControladorCentroCusto@salvaNovoCentroCusto')->name('salvaNovoCentroCusto');
Route::post('/atualizaCentroCusto','ControladorCentroCusto@atualizaCentroCusto')->name('atualizaCentroCusto');
Route::post('/deleteCentroCusto','ControladorCentroCusto@deleteCentroCusto')->name('deleteCentroCusto');






// ROTA DOS ANDARES
Route::get('/12andar/{dia?}','ControladorLayout@Andar12')->name('12andar');
Route::get('/kvmp01/{dia?}','ControladorLayout@kvmp01')->name('kvmp01');
Route::get('/kvmsub/{dia?}','ControladorLayout@kvmsub')->name('kvmsub');
//=======================================================================================




//rotas para garagem
Route::get('/garagem','ControladorVaga@index')->name('garagem');// PARA HOME DA GARAGEM
Route::get('/qtdvaga','ControladorVaga@qtdvaga')->name('qtdvaga');// PARA QUANTIDADE DE VAGAS E PODE MUDAR A QUANTIDADE DE VAGAS
Route::get('/reservavaga/{dia?}','ControladorReserva@create')->name('reservavaga'); // FORMULARIO PARA NOVA RESERVA
Route::get('/colabgaragem','ControladorUsuario@colabgaragem')->name('colabgaragem');// CONSULTA AS RESERVAS DE GARAGEM
Route::get('/minhasreservas/{dia?}','ControladorReserva@garagemreserva')->name('minhasreservas');// G.(garagem) minhas reservas pois pode ser um modulo separado 
Route::get('/elegivel/{id?}','ControladorUsuario@elegivel')->name('elegiveis');


//rota visitantes
Route::get('/visitante/{dia?}','ControladorVisitante@index')->name('visitante');
Route::get('/convite','ControladorVisitante@convite')->name('convite');
Route::post('/salvarVisitante','ControladorVisitante@salvar')->name('salvarVisitante');
Route::post('/pesquisa','ControladorAutocomplete@fetch')->name('pesquisa');
Route::post('/enviar','ControladorVisitante@enviaConvite')->name('enviaConvite');
Route::get('/evento','ControladorVisitante@evento')->name('evento');
Route::post('/evento/convidados','ControladorVisitante@convidados')->name('convidados');
Route::post('/visitante/vaga','ControladorVisitante@vaga')->name('visitante.vaga');


// rota do relatorio
Route::get('/rel','ControladorRelatorio@index')->name('rel');

