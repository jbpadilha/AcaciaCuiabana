<?php

class Pessoa extends Lumine_Base{
	
	// sobrecarga
    protected $_tablename = 'pessoa';
    protected $_package   = 'model'; 
    
	public $idPessoa;		 	 	 	 	 	 	
	public $datacadastroPessoa;		 	 	 	 	 	 	
	public $nomePessoa;		 	 	 	 	 	 	 
	public $rgPessoa;		 	 	 	 	 	 	 
	public $emissorPessoa;		 	 	 	 	 	 	 
	public $cpfPessoa;		 	 	 	 	 	 	 
	public $datanascimentoPessoa;
	public $idConjugue;
	public $idEndereco;
	
	/**
     * Inicia os valores da classe
     * @author Jo�o Batista Padilha e Silva
     * @return void
     */
    protected function _initialize()
    {
        
        $this->_addField("idPessoa", "idPessoa", "int", 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->_addField("datacadastroPessoa", "datacadastroPessoa", "datetime", null, array('notnull' => true));
        $this->_addField("nomePessoa", "nomePessoa", "varchar", 255, array('notnull' => true));
        $this->_addField("rgPessoa", "rgPessoa", "varchar", 255, array('notnull' => false));
        $this->_addField("emissorPessoa", "emissorPessoa", "varchar", 255, array('notnull' => false));
        $this->_addField("cpfPessoa", "cpfPessoa", "varchar", 14, array('notnull' => true));
        $this->_addField("datanascimentoPessoa", "datanascimentoPessoa", "date", null, array('notnull' => true));
        
        $this->_addForeignRelation('idConjugue', self::ONE_TO_MANY, 'Pessoa', 'idPessoa', null, null, null);
        $this->_addForeignRelation('idEndereco', self::ONE_TO_MANY, 'Endereco', 'idEndereco', null, null, null);

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
	 * @return the $idPessoa
	 */
	public function getIdPessoa() {
		return $this->idPessoa;
	}

	/**
	 * @return the $datacadastroPessoa
	 */
	public function getDatacadastroPessoa() {
		return $this->datacadastroPessoa;
	}

	/**
	 * @return the $nomePessoa
	 */
	public function getNomePessoa() {
		return $this->nomePessoa;
	}

	/**
	 * @return the $rgPessoa
	 */
	public function getRgPessoa() {
		return $this->rgPessoa;
	}

	/**
	 * @return the $emissorPessoa
	 */
	public function getEmissorPessoa() {
		return $this->emissorPessoa;
	}

	/**
	 * @return the $cpfPessoa
	 */
	public function getCpfPessoa() {
		return $this->cpfPessoa;
	}

	/**
	 * @return the $datanascimentoPessoa
	 */
	public function getDatanascimentoPessoa() {
		return $this->datanascimentoPessoa;
	}

	/**
	 * @return the $idConjugue
	 */
	public function getIdConjugue() {
		return $this->idConjugue;
	}

	/**
	 * @return the $idEndereco
	 */
	public function getIdEndereco() {
		return $this->idEndereco;
	}

	/**
	 * @param field_type $idPessoa
	 */
	public function setIdPessoa($idPessoa) {
		$this->idPessoa = $idPessoa;
	}

	/**
	 * @param field_type $datacadastroPessoa
	 */
	public function setDatacadastroPessoa($datacadastroPessoa) {
		$this->datacadastroPessoa = $datacadastroPessoa;
	}

	/**
	 * @param field_type $nomePessoa
	 */
	public function setNomePessoa($nomePessoa) {
		$this->nomePessoa = $nomePessoa;
	}

	/**
	 * @param field_type $rgPessoa
	 */
	public function setRgPessoa($rgPessoa) {
		$this->rgPessoa = $rgPessoa;
	}

	/**
	 * @param field_type $emissorPessoa
	 */
	public function setEmissorPessoa($emissorPessoa) {
		$this->emissorPessoa = $emissorPessoa;
	}

	/**
	 * @param field_type $cpfPessoa
	 */
	public function setCpfPessoa($cpfPessoa) {
		$this->cpfPessoa = $cpfPessoa;
	}

	/**
	 * @param field_type $datanascimentoPessoa
	 */
	public function setDatanascimentoPessoa($datanascimentoPessoa) {
		$this->datanascimentoPessoa = $datanascimentoPessoa;
	}

	/**
	 * @param field_type $idConjugue
	 */
	public function setIdConjugue($idConjugue) {
		$this->idConjugue = $idConjugue;
	}

	/**
	 * @param field_type $idEndereco
	 */
	public function setIdEndereco($idEndereco) {
		$this->idEndereco = $idEndereco;
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
		Lumine_Validator_PHPValidator::addValidation($this, 'nomePessoa', Lumine_Validator::REQUIRED_STRING, 'Informe o nome');
		Lumine_Validator_PHPValidator::addValidation($this, 'cpfPessoa', Lumine_Validator::REQUIRED_CPF, 'Informe o CPF corretamente');
		Lumine_Validator_PHPValidator::addValidation($this, 'datanascimentoPessoa', Lumine_Validator::REQUIRED_DATE, 'Informe a Data de Nascimento');
		
		return parent::validate();
	}
	
	/**
	 * 
	 * @return Endereco
	 */
	public function getEndereco()
	{
		$endereco = new Endereco();
		$endereco->setIdEndereco($this->getIdEndereco());
		$endereco->find(true);
		return $endereco;
	}
	
}

?>