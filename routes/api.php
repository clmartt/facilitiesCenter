<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/qrcode/{emp}/{pos}','ControladorQrcode@index')->name('qrcode');// qrcode ->(link/api/qrcode/1/t7)
Route::get('/bloqueada','ControladorQrcode@bloqueada')->name('apiBloqueada');
Route::get('/confirmar/{posicao}/{idempresa}','ControladorQrcode@confirmar')->name('confirmar');
Route::get('/qrlogin/{posicao}/{idempresa}/{error?}','ControladorQrcode@qrlogin')->name('qrlogin');
Route::get('/evoce/{posicao}/{idempresa}/{ocupante}','ControladorQrcode@evoce')->name('evoce');

// esta rota segue o fluxo de quando a posição esta ocupada e o usuario precisa se indentificar
Route::post('/checado','ControladorQrcode@checado')->name('checado');


//essa rota é quando a posição esta livre e pode ser agendada
Route::post('/qrreserva','ControladorQrcode@qrreserva')->name('qrreserva');


// rota para aceite do convite
Route::get('/aceite','ControladorVisitante@aceite')->name('aceite');

// guarda placa
Route::post('aceite/placa','ControladorVisitante@getPlaca')->name('aceite.placa');

// rota para os mapas
Route::get('/maps','ControladorMapa@index')->name('maps');
