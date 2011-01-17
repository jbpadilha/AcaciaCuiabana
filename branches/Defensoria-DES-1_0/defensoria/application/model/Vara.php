<?php

class Vara extends Lumine_Base{
	
	// sobrecarga
    protected $_tablename = 'vara';
    protected $_package   = 'model';
    
	public $idvara;
	public $codvara;		 	 	 	 	 	 	
	public $nomevara;		 	 	 	 	 	 	 
	public $idcomarca;
	
	/**
     * Inicia os valores da classe
     * @author João Batista Padilha e Silva
     * @return void
     */
    protected function _initialize()
    {
		# idatividades, atividades
        
        $this->_addField("idvara", "idvara", "int", 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->_addField("codvara", "codvara", "int", 11, array('notnull' => true));
        $this->_addField("nomevara", "nomevara", "varchar", 255, array('notnull' => true));
        $this->_addField('idcomarca', 'idcomarca', 'int', 11, array('foreign' => '1', 'onUpdate' => 'CASCADE', 'onDelete' => 'CASCADE', 'linkOn' => 'idcomarca', 'class' => 'Comarca'));
        
        $this->_addForeignRelation('processos', self::ONE_TO_MANY, 'Processo', 'idvara', null, null, null);
    }

    /**
     * Recupera um objeto estaticamente
     * @author João Batista Padilha e Silva
     * @return Pessoa
     */
    public static function staticGet($pk, $pkValue = null)
    {
        $obj = new Vara();
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
	 * @return the $idvara
	 */
	public function getIdvara() {
		return $this->idvara;
	}

	/**
	 * @return the $codvara
	 */
	public function getCodvara() {
		return $this->codvara;
	}

	/**
	 * @return the $nomevara
	 */
	public function getNomevara() {
		return $this->nomevara;
	}

	/**
	 * @return the $idcomarca
	 */
	public function getIdcomarca() {
		return $this->idcomarca;
	}

	/**
	 * @param $idvara the $idvara to set
	 */
	public function setIdvara($idvara) {
		$this->idvara = $idvara;
	}

	/**
	 * @param $codvara the $codvara to set
	 */
	public function setCodvara($codvara) {
		$this->codvara = $codvara;
	}

	/**
	 * @param $nomevara the $nomevara to set
	 */
	public function setNomevara($nomevara) {
		$this->nomevara = $nomevara;
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
	
	public function getNomeComarca()
	{
		$comarca = new Comarca();
		$comarca->setIdcomarca($this->getIdcomarca());
		$comarca->find(true);
		return $comarca->getNomecomarca();
	}
	
}

?>