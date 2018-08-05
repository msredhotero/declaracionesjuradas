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


$existeDeclaracionAnual = 0;

if ($_SESSION['idroll_predio'] != 1) {
	$resAgente = $serviciosReferencias->traerAgenteReal($_SESSION['curp_predio']);
}

if ($_SESSION['idroll_predio'] != 1) {
	$lstDeclaraciones = $serviciosReferencias->traerDeclaracionjuradacabeceraGrillaPorCURP($_SESSION['curp_predio']);


	$cabeceras 		= "	<th>Apellidos</th>
					<th>Nombres</th>
					<th>CURP</th>
					<th>Fecha Recepción</th>
					<th>Email</th>
					<th>Estado</th>";

	$lstCargados 	= $lstDeclaraciones;

	$existeDP		= $serviciosReferencias->traerDeclaracionjuradacabeceraPorAnioCURP(date('Y'), $_SESSION['curp_predio']);
	if (mysql_num_rows($existeDP) > 0) {
		$existeDeclaracionAnual = 1;
	} else {
		$existeDeclaracionAnual = 0;
	}
} else {
	$lstDeclaraciones = $serviciosReferencias->traerDeclaracionjuradacabeceraGrilla($_SESSION['curp_predio']);


	$cabeceras 		= "	<th>Apellidos</th>
					<th>Nombres</th>
					<th>CURP</th>
					<th>Fecha Recepción</th>
					<th>Email</th>
					<th>Estado</th>";

	$lstCargados 	= $lstDeclaraciones;
}

?>

<!DOCTYPE HTML>
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">



<title>Gesti&oacute;n: Declaraciones Patrimoniales</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">



    

    
    <script type="text/javascript" src="../js/jquery-1.8.3.min.js"></script>
    <link rel="stylesheet" href="../css/jquery-ui.css">

    <script src="../js/jquery-ui.js"></script>

    <link rel="stylesheet" href="../materialize/css/materialize.min.css"/>

    <link href="../css/estiloDash.css" rel="stylesheet" type="text/css">
    
    <script src="../js/jquery.easy-autocomplete.min.js"></script> 

	<!-- CSS file 
	<link rel="stylesheet" href="../css/easy-autocomplete.min.css"> 
	-->
	<!-- Additional CSS Themes file - not required
	<link rel="stylesheet" href="../css/easy-autocomplete.themes.min.css"> 
    -->
	<!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css"/>
	<!--<link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>-->
    <!-- Latest compiled and minified JavaScript -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>

    <script src="../materialize/js/materialize.min.js"></script>

	


	
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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


    
</head>

<body>

 
<?php echo str_replace('..','../dashboard',$resMenu); ?>

