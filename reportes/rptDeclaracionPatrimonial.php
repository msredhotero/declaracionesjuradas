<?php

date_default_timezone_set('America/Buenos_Aires');

include ('../includes/funcionesUsuarios.php');
include ('../includes/funciones.php');
include ('../includes/funcionesHTML.php');
include ('../includes/funcionesReferencias.php');


$serviciosUsuarios  		= new ServiciosUsuarios();
$serviciosFunciones 		= new Servicios();
$serviciosHTML				= new ServiciosHTML();
$serviciosReferencias 		= new ServiciosReferencias();
//$serviciosReportes			= new ServiciosReportes();

$fecha = date('Y-m-d');

require('fpdf.php');

//$header = array("Hora", "Cancha 1", "Cancha 2", "Cancha 3");

$id				=	$_GET['id'];

$resResultado = $serviciosReferencias->traerDeclaracionjuradacabeceraPorId($id);
$resResultadoCompleto = $serviciosReferencias->traerDeclaracionjuradacabeceraPorIdCompleta($id);

$publico = $serviciosReferencias->traerPublicacionPorCabecera($id);


if ((mysql_num_rows($resResultado)>0) && (mysql_num_rows($publico)>0)) {


	$pdf = new FPDF('L','mm','A4');

	/*---------------   PRIMERA PAGINA ***********************************/

	$pdf->SetMargins(3,3,3);
	// T�tulos de las columnas

	$pdf->AddPage();

	$pdf->SetXY(10,10);



	$pdf->SetFont('Arial','b',20);
	$pdf->SetXY(3,50);
	$pdf->Cell(290,8,'Secretar�a de la Contralor�a',0,0,'C',0);

	$pdf->Ln();
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Cell(290,8,'DECLARACI�N DE MODIFICACI�N ANUAL',0,0,'C',0);
	$pdf->Ln();
	$pdf->Cell(290,8,'DE INTERESES Y SITUACI�N PATRIMONIAL',0,0,'C',0);


	/*---------------  FIN PRIMERA PAGINA ***********************************/



	/*---------------   SEGUNDA PAGINA  ***********************************/
	$datos1 = $serviciosReferencias->traerDeclaracionanualinteresGridPorCabecera($id);

	$pdf->AddPage();

	$pdf->SetXY(10,10);



	$pdf->SetFont('Arial','b',18);
	$pdf->SetXY(3,10);
	$pdf->Cell(290,8,'DECLARACI�N DE MODIFICACI�N ANUAL',0,0,'C',0);
	$pdf->Ln();
	$pdf->Cell(290,8,'DE INTERESES Y DE SITUACI�N PATRIMONIAL',0,0,'C',0);
	$pdf->Ln();
	$pdf->Ln();

	if (mysql_num_rows($datos1) > 0) {
		$pdf->SetFont('Arial','b',8);
		$pdf->Cell(290,5,'MODIFICACIONES ENTRE EL 1o. DE ENERO Y EL 31 DE DICIEMBRE DEL A�O ANTERIOR',0,0,'C',0);
		$pdf->Ln();

		$pdf->Cell(100,5,'C. SECRETARIO DE LA CONTRALOR�A',0,0,'R',0);
		if (mysql_result($datos1,0,'essecretario') == 'Si') {
			$pdf->Cell(5,5,'X',1,0,'C',0);
		} else {
			$pdf->Cell(5,5,'',1,0,'C',0);
		}

		$pdf->Cell(60,5,'C. AUDITOR GENERAL DE ESAF',0,0,'R',0);
		if (mysql_result($datos1,0,'esauditor') == 'Si') {
			$pdf->Cell(5,5,'X',1,0,'C',0);
		} else {
			$pdf->Cell(5,5,'',1,0,'C',0);
		}
		$pdf->Cell(30,5,'EJERCICIO',0,0,'R',0);
		$pdf->Cell(30,5,mysql_result($datos1,0,'ejercicio'),'RLB',0,'C',0);

		$pdf->Ln();
		$pdf->Ln();

		$pdf->Cell(160,5,'ES MI DESEO HACER P�BLICA A LA INFORMACI�N CONFIDENCIAL: ',0,0,'C',0);
		if (mysql_result($datos1,0,'espublico') == 'Si') {
			$pdf->Cell(5,5,'Si',0,0,'C',0);
			$pdf->Cell(5,5,'X',1,0,'C',0);
			$pdf->Cell(5,5,'No',0,0,'C',0);
			$pdf->Cell(5,5,'',1,0,'C',0);
		} else {
			$pdf->Cell(5,5,'Si',0,0,'C',0);
			$pdf->Cell(5,5,'',1,0,'C',0);
			$pdf->Cell(5,5,'No',0,0,'C',0);
			$pdf->Cell(5,5,'X',1,0,'C',0);
		}

		$pdf->Ln();
		$pdf->Ln();
		$pdf->SetX(15);
		$pdf->SetFont('Arial','b',7);
		$pdf->Cell(290,5,'Quien suscribe, en cumplimiento a lo dispuesto en el art�culo 133 bis de la Constituci�n Pol�tica del Estado Libre y Soberano de Morelos as� como al art�culo 75 de la Ley Estatal de',0,0,'L',0);
		$pdf->Ln();
		$pdf->SetX(15);
		$pdf->Cell(290,5,'Responsabilidades de los Servidores P�blicos y bajo protesta de decir verdad, rindo a usted mi declaraci�n de modificaci�n anual de intereses y situaci�n patrimonial.',0,0,'L',0);

		$pdf->SetFont('Arial','b',7);
		$pdf->Ln();
		$pdf->SetX(15);
		$pdf->Cell(25,5,'PODER: ',0,0,'L',0);
		$pdf->Cell(40,5,mysql_result($datos1,0,'PODER'),0,0,'L',0);

		$pdf->Ln();
		$pdf->SetFont('Arial','b',12);
		$pdf->SetX(15);
		$pdf->Cell(290,5,'I.- DATOS DE IDENTIFICACI�N',0,0,'L',0);

		$pdf->Ln();
		$pdf->Ln();
		$pdf->SetFont('Arial','b',8);
		$pdf->SetX(15);
		$pdf->Cell(25,5,'Apellido Paterno',0,0,'L',0);
		$pdf->Cell(80,5,mysql_result($resResultado,0,'primerapellido'),'RLB',0,'C',0);

		$pdf->Ln();
		$pdf->SetFont('Arial','b',8);
		$pdf->SetX(15);
		$pdf->Cell(25,5,'Apellido Materno',0,0,'L',0);
		$pdf->Cell(80,5,mysql_result($resResultado,0,'segundoapellido'),'RLB',0,'C',0);


		$pdf->Ln();
		$pdf->SetFont('Arial','b',8);
		$pdf->SetX(15);
		$pdf->Cell(25,5,'Nombre (s)',0,0,'L',0);
		$pdf->Cell(80,5,mysql_result($resResultado,0,'nombres'),'RLB',0,'C',0);

		$pdf->Ln();
		$pdf->Ln();
		$pdf->SetFont('Arial','b',8);
		$pdf->SetX(15);
		$pdf->Cell(75,5,mysql_result($datos1,0,'registrofederalcontribuyente'),'RLB',0,'C',0);
		$pdf->Cell(30,5,mysql_result($resResultado,0,'homoclave'),'RLB',0,'C',0);
		$pdf->Cell(70,5,mysql_result($resResultado,0,'curp'),'RLB',0,'C',0);
		$pdf->Cell(45,5,mysql_result($datos1,0,'fechadeclaracionanterior'),'RLB',0,'C',0);
		$pdf->Cell(45,5,mysql_result($datos1,0,'fechatomaposesion'),'RLB',0,'C',0);
		$pdf->Ln();
		$pdf->SetFont('Arial','b',6);
		$pdf->SetX(15);
		$pdf->Cell(75,5,'Registro Federal de Contribuyentes',0,0,'C',0);
		$pdf->Cell(30,5,'Homoclave',0,0,'C',0);
		$pdf->Cell(70,5,'CURP Clave �nica de Registro de Poblaci�n',0,0,'C',0);
		$pdf->Cell(45,5,'AAAA-MM-DD Fecha de la declaraci�n',0,0,'C',0);
		$pdf->MultiCell(45,5,'AAAA-MM-DD Fecha de toma de posesi�n del cargo actual',0,'C',0);

		$pdf->Ln();
		$pdf->Ln();
		$pdf->SetFont('Arial','b',8);
		$pdf->SetX(15);
		$pdf->Cell(132.5,5,mysql_result($datos1,0,'cargoactual'),'RLB',0,'C',0);
		$pdf->Cell(132.5,5,mysql_result($datos1,0,'cargoanterior'),'RLB',0,'C',0);

		$pdf->Ln();
		$pdf->SetFont('Arial','b',6);
		$pdf->SetX(15);
		$pdf->Cell(132.5,5,'Cargo que desempe�a actualmente',0,0,'C',0);
		$pdf->Cell(132.5,5,'Cargo que manifest� en su �ltima declaraci�n',0,0,'C',0);

		$pdf->Ln();
		$pdf->SetFont('Arial','b',8);
		$pdf->SetX(15);
		$pdf->Cell(132.5,5,mysql_result($datos1,0,'areaadquisicion'),'RLB',0,'C',0);
		$pdf->Cell(132.5,5,mysql_result($datos1,0,'areaadquisicionanterior'),'RLB',0,'C',0);

		$pdf->Ln();
		$pdf->SetFont('Arial','b',6);
		$pdf->SetX(15);
		$pdf->Cell(132.5,5,'�rea de adscripci�n actual',0,0,'C',0);
		$pdf->Cell(132.5,5,'�rea de Adscripci�n que manifest� en su �ltima declaraci�n',0,0,'C',0);


		$pdf->Ln();
		$pdf->SetFont('Arial','b',8);
		$pdf->SetX(15);
		$pdf->Cell(152.5,5,mysql_result($resResultado,0,'domicilioparticular'),'RLB',0,'C',0);
		$pdf->Cell(112.5,5,mysql_result($resResultado,0,'localidad'),'RLB',0,'C',0);

		$pdf->Ln();
		$pdf->SetFont('Arial','b',6);
		$pdf->SetX(15);
		$pdf->Cell(152.5,5,'Domicilio oficial (calle y n�mero exterior e interior o piso)',0,0,'C',0);
		$pdf->Cell(112.5,5,'Colonia',0,0,'C',0);


		$pdf->Ln();
		$pdf->SetFont('Arial','b',8);
		$pdf->SetX(15);
		$pdf->Cell(45,5,mysql_result($resResultado,0,'municipio'),'RLB',0,'C',0);
		$pdf->Cell(30,5,mysql_result($resResultado,0,'entidadfederativa'),'RLB',0,'C',0);
		$pdf->Cell(20,5,mysql_result($resResultado,0,'codigopostal'),'RLB',0,'C',0);
		$pdf->Cell(20,5,mysql_result($resResultado,0,'lada'),'RLB',0,'C',0);
		$pdf->Cell(25,5,mysql_result($resResultado,0,'telefono'),'RLB',0,'C',0);
		$pdf->Cell(15,5,'','RLB',0,'C',0);
		$pdf->Ln();
		$pdf->SetFont('Arial','b',6);
		$pdf->SetX(15);
		$pdf->Cell(45,5,'Delegaci�n o Municipio',0,0,'C',0);
		$pdf->Cell(30,5,'Entidad Federativa',0,0,'C',0);
		$pdf->Cell(20,5,'C�digo Postal',0,0,'C',0);
		$pdf->Cell(20,5,'Lada',0,0,'C',0);
		$pdf->Cell(25,5,'Tel�fono Oficial',0,0,'C',0);
		$pdf->Cell(15,5,'Extensi�n',0,0,'C',0);


		$pdf->Ln();
		$pdf->SetFont('Arial','b',8);
		$pdf->SetX(15);
		$pdf->Cell(265,5,mysql_result($resResultado,0,'emailinstitucional'),'RLB',0,'C',0);

		$pdf->Ln();
		$pdf->SetFont('Arial','b',6);
		$pdf->SetX(15);
		$pdf->Cell(152.5,5,'Correo (s) electr�nico (s) oficial (es)',0,0,'L',0);



	}
	/*---------------  FIN SEGUNDA PAGINA ***********************************/


	/*---------------   TERCER PAGINA  ***********************************/
	$datos2a = $serviciosReferencias->traerIngresosanualesPorCabecera($id);
	$datos2b = $serviciosReferencias->traerRecursosPorCabecera($id);
	$datos2c = $serviciosReferencias->traerDecrementosPorCabecera($id);

	$pdf->AddPage();

	$pdf->SetXY(10,10);

	$pdf->SetFont('Arial','b',14);
	$pdf->SetXY(3,10);
	$pdf->SetX(15);
	$pdf->Cell(290,8,'II.- INGRESO ANUAL (Anotar cantidades sin centavos)',0,0,'L',0);
	$pdf->Ln();


	if ((mysql_result($publico, 0,'eningresosnetos') == 'Si') && (mysql_result($publico, 0,'estadeacuerdo') == 'Si')) {
		if (mysql_num_rows($datos2a) > 0) {
			$pdf->Ln();
			$pdf->SetFont('Arial','b',8);
			$pdf->SetX(15);
			$pdf->Cell(165.5,5,'a) Remuneraci�n neta del declarante por los cargos p�blicos desampe�ados...........................',0,0,'L',0);
			$pdf->Cell(100,5,'$ '.(integer)mysql_result($datos2a,0,'remuneracionanualneta'),'RLB',0,'C',0);

			$pdf->Ln();
			$pdf->SetFont('Arial','b',8);
			$pdf->SetX(15);
			$pdf->Cell(165.5,5,'Anote la suma de sueldos, honorarios, compensaciones, gratificaciones,',0,0,'L',0);
			$pdf->Ln();
			$pdf->SetFont('Arial','b',8);
			$pdf->SetX(15);
			$pdf->Cell(165.5,5,'bonos, aguinaldo incluyendo la primera y segunda parte y otras prestaciones que haya recibido.',0,0,'L',0);

			$pdf->Ln();
			$pdf->SetFont('Arial','b',8);
			$pdf->SetX(15);
			$pdf->Cell(165.5,5,'b) Ingresos por pensi�n Decretada por el Congreso del Estado o Ayuntamiento................................................',0,0,'L',0);
			$pdf->Cell(100,5,'$ '.((integer)mysql_result($datos2a,0,'actividadindustrial') + (integer)mysql_result($datos2a,0,'actividadfinanciera') + (integer)mysql_result($datos2a,0,'actividadprofesional')),'RLB',0,'C',0);

			$pdf->Ln();
			$pdf->SetFont('Arial','b',8);
			$pdf->SetX(15);
			$pdf->Cell(165.5,5,'Detalle en la secci�n XIII de observaciones y/o aclaraciones.',0,0,'L',0);


			$pdf->Ln();
			$pdf->SetFont('Arial','b',8);
			$pdf->SetX(15);
			$pdf->Cell(165.5,5,'c) Otros ingresos anuales ................................................................................................................................... ',0,0,'L',0);
			$pdf->Cell(100,5,'$ '.(integer)mysql_result($datos2a,0,'otros'),'RLB',0,'C',0);

			$pdf->Ln();
			$pdf->SetFont('Arial','b',8);
			$pdf->SetX(15);
			$pdf->Cell(165.5,5,'Detalle el concepto de sus otros ingresos en la secci�n XIII de observaciones y/o aclaraciones.',0,0,'L',0);

			$pdf->Ln();
			$pdf->SetFont('Arial','b',8);
			$pdf->SetX(15);
			$pdf->Cell(165.5,5,'INGRESO TOTAL DEL DECLARANTE (suma apartados a+b+c)...................................................................',0,0,'L',0);
			$pdf->Cell(100,5,'$ '.((integer)mysql_result($datos2a,0,'remuneracionanualneta') + (integer)mysql_result($datos2a,0,'otros') + (integer)mysql_result($datos2a,0,'actividadindustrial') + (integer)mysql_result($datos2a,0,'actividadfinanciera') + (integer)mysql_result($datos2a,0,'actividadprofesional')),'RLB',0,'C',0);

			$pdf->Ln();
			$pdf->SetFont('Arial','b',8);
			$pdf->SetX(15);
			$pdf->Cell(165.5,5,'Ingreso anual del (la) c�nyuge, concubino (a) y/o dependientes..........................................................................',0,0,'L',0);
			$pdf->Cell(100,5,'$ '.(integer)mysql_result($datos2a,0,'ingresoanualconyuge'),'RLB',0,'C',0);

			$pdf->Ln();
			$pdf->SetFont('Arial','b',8);
			$pdf->SetX(15);
			$pdf->Cell(165.5,5,'Especificar en el apartado V, en lo relativo a los datos del (la) c�nyuge o concubino (a).',0,0,'L',0);


			$pdf->Ln();
			$pdf->SetFont('Arial','b',8);
			$pdf->SetX(15);
			$pdf->Cell(165.5,5,'TOTAL INGRESOS ANUALES DEL DECLARANTE, CONYUGE, CONCUBINO Y/O DEPENDIENTES...............',0,0,'L',0);
			$pdf->Cell(100,5,'$ '.((integer)mysql_result($datos2a,0,'ingresoanualconyuge') + (integer)mysql_result($datos2a,0,'remuneracionanualneta') + (integer)mysql_result($datos2a,0,'otros') + (integer)mysql_result($datos2a,0,'actividadindustrial') + (integer)mysql_result($datos2a,0,'actividadfinanciera') + (integer)mysql_result($datos2a,0,'actividadprofesional')),'RLB',0,'C',0);
		
		} else {
			$pdf->Ln();
			$pdf->Ln();
			$pdf->SetFont('Arial','b',8);
			$pdf->SetX(15);
			$pdf->Cell(265,5,'Datos no P�blicos.',0,0,'L',0);

		}


		$pdf->Ln();
		$pdf->Ln();
		
		$pdf->SetFont('Arial','b',14);

		$pdf->SetX(15);
		$pdf->Cell(290,8,'III.- APLICACI�N DE RECURSOS',0,0,'L',0);
		$pdf->Ln();

		if (mysql_num_rows($datos2b) > 0) {
			$pdf->Ln();
			$pdf->SetFont('Arial','b',8);
			$pdf->SetX(15);
			$pdf->Cell(165.5,5,'a) Pago de adeudos (Hipoteca, pr�stamos personales, etc.).....................................................................................',0,0,'L',0);
			$pdf->Cell(100,5,'$ '.(integer)mysql_result($datos2b,0,'pagos'),'RLB',0,'C',0);

			$pdf->Ln();
			$pdf->SetFont('Arial','b',8);
			$pdf->SetX(15);
			$pdf->Cell(165.5,5,'b) Otros (Gastos de manutenci�n, renta, etc.).........................................................................................................',0,0,'L',0);
			$pdf->Cell(100,5,'$ '.(integer)mysql_result($datos2b,0,'otros'),'RLB',0,'C',0);


			$pdf->Ln();
			$pdf->SetFont('Arial','b',8);
			$pdf->SetX(15);
			$pdf->Cell(165.5,5,'TOTAL DE RECURSOS APLICADOS (suma a+b)..........................................................................................',0,0,'L',0);
			$pdf->Cell(100,5,'$ '.((integer)mysql_result($datos2b,0,'pagos') + (integer)mysql_result($datos2b,0,'otros')),'RLB',0,'C',0);

		}

		
		$pdf->Ln();
		$pdf->Ln();
		
		$pdf->SetFont('Arial','b',14);

		$pdf->SetX(15);
		$pdf->Cell(290,8,'IV.- DECREMENTOS',0,0,'L',0);
		$pdf->Ln();

		if (mysql_num_rows($datos2c) > 0) {
			$pdf->Ln();
			$pdf->SetFont('Arial','b',8);
			$pdf->SetX(15);
			$pdf->Cell(165.5,5,'a).-Donaciones ....................................................................................................................................................',0,0,'L',0);
			$pdf->Cell(100,5,'$ '.(integer)mysql_result($datos2c,0,'donaciones'),'RLB',0,'C',0);

			$pdf->Ln();
			$pdf->SetFont('Arial','b',8);
			$pdf->SetX(15);
			$pdf->Cell(165.5,5,'b).-Robo .............................................................................................................................................................',0,0,'L',0);
			$pdf->Cell(100,5,'$ '.(integer)mysql_result($datos2c,0,'robo'),'RLB',0,'C',0);

			$pdf->Ln();
			$pdf->SetFont('Arial','b',8);
			$pdf->SetX(15);
			$pdf->Cell(165.5,5,'c).-Siniestro.......................................................................................................................................................',0,0,'L',0);
			$pdf->Cell(100,5,'$ '.(integer)mysql_result($datos2c,0,'siniestros'),'RLB',0,'C',0);

			$pdf->Ln();
			$pdf->SetFont('Arial','b',8);
			$pdf->SetX(15);
			$pdf->Cell(165.5,5,'d).-Otro (especifique en el apartado n�mero XIII de observaciones y/o aclaraciones....................................',0,0,'L',0);
			$pdf->Cell(100,5,'$ '.(integer)mysql_result($datos2c,0,'otros'),'RLB',0,'C',0);


			$pdf->Ln();
			$pdf->SetFont('Arial','b',8);
			$pdf->SetX(15);
			$pdf->Cell(165.5,5,'TOTAL DE DECREMENTOS (suma a+b+c+d) ........................................................................................',0,0,'L',0);
			$pdf->Cell(100,5,'$ '.((integer)mysql_result($datos2c,0,'donaciones') + (integer)mysql_result($datos2c,0,'robo') + (integer)mysql_result($datos2c,0,'siniestros') + (integer)mysql_result($datos2c,0,'otros')),'RLB',0,'C',0);
		}
	}
	/*---------------  FIN TERCER PAGINA ***********************************/



	/*---------------   CUARTA PAGINA  ***********************************/

	$datos4a = $serviciosReferencias->traerDependienteseconomicosPorCabecera($id);

	$pdf->AddPage();

	$pdf->SetXY(10,10);



	$pdf->SetFont('Arial','b',16);
	$pdf->SetXY(3,10);
	$pdf->Cell(150,8,'V.- DATOS GENERALES DEL DECLARANTE:',0,0,'C',0);

	$pdf->SetFont('Arial','b',8);


	$pdf->Cell(100,5,'Estado civil:',0,0,'R',0);
	$pdf->Cell(15,5,mysql_result($resResultadoCompleto,0,'estadocivil'),'RLB',0,'C',0);

	
	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFont('Arial','b',8);
	$pdf->SetX(15);
	$pdf->Cell(165,5,mysql_result($resResultadoCompleto,0,'domicilioparticular'),'RLB',0,'C',0);
	$pdf->Cell(20,5,'',0,0,'C',0);
	$pdf->Cell(80,5,mysql_result($resResultadoCompleto,0,'localidad'),'RLB',0,'C',0);

	$pdf->Ln();
	$pdf->SetFont('Arial','b',6);
	$pdf->SetX(15);
	$pdf->Cell(165,5,'Domicilio particular (Calle y n�mero exterior e interior o piso)',0,0,'C',0);
	$pdf->Cell(20,5,'',0,0,'C',0);
	$pdf->Cell(80,5,'Colonia',0,0,'C',0);


	$pdf->Ln();
	$pdf->SetFont('Arial','b',8);
	$pdf->SetX(15);
	$pdf->Cell(90,5,mysql_result($resResultado,0,'municipio'),'RLB',0,'C',0);
	$pdf->Cell(5,5,'',0,0,'C',0); //lugarcito
	$pdf->Cell(70,5,mysql_result($resResultado,0,'entidadfederativa'),'RLB',0,'C',0);
	$pdf->Cell(5,5,'',0,0,'C',0); //lugarcito
	$pdf->Cell(25,5,mysql_result($resResultado,0,'codigopostal'),'RLB',0,'C',0);
	$pdf->Cell(5,5,'',0,0,'C',0); //lugarcito
	$pdf->Cell(20,5,mysql_result($resResultado,0,'lada'),'RLB',0,'C',0);
	$pdf->Cell(5,5,'',0,0,'C',0); //lugarcito
	$pdf->Cell(40,5,mysql_result($resResultado,0,'telefono'),'RLB',0,'C',0);

	$pdf->Ln();
	$pdf->SetFont('Arial','b',6);
	$pdf->SetX(15);
	$pdf->Cell(90,5,'Delegaci�n o Municipio',0,0,'C',0);
	$pdf->Cell(5,5,'',0,0,'C',0); //lugarcito
	$pdf->Cell(70,5,'Entidad Federativa',0,0,'C',0);
	$pdf->Cell(5,5,'',0,0,'C',0); //lugarcito
	$pdf->Cell(25,5,'C�digo Postal',0,0,'C',0);
	$pdf->Cell(5,5,'',0,0,'C',0); //lugarcito
	$pdf->Cell(20,5,'Lada',0,0,'C',0);
	$pdf->Cell(5,5,'',0,0,'C',0); //lugarcito
	$pdf->Cell(40,5,'Tel�fono Oficial',0,0,'C',0);


	$pdf->Ln();
	$pdf->SetFont('Arial','b',8);
	$pdf->SetX(15);
	$pdf->Cell(90,5,mysql_result($resResultado,0,'emailalterno'),'RLB',0,'C',0);
	$pdf->Cell(10,5,'',0,0,'C',0); //lugarcito
	$pdf->Cell(75,5,mysql_result($resResultado,0,'nacionalidad'),'RLB',0,'C',0);
	$pdf->Cell(10,5,'',0,0,'C',0); //lugarcito
	$pdf->Cell(80,5,mysql_result($resResultado,0,'entidadnacimiento'),'RLB',0,'C',0);


	$pdf->Ln();
	$pdf->SetFont('Arial','b',6);
	$pdf->SetX(15);
	$pdf->Cell(90,5,'Correo (s) electr�nico (s) personal (es)',0,0,'C',0);
	$pdf->Cell(10,5,'',0,0,'C',0); //lugarcito
	$pdf->Cell(75,5,'Nacionalidad',0,0,'C',0);
	$pdf->Cell(10,5,'',0,0,'C',0); //lugarcito
	$pdf->Cell(80,5,'Lugar de nacimiento (Delegaci�n o Municipio / Estado)',0,0,'C',0);



	$pdf->Ln();
	$pdf->SetFont('Arial','b',8);
	$pdf->SetX(15);
	$pdf->Cell(40,5,mysql_result($resResultadoCompleto,0,'fechanacimiento'),'RLB',0,'C',0);
	$pdf->Cell(5,5,'',0,0,'C',0); //lugarcito
	$pdf->Cell(20,5,mysql_result($resResultadoCompleto,0,'edad'),'RLB',0,'C',0);
	$pdf->Cell(5,5,'',0,0,'C',0); //lugarcito
	$pdf->Cell(25,5,(mysql_result($resResultado,0,'sexo') == 1 ? 'F' : 'M'),'RLB',0,'C',0);
	$pdf->Cell(5,5,'',0,0,'C',0); //lugarcito
	$pdf->Cell(90,5,mysql_result($resResultado,0,'estudios'),'RLB',0,'C',0);
	$pdf->Cell(5,5,'',0,0,'C',0); //lugarcito
	$pdf->Cell(70,5,mysql_result($resResultado,0,'cedulaprofesional'),'RLB',0,'C',0);


	$pdf->Ln();
	$pdf->SetFont('Arial','b',6);
	$pdf->SetX(15);
	$pdf->Cell(40,5,'AAAA-MM-DD Fecha de Nacimiento','',0,'C',0);
	$pdf->Cell(5,5,'',0,0,'C',0); //lugarcito
	$pdf->Cell(20,5,'Edad','',0,'C',0);
	$pdf->Cell(5,5,'',0,0,'C',0); //lugarcito
	$pdf->Cell(25,5,'Sexo (M o F)','',0,'C',0);
	$pdf->Cell(5,5,'',0,0,'C',0); //lugarcito
	$pdf->Cell(90,5,'Grado m�ximo de estudios/Especialidad','',0,'C',0);
	$pdf->Cell(5,5,'',0,0,'C',0); //lugarcito
	$pdf->Cell(70,5,'N�mero de c�dula profesional','',0,'C',0);

	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFont('Arial','b',10);
	$pdf->SetX(15);
	$pdf->Cell(75,5,'�Tiene USTED dependientes econ�micos ?','',0,'L',0);


	if (mysql_num_rows($datos4a) > 0) {
		$pdf->Cell(5,5,'Si',0,0,'C',0);
		$pdf->Cell(5,5,'X',1,0,'C',0);
		$pdf->Cell(5,5,'No',0,0,'C',0);
		$pdf->Cell(5,5,'',1,0,'C',0);
	} else {
		$pdf->Cell(5,5,'Si',0,0,'C',0);
		$pdf->Cell(5,5,'',1,0,'C',0);
		$pdf->Cell(5,5,'No',0,0,'C',0);
		$pdf->Cell(5,5,'X',1,0,'C',0);
	}
	$pdf->Cell(155,5,'Si su respuesta es AFIRMATIVA, proporcione sus nombres, edades y parentesco o v�nculo con USTED','',0,'L',0);

	$pdf->Ln();
	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFont('Arial','b',12);
	$pdf->SetX(15);
	$pdf->Cell(265,5,'DATOS DE SUS DEPENDIENTES ECON�MICOS','RLTB',0,'C',0);

	$pdf->Ln();
	$pdf->SetFont('Arial','',12);
	$pdf->SetX(15);
	$pdf->Cell(110,5,'Nombre','RLTB',0,'C',0);
	$pdf->Cell(45,5,'Edad','RLTB',0,'C',0);
	$pdf->Cell(110,5,'HERMANA','RLTB',0,'C',0);

	while ($row4 = mysql_fetch_array($datos4a)) {
		$pdf->Ln();
		$pdf->SetFont('Arial','',12);
		$pdf->SetX(15);
		$pdf->Cell(110,5,$row4['nombre'],'RLTB',0,'C',0);
		$pdf->Cell(45,5,$row4['edad'],'RLTB',0,'C',0);
		$pdf->Cell(110,5,$row4['tipoparentesco'],'RLTB',0,'C',0);
	}



	/*---------------  FIN CUARTA PAGINA ***********************************/

	/*---------------      QUINTA PAGINA ***********************************/
	$datos5a = $serviciosReferencias->traerBienesmueblesGridPorCabecera($id);
	$datos5b = $serviciosReferencias->traerVehiculosGridPorCabecera($id);

	$pdf->AddPage();

	$pdf->SetXY(10,10);



	$pdf->SetFont('Arial','b',16);
	$pdf->SetXY(15,10);
	$pdf->Cell(150,8,'VI.-BIENES MUEBLES',0,0,'L',0);

	if ((mysql_result($publico, 0,'enbienesmuebles') == 'Si') && (mysql_result($publico, 0,'estadeacuerdo') == 'Si')) {
		$pdf->Ln();
		$pdf->Ln();
		$pdf->SetFont('Arial','',10);
		$pdf->SetX(15);
		$pdf->Cell(265,5,'Independientemente de anotar si vendi� alg�n bien, tambi�n deber� indicar si Adquiri� otro, anotando la clave, el tipo de operaci�n y forma de pago.','',0,'L',0);

		$pdf->Ln();
		$pdf->Ln();
		$pdf->SetFont('Arial','b',10);
		$pdf->SetX(15);
		$pdf->Cell(100,5,'Tipo de Bien','RLTB',0,'C',0);
		$pdf->Cell(50,5,'Valor del bien mueble','RLTB',0,'C',0);
		$pdf->Cell(65,5,'Tipo de Operaci�n','RLTB',0,'C',0);
		$pdf->Cell(50,5,'Forma de Pago','RLTB',0,'C',0);

		while ($row5 = mysql_fetch_array($datos5a)) {
			$pdf->Ln();
			$pdf->SetFont('Arial','',10);
			$pdf->SetX(15);
			$pdf->Cell(100,5,$row5['tipobien'],'RLTB',0,'C',0);
			$pdf->Cell(50,5,'$ '.$row5['valor'],'RLTB',0,'C',0);
			$pdf->Cell(65,5,$row5['tipooperacion'],'RLTB',0,'C',0);
			$pdf->Cell(50,5,$row5['formaadquisicion'],'RLTB',0,'C',0);
		}

		$pdf->Ln();
		$pdf->Ln();
	} else {
		$pdf->Ln();
		$pdf->Ln();
		$pdf->SetFont('Arial','b',10);
		$pdf->SetX(15);
		$pdf->Cell(265,5,'Datos no P�blicos','',0,'C',0);
		$pdf->Ln();
		$pdf->Ln();
	}


	$pdf->SetFont('Arial','b',16);
	$pdf->SetX(15);
	$pdf->Cell(150,8,'VII.- VEHICULOS',0,0,'L',0);

	if ((mysql_result($publico, 0,'envehiculos') == 'Si') && (mysql_result($publico, 0,'estadeacuerdo') == 'Si')) {
		$pdf->Ln();
		$pdf->Ln();
		$pdf->SetFont('Arial','',10);
		$pdf->SetX(15);
		$pdf->Cell(265,5,'Anote "A", si el veh�culo registrado fue adquirido � "B" si el veh�culo pas� ser propiedad de otra persona, se�alando l tipo de operaci�n que se llev� a cabo.','',0,'L',0);

		$pdf->Ln();
		$pdf->Ln();
		$pdf->SetFont('Arial','b',9);
		$pdf->SetX(15);
		$pdf->Cell(10,5,'Tipo','RLTB',0,'C',0);
		$pdf->Cell(30,5,'Tipo de Operaci�n','RLTB',0,'C',0);
		$pdf->Cell(25,5,'Forma de Pago','RLTB',0,'C',0);
		$pdf->Cell(98,5,'Marca, Tipo, Modelo y Nro de Serie','RLTB',0,'C',0);
		$pdf->Cell(18,5,'Fecha','RLTB',0,'C',0);
		$pdf->Cell(25,5,'Valor','RLTB',0,'C',0);
		$pdf->Cell(25,5,'Propietario','RLTB',0,'C',0);
		$pdf->Cell(40,5,'Entidad Fed.','RLTB',0,'C',0);

		while ($row5 = mysql_fetch_array($datos5b)) {
			$pdf->Ln();
			$pdf->SetFont('Arial','',9);
			$pdf->SetX(15);
			$pdf->Cell(10,5,$row5['estado'],'RLTB',0,'C',0);
			$pdf->Cell(30,5,$row5['tipooperacion'],'RLTB',0,'C',0);
			$pdf->Cell(25,5,$row5['formaadquisicion'],'RLTB',0,'C',0);
			$pdf->Cell(98,5,$row5['vehiculo'],'RLTB',0,'C',0);
			$pdf->Cell(18,5,$row5['fechaadquisicion'],'RLTB',0,'C',0);
			$pdf->Cell(25,5,'$ '.$row5['valor'],'RLTB',0,'C',0);
			$pdf->Cell(25,5,$row5['titular'],'RLTB',0,'C',0);
			$pdf->Cell(40,5,$row5['entidadfederativa'],'RLTB',0,'C',0);

		}
	} else {
		$pdf->Ln();
		$pdf->Ln();
		$pdf->SetFont('Arial','b',10);
		$pdf->SetX(15);
		$pdf->Cell(265,5,'Datos no P�blicos','',0,'C',0);
	}

	/*---------------  FIN QUINTA PAGINA ***********************************/


	/*---------------      SEXTA PAGINA ***********************************/
	$datos6a = $serviciosReferencias->traerBienesinmueblesGridPorCabecera($id);


	$pdf->AddPage();

	$pdf->SetXY(10,10);



	$pdf->SetFont('Arial','b',16);
	$pdf->SetXY(15,10);
	$pdf->Cell(150,8,'VIII.- BIENES INMUEBLES',0,0,'L',0);

	if ((mysql_result($publico, 0,'enbienesinmuebles') == 'Si') && (mysql_result($publico, 0,'estadeacuerdo') == 'Si')) {
		$pdf->Ln();
		$pdf->Ln();
		$pdf->SetFont('Arial','',10);
		$pdf->SetX(15);
		$pdf->Cell(265,5,'Anote "A", si el inmueble registrado fue adquirido � "B" si el inmueble pas� a ser propiedad de otra persona, se�alando el tipo de operaci�n que se llev� a cabo.','',0,'L',0);

		
		
		

		while ($row5 = mysql_fetch_array($datos6a)) {

			$pdf->Ln();
			$pdf->Ln();
			$pdf->SetFont('Arial','b',10);
			$pdf->SetX(15);
			$pdf->Cell(90,5,'Tipo de Bien','RLTB',0,'C',0);
			$pdf->Cell(10,5,'Tipo','RLTB',0,'C',0);
			$pdf->Cell(35,5,'Tipo de Operaci�n','RLTB',0,'C',0);
			$pdf->Cell(30,5,'Forma de Pago','RLTB',0,'C',0);
			$pdf->Cell(60,5,'Registro Publico','RLTB',0,'C',0);
			$pdf->Cell(40,5,'Valor del Inmueble','RLTB',0,'C',0);
			$pdf->Ln();
			$pdf->SetFont('Arial','',10);
			$pdf->SetX(15);
			$pdf->Cell(90,5,$row5['tipobien'],'RLTB',0,'C',0);
			$pdf->Cell(10,5,$row5['estado'],'RLTB',0,'C',0);
			$pdf->Cell(35,5,$row5['tipooperacion'],'RLTB',0,'C',0);
			$pdf->Cell(30,5,$row5['formaadquisicion'],'RLTB',0,'C',0);
			$pdf->Cell(60,5,$row5['registropublico'],'RLTB',0,'C',0);
			$pdf->Cell(40,5,'$'.$row5['valor'],'RLTB',0,'C',0);


			$pdf->Ln();
			$pdf->Ln();
			$pdf->SetFont('Arial','b',10);
			$pdf->SetX(15);
			$pdf->Cell(145,5,'Ubicaci�n del Inmueble','RLTB',0,'C',0);
			$pdf->Cell(35,5,'Fecha Adquisici�n','RLTB',0,'C',0);
			$pdf->Cell(30,5,'Titular','RLTB',0,'C',0);
			$pdf->Cell(25,5,'Terreno M2','RLTB',0,'C',0);
			$pdf->Cell(30,5,'Construcci�n M2','RLTB',0,'C',0);
			$pdf->Ln();
			$pdf->SetFont('Arial','',10);
			$pdf->SetX(15);
			$pdf->Cell(145,5,$row5['ubicacion'],'RLTB',0,'C',0);
			$pdf->Cell(35,5,$row5['fechaadquisicion'],'RLTB',0,'C',0);
			$pdf->Cell(30,5,$row5['titular'],'RLTB',0,'C',0);
			$pdf->Cell(25,5,$row5['mtrsterreno'],'RLTB',0,'C',0);
			$pdf->Cell(30,5,$row5['mtrsconstruccion'],'RLTB',0,'C',0);


		}
	} else {
		$pdf->Ln();
		$pdf->Ln();
		$pdf->SetFont('Arial','b',10);
		$pdf->SetX(15);
		$pdf->Cell(265,5,'Datos no P�blicos','',0,'C',0);
	}

	/*---------------  FIN SEXTA PAGINA ***********************************/


	/*---------------      SEPTIMA PAGINA ***********************************/
	$datos7a = $serviciosReferencias->traerInversionesGridPorCabecera($id);


	$pdf->AddPage();

	$pdf->SetXY(10,10);



	$pdf->SetFont('Arial','b',16);
	$pdf->SetXY(15,10);
	$pdf->Cell(150,8,'IX.- INVERSIONES',0,0,'L',0);

	if ((mysql_result($publico, 0,'eninversiones') == 'Si') && (mysql_result($publico, 0,'estadeacuerdo') == 'Si')) {
		$pdf->Ln();
		$pdf->Ln();
		$pdf->SetFont('Arial','b',10);
		$pdf->SetX(15);
		$pdf->Cell(50,5,'Tipo de Inversi�n','RLTB',0,'C',0);
		$pdf->Cell(35,5,'Tipo de Operaci�n','RLTB',0,'C',0);
		$pdf->Cell(35,5,'Numero de Cuenta','RLTB',0,'C',0);
		$pdf->Cell(43,5,'Razon Social','RLTB',0,'C',0);
		$pdf->SetFont('Arial','b',8);
		$pdf->Cell(42,5,'Saldo al 31/12 del a�o anterior','RLTB',0,'C',0);
		$pdf->SetFont('Arial','b',10);
		$pdf->Cell(25,5,'Nacionalidad','RLTB',0,'C',0);
		$pdf->Cell(30,5,'Moneda','RLTB',0,'C',0);
		
		

		while ($row5 = mysql_fetch_array($datos7a)) {

			
			$pdf->Ln();
			$pdf->SetFont('Arial','',10);
			$pdf->SetX(15);
			$pdf->Cell(50,5,$row5['tipoinversion'],'RLTB',0,'C',0);
			$pdf->Cell(35,5,$row5['tipooperacion'],'RLTB',0,'C',0);
			$pdf->Cell(35,5,$row5['numerocuenta'],'RLTB',0,'C',0);
			$pdf->Cell(43,5,$row5['razonsocial'],'RLTB',0,'C',0);
			$pdf->Cell(42,5,$row5['saldo'],'RLTB',0,'C',0);
			$pdf->Cell(25,5,$row5['donde'],'RLTB',0,'C',0);
			$pdf->Cell(30,5,$row5['tipomoneda'],'RLTB',0,'C',0);


		}

	} else {
		$pdf->Ln();
		$pdf->Ln();
		$pdf->SetFont('Arial','b',10);
		$pdf->SetX(15);
		$pdf->Cell(265,5,'Datos no P�blicos','',0,'C',0);
	}

	/*---------------  FIN SEPTIMA PAGINA ***********************************/


	/*---------------      OCTAVA PAGINA ***********************************/
	$datos8a = $serviciosReferencias->traerAdeudosGridPorCabecera($id);


	$pdf->AddPage();

	$pdf->SetXY(10,10);



	$pdf->SetFont('Arial','b',16);
	$pdf->SetXY(15,10);
	$pdf->Cell(150,8,'XI.- GRAVAMENES O ADEUDOS',0,0,'L',0);

	$pdf->Ln();

	if ((mysql_result($publico, 0,'enadeudos') == 'Si') && (mysql_result($publico, 0,'estadeacuerdo') == 'Si')) {

		while ($row5 = mysql_fetch_array($datos8a)) {

			$pdf->Ln();
			$pdf->Ln();
			$pdf->SetFont('Arial','b',10);
			$pdf->SetX(15);
			$pdf->Cell(55,5,'Tipo de Adeudo','RLTB',0,'C',0);
			$pdf->Cell(55,5,'Nro Cuenta o Contrato','RLTB',0,'C',0);
			$pdf->Cell(75,5,'Instituci�n o Acreedor','RLTB',0,'C',0);
			$pdf->Cell(80,5,'Saldo al 31/12 del a�o anterior','RLTB',0,'C',0);
			$pdf->Ln();
			$pdf->SetFont('Arial','',10);
			$pdf->SetX(15);
			$pdf->Cell(55,5,$row5['tipoadeudo'],'RLTB',0,'C',0);
			$pdf->Cell(55,5,$row5['numerocuenta'],'RLTB',0,'C',0);
			$pdf->Cell(75,5,$row5['razonsocial'],'RLTB',0,'C',0);
			$pdf->Cell(80,5,$row5['saldo'],'RLTB',0,'C',0);


			$pdf->Ln();
			$pdf->Ln();
			$pdf->SetFont('Arial','b',9);
			$pdf->SetX(15);
			$pdf->Cell(190,5,'Si su adeudo o gravamen es por cr�dito hipotecario, embargo o compra a cr�dito de un inmueble, debe especificar el ','',0,'C',0);
			$pdf->Cell(75,5,'Importe total del cr�dito: $ '.$row5['montooriginal'],'RLTB',0,'L',0);


			$pdf->Ln();
			$pdf->SetFont('Arial','b',10);
			$pdf->SetX(15);
			$pdf->Cell(60,5,'Registro P�blico de la Propiedad','',0,'L',0);
			$pdf->Cell(50,5,$row5['registropublico'],'RLB',0,'C',0);
			$pdf->Cell(5,5,'','',0,'C',0);
			$pdf->Cell(65,5,$row5['fechaotorgamiento'],'RLB',0,'C',0);
			$pdf->Cell(5,5,'','',0,'C',0);
			$pdf->Cell(65,5,$row5['plazo'],'RLB',0,'C',0);
			$pdf->Ln();
			$pdf->SetFont('Arial','b',10);
			$pdf->SetX(15);
			$pdf->Cell(60,5,'','',0,'L',0);
			$pdf->Cell(50,5,'','',0,'C',0);
			$pdf->Cell(70,5,'AAAA-MM-DD Fecha que adquiere el adeudo','',0,'C',0);
			$pdf->Cell(80,5,'Plazo a pagar en meses','',0,'C',0);

			$pdf->Ln();
			$pdf->SetFont('Arial','b',10);
			$pdf->SetX(15);
			$pdf->Cell(35,5,'Titular','',0,'L',0);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(65,5,$row5['titular'],'RLB',0,'C',0);

			$pdf->SetFont('Arial','',10);
			$pdf->Ln();
			$pdf->SetX(15);
			$pdf->Cell(265,5,'_______________________________________________________________________________________________________________________________________','',0,'L',0);


		}
	} else {
		$pdf->Ln();
		$pdf->Ln();
		$pdf->SetFont('Arial','b',10);
		$pdf->SetX(15);
		$pdf->Cell(265,5,'Datos no P�blicos','',0,'C',0);
	}

	/*---------------  FIN OCTAVA PAGINA ***********************************/

	/*---------------      NOVENA PAGINA ***********************************/
	$datos9a = $serviciosReferencias->traerConflictoeconomicaGridPorCabecera($id);
	


	$pdf->AddPage();

	$pdf->SetXY(10,10);



	$pdf->SetFont('Arial','b',16);
	$pdf->SetXY(15,10);
	$pdf->Cell(150,8,'XII.- DECLARACI�N DE INTERESES',0,0,'L',0);

	
	$pdf->Ln();
	$pdf->SetFont('Arial','b',10);
	$pdf->SetX(15);
	$pdf->Cell(180,5,'ESTOY DE ACUERDO EN HACER P�BLICA LA INFORMACI�N DE POSIBLE CONFLICTO DE INTERESES','',0,'L',0);
	if ((mysql_result($publico, 0,'enconflictos') == 'Si') && (mysql_result($publico, 0,'estadeacuerdo') == 'Si')) {
		$pdf->Cell(5,5,'Si',0,0,'C',0);
		$pdf->Cell(5,5,'X',1,0,'C',0);
		$pdf->Cell(5,5,'No',0,0,'C',0);
		$pdf->Cell(5,5,'',1,0,'C',0);
	} else {
		$pdf->Cell(5,5,'Si',0,0,'C',0);
		$pdf->Cell(5,5,'',1,0,'C',0);
		$pdf->Cell(5,5,'No',0,0,'C',0);
		$pdf->Cell(5,5,'X',1,0,'C',0);
	}

	$pdf->Ln();
	$pdf->SetFont('Arial','',9);
	$pdf->SetX(15);
	$pdf->Cell(265,5,'POSIBLES CONFLICTOS DE INTERESES POR PARTICIPACIONES ECON�MICAS O FINANCIERAS DEL C�NYUGE, CONCUBINO, CONCUBINA Y/O DEPENDIENTES ECON�MICOS.','',0,'L',0);

	$pdf->Ln();
	$pdf->SetFont('Arial','',9);
	$pdf->Ln();
	$pdf->SetX(15);
	$pdf->Cell(265,5,'Descripci�n: Se refiere a participaciones econ�micas o financieras, as� como aquellos convenios, contratos, compromisos o acuerdos con un valor econ�mico presente o futuro que tenga el','',0,'L',0);
	$pdf->Ln();
	$pdf->SetX(15);
	$pdf->Cell(265,5,'(la) c�nyuge, concubino(a) y/o dependientes econ�micos con personas f�sicas o morales y que el servidor p�blico tenga conocimiento de un posible conflicto de inter�s y que no pueden ser','',0,'L',0);
	$pdf->Ln();
	$pdf->SetX(15);
	$pdf->Cell(265,5,'incluidos en alguna de las secciones anteriores.','',0,'L',0);

	if ((mysql_result($publico, 0,'enconflictos') == 'Si') && (mysql_result($publico, 0,'estadeacuerdo') == 'Si')) {

		$pdf->Ln();
		$pdf->Ln();

		while ($row5 = mysql_fetch_array($datos9a)) {

			
			$pdf->SetFont('Arial','b',9);
			$pdf->SetX(15);
			$pdf->Cell(75,5,'Nombre de la persona fisica, empresa o sociedad','RLTB',0,'C',0);
			$pdf->Cell(60,5,'Responsable de conflicto de intereses','RLTB',0,'C',0);
			$pdf->SetFont('Arial','b',8);
			$pdf->Cell(55,5,'Fecha de constituci�n de la sociedad','RLTB',0,'C',0);
			$pdf->SetFont('Arial','b',9);
			$pdf->Cell(75,5,'Inscrpcion en el registro publico u otro dato','RLTB',0,'C',0);
			$pdf->Ln();
			$pdf->SetFont('Arial','',9);
			$pdf->SetX(15);
			$pdf->Cell(75,5,$row5['descripcion'],'RLTB',0,'C',0);
			$pdf->Cell(60,5,$row5['responsable'],'RLTB',0,'C',0);
			$pdf->Cell(55,5,$row5['fecha'],'RLTB',0,'C',0);
			$pdf->Cell(75,5,$row5['inscripcion'],'RLTB',0,'C',0);


			$pdf->Ln();
			$pdf->Ln();
			$pdf->SetFont('Arial','b',9);
			$pdf->SetX(15);
			$pdf->Cell(35,5,'Sector o industria','RLTB',0,'C',0);
			$pdf->Cell(100,5,'Tipo de sociedad en la que se participa o con la que se contrata','RLTB',0,'C',0);
			$pdf->Cell(60,5,'Tipo de participacion o contrato','RLTB',0,'C',0);
			$pdf->Cell(70,5,'Especifica','RLTB',0,'C',0);
			$pdf->Ln();
			$pdf->SetFont('Arial','',9);
			$pdf->SetX(15);
			$pdf->Cell(35,5,$row5['sector'],'RLTB',0,'C',0);
			$pdf->Cell(100,5,$row5['tiposociedad'],'RLTB',0,'C',0);
			$pdf->Cell(60,5,$row5['participacion'],'RLTB',0,'C',0);
			$pdf->Cell(70,5,$row5['especifica'],'RLTB',0,'C',0);


			$pdf->Ln();
			$pdf->Ln();
			$pdf->SetFont('Arial','b',9);
			$pdf->SetX(15);
			$pdf->Cell(80,5,'Antig�edad de la participaci�n o convenio(a�os)','RLTB',0,'C',0);
			$pdf->Cell(60,5,'Inicio de participaci�n o contrato','RLTB',0,'C',0);
			$pdf->Cell(80,5,'Ubicaci�n','RLTB',0,'C',0);

			$pdf->Ln();
			$pdf->SetFont('Arial','',9);
			$pdf->SetX(15);
			$pdf->Cell(80,5,$row5['antiguedad'],'RLTB',0,'C',0);
			$pdf->Cell(60,5,$row5['inicioparticipacion'],'RLTB',0,'C',0);
			$pdf->Cell(80,5,$row5['ubicacion'],'RLTB',0,'C',0);

			$pdf->SetFont('Arial','',10);
			$pdf->Ln();
			$pdf->SetX(15);
			$pdf->Cell(265,5,'_______________________________________________________________________________________________________________________________________','',0,'L',0);



			


		}
	} else {
		$pdf->Ln();
		$pdf->Ln();
		$pdf->SetFont('Arial','b',10);
		$pdf->SetX(15);
		$pdf->Cell(265,5,'Datos no P�blicos','',0,'C',0);
	}

	/*---------------  FIN NOVENA PAGINA ***********************************/

	/*---------------      DECIMA PAGINA ***********************************/
	$datos9b = $serviciosReferencias->traerConflictopuestosGridPorCabecera($id);


	$pdf->AddPage();

	$pdf->SetXY(10,10);


	$pdf->Ln();
	$pdf->SetFont('Arial','b',9);
	$pdf->SetX(15);
	$pdf->Cell(265,5,'POR PUESTO, CARGO, COMISI�N, ACTIVIDADES O PODERES DEL C�NYUGE, CONCUBINO, CONCUBINA Y/O DEPENDIENTES ECON�MICOS QUE','',0,'L',0);
	$pdf->Ln();
	$pdf->SetX(15);
	$pdf->Cell(265,5,'ACTUALMENTE TENGA EN ASOCIACIONES, CONSEJOS, ACTIVIDADES FILANTR�PICAS Y/O CONSULTORIA.','',0,'L',0);

	$pdf->Ln();
	$pdf->SetFont('Arial','',9);
	$pdf->Ln();
	$pdf->SetX(15);
	$pdf->Cell(265,5,'Descripci�n: Se refiere a participaciones econ�micas o financieras, as� como aquellos convenios, contratos, compromisos o acuerdos con un valor econ�mico presente o futuro que tenga el','',0,'L',0);
	$pdf->Ln();
	$pdf->SetX(15);
	$pdf->Cell(265,5,'(la) c�nyuge, concubino(a) y/o dependientes econ�micos con personas f�sicas o morales y que el servidor p�blico tenga conocimiento de un posible conflicto de inter�s y que no pueden ser','',0,'L',0);
	$pdf->Ln();
	$pdf->SetX(15);
	$pdf->Cell(265,5,'incluidos en alguna de las secciones anteriores.','',0,'L',0);


	if ((mysql_result($publico, 0,'enconflictos') == 'Si') && (mysql_result($publico, 0,'estadeacuerdo') == 'Si')) {
		$pdf->Ln();
		$pdf->Ln();

		while ($row5 = mysql_fetch_array($datos9b)) {

			
			$pdf->SetFont('Arial','b',9);
			$pdf->SetX(15);
			$pdf->SetFont('Arial','b',9);
			$pdf->Cell(60,5,'Responsable de conflicto de intereses','RLTB',0,'C',0);
			$pdf->Cell(95,5,'Nombre de la entidad (empresa, asociaci�n, sindicato, etc)','RLTB',0,'C',0);
			$pdf->Cell(35,5,'Vinculos','RLTB',0,'C',0);
			$pdf->Cell(25,5,'Antig�edad','RLTB',0,'C',0);
			$pdf->Cell(25,5,'Frecuencia Anual','RLTB',0,'C',0);
			$pdf->Ln();
			$pdf->SetFont('Arial','',9);
			$pdf->SetX(15);
			$pdf->Cell(60,5,$row5['responsable'],'RLTB',0,'C',0);
			$pdf->Cell(95,5,$row5['descripcion'],'RLTB',0,'C',0);
			$pdf->Cell(35,5,$row5['vinculo'],'RLTB',0,'C',0);
			$pdf->Cell(25,5,$row5['antiguedad'],'RLTB',0,'C',0);
			$pdf->Cell(25,5,$row5['frecuenciaanual'],'RLTB',0,'C',0);


			$pdf->Ln();
			$pdf->Ln();
			$pdf->SetFont('Arial','b',9);
			$pdf->SetX(15);
			$pdf->Cell(35,5,'Participaci�n en la direcci�n o administraci�n','RLTB',0,'C',0);
			$pdf->Cell(100,5,'Tipo de persona jur�dica','RLTB',0,'C',0);
			$pdf->Cell(60,5,'Tipo de colaboraci�n o aporte','RLTB',0,'C',0);
			$pdf->Cell(70,5,'Ubicaci�n','RLTB',0,'C',0);
			$pdf->Ln();
			$pdf->SetFont('Arial','',9);
			$pdf->SetX(15);
			$pdf->Cell(35,5,$row5['participacion'],'RLTB',0,'C',0);
			$pdf->Cell(100,5,$row5['personajuridica'],'RLTB',0,'C',0);
			$pdf->Cell(60,5,$row5['colaboracion'],'RLTB',0,'C',0);
			$pdf->Cell(70,5,$row5['ubicacion'],'RLTB',0,'C',0);


			$pdf->SetFont('Arial','',10);
			$pdf->Ln();
			$pdf->SetX(15);
			$pdf->Cell(265,5,'_______________________________________________________________________________________________________________________________________','',0,'L',0);



			


		}

	} else {
		$pdf->Ln();
		$pdf->Ln();
		$pdf->SetFont('Arial','b',10);
		$pdf->SetX(15);
		$pdf->Cell(265,5,'Datos no P�blicos','',0,'C',0);
	}

	/*---------------  FIN DECIMA PAGINA ***********************************/


	/*---------------      DECIMA-PRIMERA PAGINA ***********************************/
	$datos10a = $serviciosReferencias->traerObservacionesGridPorCabecera($id);


	$pdf->AddPage();

	$pdf->SetXY(10,10);



	$pdf->SetFont('Arial','b',16);
	$pdf->SetXY(15,10);
	$pdf->Cell(150,8,'XIII.- OBSERVACIONES Y/O ACLARACIONES',0,0,'L',0);


	$pdf->Ln();
	$pdf->SetFont('Arial','b',9);
	$pdf->SetX(15);
	$pdf->Cell(265,5,'LO DECLARADO ANTERIORMENTE ES CONFIDENCIAL','RLTB',0,'L',0);
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Ln();

	$pdf->Ln();
	$pdf->SetFont('Arial','',8);
	$pdf->Ln();
	$pdf->SetX(15);
	$pdf->Cell(265,5,'C. Secretario de la Contralor�a del Estado y/o C. Auditor General de la Entidad Superior de Auditor�a y Fiscalizaci�n del Congreso del Estado, solicito se sirva tener por ','',0,'L',0);
	$pdf->Ln();
	$pdf->SetX(15);
	$pdf->Cell(265,5,'presentada esta declaraci�n, pidiendo me sea otorgado el acuse de recibo correspondiente.
','',0,'L',0);

	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetX(15);
	$pdf->Cell(265,5,'As� mismo y para efectos de lo se�alado en el art�culo 81 de la Ley de Estatal de Responsabilidades de los Servidores P�blicos, manifiesto expresamente mi autorizaci�n ','',0,'L',0);
	$pdf->Ln();
	$pdf->SetX(15);
	$pdf->Cell(265,5,'para que se verifique y coteje, el contenido de esta Declaraci�n, ante cualquier Instituci�n.','',0,'L',0);

	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetX(15);
	$pdf->Cell(265,5,'Fecha de env�o: Cuernavaca, Morelos a','',0,'L',0);


	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetX(15);
	$pdf->Cell(265,5,'NOTA: El Servidor p�blico ha manifestado su patrimonio BAJO PROTESTA DE DECIR VERDAD, en consecuencia se le apercibe para que se conduzca con verdad en lo ','',0,'L',0);
	$pdf->Ln();
	$pdf->SetX(15);
	$pdf->Cell(265,5,'declarado. As� mismo, se hace de su conocimiento lo se�alado en el art�culo 221 del C�digo Penal para el Estado de Morelos que al respecto se�ala:','',0,'L',0);



	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetX(15);
	$pdf->Cell(265,5,'"Al que teniendo legalmente la obligaci�n de conducirse con verdad en un acto ante la autoridad, apercibido por �sta, en caso de ser procedente el apercibimiento, se ','',0,'L',0);
	$pdf->Ln();
	$pdf->SetX(15);
	$pdf->Cell(265,5,'condujere con falsedad u ocultare la verdad, se le impondr� prisi�n de tres meses a dos a�os".','',0,'L',0);



	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetX(15);
	if (mysql_num_rows($datos10a) > 0) {
		$pdf->MultiCell(265,5,mysql_result($datos10a, 0,'observacion'),1,'L');
	}



	

	/*---------------  FIN DECIMA-PRIMERA PAGINA ***********************************/

	$nombreArchivo = "DeclaracionPatrimonial.pdf";

	$pdf->Output($nombreArchivo,'I');
} else {
	echo '<h1>No existe datos</h1>';	
}
/*
require('fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'�Hola, Mundo!');
$pdf->Output();
*/
?>

