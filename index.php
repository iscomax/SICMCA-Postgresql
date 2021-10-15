<?php ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./Styles/styles.css">
</head>
<body>

   <div class="containerLog login">
   <form action="validar.php" method="post">
        <label for="">Correo  Institucional</label>
        <input type="text"  name="email" value="">
        <label for="">Contraseña</label>
        <input type="password"  name="pwd" value="">
        <input type="submit" name="submit" class="button loginB"  value="Ingresar">
    </form>
   </div>
</body>
</html>