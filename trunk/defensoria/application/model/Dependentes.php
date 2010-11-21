<?php

class Dependentes extends Lumine_Base {

	// sobrecarga
    protected $_tablename = 'dependentes';
    protected $_package   = 'application';
    
	public $iddependente;
	public $nomedependente;
	public $idpessoa;
	
	/**
     * Inicia os valores da classe
     * @author João Batista Padilha e Silva
     * @return void
     */
    protected function _initialize()
    {
		# iddependente, nomedependente, idpessoa
        
        $this->_addField("iddependente", "iddependente", "int", 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->_addField("nomedependente", "nomedependente", "varchar", 255, array('notnull' => true));
        $this->_addField('idpessoa', 'idpessoa', 'int', 11, array('foreign' => '1', 'onUpdate' => 'CASCADE', 'onDelete' => 'CASCADE', 'linkOn' => 'idpessoa', 'class' => 'Pessoa'));
    }

    /**
     * Recupera um objeto estaticamente
     * @author João Batista Padilha e Silva
     * @return Pessoa
     */
    public static function staticGet($pk, $pkValue = null)
    {
        $obj = new Dependentes();
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
	 * @return the $iddependente
	 */
	public function getIddependente() {
		return $this->iddependente;
	}

	/**
	 * @return the $nomedependente
	 */
	public function getNomedependente() {
		return $this->nomedependente;
	}

	/**
	 * @return the $idpessoa
	 */
	public function getIdpessoa() {
		return $this->idpessoa;
	}

	/**
	 * @param $iddependente the $iddependente to set
	 */
	public function setIddependente($iddependente) {
		$this->iddependente = $iddependente;
	}

	/**
	 * @param $nomedependente the $nomedependente to set
	 */
	public function setNomedependente($nomedependente) {
		$this->nomedependente = $nomedependente;
	}

	/**
	 * @param $idpessoa the $idpessoa to set
	 */
	public function setIdpessoa($idpessoa) {
		$this->idpessoa = $idpessoa;
	}

	
    #------------------------------------------------------#
    # Coloque todos os metodos personalizados abaixo de    #
    # END AUTOCODE                                         #
    #------------------------------------------------------#
    #### END AUTOCODE
    
}

?>