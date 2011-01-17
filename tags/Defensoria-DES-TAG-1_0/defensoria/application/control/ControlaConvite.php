<?php

require_once ('ControlGeral.php');

class ControlaConvite extends ControlGeral {
	
	private $arrayConvites = array();
	
	public function permiteAcesso($grupo) {
		if ($grupo == GruposUsuarios::$GRUPO_ADMIN || $grupo == GruposUsuarios::$GRUPO_ATENDENTE || $grupo == GruposUsuarios::$GRUPO_DEFENSOR || $grupo == GruposUsuarios::$GRUPO_ESTAGIARIO) {
			return true;
		} else {
			return false;
		}
	}
	
	public function get($GET) {
		if(isset($GET['pesquisa']))
		{
			$cartaConvite = new CartasConvites();
			if($GET['processoPesquisa']!='')
			{
				$processo = new Processo();
				$processo->setNumeroprocesso(trim($GET['processoPesquisa']));
				if($processo->find(true))
				{
					$parteProcesso = new ParteProcesso();
					$parteProcesso->setIdprocesso($processo->getIdprocesso());
					if($parteProcesso->find())
					{
						while($parteProcesso->fetch())
						{
							if(trim($GET['nomePesquisa']) != '')
							{
								if($parteProcesso->getPessoa()->getNomepessoa() != trim($GET['nomePesquisa']))
								{
									continue;
								}
							}
							if($GET['cpfPesquisa'] == '' ||
							($GET['cpfPesquisa'] != '' && $parteProcesso->getPessoa()->getCpfpessoa() == $GET['cpfPesquisa']))
							{
								if($GET['cpfPesquisa'] != '')
									$cartaConvite->setIdparteprocesso($parteProcesso->getIdparteprocesso());
								if($GET['dataPesquisa'] != '')
									$cartaConvite->setDatacartaconvite($GET['dataPesquisa']);
								if($cartaConvite->find())
								{
									while($cartaConvite->fetch())
									{
										$arrayConvites[] = $cartaConvite->getIdcartaconvite();
									} 
								}
							}
						}
					}
				}
			}
			elseif(($GET['nomePesquisa']!='' && $GET['cpfPesquisa']!='')
			|| ($GET['nomePesquisa']=='' && $GET['cpfPesquisa']!='') ||
			($GET['nomePesquisa']!='' && $GET['cpfPesquisa']==''))
			{
				$pessoa = new Pessoa();
				if($GET['cpfPesquisa']!='')
					$pessoa->setCpfpessoa($GET['cpfPesquisa']);
				if($GET['nomePesquisa']!='')
					$pessoa->where("nomepessoa like '%".trim($GET['nomePesquisa'])."%'");
				if($pessoa->find())
				{
					while($pessoa->fetch())
					{
						$parteProcesso = new ParteProcesso();
						$parteProcesso->setIdpessoa($pessoa->getIdpessoa());
						if($parteProcesso->find())
						{
							while($parteProcesso->fetch())
							{
								$cartaConvite = new CartasConvites();
								$cartaConvite->setIdparteprocesso($parteProcesso->getIdparteprocesso());
								if($cartaConvite->find())
								{
									while($cartaConvite->fetch())
									{
										$arrayConvites[] = $cartaConvite->getIdcartaconvite();
									}
								}
							}
						}
					}
				}
			}
			
			if(count($arrayConvites) > 0)
			{
				session_start();
				$_SESSION['convitePesquisa'] = $arrayConvites;
				header ( "Location:../public/convite.php");
			}
			else
			{
				$this->MENSAGEM_ERRO[] = Mensagens::getMensagem("CONVITE_NAO_ENCONTRADO");
				header ( "Location:../public/convite.php?mensagemErro=" . urlencode ( serialize ( $this->MENSAGEM_ERRO ) ) );
			}
		}
		else
		{
			header ( "Location:../public/convite.php" );
		}
	}
	
	public function post($POST) {
		try {
			$function = (isset ( $POST ['funcao'] )) ? $POST ['funcao'] : null;
			if (! ProjetoUtil::verificaBrancoNulo ( $function )) {
				$cartaConvite = new CartasConvites ();
				if ($POST ['funcao'] == "cadastrar") {
					$this->preencheObjeto ( $cartaConvite, $POST );
					if (count ( $this->MENSAGEM_ERRO ) <= 0) {
						$this->cadastrar ( $cartaConvite );
						$this->MENSAGEM_SUCESSO [] = Mensagens::getMensagem ( "SUCESSO_CADASTRO" );
						
						/*//gerando PDF
						$parametrosPDF = array("control" => "GerarPDF","idcartaconvite" => $cartaConvite->getIdcartaconvite(),"funcao" => "CartaConvite");
						echo "<script>window.open('../recebePostGet.php', 'nomedajanela', 'toolbar=no, width=100, height=200');</script>";*/
						
						header ( "Location:../public/convite.php?mensagemSucesso=" . urlencode ( serialize ( $this->MENSAGEM_SUCESSO ) ) );
					} else {
						throw new Exception ();
					}
				} else if ($POST ['funcao'] == "alterar") {
					$this->preencheObjeto ( $cartaConvite, $POST );
					if (count ( $this->MENSAGEM_ERRO ) <= 0) {
						$this->alterar ( $cartaConvite );
						$this->MENSAGEM_SUCESSO [] = Mensagens::getMensagem ( "SUCESSO_ALTERAR" );
						header ( "Location:../public/convite.php?mensagemSucesso=" . urlencode ( serialize ( $this->MENSAGEM_SUCESSO ) ) );
					} else {
						throw new Exception ();
					}
				}
			}
		} catch ( Exception $e ) {
			$this->MENSAGEM_ERRO [] = $e->getMessage ();
			header ( "Location:../public/convite.php?mensagemErro=" . urlencode ( serialize ( $this->MENSAGEM_ERRO ) ) );
		}
	}
	
	private function preencheObjeto(CartasConvites $cartaConvite, $POST) {
		$cartaConvite->_setFrom ( $POST );
		session_start();
		$usuario = new Usuarios();
		$usuario->setUsuario($_SESSION["loginusuario"]);
		$usuario->find(true);
		$cartaConvite->setIdatendente($usuario->getIdusuario());
		$this->MENSAGEM_ERRO = array_merge ( $this->MENSAGEM_ERRO, $cartaConvite->validate () );
	}
	
	public function cadastrar(CartasConvites $cartaConvite) {
		try {
			$cartaConvite->save ();
		} catch ( Exception $e ) {
			throw new Exception ( Mensagens::getMensagem ( "ERRO_ACESSAR_FUNCIONALIDADE" ) + $e->getMessage () );
		}
	}
	
	public function alterar(CartasConvites $cartaConvite) {
		try {
			$cartaConvite->update ();
		} catch ( Exception $e ) {
			throw new Exception ( Mensagens::getMensagem ( "ERRO_ACESSAR_FUNCIONALIDADE" ) + $e->getMessage () );
		}
	}
}

?>