<div id="content">
	<div class="boxInfoLargo">
        <div id="headBoxInfo">
        	<?php if ($_SESSION['idroll_predio'] == 1) { ?>
        	<p style="color: #fff; font-size:18px; height:16px;">Buscar Agentes</p>
        	<?php } else { ?>
        	<p style="color: #fff; font-size:18px; height:16px;">Declarante</p>

        	<?php } ?>
        </div>
    	<div class="cuerpoBox">
        	<form class="form-inline formulario" role="form" enctype="multipart/form-data">
        	<div class="row">
        	<div class="col-md-12">	
        		<?php if ($_SESSION['idroll_predio'] == 1) { ?>
	        	<div class="cuerpoBox">

	            	<div class="row">
	            		
	            		<table class="table table-striped table-responsive" id="example">
							<thead>
								<tr>
									<th>Apellidos</th>
									<th>Nombres</th>
									<th>CURP</th>
									<th>Fecha Recepción</th>
									<th>Email</th>
									<th>Estado</th>
									<th style="width: 224px;">Acciones</th>
								</tr>
							</thead>
							<tbody id="resultados">
							<?php

								while ($row = mysql_fetch_array($lstCargados)) {
							?>
							<tr>
								<td><?php echo $row['apellidos']; ?></td>
								<td><?php echo $row['nombres']; ?></td>
								<td><?php echo $row['curp']; ?></td>
								<td><?php echo $row['fecharecepcion']; ?></td>
								<td><?php echo $row['emailinstitucional']; ?></td>
								<td><?php echo $row['estado']; ?></td>
								<td>
									<?php if ($row['refestados'] == 3) { ?>
									La declaración fue eliminada, no se puede acceder o modificar
									<?php } else { ?>
									<div class="btn-group">
										<button class="btn btn-success" type="button">Acciones</button>
										<button class="btn btn-success dropdown-toggle" data-toggle="dropdown" type="button">
											<span class="caret"></span>
											<span class="sr-only">Toggle Dropdown</span>
										</button>
										<ul class="dropdown-menu" role="menu">
											<li>
											<a href="javascript:void(0)" class="varmodificar" id="2"><span class="glyphicon glyphicon-pencil"></span> Modificar</a>
											</li>		<li>
											<a href="javascript:void(0)" class="vargastos" id="2"><span class="glyphicon glyphicon-print"></span> Imprimir</a>
											</li>		<li>
											<a href="javascript:void(0)" class="varver" id="2"><span class="glyphicon glyphicon-search"></span> Ver</a>
											</li>		<li>
											<a href="javascript:void(0)" class="varimprmiracuse" id="2"><span class="glyphicon glyphicon-print"></span> Generar Acuse</a>
											</li>		<li>
											<a href="javascript:void(0)" class="varborrar" id="2"><span class="glyphicon glyphicon-remove"></span> Borrar</a>
											</li>

										</ul>
									</div>
									<?php }  ?>
								</td>
							</tr>
							<?php
							}
							?>
							</tbody>
						</table>
	            	</div>	
	            		
                </div>
                <?php } else { ?>
                <ul class="list-group">
                  <li class="list-group-item list-group-item-info">Datos del Declarante</li>
	              <li class="list-group-item list-group-item-default">Primer Apellido: <?php echo mysql_result($resAgente,0,'paterno'); ?></li>
	              <li class="list-group-item list-group-item-default">Segundo Apellido: <?php echo mysql_result($resAgente,0,'materno'); ?></li>
	              <li class="list-group-item list-group-item-default">Nombres: <?php echo mysql_result($resAgente,0,'nombre'); ?></li>
	              <li class="list-group-item list-group-item-default">CURP: <?php echo mysql_result($resAgente,0,'curp'); ?></li>
	              <li class="list-group-item list-group-item-default">Email: <?php echo mysql_result($resAgente,0,'email'); ?></li>

	            </ul>

	            <div class="cuerpoBox">

	            	<div class="row">
	            		<?php
	            		if ($existeDeclaracionAnual == 0) {
	            		?>
	            		<a class="waves-effect green accent-4 btn agregarddpp" href="declaracionpatrimonial/"><i class="large material-icons left">add</i>Nueva Declaración</a>
	            		
	            		<?php } else { ?>
	            		<a class="waves-effect red accent-4 btn"><i class="large material-icons left">block</i> Ya existe una declaración patrimonial para este año.</a>
	            		<?php } ?>
	            		<hr>
	            		<table class="table table-striped table-responsive" id="example">
							<thead>
								<tr>
									<th>Apellidos</th>
									<th>Nombres</th>
									<th>CURP</th>
									<th>Fecha Recepción</th>
									<th>Email</th>
									<th>Estado</th>
									<th style="width: 224px;">Acciones</th>
								</tr>
							</thead>
							<tbody id="resultados">
							<?php

								while ($row = mysql_fetch_array($lstCargados)) {
							?>
							<tr>
								<td><?php echo $row['apellidos']; ?></td>
								<td><?php echo $row['nombres']; ?></td>
								<td><?php echo $row['curp']; ?></td>
								<td><?php echo $row['fecharecepcion']; ?></td>
								<td><?php echo $row['emailinstitucional']; ?></td>
								<td><?php echo $row['estado']; ?></td>
								<td>
									<?php if ($row['refestados'] == 3) { ?>
									La declaración fue eliminada, no se puede acceder o modificar
									<?php } else { ?>
									<div class="btn-group">
										<button class="btn btn-success" type="button">Acciones</button>
										<button class="btn btn-success dropdown-toggle" data-toggle="dropdown" type="button">
											<span class="caret"></span>
											<span class="sr-only">Toggle Dropdown</span>
										</button>
										<ul class="dropdown-menu" role="menu">
											<?php
												switch ($row['refestados']) {
													case 1:
														echo '<li>
																<a href="javascript:void(0)" class="varmodificar" id="2"><span class="glyphicon glyphicon-pencil"></span> Modificar</a>
																</li>		<li>
																<a href="javascript:void(0)" class="vargastos" id="2"><span class="glyphicon glyphicon-print"></span> Imprimir</a>
																</li>		<li>
																<a href="javascript:void(0)" class="varver" id="2"><span class="glyphicon glyphicon-search"></span> Ver</a>
																</li>		<li>
																<a href="javascript:void(0)" class="varimprmiracuse" id="2"><span class="glyphicon glyphicon-print"></span> Generar Acuse</a>
																</li>		<li>
																<a href="javascript:void(0)" class="varborrar" id="2"><span class="glyphicon glyphicon-remove"></span> Borrar</a>
																</li>';
														break;
													case 2:
														echo '<li>
																<a href="javascript:void(0)" class="vargastos" id="2"><span class="glyphicon glyphicon-print"></span> Imprimir</a>
																</li>		
																<li>
																';
														break;
													
													default:
														# code...
														break;
												}
											?>
											

										</ul>
									</div>
									<?php }  ?>
								</td>
							</tr>
							<?php
							}
							?>
							</tbody>
						</table>
	            	</div>	
	            		
                </div>

                <?php } ?>
        	</div>

            </div>
            
            
            </form>
    	</div>
    </div>
    
   
