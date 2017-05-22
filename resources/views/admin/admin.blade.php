
<html lang="es">
<head>
	<title>Administrador</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    
</head>

<body>
<div class="container col-lg-8 col-lg-offset-2">

    <h1><i class="fa fa-users"></i> Menu admin Adder<a href="/logout" class="btn btn-warning pull-right">Logout</a></h1>

    {!! Form::open(['url' => 'eliminarCategoria']) !!}
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
                    <td>{{ $personalizable->tablas }}
                    <button type="submit" name = "eliminar" value= {{ $personalizable->tablas }} class="btn btn-danger pull-right">Eliminar</button>

                    <a href="/editarCategoria/{{$personalizable->tablas}}" 
                    class="btn btn-info pull-right" style="margin-right: 3px;">Editar</a>
                    </td>
                    
                </tr>
                @endforeach
            </tbody>
        <a href="/admin/crearCategoria" class="btn btn-success">Agregar menú personalizable</a>
        </table>
    </div>
    {!! Form::close() !!}

    {{-- Voy a tener una tabla por cada elemento personalizable --}}
	@foreach ($elementos as $nombre => $elemento)
    {!! Form::open(['url' => 'eliminarElemento']) !!}
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
                        <input type="hidden" name="categoria" value={{$nombre}}>
                        <button type="submit" name = "eliminar" value= '{{$e->valor}}' class="btn btn-danger pull-right">
                        Eliminar</button>
                        
                        <a href="/editarElemento/{{$nombre}}/{{$e->valor}}"
                         class="btn btn-info pull-right" style="margin-right: 3px;">Editar</a>
                    </td>

                </tr>
                @endforeach
            </tbody>
        <a href="/crearElemento/{{$nombre}}" class="btn btn-success">Agregar {{$nombre}}</a>
        </table>
    </div>
    {!! Form::close() !!}
   @endforeach

   <hr>

   <!-- Precargados -->
   {!! Form::open(['url' => 'precargado']) !!}
            <div class= "form-group">
                {!! Form::label('url','Url del precargado: ') !!}
                {!! Form::text('url', null, ['class' => 'form-control ']) !!}

                {!! Form::label('nombre','Nuevo nombre: ') !!}
                {!! Form::text('nombre', null, ['class' => 'form-control ']) !!}
            </div>

            <div class= "form-group">
                <button type="submit" name = "comando" value= 'agregar' class="btn btn-success">
                Agregar</button>                

                <button type="submit" name = "comando" value= 'eliminar' class="btn btn-danger">
                Eliminar</button>
            </div>
   {!! Form::close() !!}
    <hr>

</div>
</body>