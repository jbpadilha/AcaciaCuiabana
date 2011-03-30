<?php
//####################################
// * Joуo Batista Padilha e Silva Analista/Desenvolvedor (Сbaco Tecnologia)
// * Arquivo: ProjetosVo.php
// * Criaчуo: Joуo Batista Padilha e Silva
// * Revisуo:
// * Data de criaчуo: 01/07/2008
//####################################
/**
 * Classe Value Objet. Serve para transportar os atributos dos usuсrios entre as camadas.
 * @author Joуo Batista Padilha e Silva
 */
class ProjetosVo extends AbstractVo 
{
	private $idProjetos = null;
	private $nomeProjetos = '';
	private $idGrupoFluxos = null;
	private $idClientes = null;

	/**
	 * Mщtodo que atribui a identificaчуo de Projetos
	 * @author Joуo Batista Padilha e Silva
	 * @param int $id
	 */
	public function setIdProjetos($id)
	{
		$this->idProjetos = $id;
	}
	
	/**
	 * Mщtodo retorna a identificaчуo de Projetos
	 * @author Joуo Batista Padilha e Silva
	 * @return int
	 */
	public function getIdProjetos()
	{
		return $this->idProjetos;
	}
	
	/**
	 * Mщtodo que atribui o Nome de Projetos
	 * @author Joуo Batista Padilha e Silva
	 * @param var $nome
	 */
	public function setNomeProjetos($nome)
	{
		$this->nomeProjetos = $nome;
	}
	
	/**
	 * Mщtodo que retorna o nome de projetos
	 * @author Joуo Batista Padilha e Silva
	 * @return var
	 */
	public function getNomeProjetos()
	{
		return $this->nomeProjetos;
	}
	
	/**
	 * Mщtodo que atribui a identificaчуo de grupo de fluxos ao projeto
	 * @author Joуo Batista Padilha e Silva
	 * @param int $id
	 */
	public function setIdGrupoFluxos($id)
	{
		$this->idGrupoFluxos = $id;
	}
	
	/**
	 * Mщtodo que retorna a identificaчуo de grupo de fluxos ao projeto
	 * @author Joуo Batista Padilha e Silva
	 * @return int
	 */
	public function getIdGrupoFluxos()
	{
		return $this->idGrupoFluxos;
	}
	
	/**
	 * Mщtodo que atribui a identificaчуo de Clientes
	 * @author Joуo Batista Padilha e Silva
	 * @param int $id
	 */
	public function setIdClientes($id)
	{
		$this->idClientes = $id;
	}
	
	/**
	 * Mщtodo que retorna a identificaчуo de Clientes
	 * @author Joуo Batista Padilha e Silva
	 * @return int
	 */
	public function getIdClientes()
	{
		return $this->idClientes;
	}
}
?>