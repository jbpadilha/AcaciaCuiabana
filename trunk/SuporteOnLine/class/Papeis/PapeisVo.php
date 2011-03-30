<?php
//####################################
// * Joуo Batista Padilha e Silva Analista/Desenvolvedor (Сbaco Tecnologia)
// * Arquivo: PapeisVo.php
// * Criaчуo: Joуo Batista Padilha e Silva
// * Revisуo:
// * Data de criaчуo: 30/06/2008
//####################################
/**
 * Classe Value Objet. Serve para transportar os atributos dos usuсrios entre as camadas.
 * @author Joуo Batista Padilha e Silva
 */
class PapeisVo extends AbstractVo
{
	private $idPapeis = null;
	private $nomePapeis = '';
	
	/**
	 * Mщtodo de modificaчуo da Identificaчуo de Papeis
	 * @author Joуo Batista Padilha e Silva
	 * @param integer $id
	 */
	public function setIdPapeis($id = null)
	{
		$this->idPapeis = $id;
	}
	
	/**
	 * Mщtodo de retorno da identificaчуo de Papeis
	 * @author Joуo Batista Padilha e Silva
	 * @return integer
	 */
	public function getIdPapeis()
	{
		return $this->idPapeis;
	}
	
	/**
	 * Mщtodo de modificaчуo do nome de Papeis
	 * @author Joуo Batista Padilha e Silva
	 * @param var $nome
	 */
	public function setNomePapeis($nome = '')
	{
		$this->nomePapeis = $nome;
	}
	
	/**
	 * Mщtodo de retorno do nome de Papeis
	 * @author Joуo Batista Padilha e Silva
	 * @return var
	 */
	public function getNomePapeis()
	{
		return $this->nomePapeis;
	}
}
?>