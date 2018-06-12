<?php

include ('../includes/funcionesUsuarios.php');
include ('../includes/funciones.php');
include ('../includes/funcionesHTML.php');
include ('../includes/funcionesReferencias.php');


$serviciosUsuarios  		= new ServiciosUsuarios();
$serviciosFunciones 		= new Servicios();
$serviciosHTML				= new ServiciosHTML();
$serviciosReferencias		= new ServiciosReferencias();


$accion = $_POST['accion'];


switch ($accion) {
    case 'login':
        enviarMail($serviciosUsuarios);
        break;
	case 'entrar':
		entrar($serviciosUsuarios);
		break;
	case 'insertarUsuario':
        insertarUsuarios($serviciosReferencias);
        break;
	case 'modificarUsuario':
        modificarUsuario($serviciosUsuarios);
        break;
	case 'registrar':
		registrar($serviciosUsuarios);
        break;
	case 'recuperar':
		recuperar($serviciosUsuarios);
		break;


case 'insertarUsuarios': 
insertarUsuarios($serviciosReferencias); 
break; 
case 'modificarUsuarios': 
modificarUsuarios($serviciosReferencias); 
break; 
case 'eliminarUsuarios': 
eliminarUsuarios($serviciosReferencias); 
break; 

case 'insertarDeclaracionjuradacabecera': 
insertarDeclaracionjuradacabecera($serviciosReferencias); 
break; 
case 'modificarDeclaracionjuradacabecera': 
modificarDeclaracionjuradacabecera($serviciosReferencias); 
break; 
case 'eliminarDeclaracionjuradacabecera': 
eliminarDeclaracionjuradacabecera($serviciosReferencias); 
break; 

case 'insertarEstadocivil': 
insertarEstadocivil($serviciosReferencias); 
break; 
case 'modificarEstadocivil': 
modificarEstadocivil($serviciosReferencias); 
break; 
case 'eliminarEstadocivil': 
eliminarEstadocivil($serviciosReferencias); 
break; 
case 'insertarRegimenmatrimonial': 
insertarRegimenmatrimonial($serviciosReferencias); 
break; 
case 'modificarRegimenmatrimonial': 
modificarRegimenmatrimonial($serviciosReferencias); 
break; 
case 'eliminarRegimenmatrimonial': 
eliminarRegimenmatrimonial($serviciosReferencias); 
break; 



case 'insertarArchivos': 
insertarArchivos($serviciosReferencias); 
break; 
case 'modificarArchivos': 
modificarArchivos($serviciosReferencias); 
break; 
case 'eliminarArchivos': 
eliminarArchivos($serviciosReferencias); 
break; 

case 'traerArchivosPorCliente':
	traerArchivosPorCliente($serviciosReferencias);
	break;

	case 'insertarDeclaracionanualinteres': 
		insertarDeclaracionanualinteres($serviciosReferencias); 
	break; 
	case 'modificarDeclaracionanualinteres': 
		modificarDeclaracionanualinteres($serviciosReferencias); 
	break; 
	case 'eliminarDeclaracionanualinteres': 
		eliminarDeclaracionanualinteres($serviciosReferencias); 
	break; 


	case 'insertarDependienteseconomicos': 
		insertarDependienteseconomicos($serviciosReferencias); 
	break; 
	case 'modificarDependienteseconomicos': 
		modificarDependienteseconomicos($serviciosReferencias); 
	break; 
	case 'eliminarDependienteseconomicos': 
		eliminarDependienteseconomicos($serviciosReferencias); 
	break; 
	case 'insertarIngresosanuales': 
		insertarIngresosanuales($serviciosReferencias); 
	break; 
	case 'modificarIngresosanuales': 
		modificarIngresosanuales($serviciosReferencias); 
	break; 
	case 'eliminarIngresosanuales': 
		eliminarIngresosanuales($serviciosReferencias); 
	break; 
	case 'insertarPublicacion': 
		insertarPublicacion($serviciosReferencias); 
	break; 
	case 'modificarPublicacion': 
		modificarPublicacion($serviciosReferencias); 
	break; 
	case 'eliminarPublicacion': 
		eliminarPublicacion($serviciosReferencias); 
	break; 


	case 'insertarPoder': 
		insertarPoder($serviciosReferencias); 
	break; 
	case 'modificarPoder': 
		modificarPoder($serviciosReferencias); 
	break; 
	case 'eliminarPoder': 
		eliminarPoder($serviciosReferencias); 
	break; 


	case 'insertarTipoparentesco': 
		insertarTipoparentesco($serviciosReferencias); 
	break; 
	case 'modificarTipoparentesco': 
		modificarTipoparentesco($serviciosReferencias); 
	break; 
	case 'eliminarTipoparentesco': 
		eliminarTipoparentesco($serviciosReferencias); 
	break; 

}

