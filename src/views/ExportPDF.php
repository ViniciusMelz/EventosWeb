<?php
include 'fpdf/fpdf.php';
$pdf = new FPDF();
$pdf->AddPage();
$pdf->Header();
// Escolhe a fonte
$pdf->SetFont('Arial','B',16);
// Move para 5 cm a direita
$pdf->Cell(50);
//Texto centralizado em uma célula de 100*10mm com borda e quebra de linha
$pdf->Cell(100,10,'Titulo - IFSul Campus Venacio Aires',1,1,'C');
$str = 'Relatório com FPDF';
$str = mb_convert_encoding($str, 'windows-1252', 'UTF-8');
$pdf->SetFont('Arial','B',36);
$pdf->Cell(0,30,$str,0,1);
$pdf->SetFont('Arial','B',20);
$str = 'Disciplina Linguagem de Programação Web 02!!!';
$str = mb_convert_encoding($str, 'windows-1252', 'UTF-8');
$pdf->Cell(0,30,$str,1,1);
$pdf->Cell(0,30,$str,1,1);
$pdf->Output();