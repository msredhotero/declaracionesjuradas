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

$serviciosFunciones = new Servicios();
$serviciosUsuario 	= new ServiciosUsuarios();
$serviciosHTML 		= new ServiciosHTML();
$serviciosReferencias 	= new ServiciosReferencias();

$fecha = date('Y-m-d');

//$resProductos = $serviciosProductos->traerProductosLimite(6);
$resMenu = $serviciosHTML->menu(utf8_encode($_SESSION['nombre_predio']),"Declaracion Patrimonial",$_SESSION['refroll_predio'],'');


$id = $_GET['id'];

if ($_SESSION['idroll_predio'] != 1) {
	$resResultado = $serviciosReferencias->traerDeclaracionjuradacabeceraPorIdCURP($id, $_SESSION['curp_predio']);
} else {
	$resResultado = $serviciosReferencias->traerDeclaracionjuradacabeceraPorId($id);
}

/////////////////////// Opciones pagina ///////////////////////////////////////////////
$singular = "Declaracion Patrimonial";

$plural = "Declaraciones Patrimoniales";

$eliminar = "eliminarDeclaracionjuradacabecera";

$modificar = "modificarDeclaracionjuradacabecera";

$idTabla = "iddeclaracionjuradacabecera";

$tituloWeb = "Gestión: Declaraciones Patrimoniales";
//////////////////////// Fin opciones ////////////////////////////////////////////////


/////////////////////// Opciones para la creacion del formulario  /////////////////////
$tabla 			= "dbdeclaracionjuradacabecera";

$lblCambio	 	= array('fecharecepcion',
						'primerapellido',
						'segundoapellido',
						'curp',
						'homoclave',
						'rfc',
						'emailinstitucional',
						'emailalterno',
						'refestadocivil',
						'refregimenmatrimonial',
						'paisnacimiento',
						'nacionalidad',
						'entidadnacimiento',
						'numerocelular',
						'lugarubica',
						'domicilioparticular',
						'localidad',
						'municipio',
						'telefono',
						'entidadfederativa',
						'codigopostal',
						'estudios',
						'cedulaprofesional',
						'refusuarios'
						,"refestados",
						"fechanacimiento");
$lblreemplazo	= array('Fecha de Recepción',
						'Primer Apellido',
						'Segundo Apellido',
						'CURP',
						'Homoclave',
						'RFC',
						'Correo Electrónico Inst.',
						'Correo Electrónico Alterno',
						'Estado Civil',
						'Regimen Matrimonial',
						'País donde nació',
						'Nacionalidad',
						'Entidad donde nació',
						'Nro de Celular',
						'Lugar donde se ubica',
						'Domicilio Particular',
						'Localidad o colonia',
						'Municipio o Alcaldía',
						'Teléfono',
						'Entidad Federativa',
						'Codigo Postal',
						'Grado Max. de estudios/Especialidad',
						'Nro de cédula profesional',
						'Usuario',
						'Estados',
						'Fecha de Nacimiento');


$resEstadoCivil = $serviciosReferencias->traerEstadocivil();
$cadRef = $serviciosFunciones->devolverSelectBoxActivo($resEstadoCivil,array(1),'', mysql_result($resResultado,0,'refestadocivil'));

$refRM = $serviciosReferencias->traerRegimenmatrimonial();
$cadRef2 = $serviciosFunciones->devolverSelectBoxActivo($refRM,array(1),' ', mysql_result($resResultado,0,'refregimenmatrimonial'));

$refUsuarios = $serviciosReferencias->traerUsuarios();
$cadRef3 = $serviciosFunciones->devolverSelectBoxActivo($refUsuarios,array(1),' ', mysql_result($resResultado,0,'refusuarios'));

if (mysql_result($resResultado,0,'lugarubica') == '1') {
	$cadRef4 = "<option value='1' selected>México</option><option value='2'>Extranjero</option>";
} else {
	$cadRef4 = "<option value='1'>México</option><option value='2' selected>Extranjero</option>";
}

if (mysql_result($resResultado,0,'sexo') == '1') {
	$cadRef5 = "<option value='1' selected>Femenino</option><option value='2'>Masculino</option>";
} else {
	$cadRef5 = "<option value='1'>Femenino</option><option value='2' selected>Masculino</option>";
}