/* Fin */



	function insertarDeclaracionanualinteres($serviciosReferencias) { 
		$refdeclaracionjuradacabecera = $_POST['refdeclaracionjuradacabecera']; 
		
		if (isset($_POST['essecretario'])) { 
			$essecretario	= 1; 
		} else { 
			$essecretario = 0; 
		} 

		if (isset($_POST['esauditor'])) { 
			$esauditor	= 1; 
		} else { 
			$esauditor = 0; 
		} 

		$ejercicio = $_POST['ejercicio']; 
		
		if (isset($_POST['espublico'])) { 
			$espublico	= 1; 
		} else { 
			$espublico = 0; 
		} 

		$refpoder = $_POST['refpoder']; 
		$registrofederalcontribuyente = $_POST['registrofederalcontribuyente']; 
		$fechadeclaracionanterior = $_POST['fechadeclaracionanterior']; 
		$fechatomaposesion = $_POST['fechatomaposesion']; 
		$cargoactual = $_POST['cargoactual']; 
		$cargoanterior = $_POST['cargoanterior']; 
		$areaadquisicion = $_POST['areaadquisicion']; 
		$areaadquisicionanterior = $_POST['areaadquisicionanterior']; 
		$dependencia = $_POST['dependencia']; 
		$dependenciaanterior = $_POST['dependenciaanterior']; 
		
		$res = $serviciosReferencias->insertarDeclaracionanualinteres($refdeclaracionjuradacabecera,$essecretario,$esauditor,$ejercicio,$espublico,$refpoder,$registrofederalcontribuyente,$fechadeclaracionanterior,$fechatomaposesion,$cargoactual,$cargoanterior,$areaadquisicion,$areaadquisicionanterior,$dependencia,$dependenciaanterior); 
		
		if ((integer)$res > 0) { 
			echo ''; 
		} else { 
			echo 'Hubo un error al insertar datos';	 
		} 
	} 

	function modificarDeclaracionanualinteres($serviciosReferencias) { 
		$id = $_POST['id']; 
		$refdeclaracionjuradacabecera = $_POST['refdeclaracionjuradacabecera']; 
		
		if (isset($_POST['essecretario'])) { 
			$essecretario	= 1; 
		} else { 
			$essecretario = 0; 
		} 

		if (isset($_POST['esauditor'])) { 
			$esauditor	= 1; 
		} else { 
			$esauditor = 0; 
		} 

		$ejercicio = $_POST['ejercicio']; 
		
		if (isset($_POST['espublico'])) { 
			$espublico	= 1; 
		} else { 
			$espublico = 0; 
		} 

		$refpoder = $_POST['refpoder']; 
		$registrofederalcontribuyente = $_POST['registrofederalcontribuyente']; 
		$fechadeclaracionanterior = $_POST['fechadeclaracionanterior']; 
		$fechatomaposesion = $_POST['fechatomaposesion']; 
		$cargoactual = $_POST['cargoactual']; 
		$cargoanterior = $_POST['cargoanterior']; 
		$areaadquisicion = $_POST['areaadquisicion']; 
		$areaadquisicionanterior = $_POST['areaadquisicionanterior']; 
		$dependencia = $_POST['dependencia']; 
		$dependenciaanterior = $_POST['dependenciaanterior']; 
		
		$res = $serviciosReferencias->modificarDeclaracionanualinteres($id,$refdeclaracionjuradacabecera,$essecretario,$esauditor,$ejercicio,$espublico,$refpoder,$registrofederalcontribuyente,$fechadeclaracionanterior,$fechatomaposesion,$cargoactual,$cargoanterior,$areaadquisicion,$areaadquisicionanterior,$dependencia,$dependenciaanterior); 
		
		if ($res == true) { 
			echo ''; 
		} else { 
			echo 'Hubo un error al modificar datos'; 
		} 
	} 

	function eliminarDeclaracionanualinteres($serviciosReferencias) { 
		$id = $_POST['id']; 
		$res = $serviciosReferencias->eliminarDeclaracionanualinteres($id); 
		echo $res; 
	} 




	function insertarDependienteseconomicos($serviciosReferencias) { 
		$refdeclaracionjuradacabecera = $_POST['refdeclaracionjuradacabecera']; 
		if (isset($_POST['tiene'])) { 
		$tiene	= 1; 
		} else { 
		$tiene = 0; 
		} 
		$nombre = $_POST['nombre']; 
		$edad = $_POST['edad']; 
		$reftipoparentesco = $_POST['reftipoparentesco']; 
		$res = $serviciosReferencias->insertarDependienteseconomicos($refdeclaracionjuradacabecera,$tiene,$nombre,$edad,$reftipoparentesco); 
		if ((integer)$res > 0) { 
		echo ''; 
		} else { 
		echo 'Hubo un error al insertar datos';	 
		} 
	} 

	function modificarDependienteseconomicos($serviciosReferencias) { 
		$id = $_POST['id']; 
		$refdeclaracionjuradacabecera = $_POST['refdeclaracionjuradacabecera']; 
		if (isset($_POST['tiene'])) { 
		$tiene	= 1; 
		} else { 
		$tiene = 0; 
		} 
		$nombre = $_POST['nombre']; 
		$edad = $_POST['edad']; 
		$reftipoparentesco = $_POST['reftipoparentesco']; 
		$res = $serviciosReferencias->modificarDependienteseconomicos($id,$refdeclaracionjuradacabecera,$tiene,$nombre,$edad,$reftipoparentesco); 
		if ($res == true) { 
		echo ''; 
		} else { 
		echo 'Hubo un error al modificar datos'; 
		} 
	} 

	function eliminarDependienteseconomicos($serviciosReferencias) { 
		$id = $_POST['id']; 
		$res = $serviciosReferencias->eliminarDependienteseconomicos($id); 
		echo $res; 
	} 

	function insertarIngresosanuales($serviciosReferencias) { 
		$refdeclaracionjuradacabecera = $_POST['refdeclaracionjuradacabecera']; 
		$remuneracionanualneta = $_POST['remuneracionanualneta']; 
		$actividadindustrial = $_POST['actividadindustrial']; 
		$razonsocialactividadindustrial = $_POST['razonsocialactividadindustrial']; 
		$actividadfinanciera = $_POST['actividadfinanciera']; 
		$razonsocialactividadfinanciera = $_POST['razonsocialactividadfinanciera']; 
		$actividadprofesional = $_POST['actividadprofesional']; 
		$descripcionactividadprofesional = $_POST['descripcionactividadprofesional']; 
		$otros = $_POST['otros']; 
		$especifiqueotros = $_POST['especifiqueotros']; 
		$ingresoanualconyuge = $_POST['ingresoanualconyuge']; 
		$especifiqueingresosconyuge = $_POST['especifiqueingresosconyuge']; 
		if (isset($_POST['fueservidorpublico'])) { 
		$fueservidorpublico	= 1; 
		} else { 
		$fueservidorpublico = 0; 
		} 
		$vigenciadesde = $_POST['vigenciadesde']; 
		$vigenciahasta = $_POST['vigenciahasta']; 
		$res = $serviciosReferencias->insertarIngresosanuales($refdeclaracionjuradacabecera,$remuneracionanualneta,$actividadindustrial,$razonsocialactividadindustrial,$actividadfinanciera,$razonsocialactividadfinanciera,$actividadprofesional,$descripcionactividadprofesional,$otros,$especifiqueotros,$ingresoanualconyuge,$especifiqueingresosconyuge,$fueservidorpublico,$vigenciadesde,$vigenciahasta); 
		if ((integer)$res > 0) { 
		echo ''; 
		} else { 
		echo 'Hubo un error al insertar datos';	 
		} 
	} 

	function modificarIngresosanuales($serviciosReferencias) { 
		$id = $_POST['id']; 
		$refdeclaracionjuradacabecera = $_POST['refdeclaracionjuradacabecera']; 
		$remuneracionanualneta = $_POST['remuneracionanualneta']; 
		$actividadindustrial = $_POST['actividadindustrial']; 
		$razonsocialactividadindustrial = $_POST['razonsocialactividadindustrial']; 
		$actividadfinanciera = $_POST['actividadfinanciera']; 
		$razonsocialactividadfinanciera = $_POST['razonsocialactividadfinanciera']; 
		$actividadprofesional = $_POST['actividadprofesional']; 
		$descripcionactividadprofesional = $_POST['descripcionactividadprofesional']; 
		$otros = $_POST['otros']; 
		$especifiqueotros = $_POST['especifiqueotros']; 
		$ingresoanualconyuge = $_POST['ingresoanualconyuge']; 
		$especifiqueingresosconyuge = $_POST['especifiqueingresosconyuge']; 
		if (isset($_POST['fueservidorpublico'])) { 
		$fueservidorpublico	= 1; 
		} else { 
		$fueservidorpublico = 0; 
		} 
		$vigenciadesde = $_POST['vigenciadesde']; 
		$vigenciahasta = $_POST['vigenciahasta']; 
		$res = $serviciosReferencias->modificarIngresosanuales($id,$refdeclaracionjuradacabecera,$remuneracionanualneta,$actividadindustrial,$razonsocialactividadindustrial,$actividadfinanciera,$razonsocialactividadfinanciera,$actividadprofesional,$descripcionactividadprofesional,$otros,$especifiqueotros,$ingresoanualconyuge,$especifiqueingresosconyuge,$fueservidorpublico,$vigenciadesde,$vigenciahasta); 
		if ($res == true) { 
		echo ''; 
		} else { 
		echo 'Hubo un error al modificar datos'; 
		} 
	} 


	function eliminarIngresosanuales($serviciosReferencias) { 
		$id = $_POST['id']; 
		$res = $serviciosReferencias->eliminarIngresosanuales($id); 
		echo $res; 
	} 

	function insertarPublicacion($serviciosReferencias) { 
		$refdeclaracionjuradacabecera = $_POST['refdeclaracionjuradacabecera']; 
		if (isset($_POST['estadeacuerdo'])) { 
		$estadeacuerdo	= 1; 
		} else { 
		$estadeacuerdo = 0; 
		} 
		if (isset($_POST['eningresosnetos'])) { 
		$eningresosnetos	= 1; 
		} else { 
		$eningresosnetos = 0; 
		} 
		if (isset($_POST['enbienesinmuebles'])) { 
		$enbienesinmuebles	= 1; 
		} else { 
		$enbienesinmuebles = 0; 
		} 
		if (isset($_POST['enbienesmuebles'])) { 
		$enbienesmuebles	= 1; 
		} else { 
		$enbienesmuebles = 0; 
		} 
		if (isset($_POST['envehiculos'])) { 
		$envehiculos	= 1; 
		} else { 
		$envehiculos = 0; 
		} 
		if (isset($_POST['eninversiones'])) { 
		$eninversiones	= 1; 
		} else { 
		$eninversiones = 0; 
		} 
		if (isset($_POST['enadeudos'])) { 
		$enadeudos	= 1; 
		} else { 
		$enadeudos = 0; 
		} 
		$res = $serviciosReferencias->insertarPublicacion($refdeclaracionjuradacabecera,$estadeacuerdo,$eningresosnetos,$enbienesinmuebles,$enbienesmuebles,$envehiculos,$eninversiones,$enadeudos); 
		if ((integer)$res > 0) { 
		echo ''; 
		} else { 
		echo 'Hubo un error al insertar datos';	 
		} 
	} 

	function modificarPublicacion($serviciosReferencias) { 
		$id = $_POST['id']; 
		$refdeclaracionjuradacabecera = $_POST['refdeclaracionjuradacabecera']; 
		if (isset($_POST['estadeacuerdo'])) { 
		$estadeacuerdo	= 1; 
		} else { 
		$estadeacuerdo = 0; 
		} 
		if (isset($_POST['eningresosnetos'])) { 
		$eningresosnetos	= 1; 
		} else { 
		$eningresosnetos = 0; 
		} 
		if (isset($_POST['enbienesinmuebles'])) { 
		$enbienesinmuebles	= 1; 
		} else { 
		$enbienesinmuebles = 0; 
		} 
		if (isset($_POST['enbienesmuebles'])) { 
		$enbienesmuebles	= 1; 
		} else { 
		$enbienesmuebles = 0; 
		} 
		if (isset($_POST['envehiculos'])) { 
		$envehiculos	= 1; 
		} else { 
		$envehiculos = 0; 
		} 
		if (isset($_POST['eninversiones'])) { 
		$eninversiones	= 1; 
		} else { 
		$eninversiones = 0; 
		} 
		if (isset($_POST['enadeudos'])) { 
		$enadeudos	= 1; 
		} else { 
		$enadeudos = 0; 
		} 
		$res = $serviciosReferencias->modificarPublicacion($id,$refdeclaracionjuradacabecera,$estadeacuerdo,$eningresosnetos,$enbienesinmuebles,$enbienesmuebles,$envehiculos,$eninversiones,$enadeudos); 
		if ($res == true) { 
		echo ''; 
		} else { 
		echo 'Hubo un error al modificar datos'; 
		} 
	} 


	function eliminarPublicacion($serviciosReferencias) { 
		$id = $_POST['id']; 
		$res = $serviciosReferencias->eliminarPublicacion($id); 
		echo $res; 
	} 



	function insertarPoder($serviciosReferencias) { 
		$poder = $_POST['poder']; 
		$res = $serviciosReferencias->insertarPoder($poder); 
		if ((integer)$res > 0) { 
		echo ''; 
		} else { 
		echo 'Hubo un error al insertar datos';	 
		} 
	} 

	function modificarPoder($serviciosReferencias) { 
		$id = $_POST['id']; 
		$poder = $_POST['poder']; 
		$res = $serviciosReferencias->modificarPoder($id,$poder); 
		if ($res == true) { 
		echo ''; 
		} else { 
		echo 'Hubo un error al modificar datos'; 
		} 
	} 

	function eliminarPoder($serviciosReferencias) { 
		$id = $_POST['id']; 
		$res = $serviciosReferencias->eliminarPoder($id); 
		echo $res; 
	} 


	function insertarTipoparentesco($serviciosReferencias) { 
		$tipoparentesco = $_POST['tipoparentesco']; 
		$res = $serviciosReferencias->insertarTipoparentesco($tipoparentesco); 
		if ((integer)$res > 0) { 
		echo ''; 
		} else { 
		echo 'Hubo un error al insertar datos';	 
		} 
	} 

	function modificarTipoparentesco($serviciosReferencias) { 
		$id = $_POST['id']; 
		$tipoparentesco = $_POST['tipoparentesco']; 
		$res = $serviciosReferencias->modificarTipoparentesco($id,$tipoparentesco); 
		if ($res == true) { 
		echo ''; 
		} else { 
		echo 'Hubo un error al modificar datos'; 
		} 
	} 

	function eliminarTipoparentesco($serviciosReferencias) { 
		$id = $_POST['id']; 
		$res = $serviciosReferencias->eliminarTipoparentesco($id); 
		echo $res; 
	} 



