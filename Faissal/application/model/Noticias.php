<?php

class Noticias extends Lumine_Base {
	
	protected $_tablename = 'noticias';
    protected $_package   = 'model';
    
	public $idNoticia = null;
	public $tituloNoticia = null;
	public $descricaoNoticia = null;
	public $dataNoticia = null;
	public $imagemNoticia = null;
	public $destaque = null;
	public $statusNoticia = null;
	
	/**
     * Inicia os valores da classe
     * @author Jo�o Batista Padilha e Silva
     * @return void
     */
    protected function _initialize()
    {
        
        $this->_addField("idNoticia", "idNoticia", "int", 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->_addField("tituloNoticia", "tituloNoticia", "varchar", 255, array('notnull' => true));
        $this->_addField('descricaoNoticia', 'descricaoNoticia', 'text', null, array('notnull' => false));
        $this->_addField("dataNoticia", "dataNoticia", "datetime", null, array('notnull' => true));
        $this->_addField("imagemNoticia", "imagemNoticia", "varchar", 255, array('notnull' => false));
        $this->_addField("destaque", "destaque", "int", 1, array('notnull' => true));
        $this->_addField("statusNoticia", "statusNoticia", "int", 1, array('notnull' => true));
    }

    /**
     * Recupera um objeto estaticamente
     * @author João Batista Padilha e Silva
     * @return Pessoa
     */
    public static function staticGet($pk, $pkValue = null)
    {
        $obj = new Noticias();
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
	 * @return the $idNoticia
	 */
	public function getIdNoticia() {
		return $this->idNoticia;
	}

	/**
	 * @return the $tituloNoticia
	 */
	public function getTituloNoticia() {
		return $this->tituloNoticia;
	}

	/**
	 * @return the $descricaonoticia
	 */
	public function getDescricaoNoticia() {
		return $this->descricaoNoticia;
	}

	/**
	 * @return the $dataNoticia
	 */
	public function getDataNoticia() {
		return $this->dataNoticia;
	}

	/**
	 * @return the $imagemNoticia
	 */
	public function getImagemNoticia() {
		return $this->imagemNoticia;
	}

	/**
	 * @return the $destaque
	 */
	public function getDestaque() {
		return $this->destaque;
	}

	/**
	 * @return the $statusNoticia
	 */
	public function getStatusNoticia() {
		return $this->statusNoticia;
	}

	/**
	 * @param field_type $idNoticia
	 */
	public function setIdNoticia($idNoticia) {
		$this->idNoticia = $idNoticia;
	}

	/**
	 * @param field_type $tituloNoticia
	 */
	public function setTituloNoticia($tituloNoticia) {
		$this->tituloNoticia = $tituloNoticia;
	}

	/**
	 * @param field_type $descricaonoticia
	 */
	public function setDescricaoNoticia($descricaoNoticia) {
		$this->descricaoNoticia = $descricaoNoticia;
	}

	/**
	 * @param field_type $dataNoticia
	 */
	public function setDataNoticia($dataNoticia) {
		$this->dataNoticia = $dataNoticia;
	}

	/**
	 * @param field_type $imagemNoticia
	 */
	public function setImagemNoticia($imagemNoticia) {
		$this->imagemNoticia = $imagemNoticia;
	}

	/**
	 * @param field_type $destaque
	 */
	public function setDestaque($destaque) {
		$this->destaque = $destaque;
	}

	/**
	 * @param field_type $statusNoticia
	 */
	public function setStatusNoticia($statusNoticia) {
		$this->statusNoticia = $statusNoticia;
	}

	public function getDatanoticiaFormatado()
	{
		if($this->getDataNoticia()!=null)
		{
			$dataHora = explode(" ",$this->getDataNoticia());
			$data = explode("-",$dataHora[0]);
			$dataRetorno = $data[2]."/".$data[1]."/".$data[0]." ".$dataHora[1];
			return $dataRetorno;
		}
		else
		{
			return "";
		}
	}
	
	public function toDataNoticiaDB()
	{
		if($this->getDataNoticia())
		{
			$dataHora = explode(" ",$this->getDataNoticia());
			$data = explode("/", $dataHora[0]);
			return $data[2]."-".$data[1]."-".$data[0]." ".$dataHora[1];
		}
		else
		{
			return null;
		}
	}
	
	
	/**
	 * 
	 * @return string
	 */
	public function getDescricaoStatusNoticia()
	{
		if($this->statusNoticia != null)
		{
			if($this->statusNoticia == 1)
				return "Ativo";
			else 
				return "Inativo";
		}
		else {
			return "";
		}
	}

	public function validate(){
		
		// limpa os validators anteriores
		Lumine_Validator_PHPValidator::clearValidations($this);
		
		// adicionando as regras 
		Lumine_Validator_PHPValidator::addValidation($this, 'tituloNoticia', Lumine_Validator::REQUIRED_STRING, 'Informe o título da notícia');
		return parent::validate();
	}
	
/**
	 * 
	 * Enter description here ...
	 * @param string $dado
	 * @return var
	 */
	public function decodificaDado($dado)
	{
		$dado = str_replace("§gt","'",$dado);
		$dado = str_replace("&ht",chr(34),$dado);
		
		$novohtml = str_replace('\"','',$dado);
		//$novohtml = html_entity_decode($novohtml);
		$novohtml  =  preg_replace ("/\\\\([^'])/e", '"&#" . ord("$1") . ";"', $novohtml); 
   		// delete the backslashes inserted for protecting single quotes 
   		$dado  =  str_replace ("\\'", "&#" . ord ("'") . ";", $novohtml);
   		
		return $dado;
	}
	
}

?>