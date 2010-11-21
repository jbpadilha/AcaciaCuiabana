<?php

class ParteProcesso extends Lumine_Base{
	
	// sobrecarga
    protected $_tablename = 'parteprocesso';
    protected $_package   = 'application';
    
	public $idparteprocesso;
	public $idpessoa;		 	 	 	 	 	 	
	public $tipoparte;		 	 	 	 	 	 	 
	public $idprocesso;		 	 	 	 	 	 	
	public $iddefensor;
	
	/**
     * Inicia os valores da classe
     * @author João Batista Padilha e Silva
     * @return void
     */
    protected function _initialize()
    {
		# idparteprocesso, idpessoa, tipoparte, idprocesso, iddefensor
        
        $this->_addField("idparteprocesso", "idparteprocesso", "int", 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->_addField('idpessoa', 'idpessoa', 'int', 11, array('foreign' => '1', 'onUpdate' => 'CASCADE', 'onDelete' => 'CASCADE', 'linkOn' => 'idpessoa', 'class' => 'Pessoa'));
        $this->_addField("tipoparte", "tipoparte", "varchar", 255, array('notnull' => true));
        $this->_addField('idprocesso', 'idprocesso', 'int', 11, array('foreign' => '1', 'onUpdate' => 'CASCADE', 'onDelete' => 'CASCADE', 'linkOn' => 'idprocesso', 'class' => 'Processo'));
        $this->_addField('iddefensor', 'iddefensor', 'int', 11, array('notnull' => false, 'foreign' => '1', 'onUpdate' => 'CASCADE', 'onDelete' => 'CASCADE', 'linkOn' => 'iddefensor', 'class' => 'Defensor'));
        
        $this->_addForeignRelation('cartasconvites', self::ONE_TO_MANY, 'CartasConvites', 'idcartaconvite', null, null, null);
        
    }

    /**
     * Recupera um objeto estaticamente
     * @author João Batista Padilha e Silva
     * @return Pessoa
     */
    public static function staticGet($pk, $pkValue = null)
    {
        $obj = new ParteProcesso();
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
	 * @return the $idparteprocesso
	 */
	public function getIdparteprocesso() {
		return $this->idparteprocesso;
	}

	/**
	 * @return the $idpessoa
	 */
	public function getIdpessoa() {
		return $this->idpessoa;
	}

	/**
	 * @return the $tipoparte
	 */
	public function getTipoparte() {
		return $this->tipoparte;
	}

	/**
	 * @return the $idprocesso
	 */
	public function getIdprocesso() {
		return $this->idprocesso;
	}

	/**
	 * @return the $iddefensor
	 */
	public function getIddefensor() {
		return $this->iddefensor;
	}

	/**
	 * @param $idparteprocesso the $idparteprocesso to set
	 */
	public function setIdparteprocesso($idparteprocesso) {
		$this->idparteprocesso = $idparteprocesso;
	}

	/**
	 * @param $idpessoa the $idpessoa to set
	 */
	public function setIdpessoa($idpessoa) {
		$this->idpessoa = $idpessoa;
	}

	/**
	 * @param $tipoparte the $tipoparte to set
	 */
	public function setTipoparte($tipoparte) {
		$this->tipoparte = $tipoparte;
	}

	/**
	 * @param $idprocesso the $idprocesso to set
	 */
	public function setIdprocesso($idprocesso) {
		$this->idprocesso = $idprocesso;
	}

	/**
	 * @param $iddefensor the $iddefensor to set
	 */
	public function setIddefensor($iddefensor) {
		$this->iddefensor = $iddefensor;
	}

	
    #------------------------------------------------------#
    # Coloque todos os metodos personalizados abaixo de    #
    # END AUTOCODE                                         #
    #------------------------------------------------------#
    #### END AUTOCODE

}

?>