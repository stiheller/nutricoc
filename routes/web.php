<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\GuardiaController;
use \App\Http\Controllers\CocinaController;
use \App\Http\Controllers\ObstetriciaController;
use \App\Http\Controllers\monitorController;
use \App\Http\Controllers\UsuarioController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
/* guardia */
Route::get("guardia",[GuardiaController::class, "index"])->name("dietaGuardia");
Route::get("guardiaFiltrar",[GuardiaController::class, "index"])->name("dietaGuardiaFiltrar");
Route::post("grabarPedidoGuardia",[GuardiaController::class, "grabarPedidoGuardia"])->name("grabarPedidoGuardia");
Route::get("guardiaPedir",[GuardiaController::class, "guardiaPedir"])->name("guardiaPedir");
/* cocina */
Route::post("accionPedidoDieta",[CocinaController::class, "accionPedidoDieta"])->name("accionPedidoDieta");
Route::get("logdieta/{id}",[GuardiaController::class, "logdieta"])->name("logdieta");
Route::post("accionPedidoIntranet",[GuardiaController::class, "accionPedidoIntranet"])->name("accionPedidoIntranet");
/* autocomplete */
Route::get("/searchGuardiaPacientes",[GuardiaController::class, "searchGuardiaPacientes"])->name("searchGuardiaPacientes");
/* obstetricia */
Route::get("/obstetriciaPaciente",[ObstetriciaController::class, "index"])->name("obstetriciaPaciente");
Route::get("/obstetriciaResetear",[ObstetriciaController::class, "index"])->name("obstetriciaResetear");
Route::post("/obstetriciaGrabar",[ObstetriciaController::class, "store"])->name("obstetriciaPaciente.store");
/* monitor controller */
Route::get("/monitorPedidos",[monitorController::class, "index"])->name("monitorPedidos");
/* usuario */
Route::get("/loginUsuario",[UsuarioController::class, "loginUsuario"])->name("loginUsuario");
Route::post("/validarUsuario",[UsuarioController::class, "validarUsuario"])->name("validarUsuario");