function traerArchivosPorCliente($serviciosReferencias) {
	$id = $_POST['id'];

	$res = $serviciosReferencias->traerArchivosPorCliente($id);

	$cad3 = '';
	//////////////////////////////////////////////////////busquedajugadores/////////////////////
	$cad3 = $cad3.'
				<div class="col-md-12">
				<div class="panel panel-info">
                                <div class="panel-heading">
                                	<h3 class="panel-title">Archivos Encontrados</h3>
                                	
                                </div>
                                <div class="panel-body-predio" style="padding:5px 20px;">
                                	';
	$cad3 = $cad3.'
	<div class="row">
                	<table id="example" class="table table-responsive table-striped" style="font-size:1.2em; padding:2px;">
						<thead>
                        <tr>
                        	<th>Observacion</th>
                        	<th>Fecha Creación</th>
							<th>Descargar</th>
                        </tr>
						</thead>
						<tbody id="resultadosProd">';
	while ($rowJ = mysql_fetch_array($res)) {
		$cad3 .= '<tr>
					<td>'.($rowJ['observacion']).'</td>
					<td>'.($rowJ['fechacreacion']).'</td>
					<td><a href="descargar.php?token='.$rowJ['token'].'" target="_blank"><img src="../imagenes/download-2-icon.png" style="width:8%;"></a></td>
				 </tr>';
	}
	
	$cad3 = $cad3.'</tbody>
                                </table></div>
                            </div>
						</div>';
						
	echo $cad3;
}

