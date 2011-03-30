<?php
//####################################
// * Jo�o Batista Padilha e Silva Analista/Desenvolvedor (�baco Tecnologia)
// * Arquivo: BusinessEntity.php
// * Cria��o: Jo�o Batista Padilha e Silva
// * Revis�o:
// * Data de cria��o: 02/07/2008
//####################################

require("Connecta.php");
require_once("DAO.php");
require_once("QDAO.php");

/**
 * Classe de Neg�cios do Sistema Suporte On Line.
 * @author Jo�o Batista Padilha e Silva
 */
class BusinessEntity
{
	private $valueObj = null;
	private $array = null;
	private $collVo = null;
	
	/**
	 * M�todo para grava��o de log
	 * @author Rafael Henrique Vieira de Moura
	 * @param string $funcionalidade
	 * @param integer $DomnAcao
	 */
	public function gravaLog($funcionalidade = '',$DomnAcao = null)
	{
		/**
		 * Grava��o do LOG
		 */
		$log_SuporteVo = new Log_SuporteVo();
		$funcionalidadesVo = new FuncionalidadesVo();
		$controlaFuncionalidades = new Controla_Funcionalidades();
		$controlaLogSuporte = new Controla_LogSuporte();
		
		try 
		{
			$funcionalidadesVo->setParametroConsulta("WHERE linkFuncionalidades = '".strip_tags($funcionalidade)."'");
			$this->collVo = $controlaFuncionalidades->pesquisarFuncionalidades($funcionalidadesVo);
			$funcionalidadesVo = (object) $this->collVo[0];
			
			$log_SuporteVo->setDomnAcao($DomnAcao);
					
			$log_SuporteVo->setDataCriacaoLog_Suporte(date("Y-m-d H:i:s"));
			$log_SuporteVo->setIdUsuarios($_SESSION["id_Usuario"]);
			$log_SuporteVo->setIdFuncionalidades($funcionalidadesVo->getIdFuncionalidades());
			$controlaLogSuporte->cadastrarLogSuporte($log_SuporteVo);
		}
		catch (Exception $e)
		{
			throw new Exception("Erro ao gravar o LOG. - ".$e->getMessage());
		}
		/**
		 * Fim da grava��o do LOG
		 */
	}
	
	/**
	 * M�todo para Verificar se o E-mail � v�lido
	 * @author Jo�o Batista Padilha e Silva
	 * @param var $email
	 */
	public function verificaEmail($email = '')
	{
		if($email != '')
		{
			if (!preg_match ("/^[A-Za-z0-9]+([_.-][A-Za-z0-9]+)*@[A-Za-z0-9]+([_.-][A-Za-z0-9]+)*\\.[A-Za-z0-9]{2,4}$/", $email))
			{
		        throw new Exception("O Email � inv�lido.");
		    }
		}
	}
	
	/**
	 * M�todo que Envia E-mail. Recebe os par�metros para ser re-utilizado por qualquer chamada
	 * @author Jo�o Batista Padilha e Silva
	 * @param var $para
	 * @param var $assunto
	 * @param var $mensagem
	 * @param var $de
	 */
	private function enviaEmail($para,$assunto,$mensagem,$de = '')
	{
		$tabelaPrincipalVo = new TabelaBasicaVo();
		$QDAO = new QDAO();
		$this->collVo = $QDAO->findTabelaBasica($tabelaPrincipalVo);
		
		$tabelaPrincipalVo = (object) $this->collVo[0];
		
		$headers = "Content-Type: text/html; charset=iso-8859-1\n";
		
		if($de == '')
			$headers .="From: {$tabelaPrincipalVo->getNomeRemetenteTabelaBasica()}<{$tabelaPrincipalVo->getEmailPadraoTabelaBasica()}>";
		else					
		$headers .="From: <$de>";
		
		/*if (!@mail($para,$assunto,$mensagem,$headers))
		{
			throw new Exception("Ocorreu um erro no envio da mensagem.");
		}*/

	}
	
