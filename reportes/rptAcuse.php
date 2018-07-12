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




	$pdf = new FPDF();

	/*---------------   PRIMERA PAGINA ***********************************/

	$pdf->SetMargins(3,3,3);
	// Títulos de las columnas

	$pdf->AddPage();

	$pdf->SetXY(10,10);



	$pdf->SetFont('Arial','b',18);
	$pdf->SetXY(10,20);
	$pdf->Cell(190,8,'DECLARACIÓN PATRIMONIAL DEL ESTADO DE MORELOS ',0,0,'C',0);

	$pdf->Ln();
	$pdf->Ln();
	$pdf->Cell(190,8,'ACUSE DE DECLARACIÓN DE MODIFICACIÓN ',0,0,'C',0);
	$pdf->Ln();
	$pdf->Cell(190,8,'Fecha: '.date('Y-m-d'),0,0,'R',0);

	$pdf->Ln();
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Ln();

	$pdf->Ln();
	$pdf->SetFont('Arial','',12);
	$pdf->SetX(10);
	$pdf->Cell(190,5,'Por medio del presente se le hace de su conocimiento que la declaración fue concluida ',0,0,'L',0);
	
	$pdf->Ln();
	$pdf->SetFont('Arial','',12);
	$pdf->SetX(10);
	$pdf->Cell(190,5,'con éxito, lo registrado anteriormente en esta declaración es confidencial y solo se hará ',0,0,'L',0);

	$pdf->Ln();
	$pdf->SetFont('Arial','',12);
	$pdf->SetX(10);
	$pdf->Cell(190,5,'pública la información si usted así lo indico en esta. ',0,0,'L',0);

	



	$nombreArchivo = "Acuse.pdf";

	$pdf->Output($nombreArchivo,'I');

/*
require('fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'¡Hola, Mundo!');
$pdf->Output();
*/
?>

