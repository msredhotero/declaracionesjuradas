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

$id = $_GET['id'];


$frmDeclaracionAnual = $serviciosReferencias->traerDeclaracionanualinteresPorCabeceraCURP($id, $_SESSION['curp_predio']);
$frmDependientesEconomicos = $serviciosReferencias->traerDependienteseconomicosPorCabeceraCURP($id, $_SESSION['curp_predio']);
$frmIngresosAnuales = $serviciosReferencias->traerIngresosanualesPorCabeceraCURP($id, $_SESSION['curp_predio']);
$frmPublicacion = $serviciosReferencias->traerPublicacionPorCabeceraCURP($id, $_SESSION['curp_predio']);
$frmBienesInmuebles = $serviciosReferencias->traerBienesinmueblesPorCabeceraCURP($id, $_SESSION['curp_predio']);
$frmBienesMuebles = $serviciosReferencias->traerBienesmueblesPorCabeceraCURP($id, $_SESSION['curp_predio']);
$frmInversiones = $serviciosReferencias->traerInversionesPorCabeceraCURP($id, $_SESSION['curp_predio']);
$frmVehiculos = $serviciosReferencias->traerVehiculosPorCabeceraCURP($id, $_SESSION['curp_predio']);
$frmAdeudos = $serviciosReferencias->traerAdeudosPorCabeceraCURP($id, $_SESSION['curp_predio']);

$frmRecursos = $serviciosReferencias->traerRecursosPorCabeceraCURP($id, $_SESSION['curp_predio']);
$frmDecrementos = $serviciosReferencias->traerDecrementosPorCabeceraCURP($id, $_SESSION['curp_predio']);
$frmObservaciones = $serviciosReferencias->traerObservacionesPorCabeceraCURP($id, $_SESSION['curp_predio']);


$resResultado = $serviciosReferencias->traerDeclaracionjuradacabeceraPorId($id);

$tabla 			= "dbdeclaracionjuradacabecera";

$lblCambio	 	= array('fecharecepcion',
						'primerapellido',
						'segundoapellido',
						'curp',
						'homoclave',
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
						'refusuarios');
$lblreemplazo	= array('Fecha de Recepción',
						'Primer Apellido',
						'Segundo Apellido',
						'CURP',
						'RFC / Homoclave',
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
						'Usuario');


$resEstadoCivil = $serviciosReferencias->traerEstadocivilPorId(mysql_result($resResultado,0,'refestadocivil'));
$cadRef = $serviciosFunciones->devolverSelectBoxActivo($resEstadoCivil,array(1),'', mysql_result($resResultado,0,'refestadocivil'));

$refRM = $serviciosReferencias->traerRegimenmatrimonialPorId(mysql_result($resResultado,0,'refregimenmatrimonial'));
$cadRef2 = $serviciosFunciones->devolverSelectBoxActivo($refRM,array(1),' ', mysql_result($resResultado,0,'refregimenmatrimonial'));

$refUsuarios = $serviciosReferencias->traerUsuariosPorId(mysql_result($resResultado,0,'refusuarios'));
$cadRef3 = $serviciosFunciones->devolverSelectBoxActivo($refUsuarios,array(1),' ', mysql_result($resResultado,0,'refusuarios'));

if (mysql_result($resResultado,0,'lugarubica') == '1') {
	$cadRef4 = "<option value='1' selected>México</option>";
} else {
	$cadRef4 = "<option value='2' selected>Extranjero</option>";
}

if (mysql_result($resResultado,0,'sexo') == '1') {
	$cadRef5 = "<option value='1' selected>Femenino</option>";
} else {
	$cadRef5 = "<option value='2' selected>Masculino</option>";
}



$refdescripcion = array(0 => $cadRef, 1=>$cadRef2, 2=>$cadRef3,3=>$cadRef4,4=>$cadRef5);
$refCampo 	=  array("refestadocivil","refregimenmatrimonial","refusuarios","lugarubica","sexo");