</div>








<script type="text/javascript" src="../js/jquery.dataTables.min.js"></script>
<script src="../bootstrap/js/dataTables.bootstrap.js"></script>

<script src="../js/bootstrap-datetimepicker.min.js"></script>
<script src="../js/bootstrap-datetimepicker.es.js"></script>
<script type="text/javascript">
$(document).ready(function(){



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


	
	$("#example").on("click",'.varborrar', function(){
		  usersid =  $(this).attr("id");
		  if (!isNaN(usersid)) {
			$("#idEliminar").val(usersid);
			$("#dialog2").dialog("open");

			
			//url = "../clienteseleccionado/index.php?idcliente=" + usersid;
			//$(location).attr('href',url);
		  } else {
			alert("Error, vuelva a realizar la acción.");	
		  }
	});//fin del boton eliminar


	$("#example").on("click",'.vargastos', function(){
		  usersid =  $(this).attr("id");
		  if (!isNaN(usersid)) {
		  	window.open("../reportes/rptDeclaracionPatrimonial.php?id=" + usersid ,'_blank');  

		  } else {
			alert("Error, vuelva a realizar la acción.");	
		  }
	});//fin del boton eliminar


	$("#example").on("click",'.varimprmiracuse', function(){
		  usersid =  $(this).attr("id");
		  if (!isNaN(usersid)) {
		  	window.open("../reportes/rptAcuse.php?id=" + usersid  ,'_blank'); 
		  	url = "index.php";
			$(location).attr('href',url); 

		  } else {
			alert("Error, vuelva a realizar la acción.");	
		  }
	});//fin del boton eliminar


	
	
	$("#example").on("click",'.varmodificar', function(){
		  usersid =  $(this).attr("id");
		  if (!isNaN(usersid)) {
			
			url = "declaracionpatrimonial/modificar.php?id=" + usersid;
			$(location).attr('href',url);
		  } else {
			alert("Error, vuelva a realizar la acción.");	
		  }
	});//fin del boton modificar


	$("#example").on("click",'.varver', function(){
		  usersid =  $(this).attr("id");
		  if (!isNaN(usersid)) {
			
			url = "ver.php?id=" + usersid;
			$(location).attr('href',url);
		  } else {
			alert("Error, vuelva a realizar la acción.");	
		  }
	});//fin del boton modificar
	

	


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
