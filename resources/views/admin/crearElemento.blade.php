<html lang="es">
<head>
	<title>Administrador</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>

<body>
	<div class="container col-lg-6 col-lg-offset-3">
		<h1>Agregando elemento en <strong>{{$categoria}}</strong></h1>
		{!! Form::open(['url' => 'crearElemento', 'files' => true, 'enctype' => "multipart/form-data"]) !!}
			<input type="hidden" name="categoria" value={{$categoria}}>

			<div class= "form-group">
				{!! Form::label('nombre','Nombre del nuevo elemento: ') !!}
				{!! Form::text('nombre', null, ['class' => 'form-control']) !!}
			</div>

			<div class="btn btn-default btn-file">
			{!! Form::file('image') !!}
			</div>

			<div class= "form-group">
				{!! Form::submit('Agregar elemento', ['class' => 'btn btn-primary form-control']) !!}
			</div>
		{!! Form::close() !!}
	</div>
</body>