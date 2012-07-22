<?php
//####################################
// * Jo�o Batista Padilha e Silva Especialista em TI (http://www.joaopadilha.com)
// * Arquivo: Curiosidades.php
// * Cria��o: Jo�o Batista Padilha e Silva
// * Data de cria��o: 11/02/2011
// * E-mail: joao.padilha@globo.com
//####################################
/*
   Classe Curiosidades, que transfere dados de uma Camada para outra.
*/

class Curiosidades extends Lumine_Base
{
	protected $_tablename = 'curiosidades';
    protected $_package   = 'model';
	
	public $idCuriosidades = null;
	public $tituloCuriosidades = '';
	public $descricaoCuriosidades = '';
	
	/**
     * Inicia os valores da classe
     * @author Jo�o Batista Padilha e Silva
     * @return void
     */
    protected function _initialize()
    {
        
        $this->_addField("idCuriosidades", "idCuriosidades", "int", 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->_addField("tituloCuriosidades", "tituloCuriosidades", "varchar", 255, array('notnull' => true));
        $this->_addField("descricaoCuriosidades", "descricaoCuriosidades", "text", null, array('notnull' => true));
        
    }
	
    /**
     * Recupera um objeto estaticamente
     * @author Jo�o Batista Padilha e Silva
     * @return Pessoa
     */
    public static function staticGet($pk, $pkValue = null)
    {
        $obj = new Curiosidades();
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
	 * @return the $idCuriosidades
	 */
	public function getIdCuriosidades() {
		return $this->idCuriosidades;
	}

	/**
	 * @return the $tituloCuriosidades
	 */
	public function getTituloCuriosidades() {
		return $this->tituloCuriosidades;
	}

	/**
	 * @return the $descricaoCuriosidades
	 */
	public function getDescricaoCuriosidades() {
		return $this->descricaoCuriosidades;
	}

	/**
	 * @param field_type $idCuriosidades
	 */
	public function setIdCuriosidades($idCuriosidades) {
		$this->idCuriosidades = $idCuriosidades;
	}

	/**
	 * @param field_type $tituloCuriosidades
	 */
	public function setTituloCuriosidades($tituloCuriosidades) {
		$this->tituloCuriosidades = $tituloCuriosidades;
	}

	/**
	 * @param field_type $descricaoCuriosidades
	 */
	public function setDescricaoCuriosidades($descricaoCuriosidades) {
		$this->descricaoCuriosidades = $descricaoCuriosidades;
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
		Lumine_Validator_PHPValidator::addValidation($this, 'tituloCuriosidades', Lumine_Validator::REQUIRED_STRING, 'Informe o t�tulo da curiosidade');
		Lumine_Validator_PHPValidator::addValidation($this, 'descricaoCuriosidades', Lumine_Validator::REQUIRED_STRING, 'Informe a descri��o da curiosidade');
		
		return parent::validate();
	}

}
?>