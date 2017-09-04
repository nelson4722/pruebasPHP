<html lang="en">

<head>
 <title>Registrar Usuario</title>
<style type="text/css" media="all">@import "./template.css";</style>
</head>

<body>

 <header>
     <h1><center>Registrate en nuestro fabuloso website:</center></h1>
 </header> 

 <?php

 $host_db = "localhost";
 $user_db = "root";
 $pass_db = "root";
 $db_name = "basedatosmaster";
 $tbl_name = "Usuarios";
 $code_db="3306";
 
 $form_pass = $_POST['password'];
 
 $hash = password_hash($form_pass, PASSWORD_BCRYPT); 

 $conexion = new mysqli($host_db, $user_db, $pass_db, $db_name, $code_db);
 if ($conexion->connect_error) {
 die("La conexion falló: " . $conexion->connect_error);
}

 $buscarUsuario = "SELECT * FROM $tbl_name
 WHERE nombre_usuario = '$_POST[username]' ";

 $result = $conexion->query($buscarUsuario);

 $count = mysqli_num_rows($result);

 if ($count == 1) {
 echo "<br />". "El Nombre de Usuario ya a sido tomado." . "<br />";

 echo "<a href='index.html'>Por favor escoga otro Nombre</a>";
 }
 else{

 $query = "INSERT INTO Usuarios (nombre_usuario, password)
           VALUES ('$_POST[username]', '$hash')";

 if ($conexion->query($query) === TRUE) {
 
 echo "<br />" . "<h2>" . "Usuario Creado Exitosamente!" . "</h2>";
 echo "<h4>" . "Bienvenido: " . $_POST['username'] . "</h4>" . "\n\n";
 echo "<h5>" . "Hacer Login: " . "<a href='login.php'>Login</a>" . "</h5>"; 
 }

 else {
 echo "Error al crear el usuario." . $query . "<br>" . $conexion->error; 
   }
 }
 mysqli_close($conexion);
?>

 </body>
</html>
