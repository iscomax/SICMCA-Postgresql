
function alerta(mensaje) {
  Swal.fire({
    toast: true,
    //title:'El Rango de la calificación Final es de 5 a 10',
    text: mensaje,
    confirmButtonColor: '#0d6efd',
    position: 'top'
  })
}

/*********************************************************************** */
$('#editar').click(function () {

  let calificacion2 = document.getElementById("calificacion2").value;
  //console.log(calificacion2);
  if (calificacion2 < 5 || calificacion2 > 10) {
    mensaje = 'El Rango de la calificación Final es de 5 a 10';
    alerta(mensaje);
    calificacion2.value = 0;
  } else {
    Swal.fire({
      //title: '¿Está seguro de actualizar la calificación final?',
      text: "¿Está seguro de actualizar la calificación final?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#0d6efd',
      cancelButtonColor: '#fb9b03',
      confirmButtonText: 'Aceptar',
      cancelButtonText: 'Cancelar',
      toast: true,
      position: 'top',
    }).then((result) => {
      if (result.isConfirmed) {

        let calificacion2 = document.getElementById("calificacion2").value;
        let calificacion = document.getElementById("calificacion").value;
        var datos = document.getElementById("calificacion");
        console.log(calificacion);
        console.log(calificacion2);
        if (calificacion == calificacion2) {

          calificacion = calificacion
        } else {

          calificacion = calificacion2
        }
        datos.value = calificacion;
        if (calificacion % 1 == 0) {
          mensaje = 'El formato de la calificación es correcto';
          alerta(mensaje);
        } else if (calificacion == "NA") {
          mensaje = 'El formato de la calificación es correcto "NA"';
          alerta(mensaje);
        }
        else if (calificacion == "NP") {
          mensaje = 'El formato de la calificación es correcto "NP"';
          alerta(mensaje);
        }
        else {
          mensaje = "La calificación actual es un número decimal no podrás realizar el registro";
          alerta(mensaje);
        }
      }
    })
  }
})

/*****************************************************/
function eliminarB(id_bitacora) {
  // window.alert("id_bitacora = "+ id_bitacora);
  var resultado = window.confirm('¿Está seguro que desea eliminar este registro?');

  if (resultado === true) {
    var ruta = "id_bitacora=" + id_bitacora;
    console.log(ruta);
    $.ajax({
      url: 'bitacora.php',
      type: 'POST',
      data: ruta,
    })
      .done(function (res) {
        $('#respuesta').html(res);
      })
      .fail(function () {
        console.log('error');
      })
      .always(function () {
        console.log('complete');
      });
    location.reload();

  } else {
    window.alert('El registro no se ha eliminado');
  }
}

