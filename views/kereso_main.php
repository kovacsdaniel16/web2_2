

<h2>Előadások adatai:</h2>


    <div id = 'informaciosdiv'>
      <div id = 'nevinfo'>
        <span class="cimke">Előadó:</span><span id="ea" class="adat"></span><br>
        <span class="cimke">Előadás:</span><span id="eas" class="adat"></span><br>
        <span class="cimke">Témakör:</span><span id="tk" class="adat"></span><br>
        <span class="cimke">Dátum:</span><span id="dt" class="adat"></span><br>
        
        <form method="post">
          <input type="submit" name="create_pdf" value="PDF">
        </form>
      </div>

      <label for= 'nevcimke'>Előadás:</label>
      <select id = 'eloadasselect'></select>
      <br><br>
      <label for = 'teruletcimke'>Terület:</label>
      <select id = 'tudosselect'></select>
      <br><br>
      <label for = 'teruletcimke'>Dátum:</label>
      <select id = 'dateselect'></select>
      

    </div>

<?php

if (isset($_POST['create_pdf'])) {
  # code...


try {

	$dbh = new PDO('mysql:host=localhost;dbname=web3', 'root', '',
				array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
	$dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');

	$sql = "SELECT eloadas.id, nev, cim, terulet, ido FROM eloadas INNER JOIN kapcsolo ON eloadas.id=eloadasid INNER JOIN tudos ON tudos.id=tudosid";     
	$sth = $dbh->query($sql);
	$rows = $sth->fetchAll(PDO::FETCH_ASSOC);
}
	catch (PDOException $e) {
	echo "Hiba: ".$e->getMessage();
}

// Include the main TCPDF library
require_once('library/tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Kovács Dániel');
$pdf->SetTitle('Eloadasok');
$pdf->SetSubject('Mindentudas Egyeteme Eloadasok');
//$pdf->SetKeywords('TCPDF, PDF, Web-programozás II, Labor3');

// set default header data
$pdf->SetHeaderData("images/mte.jpg", 25, "ELOADASOK LISTAJA", "Web-programozás II\nBeadandó\n".date('Y.m.d',time()));

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

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 10);

// add a page
$pdf->AddPage();

// create the HTML content
$html  = '
<html>
	<head>
		<style>
			table {border-collapse: collapse;}
			th {font-weight: border: 1px solid red; text-align: center;}
			td {border: 1px solid blue;}
		</style>
	</head>
	<body>
		<h1 style="text-align: center; color: blue;">Eloadasok</h1>
		<table>
			<tr style="background-color: red; color: white;">
			<th style="width: 5%;">&nbsp;<br>&nbsp;<br>&nbsp;</th>
			<th style="width: 25%;">&nbsp;<br>ELOADO</th>
			<th style="width: 25%;">&nbsp;<br>ELOADAS</th>
			<th style="width: 28%;">&nbsp;<br>TUDOMANYTERULET</th>
			<th style="width: 17%;">&nbsp;<br>DATUM</th>
			</tr>
';
			$i=1;
foreach($rows as $row) {
	if($i)
		$html .= '
			<tr style="background-color: rgb(255, 255, 255); color: rgb(0, 0, 255);">
		';
	else					
		$html .= '
			<tr style="background-color: rgb(0, 0, 255); color: rgb(255, 255, 255);">
		';
	$j=0;
	foreach($row as $cell) {
		if($j==0)
			$html .= '
				<td style="text-align: right; width: 5%;">
			';
		else if($j <= 2)
			$html .= '
				<td style="text-align: left; width: 25%;">
			';
		else if($j == 3)
			$html .= '
				<td style="text-align: left; width: 28%;">
			';
			else if($j == 4)
			$html .= '
				<td style="text-align: left; width: 17%;">
			';
		$html .= $cell;
		$html .= '
				</td>
		';
		$j++;
	}
	$html .= '
			</tr>
	';
	$i = !$i;
}
$html .= '
		</table>
	<body>
</html>';

$pdf->writeHTML($html, true, false, true, false, '');

// ---------------------------------------------------------

//Close and output PDF document
ob_end_clean();

$pdf->Output('labor3-1.pdf', 'I');

}

?>



   