@extends('layouts.app')
@section('big-content-desc')
    <p>
        <blockquote class="blockquote">
            <i class="fa fa-fw fa-calendar-o"></i>
            Historial del aprendiz
        </blockquote>
    </p>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-full table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre aprendiz</th>
                                <th>Fecha de entrega</th>
                            </tr>
                        </thead>
                        <tbody  id="myTableAprendiz">
                            @php
                            $count = 1;
                            @endphp
                            @if(count($registros_historicos) > 0)
                                @foreach($registros_historicos as $registro_historico)
                                    <tr>
                                        <td>{{ $count++ }}</td>
                                        <td>{{ $registro_historico->aprendiz->nombre_completo }}</td>
                                        @php

                                        $dt=new Jenssegers\Date\Date($registro_historico->fecha);

                                        @endphp
                                        <td>{{ $dt->format('l d F Y h:i A')}}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3">
                                        No se encuentran registros para este aprendiz.</p>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4 text-center">
            <span class="h5">
                Total de entregas:
            </span>
            <h2>
                @php
                $countEntregas = 0;
                @endphp
                @foreach($registros_historicos as $registro_historico)
                    @php
                    $countEntregas++;
                    @endphp
                @endforeach
                {{ $countEntregas }}
            </h2>
        </div>

    </div>
@endsection
