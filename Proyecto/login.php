<!DOCTYPE html>

<html lang="es">

<head>
 <title>Login</title>
<style type="text/css" media="all">@import "./template.css";</style>
</head>

<body>

    <h1><center>Login de Usuarios</center></h1>

<form action="checklogin.php" method="post" >

<div class='login'>
  <h2>Ingreso</h2>
  <input name='username' placeholder='Nombre de Usuario' type='text'/>
  <input id='pw' name='password' placeholder='Contraseña' type='password'/>
  <input type='submit' value='Ingresar'/>
  <a class='forgot' href='#'>¿Olvidaste tu contraseña?</a>
</div>
</form>
 </body>
</html>