<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Aprendiz;
use App\RegistroHistorico;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aprendices             = Aprendiz::where('estado_solicitud', 1)->orderBy('nombre_completo')->get();
        $registros_historicos   = RegistroHistorico::all();
        // $registros_historicos = DB::table('history_records')
        //             ->select('aprendices.id', 'aprendices.nombre_completo', DB::raw('count(registros_historicosapprentice_id) as total'))
        //             ->join('apprentices', 'aprendices.id', '=', 'registros_historicosapprentice_id')
        //             ->groupBy('aprendices.id', 'aprendices.nombre_completo')
        //             ->get();
        return view('index', compact('aprendices', 'registros_historicos'));
    }
}
