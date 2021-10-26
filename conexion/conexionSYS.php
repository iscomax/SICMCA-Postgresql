<?php
class conexionSYS

{

    private $server1;
    private $user;
    private $password;
    private $database;
    private $port;
    private $conexion;
    private $IDpersona;
    private $cont_Aprobados=0;
    private $cont_Reprobados=0;
    private $total_alumnos=0;
    private $promedio_Curso;
    private $calificacionesArray= array();
    private $reprobadosArray= array();
    public function setAprobados($aprobados) {$this->cont_Aprobados= $aprobados;}
    public function getAprobados(){return $this->cont_Aprobados;}
    public function setReprobados($reprobados) {$this->cont_Reprobados= $reprobados;}
    public function getReprobados(){return $this->cont_Reprobados;}
    public function setTotalAlumnos($num_alumnos) {$this->total_alumnos= $num_alumnos;}
    public function getTotalAlumnos(){return $this->total_alumnos;}
    public function setPromedioCurso($promedio) {$this->promedio_Curso= $promedio;}
    public function getPromedioCurso(){return $this->promedio_Curso;}
    public function setCalificacionesArray($calificaciones) {$this->calificacionesArray= $calificaciones;}
    public function getCalificacionesArray(){return $this->calificacionesArray;}
    public function setReprobadosArray($reprobadosArray) {$this->reprobadosArray= $reprobadosArray;}
    public function getReprobadosArray(){return $this->reprobadosArray;}

    function __construct()
    {
        $this->server = "127.0.0.1";
        $this->user = "sicma";
        $this->password = "56enldfjs.atujrstHH";
        $this->database = "sicmca";
        $this->port = "5432";
        $this->conexion = new PDO("pgsql:host=".$this->server.";port=".$this-> port.";dbname=".$this-> database,$this-> user,$this-> password) 
        or die('No se ha podido conectar: ' . pg_last_error());

    }

    
    public function obtenerDatos($qry)
    {
        //echo $qry;
        $result =  $this->conexion ->query($qry);
        $datos= $result->fetch();
        if ($datos) {
            return $datos;
        }
        else{
            return false;
        }

    
    }
    public function verificarStatus($id_grupo,$id_curso, $numero_cuenta)
    {        // echo"parametro = ".$profesor."/";
       $status =false;
        $qry = "SELECT * from materia where numero_cuenta='$numero_cuenta'";
        $cont =  $this->conexion->query($qry)->rowCount();
       
        if ( $cont  >= 1) {
           
            $result = $this->conexion->query($qry); 
            $resultArray = array();
            foreach ($result as $key) {
              $resultArray[] = $key;
            }
            foreach ($resultArray as $key => $dato) {
                $g = $dato['id_grupo'];//id_grupo
              $c = $dato['id_moodle'];//id_moodle
                if ($id_grupo == $g && $id_curso == $c) {

                   // echo "entro";
                   $status =true;
                }
            }
        } else {
            $status = false;
        }
        return $status ;
    }


