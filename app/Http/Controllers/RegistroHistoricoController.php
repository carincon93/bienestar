<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use Jenssegers\Date\Date;
use Illuminate\Support\Facades\DB;

use Excel;

use App\Aprendiz;
use App\RegistroHistorico;

class RegistroHistoricoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('obtener_historial', 'store', 'destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $registros_historicos   = RegistroHistorico::OrderBy('fecha', 'DESC')->get();
        $ultimos_registros      = DB::table('registros_historicos')
                    ->select('aprendices.id', 'aprendices.nombre_completo', DB::raw('count(registros_historicos.aprendiz_id) as total'))
                    ->join('aprendices', 'aprendices.id', '=', 'registros_historicos.aprendiz_id')
                    ->groupBy('aprendices.id', 'aprendices.nombre_completo')
                    ->orderBy('total', 'DESC')
                    ->take(5)
                    ->get();
        return view('registros_historicos.index', compact('registros_historicos', 'ultimos_registros'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        return $request;
        // $registro_historico = new RegistroHistorico();
        //
        // $registro_historico->aprendiz_id    = $id;
        // $registro_historico->fecha          = date('Y-m-d H:i:s');
        // $registro_historico->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $registros_historicos = RegistroHistorico::where('aprendiz_id', '=', $id)->orderBy('fecha', 'DESC')->get();
        return view('registros_historicos.mostrar', compact('registros_historicos'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        RegistroHistorico::destroy($id);
        return back()->with('status', 'El historial fue eliminado con éxito');
    }

    public function reportes()
    {
        return view('reportes.reportes');
    }

    public function datesearch(Request $request)
    {
        $fechaInicio = $request->get('inicio');
        $fechaFin    = $request->get('fin');

        if ($fechaInicio == '' && $fechaFin == '') {
            $registros_historicos = DB::table('registros_historicos')
                    ->select('aprendices.id', 'aprendices.nombre_completo', 'registros_historicos.fecha')
                    ->join('aprendices', 'aprendices.id', '=', 'registros_historicos.aprendiz_id')
                    ->groupBy('aprendices.id', 'aprendices.nombre_completo', 'registros_historicos.fecha')
                    ->get();
            return view('registros_historicos.ajax', compact('registros_historicos'));
        }
        else{
            // $hr = RegistroHistorico::whereBetween('fecha', [$fechaInicio, $fechaFin])->get();
            $registros_historicos = DB::table('registros_historicos')
                    ->select('aprendices.id', 'aprendices.nombre_completo', 'registros_historicos.fecha')
                    ->join('aprendices', 'aprendices.id', '=', 'registros_historicos.aprendiz_id')
                    ->whereBetween(DB::raw('cast(fecha as date)'), [$fechaInicio, $fechaFin])
                    ->groupBy('aprendices.id', 'aprendices.nombre_completo', 'registros_historicos.fecha')
                    ->get();
            return view('registros_historicos.ajax', compact('registros_historicos'));
        }
    }

    public function generar_reporte(Request $request)
    {
        $data        = $request->all();
        $fechaInicio = $data['fechaInicio'];
        $fechaFin    = $data['fechaFin'];
        $date1  = new Date($fechaInicio);
        $date2  = new Date($fechaFin);
        $month  = new Date($fechaFin);
        $year   = new Date($fechaFin);

        $fecha1 = $date1->format('d');
        $fecha2 = $date2->format('d');
        $mes    = $month->format('F');
        $ano    = $year->format('Y');

        $registros_historicos = DB::table('registros_historicos')
        ->select(DB::raw('count(registros_historicos.aprendiz_id) as total'), 'registros_historicos.aprendiz_id', 'aprendices.nombre_completo', 'aprendices.programa_formacion', 'aprendices.numero_ficha')
        ->join('aprendices', 'aprendices.id', '=', 'registros_historicos.aprendiz_id')
        ->whereBetween(DB::raw('cast(fecha as date)'), [$fechaInicio, $fechaFin])
        ->groupBy('registros_historicos.aprendiz_id', 'aprendices.nombre_completo', 'aprendices.programa_formacion', 'aprendices.numero_ficha')
        ->havingRaw('registros_historicos.aprendiz_id')
        ->orderBy('aprendices.nombre_completo', 'ASC')
        ->get();

        Excel::load('reportes/Auxilio de Alimentación Semanal V-02.xlsx', function($reader) use($registros_historicos, $fecha1, $fecha2 ,$mes ,$ano) {
            $reader->sheet('Hoja1', function($sheet) use ($reader, $registros_historicos, $fecha1, $fecha2 ,$mes ,$ano) {
                $sheet->row(2, array(
                    'CENTRO DE FORMACIÓN: PROCESOS INDUSTRIALES Y CONSTRUCCIÓN    SEMANA: ' . $fecha1. '-' .$fecha2. ' DE '. strToUpper($mes). ' DE ' .$ano
                ));

                foreach ($registros_historicos as $registro_historico) {
                    $sheet->appendRow(array(
                        '', '', $registro_historico->nombre_completo, $registro_historico->programa_formacion, $registro_historico->numero_ficha, $registro_historico->total, ''
                    ));
                }
                $sheet->setBorder('A4:G17', 'thin');
            });

        })->export('xls');
    }

    public function obtener_historial(Request $id)
    {
        $registros_historicos = RegistroHistorico::where('aprendiz_id', $id['id'])->orderBy('fecha', 'DESC')->paginate(5);
        return view('registros_historicos.fechas', compact('registros_historicos'));
    }
}