$resEstado = $serviciosReferencias->traerEstadosPorId(mysql_result($resResultado,0,'refestados'));
$cadRef6 = $serviciosFunciones->devolverSelectBoxActivo($resEstado,array(1),'', mysql_result($resResultado,0,'refestados'));



$refdescripcion = array(0 => $cadRef, 1=>$cadRef2, 2=>$cadRef3,3=>$cadRef4,4=>$cadRef5,5=>$cadRef6);
$refCampo 	=  array("refestadocivil","refregimenmatrimonial","refusuarios","lugarubica","sexo","refestados"); 
//////////////////////////////////////////////  FIN de los opciones //////////////////////////


$formulario 	= $serviciosFunciones->camposTablaModificar($id, $idTabla, $modificar,$tabla,$lblCambio,$lblreemplazo,$refdescripcion,$refCampo);

$declaracionReal = $serviciosReferencias->traerAgenteReal($_SESSION['curp_predio']);

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
	<style type="text/css">
		
  
		
	</style>
    
   
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
        	<p style="color: #fff; font-size:18px; height:16px;">Modificar <?php echo $singular; ?></p>
        	
        </div>
    	<div class="cuerpoBox">
        	<form class="form-inline formulario" role="form">
        	
			<div class="row">
			<?php echo $formulario; ?>
            </div>
            
            
            <div class='row' style="margin-left:25px; margin-right:25px;">
                <div class='alert'>
                
                </div>
                <div id='load'>
                
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                <ul class="list-inline" style="margin-top:15px;">
                    <li>
                        <button type="button" class="btn btn-warning" id="cargar" style="margin-left:0px;">Modificar</button>
                    </li>
                    <li>
                        <button type="button" class="btn btn-danger varborrar" id="<?php echo $id; ?>" style="margin-left:0px;">Eliminar</button>
                    </li>
                    <li>
                        <button type="button" class="btn btn-default volver" style="margin-left:0px;">Volver</button>
                    </li>
                </ul>
                </div>
            </div>
            </form>
    	</div>
    </div>
    
    
   
</div>


</div>

<div id="dialog2" title="Eliminar <?php echo $singular; ?>">
    	<p>
        	<span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>
            ¿Esta seguro que desea eliminar el <?php echo $singular; ?>?.<span id="proveedorEli"></span>
        </p>
        <p><strong>Importante: </strong>Si elimina el equipo se perderan todos los datos de este</p>
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


	$('#primerapellido').val('<?php echo mysql_result($declaracionReal,0,'paterno'); ?>');
	$('#primerapellido').prop('readonly', true);

	$('#segundoapellido').val('<?php echo mysql_result($declaracionReal,0,'materno'); ?>');
	$('#segundoapellido').prop('readonly', true);

	$('#nombres').val('<?php echo mysql_result($declaracionReal,0,'nombre'); ?>');
	$('#nombres').prop('readonly', true);

	$('#curp').val('<?php echo mysql_result($declaracionReal,0,'curp'); ?>');
	$('#curp').prop('readonly', true);

	$('#rfc').val('<?php echo mysql_result($declaracionReal,0,'rfc'); ?>');
	$('#rfc').prop('readonly', true);

	$('#emailinstitucional').val('<?php echo mysql_result($declaracionReal,0,'email'); ?>');
	$('#emailinstitucional').prop('readonly', true);

	$('#numerocelular').val('<?php echo mysql_result($declaracionReal,0,'celular'); ?>');
	$('#numerocelular').prop('readonly', true);

	$('#domicilioparticular').val('<?php echo mysql_result($declaracionReal,0,'domicilio_particular'); ?>');
	$('#domicilioparticular').prop('readonly', true);

	

	function validarRFC(){
		
		//Almacenamos los valores
		nombre = $('#homoclave').val();
		
	   //Comprobamos la longitud de caracteres
		if (nombre.length==3){
			return true;
		}
		else {
			alert('La Homoclave debe tener 10 caracteres');
			return false;
			
		}

	}


	
	$('.varborrar').click(function(event){
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
											url = "index.php";
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
		if (validarRFC() == true) {
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
					},
					//una vez finalizado correctamente
					success: function(data){

						if (data == '') {
	                                            $(".alert").removeClass("alert-danger");
												$(".alert").removeClass("alert-info");
	                                            $(".alert").addClass("alert-success");
	                                            $(".alert").html('<strong>Ok!</strong> Se modifico exitosamente el <strong><?php echo $singular; ?></strong>. ');
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
