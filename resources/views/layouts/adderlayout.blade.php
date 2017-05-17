<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Adder</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
    <link id="css" href="css/style1.css" rel="stylesheet">

    <link rel="shortcut icon" type="image/png" href="img/favicon.png"/>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <meta name="theme-color" content="#000000"/> <!-- chrome omnibar color -->
  </head>
  <body>

    <div class="container-fluid sin-margenes">

      <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand marca_auto brillo" href="/">Adder</a>
          </div>


            <!-- Collect the nav links, forms, and other content for toggling -->
         <div class="collapse navbar-collapse pull-right" id="bs-example-navbar-collapse-1">
               <ul class="nav navbar-nav">
                        <li {{ Route::currentRouteName() == "/register" ? 'class = active' : '' }})> {{--FIXME--}}
                        <a href="#panel-personalizar">DISEÑO</a>
                        </li>
                        <li><a class="not-allowed" title="No implementado">EL COCHE</a></li>
                        <li><a class="not-allowed" title="No implementado">SOPORTE</a></li>
                        <li><a class="not-allowed" title="No implementado">ENCUÉNTRANOS</a></li>
                        <li><a class="not-allowed" title="No implementado">COMPRAR</a></li>
                        @if (Auth::check())
                        <li>
                          <a href="{{ route('logout') }}"
                              onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                              CERRAR SESION <?php Auth::user()->username; ?> {{--FIXME--}}
                          </a>
                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                          </form>
                        </li>
                        @else
                            <li><a href="{{ url('/login') }}">MI ADDER</a></li>
                            <li><a href="{{ url('/register') }}">REGISTRARSE</a></li>
                        @endif
                     </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>
    </div>

@yield('content')

  <div class="footer-bottom">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
            © 2017 Truffade Motors |
            <a href="readme"> Readme </a>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 pull-right">
           <div class="pull-right boton-estilo">
           <a id="est1">Noctis</a> | <a id="est2">Lucis</a>
           </div>
        </div>
      </div>
    </div> <!--fin container -->
    </div> <!--fin footer -->

    <script
      src="https://code.jquery.com/jquery-3.2.1.min.js"
      integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
      crossorigin="anonymous">
    </script>
    <script 
      src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
      integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
      crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="js/cookies.js"></script>
    <script type="text/javascript" src="js/cambiarEstilo.js"></script>
    <script type="text/javascript" src="app/personalizar.js"></script>
  </body>
</html>
