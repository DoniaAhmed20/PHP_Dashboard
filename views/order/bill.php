<?php
session_start();
include_once("../fpdf/fpdf.php");

$pdf = new FPDF();
$pdf -> AddPage();

$pdf -> SetFont("Arial","B",16);
$pdf -> Cell(190,10,"Sales Order",0,1,"C");
$pdf -> SetFont("Arial",null,12);
$pdf -> Cell(50,10,"Order Date : ",0,0);
$pdf -> Cell(50,10,$_POST["order_date"],0,1);

$pdf -> Cell(50,10,"Customer Name : ",0,0);
$pdf -> Cell(50,10,"Donia",0,1);

$pdf -> Cell(190,10,"",0,1);

// $pdf

// $pdf -> Cell(190,10,"",1,1);
//$pdf -> Cell(190,10,"Sales Order",0,1,"C");


$pdf -> Output();
?>