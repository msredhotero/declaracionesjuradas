<?php


session_start();

if (!isset($_SESSION['usua_predio']))
{
	header('Location: ../../error.php');
} else {


include ('../../includes/funciones.php');
include ('../../includes/funcionesUsuarios.php');
include ('../../includes/funcionesHTML.php');
include ('../../includes/funcionesReferencias.php');

$serviciosFunciones 	= new Servicios();
$serviciosUsuario 		= new ServiciosUsuarios();
$serviciosHTML 			= new ServiciosHTML();
$serviciosReferencias 	= new ServiciosReferencias();

$fecha = date('Y-m-d');

//$resProductos = $serviciosProductos->traerProductosLimite(6);
$resMenu = $serviciosHTML->menu(utf8_encode($_SESSION['nombre_predio']),"Ingresos Anuales",$_SESSION['refroll_predio'],'');


///////////////////////   id de la cabecera de la declaracion /////////////////////////
$id = $_GET['id'];
///////////////////////////////////////////////////////////////////////////////////////


/////////////////////// Opciones pagina ///////////////////////////////////////////////
$singular = "Ingresos Anuales";

$plural = "Ingresos Anuales";

$eliminar = "eliminarIngresosanuales";

$insertar = "insertarIngresosanuales";

$tituloWeb = "Gestión: Declaraciones Patrimoniales";
//////////////////////// Fin opciones ////////////////////////////////////////////////


/////////////////////// Opciones para la creacion del formulario  /////////////////////
$tabla 			= "dbingresosanuales";

$lblCambio	 	= array('refdeclaracionjuradacabecera',
						'remuneracionanualneta',
						'actividadindustrial',
						'razonsocialactividadindustrial',
						'actividadfinanciera',
						'razonsocialactividadfinanciera',
						'actividadprofesional',
						'descripcionactividadprofesional',
						'otros',
						'especifiqueotros',
						'ingresoanualconyuge',
						'especifiqueingresosconyuge',
						'fueservidorpublico',
						'vigenciadesde',
						'vigenciahasta');
$lblreemplazo	= array('Declaracion Pat. Cabecera',
						'I Remuneración Anual neta del declarante por su cargo público',
						'II.1 Por actividad indutrial y/o comercial',
						'II.1 Especifique el nombre o razon social',
						'II.2 Por actividad financiera',
						'II.2 Especifique',
						'II.3 Por servicios profesionales, participación en consejos, consultorias o asesorias',
						'II.3 Especifique servicio y contratante',
						'II.4 Otros',
						'II.4 Especifique',
						'B_ Ingresos Anual del conyuge concubina o concubinario y/o dependientes económicos',
						'B_ Especifique',
						'¿Te desempeñaste como servidor público federal obligado a presentar Declaracion Patrimonial en el año inmediato anterior?',
						'Desde',
						'Hasta');


$resVar1 = $serviciosReferencias->traerDeclaracionjuradacabeceraPorId($id);
$cadRef = $serviciosFunciones->devolverSelectBoxObligatorio($resVar1,array(2,3,4),' ');

$refdescripcion = array(0 => $cadRef);
$refCampo 	=  array("refdeclaracionjuradacabecera"); 
//////////////////////////////////////////////  FIN de los opciones //////////////////////////




/////////////////////// Opciones para la creacion del view  apellido,nombre,nrodocumento,fechanacimiento,direccion,telefono,email/////////////////////
$cabeceras 		= "	<th>Declaracion Pat. Cabecera</th>
					<th>Rem. Anual</th>
					<th>Rem. Anual Neto</th>
					<th>Rem. Anual Conyuge Neto</th>
					<th>Total Ingresos</th>
					<th>Fue servidor publico?</th>
					<th>Desde</th>
					<th>Hasta</th>";

//////////////////////////////////////////////  FIN de los opciones //////////////////////////




$formulario 	= $serviciosFunciones->camposTabla($insertar ,$tabla,$lblCambio,$lblreemplazo,$refdescripcion,$refCampo);

$lstCargados 	= $serviciosFunciones->camposTablaView($cabeceras,$serviciosReferencias->traerIngresosanualesGrilla(),8);

$frmIngresosAnuales = $serviciosReferencias->traerIngresosanualesPorCabeceraCURP($id, $_SESSION['curp_predio']);


if ($_SESSION['refroll_predio'] != 1) {

} else {

	
}


?>

<!DOCTYPE HTML>
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">



<title><?php echo $tituloWeb; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">


<link href="../../css/estiloDash.css" rel="stylesheet" type="text/css">
    

    
    <script type="text/javascript" src="../../js/jquery-1.8.3.min.js"></script>
    <link rel="stylesheet" href="../../css/jquery-ui.css">

    <script src="../../js/jquery-ui.js"></script>
    
	<!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css"/>
	
    <!-- Latest compiled and minified JavaScript -->
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="../../css/bootstrap-datetimepicker.min.css">

	<script src="../../js/jquery.number.min.js"></script>
	
    
   
   <link href="../../css/perfect-scrollbar.css" rel="stylesheet">
      <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
      <script src="../../js/jquery.mousewheel.js"></script>
      <script src="../../js/perfect-scrollbar.js"></script>
      <script>
      jQuery(document).ready(function ($) {
        "use strict";
        $('#navigation').perfectScrollbar();
      });
    </script>
    
 
</head>

<body>

 <?php echo $resMenu; ?>

<div id="content">

<h3><?php echo $plural; ?></h3>

    <div class="boxInfoLargo">
        <div id="headBoxInfo">
        	<p style="color: #fff; font-size:18px; height:16px;">Carga de <?php echo $plural; ?></p>
        	
        </div>
    	<div class="cuerpoBox">
        	<form class="form-inline formulario" role="form">
        	<div class="row">
				<?php echo $formulario; ?>
				<div class="row" style="padding: 10px 20px;">
					<div class="col-md-6">
						<div class="input-group col-md-12 col-xs-12">
							<span class="input-group-addon">SubTotal II  $</span>
							<input type="text" class="form-control" id="netoii" name="netoii" value="0" readonly />
						</div>
					</div>
					<div class="col-md-6">
						<div class="input-group col-md-12 col-xs-12">
							<span class="input-group-addon">A = Suma subTotal I + SubTotal II  $</span>
							<input type="text" class="form-control" id="neto" name="neto" value="0" readonly />
						</div>
					</div>
				</div>
				<div class="row" style="padding: 0 20px;">
					<div class="col-md-6">
						<div class="input-group col-md-12 col-xs-12">
							<span class="input-group-addon">Suma de A + B  $</span>
							<input type="text" class="form-control" id="total" name="total" value="0" readonly />
						</div>
					</div>
					
				</div>
            </div>
            <!--
            <div class="row">
            	<div id="map" ></div>

            </div>
            -->
            <div class='row' style="margin-left:25px; margin-right:25px;">
                <div class='alert'>
                
                </div>
                <div id='load'>
                
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                <ul class="list-inline" style="margin-top:15px;">

                	<?php
						if (mysql_num_rows($frmIngresosAnuales) > 0) {
					?>

                    <li>
                        <button type="button" class="btn btn-default volver" style="margin-left:0px;">Volver</button>
                    </li>
                    <?php
						} else {
					?>
					<li>
                        <button type="button" class="btn btn-primary" id="cargar" style="margin-left:0px;">Guardar</button>
                    </li>
                    <li>
                        <button type="button" class="btn btn-default volver" style="margin-left:0px;">Volver</button>
                    </li>
					<?php
						}
					?>
                    
                </ul>
                </div>
            </div>
            </form>
    	</div>
    </div>
    
    <div class="boxInfoLargo">
        <div id="headBoxInfo">
        	<p style="color: #fff; font-size:18px; height:16px;"><?php echo $plural; ?> Cargados</p>
        	
        </div>
    	<div class="cuerpoBox">
        	<?php echo $lstCargados; ?>
    	</div>
    </div>
    
    

    
    
   
</div>


</div>
<div id="dialog2" title="Eliminar <?php echo $singular; ?>">
    	<p>
        	<span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>
            ¿Esta seguro que desea eliminar el <?php echo $singular; ?>?.<span id="proveedorEli"></span>
        </p>
        <p><strong>Importante: </strong>Si elimina el <?php echo $singular; ?> se perderan todos los datos de este</p>
        <input type="hidden" value="" id="idEliminar" name="idEliminar">
</div>
<script type="text/javascript" src="../../js/jquery.dataTables.min.js"></script>
<script src="../../bootstrap/js/dataTables.bootstrap.js"></script>

<script src="../../js/bootstrap-datetimepicker.min.js"></script>
<script src="../../js/bootstrap-datetimepicker.es.js"></script>

<script type="text/javascript">
$(document).ready(function(){


	$('.volver').click(function(event){
		 
		url = "../ver.php?id=<?php echo $id; ?>";
		$(location).attr('href',url);
	});//fin del boton modificar

	<?php echo $serviciosFunciones->teclasAceptadas(); ?>

	
	$('#example').dataTable({
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

	$('#remuneracionanualneta').number( true, 2,'.','' );
	$('#ingresoanualconyuge').number( true, 2,'.','' );
	$('#actividadindustrial').number( true, 2,'.','' );
	$('#actividadfinanciera').number( true, 2,'.','' );
	$('#actividadprofesional').number( true, 2,'.','' );
	$('#otros').number( true, 2,'.','' );

	function sumaII(industrial, financiera, profesional, otros) {
		$('#netoii').val(parseFloat(industrial) + parseFloat(financiera) + parseFloat(profesional) + parseFloat(otros));
		sumaIII($('#remuneracionanualneta').val());
		sumaTotal();
	}

	function sumaIII(remuneracion) {
		$('#neto').val(parseFloat(remuneracion) + parseFloat($('#netoii').val()) );
		sumaTotal();
	}

	function sumaTotal() {
		$('#total').val(parseFloat($('#neto').val()) + parseFloat($('#ingresoanualconyuge').val()));
	}


	$('#ingresoanualconyuge').change(function() {
		if ($(this).val() == '') {
			$(this).val('0');
		}
		sumaTotal();
	});

	$('#actividadindustrial').change(function() {
		if ($(this).val() == '') {
			$(this).val('0');
		}
		sumaII($('#actividadindustrial').val(), $('#actividadfinanciera').val(), $('#actividadprofesional').val(), $('#otros').val());
		
	});

	$('#actividadfinanciera').change(function() {
		if ($(this).val() == '') {
			$(this).val('0');
		}
		sumaII($('#actividadindustrial').val(), $('#actividadfinanciera').val(), $('#actividadprofesional').val(), $('#otros').val());
		
	});

	$('#actividadprofesional').change(function() {
		if ($(this).val() == '') {
			$(this).val('0');
		}
		sumaII($('#actividadindustrial').val(), $('#actividadfinanciera').val(), $('#actividadprofesional').val(), $('#otros').val());
		
	});

	$('#otros').change(function() {
		if ($(this).val() == '') {
			$(this).val('0');
		}
		sumaII($('#actividadindustrial').val(), $('#actividadfinanciera').val(), $('#actividadprofesional').val(), $('#otros').val());
		
	});

	$('#remuneracionanualneta').change(function() {
		if ($(this).val() == '') {
			$(this).val('0');
		}
		sumaIII($('#remuneracionanualneta').val());
	});
	
	$("#example").on("click",'.varmodificar', function(){
		  usersid =  $(this).attr("id");
		  if (!isNaN(usersid)) {
			
			url = "modificar.php?id=" + usersid;
			$(location).attr('href',url);
		  } else {
			alert("Error, vuelva a realizar la acción.");	
		  }
	});//fin del boton modificar


	$("#example").on("click",'.vararchivos', function(){
		  usersid =  $(this).attr("id");
		  if (!isNaN(usersid)) {
			
			url = "archivos.php?id=" + usersid;
			$(location).attr('href',url);
		  } else {
			alert("Error, vuelva a realizar la acción.");	
		  }
	});//fin del boton archivos

	 $( "#dialog2" ).dialog({
		 	
			    autoOpen: false,
			 	resizable: false,
				width:600,
				height:240,
				modal: true,
				buttons: {
				    "Eliminar": function() {
	
						$.ajax({
									data:  {id: $('#idEliminar').val(), accion: '<?php echo $eliminar; ?>'},
									url:   '../../ajax/ajax.php',
									type:  'post',
									beforeSend: function () {
											
									},
									success:  function (response) {
											url = "index.php?id=<?php echo $id; ?>";
											$(location).attr('href',url);
											
									}
							});
						$( this ).dialog( "close" );
						$( this ).dialog( "close" );
							$('html, body').animate({
	           					scrollTop: '1000px'
	       					},
	       					1500);
				    },
				    Cancelar: function() {
						$( this ).dialog( "close" );
				    }
				}
		 
		 
	 		}); //fin del dialogo para eliminar
			
	<?php 
		echo $serviciosHTML->validacion($tabla);
	
	?>
	

	
	
	//al enviar el formulario
    $('#cargar').click(function(){
		
		if (validador() == "")
        {
			//información del formulario
			var formData = new FormData($(".formulario")[0]);
			var message = "";
			//hacemos la petición ajax  
			$.ajax({
				url: '../../ajax/ajax.php',  
				type: 'POST',
				// Form data
				//datos del formulario
				data: formData,
				//necesario para subir archivos via ajax
				cache: false,
				contentType: false,
				processData: false,
				//mientras enviamos el archivo
				beforeSend: function(){
					$("#load").html('<img src="../../imagenes/load13.gif" width="50" height="50" />'); 
					$('#cargar').hide();       
				},
				//una vez finalizado correctamente
				success: function(data){

					if (data == '') {
                                            $(".alert").removeClass("alert-danger");
											$(".alert").removeClass("alert-info");
                                            $(".alert").addClass("alert-success");
                                            $(".alert").html('<strong>Ok!</strong> Se cargo exitosamente el <strong><?php echo $singular; ?></strong>. ');
											$(".alert").delay(3000).queue(function(){
												/*aca lo que quiero hacer 
												  después de los 2 segundos de retraso*/
												$(this).dequeue(); //continúo con el siguiente ítem en la cola
												
											});
											$("#load").html('');
											//url = "index.php";
											//$(location).attr('href',url);
                                            
											
                                        } else {
                                        	$(".alert").removeClass("alert-danger");
                                            $(".alert").addClass("alert-danger");
                                            $(".alert").html('<strong>Error!</strong> '+data);
                                            $("#load").html('');
                                        }
				},
				//si ha ocurrido un error
				error: function(){
					$(".alert").html('<strong>Error!</strong> Actualice la pagina');
                    $("#load").html('');
				}
			});
		}
    });

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
<?php } ?>
</body>
</html>
