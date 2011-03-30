<?php
//####################################
// * João Batista Padilha e Silva Analista/Desenvolvedor (Ábaco Tecnologia)
// * Arquivo: BusinessEntity.php
// * Criação: João Batista Padilha e Silva
// * Revisão:
// * Data de criação: 02/07/2008
//####################################

require("Connecta.php");
require_once("DAO.php");
require_once("QDAO.php");

/**
 * Classe de Negócios do Sistema Suporte On Line.
 * @author João Batista Padilha e Silva
 */
class BusinessEntity
{
	private $valueObj = null;
	private $array = null;
	private $collVo = null;
	
	/**
	 * Método para gravação de log
	 * @author Rafael Henrique Vieira de Moura
	 * @param string $funcionalidade
	 * @param integer $DomnAcao
	 */
	public function gravaLog($funcionalidade = '',$DomnAcao = null)
	{
		/**
		 * Gravação do LOG
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
		 * Fim da gravação do LOG
		 */
	}
	
	/**
	 * Método para Verificar se o E-mail é válido
	 * @author João Batista Padilha e Silva
	 * @param var $email
	 */
	public function verificaEmail($email = '')
	{
		if($email != '')
		{
			if (!preg_match ("/^[A-Za-z0-9]+([_.-][A-Za-z0-9]+)*@[A-Za-z0-9]+([_.-][A-Za-z0-9]+)*\\.[A-Za-z0-9]{2,4}$/", $email))
			{
		        throw new Exception("O Email é inválido.");
		    }
		}
	}
	
	/**
	 * Método que Envia E-mail. Recebe os parâmetros para ser re-utilizado por qualquer chamada
	 * @author João Batista Padilha e Silva
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
	 * Método de Envio de E-mail do Pedido ao Usuário Destinatário
	 * @author João Batista Padilha e Silva
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
	 * Método para envio da Não Conformidade por e-mail para o destinatário responsável de recebe-la
	 * e para o usuário que deverá justifica-la.
	 * @author Rafael Henrique Vieira de Moura
	 * @param PedidosVo $pedidosVo
	 */
	public function enviaNaoConformidades(PedidosVo $pedidosVo)
	{
		try 
		{
			$controlaUsuarios = new Controla_Usuarios();
			$controlaHistorico = new Controla_Historico();
			
			//Envio de e-mail para os Destinatarios da Não Conformidades do Projeto
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
					
					$mensagem = "Uma nova Não Conformidade no seu Projeto. Pedido Nº ".$pedidosVo->getIdPedidos();
					
					self::enviaEmail("<".$usuariosVo->getEmailUsuarios().">","Nova Nao Conformidade",$mensagem);
				}
			}
			
			//Envia e-mail para usuário
			$historicoVo = new Historico_PedidosVo();
			$historicoVo->setIdPedidos($pedidosVo->getIdPedidos());
			$collVo_Historico = $controlaHistorico->pesquisarHistorico($historicoVo);
			$i = count($collVo_Historico)-1;
			$historicoVo = (object) $collVo_Historico[$i];
			
			$usuariosVo = new UsuariosVo();
			$usuariosVo->setIdUsuarios($historicoVo->getIdUsuariosDestinatario());
			$collVo_Usuarios = $controlaUsuarios->pesquisarUsuarios($usuariosVo);
			$usuariosVo = (object) $collVo_Usuarios[0];
			
			$mensagem = "Foi gerada uma não conformidade para o pedido nº ".$pedidosVo->getIdPedidos();
			
