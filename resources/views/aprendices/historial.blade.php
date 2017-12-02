<table>
	<thead>
		<tr>
			<th>Nombre del aprendiz</th>
			<th>Fecha de entrega</th>
		</tr>
	</thead>
	<tbody>
		@foreach($his as $h)
		<tr>
			<td>{{ $h->aprendiz->nombre_completo }}</td>
			<td>{{ $h->fecha }}</td>
		</tr>
		@endforeach
	</tbody>
</table>
