<?php
// Include the main TCPDF library (search for installation path).

$colorE = "#e70810cf";#e708108c
$color_titulos = "#e70810cf";

$arrayConfiguracion = getConfiguracion()[0];
$logo = $arrayConfiguracion['logo'];



// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

  public $imagenLogo = '';
  public $txt = '';
	//Page header
	public function Header() {
		// Logo
		$image_file = $this->imagenLogo;

		$this->Image($image_file, 10, 4, 35, 20, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);

		//$this->txt = "Nombre empresa \n telefono: 13114131 \n nit: 3131313";
		$this->SetY(4);
		$this->SetX(40);
		$this->SetFont('helvetica', 'BI', 12);
		$this->setCellPaddings(2, 4, 6, 8);
		$this->SetFillColor(255, 255, 255);
		$this->SetTextColor(80, 94, 90);
		$this->MultiCell(80, 5, $this->txt."\n", 0, 'C', 1, 1, '' ,'', true);

		$image_file = K_PATH_IMAGES.'header_reportes.png';
		$this->Image($image_file, 10, 4, 35, 20, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);

		$fechaActual = date('Y-m-d');
		$txt = "$fechaActual";
		$this->SetY(4);
		$this->SetX(230);
		$this->SetFont('helvetica', 'BI', 12);
		$this->setCellPaddings(2, 4, 6, 8);
		$this->SetFillColor(255, 255, 255);
		$this->SetTextColor(80, 94, 90);
		$this->MultiCell(80, 5, $txt."\n", 0, 'C', 1, 1, '' ,'', true);
	}

}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


//agregar imagen de logo desde la consulta de configuración
if($logo == 'no_image.jpg'){
  $pdf->imagenLogo = URL_IMG_CONFIGURACION."0/".$logo;
} else {
  $pdf->imagenLogo = URL_IMG_CONFIGURACION."1/".$logo;
}
$razonSocial = $arrayConfiguracion['razon_social'];
$ruc = $arrayConfiguracion['ruc'];
$pdf->txt = $razonSocial.;


// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
//$pdf->SetPrintFooter(false);
Fuente: https://www.iteramos.com/pregunta/64344/-cambiar-o-eliminar-header-ampamp-footer-en-el-tcpdf-

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', 'BI', 12);
//$pdf->SetFont('verdana', '', 12);

// add a page
$pdf->AddPage('L','A4');


// ---------------------------------------------------------

$html = '<div></div><table cellpadding="4" style="border: 1px solid '.$colorE.'; font-size: 12px;">
		<tr>
			<th width="3%" style="border: 1px solid '.$colorE.';">#</th>
			<th width="7%" style="border: 1px solid '.$colorE.';">Codigo</th>
			<th width="7%" style="border: 1px solid '.$colorE.';">Codigo M</th>
			<th width="8%" style="border: 1px solid '.$colorE.';">Fecha orden</th>
			<th width="8%" style="border: 1px solid '.$colorE.';">Nro orden</th>
      <th width="15%" style="border: 1px solid '.$colorE.';">nombre usuario</th>
      <th width="15%" style="border: 1px solid '.$colorE.';">descripción</th>
			<th width="12%" style="border: 1px solid '.$colorE.';">area</th>
			<th width="8%" style="border: 1px solid '.$colorE.';">Costo</th>
			<th width="7%" style="border: 1px solid '.$colorE.';">total horas</th>
      <th width="10%" style="border: 1px solid '.$colorE.';">Estado</th>
		</tr>';



//echo '<pre>'; var_dump($usuarios); exit;
foreach($ordenes as $key => $dato){

  $codigo = $dato["codigo"];
  $equipoM = $dato["codigo_mantenimiento"];
  $fechaOrden = $dato['fecha_orden'];
  $nroOrden = $dato['nro_orden'];
  $nombres = $dato['nombres'];
  $descripcion = $dato['descripcion_servicio'];
  $nombreArea = $dato['nombre_area'];
  $costo = $dato['costo'];
  $totalHoras = $dato['horas_total'];
  $estado = $dato['estado'];

  if($estado == 0)
    $estado = "PENDIENTE";

  if($estado == 1)
    $estado = "FINALIZADO";


  $html .= '<tr style="font-size: 12px; color: #2E2E2E;">
    <td style="border: 1px solid '.$colorE.';">'.$key.'</td>
    <td style="border: 1px solid '.$colorE.';">'.$codigo.'</td>
    <td style="border: 1px solid '.$colorE.';">'.$equipoM.'</td>
    <td style="border: 1px solid '.$colorE.';">'.$fechaOrden.'</td>
    <td style="border: 1px solid '.$colorE.';">'.$nroOrden.'</td>
    <td style="border: 1px solid '.$colorE.';">'.$nombres.'</td>
    <td style="border: 1px solid '.$colorE.';">'.$descripcion.'</td>
    <td style="border: 1px solid '.$colorE.';">'.$nombreArea.'</td>
    <td style="border: 1px solid '.$colorE.';">'.$costo.'</td>
    <td style="border: 1px solid '.$colorE.';">'.$totalHoras.'</td>
    <td style="border: 1px solid '.$colorE.';">'.$estado.'</td>
  </tr>';

}

		$html .='</table>';

	$pdf->writeHTML($html, true, false, true, false, '');


//Close and output PDF document
$pdf->Output('example_003.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
exit;
