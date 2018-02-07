@extends('layouts.app')

@section('title', 'Historial de entregas')

@section('informacion')
    <blockquote class="blockquote">
        <p>Historial de aprendices que han recibido suplementos.</p>
    </blockquote>
@endsection

@section('content')
    @include('layouts.modal')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>
                        <i class="fa fa-fw fa-table"></i>
                        Tabla historial
                    </h4>
                </div>
                <div class="table-responsive card-content">
                    <table class="table table-full table-hover" id="myTable" data-form="deleteForm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre aprendiz</th>
                                <th>Fecha de entrega</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="history" id="myTableAprendiz">
                            @php
                            $count = 1;
                            @endphp
                            @foreach($registros_historicos as $registro_historico)
                                @php
                                $dt = new Jenssegers\Date\Date($registro_historico->fecha);
                                @endphp
                                <tr>
                                    <td>{{ $count++ }}</td>
                                    <td>{{ $registro_historico->aprendiz->nombre_completo }}</td>
                                    <td>
                                        <span class="text-uppercase">{{ $dt->format('l d F') }}</span>
                                        <div>
                                            {{ $dt->format('Y h:i A') }}
                                        </div>
                                    </td>

                                    <td>
                                        <form action="{{ url('admin/registro_historico/'.$registro_historico->id) }}" style="display: inline-block;" data-nombre="{{ $registro_historico->aprendiz->nombre_completo }}"  method="POST" class="btn-delete-tbl btn btn-round">
                                            {{ method_field('delete') }}
                                            {{ csrf_field() }}
                                            <i class="fa fa-fw fa-trash"></i>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <p class="text-center">
                Aprendices más beneficiados con el suplemento alimenticio.
            </p>
            <div class="card">
                <div class="panel-heading">
                    <i class="fa fa-fw fa-trophy center-block"></i>
                </div>
                <div class="table-responsive card-content">
                    <table class="table table-hovered">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Total</th>
                                {{-- <th></th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ultimos_registros as $ultimo_registro)
                                <tr>
                                    <td>
                                        {{ $ultimo_registro->nombre_completo }}
                                    </td>
                                    <td>
                                        {{ $ultimo_registro->total }}
                                    </td>
                                    {{-- <td>
                                        <a href="{{ url('admin/registro_historico/'.$ultimo_registro->id) }}" class="btn btn-round">
                                            <i class="fa fa-fw fa-external-link"></i>
                                        </a>
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
