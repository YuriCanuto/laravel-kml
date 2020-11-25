<form action="{{ route('kml.create') }}" method="post" enctype="multipart/form-data">
@csrf

<label for="file">Arquivo KML</label>
<input id="file" name="file" type="file">

<button type="submit">Enviar</button>

</form>
