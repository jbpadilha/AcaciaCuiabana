<?php
//####################################
// * Jo�o Batista Padilha e Silva Analista/Desenvolvedor (�baco Tecnologia)
// * Arquivo: Controla_Permissao.php
// * Cria��o: Jo�o Batista Padilha e Silva
// * Revis�o: 
// * Data de cria��o: 07/07/2008
//####################################
require_once("Permissao_Usuarios_Funcionalidade_PapeisVo.php");

/**
 * Classe de Controle das Permiss�es do Sistema
 * @author Jo�o Batista Padilha e Silva
 */
class Controla_Permissao
{
	private $collVo = null;
	
	/**
	 * M�todo de busca de Permissoes do usu�rio.
	 * @author Jo�o Batista Padilha e Silva
	 * @return $this->collVo
	 */
	public function buscaPermissoesUsuarios()
	{
		$permissaoVo = new Permissao_Usuarios_Funcionalidades_PapeisVo();
		$permissaoVo->setIdUsuarios($_SESSION["id_Usuario"]);
		$businessEntity = new BusinessEntity();
		try 
		{
			$this->collVo = $businessEntity->buscaPermissaoUsuarios($permissaoVo);
		}
		catch (Exception $e)
		{
			header("../index.php?msg = {$e->getMessage()}");
		}
		return $this->collVo;
	}
	
	/**
	 * Cadastra Permiss�es de todas as funcionalidades conforme selecionado
	 * @author Jo�o Batista Padilha e Silva
	 * @param Permissao_Usuarios_Funcionalidades_PapeisVo $permissaoVo
	 */
	public function cadastraPermissoes(Permissao_Usuarios_Funcionalidades_PapeisVo $permissaoVo)
	{
		if($permissaoVo->getIdFuncionalidades() == '')
			throw new Exception("N�o foi poss�vel cadastrar permiss�o. Funcionalidade ausente");
		if ($permissaoVo->getIdPapeis() == '' && $permissaoVo->getIdUsuarios() == '') 
			throw new Exception("N�o foi poss�vel cadastrar permiss�o. Papel ou Usu�rio n�o selecionado.");
		try 
		{
			$DAO = new DAO();
			$DAO->inserirPermissaoUsuariosFuncionalidadesPapeis($permissaoVo);
		}
		catch (Exception $e)
		{
			throw new Exception("N�o foi poss�vel continuar. {$e->getMessage()}");
		}
	}
	
	/**
	 * M�todo que busca as permiss�es pelos par�metros passados.
	 * @author Jo�o Batista Padilha e Silva
	 * @param Permissao_Usuarios_Funcionalidades_PapeisVo $permissaoVo
	 * @return $this->collVo
	 */
	public function buscaPermissoes(Permissao_Usuarios_Funcionalidades_PapeisVo $permissaoVo)
	{
		try
		{
			$businessEntity = new BusinessEntity();
			$this->collVo = $businessEntity->buscaPermissoes($permissaoVo);
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
		}
		return $this->collVo;
	}
	
	/**
	 * Busca as permiss�es do usu�rio sem retornar mensagem de Erro, caso n�o encontre
	 * @author Jo�o Batista Padilha e Silva
	 * @param Permissao_Usuarios_Funcionalidades_PapeisVo $permissaoVo
	 * @return array $this->collVo
	 */
	public function buscaPermissoesSemMensagem(Permissao_Usuarios_Funcionalidades_PapeisVo $permissaoVo)
	{
		try
		{
			$businessEntity = new BusinessEntity();
			$this->collVo = $businessEntity->buscaPermissoes($permissaoVo,false);
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
		}
		return $this->collVo;
	}
	
	/**
	 * M�todo de dele��o de permiss�es a partir de id de Usuarios ou de id de Papeis
	 * @author Jo�o Batista Padilha e Silva
	 * @param Permissao_Usuarios_Funcionalidades_PapeisVo $permissaoVo
	 */
	public function deletarPermissoes(Permissao_Usuarios_Funcionalidades_PapeisVo $permissaoVo)
	{
		try 
		{
			$businessEntity = new BusinessEntity();
			$businessEntity->deletaPermissoes($permissaoVo);
		}
		catch (Exception $e) 
		{
			echo $e->getMessage();
		}
	}

	/**
	 * M�todo que verifica se o usu�rio tem permiss�o para esta funcionalidade.
	 * @author Jo�o Batista Padilha e Silva
	 * @param Permissao_Usuarios_Funcionalidades_PapeisVo $permissaoVo
	 * @param int $idFuncionalidade
	 * @return bool
	 */
	public function verificaPermissao(Permissao_Usuarios_Funcionalidades_PapeisVo $permissaoVo,$idFuncionalidade)
	{
		try
		{
			$businessEntity = new BusinessEntity();
			$permissaoVo->setIdFuncionalidades($idFuncionalidade);
			$this->collVo = $businessEntity->buscaPermissoes($permissaoVo,false);
			if(!is_null($this->collVo))
				$return = true;
			else 
				$return = false;
		}
		catch (Exception $e)
		{
			$return = false;
			echo $e->getMessage();
		}
		return $return;
	}
	
	/**
	 * M�todo de verifica��o se o usu�rio tem permiss�o � funcionalidade
	 * @author Jo�o Batista Padilha e Silva
	 * @param int $idUsuario
	 * @param int $idFuncionalidade
	 * @return boolean
	 */
	public function verificaPermissaoPorUsuarioEFuncionalidade($idUsuario, $urlBaseFuncionalidade)
	{
		$controla_Funcionalidades = new Controla_Funcionalidades();
		$funcionalidadesVo = new FuncionalidadesVo();
		$funcionalidadesVo->setLinkFuncionalidades($urlBaseFuncionalidade);
		$collVo_Funcionalidades = $controla_Funcionalidades->pesquisarFuncionalidadesPorLink($funcionalidadesVo);
		$funcionalidadesVo = (object) $collVo_Funcionalidades[0];
		
		$permissaoVo = new Permissao_Usuarios_Funcionalidades_PapeisVo();
		$permissaoVo->setIdUsuarios($idUsuario);
		$permissaoVo->setIdFuncionalidades($funcionalidadesVo->getIdFuncionalidades());
		$this->collVo = self::buscaPermissoesSemMensagem($permissaoVo);
		if(!is_null($this->collVo))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}
?>