$frmDeclaracionCabecera = $serviciosFunciones->camposTablaVer($id, 'iddeclaracionjuradacabecera',$tabla,$lblCambio,$lblreemplazo,$refdescripcion,$refCampo);

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
        	<p style="color: #fff; font-size:18px; height:16px;">Declaración Patrimonial Cabecera</p>

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
                

	            <div class="cuerpoBox">
	            	<div class="row">
	            		<?php echo $frmDeclaracionCabecera; ?>
	            	</div>
	            	<div class="row">
	            		
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
									
									<?php
										if (mysql_num_rows($frmDeclaracionAnual) > 0) {
									?>
									<a href="declaracionanual/modificar.php?id=<?php echo $id; ?>">Acceder</a>
									<a class="btn-floating halfway-fab waves-effect waves-light green accent-4"><i class="material-icons">check</i></a>
									<?php
										} else {
									?>
									<a class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons">clear</i></a>
									<a href="declaracionanual/index.php?id=<?php echo $id; ?>">Acceder</a>
									
									<?php
										}
									?>
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
	
									<?php
										if (mysql_num_rows($frmPublicacion) > 0) {
									?>
									<a href="publicacion/modificar.php?id=<?php echo $id; ?>">Acceder</a>
									<a class="btn-floating halfway-fab waves-effect waves-light green accent-4"><i class="material-icons">check</i></a>
									<?php
										} else {
									?>
									<a class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons">clear</i></a>
									<a href="publicacion/index.php?id=<?php echo $id; ?>">Acceder</a>
									
									<?php
										}
									?>
								</div>
							</div>
						</div>


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
									
									<?php
										if (mysql_num_rows($frmIngresosAnuales) > 0) {
									?>
									<a href="ingresosanuales/modificar.php?id=<?php echo $id; ?>">Acceder</a>
									<a class="btn-floating halfway-fab waves-effect waves-light green accent-4"><i class="material-icons">check</i></a>
									<?php
										} else {
									?>
									<a class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons">clear</i></a>
									<a href="ingresosanuales/index.php?id=<?php echo $id; ?>">Acceder</a>
									
									<?php
										}
									?>
								</div>
							</div>
						</div>
					</div>




					<div class="row">
						

						<div class="col s12 m4">
							<div class="card light-blue darken-4">
								<div class="card-content white-text">
									<span class="card-title">DEPENDIENTES ECONOMICOS</span>
									<p>En caso de tener dependientes económicos, deberá anotar sus datos en esta sección.</p>
								</div>
								<div class="card-action">
									
									<?php
										if (mysql_num_rows($frmDependientesEconomicos) > 0) {
									?>
									<a href="dependienteseconomicos/index.php?id=<?php echo $id; ?>">Acceder</a>
									<a class="btn-floating halfway-fab waves-effect waves-light green accent-4"><i class="material-icons">check</i></a>
									<?php
										} else {
									?>
									<a class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons">clear</i></a>
									<a href="dependienteseconomicos/index.php?id=<?php echo $id; ?>">Acceder</a>
									
									<?php
										}
									?>
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

									<?php
										if (mysql_num_rows($frmBienesMuebles) > 0) {
									?>
									<a href="bienesmuebles/index.php?id=<?php echo $id; ?>">Acceder</a>
									<a class="btn-floating halfway-fab waves-effect waves-light green accent-4"><i class="material-icons">check</i></a>
									<?php
										} else {
									?>
									<a class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons">clear</i></a>
									<a href="bienesmuebles/index.php?id=<?php echo $id; ?>">Acceder</a>
									
									<?php
										}
									?>
								</div>
							</div>
						</div>


						<div class="col s12 m4">
							<div class="card teal lighten-2 darken-1">
								<div class="card-content white-text">
									<span class="card-title">VEHICULOS</span>
									<p>Anote la clave de operación referente al vehículo, si se trata de otro tipo de transporte como
avión, tractor, etc. deberá especificarlo también en esta sección.</p>
								</div>
								<div class="card-action">

									<?php
										if (mysql_num_rows($frmVehiculos) > 0) {
									?>
									<a href="vehiculos/index.php?id=<?php echo $id; ?>">Acceder</a>
									<a class="btn-floating halfway-fab waves-effect waves-light green accent-4"><i class="material-icons">check</i></a>
									<?php
										} else {
									?>
									<a class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons">clear</i></a>
									<a href="vehiculos/index.php?id=<?php echo $id; ?>">Acceder</a>
									
									<?php
										}
									?>
								</div>
							</div>
						</div>
					</div>



					<div class="row">
						

						<div class="col s12 m4">
							<div class="card teal lighten-2 darken-1">
								<div class="card-content white-text">
									<span class="card-title">BIENES INMUEBLES</span>
									<p>Anote la clave que corresponda al tipo de inmueble con el que cuenta. IMPORTANTE anotar
