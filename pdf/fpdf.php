<?php
// Import FPDF library
//require('path/to/fpdf.php');
require('../vendors/setasign/fpdf/fpdf.php'); 
// Create instance of FPDF
$pdf = new FPDF();

// Add a new page
$pdf->AddPage();

// Set font: Arial, bold, size 16
$pdf->SetFont('Arial', 'B', 16);

// Add a cell (width, height, text, border, line, align)
$pdf->Cell(40, 10, 'Hello World!');

// Add another cell
$pdf->Cell(100, 10, 'This is a simple PDF created using FPDF.', 0, 1);

// Set font: Arial, regular, size 12
$pdf->SetFont('Arial', '', 12);

// Add a multi-line cell
$pdf->MultiCell(0, 10, "FPDF is a PHP class which allows you to generate PDF files. It's a free library, and you can download it from the FPDF website.");

// Output the PDF (I: display in browser, D: force download)
$pdf->Output('example.pdf', 'I');
?>
