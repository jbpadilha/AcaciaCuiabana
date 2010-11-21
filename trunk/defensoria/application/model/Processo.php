<?php

class Processo extends Lumine_Base{
	
	// sobrecarga
    protected $_tablename = 'processo';
    protected $_package   = 'application';
    
	public $idprocesso;
	public $numeroprocesso;		 	 	 	 	 	 	
	public $idvara;		 	 	 	 	 	 	
	public $idcomarca;		 	 	 	 	 	 	
	public $juizo;		 	 	 	 	 	 	
	public $idtipoacao;		 	 	 	 	 	 	
	public $idnaturezaacao;
	
	public static $juizo_Primeiro_Grau = 1;
	public static $juizo_Segundo_Grau = 2;
	
	/**
     * Inicia os valores da classe
     * @author João Batista Padilha e Silva
     * @return void
     */
    protected function _initialize()
    {
		# iddefensor, idpessoa, oabdefensor, compoabdefensor, estadooabdefensor
        
        $this->_addField("idprocesso", "idprocesso", "int", 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->_addField("numeroprocesso", "numeroprocesso", "bigint", 50, array('notnull' => true));
        $this->_addField('idvara', 'idvara', 'int', 11, array('foreign' => '1', 'onUpdate' => 'CASCADE', 'onDelete' => 'CASCADE', 'linkOn' => 'idvara', 'class' => 'Vara'));
        $this->_addField('idcomarca', 'idcomarca', 'int', 11, array('foreign' => '1', 'onUpdate' => 'CASCADE', 'onDelete' => 'CASCADE', 'linkOn' => 'idcomarca', 'class' => 'Comarca'));
        $this->_addField("juizo", "juizo", "int", 11, array('notnull' => true));
        $this->_addField('idtipoacao', 'idtipoacao', 'int', 11, array('foreign' => '1', 'onUpdate' => 'CASCADE', 'onDelete' => 'CASCADE', 'linkOn' => 'idtipoacao', 'class' => 'TipoAcao'));
        $this->_addField('idnaturezaacao', 'idnaturezaacao', 'int', 11, array('foreign' => '1', 'onUpdate' => 'CASCADE', 'onDelete' => 'CASCADE', 'linkOn' => 'idnaturezaacao', 'class' => 'Processo'));
        
        $this->_addForeignRelation('entrevistas', self::ONE_TO_MANY, 'Entrevista', 'idprocesso', null, null, null);
        $this->_addForeignRelation('partesprocesso', self::ONE_TO_MANY, 'ParteProcesso', 'idprocesso', null, null, null);
    }

    /**
     * Recupera um objeto estaticamente
     * @author João Batista Padilha e Silva
     * @return Pessoa
     */
    public static function staticGet($pk, $pkValue = null)
    {
        $obj = new Processo();
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
	 * @return the $idprocesso
	 */
	public function getIdprocesso() {
		return $this->idprocesso;
	}

	/**
	 * @return the $numeroprocesso
	 */
	public function getNumeroprocesso() {
		return $this->numeroprocesso;
	}

	/**
	 * @return the $idvara
	 */
	public function getIdvara() {
		return $this->idvara;
	}

	/**
	 * @return the $idcomarca
	 */
	public function getIdcomarca() {
		return $this->idcomarca;
	}

	/**
	 * @return the $juizo
	 */
	public function getJuizo() {
		return $this->juizo;
	}

	/**
	 * @return the $idtipoacao
	 */
	public function getIdtipoacao() {
		return $this->idtipoacao;
	}

	/**
	 * @return the $idnaturezaacao
	 */
	public function getIdnaturezaacao() {
		return $this->idnaturezaacao;
	}

	/**
	 * @param $idprocesso the $idprocesso to set
	 */
	public function setIdprocesso($idprocesso) {
		$this->idprocesso = $idprocesso;
	}

	/**
	 * @param $numeroprocesso the $numeroprocesso to set
	 */
	public function setNumeroprocesso($numeroprocesso) {
		$this->numeroprocesso = $numeroprocesso;
	}

	/**
	 * @param $idvara the $idvara to set
	 */
	public function setIdvara($idvara) {
		$this->idvara = $idvara;
	}

	/**
	 * @param $idcomarca the $idcomarca to set
	 */
	public function setIdcomarca($idcomarca) {
		$this->idcomarca = $idcomarca;
	}

	/**
	 * @param $juizo the $juizo to set
	 */
	public function setJuizo($juizo) {
		$this->juizo = $juizo;
	}

	/**
	 * @param $idtipoacao the $idtipoacao to set
	 */
	public function setIdtipoacao($idtipoacao) {
		$this->idtipoacao = $idtipoacao;
	}

	/**
	 * @param $idnaturezaacao the $idnaturezaacao to set
	 */
	public function setIdnaturezaacao($idnaturezaacao) {
		$this->idnaturezaacao = $idnaturezaacao;
	}

	
    #------------------------------------------------------#
    # Coloque todos os metodos personalizados abaixo de    #
    # END AUTOCODE                                         #
    #------------------------------------------------------#
    #### END AUTOCODE

}

?>