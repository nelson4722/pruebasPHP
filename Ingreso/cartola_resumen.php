
<?php
$datos= json_decode(stripslashes($_POST['data']));
//print_r($datos[0]);
//$datos[0][0o1o2]->nombres;
$contCreditos=0;
$hoy = idate('m')*30+idate('Y')*12*30;

is_null($datos) ? $token1=false: $token1=true;
$token2=true;
$muestraTabla=true;
$muestraBeneficios=true;
$muestraBeneficiosMas=true;

function cambioFecha($date){
	$formato_fecha=explode("-",$date);
	
	switch($formato_fecha[1]){
		case 1:
		return $formato_fecha[2]." de Enero ".$formato_fecha[0];
		case 2:
		return $formato_fecha[2]." de Febrero ".$formato_fecha[0];
		case 3:
		return $formato_fecha[2]." de Marzo ".$formato_fecha[0];
		case 4:
		return $formato_fecha[2]." de Abril ".$formato_fecha[0];
		case 5:
		return $formato_fecha[2]." de Mayo ".$formato_fecha[0];
		case 6:
		return $formato_fecha[2]." de Junio ".$formato_fecha[0];
		case 7:
		return $formato_fecha[2]." de Julio ".$formato_fecha[0];
		case 8:
		return $formato_fecha[2]." de Agosto ".$formato_fecha[0];
		case 9:
		return $formato_fecha[2]." de Septiembre ".$formato_fecha[0];
		case 10:
		return $formato_fecha[2]." de Octubre ".$formato_fecha[0];
		case 11:
		return $formato_fecha[2]." de Noviembre ".$formato_fecha[0];
		case 12:
		return $formato_fecha[2]." de Diciembre ".$formato_fecha[0];
	}

}
function cambioFechaMesAnio($date){
	$formato_fecha=explode("-",$date);
	
	switch($formato_fecha[1]){
		case 1:
		return "Enero ".$formato_fecha[0];
		case 2:
		return "Febrero ".$formato_fecha[0];
		case 3:
		return "Marzo ".$formato_fecha[0];
		case 4:
		return "Abril ".$formato_fecha[0];
		case 5:
		return "Mayo ".$formato_fecha[0];
		case 6:
		return "Junio ".$formato_fecha[0];
		case 7:
		return "Julio ".$formato_fecha[0];
		case 8:
		return "Agosto ".$formato_fecha[0];
		case 9:
		return "Septiembre ".$formato_fecha[0];
		case 10:
		return "Octubre ".$formato_fecha[0];
		case 11:
		return "Noviembre ".$formato_fecha[0];
		case 12:
		return "Diciembre ".$formato_fecha[0];
	}

}