    public function obtenerRol($id)
    {
         $qry = "select id_rol from rol_usuario where id_usuario ='$id'";
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

    public function validar($qry)
    {
        $result =  $this->conexion->query($qry)->rowCount();
    //echo "numero de ROW=".$result;
      
        if ($result >= 1) {
            return 1;
        } else {
            return 0;
        }
    }
    /********funciones administrador***********************************************************/
    public function insertPersona($nombre, $apellidos)
    {
        $qry = "INSERT into persona (nombre, apellidos)values
        ('$nombre','$apellidos')";
       // $result =   $this->conexion->query($qry);
        $filas = $this->conexion->query($qry)->rowCount();
        if ($filas >= 1) {
            $this->IDpersona = $this->conexion->lastInsertId();
            return  $this->IDpersona;
        } else {
            return 0;
        }
    }

    public function insertUsuario($id, $correo, $contraseña, $idPersona)
    {
        $qry = "INSERT into usuario (id_usuario, correo, contraseña,id_persona)values
        ('$id','$correo','$contraseña','$idPersona')";

        $filas = $this->conexion->query($qry)->rowCount();

        if ($filas >= 1) {
            return $this->conexion->lastInsertId();
        } else {
            return 0;
        }
    }

    public function insertROL($id_rol, $idPersona)
    {
        $qry = "INSERT into rol_usuario(id_rol, id_usuario)values('$id_rol','$idPersona')";

        $filas = $this->conexion->query($qry)->rowCount();
        
        if ($filas >= 1) {
            return  $filas;
        } else {
            return 0;
        }
    }

    public function guardar($qry)
    {
        $filas = $this->conexion->query($qry)->rowCount();
        if ($filas >= 1) {
            return $this->conexion->lastInsertId();
        } else {
            return 0;
        }
    }


    public function listaUsuarios()
    {
        $qry = "SELECT usuario.id_usuario,usuario.id_persona, persona.nombre, persona.apellidos, rol.nombre_rol, usuario.correo 
        from rol_usuario, rol,usuario, persona 
        where rol_usuario.id_rol = rol.id_rol  
        and rol_usuario.id_usuario = usuario.id_usuario 
        and usuario.id_persona =persona.id_persona";
        $result =  $this->conexion->query($qry);
        $resultArray = array();
        foreach ($result as $key) {
            $resultArray[] = $key;
        }
        //print_r($resultArray);
        return $resultArray;
    }
    public function obtnerUsuario($id)
    {
        $qry = "SELECT usuario.id_usuario,usuario.id_persona, persona.nombre, persona.apellidos, rol.id_rol,rol.nombre_rol, usuario.correo 
        from rol_usuario, rol,usuario, persona 
        where rol_usuario.id_rol = rol.id_rol  
        and rol_usuario.id_usuario = usuario.id_usuario 
        and usuario.id_persona =persona.id_persona and  usuario.id_usuario =$id";
        $result =  $this->conexion->query($qry);
        $resultArray = array();
        foreach ($result as $key) {
            $resultArray[] = $key;
        }   
        //print_r($resultArray);
        return $resultArray;
    }
    /********funciones actualizar datos***********************************************************/
    public function actualizarUsuario($id, $correo)
    {
        //echo "idusuario= " . $id;
        //echo "correo= " . $correo;
        $qry = "UPDATE usuario set correo ='$correo' where id_usuario =$id";
      

        $filas =  $filas = $this->conexion->query($qry)->rowCount();
        if ($filas >= 1) {
            return  $filas;
        } else {
            return 0;
        }
    }
    public function actualizarPersona($nombre, $apellidos, $id_persona)
    {
        $qry = "update persona set  nombre = '$nombre', apellidos = '$apellidos' where id_persona='$id_persona'";

        $filas =   $filas = $this->conexion->query($qry)->rowCount();
        if ($filas >= 1) {
            return  $filas;
        } else {
            return 0;
        }
    }
    public function actualizarRol($id_rol, $id_usuario)
    {
        $qry = "update rol_usuario set id_rol ='$id_rol' where id_usuario ='$id_usuario'";
      
          $filas = $this->conexion->query($qry)->rowCount();
        if ($filas >= 1) {
            return  $filas;
        } else {
            return 0;
        }
    }
    /********************funciones eliminar usuario***********************************************************/
    public function eliminarRol($id_usuario)
    {
        $qry = "DELETE from rol_usuario where id_usuario='$id_usuario'";
        //$result = $this->conexion->query($qry);

        $filas = $this->conexion->query($qry)->rowCount();
       // echo "filas= " . $filas;
        if ($filas >= 1) {
            return  $filas;
        } else {
            return 0;
        }
    }
    public function eliminarUsuario($id_usuario)
    {
        $qry = "DELETE from usuario where id_usuario =$id_usuario";
     

        $filas =    $filas = $this->conexion->query($qry)->rowCount();
        //echo "filas= " . $filas;
        if ($filas >= 1) {
            return  $filas;
        } else {
            return 0;
        }
    }
    public function eliminarPersona($id_persona)
    {
        $qry = "DELETE from persona where id_persona = '$id_persona';";

        $filas =  $filas = $this->conexion->query($qry)->rowCount();
        //echo "filas= " . $filas;
        if ($filas >= 1) {
            return  $filas;
        } else {
            return 0;
        }
    }

    /********************funciones coordinador***********************************************************/
    public function mostrarBItacora()
    {
        $qry = "SELECT * from bitacora";
        $result =  $this->conexion->query($qry);
        $resultArray = array();
        foreach ($result as $key) {
            $resultArray[] = $key;
        }
        //print_r($resultArray);
        return $resultArray;
    }
    public function eliminarBitacora($id_bitacora)
    {
        $qry = "DELETE from bitacora where id_bitacora = '$id_bitacora'";
       
        $filas = $this->conexion->query($qry)->rowCount();
      
        //echo "filas= " . $filas;
        if ($filas >= 1) {
            return  $filas;
        } else {
            return 0;
        }
    }
    /********************funciones profesor***********************************************************/

    public function actualizarCalificacion($id_grupo,$id_curso, $numero_cuenta)
    {
        //echo "parametro = ".$profesor."/";
        $qry = "SELECT * from materia where numero_cuenta='$numero_cuenta'";
        $result =  $this->conexion->query($qry);
        $resultArray = array();
        foreach ($result as $key) {
            $resultArray[] = $key;
        }
        $calificacion = 0;
        foreach ($resultArray as $key => $dato) {
            $grupo = $dato['id_grupo'];//id_grupo
            $curso = $dato['id_moodle'];//id_moodle
            if ($id_curso == $curso && $grupo == $id_grupo) {

                $calificacion = $dato['calificacion'];
            }
        }
        //print_r($resultArray);
        return $calificacion;
    }

    public function numeroCalificados($id_grupo)
    {
        $qry= "SELECT count(*) from materia where id_grupo ='$id_grupo'";

        $result =  $this->conexion ->query($qry);
        $resultArray= $result->fetch();
       
        foreach ($resultArray as $key) {
            $numero = $key; 
        }

        return $numero;

    }

    public function statusAprobados($cal)
    {
        if ($cal>=6) {
            $status ="Aprobado";
            $this->cont_Aprobados++;
            array_push($this->calificacionesArray,$cal); 
        } else {
            $status ="Reprobado";
            $this->cont_Reprobados++;
            array_push($this->calificacionesArray,$cal); 
        }
        $this->total_alumnos =  $this->cont_Aprobados +  $this->cont_Reprobados;
       // print_r($this->calificacionesArray);
        
       return $status;
    }

    public function promedioCurso($calificacionesArray)
    {
        $this->calificacionesArray= $calificacionesArray;
        $suma = array_sum($this->calificacionesArray);
        $numeroDeCal=count($this->calificacionesArray);
        $this->promedio_Curso = $suma/$numeroDeCal;

        return $this->promedio_Curso;
    }
}
