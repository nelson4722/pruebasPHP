<form action="ejercicio6.php" method="post">
 <p>Su nombre: <input type="text" name="nombre" /></p>
 <p>Su edad: <input type="text" name="edad" /></p>
 <p><input type="submit" /></p>
</form>
<?php 
$nombre=htmlspecialchars($_REQUEST['nombre']);
$edad=htmlspecialchars($_REQUEST['edad']);
echo ($nombre).", Usted tiene ".(int)($edad)." años";
