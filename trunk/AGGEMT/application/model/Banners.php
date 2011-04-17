<?php

class Banners extends Lumine_Base {

	// sobrecarga
    protected $_tablename = 'banner';
    protected $_package   = 'model';
	
	public $idbanner = null;
	public $nomebanner = null;
	public $caminhobanner = null;
	public $statusbanner = 0;

	/**
     * Inicia os valores da classe
     * @author Jo�o Batista Padilha e Silva
     * @return void
     */
    protected function _initialize()
    {
        
        $this->_addField("idbanner", "idbanner", "int", 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->_addField("nomebanner", "nomebanner", "varchar", 255, array('notnull' => true));
        $this->_addField("caminhobanner", "caminhobanner", "varchar", 255, array('notnull' => true));
        $this->_addField("statusbanner", "statusbanner", "int", 1, array('notnull' => false));

    }

    /**
     * Recupera um objeto estaticamente
     * @author Jo�o Batista Padilha e Silva
     * @return Pessoa
     */
    public static function staticGet($pk, $pkValue = null)
    {
        $obj = new Banners();
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
	 * @return the $idbanner
	 */
	public function getIdbanner() {
		return $this->idbanner;
	}

	/**
	 * @return the $caminhobanner
	 */
	public function getCaminhobanner() {
		return $this->caminhobanner;
	}

	/**
	 * @return the $statusbanner
	 */
	public function getStatusbanner() {
		return $this->statusbanner;
	}

	/**
	 * @param field_type $idbanner
	 */
	public function setIdbanner($idbanner) {
		$this->idbanner = $idbanner;
	}

	/**
	 * @param field_type $caminhobanner
	 */
	public function setCaminhobanner($caminhobanner) {
		$this->caminhobanner = $caminhobanner;
	}

	/**
	 * @param field_type $statusbanner
	 */
	public function setStatusbanner($statusbanner) {
		$this->statusbanner = $statusbanner;
	}

	/**
	 * @return the $nomebanner
	 */
	public function getNomebanner() {
		return $this->nomebanner;
	}

	/**
	 * @param field_type $nomebanner
	 */
	public function setNomebanner($nomebanner) {
		$this->nomebanner = $nomebanner;
	}

	public function validate(){
		
		// limpa os validators anteriores
		Lumine_Validator_PHPValidator::clearValidations($this);
		
		// adicionando as regras
		Lumine_Validator_PHPValidator::addValidation($this, 'nomebanner', Lumine_Validator::REQUIRED_STRING, 'Por favor, forneça o nome do banner.'); 
		
		return parent::validate();
	}
	
}

?>