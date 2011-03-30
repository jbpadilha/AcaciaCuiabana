<?php
//####################################
// * João Batista Padilha e Silva Analista/Desenvolvedor (Ábaco Tecnologia)
// * Arquivo: Controla_Permissao.php
// * Criação: João Batista Padilha e Silva
// * Revisão: 
// * Data de criação: 07/07/2008
//####################################
require_once("Permissao_Usuarios_Funcionalidade_PapeisVo.php");

/**
 * Classe de Controle das Permissões do Sistema
 * @author João Batista Padilha e Silva
 */
class Controla_Permissao
{
	private $collVo = null;
	
	/**
	 * Método de busca de Permissoes do usuário.
	 * @author João Batista Padilha e Silva
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
	 * Cadastra Permissões de todas as funcionalidades conforme selecionado
	 * @author João Batista Padilha e Silva
	 * @param Permissao_Usuarios_Funcionalidades_PapeisVo $permissaoVo
	 */
	public function cadastraPermissoes(Permissao_Usuarios_Funcionalidades_PapeisVo $permissaoVo)
	{
		if($permissaoVo->getIdFuncionalidades() == '')
			throw new Exception("Não foi possível cadastrar permissão. Funcionalidade ausente");
		if ($permissaoVo->getIdPapeis() == '' && $permissaoVo->getIdUsuarios() == '') 
			throw new Exception("Não foi possível cadastrar permissão. Papel ou Usuário não selecionado.");
		try 
		{
			$DAO = new DAO();
			$DAO->inserirPermissaoUsuariosFuncionalidadesPapeis($permissaoVo);
		}
		catch (Exception $e)
		{
			throw new Exception("Não foi possível continuar. {$e->getMessage()}");
		}
	}
	
	/**
	 * Método que busca as permissões pelos parâmetros passados.
	 * @author João Batista Padilha e Silva
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
	 * Busca as permissões do usuário sem retornar mensagem de Erro, caso não encontre
	 * @author João Batista Padilha e Silva
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
	 * Método de deleção de permissões a partir de id de Usuarios ou de id de Papeis
	 * @author João Batista Padilha e Silva
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
	 * Método que verifica se o usuário tem permissão para esta funcionalidade.
	 * @author João Batista Padilha e Silva
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
	 * Método de verificação se o usuário tem permissão à funcionalidade
	 * @author João Batista Padilha e Silva
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