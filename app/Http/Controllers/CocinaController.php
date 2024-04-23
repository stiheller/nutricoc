<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;

use App\Models\guardia\PedidoDieta;
use App\Models\Nutricion\Dieta;

class CocinaController extends Controller
{
    public function accionPedidoDieta(Request $request){



        $pass = md5($request->clave);
        //return($pass." - ".$request->dni);

        /*
         * 0 = tipo de accion
         * 1 = id Accion
         * 2 = id dietas_monitor
         */
       $array = explode("|",$request->keyRegchequear);
       $pedido = PedidoDieta::findOrFail($array[2]);
       $dieta = Dieta::findOrFail($pedido->dieta_id);
       $usuario = fgGetUsuarioNutriCoc($pass, $request->dni);
       $error = 0;
       if(count($usuario) < 1){
            Session::flash('error','Error Datos Usuario Cocina');
            $error = 1;
        }
       //si no hay error
       if($error == 0){

            switch ($array[0]){
                case "C": //confirmada
                    $pedido->nutricoc_user_id = $usuario[0]['id'];
                    $pedido->estado_id = 2;
                    $log ="El Usuario de cocina ".$usuario[0]['name']." ha confirmado la dieta";
                    Break;
                case "E": //entregada
                    $pedido->nutricoc_user_id = $usuario[0]['id'];
                    $pedido->estado_id = 4;
                    $log ="El Usuario de cocina ".$usuario[0]['name']." ha entregsado la dieta";
                    Break;
                case "X": //eliminada
                    $pedido->nutricoc_user_id = $usuario[0]['id'];
                    $pedido->estado_id = 0;
                    $log ="El Usuario de cocina ".$usuario[0]['name']." ha eliminado la dieta";
                    Break;
                case "A": //anulada
                    $pedido->nutricoc_user_id = $usuario[0]['id'];
                    $pedido->estado_id = $array[1];
                    $log ="El Usuario de cocina ".$usuario[0]['name']." ha anulado la dieta";
                    Break;
                default:
                    $pedido->nutricoc_user_id = $usuario[0]['id'];
                    $pedido->estado_id = 1;
                    $log ="El Usuario de cocina ".$usuario[0]['name']." ha solicitado la dieta";
                    Break;
            }
            $pedido->update();
            Session::flash('message', $log);
            /* grabo el log */
            fgLogdieta($dieta->id, $log);
       }else{
           Session::flash('error','Error Actualizando Programación');

       }

        return redirect()->route('monitorPedidos');
    }

}
