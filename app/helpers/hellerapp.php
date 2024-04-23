<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

function fgValidarUsuarioHellerApp($usuario, $pass){
    $usuario = DB::connection('hellerapp')->table('users')
        ->where('username', '=', $usuario)
        ->get();
    $user = json_encode($usuario);
    return $user;

}