function insertarArchivos($serviciosReferencias) { 
	$refclientes = $_POST['refclientes']; 
	$token = $_POST['token']; 
	//$imagen = $_POST['imagen'];  
	$observacion = $_POST['observacion']; 
	
	if ($_FILES['imagen']['tmp_name'] != '') {
		$res = $serviciosReferencias->subirArchivo('imagen',$refclientes,$serviciosReferencias->obtenerNuevoId('dbarchivos'),$token,$observacion); 
		
		if ($res == '') { 
			echo ''; 
		} else { 
			echo 'Hubo un error al insertar datos';	 
		} 
	} else {
		echo 'Debe seleccionar un archivo';	
	}
}


function modificarArchivos($serviciosReferencias) { 
	$id = $_POST['id']; 
	$refclientes = $_POST['refclientes']; 
	$token = $_POST['token']; 
	$imagen = $_POST['imagen']; 
	$type = $_POST['type']; 
	$observacion = $_POST['observacion']; 
	
	$res = $serviciosReferencias->modificarArchivos($id,$refclientes,$token,$imagen,$type,$observacion); 
	
	if ($res == true) { 
		echo ''; 
	} else { 
		echo 'Hubo un error al modificar datos'; 
	} 
} 


function eliminarArchivos($serviciosReferencias) { 
	$id = $_POST['id']; 
	$res = $serviciosReferencias->eliminarArchivos($id); 
	echo $res; 
} 


