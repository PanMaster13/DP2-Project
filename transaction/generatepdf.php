<?php
// Include the main TCPDF library (search for installation path).
require_once('tcpdf/tcpdf.php');
// Extend the TCPDF class to create custom Header and Footer
class FoodsmithReport extends TCPDF {

    //Page header
    public function Header() {
        // Logo
        $image_file = '../template/images/logo_blue.png';
        $this->Image($image_file, 15, 10, 50, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 20);
        // Title
        $this->Cell(0, 15, 'Transaction Report', 0, false, 'L', 0, '', 0, false, 'T', 'M');
		/*
		$html="
		<br/>
		<h1>FoodSmith Cafe House</h1>
		<hr/>
		";
		$this->writeHTML($html, true, false, false, false, '');*/
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

session_start();

// create new PDF document
$pdf = new FoodsmithReport(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('FoodSmith Cafe');
$pdf->SetTitle('Transaction Report');
$pdf->SetSubject('Daily Transaction Report');
$pdf->SetKeywords('report');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

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
$pdf->SetFont('helvetica', 'B', 12);

// add a page
$pdf->AddPage();

if ($_SESSION["transaction"]){
	if (isset($_SESSION["period"])){
		$period = $_SESSION["period"];
	} else {
		$period = "all";
	}
$html = 
<<<html
<br/>
<h1>Period: $period</h1>
<table cellspacing="0" cellpadding="10" border="1">
	<tr>
		<th>Order ID</th>
		<th>Order Status</th>
		<th>Order Price</th>
		<th>Item List</th>
		<th>Table ID</th>
		<th>Order Date</th>
	</tr>
html;
	include_once ($_SERVER['DOCUMENT_ROOT']."/db_conn.php");
	$result = $conn->query($_SESSION["transaction"]);
	if ($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			$orderID = $row['orderID'];
			$orderStatus = $row['orderStatus'];
			$totalPrice = $row['totalPrice'];
			$itemList = nl2br($row['itemList']);
			$tableID = $row['tableID'];	
			$orderDate = $row['orderDate'];	
			
			$html .= <<<html
<tr>
	<td>$orderID</td>
	<td>$orderStatus</td>
	<td>$totalPrice</td>
	<td>$itemList</td>	
	<td>$tableID</td>	
	<td>$orderDate</td>						
</tr>
html;
		}
	}
	else
	{
		$html .= "0 results";
	}	
	$html .= "</table>";
}
else {
	$html = "";
}
// print a block of text using Write()
$pdf->writeHTML($html, true, false, false, false, '');

//Close and output PDF document
$pdf->Output('report.pdf', 'I');
?>