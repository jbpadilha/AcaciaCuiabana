<?php

class Agenda extends Lumine_Base {

	protected $_tablename = 'anexos';
    protected $_package   = 'model';
	
    public $idagenda;
    public $tituloagenda;
    public $dataagenda;
    public $descricaoagenda;
    
	/**
     * Inicia os valores da classe
     * @author Jo�o Batista Padilha e Silva
     * @return void
     */
    protected function _initialize()
    {
        
        $this->_addField("idagenda", "idagenda", "int", 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->_addField("tituloagenda", "tituloagenda", "varchar", 255, array('notnull' => true));
        $this->_addField('dataagenda', 'dataagenda', 'datetime', null, array('notnull' => true));
        $this->_addField("descricaoagenda", "descricaoagenda", "varchar", 255, array('notnull' => false));
        
    }

    /**
     * Recupera um objeto estaticamente
     * @author Jo�o Batista Padilha e Silva
     * @return Pessoa
     */
    public static function staticGet($pk, $pkValue = null)
    {
        $obj = new Agenda();
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
	 * @return the $idagenda
	 */
	public function getIdagenda() {
		return $this->idagenda;
	}

	/**
	 * @return the $tituloagenda
	 */
	public function getTituloagenda() {
		return $this->tituloagenda;
	}

	/**
	 * @return the $dataagenda
	 */
	public function getDataagenda() {
		return $this->dataagenda;
	}

	/**
	 * @return the $descricaoagenda
	 */
	public function getDescricaoagenda() {
		return $this->descricaoagenda;
	}

	/**
	 * @param field_type $idagenda
	 */
	public function setIdagenda($idagenda) {
		$this->idagenda = $idagenda;
	}

	/**
	 * @param field_type $tituloagenda
	 */
	public function setTituloagenda($tituloagenda) {
		$this->tituloagenda = $tituloagenda;
	}

	/**
	 * @param field_type $dataagenda
	 */
	public function setDataagenda($dataagenda) {
		$this->dataagenda = $dataagenda;
	}

	/**
	 * @param field_type $descricaoagenda
	 */
	public function setDescricaoagenda($descricaoagenda) {
		$this->descricaoagenda = $descricaoagenda;
	}

	public function validate(){
		
		// limpa os validators anteriores
		Lumine_Validator_PHPValidator::clearValidations($this);
		
		// adicionando as regras 
		Lumine_Validator_PHPValidator::addValidation($this, 'tituloagenda', Lumine_Validator::REQUIRED_STRING, 'Informe o t�tulo da agenda');
		Lumine_Validator_PHPValidator::addValidation($this, 'dataagenda', Lumine_Validator::REQUIRED_DATE, 'Informe a data da agenda');
		
		return parent::validate();
	}
	
}

?>