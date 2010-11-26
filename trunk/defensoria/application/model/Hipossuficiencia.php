<?php

class Hipossuficiencia extends Lumine_Base{

	// sobrecarga
    protected $_tablename = 'hipossuficiencia';
    protected $_package   = 'model';
    
	public $idhipossuficiencia;
	public $idpessoa;
	public $profhipossuficiencia;
	public $salariohipossuficiencia;
	public $empresahipossuficiencia;
	public $totalrendahipossuficiencia;
	public $observacoeshipossuficiencia;
	
	/**
     * Inicia os valores da classe
     * @author João Batista Padilha e Silva
     * @return void
     */
    protected function _initialize()
    {
		# iddependente, nomedependente, idpessoa
        
        $this->_addField("idhipossuficiencia", "idhipossuficiencia", "int", 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->_addField('idpessoa', 'idpessoa', 'int', 11, array('foreign' => '1', 'onUpdate' => 'CASCADE', 'onDelete' => 'CASCADE', 'linkOn' => 'idpessoa', 'class' => 'Pessoa'));
        $this->_addField("profhipossuficiencia", "profhipossuficiencia", "varchar", 255, array('notnull' => false));
        $this->_addField("salariohipossuficiencia", "salariohipossuficiencia", "varchar", 255, array('notnull' => false));
        $this->_addField("empresahipossuficiencia", "empresahipossuficiencia", "varchar", 255, array('notnull' => false));
        $this->_addField("totalrendahipossuficiencia", "totalrendahipossuficiencia", "varchar", 255, array('notnull' => false));
        $this->_addField("observacoeshipossuficiencia", "observacoeshipossuficiencia", "varchar", 255, array('notnull' => false));
    }

    /**
     * Recupera um objeto estaticamente
     * @author João Batista Padilha e Silva
     * @return Pessoa
     */
    public static function staticGet($pk, $pkValue = null)
    {
        $obj = new Hipossuficiencia();
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
	 * @return the $idhipossuficiencia
	 */
	public function getIdhipossuficiencia() {
		return $this->idhipossuficiencia;
	}

	/**
	 * @return the $idpessoa
	 */
	public function getIdpessoa() {
		return $this->idpessoa;
	}

	/**
	 * @return the $profhipossuficiencia
	 */
	public function getProfhipossuficiencia() {
		return $this->profhipossuficiencia;
	}

	/**
	 * @return the $salariohipossuficiencia
	 */
	public function getSalariohipossuficiencia() {
		return $this->salariohipossuficiencia;
	}

	/**
	 * @return the $empresahipossuficiencia
	 */
	public function getEmpresahipossuficiencia() {
		return $this->empresahipossuficiencia;
	}

	/**
	 * @return the $totalrendahipossuficiencia
	 */
	public function getTotalrendahipossuficiencia() {
		return $this->totalrendahipossuficiencia;
	}

	/**
	 * @return the $observacoeshipossuficiencia
	 */
	public function getObservacoeshipossuficiencia() {
		return $this->observacoeshipossuficiencia;
	}

	/**
	 * @param $idhipossuficiencia the $idhipossuficiencia to set
	 */
	public function setIdhipossuficiencia($idhipossuficiencia) {
		$this->idhipossuficiencia = $idhipossuficiencia;
	}

	/**
	 * @param $idpessoa the $idpessoa to set
	 */
	public function setIdpessoa($idpessoa) {
		$this->idpessoa = $idpessoa;
	}

	/**
	 * @param $profhipossuficiencia the $profhipossuficiencia to set
	 */
	public function setProfhipossuficiencia($profhipossuficiencia) {
		$this->profhipossuficiencia = $profhipossuficiencia;
	}

	/**
	 * @param $salariohipossuficiencia the $salariohipossuficiencia to set
	 */
	public function setSalariohipossuficiencia($salariohipossuficiencia) {
		$this->salariohipossuficiencia = $salariohipossuficiencia;
	}

	/**
	 * @param $empresahipossuficiencia the $empresahipossuficiencia to set
	 */
	public function setEmpresahipossuficiencia($empresahipossuficiencia) {
		$this->empresahipossuficiencia = $empresahipossuficiencia;
	}

	/**
	 * @param $totalrendahipossuficiencia the $totalrendahipossuficiencia to set
	 */
	public function setTotalrendahipossuficiencia($totalrendahipossuficiencia) {
		$this->totalrendahipossuficiencia = $totalrendahipossuficiencia;
	}

	/**
	 * @param $observacoeshipossuficiencia the $observacoeshipossuficiencia to set
	 */
	public function setObservacoeshipossuficiencia($observacoeshipossuficiencia) {
		$this->observacoeshipossuficiencia = $observacoeshipossuficiencia;
	}

	
    #------------------------------------------------------#
    # Coloque todos os metodos personalizados abaixo de    #
    # END AUTOCODE                                         #
    #------------------------------------------------------#
    #### END AUTOCODE
}

?>