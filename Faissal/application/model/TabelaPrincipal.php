<?php
//####################################
// * Jo�o Batista Padilha e Silva Especialista em TI (http://www.joaopadilha.eti.br)
// * Arquivo: TabelaPrincipal.php
// * Cria��o: Jo�o Batista Padilha e Silva
// * Data de cria��o: 15/02/2008
// * E-mail: joao.padilha@brturbo.com.br
//####################################
/*
   Classe TabelaPrincipal, que transfere dados de uma Camada para outra.
*/
class TabelaPrincipal extends Lumine_Base
{
	protected $_tablename = 'tabelaprincipal';
    protected $_package   = 'model';
	
	public $idTabelaPrincipal = null;
	public $contatoTabelaPrincipal = '';
	public $fraseDestaqueTabelaPrincipal = '';
	public $localizacaoTabelaPrincipal = '';
	public $rodapeTabelaPrincipal = '';
	
	/**
     * Inicia os valores da classe
     * @author Jo�o Batista Padilha e Silva
     * @return void
     */
    protected function _initialize()
    {
		# idatividades, atividades
        
        $this->_addField("idTabelaPrincipal", "idTabelaPrincipal", "int", 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->_addField("contatoTabelaPrincipal", "contatoTabelaPrincipal", "varchar", 255, array('notnull' => true));
        $this->_addField("fraseDestaqueTabelaPrincipal", "fraseDestaqueTabelaPrincipal", "text", null, array('notnull' => true));
        $this->_addField("localizacaoTabelaPrincipal", "localizacaoTabelaPrincipal", "text", null, array('notnull' => false));
        $this->_addField("rodapeTabelaPrincipal", "rodapeTabelaPrincipal", "text", null, array('notnull' => false));
        
    }
	
    /**
     * Recupera um objeto estaticamente
     * @author Jo�o Batista Padilha e Silva
     * @return Pessoa
     */
    public static function staticGet($pk, $pkValue = null)
    {
        $obj = new TabelaPrincipal();
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
	
	
	public function setIdTabelaPrincipal($id = null)
	{
		$this->idTabelaPrincipal = $id;
	}
	
	public function getIdTabelaPrincipal()
	{
		return $this->idTabelaPrincipal;
	}
	
	public function setContatoTabelaPrincipal($contato = '')
	{
		$this->contatoTabelaPrincipal = $contato;
	}
	
	public function getContatoTabelaPrincipal()
	{
		return $this->contatoTabelaPrincipal;
	}
	
	public function setFraseDestaqueTabelaPrincipal($frase = '')
	{
		$this->fraseDestaqueTabelaPrincipal = $frase;
	}
	
	public function getFraseDestaqueTabelaPrincipal()
	{
		return $this->fraseDestaqueTabelaPrincipal;
	}
	
	public function setLocalizacaoTabelaPrincipal($localizacao = '')
	{
		$this->localizacaoTabelaPrincipal = $localizacao;
	}
	
	public function getLocalizacaoTabelaPrincipal()
	{
		return $this->localizacaoTabelaPrincipal;
	}
	
	public function setRodapeTabelaPrincipal($rodape = '')
	{
		$this->rodapeTabelaPrincipal = $rodape;
	}
	
	public function getRodapeTabelaPrincipal()
	{
		return $this->rodapeTabelaPrincipal;
	}
	
	public function validate(){
		
		// limpa os validators anteriores
		Lumine_Validator_PHPValidator::clearValidations($this);
		
		// adicionando as regras 
		Lumine_Validator_PHPValidator::addValidation($this, 'contatoTabelaPrincipal', Lumine_Validator::REQUIRED_STRING, 'Informe o contato para envio de correspondência via e-mail.');
		
		return parent::validate();
	}
}
?>