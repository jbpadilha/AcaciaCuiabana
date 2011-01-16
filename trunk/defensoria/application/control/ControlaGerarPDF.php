<?php

require_once ('ControlGeral.php');

class ControlaGerarPDF extends ControlGeral {
	
	public function permiteAcesso($grupo) {
		if($grupo == GruposUsuarios::$GRUPO_ADMIN || $grupo == GruposUsuarios::$GRUPO_ATENDENTE
		|| $grupo == GruposUsuarios::$GRUPO_DEFENSOR || $grupo == GruposUsuarios::$GRUPO_ESTAGIARIO)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function get($GET) {
		$this->post($GET);
	}
	
	public function post($POST) {
		try 
		{
			$fontDir = getcwd();
			define('FPDF_FONTPATH',$fontDir.'/font/');
			require('FPDF.php');
			$function = (isset($POST['funcao']))?$POST['funcao']:null;
			if(!ProjetoUtil::verificaBrancoNulo($function))
			{
				if($POST['funcao'] == "FichaHipo")
				{					
					$hipossuficiencia = new Hipossuficiencia();
					$hipossuficiencia->setIdhipossuficiencia($POST['idhipossuficiencia']);
					$hipossuficiencia->find(true);
					
				}
				else if($POST['funcao'] == "FichaHipo")
				{
					
				}
				else if($POST['funcao'] == "CartaConvite")
				{
					$cartaConvite = new CartasConvites();
					$cartaConvite->setIdcartaconvite($POST['idcartaconvite']);
					$cartaConvite->find(true);
					$this->gerarCartaConvite($cartaConvite);
					//echo "<script>window.open('', 'nomedajanela', 'toolbar=no, width=100, height=200');</script>";
				}
			}
			else
			{
				throw new Exception(Mensagens::getMensagem("ERRO_ACESSAR_FUNCIONALIDADE"));
			}
		}
		catch (Exception $e)
		{
			$this->MENSAGEM_ERRO[] = $e->getMessage();
			header("Location:../public/conteudoInicial.php?mensagemErro=".urlencode(serialize($this->MENSAGEM_ERRO)));
		}
	}
	
	private function gerarCartaConvite(CartasConvites $cartaConvite)
	{
		$pdf=new FPDF();
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$this->Header($pdf);
		$pdf->Ln(10);
		$pdf->SetFont('Arial','B',12);
		$pdf->SetFillColor(200,220,255);
	    $pdf->Cell(0,6,"CONVITE",0,1,'C',true);
	    $pdf->Ln(4);
	    $pdf->Cell(0,6,"Senhor(a) ".$cartaConvite->getParteProcesso()->getPessoa()->getNomepessoa(),0,1,'L',true);
	    $pdf->Ln(2);
	    $pdf->Cell(0,6,"Convidamos a comparecer da Defensoria Pública:",0,1,'L',true);
		$pdf->Output();
	}
	
	//Page header
	function Header(FPDF $pdf)
	{
	    //Logo
	    $pdf->Image('images/pdf_logo.jpg',10,8,33);
	    //Arial bold 15
	    $pdf->SetFont('Arial','B',15);
	    //Move to the right
	    $pdf->Cell(80);
	    //Line break
	    $pdf->Ln(20);
	    $pdf->SetFont('Arial','B',14);
		$pdf->Cell(100,10,'DEFENSORIA PÚBLICA DO ESTADO DE MATO GROSSO',1,0,'C');
		$pdf->Cell(100,10,'BALCÃO DA CIDADANIA - CUIABÁ',1,0,'C');
		$pdf->SetFont('Arial','B',13);
		$pdf->Cell(100,10,'Missão: Promover assistência jurídica aos necessitados com',1,0,'C');
		$pdf->Cell(100,10,'excelência, efetivando a inclusão social, respaldada na ética e na',1,0,'C');
		$pdf->Cell(100,10,'moralidade.',1,0,'C');
	}
	
	//Page footer
	function Footer(FPDF $pdf)
	{
	    //Position at 1.5 cm from bottom
	    $pdf->SetY(-15);
	    //Arial italic 8
	    $pdf->SetFont('Arial','I',8);
	    //Page number
	    $pdf->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	}
}
