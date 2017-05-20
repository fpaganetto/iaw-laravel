
<html lang="es">
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>

<body>
<div class="col-lg-10 col-lg-offset-1">

    <h1><i class="fa fa-users"></i> Menu admin <a href="/logout" class="btn btn-default pull-right">Logout</a></h1>

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

</div>
</body>