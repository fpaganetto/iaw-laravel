//Obtenemos los datos a cargar en la página web a partir del JSON que los contiene, se lo pedimos al servidor
var autoPersonalizado = {}; //variable global conteniendo los datos seleccionados por un usuario
var jsonOpciones;

var request = new XMLHttpRequest();
request.open("GET", "./personalizables");
request.responseType = "json";
request.send();
request.onload = function() { //lo que ocurre al recibir la respuesta del servidor
  jsonOpciones = request.response;

  var canvas = document.getElementById("imagen-personalizada");
  var ctx = canvas.getContext("2d");
  var imageObj = new Image();

  imageObj.onload = function() {//dibujar cuando la imagen esté cargada
    ctx.drawImage(imageObj, 0, 0, canvas.width, canvas.height);
  };
  imageObj.src = "app/img/cero.png";

  cargarOpciones(jsonOpciones);
  cargarRecordado();
}

//Se encarga de poblar el html con las opciones recibidas en el objeto JSON
function cargarOpciones(jsonOpciones) {
  var opciones = jsonOpciones["opciones"];

  //Creamos un elemento del acordeón por cada opcion y un elemento de lista por cada valor posible
  for (i = 0; i < opciones.length; i++) {
    var opcion = opciones[i];
    var panel = document.createElement("div");
    panel.setAttribute("class", "panel panel-default");

    var heading = document.createElement("div");
    heading.setAttribute("class", "panel-heading");
    heading.setAttribute("role", "tab");
    heading.setAttribute("id", "heading"+i);

    var h4 = document.createElement("h4");
    h4.setAttribute("class", "panel-title mayus");

    var nombreOpcion = document.createElement("a");
    nombreOpcion.setAttribute("class", "collapsed");
    nombreOpcion.setAttribute("role", "button");
    nombreOpcion.setAttribute("data-toggle", "collapse");
    nombreOpcion.setAttribute("data-parent", "#accordionOpciones");
    nombreOpcion.setAttribute("href", "#collapse"+i);
    nombreOpcion.setAttribute("aria-expanded", "false");
    nombreOpcion.setAttribute("aria-controls", "collapse"+i);
    nombreOpcion.innerHTML = opcion.nombre;

    var colapsable = document.createElement("div");
    colapsable.setAttribute("id", "collapse"+i);
    colapsable.setAttribute("class", "panel-collapse collapse");
    colapsable.setAttribute("role", "tabpanel");
    colapsable.setAttribute("aria-labelledby", "heading"+i);

    var botonesVertical = document.createElement("div");
    botonesVertical.setAttribute("class","btn-group-vertical");
    botonesVertical.setAttribute("data-toggle","buttons")

    for (j = 0; j < opcion.valores.length; j++) {
      var boton = document.createElement("div");
      boton.setAttribute("class","btn btn-default btn-personalizar");
      boton.setAttribute("id", opcion.nombre+"-radiobt"+j);
      boton.setAttribute("onclick", "opcionSeleccionada(\""+opcion.nombre+"\", \""+opcion.valores[j]+"\")");

      boton.innerHTML+="<input type=\"radio\" name=\"options\" id=\"option1\" autocomplete=\"off\" checked>";
      boton.innerHTML+= opcion.valores[j];

      botonesVertical.appendChild(boton);
    }

    colapsable.appendChild(botonesVertical);

    h4.appendChild(nombreOpcion);
    heading.appendChild(h4);

    panel.appendChild(heading);
    panel.appendChild(colapsable);

    document.getElementById("accordionOpciones").appendChild(panel);
  }//end for
  console.log(autoPersonalizado);
}

//carga la recordada por cookie en el caso normal (GET /) y sino carga la compartida (GET /idURL)
function cargarRecordado(){

  cookieAuto ="";

  idURL = $("#idURL").attr("value");
  console.log(idURL);

  if (idURL != "") { //caso adder compartido

    $.ajax({
      type:'POST',
      url:'/obtener',
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, //obtiene el CSRF encontrado como meta tag en la página de donde se invoca esta función
      data: {"idURL": idURL},
      success:function(data){
        //Se ejecuta al recibir respuesta satisfactoria del servidor
        console.log("data respuesta:\n");
        console.log(data[0].json);
        //cookieAuto = (JSON.parse(data));
        cookieAuto = JSON.parse(data[0].json);
        delete cookieAuto["idURL"];
        console.log("eliminando idurl:\n");
        console.log(cookieAuto);
        cargarCookieAuto(cookieAuto);
      }
    });


  }
  else { //cookie
    if(getCookie("autoPersonalizado")=="")
		  return;

	   var cookieAuto = JSON.parse(getCookie("autoPersonalizado"));
     cargarCookieAuto(cookieAuto);  //no necesita esperar para cargar la cookie
  }
}


