@foreach($busqueda as $aprendiz)

    @php
    $fecha = substr($aprendiz->fecha, 0, -9);
    @endphp

    <div class="aprendiz-card">
        <div class="row">
            <div class="col-md-6">
                <ul class="list-unstyled">
                    <li class="h4">{{ $aprendiz->nombre_completo }}</li>
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

    {{-- @if(isset($fecha) && $fecha == date('Y-m-d'))
        @php
        $dt = new Jenssegers\Date\Date($aprendiz->fecha);
        @endphp
        <div class="entrega-warning">
            <div class="text-center">
                <i class="fa fa-fw fa-warning fa-2x"></i>
            </div>
            <p class="text-center">
                El aprendiz ya recibió el suplemento! <br>Última fecha: <strong>{{ $dt->format('l d F Y h:i A')}}</strong>
            </p>
        </div>
    @else
        <form action="{{ url($aprendiz->id.'/entrega_suplemento') }}" id="formEntrega" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="aprendiz_id" value="{{ $aprendiz->id }}">
            <button type="submit" class="text-uppercase center-block btn btn-success" id="entregarSuplemento">Entregar suplemento</button>
        </form>
    @endif --}}
@endforeach
