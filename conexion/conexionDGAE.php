<?php

class conexionDGAE
{
    private $server1;
    private $user;
    private $password;
    private $database;
    private $port;
    private $nombre_Alumno;
    private $paterno_Alumno;
    private $materno_Alumno;
    private $conexion;
    private $correo;
    public function setNombreAlumno($nombre) {$this-> nombre_Alumno= $nombre;}
    public function getNombreAlumno(){return $this-> nombre_Alumno;}
    public function setPaternoAlumno($paterno) {$this-> paterno_Alumno= $paterno;}
    public function getPaternoAlumno(){return $this-> paterno_Alumno;}
    public function setMaternoAlumno($materno) {$this-> materno_Alumno= $materno;}
    public function getMaternoAlumno(){return $this-> materno_Alumno;}
    public function setCorreoAlumno($correo) {$this-> correo= $correo;}
    public function getCorreoAlumno(){return $this-> correo;}


    function __construct()
    {
        $this->server = "127.0.0.1";
        $this->user = "dgae";
        $this->password = "56jtemn.BIUeryye";
        $this->database = "dgae";
        $this->port = "5432";
        $this->conexion = new PDO("pgsql:host=".$this->server.";port=".$this-> port.";dbname=".$this-> database,$this-> user,$this-> password) 
        or die('No se ha podido conectar: ' . pg_last_error());


    }

    public function obtenerDatos($qry)
    {
        $result =   $this->conexion->query($qry);
        
        $resultArray = array();
        foreach ($result as $key) {
            $resultArray[] = $key;
        }
        return $resultArray;
    }
    public function obtenerCuenta($qry)
    {
        //echo $qry;
        $result =  $this->conexion ->query($qry);
      
        $datos= $result->fetch();
       // print_r($datos);
        if ($datos) {
            return $datos;
        }
        else{
            return false;
        }
    }

    public function getAlumnoby($numero_Cuenta)
    { 
        $query = "SELECT alumnos.correo  from alumnos where numero_cuenta =$numero_Cuenta";
        $result =  $this->conexion ->query($query);
      
        $datos= $result->fetch();


        if ($datos) {
            return $datos;
        }
        else{
            return false;
        }
      // print_r($result);
      return $result;
       
    }
    public function getDataAlumno($numero_Cuenta)  
    {
        $query = "SELECT * from alumnos where numero_cuenta =$numero_Cuenta";
        
        /*$result =   $this->conexion->query($query);
        $resultArray = array();
        foreach ($result as $key) {
             $resultArray[] = $key;
            foreach ($resultArray as $key => $value) {
                $this->nombre_Alumno=$value['nombre'];
                $this->paterno_Alumno=$value['paterno'];
                $this->materno_Alumno=$value['materno'];
                $this->correo=['correo'];
            }
        }*/       
        $result =  $this->conexion ->query($query);      
        $datos= $result->fetchAll();
        if ($datos) {
            foreach ($datos as $key => $value) {
                $this->nombre_Alumno=$value['nombre'];
                $this->paterno_Alumno=$value['paterno'];
                $this->materno_Alumno=$value['materno'];
                $this->correo=['correo'];
            }
            return $datos;
        }
        else{
            return false;
        }

    }



}