<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class UsuarioController extends Controller
{
    public function loginUsuario()
    {
        return view("auth.login");
    }

    public function validarUsuario(Request $request)
    {


        if($request->password !=''){
            $pass = md5($request->password);
            $usuario = User::where('username', '=', $request->dni)
                ->where('password', '=', $pass)
                ->get();
            //return ($usuario);
            if(count($usuario) ==1){
                return('entraste');
            }else{
                return view("auth.login");

            }
        }else{
            return view("auth.login");
        }


    }
}
