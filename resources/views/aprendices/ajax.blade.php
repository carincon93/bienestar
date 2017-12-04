@foreach($solicitud as $datos)
    <h3 class="text-center text-uppercase">{{ $datos->nombre_completo }}</h3>
    @if($datos->compromiso_informar == null || $datos->compromiso_normas == null)
        <blockquote class="blockquote blockquote-danger">
            <i class="fa fa-fw fa-warning"></i>
            El aprendiz no aceptó algún compromiso!
        </blockquote>
    @endif
    <div class="modal-body-section">
        <div class="row">
            <div class="col-md-6">
                <h5>Tipo de documento</h5>
                <p>{{ $datos->tipo_documento === "cedula" ? "Cédula" : ($datos->tipo_documento ==="ti" ? "Tarjeta de identidad" : "") }}</p>
            </div>
            <div class="col-md-6">
                <h5>Número de documento</h5>
                <p>{{ $datos->numero_documento }}</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <h5>Dirección</h5>
                <p>{{ $datos->direccion }}</p>
            </div>
            <div class="col-md-6">
                <h5>Barrio</h5>
                <p>{{ $datos->barrio }}</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <h5>Teléfono</h5>
                <p>{{ $datos->telefono }}</p>
            </div>
            <div class="col-md-6">
                <h5>Estrato</h5>
                <p>{{ $datos->estrato }}</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h5>Correo electrónico</h5>
                <p>{{ $datos->email }}</p>
            </div>
        </div>
    </div>

    <h4 class="text-center">Información académica</h4>
    <div class="modal-body-section">
        <div class="row">
            <div class="col-md-12">
                <h5>Programa de formación</h5>
                <p>{{ $datos->programa_formacion }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h5>ID ficha</h5>
                <p>{{ $datos->numero_ficha }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h5>Jornada</h5>
                <p>{{ $datos->jornada }}</p>
            </div>
        </div>

    </div>





    <h4 class="text-center">
        <span>Información adicional</span>
    </h4>
    <div class="modal-body-section">
        <div class="row">
            <div class="col-md-12">
                <h5>De quién depende el aprendiz?</h5>
                <p>{{ $datos->pregunta1 }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h5>Personas las cuales dependen del aprendiz</h5>
                <p>{{ $datos->pregunta3 }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h5>Apoyos a los cuales esta vinculado el aprendiz</h5>
                <p>{{ $datos->otro_apoyo }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h5>Se compromete a informar en la oficina de Bienestar al Aprendiz el momento en que usted reciba contrato de aprendizaje, consiguió empleo, o cualquier otro beneficio del Gobierno o del SENA (Monitorias, FIC, Apoyos de sostenimiento, entre otros).</h5>
                <p>{{ $datos->compromiso_informar ? $datos->compromiso_informar : 'no' }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h5>Se compromete acatar las normas sobre el manejo adecuado del suplemento.</h5>
                <p>{{ $datos->compromiso_normas ? $datos->compromiso_normas : 'no' }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h5>Justificación del porque necesita el suplemento</h5>
                <p>{{ $datos->justificacion_suplemento }}</p>
            </div>
        </div>
    </div>

    <h4 class="text-center">Novedad</h4>
    <div class="modal-body-section">
        <form action="{{ url('admin/aprendiz_solicitud/'.$datos->id) }}" method="POST" id="solicitud">
            {{ csrf_field()  }}
            <div class="form-group">
                <input type="hidden" name="id" value="{{ $datos->id }}">
                <input type="hidden" name="estado" value="">
                <blockquote class="blockquote blockquote-info">
                    <i class="fa fa-fw fa-info"></i>
                    El siguiente campo le permite añadir una novedad a esta solicitud
                </blockquote>
                <textarea name="novedad_solicitud" rows="5" cols="50" class="form-control">{{$datos->novedad_solicitud != '' ? $datos->novedad_solicitud : 'No tiene novedad'  }}</textarea>
            </div>
        </form>
    </div>
@endforeach
