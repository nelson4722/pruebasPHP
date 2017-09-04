
<?php
// Conectando, seleccionando la base de datos
$link = pg_connect("host=10.10.40.70 dbname=opencontact user=opencontact password=opencontact")     
                               or die('No se ha podido conectar: ' . pg_last_error());



// Realizar una consulta MySQL
$query_torta= "SELECT COUNT(*) AS llamadas, nombre_opcion FROM medipass_datos_ivr
where fecha::date >= '11-02-2016'::date and fecha::date <= '16-02-2016'::date
GROUP BY nombre_opcion";


$result_torta = pg_query($query_torta) or die('La consulta fallo: ' . pg_last_error());

while ($line_torta = pg_fetch_assoc($result_torta)) {

    $ar_grafico_torta = $line_torta; //lleno array para luego modelar segun estructura requerida 
 
}
print_r($ar_grafico_torta);

// Imprimir los resultados en HTML


?>
