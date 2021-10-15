// Get the modal
var reprobados = document.getElementById("reprobados");

// Get the button that opens the modal
var listaR = document.getElementById("listaR");

// Get the <span> element that closes the modal
var spanC = document.getElementsByClassName("reprobadosCerrar")[0];
//botones del modal

var exit = document.getElementById("exit");

// When the user clicks the button, open the modal 
listaR.onclick = function () {
  reprobados.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
spanC.onclick = function () {
  reprobados.style.display = "none";
}
exit.onclick = function () {
  reprobados.style.display = "none";
}


// When the user clicks anywhere outside of the modal, close it
/*window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}*/
