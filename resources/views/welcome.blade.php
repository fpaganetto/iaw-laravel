@extends('layouts.adderlayout')

@section('content')
      <!-- Carrousell -->
      <div class="container-fluid carousel-background">
        <div class="row col-md-10 col-md-offset-1 centered">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
              <!-- Indicators -->
              <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
                <li data-target="#myCarousel" data-slide-to="3"></li>
              </ol>

              <!-- Wrapper for slides -->
              <div class="carousel-inner" role="listbox">
                <div class="item active">
                  <img src="img/1280x720/adder1.jpg" alt="Adder 1">
                </div>

                <div class="item">
                  <img src="img/1280x720/adder2.jpg" alt="Adder 2">
                </div>

                <div class="item">
                  <img src="img/1280x720/adder3.jpg" alt="Adder 3">
                </div>

                <div class="item">
                  <img src="img/1280x720/adder4.jpg" alt="Adder 4">
                </div>
              </div>

              <!-- Left and right controls -->
              <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div> <!-- Carrousell -->
        </div> <!-- row -->
    </div>

    <div class="container main-content">
      <div class="row" id="panel-personalizar">
        <div class="col-lg-4">
          <div class="panel-group" id="accordionOpciones" role="tablist" aria-multiselectable="true">
            </div>
            <div class="btn-group-vertical">
              <button type="submit" class="btn btn-block btn-recordar" id="recordar" 
              data-toggle="tooltip" data-placement="top"
              title="Guarda las opciones elegidas, para que al abrir nuevamente el sitio web permanezcan seleccionadas">Recordar</button>
              <button type="submit" class="btn btn-block btn-olvidar" id="olvidar"
              data-toggle="tooltip" data-placement="top"
              title="Elimina la cookie que memoriza las opciones">Olvidar</button>
              <button type="submit" class="btn btn-block btn-descargar" id="descargar"
              data-toggle="tooltip" data-placement="top"
              title="Descarga una imagen del modelo del auto generado">Descargar</button>
            </div>
        </div>

        <div class="col-lg-8">
            <canvas id="imagen-personalizada" height="720" width="1280"> </canvas>
        </div>
      </div> <!-- row -->

      </div><!-- END main-content -->