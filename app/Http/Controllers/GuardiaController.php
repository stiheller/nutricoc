<?php

namespace App\Http\Controllers;

use App\Models\Nutricion\Colacion;
use App\Models\Nutricion\ColacionFrecuencia;
use App\Models\Nutricion\Dieta;
use App\Models\Nutricion\Frecuencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Session;
/* modelos de datos */
use App\Models\Nutricion\DietaLog;
use App\Models\Guardia\PedidoDieta;
class GuardiaController extends Controller
{

    public function grabarPedidoGuardia(Request $request){
        $error = 0;
        $hoy = Carbon::now()->format('Y-m-d');
        //encrypto a md5 para buscar el usuario en intranet
        $clave = md5($request->password);
        //validar usuario intranet en funcion global
        $usuario = fgGetUsuarioIntranet($clave, $hoy);

       if(count($usuario)< 1){
            Session::flash('error','Error al validar Usuario en Intranet');
            $error = 1;
       }

      //valido el paciente
       if($request->pacsend !=''){
            $arrayPaciente = explode("|",$request->pacsend);
            $arrayBox = explode("|",$request->lugarg);
            //inserto el registro
        }else{
            Session::flash('error','Error Datos Pacientes');
            $error = 1;
        }
        if(!isset($arrayPaciente[1]) OR is_null($arrayPaciente[1])){
            $error = 1;
            Session::flash('error','Paciente no registrado en la Guardia!!! ');
        }
        //si no hay error grabo el registro
       if($error == 0){
            //grabo el registro
            $newDieta = new PedidoDieta;
            $newDieta->fecha_programacion = $hoy;
            $newDieta->dni =  $arrayPaciente[0]; //dnipaciente
            $newDieta->apenom = $arrayPaciente[1]; //paciente
            $newDieta->destino_guardia_id = $arrayBox[0];
            $newDieta->destino_guardia = $arrayBox[1];
            $newDieta->destino_obstetricia = $request->lobs;
            $newDieta->dieta_id = $request->dieta;
            $newDieta->df_id = $request->fd;
            $newDieta->colacion_id = $request->colacion;
            $newDieta->cf_id = $request->cf;
            $newDieta->dieta_acomp_id = $request->dacomp;
            $newDieta->cantidad = $request->cacomp;
            $newDieta->observacion = $request->observacion;
            $newDieta->idAgente = $usuario[0]->idAgente;
            $newDieta->dniAgente = $usuario[0]->dni;
            $newDieta->legajo = $usuario[0]->legajo;
            $newDieta->nic_intranet = $usuario[0]->nic_chat;
            $newDieta->estado_id = 1;
            $newDieta->nutricoc_user_id = 99;
           $newDieta->origen_id = 1;
            $newDieta->save();
            //mensaje sesion
            if($newDieta->id > 0){
                //guardo el log de la dieta
                $log ="El Usuario ".$usuario[0]->nic_chat." ha grabado una dieta para el paciente ".$arrayPaciente[1]." con DNI ".$arrayPaciente[0];
                fgLogdieta($newDieta->id, $log);
                Session::flash('message','Pedido Agregado con Exito para el paciente '. $arrayPaciente[1]);
            }else{
                Session::flash('error','Error al grabar la dieta del paciente '. $arrayPaciente[1]);
            }

       }
       return redirect()->route('guardiaPedir');
    }

    public function logdieta($id){

        $logs = DietaLog::where('dieta_id', '=', $id)->orderBy('id', 'asc')->get();
        return view('guardia.log', compact('logs'));
        //return ( $losg);
    }

