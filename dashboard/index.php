<?php

session_start();

if (!isset($_SESSION['usua_predio']))
{
	header('Location: ../error.php');
} else {


include ('../includes/funcionesUsuarios.php');
include ('../includes/funcionesHTML.php');
include ('../includes/funciones.php');
include ('../includes/funcionesReferencias.php');

$serviciosUsuario = new ServiciosUsuarios();
$serviciosHTML = new ServiciosHTML();
$serviciosFunciones = new Servicios();
$serviciosReferencias 	= new ServiciosReferencias();

$fecha = date('Y-m-d');

//$resProductos = $serviciosProductos->traerProductosLimite(6);
$resMenu = $serviciosHTML->menu($_SESSION['nombre_predio'],"Dashboard",$_SESSION['refroll_predio'],'');



?>

<!DOCTYPE HTML>
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">



<title>Gesti&oacute;n: Declaraciones Patrimoniales</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">


<link href="../css/estiloDash.css" rel="stylesheet" type="text/css">
    

    
    <script type="text/javascript" src="../js/jquery-1.8.3.min.js"></script>
    <link rel="stylesheet" href="../css/jquery-ui.css">

    <script src="../js/jquery-ui.js"></script>
    
    <script src="../js/jquery.easy-autocomplete.min.js"></script> 

	<!-- CSS file -->
	<link rel="stylesheet" href="../css/easy-autocomplete.min.css"> 

	<!-- Additional CSS Themes file - not required-->
	<link rel="stylesheet" href="../css/easy-autocomplete.themes.min.css"> 
    
	<!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css"/>
	<!--<link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>-->
    <!-- Latest compiled and minified JavaScript -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
	


	
    <script src="../js/liquidmetal.js" type="text/javascript"></script>

      <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
      <script src="../js/jquery.mousewheel.js"></script>
      <script src="../js/perfect-scrollbar.js"></script>
      <script>
      jQuery(document).ready(function ($) {
        "use strict";
        $('#navigation').perfectScrollbar();
      });
    </script>

    <style type="text/css">
    	.sinborde {
		    border: 0;
		  }

    </style>


    
</head>

<body>

 
<?php echo str_replace('..','../dashboard',$resMenu); ?>

<div id="content">
	<div class="boxInfoLargo">
        <div id="headBoxInfo">
        	<?php if ($_SESSION['idroll_predio'] == 1) { ?>
        	<p style="color: #fff; font-size:18px; height:16px;">Buscar Agentes</p>
        	<?php } else { ?>
        	<p style="color: #fff; font-size:18px; height:16px;">Agente</p>

        	<?php } ?>
        </div>
    	<div class="cuerpoBox">
        	<form class="form-inline formulario" role="form" enctype="multipart/form-data">
        	<div class="row">
        	<div class="col-md-12">	
        		<?php if ($_SESSION['idroll_predio'] == 1) { ?>
	        	<div class="form-group col-md-12">
                     <h4>Busqueda por Nombre Completo o CURP</h4>
                    
						
					<input id="lstjugadores" style="width:75%;">
						
					
					<div id="selction-ajax" style="margin-top: 10px;"></div>
                </div>
                
                <div class="form-group col-md-12">
                    <div class="cuerpoBox" id="resultadosJuagadores">
    
                    </div>

                    <div class="cuerpoBox" id="resultadosArchivos">
    
                    </div>
                </div>
                <?php } else { ?>
                <ul class="list-group">
	              <li class="list-group-item list-group-item-info"><span class="glyphicon glyphicon-user"></span> Cliente - (<span style="color:#F00;">*</span> Datos No editables)</li>
	              <li class="list-group-item list-group-item-default">Apellido: <input type="text" class="form-control sinborde" name="apellido" id="apellido" value="<?php echo mysql_result($resCliente,0,'apellido'); ?>" /></li>
	              <li class="list-group-item list-group-item-default">Nombre: <input type="text" class="form-control sinborde" name="nombre" id="nombre" value="<?php echo mysql_result($resCliente,0,'nombre'); ?>" /></li>
	              <li class="list-group-item list-group-item-default">CUIT: <input type="text" class="form-control sinborde" name="cuit" id="cuit" value="<?php echo mysql_result($resCliente,0,'cuit'); ?>" /></li>
	              <li class="list-group-item list-group-item-default">Dirección: <input type="text" style="width:100%;" class="form-control sinborde" name="direccion" id="direccion" value="<?php echo mysql_result($resCliente,0,'direccion'); ?>" /></li>
	              <li class="list-group-item list-group-item-default">Tel. Fijo: <input type="text" class="form-control sinborde" name="telefono" id="telefono" value="<?php echo mysql_result($resCliente,0,'telefono'); ?>" /></li>
	              <li class="list-group-item list-group-item-default">Tel. Movil: <input type="text" class="form-control sinborde" name="celular" id="celular" value="<?php echo mysql_result($resCliente,0,'celular'); ?>" /></li>
	              <li class="list-group-item list-group-item-default"><span style="color:#F00;">*</span> Email: <?php echo mysql_result($resCliente,0,'email'); ?></li>
	              <li class="list-group-item list-group-item-default">
	                <ul class="list-inline">
	                    <li>Modificar Cliente:</li>
	                    <li><button type="button" class="btn btn-warning" id="modificarCliente" style="margin-left:0px;">Modificar</button></li>
	                    <li id="mensaje"></li>
	                </ul>
	              </li>
	            </ul>

	            <div class="cuerpoBox" id="resultadosArchivos">
    
                </div>

                <?php } ?>
        	</div>

            </div>
            
            
            </form>
    	</div>
    </div>
    
   
</div>






<div class="modal fade" id="myModalcaja" tabindex="1" style="z-index:500000;" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Inicio de Caja</h4>
      </div>
      <div class="modal-body inicioCaja">
      	<div class="row">
        <div class="form-group col-md-6 col-xs-6" style="display:'.$lblOculta.'">
            <label for="'.$campo.'" class="control-label" style="text-align:left">Fecha</label>
            <div class="input-group date form_date col-md-6 col-xs-6" data-date="" data-date-format="dd MM yyyy" data-link-field="fechacaja" data-link-format="yyyy-mm-dd">
                <input class="form-control" size="50" type="text" value="<?php echo date('Y-m-d'); ?>" readonly>
                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
            <input type="hidden" name="fechacaja" id="fechacaja" value="<?php echo date('Y-m-d'); ?>" />
        </div>
        <div class="col-md-6">
        	<label class="control-label">Ingresa Inicio de Caja</label>
            <div class="col-md-12 input-group">
            	<input type="number" class="form-control valor" id="cajainicio" name="cajainicio" value="5" required />
            </div>
        </div>
        </div>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-primary" data-dismiss="modal" id="guardarcaja">Guardar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript" src="../js/jquery.dataTables.min.js"></script>
<script src="../bootstrap/js/dataTables.bootstrap.js"></script>

<script src="../js/bootstrap-datetimepicker.min.js"></script>
<script src="../js/bootstrap-datetimepicker.es.js"></script>
<script type="text/javascript">
$(document).ready(function(){


	var options = {

			url: "../json/jsbuscarclientes.php",

			getValue: function(element) {
				return element.apellido + ' ' + element.nombre + ' ' + element.cuit;
			},

			ajaxSettings: {
		        dataType: "json",
		        method: "POST",
		        data: {
		            busqueda: $("#lstjugadores").val()
		        }
		    },
		    
		    preparePostData: function (data) {
		        data.busqueda = $("#lstjugadores").val();
		        return data;
		    },
			
			list: {
			    maxNumberOfElements: 15,
				match: {
					enabled: true
				},
				onClickEvent: function() {
					var value = $("#lstjugadores").getSelectedItemData().id;
					
					$("#selction-ajax").html('<button type="button" class="btn btn-warning varClienteModificar" id="' + value + '" style="margin-left:0px;"><span class="glyphicon glyphicon-pencil"></span> Modificar</button> \
						<button type="button" class="btn btn-info varClienteArchivos" id="' + value + '" style="margin-left:0px;"><span class="glyphicon glyphicon-download-alt"></span> Cargar Archivos</button> \
					<button type="button" class="btn btn-success varClienteDocumentaciones" id="' + value + '" style="margin-left:0px;"><span class="glyphicon glyphicon-file"></span> Archivos</button>');
				}
			},
			theme: "square"
		};

	$("#lstjugadores").easyAutocomplete(options);

	function traerArchivos(id) {
		$.ajax({
			data:  {id: id, accion: 'traerArchivosPorCliente'},
			url:   '../ajax/ajax.php',
			type:  'post',
			beforeSend: function () {
					
			},
			success:  function (response) {
					$('#resultadosArchivos').html(response);
					
			}
		});
	}


	<?php if ($_SESSION['idroll_predio'] == 2) { ?>
	function modificarCliente(id, apellido, nombre, cuit, direccion, telefono, celular) {
		$.ajax({
			data:  {id: id,
					apellido: apellido,
					nombre: nombre,
					cuit: cuit,
					direccion: direccion,
					telefono: telefono, 
					celular: celular, 
					accion: 'modificarClientePorCliente'},
			url:   '../ajax/ajax.php',
			type:  'post',
			beforeSend: function () {
					
			},
			success:  function (response) {
				if (response == '') {
					$('#mensaje').html('<span style="color:#05E98D;">Se actualizaron sus datos</span>');
				} else {
					$('#mensaje').html('<span style="color:#E90C05;">'+ response + '</span>');
				}
				
					
			}
		});
	}

	$('#modificarCliente').click(function() {
		modificarCliente(<?php echo $idcliente; ?>, $('#apellido').val(), $('#nombre').val(), $('#cuit').val(), $('#direccion').val(), $('#telefono').val(), $('#celular').val());
	});

	
		traerArchivos(<?php echo $idcliente; ?>);
	<?php } ?>	


	$('#selction-ajax').on("click",'.varClienteDocumentaciones', function(){
	    usersid =  $(this).attr("id");
	    traerArchivos(usersid);
	});//fin del boton eliminar

	$('#selction-ajax').on("click",'.varClienteModificar', function(){
		  usersid =  $(this).attr("id");
		  if (!isNaN(usersid)) {
			
			url = "clientes/modificar.php?id=" + usersid;
			$(location).attr('href',url);
		  } else {
			alert("Error, vuelva a realizar la acción.");	
		  }
	});//fin del boton eliminar

	$('#selction-ajax').on("click",'.varClienteArchivos', function(){
		  usersid =  $(this).attr("id");
		  if (!isNaN(usersid)) {
			
			url = "clientes/archivos.php?id=" + usersid;
			$(location).attr('href',url);
		  } else {
			alert("Error, vuelva a realizar la acción.");	
		  }
	});//fin del boton eliminar

	


	var months = ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"];
    
	
	$('table.table').dataTable({
		"order": [[ 0, "asc" ]],
		"language": {
			"emptyTable":     "No hay datos cargados",
			"info":           "Mostrar _START_ hasta _END_ del total de _TOTAL_ filas",
			"infoEmpty":      "Mostrar 0 hasta 0 del total de 0 filas",
			"infoFiltered":   "(filtrados del total de _MAX_ filas)",
			"infoPostFix":    "",
			"thousands":      ",",
			"lengthMenu":     "Mostrar _MENU_ filas",
			"loadingRecords": "Cargando...",
			"processing":     "Procesando...",
			"search":         "Buscar:",
			"zeroRecords":    "No se encontraron resultados",
			"paginate": {
				"first":      "Primero",
				"last":       "Ultimo",
				"next":       "Siguiente",
				"previous":   "Anterior"
			},
			"aria": {
				"sortAscending":  ": activate to sort column ascending",
				"sortDescending": ": activate to sort column descending"
			}
		  }
	} );


	
	
	

	


});
</script>

<script type="text/javascript">

		
$('.form_date').datetimepicker({
	language:  'es',
	weekStart: 1,
	todayBtn:  1,
	autoclose: 1,
	todayHighlight: 1,
	startView: 2,
	minView: 2,
	forceParse: 0,
	format: 'dd/mm/yyyy'
});
</script>
   
    <script src="../js/chosen.jquery.js" type="text/javascript"></script>
<script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  </script>
<?php } ?>
</body>
</html>
