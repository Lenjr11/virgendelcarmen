<?php
	# Incluyendo librerias necesarias #
	require "./code128.php";

	$pdf = new PDF_Code128('P','mm','Letter');
	$pdf->SetMargins(17,17,17);
	$pdf->AddPage();

	# Logo de la empresa formato png #
	$pdf->Image('./img/vdclogo.png',165,12,35,35,'PNG');

	# Encabezado y datos de la empresa #
	$pdf->SetFont('Arial','B',12);
	$pdf->SetTextColor(32,100,210);
	$pdf->Cell(150,10,utf8_decode(strtoupper("ASOCIACION CIVIL EDUCATIVA")),0,0,'L');
	$pdf->Ln(5);
	$pdf->Cell(150,10,utf8_decode(strtoupper("VIRGEN DEL CARMEN")),0,0,'L');

	$pdf->Ln(9);

	$pdf->SetFont('Arial','',10);
	$pdf->SetTextColor(39,39,51);
	$pdf->Cell(150,9,utf8_decode("RUC: 20103196419"),0,0,'L');
	$pdf->SetFont('Arial','B',10);
	$pdf->SetTextColor(39,39,51);
	$pdf->Cell(-60,1,utf8_decode(strtoupper("BOLETA DE VENTA")),0,0,'C');
	$pdf->Cell(60,10,utf8_decode(strtoupper("ELECTRONICA")),0,0,'C');
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(-60,25,utf8_decode(strtoupper("B002-00003242")),0,0,'C');

	$pdf->Ln(5);

	$pdf->SetFont('Arial','',8);
	$pdf->Cell(150,9,utf8_decode("Direccion:  CAL. ALVA DIAZ NRO. 380 URB, ALEJANDRIA"),0,0,'L');
	$pdf->Ln(4);
	$pdf->Cell(150,9,utf8_decode(", CHICLAYO, CHICLAYO - LAMBAYEQUE "),0,0,'L');

	$pdf->Ln(5);

	$pdf->Cell(150,9,utf8_decode("Email: admin@facturacionsunat.pe"),0,0,'L');

	$pdf->Ln(10);

	$pdf->SetFont('Arial','B',9);
	$pdf->SetTextColor(39,39,51);
	$pdf->Cell(28,7,utf8_decode("Fecha de emisión:"),0,0);
	$pdf->SetFont('Arial','',9);
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(116,7,utf8_decode(date("d/m/Y", strtotime("13-09-2022"))),0,0,'L');
	$pdf->Ln(4);
	$pdf->SetFont('Arial','B',9);
	$pdf->SetTextColor(39,39,51);
	$pdf->Cell(35,7,utf8_decode("Fecha de vencimiento:"),0,0);
	$pdf->SetFont('Arial','',9);
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(116,7,utf8_decode(date("d/m/Y", strtotime("13-09-2022"))),0,0,'L');

	$pdf->Ln(4);
	$pdf->SetFont('Arial','B',9);
	$pdf->SetTextColor(39,39,51);
	$pdf->Cell(13,7,utf8_decode("Cliente:"),0,0);
	$pdf->SetFont('Arial','',9);
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(60,7,utf8_decode("Carlos Alfaro"),0,0,'L');
	$pdf->Ln(4);
	$pdf->SetTextColor(39,39,51);
	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(7,7,utf8_decode("DNI:"),0,0);
	$pdf->SetFont('Arial','',9);
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(150,7,utf8_decode("17770628"),0,0);
	$pdf->Ln(4);
	$pdf->SetTextColor(39,39,51);
	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(16,7,utf8_decode("Dirección:"),0,0);
	$pdf->SetFont('Arial','',9);
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(109,7,utf8_decode("Calle el Prado Mz B Lote 1, URB Las Brisas"),0,0);

	$pdf->Ln(9);

	# Tabla de productos #
	$pdf->SetFont('Arial','',8);
	$pdf->SetFillColor(23,83,201);
	$pdf->SetDrawColor(23,83,201);
	$pdf->SetTextColor(255,255,255);
	$pdf->Cell(15,8,utf8_decode("CANT."),1,0,'C',true);
	$pdf->Cell(20,8,utf8_decode("UNIDAD"),1,0,'C',true);
	$pdf->Cell(70,8,utf8_decode("DESCRIPCION"),1,0,'C',true);
	$pdf->Cell(25,8,utf8_decode("P.UNIT"),1,0,'C',true);
	$pdf->Cell(19,8,utf8_decode("DTO."),1,0,'C',true);
	$pdf->Cell(32,8,utf8_decode("TOTAL"),1,0,'C',true);

	$pdf->Ln(8);

	
	$pdf->SetTextColor(39,39,51);



	/*----------  Detalles de la tabla  ----------*/
	$pdf->Cell(15,7,utf8_decode("1"),'L',0,'C');
	$pdf->Cell(20,7,utf8_decode("ZZ"),'L',0,'C');
	$pdf->Cell(70,7,utf8_decode("AULA DE 3 AÑOS - MES DE MARZO"),'L',0,'C');
	$pdf->Cell(25,7,utf8_decode("180.00"),'L',0,'C');
	$pdf->Cell(19,7,utf8_decode("0"),'L',0,'C');
	$pdf->Cell(32,7,utf8_decode("180.00"),'LR',0,'C');
	$pdf->Ln(7);
	/*----------  Fin Detalles de la tabla  ----------*/


	
	$pdf->SetFont('Arial','B',9);
	
	# Impuestos & totales #
	$pdf->Cell(100,7,utf8_decode(''),'T',0,'C');
	$pdf->Cell(15,7,utf8_decode(''),'T',0,'C');
	$pdf->Cell(32,7,utf8_decode("OP.INAFECTAS:"),'T',0,'C');
	$pdf->Cell(34,7,utf8_decode("S/180.00"),'T',0,'C');

	$pdf->Ln(7);

	$pdf->Cell(100,7,utf8_decode(''),'',0,'C');
	$pdf->Cell(15,7,utf8_decode(''),'',0,'C');
	$pdf->Cell(32,7,utf8_decode("IGV:"),'',0,'C');
	$pdf->Cell(34,7,utf8_decode("S/0.00"),'',0,'C');

	$pdf->Ln(7);

	$pdf->Cell(100,7,utf8_decode(''),'',0,'C');
	$pdf->Cell(15,7,utf8_decode(''),'',0,'C');


	$pdf->Cell(32,7,utf8_decode("TOTAL A PAGAR"),'T',0,'C');
	$pdf->Cell(34,7,utf8_decode("S/180.00"),'T',0,'C');

	$pdf->Ln(12);

	$pdf->SetTextColor(39,39,51);
	$pdf->Cell(28,7,utf8_decode("Son: CIENTO OCHENTA CON 00/100 SOLES"),0,0);

	$pdf->Ln(5);

	$pdf->SetTextColor(39,39,51);
	$pdf->Cell(28,7,utf8_decode("Condicion de Pago: CONTADO"),0,0);

	$pdf->Ln(10);
	$pdf->SetFont('Arial','B',9);
	$pdf->SetTextColor(39,39,51);
	$pdf->Cell(28,7,utf8_decode("PAGOS:"),0,0);

	$pdf->Ln(5);
	$pdf->SetFont('Arial','',9);
	$pdf->SetTextColor(39,39,51);
	$pdf->Cell(28,7,utf8_decode("Efectivo - S/180"),0,0);

	$pdf->Ln(10);
	$pdf->SetFont('Arial','B',9);
	$pdf->SetTextColor(39,39,51);
	$pdf->Cell(28,7,utf8_decode("VENDEDOR:"),0,0);

	$pdf->Ln(5);
	$pdf->SetFont('Arial','',9);
	$pdf->SetTextColor(39,39,51);
	$pdf->Cell(28,7,utf8_decode("ADMINISTRADOR"),0,0);

	$pdf->Ln(30);

	$pdf->SetFont('Arial','',9);

	$pdf->SetTextColor(39,39,51);
	$pdf->MultiCell(0,9,utf8_decode("*** Para consultar el comprobante ingresar a https://vcarmen.facturacionsunat.pe/buscar ***"),0,'C',false);


	# Nombre del archivo PDF #
	$pdf->Output("I","Boleta_Pago.pdf",true);

?>