function insertarDeclaracionjuradacabecera($serviciosReferencias) { 
	$fecharecepcion = $_POST['fecharecepcion']; 
	$primerapellido = $_POST['primerapellido']; 
	$segundoapellido = $_POST['segundoapellido']; 
	$nombres = $_POST['nombres']; 
	$curp = $_POST['curp']; 
	$homoclave = $_POST['homoclave']; 
	$emailinstitucional = $_POST['emailinstitucional']; 
	$emailalterno = $_POST['emailalterno']; 
	$refestadocivil = $_POST['refestadocivil']; 
	$refregimenmatrimonial = $_POST['refregimenmatrimonial']; 
	$paisnacimiento = $_POST['paisnacimiento']; 
	$nacionalidad = $_POST['nacionalidad']; 
	$entidadnacimiento = $_POST['entidadnacimiento']; 
	$numerocelular = $_POST['numerocelular']; 
	$lugarubica = $_POST['lugarubica']; 
	$domicilioparticular = $_POST['domicilioparticular']; 
	$localidad = $_POST['localidad']; 
	$municipio = $_POST['municipio']; 
	$telefono = $_POST['telefono']; 
	$entidadfederativa = $_POST['entidadfederativa']; 
	$codigopostal = $_POST['codigopostal']; 
	$lada = $_POST['lada']; 
	$sexo = $_POST['sexo']; 
	$estudios = $_POST['estudios']; 
	$cedulaprofesional = $_POST['cedulaprofesional']; 
	$refusuarios = $_POST['refusuarios']; 
	
	$res = $serviciosReferencias->insertarDeclaracionjuradacabecera($fecharecepcion,$primerapellido,$segundoapellido,$nombres,$curp,$homoclave,$emailinstitucional,$emailalterno,$refestadocivil,$refregimenmatrimonial,$paisnacimiento,$nacionalidad,$entidadnacimiento,$numerocelular,$lugarubica,$domicilioparticular,$localidad,$municipio,$telefono,$entidadfederativa,$codigopostal,$lada,$sexo,$estudios,$cedulaprofesional,$refusuarios); 
	
	if ((integer)$res > 0) { 
		echo ''; 
	} else { 
		echo 'Hubo un error al insertar datos';	 
	} 
} 


