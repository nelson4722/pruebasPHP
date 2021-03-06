

<?php header("Content-type: text/json");
// Realizando una conexion postgeSQL
$dbconn = pg_connect("host=10.10.40.70 dbname=opencontact user=opencontact password=opencontact")
                    or die('No se ha podido conectar: ' . pg_last_error());

//obteniendo datos de valor_fecha desde archivo funciones.js con: var valor_fecha =  $("#reportrange").val(); del html index.php 

if($_GET['valor_fecha']){//se ordena el rango de fechas 

     $rango_fecha = $_GET['valor_fecha'];//obteniendo rango de fechas por get
     $rango_fecha = str_replace("/","-",$rango_fecha);//reemplazando / por -
     $rangos_fecha = explode(' - ',$rango_fecha); //separando el rango de fecha en un arreglo con cada fecha por separado
}

$valor_nombre_opcion = $_GET['valor_nombre_opcion'];// recibe desde el get lineas_simples,  $.get('chart/ajax.php',{valor_fecha: valor_fecha,valor_nombre_opcion:valor_nombre_opcion}, datos para consulta

//--------------------------------------- GRAFICO COLUMNAS------------------------------------------------- 

$query_columna= "SELECT date_trunc('day', fecha) as dia, COUNT(*) AS llamadas FROM medipass_datos_ivr
where fecha::date >= '".$rangos_fecha[0]."'::date and fecha::date <= '".$rangos_fecha[1]."'::date
GROUP BY 1 ORDER BY dia ASC";//consulta dinámica

$result_columna = pg_query($query_columna) or die('La consulta fallo: ' . pg_last_error());//resultado consulta
 
$ar_grafico_columna = []; //arreglo columnas para llenar json con consulta para el llenado de las columnas

$incrementa = 0;
while ($line_columna = pg_fetch_assoc($result_columna)) {

    $ar_grafico_columna = $line_columna; //lleno array para luego modelar segun estructura requerida 
    $porciones = explode(" ", $ar_grafico_columna['dia']);//separo el dia por la fecha y hora
    $ar_grafico_json['data_json']['columnas'][$incrementa]['name']=$porciones[0];//ingreso solo la fecha al json con su estructura definida 
    $ar_grafico_json['data_json']['columnas'][$incrementa]['y'] = $ar_grafico_columna['llamadas'];//ingreso cantidad de llamadas al json con su estructura definida
    $incrementa++;//incremento índice
}
//---------------------------------------FIN GRAFICO COLUMNAS------------------------------------------------- 

//---------------------------------------GRAFICO TORTAS------------------------------------------------ 

$query_torta ="SELECT COUNT(*) AS llamadas, nombre_opcion FROM medipass_datos_ivr
where fecha::date >= '".$rangos_fecha[0]."'::date and fecha::date <= '".$rangos_fecha[1]."'::date
GROUP BY nombre_opcion";//consulta dinámica


$resultado = pg_query($query_torta) or die('La consulta fallo: ' . pg_last_error());//extraigo consulta


$incrementa = 0;
while ($line = pg_fetch_assoc($resultado)) {  

    $torta = $line; //  creo array asociativo 
    $ar_grafico_json['data_json']['torta'][$incrementa]['name']= $torta['nombre_opcion'];//le doy el nombre del tipo con su estructura definida
    $ar_grafico_json['data_json']['torta'][$incrementa]['y']= $torta['llamadas'];//doy cantidad de llamadas por tipo con su estructura definida
    $incrementa++;
}
//---------------------------------------FIN GRAFICO TORTAS------------------------------------------------ 

//---------------------------------------GRAFICO LINEAS------------------------------------------------- 

if($valor_nombre_opcion){//si valor nombre_opcion viene lleno entonces true si no, false-----------------------comienzo if-------------------

    $query_linea_cola ="SELECT date_trunc('day', fecha) as dia, COUNT(*) AS llamadas, nombre_opcion FROM medipass_datos_ivr
    where fecha::date >= '".$rangos_fecha[0]."'::date and fecha::date <= '".$rangos_fecha[1]."'::date
    and nombre_opcion='".$valor_nombre_opcion."'
    GROUP BY 1,3 ORDER BY dia ASC";//consulta dinámica

    $result = pg_query($query_linea_cola) or die('La consulta fallo: ' . pg_last_error());//extraigo valor de la consulta


    $incrementa2 = 0;                          
    while ($line = pg_fetch_array($result)) {    //pg_fetch_array ya que necesito llaves numericas para posteriormente modelar el array

        $ar_grafico_linea= $line;
        $porciones_linea = explode(" ", $ar_grafico_linea['dia']);//separo el dia por fecha y hora
        $ar_grafico_json['data_json']['linea']['categories'][$incrementa2]=$porciones_linea[0]; //ingreso las fechas segun estrucuta definida
        $ar_grafico_json['data_json']['linea']['series'][0]['data'][]=  $ar_grafico_linea['llamadas']; //ingreso cantidad de llamadas segun estructura definida
        $incrementa2++;//incremento índice 
    }

     $ar_grafico_json['data_json']['linea']['series'][0]['name'][]=  $ar_grafico_linea['nombre_opcion'];//ingreso nombre opcion para el gráfico 
}              
//-----------------------------------------------------------------------------------------------------------fin if------------------------
//---------------------------------------FIN GRAFICO LINEAS------------------------------------------------- 

echo json_encode($ar_grafico_json,JSON_NUMERIC_CHECK);//retorno un json y lo muestro

pg_close($dbconn);//fin conexión

?>





