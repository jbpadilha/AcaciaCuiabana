<?php

class Agenda extends Lumine_Base {

	protected $_tablename = 'agenda';
    protected $_package   = 'model';
	
    public $idagenda = null;
    public $tituloagenda = null;
    public $dataagenda = null;
    public $descricaoagenda = null;
    
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
	
	public function toDataAgendaDB()
	{
		if($this->getDataagenda())
		{
			$dataHora = explode(" ",$this->getDataagenda());
			$data = explode("-",$dataHora[0]);
			return $data[2]."-".$data[1]."-".$data[0]." ".$dataHora[1];
		}
		else
		{
			return null;
		}
	}
	
	public function getDataAgendaFormatado()
	{
		if($this->getDataagenda()!=null)
		{
			$dataHora = explode(" ",$this->getDataagenda());
			$data = explode("-",$dataHora[0]);
			$dataRetorno = $data[2]."/".$data[1]."/".$data[0]." ".$dataHora[1];
			return $dataRetorno;
		}
		else
		{
			return "";
		}
	}
	
}

?>