function modificarDeclaracionjuradacabecera($serviciosReferencias) { 
	$id = $_POST['id']; 
	$fecharecepcion = $_POST['fecharecepcion']; 
	$primerapellido = $_POST['primerapellido']; 
	$segundoapellido = $_POST['segundoapellido']; 
	$nombres = $_POST['nombres']; 
	$curp = $_POST['curp']; 
	$homoclave = $_POST['homoclave']; 
	$emailinstitucional = $_POST['emailinstitucional']; 
	$emailalterno = $_POST['emailalterno']; 
	$refestadocivil = $_POST['refestadocivil']; 
	$refregimenmatrimonial = $_POST['refregimenmatrimonial']; 
	$paisnacimiento = $_POST['paisnacimiento']; 
	$nacionalidad = $_POST['nacionalidad']; 
	$entidadnacimiento = $_POST['entidadnacimiento']; 
	$numerocelular = $_POST['numerocelular']; 
	$lugarubica = $_POST['lugarubica']; 
	$domicilioparticular = $_POST['domicilioparticular']; 
	$localidad = $_POST['localidad']; 
	$municipio = $_POST['municipio']; 
	$telefono = $_POST['telefono']; 
	$entidadfederativa = $_POST['entidadfederativa']; 
	$codigopostal = $_POST['codigopostal']; 
	$lada = $_POST['lada']; 
	$sexo = $_POST['sexo']; 
	$estudios = $_POST['estudios']; 
	$cedulaprofesional = $_POST['cedulaprofesional']; 
	$refusuarios = $_POST['refusuarios']; 
	
	$res = $serviciosReferencias->modificarDeclaracionjuradacabecera($id,$fecharecepcion,$primerapellido,$segundoapellido,$nombres,$curp,$homoclave,$emailinstitucional,$emailalterno,$refestadocivil,$refregimenmatrimonial,$paisnacimiento,$nacionalidad,$entidadnacimiento,$numerocelular,$lugarubica,$domicilioparticular,$localidad,$municipio,$telefono,$entidadfederativa,$codigopostal,$lada,$sexo,$estudios,$cedulaprofesional,$refusuarios); 
	
	if ($res == true) { 
		echo ''; 
	} else { 
		echo 'Hubo un error al modificar datos'; 
	} 
} 


