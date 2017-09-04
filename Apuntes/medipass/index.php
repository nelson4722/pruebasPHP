<!DOCTYPE HTML>
<html>
	<head>
        <meta charset="utf-8">
		<title>OpenPartner - Medipass</title>
        <!--COMPLEMENTOS HICHARDS-->
		<style type="text/css">${demo.css}</style>
        
        <script src="js/jquery-1.12.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        
		<script src="js/highcharts/highcharts.js"></script>
		<!--script src="js/highcharts/modules/data.js"></script-->
		<script src="js/highcharts/modules/drilldown.js"></script>
        <!--EXPORTADOR DE HICHARDS-->
        <script src="js/highcharts/modules/exporting.js"></script>
        
            
        <!--BOOSTRAP>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
        <!DATA PICKER-->

		<script type="text/javascript" src="js/moment.min.js"></script>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
		<script type="text/javascript" src="js/daterangepicker.js"></script>
		<link rel="stylesheet" type="text/css" href="css/daterangepicker.css" />
        
        <!--AJUSTE PERSONAL-->
        <link rel="stylesheet" type="text/css" href="js/report.css" />
        <script type="text/javascript" src="js/themes.js"></script>
        <script type="text/javascript" src="js/funciones.js"></script>

	</head>
	<body>
        <style type="text/css">

        .active{
           border: red solid 1px;
        }
        </style>
        <!--header-->
        <header>
            <div class="col-xs-12 col-sm-12 col-md-8 logo btn-blanck">&nbsp;</div>
            <div class="col-xs-12 col-sm-6 col-md-3 btn-blanck btn-b">SOLCOP</div>
            <div class="col-xs-12 col-sm-6 col-md-1 btn-blanck btn-b" onClick="salir()">Salir</div>
        </header>

		<div class="container">
        
        	<div class='carpetas'>
                <input type="radio"/>
                
                <label  class="tab active" id="tab_8" data-id="8"><span>GESTIÓN DE LLAMADAS:8000</span></label>
                
                <input type="radio" />               

                <label class="tab" id="tab_9" data-id="9"><span>GESTIÓN DE LLAMADAS:9000</span></label>
                
			</div>

			 <div class="sin">
                <!--CONTENEDOR DE GRAFICOS-->    
                <div class="row" id="conterA">
                    <!--BUSCADOR-->
                    	<div class="col-xs-12 col-sm-12 col-md-6 text-left">
                            <div class="titulo col-xs-12 col-sm-12 col-md-6">GESTIÓN DE LLAMADAS</div>
                            <div class="input-group col-xs-12 col-sm-12 col-md-6">
                           
                                <input id="reportrange" name="valor_fecha" type="text" value="" class="form-control">
                                <span class="input-group-btn">

                                <input type="submit" class="btn btn-default rojo" id="btn_rango_fecha" type="button">Buscar-----</input>
                          
                                </span>
                            </div>
                        </div>
                     	<div id="body-alert" class="col-lg-6">
                        	
                        </div>
                        <div class="col-lg-12">
                       	<hr>
                        </div>
                	<!--FIN BUSCADOR-->
                    <!--DASH-->
                    <div class="">
           
                        <div class="col-md-6">
                            <div class="chart" id="container_columnas" ></div>
                        </div>
        
                        <div class="col-md-6">
                            <div class="chart" id="container_torta"></div>
                        </div>
                    </div>
                    
                    <div class="">
                    	<!--div id="nota"></div-->
                        <div class="col-md-12">
                            <div class="chart" id="container_lineas"></div>
                        </div>
                    </div>
                    <!--FIN DASH-->
                    
				</div>
                <!--FIN CONTENEDOR DE GRAFICOS--> 
                <!--RESUMEN-->         
                <div class="" id="conterB" style="display:none">       	
	
                 </div> 
 

                 <!--FIN RESUMEN---> 
                 
                 
                 
                 <!-- Modal -->
        <style type="text/css">
            #myModal{opacity:1}
        </style>

		<div id="myModal" class="modal fade" role="dialog">
		  <div class="modal-dialog modal-lg">

		   <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-header">
              
              	<div id="categoria" class="col-xs-12 col-sm-12 col-md-5">
                	
                    	
                    
                </div>
                
                <div class="col-md-8">
                        
		        		
                    <label id="fecha"></label>
                         <label id="tipo"></label>
                </div>
                    <div class="col-md-2">    
	        		<form  method="post" target="_blank" id="modal_table" action="chart/modal_excel.php">
                                         
                        <input type="hidden" id="data_send" name="data_send" />
                        <button id="excl_gn" type="button" class="btn rojo">Exp. a Excel</button>

                    </form>

                    </div>
                    
                    <div class="col-md-2">
                    <input type="hidden" id="maintain_date" name="maintain_date" />
                    <input type="hidden" id="category-name" name="category-name" />
                    <input type="hidden" id="type_sla" name="type_sla" />
                    <button type="hidden" class="close" data-dismiss="modal">&times;</button>
	               
                </div>		        
		        	        
		      </div>
              
              
		      <div class="modal-body">
		        <center><span id="referencia" class="titulo" ></span></center><br>
		        <div id="detalle-tabla">

                
             </div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
		      </div>
		    </div>

		  </div>
		</div>
                 
                 
                 



                 <!--DERECHOS--->            
                 </div><div class="row derechos">OpenPartner 2016 ( © Comunidades Digitales 2016) </div>
                 <!--FIN DERECHOS--->
                 
                 
		</div>


    </body>
</html>




			
