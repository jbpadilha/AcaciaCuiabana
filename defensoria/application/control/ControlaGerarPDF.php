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
					$this->gerarFichaHipo($hipossuficiencia);
				}
				else if($POST['funcao'] == "FichaAtendimento")
				{
					$entrevista = new Entrevista();
					$entrevista->setIdentrevista($POST['identrevista']);
					$entrevista->find(true);
					$this->gerarFichaAtendimento($entrevista);
				}
				else if($POST['funcao'] == "CartaConvite")
				{
					$cartaConvite = new CartasConvites();
					$cartaConvite->setIdcartaconvite($POST['idcartaconvite']);
					$cartaConvite->find(true);
					$this->gerarCartaConvite($cartaConvite);
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
		$pdf->SetFont('Arial','B',10);
		$pdf->SetFillColor(200,220,255);
	    $pdf->Cell(0,6,"CONVITE",0,1,'C',true);
	    $pdf->Ln(4);
	    $pdf->SetFont('Arial','',8);
	    $pdf->Cell(0,6,"Senhor(a) ".$cartaConvite->getParteProcesso()->getPessoa()->getNomepessoa(),0,1,'L');
	    $pdf->Ln(2);
	    $pdf->Cell(0,6,"Convidamos a comparecer da Defensoria Pública:",0,1,'L');
	    $pdf->Cell(0,6,"Data:".$cartaConvite->getDataCartaConviteFormatadoPDF(),0,1,'L');
	    $pdf->Ln(10);
	    $pdf->Cell(0,6,$cartaConvite->getDefensor()->getPessoa()->getNomepessoa(),0,1,'C');
	    $pdf->Cell(0,6,"Defensor(ra) Público(a)",0,1,'C');
		$pdf->Output();
	}
	
	private function gerarFichaHipo(Hipossuficiencia $hipossuficiencia)
	{
		$pdf=new FPDF();
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$this->Header($pdf);
		$pdf->Ln(5);
		$pdf->SetFont('Arial','B',10);
		$pdf->SetFillColor(200,220,255);
	    $pdf->Cell(0,6,"FICHA HIPOSSUFICIÊNCIA",0,1,'C',true);
	    $pdf->Ln(2);
	    $pdf->SetFont('Arial','',8);
	    $pdf->Cell(0,6,"Nome: ".$hipossuficiencia->getPessoa()->getNomepessoa(),0,1,'L');
	    $pdf->Cell(0,6,"CPF: ".$hipossuficiencia->getPessoa()->getCpfpessoa(),0,1,'L');
	    $pdf->Cell(0,6,"RG: ".$hipossuficiencia->getPessoa()->getRgpessoa(),0,1,'L');
	    $pdf->Cell(0,6,"Emissor: ".$hipossuficiencia->getPessoa()->getEmissorpessoa(),0,1,'L');
	    $pdf->Cell(0,6,"Sexo: ".$hipossuficiencia->getPessoa()->getSexopessoa(),0,1,'L');
	    $pdf->Cell(0,6,"Estado Civil: ".$hipossuficiencia->getPessoa()->getEstadocivilpessoa(),0,1,'L');
	    $pdf->Cell(0,6,"Apelido: ".$hipossuficiencia->getPessoa()->getApelidopessoa(),0,1,'L');
	    $pdf->Cell(0,6,"Naturalidade: ".$hipossuficiencia->getPessoa()->getNaturalidadepessoa(),0,1,'L');
	    $pdf->Cell(0,6,"Data de Nascimento: ".$hipossuficiencia->getPessoa()->getDataNascimentoFormatado(),0,1,'L');
	    $pdf->Ln(2);
	    //$pdf->AddPage();
	    $pdf->Cell(0,6,"Logradouro: ".$hipossuficiencia->getPessoa()->getEndereco()->getLogradouroendereco(),0,1,'L');
	    $pdf->Cell(0,6,"Complemento: ".$hipossuficiencia->getPessoa()->getEndereco()->getComplementoendereco(),0,1,'L');
	    $pdf->Cell(0,6,"Bairro: ".$hipossuficiencia->getPessoa()->getEndereco()->getBairroendereco(),0,1,'L');
	    $pdf->Cell(0,6,"Nº: ".$hipossuficiencia->getPessoa()->getEndereco()->getNumeroendereco(),0,1,'L');
	    $pdf->Cell(0,6,"CEP: ".$hipossuficiencia->getPessoa()->getEndereco()->getCependereco(),0,1,'L');
	    $pdf->Cell(0,6,"Cidade: ".$hipossuficiencia->getPessoa()->getEndereco()->getCidadeendereco(),0,1,'L');
	    $pdf->Cell(0,6,"Estado: ".$hipossuficiencia->getPessoa()->getEndereco()->getEstadoendereco(),0,1,'L');
	    $pdf->Cell(0,6,"Telefone: ".$hipossuficiencia->getPessoa()->getEndereco()->getTelefoneendereco(),0,1,'L');
	    $pdf->Cell(0,6,"Referência: ".$hipossuficiencia->getPessoa()->getEndereco()->getReferenciaendereco(),0,1,'L');
	    $pdf->Ln(2);
	    $pdf->Cell(0,6,"Profissão: ".$hipossuficiencia->getProfhipossuficiencia(),0,1,'L');
	    $pdf->Cell(0,6,"Salário: R$ ".$hipossuficiencia->getSalariohipossuficiencia(),0,1,'L');
	    $pdf->Cell(0,6,"Empresa: ".$hipossuficiencia->getEmpresahipossuficiencia(),0,1,'L');
	    $pdf->Cell(0,6,"Renda: R$ ".$hipossuficiencia->getTotalrendahipossuficiencia(),0,1,'L');
	    $pdf->Cell(0,6,"Observações: ".$hipossuficiencia->getObservacoeshipossuficiencia(),0,1,'L');
	    $pdf->Ln(7);
	    $pdf->Cell(0,6,$hipossuficiencia->getPessoa()->getNomepessoa(),0,1,'C');
		$pdf->Output();
	}
	
	private function gerarFichaAtendimento(Entrevista $entrevista)
	{
		$pdf=new FPDF();
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$this->Header($pdf);
		$pdf->Ln(5);
		$pdf->SetFont('Arial','B',10);
		$pdf->SetFillColor(200,220,255);
	    $pdf->Cell(0,6,"FICHA ATENDIMENTO - Protocolo: ".$entrevista->getProtocoloatendimento(),0,1,'C',true);
	    $pdf->Ln(2);
	    $pdf->SetFont('Arial','',5);
	    $pdf->Cell(0,6,"Assistido: ".$entrevista->getProcesso()->getParteAssistida()->getPessoa()->getNomepessoa(),0,1,'L');
	    $pdf->Cell(0,6,"CPF: ".$entrevista->getProcesso()->getParteAssistida()->getPessoa()->getCpfpessoa(),0,1,'L');
	    $pdf->Cell(0,6,"RG: ".$entrevista->getProcesso()->getParteAssistida()->getPessoa()->getRgpessoa(),0,1,'L');
	    $pdf->Cell(0,6,"Emissor: ".$entrevista->getProcesso()->getParteAssistida()->getPessoa()->getEmissorpessoa(),0,1,'L');
	    $pdf->Cell(0,6,"Sexo: ".$entrevista->getProcesso()->getParteAssistida()->getPessoa()->getSexopessoa(),0,1,'L');
	    $pdf->Cell(0,6,"Estado Civil: ".$entrevista->getProcesso()->getParteAssistida()->getPessoa()->getEstadocivilpessoa(),0,1,'L');
	    $pdf->Cell(0,6,"Apelido: ".$entrevista->getProcesso()->getParteAssistida()->getPessoa()->getApelidopessoa(),0,1,'L');
	    $pdf->Cell(0,6,"Naturalidade: ".$entrevista->getProcesso()->getParteAssistida()->getPessoa()->getNaturalidadepessoa(),0,1,'L');
	    $pdf->Cell(0,6,"Data de Nascimento: ".$entrevista->getProcesso()->getParteAssistida()->getPessoa()->getDataNascimentoFormatado(),0,1,'L');
	    $pdf->Cell(0,6,"Logradouro: ".$entrevista->getProcesso()->getParteAssistida()->getPessoa()->getEndereco()->getLogradouroendereco(),0,1,'L');
	    $pdf->Cell(0,6,"Complemento: ".$entrevista->getProcesso()->getParteAssistida()->getPessoa()->getEndereco()->getComplementoendereco(),0,1,'L');
	    $pdf->Cell(0,6,"Bairro: ".$entrevista->getProcesso()->getParteAssistida()->getPessoa()->getEndereco()->getBairroendereco(),0,1,'L');
	    $pdf->Cell(0,6,"Nº: ".$entrevista->getProcesso()->getParteAssistida()->getPessoa()->getEndereco()->getNumeroendereco(),0,1,'L');
	    $pdf->Cell(0,6,"CEP: ".$entrevista->getProcesso()->getParteAssistida()->getPessoa()->getEndereco()->getCependereco(),0,1,'L');
	    $pdf->Cell(0,6,"Cidade: ".$entrevista->getProcesso()->getParteAssistida()->getPessoa()->getEndereco()->getCidadeendereco(),0,1,'L');
	    $pdf->Cell(0,6,"Estado: ".$entrevista->getProcesso()->getParteAssistida()->getPessoa()->getEndereco()->getEstadoendereco(),0,1,'L');
	    $pdf->Cell(0,6,"Telefone: ".$entrevista->getProcesso()->getParteAssistida()->getPessoa()->getEndereco()->getTelefoneendereco(),0,1,'L');
	    $pdf->Cell(0,6,"Referência: ".$entrevista->getProcesso()->getParteAssistida()->getPessoa()->getEndereco()->getReferenciaendereco(),0,1,'L');
	    $pdf->Ln(2);
		$pdf->Cell(0,6,"Parte Contrária: ".$entrevista->getProcesso()->getParteNaoAssistida()->getPessoa()->getNomepessoa(),0,1,'L');
	    $pdf->Cell(0,6,"CPF: ".$entrevista->getProcesso()->getParteNaoAssistida()->getPessoa()->getCpfpessoa(),0,1,'L');
	    $pdf->Cell(0,6,"RG: ".$entrevista->getProcesso()->getParteNaoAssistida()->getPessoa()->getRgpessoa(),0,1,'L');
	    $pdf->Cell(0,6,"Emissor: ".$entrevista->getProcesso()->getParteNaoAssistida()->getPessoa()->getEmissorpessoa(),0,1,'L');
	    $pdf->Cell(0,6,"Sexo: ".$entrevista->getProcesso()->getParteNaoAssistida()->getPessoa()->getSexopessoa(),0,1,'L');
	    $pdf->Cell(0,6,"Estado Civil: ".$entrevista->getProcesso()->getParteNaoAssistida()->getPessoa()->getEstadocivilpessoa(),0,1,'L');
	    $pdf->Cell(0,6,"Apelido: ".$entrevista->getProcesso()->getParteNaoAssistida()->getPessoa()->getApelidopessoa(),0,1,'L');
	    $pdf->Cell(0,6,"Naturalidade: ".$entrevista->getProcesso()->getParteNaoAssistida()->getPessoa()->getNaturalidadepessoa(),0,1,'L');
	    $pdf->Cell(0,6,"Data de Nascimento: ".$entrevista->getProcesso()->getParteNaoAssistida()->getPessoa()->getDataNascimentoFormatado(),0,1,'L');
	    $pdf->Cell(0,6,"Logradouro: ".$entrevista->getProcesso()->getParteNaoAssistida()->getPessoa()->getEndereco()->getLogradouroendereco(),0,1,'L');
	    $pdf->Cell(0,6,"Complemento: ".$entrevista->getProcesso()->getParteNaoAssistida()->getPessoa()->getEndereco()->getComplementoendereco(),0,1,'L');
	    $pdf->Cell(0,6,"Bairro: ".$entrevista->getProcesso()->getParteNaoAssistida()->getPessoa()->getEndereco()->getBairroendereco(),0,1,'L');
	    $pdf->Cell(0,6,"Nº: ".$entrevista->getProcesso()->getParteNaoAssistida()->getPessoa()->getEndereco()->getNumeroendereco(),0,1,'L');
	    $pdf->Cell(0,6,"CEP: ".$entrevista->getProcesso()->getParteNaoAssistida()->getPessoa()->getEndereco()->getCependereco(),0,1,'L');
	    $pdf->Cell(0,6,"Cidade: ".$entrevista->getProcesso()->getParteNaoAssistida()->getPessoa()->getEndereco()->getCidadeendereco(),0,1,'L');
	    $pdf->Cell(0,6,"Estado: ".$entrevista->getProcesso()->getParteNaoAssistida()->getPessoa()->getEndereco()->getEstadoendereco(),0,1,'L');
	    $pdf->Cell(0,6,"Telefone: ".$entrevista->getProcesso()->getParteNaoAssistida()->getPessoa()->getEndereco()->getTelefoneendereco(),0,1,'L');
	    $pdf->Cell(0,6,"Referência: ".$entrevista->getProcesso()->getParteNaoAssistida()->getPessoa()->getEndereco()->getReferenciaendereco(),0,1,'L');
	    $pdf->Ln(2);
	    $pdf->Cell(0,6,"Defensor Público: ".$entrevista->getProcesso()->getParteAssistida()->getDefensor()->getPessoa()->getNomepessoa(),0,1,'L');
	    $pdf->Cell(0,6,"Data da Entrevista: ".$entrevista->getDataEntrevistaFormatadoPDF(),0,1,'L');
	    $pdf->Ln(1);
	    $pdf->Cell(0,6,"Fui instruído(a) acerca da relação de documentos que devo providenciar para a medida judicial pertinente.",0,1,'L');
	    $pdf->Ln(1);
	    $pdf->Cell(0,6,"Declaro, sob as penas da lei, que as informações acima prestadas são verdadeiras.",0,1,'R');
	    $pdf->Cell(0,6,$entrevista->getProcesso()->getComarca()->getNomecomarca().",__________/_________/_________",0,1,'R');
	    $pdf->Cell(0,6,"Declarante: ____________________________",0,1,'R');
		$pdf->Output();
	}
	
	//Page header
	function Header(FPDF $pdf)
	{
	    //Logo
	    $pdf->Image($_SESSION["PATH_PUBLIC"].'/images/pdf_logo.jpg',70,0);
	    //Arial bold 15
	    //Line break
	    $pdf->Ln(25);
	    $pdf->SetFont('Arial','B',12);
		$pdf->Cell(0,5,'DEFENSORIA PÚBLICA DO ESTADO DE MATO GROSSO',0,1,'C');
		$pdf->Cell(0,5,'BALCÃO DA CIDADANIA - CUIABÁ',0,1,'C');
		$pdf->SetFont('Arial','B',10);
		$pdf->MultiCell(0,5,'Missão: Promover assistência jurídica aos necessitados com excelência, efetivando a inclusão social, respaldada na ética e na moralidade',0,'C');
	}
}
