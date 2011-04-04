<?php

class Linksuteis extends Lumine_Base {
	
	protected $_tablename = 'linksuteis';
    protected $_package   = 'model';
    
    public $idlinksuteis = null;
    public $descricaolinksuteis = null;
    public $link = null;
    
	/**
     * Inicia os valores da classe
     * @author Jo�o Batista Padilha e Silva
     * @return void
     */
    protected function _initialize()
    {
        
        $this->_addField("idlinksuteis", "idlinksuteis", "int", 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->_addField("descricaolinksuteis", "descricaolinksuteis", "varchar", 255, array('notnull' => true));
        $this->_addField('link', 'link', 'varchar', 255, array('notnull' => true));
        
    }

    /**
     * Recupera um objeto estaticamente
     * @author Jo�o Batista Padilha e Silva
     * @return Pessoa
     */
    public static function staticGet($pk, $pkValue = null)
    {
        $obj = new Linksuteis();
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
	 * @return the $idlinksuteis
	 */
	public function getIdlinksuteis() {
		return $this->idlinksuteis;
	}

	/**
	 * @return the $descricaolinksuteis
	 */
	public function getDescricaolinksuteis() {
		return $this->descricaolinksuteis;
	}

	/**
	 * @return the $link
	 */
	public function getLink() {
		return $this->link;
	}

	/**
	 * @param field_type $idlinksuteis
	 */
	public function setIdlinksuteis($idlinksuteis) {
		$this->idlinksuteis = $idlinksuteis;
	}

	/**
	 * @param field_type $descricaolinksuteis
	 */
	public function setDescricaolinksuteis($descricaolinksuteis) {
		$this->descricaolinksuteis = $descricaolinksuteis;
	}

	/**
	 * @param field_type $link
	 */
	public function setLink($link) {
		$this->link = $link;
	}

	public function validate(){
		
		// limpa os validators anteriores
		Lumine_Validator_PHPValidator::clearValidations($this);
		
		// adicionando as regras 
		Lumine_Validator_PHPValidator::addValidation($this, 'descricaolinksuteis', Lumine_Validator::REQUIRED_STRING, 'Informe a descricao do link');
		Lumine_Validator_PHPValidator::addValidation($this, 'link', Lumine_Validator::REQUIRED_STRING, 'Informe um link para um site');
		
		return parent::validate();
	}
	
	
}

?>