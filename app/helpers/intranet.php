<?php
use Illuminate\Support\Facades\DB;

function fgGetUsuarioIntranet($clave, $fecha){
    $usuario = DB::connection('intranet')->table('usuarios')
        ->where('clave', '=', $clave)
        ->where('cp', '=', 'N')
        ->where('temporal', '=', 'N')
        ->where('fvp','>=', $fecha)
        ->get();
    return $usuario;
}
