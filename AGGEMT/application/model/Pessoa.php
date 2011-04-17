<?php

class Pessoa extends Lumine_Base{
	
	// sobrecarga
    protected $_tablename = 'pessoa';
    protected $_package   = 'model';
    
	public $idpessoa = null; 	 	 	 	 	
	public $datacadastropessoa = null;		 	 	 	 	 	 	
	public $nomepessoa = null;	 	 	 	 
	public $rgpessoa = null;	 	 	 	 	 	 
	public $emissorpessoa = null;	 	 	 	 	 	 	 		 	 	 	 	 	 	 
	public $cpfpessoa = null;	 	 	 	 	 
	public $datanascimentopessoa = null;
	public $cursospessoa = null;
	public $projetospessoa = null;
	
	/**
     * Inicia os valores da classe
     * @author Jo�o Batista Padilha e Silva
     * @return void
     */
    protected function _initialize()
    {
        
        $this->_addField("idpessoa", "idpessoa", "int", 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->_addField("datacadastropessoa", "datacadastropessoa", "datetime", null, array('notnull' => true));
        $this->_addField("nomepessoa", "nomepessoa", "varchar", 255, array('notnull' => true));
        $this->_addField("rgpessoa", "rgpessoa", "varchar", 255, array('notnull' => false));
        $this->_addField("emissorpessoa", "emissorpessoa", "varchar", 255, array('notnull' => false));
        $this->_addField("cpfpessoa", "cpfpessoa", "varchar", 14, array('notnull' => true));
        $this->_addField("datanascimentopessoa", "datanascimentopessoa", "date", null, array('notnull' => true));
        $this->_addField("cursospessoa", "cursospessoa", "text", null, array('notnull' => false));
        $this->_addField("projetospessoa", "projetospessoa", "text", null, array('notnull' => false));
        
        $this->_addForeignRelation('endereco', self::ONE_TO_MANY, 'Endereco', 'idpessoa', null, null, null);
        $this->_addForeignRelation('usuarios', self::ONE_TO_MANY, 'Usuarios', 'idpessoa', null, null, null);

    }

    /**
     * Recupera um objeto estaticamente
     * @author Jo�o Batista Padilha e Silva
     * @return Pessoa
     */
    public static function staticGet($pk, $pkValue = null)
    {
        $obj = new Pessoa();
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
	 * @return the $idpessoa
	 */
	public function getIdpessoa() {
		return $this->idpessoa;
	}

	/**
	 * @return the $datacadastropessoa
	 */
	public function getDatacadastropessoa() {
		return $this->datacadastropessoa;
	}

	/**
	 * @return the $nomepessoa
	 */
	public function getNomepessoa() {
		return $this->nomepessoa;
	}

	/**
	 * @return the $rgpessoa
	 */
	public function getRgpessoa() {
		return $this->rgpessoa;
	}

	/**
	 * @return the $emissorpessoa
	 */
	public function getEmissorpessoa() {
		return $this->emissorpessoa;
	}

	/**
	 * @return the $cpfpessoa
	 */
	public function getCpfpessoa() {
		return $this->cpfpessoa;
	}

	/**
	 * @return the $datanascimentopessoa
	 */
	public function getDatanascimentopessoa() {
		return $this->datanascimentopessoa;
	}

	/**
	 * @param $idpessoa the $idpessoa to set
	 */
	public function setIdpessoa($idpessoa) {
		$this->idpessoa = $idpessoa;
	}

	/**
	 * @param $datacadastropessoa the $datacadastropessoa to set
	 */
	public function setDatacadastropessoa($datacadastropessoa) {
		$this->datacadastropessoa = $datacadastropessoa;
	}

	/**
	 * @param $nomepessoa the $nomepessoa to set
	 */
	public function setNomepessoa($nomepessoa) {
		$this->nomepessoa = $nomepessoa;
	}

	/**
	 * @param $rgpesso the $rgpesso to set
	 */
	public function setRgpessoa($rgpessoa) {
		$this->rgpessoa = $rgpessoa;
	}

	/**
	 * @param $emissorpessoa the $emissorpessoa to set
	 */
	public function setEmissorpessoa($emissorpessoa) {
		$this->emissorpessoa = $emissorpessoa;
	}

	/**
	 * @param $cpfpessoa the $cpfpessoa to set
	 */
	public function setCpfpessoa($cpfpessoa) {
		$this->cpfpessoa = $cpfpessoa;
	}

	/**
	 * @param $datanascimentopessoa the $datanascimentopessoa to set
	 */
	public function setDatanascimentopessoa($datanascimentopessoa) {
		$this->datanascimentopessoa = $datanascimentopessoa;
	}
	
    /**
	 * @return the $cursospessoa
	 */
	public function getCursospessoa() {
		return $this->cursospessoa;
	}

	/**
	 * @return the $projetospessoa
	 */
	public function getProjetospessoa() {
		return $this->projetospessoa;
	}

	/**
	 * @param field_type $cursospessoa
	 */
	public function setCursospessoa($cursospessoa) {
		$this->cursospessoa = $cursospessoa;
	}

	/**
	 * @param field_type $projetospessoa
	 */
	public function setProjetospessoa($projetospessoa) {
		$this->projetospessoa = $projetospessoa;
	}

	#------------------------------------------------------#
    # Coloque todos os metodos personalizados abaixo de    #
    # END AUTOCODE                                         #
    #------------------------------------------------------#
    #### END AUTOCODE
	
	public function getDataNascimentoFormatado()
	{
		if($this->getDatanascimentopessoa()!=null)
		{
			$data = explode("-",$this->getDatanascimentopessoa());
			$dataRetorno = $data[2]."/".$data[1]."/".$data[0];
			return $dataRetorno;
		}
		else
		{
			return "";
		}
	}
	
	public function toDataNascimentoDB()
	{
		if($this->getDatanascimentopessoa())
		{
			$data = explode("/",$this->getDatanascimentopessoa());
			return $data[2]."-".$data[1]."-".$data[0];
		}
		else
		{
			return null;
		}
	}
	
	public function isUsuario()
	{
		$usuario = new Usuarios();
		$usuario->setIdpessoa($this->getIdpessoa());
		if($usuario->find(true))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	
	public function validate(){
		
		// limpa os validators anteriores
		Lumine_Validator_PHPValidator::clearValidations($this);
		
		// adicionando as regras 
		Lumine_Validator_PHPValidator::addValidation($this, 'nomepessoa', Lumine_Validator::REQUIRED_STRING, 'Informe o nome');
		Lumine_Validator_PHPValidator::addValidation($this, 'datanascimentopessoa', Lumine_Validator::REQUIRED_DATE, 'Informe a Data de Nascimento');
		
		return parent::validate();
	}
	
	/**
	 * 
	 * @return Endereco
	 */
	public function getEndereco()
	{
		$endereco = new Endereco();
		$endereco->setIdpessoa($this->getIdpessoa());
		$endereco->find(true);
		return $endereco;
	}
	
}

?>