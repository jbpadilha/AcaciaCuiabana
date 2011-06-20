<?php
class Enquete extends Lumine_Base {
	
	// sobrecarga
    protected $_tablename = 'enquete';
    protected $_package   = 'model';
	
	public $idenquete = null;
	public $nomeenquete = null;
	public $tipoenquete = 0;
	public $questao1enquete = null;
	public $votos1enqueste = 0;
	public $questao2enquete = null;
	public $votos2enqueste = 0;
	public $questao3enquete = null;
	public $votos3enqueste = 0;
	public $questao4enquete = null;
	public $votos4enqueste = 0;
	public $questao5enquete = null;
	public $votos5enqueste = 0;
	public $statusenquete = 0;

	/**
     * Inicia os valores da classe
     * @author Jo�o Batista Padilha e Silva
     * @return void
     */
    protected function _initialize()
    {
        
        $this->_addField("idenquete", "idenquete", "int", 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->_addField("nomeenquete", "nomeenquete", "varchar", 255, array('notnull' => true));
        $this->_addField("tipoenquete", "tipoenquete", "int", 1, array('notnull' => true));
        $this->_addField("questao1enquete", "questao1enquete", "varchar", 255, array('notnull' => true));
        $this->_addField("votos1enqueste", "votos1enqueste", "int", 11, array('notnull' => true));
        $this->_addField("questao2enquete", "questao2enquete", "varchar", 255, array('notnull' => true));
        $this->_addField("votos2enqueste", "votos2enqueste", "int", 11, array('notnull' => true));
        $this->_addField("questao3enquete", "questao3enquete", "varchar", 255, array('notnull' => false));
        $this->_addField("votos3enqueste", "votos3enqueste", "int", 11, array('notnull' => true));
        $this->_addField("questao4enquete", "questao4enquete", "varchar", 255, array('notnull' => false));
        $this->_addField("votos4enqueste", "votos4enqueste", "int", 11, array('notnull' => true));
        $this->_addField("questao5enquete", "questao5enquete", "varchar", 255, array('notnull' => false));
        $this->_addField("votos5enqueste", "votos5enqueste", "int", 11, array('notnull' => true));
        $this->_addField("statusenquete", "statusenquete", "int", 1, array('notnull' => true));

    }

    /**
     * Recupera um objeto estaticamente
     * @author Jo�o Batista Padilha e Silva
     * @return Pessoa
     */
    public static function staticGet($pk, $pkValue = null)
    {
        $obj = new Enquete();
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
	 * @return the $idenquete
	 */
	public function getIdenquete() {
		return $this->idenquete;
	}

	/**
	 * @return the $nomeenquete
	 */
	public function getNomeenquete() {
		return $this->nomeenquete;
	}

	/**
	 * @return the $tipoenquete
	 */
	public function getTipoenquete() {
		return $this->tipoenquete;
	}

	/**
	 * @return the $questao1enquete
	 */
	public function getQuestao1enquete() {
		return $this->questao1enquete;
	}

	/**
	 * @return the $votos1enqueste
	 */
	public function getVotos1enqueste() {
		return $this->votos1enqueste;
	}

	/**
	 * @return the $questao2enquete
	 */
	public function getQuestao2enquete() {
		return $this->questao2enquete;
	}

	/**
	 * @return the $votos2enqueste
	 */
	public function getVotos2enqueste() {
		return $this->votos2enqueste;
	}

	/**
	 * @return the $questao3enquete
	 */
	public function getQuestao3enquete() {
		return $this->questao3enquete;
	}

	/**
	 * @return the $votos3enqueste
	 */
	public function getVotos3enqueste() {
		return $this->votos3enqueste;
	}

	/**
	 * @return the $questao4enquete
	 */
	public function getQuestao4enquete() {
		return $this->questao4enquete;
	}

	/**
	 * @return the $votos4enqueste
	 */
	public function getVotos4enqueste() {
		return $this->votos4enqueste;
	}

	/**
	 * @return the $questao5enquete
	 */
	public function getQuestao5enquete() {
		return $this->questao5enquete;
	}

	/**
	 * @return the $votos5enqueste
	 */
	public function getVotos5enqueste() {
		return $this->votos5enqueste;
	}

	/**
	 * @return the $statusenquete
	 */
	public function getStatusenquete() {
		return $this->statusenquete;
	}

	/**
	 * @param field_type $idenquete
	 */
	public function setIdenquete($idenquete) {
		$this->idenquete = $idenquete;
	}

	/**
	 * @param field_type $nomeenquete
	 */
	public function setNomeenquete($nomeenquete) {
		$this->nomeenquete = $nomeenquete;
	}

	/**
	 * @param field_type $tipoenquete
	 */
	public function setTipoenquete($tipoenquete) {
		$this->tipoenquete = $tipoenquete;
	}

	/**
	 * @param field_type $questao1enquete
	 */
	public function setQuestao1enquete($questao1enquete) {
		$this->questao1enquete = $questao1enquete;
	}

	/**
	 * @param field_type $votos1enqueste
	 */
	public function setVotos1enqueste($votos1enqueste) {
		$this->votos1enqueste = $votos1enqueste;
	}

	/**
	 * @param field_type $questao2enquete
	 */
	public function setQuestao2enquete($questao2enquete) {
		$this->questao2enquete = $questao2enquete;
	}

	/**
	 * @param field_type $votos2enqueste
	 */
	public function setVotos2enqueste($votos2enqueste) {
		$this->votos2enqueste = $votos2enqueste;
	}

	/**
	 * @param field_type $questao3enquete
	 */
	public function setQuestao3enquete($questao3enquete) {
		$this->questao3enquete = $questao3enquete;
	}

	/**
	 * @param field_type $votos3enqueste
	 */
	public function setVotos3enqueste($votos3enqueste) {
		$this->votos3enqueste = $votos3enqueste;
	}

	/**
	 * @param field_type $questao4enquete
	 */
	public function setQuestao4enquete($questao4enquete) {
		$this->questao4enquete = $questao4enquete;
	}

	/**
	 * @param field_type $votos4enqueste
	 */
	public function setVotos4enqueste($votos4enqueste) {
		$this->votos4enqueste = $votos4enqueste;
	}

	/**
	 * @param field_type $questao5enquete
	 */
	public function setQuestao5enquete($questao5enquete) {
		$this->questao5enquete = $questao5enquete;
	}

	/**
	 * @param field_type $votos5enqueste
	 */
	public function setVotos5enqueste($votos5enqueste) {
		$this->votos5enqueste = $votos5enqueste;
	}

	/**
	 * @param field_type $statusenquete
	 */
	public function setStatusenquete($statusenquete) {
		$this->statusenquete = $statusenquete;
	}

	public function validate(){
		
		// limpa os validators anteriores
		Lumine_Validator_PHPValidator::clearValidations($this);
		
		// adicionando as regras
		Lumine_Validator_PHPValidator::addValidation($this, 'nomeenquete', Lumine_Validator::REQUIRED_STRING, 'Por favor, forneça o nome da enquete.'); 
		
		return parent::validate();
	}
	
	/**
	 * 
	 * Retorna a quantidade de questões
	 * @return int
	 */
	public function getNumeroPerguntas()
	{
		$nPerguntas = 2;
		if($this->getQuestao3enquete()!=null)
			$nPerguntas++;
		if($this->getQuestao4enquete()!=null)
			$nPerguntas++;
		if($this->getQuestao5enquete()!=null)
			$nPerguntas++;
		return $nPerguntas;
	}
	/**
	 * 
	 * Retorna a quantidade de votos já computados
	 * 
	 */
	public function getTotalVotos()
	{
		$votos = 0;
		if($this->getQuestao1enquete()!=null)
			$votos = $votos + $this->getVotos1enqueste();
		if($this->getQuestao1enquete()!=null)
			$votos = $votos + $this->getVotos2enqueste();
		if($this->getQuestao3enquete()!=null)
			$votos = $votos + $this->getVotos3enqueste();
		if($this->getQuestao4enquete()!=null)
			$votos = $votos + $this->getVotos4enqueste();
		if($this->getQuestao5enquete()!=null)
			$votos = $votos + $this->getVotos5enqueste();
		
		return $votos;
	}
}

?>