if($token1==false){ ?>


<div>Error interno</div>	

<?php


}else{
	for ($j=0; $j <$datos[1][0] ; $j++) { 

		$fechaInicio= explode("-",$datos[0][$j]->fecha_inicio_pago);
		$fecha=$fechaInicio[0]*12*30+$fechaInicio[1]*30;
		
		if($datos[1][0]>1){	?>			
		<div style='width:98%' >
			<div class="header_background border_color bleeding" style="margin-top:10px;">CRÉDITO <?=++$contCreditos?></div>
		</div>
		<?php
	}
	$tituloCabecera="HISTORIAL DEL CRÉDITO";
	
	$titulo0="Institución";
	$titulo1="Carrera";
	$titulo2="Banco";
	$titulo3="Monto Total Solicitado (UF)";
	$titulo4="Años de financiamiento";
	$descripcion0="anio_licitacion";
	$descripcion0="institucion";
	$descripcion1="carrera";
	$descripcion2="banco";
	$descripcion3="monto_total_solicitado_uf";
	$descripcion4="numero_desembolsos";
	

	for ($i=0; $i < 4 ; $i++) { 

		if($i==1 && ($datos[0][$j]->estado_renovante==4 || $datos[0][$j]->estado_renovante==7)){
			$tituloCabecera="INFORME PARA EL PAGO";
			if($fecha<=$hoy){	

				$titulo0="Inicio del Pago";
				$titulo1="Valor Cuota a Pagar (UF)";
				$titulo2="Vencimiento Cuota a Pagar";
				$titulo3="Número de Cuotas Pagadas";
				$titulo4="Fecha del Último Pago";
				$titulo5="Capital por Pagar (UF)";
				
					//hacer el cambio de la fecha					
				
				$descripcion0="fecha_inicio_pago";
					$descripcion1="valor_cuota_pagar_uf";//nombre del campo que viene de la base de datos
					$descripcion2="fecha_venc_cuota_por_pagar";
					$descripcion3="numero_cuotas_pagadas";
					//numero total cuotas
					$descripcion4="fecha_ultimo_pago";
					$descripcion5="capital_por_pagar_uf";
					$descripcion6="cuotas_totales";

					$datos[0][$j]->$descripcion0=cambioFecha($datos[0][$j]->$descripcion0);
					$datos[0][$j]->$descripcion2=cambioFecha($datos[0][$j]->$descripcion2);
					$datos[0][$j]->$descripcion4=cambioFecha($datos[0][$j]->$descripcion4);
					$datos[0][$j]->$descripcion3=$datos[0][$j]->$descripcion3."/".$datos[0][$j]->$descripcion6;


				}else{
					$titulo0="Inicio del Pago";
					$datos[0][$j]->$descripcion0=cambioFecha($datos[0][$j]->fecha_inicio_pago);

					$token1=false;
				}
			}else{
				if ($i==2 && ($datos[0][$j]->estado_renovante==4 || $datos[0][$j]->estado_renovante==7)) {
					$tituloCabecera="BENEFICIOS ASIGNADOS";
					if($datos[0][$j]->derecho_cuotas=="SI"){
						$titulo0="Derecho a Cuotas del 10% de la Renta";
						$titulo1="Valor Cuota Rebajada";
						$titulo2="Vigencia del Beneficio";
						$titulo3="Próxima Solicitud para Renovar";
						$titulo5="";
						$descripcion0="derecho_cuotas";
						$descripcion1="valor_cuota_rebajada_uf";
						$descripcion2="contingencia_fecha_inicio";
						$descripcion3="contingencia_prox_solicitud";
						$descripcion4="contingencia_fecha_termino";
						
						$datos[0][$j]->$descripcion2=cambioFechaMesAnio($datos[0][$j]->$descripcion2)." - ".cambioFechaMesAnio($datos[0][$j]->$descripcion4);
						$datos[0][$j]->$descripcion3=cambioFechaMesAnio($datos[0][$j]->$descripcion3);


						if($datos[0][$j]->derecho_suspension_pago=="SI"){
							$muestraBeneficios=false;
						}
					}else{
						
						$muestraTabla=false;
						
					}
					
				}else{
					if ($i==3 && ($datos[0][$j]->estado_renovante==4 || $datos[0][$j]->estado_renovante==7)){
						$tituloCabecera="BENEFICIOS ASIGNADOS";
						if($datos[0][$j]->derecho_suspension_pago=="SI"){
							if($muestraBeneficios==false){$muestraBeneficiosMas=false; $muestraBeneficios=true;}
							$titulo0="Derecho a Suspensión de Pago";
							$titulo1="Vigencia del Beneficio";
							$titulo2="Próxima Solicitud para Renovar";
							
							$titulo4="";
							$titulo5="";
							$descripcion0="derecho_suspension_pago";
							$descripcion1="suspension_fecha_inicio";
							$descripcion2="suspension_prox_solicitud";
							$descripcion3="suspension_fecha_termino";
							
							$datos[0][$j]->$descripcion1=cambioFechaMesAnio($datos[0][$j]->$descripcion1)." - ".cambioFechaMesAnio($datos[0][$j]->$descripcion3);
							$datos[0][$j]->$descripcion2=cambioFechaMesAnio($datos[0][$j]->$descripcion2);

						}else{
							if($datos[0][$j]->derecho_cuotas=="SI"){
								$muestraTabla=false;
							}else{
								$titulo0="Información";
								$datos[0][$j]->$descripcion0="No tienes beneficios asociados al pago de tus cuotas vigentes a la fecha. Informate sobre cómo rebajar tus cuotas al 10% de tu renta o suspender el cobro de tus cuotas en www.ingresa.cl";
								$token2=false;
							}
						}
					}else{
						if($i!=0)
							$muestraTabla=false;
					}
				}
			}
			if ($muestraTabla){ ?>
			

			<div style='width:98%' >
				<table style='margin-top:10px; margin-bottom:10px;'>
					<?php if($muestraBeneficiosMas==true){?>
					
					<thead >
						<tr class='header_background bleeding' style="background-color: #cddfab">
							<td colspan='2'>
								<?=$tituloCabecera?>
								
								
							</td>
						</tr>
					</thead>

					<tbody class='bleeding'>
						<?php } $muestraBeneficiosMas=true;?>
						<tr>
							<th><?= $titulo0 ?></th>
							<td><?= $datos[0][$j]->$descripcion0 ?></td>
						</tr>
						<?php if($token1==true && $token2==true){ ?>
						<tr>
							<td><?= $titulo1 ?></td>
							<td><?= $datos[0][$j]->$descripcion1 ?></td>
						</tr>
						<tr>
							<td><?= $titulo2 ?></td>
							<td><?=$datos[0][$j]->$descripcion2?></td>
						</tr>
						<?php if($i==0 || $i==1 || $i==2){?>						 
						<tr>
							<td><?= $titulo3 ?></td>
							<td><?=$datos[0][$j]->$descripcion3?></td>
						</tr>
						<?php if($i==0 || $i==1){?>							  
						<tr>
							<td><?= $titulo4 ?></td>
							<td><?=$datos[0][$j]->$descripcion4?></td>
						</tr>
						<?php if($i==1){?>										
						<tr>
							<td><?= $titulo5 ?></td>
							<td><?=$datos[0][$j]->$descripcion5?></td>
						</tr>
						<?php										  			
					}
				}
			}
		}
		
		?>
	</tbody>
</table>

</div>


<?php  
}
$token1=true;
$token2=true;
$muestraTabla=true;

} 
} 
}
?>