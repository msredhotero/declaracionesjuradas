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


	case 'insertarBienesinmuebles': 
		insertarBienesinmuebles($serviciosReferencias); 
	break; 
	case 'modificarBienesinmuebles': 
		modificarBienesinmuebles($serviciosReferencias); 
	break; 
	case 'eliminarBienesinmuebles': 
		eliminarBienesinmuebles($serviciosReferencias); 
	break; 
	case 'insertarBienesmuebles': 
		insertarBienesmuebles($serviciosReferencias); 
	break; 
	case 'modificarBienesmuebles': 
		modificarBienesmuebles($serviciosReferencias); 
	break; 
	case 'eliminarBienesmuebles': 
		eliminarBienesmuebles($serviciosReferencias); 
	break; 

	case 'insertarInversiones': 
		insertarInversiones($serviciosReferencias); 
	break; 
	case 'modificarInversiones': 
		modificarInversiones($serviciosReferencias); 
	break; 
	case 'eliminarInversiones': 
		eliminarInversiones($serviciosReferencias); 
	break; 

	case 'insertarVehiculos': 
		insertarVehiculos($serviciosReferencias); 
	break; 
	case 'modificarVehiculos': 
		modificarVehiculos($serviciosReferencias); 
	break; 
	case 'eliminarVehiculos': 
		eliminarVehiculos($serviciosReferencias); 
	break; 

	case 'insertarFormaadquisicion': 
		insertarFormaadquisicion($serviciosReferencias); 
	break; 
	case 'modificarFormaadquisicion': 
		modificarFormaadquisicion($serviciosReferencias); 
	break; 
	case 'eliminarFormaadquisicion': 
		eliminarFormaadquisicion($serviciosReferencias); 
	break; 
	case 'insertarOtrotipobien': 
		insertarOtrotipobien($serviciosReferencias); 
	break; 
	case 'modificarOtrotipobien': 
		modificarOtrotipobien($serviciosReferencias); 
	break; 
	case 'eliminarOtrotipobien': 
		eliminarOtrotipobien($serviciosReferencias); 
	break; 

	case 'insertarTipobien': 
		insertarTipobien($serviciosReferencias); 
	break; 
	case 'modificarTipobien': 
		modificarTipobien($serviciosReferencias); 
	break; 
	case 'eliminarTipobien': 
		eliminarTipobien($serviciosReferencias); 
	break; 
	case 'insertarTipocesionario': 
		insertarTipocesionario($serviciosReferencias); 
	break; 
	case 'modificarTipocesionario': 
		modificarTipocesionario($serviciosReferencias); 
	break; 
	case 'eliminarTipocesionario': 
		eliminarTipocesionario($serviciosReferencias); 
	break; 
	case 'insertarTipoinversion': 
		insertarTipoinversion($serviciosReferencias); 
	break; 
	case 'modificarTipoinversion': 
		modificarTipoinversion($serviciosReferencias); 
	break; 
	case 'eliminarTipoinversion': 
		eliminarTipoinversion($serviciosReferencias); 
	break; 
	case 'insertarTipooperacion': 
		insertarTipooperacion($serviciosReferencias); 
	break; 
	case 'modificarTipooperacion': 
		modificarTipooperacion($serviciosReferencias); 
	break; 
	case 'eliminarTipooperacion': 
		eliminarTipooperacion($serviciosReferencias); 
	break; 

	case 'insertarTitular': 
		insertarTitular($serviciosReferencias); 
	break; 
	case 'modificarTitular': 
		modificarTitular($serviciosReferencias); 
	break; 
	case 'eliminarTitular': 
		eliminarTitular($serviciosReferencias); 
	break;

	case 'insertarTipoadeudo': 
		insertarTipoadeudo($serviciosReferencias); 
	break; 
	case 'modificarTipoadeudo': 
		modificarTipoadeudo($serviciosReferencias); 
	break; 
	case 'eliminarTipoadeudo': 
		eliminarTipoadeudo($serviciosReferencias); 
	break; 


	case 'insertarAdeudos': 
		insertarAdeudos($serviciosReferencias); 
	break; 
	case 'modificarAdeudos': 
		modificarAdeudos($serviciosReferencias); 
	break; 
	case 'eliminarAdeudos': 
		eliminarAdeudos($serviciosReferencias); 
	break; 

	case 'insertarRecursos': 
		insertarRecursos($serviciosReferencias); 
	break; 
	case 'modificarRecursos': 
		modificarRecursos($serviciosReferencias); 
	break; 
	case 'eliminarRecursos': 
		eliminarRecursos($serviciosReferencias); 
	break; 

	case 'insertarDecrementos': 
		insertarDecrementos($serviciosReferencias); 
	break; 
	case 'modificarDecrementos': 
		modificarDecrementos($serviciosReferencias); 
	break; 
	case 'eliminarDecrementos': 
		eliminarDecrementos($serviciosReferencias); 
	break; 


	case 'insertarObservaciones': 
		insertarObservaciones($serviciosReferencias); 
	break; 
	case 'modificarObservaciones': 
		modificarObservaciones($serviciosReferencias); 
	break; 
	case 'eliminarObservaciones': 
		eliminarObservaciones($serviciosReferencias); 
	break; 

	case 'insertarConflictoeconomica': 
		insertarConflictoeconomica($serviciosReferencias); 
	break; 
	case 'modificarConflictoeconomica': 
		modificarConflictoeconomica($serviciosReferencias); 
	break; 
	case 'eliminarConflictoeconomica': 
		eliminarConflictoeconomica($serviciosReferencias); 
	break; 
	case 'insertarConflictopuestos': 
		insertarConflictopuestos($serviciosReferencias); 
	break; 
	case 'modificarConflictopuestos': 
		modificarConflictopuestos($serviciosReferencias); 
	break; 
	case 'eliminarConflictopuestos': 
		eliminarConflictopuestos($serviciosReferencias); 
	break; 

	case 'insertarFrecuenciaanual': 
		insertarFrecuenciaanual($serviciosReferencias); 
	break; 
	case 'modificarFrecuenciaanual': 
		modificarFrecuenciaanual($serviciosReferencias); 
	break; 
	case 'eliminarFrecuenciaanual': 
		eliminarFrecuenciaanual($serviciosReferencias); 
	break; 
	case 'insertarInicioparticipacion': 
		insertarInicioparticipacion($serviciosReferencias); 
	break; 
	case 'modificarInicioparticipacion': 
		modificarInicioparticipacion($serviciosReferencias); 
	break; 
	case 'eliminarInicioparticipacion': 
		eliminarInicioparticipacion($serviciosReferencias); 
	break; 

	case 'insertarParticipacion': 
		insertarParticipacion($serviciosReferencias); 
	break; 
	case 'modificarParticipacion': 
		modificarParticipacion($serviciosReferencias); 
	break; 
	case 'eliminarParticipacion': 
		eliminarParticipacion($serviciosReferencias); 
	break; 
	case 'insertarResponsables': 
		insertarResponsables($serviciosReferencias); 
	break; 
	case 'modificarResponsables': 
		modificarResponsables($serviciosReferencias); 
	break; 
	case 'eliminarResponsables': 
		eliminarResponsables($serviciosReferencias); 
	break; 
	case 'insertarTipocolaboracion': 
		insertarTipocolaboracion($serviciosReferencias); 
	break; 
	case 'modificarTipocolaboracion': 
		modificarTipocolaboracion($serviciosReferencias); 
	break; 
	case 'eliminarTipocolaboracion': 
		eliminarTipocolaboracion($serviciosReferencias); 
	break; 
	case 'insertarTipopersonajuridica': 
		insertarTipopersonajuridica($serviciosReferencias); 
	break; 
	case 'modificarTipopersonajuridica': 
		modificarTipopersonajuridica($serviciosReferencias); 
	break; 
	case 'eliminarTipopersonajuridica': 
		eliminarTipopersonajuridica($serviciosReferencias); 
	break; 
	case 'insertarTiposociedad': 
		insertarTiposociedad($serviciosReferencias); 
	break; 
	case 'modificarTiposociedad': 	
		modificarTiposociedad($serviciosReferencias); 
	break; 
	case 'eliminarTiposociedad': 
		eliminarTiposociedad($serviciosReferencias); 
	break; 

	case 'insertarVinculos': 
		insertarVinculos($serviciosReferencias); 
	break; 
	case 'modificarVinculos': 
		modificarVinculos($serviciosReferencias); 
	break; 
	case 'eliminarVinculos': 
		eliminarVinculos($serviciosReferencias); 
	break; 

}

