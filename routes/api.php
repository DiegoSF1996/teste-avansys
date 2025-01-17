<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::post('listarOperadoras','OperadoraController@listarOperadoras');
Route::post('salvar','OperadoraController@salvar');
Route::post('excluirOperadoras','OperadoraController@excluirOperadoras');
Route::get('lsOperadoras','DescricaoController@lsOperadoras');
Route::post('lsDescricaoPorOperadora','DescricaoController@lsDescricaoPorOperadora');
Route::post('salvarDescricao','DescricaoController@salvar');
Route::post('excluirDescricoes','DescricaoController@excluirDescricoes');