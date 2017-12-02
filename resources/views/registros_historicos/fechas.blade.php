<table class="table table-full table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Nombre aprendiz</th>
            <th>Fecha de entrega</th>
            <th>Acciones</th>
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
                    $dt = new Jenssegers\Date\Date($registro_historico->fecha);
                @endphp
                <td>{{ $dt->format('l d F Y h:i A') }}</td>
                <td>
                    <div class="dropdown">
                    <a href="#" class="dropdown-toggle text-capitalize user-name" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-fw fa-trash"></i><span class="caret"></span></a>

                    <ul class="dropdown-menu">
                        <li>
                            <form action="{{ url('admin/registro_historico/'.$registro_historico->id) }}" method="POST">
                                {{ method_field('delete') }}
                                {{ csrf_field()  }}
                                <button type="submit" class="btn-no-style text-center button-width">Está seguro?</button>
                            </form>
                        </li>
                    </ul>
                </div>
                </td>
            </tr>
            @endforeach
        @else
        <tr>
            <td colspan="4">
                No se encuentran registros para este aprendiz.
            </td>
        </tr>
        @endif
    </tbody>
</table>
