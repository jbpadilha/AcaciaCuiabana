<?php
//####################################
// * Rafael Henrique Vieira de Moura / Desenvolvedor (�baco Tecnologia)
// * Arquivo: FluxosVo.php
// * Cria��o: Rafael Henrique Vieira de Moura
// * Revis�o: Jo�o Batista Padilha e Silva
// * Data de cria��o: 01/07/2008
// * Data de revis�o: 11/07/2008
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
	 * M�todo de modifica��o da identifica��o do Grupo de Fluxo para este Fluxo
	 * @author Jo�o Batista Padilha e Silva
	 * @param int $id
	 */
	public function setIdGrupoFluxos($id = null)
	{
		$this->idGrupoFluxos = $id;
	}
	
	/**
	 * M�todo de retorno da identifica��o do Grupo de Fluxos para este Fluxo
	 * @author Jo�o Batista Padilha e Silva
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