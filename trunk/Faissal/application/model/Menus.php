<?php
//####################################
// * Jo�o Batista Padilha e Silva Especialista em TI (http://www.joaopadilha.eti.br)
// * Arquivo: Menus.php
// * Cria��o: Jo�o Batista Padilha e Silva
// * Data de cria��o: 15/02/2008
// * E-mail: joao.padilha@brturbo.com.br
//####################################
/*
   Classe Menus, que transfere dados de uma Camada para outra.
*/
class Menus extends Lumine_Base
{
	protected $_tablename = 'menus';
    protected $_package   = 'model';
	
	public $idMenu = null;
	public $idPagina = null;
	public $nomeMenu = '';
	public $linkMenu = '';
	public $downloadMenu = '';
	
		/**
     * Inicia os valores da classe
     * @author Jo�o Batista Padilha e Silva
     * @return void
     */
    protected function _initialize()
    {
        $this->_addField("idMenu", "idMenu", "int", 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->_addField("nomeMenu", "nomeMenu", "varchar", 255, array('notnull' => true, 'default' => ''));
        $this->_addField("linkMenu", "linkMenu", "varchar", 255, array('notnull' => false, 'default' => ''));
        $this->_addField("downloadMenu", "downloadMenu", "varchar", 255, array('notnull' => false, 'default' => ''));
        $this->_addField('idPagina', 'idPagina', 'int', 11, array('foreign' => '1', 'onUpdate' => 'CASCADE', 'onDelete' => 'CASCADE', 'linkOn' => 'idPagina', 'class' => 'Paginas'));
    }
	
    /**
     * Recupera um objeto estaticamente
     * @author Jo�o Batista Padilha e Silva
     * @return Pessoa
     */
    public static function staticGet($pk, $pkValue = null)
    {
        $obj = new Menus();
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
	
	
	
	
	public function setIdMenu($id = '')
	{
		$this->idMenu = $id;
	}
	
	public function getIdMenu()
	{
		return $this->idMenu;
	}
	
	public function setIdPagina($id = '')
	{
		$this->idPagina = $id;
	}
	
	public function getIdPagina()
	{
		return $this->idPagina;
	}
	
	public function setNomeMenu($nome = '')
	{
		$this->nomeMenu = $nome;
	}
	
	public function getNomeMenu()
	{
		return $this->nomeMenu;
	}
	
	public function setLinkMenu($link = '')
	{
		$this->linkMenu = $link;
	}
	
	public function getLinkMenu()
	{
		return $this->linkMenu;
	}
	
	public function setDownloadMenu($download = '')
	{
		$this->downloadMenu = $download;
	}
	
	public function getDownloadMenu()
	{
		return $this->downloadMenu;
	}
}
?>