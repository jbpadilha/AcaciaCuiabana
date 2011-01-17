<?php

class TipoAcao extends Lumine_Base {
	
	// sobrecarga
    protected $_tablename = 'tipoacao';
    protected $_package   = 'model';
    
	public $idtipoacao;
	public $tipoacao;
	
	/**
     * Inicia os valores da classe
     * @author João Batista Padilha e Silva
     * @return void
     */
    protected function _initialize()
    {
		# idatividades, atividades
        
        $this->_addField("idtipoacao", "idtipoacao", "int", 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->_addField("tipoacao", "tipoacao", "varchar", 255, array('notnull' => true));
        
    }

    /**
     * Recupera um objeto estaticamente
     * @author João Batista Padilha e Silva
     * @return Pessoa
     */
    public static function staticGet($pk, $pkValue = null)
    {
        $obj = new TipoAcao();
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
	 * @return the $idtipoacao
	 */
	public function getIdtipoacao() {
		return $this->idtipoacao;
	}

	/**
	 * @return the $tipoacao
	 */
	public function getTipoacao() {
		return $this->tipoacao;
	}

	/**
	 * @param $idtipoacao the $idtipoacao to set
	 */
	public function setIdtipoacao($idtipoacao) {
		$this->idtipoacao = $idtipoacao;
	}

	/**
	 * @param $tipoacao the $tipoacao to set
	 */
	public function setTipoacao($tipoacao) {
		$this->tipoacao = $tipoacao;
	}

	
    #------------------------------------------------------#
    # Coloque todos os metodos personalizados abaixo de    #
    # END AUTOCODE                                         #
    #------------------------------------------------------#
    #### END AUTOCODE

}

?>