function cargarCookieAuto(cookieAuto) {
  //Opcion: Color, Llantas, Polarizado, Motor...
  for(var opcion in cookieAuto){
      opcionSeleccionada(opcion,cookieAuto[opcion]);
    var boton = $(".btn-personalizar:contains("+cookieAuto[opcion]+")");
    boton.addClass("active");
  }
}

function opcionSeleccionada(opcion, valor) {
glyphOk(opcion);
  dibujar(opcion,valor);
  autoPersonalizado[opcion] = valor; //guardamos en el objeto el cambio
  console.log(autoPersonalizado);
}

function glyphOk(opcion){
	var pestania = $("a:contains("+opcion+")");
	//console.log(pestania.find("spawn").length);
	if(!pestania.find("spawn").length){
		var tilde = document.createElement("spawn");
		tilde.setAttribute("class","glyphicon glyphicon-ok pull-right");

		pestania.append(tilde);
	}
	//<span class="glyphicon glyphicon-ok pull-right"></span>
}

function dibujar(opcion,valor){
  console.log("Seleccionó: "+opcion+" -> "+valor);

  var canvas = document.getElementById("imagen-personalizada");
  var ctx = canvas.getContext("2d");
  var imageObj = new Image();

  if(opcion=="Color"){
    ctx.font="70pt SignPainter";
    var color = jsonOpciones["opciones"][0]["colors"][valor];
    ctx.fillStyle = color;
    ctx.fillText("Adder",105.5,116);
  }


  imageObj.onload = function() {//dibujar cuando la imagen esté cargada
    ctx.drawImage(imageObj, 0, 0, canvas.width, canvas.height);
  };
  imageObj.src = "app/img/"+opcion+"/"+valor+".png";
}

$( "p" ).click(function() { //ya comprobé que este funciona
  $( this ).slideUp();
});

//manipulación de autoPersonalizado
$("#recordar").click(function() {
  if (autoPersonalizado["idURL"] != "") {
    delete autoPersonalizado["idURL"];  //así no queda ensuciada la cookie con el idurl
  }
  setCookie("autoPersonalizado", JSON.stringify(autoPersonalizado), 30); //guardamos el auto como un string en una cookie, válida por 30 días
  console.log("Personalización registrada")
});

$("#olvidar").click(function eraseCookie(/*name*/) {
    document.cookie = "autoPersonalizado" + '=; Max-Age=0'
    location.reload(true); //Se actualiza para borrar las cosas
})

$("#descargar").click(function() {
  var canvas = document.getElementById("imagen-personalizada");
  var data = canvas.toDataURL("image/png");
  download(data, "MiAdder.png", "image/png");
})


$("#compartir").click(function() {
  //generar string hash
  //guardar json en la base de datos, usando el hash como id
  //mostrar URL por alert al usuario
  var idURL = ID();
  autoPersonalizado["idURL"] = idURL; //agregamos idURL como campo
  console.log("Agregado el ID:\n");
  console.log(autoPersonalizado);
  var str_json = JSON.stringify(autoPersonalizado);

  $.ajax({
    type:'POST',
    url:'/compartir',
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, //obtiene el CSRF encontrado como meta tag en la página de donde se invoca esta función
    data: {"strData": str_json},
    //success:function(data){
    //   window.prompt("¡Listo!\n\nCopia este enlace para compartir con tus amigos", window.location.href+"compartido/"+idURL);
    //}
  });

  crearAlertaCompartir(idURL);
})

  function crearAlertaCompartir(idURL){
    $('#alert-compartir').html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>¡Listo!</strong> Copia este enlace para compartir con tus amigos! <u>'+window.location.href+'compartido/'+idURL+'</u></div>');
  }


// ### fuente: https://gist.github.com/gordonbrander/2230317#file-id-js
//
// Generate unique IDs for use as pseudo-private/protected names.
// Similar in concept to
// <http://wiki.ecmascript.org/doku.php?id=strawman:names>.
//
// The goals of this function are twofold:
//
// * Provide a way to generate a string guaranteed to be unique when compared
//   to other strings generated by this function.
// * Make the string complex enough that it is highly unlikely to be
//   accidentally duplicated by hand (this is key if you're using `ID`
//   as a private/protected name on an object).
//
// Use:
//
//     var privateName = ID();
//     var o = { 'public': 'foo' };
//     o[privateName] = 'bar';
var ID = function () {
  // Math.random should be unique because of its seeding algorithm.
  // Convert it to base 36 (numbers + letters), and grab the first 9 characters
  // after the decimal.
  return '_' + Math.random().toString(36).substr(2, 9);
};
