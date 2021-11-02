<?php 
require('../conexion/conexion.php');
require('../conexion/conexionSYS.php');
require('../conexion/conexionDGAE.php');
require('../clases/cursos.php');
session_start();
if(isset($_SESSION['login'])){ 
    $id = $_SESSION['id_usuario']; 
}else{
  header("location: index.php");
}
try {
   
    if (empty( $_SESSION['id_usuario'])) {
        $id= $_GET['id_usuario'];
        //echo "get";
    }elseif (isset($_GET['id_usuario'])){
       $id = $_SESSION['id_usuario'];
       //echo "session";
    }
  
    $cursos = new cursos();
    $listaCursos = $cursos->listaCursos($id);
    //print_r($listaCursos);

    $conexionSYS = new conexionSYS();
    
} catch (Exception $ex) {
    //throw $th;
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Document</title>
</head>
<body>
    <div id="navbar">
    <ul>
    <li><?php echo" <a href='cursos.php?id_usuario=$id'>Cursos</a>"?></li>
      <li ><?php echo" <a href='../profesor.php?id_usuario=$id'>Grupos</a>"?></li>
   
      <li ><?php echo" <a href='../buscar.php?id_usuario=$id'>Buscar</a>"?></li>
      <li style="float:right"><a class="active" href="../clases/destroy.php">Cerrar Sesión</a></li>
    </ul>
  </div>

<div class="titulos">
    <h1>Cursos</h1>
</div>
  <div class="containerTAB" >
  <table class="paleBlueRows" id="datatable" >
        <thead>
            <tr>
                <th>Id Curso</th>
                <th>Nombre del Curso</th>
                <th>Nombre del Profesor</th>
               
            </tr>
        </thead>
 <tbody>
            <?php if(isset($listaCursos) && !empty($listaCursos) && sizeof($listaCursos) > 0):?>
                <?php foreach ($listaCursos as $key => $curso): ?>
                    <?php  $id_grupo =$curso['id'];
                             $id_curso=$curso['instanceid'];          
                     ?>
                      <tr>
                        <td><?php echo $curso['instanceid'] ?></td>
                        <td><?php echo  $curso['fullname'] ?></td>
                        <td> <?php echo $curso['firstname']." ".$curso['lastname'] ?> </td>   
                    </tr>
                <?php endforeach?>
            <?php endif?>    

        </tbody>
    </table>

  </div>
  <script  type="text/javascript">
   


</script>
</body>

</html>