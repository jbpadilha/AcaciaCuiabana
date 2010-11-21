<?php

class Endereco extends Lumine_Base{

	// sobrecarga
    protected $_tablename = 'endereco';
    protected $_package   = 'application';
    
	public $idendereco;
	public $idpessoa;
	public $logradouroendereco;		 	 	 	 	 	 	 
	public $complementoendereco;		 	 	 	 	 	 	 
	public $bairroendereco;		 	 	 	 	 	 	 
	public $numeroendereco;		 	 	 	 	 	 	 
	public $cependereco;		 	 	 	 	 	 	 
	public $cidadeendereco;		 	 	 	 	 	 	 
	public $estadoendereco;		 	 	 	 	 	 	 
	public $telefoneendereco;		 	 	 	 	 	 	 
	public $referenciaendereco;
	
	/**
     * Inicia os valores da classe
     * @author João Batista Padilha e Silva
     * @return void
     */
    protected function _initialize()
    {
		# 
        
        $this->_addField("idendereco", "idendereco", "int", 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->_addField('idpessoa', 'idpessoa', 'int', 11, array('foreign' => '1', 'onUpdate' => 'CASCADE', 'onDelete' => 'CASCADE', 'linkOn' => 'idpessoa', 'class' => 'Pessoa'));
        $this->_addField("logradouroendereco", "logradouroendereco", "varchar", 255, array('notnull' => true));
        $this->_addField("complementoendereco", "complementoendereco", "varchar", 255, array('notnull' => false));
        $this->_addField("bairroendereco", "bairroendereco", "varchar", 255, array('notnull' => false));
        $this->_addField("numeroendereco", "numeroendereco", "varchar", 255, array('notnull' => false));
        $this->_addField("cependereco", "cependereco", "varchar", 255, array('notnull' => true));
        $this->_addField("cidadeendereco", "cidadeendereco", "varchar", 255, array('notnull' => true));
        $this->_addField("estadoendereco", "estadoendereco", "varchar", 255, array('notnull' => true));
        $this->_addField("telefoneendereco", "telefoneendereco", "varchar", 255, array('notnull' => false));
        $this->_addField("referenciaendereco", "referenciaendereco", "varchar", 255, array('notnull' => false));
        
    }

    /**
     * Recupera um objeto estaticamente
     * @author João Batista Padilha e Silva
     * @return Pessoa
     */
    public static function staticGet($pk, $pkValue = null)
    {
        $obj = new Endereco();
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
	 * @return the $idendereco
	 */
	public function getIdendereco() {
		return $this->idendereco;
	}

	/**
	 * @return the $idpessoa
	 */
	public function getIdpessoa() {
		return $this->idpessoa;
	}

	/**
	 * @return the $logradouroendereco
	 */
	public function getLogradouroendereco() {
		return $this->logradouroendereco;
	}

	/**
	 * @return the $complementoendereco
	 */
	public function getComplementoendereco() {
		return $this->complementoendereco;
	}

	/**
	 * @return the $bairroendereco
	 */
	public function getBairroendereco() {
		return $this->bairroendereco;
	}

	/**
	 * @return the $numeroendereco
	 */
	public function getNumeroendereco() {
		return $this->numeroendereco;
	}

	/**
	 * @return the $cependereco
	 */
	public function getCependereco() {
		return $this->cependereco;
	}

	/**
	 * @return the $cidadeendereco
	 */
	public function getCidadeendereco() {
		return $this->cidadeendereco;
	}

	/**
	 * @return the $estadoendereco
	 */
	public function getEstadoendereco() {
		return $this->estadoendereco;
	}

	/**
	 * @return the $telefoneendereco
	 */
	public function getTelefoneendereco() {
		return $this->telefoneendereco;
	}

	/**
	 * @return the $referenciaendereco
	 */
	public function getReferenciaendereco() {
		return $this->referenciaendereco;
	}

	/**
	 * @param $idendereco the $idendereco to set
	 */
	public function setIdendereco($idendereco) {
		$this->idendereco = $idendereco;
	}

	/**
	 * @param $idpessoa the $idpessoa to set
	 */
	public function setIdpessoa($idpessoa) {
		$this->idpessoa = $idpessoa;
	}

	/**
	 * @param $logradouroendereco the $logradouroendereco to set
	 */
	public function setLogradouroendereco($logradouroendereco) {
		$this->logradouroendereco = $logradouroendereco;
	}

	/**
	 * @param $complementoendereco the $complementoendereco to set
	 */
	public function setComplementoendereco($complementoendereco) {
		$this->complementoendereco = $complementoendereco;
	}

	/**
	 * @param $bairroendereco the $bairroendereco to set
	 */
	public function setBairroendereco($bairroendereco) {
		$this->bairroendereco = $bairroendereco;
	}

	/**
	 * @param $numeroendereco the $numeroendereco to set
	 */
	public function setNumeroendereco($numeroendereco) {
		$this->numeroendereco = $numeroendereco;
	}

	/**
	 * @param $cependereco the $cependereco to set
	 */
	public function setCependereco($cependereco) {
		$this->cependereco = $cependereco;
	}

	/**
	 * @param $cidadeendereco the $cidadeendereco to set
	 */
	public function setCidadeendereco($cidadeendereco) {
		$this->cidadeendereco = $cidadeendereco;
	}

	/**
	 * @param $estadoendereco the $estadoendereco to set
	 */
	public function setEstadoendereco($estadoendereco) {
		$this->estadoendereco = $estadoendereco;
	}

	/**
	 * @param $telefoneendereco the $telefoneendereco to set
	 */
	public function setTelefoneendereco($telefoneendereco) {
		$this->telefoneendereco = $telefoneendereco;
	}

	/**
	 * @param $referenciaendereco the $referenciaendereco to set
	 */
	public function setReferenciaendereco($referenciaendereco) {
		$this->referenciaendereco = $referenciaendereco;
	}

	
    #------------------------------------------------------#
    # Coloque todos os metodos personalizados abaixo de    #
    # END AUTOCODE                                         #
    #------------------------------------------------------#
    #### END AUTOCODE
}

?>