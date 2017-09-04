<?php header("Content-type: text/json");
// Realizando una consulta SQL
$dbconn = pg_connect("host=10.10.40.70 dbname=opencontact user=opencontact password=opencontact")
                    or die('No se ha podido conectar: ' . pg_last_error());//conexion base de datos postgresql 

//extraccion de datos mediante GET, desde la funcion carga_tabla en archivo funciones.js, para las variables en la consulta
 $fecha=$_GET['fecha']; 
 $condicion = $_GET['tipo'];

//--------------------------------------- Tabla lineas--------------------------------------------------------- 
if($fecha){//si fecha viene llena entonces true, si no, false

    $query_tabla_lineas = "SELECT fono, opcion, rut, fecha from medipass_datos_ivr where nombre_opcion = '".$condicion."' and fecha::date = '".$fecha."' ::date";
    
    $result_tabla = pg_query($query_tabla_lineas) or die('La consulta fallo: ' . pg_last_error());
    
    $carga_datosRetorno= array();//declara arreglo para retornar un valor Json

while($row = pg_fetch_array($result_tabla)){
	
	$carga_datosRetorno[]= $row;//cargando datos de consulta para datos de retorno, con un dimencion para cada iteración
	
}

}
echo json_encode($carga_datosRetorno,JSON_NUMERIC_CHECK);//retornando un json para la funcio caraga_tabla en archivo funciones.js

 

pg_close($dbconn);//cerrando conexión

?>
