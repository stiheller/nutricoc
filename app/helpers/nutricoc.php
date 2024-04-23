<?php

use App\Models\User;
use App\Models\Nutricion\DietaLog;

function fgGetUsuarioNutriCoc($clave, $dni){
    $usuario = User::where('username', '=', $dni)
                    ->where('password', '=', $clave)
                    ->get();
    return $usuario;
}

function fgLogdieta($dieta, $log){
    $newLog = new DietaLog;
    $newLog->dieta_id = $dieta;
    $newLog->log = $log;
    $newLog->save();


}
