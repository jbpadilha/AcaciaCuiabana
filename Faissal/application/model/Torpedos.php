<?php

class Torpedos extends Lumine_Base {
	
	protected $_tablename = 'torpedos';
    protected $_package   = 'model';
	
	public $idTorpedo = null;
	public $deTorpedo = '';
	public $paraTorpedo = '';
	public $dataTorpedo = '';
	public $tituloTorpedo = '';
	public $mensagemTorpedo = '';
	public $statusTorpedo = '';
	
	/**
     * Inicia os valores da classe
     * @author Jo�o Batista Padilha e Silva
     * @return void
     */
    protected function _initialize()
    {
		# idatividades, atividades
        
        $this->_addField("idTorpedo", "idTorpedo", "int", 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->_addField("deTorpedo", "deTorpedo", "varchar", 255, array('notnull' => true));
        $this->_addField("paraTorpedo", "paraTorpedo", "varchar", 255, array('notnull' => true));
        $this->_addField("dataTorpedo", "dataTorpedo", "datetime", null, array('notnull' => true));
        $this->_addField("tituloTorpedo", "tituloTorpedo", "varchar", 255, array('notnull' => true));
        $this->_addField("mensagemTorpedo", "mensagemTorpedo", "text", null, array('notnull' => true));
        $this->_addField("statusTorpedo", "statusTorpedo", "varchar", 255, array('notnull' => true));
        
    }
	
    /**
     * Recupera um objeto estaticamente
     * @author Jo�o Batista Padilha e Silva
     * @return Pessoa
     */
    public static function staticGet($pk, $pkValue = null)
    {
        $obj = new Torpedos();
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
	 * @return the $idTorpedo
	 */
	public function getIdTorpedo() {
		return $this->idTorpedo;
	}

	/**
	 * @return the $deTorpedo
	 */
	public function getDeTorpedo() {
		return $this->deTorpedo;
	}

	/**
	 * @return the $paraTorpedo
	 */
	public function getParaTorpedo() {
		return $this->paraTorpedo;
	}

	/**
	 * @return the $dataTorpedo
	 */
	public function getDataTorpedo() {
		return $this->dataTorpedo;
	}

	/**
	 * @return the $tituloTorpedo
	 */
	public function getTituloTorpedo() {
		return $this->tituloTorpedo;
	}

	/**
	 * @return the $mensagemTorpedo
	 */
	public function getMensagemTorpedo() {
		return $this->mensagemTorpedo;
	}

	/**
	 * @return the $statusTorpedo
	 */
	public function getStatusTorpedo() {
		return $this->statusTorpedo;
	}

	/**
	 * @param $idTorpedo the $idTorpedo to set
	 */
	public function setIdTorpedo($idTorpedo) {
		$this->idTorpedo = $idTorpedo;
	}

	/**
	 * @param $deTorpedo the $deTorpedo to set
	 */
	public function setDeTorpedo($deTorpedo) {
		$this->deTorpedo = $deTorpedo;
	}

	/**
	 * @param $paraTorpedo the $paraTorpedo to set
	 */
	public function setParaTorpedo($paraTorpedo) {
		$this->paraTorpedo = $paraTorpedo;
	}

	/**
	 * @param $dataTorpedo the $dataTorpedo to set
	 */
	public function setDataTorpedo($dataTorpedo) {
		$this->dataTorpedo = $dataTorpedo;
	}

	/**
	 * @param $tituloTorpedo the $tituloTorpedo to set
	 */
	public function setTituloTorpedo($tituloTorpedo) {
		$this->tituloTorpedo = $tituloTorpedo;
	}

	/**
	 * @param $mensagemTorpedo the $mensagemTorpedo to set
	 */
	public function setMensagemTorpedo($mensagemTorpedo) {
		$this->mensagemTorpedo = $mensagemTorpedo;
	}

	/**
	 * @param $statusTorpedo the $statusTorpedo to set
	 */
	public function setStatusTorpedo($statusTorpedo) {
		$this->statusTorpedo = $statusTorpedo;
	}

	
	
	
}

?>