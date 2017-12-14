@extends('layouts.app')

@section('title','Editar aprendiz')

@section('informacion')
	<ul class="breadcrumb">
		<li><a href="{{ url('admin/dashboard') }}" class="btn-link">Lista de aprendices</a></li>
		<li>Editar aprendiz</li>
	</ul>
@endsection

@section('content')
	<div class="col-md-8">
		<div class="card-form">
			<form action="{{ url('admin/aprendiz/'.$aprendiz->id) }}" method="POST">
				{{ csrf_field()  }}
				{{ method_field('PUT') }}
				<p class="note note-danger">{{ count($errors) > 0 ? 'Información: Por favor echa un vistazo a los errores y asegurate de llenar bien cada campo.' : '' }}</p>
				<div class="form-group{{ $errors->has('nombre_completo') ? ' has-error' : '' }}">
					<label for="nombre_completo" class="control-label">
						Nombre completo *
					</label>
					<input type="text" name="nombre_completo" class="form-control" value="{{ $aprendiz->nombre_completo }}">
					@if ($errors->has('nombre_completo'))
						<span class="help-block">
							{{ $errors->first('nombre_completo') }}
						</span>
					@endif
				</div>
				<div class="form-group{{ $errors->has('tipo_documento') ? ' has-error' : '' }}">
					<label for="tipo_documento" class="control-label">
						Tipo de documento *
					</label>
					<select name="tipo_documento" class="form-control">
						<option value="cedula" {{ $aprendiz->tipo_documento == 'cedula' ? 'selected="selected"' : '' }}>Cédula de ciudadanía</option>
						<option value="ti" {{ $aprendiz->tipo_documento == 'ti' ? 'selected="selected"' : '' }}>Tarjeta de identidad</option>
					</select>
					@if ($errors->has('tipo_documento'))
						<span class="help-block">
							{{ $errors->first('tipo_documento') }}
						</span>
					@endif
				</div>
				<div class="form-group{{ $errors->has('numero_documento') ? ' has-error' : '' }}">
					<label for="numero_documento" class="control-label">
						Numero de documento *
					</label>
					<input type="number" name="numero_documento" min="0" class="form-control" value="{{ $aprendiz->numero_documento }}">
					@if ($errors->has('numero_documento'))
						<span class="help-block">
							{{ $errors->first('numero_documento') }}
						</span>
					@endif
				</div>
				<div class="form-group{{ $errors->has('direccion') ? ' has-error' : '' }}">
					<label for="direccion" class="control-label">
						Dirección *
					</label>
					<input type="text" name="direccion" class="form-control" value="{{ $aprendiz->direccion }}">
					@if ($errors->has('direccion'))
						<span class="help-block">
							{{ $errors->first('direccion') }}
						</span>
					@endif
				</div>

				<div class="form-group{{ $errors->has('barrio') ? ' has-error' : '' }}">
					<label for="barrio" class="control-label">
						Barrio *
					</label>
					<input type="text" name="barrio" class="form-control" value="{{ $aprendiz->barrio }}">
					@if ($errors->has('barrio'))
						<span class="help-block">
							{{ $errors->first('barrio') }}
						</span>
					@endif
				</div>
				<div class="form-group{{ $errors->has('estrato') ? ' has-error' : '' }}">
					<label for="estrato" class="control-label">
						Estrato *
					</label>
					<input type="number" name="estrato" class="form-control" value="{{ $aprendiz->estrato }}">
					@if ($errors->has('estrato'))
						<span class="help-block">
							{{ $errors->first('estrato') }}
						</span>
					@endif
				</div>
				<div class="form-group">
					<label for="telefono" class="control-label">
						Teléfono
					</label>
					<input type="number" name="telefono" class="form-control" value="{{ $aprendiz->telefono }}">
				</div>
				<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
					<label for="email" class="control-label">
						Email *
					</label>
					<input type="text" name="email" class="form-control" value="{{ $aprendiz->email }}">
					@if ($errors->has('email'))
						<span class="help-block">
							{{ $errors->first('email') }}
						</span>
					@endif
				</div>
				<div class="form-group{{ $errors->has('programa_formacion') ? ' has-error' : '' }}">
					<label for="programa_formacion" class="control-label">
						Programa de formación *
					</label>
					<input type="text" name="programa_formacion" class="form-control" value="{{ $aprendiz->programa_formacion }}">
					@if ($errors->has('programa_formacion'))
						<span class="help-block">
							{{ $errors->first('programa_formacion') }}
						</span>
					@endif
				</div>
				<div class="form-group{{ $errors->has('numero_ficha') ? ' has-error' : '' }}">
					<label for="numero_ficha" class="control-label">
						Número de ficha *
					</label>
					<input type="number" name="numero_ficha" class="form-control" value="{{ $aprendiz->numero_ficha }}">
					@if ($errors->has('numero_ficha'))
						<span class="help-block">
							{{ $errors->first('numero_ficha') }}
						</span>
					@endif
				</div>
				<div class="form-group{{ $errors->has('jornada') ? ' has-error' : '' }}">
					<label for="jornada" class="control-label">
						Jornada *
					</label>
					<input type="text" name="jornada" class="form-control" value="{{ $aprendiz->jornada }}">
					@if ($errors->has('jornada'))
						<span class="help-block">
							{{ $errors->first('jornada') }}
						</span>
					@endif
				</div>
				<div class="form-group{{ $errors->has('pregunta1') ? ' has-error' : '' }}">
					<label for="pregunta1" class="control-label">
						De quien depende usted? *
					</label>
					<input type="text" name="pregunta1" class="form-control" value="{{ $aprendiz->pregunta1 }}">
					@if ($errors->has('pregunta1'))
						<span class="help-block">
							{{ $errors->first('pregunta1') }}
						</span>
					@endif
				</div>
				<div class="form-group{{ $errors->has('pregunta3') ? ' has-error' : '' }}">
					<label for="pregunta3" class="control-label">
						Tiene personas que dependan de usted? *
					</label>
					<input type="text" name="pregunta3" class="form-control" value="{{ $aprendiz->pregunta3 }}">
					@if ($errors->has('pregunta3'))
						<span class="help-block">
							{{ $errors->first('pregunta3') }}
						</span>
					@endif
				</div>
				<div class="form-group{{ $errors->has('otro_apoyo') ? ' has-error' : '' }}">
					<label for="otro_apoyo" class="control-label">
						Es usted beneficiario de algún tipo de apoyo? *
					</label>
					<input type="text" name="otro_apoyo" class="form-control" value="{{ $aprendiz->otro_apoyo }}">
					{{-- <select name="otro_apoyo" class="form-control">
						<option value="">Seleccione el tipo de apoyo...</option>
						<option value="monitoria" {{ $aprendiz->otro_apoyo == 'monitoria' ? 'selected="selected"' : '' }}>Monitoría</option>
						<option value="fic" {{ $aprendiz->otro_apoyo == 'fic' ? 'selected="selected"' : '' }}>FIC</option>
						<option value="apoyo de sostenimiento" {{ $aprendiz->otro_apoyo == 'apoyo de sostenimiento' ? 'selected="selected"' : '' }}>Apoyo de sostenimiento</option>
						<option value="dps" {{ $aprendiz->otro_apoyo == 'dps' ? 'selected="selected"' : '' }}>DPS</option>
						<option value="patrocinio" {{ $aprendiz->otro_apoyo == 'patrocinio' ? 'selected="selected"' : '' }}>Patrocinio</option>
						<option value="vinculo laboral" {{ $aprendiz->otro_apoyo == 'vinculo laboral' ? 'selected="selected"' : '' }}>Vínculo laboral</option>
						<option value="auxilio almuerzo" {{ $aprendiz->otro_apoyo == 'auxilio almuerzo' ? 'selected="selected"' : '' }}>Auxilio de almuerzo</option>
						<option value="ninguno" {{ $aprendiz->otro_apoyo == 'ninguno' ? 'selected="selected"' : '' }}>Ninguno</option>
					</select> --}}
					@if ($errors->has('otro_apoyo'))
						<span class="help-block">
							{{ $errors->first('otro_apoyo') }}
						</span>
					@endif
				</div>
				<br>
				<label for="">Compromisos</label>
				<div class="checkbox form-group">
					<label class="control control--checkbox">
						<input type="checkbox" name="compromiso_informar" value="si" {{ $aprendiz->compromiso_informar == 'si' ? 'checked="checked"' : '' }}>Se compromete a informar en la oficina de Bienestar al Aprendiz el momento en que usted reciba contrato de aprendizaje, consiguió empleo, o cualquier otro beneficio del Gobierno o del SENA (Monitorias, FIC, Apoyos de sostenimiento, entre otros).
						<div class="control__indicator"></div>
					</label>
				</div>
				<br>
				<div class="checkbox form-group">
					<label class="control control--checkbox">
						<input type="checkbox" name="compromiso_normas" value="si" {{ $aprendiz->compromiso_normas == 'si' ? 'checked="checked"' : '' }}>Se compromete acatar las normas sobre el manejo adecuado del suplemento.
						<div class="control__indicator"></div>
					</label>
				</div>
				<br>
				<div class="form-group{{ $errors->has('justificacion_suplemento') ? ' has-error' : '' }}">
					<label for="justificacion_suplemento" class="control-label">
						Explíque a profundidad por que requiere el suplemento *
					</label>
					<br>
					<br>
					<textarea name="justificacion_suplemento" rows="8" cols="80" class="form-control" placeholder="Escribe aquí">{{ $aprendiz->justificacion_suplemento }}</textarea>
					@if ($errors->has('justificacion_suplemento'))
						<span class="help-block">
							{{ $errors->first('justificacion_suplemento') }}
						</span>
					@endif
				</div>
				<div class="form-group">
					<button class="btn btn-success" type="submit">
						<i class="fas fa-save"></i>
						Guardar
					</button>
				</div>
			</form>
		</div>
	</div>
	<div class="col-md-4">
		<h3><i class="fa fa-fw fa-pencil"></i> Editar aprendiz</h3>
		<p>
			Diligencie este formulario para Editar un aprendiz.
		</p>
		<blockquote class="note note-info {{ count($errors) > 0 ? 'note-danger animated shake' : '' }}">
			Los campos que tienen asterisco <span class="btn">*</span> son obligatorios.
		</blockquote>
	</div>
@endsection
