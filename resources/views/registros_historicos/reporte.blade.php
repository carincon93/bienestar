<table>
	<thead>
		<tr>
			<th colspan="2">
				<img src="{{ asset('public/images/logoSena.png') }}" alt="">
			</th>
			<th colspan="3" style="text-align: center;">
				SERVICIO NACIONAL DE APRENDIZAJE SENA <br>
				AUXILIO DE ALIMENTACIÓN – SEMANAL
			</th>
			<th colspan="2">
				Versión: 02 <br>
				Marzo de 2015
			</th>
		</tr>
		<tr>
			<th colspan="7">
				CENTRO DE FORMACIÓN: PROCESOS INDUSTRIALES Y CONSTRUCCION    SEMANA: 15-19 DE MAYO DE 2017
			</th>
		</tr>
		<tr>
			<th>BP</th>
			<th>BO</th>
			<th>NOMBRE COMPLETO</th>
			<th>PROGRAMA DE FORMACIÓN</th>
			<th>ID</th>
			<th>NÚMEROS DE FICHAS</th>
			<th>FIRMA</th>
		</tr>
	</thead>
	<tbody>
		@foreach($registros_historicos as $registro_historico)
			<tr>
				<td></td>
				<td></td>
				<td>{{ $registro_historico->nombre_completo }}</td>
				<td>{{ $registro_historico->programa_formacion }}</td>
				<td>{{ $registro_historico->numero_ficha }}</td>
				<td>5</td>
				<td></td>
			</tr>
		@endforeach
	</tbody>
</table>
