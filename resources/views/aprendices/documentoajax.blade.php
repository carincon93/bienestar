@foreach($busqueda as $aprendiz)
    @foreach($aprendiz->registros_historicos as $his)
        @php
        $fecha = substr($his->fecha, 0, -9);
        @endphp
    @endforeach
    <div class="aprendiz-card">
        <div class="row">
            <div class="col-md-6">
                <ul class="list-unstyled">
                    <li class="h4">{{ $aprendiz->nombre_completo }}</li>
                    <!-- <div>
                    <i class="fa fa-fw fa-info"></i>
                    El aprendiz solo puede recibir el suplemento alimenticio una vez por día.
                </div> -->
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
@if(isset($fecha) && $fecha == date('Y-m-d'))
    @php
    $dt=new Jenssegers\Date\Date($aprendiz->registros_historicos->last()->fecha);
    @endphp
    <div class="entrega-warning">
        <p>
            <i class="fa fa-fw fa-warning center-block"></i>El aprendiz ya recibió el suplemento! Última fecha: <strong>{{ $dt->format('l d F Y h:i A')}}</strong>
        </p>
    </div>
@else
    <form action="{{ url($aprendiz->id.'/entrega_suplemento') }}" id="formEntrega" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="aprendiz_id" value="{{ $aprendiz->id }}">
        <button type="submit" class="text-uppercase pull-right btn-no-style" id="entregarSuplemento">Entregar suplemento</button>
    </form>
@endif
@endforeach
