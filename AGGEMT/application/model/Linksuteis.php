<?php

class Linksuteis extends Lumine_Base {
	
	protected $_tablename = 'linksuteis';
    protected $_package   = 'model';
    
    public $idlinksuteis = null;
    public $descricaolinksuteis = null;
    public $link = null;
    public $idanexo = null;
    
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
        $this->_addField('idanexo', 'idanexo', 'int', 11, array('notnull' => false, 'foreign' => '1', 'onUpdate' => 'CASCADE', 'onDelete' => 'RESTRICT', 'linkOn' => 'idanexo', 'class' => 'Anexos'));
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
	 * @return the $idanexo
	 */
	public function getIdanexo() {
		return $this->idanexo;
	}

	/**
	 * @param field_type $idanexo
	 */
	public function setIdanexo($idanexo) {
		$this->idanexo = $idanexo;
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
		
		return parent::validate();
	}
	
	
}

?>