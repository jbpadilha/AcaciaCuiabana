<?php

class Usuarios extends Lumine_Base{
	
	// sobrecarga
    protected $_tablename = 'usuarios';
    protected $_package   = 'model';
    
	public $idusuario;
	public $datacadastropessoa;		 	 	 	 	 	 	
	public $usuario;		 	 	 	 	 	 	 
	public $senha;
	public $grupousuario;
	
	
	/**
     * Inicia os valores da classe
     * @author João Batista Padilha e Silva
     * @return void
     */
    protected function _initialize()
    {
		# idatividades, atividades
        
        $this->_addField("idusuario", "idusuario", "int", 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->_addField("datacadastropessoa", "datacadastropessoa", "datetime", null, array('notnull' => true));
        $this->_addField("usuario", "usuario", "varchar", 255, array('notnull' => true));
        $this->_addField("senha", "senha", "varchar", 255, array('notnull' => true));
        $this->_addField("grupousuario", "grupousuario", "int", 11, array('notnull' => true));
        
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
	 * @return the $datacadastropessoa
	 */
	public function getDatacadastropessoa() {
		return $this->datacadastropessoa;
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
	 * @param $idusuarios the $idusuarios to set
	 */
	public function setIdusuarios($idusuarios) {
		$this->idusuario = $idusuarios;
	}

	/**
	 * @param $datacadastropessoa the $datacadastropessoa to set
	 */
	public function setDatacadastropessoa($datacadastropessoa) {
		$this->datacadastropessoa = $datacadastropessoa;
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
		session_cache_limiter(5);
		session_start();
		$_SESSION["loginusuario"] = $this->getUsuario();
	}
	
}

?>