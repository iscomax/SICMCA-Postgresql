<?php 
require("../conexion/conexion.php");

class registro extends conexion
{
    private $correo;
   
    public function buscarDatos($correo)
    {
        $this->correo= $correo;
        $query = "SELECT  mdl_user.id,  mdl_user.firstname, mdl_user.lastname,  mdl_user.email, mdl_user.password  from mdl_user where  mdl_user.email = '$this->correo'";
        $datos = parent::buscarDatos($query);
       // print_r($datos);
        return $datos;
    }

    public function obtenerCuenta($qry)
    {
        $result =    pg_fetch_array($this->conexion->query($qry));
        return $result;
    }  
}

?>
