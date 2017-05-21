@extends('layouts.adderlayout')

@section('content')
<body>
<link id="css" href="css/styleAdmin.css" rel="stylesheet">

<div class="container col-lg-8 col-lg-offset-2" style="background: white">

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

        </table>
    </div>

    <a href="/user/create" class="btn btn-success">Agregar menú personalizable</a>

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
        </table>
    </div>
    <a href="/user/create" class="btn btn-success">Agregar {{$nombre}}</a>
   @endforeach
</div>

@endsection