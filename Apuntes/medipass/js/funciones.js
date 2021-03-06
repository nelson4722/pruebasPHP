//------------------------------------------------------------inicio funciones-----------------------------------------------------
//----------------------------------------------------inicio funcion columnas_simples----------------------------------------------
function columnas_simples (data) {
   $('#container_columnas').highcharts({//highcharts para container columnas
		chart: {
         
			defaultSeriesType: 'column',//tipo gráfico
			 
        },
        title: {
            text: 'RESUMEN DE GESTIONES, LLAMADAS Y CONCRETADAS'//título gráfico columnas
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title: {
                text: 'Cantidad de Llamadas'//título eje y
            }

        },
        legend: {
            enabled: true//muestra o no el legend para mostrar de que tipo son los datos
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                  
                },

                cursor: 'pointer',
                point: {
                    events: {
                        click: function () { //mostrar nuevo modal, funcion desactivada                                                                                   
                            /*
                        condicion_columnas_fechas($("#reportrange").val());
                        $("#btn_date_range").text($("#reportrange").val());
                        $("#btn_date_range").val($("#reportrange").val());                                                  
                        $("#btn_date_select").hide();                                                    
                        document.getElementById("btn_date_select").innerHTML = 'Ver: ' + this.category ;
                        $("#myModal").modal();
                    
                            */
                        }
                    }
                }            
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },

    series: [{
        name: 'Llamadas por día',//nombre de la legend 
        colorByPoint: false,//usa o no los temas en archivo themes.js para cambiar los colores segun el dato, en este caso el dia
        data: data
    }],
  });
}
//----------------------------------------------------fin funcion columnas_simples----------------------------------------------
//----------------------------------------------------inicio funcion construir tortas----------------------------------------------