	/**
	 * M�todo de Envio de E-mail do Pedido ao Usu�rio Destinat�rio
	 * @author Jo�o Batista Padilha e Silva
	 * @param PedidosVo $pedidosVo
	 * @param Historico_PedidosVo $historicoVo
	 */
	public function enviaPedidoUsuario(PedidosVo $pedidosVo, Historico_PedidosVo $historicoVo)
	{
		try 
		{
			$controlaUsuarios = new Controla_Usuarios();
			$usuariosVo = new UsuariosVo();
			
			$usuariosVo->setIdUsuarios($historicoVo->getIdUsuariosDestinatario());
			$collVoUsuarios = $controlaUsuarios->pesquisarUsuariosSistema($usuariosVo);
			$usuariosVo = (object) $collVoUsuarios[0];
			$para = $usuariosVo->getEmailUsuarios();
			
			$usuariosVo->setIdUsuarios($historicoVo->getIdUsuarioOrigem());
			$collVoUsuarios = $controlaUsuarios->pesquisarUsuariosSistema($usuariosVo);
			$usuariosVo = (object) $collVoUsuarios[0];
			$de = $usuariosVo->getEmailUsuarios();
			
			$mensagemEnvio = "";
			$assunto = "";
			
			self::enviaEmail($para,$assunto,$mensagemEnvio,$de);
			
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	
	/**
	 * M�todo para envio da N�o Conformidade por e-mail para o destinat�rio respons�vel de recebe-la
	 * e para o usu�rio que dever� justifica-la.
	 * @author Rafael Henrique Vieira de Moura
	 * @param PedidosVo $pedidosVo
	 */
	public function enviaNaoConformidades(PedidosVo $pedidosVo)
	{
		try 
		{
			$controlaUsuarios = new Controla_Usuarios();
			$controlaHistorico = new Controla_Historico();
			
			//Envio de e-mail para os Destinatarios da N�o Conformidades do Projeto
			$destinatariosNaoConformidadesVo = new DestinatariosNaoConformidadesVo();
			$destinatariosNaoConformidadesVo->setIdProjetos($pedidosVo->getIdProjetos());
			$collVo_Destinatarios = self::pesquisarDestinatariosNaoConformidades($destinatariosNaoConformidadesVo);
			if (!is_null($collVo_Destinatarios))
			{
				foreach ($collVo_Destinatarios as $destinatarios)
				{
					$destinatariosNaoConformidadesVo = (object) $destinatarios;
					$usuariosVo = new UsuariosVo();
					$usuariosVo->setIdUsuarios($destinatariosNaoConformidadesVo->getIdUsuarios());
					$collVo_Usuarios = $controlaUsuarios->pesquisarUsuarios($usuariosVo);
					$usuariosVo = (object) $collVo_Usuarios[0];
					
					$mensagem = "Uma nova N�o Conformidade no seu Projeto. Pedido N� ".$pedidosVo->getIdPedidos();
					
					self::enviaEmail("<".$usuariosVo->getEmailUsuarios().">","Nova Nao Conformidade",$mensagem);
				}
			}
			
			//Envia e-mail para usu�rio
			$historicoVo = new Historico_PedidosVo();
			$historicoVo->setIdPedidos($pedidosVo->getIdPedidos());
			$collVo_Historico = $controlaHistorico->pesquisarHistorico($historicoVo);
			$i = count($collVo_Historico)-1;
			$historicoVo = (object) $collVo_Historico[$i];
			
			$usuariosVo = new UsuariosVo();
			$usuariosVo->setIdUsuarios($historicoVo->getIdUsuariosDestinatario());
			$collVo_Usuarios = $controlaUsuarios->pesquisarUsuarios($usuariosVo);
			$usuariosVo = (object) $collVo_Usuarios[0];
			
			$mensagem = "Foi gerada uma n�o conformidade para o pedido n� ".$pedidosVo->getIdPedidos();
			
			self::enviaEmail("<".$usuariosVo->getEmailUsuarios().">","Nova Nao Conformidade",$mensagem);	
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
		
	}
	
	/**
	 * M�todo de Pesquisa de Usu�rios. Retorna todos os dados do usu�rios, atrav�s da chamada a classe QDAO
	 * Usado para login do sistema
	 * @author Jo�o Batista Padilha e Silva
	 * @param UsuariosVo $usuariosVo
	 */
	public function pesquisarUsuarios(UsuariosVo $usuariosVo)
	{
		$QDAO = new QDAO();
		
		if($usuariosVo->getLoginUsuarios() != '' && $usuariosVo->getSenhaUsuarios() != '' && $usuariosVo->getIdUsuarios() == '')
		{
			try
			{
				$this->collVo = $QDAO->findUsuarios($usuariosVo);
				if(is_null($this->collVo))
					throw new Exception("Usu�rio e/ou Senha incorretos.");
				
				$usuariosVo = (object) $this->collVo[0];				
				
				// Grava Sess�o
				
				session_cache_expire(10);
				session_regenerate_id("loginUsuarios");
				$_SESSION["usuario_Logado"] = $usuariosVo->getLoginUsuarios();
				$_SESSION["id_Usuario"] = $usuariosVo->getIdUsuarios();
				$_SESSION["nome_Usuario"] = $usuariosVo->getNomeUsuarios();
				$_SESSION['usuario_Clientes'] = $usuariosVo->getFlagTipoUsuario();
								
				//Fim Grava Sess�o
			}
			catch (Exception $e)
			{
				throw new Exception("N�o foi poss�vel continuar. - {$e->getMessage()}");
			}
		}		
		if($usuariosVo->getLoginUsuarios() != '' && $usuariosVo->getSenhaUsuarios() == '' && $usuariosVo->getIdUsuarios() == '')
		{
			try 
			{
				$dominio = new Dominio();
				$sqlPesquisa = "WHERE loginUsuarios = '{$usuariosVo->getLoginUsuarios()}'";
				$usuariosVo->setParametroConsulta($sqlPesquisa);
				$this->collVo = $QDAO->findUsuarios($usuariosVo);
				if(is_null($this->collVo))
					throw new Exception("Login inexistente.");
				$usuariosVo = (object) $this->collVo[0];
				$usuariosVo->setSenhaUsuarios();
				$mensagem = $dominio->mensagemEmailLembrarSenha . str_shuffle(substr($usuariosVo->getSenhaUsuarios(),0,8));
				self::enviaEmail($usuariosVo->getEmailUsuarios(), "Re-Envio de Senha", $mensagem);
			}
			catch (Exception $e)
			{
				throw new Exception("N�o foi poss�vel continuar. {$e->getMessage()}");
			}
		}
		
		if($usuariosVo->getIdUsuarios() != '')
		{
			try 
			{
				$this->collVo = $QDAO->findUsuarios($usuariosVo);
			}
			catch (Exception $e)
			{
				throw new Exception("N�o foi poss�vel buscar Usu�rios. {$e->getMessage()}");
			}
		}
		elseif ($usuariosVo->getNomeUsuarios() != '' || $usuariosVo->getFlagSuspenso() !== '')
		{
			try
			{
				$this->collVo = $QDAO->findUsuarios($usuariosVo);
			}
			catch (Exception $e)
			{
				throw new Exception("N�o foi poss�vel buscar Usu�rios. {$e->getMessage()}");
			}
		}
		else
		{
			try
			{
				$usuariosVo->setParametroConsulta($usuariosVo->getParametroConsulta().' ORDER BY nomeUsuarios ASC');
				$this->collVo = $QDAO->findUsuarios($usuariosVo);
			}
			catch (Exception $e)
			{
				throw new Exception("N�o foi poss�vel buscar Usu�rios. {$e->getMessage()}");
			}
		}
		
		return $this->collVo;
	}
	
	/**
	 * M�todo de pesquisa de Funcionalidades
	 * @author Jo�o Batista Padilha e Silva
	 * @param FuncionalidadesVo $funcionalidadesVo
	 * @return $collVo
	 */
	public function pesquisarFuncionalidades(FuncionalidadesVo $funcionalidadesVo)
	{
		$QDAO = new QDAO();
		$dominio = new Dominio();
		try 
		{
			//Ordernar Lista
			//Verificar se A pesquisa � pelo precedente colocando assim em ordem
			if($funcionalidadesVo->getDomnTipoFuncionalidades() == $dominio->DomnTipoFuncionalidade_Menu)
				$funcionalidadesVo->setParametroConsulta("WHERE DomnTipoFuncionalidades = '{$dominio->DomnTipoFuncionalidade_Menu}' ORDER BY precedenteFuncionalidades asc, ordemFuncionalidades asc");
			elseif ($funcionalidadesVo->getDomnTipoFuncionalidades() == $dominio->DomnTipoFuncionalidade_SubMenu)
				$funcionalidadesVo->setParametroConsulta("WHERE DomnTipoFuncionalidades = '{$dominio->DomnTipoFuncionalidade_SubMenu}' ORDER BY precedenteFuncionalidades asc, ordemFuncionalidades asc");
			elseif ($funcionalidadesVo->getPrecedenteFuncionalidades() != '')
				$funcionalidadesVo->setParametroConsulta("WHERE precedenteFuncionalidades = '{$funcionalidadesVo->getPrecedenteFuncionalidades()}' ORDER BY ordemFuncionalidades asc");
			elseif ($funcionalidadesVo->getNomeFuncionalidades() != '')
				$funcionalidadesVo->setParametroConsulta("WHERE nomeFuncionalidades like '{$funcionalidadesVo->getNomeFuncionalidades()}%'");
			
				
			$this->collVo = $QDAO->findFuncionalidades($funcionalidadesVo);
			
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
		return $this->collVo;
	}
	
	/**
	 * M�todo de Consulta Funcionalidades por Link
	 * @author Jo�o Batista Padilha e Silva
	 * @param FuncionalidadesVo $funcionalidadesVo
	 * @return array $this->collVo
	 */
	public function pesquisarFuncionalidadesPorLink(FuncionalidadesVo $funcionalidadesVo)
	{
		$QDAO = new QDAO();
		$dominio = new Dominio();
		try 
		{
			if($funcionalidadesVo->getLinkFuncionalidades() != '')
			{
				$funcionalidadesVo->setParametroConsulta("WHERE linkFuncionalidades = '{$funcionalidadesVo->getLinkFuncionalidades()}'");
			}
			$this->collVo = $QDAO->findFuncionalidades($funcionalidadesVo);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
		return $this->collVo;
	}
	
	/**
	 * M�todo de busca de permiss�es de Usu�rios do Sistema
	 * @author Jo�o Batista Padilha e Silva
	 * @param Permissao_Usuarios_Funcionalidades_PapeisVo $permissaoVo
	 * @return $this->collVo
	 */
	public function buscaPermissaoUsuarios(Permissao_Usuarios_Funcionalidades_PapeisVo $permissaoVo)
	{
		$QDAO = new QDAO();
		
		try 
		{
			if($permissaoVo->getIdUsuarios() == '')
				throw new Exception("Usu�rio inexistente.");
			$this->collVo = $QDAO->findPermissoes_Usuarios_Funcionalidades_Papeis($permissaoVo);
		}
		catch (Exception $e)
		{
			throw new Exception("N�o foi poss�vel continuar. {$e->getMessage()}");
		}
		return $this->collVo;
	}
	
	/**
	 * M�todo para Buscar permiss�es em Geral
	 * @author Jo�o Batista Padilha e Silva
	 * @param Permissao_Usuarios_Funcionalidades_PapeisVo $permissaoVo
	 * @return $this->collVo
	 */
	public function buscaPermissoes(Permissao_Usuarios_Funcionalidades_PapeisVo $permissaoVo , $mensagem = true)
	{
		try
		{
			$QDAO = new QDAO();
			$this->collVo = $QDAO->findPermissoes_Usuarios_Funcionalidades_Papeis($permissaoVo);
			
			if(is_null($this->collVo) && $mensagem == true)
				throw new Exception("N�o existe permiss�o cadastrada.");
			
		}
		catch (Exception $e)
		{
			throw new Exception("N�o foi poss�vel continuar. {$e->getMessage()}");
		}
		return $this->collVo;
	}
	
	/**
	 * M�todo para deletar Permissoes por id do Papel ou id do Usu�rio
	 * @author Jo�o Batista Padilha e Silva
	 * @param Permissao_Usuarios_Funcionalidades_PapeisVo $permissaoVo
	 */
	public function deletaPermissoes(Permissao_Usuarios_Funcionalidades_PapeisVo $permissaoVo)
	{
		$DAO = new DAO();
		try 
		{
			if($permissaoVo->getIdPapeis() == '' && $permissaoVo->getIdUsuarios() == '')
				throw new Exception("Papel ou usu�rio n�o selecionado");
			$DAO->deletarPermissaoUsuariosFuncionalidadesPapeis($permissaoVo);
		}
		catch (Exception $e)
		{
			throw new Exception("N�o foi poss�vel Continuar. {$e->getMessage()}");
		}
	}
	
	/**
	 * M�todo que busca todos os papeis existentes
	 * @author Jo�o Batista Padilha e Silva
	 * @param PapeisVo $papeisVo
	 * @return $this->collVo
	 */
	public function pesquisarPapeis(PapeisVo $papeisVo)
	{
		$QDAO = new QDAO();
		try 
		{
			$this->collVo = $QDAO->findPapeis($papeisVo);
		}
		catch (Exception $e)
		{
			throw new Exception("N�o foi poss�vel buscar papeis. {$e->getMessage()}");
		}
		return $this->collVo;		
	}
	
	/**
	 * M�todo que cadastra o papel
	 * @author Jo�o Batista Padilha e Silva
	 * @param PapeisVo $papeisVo
	 */
	public function cadastrarPapeis(PapeisVo $papeisVo)
	{
		//Valida��o
		if($papeisVo->getNomePapeis() == '')
			throw new Exception("O nome do papel n�o pode estar em branco.");
		
		$DAO = new DAO();
		try 
		{
			if($papeisVo->getIdPapeis() == '')
			{
				$DAO->inserirPapeis($papeisVo);
			}
			else 
			{
				$DAO->alterarPapeis($papeisVo);
			}
		}
		catch (Exception $e)
		{
			throw new Exception("N�o foi poss�vel continuar. {$e->getMessage()}");
		}
	}
	
	/**
	 * M�todo para cadastro de usu�rios
	 * @author Rafael Henrique Vieira de Moura
	 * @param UsuariosVo $usuariosVo
	 */
	public function cadastrarUsuarios(UsuariosVo $usuariosVo)
	{
		//valida��o
		if ($usuariosVo->getNomeUsuarios() == '')
			throw new Exception("O Nome do usu�rio n�o pode estar em branco.");
		if ($usuariosVo->getLoginUsuarios() == '')
			throw new Exception("O Login do usu�rio n�o pode estar em branco.");
		if ($usuariosVo->getSenhaUsuarios() == '' && $usuariosVo->getIdUsuarios() == '')
			throw new Exception("A Senha do usu�rio n�o pode estar em branco.");
		if ($usuariosVo->getEmailUsuarios() == '')
			throw new Exception("O E-mail do usu�rio n�o pode estar em branco.");
		self::verificaEmail($usuariosVo->getEmailUsuarios());
		
		$DAO = new DAO();
		
		try
		{
			if ($usuariosVo->getIdUsuarios() == '') {
				$DAO->inserirUsuarios($usuariosVo);
			} else {
				$DAO->alterarUsuarios($usuariosVo);
			}
		}
		catch (Exception $e)
		{
			throw new Exception("N�o foi poss�vel continuar. {$e->getMessage()}");
		}
	}
	
	/**
	 * M�todo para altera��o de senha do usu�rio
	 * @author Rafael Henrique Vieira de Moura
	 * @param UsuariosVo $usuariosVo
	 */
	public function alteraSenhaUsuarios(UsuariosVo $usuariosVo)
	{
		if ($usuariosVo->getSenhaUsuarios() == '')
			throw new Exception("O campo Nova Senha n�o pode estar em branco.");
		if ($_POST['confirmarSenhaUsuarios'] == '')
			throw new Exception("O campo Confirmar Senha n�o pode estar em branco.");
		
		if ($usuariosVo->getSenhaUsuarios() != $_POST['confirmarSenhaUsuarios']) {
			throw new Exception("As senhas digitadas n�o s�o iguais.");
		}
		
		$DAO = new DAO();
		try 
		{
			$DAO->alterarSenhaUsuarios($usuariosVo);
		}
		catch (Exception $e)
		{
			throw new Exception("N�o foi poss�vel continuar. {$e->getMessage()}");
		}
	}
	
	/**
	 * M�todo para Cadastrar/Alterar Funcionalidades no Sistema
	 * @author Jo�o Batista Padilha e Silva
	 * @param FuncionalidadesVo $funcionalidadesVo
	 */
	public function cadastrarFuncionalidades(FuncionalidadesVo $funcionalidadesVo)
	{
		//Valida��o
		if($funcionalidadesVo->getNomeFuncionalidades() == '')
			throw new Exception("O nome da Funcionalidade n�o pode estar em branco.");
		
		$DAO = new DAO();
		try 
		{
			if($funcionalidadesVo->getIdFuncionalidades() == '')
			{
				$DAO->inserirFuncionalidades($funcionalidadesVo);
			}
			else 
			{
				$DAO->alterarFuncionalidades($funcionalidadesVo);
			}
		}
		catch (Exception $e)
		{
			throw new Exception("N�o foi poss�vel continuar. {$e->getMessage()}");
		}
	}
	
	/**
	 * M�todo para buscar M�dulos do Sistema
	 * @author Jo�o Batista Padilha e Silva
	 * @param ModulosVo $modulosVo
	 * @return $this->collVo
	 */
	public function pesquisarModulos(ModulosVo $modulosVo)
	{
		$QDAO = new QDAO();
		try 
		{
			if(is_null($modulosVo->getIdModulos()) && $modulosVo->getNomeModulos() != '')
				$modulosVo->setParametroConsulta("WHERE nomeModulos like '{$modulosVo->getNomeModulos()}%'");
			$this->collVo = $QDAO->findModulos($modulosVo);
		}
		catch (Exception $e)
		{
			throw new Exception("N�o foi poss�vel buscar M�dulos. {$e->getMessage()}");
		}
		return $this->collVo;
	}
	
	/**
	 * M�todo que cadastra os m�dulos no Sistema/ Inser��o e Altera��o
	 * @author Jo�o Batista Padilha e Silva
	 * @param ModulosVo $modulosVo
	 */
	public function cadastrarModulos(ModulosVo $modulosVo)
	{
		//Valida��o
		if($modulosVo->getNomeModulos() == '')
			throw new Exception("O nome do m�dulo n�o pode estar em branco.");
		
		$DAO = new DAO();
		try 
		{
			if($modulosVo->getIdModulos() == '')
			{
				$DAO->inserirModulos($modulosVo);
			}
			else 
			{
				$DAO->alterarModulos($modulosVo);
			}
		}
		catch (Exception $e)
		{
			throw new Exception("N�o foi poss�vel continuar. {$e->getMessage()}");
		}
	}
	
	/**
	 * Metodo para pesquisa de SubModulos
	 * @author Rafael H. V. Moura
	 * @param SubModulosVo $subModulosVo
	 * @return array $this->collVo
	 */
	public function pesquisarSubModulos(SubModulosVo $subModulosVo)
	{
		$QDAO = new QDAO();
		
		try 
		{
			$this->collVo = $QDAO->findSubModulos($subModulosVo);
		}
		catch (Exception $e)
		{
			throw new Exception("N�o foi poss�vel continuar. {$e->getMessage()}");
		}
		
		return $this->collVo;
	}
	
	/**
	 * Metodo para cadastro e altera��o de SubModulos
	 * @author Rafael Henrique Vieira de Moura
	 * @param SubModulosVo $subModulosVo
	 */
	public function cadastrarSubModulos(SubModulosVo $subModulosVo)
	{
		if ($subModulosVo->getNomeSubModulos() == '')
			throw new Exception("O Nome do SubModulo n�o pode estar em branco.");
		
		$DAO = new DAO();
		
		try 
		{
			if ($subModulosVo->getIdSubModulos() == '') {
				$DAO->inserirSubModulos($subModulosVo);
			} else {
				$DAO->alterarSubModulos($subModulosVo);
			}
		}
		catch (Exception $e)
		{
			throw new Exception("N�o foi poss�vel continuar. {$e->getMessage()}");
		}
	}
	
	/**
	 * M�todo de Cadastramento de Modulos-SubM�dulos (Sub-M�dulos para cada M�dulo)
	 * @author Jo�o Batista Padilha e Silva
	 * @param Modulos_SubModulosVo $modulosSubModulosVo
	 */
	public function cadastrarModulosSubModulos(Modulos_SubModulosVo $modulosSubModulosVo)
	{
		//Valida��o
		if($modulosSubModulosVo->getIdModulos() == '' && $modulosSubModulosVo->getIdSubModulos() == '')
			throw new Exception("O M�dulo e o Sub-M�dulo deve ser selecionado n�o pode estar em branco.");
		
		$DAO = new DAO();
		try 
		{
				$DAO->inserirModulos_SubModulos($modulosSubModulosVo);
		}
		catch (Exception $e)
		{
			throw new Exception("N�o foi poss�vel continuar. {$e->getMessage()}");
		}
	}
	
	/**
	 * M�todo para pesquisar todos os Sub-M�dulos para cada M�dulo
	 * @author Jo�o Batista Padilha e Silva
	 * @param Modulos_SubModulosVo $modulosSubModulosVo
	 * @return $this->collVo
	 */
	public function pesquisarModulosSubModulos(Modulos_SubModulosVo $modulosSubModulosVo)
	{
		$QDAO = new QDAO();
		
		try 
		{
			$this->collVo = $QDAO->findModulos_SubModulos($modulosSubModulosVo);
		}
		catch (Exception $e)
		{
			throw new Exception("N�o foi poss�vel continuar. {$e->getMessage()}");
		}
		
		return $this->collVo;
	}
	
	/**
	 * M�todo que deleta todas os sub-modulos para o m�dulo selecionado
	 * @author Jo�o Batista Padilha e Silva
	 * @param Modulos_SubModulosVo $modulosSubModulosVo
	 */
	public function deletaModulosSubModulos(Modulos_SubModulosVo $modulosSubModulosVo)
	{
		$DAO = new DAO();
		try 
		{
			if($modulosSubModulosVo->getIdModulos() == '')
				throw new Exception("Identifica��o do M�dulo n�o identificado.");
			$DAO->deletarModulos_SubModulos($modulosSubModulosVo);
		}
		catch (Exception $e)
		{
			throw new Exception("N�o foi poss�vel Continuar. {$e->getMessage()}");
		}
	}
	
	/**
	 * M�todo para pesquisa de Clientes
	 * @author Rafael Henrique Vieira de Moura
	 * @param ClientesVo $clientesVo
	 * @return array $this->collVo
	 */
	public function pesquisarClientes(ClientesVo $clientesVo)
	{
		$QDAO = new QDAO();
		
		try 
		{
			$this->collVo = $QDAO->findClientes($clientesVo);
		}
		catch (Exception $e)
		{
			throw new Exception("N�o foi poss�vel continuar. {$e->getMessage()}");
		}
		
		return $this->collVo;
	}
	
	/**
	 * Metodo para cadastro e altera��o de SubModulos
	 * @author Rafael Henrique Vieira de Moura
	 * @param SubModulosVo $subModulosVo
	 */
	public function cadastrarClientes(ClientesVo $clientesVo)
	{
		if ($clientesVo->getNomeClientes() == '')
			throw new Exception("O Nome do Cliente n�o pode estar em branco.");
		
		$DAO = new DAO();
		
		try 
		{
			if ($clientesVo->getIdClientes() == '') {
				$DAO->inserirClientes($clientesVo);
			} else {
				$DAO->alterarClientes($clientesVo);
			}
		}
		catch (Exception $e)
		{
			throw new Exception("N�o foi poss�vel continuar. {$e->getMessage()}");
		}
	}
	
	/**
	 * M�todo de Pesquisa da Tabela B�sica
	 * @author Jo�o Batista Padilha e Silva
	 * @param TabelaBasicaVo $tabelaBasicaVo
	 * @return $this->collVo
	 */
	public function pesquisarTabelaBasica(TabelaBasicaVo $tabelaBasicaVo)
	{
		$QDAO = new QDAO();
		try 
		{
			$this->collVo = $QDAO->findTabelaBasica($tabelaBasicaVo);
		}
		catch (Exception $e)
		{
			throw new Exception("N�o foi poss�vel continuar. {$e->getMessage()}");
		}
		
		return $this->collVo;
	}
	
	/**
	 * M�todo de altera��o da tabela b�sica
	 * @author Jo�o Batista Padilha e Silva
	 * @param TabelaBasicaVo $tabelaBasicaVo
	 */
	public function cadastrarTabelaBasica(TabelaBasicaVo $tabelaBasicaVo)
	{
		if ($tabelaBasicaVo->getToleranciaHoraConformidade() == '')
			throw new Exception("A Toler�ncia das n�o conformidades n�o pode estar em branco.");
		
		$DAO = new DAO();
		
		try 
		{
			self::verificaEmail($tabelaBasicaVo->getEmailPadraoTabelaBasica());
			$DAO->alterarTabelaBasica($tabelaBasicaVo);
		}
		catch (Exception $e)
		{
			throw new Exception("N�o foi poss�vel continuar. {$e->getMessage()}");
		}
	}
	
	/**
	 * M�todo para cadastro de Usuarios_Clientes
	 * @author Rafael Henrique Vieira de Moura
	 * @param Usuarios_ClientesVo $usuarios_ClientesVo
	 */
	public function cadastrarUsuariosClientes(Usuarios_ClientesVo $usuarios_ClientesVo)
	{
		//valida��o
		if ($usuarios_ClientesVo->getIdClientes() == '' || $usuarios_ClientesVo->getIdUsuarios() == '')
				throw new Exception("Usu�rios e Clientes n�o selecionados");
		
		$DAO = new DAO();
		try
		{
			$DAO->inserirUsuariosClientes($usuarios_ClientesVo);
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
		}
	}
	
	/**
	 * M�todo que pesquisa todas as tecnologias existentes no Sistema
	 * @author Jo�o Batista Padilha e Silva
	 * @param TecnologiasVo $tecnologiasVo
	 * @return $this->collVo
	 */
	public function pesquisarTecnologias(TecnologiasVo $tecnologiasVo)
	{
		$QDAO = new QDAO();
		
		try 
		{
			if($tecnologiasVo->getNomeTecnologias() != '' && $tecnologiasVo->getIdTecnologias() == '')
				$tecnologiasVo->setParametroConsulta("WHERE nomeTecnologias LIKE '{$tecnologiasVo->getNomeTecnologias()}%'"); 
			$this->collVo = $QDAO->findTecnologias($tecnologiasVo);
		}
		catch (Exception $e)
		{
			throw new Exception("N�o foi poss�vel continuar. {$e->getMessage()}");
		}
		return $this->collVo;
	}
	
	/**
	 * M�todo que cadastra as Tecnologias no Sistema
	 * @author Jo�o Batista Padilha e Silva
	 * @param TecnologiasVo $tecnologiasVo
	 */
	public function cadastrarTecnologias(TecnologiasVo $tecnologiasVo)
	{
		//Valida��o
		if($tecnologiasVo->getNomeTecnologias() == '')
			throw new Exception("O nome da Tecnologia n�o pode estar em branco.");
		
		$DAO = new DAO();
		try 
		{
			if($tecnologiasVo->getIdTecnologias() == '')
			{
				$DAO->inserirTecnologias($tecnologiasVo);
			}
			else 
			{
				$DAO->alterarTecnologias($tecnologiasVo);
			}
		}
		catch (Exception $e)
		{
			throw new Exception("N�o foi poss�vel continuar. {$e->getMessage()}");
		}
	}
	
	/**
	 * M�todo de pesquisa de Vers�es de Sistema
	 * @author Jo�o Batista Padilha e Silva
	 * @param VersoesVo $versoesVo
	 * @return $this->collVo
	 */
	public function pesquisarVersoes(VersoesVo $versoesVo)
	{
		$QDAO = new QDAO();
		$converte = new FormataData();
		
		try 
		{
			/*if($versoesVo->getNomeVersoes() != '' && $versoesVo->getDataEntregaVersoes() == '' && $versoesVo->getIdVersoes() == '')
				$versoesVo->setParametroConsulta("WHERE nomeVersoes like '{$versoesVo->getNomeVersoes()}%'");
			if($versoesVo->getNomeVersoes() == '' && $versoesVo->getDataEntregaVersoes() != '' && $versoesVo->getIdVersoes() == '')
				$versoesVo->setParametroConsulta("WHERE dataEntregaVersoes = '{$versoesVo->getDataEntregaVersoes()}'");
			if($versoesVo->getNomeVersoes() != '' && $versoesVo->getDataEntregaVersoes() != '' && $versoesVo->getIdVersoes() == '')
				$versoesVo->setParametroConsulta("WHERE nomeVersoes like '{$versoesVo->getNomeVersoes()}%' AND dataEntregaVersoes = '{$versoesVo->getDataEntregaVersoes()}'");*/
			
			if ($versoesVo->getNomeVersoes() != ''){
				$versoesVo->setParametroConsulta("WHERE nomeVersoes like '{$versoesVo->getNomeVersoes()}%'");
			}
			if ($versoesVo->getDataEntregaVersoes() != '') {
				if ($versoesVo->getNomeVersoes() == '') {
					$versoesVo->setParametroConsulta("WHERE dataEntregaVersoes = '".$converte->toDBDate($versoesVo->getDataEntregaVersoes())."'");
				} else {
					$versoesVo->setParametroConsulta($versoesVo->getParametroConsulta()." AND dataEntregaVersoes = '".$converte->toDBDate($versoesVo->getDataEntregaVersoes())."'");
				}
			}
			if ($versoesVo->getDataEntregaVersoesClientes() != '') {
				if ($versoesVo->getNomeVersoes() == '' && $versoesVo->getDataEntregaVersoes() == '') {
					$versoesVo->setParametroConsulta("WHERE dataEntregaVersoesClientes = '".$converte->toDBDate($versoesVo->getDataEntregaVersoesClientes())."'");
				} else {
					$versoesVo->setParametroConsulta($versoesVo->getParametroConsulta()." AND dataEntregaVersoesClientes = '".$converte->toDBDate($versoesVo->getDataEntregaVersoesClientes())."'");
				}
			}
			if ($versoesVo->getIdProjetos() != '') {
				if ($versoesVo->getNomeVersoes() == '' && $versoesVo->getDataEntregaVersoes() == '' && $versoesVo->getDataEntregaVersoesClientes() == '') {
					$versoesVo->setParametroConsulta("WHERE idProjetos = '".$versoesVo->getIdProjetos()."'");
				} else {
					$versoesVo->setParametroConsulta($versoesVo->getParametroConsulta()." AND idProjetos = '".$versoesVo->getIdProjetos()."'");
				}
			}

			$this->collVo = $QDAO->findVersoes($versoesVo);
		}
		catch (Exception $e)
		{
			throw new Exception("N�o foi poss�vel continuar. {$e->getMessage()}");
		}
		return $this->collVo;
	}
	
	/**
	 * M�todo de Cadastrar / Alterar Vers�es de Sistema
	 * @author Jo�o Batista Padilha e Silva
	 * @param VersoesVo $versoesVo
	 */
	public function cadastrarVersoes(VersoesVo $versoesVo)
	{
		//Valida��o
		if($versoesVo->getNomeVersoes() == '')
			throw new Exception("O nome da Vers�o n�o pode estar em branco.");
		if($versoesVo->getDataEntregaVersoes() == '')
			throw new Exception("A Data de Entrega n�o pode estar em branco.");
		if($versoesVo->getDataEntregaVersoesClientes() == '')
			throw new Exception("A Data de Entrega da Vers�o para o Cliente n�o pode estar em branco.");
		if($versoesVo->getIdProjetos() == '')
			throw new Exception("O Projeto da Vers�o deve ser selecionado.");
		/*if($versoesVo->getNomeVersoes() == '' && $versoesVo->getDataEntregaVersoesClientes() == '' && $versoesVo->getDataEntregaVersoes() == '')
			throw new Exception("O Nome da Vers�o, Data de Entrega e a Data de Entrega para o Cliente n�o podem estar em branco.");*/
		
		$formataData = new FormataData();
		$versoesVo->setDataEntregaVersoes($formataData->toDBDate($versoesVo->getDataEntregaVersoes()));	
		$versoesVo->setDataEntregaVersoesClientes($formataData->toDBDate($versoesVo->getDataEntregaVersoesClientes()));
			
		$DAO = new DAO();
		try 
		{
			if($versoesVo->getIdVersoes() == '')
			{
				$DAO->inserirVersoes($versoesVo);
			}
			else 
			{
				$DAO->alterarVersoes($versoesVo);
			}
		}
		catch (Exception $e)
		{
			throw new Exception("N�o foi poss�vel continuar. {$e->getMessage()}");
		}
	}
	
	/**
	 * M�todo para pesquisa de anexos
	 * @author Rafael Henrique Vieira de Moura
	 * @param AnexosVo $anexosVo
	 * @return array $this->collVo
	 */
	public function pesquisarAnexos(AnexosVo $anexosVo)
	{
		$QDAO = new QDAO();
		
		try 
		{
			$this->collVo = $QDAO->findAnexos($anexosVo);
		}
		catch (Exception $e)
		{
			throw new Exception("N�o foi poss�vel continuar. {$e->getMessage()}");
		}
		
		return $this->collVo;
	}
	
	/**
	 * M�todo para pesquisar Atividades
	 * @author Jo�o Batista Padilha e Silva
	 * @param AtividadesPontoFuncaoHorasVo $atividadesVo
	 * @return $this->collVo
	 */
	public function pesquisarAtividades(AtividadesPontoFuncaoHorasVo $atividadesVo)
	{
		$QDAO = new QDAO();
		
		try 
		{
			if($atividadesVo->getNomeAtividadesPontoFuncaoHoras() != '' && $atividadesVo->getIdTecnologias() == '' && $atividadesVo->getIdAtividadePontoFuncaoHoras() == '')
				$atividadesVo->setParametroConsulta("WHERE nomeAtividadesPontoFuncaoHoras LIKE '{$atividadesVo->getNomeAtividadesPontoFuncaoHoras()}%'");
			if($atividadesVo->getNomeAtividadesPontoFuncaoHoras() == '' && $atividadesVo->getIdTecnologias() != '' && $atividadesVo->getIdAtividadePontoFuncaoHoras() == '')
				$atividadesVo->setParametroConsulta("WHERE idTecnologias = '{$atividadesVo->getIdTecnologias()}'");
			if($atividadesVo->getNomeAtividadesPontoFuncaoHoras() != '' && $atividadesVo->getIdTecnologias() != '' && $atividadesVo->getIdAtividadePontoFuncaoHoras() == '')
				$atividadesVo->setParametroConsulta("WHERE nomeAtividadesPontoFuncaoHoras LIKE '{$atividadesVo->getNomeAtividadesPontoFuncaoHoras()}%' AND idTecnologias = '{$atividadesVo->getIdTecnologias()}'");

			$this->collVo = $QDAO->findAtividadesPontoFuncaoHoras($atividadesVo);
		}
		catch (Exception $e)
		{
			throw new Exception("N�o foi poss�vel continuar. {$e->getMessage()}");
		}
		return $this->collVo;
	}
	
	/**
	 * M�todo para Cadastrar Atividade Ponto Fu��o Horas
	 * @author Jo�o Batista Padilha e Silva
	 * @param AtividadesPontoFuncaoHorasVo $atividadesVo
	 */
	public function cadastrarAtividades(AtividadesPontoFuncaoHorasVo $atividadesVo)
	{
		//Valida��o
		if($atividadesVo->getNomeAtividadesPontoFuncaoHoras() == '' && $atividadesVo->getIdTecnologias() == '')
			throw new Exception("O nome da Atividade e a Tecnologia n�o podem estar em branco.");
		if($atividadesVo->getNomeAtividadesPontoFuncaoHoras() != '' && $atividadesVo->getIdTecnologias() == '')
			throw new Exception("ATecnologia n�o pode estar em branco.");
		if($atividadesVo->getNomeAtividadesPontoFuncaoHoras() == '' && $atividadesVo->getIdTecnologias() != '')
			throw new Exception("O nome da Atividade n�o pode estar em branco.");
			
		$DAO = new DAO();
		try 
		{
			if($atividadesVo->getIdAtividadePontoFuncaoHoras() == '')
			{
				$DAO->inserirAtividadesPontoFuncaoHoras($atividadesVo);
			}
			else 
			{
				$DAO->alterarAtividadesPontoFuncaoHoras($atividadesVo);
			}
		}
		catch (Exception $e)
		{
			throw new Exception("N�o foi poss�vel continuar. {$e->getMessage()}");
		}
	}
	
	/**
	 * M�todo para cadastro de anexo
	 * @author Rafael Henrique Vieira de Moura
	 * @param AnexosVo $anexosVo
	 */
	public function cadastrarAnexos(AnexosVo $anexosVo)
	{
		if ($anexosVo->getNomeAnexos() == '')
			throw new Exception("O Nome do Anexo n�o pode estar em branco.");
		
		if ($anexosVo->getIdAnexos()=='' && $anexosVo->getCaminhoAnexos() == '')
			throw new Exception("Um arquivo deve ser selecionado para este Anexo");
		
		$DAO = new DAO();
		
		try 
		{
			if ($anexosVo->getIdAnexos() == '') {
				$ultimoId = $DAO->inserirAnexos($anexosVo);
			} else {
				$DAO->alterarAnexos($anexosVo);
			}
		}
		catch (Exception $e)
		{
			throw new Exception("N�o foi poss�vel continuar. {$e->getMessage()}");
		}
		return $ultimoId;
	}
	
	/**
	 * M�todo para dele��o de arquivos de anexos
	 * @author Rafael Henrique Vieira de Moura
	 * @param AnexosVo $anexosVo
	 */
	public function deletarArquivoAnexos(AnexosVo $anexosVo)
	{
		try 
		{
			unlink($anexosVo->getCaminhoAnexos());
		}
		catch (Exception $e)
		{
			throw new Exception("N�o foi poss�vel continuar. {$e->getMessage()}");
		}
	}
	
	/**
	 * M�todo para upload de arquivos de anexos
	 * @author Rafael Henrique Vieira de Moura
	 * @param unknown_type $file
	 * @return unknown
	 */
	public function uploadArquivoAnexos($file)
	{
		try 
		{
			$dominio = new Dominio();
			$diretorio = "download/".date('mY')."/";
			if (!file_exists($dominio->path_fisico.$diretorio)) {
				mkdir($dominio->path_fisico.$diretorio);
			}
			$nome = eregi_replace("[^0-9]","",microtime());
			$caminhoAnexos = $diretorio.$nome."_".$file['name'];
			
			move_uploaded_file($file['tmp_name'],$dominio->path_fisico.$caminhoAnexos);
		}
		catch (Exception $e)
		{
			throw new Exception("N�o foi poss�vel continuar. {$e->getMessage()}");
		}
		
		return $caminhoAnexos;
	}
	
	/**
	 * M�todo que pesquisa todas os Grupo de Fluxos existentes no Sistema
	 * @author Jo�o Batista Padilha e Silva
	 * @param GrupoFluxosVo $grupoFluxosVo
	 * @return $this->collVo
	 */
	public function pesquisarGrupoFluxos(GrupoFluxosVo $grupoFluxosVo)
	{
		$QDAO = new QDAO();
		
		try 
		{
			if($grupoFluxosVo->getNomeGrupoFluxos() != '' && $grupoFluxosVo->getIdGrupoFluxos() == '')
				$grupoFluxosVo->setParametroConsulta("WHERE nomeGrupoFluxos LIKE '{$grupoFluxosVo->getNomeGrupoFluxos()}%'"); 
			$this->collVo = $QDAO->findGrupoFluxos($grupoFluxosVo);
		}
		catch (Exception $e)
		{
			throw new Exception("N�o foi poss�vel continuar. {$e->getMessage()}");
		}
		return $this->collVo;
	}
	
	/**
	 * M�todo que cadastra as Grupo de Fluxos no Sistema
	 * @author Jo�o Batista Padilha e Silva
	 * @param GrupoFluxosVo $grupoFluxosVo
	 */
	public function cadastrarGrupoFluxos(GrupoFluxosVo $grupoFluxosVo)
	{
		//Valida��o
		if($grupoFluxosVo->getNomeGrupoFluxos() == '')
			throw new Exception("O nome do Grupo de Fluxos n�o pode estar em branco.");
		
		$DAO = new DAO();
		try 
		{
			if($grupoFluxosVo->getIdGrupoFluxos() == '')
			{
				$DAO->inserirGrupoFluxos($grupoFluxosVo);
			}
			else 
			{
				$DAO->alterarGrupoFluxos($grupoFluxosVo);
			}
		}
		catch (Exception $e)
		{
			throw new Exception("N�o foi poss�vel continuar. {$e->getMessage()}");
		}
	}
	
	/**
	 * M�todo de Pesquisa de Fluxos do Sistema
	 * @author Jo�o Batista Padilha e Silva
	 * @param FluxosVo $fluxosVo
	 * @return $this->collVo
	 */
	public function pesquisarFluxos(FluxosVo $fluxosVo)
	{
		$QDAO = new QDAO();
		try 
		{
			//Ordernar Lista
			//Verificar se A pesquisa � pelo precedente colocando assim em ordem
			if($fluxosVo->getIdFluxos() == '' && $fluxosVo->getIdGrupoFluxos() != '')
				$fluxosVo->setParametroConsulta("WHERE idGrupoFluxos = '{$fluxosVo->getIdGrupoFluxos()}'");
			elseif($fluxosVo->getIdFluxos() != '' && $fluxosVo->getIdGrupoFluxos() == '')
				$fluxosVo->setParametroConsulta("WHERE idFluxos = '{$fluxosVo->getIdFluxos()}'");
			elseif($fluxosVo->getIdFluxos() != '' && $fluxosVo->getIdGrupoFluxos() != '')
				$fluxosVo->setParametroConsulta("WHERE idFluxos = '{$fluxosVo->getIdFluxos()}' AND idGrupoFluxos = '{$fluxosVo->getIdGrupoFluxos()}'");
			
			$fluxosVo->setParametroConsulta($fluxosVo->getParametroConsulta()." ORDER BY idGrupoFluxos asc, ordemFluxos asc");
			$this->collVo = $QDAO->findFluxos($fluxosVo);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
		return $this->collVo;
	}
	
	/**
	 * M�todo de Cadastramento de Fluxos do Sistema
	 * @author Jo�o Batista Padilha e Silva
	 * @param FluxosVo $fluxosVo
	 */
	public function cadastrarFluxos(FluxosVo $fluxosVo)
	{
		//Valida��o
		if($fluxosVo->getIdGrupoFluxos() == '' && $fluxosVo->getIdPapeisOrigem() == '' && $fluxosVo->getIdPapeisDestinatario() == '')
			throw new Exception("O Grupo de Fluxos, o Papel de Origem e o Papel Destinat�rio n�o podem estar em branco.");
		elseif($fluxosVo->getIdGrupoFluxos() != '' && $fluxosVo->getIdPapeisOrigem() == '' && $fluxosVo->getIdPapeisDestinatario() == '')
			throw new Exception("Os Papeis de Origem e Destinat�rio n�o podem estar em branco.");
		elseif($fluxosVo->getIdGrupoFluxos() != '' && $fluxosVo->getIdPapeisOrigem() != '' && $fluxosVo->getIdPapeisDestinatario() == '')
			throw new Exception("O Papel de Destinat�rio n�o pode estar em branco.");
		elseif($fluxosVo->getIdGrupoFluxos() != '' && $fluxosVo->getIdPapeisOrigem() == '' && $fluxosVo->getIdPapeisDestinatario() != '')
			throw new Exception("O Papel de Origem n�o pode estar em branco.");
		
			/**
		 * Buscar os Fluxos na ordem. Caso n�o seja altera��o, apenas seta a ordem, na ultima posi��o, caso contr�rio, selecione a ordem.
		 */
		if($fluxosVo->getIdFluxos() == '')
		{
			$fluxosVo_ordem = new FluxosVo();
			$fluxosVo_ordem->setIdGrupoFluxos($fluxosVo->getIdGrupoFluxos());
			$collVo_ordem = self::pesquisarFluxos($fluxosVo_ordem);
			$fluxosVo->setOrdemFluxos(count($collVo_ordem) + 1);	
		}
		$DAO = new DAO();
		try 
		{
			if($fluxosVo->getIdFluxos() == '')
			{
				$DAO->inserirFluxos($fluxosVo);
			}
			else 
			{
				$DAO->alterarFluxos($fluxosVo);
			}
		}
		catch (Exception $e)
		{
			throw new Exception("N�o foi poss�vel continuar. {$e->getMessage()}");
		}
	}
	
	/**
	 * M�todo para grava��o de Log de a��es executadas no Suporte
	 * @author Rafael Henrique Vieira de Moura
	 * @param Log_SuporteVo $log_SuporteVo
	 */
	public function cadastrarLogSuporte(Log_SuporteVo $log_SuporteVo)
	{
		$DAO = new DAO();
		try 
		{
			$DAO->inserirLogSuporte($log_SuporteVo);
		}
		catch (Exception $e)
		{
			throw new Exception("N�o foi poss�vel continuar. ".$e->getMessage());
		}
	}
	
	/**
	 * M�todo que pesquisa os projetos
	 * @author Jo�o Batista Padilha e Silva
	 * @param ProjetosVo $projetosVo
	 * @return array $this->collVo
	 */
	public function pesquisarProjetos(ProjetosVo $projetosVo)
	{
		$QDAO = new QDAO();
		try 
		{
			if($projetosVo->getIdProjetos() == '' && $projetosVo->getNomeProjetos() != '' && $projetosVo->getIdClientes() == '')
				$projetosVo->setParametroConsulta("WHERE nomeProjetos LIKE '{$projetosVo->getNomeProjetos()}%'");
			elseif($projetosVo->getIdProjetos() == '' && $projetosVo->getNomeProjetos() != '' && $projetosVo->getIdClientes() != '')
				$projetosVo->setParametroConsulta("WHERE nomeProjetos LIKE '{$projetosVo->getNomeProjetos()}%' AND idClientes = '{$projetosVo->getIdClientes()}'");
			elseif($projetosVo->getIdProjetos() == '' && $projetosVo->getNomeProjetos() == '' && $projetosVo->getIdClientes() != '')
				$projetosVo->setParametroConsulta("WHERE idClientes = '{$projetosVo->getIdClientes()}'");
			$this->collVo = $QDAO->findProjetos($projetosVo);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
		return $this->collVo;
	}
	
	/**
	 * M�todo que cadastra/altera os Projetos no Sistema
	 * @author Jo�o Batista Padilha e Silva
	 * @param ProjetosVo $projetosVo
	 */
	public function cadastrarProjetos(ProjetosVo $projetosVo)
	{
		//Valida��o
		if($projetosVo->getNomeProjetos() == '')
			throw new Exception("O nome do Projeto n�o pode estar em branco.");

		$DAO = new DAO();
		try 
		{
			if($projetosVo->getIdProjetos() == '')
			{
				$DAO->inserirProjetos($projetosVo);
			}
			else 
			{
				$DAO->alterarProjetos($projetosVo);
			}
		}
		catch (Exception $e)
		{
			throw new Exception("N�o foi poss�vel continuar. {$e->getMessage()}");
		}
	}
	
	/**
	 * M�todo para pesquisa do Log_Suporte
	 * @author Rafael Henrique Vieira de Moura
	 * @param Log_SuporteVo $log_SuporteVo
	 * @return array $this->collVo
	 */
	public function pesquisarLogSuporte(Log_SuporteVo $log_SuporteVo)
	{
		$QDAO = new QDAO();
		try 
		{
			if ($log_SuporteVo->getIdUsuarios() != ''){
				$log_SuporteVo->setParametroConsulta("WHERE idUsuarios = '{$log_SuporteVo->getIdUsuarios()}'");
			}
			if ($log_SuporteVo->getIdFuncionalidades() != '') {
				if ($log_SuporteVo->getIdUsuarios() == '') {
					$log_SuporteVo->setParametroConsulta("WHERE idFuncionalidades = '{$log_SuporteVo->getIdFuncionalidades()}'");
				} else {
					$log_SuporteVo->setParametroConsulta($log_SuporteVo->getParametroConsulta()." AND idFuncionalidades = '{$log_SuporteVo->getIdFuncionalidades()}'");
				}
			}
			if ($log_SuporteVo->getDataCriacaoLog_Suporte() != '') {
				list($ano,$mes,$dia) = explode("-",$log_SuporteVo->getDataCriacaoLog_Suporte());
				if ($log_SuporteVo->getIdUsuarios() == '' && $log_SuporteVo->getIdFuncionalidades() == '') {
					$log_SuporteVo->setParametroConsulta("WHERE YEAR(dataCriacaoLog_Suporte) = '{$ano}' AND MONTH(dataCriacaoLog_Suporte) = '{$mes}' AND DAY(dataCriacaoLog_Suporte) = '{$dia}'");
				} else {
					$log_SuporteVo->setParametroConsulta($log_SuporteVo->getParametroConsulta()." AND (YEAR(dataCriacaoLog_Suporte) = '{$ano}' AND MONTH(dataCriacaoLog_Suporte) = '{$mes}' AND DAY(dataCriacaoLog_Suporte) = '{$dia}')");
				}
			}
			
			$this->collVo = $QDAO->findLog_Suporte($log_SuporteVo);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
		return $this->collVo;
	}
	
	/**
	 * M�todo que pesquisa Papeis Projetos
	 * @author Jo�o Batista Padilha e Silva
	 * @param Papeis_ProjetosVo $papeisProjetosVo
	 * @return array $this->collVo
	 */
	public function pesquisarPapeisProjetos(Papeis_ProjetosVo $papeisProjetosVo)
	{
		$QDAO = new QDAO();
		try 
		{
			$this->collVo = $QDAO->findPapeis_Projetos($papeisProjetosVo);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
		return $this->collVo;
	}
	
	/**
	 * M�todo que pesquisa todos os destinat�rios n�o conformidades
	 * @author Jo�o Batista Padilha e Silva
	 * @param DestinatariosNaoConformidadesVo $destinatariosVo
	 * @return array $this->collVo
	 */
	public function pesquisarDestinatariosNaoConformidades(DestinatariosNaoConformidadesVo $destinatariosVo)
	{
		$QDAO = new QDAO();
		try 
		{
			if($destinatariosVo->getIdUsuarios() == '' && $destinatariosVo->getIdProjetos() != '')
				$destinatariosVo->setParametroConsulta("WHERE idProjetos = '{$destinatariosVo->getIdProjetos()}'");
			if($destinatariosVo->getIdUsuarios() != '' && $destinatariosVo->getIdProjetos() == '')
				$destinatariosVo->setParametroConsulta("WHERE idUsuarios = '{$destinatariosVo->getIdUsuarios()}'");
			if($destinatariosVo->getIdUsuarios() != '' && $destinatariosVo->getIdProjetos() != '')
				$destinatariosVo->setParametroConsulta("WHERE idProjetos = '{$destinatariosVo->getIdProjetos()}' AND idUsuarios = '{$destinatariosVo->getIdUsuarios()}'");
				
			$this->collVo = $QDAO->findDestinatariosNaoConformidades($destinatariosVo);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
		return $this->collVo;
	}
	
	/**
	 * M�todo para cadastrar PapeisProjetos
	 * @author Jo�o Batista Padilha e Silva
	 * @param Papeis_ProjetosVo $papeisProjetosVo
	 */
	public function cadastrarPapeisProjetos(Papeis_ProjetosVo $papeisProjetosVo)
	{
		//Valida��o
		if($papeisProjetosVo->getIdProjetos() == '' && $papeisProjetosVo->getIdPapeis() == '' && $papeisProjetosVo->getIdUsuarios() == '')
			throw new Exception("O Projeto, papel e o usu�rio n�o podem estar em branco.");
		if($papeisProjetosVo->getIdProjetos() != '' && $papeisProjetosVo->getIdPapeis() == '' && $papeisProjetosVo->getIdUsuarios() == '')
			throw new Exception("O Papel e o usu�rio n�o podem estar em branco.");
		if($papeisProjetosVo->getIdProjetos() != '' && $papeisProjetosVo->getIdPapeis() != '' && $papeisProjetosVo->getIdUsuarios() == '')
			throw new Exception("O Usu�rio n�o pode estar em branco.");
		if($papeisProjetosVo->getIdProjetos() != '' && $papeisProjetosVo->getIdPapeis() == '' && $papeisProjetosVo->getIdUsuarios() != '')
			throw new Exception("O Papel n�o pode estar em branco.");

		$DAO = new DAO();
		try 
		{
			$DAO->inserirPapeisProjetos($papeisProjetosVo);
		}
		catch (Exception $e)
		{
			throw new Exception("N�o foi poss�vel continuar. {$e->getMessage()}");
		}
	}
	
	/**
	 * M�todo para deletar papeis Projetos
	 * @author Jo�o Batista Padilha e Silva
	 * @param Papeis_ProjetosVo $papeisProjetosVo
	 */
	public function deletaPapeisProjetos(Papeis_ProjetosVo $papeisProjetosVo)
	{
		$DAO = new DAO();
		try 
		{
			if($papeisProjetosVo->getIdProjetos() == '')
				throw new Exception("Projeto n�o selecionado");
			$DAO->deletaPapeisProjetos($papeisProjetosVo);
		}
		catch (Exception $e)
		{
			throw new Exception("N�o foi poss�vel Continuar. {$e->getMessage()}");
		}
	}
	
	/**
	 * M�todo que cadastra os DestinatariosNaoConformidades
	 * @author Jo�o Batista Padilha e Silva
	 * @param DestinatariosNaoConformidadesVo $destinatariosVo
	 */
	public function cadastrarDestinatariosNaoConformidades(DestinatariosNaoConformidadesVo $destinatariosVo)
	{
		//Valida��o
		if($destinatariosVo->getIdProjetos() == '')
			throw new Exception("O Projeto n�o pode estar em branco.");
		
		$DAO = new DAO();
		try 
		{
			$DAO->inserirDestinatariosNaoConformidades($destinatariosVo);
		}
		catch (Exception $e)
		{
			throw new Exception("N�o foi poss�vel continuar. {$e->getMessage()}");
		}
	}
	
	/**
	 * M�todo que deleta os DestinatariosNaoConformidades de acordo com o projeto
	 * @author Jo�o Batista Padilha e Silva
	 * @param DestinatariosNaoConformidadesVo $destinatariosVo
	 */
	public function deletaDestinatariosNaoConformidades(DestinatariosNaoConformidadesVo $destinatariosVo)
	{
		//Valida��o
		if($destinatariosVo->getIdProjetos() == '')
			throw new Exception("O Projeto n�o podem estar em branco.");
		
		$DAO = new DAO();
		try 
		{
			$DAO->deletaDestinatariosNaoConformidades($destinatariosVo);
		}
		catch (Exception $e)
		{
			throw new Exception("N�o foi poss�vel continuar. {$e->getMessage()}");
		}
	}
	
	/**
	 * M�todo de pesquisa dos M�dulos do Projeto
	 * @author Jo�o Batista Padilha e Silva
	 * @param Projetos_ModulosVo $projetosModulosVo
	 * @return array $this->collVo
	 */
	public function pesquisarProjetosModulos(Projetos_ModulosVo $projetosModulosVo)
	{
		$QDAO = new QDAO();
		try 
		{
			if($projetosModulosVo->getIdProjetos_Modulos() == '' && $projetosModulosVo->getIdProjetos() != '')
				$projetosModulosVo->setParametroConsulta("WHERE idProjetos = '{$projetosModulosVo->getIdProjetos()}'");
				
			$this->collVo = $QDAO->findProjetosModulos($projetosModulosVo);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
		return $this->collVo;
	}
	
	/**
	 * M�todo de cadastramento de M�dulos para o projeto
	 * @author Jo�o Batista Padilha e Silva
	 * @param Projetos_ModulosVo $projetosModulosVo
	 */
	public function cadastrarProjetosModulos(Projetos_ModulosVo $projetosModulosVo)
	{
		//Valida��o
		if($projetosModulosVo->getIdProjetos() == '' && $projetosModulosVo->getIdModulos() == '')
			throw new Exception("O Projeto e o M�dulo n�o podem estar em branco.");
		if($projetosModulosVo->getIdProjetos() != '' && $projetosModulosVo->getIdModulos() == '')
			throw new Exception("O M�dulo n�o pode estar em branco.");
		if($projetosModulosVo->getIdProjetos() == '' && $projetosModulosVo->getIdModulos() != '')
			throw new Exception("O Projeto n�o pode estar em branco.");
		
		$DAO = new DAO();
		try 
		{
			$DAO->inserirProjetosModulos($projetosModulosVo);
		}
		catch (Exception $e)
		{
			throw new Exception("N�o foi poss�vel continuar. {$e->getMessage()}");
		}
	}
	
	/**
	 * M�todo de dele��o de M�dulos do Projeto
	 * @author Jo�o Batista Padilha e Silva
	 * @param Projetos_ModulosVo $projetosModulosVo
	 */
	public function deletaProjetosModulos(Projetos_ModulosVo $projetosModulosVo)
	{
		$DAO = new DAO();
		try 
		{
			if($projetosModulosVo->getIdProjetos() == '')
				throw new Exception("Projeto n�o selecionado");
			$DAO->deletarProjetosModulos($projetosModulosVo);
		}
		catch (Exception $e)
		{
			throw new Exception("N�o foi poss�vel Continuar. {$e->getMessage()}");
		}
	}
	
	/**
	 * M�todo que popula o Vo passado. De acordo com sua inst�ncia, ele popula o vo com id's diferentes
	 * @author Jo�o Batista Padilha e Silva
	 * @param VO $entidadeVo
	 * @param collVo $collVo
	 * @return collVo
	 */
	public function popularCollVo($entidadeVo,$collVo)
	{
		$retorno = 1;
		if(!is_null($collVo))
		{
			if($entidadeVo instanceof ProjetosVo)
			{
				$newEntidade = new ProjetosVo();
				$entidadeVo_aux = new ProjetosVo();
				$entidadeVo_aux = (object) $entidadeVo;
				foreach ($collVo as $vo)
				{
					$newEntidade = (object) $vo;
					if($newEntidade->getIdProjetos() == $entidadeVo_aux->getIdProjetos())
					{
						$retorno = 0;
					}
				}
			}
			
			if($entidadeVo instanceof ClientesVo)
			{
				$newEntidade = new ClientesVo();
				$entidadeVo_aux = new ClientesVo();
				$entidadeVo_aux = (object) $entidadeVo;
				foreach ($collVo as $vo)
				{
					$newEntidade = (object) $vo;
					if($newEntidade->getIdClientes() == $entidadeVo_aux->getIdClientes())
					{
						$retorno = 0;
					}
				}
			}
			
			if($entidadeVo instanceof Projetos_ModulosVo)
			{
				$newEntidade = new Projetos_ModulosVo();
				$entidadeVo_aux = new Projetos_ModulosVo();
				$entidadeVo_aux = (object) $entidadeVo;
				foreach ($collVo as $vo)
				{
					$newEntidade = (object) $vo;
					if($newEntidade->getIdProjetos_Modulos() == $entidadeVo_aux->getIdProjetos_Modulos())
					{
						$retorno = 0;
					}
				}
			}
			
			if($entidadeVo instanceof PapeisVo)
			{
				$newEntidade = new PapeisVo();
				$entidadeVo_aux = new PapeisVo();
				$entidadeVo_aux = (object) $entidadeVo;
				foreach ($collVo as $vo)
				{
					$newEntidade = (object) $vo;
					if($newEntidade->getIdPapeis() == $entidadeVo_aux->getIdPapeis())
					{
						$retorno = 0;
					}
				}
			}
			
			if($entidadeVo instanceof SubModulosVo)
			{
				$newEntidade = new SubModulosVo();
				$entidadeVo_aux = new SubModulosVo();
				$entidadeVo_aux = (object) $entidadeVo;
				foreach ($collVo as $vo)
				{
					$newEntidade = (object) $vo;
					if($newEntidade->getIdSubModulos() == $entidadeVo_aux->getIdSubModulos())
					{
						$retorno = 0;
					}
				}
			}
			
			if($entidadeVo instanceof UsuariosVo)
			{
				$newEntidade = new UsuariosVo();
				$entidadeVo_aux = new UsuariosVo();
				$entidadeVo_aux = (object) $entidadeVo;
				foreach ($collVo as $vo)
				{
					$newEntidade = (object) $vo;
					if($newEntidade->getIdUsuarios() == $entidadeVo_aux->getIdUsuarios())
					{
						$retorno = 0;
					}
				}
			}
			
			if($entidadeVo instanceof Permissao_Usuarios_Funcionalidades_PapeisVo)
			{
				$newEntidade = new Permissao_Usuarios_Funcionalidades_PapeisVo();
				$entidadeVo_aux = new Permissao_Usuarios_Funcionalidades_PapeisVo();
				$entidadeVo_aux = (object) $entidadeVo;
				foreach ($collVo as $vo)
				{
					$newEntidade = (object) $vo;
					if($newEntidade->getIdFuncionalidades() == $entidadeVo_aux->getIdFuncionalidades())
					{
						$retorno = 0;
					}
				}
			}
			
			
		}
		if($retorno == 1)
		{
			$collVo[] = $entidadeVo;
		}
		return $collVo;
	}
	
	/**
	 * M�todo de Cadastramento de Pedidos
	 * @author Jo�o Batista Padilha e Silva
	 * @param PedidosVo $pedidosVo
	 * @return int UltimoIdInserido
	 */
	public function cadastrarPedidos(PedidosVo $pedidosVo)
	{
		//Valida��o
		if($pedidosVo->getIdProjetos() == '')
			throw new Exception("O Projeto deve ser selecionado.");

		$ultimoId = ''	;
		$DAO = new DAO();
		try 
		{
			if($pedidosVo->getIdPedidos() == '')
			{
				$ultimoId = $DAO->inserirPedidos($pedidosVo);
			}
			else 
			{
				$DAO->alterarPedidos($pedidosVo);
			}
		}
		catch (Exception $e)
		{
			throw new Exception("N�o foi poss�vel continuar. {$e->getMessage()}");
		}
		return $ultimoId;
	}
	
	/**
	 * M�todo de Cadastramento de Hist�ricos do Pedido
	 * @author Jo�o Batista Padilha e Silva
	 * @param Historico_PedidosVo $historicoVo
	 */
	public function cadastrarHistoricoPedidos(Historico_PedidosVo $historicoVo)
	{
		$ultimoId = '';
		//Valida��o
		if($historicoVo->getIdPedidos() == '')
			throw new Exception("O N� do Pedido n�o existe.");
		elseif ($historicoVo->getIdUsuarioOrigem() == '')
			throw new Exception("O usu�rio de origem deve ser selecionado.");
		elseif ($historicoVo->getIdPapeisOrigem() == '')
			throw new Exception("O papel de origem deve ser selecionado.");
		elseif ($historicoVo->getIdUsuariosDestinatario() == '')
			throw new Exception("O usu�rio destinat�rio deve ser selecionado.");
		elseif ($historicoVo->getIdPapeisDestinatario() == '')
			throw new Exception("O papel destinat�rio deve ser selecionado.");
		elseif ($historicoVo->getIdFluxos() == '')
			throw new Exception("Usu�rio n�o autorizado a realizar este fluxo.");
		elseif ($historicoVo->getIdUsuariosDestinatario() == '')
			throw new Exception("O usu�rio destinat�rio deve ser selecionado.");
		
		$DAO = new DAO();
		try 
		{
			if($historicoVo->getIdHistorico_Pedidos() == '')
			{
				$ultimoId = $DAO->inserirHistoricosPedidos($historicoVo);
			}
			else 
			{
				$DAO->alterarHistoricosPedidos($historicoVo);
			}
		}
		catch (Exception $e)
		{
			throw new Exception("N�o foi poss�vel continuar. {$e->getMessage()}");
		}
		return $ultimoId;
	}
	
	/**
	 * M�todo de Pesquisa de Pedidos
	 * @author Jo�o Batista Padilha e Silva
	 * @param PedidosVo $pedidosVo
	 * @return array $this->collVo
	 */
	public function pesquisarPedidos(PedidosVo $pedidosVo)
	{
		$QDAO = new QDAO();
		try 
		{
			$pedidosVo->setParametroConsulta("ORDER BY idPedidos DESC");
			$this->collVo = $QDAO->findPedidos($pedidosVo);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
		return $this->collVo;
	}
	
	/**
	 * M�todo para pesquisar os pedidos que entraram em N�o Conformidade
	 * @author Rafael Henrique Vieira de Moura
	 * @param PedidosVo $pedidosVo
	 * @return array $this->collVo
	 */
	public function pesquisarPedidosNaoConformidades(PedidosVo $pedidosVo)
	{
		$QDAO = new QDAO();
		$dominio = new Dominio();
		try 
		{
			$pedidosVo->setParametroConsulta("WHERE dataHoraPrevisaoPedidos < now() AND DomnStatusPedidos <> ".$dominio->DomnStatusPedido_Concluido);
			$this->collVo = $QDAO->findPedidos($pedidosVo);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
		return $this->collVo;
	}
	
	/**
	 * M�todo de Pesquisa de Pedidos por Projeto
	 * @author Jo�o Batista Padilha e SIlva
	 * @param PedidosVo $pedidosVo
	 * @return array $this->collVo
	 */
	public function pesquisarPedidosPorProjeto(PedidosVo $pedidosVo)
	{
		$QDAO = new QDAO();
		try 
		{
			if($pedidosVo->getIdProjetos() != '')
			{
				$pedidosVo->setParametroConsulta("WHERE idProjetos = '{$pedidosVo->getIdProjetos()}' ORDER BY idPedidos asc");
			}
			$this->collVo = $QDAO->findPedidos($pedidosVo);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
		return $this->collVo;
	}
	
	/**
	 * M�todo de pesquisa de pedidos por precedente
	 * @author Jo�o Batista Padilha e Silva
	 * @param PedidosVo $pedidosVo
	 * @return array $collVo
	 */
	public function pesquisarPedidosPorPrecedente(PedidosVo $pedidosVo)
	{
		$QDAO = new QDAO();
		try 
		{
			if($pedidosVo->getPrecedentePedidos() != '')
			{
				$pedidosVo->setParametroConsulta("WHERE precedentePedidos = '{$pedidosVo->getPrecedentePedidos()}' ORDER BY idPedidos asc");
			}
			$this->collVo = $QDAO->findPedidos($pedidosVo);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
		return $this->collVo;
	}
	
	/**
	 * M�todo de Pesquisa de Pedidos por Status
	 * @author Jo�o Batista Padilha e Silva
	 * @param PedidosVo $pedidosVo
	 * @param int $DomnStatus
	 * @return int
	 */
	public function pesquisarPedidosStatus(PedidosVo $pedidosVo,$DomnStatus)
	{
		$QDAO = new QDAO();
		$dominio = new Dominio();
		try 
		{
			if($pedidosVo->getIdUsuarios() != '' && $pedidosVo->getIdProjetos() == '')
			{
				$pedidosVo->setParametroConsulta("WHERE idUsuarios = '{$pedidosVo->getIdUsuarios()}' ");
			}
			elseif ($pedidosVo->getIdUsuarios() == '' && $pedidosVo->getIdProjetos() != '')
			{
				$pedidosVo->setParametroConsulta("WHERE idProjetos = '{$pedidosVo->getIdProjetos()}' ");
			}
			elseif ($pedidosVo->getIdUsuarios() != '' && $pedidosVo->getIdProjetos() != '')
			{
				$pedidosVo->setParametroConsulta("WHERE idProjetos = '{$pedidosVo->getIdProjetos()}' AND idUsuarios = '{$pedidosVo->getIdUsuarios()}'");
			}
			
			if($pedidosVo->getParametroConsulta() == '' && $DomnStatus != '')
			{
				$pedidosVo->setParametroConsulta(" WHERE ");
			}
			elseif($DomnStatus != '')
			{
				$pedidosVo->setParametroConsulta($pedidosVo->getParametroConsulta()." AND ");
			}
			
			if($DomnStatus != '')
			{	
				$arrayStatus = explode(";",$DomnStatus);
				$i = 1;
				foreach ($arrayStatus as $DomnStatus)
				{
					if($i > 1)
					{
						$pedidosVo->setParametroConsulta($pedidosVo->getParametroConsulta()." OR ");
					}
					
					if($DomnStatus == $dominio->DomnStatusPedido_Concluido)
					{
						$pedidosVo->setParametroConsulta($pedidosVo->getParametroConsulta()."DomnStatusPedidos = '{$dominio->DomnStatusPedido_Concluido}'");
					}
					elseif ($DomnStatus == $dominio->DomnStatusPedido_Desenvolvimento)
					{
						$pedidosVo->setParametroConsulta($pedidosVo->getParametroConsulta()."DomnStatusPedidos = '{$dominio->DomnStatusPedido_Desenvolvimento}'");
					}
					elseif ($DomnStatus == $dominio->DomnStatusPedido_Devolvido)
					{
						$pedidosVo->setParametroConsulta($pedidosVo->getParametroConsulta()."DomnStatusPedidos = '{$dominio->DomnStatusPedido_Devolvido}'");
					}
					elseif ($DomnStatus == $dominio->DomnStatusPedido_Fechado)
					{
						$pedidosVo->setParametroConsulta($pedidosVo->getParametroConsulta()."DomnStatusPedidos = '{$dominio->DomnStatusPedido_Fechado}'");
					}
					elseif ($DomnStatus == $dominio->DomnStatusPedido_Novo)
					{
						$pedidosVo->setParametroConsulta($pedidosVo->getParametroConsulta()."DomnStatusPedidos = '{$dominio->DomnStatusPedido_Novo}'");
					}
					elseif ($DomnStatus == $dominio->DomnStatusPedido_Recebido)
					{
						$pedidosVo->setParametroConsulta($pedidosVo->getParametroConsulta()."DomnStatusPedidos = '{$dominio->DomnStatusPedido_Recebido}'");
					}
					$i++;
				}
			}
			
			$pedidosVo->setParametroConsulta($pedidosVo->getParametroConsulta()." ORDER BY idPedidos desc");
			
			$this->collVo = $QDAO->findPedidos($pedidosVo);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
		return $this->collVo;
	}
	
	/**
	 * M�todo de Pesquisa de Hist�ricos do Pedido
	 * @author Jo�o Batista Padilha e Silva
	 * @param Historico_PedidosVo $historicoVo
	 * @return array $this->collVo
	 */
	public function pesquisarHistorico(Historico_PedidosVo $historicoVo)
	{
		$QDAO = new QDAO();
		try 
		{
			$this->collVo = $QDAO->findHistorico_Pedidos($historicoVo);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
		return $this->collVo;
	}
	
	/**
	 * M�todo para pesquisa de N�o Conformidades
	 * @author Rafael Henrique Vieira de Moura
	 * @param NaoConformidadesVo $naoConformidadesVo
	 * @return array $this->collVo
	 */
	public function pesquisarNaoConformidades(NaoConformidadesVo $naoConformidadesVo)
	{
		$QDAO = new QDAO();
		$formataData = new FormataData();
		
		if ($naoConformidadesVo->getIdPedidos() != '')
		{
			$naoConformidadesVo->setParametroConsulta('WHERE idPedidos = "'.$naoConformidadesVo->getIdPedidos().'"');
		}
		if ($naoConformidadesVo->getDataNaoConformidades() != '')
		{
			list($ano,$mes,$dia) = explode("-",$naoConformidadesVo->getDataNaoConformidades());
			if ($naoConformidadesVo->getIdPedidos() == '') {
				$naoConformidadesVo->setParametroConsulta("WHERE YEAR(dataNaoConformidades) = '{$ano}' AND MONTH(dataNaoConformidades) = '{$mes}' AND DAY(dataNaoConformidades) = '{$dia}'");
			} else {
				$naoConformidadesVo->setParametroConsulta($naoConformidadesVo->getParametroConsulta()." AND (YEAR(dataNaoConformidades) = '{$ano}' AND MONTH(dataNaoConformidades) = '{$mes}' AND DAY(dataNaoConformidades) = '{$dia}')");
			}
		}
		
		try
		{
			$this->collVo = $QDAO->findNaoConformidades($naoConformidadesVo);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
		
		return $this->collVo;
	}
	
	/**
	 * M�todo para cadastro de n�o conformidades
	 * @author Rafael Henrique Vieira de Moura
	 * @param NaoConformidadesVo $naoConformidadesVo
	 */
	public function cadastrarNaoConformidades(NaoConformidadesVo $naoConformidadesVo, $retorno = false)
	{
		$DAO = new DAO();
		
		/*if ($naoConformidadesVo->getJustificativaNaoConformidades() == '')
		{
			throw new Exception('O campo Justificativa n�o pode estar em branco.');
		}
		if ($naoConformidadesVo->getContraMedidasNaoConformidades() == '' && $naoConformidadesVo->get)
		{
			throw new Exception('O campo Contra-Medidas n�o pode estar em branco.');
		}*/
			
		try
		{
			if ($naoConformidadesVo->getIdNaoConformidades() == '')
			{
				$DAO->inserirNaoConformidades($naoConformidadesVo);
			}
			else
			{
				$DAO->alterarNaoConformidades($naoConformidadesVo);
			}
			
			if ($retorno === true)
			{
				echo 'Sucesso';
			}
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}
}
?>