/* Fin */

	function insertarVinculos($serviciosReferencias) { 
		$descripcion = $_POST['descripcion']; 
		$res = $serviciosReferencias->insertarVinculos($descripcion); 
		if ((integer)$res > 0) { 
		echo ''; 
		} else { 
		echo 'Hubo un error al insertar datos';	 
		} 
	} 


	function modificarVinculos($serviciosReferencias) { 
		$id = $_POST['id']; 
		$descripcion = $_POST['descripcion']; 
		$res = $serviciosReferencias->modificarVinculos($id,$descripcion); 
		if ($res == true) { 
		echo ''; 
		} else { 
		echo 'Hubo un error al modificar datos'; 
		} 
	} 


	function eliminarVinculos($serviciosReferencias) { 
		$id = $_POST['id']; 
		$res = $serviciosReferencias->eliminarVinculos($id); 
		echo $res; 
	} 


	function insertarFrecuenciaanual($serviciosReferencias) { 
		$descripcion = $_POST['descripcion']; 
		$res = $serviciosReferencias->insertarFrecuenciaanual($descripcion); 
		if ((integer)$res > 0) { 
		echo ''; 
		} else { 
		echo 'Hubo un error al insertar datos';	 
		} 
	} 


	function modificarFrecuenciaanual($serviciosReferencias) { 
		$id = $_POST['id']; 
		$descripcion = $_POST['descripcion']; 
		$res = $serviciosReferencias->modificarFrecuenciaanual($id,$descripcion); 
		if ($res == true) { 
		echo ''; 
		} else { 
		echo 'Hubo un error al modificar datos'; 
		} 
	} 


	function eliminarFrecuenciaanual($serviciosReferencias) { 
		$id = $_POST['id']; 
		$res = $serviciosReferencias->eliminarFrecuenciaanual($id); 
		echo $res; 
	} 

	function insertarInicioparticipacion($serviciosReferencias) { 
		$descripcion = $_POST['descripcion']; 
		$res = $serviciosReferencias->insertarInicioparticipacion($descripcion); 
		if ((integer)$res > 0) { 
		echo ''; 
		} else { 
		echo 'Hubo un error al insertar datos';	 
		} 
	} 

	function modificarInicioparticipacion($serviciosReferencias) { 
		$id = $_POST['id']; 
		$descripcion = $_POST['descripcion']; 
		$res = $serviciosReferencias->modificarInicioparticipacion($id,$descripcion); 
		if ($res == true) { 
		echo ''; 
		} else { 
		echo 'Hubo un error al modificar datos'; 
		} 
	} 

	function eliminarInicioparticipacion($serviciosReferencias) { 
		$id = $_POST['id']; 
		$res = $serviciosReferencias->eliminarInicioparticipacion($id); 
		echo $res; 
	} 

	function insertarParticipacion($serviciosReferencias) { 
		$descripcion = $_POST['descripcion']; 
		$res = $serviciosReferencias->insertarParticipacion($descripcion); 
		if ((integer)$res > 0) { 
		echo ''; 
		} else { 
		echo 'Hubo un error al insertar datos';	 
		} 
	} 

	function modificarParticipacion($serviciosReferencias) { 
		$id = $_POST['id']; 
		$descripcion = $_POST['descripcion']; 
		$res = $serviciosReferencias->modificarParticipacion($id,$descripcion); 
		if ($res == true) { 
		echo ''; 
		} else { 
		echo 'Hubo un error al modificar datos'; 
		} 
	} 


	function eliminarParticipacion($serviciosReferencias) { 
		$id = $_POST['id']; 
		$res = $serviciosReferencias->eliminarParticipacion($id); 
		echo $res; 
	} 

	function insertarResponsables($serviciosReferencias) { 
		$descripcion = $_POST['descripcion']; 
		$res = $serviciosReferencias->insertarResponsables($descripcion); 
		if ((integer)$res > 0) { 
		echo ''; 
		} else { 
		echo 'Hubo un error al insertar datos';	 
		} 
	} 

	function modificarResponsables($serviciosReferencias) { 
		$id = $_POST['id']; 
		$descripcion = $_POST['descripcion']; 
		$res = $serviciosReferencias->modificarResponsables($id,$descripcion); 
		if ($res == true) { 
		echo ''; 
		} else { 
		echo 'Hubo un error al modificar datos'; 
		} 
	} 

	function eliminarResponsables($serviciosReferencias) { 
		$id = $_POST['id']; 
		$res = $serviciosReferencias->eliminarResponsables($id); 
		echo $res; 
	} 

	function insertarTipocolaboracion($serviciosReferencias) { 
		$descripcion = $_POST['descripcion']; 
		$res = $serviciosReferencias->insertarTipocolaboracion($descripcion); 
		if ((integer)$res > 0) { 
		echo ''; 
		} else { 
		echo 'Hubo un error al insertar datos';	 
		} 
	} 

	function modificarTipocolaboracion($serviciosReferencias) { 
		$id = $_POST['id']; 
		$descripcion = $_POST['descripcion']; 
		$res = $serviciosReferencias->modificarTipocolaboracion($id,$descripcion); 
		if ($res == true) { 
		echo ''; 
		} else { 
		echo 'Hubo un error al modificar datos'; 
		} 
	} 

	function eliminarTipocolaboracion($serviciosReferencias) { 
		$id = $_POST['id']; 
		$res = $serviciosReferencias->eliminarTipocolaboracion($id); 
		echo $res; 
	} 

	function insertarTipopersonajuridica($serviciosReferencias) { 
		$descripcion = $_POST['descripcion']; 
		$res = $serviciosReferencias->insertarTipopersonajuridica($descripcion); 
		if ((integer)$res > 0) { 
		echo ''; 
		} else { 
		echo 'Hubo un error al insertar datos';	 
		} 
	} 

	function modificarTipopersonajuridica($serviciosReferencias) { 
		$id = $_POST['id']; 
		$descripcion = $_POST['descripcion']; 
		$res = $serviciosReferencias->modificarTipopersonajuridica($id,$descripcion); 
		if ($res == true) { 
		echo ''; 
		} else { 
		echo 'Hubo un error al modificar datos'; 
		} 
	} 

	function eliminarTipopersonajuridica($serviciosReferencias) { 
		$id = $_POST['id']; 
		$res = $serviciosReferencias->eliminarTipopersonajuridica($id); 
		echo $res; 
	} 

	function insertarTiposociedad($serviciosReferencias) { 
		$descripcion = $_POST['descripcion']; 
		$res = $serviciosReferencias->insertarTiposociedad($descripcion); 
		if ((integer)$res > 0) { 
		echo ''; 
		} else { 
		echo 'Hubo un error al insertar datos';	 
		} 
	} 

	function modificarTiposociedad($serviciosReferencias) { 
		$id = $_POST['id']; 
		$descripcion = $_POST['descripcion']; 
		$res = $serviciosReferencias->modificarTiposociedad($id,$descripcion); 
		if ($res == true) { 
		echo ''; 
		} else { 
		echo 'Hubo un error al modificar datos'; 
		} 
	} 

	function eliminarTiposociedad($serviciosReferencias) { 
		$id = $_POST['id']; 
		$res = $serviciosReferencias->eliminarTiposociedad($id); 
		echo $res; 
	} 


	function insertarRecursos($serviciosReferencias) { 
		$refdeclaracionjuradacabecera = $_POST['refdeclaracionjuradacabecera']; 
		$pagos = $_POST['pagos']; 
		$otros = $_POST['otros']; 
		
		$res = $serviciosReferencias->insertarRecursos($refdeclaracionjuradacabecera,$pagos,$otros); 
		
		if ((integer)$res > 0) { 
			echo ''; 
		} else { 
			echo 'Hubo un error al insertar datos';	 
		} 
	} 


	function modificarRecursos($serviciosReferencias) { 
		$id = $_POST['id']; 
		$refdeclaracionjuradacabecera = $_POST['refdeclaracionjuradacabecera']; 
		$pagos = $_POST['pagos']; 
		$otros = $_POST['otros']; 
		
		$res = $serviciosReferencias->modificarRecursos($id,$refdeclaracionjuradacabecera,$pagos,$otros); 
		
		if ($res == true) { 
			echo ''; 
		} else { 
			echo 'Hubo un error al modificar datos'; 
		} 
	} 


	function eliminarRecursos($serviciosReferencias) { 
		$id = $_POST['id']; 
		$res = $serviciosReferencias->eliminarRecursos($id); 
		echo $res; 
	} 



	function insertarDecrementos($serviciosReferencias) { 
		$refdeclaracionjuradacabecera = $_POST['refdeclaracionjuradacabecera']; 
		$donaciones = $_POST['donaciones']; 
		$robo = $_POST['robo']; 
		$siniestros = $_POST['siniestros']; 
		$otros = $_POST['otros']; 
		
		$res = $serviciosReferencias->insertarDecrementos($refdeclaracionjuradacabecera,$donaciones,$robo,$siniestros,$otros); 
		
		if ((integer)$res > 0) { 
			echo ''; 
		} else { 
			echo 'Hubo un error al insertar datos';	 
		} 
	} 


	function modificarDecrementos($serviciosReferencias) { 
		$id = $_POST['id']; 
		$refdeclaracionjuradacabecera = $_POST['refdeclaracionjuradacabecera']; 
		$donaciones = $_POST['donaciones']; 
		$robo = $_POST['robo']; 
		$siniestros = $_POST['siniestros']; 
		$otros = $_POST['otros']; 
		
		$res = $serviciosReferencias->modificarDecrementos($id,$refdeclaracionjuradacabecera,$donaciones,$robo,$siniestros,$otros); 
		
		if ($res == true) { 
			echo ''; 
		} else { 
			echo 'Hubo un error al modificar datos'; 
		} 
	} 


	function eliminarDecrementos($serviciosReferencias) { 
		$id = $_POST['id']; 
		$res = $serviciosReferencias->eliminarDecrementos($id); 
		echo $res; 
	} 



	function insertarObservaciones($serviciosReferencias) { 
		$refdeclaracionjuradacabecera = $_POST['refdeclaracionjuradacabecera']; 
		$observacion = $_POST['observacion']; 
		
		$res = $serviciosReferencias->insertarObservaciones($refdeclaracionjuradacabecera,$observacion); 
		
		if ((integer)$res > 0) { 
			echo ''; 
		} else { 
			echo 'Hubo un error al insertar datos';	 
		} 
	} 


	function modificarObservaciones($serviciosReferencias) { 
		$id = $_POST['id']; 
		$refdeclaracionjuradacabecera = $_POST['refdeclaracionjuradacabecera']; 
		$observacion = $_POST['observacion']; 
		
		$res = $serviciosReferencias->modificarObservaciones($id,$refdeclaracionjuradacabecera,$observacion); 
		
		if ($res == true) { 
			echo ''; 
		} else { 
			echo 'Hubo un error al modificar datos'; 
		} 
	} 


	function eliminarObservaciones($serviciosReferencias) { 
		$id = $_POST['id']; 
		$res = $serviciosReferencias->eliminarObservaciones($id); 
		echo $res; 
	} 



	
	function insertarAdeudos($serviciosReferencias) { 
		$refdeclaracionjuradacabecera = $_POST['refdeclaracionjuradacabecera']; 
		$reftipooperacion = $_POST['reftipooperacion']; 
		$reftipoadeudo = $_POST['reftipoadeudo']; 
		$numerocuenta = $_POST['numerocuenta']; 
		$donde = $_POST['donde']; 
		$razonsocial = $_POST['razonsocial']; 
		$pais = $_POST['pais']; 
		$fechaotorgamiento = $_POST['fechaotorgamiento']; 
		$montooritginal = $_POST['montooritginal']; 
		$tipomoneda = $_POST['tipomoneda']; 
		$montopagos = $_POST['montopagos']; 
		$saldo = $_POST['saldo']; 
		$tipomonedasaldo = $_POST['tipomonedasaldo']; 
		$reftitular = $_POST['reftitular']; 
		
		$res = $serviciosReferencias->insertarAdeudos($refdeclaracionjuradacabecera,$reftipooperacion,$reftipoadeudo,$numerocuenta,$donde,$razonsocial,$pais,$fechaotorgamiento,$montooritginal,$tipomoneda,$montopagos,$saldo,$tipomonedasaldo,$reftitular); 
		
		if ((integer)$res > 0) { 
			echo ''; 
		} else { 
			echo 'Hubo un error al insertar datos';	 
		} 
	} 


	function modificarAdeudos($serviciosReferencias) { 
		$id = $_POST['id']; 
		$refdeclaracionjuradacabecera = $_POST['refdeclaracionjuradacabecera']; 
		$reftipooperacion = $_POST['reftipooperacion']; 
		$reftipoadeudo = $_POST['reftipoadeudo']; 
		$numerocuenta = $_POST['numerocuenta']; 
		$donde = $_POST['donde']; 
		$razonsocial = $_POST['razonsocial']; 
		$pais = $_POST['pais']; 
		$fechaotorgamiento = $_POST['fechaotorgamiento']; 
		$montooritginal = $_POST['montooritginal']; 
		$tipomoneda = $_POST['tipomoneda']; 
		$montopagos = $_POST['montopagos']; 
		$saldo = $_POST['saldo']; 
		$tipomonedasaldo = $_POST['tipomonedasaldo']; 
		$reftitular = $_POST['reftitular']; 
		
		$res = $serviciosReferencias->modificarAdeudos($id,$refdeclaracionjuradacabecera,$reftipooperacion,$reftipoadeudo,$numerocuenta,$donde,$razonsocial,$pais,$fechaotorgamiento,$montooritginal,$tipomoneda,$montopagos,$saldo,$tipomonedasaldo,$reftitular); 
		
		if ($res == true) { 
			echo ''; 
		} else { 
			echo 'Hubo un error al modificar datos'; 
		} 
	} 


	function eliminarAdeudos($serviciosReferencias) { 
		$id = $_POST['id']; 
		$res = $serviciosReferencias->eliminarAdeudos($id); 
		echo $res; 
	} 



	function insertarTipoadeudo($serviciosReferencias) { 
		$tipoadeudo = $_POST['tipoadeudo']; 
		$res = $serviciosReferencias->insertarTipoadeudo($tipoadeudo); 
		
		if ((integer)$res > 0) { 
			echo ''; 
		} else { 
			echo 'Hubo un error al insertar datos';	 
		} 
	} 


	function modificarTipoadeudo($serviciosReferencias) { 
		$id = $_POST['id']; 
		$tipoadeudo = $_POST['tipoadeudo']; 
		$res = $serviciosReferencias->modificarTipoadeudo($id,$tipoadeudo); 
		
		if ($res == true) { 
			echo ''; 
		} else { 
			echo 'Hubo un error al modificar datos'; 
		} 
	} 


	function eliminarTipoadeudo($serviciosReferencias) { 
		$id = $_POST['id']; 
		$res = $serviciosReferencias->eliminarTipoadeudo($id); 
		echo $res; 
	} 
	

	function insertarBienesinmuebles($serviciosReferencias) { 
		$refdeclaracionjuradacabecera = $_POST['refdeclaracionjuradacabecera']; 
		$reftipooperacion = $_POST['reftipooperacion']; 
		$reftipobien = $_POST['reftipobien']; 
		$refotrotipobien = $_POST['refotrotipobien']; 
		$mtrsterreno = $_POST['mtrsterreno']; 
		$mtrsconstruccion = $_POST['mtrsconstruccion']; 
		$refformaadquisicion = $_POST['refformaadquisicion']; 
		$cesionario = $_POST['cesionario']; 
		$reftitular = $_POST['reftitular']; 
		$reftipocesionario = $_POST['reftipocesionario']; 
		$otrotipocesionario = $_POST['otrotipocesionario']; 
		$valor = $_POST['valor']; 
		$tipomoneda = $_POST['tipomoneda']; 
		$fechaadquisicion = $_POST['fechaadquisicion']; 
		$registropublico = $_POST['registropublico']; 
		$ubicacion = $_POST['ubicacion']; 
		$especificacionobra = $_POST['especificacionobra']; 
		$especificacionventa = $_POST['especificacionventa']; 
		
		$res = $serviciosReferencias->insertarBienesinmuebles($refdeclaracionjuradacabecera,$reftipooperacion,$reftipobien,$refotrotipobien,$mtrsterreno,$mtrsconstruccion,$refformaadquisicion,$cesionario,$reftitular,$reftipocesionario,$otrotipocesionario,$valor,$tipomoneda,$fechaadquisicion,$registropublico,$ubicacion,$especificacionobra,$especificacionventa); 
		
		if ((integer)$res > 0) { 
			echo ''; 
		} else { 
			echo 'Hubo un error al insertar datos';	 
		} 
	} 


	function modificarBienesinmuebles($serviciosReferencias) { 
		$id = $_POST['id']; 
		$refdeclaracionjuradacabecera = $_POST['refdeclaracionjuradacabecera']; 
		$reftipooperacion = $_POST['reftipooperacion']; 
		$reftipobien = $_POST['reftipobien']; 
		$refotrotipobien = $_POST['refotrotipobien']; 
		$mtrsterreno = $_POST['mtrsterreno']; 
		$mtrsconstruccion = $_POST['mtrsconstruccion']; 
		$refformaadquisicion = $_POST['refformaadquisicion']; 
		$cesionario = $_POST['cesionario']; 
		$reftitular = $_POST['reftitular']; 
		$reftipocesionario = $_POST['reftipocesionario']; 
		$otrotipocesionario = $_POST['otrotipocesionario']; 
		$valor = $_POST['valor']; 
		$tipomoneda = $_POST['tipomoneda']; 
		$fechaadquisicion = $_POST['fechaadquisicion']; 
		$registropublico = $_POST['registropublico']; 
		$ubicacion = $_POST['ubicacion']; 
		$especificacionobra = $_POST['especificacionobra']; 
		$especificacionventa = $_POST['especificacionventa']; 
		
		$res = $serviciosReferencias->modificarBienesinmuebles($id,$refdeclaracionjuradacabecera,$reftipooperacion,$reftipobien,$refotrotipobien,$mtrsterreno,$mtrsconstruccion,$refformaadquisicion,$cesionario,$reftitular,$reftipocesionario,$otrotipocesionario,$valor,$tipomoneda,$fechaadquisicion,$registropublico,$ubicacion,$especificacionobra,$especificacionventa); 
		
		if ($res == true) { 
			echo ''; 
		} else { 
			echo 'Hubo un error al modificar datos'; 
		} 
	} 

	function eliminarBienesinmuebles($serviciosReferencias) { 
		$id = $_POST['id']; 
		$res = $serviciosReferencias->eliminarBienesinmuebles($id); 
		echo $res; 
	} 



	function insertarBienesmuebles($serviciosReferencias) { 
		$refdeclaracionjuradacabecera = $_POST['refdeclaracionjuradacabecera']; 
		$reftipooperacion = $_POST['reftipooperacion']; 
		$reftipobien = $_POST['reftipobien']; 
		$descripcion = $_POST['descripcion']; 
		$refformaadquisicion = $_POST['refformaadquisicion']; 
		$cesionario = $_POST['cesionario']; 
		$reftipocesionario = $_POST['reftipocesionario']; 
		$otrotipocesionario = $_POST['otrotipocesionario']; 
		$valor = $_POST['valor']; 
		$tipomoneda = $_POST['tipomoneda']; 
		$fechaadquisicion = $_POST['fechaadquisicion']; 
		$reftitular = $_POST['reftitular']; 
		$especificacionventa = $_POST['especificacionventa']; 
		
		$res = $serviciosReferencias->insertarBienesmuebles($refdeclaracionjuradacabecera,$reftipooperacion,$reftipobien,$descripcion,$refformaadquisicion,$cesionario,$reftipocesionario,$otrotipocesionario,$valor,$tipomoneda,$fechaadquisicion,$reftitular,$especificacionventa); 
		
		if ((integer)$res > 0) { 
			echo ''; 
		} else { 
			echo 'Hubo un error al insertar datos';	 
		} 
	} 


	function modificarBienesmuebles($serviciosReferencias) { 
		$id = $_POST['id']; 
		$refdeclaracionjuradacabecera = $_POST['refdeclaracionjuradacabecera']; 
		$reftipooperacion = $_POST['reftipooperacion']; 
		$reftipobien = $_POST['reftipobien']; 
		$descripcion = $_POST['descripcion']; 
		$refformaadquisicion = $_POST['refformaadquisicion']; 
		$cesionario = $_POST['cesionario']; 
		$reftipocesionario = $_POST['reftipocesionario']; 
		$otrotipocesionario = $_POST['otrotipocesionario']; 
		$valor = $_POST['valor']; 
		$tipomoneda = $_POST['tipomoneda']; 
		$fechaadquisicion = $_POST['fechaadquisicion']; 
		$reftitular = $_POST['reftitular']; 
		$especificacionventa = $_POST['especificacionventa']; 
		
		$res = $serviciosReferencias->modificarBienesmuebles($id,$refdeclaracionjuradacabecera,$reftipooperacion,$reftipobien,$descripcion,$refformaadquisicion,$cesionario,$reftipocesionario,$otrotipocesionario,$valor,$tipomoneda,$fechaadquisicion,$reftitular,$especificacionventa); 
		
		if ($res == true) { 
			echo ''; 
		} else { 
			echo 'Hubo un error al modificar datos'; 
		} 
	} 

	function eliminarBienesmuebles($serviciosReferencias) { 
		$id = $_POST['id']; 
		$res = $serviciosReferencias->eliminarBienesmuebles($id); 
		echo $res; 
	} 



	function insertarInversiones($serviciosReferencias) { 
		$refdeclaracionjuradacabecera = $_POST['refdeclaracionjuradacabecera']; 
		$reftipooperacion = $_POST['reftipooperacion']; 
		$reftitular = $_POST['reftitular']; 
		$numerocuenta = $_POST['numerocuenta']; 
		$donde = $_POST['donde']; 
		$razonsocial = $_POST['razonsocial']; 
		$pais = $_POST['pais']; 
		$saldo = $_POST['saldo']; 
		$tipomoneda = $_POST['tipomoneda']; 
		$reftipoinversion = $_POST['reftipoinversion']; 
		$especifica = $_POST['especifica']; 
		
		$res = $serviciosReferencias->insertarInversiones($refdeclaracionjuradacabecera,$reftipooperacion,$reftitular,$numerocuenta,$donde,$razonsocial,$pais,$saldo,$tipomoneda,$reftipoinversion,$especifica); 
		
		if ((integer)$res > 0) { 
			echo ''; 
		} else { 
			echo 'Hubo un error al insertar datos';	 
		} 
	} 


	function modificarInversiones($serviciosReferencias) { 
		$id = $_POST['id']; 
		$refdeclaracionjuradacabecera = $_POST['refdeclaracionjuradacabecera']; 
		$reftipooperacion = $_POST['reftipooperacion']; 
		$reftitular = $_POST['reftitular']; 
		$numerocuenta = $_POST['numerocuenta']; 
		$donde = $_POST['donde']; 
		$razonsocial = $_POST['razonsocial']; 
		$pais = $_POST['pais']; 
		$saldo = $_POST['saldo']; 
		$tipomoneda = $_POST['tipomoneda']; 
		$reftipoinversion = $_POST['reftipoinversion']; 
		$especifica = $_POST['especifica']; 
		
		$res = $serviciosReferencias->modificarInversiones($id,$refdeclaracionjuradacabecera,$reftipooperacion,$reftitular,$numerocuenta,$donde,$razonsocial,$pais,$saldo,$tipomoneda,$reftipoinversion,$especifica); 
		
		if ($res == true) { 
			echo ''; 
		} else { 
			echo 'Hubo un error al modificar datos'; 
		} 
	} 


	function eliminarInversiones($serviciosReferencias) { 
		$id = $_POST['id']; 
		$res = $serviciosReferencias->eliminarInversiones($id); 
		echo $res; 
	} 



	function insertarVehiculos($serviciosReferencias) { 
		$refdeclaracionjuradacabecera = $_POST['refdeclaracionjuradacabecera']; 
		$reftipooperacion = $_POST['reftipooperacion']; 
		$vehiculo = $_POST['vehiculo']; 
		$donde = $_POST['donde']; 
		$entidadfederativa = $_POST['entidadfederativa']; 
		$refformaadquisicion = $_POST['refformaadquisicion']; 
		$cesionario = $_POST['cesionario']; 
		$reftipocesionario = $_POST['reftipocesionario']; 
		$otrotipocesionario = $_POST['otrotipocesionario']; 
		$valor = $_POST['valor']; 
		$tipomoneda = $_POST['tipomoneda']; 
		$fechaadquisicion = $_POST['fechaadquisicion']; 
		$reftitular = $_POST['reftitular']; 
		$especificacionventa = $_POST['especificacionventa']; 
		$especificacionsiniestro = $_POST['especificacionsiniestro']; 
		
		$res = $serviciosReferencias->insertarVehiculos($refdeclaracionjuradacabecera,$reftipooperacion,$vehiculo,$donde,$entidadfederativa,$refformaadquisicion,$cesionario,$reftipocesionario,$otrotipocesionario,$valor,$tipomoneda,$fechaadquisicion,$reftitular,$especificacionventa,$especificacionsiniestro); 
		
		if ((integer)$res > 0) { 
			echo ''; 
		} else { 
			echo 'Hubo un error al insertar datos';	 
		} 
	} 


	function modificarVehiculos($serviciosReferencias) { 
		$id = $_POST['id']; 
		$refdeclaracionjuradacabecera = $_POST['refdeclaracionjuradacabecera']; 
		$reftipooperacion = $_POST['reftipooperacion']; 
		$vehiculo = $_POST['vehiculo']; 
		$donde = $_POST['donde']; 
		$entidadfederativa = $_POST['entidadfederativa']; 
		$refformaadquisicion = $_POST['refformaadquisicion']; 
		$cesionario = $_POST['cesionario']; 
		$reftipocesionario = $_POST['reftipocesionario']; 
		$otrotipocesionario = $_POST['otrotipocesionario']; 
		$valor = $_POST['valor']; 
		$tipomoneda = $_POST['tipomoneda']; 
		$fechaadquisicion = $_POST['fechaadquisicion']; 
		$reftitular = $_POST['reftitular']; 
		$especificacionventa = $_POST['especificacionventa']; 
		$especificacionsiniestro = $_POST['especificacionsiniestro']; 
		
		$res = $serviciosReferencias->modificarVehiculos($id,$refdeclaracionjuradacabecera,$reftipooperacion,$vehiculo,$donde,$entidadfederativa,$refformaadquisicion,$cesionario,$reftipocesionario,$otrotipocesionario,$valor,$tipomoneda,$fechaadquisicion,$reftitular,$especificacionventa,$especificacionsiniestro); 
		
		if ($res == true) { 
			echo ''; 
		} else { 
			echo 'Hubo un error al modificar datos'; 
		} 
	} 


	function eliminarVehiculos($serviciosReferencias) { 
		$id = $_POST['id']; 
		$res = $serviciosReferencias->eliminarVehiculos($id); 
		echo $res; 
	} 


	function insertarFormaadquisicion($serviciosReferencias) { 
		$formaadquisicion = $_POST['formaadquisicion']; 
		
		$res = $serviciosReferencias->insertarFormaadquisicion($formaadquisicion); 
		
		if ((integer)$res > 0) { 
		echo ''; 
		} else { 
		echo 'Hubo un error al insertar datos';	 
		} 
	} 


	function modificarFormaadquisicion($serviciosReferencias) { 
		$id = $_POST['id']; 
		$formaadquisicion = $_POST['formaadquisicion']; 
		$res = $serviciosReferencias->modificarFormaadquisicion($id,$formaadquisicion); 
		if ($res == true) { 
		echo ''; 
		} else { 
		echo 'Hubo un error al modificar datos'; 
		} 
	} 


	function eliminarFormaadquisicion($serviciosReferencias) { 
		$id = $_POST['id']; 
		$res = $serviciosReferencias->eliminarFormaadquisicion($id); 
		echo $res; 
	} 


	function insertarOtrotipobien($serviciosReferencias) { 
		$otrotipobien = $_POST['otrotipobien']; 
		$res = $serviciosReferencias->insertarOtrotipobien($otrotipobien); 
		if ((integer)$res > 0) { 
		echo ''; 
		} else { 
		echo 'Hubo un error al insertar datos';	 
		} 
	} 


	function modificarOtrotipobien($serviciosReferencias) { 
		$id = $_POST['id']; 
		$otrotipobien = $_POST['otrotipobien']; 
		$res = $serviciosReferencias->modificarOtrotipobien($id,$otrotipobien); 
		if ($res == true) { 
		echo ''; 
		} else { 
		echo 'Hubo un error al modificar datos'; 
		} 
	} 


	function eliminarOtrotipobien($serviciosReferencias) { 
		$id = $_POST['id']; 
		$res = $serviciosReferencias->eliminarOtrotipobien($id); 
		echo $res; 
	} 



	function insertarTipobien($serviciosReferencias) { 
		$tipobien = $_POST['tipobien']; 
		$res = $serviciosReferencias->insertarTipobien($tipobien); 
		if ((integer)$res > 0) { 
		echo ''; 
		} else { 
		echo 'Hubo un error al insertar datos';	 
		} 
	} 


	function modificarTipobien($serviciosReferencias) { 
		$id = $_POST['id']; 
		$tipobien = $_POST['tipobien']; 
		$res = $serviciosReferencias->modificarTipobien($id,$tipobien); 
		if ($res == true) { 
		echo ''; 
		} else { 
		echo 'Hubo un error al modificar datos'; 
		} 
	} 


	function eliminarTipobien($serviciosReferencias) { 
		$id = $_POST['id']; 
		$res = $serviciosReferencias->eliminarTipobien($id); 
		echo $res; 
	} 


	function insertarTipocesionario($serviciosReferencias) { 
		$tipocesionario = $_POST['tipocesionario']; 
		$res = $serviciosReferencias->insertarTipocesionario($tipocesionario); 
		if ((integer)$res > 0) { 
		echo ''; 
		} else { 
		echo 'Hubo un error al insertar datos';	 
		} 
	} 


	function modificarTipocesionario($serviciosReferencias) { 
		$id = $_POST['id']; 
		$tipocesionario = $_POST['tipocesionario']; 
		$res = $serviciosReferencias->modificarTipocesionario($id,$tipocesionario); 
		if ($res == true) { 
		echo ''; 
		} else { 
		echo 'Hubo un error al modificar datos'; 
		} 
	} 


	function eliminarTipocesionario($serviciosReferencias) { 
		$id = $_POST['id']; 
		$res = $serviciosReferencias->eliminarTipocesionario($id); 
		echo $res; 
	} 


	function insertarTipoinversion($serviciosReferencias) { 
		$tipoinversion = $_POST['tipoinversion']; 
		$res = $serviciosReferencias->insertarTipoinversion($tipoinversion); 
		if ((integer)$res > 0) { 
		echo ''; 
		} else { 
		echo 'Hubo un error al insertar datos';	 
		} 
	} 


	function modificarTipoinversion($serviciosReferencias) { 
		$id = $_POST['id']; 
		$tipoinversion = $_POST['tipoinversion']; 
		$res = $serviciosReferencias->modificarTipoinversion($id,$tipoinversion); 
		if ($res == true) { 
		echo ''; 
		} else { 
		echo 'Hubo un error al modificar datos'; 
		} 
	} 


	function eliminarTipoinversion($serviciosReferencias) { 
		$id = $_POST['id']; 
		$res = $serviciosReferencias->eliminarTipoinversion($id); 
		echo $res; 
	} 


	function insertarTipooperacion($serviciosReferencias) { 
		$tipooperacion = $_POST['tipooperacion']; 
		$res = $serviciosReferencias->insertarTipooperacion($tipooperacion); 
		if ((integer)$res > 0) { 
		echo ''; 
		} else { 
		echo 'Hubo un error al insertar datos';	 
		} 
	} 


	function modificarTipooperacion($serviciosReferencias) { 
		$id = $_POST['id']; 
		$tipooperacion = $_POST['tipooperacion']; 
		$res = $serviciosReferencias->modificarTipooperacion($id,$tipooperacion); 
		if ($res == true) { 
		echo ''; 
		} else { 
		echo 'Hubo un error al modificar datos'; 
		} 
	} 


	function eliminarTipooperacion($serviciosReferencias) { 
		$id = $_POST['id']; 
		$res = $serviciosReferencias->eliminarTipooperacion($id); 
		echo $res; 
	} 


	function insertarTitular($serviciosReferencias) { 
		$titular = $_POST['titular']; 
		$res = $serviciosReferencias->insertarTitular($titular); 
		if ((integer)$res > 0) { 
		echo ''; 
		} else { 
		echo 'Hubo un error al insertar datos';	 
		} 
	} 


	function modificarTitular($serviciosReferencias) { 
		$id = $_POST['id']; 
		$titular = $_POST['titular']; 
		$res = $serviciosReferencias->modificarTitular($id,$titular); 
		if ($res == true) { 
		echo ''; 
		} else { 
		echo 'Hubo un error al modificar datos'; 
		} 
	} 

	
	function eliminarTitular($serviciosReferencias) { 
		$id = $_POST['id']; 
		$res = $serviciosReferencias->eliminarTitular($id); 
		echo $res; 
	} 



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
			echo 'Hubo un error al modificar datos '; 
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
			if ($fueservidorpublico == 0) {
				$serviciosReferencias->modificarVigencias($res);	
			}
			
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
			if ($fueservidorpublico == 0) {
				$serviciosReferencias->modificarVigencias($id);	
			}
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

	$rfc = $_POST['rfc']; 
	
	$res = $serviciosReferencias->insertarDeclaracionjuradacabecera($fecharecepcion,$primerapellido,$segundoapellido,$nombres,$curp,$homoclave,$rfc,$emailinstitucional,$emailalterno,$refestadocivil,$refregimenmatrimonial,$paisnacimiento,$nacionalidad,$entidadnacimiento,$numerocelular,$lugarubica,$domicilioparticular,$localidad,$municipio,$telefono,$entidadfederativa,$codigopostal,$lada,$sexo,$estudios,$cedulaprofesional,$refusuarios); 
	
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

	$refestados = $_POST['refestados']; 
	$rfc = $_POST['rfc']; 
	
	$res = $serviciosReferencias->modificarDeclaracionjuradacabecera($id,$fecharecepcion,$primerapellido,$segundoapellido,$nombres,$curp,$homoclave,$rfc,$emailinstitucional,$emailalterno,$refestadocivil,$refregimenmatrimonial,$paisnacimiento,$nacionalidad,$entidadnacimiento,$numerocelular,$lugarubica,$domicilioparticular,$localidad,$municipio,$telefono,$entidadfederativa,$codigopostal,$lada,$sexo,$estudios,$cedulaprofesional,$refusuarios,$refestados); 
	
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