<?php
$conn_string = "host=10.10.40.70 port=5432 dbname=milliway user=milliway password=milliway";
$conexion = pg_connect($conn_string) or die('No se ha podido conectar: '.pg_last_error());

$rut= $_REQUEST['rut'];

$result = pg_query($conexion, "select * from notificaciones where rut =".$rut);

$header=["ID CAMPAÑA","ID NOTIFICACIÓN","ASUNTO","UNIVERSO","ENVIADO","FECHA DE INICIO","APERTURA","FECHA DE APERTURA"];


?>

<div style='width:98%' >

	<table style='margin-top:10px; margin-bottom:10px;'>

		<thead >

			<tr class='header_background' style="background-color: #cddfab">
				<?php foreach ($header as $key => $value) { ?>							
				<td class=""><?=$value?></td>
				<?php } ?>
			</tr>

		</thead>

		<tbody>
			<?php 
			while ($row = pg_fetch_row($result)) {
				$cargaDatos=$row;
				?>
				<tr>
					<?php 

					foreach ($cargaDatos as $key => $value) {
						if($key != 9){?>
						<td style="text-align:center; padding-left:0px"><?= $value ?></td>								
						<?php } }?>
					</tr>
					<?php }?>



				</tbody>
			</table>

		</div>
		<?php


		pg_close($conexion);

		?>