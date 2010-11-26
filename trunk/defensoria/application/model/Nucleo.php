<?php

class Nucleo extends Lumine_Base{

	// sobrecarga
    protected $_tablename = 'nucleo';
    protected $_package   = 'model';
    
	public $idnucleo;
	public $nomenucleo;
	public $idcomarca;
	
	/**
     * Inicia os valores da classe
     * @author João Batista Padilha e Silva
     * @return void
     */
    protected function _initialize()
    {
		# idnaturezaacao, naturezaacao
        
        $this->_addField("idnucleo", "idnucleo", "int", 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->_addField("nomenucleo", "nomenucleo", "varchar", 255, array('notnull' => true));
        $this->_addField('idcomarca', 'idcomarca', 'int', 11, array('foreign' => '1', 'onUpdate' => 'CASCADE', 'onDelete' => 'CASCADE', 'linkOn' => 'idcomarca', 'class' => 'Comarca'));
    }

    /**
     * Recupera um objeto estaticamente
     * @author João Batista Padilha e Silva
     * @return Pessoa
     */
    public static function staticGet($pk, $pkValue = null)
    {
        $obj = new Nucleo();
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
	 * @return the $idnucleo
	 */
	public function getIdnucleo() {
		return $this->idnucleo;
	}

	/**
	 * @return the $nomenucleo
	 */
	public function getNomenucleo() {
		return $this->nomenucleo;
	}

	/**
	 * @return the $idcomarca
	 */
	public function getIdcomarca() {
		return $this->idcomarca;
	}

	/**
	 * @param $idnucleo the $idnucleo to set
	 */
	public function setIdnucleo($idnucleo) {
		$this->idnucleo = $idnucleo;
	}

	/**
	 * @param $nomenucleo the $nomenucleo to set
	 */
	public function setNomenucleo($nomenucleo) {
		$this->nomenucleo = $nomenucleo;
	}

	/**
	 * @param $idcomarca the $idcomarca to set
	 */
	public function setIdcomarca($idcomarca) {
		$this->idcomarca = $idcomarca;
	}

	
    #------------------------------------------------------#
    # Coloque todos os metodos personalizados abaixo de    #
    # END AUTOCODE                                         #
    #------------------------------------------------------#
    #### END AUTOCODE
}

?>