function eliminarDeclaracionjuradacabecera($serviciosReferencias) { 
	$id = $_POST['id']; 
	$res = $serviciosReferencias->eliminarDeclaracionjuradacabecera($id); 
	echo $res; 
} 







function insertarEstadocivil($serviciosReferencias) { 
$estadocivil = $_POST['estadocivil']; 
$res = $serviciosReferencias->insertarEstadocivil($estadocivil); 
if ((integer)$res > 0) { 
echo ''; 
} else { 
echo 'Hubo un error al insertar datos';	 
} 
} 
function modificarEstadocivil($serviciosReferencias) { 
$id = $_POST['id']; 
$estadocivil = $_POST['estadocivil']; 
$res = $serviciosReferencias->modificarEstadocivil($id,$estadocivil); 
if ($res == true) { 
echo ''; 
} else { 
echo 'Hubo un error al modificar datos'; 
} 
} 
function eliminarEstadocivil($serviciosReferencias) { 
$id = $_POST['id']; 
$res = $serviciosReferencias->eliminarEstadocivil($id); 
echo $res; 
} 
function insertarRegimenmatrimonial($serviciosReferencias) { 
$regimenmatrimonial = $_POST['regimenmatrimonial']; 
$res = $serviciosReferencias->insertarRegimenmatrimonial($regimenmatrimonial); 
if ((integer)$res > 0) { 
echo ''; 
} else { 
echo 'Hubo un error al insertar datos';	 
} 
} 
function modificarRegimenmatrimonial($serviciosReferencias) { 
$id = $_POST['id']; 
$regimenmatrimonial = $_POST['regimenmatrimonial']; 
$res = $serviciosReferencias->modificarRegimenmatrimonial($id,$regimenmatrimonial); 
if ($res == true) { 
echo ''; 
} else { 
echo 'Hubo un error al modificar datos'; 
} 
} 
function eliminarRegimenmatrimonial($serviciosReferencias) { 
$id = $_POST['id']; 
$res = $serviciosReferencias->eliminarRegimenmatrimonial($id); 
echo $res; 
} 



////////////////////////// FIN DE TRAER DATOS ////////////////////////////////////////////////////////////

//////////////////////////  BASICO  /////////////////////////////////////////////////////////////////////////

function toArray($query)
{
    $res = array();
    while ($row = @mysql_fetch_array($query)) {
        $res[] = $row;
    }
    return $res;
}


function entrar($serviciosUsuarios) {
	$email		=	$_POST['email'];
	$pass		=	$_POST['pass'];
	echo $serviciosUsuarios->loginUsuario($email,$pass);
}


function cambiarSede($serviciosUsuarios) {
	$sede		=	$_POST['sede'];

	echo $serviciosUsuarios->cambiarSede($sede);
}


function registrar($serviciosUsuarios) {
	$usuario			=	$_POST['usuario'];
	$password			=	$_POST['password'];
	$refroll			=	$_POST['refroll'];
	$email				=	$_POST['email'];
	$nombre				=	$_POST['nombrecompleto'];
	
	$res = $serviciosUsuarios->insertarUsuario($usuario,$password,$refroll,$email,$nombre);
	if ((integer)$res > 0) {
		echo '';	
	} else {
		echo $res;	
	}
}

function recuperar($serviciosUsuarios) {
	$email		=		$_POST['email'];
	
	$res		=	$serviciosUsuarios->recuperar($email);
	
	echo $res;
}


function insertarUsuarios($serviciosReferencias) { 
	$usuario = $_POST['usuario']; 
	$password = $_POST['password']; 
	$refroles = $_POST['refroles']; 
	$email = $_POST['email']; 
	$nombrecompleto = $_POST['nombrecompleto']; 
	
	if (isset($_POST['activo'])) { 
		$activo	= 1; 
	} else { 
		$activo = 0; 
	} 

	$refclientes = ($_POST['refclientes'] == '' ? 0 : $_POST['refclientes']); 
	
	$res = $serviciosReferencias->insertarUsuarios($usuario,$password,$refroles,$email,$nombrecompleto,$activo,$refclientes); 
	
	if ((integer)$res > 0) { 
		echo ''; 
	} else { 
		echo 'Hubo un error al insertar datos ';	 
	} 
} 


