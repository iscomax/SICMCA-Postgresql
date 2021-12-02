<?php
//include 'scope/nvar.php';
session_start();

//condicionamos el inicio de sesion
if(isset($_SESSION['login'])){ 
    $id = $_SESSION['id_usuario']; 
}else{
    //redireccionamos si no hay sesion
  header("location: index.php");
}

require('./conexion/conexion.php');
require('./clases/cursos.php');
require('./conexion/conexionSYS.php');
try {
   
    if (empty( $_SESSION['id_usuario'])) {
        $id= $_GET['id_usuario'];
        //echo "get";
    }elseif (isset($_GET['id_usuario'])){
       $id = $_SESSION['id_usuario'];
       //echo "session";
    }
  //instanciamos la clase
    $cursos = new cursos();
    //asignamos a variable 
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
    <link rel="stylesheet" href="./Styles/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Document</title>
</head>
<body>
    <!-- barra de navegacion -->
    <div id="navbar">
    <ul>
    <li><?php echo" <a href='./profesor/cursos.php?id_usuario=$id'>Cursos</a>"?></li>
      <li ><?php echo" <a href='profesor.php?id_usuario=$id'>Grupos</a>"?></li>
   
      <li ><?php echo" <a href='buscar.php?id_usuario=$id'>Buscar</a>"?></li>
      <li style="float:right"><a class="active" href="./clases/destroy.php">Cerrar Sesión</a></li>
    </ul>
  </div>

<div class="titulos">
    <h1>Grupos</h1>
</div>
  <div class="containerTAB" >
  <table class="paleBlueRows" id="datatable" >
        <thead>
            <tr>
                <th>Id Curso</th>
                <th>Nombre del Curso</th>
                <th>Nombre del Grupo</th>
                <th>Nombre del Profesor</th>
                <th>Pendientes por <br> Calificar</th>
                <th>Calificados</th>
                <th>Acción</th>
            </tr>
        </thead>
 <tbody>
            <?php
            try {
                if (isset($listaCursos) && !empty($listaCursos) && sizeof($listaCursos) > 0) {
                    foreach ($listaCursos as $key => $curso) {
                                    $id_grupo =$curso['id'];
                                    $id_curso=$curso['instanceid'];
                                  $numeroA =$cursos->numeroAlumnos($id_grupo, $id_curso);
                                $numeroC=$conexionSYS->numeroCalificados($id_grupo);
                                    //echo "total concluidos= ". $numeroC;
                                  // echo "total de alumnos= ". $numeroA;
                                $pendientes = $numeroA-$numeroC;
                                    //echo $curso["instanceid"] . "-" . $curso["fullname"] . "-" .  $curso["firstname"] . "-" . $curso["lastname"] . "<br/>";
                                    echo
                                    '
                        <tr>
                            <td>'.$curso['instanceid'].'</td>
                            <td>' . $curso['fullname'] . '</td>
                            <td>' . $curso['name'] . '</td>
                            <td>' . $curso['firstname'] . " " . $curso['lastname'] . '</td>
                            <td>'.$pendientes.'</td>
                            <td>'.$numeroC.'</td>
                            <td>
                            <a href="lista.php?id_grupo='.$curso['id'].'&id_curso='.$curso['instanceid'].'" class="button" type="button">Ver Grupo </a>
                        
                            </td>
                        </tr>
                        ';  
                    }
                }
            } catch (Exception $ex) {
                //throw $th;
            }
           // $id_grupo=1;
      
            
            ?>
        </tbody>
    </table>

  </div>
  <script  type="text/javascript">
   


</script>
</body>

</html>