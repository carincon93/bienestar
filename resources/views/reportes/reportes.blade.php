@extends('layouts.app')

@section('title', 'Reportes')

@section('informacion')
    <h4>Generar reportes</h4>
    <blockquote class="blockquote">
        <p>
            <i class="fa fa-fw fa-info"></i> Siga los siguientes pasos para generar un reporte.
        </p>
        <ol>
            <li>Seleccione un rango de fechas, de las cuales quiere generar el reporte <strong>(fecha inicio - fecha fin)</strong>.</li>
            <li>Una vez seleccionadas las dos fechas, da click en buscar.</li>
            <li>El botón 'Descargar reporte' se habilitará (Color verde).</li>
        </ol>
    </blockquote>
@endsection

@section('content')
    <div>
        <div>
            <form action="{{ url('datesearch') }}" method="POST" class="form-datepicker">
                <fieldset>
                    <legend class="h4">
                        Búsqueda por fechas
                    </legend>
                    {{ csrf_field() }}
                    <div class="input-daterange input-group datapickerr" id="datepicker">
                        <div class="input-date-wrapper">
                            <label for="inicio">Fecha inicio</label>
                            <input type="text" class="input-sm form-control" name="inicio"  autocomplete="off">
                        </div>
                        <span class="input-group-addon"></span>
                        <div class="input-date-wrapper">
                            <label for="inicio">Fecha fin</label>
                            <input type="text" class="input-sm form-control" name="fin" autocomplete="off">
                        </div>
                    </div>
                    <div class="search-dates-wrapper">
                        <button type="button" class="btn-no-style reset text-uppercase">Limpiar</button>

                        <button type="button" class="btn-no-style enviarfechas text-uppercase pull-right">Buscar</button>
                    </div>
                </fieldset>
            </form>
        </div>
        <div>
            <br>
            <form action="{{ url('admin/generar_reporte') }}" style="display: inline-block;" method="POST" class="text-uppercase" id="formReporte">
                {{ csrf_field()  }}
                <input type="hidden" name="fechaInicio">
                <input type="hidden" name="fechaFin">
                <button type="submit" class="btn btn-success" name="button-export-reporte" disabled>Descargar reporte</button>
            </form>
        </div>

    </div>
@endsection
