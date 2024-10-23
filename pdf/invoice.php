<?php
    require('../vendors/setasign/fpdf/fpdf.php');

    $pdf = new FPDF ('P','mm','A4');


    $pdf->AddPage();

    $pdf->setFont('Arial','B',20);

    $pdf->Cell(71,10,'',0,0);
    $pdf->Cell(59,5,'Invoice',0,0);
    $pdf->Cell(59,10,'',0,1);


    $pdf->setFont('Arial','B',15);
    $pdf->Cell(71,5,'WET',0,0);
    $pdf->Cell(59,5,'',0,0);
    $pdf->Cell(59,5,'Details',0,1);


    $pdf->setFont('Arial','',10);
    $pdf->Cell(130,5,'Near DAV',0,0);
    $pdf->Cell(25,5,'Customer ID',0,0);
    $pdf->Cell(59,5,'ORD001',0,1);


    $pdf->Cell(130,5,'City, 751001',0,0);
    $pdf->Cell(25,5,'Invoice Date',0,0);
    $pdf->Cell(59,5,'12th Jan 2024',0,1);
    

    $pdf->Cell(130,5,'',0,0);
    $pdf->Cell(25,5,'Invoice No:',0,0);
    $pdf->Cell(59,5,'ORD001',0,1);


    $pdf->setFont('Arial','B',15);
    $pdf->Cell(130,5,'Bill To',0,0);
    $pdf->Cell(25,5,'',0,0);
    $pdf->setFont('Arial','B',10);
    $pdf->Cell(189,10,'',0,1);

    $pdf->Cell(50,10,'',0,1);

    $pdf->setFont('Arial','B',10);
    $pdf->Cell(10,6,'S1',1,0,'C');
    $pdf->Cell(80,6,'Descrition',1,0,'C');
    $pdf->Cell(23,6,'Qty',1,0,'C');
    $pdf->Cell(30,6,'Unit Price',1,0,'C');
    $pdf->Cell(30,6,'Sales Tax',1,0,'C');
    $pdf->Cell(25,6,'Total',1,1,'C');

    
    $pdf->setFont('Arial','',10);
    for($i=1; $i<=10;$i++ )
    {
        $pdf->Cell(10,6,$i,1,0);
        $pdf->Cell(80,6,'Hp Laptop',1,0);
        $pdf->Cell(23,6,'1',1,0,'R');
        $pdf->Cell(30,6,'15000.00',1,0,'R');
        $pdf->Cell(30,6,'100.00',1,0,'R');
        $pdf->Cell(25,6,'15100.00',1,1,'R');

    }
    $pdf->Cell(118,6,'',0,0);
    $pdf->Cell(25,6,'Subtotal:',1,0,'C');
    $pdf->Cell(55,6,'15100.00',1,'R');


    $pdf ->Output();
?>