function validarCorreoAlta(correo){
    var expRegCorreo=/^\w+@(\w+\.)+\w{2,4}$/;
    if(!expRegCorreo.exec(correo))
    {
        swal("ERROR","El campo correo institucional no tiene el formato correcto.", "error");
      //alert("El campo correo institucional no tiene el formato correcto.");
      correo.focus();
      return false;
    }


   if (correo.indexOf("unam.mx")==-1) {
       swal("ERROR","El dominio del correo institucional debe ser unam.mx", "error");
       //alert("El dominio del correo institucional debe ser unam.mx");
       return false;
   } 
    return true;

}
function validarForm(nombre, apellidos, correo){
   
    if (nombre =="") { 
        swal("ERROR","El campo nombre(s) no puede estar vacío.", "error");
        //alert("El campo NOMBRE(s) no puede estar vacío.");
         return false; 
        }
    if (apellidos ==""){
        swal("ERROR","El campo apellidos no puede estar vacío.", "error");
        //alert("El campo apellidos no puede estar vacío.") ;
        return false;}
    if (correo ==""){
        swal("ERROR","El campo correo institucional no puede estar vacío.", "error");
        //alert("El campo correo institucional no puede estar vacío.") ;
        return false;
    }
    
    if (nombre.length<3) { 
        swal("ERROR","El campo nombre(s) es muy corto.", "error");
        //alert("El campo nombre(s) es muy corto.");
         return false; 
    }
     
    if (apellidos.length<3) { 
        swal("ERROR","El campo apellidos es muy corto.", "error");
        //alert("El campo apellidos es muy corto.");
         return false; 
    }
    var expRegNombre= /^[a-zA-ZÑñÁáÉéÍíÓóÚúÜü\s]+$/
    var expRegApellidos=/^[a-zA-ZÑñÁáÉéÍíÓóÚúÜü\s]+$/;
    if (!expRegNombre.exec(nombre))
     {
        swal("ERROR","El campo nombre(s) solo admite letras y espacios.", "error");
        //alert("El campo nombre(s) solo admite letras y espacios.");
        nombre.focus();
        return false;
     }

     if (!expRegApellidos.exec(apellidos))
     {
        swal("ERROR","El campo apellidos solo admite letras y espacios.", "error");
        //alert("El campo apellidos solo admite letras y espacios.");
        nombre.focus();
        return false;
     }

     var expRegCorreo=/^\w+@(\w+\.)+\w{2,4}$/;
     if(!expRegCorreo.exec(correo))
     {
        swal("ERROR","El campo correo institucional no tiene el formato correcto.", "error");
       //alert("El campo correo institucional no tiene el formato correcto.")
       correo.focus();
       return false;
     }
     if (correo.indexOf("unam.mx")==-1) {
        swal("ERROR","El dominio del correo institucional debe ser unam.mx", "error");
        //alert("El dominio del correo institucional debe ser unam.mx")
        return false;
    }
    return true;
    }
    $('#editar').click(function() {

        var resultado = window.confirm('¿Está seguro de actualizar los datos?');
        //var resultado = swal("Confirmacion","¿Está seguro de actualizar los datos?","info");
        if (resultado === true) {
            var id = document.getElementById('id_moodle').value;
            var id_persona = document.getElementById('id_persona').value; console.log("id_persona" + id_persona);
            var nombre = document.getElementById('nombre').value;console.log("nombre" + nombre);
            var apellidos = document.getElementById('apellidos').value;console.log("apellidos" + apellidos);
            var correo = document.getElementById('correo').value;console.log("correo" + correo);
            var roles = document.getElementById('roles').value;

            var validar= validarForm(nombre, apellidos, correo);
        
            if (validar ===true) {
                var ruta = "id=" + id + "&nombre=" + nombre + "&apellidos=" + apellidos + "&correo=" + correo + "&roles=" + roles + "&id_persona=" + id_persona;
            console.log(ruta);
            $.ajax({
                    url: './getvalidacion.php',
                    type: 'POST',
                    data: ruta,
                })
                .done(function(res) {
                    console.log('resut =',res)
                    $('#respuesta').html(res);
                })
                .fail(function() {
                    console.log('error');
                })
                .always(function() {
                    console.log('complete');
                    location.href ="../adm.php";
                });
               //location.href ="../adm.php";
     
            } 
             
            //e.preventDefault();

        } else {
            swal("UPS...","Se ha cancelado la edición de datos", "info");
            //window.alert('');
            location.href ="../adm.php";
        }

    })