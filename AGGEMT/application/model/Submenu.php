<?php

class Submenu extends Lumine_Base {
	
	protected $_tablename = 'submenu';
    protected $_package   = 'model';
    
    public $idsubmenu = null;
    public $descricaosubmenu = null;
    public $idpagina = null;
    public $idanexo = null;
    public $linksubmenu = null;
    public $idmenu = null;
    
/**
     * Inicia os valores da classe
     * @author Jo�o Batista Padilha e Silva
     * @return void
     */
    protected function _initialize()
    {
        
        $this->_addField("idsubmenu", "idsubmenu", "int", 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->_addField("descricaosubmenu", "descricaosubmenu", "varchar", 255, array('notnull' => true));
        $this->_addField('idpagina', 'idpagina', 'int', 11, array('notnull' => false, 'foreign' => '1', 'onUpdate' => 'CASCADE', 'onDelete' => 'RESTRICT', 'linkOn' => 'idpagina', 'class' => 'Paginas'));
        $this->_addField('idanexo', 'idanexo', 'int', 11, array('notnull' => false, 'foreign' => '1', 'onUpdate' => 'CASCADE', 'onDelete' => 'RESTRICT', 'linkOn' => 'idanexo', 'class' => 'Anexos'));
        $this->_addField("linksubmenu", "linksubmenu", "varchar", 255, array('notnull' => false));
        $this->_addField('idmenu', 'idmenu', 'int', 11, array('notnull' => true, 'foreign' => '1', 'onUpdate' => 'CASCADE', 'onDelete' => 'RESTRICT', 'linkOn' => 'idmenu', 'class' => 'Menu'));
        
    }

    /**
     * Recupera um objeto estaticamente
     * @author Jo�o Batista Padilha e Silva
     * @return Pessoa
     */
    public static function staticGet($pk, $pkValue = null)
    {
        $obj = new Submenu();
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
	 * @return the $idsubmenu
	 */
	public function getIdsubmenu() {
		return $this->idsubmenu;
	}

	/**
	 * @return the $descricaosubmenu
	 */
	public function getDescricaosubmenu() {
		return $this->descricaosubmenu;
	}

	/**
	 * @return the $idpagina
	 */
	public function getIdpagina() {
		return $this->idpagina;
	}

	/**
	 * @return the $idanexo
	 */
	public function getIdanexo() {
		return $this->idanexo;
	}

	/**
	 * @return the $linksubmenu
	 */
	public function getLinksubmenu() {
		return $this->linksubmenu;
	}

	/**
	 * @return the $idmenu
	 */
	public function getIdmenu() {
		return $this->idmenu;
	}

	/**
	 * @param field_type $idsubmenu
	 */
	public function setIdsubmenu($idsubmenu) {
		$this->idsubmenu = $idsubmenu;
	}

	/**
	 * @param field_type $descricaosubmenu
	 */
	public function setDescricaosubmenu($descricaosubmenu) {
		$this->descricaosubmenu = $descricaosubmenu;
	}

	/**
	 * @param field_type $idpagina
	 */
	public function setIdpagina($idpagina) {
		$this->idpagina = $idpagina;
	}

	/**
	 * @param field_type $idanexo
	 */
	public function setIdanexo($idanexo) {
		$this->idanexo = $idanexo;
	}

	/**
	 * @param field_type $linksubmenu
	 */
	public function setLinksubmenu($linksubmenu) {
		$this->linksubmenu = $linksubmenu;
	}

	/**
	 * @param field_type $idmenu
	 */
	public function setIdmenu($idmenu) {
		$this->idmenu = $idmenu;
	}

	public function validate(){
		
		// limpa os validators anteriores
		Lumine_Validator_PHPValidator::clearValidations($this);
		
		// adicionando as regras 
		Lumine_Validator_PHPValidator::addValidation($this, 'descricaosubmenu', Lumine_Validator::REQUIRED_STRING, 'Informe a descrição do Sub-menu');
		Lumine_Validator_PHPValidator::addValidation($this, 'idmenu', Lumine_Validator::REQUIRED_NUMBER, 'Informe menu relacionado');
		
		return parent::validate();
	}
	
	/**
	 * 
	 * Retorno do Menu Relacionado
	 * @return Menu
	 */
	public function getMenu()
	{
		$menu = new Menu();
		if($this->getIdmenu()!=null)
		{
			$menu->setIdmenu($this->getIdmenu());
			$menu->find(true);
		}
		return $menu;
	}
}

?>