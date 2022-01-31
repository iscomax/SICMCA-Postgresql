function validarForm(nombre, apellidos, correo){
   
    if (nombre =="") { 
        alert("El campo Nombre no puede estar vacío.");
         return false; 
        }
    if (apellidos ==""){
        alert("El campo Apellidos no puede estar vacío.") ;
        return false;}
    if (correo ==""){
        alert("El campo Correo electrónico no puede estar vacío.") ;
        return false;
    }
    
    if (nombre.length<3) { 
        alert("El campo Nombre es muy corto");
         return false; 
    }
     
    if (apellidos.length<3) { 
        alert("El campo Apellidos es muy corto");
         return false; 
    }
    var expRegNombre= /^[a-zA-ZÑñÁáÉéÍíÓóÚúÜü\s]+$/
    var expRegApellidos=/^[a-zA-ZÑñÁáÉéÍíÓóÚúÜü\s]+$/;
    if (!expRegNombre.exec(nombre))
     {
        alert("El campo nombre admite letras y espacios.");
        nombre.focus();
        return false;
     }

     if (!expRegApellidos.exec(apellidos))
     {
        alert("El campo apellidos admite letras y espacios.");
        nombre.focus();
        return false;
     }

     var expRegCorreo=/^\w+@(\w+\.)+\w{2,4}$/;
     if(!expRegCorreo.exec(correo))
     {
       alert("El campo correo no tiene el formato correcto.")
       correo.focus();
       return false;
     }


    if (correo.indexOf(".unam.mx")==-1) {
        alert("El dominio del correo debe ser unam.mx")
        return false;
    } 



  

     return true;
}




    $('#editar').click(function() {

        var resultado = window.confirm('¿Estas seguro de actualizar los datos?');
        if (resultado === true) {
            var id = document.getElementById('id_moodle').value;
            var id_persona = document.getElementById('id_persona').value;
            var nombre = document.getElementById('nombre').value;
            var apellidos = document.getElementById('apellidos').value;
            var correo = document.getElementById('correo').value;
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
                });
               location.href ="../adm.php";
     
            } 
             
            //e.preventDefault();

        } else {
            window.alert('Se ha cancelado la edición de datos');
            location.href ="../adm.php";
        }

    })