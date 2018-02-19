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
                        <div class="input-group busqueda-aprendiz">
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
            @php
            // Setear foto de aprendiz (Solo cuando la url es localhost/.../public)
            if ($aprendiz->foto) {
                $foto = explode('/', $aprendiz->foto);
            } else {
                $foto = null;
            }

            if ($aprendiz->fecha) {
                $formatFecha = DateTime::createFromFormat('Y-m-d H:i:s', $aprendiz->fecha);
                $ultimaFecha = $formatFecha->format('Y-m-d');
            } else {
                $ultimaFecha = null;
            }
            $fechaHumanos = new Jenssegers\Date\Date($aprendiz->fecha);
            @endphp
            <div>
                <div class="aprendiz-card">
                    <h4 class="text-uppercase text-center m0">{{ $aprendiz->programa_formacion }}</h4>
                    <hr>
                    <div class="row mt-25">
                        <div class="col-md-3">
                            <img src="{{ asset('storage/'.$foto[1].'/'.$foto[2]) }}" alt="" class="img-responsive foto-aprendiz">
                        </div>
                        <div class="col-md-9">
                            <ul class="list-unstyled">
                                <li class="h3 m0"><strong>{{ $aprendiz->nombre_completo }}</strong></li>
                                <li>{{ $aprendiz->numero_documento }}</li>
                            </ul>
                            <ul class="list-inline">
                                @if(Auth::check())
                                    <li>
                                        <a href="{{ url('admin/registro_historico/'.$aprendiz->id) }}" class="btn btn-modal-historial">Ver historial</a>
                                    </li>
                                @endif
                                @if($ultimaFecha == date('Y-m-d'))
                                    <li>
                                        <p class="text-uppercase text-center advertencia mt-25">
                                            <i class="fas fa-exclamation-triangle color-danger"></i>
                                            El aprendiz ya recibió el suplemento!
                                            Última fecha: <strong>{{ $fechaHumanos->format('l d F Y h:i A')}}</strong>
                                        </p>
                                    </li>
                                @else
                                    <li>
                                        <form action="{{ url($aprendiz->id.'/entrega_suplemento') }}" id="formEntrega" method="post">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="aprendiz_id" value="{{ $aprendiz->id }}">
                                            <button type="submit" class="text-uppercase center-block btn btn-success" id="entregarSuplemento">Entregar suplemento</button>
                                        </form>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="h3 text-center">
                <strong>Información: </strong>El aprendiz no existe o su solicitud no ha sido aceptada aún.
            </p>
        @endforelse
    @endisset
@endsection
