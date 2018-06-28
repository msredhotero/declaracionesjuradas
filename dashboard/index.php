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


if ($_SESSION['idroll_predio'] == 2) {
	$resAgente = $serviciosReferencias->traerAgenteReal($_SESSION['curp_predio']);
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

	<!-- CSS file -->
	<link rel="stylesheet" href="../css/easy-autocomplete.min.css"> 

	<!-- Additional CSS Themes file - not required-->
	<link rel="stylesheet" href="../css/easy-autocomplete.themes.min.css"> 
    
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
                  <li class="list-group-item list-group-item-info">Datos del Declarante</li>
	              <li class="list-group-item list-group-item-default">Primer Apellido: <?php echo mysql_result($resAgente,0,'paterno'); ?></li>
	              <li class="list-group-item list-group-item-default">Segundo Apellido: <?php echo mysql_result($resAgente,0,'materno'); ?></li>
	              <li class="list-group-item list-group-item-default">Nombres: <?php echo mysql_result($resAgente,0,'nombre'); ?></li>
	              <li class="list-group-item list-group-item-default">CURP: <?php echo mysql_result($resAgente,0,'curp'); ?></li>
	              <li class="list-group-item list-group-item-default">Email: <?php echo mysql_result($resAgente,0,'email'); ?></li>

	            </ul>

	            <div class="cuerpoBox">

	            	<div class="row">
						<div class="col s12 m4">
							<div class="card teal lighten-2 darken-1">
								<div class="card-content white-text">
									<span class="card-title">DATOS GENERALES DEL DECLARANTE</span>
									<p>En nombre y apellidos, deberá anotarlos sin abreviaciones con excepción de las personas que lo tengan
registrado así en su acta de nacimiento. Utilizar todos los espacios disponibles para el RFC con
HOMOCLAVE. De Igual forma para anotar su CURP. El lugar de nacimiento deberá indicar el municipio o
delegación y separado por una coma, el Estado al que pertenece.
Para el caso del Sexo, solo debe anotar la letra que corresponda: M para Masculino y F para Femenino.
Si dispone de un correo electrónico personal, deberá anotarlo, esto con el objeto de que pueda recibir
información por este medio, si fuera necesario.</p>
								</div>
								<div class="card-action">
									<a href="declaracionpatrimonial/">Acceder</a>
								</div>
							</div>
						</div>

						<div class="col s12 m4">
							<div class="card light-blue lighten-2 darken-1">
								<div class="card-content white-text">
									<span class="card-title">DATOS DEL CARGO</span>
									<p>Anotará el cargo que va a desempeñar o que concluye, mencionando la fecha en que toma posesión o se
retira del cargo, según sea el caso. El nombre del cargo, dependencia, organismo o ayuntamiento, así
como área de adscripción, deberá anotarlos sin abreviaciones, exceptuando cuando quiera indicar
“Dirección General” con Dir. Gral. o “Coordinación” como Coord.
En área de adscripción indicará el área a la que pertenece el cargo que va a ocupar o que concluye,
exceptuando cuando Usted ocupe un cargo de Dirección General o Coordinación, o nivel similar, por
ejemplo: Cargo: Jefe de Departamento de Recursos Materiales; área de Adscripción: Coordinación
Administrativa.</p>
								</div>
								<div class="card-action">
									<a href="declaracionanual/">Acceder</a>
								</div>
							</div>
						</div>


						<div class="col s12 m4">
							<div class="card indigo lighten-2 darken-1">
								<div class="card-content white-text">
									<span class="card-title">DATOS PUBLICOS</span>
									<p>Seleccionará los datos que el declarante desee que sean públicos.</p>
								</div>
								<div class="card-action">
									<a href="publicacion/">Acceder</a>
								</div>
							</div>
						</div>
					</div>




					<div class="row">
						<div class="col s12 m4">
							<div class="card teal lighten-2 darken-1">
								<div class="card-content white-text">
									<span class="card-title">INGRESOS ANUALES DEL DECLARANTE</span>
									<p>Anotará el monto de percepción mensual por concepto de salarios, después de haber descontado los
impuestos y cuotas de Seguridad Social. En el caso de tener otros ingresos, éstos serán bajo los mismos
criterios señalados en este párrafo, indicando en la sección XII.- OBSERVACIONES Y ACLARACIONES,
el concepto de estos ingresos. Las cantidades deberán ser redondeados y sin centavos.</p>
								</div>
								<div class="card-action">
									<a href="ingresosanuales/">Acceder</a>
								</div>
							</div>
						</div>

						<div class="col s12 m4">
							<div class="card light-blue darken-4">
								<div class="card-content white-text">
									<span class="card-title">DEPENDIENTES ECONOMICOS</span>
									<p>En caso de tener dependientes económicos, deberá anotar sus datos en esta sección.</p>
								</div>
								<div class="card-action">
									<a href="dependienteseconomicos/">Acceder</a>
								</div>
							</div>
						</div>


						<div class="col s12 m4">
							<div class="card teal lighten-2 darken-1">
								<div class="card-content white-text">
									<span class="card-title">BIENES MUEBLES</span>
									<p>Anote el número que corresponda según la clave de bien mueble con que cuenta, así como su valor, tanto
del declarante como de su cónyuge, concubino (a) y dependientes económicos, en caso de tenerlos. El
valor del bien deberá ir redondeado y sin centavos.
</p>
								</div>
								<div class="card-action">
									<a href="bienesmuebles/">Acceder</a>
								</div>
							</div>
						</div>
					</div>



					<div class="row">
						<div class="col s12 m4">
							<div class="card teal lighten-2 darken-1">
								<div class="card-content white-text">
									<span class="card-title">VEHICULOS</span>
									<p>Anote la clave de operación referente al vehículo, si se trata de otro tipo de transporte como
avión, tractor, etc. deberá especificarlo también en esta sección.</p>
								</div>
								<div class="card-action">
									<a href="vehiculos/">Acceder</a>
								</div>
							</div>
						</div>

						<div class="col s12 m4">
							<div class="card teal lighten-2 darken-1">
								<div class="card-content white-text">
									<span class="card-title">BIENES INMUEBLES</span>
									<p>Anote la clave que corresponda al tipo de inmueble con el que cuenta. IMPORTANTE anotar
el registro que se tenga ante el Registro Público de la Propiedad. En caso de terrenos
ejidales, deberá señalar en el mismo espacio la sesión de derechos correspondiente.</p>
								</div>
								<div class="card-action">
									<a href="bienesinmuebles/">Acceder</a>
								</div>
							</div>
						</div>


						<div class="col s12 m4">
							<div class="card teal lighten-2 darken-1">
								<div class="card-content white-text">
									<span class="card-title">INVERSIONES</span>
									<p>Anote la clave de inversión con que cuenta, en caso de tener inversión en un negocio propio,
deberá señalarlo en la sección VIII.- OTRO TIPO DE INVERSIÓN.</p>
								</div>
								<div class="card-action">
									<a href="inversiones/">Acceder</a>
								</div>
							</div>
						</div>
					</div>

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
