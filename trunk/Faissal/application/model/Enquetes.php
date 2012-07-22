<?php
//####################################
// * Jo�o Batista Padilha e Silva Especialista em TI (http://www.joaopadilha.com)
// * Arquivo: Enquetes.php
// * Cria��o: Jo�o Batista Padilha e Silva
// * Data de cria��o: 11/02/2011
// * E-mail: joao.padilha@globo.com
//####################################
/*
   Classe AgendaVo, que transfere dados de uma Camada para outra.
*/

class Enquetes extends Lumine_Base
{
	protected $_tablename = 'enquetes';
    protected $_package   = 'model';
    
	public $idEnquete = null;
	public $nomeEnquete = '';
	public $op1Enquete = '';
	public $votos1Enquete = '';
	public $op2Enquete = '';
	public $votos2Enquete = '';
	public $op3Enquete = '';
	public $votos3Enquete = '';
	public $op4Enquete = '';
	public $votos4Enquete = '';
	public $op5Enquete = '';
	public $votos5Enquete = '';
	public $exibirEnquete = '';
	
	/**
     * Inicia os valores da classe
     * @author Jo�o Batista Padilha e Silva
     * @return void
     */
    protected function _initialize()
    {
        
        $this->_addField("idEnquete", "idEnquete", "int", 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->_addField("nomeEnquete", "nomeEnquete", "varchar", 255, array('notnull' => true));
        $this->_addField("op1Enquete", "op1Enquete", "varchar", 255, array('notnull' => true));
        $this->_addField("votos1Enquete", "votos1Enquete", "int", 3, array('notnull' => false, 'default' => 0));
        $this->_addField("op2Enquete", "op2Enquete", "varchar", 255, array('notnull' => false));
        $this->_addField("votos2Enquete", "votos2Enquete", "int", 3, array('notnull' => true));
        $this->_addField("op3Enquete", "op3Enquete", "varchar", 255, array('notnull' => false));
        $this->_addField("votos3Enquete", "votos3Enquete", "int", 3, array('notnull' => true));
        $this->_addField("op4Enquete", "op4Enquete", "varchar", 255, array('notnull' => false));
        $this->_addField("votos4Enquete", "votos4Enquete", "int", 3, array('notnull' => true));
        $this->_addField("op5Enquete", "op5Enquete", "varchar", 255, array('notnull' => false));
        $this->_addField("votos5Enquete", "votos5Enquete", "int", 3, array('notnull' => true));
        $this->_addField("exibirEnquete", "exibirEnquete", "char", 1, array('notnull' => true));
        
    }
	
    /**
     * Recupera um objeto estaticamente
     * @author Jo�o Batista Padilha e Silva
     * @return Pessoa
     */
    public static function staticGet($pk, $pkValue = null)
    {
        $obj = new Enquetes();
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
	
	
	
	public function getidEnquete()
	{
		return $this->idEnquete;
	}
	
	public function setidEnquete($id)
	{
		$this->idEnquete = $id;
	}
	
	public function getnomeEnquete()
	{
		return $this->nomeEnquete;
	}
	
	public function setnomeEnquete($nome)
	{
		$this->nomeEnquete = $nome;
	}
	
	public function getop1Enquete()
	{
		return $this->op1Enquete;
	}
	
	public function setop1Enquete($opcao)
	{
		$this->op1Enquete = $opcao;
	}
	
	public function getvotos1Enquete()
	{
		return $this->votos1Enquete;
	}
	
	public function setvotos1Enquete($votos)
	{
		$this->votos1Enquete = $votos;
	}
	
	public function getop2Enquete()
	{
		return $this->op2Enquete;
	}
	
	public function setop2Enquete($opcao)
	{
		$this->op2Enquete = $opcao;
	}
	
	public function getvotos2Enquete()
	{
		return $this->votos2Enquete;
	}
	
	public function setvotos2Enquete($votos)
	{
		$this->votos2Enquete = $votos;
	}
	
	public function getop3Enquete()
	{
		return $this->op3Enquete;
	}
	
	public function setop3Enquete($opcao)
	{
		$this->op3Enquete = $opcao;
	}
	
	public function getvotos3Enquete()
	{
		return $this->votos3Enquete;
	}
	
	public function setvotos3Enquete($votos)
	{
		$this->votos3Enquete = $votos;
	}
	
	public function getop4Enquete()
	{
		return $this->op4Enquete;
	}
	
	public function setop4Enquete($opcao)
	{
		$this->op4Enquete = $opcao;
	}
	
	public function getvotos4Enquete()
	{
		return $this->votos4Enquete;
	}
	
	public function setvotos4Enquete($votos)
	{
		$this->votos4Enquete = $votos;
	}
	
	public function getop5Enquete()
	{
		return $this->op5Enquete;
	}
	
	public function setop5Enquete($opcao)
	{
		$this->op5Enquete = $opcao;
	}
	
	public function getvotos5Enquete()
	{
		return $this->votos5Enquete;
	}
	
	public function setvotos5Enquete($votos)
	{
		$this->votos5Enquete = $votos;
	}
	
	public function getexibirEnquete()
	{
		return $this->exibirEnquete;
	}
	
	public function setexibirEnquete($exibir)
	{
		$this->exibirEnquete = $exibir;
	}

	public function validate()
	{
		// limpa os validators anteriores
		Lumine_Validator_PHPValidator::clearValidations($this);
		// adicionando as regras 
		Lumine_Validator_PHPValidator::addValidation($this, 'nomeEnquete', Lumine_Validator::REQUIRED_STRING, 'Informe o nome da enqu�te');
		Lumine_Validator_PHPValidator::addValidation($this, 'op1Enquete', Lumine_Validator::REQUIRED_STRING, 'Informe a pergunta da enquete');
		Lumine_Validator_PHPValidator::addValidation($this, 'op2Enquete', Lumine_Validator::REQUIRED_STRING, 'Informe a pergunta da enquete');
		
		return parent::validate();
	}
	
}
?>