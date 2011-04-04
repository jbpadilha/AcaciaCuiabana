<?php
class Menu extends Lumine_Base
{

	// sobrecarga
    protected $_tablename = 'menu';
    protected $_package   = 'model';
	
	public $idmenu = null;
	public $descricaomenu = null;
	public $idpagina = null;
	public $linkmenu = null;

	/**
     * Inicia os valores da classe
     * @author Jo�o Batista Padilha e Silva
     * @return void
     */
    protected function _initialize()
    {
        
        $this->_addField("idmenu", "idmenu", "int", 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->_addField("descricaomenu", "descricaomenu", "varchar", 255, array('notnull' => true));
        $this->_addField('idpagina', 'idpagina', 'int', 11, array('notnull' => false,'foreign' => '1', 'onUpdate' => 'CASCADE', 'onDelete' => 'RESTRICT', 'linkOn' => 'idpagina', 'class' => 'Paginas'));
        $this->_addField("linkmenu", "linkmenu", "varchar", 255, array('notnull' => false));

        $this->_addForeignRelation('submenu', self::ONE_TO_MANY, 'Submenu', 'idmenu', null, null, null);
    }

    /**
     * Recupera um objeto estaticamente
     * @author Jo�o Batista Padilha e Silva
     * @return Pessoa
     */
    public static function staticGet($pk, $pkValue = null)
    {
        $obj = new Menu();
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
	 * @return the $idmenu
	 */
	public function getIdmenu() {
		return $this->idmenu;
	}

	/**
	 * @return the $descricaoenu
	 */
	public function getDescricaomenu() {
		return $this->descricaomenu;
	}

	/**
	 * @return the $idpagina
	 */
	public function getIdpagina() {
		return $this->idpagina;
	}

	/**
	 * @return the $linkmenu
	 */
	public function getLinkmenu() {
		return $this->linkmenu;
	}

	/**
	 * @param field_type $idmenu
	 */
	public function setIdmenu($idmenu) {
		$this->idmenu = $idmenu;
	}

	/**
	 * @param field_type $descricaoenu
	 */
	public function setDescricaomenu($descricaomenu) {
		$this->descricaomenu = $descricaomenu;
	}

	/**
	 * @param field_type $idpagina
	 */
	public function setIdpagina($idpagina) {
		$this->idpagina = $idpagina;
	}

	/**
	 * @param field_type $linkmenu
	 */
	public function setLinkmenu($linkmenu) {
		$this->linkmenu = $linkmenu;
	}
	
	public function validate(){
		
		// limpa os validators anteriores
		Lumine_Validator_PHPValidator::clearValidations($this);
		
		// adicionando as regras 
		Lumine_Validator_PHPValidator::addValidation($this, 'descricaomenu', Lumine_Validator::REQUIRED_STRING, 'Informe a descri��o do menu');
		
		return parent::validate();
	}
	
	
}
?>