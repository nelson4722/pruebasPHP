<html lang="es">

<head>
 <title>Registrar Usuario</title>
<style type="text/css" media="all">@import "./template.css";</style>
</head>

<body>
    <h1><center>Bienvenido nuevamente</center></h1>
<?php
session_start();
?>

<?php

 $host_db = "localhost";
 $user_db = "root";
 $pass_db = "root";
 $db_name = "basedatosmaster";
 $tbl_name = "Usuarios";
 $code_db="3306";
 
 $conexion = new mysqli($host_db, $user_db, $pass_db, $db_name, $code_db);
if ($conexion->connect_error) {
 die("La conexion falló: " . $conexion->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];
 
$sql = "SELECT * FROM $tbl_name WHERE nombre_usuario = '$username'";

$result = $conexion->query($sql);

if ($result->num_rows > 0) {     
 }
 $row = $result->fetch_array(MYSQLI_ASSOC);
 if (password_verify($password, $row['password'])) { 
 
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $username;
    $_SESSION['start'] = time();
    $_SESSION['expire'] = $_SESSION['start'] + (5 * 60);
    echo "<h1>Bienvenido! " . $_SESSION['username']."</h1>";
    echo "<br><br><a href=panel-control.php>Panel de Control</a>"; 

 } else { 
   echo "Username o Password estan incorrectos.";

   echo "<br><a href='login.php'>Volver a Intentarlo</a>";
 }
 mysqli_close($conexion); 
 ?>

 </body>
</html>
