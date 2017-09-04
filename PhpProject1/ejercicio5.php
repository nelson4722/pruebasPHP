<?php
echo "<H1>MESES</H1>";
$meses=array("enero","febrero","marzo","abril","mayo","junio",
    "julio","agosto","septiembre","octubre","noviembre","diciembre");
/*for($i=0;$i<count($meses);$i++)
{
    echo $meses[$i]."<br>";
}*/

foreach($meses as $mes)
{
    echo $mes."<br>";
}
?>

