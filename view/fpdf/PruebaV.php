<?php

require('./fpdf.php');

class PDF extends FPDF
{

   // Cabecera de página
   function Header()
   {

      $this->Image('vdclogo.png', 140, 8, 20); //logo de la empresa,moverDerecha,moverAbajo,tamañoIMG
      $this->SetFont('Arial', 'B', 19); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(45); // Movernos a la derecha
      $this->SetTextColor(0, 0, 0); //color
      //creamos una celda o fila
      $this->Cell(80, 15, utf8_decode('IEP Virgen Del Carmen'), 0, 1, 'C', 0); // AnchoCelda,AltoCelda,titulo,borde(1-0),saltoLinea(1-0),posicion(L-C-R),ColorFondo(1-0)
      $this->Ln(3); // Salto de línea
      $this->SetTextColor(103); //color

      /* TITULO DE LA TABLA */
      //color
      $this->SetTextColor(0, 0, 0);
      $this->Cell(50); // mover a la derecha
      $this->SetFont('Arial', 'B', 15);
      $this->Cell(100, 10, utf8_decode("REPORTE DE PAGOS "), 1, 1, 'C', 0);
      $this->Ln(5);

      /* CAMPOS DE LA TABLA */
      //color
      $this->SetFillColor( 9, 43, 169 ); //colorFondo
      $this->SetTextColor(255, 255, 255); //colorTexto
      $this->SetDrawColor(163, 163, 163); //colorBorde
      $this->SetFont('Arial', 'B', 8);
      $this->Cell(8, 10, utf8_decode('N°'), 1, 0, 'C', 1);
      $this->Cell(30, 10, utf8_decode('COD. MATRÍCULA'), 1, 0, 'C', 1);
      $this->Cell(60, 10, utf8_decode('ALUMNO'), 1, 0, 'C', 1);
      $this->Cell(20, 10, utf8_decode('CONCEPTO'), 1, 0, 'C', 1);
      $this->Cell(18, 10, utf8_decode('MES'), 1, 0, 'C', 1);
      $this->Cell(20, 10, utf8_decode('FECHA'), 1, 0, 'C', 1);
      $this->Cell(20, 10, utf8_decode('M. Pago'), 1, 0, 'C', 1);
      $this->Cell(20, 10, utf8_decode('Monto'), 1, 1, 'C', 1);
      
   }

   // Pie de página
   function Footer()
   {
      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C'); //pie de pagina(numero de pagina)

      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, cursiva, tamañoTexto
      $hoy = date('d/m/Y');
      $this->Cell(355, 10, utf8_decode($hoy), 0, 0, 'C'); // pie de pagina(fecha de pagina)
   }
}


/* CONSULTA INFORMACION DE LOS PAGOS */

$pdf = new PDF();
$pdf->AddPage(); /* aqui entran dos para parametros (horientazion,tamaño)V->portrait H->landscape tamaño (A3.A4.A5.letter.legal) */
$pdf->AliasNbPages(); //muestra la pagina / y total de paginas

$i = 0;
$pdf->SetFont('Arial', '', 8);
$pdf->SetDrawColor(163, 163, 163); //colorBorde

include_once '../../model/modelo_conexion.php';
$conexion = new conexionBD();
$pdo = $conexion->conexionPDO();

$sql = "select 
matricula.matric_code,
alumno.alumno_nombre,
pagos.pago_descripcion,
pagos.pago_mes,
pagos.pago_fecha,
pagos.pago_modalidad,
pagos.pago_monto
from pagos
inner join matricula on pagos.id_matricula=matricula.id_matricula
inner join alumno on matricula.id_alumno=alumno.id_alumno";
$stmt = $pdo->prepare($sql);
$stmt->execute();

while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {     
   $i = $i + 1;
   $columna1 = $fila['matric_code'];
   $columna2 = $fila['alumno_nombre'];
   $columna3 = $fila['pago_descripcion'];
   $columna4 = $fila['pago_mes'];
   $columna5 = $fila['pago_fecha'];
   $columna6 = $fila['pago_modalidad'];
   $columna7 = $fila['pago_monto'];
/* TABLA */
$pdf->Cell(8, 10, utf8_decode($i), 1, 0, 'C', 0);
$pdf->Cell(30, 10, utf8_decode($columna1), 1, 0, 'C', 0);
$pdf->Cell(60, 10, utf8_decode($columna2), 1, 0, 'C', 0);
$pdf->Cell(20, 10, utf8_decode($columna3), 1, 0, 'C', 0);
$pdf->Cell(18, 10, utf8_decode($columna4), 1, 0, 'C', 0);
$pdf->Cell(20, 10, utf8_decode($columna5), 1, 0, 'C', 0);
$pdf->Cell(20, 10, utf8_decode($columna6), 1, 0, 'C', 0);
$pdf->Cell(20, 10, utf8_decode($columna7), 1, 1, 'C', 0); 
}


$pdf->Output('Prueba.pdf', 'I');//nombreDescarga, Visor(I->visualizar - D->descargar)
