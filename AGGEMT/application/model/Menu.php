<?php
class Menu extends Lumine_Base
{

	// sobrecarga
    protected $_tablename = 'menu';
    protected $_package   = 'model';
	
	public $idmenu = null;
	public $descricaoenu = '';
	public $idpagina = null;
	public $linkmenu = '';

	/**
     * Inicia os valores da classe
     * @author Joуo Batista Padilha e Silva
     * @return void
     */
    protected function _initialize()
    {
        
        $this->_addField("idmenu", "idmenu", "int", 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->_addField("descricaomenu", "descricaomenu", "varchar", 255, array('notnull' => true));
        $this->_addField('idpagina', 'idpagina', 'int', 11, array('foreign' => '1', 'onUpdate' => 'CASCADE', 'onDelete' => 'RESTRICT', 'linkOn' => 'idpagina', 'class' => 'Paginas'));
        $this->_addField("linkmenu", "linkmenu", "varchar", 255, array('notnull' => false));
        
    }

    /**
     * Recupera um objeto estaticamente
     * @author Joуo Batista Padilha e Silva
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
	public function getDescricaoenu() {
		return $this->descricaoenu;
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
	public function setDescricaoenu($descricaoenu) {
		$this->descricaoenu = $descricaoenu;
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
		Lumine_Validator_PHPValidator::addValidation($this, 'descricaomenu', Lumine_Validator::REQUIRED_STRING, 'Informe a descriчуo do menu');
		
		return parent::validate();
	}
	
	
}
?>