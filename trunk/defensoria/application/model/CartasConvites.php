<?php

class CartasConvites extends Lumine_Base {
	
	// sobrecarga
    protected $_tablename = 'cartasconvites';
    protected $_package   = 'model';
    
	public $idcartaconvite;	 	 	 	 	 	 	
	public $datacartaconvite;		 	 	 	 	 	 	
	public $idparteprocesso;		 	 	 	 	 	 	
	public $iddefensor;		 	 	 	 	 	 	
	public $idatendente;		 	 	 	 	 	 	
	public $leitura;
	
	/**
     * Inicia os valores da classe
     * @author João Batista Padilha e Silva
     * @return void
     */
    protected function _initialize()
    {
		# idcartaconvite, datacartaconvite, idparteprocesso, iddefensor, idatendente, leitura
        
        $this->_addField("idcartaconvite", "idcartaconvite", "int", 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->_addField("datacartaconvite", "datacartaconvite", "datetime", null, array('notnull' => true));
        $this->_addField('idparteprocesso', 'idparteprocesso', 'int', 11, array('foreign' => '1', 'onUpdate' => 'CASCADE', 'onDelete' => 'CASCADE', 'linkOn' => 'idparteprocesso', 'class' => 'ParteProcesso'));
        $this->_addField('iddefensor', 'iddefensor', 'int', 11, array('foreign' => '1', 'onUpdate' => 'CASCADE', 'onDelete' => 'CASCADE', 'linkOn' => 'iddefensor', 'class' => 'Defensor'));
        $this->_addField('idatendente', 'idatendente', 'int', 11, array('foreign' => '1', 'onUpdate' => 'CASCADE', 'onDelete' => 'CASCADE', 'linkOn' => 'idatendente', 'class' => 'Usuarios'));
        $this->_addField("leitura", "leitura", "int", 1, array('notnull' => true));
    }

    /**
     * Recupera um objeto estaticamente
     * @author João Batista Padilha e Silva
     * @return Pessoa
     */
    public static function staticGet($pk, $pkValue = null)
    {
        $obj = new CartasConvites();
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
	

	
    #------------------------------------------------------#
    # Coloque todos os metodos personalizados abaixo de    #
    # END AUTOCODE                                         #
    #------------------------------------------------------#
    #### END AUTOCODE
	
	/**
	 * @return the $idcartaconvite
	 */
	public function getIdcartaconvite() {
		return $this->idcartaconvite;
	}

	/**
	 * @return the $datacartaconvite
	 */
	public function getDatacartaconvite() {
		return $this->datacartaconvite;
	}

	/**
	 * @return the $idparteprocesso
	 */
	public function getIdparteprocesso() {
		return $this->idparteprocesso;
	}

	/**
	 * @return the $iddefensor
	 */
	public function getIddefensor() {
		return $this->iddefensor;
	}

	/**
	 * @return the $idatendente
	 */
	public function getIdatendente() {
		return $this->idatendente;
	}

	/**
	 * @return the $leitura
	 */
	public function getLeitura() {
		return $this->leitura;
	}

	/**
	 * @param $idcartaconvite the $idcartaconvite to set
	 */
	public function setIdcartaconvite($idcartaconvite) {
		$this->idcartaconvite = $idcartaconvite;
	}

	/**
	 * @param $datacartaconvite the $datacartaconvite to set
	 */
	public function setDatacartaconvite($datacartaconvite) {
		$this->datacartaconvite = $datacartaconvite;
	}

	/**
	 * @param $idparteprocesso the $idparteprocesso to set
	 */
	public function setIdparteprocesso($idparteprocesso) {
		$this->idparteprocesso = $idparteprocesso;
	}

	/**
	 * @param $iddefensor the $iddefensor to set
	 */
	public function setIddefensor($iddefensor) {
		$this->iddefensor = $iddefensor;
	}

	/**
	 * @param $idatendente the $idatendente to set
	 */
	public function setIdatendente($idatendente) {
		$this->idatendente = $idatendente;
	}

	/**
	 * @param $leitura the $leitura to set
	 */
	public function setLeitura($leitura) {
		$this->leitura = $leitura;
	}
	
}

?>