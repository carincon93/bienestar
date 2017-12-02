@php
    $count = 1;
@endphp
@foreach($hr as $h)
<tr>
    <td>{{ $count++ }}</td>
    <td>{{ $h->nombre_completo }}</td>
    <td>{{ $h->fecha }}</td>
</tr>
@endforeach
