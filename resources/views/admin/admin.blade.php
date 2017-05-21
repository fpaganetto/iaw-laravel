
<html lang="es">
<head>
	<title>Administrador</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    
</head>

<body>
<div class="container col-lg-8 col-lg-offset-2">

    <h1><i class="fa fa-users"></i> Menu admin Adder<a href="/logout" class="btn btn-warning pull-right">Logout</a></h1>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th>Personalizables</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($personalizables as $personalizable)
                <tr>
                    <td>{{ $personalizable->tablas }}</td>
                </tr>
                @endforeach
            </tbody>
        <a href="/admin/crearCategoria" class="btn btn-success">Agregar menú personalizable</a>
        </table>
    </div>

    {{-- Voy a tener una tabla por cada elemento personalizable --}}
	@foreach ($elementos as $nombre => $elemento)
        <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>{{$nombre}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($elemento as $e)
                <tr>
                    <td>
                    	{{ $e->valor }}
                    	<a href="/borrar/{{$nombre}}/{{$e->valor}}"
                         class="btn btn-danger pull-right" style="margin-right: 3px;">Eliminar</a>
                        <a href="/user/edit" class="btn btn-info pull-right" style="margin-right: 3px;">Editar</a>
                    </td>

                </tr>
                @endforeach
            </tbody>
        <a href="/user/create" class="btn btn-success">Agregar {{$nombre}}</a>
        </table>
    </div>
   @endforeach

</div>
</body>