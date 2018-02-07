<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

use App\Http\Requests\AprendizRequest;

use Carbon\Carbon;
use Jenssegers\Date\Date;

use App\Aprendiz;
use App\RegistroHistorico;

use Auth;
use Excel;

class AprendizController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('entrega_suplemento', 'ajax', 'busqueda_aprendiz');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        redirect('admin/dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('aprendices.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AprendizRequest $request)
    {
        $aprendiz = new Aprendiz();
        $aprendiz->nombre_completo     = strtoupper($request->get('nombre_completo'));
        $aprendiz->tipo_documento      = $request->get('tipo_documento');
        $aprendiz->numero_documento    = $request->get('numero_documento');
        $aprendiz->direccion           = $request->get('direccion');
        $aprendiz->barrio              = $request->get('barrio');
        $aprendiz->estrato             = $request->get('estrato');
        $aprendiz->telefono            = $request->get('telefono');
        $this->validate($request, [
            'email' => [
                'required',
                'email',
                Rule::unique('aprendices')->ignore($aprendiz->id),
            ]
        ]);
        $aprendiz->email               = $request->get('email');
        $aprendiz->programa_formacion  = strtoupper($request->get('programa_formacion'));
        $aprendiz->numero_ficha        = $request->get('numero_ficha');
        $aprendiz->jornada             = $request->get('jornada');
        $aprendiz->pregunta1           = $request->get('pregunta1');
        $aprendiz->pregunta3           = $request->get('pregunta3');
        $aprendiz->otro_apoyo          = $request->get('otro_apoyo');
        $aprendiz->compromiso_informar = $request->get('compromiso_informar');
        $aprendiz->compromiso_normas   = $request->get('compromiso_normas');
        $aprendiz->justificacion_suplemento = $request->get('justificacion_suplemento');
        if ($aprendiz->save()){
            return redirect('admin/dashboard')->with('status', 'El aprendiz '.$aprendiz->nombre_completo.' fue adicionado con éxito');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $aprendiz = Aprendiz::findOrFail($id);
        return view('aprendices.mostrar', compact('aprendiz') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $aprendiz = Aprendiz::findOrFail($id);
        return view('aprendices.editar', compact('aprendiz') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AprendizRequest $request, $id)
    {
        $aprendiz = Aprendiz::findOrFail($id);
        $aprendiz->nombre_completo       = $request->get('nombre_completo');
        $aprendiz->tipo_documento        = $request->get('tipo_documento');
        $aprendiz->numero_documento      = $request->get('numero_documento');
        $aprendiz->direccion             = $request->get('direccion');
        $aprendiz->barrio                = $request->get('barrio');
        $aprendiz->estrato               = $request->get('estrato');
        $aprendiz->telefono              = $request->get('telefono');
        $this->validate($request, [
            'email' => [
                'required',
                'email',
                Rule::unique('aprendices')->ignore($aprendiz->id),
            ],
        ]);
        $aprendiz->email                 = $request->get('email');
        $aprendiz->programa_formacion    = $request->get('programa_formacion');
        $aprendiz->numero_ficha          = $request->get('numero_ficha');
        $aprendiz->jornada               = $request->get('jornada');
        $aprendiz->pregunta1             = $request->get('pregunta1');
        $aprendiz->pregunta3             = $request->get('pregunta3');
        $aprendiz->otro_apoyo            = $request->get('otro_apoyo');
        $aprendiz->compromiso_informar   = $request->get('compromiso_informar');
        $aprendiz->compromiso_normas     = $request->get('compromiso_normas');
        $aprendiz->justificacion_suplemento = $request->get('justificacion_suplemento');
        if ($aprendiz->save()){
            return redirect('admin/dashboard')->with('status', 'El aprendiz '.$aprendiz->nombre_completo.' fue modificado con éxito');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Aprendiz::destroy($id);
        return redirect('admin/dashboard')->with('status', 'El aprendiz fue eliminado con éxito');
    }

    public function solicitud(Request $request, $id)
    {
        $aprendiz = Aprendiz::findOrFail($id);
        $aprendiz->novedad_solicitud = $request->get('novedad_solicitud');
        if ($request->get('estado') == 1) {
            $aprendiz->estado_solicitud = 1;
            $msj = 'La solicitud del aprendiz <strong>'.$aprendiz->nombre_completo.'</strong> fue aceptada!';
        } else {
            $aprendiz->estado_solicitud = 0;
            $msj = 'La solicitud del aprendiz <strong>'.$aprendiz->nombre_completo.'</strong> fue rechazada!';
        }
        if($aprendiz->save()) {
            return redirect('admin/dashboard')->with('status', $msj);
        }
    }

    public function obtener_solicitud(Request $id)
    {
        $solicitud = Aprendiz::findOrFail($id);
        return view('aprendices.ajax', compact('solicitud'));
    }

    public function entrega_suplemento(Request $request, $id)
    {
        $aprendiz = Aprendiz::where('id', $id)->firstOrFail();
        $aprendiz->estado_beneficio = 1;
        $aprendiz_id = $aprendiz->id;
        $aprendiz->save();

        RegistroHistorico::create([
            'aprendiz_id'   => $aprendiz_id,
            'fecha'         => date('Y-m-d H:i:s')
        ]);

        return redirect('/')->with('status', 'El aprendiz ha recibido el suplemento!');
    }

    public function ajax(Request $request)
    {
        // $busqueda = Aprendiz::numero_documento($request->get('numero_documento'))->get();
        $busqueda      = DB::table('aprendices')
                        ->select('aprendices.id', 'aprendices.nombre_completo', 'aprendices.numero_documento', 'aprendices.programa_formacion', 'aprendices.numero_ficha', 'registros_historicos.aprendiz_id', 'registros_historicos.fecha')
                        ->leftJoin('registros_historicos', 'registros_historicos.aprendiz_id', '=', 'aprendices.id')
                        ->where([
                            ['numero_documento', $request->numero_documento],
                            ['estado_solicitud', '=', 1]
                        ])
                        ->groupBy('aprendices.id', 'aprendices.nombre_completo', 'aprendices.numero_documento', 'aprendices.programa_formacion', 'aprendices.numero_ficha', 'registros_historicos.aprendiz_id', 'registros_historicos.fecha')
                        ->orderBy('registros_historicos.fecha', 'DESC')
                        ->limit(1)
                        ->get();
        // return view('aprendices.documentoajax', compact('busqueda'));
        return $busqueda;
    }

    public function busqueda_aprendiz(Request $request)
    {
        $numero_documento       = $request->get('numero_documento_aprendiz');

        $aprendices             = DB::table('aprendices')
                                ->select('aprendices.id', 'aprendices.nombre_completo', 'aprendices.numero_documento', 'aprendices.programa_formacion', 'aprendices.numero_ficha', 'registros_historicos.aprendiz_id', 'registros_historicos.fecha')
                                ->leftJoin('registros_historicos', 'registros_historicos.aprendiz_id', '=', 'aprendices.id')
                                ->where([
                                    ['numero_documento', $numero_documento],
                                    ['estado_solicitud', '=', 1]
                                ])
                                ->groupBy('aprendices.id', 'aprendices.nombre_completo', 'aprendices.numero_documento', 'aprendices.programa_formacion', 'aprendices.numero_ficha', 'registros_historicos.aprendiz_id', 'registros_historicos.fecha')
                                ->orderBy('registros_historicos.fecha', 'DESC')
                                ->limit(1)
                                ->get();

    	return view('aprendices.busqueda', compact('aprendices'));
    }

    public function store_import(Request $request)
    {
        if($request->file('imported-file'))
        {
            $path = $request->file('imported-file')->getRealPath();

            $data = Excel::selectSheets('Hoja1')->load($path, function($reader)
            {
            })->get();
            if(!empty($data) && $data->count())
            {
                foreach ($data->toArray() as $row)
                {
                    if(!empty($row))
                    {
                        $compromiso = $row['compromiso_del_aprendiz'];
                        if(isset($compromiso)) {
                            if (strpos($compromiso, 'si') !== false) {
                                $compromiso_informar = 'si';
                            } else {
                                $compromiso_informar = 'no';
                            }
                            if(strpos($compromiso, 'si') !== false) {
                                $compromiso_normas = 'si';
                            } else {
                                $compromiso_normas = 'no';
                            }
                        } else {
                            $compromiso_informar = 'no';
                            $compromiso_normas = 'no';
                        }
                        $dataArray[] =
                        [
                            'nombre_completo'       => strtoupper($row['nombre_completo']),
                            'tipo_documento'        => strtolower($row['tipo_de_documento_de_identidad']),
                            'numero_documento'      => str_replace(array('.', ',', ' '), '', $row['numero_de_documento']),
                            'direccion'             => $row['direccion'],
                            'barrio'                => $row['barrio'],
                            'estrato'               => $row['estrato'],
                            'telefono'              => $row['telefono'],
                            'email'                 => $row['email'],
                            'programa_formacion'    => strtoupper($row['programa_de_formacion']),
                            'numero_ficha'          => $row['n0_de_ficha'],
                            'jornada'               => $row['jornada'],
                            'pregunta1'             => $row['de_quien_depende_usted'],
                            'pregunta3'             => $row['tiene_personas_que_dependan_de_usted'],
                            'otro_apoyo'            => strtolower($row['es_usted_beneficiario_de_algun_apoyo']),
                            'compromiso_informar'   => $compromiso_informar,
                            'compromiso_normas'     => $compromiso_normas,
                            'justificacion_suplemento' => $row['explique_a_profundidad_por_que_requiere_el_suplemento.'],
                        ];
                    }
                }

                if(!empty($dataArray))
                {
                    Aprendiz::insertIgnore($dataArray);
                    return redirect('admin/dashboard')->with('status', 'Se ha importado el archivo con éxito!');
                }
            } else {
                return redirect('admin/dashboard')->with('status-danger', 'No se ha podido importar el archivo!');
            }
        }
    }

    public function excel()
    {
        Excel:: create('Registros_Backup' , function($excel) {
            $excel->sheet('Historial' , function($sheet) {
                $his = RegistroHistorico::all();
                $sheet->loadView('aprendices.historial' , array('his' => $his));
            });
            $excel->sheet('Solicitudes Aceptadas' , function($sheet) {
                $sa = Aprendiz::where('estado_solicitud', 1)->orderBy('nombre_completo', 'ASC')->get();
                $sheet->loadView('aprendices.solicitudes_aceptadas' , array('sa' => $sa));
            });
            $excel->sheet('Solicitudes Rechazadas' , function($sheet) {
                $sd = Aprendiz::where('estado_solicitud', 0)->orderBy('nombre_completo', 'ASC')->get();
                $sheet->loadView('aprendices.solicitudes_denegadas' , array('sd' => $sd));
            });
        })->download('xls' );
    }

    public function aceptar_solicitudes(Request $request)
    {
        $aprendiz = Aprendiz::whereIn('id', $request->id)->update(['estado_solicitud' => 1]);

        return redirect('admin/dashboard')->with('status', 'Las solicitudes han sido aprobadas con éxito!');
    }
}