function modificarUsuarios($serviciosReferencias) { 
	$id = $_POST['id']; 
	$usuario = $_POST['usuario']; 
	$password = $_POST['password']; 
	$refroles = $_POST['refroles']; 
	$email = $_POST['email']; 
	$nombrecompleto = $_POST['nombrecompleto']; 
	
	if (isset($_POST['activo'])) { 
		$activo	= 1; 
	} else { 
		$activo = 0; 
	} 

	$refclientes = ($_POST['refclientes'] == '' ? 0 : $_POST['refclientes']); 
	
	$res = $serviciosReferencias->modificarUsuarios($id,$usuario,$password,$refroles,$email,$nombrecompleto,$activo,$refclientes); 
	
	if ($res == true) { 
		echo ''; 
	} else { 
		echo 'Hubo un error al modificar datos'; 
	} 
} 

function eliminarUsuarios($serviciosReferencias) { 
	$id = $_POST['id']; 
	$res = $serviciosReferencias->eliminarUsuarios($id); 
	echo $res; 
} 

function enviarMail($serviciosUsuarios) {
	$email		=	$_POST['email'];
	$pass		=	$_POST['pass'];
	
	echo $serviciosUsuarios->login($email,$pass);
}


function devolverImagen($nroInput) {
	
	if( $_FILES['archivo'.$nroInput]['name'] != null && $_FILES['archivo'.$nroInput]['size'] > 0 ){
	// Nivel de errores
	  error_reporting(E_ALL);
	  $altura = 100;
	  // Constantes
	  # Altura de el thumbnail en píxeles
	  //define("ALTURA", 100);
	  # Nombre del archivo temporal del thumbnail
	  //define("NAMETHUMB", "/tmp/thumbtemp"); //Esto en servidores Linux, en Windows podría ser:
	  //define("NAMETHUMB", "c:/windows/temp/thumbtemp"); //y te olvidas de los problemas de permisos
	  $NAMETHUMB = "c:/windows/temp/thumbtemp";
	  # Servidor de base de datos
	  //define("DBHOST", "localhost");
	  # nombre de la base de datos
	  //define("DBNAME", "portalinmobiliario");
	  # Usuario de base de datos
	  //define("DBUSER", "root");
	  # Password de base de datos
	  //define("DBPASSWORD", "");
	  // Mime types permitidos
	  $mimetypes = array("image/jpeg", "image/pjpeg", "image/gif", "image/png");
	  // Variables de la foto
	  $name = $_FILES["archivo".$nroInput]["name"];
	  $type = $_FILES["archivo".$nroInput]["type"];
	  $tmp_name = $_FILES["archivo".$nroInput]["tmp_name"];
	  $size = $_FILES["archivo".$nroInput]["size"];
	  // Verificamos si el archivo es una imagen válida
	  if(!in_array($type, $mimetypes))
		die("El archivo que subiste no es una imagen válida");
	  // Creando el thumbnail
	  switch($type) {
		case $mimetypes[0]:
		case $mimetypes[1]:
		  $img = imagecreatefromjpeg($tmp_name);
		  break;
		case $mimetypes[2]:
		  $img = imagecreatefromgif($tmp_name);
		  break;
		case $mimetypes[3]:
		  $img = imagecreatefrompng($tmp_name);
		  break;
	  }
	  
	  $datos = getimagesize($tmp_name);
	  
	  $ratio = ($datos[1]/$altura);
	  $ancho = round($datos[0]/$ratio);
	  $thumb = imagecreatetruecolor($ancho, $altura);
	  imagecopyresized($thumb, $img, 0, 0, 0, 0, $ancho, $altura, $datos[0], $datos[1]);
	  switch($type) {
		case $mimetypes[0]:
		case $mimetypes[1]:
		  imagejpeg($thumb, $NAMETHUMB);
			  break;
		case $mimetypes[2]:
		  imagegif($thumb, $NAMETHUMB);
		  break;
		case $mimetypes[3]:
		  imagepng($thumb, $NAMETHUMB);
		  break;
	  }
	  // Extrae los contenidos de las fotos
	  # contenido de la foto original
	  $fp = fopen($tmp_name, "rb");
	  $tfoto = fread($fp, filesize($tmp_name));
	  $tfoto = addslashes($tfoto);
	  fclose($fp);
	  # contenido del thumbnail
	  $fp = fopen($NAMETHUMB, "rb");
	  $tthumb = fread($fp, filesize($NAMETHUMB));
	  $tthumb = addslashes($tthumb);
	  fclose($fp);
	  // Borra archivos temporales si es que existen
	  //@unlink($tmp_name);
	  //@unlink(NAMETHUMB);
	} else {
		$tfoto = '';
		$type = '';
	}
	$tfoto = utf8_decode($tfoto);
	return array('tfoto' => $tfoto, 'type' => $type);	
}


?>