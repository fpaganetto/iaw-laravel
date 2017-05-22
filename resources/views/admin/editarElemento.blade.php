<html lang="es">
<head>
	<title>Administrador</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>

<body>
	<div class="container col-lg-6 col-lg-offset-3">
		<h1>Editando elemento {{$categoria}} -> <strong> {{$elemento}}</strong></h1>
		{!! Form::open(['url' => 'editarElemento']) !!}
			<input type="hidden" name="categoria" value='{{$categoria}}'>
			<input type="hidden" name="nombreViejo" value='{{$elemento}}'>

			<div class= "form-group">
				{!! Form::label('nombre','Reemplazar nombre: ') !!}
				{!! Form::text('nombreNuevo', null, ['class' => 'form-control']) !!}
			</div>

			<div class= "form-group">
				{!! Form::submit('Editar elemento', ['class' => 'btn btn-primary form-control']) !!}
			</div>
		{!! Form::close() !!}
	</div>
</body>