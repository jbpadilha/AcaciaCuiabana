<?php

class Pessoa extends Lumine_Base{
	
	// sobrecarga
    protected $_tablename = 'pessoa';
    protected $_package   = 'model';
    
	public $idpessoa;		 	 	 	 	 	 	
	public $datacadastropessoa;		 	 	 	 	 	 	
	public $nomepessoa;		 	 	 	 	 	 	 
	public $rgpessoa;		 	 	 	 	 	 	 
	public $emissorpessoa;		 	 	 	 	 	 	 
	public $sexopessoa;		 	 	 	 	 	 	 
	public $cpfpessoa;		 	 	 	 	 	 	 
	public $estadocivilpessoa;		 	 	 	 	 	 	
	public $apelidopessoa;		 	 	 	 	 	 	 
	public $naturalidadepessoa;		 	 	 	 	 	 	 
	public $datanascimentopessoa;	
	
	/**
     * Inicia os valores da classe
     * @author João Batista Padilha e Silva
     * @return void
     */
    protected function _initialize()
    {
        
        $this->_addField("idpessoa", "idpessoa", "int", 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->_addField("datacadastropessoa", "datacadastropessoa", "datetime", null, array('notnull' => true));
        $this->_addField("nomepessoa", "nomepessoa", "varchar", 255, array('notnull' => true));
        $this->_addField("rgpessoa", "rgpessoa", "varchar", 255, array('notnull' => false));
        $this->_addField("emissorpessoa", "emissorpessoa", "varchar", 255, array('notnull' => false));
        $this->_addField("sexopessoa", "sexopessoa", "varchar", 1, array('notnull' => true));
        $this->_addField("cpfpessoa", "cpfpessoa", "varchar", 14, array('notnull' => true));
        $this->_addField("estadocivilpessoa", "estadocivilpessoa", "int", 1, array('notnull' => true));
        $this->_addField("apelidopessoa", "apelidopessoa", "varchar", 255, array('notnull' => false));
        $this->_addField("naturalidadepessoa", "naturalidadepessoa", "varchar", 255, array('notnull' => false));
        $this->_addField("datanascimentopessoa", "datanascimentopessoa", "date", null, array('notnull' => true));
        
        $this->_addForeignRelation('defensores', self::ONE_TO_MANY, 'Defensor', 'idpessoa', null, null, null);
        $this->_addForeignRelation('dependentes', self::ONE_TO_MANY, 'Dependentes', 'idpessoa', null, null, null);
        $this->_addForeignRelation('enderecos', self::ONE_TO_MANY, 'Endereco', 'idpessoa', null, null, null);
        $this->_addForeignRelation('hipossuficiencias', self::ONE_TO_MANY, 'Hipossuficiencia', 'idpessoa', null, null, null);
        $this->_addForeignRelation('parteprocessos', self::ONE_TO_MANY, 'ParteProcesso', 'idpessoa', null, null, null);
        $this->_addForeignRelation('usuarios', self::ONE_TO_MANY, 'Usuarios', 'idpessoa', null, null, null);

    }

    /**
     * Recupera um objeto estaticamente
     * @author João Batista Padilha e Silva
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
	 * @return the $sexopessoa
	 */
	public function getSexopessoa() {
		return $this->sexopessoa;
	}

	/**
	 * @return the $cpfpessoa
	 */
	public function getCpfpessoa() {
		return $this->cpfpessoa;
	}

	/**
	 * @return the $estadocivilpessoa
	 */
	public function getEstadocivilpessoa() {
		return $this->estadocivilpessoa;
	}

	/**
	 * @return the $apelidopessoa
	 */
	public function getApelidopessoa() {
		return $this->apelidopessoa;
	}

	/**
	 * @return the $naturalidadepessoa
	 */
	public function getNaturalidadepessoa() {
		return $this->naturalidadepessoa;
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
	 * @param $sexopessoa the $sexopessoa to set
	 */
	public function setSexopessoa($sexopessoa) {
		$this->sexopessoa = $sexopessoa;
	}

	/**
	 * @param $cpfpessoa the $cpfpessoa to set
	 */
	public function setCpfpessoa($cpfpessoa) {
		$this->cpfpessoa = $cpfpessoa;
	}

	/**
	 * @param $estadocivilpessoa the $estadocivilpessoa to set
	 */
	public function setEstadocivilpessoa($estadocivilpessoa) {
		$this->estadocivilpessoa = $estadocivilpessoa;
	}

	/**
	 * @param $apelidopessoa the $apelidopessoa to set
	 */
	public function setApelidopessoa($apelidopessoa) {
		$this->apelidopessoa = $apelidopessoa;
	}

	/**
	 * @param $naturalidadepessoa the $naturalidadepessoa to set
	 */
	public function setNaturalidadepessoa($naturalidadepessoa) {
		$this->naturalidadepessoa = $naturalidadepessoa;
	}

	/**
	 * @param $datanascimentopessoa the $datanascimentopessoa to set
	 */
	public function setDatanascimentopessoa($datanascimentopessoa) {
		$this->datanascimentopessoa = $datanascimentopessoa;
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
	
	public function isDefensor()
	{
		$defensor = new Defensor();
		$defensor->setIdpessoa($this->getIdpessoa());
		if($defensor->find(true))
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
		Lumine_Validator_PHPValidator::addValidation($this, 'sexopessoa', Lumine_Validator::REQUIRED_STRING, 'Informe o sexo');
		Lumine_Validator_PHPValidator::addValidation($this, 'cpfpessoa', Lumine_Validator::REQUIRED_CPF, 'Informe o CPF corretamente');
		Lumine_Validator_PHPValidator::addValidation($this, 'estadocivilpessoa', Lumine_Validator::REQUIRED_STRING, 'Informe o estado civil corretamente');
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