<?php

class Comarca extends Lumine_Base{
	
	// sobrecarga
    protected $_tablename = 'comarca';
    protected $_package   = 'application';
    
	public $idcomarca;
	public $nomecomarca;
	
	/**
     * Inicia os valores da classe
     * @author João Batista Padilha e Silva
     * @return void
     */
    protected function _initialize()
    {
		# idcomarca, nomecomarca
        
        $this->_addField("idcomarca", "idcomarca", "int", 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->_addField("nomecomarca", "nomecomarca", "varchar", 255, array('notnull' => true));
        
        $this->_addForeignRelation('nucleos', self::ONE_TO_MANY, 'Nucleo', 'idcomarca', null, null, null);
        $this->_addForeignRelation('processos', self::ONE_TO_MANY, 'Processo', 'idcomarca', null, null, null);
        $this->_addForeignRelation('varas', self::ONE_TO_MANY, 'Vara', 'idcomarca', null, null, null);
    }

    /**
     * Recupera um objeto estaticamente
     * @author João Batista Padilha e Silva
     * @return Pessoa
     */
    public static function staticGet($pk, $pkValue = null)
    {
        $obj = new Comarca();
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
	 * @return the $idcomarca
	 */
	public function getIdcomarca() {
		return $this->idcomarca;
	}

	/**
	 * @return the $nomecomarca
	 */
	public function getNomecomarca() {
		return $this->nomecomarca;
	}

	/**
	 * @param $idcomarca the $idcomarca to set
	 */
	public function setIdcomarca($idcomarca) {
		$this->idcomarca = $idcomarca;
	}

	/**
	 * @param $nomecomarca the $nomecomarca to set
	 */
	public function setNomecomarca($nomecomarca) {
		$this->nomecomarca = $nomecomarca;
	}

	
    #------------------------------------------------------#
    # Coloque todos os metodos personalizados abaixo de    #
    # END AUTOCODE                                         #
    #------------------------------------------------------#
    #### END AUTOCODE

}

?>