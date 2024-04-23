<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Session;

/* modelos */
use App\Models\Nutricion\Colacion;
use App\Models\Nutricion\ColacionFrecuencia;
use App\Models\Nutricion\Dieta;
use App\Models\Nutricion\Frecuencia;

class monitorController extends Controller
{
    public function index(Request $request){


        if(isset($request->dateSearch)){
            $dateSearch = $request->dateSearch;
        }else{
            $dateSearch = Carbon::now()->format('Y-m-d');
        }

        $dietas = Dieta::orderBy('name', 'asc')->get();
        $cf = ColacionFrecuencia::orderBy('name', 'asc')->get();
        $colacion = Colacion::orderBy('name', 'asc')->get();
        $frecuencia = Frecuencia::orderBy('name', 'asc')->get();
        $boxes = DB::connection('guardia')->table('gua_boxes')
            ->select('id_box', 'nombre_box')
            ->where('nutricoc', '=', 1)
            ->get();

        //busco las dietas del dia
        $registros = DB::connection('mysql')->table('dietas_monitor as g')
            ->select('g.*', 'd.name as dieta','f.name as dietafrec', 'c.name as colacion', 'c.icon as colacionIcon',
                'cf.name as colacionfrec','da.name as dietaAcomp', 'e.name as estado', 'u.name as usuario', 'e.icon', 'f.icon as frecIcon',
                'o.nombre as origen', 'o.icon')
            ->join("nut_dietas as d", "d.id", "=", "g.dieta_id")
            ->join('nut_frecuencias as f', 'f.id', '=', 'g.df_id')
            ->join('nut_colaciones as c', 'c.id', '=', 'g.colacion_id')
            ->join('nut_colacion_frec as cf', 'cf.id', '=', 'g.cf_id')
            ->join("nut_dietas as da", "da.id", "=", "g.dieta_acomp_id")
            ->join("nut_dietas_estado as e", "e.id", "=", "g.estado_id")
            ->join("users as u", "u.id", "=", "g.nutricoc_user_id")
            ->join("dietas_monitor_origenes as o", "o.id", "=", "g.origen_id")
            ->where('fecha_programacion', "=", $dateSearch)
            ->orderBy('g.estado_id', 'ASC')
            ->get();
        //return($registros);
        return view('monitor.index', compact('dietas', 'cf', 'colacion', 'frecuencia', 'boxes','registros','dateSearch'));

    }
}
