<?php 

class conexion{
     private $server;
     private $user; 
     private $password;
     private $database;
     private $port;
     private $conexion;

    function __construct()
    {
        $listaDatos= $this-> datosConexion();
        foreach ($listaDatos as $key => $value) {
           $this-> server = $value['server'];
           $this-> user = $value['user'];
           $this-> password = $value['password'];
           $this-> database = $value['database'];
           $this-> port = $value['port'];
        }
       
        $this->conexion = new PDO("pgsql:host=".$this->server.";port=".$this-> port.";dbname=".$this-> database,$this-> user,$this-> password) 
        or die('No se ha podido conectar: ' . pg_last_error());
      //$this->conexion = new PDO("pgsql:host=".$this->server.";port=5432;dbname=".$this-> database,$this-> user,$this-> password) ;
        //$this->conexion = new PDO("pgsql:dbname=prueba host=localhost port=5432  user=postgres password=kikokiko options='--client_encoding=UTF8'")
        // or die('No se ha podido conectar: ' . pg_last_error());
        

    }

     private function datosConexion(){
         $direccion= dirname(__FILE__);
         //abre un arhivo y guarda la informacion
         $jsonDatos= file_get_contents($direccion . "/". "config");
         return json_decode($jsonDatos, true);
     }
     
    public function obtenerDatos($qry){
         $result =  $this->conexion ->query($qry);
      
        $datos= $result->fetchAll();


        if ($datos) {
            return $datos;
        }
        else{
            return false;
        }
    }

    public function nonQuery($qry){
    $result =   $this->conexion ->query($qry);
    return $this->conexion ->affected_rows;
    }

    public function guardar($qry){
        $result =   $this->conexion ->query($qry);
        $filas= $this->conexion ->affected_rows;
        if ($filas>=1) {
            return $this->conexion ->insert_id;
        }
        else{
            return 0;
        }
    }
    public function buscarDatos($qry)
    {
      
       // $result =  $this->conexion->prepare($qry);
        //$result->execute();
       // $datos= $result->fetch();
       $result =  $this->conexion ->query($qry);
        $datos= $result->fetch();
        if ($datos) {
            return $datos;
        }
        else{
            return false;
        }
       
    }

    //metodo de encriptar
    protected function encriptar($string)
    {
        return md5($string);

    }

    public function crearVista($qry, $id_grupo)
    {
        //echo $qry;
        //$result =  $this->conexion->prepare($qry);
        //$result->execute();
        //echo  $this->conexion->query($qry)->rowCount();
        $select = "SELECT count(*) from lista where id ='$id_grupo'";
      $result =  $this->conexion ->query($select);
      $resultArray= $result->fetch();
     
    //  print_r($resultArray);
      
           foreach ($resultArray as $key) {
            $numero= $key;
           }
 
       
       return $numero;

    }

    public function alumnosGrupo($qry)
    {
        $result =  $this->conexion ->query($qry);
      $resultArray= $result->fetch();
      foreach ($resultArray as $key) {
        $numero= $key;
       }

       return $numero;
    }













}

?>