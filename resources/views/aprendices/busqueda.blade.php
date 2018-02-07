@extends('layouts.app')

@section('title', 'Entrega de suplemento')

@section('informacion')
    <div>
        <p class="descripcion-busqueda">
            Ingresa el número de documento del aprendiz o pasa el lector sobre el código de barras del carné del aprendiz,
            una vez la persona es identificada, dale click en 'Entregar suplemento'.
        </p>
        <div class="row">
            <div class="d-flex align-center">
                <div class="col-md-5">
                    <img src="{{ asset('images/document-img.png') }}" alt="" class="img-responsive document-img">
                </div>
                <div class="col-md-7">
                    <form class="" action="{{ url('busqueda_aprendiz') }}" method="GET">
                        <div class="input-group">
                            <input name="numero_documento_aprendiz" type="number" class="form-control" placeholder="Número de documento del aprendiz" id="numero_documento" autocomplete="off" min="0" autofocus>
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-default">Buscar</button>
                            </span>
                        </div><!-- /input-group -->
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    @isset($aprendices)
        @forelse ($aprendices as $aprendiz)
            <div class="aprendiz-card">
                <div class="row">
                    <div class="col-md-6">
                        <ul class="list-unstyled">
                            <li class="h3"><strong>{{ $aprendiz->nombre_completo }}</strong></li>
                            <li>{{ $aprendiz->numero_documento }}</li>
                            <li class="text-uppercase">{{ $aprendiz->programa_formacion }}</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        @if(Auth::check())
                            <a href="{{ url('admin/registro_historico/'.$aprendiz->id) }}" class="btn btn-modal-historial">Ver historial</a>
                        @endif
                    </div>
                </div>
            </div>
            @php
            $fecha = substr($aprendiz->fecha, 0, -9);
            @endphp
            @if($fecha == date('Y-m-d'))
                @php
                $dt = new Jenssegers\Date\Date($aprendiz->fecha);
                @endphp
                <div class="entrega-warning">
                    <div class="text-center">
                        <i class="fas fa-exclamation-triangle fa-2x"></i>
                    </div>
                    <p class="text-center">
                        El aprendiz ya recibió el suplemento!
                    </p>
                    <p class="text-center text-uppercase">
                        Última fecha: <strong>{{ $dt->format('l d F Y h:i A')}}</strong>
                    </p>
                </div>
            @else
                <form action="{{ url($aprendiz->id.'/entrega_suplemento') }}" id="formEntrega" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="aprendiz_id" value="{{ $aprendiz->id }}">
                    <button type="submit" class="text-uppercase center-block btn btn-success" id="entregarSuplemento">Entregar suplemento</button>
                </form>
            @endif
        @empty
            <p class="h3 text-center">
                <strong>Información: </strong>El aprendiz no existe o su solicitud no ha sido aceptada aún.
            </p>
        @endforelse
    @endisset
@endsection
