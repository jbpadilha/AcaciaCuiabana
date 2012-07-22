<?php

class Usuarios extends Lumine_Base {
	
	protected $_tablename = 'usuarios';
    protected $_package   = 'model';
	
	public $idUsuario = null;
	public $idPessoa = null;
	public $usuario = "";
	public $senha = "";
	public $grupoUsuario = null;
	
	/**
     * Inicia os valores da classe
     * @author Jo�o Batista Padilha e Silva
     * @return void
     */
    protected function _initialize()
    {
		# idatividades, atividades
        
        $this->_addField("idUsuario", "idUsuario", "int", 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->_addField("idPessoa", "idPessoa", "int", 11, array('notnull' => true,'foreign' => '1', 'onUpdate' => 'CASCADE', 'onDelete' => 'CASCADE', 'linkOn' => 'idpessoa', 'class' => 'Pessoa'));
        $this->_addField("usuario", "usuario", "varchar", 255, array('notnull' => true));
        $this->_addField("senha", "senha", "varchar", 255, array('notnull' => true));
        $this->_addField("idGrau", "idGrau", "int", 11, array('notnull' => true,'foreign' => '1', 'onUpdate' => 'CASCADE', 'onDelete' => 'CASCADE', 'linkOn' => 'idGrau', 'class' => 'Grau'));
        $this->_addField("grupoUsuario", "grupoUsuario", "int", 1, array('notnull' => true));
        
    }
	
    /**
     * Recupera um objeto estaticamente
     * @author Jo�o Batista Padilha e Silva
     * @return Pessoa
     */
    public static function staticGet($pk, $pkValue = null)
    {
        $obj = new Usuarios();
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
	 * @return the $idUsuario
	 */
	public function getIdUsuario() {
		return $this->idUsuario;
	}

	/**
	 * @return the $idPessoa
	 */
	public function getIdPessoa() {
		return $this->idPessoa;
	}

	/**
	 * @return the $usuario
	 */
	public function getUsuario() {
		return $this->usuario;
	}

	/**
	 * @return the $senha
	 */
	public function getSenha() {
		return $this->senha;
	}

	/**
	 * @param $idUsuario the $idUsuario to set
	 */
	public function setIdUsuario($idUsuario) {
		$this->idUsuario = $idUsuario;
	}

	/**
	 * @param $idPessoa the $idPessoa to set
	 */
	public function setIdPessoa($idPessoa) {
		$this->idPessoa = $idPessoa;
	}

	/**
	 * @param $usuario the $usuario to set
	 */
	public function setUsuario($usuario) {
		$this->usuario = $usuario;
	}

	/**
	 * @param $senha the $senha to set
	 */
	public function setSenha($senha) {
		$this->senha = $senha;
	}
	
	/**
	 * @return the $grupoUsuario
	 */
	public function getGrupoUsuario() {
		return $this->grupoUsuario;
	}

	/**
	 * @param field_type $grupoUsuario
	 */
	public function setGrupoUsuario($grupoUsuario) {
		$this->grupoUsuario = $grupoUsuario;
	}

	public function registraUsuarioSessao()
	{
		session_start();
		$_SESSION["loginusuario"] = $this->getUsuario();
		$_SESSION['grupoUsuario'] = $this->getGrupoUsuario();
		
	}
	public function validate(){
		
		// limpa os validators anteriores
		Lumine_Validator_PHPValidator::clearValidations($this);
		
		// adicionando as regras 
		Lumine_Validator_PHPValidator::addValidation($this, 'usuario', Lumine_Validator::REQUIRED_STRING, 'Informe o usuário de acesso');
		Lumine_Validator_PHPValidator::addValidation($this, 'senha', Lumine_Validator::REQUIRED_STRING, 'Informe a senha de acesso');
		Lumine_Validator_PHPValidator::addValidation($this, 'grupoUsuario', Lumine_Validator::REQUIRED_NUMBER, 'Grupo de acesso não informado');
		
		return parent::validate();
	}
	
	public function getNomeGrupoUsuarios()
	{
		switch ($this->grupoUsuario)
		{
			case GruposUsuarios::$GRUPO_ADMIN:
				{
					return GruposUsuarios::$GRUPO_ADMIN_TXT;
					break;
				}
			case GruposUsuarios::$GRUPO_PUBLICO:
				{
					return GruposUsuarios::$GRUPO_PUBLICO_TXT;
					break;
				}
			default:
					return "";
					break;
		}
		
	}
	
	/**
	 * 
	 * @return Pessoa
	 */
	public function getPessoa()
	{
		$pessoa = new Pessoa();
		$pessoa->setIdpessoa($this->getIdpessoa());
		$pessoa->find(true);
		return $pessoa;
	}

	
}

?>