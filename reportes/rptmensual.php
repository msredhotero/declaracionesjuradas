<?php

date_default_timezone_set('America/Buenos_Aires');

include ('../includes/funcionesUsuarios.php');
include ('../includes/funciones.php');
include ('../includes/funcionesHTML.php');
include ('../includes/funcionesReferencias.php');


$serviciosUsuarios  		= new ServiciosUsuarios();
$serviciosFunciones 		= new Servicios();
$serviciosHTML				= new ServiciosHTML();
$serviciosReferancias 		= new ServiciosReferencias();

$fecha = date('Y-m-d');

require('fpdf.php');

//$header = array("Hora", "Cancha 1", "Cancha 2", "Cancha 3");

$resEmpresa		=	$serviciosEmpresas->traerEmpresasPorId($id);

$empresa		=	mysql_result($resEmpresa,0,0);

$TotalIngresos = 0;
$TotalEgresos = 0;
$Totales = 0;
$Caja = 0;



class PDF extends FPDF
{
// Cargar los datos




// Tabla coloreada
function ingresosFacturacion($header, $data, &$TotalIngresos)
{
	$this->SetFont('Arial','',12);
	$this->Ln();
	$this->Ln();
	$this->Cell(60,7,'Ingresos de Fiestas',0,0,'L',false);
	$this->SetFont('Arial','',10);
    // Colores, ancho de l�nea y fuente en negrita
    $this->SetFillColor(255,0,0);
    $this->SetTextColor(255);
    $this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
	$this->Ln();
	
	
    // Cabecera
    $w = array(90, 20,25,25,25);
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
    $this->Ln();
    // Restauraci�n de colores y fuentes
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('');
    // Datos
    $fill = false;
	
	$total = 0;
	$totalcant = 0;
    while ($row = mysql_fetch_array($data))
    {
		$total = $total + $row[0];
		$totalcant = $totalcant + $row[2];
		
        $this->Cell($w[0],6,$row[1],'LR',0,'L',$fill);
		$this->Cell($w[1],6,$row[0],'LR',0,'R',$fill);
        $this->Cell($w[2],6,$row[2],'LR',0,'C',$fill);
		$this->Cell($w[3],6,$row[3],'LR',0,'C',$fill);
		$this->Cell($w[4],6,$row[4],'LR',0,'C',$fill);
		$this->Cell($w[3],6,$row[3],'LR',0,'C',$fill);
		$this->Cell($w[4],6,$row[4],'LR',0,'C',$fill);
        $this->Ln();
        $fill = !$fill;
    }
	
    // L�nea de cierre
    $this->Cell(array_sum($w),0,'','T');
	$this->SetFont('Arial','',12);
	$this->Ln();
	$this->Ln();
	$this->Cell(60,7,'Cantidad de Fiestas:'.number_format($totalcant, 2, '.', ','),0,0,'L',false);
	$this->Ln();
	$this->Cell(60,7,'Total de Fiestas: $'.number_format($total, 2, '.', ','),0,0,'L',false);
	
	$TotalIngresos = $TotalIngresos + $total;
}

}






$pdf = new PDF();


// T�tulos de las columnas

$headerFacturacion = array("Factura", "Cliente", "Referencia","Fecha", "Importe", "Abonos", "Saldo");
// Carga de datos

$pdf->AddPage();

$pdf->SetFont('Arial','U',17);
$pdf->Cell(180,7,'Reporte General de Facturaci�n',0,0,'C',false);
$pdf->Ln();
$pdf->SetFont('Arial','U',14);
$pdf->Cell(180,7,"Empresa: ".strtoupper($empresa),0,0,'C',false);
$pdf->Ln();
$pdf->Cell(180,7,'Fecha: '.date('Y-m-d'),0,0,'C',false);
$pdf->Ln();

$pdf->SetFont('Arial','',10);

$pdf->ingresosFiestas($headerFacturacion,$resIngresosFacturacion,$TotalFacturacion);

$pdf->Ln();

$pdf->SetFont('Arial','',13);


$pdf->Ln();
$pdf->Cell(60,7,'Importe Total:'.number_format(($TotalIngresos), 2, '.', ','),0,0,'L',false);


$nombreTurno = "Mensual-".$fecha.".pdf";

$pdf->Output($nombreTurno,'D');


?>

