<?php

class Atividades extends Lumine_Base {
	
	// sobrecarga
    protected $_tablename = 'atividades';
    protected $_package   = 'application';
    
	public $idatividades;
	public $atividades;
	
	/**
     * Inicia os valores da classe
     * @author João Batista Padilha e Silva
     * @return void
     */
    protected function _initialize()
    {
		# idatividades, atividades
        
        $this->_addField("idatividades", "idatividades", "int", 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->_addField("atividades", "atividades", "varchar", 255, array('notnull' => true));
        
    }

    /**
     * Recupera um objeto estaticamente
     * @author João Batista Padilha e Silva
     * @return Pessoa
     */
    public static function staticGet($pk, $pkValue = null)
    {
        $obj = new Atividades();
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
	 * @return the $idatividades
	 */	

	
    #------------------------------------------------------#
    # Coloque todos os metodos personalizados abaixo de    #
    # END AUTOCODE                                         #
    #------------------------------------------------------#
    #### END AUTOCODE
	
	public function getIdatividades() {
		return $this->idatividades;
	}

	/**
	 * @return the $atividades
	 */
	public function getAtividades() {
		return $this->atividades;
	}

	/**
	 * @param $idatividades the $idatividades to set
	 */
	public function setIdatividades($idatividades) {
		$this->idatividades = $idatividades;
	}

	/**
	 * @param $atividades the $atividades to set
	 */
	public function setAtividades($atividades) {
		$this->atividades = $atividades;
	}

}

?>