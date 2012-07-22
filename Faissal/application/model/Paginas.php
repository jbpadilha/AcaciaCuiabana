<?php
//####################################
// * Jo�o Batista Padilha e Silva Especialista em TI (http://www.joaopadilha.eti.br)
// * Arquivo: Paginas.php
// * Cria��o: Jo�o Batista Padilha e Silva
// * Data de cria��o: 15/02/2008
// * E-mail: joao.padilha@brturbo.com.br
//####################################
/*
   Classe Paginas, que transfere dados de uma Camada para outra.
*/
class Paginas extends Lumine_Base
{
	protected $_tablename = 'paginas'; 
    protected $_package   = 'model';
	
	public $idPagina = null;
	public $nomePagina = "";
	public $conteudoPagina = "";
	
	/**
     * Inicia os valores da classe
     * @author Jo�o Batista Padilha e Silva
     * @return void
     */
    protected function _initialize()
    {
        
        $this->_addField("idPagina", "idPagina", "int", 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->_addField("nomePagina", "nomePagina", "varchar", 255, array('notnull' => true));
        $this->_addField("conteudoPagina", "conteudoPagina", "blob", null, array('notnull' => false));
        
    }
	
    /**
     * Recupera um objeto estaticamente
     * @author Jo�o Batista Padilha e Silva
     * @return Pessoa
     */
    public static function staticGet($pk, $pkValue = null)
    {
        $obj = new Paginas();
        $obj->get($pk, $pkValue);
        return $obj;
    }

	/**
	 * chama o destrutor pai
	 *
	 */
	function __destruct()
	{
		parent::__destruct();
	}
	
	public function setIdPagina($id = '')
	{
		$this->idPagina = $id;
	}
	
	public function getIdPagina()
	{
		return $this->idPagina;
	}
	
	public function setNomePagina($nome = '')
	{
		$this->nomePagina = $nome;
	}
	
	public  function getNomePagina()
	{
		return $this->nomePagina;
	}
	
	public function setConteudoPagina($conteudo = '')
	{
		$this->conteudoPagina = $conteudo;
	}
	
	public function getConteudoPagina()
	{
		return $this->conteudoPagina;
	}
		
}
?>