<?php
//####################################
// * Jo�o Batista Padilha e Silva Especialista em TI (http://www.joaopadilha.com)
// * Arquivo: ImagensUteis.php
// * Cria��o: Jo�o Batista Padilha e Silva
// * Data de cria��o: 11/02/2011
// * E-mail: joao.padilha@globo.com
//####################################
/*
   Classe ImagensUteis, que transfere dados de uma Camada para outra.
*/

class ImagensUteis extends Lumine_Base
{
	protected $_tablename = 'imagensuteis';
    protected $_package   = 'model';
	
	public $idImagensUteis = null;
	public $localImagensUteis = '';
	public $nomeImagensUteis = '';
	
	
	/**
     * Inicia os valores da classe
     * @author Jo�o Batista Padilha e Silva
     * @return void
     */
    protected function _initialize()
    {
        $this->_addField("idImagensUteis", "idImagensUteis", "int", 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->_addField("localImagensUteis", "localImagensUteis", "varchar", 255, array('notnull' => false, 'default' => 0));
        $this->_addField("nomeImagensUteis", "nomeImagensUteis", "varchar", 255, array('notnull' => false, 'default' => 0));
        
    }
	
    /**
     * Recupera um objeto estaticamente
     * @author Jo�o Batista Padilha e Silva
     * @return Pessoa
     */
    public static function staticGet($pk, $pkValue = null)
    {
        $obj = new ImagensUteis();
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
	
	
	public function setIdImagensUteis($id = null)
	{
		$this->idImagensUteis = $id;
	}
	
	public function getIdImagensUteis()
	{
		return $this->idImagensUteis;
	}
	
	public function setLocalImagensUteis($local = '')
	{
		$this->localImagensUteis = $local;
	}
	
	public function getLocalImagensUteis()
	{
		return $this->localImagensUteis;
	}
	
	public function setNomeImagensUteis($nome = '')
	{
		$this->nomeImagensUteis = $nome;
	}
	
	public function getNomeImagensUteis()
	{
		return $this->nomeImagensUteis;
	}
	
	public function validate()
	{
		// limpa os validators anteriores
		Lumine_Validator_PHPValidator::clearValidations($this);
		// adicionando as regras 
		Lumine_Validator_PHPValidator::addValidation($this, 'nomeImagensUteis', Lumine_Validator::REQUIRED_STRING, 'Informe o nome da Imagem');
		
		return parent::validate();
	}
}
?>