<?php
$numero= $_GET["numero"];
if(isset($_GET["numero"]) && is_numeric($_GET["numero"]))
{
    $numero=$_GET["numero"];
}
echo "<P>Tabla de Multiplicar de ".$numero."</P>";
for($i=1;$i<=10;$i++)
{
    echo $i." x ".$numero." = ".($i*$numero)."</br>";
}
?>

