<?php

class Anexos extends Lumine_Base {
	
	protected $_tablename = 'anexos';
    protected $_package   = 'model';
	
    public $idanexo = null;
    public $nomeanexo = null;
    public $caminhoanexo = null;
    public $linkanexo = null;
    public $tipoanexo = 0;
    
	/**
     * Inicia os valores da classe
     * @author Jo�o Batista Padilha e Silva
     * @return void
     */
    protected function _initialize()
    {
        
        $this->_addField("idanexo", "idanexo", "int", 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->_addField("nomeanexo", "nomeanexo", "varchar", 255, array('notnull' => true));
        $this->_addField('caminhoanexo', 'caminhoanexo', 'varchar', 255, array('notnull' => false));
        $this->_addField("linkanexo", "linkanexo", "varchar", 255, array('notnull' => false));
        $this->_addField("tipoanexo", "tipoanexo", "int", 1, array('notnull' => false));
        
        $this->_addForeignRelation('submenu', self::ONE_TO_MANY, 'Submenu', 'idanexo', null, null, null);
        $this->_addForeignRelation('linkuteis', self::ONE_TO_MANY, 'Linksuteis', 'idanexo', null, null, null);
    }

    /**
     * Recupera um objeto estaticamente
     * @author Jo�o Batista Padilha e Silva
     * @return Pessoa
     */
    public static function staticGet($pk, $pkValue = null)
    {
        $obj = new Anexos();
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
	 * @return the $idanexo
	 */
	public function getIdanexo() {
		return $this->idanexo;
	}

	/**
	 * @return the $nomeanexo
	 */
	public function getNomeanexo() {
		return $this->nomeanexo;
	}

	/**
	 * @return the $caminhoanexo
	 */
	public function getCaminhoanexo() {
		return $this->caminhoanexo;
	}

	/**
	 * @return the $linkanexo
	 */
	public function getLinkanexo() {
		return $this->linkanexo;
	}

	/**
	 * @param field_type $idanexo
	 */
	public function setIdanexo($idanexo) {
		$this->idanexo = $idanexo;
	}

	/**
	 * @param field_type $nomeanexo
	 */
	public function setNomeanexo($nomeanexo) {
		$this->nomeanexo = $nomeanexo;
	}

	/**
	 * @param field_type $caminhoanexo
	 */
	public function setCaminhoanexo($caminhoanexo) {
		$this->caminhoanexo = $caminhoanexo;
	}

	/**
	 * @param field_type $linkanexo
	 */
	public function setLinkanexo($linkanexo) {
		$this->linkanexo = $linkanexo;
	}
	
	/**
	 * @return the $tipoanexo
	 */
	public function getTipoanexo() {
		return $this->tipoanexo;
	}

	/**
	 * @param field_type $tipoanexo
	 */
	public function setTipoanexo($tipoanexo) {
		$this->tipoanexo = $tipoanexo;
	}

	public function validate(){
		
		// limpa os validators anteriores
		Lumine_Validator_PHPValidator::clearValidations($this);
		
		// adicionando as regras 
		Lumine_Validator_PHPValidator::addValidation($this, 'nomeanexo', Lumine_Validator::REQUIRED_STRING, 'Informe o nome do anexo');
		
		return parent::validate();
	}
	
    
}

?>