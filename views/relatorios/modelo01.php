<?php

require '../fpdf181/fpdf.php';

$pdf = new FPDF('P','pt',"A4");
$pdf->AddPage();
$pdf->setFont('arial','B',12);
$pdf->Cell(0,5,'Modelo 01',0,1,'L');
$pdf->Ln(8);
$pdf->Output("arquivo.pdf","D");



