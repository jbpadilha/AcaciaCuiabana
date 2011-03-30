<?php
//####################################
// * Rafael Henrique Vieira de Moura / Desenvolvedor (Сbaco Tecnologia)
// * Arquivo: GrupoFluxosVo.php
// * Criaчуo: Joуo Batista Padilha e Silva
// * Revisуo:
// * Data de criaчуo: 11/07/2008
//####################################
/**
 * Classe Value Object. Serve para transportar os atributos do Fluxo entre as camadas.
 * @author Joуo Batista Padilha e Silva
 */
class GrupoFluxosVo extends AbstractVo 
{
	private $idGrupoFluxos = null;
	private $nomeGrupoFluxos = '';
	
	/**
	 * Mщtodo de alteraчуo da identificaчуo do Grupo de Fluxos
	 * @author Joуo Batista Padilha e Silva
	 * @param int $id
	 */
	public function setIdGrupoFluxos($id = null)
	{
		$this->idGrupoFluxos = $id;
	}
	
	/**
	 * Mщtodo de retorno da identificaчуo do Grupo de Fluxos
	 * @author Joуo Batista Padilha e Silva
	 * @return int
	 */
	public function getIdGrupoFluxos()
	{
		return $this->idGrupoFluxos;
	}
	
	/**
	 * Mщtodo de modificaчуo do Nome de Grupo de Fluxos
	 * @author Joуo Batista Padilha e Silva
	 * @param var $nome
	 */
	public function setNomeGrupoFluxos($nome = '')
	{
		$this->nomeGrupoFluxos = $nome;
	}
	
	/**
	 * Mщtodo de retorno do nome do Grupo de Fluxos
	 * @author Joуo Batista Padilha e Silva
	 * @return var
	 */
	public function getNomeGrupoFluxos()
	{
		return $this->nomeGrupoFluxos;
	}
}
?>