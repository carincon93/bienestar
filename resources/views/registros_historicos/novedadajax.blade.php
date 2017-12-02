@foreach($query as $his)
<label for="novedad" class="control-label">Novedad vieja</label>
<textarea name="novedad" rows="4" cols="80" class="form-control" disabled>{{ $his->novedad }}</textarea>
@endforeach
