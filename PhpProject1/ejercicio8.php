<form action="ejercicio8.php" method="post">
 <p>codigo: <input type="text" name="codigo" /></p>
 <p>nombre: <input type="text" name="nombre" /></p>
 <p>precio: <input type="text" name="precio" /></p>
 <p>fecha de alta: <input type="text" name="fechaalta" /></p>
 <p>categoria: <input type="text" name="categoria" /></p>
 <p><input type="submit" /></p>
</form>

<?php
$codigo = htmlspecialchars($_POST['codigo']);
$nombre = htmlspecialchars($_POST['nombre']);
$precio = htmlspecialchars($_POST['precio']);
$fechaalta = htmlspecialchars($_POST['fechaalta']);
$categoria = htmlspecialchars($_POST['categoria']);
// process form
$connection = mysqli_connect('localhost', 'root', 'root', 'productos1', '3306');
//INSERT INTO productos VALUES (01,'Afilador', 2.50, '2007-11-02');#inseta afilador
$query = "INSERT INTO productos VALUES ('$codigo', '$nombre', '$precio', '$fechaalta', '$categoria')";    
        $result = mysqli_query($connection, $query);
        //Test if there was a query error
        if ($result) {
            //SUCCESS
        header('Location: ejercicio7.php');
        } else {
            //FAILURE
            die("Database query failed. " . mysqli_error($connection)); 
            //last bit is for me, delete when done
        }
echo "¡Gracias! Hemos recibido sus datos.\n";
mysqli_close($connection);
?>
