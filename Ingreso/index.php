
<?php

//$_SESSION["GroupID"];
$group_id=$_REQUEST["codigo"];

$conexion = mysqli_connect('localhost', 'root', 'root', 'productos1', '3306');

$result = mysqli_query($conexion, 'SELECT codigo, nombre, precio, fechaalta, categoria FROM productos');

mysqli_free_result($result);
//print_r($res[""]);

mysqli_close($conexion);

?>



<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd"> 
<!--
<DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

-->

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />

	<title>Sistema de Gestión Ingresa</title>


	<!-- >> CSS para mocha-ui -->
	<script type='text/javascript' src="jquery/jquery.min.js"></script>
	<script type='text/javascript' src="jquery/jquery.numeric.js"></script>

	<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="css/style.css" />



</head>

<body>

	<div class="container">
		<div class="row">
			<div class="col-md-3" id="content-barra-left" style="">			
				<div class="border_color" id="menu_barra_left">					
					<div class="header_background tamanio_barra_left" id="header_barra_left" style="">INFORMACIÓN GENERAL DEL BENEFICIARIO</div>
					<div class="tamanio_barra_left">
						<br>
						<form action="">
							<div class="" style="">
								<input type="text" name="group_id" value="<?=$group_id?>" style="display:none">
								<label>Ingrese Rut:</label> <input maxlength="8" type="text" id="rutInput" onkeyup="largo_rut(this.value)" style="" value="">
								<input id="btn_consultar" type="submit" value="Consultar">
							</div>
						</form>
						<label id="mensaje_alerta" class="mensaje_validacion">mensaje</label>
						<br>
						<br>
						
						<div class="row row_margin" style="">
							<div class="col-md-12">
								<label>Nombre:</label> 
								<label id="nombre"></label> 
								
							</div> 
							<div class="col-md-12">
								<label>Rut:</label>
								<label id="lbl_rut" style=""></label>
								
							</div>
						</div>
					</div>
					
				</div>
				<div class="border_color tamanio_barra_left" id="caja_menu_barra_left" style="" >
					
					<div class="odd">
						<div class="header_background border_color bleeding" >MENÚ</div>

						<?php if($res["cartola_resumen"]=="SI"||$res["mensajes_app"]=="SI"||$res["emails"]=="SI"||$res["consulta_contactabilidad"]){?>	

						<ul class="menu_list">

							<li class="underline">RESUMEN</li>
							<?php if($res["cartola_resumen"]=="SI"){?>
							<li><a class="cartola_resumen" href="#" name="CARTOLA RESUMEN">Cartola Resumen</a></li>
							<?php }if($res["mensajes_app"]=="SI"){?>
							<li><a class="mensajes_app headerIframe" href="#" name="MENSAJES ENVIADOS A LA APP">Mensajes Enviados a la App</a></li>
							<?php }if($res["emails"]=="SI"){?>
							<li class=""><a class="headerIframe" id="emailenviado" href="#" name="EMAILS ENVIADOS">Emails Enviados</a></li>
							
							<?php } if($res["consulta_contactabilidad"]=="SI"){?>
							<li class=""><a class="headerIframe" id="contactabilidad" href="#" name="DATOS DE CONTACTO">Datos de Contacto</a></li>
							<?php } ?>
						</ul>

						<?php } if($res["bitacora_postulante"]=="SI"||$res["apelacion"]=="SI"||$res["comprobante_postulacion"]=="SI"){?>

						<ul class="menu_list ">

							<li class="underline">ASIGNACIÓN</li>
							<?php if($res["bitacora_postulante"]=="SI"){?>
							<li class=""><a class="headerIframe" id="bp/index.php?id_vent=62" href="#" name="BITÁCORA DEL POSTULANTE">Bitácora del Postulante</a></li>
							<?php } if($res["apelacion"]=="SI"){?>
							<li class=""><a class="headerIframe" id="ap/index.php?id_vent=64" href="#" name="APELACIÓN">Apelación</a></li>
							<?php } if($res["comprobante_postulacion"]=="SI"){?>
							<li class=""><a class="headerIframe" id="vercomppost" href="#" name="COMPROBANTE DE POSTULACIÓN">Comprobante de Postulación</a></li>
							<?php } ?>

						</ul>

						<?php } if($res["bitacora_renovante"]=="SI"||$res["solicitudes_monto"]=="SI"||$res["trazabilidad"]=="SI"){?>

						<ul class="menu_list ">

							<li class="underline">RENOVACIÓN</li>
							<?php if($res["bitacora_renovante"]=="SI"){?>
							<li class=""><a class="headerIframe" id="br/index.php?id_vent=63" href="#" name="BITÁCORA DEL RENOVANTE">Bitácora del Renovante</a></li>
							<?php } if($res["solicitudes_monto"]=="SI"){?>
							<li class=""><a class="headerIframe" id="monto/index.php?id_vent=46" href="#" name="SOLICITUDES DE MONTOS">Solicitudes de Monto</a></li>
							<?php } if($res["trazabilidad"]=="SI"){?>
							<li class=""><a class="headerIframe" id="tr/trz_grid.php?id_vent=64" href="#" name="TRAZABILIDAD">Trazabilidad</a></li>
							<?php } ?>

						</ul>

						<?php } if($res["historial_credito_beneficiario"]=="SI"||$res["simulador_cuotas"]=="SI"||$res["cuadro_pago"]=="SI"||$res["prepagos"]=="SI"||$res["pagos_garantias"]=="SI"||$res["consulta_consulta_pagos_ies"]=="SI"){?>

						<ul class="menu_list ">

							<li class="underline">HISTORIAL FINANCIERO</li>
							<?php if($res["historial_credito_beneficiario"]=="SI"){ ?>
							<li class=""><a class="headerIframe" id="credito/index.php?id_vent=9019" href="#" name="HISTORIAL DE CRÉDITO PORTAL DEL BENEFICIARIO">Historial del Crédito Portal del Beneficiario</a></li>
							<?php } if($res["simulador_cuotas"]=="SI"){?>
							<li class=""><a class="headerIframe" id="simulador/sim.php?id_vent=9019" href="#" name="SIMULADOR DE CUOTAS">Simulador de Cuotas</a></li>
							<?php } if($res["cuadro_pago"]=="SI"){?>
							<li class=""><a class="headerIframe" id="cp/index.php?id_vent=9021" href="#" name="CUADRO DE PAGO">Cuadro de Pago</a></li>
							<?php } if($res["prepagos"]=="SI"){?>
							<li><a class="headerIframe" id="pp/hst_alumno.php?id_vent=7013" href="#" name="PREPAGOS">Prepagos</a></li>
							<?php } if($res["pagos_garantias"]=="SI"){?>
							<li class=""><a class="headerIframe" id="pg/buscador_solicitudes.php?id_vent=9019" href="#" name="PAGOS DE GARANTÍAS">Pagos de Garantías</a></li>


							<?php } if($res["consulta_pagos_ies"]=="SI"){?>

							<li class=""><a class="headerIframe" id="pi/consulta_rut.php?id_vent=9019" href="#" name="CONSULTA DE PAGOS IES">Consulta de pagos a IES</a></li>
							


							
							<?php } ?>

						</ul>

						<?php } if($res["historial_postulaciones_contingencia"]=="SI"||$res["postulaciones_suspension_cesantia"]=="SI"||$res["postulaciones_suspencion_postgrado"]=="SI"){?>	

						<ul class="menu_list ">
							
							<li class="underline">BENEFICIOS</li>
							<?php  if($res["historial_postulaciones_contingencia"]=="SI"){?>
							<li class=""><a class="headerIframe" id="hp/index.php?id_vent=63" href="#" name="HISTORIAL DE POSTULACIONES A LA CONTIGENCIAS">Historial Postulaciones a la Contingencia</a></li>
							<?php } if($res["postulaciones_suspension_cesantia"]=="SI"){?>
							<li class=""><a class="headerIframe" id="sp/index.php?id_vent=9019" href="#" name="POSTULACIONES SUSPENSIÓN POR CESANTÍA">Postulaciones Suspensión por Cesantía</a></li>
							<?php } if($res["postulaciones_suspension_postgrado"]=="SI"){?>
							<li class=""><a class="headerIframe" id="postsusppostgrado" href="#" name="POSTULACIONES SUSPENSIÓN POSTGRADO">Postulaciones Suspensión Postgrado</a></li>
							<?php } ?>

						</ul>

						<?php } if($res["llamados_callcenter"]=="SI"||$res["consultas_sac"]=="SI"){?>

						<ul class="menu_list ">

							<li class="underline ">ATENCIÓN DE PÚBLICO</li>
							<?php  if($res["consultas_sac"]=="SI"){?>
							<li class=""><a class="headerIframe" id="sac/index.php?id_vent=9019" href="#" name="CONSULTAS EN EL SAC">Consultas en el SAC</a></li>
							<?php } if($res["llamados_callcenter"]=="SI"){?>
							<li class=""><a class="headerIframe" id="callcenter" href="#" name="LLAMADOS AL CALL CENTER">Llamados al Call Center</a></li>
							<?php } ?>	
							

						</ul>

						
						
						<?php } ?>	
					</div>

					
					
				</div>
			</div>
			
			<div class="col-md-9" id="content-right" style="">
				<div class="" id="repliega_desplega" style=""><div id="posicion_repliega_despliega" style=""><img style="width:auto" id="img_repliega_despliega" src="img/fondo_borra_repliega.jpg"></div>
			</div>
			
			<div class="main_panel border_color"  style=" ">
				<div class="header_background"  id="headerIframePanel"></div>
				
				<div id="contenido_principal" style="">
					
					
				</div>
				
			</div>
			
		</div>
		
	</div>
</div>
</body>
</html>
<script type="text/javascript" src="js/javascript.js"></script>
