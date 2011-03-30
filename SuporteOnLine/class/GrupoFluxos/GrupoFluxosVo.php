<?php
//####################################
// * Rafael Henrique Vieira de Moura / Desenvolvedor (�baco Tecnologia)
// * Arquivo: GrupoFluxosVo.php
// * Cria��o: Jo�o Batista Padilha e Silva
// * Revis�o:
// * Data de cria��o: 11/07/2008
//####################################
/**
 * Classe Value Object. Serve para transportar os atributos do Fluxo entre as camadas.
 * @author Jo�o Batista Padilha e Silva
 */
class GrupoFluxosVo extends AbstractVo 
{
	private $idGrupoFluxos = null;
	private $nomeGrupoFluxos = '';
	
	/**
	 * M�todo de altera��o da identifica��o do Grupo de Fluxos
	 * @author Jo�o Batista Padilha e Silva
	 * @param int $id
	 */
	public function setIdGrupoFluxos($id = null)
	{
		$this->idGrupoFluxos = $id;
	}
	
	/**
	 * M�todo de retorno da identifica��o do Grupo de Fluxos
	 * @author Jo�o Batista Padilha e Silva
	 * @return int
	 */
	public function getIdGrupoFluxos()
	{
		return $this->idGrupoFluxos;
	}
	
	/**
	 * M�todo de modifica��o do Nome de Grupo de Fluxos
	 * @author Jo�o Batista Padilha e Silva
	 * @param var $nome
	 */
	public function setNomeGrupoFluxos($nome = '')
	{
		$this->nomeGrupoFluxos = $nome;
	}
	
	/**
	 * M�todo de retorno do nome do Grupo de Fluxos
	 * @author Jo�o Batista Padilha e Silva
	 * @return var
	 */
	public function getNomeGrupoFluxos()
	{
		return $this->nomeGrupoFluxos;
	}
}
?>