@extends('layouts.app')

@section('title', 'Suplemento alimenticio')

@section('informacion')
    <!-- Modal historial -->
    @include('layouts.modal_historial')

    @if ($errors->has('token_error'))
        <!-- Modal -->
        <div class="modal fade" id="modalSession" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Sesión expirada</h4>
                    </div>
                    <div class="modal-body">
                        {{ $errors->first('token_error') }}
                    </div>
                    <div class="modal-footer">
                        <a href="{{ url('/') }}" class="btn-link">Volver a la página principal</a>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <section class="page-section">
        <div>
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
                {{-- <input type="number" class="form-control" placeholder="Número de documento del aprendiz" id="numero_documento" autofocus autocomplete="off" min="0">
                <button id="buscar_aprendiz" type="button"><i class="fa fa-search"></i></button>
                <div class="apprentice"></div> --}}

            </div>
            <hr>
            <div class="aprendices-seleccionados">
                <h3>
                    Lista de aprendices seleccionados.
                </h3>
                <div class="panel panel-default card">
                    <div>
                        <div class="table-responsive">
                            <table class="table table-full table-hover table-aprendices-beneficiados" id="myTable">
                                <caption>
                                </caption>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre completo</th>
                                        <th>Número de documento</th>
                                        <th>Programa de formación</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody  id="myTableAprendiz">
                                    @php
                                    $count = 1;
                                    @endphp
                                    @foreach($aprendices as $aprendiz)
                                        <tr>
                                            <td>{{ $count++ }}</td>
                                            <td>{{ $aprendiz->nombre_completo }}</td>
                                            <td>{{ $aprendiz->numero_documento }}</td>
                                            <td>{{ $aprendiz->programa_formacion }}</td>
                                            <td>
                                                <button class="btn btn-historial" data-toggle="modal" data-target="#modalHistorial" data-id="{{ $aprendiz->id }}" data-nombre="{{ $aprendiz->nombre_completo }}">
                                                    Ver historial
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@push('scripts')
    <script>
        $(window).on('load', function () {
            $('#modalSession').modal({ backdrop: 'static', keyboard: false });
        });
    </script>
@endpush
