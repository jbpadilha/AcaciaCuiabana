<?php
//####################################
// * Jo�o Batista Padilha e Silva Analista/Desenvolvedor (�baco Tecnologia)
// * Arquivo: PapeisVo.php
// * Cria��o: Jo�o Batista Padilha e Silva
// * Revis�o:
// * Data de cria��o: 30/06/2008
//####################################
/**
 * Classe Value Objet. Serve para transportar os atributos dos usu�rios entre as camadas.
 * @author Jo�o Batista Padilha e Silva
 */
class PapeisVo extends AbstractVo
{
	private $idPapeis = null;
	private $nomePapeis = '';
	
	/**
	 * M�todo de modifica��o da Identifica��o de Papeis
	 * @author Jo�o Batista Padilha e Silva
	 * @param integer $id
	 */
	public function setIdPapeis($id = null)
	{
		$this->idPapeis = $id;
	}
	
	/**
	 * M�todo de retorno da identifica��o de Papeis
	 * @author Jo�o Batista Padilha e Silva
	 * @return integer
	 */
	public function getIdPapeis()
	{
		return $this->idPapeis;
	}
	
	/**
	 * M�todo de modifica��o do nome de Papeis
	 * @author Jo�o Batista Padilha e Silva
	 * @param var $nome
	 */
	public function setNomePapeis($nome = '')
	{
		$this->nomePapeis = $nome;
	}
	
	/**
	 * M�todo de retorno do nome de Papeis
	 * @author Jo�o Batista Padilha e Silva
	 * @return var
	 */
	public function getNomePapeis()
	{
		return $this->nomePapeis;
	}
}
?>