<?php

class Submenus extends Lumine_Base {
	
	protected $_tablename = 'submenus';
    protected $_package   = 'model';
	
	public $idSubMenu = null;
	public $idPagina = null;
	public $nomeSubMenu = "";
	public $linkSubMenu = "";
	public $downloadSubMenu = "";
	public $idMenu = null;
	
	/**
     * Inicia os valores da classe
     * @author Jo�o Batista Padilha e Silva
     * @return void
     */
    protected function _initialize()
    {
		# idatividades, atividades
        
        $this->_addField("idSubMenu", "idSubMenu", "int", 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->_addField('idPagina', 'idPagina', 'int', 11, array('foreign' => '1', 'onUpdate' => 'CASCADE', 'onDelete' => 'CASCADE', 'linkOn' => 'idPagina', 'class' => 'Paginas'));
        $this->_addField("nomeSubMenu", "nomeSubMenu", "varchar", 255, array('notnull' => true));
        $this->_addField("linkSubMenu", "linkSubMenu", "varchar", 255, array('notnull' => true));
        $this->_addField("downloadSubMenu", "downloadSubMenu", "varchar", 255, array('notnull' => true));
        $this->_addField('idMenu', 'idMenu', 'int', 11, array('foreign' => '1', 'onUpdate' => 'CASCADE', 'onDelete' => 'CASCADE', 'linkOn' => 'idMenu', 'class' => 'Menus'));
        
    }
	
    /**
     * Recupera um objeto estaticamente
     * @author Jo�o Batista Padilha e Silva
     * @return Pessoa
     */
    public static function staticGet($pk, $pkValue = null)
    {
        $obj = new Submenus();
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
	
	/**
	 * @return the $idSubMenu
	 */
	public function getIdSubMenu() {
		return $this->idSubMenu;
	}

	/**
	 * @return the $idPagina
	 */
	public function getIdPagina() {
		return $this->idPagina;
	}

	/**
	 * @return the $nomeSubMenu
	 */
	public function getNomeSubMenu() {
		return $this->nomeSubMenu;
	}

	/**
	 * @return the $linkSubMenu
	 */
	public function getLinkSubMenu() {
		return $this->linkSubMenu;
	}

	/**
	 * @return the $downloadSubMenu
	 */
	public function getDownloadSubMenu() {
		return $this->downloadSubMenu;
	}

	/**
	 * @param field_type $idSubMenu
	 */
	public function setIdSubMenu($idSubMenu) {
		$this->idSubMenu = $idSubMenu;
	}

	/**
	 * @param field_type $idPagina
	 */
	public function setIdPagina($idPagina) {
		$this->idPagina = $idPagina;
	}

	/**
	 * @param field_type $nomeSubMenu
	 */
	public function setNomeSubMenu($nomeSubMenu) {
		$this->nomeSubMenu = $nomeSubMenu;
	}

	/**
	 * @param field_type $linkSubMenu
	 */
	public function setLinkSubMenu($linkSubMenu) {
		$this->linkSubMenu = $linkSubMenu;
	}

	/**
	 * @param field_type $downloadSubMenu
	 */
	public function setDownloadSubMenu($downloadSubMenu) {
		$this->downloadSubMenu = $downloadSubMenu;
	}
	
	/**
	 * @return the $idMenu
	 */
	public function getIdMenu() {
		return $this->idMenu;
	}

	/**
	 * @param field_type $idMenu
	 */
	public function setIdMenu($idMenu) {
		$this->idMenu = $idMenu;
	}

	/**
	 * Valida��o(non-PHPdoc)
	 * @see lumine/lib/Lumine_Base#validate()
	 */
	public function validate()
	{
		
		// limpa os validators anteriores
		Lumine_Validator_PHPValidator::clearValidations($this);
		
		// adicionando as regras 
		Lumine_Validator_PHPValidator::addValidation($this, 'nomeSubMenu', Lumine_Validator::REQUIRED_STRING, 'Informe o nome do SubMenu');
		
		return parent::validate();
	}
	
	/**
	 * 
	 * Retorno do Menu Relacionado
	 * @return Menus
	 */
	public function getMenu()
	{
		$menu = new Menus();
		$menu->setIdMenu($this->idMenu);
		$menu->find(true);
		return $menu;
	}
	
	
}

?>