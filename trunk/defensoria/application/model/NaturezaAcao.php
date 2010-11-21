<?php

class NaturezaAcao extends Lumine_Base{
	
	// sobrecarga
    protected $_tablename = 'naturezaacao';
    protected $_package   = 'application';
    
	public $idnaturezaacao;
	public $naturezaacao;
	
	/**
     * Inicia os valores da classe
     * @author João Batista Padilha e Silva
     * @return void
     */
    protected function _initialize()
    {
		# idnaturezaacao, naturezaacao
        
        $this->_addField("idnaturezaacao", "iddependente", "int", 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->_addField("naturezaacao", "nomedependente", "varchar", 255, array('notnull' => true));
    }

    /**
     * Recupera um objeto estaticamente
     * @author João Batista Padilha e Silva
     * @return Pessoa
     */
    public static function staticGet($pk, $pkValue = null)
    {
        $obj = new NaturezaAcao();
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
	 * @return the $idnaturezaacao
	 */
	public function getIdnaturezaacao() {
		return $this->idnaturezaacao;
	}

	/**
	 * @return the $naturezaacao
	 */
	public function getNaturezaacao() {
		return $this->naturezaacao;
	}

	/**
	 * @param $idnaturezaacao the $idnaturezaacao to set
	 */
	public function setIdnaturezaacao($idnaturezaacao) {
		$this->idnaturezaacao = $idnaturezaacao;
	}

	/**
	 * @param $naturezaacao the $naturezaacao to set
	 */
	public function setNaturezaacao($naturezaacao) {
		$this->naturezaacao = $naturezaacao;
	}

	
    #------------------------------------------------------#
    # Coloque todos os metodos personalizados abaixo de    #
    # END AUTOCODE                                         #
    #------------------------------------------------------#
    #### END AUTOCODE

}

?>