			self::enviaEmail("<".$usuariosVo->getEmailUsuarios().">","Nova Nao Conformidade",$mensagem);	
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
		
	}
	
	/**
	 * Método de Pesquisa de Usuários. Retorna todos os dados do usuários, através da chamada a classe QDAO
	 * Usado para login do sistema
	 * @author João Batista Padilha e Silva
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
					throw new Exception("Usuário e/ou Senha incorretos.");
				
				$usuariosVo = (object) $this->collVo[0];				
				
				// Grava Sessão
				
				session_cache_expire(10);
				session_regenerate_id("loginUsuarios");
				$_SESSION["usuario_Logado"] = $usuariosVo->getLoginUsuarios();
				$_SESSION["id_Usuario"] = $usuariosVo->getIdUsuarios();
				$_SESSION["nome_Usuario"] = $usuariosVo->getNomeUsuarios();
				$_SESSION['usuario_Clientes'] = $usuariosVo->getFlagTipoUsuario();
								
				//Fim Grava Sessão
			}
			catch (Exception $e)
			{
				throw new Exception("Não foi possível continuar. - {$e->getMessage()}");
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
				throw new Exception("Não foi possível continuar. {$e->getMessage()}");
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
				throw new Exception("Não foi possível buscar Usuários. {$e->getMessage()}");
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
				throw new Exception("Não foi possível buscar Usuários. {$e->getMessage()}");
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
				throw new Exception("Não foi possível buscar Usuários. {$e->getMessage()}");
			}
		}
		
		return $this->collVo;
	}
	
	/**
	 * Método de pesquisa de Funcionalidades
	 * @author João Batista Padilha e Silva
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
			//Verificar se A pesquisa é pelo precedente colocando assim em ordem
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
	 * Método de Consulta Funcionalidades por Link
	 * @author João Batista Padilha e Silva
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
	 * Método de busca de permissões de Usuários do Sistema
	 * @author João Batista Padilha e Silva
	 * @param Permissao_Usuarios_Funcionalidades_PapeisVo $permissaoVo
	 * @return $this->collVo
	 */
	public function buscaPermissaoUsuarios(Permissao_Usuarios_Funcionalidades_PapeisVo $permissaoVo)
	{
		$QDAO = new QDAO();
		
		try 
		{
			if($permissaoVo->getIdUsuarios() == '')
				throw new Exception("Usuário inexistente.");
			$this->collVo = $QDAO->findPermissoes_Usuarios_Funcionalidades_Papeis($permissaoVo);
		}
		catch (Exception $e)
		{
			throw new Exception("Não foi possível continuar. {$e->getMessage()}");
		}
		return $this->collVo;
	}
	
	/**
	 * Método para Buscar permissões em Geral
	 * @author João Batista Padilha e Silva
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
				throw new Exception("Não existe permissão cadastrada.");
			
		}
		catch (Exception $e)
		{
			throw new Exception("Não foi possível continuar. {$e->getMessage()}");
		}
		return $this->collVo;
	}
	
	/**
	 * Método para deletar Permissoes por id do Papel ou id do Usuário
	 * @author João Batista Padilha e Silva
	 * @param Permissao_Usuarios_Funcionalidades_PapeisVo $permissaoVo
	 */
	public function deletaPermissoes(Permissao_Usuarios_Funcionalidades_PapeisVo $permissaoVo)
	{
		$DAO = new DAO();
		try 
		{
			if($permissaoVo->getIdPapeis() == '' && $permissaoVo->getIdUsuarios() == '')
				throw new Exception("Papel ou usuário não selecionado");
			$DAO->deletarPermissaoUsuariosFuncionalidadesPapeis($permissaoVo);
		}
		catch (Exception $e)
		{
			throw new Exception("Não foi possível Continuar. {$e->getMessage()}");
		}
	}
	
	/**
	 * Método que busca todos os papeis existentes
	 * @author João Batista Padilha e Silva
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
			throw new Exception("Não foi possível buscar papeis. {$e->getMessage()}");
		}
		return $this->collVo;		
	}
	
	/**
	 * Método que cadastra o papel
	 * @author João Batista Padilha e Silva
	 * @param PapeisVo $papeisVo
	 */
	public function cadastrarPapeis(PapeisVo $papeisVo)
	{
		//Validação
		if($papeisVo->getNomePapeis() == '')
			throw new Exception("O nome do papel não pode estar em branco.");
		
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
			throw new Exception("Não foi possível continuar. {$e->getMessage()}");
		}
	}
	
	/**
	 * Método para cadastro de usuários
	 * @author Rafael Henrique Vieira de Moura
	 * @param UsuariosVo $usuariosVo
	 */
	public function cadastrarUsuarios(UsuariosVo $usuariosVo)
	{
		//validação
		if ($usuariosVo->getNomeUsuarios() == '')
			throw new Exception("O Nome do usuário não pode estar em branco.");
		if ($usuariosVo->getLoginUsuarios() == '')
			throw new Exception("O Login do usuário não pode estar em branco.");
		if ($usuariosVo->getSenhaUsuarios() == '' && $usuariosVo->getIdUsuarios() == '')
			throw new Exception("A Senha do usuário não pode estar em branco.");
		if ($usuariosVo->getEmailUsuarios() == '')
			throw new Exception("O E-mail do usuário não pode estar em branco.");
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
			throw new Exception("Não foi possível continuar. {$e->getMessage()}");
		}
	}
	
	/**
	 * Método para alteração de senha do usuário
	 * @author Rafael Henrique Vieira de Moura
	 * @param UsuariosVo $usuariosVo
	 */
	public function alteraSenhaUsuarios(UsuariosVo $usuariosVo)
	{
		if ($usuariosVo->getSenhaUsuarios() == '')
			throw new Exception("O campo Nova Senha não pode estar em branco.");
		if ($_POST['confirmarSenhaUsuarios'] == '')
			throw new Exception("O campo Confirmar Senha não pode estar em branco.");
		
		if ($usuariosVo->getSenhaUsuarios() != $_POST['confirmarSenhaUsuarios']) {
			throw new Exception("As senhas digitadas não são iguais.");
		}
		
		$DAO = new DAO();
		try 
		{
			$DAO->alterarSenhaUsuarios($usuariosVo);
		}
		catch (Exception $e)
		{
			throw new Exception("Não foi possível continuar. {$e->getMessage()}");
		}
	}
	
	/**
	 * Método para Cadastrar/Alterar Funcionalidades no Sistema
	 * @author João Batista Padilha e Silva
	 * @param FuncionalidadesVo $funcionalidadesVo
	 */
	public function cadastrarFuncionalidades(FuncionalidadesVo $funcionalidadesVo)
	{
		//Validação
		if($funcionalidadesVo->getNomeFuncionalidades() == '')
			throw new Exception("O nome da Funcionalidade não pode estar em branco.");
		
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
			throw new Exception("Não foi possível continuar. {$e->getMessage()}");
		}
	}
	
	/**
	 * Método para buscar Módulos do Sistema
	 * @author João Batista Padilha e Silva
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
			throw new Exception("Não foi possível buscar Módulos. {$e->getMessage()}");
		}
		return $this->collVo;
	}
	
	/**
	 * Método que cadastra os módulos no Sistema/ Inserção e Alteração
	 * @author João Batista Padilha e Silva
	 * @param ModulosVo $modulosVo
	 */
	public function cadastrarModulos(ModulosVo $modulosVo)
	{
		//Validação
		if($modulosVo->getNomeModulos() == '')
			throw new Exception("O nome do módulo não pode estar em branco.");
		
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
			throw new Exception("Não foi possível continuar. {$e->getMessage()}");
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
			throw new Exception("Não foi possível continuar. {$e->getMessage()}");
		}
		
		return $this->collVo;
	}
	
	/**
	 * Metodo para cadastro e alteração de SubModulos
	 * @author Rafael Henrique Vieira de Moura
	 * @param SubModulosVo $subModulosVo
	 */
	public function cadastrarSubModulos(SubModulosVo $subModulosVo)
	{
		if ($subModulosVo->getNomeSubModulos() == '')
			throw new Exception("O Nome do SubModulo não pode estar em branco.");
		
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
			throw new Exception("Não foi possível continuar. {$e->getMessage()}");
		}
	}
	
	/**
	 * Método de Cadastramento de Modulos-SubMódulos (Sub-Módulos para cada Módulo)
	 * @author João Batista Padilha e Silva
	 * @param Modulos_SubModulosVo $modulosSubModulosVo
	 */
	public function cadastrarModulosSubModulos(Modulos_SubModulosVo $modulosSubModulosVo)
	{
		//Validação
		if($modulosSubModulosVo->getIdModulos() == '' && $modulosSubModulosVo->getIdSubModulos() == '')
			throw new Exception("O Módulo e o Sub-Módulo deve ser selecionado não pode estar em branco.");
		
		$DAO = new DAO();
		try 
		{
				$DAO->inserirModulos_SubModulos($modulosSubModulosVo);
		}
		catch (Exception $e)
		{
			throw new Exception("Não foi possível continuar. {$e->getMessage()}");
		}
	}
	
	/**
	 * Método para pesquisar todos os Sub-Módulos para cada Módulo
	 * @author João Batista Padilha e Silva
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
			throw new Exception("Não foi possível continuar. {$e->getMessage()}");
		}
		
		return $this->collVo;
	}
	
	/**
	 * Método que deleta todas os sub-modulos para o módulo selecionado
	 * @author João Batista Padilha e Silva
	 * @param Modulos_SubModulosVo $modulosSubModulosVo
	 */
	public function deletaModulosSubModulos(Modulos_SubModulosVo $modulosSubModulosVo)
	{
		$DAO = new DAO();
		try 
		{
			if($modulosSubModulosVo->getIdModulos() == '')
				throw new Exception("Identificação do Módulo não identificado.");
			$DAO->deletarModulos_SubModulos($modulosSubModulosVo);
		}
		catch (Exception $e)
		{
			throw new Exception("Não foi possível Continuar. {$e->getMessage()}");
		}
	}
	
	/**
	 * Método para pesquisa de Clientes
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
			throw new Exception("Não foi possível continuar. {$e->getMessage()}");
		}
		
		return $this->collVo;
	}
	
	/**
	 * Metodo para cadastro e alteração de SubModulos
	 * @author Rafael Henrique Vieira de Moura
	 * @param SubModulosVo $subModulosVo
	 */
	public function cadastrarClientes(ClientesVo $clientesVo)
	{
		if ($clientesVo->getNomeClientes() == '')
			throw new Exception("O Nome do Cliente não pode estar em branco.");
		
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
			throw new Exception("Não foi possível continuar. {$e->getMessage()}");
		}
	}
	
	/**
	 * Método de Pesquisa da Tabela Básica
	 * @author João Batista Padilha e Silva
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
			throw new Exception("Não foi possível continuar. {$e->getMessage()}");
		}
		
		return $this->collVo;
	}
	
	/**
	 * Método de alteração da tabela básica
	 * @author João Batista Padilha e Silva
	 * @param TabelaBasicaVo $tabelaBasicaVo
	 */
	public function cadastrarTabelaBasica(TabelaBasicaVo $tabelaBasicaVo)
	{
		if ($tabelaBasicaVo->getToleranciaHoraConformidade() == '')
			throw new Exception("A Tolerância das não conformidades não pode estar em branco.");
		
		$DAO = new DAO();
		
		try 
		{
			self::verificaEmail($tabelaBasicaVo->getEmailPadraoTabelaBasica());
			$DAO->alterarTabelaBasica($tabelaBasicaVo);
		}
		catch (Exception $e)
		{
			throw new Exception("Não foi possível continuar. {$e->getMessage()}");
		}
	}
	
	/**
	 * Método para cadastro de Usuarios_Clientes
	 * @author Rafael Henrique Vieira de Moura
	 * @param Usuarios_ClientesVo $usuarios_ClientesVo
	 */
	public function cadastrarUsuariosClientes(Usuarios_ClientesVo $usuarios_ClientesVo)
	{
		//validação
		if ($usuarios_ClientesVo->getIdClientes() == '' || $usuarios_ClientesVo->getIdUsuarios() == '')
				throw new Exception("Usuários e Clientes não selecionados");
		
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
	 * Método que pesquisa todas as tecnologias existentes no Sistema
	 * @author João Batista Padilha e Silva
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
			throw new Exception("Não foi possível continuar. {$e->getMessage()}");
		}
		return $this->collVo;
	}
	
	/**
	 * Método que cadastra as Tecnologias no Sistema
	 * @author João Batista Padilha e Silva
	 * @param TecnologiasVo $tecnologiasVo
	 */
	public function cadastrarTecnologias(TecnologiasVo $tecnologiasVo)
	{
		//Validação
		if($tecnologiasVo->getNomeTecnologias() == '')
			throw new Exception("O nome da Tecnologia não pode estar em branco.");
		
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
			throw new Exception("Não foi possível continuar. {$e->getMessage()}");
		}
	}
	
	/**
	 * Método de pesquisa de Versões de Sistema
	 * @author João Batista Padilha e Silva
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
			throw new Exception("Não foi possível continuar. {$e->getMessage()}");
		}
		return $this->collVo;
	}
	
	/**
	 * Método de Cadastrar / Alterar Versões de Sistema
	 * @author João Batista Padilha e Silva
	 * @param VersoesVo $versoesVo
	 */
	public function cadastrarVersoes(VersoesVo $versoesVo)
	{
		//Validação
		if($versoesVo->getNomeVersoes() == '')
			throw new Exception("O nome da Versão não pode estar em branco.");
		if($versoesVo->getDataEntregaVersoes() == '')
			throw new Exception("A Data de Entrega não pode estar em branco.");
		if($versoesVo->getDataEntregaVersoesClientes() == '')
			throw new Exception("A Data de Entrega da Versão para o Cliente não pode estar em branco.");
		if($versoesVo->getIdProjetos() == '')
			throw new Exception("O Projeto da Versão deve ser selecionado.");
		/*if($versoesVo->getNomeVersoes() == '' && $versoesVo->getDataEntregaVersoesClientes() == '' && $versoesVo->getDataEntregaVersoes() == '')
			throw new Exception("O Nome da Versão, Data de Entrega e a Data de Entrega para o Cliente não podem estar em branco.");*/
		
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
			throw new Exception("Não foi possível continuar. {$e->getMessage()}");
		}
	}
	
	/**
	 * Método para pesquisa de anexos
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
			throw new Exception("Não foi possível continuar. {$e->getMessage()}");
		}
		
		return $this->collVo;
	}
	
	/**
	 * Método para pesquisar Atividades
	 * @author João Batista Padilha e Silva
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
			throw new Exception("Não foi possível continuar. {$e->getMessage()}");
		}
		return $this->collVo;
	}
	
	/**
	 * Método para Cadastrar Atividade Ponto Fução Horas
	 * @author João Batista Padilha e Silva
	 * @param AtividadesPontoFuncaoHorasVo $atividadesVo
	 */
	public function cadastrarAtividades(AtividadesPontoFuncaoHorasVo $atividadesVo)
	{
		//Validação
		if($atividadesVo->getNomeAtividadesPontoFuncaoHoras() == '' && $atividadesVo->getIdTecnologias() == '')
			throw new Exception("O nome da Atividade e a Tecnologia não podem estar em branco.");
		if($atividadesVo->getNomeAtividadesPontoFuncaoHoras() != '' && $atividadesVo->getIdTecnologias() == '')
			throw new Exception("ATecnologia não pode estar em branco.");
		if($atividadesVo->getNomeAtividadesPontoFuncaoHoras() == '' && $atividadesVo->getIdTecnologias() != '')
			throw new Exception("O nome da Atividade não pode estar em branco.");
			
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
			throw new Exception("Não foi possível continuar. {$e->getMessage()}");
		}
	}
	
	/**
	 * Método para cadastro de anexo
	 * @author Rafael Henrique Vieira de Moura
	 * @param AnexosVo $anexosVo
	 */
	public function cadastrarAnexos(AnexosVo $anexosVo)
	{
		if ($anexosVo->getNomeAnexos() == '')
			throw new Exception("O Nome do Anexo não pode estar em branco.");
		
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
			throw new Exception("Não foi possível continuar. {$e->getMessage()}");
		}
		return $ultimoId;
	}
	
	/**
	 * Método para deleção de arquivos de anexos
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
			throw new Exception("Não foi possível continuar. {$e->getMessage()}");
		}
	}
	
	/**
	 * Método para upload de arquivos de anexos
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
			throw new Exception("Não foi possível continuar. {$e->getMessage()}");
		}
		
		return $caminhoAnexos;
	}
	
	/**
	 * Método que pesquisa todas os Grupo de Fluxos existentes no Sistema
	 * @author João Batista Padilha e Silva
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
			throw new Exception("Não foi possível continuar. {$e->getMessage()}");
		}
		return $this->collVo;
	}
	
	/**
	 * Método que cadastra as Grupo de Fluxos no Sistema
	 * @author João Batista Padilha e Silva
	 * @param GrupoFluxosVo $grupoFluxosVo
	 */
	public function cadastrarGrupoFluxos(GrupoFluxosVo $grupoFluxosVo)
	{
		//Validação
		if($grupoFluxosVo->getNomeGrupoFluxos() == '')
			throw new Exception("O nome do Grupo de Fluxos não pode estar em branco.");
		
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
			throw new Exception("Não foi possível continuar. {$e->getMessage()}");
		}
	}
	
	/**
	 * Método de Pesquisa de Fluxos do Sistema
	 * @author João Batista Padilha e Silva
	 * @param FluxosVo $fluxosVo
	 * @return $this->collVo
	 */
	public function pesquisarFluxos(FluxosVo $fluxosVo)
	{
		$QDAO = new QDAO();
		try 
		{
			//Ordernar Lista
			//Verificar se A pesquisa é pelo precedente colocando assim em ordem
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
	 * Método de Cadastramento de Fluxos do Sistema
	 * @author João Batista Padilha e Silva
	 * @param FluxosVo $fluxosVo
	 */
	public function cadastrarFluxos(FluxosVo $fluxosVo)
	{
		//Validação
		if($fluxosVo->getIdGrupoFluxos() == '' && $fluxosVo->getIdPapeisOrigem() == '' && $fluxosVo->getIdPapeisDestinatario() == '')
			throw new Exception("O Grupo de Fluxos, o Papel de Origem e o Papel Destinatário não podem estar em branco.");
		elseif($fluxosVo->getIdGrupoFluxos() != '' && $fluxosVo->getIdPapeisOrigem() == '' && $fluxosVo->getIdPapeisDestinatario() == '')
			throw new Exception("Os Papeis de Origem e Destinatário não podem estar em branco.");
		elseif($fluxosVo->getIdGrupoFluxos() != '' && $fluxosVo->getIdPapeisOrigem() != '' && $fluxosVo->getIdPapeisDestinatario() == '')
			throw new Exception("O Papel de Destinatário não pode estar em branco.");
		elseif($fluxosVo->getIdGrupoFluxos() != '' && $fluxosVo->getIdPapeisOrigem() == '' && $fluxosVo->getIdPapeisDestinatario() != '')
			throw new Exception("O Papel de Origem não pode estar em branco.");
		
			/**
		 * Buscar os Fluxos na ordem. Caso não seja alteração, apenas seta a ordem, na ultima posição, caso contrário, selecione a ordem.
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
			throw new Exception("Não foi possível continuar. {$e->getMessage()}");
		}
	}
	
	/**
	 * Método para gravação de Log de ações executadas no Suporte
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
			throw new Exception("Não foi possível continuar. ".$e->getMessage());
		}
	}
	
	/**
	 * Método que pesquisa os projetos
	 * @author João Batista Padilha e Silva
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
	 * Método que cadastra/altera os Projetos no Sistema
	 * @author João Batista Padilha e Silva
	 * @param ProjetosVo $projetosVo
	 */
	public function cadastrarProjetos(ProjetosVo $projetosVo)
	{
		//Validação
		if($projetosVo->getNomeProjetos() == '')
			throw new Exception("O nome do Projeto não pode estar em branco.");

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
			throw new Exception("Não foi possível continuar. {$e->getMessage()}");
		}
	}
	
	/**
	 * Método para pesquisa do Log_Suporte
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
	 * Método que pesquisa Papeis Projetos
	 * @author João Batista Padilha e Silva
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
	 * Método que pesquisa todos os destinatários não conformidades
	 * @author João Batista Padilha e Silva
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
	 * Método para cadastrar PapeisProjetos
	 * @author João Batista Padilha e Silva
	 * @param Papeis_ProjetosVo $papeisProjetosVo
	 */
	public function cadastrarPapeisProjetos(Papeis_ProjetosVo $papeisProjetosVo)
	{
		//Validação
		if($papeisProjetosVo->getIdProjetos() == '' && $papeisProjetosVo->getIdPapeis() == '' && $papeisProjetosVo->getIdUsuarios() == '')
			throw new Exception("O Projeto, papel e o usuário não podem estar em branco.");
		if($papeisProjetosVo->getIdProjetos() != '' && $papeisProjetosVo->getIdPapeis() == '' && $papeisProjetosVo->getIdUsuarios() == '')
			throw new Exception("O Papel e o usuário não podem estar em branco.");
		if($papeisProjetosVo->getIdProjetos() != '' && $papeisProjetosVo->getIdPapeis() != '' && $papeisProjetosVo->getIdUsuarios() == '')
			throw new Exception("O Usuário não pode estar em branco.");
		if($papeisProjetosVo->getIdProjetos() != '' && $papeisProjetosVo->getIdPapeis() == '' && $papeisProjetosVo->getIdUsuarios() != '')
			throw new Exception("O Papel não pode estar em branco.");

		$DAO = new DAO();
		try 
		{
			$DAO->inserirPapeisProjetos($papeisProjetosVo);
		}
		catch (Exception $e)
		{
			throw new Exception("Não foi possível continuar. {$e->getMessage()}");
		}
	}
	
	/**
	 * Método para deletar papeis Projetos
	 * @author João Batista Padilha e Silva
	 * @param Papeis_ProjetosVo $papeisProjetosVo
	 */
	public function deletaPapeisProjetos(Papeis_ProjetosVo $papeisProjetosVo)
	{
		$DAO = new DAO();
		try 
		{
			if($papeisProjetosVo->getIdProjetos() == '')
				throw new Exception("Projeto não selecionado");
			$DAO->deletaPapeisProjetos($papeisProjetosVo);
		}
		catch (Exception $e)
		{
			throw new Exception("Não foi possível Continuar. {$e->getMessage()}");
		}
	}
	
	/**
	 * Método que cadastra os DestinatariosNaoConformidades
	 * @author João Batista Padilha e Silva
	 * @param DestinatariosNaoConformidadesVo $destinatariosVo
	 */
	public function cadastrarDestinatariosNaoConformidades(DestinatariosNaoConformidadesVo $destinatariosVo)
	{
		//Validação
		if($destinatariosVo->getIdProjetos() == '')
			throw new Exception("O Projeto não pode estar em branco.");
		
		$DAO = new DAO();
		try 
		{
			$DAO->inserirDestinatariosNaoConformidades($destinatariosVo);
		}
		catch (Exception $e)
		{
			throw new Exception("Não foi possível continuar. {$e->getMessage()}");
		}
	}
	
	/**
	 * Método que deleta os DestinatariosNaoConformidades de acordo com o projeto
	 * @author João Batista Padilha e Silva
	 * @param DestinatariosNaoConformidadesVo $destinatariosVo
	 */
	public function deletaDestinatariosNaoConformidades(DestinatariosNaoConformidadesVo $destinatariosVo)
	{
		//Validação
		if($destinatariosVo->getIdProjetos() == '')
			throw new Exception("O Projeto não podem estar em branco.");
		
		$DAO = new DAO();
		try 
		{
			$DAO->deletaDestinatariosNaoConformidades($destinatariosVo);
		}
		catch (Exception $e)
		{
			throw new Exception("Não foi possível continuar. {$e->getMessage()}");
		}
	}
	
	/**
	 * Método de pesquisa dos Módulos do Projeto
	 * @author João Batista Padilha e Silva
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
	 * Método de cadastramento de Módulos para o projeto
	 * @author João Batista Padilha e Silva
	 * @param Projetos_ModulosVo $projetosModulosVo
	 */
	public function cadastrarProjetosModulos(Projetos_ModulosVo $projetosModulosVo)
	{
		//Validação
		if($projetosModulosVo->getIdProjetos() == '' && $projetosModulosVo->getIdModulos() == '')
			throw new Exception("O Projeto e o Módulo não podem estar em branco.");
		if($projetosModulosVo->getIdProjetos() != '' && $projetosModulosVo->getIdModulos() == '')
			throw new Exception("O Módulo não pode estar em branco.");
		if($projetosModulosVo->getIdProjetos() == '' && $projetosModulosVo->getIdModulos() != '')
			throw new Exception("O Projeto não pode estar em branco.");
		
		$DAO = new DAO();
		try 
		{
			$DAO->inserirProjetosModulos($projetosModulosVo);
		}
		catch (Exception $e)
		{
			throw new Exception("Não foi possível continuar. {$e->getMessage()}");
		}
	}
	
	/**
	 * Método de deleção de Módulos do Projeto
	 * @author João Batista Padilha e Silva
	 * @param Projetos_ModulosVo $projetosModulosVo
	 */
	public function deletaProjetosModulos(Projetos_ModulosVo $projetosModulosVo)
	{
		$DAO = new DAO();
		try 
		{
			if($projetosModulosVo->getIdProjetos() == '')
				throw new Exception("Projeto não selecionado");
			$DAO->deletarProjetosModulos($projetosModulosVo);
		}
		catch (Exception $e)
		{
			throw new Exception("Não foi possível Continuar. {$e->getMessage()}");
		}
	}
	
	/**
	 * Método que popula o Vo passado. De acordo com sua instância, ele popula o vo com id's diferentes
	 * @author João Batista Padilha e Silva
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
	 * Método de Cadastramento de Pedidos
	 * @author João Batista Padilha e Silva
	 * @param PedidosVo $pedidosVo
	 * @return int UltimoIdInserido
	 */
	public function cadastrarPedidos(PedidosVo $pedidosVo)
	{
		//Validação
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
			throw new Exception("Não foi possível continuar. {$e->getMessage()}");
		}
		return $ultimoId;
	}
	
	/**
	 * Método de Cadastramento de Históricos do Pedido
	 * @author João Batista Padilha e Silva
	 * @param Historico_PedidosVo $historicoVo
	 */
	public function cadastrarHistoricoPedidos(Historico_PedidosVo $historicoVo)
	{
		$ultimoId = '';
		//Validação
		if($historicoVo->getIdPedidos() == '')
			throw new Exception("O Nº do Pedido não existe.");
		elseif ($historicoVo->getIdUsuarioOrigem() == '')
			throw new Exception("O usuário de origem deve ser selecionado.");
		elseif ($historicoVo->getIdPapeisOrigem() == '')
			throw new Exception("O papel de origem deve ser selecionado.");
		elseif ($historicoVo->getIdUsuariosDestinatario() == '')
			throw new Exception("O usuário destinatário deve ser selecionado.");
		elseif ($historicoVo->getIdPapeisDestinatario() == '')
			throw new Exception("O papel destinatário deve ser selecionado.");
		elseif ($historicoVo->getIdFluxos() == '')
			throw new Exception("Usuário não autorizado a realizar este fluxo.");
		elseif ($historicoVo->getIdUsuariosDestinatario() == '')
			throw new Exception("O usuário destinatário deve ser selecionado.");
		
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
			throw new Exception("Não foi possível continuar. {$e->getMessage()}");
		}
		return $ultimoId;
	}
	
	/**
	 * Método de Pesquisa de Pedidos
	 * @author João Batista Padilha e Silva
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
	 * Método para pesquisar os pedidos que entraram em Não Conformidade
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
	 * Método de Pesquisa de Pedidos por Projeto
	 * @author João Batista Padilha e SIlva
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
	 * Método de pesquisa de pedidos por precedente
	 * @author João Batista Padilha e Silva
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
	 * Método de Pesquisa de Pedidos por Status
	 * @author João Batista Padilha e Silva
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
	 * Método de Pesquisa de Históricos do Pedido
	 * @author João Batista Padilha e Silva
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
	 * Método para pesquisa de Não Conformidades
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
	 * Método para cadastro de não conformidades
	 * @author Rafael Henrique Vieira de Moura
	 * @param NaoConformidadesVo $naoConformidadesVo
	 */
	public function cadastrarNaoConformidades(NaoConformidadesVo $naoConformidadesVo, $retorno = false)
	{
		$DAO = new DAO();
		
		/*if ($naoConformidadesVo->getJustificativaNaoConformidades() == '')
		{
			throw new Exception('O campo Justificativa não pode estar em branco.');
		}
		if ($naoConformidadesVo->getContraMedidasNaoConformidades() == '' && $naoConformidadesVo->get)
		{
			throw new Exception('O campo Contra-Medidas não pode estar em branco.');
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