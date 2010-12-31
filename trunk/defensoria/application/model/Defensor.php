<?php

class Defensor extends Lumine_Base{
	
	// sobrecarga
    protected $_tablename = 'defensor';
    protected $_package   = 'model';
    
	public $iddefensor;
	public $idpessoa;
	public $oabdefensor;
	public $compoabdefensor;
	public $estadooabdefensor;
	
	/**
     * Inicia os valores da classe
     * @author João Batista Padilha e Silva
     * @return void
     */
    protected function _initialize()
    {
		# iddefensor, idpessoa, oabdefensor, compoabdefensor, estadooabdefensor
        
        $this->_addField("iddefensor", "iddefensor", "int", 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->_addField('idpessoa', 'idpessoa', 'int', 11, array('foreign' => '1', 'onUpdate' => 'CASCADE', 'onDelete' => 'CASCADE', 'linkOn' => 'idpessoa', 'class' => 'Pessoa'));
        $this->_addField("oabdefensor", "oabdefensor", "int", 11, array('notnull' => true));
        $this->_addField("compoabdefensor", "compoabdefensor", "varchar", 1, array('notnull' => true));
        $this->_addField("estadooabdefensor", "estadooabdefensor", "varchar", 2, array('notnull' => true));
        
        $this->_addForeignRelation('cartasconvites', self::ONE_TO_MANY, 'CartasConvites', 'idcartaconvite', null, null, null);
        $this->_addForeignRelation('partesprocesso', self::ONE_TO_MANY, 'ParteProcesso', 'idparteprocesso', null, null, null);
    }

    /**
     * Recupera um objeto estaticamente
     * @author João Batista Padilha e Silva
     * @return Pessoa
     */
    public static function staticGet($pk, $pkValue = null)
    {
        $obj = new Defensor();
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
	 * @return the $iddefensor
	 */
	public function getIddefensor() {
		return $this->iddefensor;
	}

	/**
	 * @return the $idpessoa
	 */
	public function getIdpessoa() {
		return $this->idpessoa;
	}

	/**
	 * @return the $oabdefensor
	 */
	public function getOabdefensor() {
		return $this->oabdefensor;
	}

	/**
	 * @return the $compoabdefensor
	 */
	public function getCompoabdefensor() {
		return $this->compoabdefensor;
	}

	/**
	 * @return the $estadooabdefensor
	 */
	public function getEstadooabdefensor() {
		return $this->estadooabdefensor;
	}

	/**
	 * @param $iddefensor the $iddefensor to set
	 */
	public function setIddefensor($iddefensor) {
		$this->iddefensor = $iddefensor;
	}

	/**
	 * @param $idpessoa the $idpessoa to set
	 */
	public function setIdpessoa($idpessoa) {
		$this->idpessoa = $idpessoa;
	}

	/**
	 * @param $oabdefensor the $oabdefensor to set
	 */
	public function setOabdefensor($oabdefensor) {
		$this->oabdefensor = $oabdefensor;
	}

	/**
	 * @param $compoabdefensor the $compoabdefensor to set
	 */
	public function setCompoabdefensor($compoabdefensor) {
		$this->compoabdefensor = $compoabdefensor;
	}

	/**
	 * @param $estadooabdefensor the $estadooabdefensor to set
	 */
	public function setEstadooabdefensor($estadooabdefensor) {
		$this->estadooabdefensor = $estadooabdefensor;
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
		Lumine_Validator_PHPValidator::addValidation($this, 'oabdefensor', Lumine_Validator::REQUIRED_NUMBER, 'Informe a OAB do defensor');
		Lumine_Validator_PHPValidator::addValidation($this, 'compoabdefensor', Lumine_Validator::REQUIRED_STRING, 'Informe o complemento da OAB');
		Lumine_Validator_PHPValidator::addValidation($this, 'estadooabdefensor', Lumine_Validator::REQUIRED_STRING, 'Informe o estado da OAB');
		
		return parent::validate();
	}
}

?>