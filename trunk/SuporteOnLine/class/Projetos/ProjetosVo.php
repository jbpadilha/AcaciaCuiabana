<?php
//####################################
// * Jo�o Batista Padilha e Silva Analista/Desenvolvedor (�baco Tecnologia)
// * Arquivo: ProjetosVo.php
// * Cria��o: Jo�o Batista Padilha e Silva
// * Revis�o:
// * Data de cria��o: 01/07/2008
//####################################
/**
 * Classe Value Objet. Serve para transportar os atributos dos usu�rios entre as camadas.
 * @author Jo�o Batista Padilha e Silva
 */
class ProjetosVo extends AbstractVo 
{
	private $idProjetos = null;
	private $nomeProjetos = '';
	private $idGrupoFluxos = null;
	private $idClientes = null;

	/**
	 * M�todo que atribui a identifica��o de Projetos
	 * @author Jo�o Batista Padilha e Silva
	 * @param int $id
	 */
	public function setIdProjetos($id)
	{
		$this->idProjetos = $id;
	}
	
	/**
	 * M�todo retorna a identifica��o de Projetos
	 * @author Jo�o Batista Padilha e Silva
	 * @return int
	 */
	public function getIdProjetos()
	{
		return $this->idProjetos;
	}
	
	/**
	 * M�todo que atribui o Nome de Projetos
	 * @author Jo�o Batista Padilha e Silva
	 * @param var $nome
	 */
	public function setNomeProjetos($nome)
	{
		$this->nomeProjetos = $nome;
	}
	
	/**
	 * M�todo que retorna o nome de projetos
	 * @author Jo�o Batista Padilha e Silva
	 * @return var
	 */
	public function getNomeProjetos()
	{
		return $this->nomeProjetos;
	}
	
	/**
	 * M�todo que atribui a identifica��o de grupo de fluxos ao projeto
	 * @author Jo�o Batista Padilha e Silva
	 * @param int $id
	 */
	public function setIdGrupoFluxos($id)
	{
		$this->idGrupoFluxos = $id;
	}
	
	/**
	 * M�todo que retorna a identifica��o de grupo de fluxos ao projeto
	 * @author Jo�o Batista Padilha e Silva
	 * @return int
	 */
	public function getIdGrupoFluxos()
	{
		return $this->idGrupoFluxos;
	}
	
	/**
	 * M�todo que atribui a identifica��o de Clientes
	 * @author Jo�o Batista Padilha e Silva
	 * @param int $id
	 */
	public function setIdClientes($id)
	{
		$this->idClientes = $id;
	}
	
	/**
	 * M�todo que retorna a identifica��o de Clientes
	 * @author Jo�o Batista Padilha e Silva
	 * @return int
	 */
	public function getIdClientes()
	{
		return $this->idClientes;
	}
}
?>