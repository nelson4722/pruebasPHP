
<?php
// Conectando y seleccionado la base de datos  



$conn_string = "host=10.10.40.70 port=5432 dbname=milliway user=milliway password=milliway";
$conexion = pg_connect($conn_string) or die('No se ha podido conectar: '.pg_last_error());

$rut= $_POST["rut"];
//$rut="5555551";




$result = pg_query($conexion, "select * from cartola where rut =".$rut);

$cont=0;
$numCreditos=0;
$resultado = "[[";

while ($row = pg_fetch_assoc($result)) {
	
	$cargaDatos=json_encode($row);
	$cont==0 ? $resultado= $resultado.$cargaDatos : $resultado= $resultado.",".$cargaDatos;
	$cont=1;
	$numCreditos++;

}

$resultado = $resultado."],[".$numCreditos."]]";
echo $resultado;



// Cerrando la conexión
pg_close($conexion);





?>
