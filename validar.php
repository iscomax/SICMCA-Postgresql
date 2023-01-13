<?php
function validarCorreo($correo){

   
    if(filter_var($correo, FILTER_VALIDATE_EMAIL) === FALSE){
        return false;
     }else{
        return true;
     }
   
}
?>