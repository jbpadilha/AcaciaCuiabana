<?php
//####################################
// * Rafael Henrique Vieira de Moura / Desenvolvedor (Сbaco Tecnologia)
// * Arquivo: FluxosVo.php
// * Criaчуo: Rafael Henrique Vieira de Moura
// * Revisуo: Joуo Batista Padilha e Silva
// * Data de criaчуo: 01/07/2008
// * Data de revisуo: 11/07/2008
//####################################
/**
 * Classe Value Object. Serve para transportar os atributos do Fluxo entre as camadas.
 * @author Rafael Henrique Vieira de Moura
 */
class FluxosVo extends AbstractVo 
{
	private $idFluxos = null;
	private $idGrupoFluxos = null;
	private $idPapeisOrigem = null;
	private $idPapeisDestinatario = null;
	private $ordemFluxos = null;
	
	public function setIdFluxos($id = null)
	{
		$this->idFluxos = $id;
	}
	
	public function getIdFluxos()
	{
		return $this->idFluxos;
	}
	
	/**
	 * Mщtodo de modificaчуo da identificaчуo do Grupo de Fluxo para este Fluxo
	 * @author Joуo Batista Padilha e Silva
	 * @param int $id
	 */
	public function setIdGrupoFluxos($id = null)
	{
		$this->idGrupoFluxos = $id;
	}
	
	/**
	 * Mщtodo de retorno da identificaчуo do Grupo de Fluxos para este Fluxo
	 * @author Joуo Batista Padilha e Silva
	 * @return int
	 */
	public function getIdGrupoFluxos()
	{
		return $this->idGrupoFluxos;
	}
	
	public function setIdPapeisOrigem($id = null)
	{
		$this->idPapeisOrigem = $id;
	}
	
	public function getIdPapeisOrigem()
	{
		return $this->idPapeisOrigem;
	}
	
	public function setIdPapeisDestinatario($id = null)
	{
		$this->idPapeisDestinatario = $id;
	}
	
	public function getIdPapeisDestinatario()
	{
		return $this->idPapeisDestinatario;
	}
	
	public function setOrdemFluxos($ordem = null)
	{
		$this->ordemFluxos = $ordem;
	}
	
	public function getOrdemFluxos()
	{
		return $this->ordemFluxos;
	}
}
?>