function construirTorta(data){

    $('#container_torta').highcharts({//highchart container torta
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: true,
            type: 'pie'
        },
        title: {
            text: '% de Llamadas en COLA y en ESTADO_LME'//título de la torta
        },
        tooltip: {
            pointFormat: '<b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            },
            series: {
                animation: {
                    duration: 2000//tiempo en milisegundos que demora en cargar la torta
                },
                point: {//pinchamos los pedazos detorta para hacer algo 
                    events:{
                        click: function(event){//event.point trae consigo datos del pedazo de torta, usamos this para mostrarlos this=event.point (ejemplo this.name)
                                 
                                var valor_fecha =  $("#reportrange").val(); // valor de rango fecha para enviar por ajax 
                                lineas_simples(valor_fecha,this.name);//llamando a lineas siples desde torta, con valor_fecha, nombre tipo
                                                            
                            }
                        }
                    }
                }
        },
             
        series: [{
            name: 'Brands',//nombre del legend
            colorByPoint: true,//para mostrar o no los pedazos de torta con los colores de theme.js
            data: data//cantidad de datos de la torta con su "name" y su "y"
        }]
        
    });
}
//----------------------------------------------------fin funcion construir tortas----------------------------------------------
//----------------------------------------------------inicio funcion lineas_simples----------------------------------------------
function lineas_simples(valor_fecha,valor_nombre_opcion){
    
	var optionLinea ={
		chart: {
		   	renderTo: 'container_lineas',
		    type: 'line',
		    marginTop: 80,
		    marginRight: 40
		},
		title: {
            text: 'Montos totales por fechas',//titulo de grafico lineas
            x: -20 //center
        },
        xAxis: {
            categories: []
        },
        yAxis: {
            title: {
                text: 'LLAMADAS'//eje y de lineas
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        plotOptions: {
                series: {
                    cursor: 'pointer',
                    point: {//pinchamos los puntos del grafico para mostrar algo
                        events: {
                            click: function (e) { //e.point trae consigo datos del pedazo de torta, usamos this para mostrarlos this=e.point (ejemplo this.category)                               
                            
                               var tipo=$(".highcharts-legend-item text ").text().split("día");//como se concatenaron los legend se tubo que separar para mostrar el tipo
                               carga_tabla(this.category,tipo[1]);//cargando tabla con parámetros fecha y tipo                                                                                           
                                $('#myModal').modal('show');

                        	}
                    	}
                	},
                marker: {
                    lineWidth: 1
                }
            }
        },
        tooltip: {
            valueSuffix: ' Detalle'
        },// al comentar este pedazo de código concatinamos los legent de lineas y columnas, ademas ponemos el legend de lineas abajo del gráfico
        /*legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },*/
        series: []
	}; 
	
        //manda los parametros como valores al php
    $.get('chart/ajax.php',{valor_fecha: valor_fecha,valor_nombre_opcion:valor_nombre_opcion},function(data){

        optionLinea.series=data.data_json.linea.series;
        optionLinea.xAxis.categories=data.data_json.linea.categories;
        chart1=new Highcharts.Chart(optionLinea);//entrega los valores para

    })

 

}
//----------------------------------------------------fin funcion lineas_simples----------------------------------------------
//----------------------------------------------------inicio funcion carga_tabla----------------------------------------------
function carga_tabla(fecha,tipo){

        //$("#fecha").html('Fecha: '+fecha);
       //$("#tipo").html('Tipo: '+condicion);
        $("#referencia").html('Detalle de llamadas en '+tipo+' por el día con fecha: '+fecha);
        $("#myModal").animate({opacity: "0"},100);  

        $("#detalle-tabla").html("");
        
        $.get('chart/ajax_carga_tabla.php',{fecha:fecha,tipo:tipo} ,function(resp) {

            var html = "";

            html+="<div class='table-responsive'>";
            html+="<table id='table_modal' class='table'>";
            html+="<thead>";
            html+="<tr>";
            html+="<th>Número </th>";
            if(tipo!='ESTADO_LME'){
            html+="<th>Fono </th>";}
            html+="<th>Opción</th>";
            if(tipo!='COLA'){
            html+="<th>rut</th>";}   
            html+="<th>Hora</th>";                                                          
            html+="</tr>";
            html+="</thead><tbody>";
                var numero=1;
            $.each(resp, function(k, v) {
                console.log(v.fecha);
                var valor = v.fecha.split(".");
                
                
                html+="<tr>";

               if(tipo!='ESTADO_LME'){ html+="<td>"+numero+"</td><td>"+v.fono+"</td><td>"+v.opcion+"</td><td>"+valor[1]+"</td>";}
               else{ html+="<td>"+numero+"</td><td>"+v.opcion+"</td><td>"+v.rut+"</td><td>"+valor[1]+"</td>";}
                
                html+="</tr>";
                numero++;
            })

            html+="</tbody>";
            html+="</table>";

            $("#detalle-tabla").append(html);
            $("#myModal").animate({opacity: "1"},1000); 
        });
    }
//----------------------------------------------------fin funcion carga_tabla----------------------------------------------
//----------------------------------------------------fin funciones--------------------------------------------------------
//----------------------------------------------------inicio del main-----------------------------------------------------------
$(document).ready(function() {

     //funcion que muestra gráficos al cargar la página                           
	/*	var valor_fecha =  $("#reportrange").val(); // valor de rango fecha para enviar por ajax 
		var valor_id = $(".tab.active").attr("data-id"); // valor atributo data-id de los tabs en este caso solo el que esta con clase active para enviar por ajax 

		$.get('chart/ajax.php',{valor_fecha: valor_fecha,valor_id:valor_id},function(data){  // consulta ajax

		   columnas_simples(data.data_json.columnas);  // RESPUESTA AJAX CON FUNCIONES DE RESPECTIVOS GRAFICOS
		    construirTorta(data.data_json.torta);
 		 })

	});*/
    //funcion que muestra datos al presionar botón
	$("#btn_rango_fecha").click(function(){ // si le doy click a boton rango de fecha  : envia peticion ajax

		var valor_fecha =  $("#reportrange").val(); // valor de rango fecha para enviar por ajax 
		var valor_id = $(".tab.active").attr("data-id"); // valor atributo data-id de los tabs en este caso solo el que esta con clase active para enviar por ajax 

		$.get('chart/ajax.php',{valor_fecha: valor_fecha},function(data){

		    columnas_simples(data.data_json.columnas);  // RESPUESTA AJAX CON FUNCIONES DE RESPECTIVOS GRAFICOS
		    construirTorta(data.data_json.torta);

		 })

	});

    $('#reportrange').daterangepicker( //instancio daterangepicker
        opts = {
      //  autoUpdateInput: false,
            locale: {
                format: 'YYYY-MM-DD',
                applyClass: 'btn-green',
                applyLabel: "Aceptar",
                fromLabel: "Desde:",
                toLabel: "Hasta:",
                cancelLabel: 'Cancelar',
                customRangeLabel: 'Rango Personalizado',
                daysOfWeek: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
                firstDay: 1,
                cancelLabel: 'Clear',
                monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre',
                    'Octubre', 'Nombiembre', 'Diciembre'
                ]

            },

            maxDate: moment(),

 
			startDate: '2015-01-01',
    		//endDate: '2016-12-30',
 
            ranges: {
                   'Hoy': [moment(), moment()],
                   'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                   'Los Ultimos 7 Dias': [moment().subtract(6, 'days'), moment()],
                   'Los Ultimos 30 Dias': [moment().subtract(29, 'days'), moment()],
                   'Mes Actual': [moment().startOf('month'), moment().endOf('month')],
                   'Mes Anterior': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            }

    );

    $('input[name="rango_fecha"]').on('apply.daterangepicker', function(ev, picker) {
          $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
      });

      $('input[name="rango_fecha"]').on('cancel.daterangepicker', function(ev, picker) {
          $(this).val('');
    });
	

  	$("#excl_gn").on('click', function(event){

        $("#data_send").val( $("<div>").append( $("#table_modal").eq(0).clone()).html());
        $("#modal_table").submit();

    });

});