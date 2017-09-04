$(document).ready(function() {
/*
				$.post("menu.php",function(htmlMenu){
					$("#caja_menu_barra_left").html(htmlMenu);
				});
				*/			

				$("#rutInput").numeric();
				altura_despliega_repliega=$(".col-md-3").height();
				var ancho_window=$(window).width();
				$(".container").css("width",ancho_window);
				$("#repliega_desplega").css("height",altura_despliega_repliega);

				

				var datosTabla= []; 				


			

	$("#btn_consultar").click(function(){
		$("#contenido_principal").empty();
							//validar cantidad de rut
							
							if($("#rutInput").val().length<7 && $("#rutInput").val().length>0 ){
								
								$("#mensaje_alerta").text("El Rut ingresado tiene muy pocos caracteres");
								$("#mensaje_alerta").css("visibility","visible");
							}else{
								if($('#rutInput').val()){
									$("#mensaje_alerta").css("visibility","hidden");

									$.ajax({
										url: "conexion_bd_cartola.php",
										type: "post",
										data: { 
											rut:$('#rutInput').val()
										},
										success: function(data1){

											console.log(data1);


											var datosJson =JSON.parse(data1);
					                  	//console.log(datosJson);
					                  	datosTabla=datosJson;
					                  	//datosTabla=data1[0];
					                  	//alert(datosJson[0][0]);
					                  	//console.log(datosJson[1][0]);
					                  	if(datosJson[1][0]!=0){
					                  		$("#nombre").text(datosJson[0][0].nombres+" "+datosJson[0][0].apellidos);
					                  		$("#lbl_rut").text(datosJson[0][0].rut+"-"+datosJson[0][0].dv);
					                  		$("#headerIframePanel").text($(".cartola_resumen").attr("name"));
					                  		cartola(datosTabla);	
					                  	}else{
					                  		$("#mensaje_alerta").text("El RUT no está en los registros del Crédito CAE");
					                  		$("#mensaje_alerta").css("visibility","visible");
					                  	}

					                  }
					              });

								}else{
									$("#mensaje_alerta").text("Ingrese número de Rut sin puntos ni DV");
									$("#mensaje_alerta").css("visibility","visible");
								}
							
						}
					});



	$(".cartola_resumen").click(function(){
			$("#headerIframePanel").text($(this).attr("name"));
			cartola(datosTabla);
	});


	$(".headerIframe").click(function(){// validación y agrega iframe
		$("#contenido_principal").empty();
		$("#headerIframePanel").text($(this).attr("name"));
		//$("#contenido_principal").html("<iframe src='https://gestion.ingresa.cl/gestion2016/app/mod_"+$(this).attr('id')+"/hst_alumno.php?s_RUT="+$('#rutInput').val()+"' style='border:0px; width:98%; height: 80vh;'></iframe>");
		if($("#lbl_rut").text()){
			rut= $("#lbl_rut").text().split("-");
			$("#contenido_principal").html("<iframe src='http://desarrollo.tide.cl/Creditos2017/svn_desarrollo/trunk/app/consultas_rut/"+$(this).attr('id')+"&rut="+rut[0]+"' class='iframe_dimencion'></iframe>");	

			if($(".main_panel").height()>600){
			
				$('#repliega_desplega').height($(".main_panel").height()+2);
				$('.tamanio_barra_left .odd').height($(".main_panel").height()-150);
				}else{
					
					$('.tamanio_barra_left .odd').height("70vh");
					$("#repliega_desplega").css("height",$(".col-md-3").height());
				}			
		}else{
			if($("#rutInput").val()=="")
			{
				$("#mensaje_alerta").text("Ingrese número de Rut sin puntos ni DV");
				$("#mensaje_alerta").css("visibility","visible");
			}

			if($(this).attr("name")=="LLAMADOS AL CALL CENTER" && $("#mensaje_alerta").text() == "El RUT no está en los registros del Crédito CAE")
			{
			
			$("#contenido_principal").html("<iframe src='http://desarrollo.tide.cl/Creditos2017/svn_desarrollo/trunk/app/consultas_rut/"+$(this).attr('id')+"&rut="+$("#rutInput").val()+"' class='iframe_dimencion'></iframe>");	

			if($(".main_panel").height()>600){
			
				$('#repliega_desplega').height($(".main_panel").height()+2);
				$('.tamanio_barra_left .odd').height($(".main_panel").height()-150);
				}else{
					
					$('.tamanio_barra_left .odd').height("70vh");
					$("#repliega_desplega").css("height",$(".col-md-3").height());
				}	
			}
			
			//$("#mensaje_alerta").text("Consulte Rut");
			//$("#mensaje_alerta").css("visibility","visible");
		}
		

	});
});



