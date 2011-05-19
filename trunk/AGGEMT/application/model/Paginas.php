<?php

class Paginas extends Lumine_Base {
	
	protected $_tablename = 'paginas';
    protected $_package   = 'model';
    
    public $idpagina = null;
    public $nomepagina = null;
    public $descricaopagina = null;
    
/**
     * Inicia os valores da classe
     * @author João Batista Padilha e Silva
     * @return void
     */
    protected function _initialize()
    {
        
        $this->_addField("idpagina", "idpagina", "int", 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->_addField("nomepagina", "nomepagina", "datetime", null, array('notnull' => true));
        $this->_addField("descricaopagina", "descricaopagina", "text", null, array('notnull' => false));
		
        $this->_addForeignRelation('menu', self::ONE_TO_MANY, 'Menu', 'idpagina', null, null, null);
        $this->_addForeignRelation('submenu', self::ONE_TO_MANY, 'Submenu', 'idpagina', null, null, null);
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
	
	/**
	 * @return the $idpagina
	 */
	public function getIdpagina() {
		return $this->idpagina;
	}

	/**
	 * @return the $nomepagina
	 */
	public function getNomepagina() {
		return $this->nomepagina;
	}

	/**
	 * @return the $descricaopagina
	 */
	public function getDescricaopagina() {
		return $this->descricaopagina;
	}

	/**
	 * @param field_type $idpagina
	 */
	public function setIdpagina($idpagina) {
		$this->idpagina = $idpagina;
	}

	/**
	 * @param field_type $nomepagina
	 */
	public function setNomepagina($nomepagina) {
		$this->nomepagina = $nomepagina;
	}

	/**
	 * @param field_type $descricaopagina
	 */
	public function setDescricaopagina($descricaopagina) {
		$this->descricaopagina = $descricaopagina;
	}

	public function validate(){
		
		// limpa os validators anteriores
		Lumine_Validator_PHPValidator::clearValidations($this);
		
		// adicionando as regras 
		Lumine_Validator_PHPValidator::addValidation($this, 'nomepagina', Lumine_Validator::REQUIRED_STRING, 'Informe o nome da p�gina');
		
		return parent::validate();
	}
	
	/**
	 * 
	 * Verifica se a página está sendo utilizada em algum menu
	 * @return boolean
	 */
	public function paginaEhUtilizada()
	{
		$menu = new Menu();
		$menu->setIdpagina($this->getIdpagina());
		if($menu->find()>0)
		{
			return true;
		}
		else {
			$submenu = new Submenu();
			$submenu->setIdpagina($this->getIdpagina());
			if($submenu->find()>0)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}
	
}

?>