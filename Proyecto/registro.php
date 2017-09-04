<html lang="es">

<head>
 <title>Registrar Usuario</title>
<style type="text/css" media="all">@import "./template.css";</style>
</head>

<body>

 <header>
     <h1><center>Registrate en nuestro fabuloso website:</center></h1>
 </header> 

 <form action="registrar-usuario.php" method="post"> 

  <div class='login'>
  <h2>Registro</h2>
  <input name='username' placeholder='Nombre de Usuario' type='text'/>
  <input name='password'placeholder='Contraseña'type="password" type='text'/>
  <input checked='' id='remember' name='remember' type='checkbox'/>
  <label for='remember'></label>
  <text>Recordar Contraseña</text>
  <br><input type="submit" name="submit" value="Registrarme"/>
  <input type="reset" name="clear" value="Borrar"/></br>
  </div>

 </form>

 </body>
</html>