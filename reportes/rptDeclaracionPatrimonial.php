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


if (mysql_num_rows($resResultado)>0) {


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

	$pdf->Ln();
	$pdf->Ln();
	
	$pdf->SetFont('Arial','b',14);

	$pdf->SetX(15);
	$pdf->Cell(290,8,'III.- APLICACIÓN DE RECURSOS',0,0,'L',0);
	$pdf->Ln();

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

	$pdf->Ln();
	$pdf->Ln();
	
	$pdf->SetFont('Arial','b',14);

	$pdf->SetX(15);
	$pdf->Cell(290,8,'IV.- DECREMENTOS',0,0,'L',0);
	$pdf->Ln();

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


	/*---------------  FIN TERCER PAGINA ***********************************/



	/*---------------   CUARTA PAGINA  ***********************************/

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
	$pdf->Cell(40,5,'1985-05-20','RLB',0,'C',0);
	$pdf->Cell(5,5,'',0,0,'C',0); //lugarcito
	$pdf->Cell(20,5,'33','RLB',0,'C',0);
	$pdf->Cell(5,5,'',0,0,'C',0); //lugarcito
	$pdf->Cell(25,5,(mysql_result($resResultado,0,'sexo') == 1 ? 'F' : 'M'),'RLB',0,'C',0);
	$pdf->Cell(5,5,'',0,0,'C',0); //lugarcito
	$pdf->Cell(90,5,mysql_result($resResultado,0,'estudios'),'RLB',0,'C',0);
	$pdf->Cell(5,5,'',0,0,'C',0); //lugarcito
	$pdf->Cell(70,5,mysql_result($resResultado,0,'cedulaprofesional'),'RLB',0,'C',0);





	/*---------------  FIN SEGUNDA PAGINA ***********************************/



	$nombreArchivo = "DeclaracionPatrimonial.pdf";

	$pdf->Output($nombreArchivo,'D');
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

