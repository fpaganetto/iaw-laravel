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

function cargarRecordado(){
	if(getCookie("autoPersonalizado")=="")
		return;

	var cookieAuto = JSON.parse(getCookie("autoPersonalizado"));
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
  setCookie("autoPersonalizado", JSON.stringify(autoPersonalizado), 30); //guardamos el auto como un string en una cookie, válida por 30 días
  console.log("Personalización registrada")
});

$("#olvidar").click(function eraseCookie(/*name*/) {
    document.cookie = "autoPersonalizado" + '=; Max-Age=0'
    location.reload(true); //Se actualiza para borrar las cosas
})

$("#descargar").click(function() {
/*  this.setAttribute("download","MiAdder.png");
  var canvas = document.getElementById("imagen-personalizada");
  var data = canvas.toDataURL("image/png");
  data = data.replace(/^data:image\/[^;]*//*, 'data:application/octet-stream');
  window.location.href = data.replace(/^data:application\/octet-stream/, "data:application/octet-stream;headers=Content-Disposition%3A%20attachment%3B%20filename=MiAdder.png");
  this.href = data; */
  var canvas = document.getElementById("imagen-personalizada");
  var data = canvas.toDataURL("image/png");
  download(data, "MiAdder.png", "image/png");
})