$(".mensajes_app").click(function(){
	if($("#lbl_rut").text()!=""){
		rut= $("#lbl_rut").text().split("-");
		$.post("mensajes_app.php",{rut: rut[0]},function(htmlTablaApp){

		
			$("#contenido_principal").html(htmlTablaApp);
			$("#headerIframePanel").text($(this).attr("name"));

			if($(".main_panel").height()>600){
			
				$('#repliega_desplega').height($(".main_panel").height()+2);
				$('.tamanio_barra_left .odd').height($(".main_panel").height()-150);
				}else{
					
					$('.tamanio_barra_left .odd').height("70vh");
					$("#repliega_desplega").css("height",$(".col-md-3").height());
				}	
		});
		}else{
			if($("#rutInput").val()=="")
			{
				$("#mensaje_alerta").text("Ingrese número de Rut sin puntos ni DV");
				$("#mensaje_alerta").css("visibility","visible");
			}
			//$("#mensaje_alerta").text("Consulte Rut");
			//$("#mensaje_alerta").css("visibility","visible");
		}
	
});	

$("#rutInput").click(function(){
	if($("#rutInput").val()=="")
	{
		$("#mensaje_alerta").text("Ingrese número de Rut sin puntos ni DV");
		$("#mensaje_alerta").css("visibility","visible");
	}
	

});

function largo_rut(val){


	if(val.length<7 && val.length>0){
		$("#contenido_principal").empty();
		$("#lbl_rut").empty();
		$("#nombre").empty();
		$("#headerIframePanel").empty();


	}
	else{

		$("#mensaje_alerta").css("visibility","collapse");
	}  

}
function cartola(datosTabla)
{
	if($('#lbl_rut').text()){

			var jsonString = JSON.stringify(datosTabla);
			console.log(jsonString);
			data= {
				data: jsonString
				
			};							
			$.post("cartola_resumen.php",data,function(htmlTablas){
				$("#contenido_principal").html(htmlTablas);	
				if($(".main_panel").height()>600){
			
				$('#repliega_desplega').height($(".main_panel").height()+2);
				$('.tamanio_barra_left .odd').height($(".main_panel").height()-150);
				}else{
					$('.tamanio_barra_left .odd').height("70vh");
					$("#repliega_desplega").css("height",$(".col-md-3").height());
				}			
			});
			


		}else{
			if($("#rutInput").val()=="")
			{
				$("#mensaje_alerta").text("Ingrese número de Rut sin puntos ni DV");
				$("#mensaje_alerta").css("visibility","visible");
			}
			
			//$("#mensaje_alerta").text("Consulte Rut");
			//$("#mensaje_alerta").css("visibility","visible");
		}
}
var esVisible=true;
$("#repliega_desplega").click(function(){// implementación de menu dinámico
				//$("#btn_consultar").css("opacity","0");
				$("#menu_barra_left").animate({


				})
				valor_barra_left= $(".col-md-3").width();
				if(valor_barra_left>1){
					$(".tamanio_barra_left").css("width",valor_barra_left);
					//$("#caja_input_rut").css("margin-top",)
				}


				if(esVisible==true){
					$("#content-barra-left").css("disabled", "disabled");
					$("#content-barra-left").animate({

						opacity: '0',					  
						width: '0%'
					});
					$("#caja_menu_barra_left").css("display","none");

					$("#content-right").animate({

						width:'98%'
					});
					$("#img_repliega_despliega").attr("src","img/fondo_borra_despliega.jpg");
					
					esVisible=false;
				}else{
					//$("#btn_consultar").css("opacity","1");
					$("#content-barra-left").animate({

						opacity: '1',

						width: '25%'
					});
					$("#caja_menu_barra_left").css("display","block");

					$("#content-right").animate({

						width: '75%'
					});
					
					$("#img_repliega_despliega").attr("src","img/fondo_borra_repliega.jpg");
					esVisible=true;

				}



			});


