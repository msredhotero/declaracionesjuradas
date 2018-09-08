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
	// Títulos de las columnas

	$pdf->AddPage();

	$pdf->SetXY(10,10);



	$pdf->SetFont('Arial','b',20);
	$pdf->SetXY(3,50);
	$pdf->Cell(290,8,'Secretaría de la Contraloría',0,0,'C',0);

	$pdf->Ln();
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Cell(290,8,'DECLARACIÓN DE MODIFICACIÓN ANUAL',0,0,'C',0);
	$pdf->Ln();
	$pdf->Cell(290,8,'DE INTERESES Y SITUACIÓN PATRIMONIAL',0,0,'C',0);


	/*---------------  FIN PRIMERA PAGINA ***********************************/



	/*---------------   SEGUNDA PAGINA  ***********************************/
	$datos1 = $serviciosReferencias->traerDeclaracionanualinteresGridPorCabecera($id);

	$pdf->AddPage();

	$pdf->SetXY(10,10);



	$pdf->SetFont('Arial','b',18);
	$pdf->SetXY(3,10);
	$pdf->Cell(290,8,'DECLARACIÓN DE MODIFICACIÓN ANUAL',0,0,'C',0);
	$pdf->Ln();
	$pdf->Cell(290,8,'DE INTERESES Y DE SITUACIÓN PATRIMONIAL',0,0,'C',0);
	$pdf->Ln();
	$pdf->Ln();

	if (mysql_num_rows($datos1) > 0) {
		$pdf->SetFont('Arial','b',8);
		$pdf->Cell(290,5,'MODIFICACIONES ENTRE EL 1o. DE ENERO Y EL 31 DE DICIEMBRE DEL AÑO ANTERIOR',0,0,'C',0);
		$pdf->Ln();

		$pdf->Cell(100,5,'C. SECRETARIO DE LA CONTRALORÍA',0,0,'R',0);
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

		$pdf->Cell(160,5,'ES MI DESEO HACER PÚBLICA A LA INFORMACIÓN CONFIDENCIAL: ',0,0,'C',0);
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
		$pdf->Cell(290,5,'Quien suscribe, en cumplimiento a lo dispuesto en el artículo 133 bis de la Constitución Política del Estado Libre y Soberano de Morelos así como al artículo 75 de la Ley Estatal de',0,0,'L',0);
		$pdf->Ln();
		$pdf->SetX(15);
		$pdf->Cell(290,5,'Responsabilidades de los Servidores Públicos y bajo protesta de decir verdad, rindo a usted mi declaración de modificación anual de intereses y situación patrimonial.',0,0,'L',0);

		$pdf->SetFont('Arial','b',7);
		$pdf->Ln();
		$pdf->SetX(15);
		$pdf->Cell(25,5,'PODER: ',0,0,'L',0);
		$pdf->Cell(40,5,mysql_result($datos1,0,'PODER'),0,0,'L',0);

		$pdf->Ln();
		$pdf->SetFont('Arial','b',12);
		$pdf->SetX(15);
		$pdf->Cell(290,5,'I.- DATOS DE IDENTIFICACIÓN',0,0,'L',0);

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
		$pdf->Cell(70,5,'CURP Clave Única de Registro de Población',0,0,'C',0);
		$pdf->Cell(45,5,'AAAA-MM-DD Fecha de la declaración',0,0,'C',0);
		$pdf->MultiCell(45,5,'AAAA-MM-DD Fecha de toma de posesión del cargo actual',0,'C',0);

		$pdf->Ln();
		$pdf->Ln();
		$pdf->SetFont('Arial','b',8);
		$pdf->SetX(15);
		$pdf->Cell(132.5,5,mysql_result($datos1,0,'cargoactual'),'RLB',0,'C',0);
		$pdf->Cell(132.5,5,mysql_result($datos1,0,'cargoanterior'),'RLB',0,'C',0);

		$pdf->Ln();
		$pdf->SetFont('Arial','b',6);
		$pdf->SetX(15);
		$pdf->Cell(132.5,5,'Cargo que desempeña actualmente',0,0,'C',0);
		$pdf->Cell(132.5,5,'Cargo que manifestó en su última declaración',0,0,'C',0);

		$pdf->Ln();
		$pdf->SetFont('Arial','b',8);
		$pdf->SetX(15);
		$pdf->Cell(132.5,5,mysql_result($datos1,0,'areaadquisicion'),'RLB',0,'C',0);
		$pdf->Cell(132.5,5,mysql_result($datos1,0,'areaadquisicionanterior'),'RLB',0,'C',0);

		$pdf->Ln();
		$pdf->SetFont('Arial','b',6);
		$pdf->SetX(15);
		$pdf->Cell(132.5,5,'Área de adscripción actual',0,0,'C',0);
		$pdf->Cell(132.5,5,'Área de Adscripción que manifestó en su última declaración',0,0,'C',0);


		$pdf->Ln();
		$pdf->SetFont('Arial','b',8);
		$pdf->SetX(15);
		$pdf->Cell(152.5,5,mysql_result($resResultado,0,'domicilioparticular'),'RLB',0,'C',0);
		$pdf->Cell(112.5,5,mysql_result($resResultado,0,'localidad'),'RLB',0,'C',0);

		$pdf->Ln();
		$pdf->SetFont('Arial','b',6);
		$pdf->SetX(15);
		$pdf->Cell(152.5,5,'Domicilio oficial (calle y número exterior e interior o piso)',0,0,'C',0);
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
		$pdf->Cell(45,5,'Delegación o Municipio',0,0,'C',0);
		$pdf->Cell(30,5,'Entidad Federativa',0,0,'C',0);
		$pdf->Cell(20,5,'Código Postal',0,0,'C',0);
		$pdf->Cell(20,5,'Lada',0,0,'C',0);
		$pdf->Cell(25,5,'Teléfono Oficial',0,0,'C',0);
		$pdf->Cell(15,5,'Extensión',0,0,'C',0);


		$pdf->Ln();
		$pdf->SetFont('Arial','b',8);
		$pdf->SetX(15);
		$pdf->Cell(265,5,mysql_result($resResultado,0,'emailinstitucional'),'RLB',0,'C',0);

		$pdf->Ln();
		$pdf->SetFont('Arial','b',6);
		$pdf->SetX(15);
		$pdf->Cell(152.5,5,'Correo (s) electrónico (s) oficial (es)',0,0,'L',0);



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
			$pdf->Cell(165.5,5,'a) Remuneración neta del declarante por los cargos públicos desampeñados...........................',0,0,'L',0);
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
			$pdf->Cell(165.5,5,'b) Ingresos por pensión Decretada por el Congreso del Estado o Ayuntamiento................................................',0,0,'L',0);
			$pdf->Cell(100,5,'$ '.((integer)mysql_result($datos2a,0,'actividadindustrial') + (integer)mysql_result($datos2a,0,'actividadfinanciera') + (integer)mysql_result($datos2a,0,'actividadprofesional')),'RLB',0,'C',0);

			$pdf->Ln();
			$pdf->SetFont('Arial','b',8);
			$pdf->SetX(15);
			$pdf->Cell(165.5,5,'Detalle en la sección XIII de observaciones y/o aclaraciones.',0,0,'L',0);


			$pdf->Ln();
			$pdf->SetFont('Arial','b',8);
			$pdf->SetX(15);
			$pdf->Cell(165.5,5,'c) Otros ingresos anuales ................................................................................................................................... ',0,0,'L',0);
			$pdf->Cell(100,5,'$ '.(integer)mysql_result($datos2a,0,'otros'),'RLB',0,'C',0);

			$pdf->Ln();
			$pdf->SetFont('Arial','b',8);
			$pdf->SetX(15);
			$pdf->Cell(165.5,5,'Detalle el concepto de sus otros ingresos en la sección XIII de observaciones y/o aclaraciones.',0,0,'L',0);

			$pdf->Ln();
			$pdf->SetFont('Arial','b',8);
			$pdf->SetX(15);
			$pdf->Cell(165.5,5,'INGRESO TOTAL DEL DECLARANTE (suma apartados a+b+c)...................................................................',0,0,'L',0);
			$pdf->Cell(100,5,'$ '.((integer)mysql_result($datos2a,0,'remuneracionanualneta') + (integer)mysql_result($datos2a,0,'otros') + (integer)mysql_result($datos2a,0,'actividadindustrial') + (integer)mysql_result($datos2a,0,'actividadfinanciera') + (integer)mysql_result($datos2a,0,'actividadprofesional')),'RLB',0,'C',0);

			$pdf->Ln();
			$pdf->SetFont('Arial','b',8);
			$pdf->SetX(15);
			$pdf->Cell(165.5,5,'Ingreso anual del (la) cónyuge, concubino (a) y/o dependientes..........................................................................',0,0,'L',0);
			$pdf->Cell(100,5,'$ '.(integer)mysql_result($datos2a,0,'ingresoanualconyuge'),'RLB',0,'C',0);

			$pdf->Ln();
			$pdf->SetFont('Arial','b',8);
			$pdf->SetX(15);
			$pdf->Cell(165.5,5,'Especificar en el apartado V, en lo relativo a los datos del (la) cónyuge o concubino (a).',0,0,'L',0);


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
			$pdf->Cell(265,5,'Datos no Públicos.',0,0,'L',0);

		}


		$pdf->Ln();
		$pdf->Ln();
		
		$pdf->SetFont('Arial','b',14);

		$pdf->SetX(15);
		$pdf->Cell(290,8,'III.- APLICACIÓN DE RECURSOS',0,0,'L',0);
		$pdf->Ln();

		if (mysql_num_rows($datos2b) > 0) {
			$pdf->Ln();
			$pdf->SetFont('Arial','b',8);
			$pdf->SetX(15);
			$pdf->Cell(165.5,5,'a) Pago de adeudos (Hipoteca, préstamos personales, etc.).....................................................................................',0,0,'L',0);
			$pdf->Cell(100,5,'$ '.(integer)mysql_result($datos2b,0,'pagos'),'RLB',0,'C',0);

			$pdf->Ln();
			$pdf->SetFont('Arial','b',8);
			$pdf->SetX(15);
			$pdf->Cell(165.5,5,'b) Otros (Gastos de manutención, renta, etc.).........................................................................................................',0,0,'L',0);
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
			$pdf->Cell(165.5,5,'d).-Otro (especifique en el apartado número XIII de observaciones y/o aclaraciones....................................',0,0,'L',0);
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
	$pdf->Cell(165,5,'Domicilio particular (Calle y número exterior e interior o piso)',0,0,'C',0);
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
	$pdf->Cell(90,5,'Delegación o Municipio',0,0,'C',0);
	$pdf->Cell(5,5,'',0,0,'C',0); //lugarcito
	$pdf->Cell(70,5,'Entidad Federativa',0,0,'C',0);
	$pdf->Cell(5,5,'',0,0,'C',0); //lugarcito
	$pdf->Cell(25,5,'Código Postal',0,0,'C',0);
	$pdf->Cell(5,5,'',0,0,'C',0); //lugarcito
	$pdf->Cell(20,5,'Lada',0,0,'C',0);
	$pdf->Cell(5,5,'',0,0,'C',0); //lugarcito
	$pdf->Cell(40,5,'Teléfono Oficial',0,0,'C',0);


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
	$pdf->Cell(90,5,'Correo (s) electrónico (s) personal (es)',0,0,'C',0);
	$pdf->Cell(10,5,'',0,0,'C',0); //lugarcito
	$pdf->Cell(75,5,'Nacionalidad',0,0,'C',0);
	$pdf->Cell(10,5,'',0,0,'C',0); //lugarcito
	$pdf->Cell(80,5,'Lugar de nacimiento (Delegación o Municipio / Estado)',0,0,'C',0);



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
	$pdf->Cell(90,5,'Grado máximo de estudios/Especialidad','',0,'C',0);
	$pdf->Cell(5,5,'',0,0,'C',0); //lugarcito
	$pdf->Cell(70,5,'Número de cédula profesional','',0,'C',0);

	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFont('Arial','b',10);
	$pdf->SetX(15);
	$pdf->Cell(75,5,'¿Tiene USTED dependientes económicos ?','',0,'L',0);


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
	$pdf->Cell(155,5,'Si su respuesta es AFIRMATIVA, proporcione sus nombres, edades y parentesco o vínculo con USTED','',0,'L',0);

	$pdf->Ln();
	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFont('Arial','b',12);
	$pdf->SetX(15);
	$pdf->Cell(265,5,'DATOS DE SUS DEPENDIENTES ECONÓMICOS','RLTB',0,'C',0);

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
		$pdf->Cell(265,5,'Independientemente de anotar si vendió algún bien, también deberá indicar si Adquirió otro, anotando la clave, el tipo de operación y forma de pago.','',0,'L',0);

		$pdf->Ln();
		$pdf->Ln();
		$pdf->SetFont('Arial','b',10);
		$pdf->SetX(15);
		$pdf->Cell(100,5,'Tipo de Bien','RLTB',0,'C',0);
		$pdf->Cell(50,5,'Valor del bien mueble','RLTB',0,'C',0);
		$pdf->Cell(65,5,'Tipo de Operación','RLTB',0,'C',0);
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
		$pdf->Cell(265,5,'Datos no Públicos','',0,'C',0);
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
		$pdf->Cell(265,5,'Anote "A", si el vehículo registrado fue adquirido ó "B" si el vehículo pasó ser propiedad de otra persona, señalando l tipo de operación que se llevó a cabo.','',0,'L',0);

		$pdf->Ln();
		$pdf->Ln();
		$pdf->SetFont('Arial','b',9);
		$pdf->SetX(15);
		$pdf->Cell(10,5,'Tipo','RLTB',0,'C',0);
		$pdf->Cell(30,5,'Tipo de Operación','RLTB',0,'C',0);
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
		$pdf->Cell(265,5,'Datos no Públicos','',0,'C',0);
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
		$pdf->Cell(265,5,'Anote "A", si el inmueble registrado fue adquirido ó "B" si el inmueble pasó a ser propiedad de otra persona, señalando el tipo de operación que se llevó a cabo.','',0,'L',0);

		
		
		

		while ($row5 = mysql_fetch_array($datos6a)) {

			$pdf->Ln();
			$pdf->Ln();
			$pdf->SetFont('Arial','b',10);
			$pdf->SetX(15);
			$pdf->Cell(90,5,'Tipo de Bien','RLTB',0,'C',0);
			$pdf->Cell(10,5,'Tipo','RLTB',0,'C',0);
			$pdf->Cell(35,5,'Tipo de Operación','RLTB',0,'C',0);
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
			$pdf->Cell(145,5,'Ubicación del Inmueble','RLTB',0,'C',0);
			$pdf->Cell(35,5,'Fecha Adquisición','RLTB',0,'C',0);
			$pdf->Cell(30,5,'Titular','RLTB',0,'C',0);
			$pdf->Cell(25,5,'Terreno M2','RLTB',0,'C',0);
			$pdf->Cell(30,5,'Construcción M2','RLTB',0,'C',0);
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
		$pdf->Cell(265,5,'Datos no Públicos','',0,'C',0);
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
		$pdf->Cell(50,5,'Tipo de Inversión','RLTB',0,'C',0);
		$pdf->Cell(35,5,'Tipo de Operación','RLTB',0,'C',0);
		$pdf->Cell(35,5,'Numero de Cuenta','RLTB',0,'C',0);
		$pdf->Cell(43,5,'Razon Social','RLTB',0,'C',0);
		$pdf->SetFont('Arial','b',8);
		$pdf->Cell(42,5,'Saldo al 31/12 del año anterior','RLTB',0,'C',0);
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
		$pdf->Cell(265,5,'Datos no Públicos','',0,'C',0);
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
			$pdf->Cell(75,5,'Institución o Acreedor','RLTB',0,'C',0);
			$pdf->Cell(80,5,'Saldo al 31/12 del año anterior','RLTB',0,'C',0);
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
			$pdf->Cell(190,5,'Si su adeudo o gravamen es por crédito hipotecario, embargo o compra a crédito de un inmueble, debe especificar el ','',0,'C',0);
			$pdf->Cell(75,5,'Importe total del crédito: $ '.$row5['montooriginal'],'RLTB',0,'L',0);


			$pdf->Ln();
			$pdf->SetFont('Arial','b',10);
			$pdf->SetX(15);
			$pdf->Cell(60,5,'Registro Público de la Propiedad','',0,'L',0);
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
		$pdf->Cell(265,5,'Datos no Públicos','',0,'C',0);
	}

	/*---------------  FIN OCTAVA PAGINA ***********************************/

	/*---------------      NOVENA PAGINA ***********************************/
	$datos9a = $serviciosReferencias->traerConflictoeconomicaGridPorCabecera($id);
	


	$pdf->AddPage();

	$pdf->SetXY(10,10);



	$pdf->SetFont('Arial','b',16);
	$pdf->SetXY(15,10);
	$pdf->Cell(150,8,'XII.- DECLARACIÓN DE INTERESES',0,0,'L',0);

	
	$pdf->Ln();
	$pdf->SetFont('Arial','b',10);
	$pdf->SetX(15);
	$pdf->Cell(180,5,'ESTOY DE ACUERDO EN HACER PÚBLICA LA INFORMACIÓN DE POSIBLE CONFLICTO DE INTERESES','',0,'L',0);
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
	$pdf->Cell(265,5,'POSIBLES CONFLICTOS DE INTERESES POR PARTICIPACIONES ECONÓMICAS O FINANCIERAS DEL CÓNYUGE, CONCUBINO, CONCUBINA Y/O DEPENDIENTES ECONÓMICOS.','',0,'L',0);

	$pdf->Ln();
	$pdf->SetFont('Arial','',9);
	$pdf->Ln();
	$pdf->SetX(15);
	$pdf->Cell(265,5,'Descripción: Se refiere a participaciones económicas o financieras, así como aquellos convenios, contratos, compromisos o acuerdos con un valor económico presente o futuro que tenga el','',0,'L',0);
	$pdf->Ln();
	$pdf->SetX(15);
	$pdf->Cell(265,5,'(la) cónyuge, concubino(a) y/o dependientes económicos con personas físicas o morales y que el servidor público tenga conocimiento de un posible conflicto de interés y que no pueden ser','',0,'L',0);
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
			$pdf->Cell(55,5,'Fecha de constitución de la sociedad','RLTB',0,'C',0);
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
			$pdf->Cell(80,5,'Antigüedad de la participación o convenio(años)','RLTB',0,'C',0);
			$pdf->Cell(60,5,'Inicio de participación o contrato','RLTB',0,'C',0);
			$pdf->Cell(80,5,'Ubicación','RLTB',0,'C',0);

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
		$pdf->Cell(265,5,'Datos no Públicos','',0,'C',0);
	}

	/*---------------  FIN NOVENA PAGINA ***********************************/

	/*---------------      DECIMA PAGINA ***********************************/
	$datos9b = $serviciosReferencias->traerConflictopuestosGridPorCabecera($id);


	$pdf->AddPage();

	$pdf->SetXY(10,10);


	$pdf->Ln();
	$pdf->SetFont('Arial','b',9);
	$pdf->SetX(15);
	$pdf->Cell(265,5,'POR PUESTO, CARGO, COMISIÓN, ACTIVIDADES O PODERES DEL CÓNYUGE, CONCUBINO, CONCUBINA Y/O DEPENDIENTES ECONÓMICOS QUE','',0,'L',0);
	$pdf->Ln();
	$pdf->SetX(15);
	$pdf->Cell(265,5,'ACTUALMENTE TENGA EN ASOCIACIONES, CONSEJOS, ACTIVIDADES FILANTRÓPICAS Y/O CONSULTORIA.','',0,'L',0);

	$pdf->Ln();
	$pdf->SetFont('Arial','',9);
	$pdf->Ln();
	$pdf->SetX(15);
	$pdf->Cell(265,5,'Descripción: Se refiere a participaciones económicas o financieras, así como aquellos convenios, contratos, compromisos o acuerdos con un valor económico presente o futuro que tenga el','',0,'L',0);
	$pdf->Ln();
	$pdf->SetX(15);
	$pdf->Cell(265,5,'(la) cónyuge, concubino(a) y/o dependientes económicos con personas físicas o morales y que el servidor público tenga conocimiento de un posible conflicto de interés y que no pueden ser','',0,'L',0);
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
			$pdf->Cell(95,5,'Nombre de la entidad (empresa, asociación, sindicato, etc)','RLTB',0,'C',0);
			$pdf->Cell(35,5,'Vinculos','RLTB',0,'C',0);
			$pdf->Cell(25,5,'Antigüedad','RLTB',0,'C',0);
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
			$pdf->Cell(35,5,'Participación en la dirección o administración','RLTB',0,'C',0);
			$pdf->Cell(100,5,'Tipo de persona jurídica','RLTB',0,'C',0);
			$pdf->Cell(60,5,'Tipo de colaboración o aporte','RLTB',0,'C',0);
			$pdf->Cell(70,5,'Ubicación','RLTB',0,'C',0);
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
		$pdf->Cell(265,5,'Datos no Públicos','',0,'C',0);
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
	$pdf->Cell(265,5,'C. Secretario de la Contraloría del Estado y/o C. Auditor General de la Entidad Superior de Auditoría y Fiscalización del Congreso del Estado, solicito se sirva tener por ','',0,'L',0);
	$pdf->Ln();
	$pdf->SetX(15);
	$pdf->Cell(265,5,'presentada esta declaración, pidiendo me sea otorgado el acuse de recibo correspondiente.
','',0,'L',0);

	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetX(15);
	$pdf->Cell(265,5,'Así mismo y para efectos de lo señalado en el artículo 81 de la Ley de Estatal de Responsabilidades de los Servidores Públicos, manifiesto expresamente mi autorización ','',0,'L',0);
	$pdf->Ln();
	$pdf->SetX(15);
	$pdf->Cell(265,5,'para que se verifique y coteje, el contenido de esta Declaración, ante cualquier Institución.','',0,'L',0);

	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetX(15);
	$pdf->Cell(265,5,'Fecha de envío: Cuernavaca, Morelos a','',0,'L',0);


	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetX(15);
	$pdf->Cell(265,5,'NOTA: El Servidor público ha manifestado su patrimonio BAJO PROTESTA DE DECIR VERDAD, en consecuencia se le apercibe para que se conduzca con verdad en lo ','',0,'L',0);
	$pdf->Ln();
	$pdf->SetX(15);
	$pdf->Cell(265,5,'declarado. Así mismo, se hace de su conocimiento lo señalado en el artículo 221 del Código Penal para el Estado de Morelos que al respecto señala:','',0,'L',0);



	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetX(15);
	$pdf->Cell(265,5,'"Al que teniendo legalmente la obligación de conducirse con verdad en un acto ante la autoridad, apercibido por ésta, en caso de ser procedente el apercibimiento, se ','',0,'L',0);
	$pdf->Ln();
	$pdf->SetX(15);
	$pdf->Cell(265,5,'condujere con falsedad u ocultare la verdad, se le impondrá prisión de tres meses a dos años".','',0,'L',0);



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
$pdf->Cell(40,10,'¡Hola, Mundo!');
$pdf->Output();
*/
?>

