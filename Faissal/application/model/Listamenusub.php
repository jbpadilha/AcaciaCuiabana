<?php

require_once ('lumine\lib\Base.php');

class Listamenusub extends Lumine_Base {

	protected $_tablename = 'listamenusub';
    protected $_package   = 'model';
	
	public $idListaMenuSub = null;
	public $idMenu = '';
	public $idSubMenu = '';
	
	
	/**
     * Inicia os valores da classe
     * @author Jo�o Batista Padilha e Silva
     * @return void
     */
    protected function _initialize()
    {
        $this->_addField("idListaMenuSub", "idListaMenuSub", "int", 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->_addField('idMenu', 'idMenu', 'int', 11, array('foreign' => '1', 'onUpdate' => 'CASCADE', 'onDelete' => 'CASCADE', 'linkOn' => 'idMenu', 'class' => 'Menus'));
        $this->_addField('idSubMenu', 'idSubMenu', 'int', 11, array('foreign' => '1', 'onUpdate' => 'CASCADE', 'onDelete' => 'CASCADE', 'linkOn' => 'idSubMenu', 'class' => 'Submenus'));
        
    }
	
    /**
     * Recupera um objeto estaticamente
     * @author Jo�o Batista Padilha e Silva
     * @return Pessoa
     */
    public static function staticGet($pk, $pkValue = null)
    {
        $obj = new Listamenusub();
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
	 * @return the $idListaMenuSub
	 */
	public function getIdListaMenuSub() {
		return $this->idListaMenuSub;
	}

	/**
	 * @return the $idMenu
	 */
	public function getIdMenu() {
		return $this->idMenu;
	}

	/**
	 * @return the $idSubMenu
	 */
	public function getIdSubMenu() {
		return $this->idSubMenu;
	}

	/**
	 * @param $idListaMenuSub the $idListaMenuSub to set
	 */
	public function setIdListaMenuSub($idListaMenuSub) {
		$this->idListaMenuSub = $idListaMenuSub;
	}

	/**
	 * @param $idMenu the $idMenu to set
	 */
	public function setIdMenu($idMenu) {
		$this->idMenu = $idMenu;
	}

	/**
	 * @param $idSubMenu the $idSubMenu to set
	 */
	public function setIdSubMenu($idSubMenu) {
		$this->idSubMenu = $idSubMenu;
	}

	
	
	
}

?>