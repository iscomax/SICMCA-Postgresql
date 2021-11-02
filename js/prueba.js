
$('#editar').click(function () {

  let calificacion2 = document.getElementById("calificacion2").value;
  //console.log(calificacion2);
  if (calificacion2<5||calificacion2>10) {
    window.alert("El Rango de la calificación Final es de 5 a 10");
    calificacion2.value=0;
  } else {
    var resultado = window.confirm('¿Está seguro de actualizar la calificación final?');
    if (resultado === true) {
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
            alert ("El formato de la calificación es correcto");
        } else {
            alert ("La calificación actual es un número decimal no podrás realizar el registro");
        }
     }    
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
  console.log(profesor);
  if( calificacion % 1 == 0) {
    if (estatus >= 1) {
      window.alert("Esta calificacion ya esta registrada en el sistema DGAE");
      location.reload();
  
    } else {
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
     location.reload();
    }
   
  }else
  {
    window.alert("El registro de la calificación debe ser un número entero");
  }

 

}
/**************************************************************************/
function enviarAlumno()
{
  var id_curso = $('#datatable').find("#id_curso").html(); 
  var cuentas= $('#datatable').find("#numero_Cuenta").html(); 
  console.log(id_curso);
  $.ajax
  ({ url:'cargar.php',type:'POST', data : {
    id_curso: id_curso,
    cuenta:cuentas
  },})
  .done(function(res){
    console.log('resut =',res)
    $('#respuesta').html(res);
   // window.location.href="cargar.php"
  })
  .fail(function(){console.log('error');})
  .always(function(){console.log('complete');});
 // location.href ="cargar.php";
}
function Cargar(){
  var url="cargar.php";
  var id_curso = $('#datatable').find("#id_curso").html(); 
  var cuentas= $('#datatable').find("#numero_Cuenta").html(); 

  $.ajax({
      type: "POST",
      url:url,
      data:{
        id_curso: id_curso,
        cuenta:cuentas
      },
      success: function(datos){
          $('#contenido').html(datos);
      }
  });
}
/*****************************************************/
function  searchByNumCuenta()
{
  var num_cuenta= document.getElementById('num_cuenta').value; 

  var long = num_cuenta.length; 
  console.log(long);
  if (long<9 || long >9) {
    window.alert("Un numero de cuenta es de 9 digitos");
  } else {
    var ruta="num_cuenta="+num_cuenta;
    console.log(ruta);
    $.ajax
    ({ url:'getAlumno.php',type:'POST', data : {
      num_cuenta: num_cuenta
    },})
    .done(function(res){
      console.log('resut =',res)
      $('#respuesta').html(res);
    })
    .fail(function(){console.log('error');})
    .always(function(){console.log('complete');});
  }
 
  
}

/*****************************************************/

function notificacionBuscar(){
  var elem = document.getElementById('noti');
  elem.window.alert("Bienvenido a nuestro sitio web 2");
}