    public function accionPedidoIntranet(Request $request){

       $pass = md5($request->claveGuardia);
       $usuario = fgGetUsuarioIntranet($pass, date('Y-m-d'));
       //return $usuario[0]->nic_chat;
       //separo el array con datos
        $array = explode("|",$request->keyRegchequearGuardia);
       //controlo si es correcto el usuario
       $error = 0;
       if(count($usuario) < 1){
           Session::flash('error','Error Datos Usuario Intranet');
           $error = 1;
       }
       /*si todo esta bien proceso accion*/
        //si no hay error
        if($error == 0){
            $pedido = PedidoDieta::findOrFail($array[2]);
            switch ($array[0]){
                case "X": //eliminada
                    $pedido->nutricoc_user_id = 99;
                    $pedido->estado_id = 0;
                    $log ="El Usuario de Intranet ".$usuario[0]->nic_chat." ha eliminado la dieta";
                    Break;
                case "A": //anulada
                    $pedido->nutricoc_user_id = 99;
                    $pedido->estado_id = $array[1];
                    $log ="El Usuario de Intranet ".$usuario[0]->nic_chat." ha anulado la dieta";
                    Break;
            }
            $pedido->update();
            Session::flash('message',$log);
            /* grabo el log */
            fgLogdieta($array[2], $log);
        }else{
            Session::flash('error','Error Actualizando Programación');

        }

        return redirect()->route('monitorPedidos');


    }

    public function searchGuardiaPacientes(Request $request){
        $hoy = Carbon::now()->format('Y-m-d')." 23:59:59";
        $antesDeAyer = Carbon::now()->subDay(7)->format('Y-m-d')." 00:00:00";

        $data = $request->all();

        $query = $data['query'];

        $filter_data =  DB::connection('guardia')->table('gua_monitor')
            ->select('dni', 'paciente')
            ->whereBetween('fecha_busqueda', [$antesDeAyer,$hoy])
            ->where('dni', '=',$query)
            ->orderBy('paciente', 'asc')
            ->distinct()
            ->get();

        $data= [];
        foreach($filter_data as $item){
            $data[]= $item->dni."|".$item->paciente;
        }
        return response()->json($data);

    }

    public function guardiaPedir(Request $request)
    {
        $apenom = "";
        $fechanac = "";
        $dni = "";
        $hc = "";
        $dietas = [];
        $cf = [];
        $colacion = [];
        $frecuencia = [];
        $boxes = [];
        $hoy = Carbon::now()->format('Y-m-d')." 23:59:59";
        $antesDeAyer = Carbon::now()->subDay(7)->format('Y-m-d')." 00:00:00";

        if($request->dni !=''){
            $dni = $request->dni;
            Session::flash('','');
            $paciente =  DB::connection('guardia')->table('gua_monitor as m')
                ->join('gua_mov_datospac as p', 'p.dni', '=', 'm.dni')
                ->select('m.dni', 'm.paciente', 'p.fechaNac', 'p.hc')
                ->whereBetween('m.fecha_busqueda', [$antesDeAyer,$hoy])
                ->where('m.dni', '=',$dni )
                ->orderBy('p.idmov', 'DESC')
                ->take(1)
                ->get();

            //return($paciente[0]->dni);

            if(count($paciente) > 0){
                //array datos
                $dietas = Dieta::orderBy('name', 'asc')->get();
                $cf = ColacionFrecuencia::orderBy('name', 'asc')->get();
                $colacion = Colacion::orderBy('name', 'asc')->get();
                $frecuencia = Frecuencia::orderBy('name', 'asc')->get();
                /* boxes */
                $boxes = DB::connection('guardia')->table('gua_boxes')
                    ->select('id_box', 'nombre_box')
                    ->where('nutricoc', '=', 1)
                    ->get();
                $apenom =  $paciente[0]->paciente;
                $fechanac =Carbon::parse($paciente[0]->fechaNac)->format('d/m/Y');
                $hc = $paciente[0]->hc;
                Session::flash('message','Paciente Admitido con Exito');
            }else{
                Session::flash('error','Paciente No Registrado en Guardia');
            }
        }else{
            Session::flash('','');
        }


        return view('guardia.guardiaPedido',compact('apenom', 'fechanac', 'hc', 'dni','dietas','cf','colacion','frecuencia','boxes'));

    }


}