/***************************************************************************************/
function enviarDatos() {
  var id_usuario = document.getElementById('id_usuario').value;
  var id_grupo = document.getElementById('id_grupo').value;
  var profesor = document.getElementById('profesor').value;
  var idcurso = document.getElementById('idcurso').value;
  var cuenta = document.getElementById('cuenta').value;
  var nombre = document.getElementById('nombre').value;
  var paterno = document.getElementById('paterno').value;
  var materno = document.getElementById('materno').value;
  var curso = document.getElementById('curso').value;
  var grupo = document.getElementById('grupo').value;
  var estatus = document.getElementById('reporte').value;
  var calificacion = document.getElementById('calificacion').value;

  console.log(calificacion);
  if (calificacion % 1 == 0 || calificacion == "NA" || calificacion == "NP") {
    if (estatus >= 1) {
      // window.alert("Esta calificación ya está registrada en el sistema DGAE");
      Swal.fire({
        icon: 'error',
        title: "Esta calificación ya está registrada en el sistema DGAE",
        //text: 'Something went wrong!',
        confirmButtonColor: '#0d6efd',
        position: 'top',
        timer: 5000,//5 segundos
        timeProgressBar: true,
        showConfirmButton: true,
      })
      // location.reload();
    } else if (calificacion >= 5 || calificacion == "NA" || calificacion == "NP") {
      Swal.fire({
        //title: '¿Está seguro de actualizar la calificación final?',
        text: "¿Está seguro de registrar la calificación final?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#0d6efd',
        cancelButtonColor: '#fb9b03',
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
        toast: true,
        position: 'top',
      }).then((result) => {
        if (result.isConfirmed) {
          var ruta = "profesor=" + profesor + "&idcurso=" + idcurso + "&cuenta=" + cuenta + "&nombre=" + nombre + "&paterno="
            + paterno + "&materno=" + materno + "&cursoNombre=" + curso + "&grupo=" + grupo + "&calificacion=" + calificacion + "&estatus=" + estatus + "&id_usuario=" + id_usuario + "&id_grupo=" + id_grupo;
          console.log(ruta);
          $.ajax
            ({
              url: "insert.php",
              type: 'POST',
              data: ruta,
            })
            .done(function (res) {
              $('#respuesta').html(res);

            })
            .fail(function () {
              console.log("error");
            })
            .always(function () {
              console.log("complete");
            });
          //window.alert("La calificación se ha registrado exitosamente");
          Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'La calificación se ha registrado exitosamente',
            showConfirmButton: false,
            timer: 1500
          })
          setTimeout(function () {
            location.reload();
          }, 1500);


        }
      })

      /* ********* */
    } else {
      mensaje= "El Rango de la calificación Final es de 5 a 10";
      alerta(mensaje);
    }

  } else {
    mensaje="El registro de la calificación debe ser un número entero";
    alerta(mensaje);
  }



}
/**************************************************************************/
function enviarAlumno() {
  var id_curso = $('#datatable').find("#id_curso").html();
  var cuentas = $('#datatable').find("#numero_Cuenta").html();
  console.log(id_curso);
  $.ajax
    ({
      url: 'cargar.php', type: 'POST', data: {
        id_curso: id_curso,
        cuenta: cuentas
      },
    })
    .done(function (res) {
      console.log('resut =', res)
      $('#respuesta').html(res);
      // window.location.href="cargar.php"
    })
    .fail(function () { console.log('error'); })
    .always(function () { console.log('complete'); });
  // location.href ="cargar.php";
}
function Cargar() {
  var url = "cargar.php";
  var id_curso = $('#datatable').find("#id_curso").html();
  var cuentas = $('#datatable').find("#numero_Cuenta").html();

  $.ajax({
    type: "POST",
    url: url,
    data: {
      id_curso: id_curso,
      cuenta: cuentas
    },
    success: function (datos) {
      $('#contenido').html(datos);
    }
  });
}
/*****************************************************/
function searchByNumCuenta() {
  var num_cuenta = document.getElementById('num_cuenta').value;

  var long = num_cuenta.length;
  console.log(long);
  if (num_cuenta === "") {
    mensaje="Para realizar una búsqueda debes ingresar un número de cuenta de 9 dígitos";
    
    Swal.fire({
      toast: true,
      //title:'El Rango de la calificación Final es de 5 a 10',
      text: mensaje,
      confirmButtonColor: '#0d6efd',
      position: 'top',
      timer: 5000,
    })


  } else if (long < 9 || long > 9) {
    //window.alert("Un número de cuenta es de 9 dígitos");
    mensaje= "Un número de cuenta es de 9 dígitos";
    alerta(mensaje);
  }
  else {
    var ruta = "num_cuenta=" + num_cuenta;
    console.log(ruta);
    $.ajax
      ({
        url: 'getAlumno.php', type: 'POST', data: {
          num_cuenta: num_cuenta
        },
      })
      .done(function (res) {
        console.log('resut =', res)
        $('#respuesta').html(res);
      })
      .fail(function () { console.log('error'); })
      .always(function () { console.log('complete'); });
  }


}

/*****************************************************/

function notificacionBuscar() {
  var elem = document.getElementById('noti');
  elem.window.alert("Bienvenido a nuestro sitio web 2");
}


