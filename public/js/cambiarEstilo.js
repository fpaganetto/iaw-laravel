if (localStorage.getItem("estilo")!=null) { //si ya hay una opción elegida previamente
  cambiarEstilo(localStorage.getItem("estilo"));
}

$('#est1').click(function (){
  if (typeof(Storage) !== "undefined") {
    localStorage.setItem("estilo", "style1");
    cambiarEstilo("style1");
  }
    $('meta[name="theme-color"]').attr('content','#000000');
});
$('#est2').click(function (){
  if (typeof(Storage) !== "undefined") {
    localStorage.setItem("estilo", "style2");
    cambiarEstilo("style2");
    }
   $('meta[name="theme-color"]').attr('content','#ffffff');
});

function cambiarEstilo(estilo) {
  //$('link[href*="css/style').attr('href','css/'+estilo+'.css');
  $('#css').attr('href','css/'+estilo+'.css');
}

$(function () {
  $('[data-toggle="tooltip"]').tooltip();
})