el registro que se tenga ante el Registro Público de la Propiedad. En caso de terrenos
ejidales, deberá señalar en el mismo espacio la sesión de derechos correspondiente.</p>
								</div>
								<div class="card-action">
									<?php
									if (mysql_num_rows($frmBienesInmuebles) > 0) {
									?>
									<a href="bienesinmuebles/index.php?id=<?php echo $id; ?>">Acceder</a>
									<a class="btn-floating halfway-fab waves-effect waves-light green accent-4"><i class="material-icons">check</i></a>
									<?php
										} else {
									?>
									<a class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons">clear</i></a>
									<a href="bienesinmuebles/index.php?id=<?php echo $id; ?>">Acceder</a>
									
									<?php
										}
									?>
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

									<?php
									if (mysql_num_rows($frmBienesInmuebles) > 0) {
									?>
									<a href="inversiones/index.php?id=<?php echo $id; ?>">Acceder</a>
									<a class="btn-floating halfway-fab waves-effect waves-light green accent-4"><i class="material-icons">check</i></a>
									<?php
										} else {
									?>
									<a class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons">clear</i></a>
									<a href="inversiones/index.php?id=<?php echo $id; ?>">Acceder</a>
									
									<?php
										}
									?>
								</div>
							</div>
						</div>


						<div class="col s12 m4">
							<div class="card teal lighten-2 darken-1">
								<div class="card-content white-text">
									<span class="card-title">ADEUDOS</span>
									<p>Anotará la clave del tipo de gravamen o adeudo que tenga al momento de la presentación de
esta Declaración Patrimonial.
Si el adeudo es con una persona particular, deberá anotar en el espacio de “Institución o
Acreedor” el nombre completo de esa persona.</p>
								</div>
								<div class="card-action">

									<?php
									if (mysql_num_rows($frmAdeudos) > 0) {
									?>
									<a href="adeudos/index.php?id=<?php echo $id; ?>">Acceder</a>
									<a class="btn-floating halfway-fab waves-effect waves-light green accent-4"><i class="material-icons">check</i></a>
									<?php
										} else {
									?>
									<a class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons">clear</i></a>
									<a href="adeudos/index.php?id=<?php echo $id; ?>">Acceder</a>
									
									<?php
										}
									?>
								</div>
							</div>
						</div>

						

					</div>




					<div class="row">
						

						<div class="col s12 m4">
							<div class="card teal lighten-2 darken-1">
								<div class="card-content white-text">
									<span class="card-title">APLICACION DE RECURSOS</span>
									<p>Anote solo las cantidades correspondientes.</p>
								</div>
								<div class="card-action">
									<?php
									if (mysql_num_rows($frmRecursos) > 0) {
									?>
									<a href="recursos/modificar.php?id=<?php echo $id; ?>">Acceder</a>
									<a class="btn-floating halfway-fab waves-effect waves-light green accent-4"><i class="material-icons">check</i></a>
									<?php
										} else {
									?>
									<a class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons">clear</i></a>
									<a href="recursos/index.php?id=<?php echo $id; ?>">Acceder</a>
									
									<?php
										}
									?>
								</div>
							</div>
						</div>


						<div class="col s12 m4">
							<div class="card teal lighten-2 darken-1">
								<div class="card-content white-text">
									<span class="card-title">DECREMENTOS</span>
									<p>Anote solo las cantidades correspondientes.</p>
								</div>
								<div class="card-action">

									<?php
									if (mysql_num_rows($frmDecrementos) > 0) {
									?>
									<a href="decrementos/modificar.php?id=<?php echo $id; ?>">Acceder</a>
									<a class="btn-floating halfway-fab waves-effect waves-light green accent-4"><i class="material-icons">check</i></a>
									<?php
										} else {
									?>
									<a class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons">clear</i></a>
									<a href="decrementos/index.php?id=<?php echo $id; ?>">Acceder</a>
									
									<?php
										}
									?>
								</div>
							</div>
						</div>


						<div class="col s12 m4">
							<div class="card teal lighten-2 darken-1">
								<div class="card-content white-text">
									<span class="card-title">OBSERVACIONES</span>
									<p>Si requiere hacer alguna anotación especial o aclaración, esta la podrá realizar en esta
sección.</p>
								</div>
								<div class="card-action">

									<?php
									if (mysql_num_rows($frmObservaciones) > 0) {
									?>
									<a href="observaciones/modificar.php?id=<?php echo $id; ?>">Acceder</a>
									<a class="btn-floating halfway-fab waves-effect waves-light green accent-4"><i class="material-icons">check</i></a>
									<?php
										} else {
									?>
									<a class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons">clear</i></a>
									<a href="observaciones/index.php?id=<?php echo $id; ?>">Acceder</a>
									
									<?php
										}
									?>
								</div>
							</div>
						</div>

						

					</div>
					
                </div>

                <?php } ?>
        	</div>

            </div>


            <div class="row">
                <div class="col-md-12">
                <ul class="list-inline" style="margin-top:15px;">

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

	$('.volver').click(function(event){
		 
		url = "index.php";
		$(location).attr('href',url);
	});//fin del boton modificar


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

	$('.agregarddpp').click(function() {

		url = "declaracionpatrimonial/index.php";
		$(location).attr('href',url);

	})

	


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
