<?php
require('../vendors/setasign/fpdf/fpdf.php');

$pdf = new FPDF('P', 'mm', 'A4');

$pdf->AddPage();
$pdf->Rect(5, 7, 200, 267);
$pdf->SetFillColor(255, 165, 0);

$pdf->setFont('Arial', 'B', 22);

$pdf->Cell(65, 10, '', 0, 0);
$pdf->Cell(59, 5, 'Company Name', 0, 1);

$pdf->setFont('Arial', '', 14);
$pdf->Cell(25, 10, '', 0, 0);
$pdf->Cell(59, 10, 'No - 00, ABC Road, ABCPURAM, Chennai, Tamil Nadu PIN 600000', 0, 1);
$pdf->Cell(69, 3, '', 0, 0);
$pdf->Cell(59, 3, 'TEL +91 1234567890', 0, 1);
$pdf->Cell(65, 10, '', 0, 0);
$pdf->Cell(59, 10, 'GSTIN:33AAAA0000A1Z5', 0, 1);
$pdf->SetY(36);
$pdf->SetX(5);
$pdf->SetFillColor(255, 165, 0);
$pdf->Cell(200, 3, '', 1, 1, '', 1);

$pdf->setFont('Arial', 'B', 22);
$pdf->Cell(70, 11, '', 0, 0);
$pdf->Cell(59, 11, 'Tax Invoice', 0, 1);
$pdf->SetY(50);
$pdf->SetX(5);
$pdf->Cell(200, 3, '', 1, 1, '', 1);

$pdf->setFont('Arial', '', 12);
$pdf->SetY(53);
$pdf->SetX(5);
$pdf->Cell(100, 7, 'Invoice No:', 1, 0, 1);
$pdf->Cell(100, 7, 'To', 1, 1);

$pdf->SetY(60);
$pdf->SetX(5);
$pdf->Cell(100, 7, 'Invoice Date:', 1, 0, 1);
$pdf->Cell(25, 7, 'Name:', 1, 0);
$pdf->Cell(75, 7, '', 1, 1);

$pdf->SetY(67);
$pdf->SetX(5);
$pdf->Cell(100, 7, 'Reverse Charge(Y/N):', 1, 0, 1);
$pdf->Cell(25, 7, 'Address:', 'TLR', 2, 1);
$pdf->Cell(25, 7, '', 'LRB', 0, 1);

$pdf->SetY(74);
$pdf->SetX(5);
$pdf->Cell(100, 7, 'State Tamil Nadu', 1, 1, 1);

$pdf->SetY(81);
$pdf->SetX(5);
$pdf->Cell(100, 7, 'State Tamil Nadu', 1, 0, 1);
$pdf->Cell(100, 7, 'GSTIN:', 1, 1, 1);

$pdf->SetY(88);
$pdf->SetX(5);
$pdf->Cell(15, 12, 'S.No', 1, 0, 'C', 1);
$pdf->Cell(40, 12, 'Product Description', 1, 0, 'C', 1);
$pdf->Cell(14, 6, 'HSN', 'LTR', 2, 'C', 1);
$pdf->Cell(14, 6, 'Code', 'LRB', 0, 'C', 1);

$pdf->SetY(88);
$pdf->SetX(74);
$pdf->Cell(14, 12, 'Qty', 1, 0, 'C', 1);
$pdf->Cell(14, 12, 'Rate', 1, 0, 'C', 1);
$pdf->Cell(34, 12, 'Amount', 1, 0, 'C', 1);
$pdf->Cell(34, 12, 'Discount', 1, 0, 'C', 1);
$pdf->Cell(34.9, 12, 'Taxable Value', 1, 1, 'C', 1);

$pdf->setFont('Arial', '', 10);
for ($i = 1; $i <= 15; $i++) {
    $pdf->SetX(5);
    $pdf->Cell(15, 6, $i, 1, 0);
    $pdf->Cell(40, 6, '', 1, 0);
    $pdf->Cell(14, 6, '', 1, 0);
    $pdf->Cell(14, 6, '', 1, 0);
    $pdf->Cell(14, 6, '', 1, 0);
    $pdf->Cell(34, 6, '', 1, 0);
    $pdf->Cell(34, 6, '', 1, 0);
    $pdf->Cell(34.9, 6, '', 1, 1);
}

$pdf->setFont('Arial', 'B', 10);
$pdf->SetX(5);
$pdf->Cell(165.1, 6, 'Total', 1, 0, 'R');
$pdf->Cell(34.9, 6, '', 1, 1);

$pdf->SetX(5);
$pdf->Cell(66.7, 6, 'Total Invoice amount in words', 1, 0, 'C', 1);
$pdf->Cell(66.7, 6, 'Total Amount before Tax', 1, 0, 'C', 1);
$pdf->Cell(66.7, 6, '', 1, 1, 'C', 1);

$pdf->setFont('Arial', '', 10);
$pdf->SetX(5);
$pdf->Cell(66.7, 12, '', 1, 0, 'C');
$pdf->Cell(66.7, 6, 'Add :CGST- %', '1', 2, 'L');
$pdf->Cell(66.7, 6, 'Add :SGST- %', '1', 0, 'L');

$pdf->SetY(202.2);
$pdf->SetX(138.5);
$pdf->Cell(66.7, 6, '', '1', 2);
$pdf->Cell(66.7, 6, '', '1', 1);

$pdf->setFont('Arial', 'B', 10);
$pdf->SetX(5);
$pdf->Cell(66.7, 6, 'Bank Details', 1, 0, 'C', 1);
$pdf->Cell(66.7, 6, 'Grand Total', 1, 0, 'R', 1);
$pdf->Cell(66.7, 6, '', 1, 1, 'C', 1);

$pdf->setFont('Arial', '', 10);
$pdf->SetX(5);
$pdf->Cell(100, 10, 'Bank A/C No.:', 'LR', 2, 'L');
$pdf->Cell(100, 10, 'Bank Name:', 'LR', 2, 'L');
$pdf->Cell(100, 10, 'Branch Name:', 'LR', 2, 'L');
$pdf->Cell(100, 10, 'Bank IFSC Code:', 'LRB', 2, 'L');
$pdf->Cell(100, 5, 'Terms & Conditions:', 'LR', 2, 'L');
$pdf->Cell(100, 5, '', 'LRB', 2, 'L');
$pdf->Cell(200, 5, 'Computer Generated Invoice', 1, 1, 'C', 1);



$pdf->SetY(220.5);
$pdf->SetX(105);
$pdf->Cell(100, 7, 'Certified that the particulars given above', 'LR', 2, 'C');
$pdf->Cell(100, 7, 'are true and correct', 'LR', 2, 'C');
$pdf->Cell(100, 9, 'For ABC & Co', 'LR', 2, 'C');
$pdf->Cell(100, 17, 'Authorised signatory', 'LR', 2, 'C');
$pdf->Cell(100, 10, '', 'LR', 2, 'C');







$pdf->Output();
?>