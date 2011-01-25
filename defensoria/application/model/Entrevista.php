<?php

class Entrevista extends Lumine_Base{
	
	// sobrecarga
    protected $_tablename = 'entrevista';
    protected $_package   = 'model';
    
	public $identrevista;	 	 	 	 	 	 	
	public $dataentrevista;		 	 	 	 	 	 	
	public $idprocesso;		 	 	 	 	 	 	
	public $assuntoentrevista;		 	 	 				 
	public $protocoloatendimento;
	
	/**
     * Inicia os valores da classe
     * @author Jo�o Batista Padilha e Silva
     * @return void
     */
    protected function _initialize()
    {
        $this->_addField("identrevista", "identrevista", "int", 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->_addField("dataentrevista", "dataentrevista", "datetime", null, array('notnull' => true));
        $this->_addField('idprocesso', 'idprocesso', 'int', 11, array('foreign' => '1', 'onUpdate' => 'CASCADE', 'onDelete' => 'CASCADE', 'linkOn' => 'idprocesso', 'class' => 'Processo'));
        $this->_addField("assuntoentrevista", "assuntoentrevista", "varchar", 255, array('notnull' => true));
        $this->_addField("protocoloatendimento", "protocoloatendimento", "varchar", 255, array('notnull' => true));        
    }

    /**
     * Recupera um objeto estaticamente
     * @author Jo�o Batista Padilha e Silva
     * @return Pessoa
     */
    public static function staticGet($pk, $pkValue = null)
    {
        $obj = new Entrevista();
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
	 * @return the $identrevista
	 */
	public function getIdentrevista() {
		return $this->identrevista;
	}

	/**
	 * @return the $dataentrevista
	 */
	public function getDataentrevista() {
		return $this->dataentrevista;
	}

	/**
	 * @return the $idprocesso
	 */
	public function getIdprocesso() {
		return $this->idprocesso;
	}

	/**
	 * @return the $assuntoentrevista
	 */
	public function getAssuntoentrevista() {
		return $this->assuntoentrevista;
	}

	/**
	 * @return the $protocoloatendimento
	 */
	public function getProtocoloatendimento() {
		return $this->protocoloatendimento;
	}

	/**
	 * @param $identrevista the $identrevista to set
	 */
	public function setIdentrevista($identrevista) {
		$this->identrevista = $identrevista;
	}

	/**
	 * @param $dataentrevista the $dataentrevista to set
	 */
	public function setDataentrevista($dataentrevista) {
		$this->dataentrevista = $dataentrevista;
	}

	/**
	 * @param $idprocesso the $idprocesso to set
	 */
	public function setIdprocesso($idprocesso) {
		$this->idprocesso = $idprocesso;
	}

	/**
	 * @param $assuntoentrevista the $assuntoentrevista to set
	 */
	public function setAssuntoentrevista($assuntoentrevista) {
		$this->assuntoentrevista = $assuntoentrevista;
	}

	/**
	 * @param $protocoloatendimento the $protocoloatendimento to set
	 */
	public function setProtocoloatendimento($protocoloatendimento) {
		$this->protocoloatendimento = $protocoloatendimento;
	}

	
    #------------------------------------------------------#
    # Coloque todos os metodos personalizados abaixo de    #
    # END AUTOCODE                                         #
    #------------------------------------------------------#
    #### END AUTOCODE
	public function validate(){
		
		// limpa os validators anteriores
		Lumine_Validator_PHPValidator::clearValidations($this);
		
		// adicionando as regras 
		Lumine_Validator_PHPValidator::addValidation($this, 'assuntoentrevista', Lumine_Validator::REQUIRED_STRING, 'Informe o assunto da entrevista');
		
		return parent::validate();
	}
	
	public function getDataEntrevistaFormatadoPDF()
	{
		if($this->getDataentrevista()!=null)
		{
			$dataHora = explode(" ",$this->getDataentrevista());
			$data = explode("-",$dataHora[0]);
			$dataRetorno = $data[2]."/".$data[1]."/".$data[0];
			return $dataRetorno . " às ".$dataHora[1];
		}
		else
		{
			return "";
		}
	}
	
	/**
	 * 
	 * @return Processo
	 */
	public function getProcesso()
	{
		$processo = new Processo();
		$processo->setIdprocesso($this->getIdprocesso());
		$processo->find(true);
		return $processo;
	}
}

?>