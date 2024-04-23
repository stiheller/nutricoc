<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Session;
/* modelos */
use App\Models\Nutricion\Colacion;
use App\Models\Nutricion\ColacionFrecuencia;
use App\Models\Nutricion\Dieta;
use App\Models\Nutricion\Frecuencia;
use App\Models\Guardia\PedidoDieta;
class ObstetriciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
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
        if(isset($request->dni))
        {
            /* buscar paciente */
            $dni = $request->dni;
            $paciente = Http::get('http://srvsql/optic/consultaPaciente.php?dni='.$dni);
            if($paciente['sex'] !='M'){
                //array datos
                $dietas = Dieta::orderBy('name', 'asc')->get();
                $cf = ColacionFrecuencia::orderBy('name', 'asc')->get();
                $colacion = Colacion::orderBy('name', 'asc')->get();
                $frecuencia = Frecuencia::orderBy('name', 'asc')->get();
                /* boxes */
                $boxes = DB::connection('guardia')->table('gua_boxes_obstetricia')
                    ->select('id_box', 'nombre_box')
                    ->where('nutricoc', '=', 1)
                    ->get();
                $apenom =  $paciente['ape'].",".$paciente['nom'];
                $fechanac =Str::substr($paciente['fechanac'],6,2)."/".Str::substr($paciente['fechanac'],4,2)."/".Str::substr($paciente['fechanac'],0,4);
                $hc = $paciente['hc'];
                Session::flash('message','Paciente Admitido con Exito');
            }else{
                Session::flash('error','No puede Admitir un Paciente Masculino ');
            }

        }else{
            Session::flash('','');
        }
        return view('obstetricia.index', compact('dni','apenom', 'fechanac','dietas','cf','colacion','frecuencia', 'boxes', 'hc'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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
            Session::flash('error','Paciente no Registrado!!! ');
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
            $newDieta->origen_id = 2;
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
        return redirect()->route('obstetriciaPaciente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
