<table>
	<thead>
		<tr>
			<th>NOMBRE COMPLETO</th>
	        <th>TIPO DE DOCUMENTO DE IDENTIDAD</th>
	        <th>NÚMERO DE DOCUMENTO</th>
	        <th>DIRECCIÓN</th>
	        <th>BARRIO</th>
	        <th>ESTRATO</th>
	        <th>TELÉFONO</th>
	        <th>EMAIL</th>
	        <th>PROGRAMA DE FORMACIÓN</th>
	        <th>N° DE FICHA</th>
	        <th>JORNADA</th>
	        <th>DE QUIEN DEPENDE USTED</th>
	        <th>OFICIO QUE REALIZA DE QUIEN DEPENDE</th>
	        <th>TIENE PERSONAS QUE DEPENDAN DE USTED</th>
	        <th>ES USTED BENEFICIARIO DE ALGÚN APOYO</th>
	        <th>COMPROMISO DEL APRENDIZ</th>
	        <th>EXPLIQUE A PROFUNDIDAD POR QUE REQUIERE EL SUPLEMENTO</th>
	        <th>NOVEDAD SOLICITUD</th>
		</tr>
	</thead>
	<tbody>
		@foreach($sa as $s)
		<tr>
			<td>{{ $s->nombre_completo }}</td>
			<td>{{ $s->tipo_documento }}</td>
			<td>{{ $s->numero_documento }}</td>
			<td>{{ $s->direccion }}</td>
			<td>{{ $s->barrio }}</td>
			<td>{{ $s->estrato }}</td>
			<td>{{ $s->telefono }}</td>
			<td>{{ $s->email }}</td>
			<td>{{ $s->programa_formacion }}</td>
			<td>{{ $s->numero_ficha }}</td>
			<td>{{ $s->jornada }}</td>
			<td>{{ $s->pregunta1 }}</td>
			<td>{{ $s->pregunta2 }}</td>
			<td>{{ $s->pregunta3 }}</td>
			<td>{{ $s->otro_apoyo }}</td>
			<td>{{ $s->compromiso_informar == 'si' ? 'Se compromete a informar en la oficina de Bienestar al Aprendiz el momento en que usted reciba contrato de aprendizaje, consiguió empleo, o cualquier otro beneficio del Gobierno o del SENA (Monitorias, FIC, Apoyos de sostenimiento, entre otros). ' : 'No aceptó'}} {{ $s->compromiso_informar == 'si' ? ' Se compromete acatar las normas sobre el manejo adecuado del suplemento.' : 'No aceptó' }}</td>
			<td>{{ $s->justificacion_suplemento }}</td>
			<td>{{ $s->novedad_solicitud }}</td>
		</tr>
		@endforeach
	</tbody>
</table>
