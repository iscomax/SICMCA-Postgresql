//Script para mostrar y ocultar contraseña
//<script type="text/javascript">
function activarPass(){
    var cambiar = document.getElementById("inputPass");
    if(cambiar.type==="password"){
        cambiar.type="text";
    }else{
        cambiar.type="password";
    }
}
//</script>
//Deshabilitar formulario si existen campos vacios
//<script>

(function() {
    'use strict'

    // Obtener todos los formularios a los que queremos aplicar estilos de validación de Bootstrap personalizados
    var forms = document.querySelectorAll('.needs-validation')

    // blucle
    Array.prototype.slice.call(forms)
        .forEach(function(form) {
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
})()
//</script>

