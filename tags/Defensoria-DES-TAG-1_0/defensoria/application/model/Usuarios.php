<?php

class Usuarios extends Lumine_Base{
	
	// sobrecarga
    protected $_tablename = 'usuarios';
    protected $_package   = 'model';
    
	public $idusuario;
	public $usuario;		 	 	 	 	 	 	 
	public $senha;
	public $grupousuario;
	public $idpessoa;
	
	
	/**
     * Inicia os valores da classe
     * @author João Batista Padilha e Silva
     * @return void
     */
    protected function _initialize()
    {
        $this->_addField("idusuario", "idusuario", "int", 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->_addField("usuario", "usuario", "varchar", 255, array('notnull' => true));
        $this->_addField("senha", "senha", "varchar", 255, array('notnull' => true));
        $this->_addField("grupousuario", "grupousuario", "int", 11, array('notnull' => true));
        $this->_addField('idpessoa', 'idpessoa', 'int', 11, array('foreign' => '1', 'onUpdate' => 'CASCADE', 'onDelete' => 'CASCADE', 'linkOn' => 'idpessoa', 'class' => 'Pessoa'));
        
        $this->_addForeignRelation('cartasconvites', self::ONE_TO_MANY, 'CartasConvites', 'idatendente', null, null, null);        
    }

    /**
     * Recupera um objeto estaticamente
     * @author João Batista Padilha e Silva
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
	 * @return the $idusuario
	 */
	public function getIdusuario() {
		return $this->idusuario;
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
	 * @return the $grupousuario
	 */
	public function getGrupousuario() {
		return $this->grupousuario;
	}

	/**
	 * @param $idusuario the $idusuarios to set
	 */
	public function setIdusuario($idusuario) {
		$this->idusuario = $idusuario;
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
	 * @param $grupousuario the $grupousuario to set
	 */
	public function setGrupousuario($grupousuario) {
		$this->grupousuario = $grupousuario;
	}

	
    #------------------------------------------------------#
    # Coloque todos os metodos personalizados abaixo de    #
    # END AUTOCODE                                         #
    #------------------------------------------------------#
    #### END AUTOCODE
	
	public function registraUsuarioSessao()
	{
		session_start();
		$_SESSION["loginusuario"] = $this->getUsuario();
		$_SESSION['grupo'] = $this->getGrupousuario();
	}
	/**
	 * @return the $idpessoa
	 */
	public function getIdpessoa() {
		return $this->idpessoa;
	}

	/**
	 * @param $idpessoa the $idpessoa to set
	 */
	public function setIdpessoa($idpessoa) {
		$this->idpessoa = $idpessoa;
	}

	public function validate(){
		
		// limpa os validators anteriores
		Lumine_Validator_PHPValidator::clearValidations($this);
		
		// adicionando as regras 
		Lumine_Validator_PHPValidator::addValidation($this, 'usuario', Lumine_Validator::REQUIRED_STRING, 'Informe o usuário de acesso');
		Lumine_Validator_PHPValidator::addValidation($this, 'senha', Lumine_Validator::REQUIRED_STRING, 'Informe a senha de acesso');
		Lumine_Validator_PHPValidator::addValidation($this, 'grupousuario', Lumine_Validator::REQUIRED_NUMBER, 'Grupo de acesso não informado');
		
		return parent::validate();
	}

	public function getNomeGrupoUsuarios()
	{
		switch ($this->grupousuario)
		{
			case GruposUsuarios::$GRUPO_ADMIN:
				{
					return GruposUsuarios::$GRUPO_ADMIN_TXT;
					break;
				}
			case GruposUsuarios::$GRUPO_ATENDENTE:
				{
					return GruposUsuarios::$GRUPO_ATENDENTE_TXT;
					break;
				}
			case GruposUsuarios::$GRUPO_DEFENSOR:
				{
					return GruposUsuarios::$GRUPO_DEFENSOR_TXT;
					break;
				}
			case GruposUsuarios::$GRUPO_ESTAGIARIO:
				{
					return GruposUsuarios::$GRUPO_ESTAGIARIO_TXT;
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