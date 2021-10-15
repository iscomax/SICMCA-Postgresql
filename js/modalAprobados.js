var aprobados = document.getElementById("aprobados");

// Get the button that opens the modal
var lista = document.getElementById("lista");

// Get the <span> element that closes the modal
var spans = document.getElementsByClassName("aprobadosCerrar")[0];
//botones del modal

var salir = document.getElementById("salir");

// When the user clicks the button, open the modal 
lista.onclick = function () {
  aprobados.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
spans.onclick = function () {
  aprobados.style.display = "none";
}
salir.onclick = function () {
  aprobados.style.display = "none";
}

  