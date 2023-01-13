
function alertas(mensaje){
    Swal.fire({
        icon: 'error',
        title: mensaje,
        //text: 'Something went wrong!',
        confirmButtonColor: '#0d6efd',
        position: 'top',
      })
}

$('#np').click(function () {
    var calificacion = document.getElementById("calificacion2").value;
    console.log(calificacion);
    if (calificacion == 0 || calificacion == "NA" || calificacion == "NP") {
        var dato = "NP"
        console.log(dato);
    } else {
        //window.alert("Para poder asignar NP a una calificación esta debe ser igual cero");
        mensaje ="Para poder asignar NP a una calificación esta debe ser igual cero";
        alertas(mensaje);
        dato = calificacion;
    }
    document.getElementById("calificacion2").value = dato;
})



$('#na').click(function () {
    var calificacion = document.getElementById("calificacion2").value;
    console.log(calificacion);
    if (calificacion <= 5.9 || calificacion == "NP" || calificacion == "NA") {
        var dato = "NA"
        console.log(dato);
    } else {
       // window.alert("Para poder asignar NA a una calificación esta debe ser Menor o igual a 5.9");
       mensaje="Para poder asignar NA a una calificación esta debe ser Menor o igual a 5.9";
       alertas(mensaje);
        dato = calificacion;
    }

    document.getElementById("calificacion2").value = dato;
    /*  calificacion2 = document.getElementById("calificacion");
        calificacion2.value=dato;    */
})