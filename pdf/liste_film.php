<?php
require('fpdf.php');
require('../class/class_sys.php');
require('../class/class_film.php');

class PDF extends FPDF
{
	// Titres des colonnes
	public $header = array('Media', 'Film');

	function Header()
	{
		$this->SetFillColor(255,0,0);
		$this->SetTextColor(255);
		$w = array(20, 145);
		for($i=0;$i<count($this->header);$i++)
			$this->Cell($w[$i],7,$this->header[$i],1,0,'C',true);
			$this->Ln();
	}
	function Footer()
	{
		// Positionnement à 1,5 cm du bas
		$this->SetY(-20);
				// Trait de terminaison
		$this->Cell(145,0,'','T');
		// Police Arial italique 8
		$this->SetFont('Arial','I',8);
		// Numéro de page centré
		
		$this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
	}
	
	// Tableau coloré
	function FancyTable($data)
	{
		// Couleurs, épaisseur du trait et police grasse
		$this->SetDrawColor(128,0,0);
		$this->SetAutoPageBreak(true,20);
		$this->SetLineWidth(.3);
		$this->SetFont('','B');
		
		// Restauration des couleurs et de la police
		$this->SetFillColor(224,235,255);
		$this->SetTextColor(0);
		$this->SetFont('');
		// Données
		$fill = false;
		$w = array(20, 145);
		$this->AddPage('P');
		
		foreach($data as $row)
		{				
			$this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
			$this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
			//$this->Cell($w[2],6,$row[2],'LR',0,'R',$fill);
			//$this->Cell($w[3],6,number_format($row[3],0,',',' '),'LR',0,'R',$fill);
			$this->Ln();
			//$fill = !$fill;
		}
		// Trait de terminaison
		$this->Cell(array_sum($w),0,'','T');
	}
}

// Chargement des données
function LoadData()
{
	// Lecture des lignes du fichier
	$app=new sys();
	$fi=new film();
	$data = array();
	$qry  = "SELECT * FROM movies WHERE `select` = '1' ORDER BY translatedtitle";
	if ($app->requete($qry,"S"))
	{
		while ($ligne=mysql_fetch_assoc($app->result))
		{
			extract($ligne);
			$fi->setdata($ligne);
			$data[]=explode(";",$fi->film_media.";".utf8_decode($fi->film_translatedtitle));
		}
	}
	return $data;
}

$sys = new sys();
$data = LoadData();
$pdf = new PDF("L");
$pdf->SetFont('Arial','',10);
$pdf->FancyTable($data);
$pdf->Output();
?>