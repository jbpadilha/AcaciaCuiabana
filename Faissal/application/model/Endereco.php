<?php
//####################################
// * Jo�o Batista Padilha e Silva Especialista em TI (http://www.joaopadilha.com)
// * Arquivo: Endereco.php
// * Cria��o: Jo�o Batista Padilha e Silva
// * Data de cria��o: 11/02/2011
// * E-mail: joao.padilha@globo.com
//####################################
class Endereco extends Lumine_Base {

	protected $_tablename = 'endereco';
    protected $_package   = 'model';
	
	public $idEndereco = null;
	public $logradouroEndereco = "";
	public $complementoEndereco = "";
	public $numeroEndereco = "";
	public $bairroEndereco = "";
	public $cidadeEndereco = "";
	public $estadoEndereco = "";
	public $emailEndereco = "";
	public $msnEndereco = "";
	public $twitterEndereco = "";
	public $orkutEndereco = "";
	public $facebookEndereco = "";
	public $idPessoa = null;
	
	/**
     * Inicia os valores da classe
     * @author Jo�o Batista Padilha e Silva
     * @return void
     */
    protected function _initialize()
    {
		# idatividades, atividades
        
        $this->_addField("idEndereco", "idEndereco", "int", 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->_addField("logradouroEndereco", "logradouroEndereco", "varchar", 255, array('notnull' => true));
        $this->_addField("complementoEndereco", "complementoEndereco", "varchar", 255, array('notnull' => false));
        $this->_addField("numeroEndereco", "numeroEndereco", "varchar", 255, array('notnull' => false));
        $this->_addField("bairroEndereco", "bairroEndereco", "varchar", 255, array('notnull' => false));
        $this->_addField("cidadeEndereco", "cidadeEndereco", "varchar", 255, array('notnull' => true));
        $this->_addField("estadoEndereco", "estadoEndereco", "varchar", 2, array('notnull' => true));
        $this->_addField("emailEndereco", "emailEndereco", "varchar", 255, array('notnull' => true));
        $this->_addField("msnEndereco", "msnEndereco", "varchar", 255, array('notnull' => false));
        $this->_addField("twitterEndereco", "twitterEndereco", "varchar", 255, array('notnull' => false));
        $this->_addField("orkutEndereco", "orkutEndereco", "varchar", 255, array('notnull' => false));
        $this->_addField("facebookEndereco", "facebookEndereco", "varchar", 255, array('notnull' => false));
        $this->_addField('idPessoa', 'idPessoa', 'int', 11, array('foreign' => '1', 'onUpdate' => 'CASCADE', 'onDelete' => 'CASCADE', 'linkOn' => 'idPessoa', 'class' => 'Pessoa'));
        
    }
	
    /**
     * Recupera um objeto estaticamente
     * @author Jo�o Batista Padilha e Silva
     * @return Pessoa
     */
    public static function staticGet($pk, $pkValue = null)
    {
        $obj = new Endereco();
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
	 * @return the $idEndereco
	 */
	public function getIdEndereco() {
		return $this->idEndereco;
	}

	/**
	 * @return the $logradouroEndereco
	 */
	public function getLogradouroEndereco() {
		return $this->logradouroEndereco;
	}

	/**
	 * @return the $complementoEndereco
	 */
	public function getComplementoEndereco() {
		return $this->complementoEndereco;
	}

	/**
	 * @return the $numeroEndereco
	 */
	public function getNumeroEndereco() {
		return $this->numeroEndereco;
	}

	/**
	 * @return the $bairroEndereco
	 */
	public function getBairroEndereco() {
		return $this->bairroEndereco;
	}

	/**
	 * @return the $cidadeEndereco
	 */
	public function getCidadeEndereco() {
		return $this->cidadeEndereco;
	}

	/**
	 * @return the $estadoEndereco
	 */
	public function getEstadoEndereco() {
		return $this->estadoEndereco;
	}

	/**
	 * @return the $emailEndereco
	 */
	public function getEmailEndereco() {
		return $this->emailEndereco;
	}

	/**
	 * @return the $msnEndereco
	 */
	public function getMsnEndereco() {
		return $this->msnEndereco;
	}

	/**
	 * @return the $twitterEndereco
	 */
	public function getTwitterEndereco() {
		return $this->twitterEndereco;
	}

	/**
	 * @return the $orkutEndereco
	 */
	public function getOrkutEndereco() {
		return $this->orkutEndereco;
	}

	/**
	 * @return the $facebookEndereco
	 */
	public function getFacebookEndereco() {
		return $this->facebookEndereco;
	}

	/**
	 * @return the $idPessoa
	 */
	public function getIdPessoa() {
		return $this->idPessoa;
	}

	/**
	 * @param field_type $idEndereco
	 */
	public function setIdEndereco($idEndereco) {
		$this->idEndereco = $idEndereco;
	}

	/**
	 * @param field_type $logradouroEndereco
	 */
	public function setLogradouroEndereco($logradouroEndereco) {
		$this->logradouroEndereco = $logradouroEndereco;
	}

	/**
	 * @param field_type $complementoEndereco
	 */
	public function setComplementoEndereco($complementoEndereco) {
		$this->complementoEndereco = $complementoEndereco;
	}

	/**
	 * @param field_type $numeroEndereco
	 */
	public function setNumeroEndereco($numeroEndereco) {
		$this->numeroEndereco = $numeroEndereco;
	}

	/**
	 * @param field_type $bairroEndereco
	 */
	public function setBairroEndereco($bairroEndereco) {
		$this->bairroEndereco = $bairroEndereco;
	}

	/**
	 * @param field_type $cidadeEndereco
	 */
	public function setCidadeEndereco($cidadeEndereco) {
		$this->cidadeEndereco = $cidadeEndereco;
	}

	/**
	 * @param field_type $estadoEndereco
	 */
	public function setEstadoEndereco($estadoEndereco) {
		$this->estadoEndereco = $estadoEndereco;
	}

	/**
	 * @param field_type $emailEndereco
	 */
	public function setEmailEndereco($emailEndereco) {
		$this->emailEndereco = $emailEndereco;
	}

	/**
	 * @param field_type $msnEndereco
	 */
	public function setMsnEndereco($msnEndereco) {
		$this->msnEndereco = $msnEndereco;
	}

	/**
	 * @param field_type $twitterEndereco
	 */
	public function setTwitterEndereco($twitterEndereco) {
		$this->twitterEndereco = $twitterEndereco;
	}

	/**
	 * @param field_type $orkutEndereco
	 */
	public function setOrkutEndereco($orkutEndereco) {
		$this->orkutEndereco = $orkutEndereco;
	}

	/**
	 * @param field_type $facebookEndereco
	 */
	public function setFacebookEndereco($facebookEndereco) {
		$this->facebookEndereco = $facebookEndereco;
	}

	/**
	 * @param field_type $idPessoa
	 */
	public function setIdPessoa($idPessoa) {
		$this->idPessoa = $idPessoa;
	}

	/**
	 * Valida��o(non-PHPdoc)
	 * @see lumine/lib/Lumine_Base#validate()
	 */
	public function validate()
	{
		// limpa os validators anteriores
		Lumine_Validator_PHPValidator::clearValidations($this);
		// adicionando as regras 
		Lumine_Validator_PHPValidator::addValidation($this, 'logradouroEndereco', Lumine_Validator::REQUIRED_STRING, 'Informe o nome do Logradouro');
		Lumine_Validator_PHPValidator::addValidation($this, 'cidadeEndereco', Lumine_Validator::REQUIRED_STRING, 'Informe a cidade');
		Lumine_Validator_PHPValidator::addValidation($this, 'estadoEndereco', Lumine_Validator::REQUIRED_STRING, 'Informe o estado');
		Lumine_Validator_PHPValidator::addValidation($this, 'emailEndereco', Lumine_Validator::REQUIRED_STRING, 'Informe o e-mail');
		
		return parent::validate();
	}
	
	
}

?>