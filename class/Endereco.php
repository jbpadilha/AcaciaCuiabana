<?php
/**
 * Classe Endereco
 * @author Joao Padilha
 * @version 1.0
 */
class Endereco
{

	private $idEndereco;
	private $ruaEndereco;
	private $complementoEndereco;
	private $bairroEndereco;
	private $cepEndereco;
	private $estadoEndereco;
	private $cidadeEndereco;
	private $telefoneEndereco;
	private $celEndereco;
	private $faxEndereco;
	private $emailEndereco;
	private $idPessoa;
	private $idEmpresa;
	
	
	/**
	 * @return the $idEndereco
	 */
	public function getIdEndereco() {
		return $this->idEndereco;
	}

	/**
	 * @return the $ruaEndereco
	 */
	public function getRuaEndereco() {
		return $this->ruaEndereco;
	}

	/**
	 * @return the $complementoEndereco
	 */
	public function getComplementoEndereco() {
		return $this->complementoEndereco;
	}

	/**
	 * @return the $BairroEndereco
	 */
	public function getBairroEndereco() {
		return $this->bairroEndereco;
	}

	/**
	 * @return the $cepEndereco
	 */
	public function getCepEndereco() {
		return $this->cepEndereco;
	}

	/**
	 * @return the $estadoEndereco
	 */
	public function getEstadoEndereco() {
		return $this->estadoEndereco;
	}

	/**
	 * @return the $cidadeEndereco
	 */
	public function getCidadeEndereco() {
		return $this->cidadeEndereco;
	}

	/**
	 * @return the $telefoneEndereco
	 */
	public function getTelefoneEndereco() {
		return $this->telefoneEndereco;
	}

	/**
	 * @return the $celEndereco
	 */
	public function getCelEndereco() {
		return $this->celEndereco;
	}

	/**
	 * @return the $faxEndereco
	 */
	public function getFaxEndereco() {
		return $this->faxEndereco;
	}

	/**
	 * @return the $emailEndereco
	 */
	public function getEmailEndereco() {
		return $this->emailEndereco;
	}

	/**
	 * @return the $idPessoa
	 */
	public function getIdPessoa() {
		return $this->idPessoa;
	}

	/**
	 * @return the $idEmpresa
	 */
	public function getIdEmpresa() {
		return $this->idEmpresa;
	}

	/**
	 * @param $idEndereco the $idEndereco to set
	 */
	public function setIdEndereco($idEndereco) {
		$this->idEndereco = $idEndereco;
	}

	/**
	 * @param $ruaEndereco the $ruaEndereco to set
	 */
	public function setRuaEndereco($ruaEndereco) {
		$this->ruaEndereco = $ruaEndereco;
	}

	/**
	 * @param $complementoEndereco the $complementoEndereco to set
	 */
	public function setComplementoEndereco($complementoEndereco) {
		$this->complementoEndereco = $complementoEndereco;
	}

	/**
	 * @param $BairroEndereco the $BairroEndereco to set
	 */
	public function setBairroEndereco($bairroEndereco) {
		$this->bairroEndereco = $bairroEndereco;
	}

	/**
	 * @param $cepEndereco the $cepEndereco to set
	 */
	public function setCepEndereco($cepEndereco) {
		$this->cepEndereco = $cepEndereco;
	}

	/**
	 * @param $estadoEndereco the $estadoEndereco to set
	 */
	public function setEstadoEndereco($estadoEndereco) {
		$this->estadoEndereco = $estadoEndereco;
	}

	/**
	 * @param $cidadeEndereco the $cidadeEndereco to set
	 */
	public function setCidadeEndereco($cidadeEndereco) {
		$this->cidadeEndereco = $cidadeEndereco;
	}

	/**
	 * @param $telefoneEndereco the $telefoneEndereco to set
	 */
	public function setTelefoneEndereco($telefoneEndereco) {
		$this->telefoneEndereco = $telefoneEndereco;
	}

	/**
	 * @param $celEndereco the $celEndereco to set
	 */
	public function setCelEndereco($celEndereco) {
		$this->celEndereco = $celEndereco;
	}

	/**
	 * @param $faxEndereco the $faxEndereco to set
	 */
	public function setFaxEndereco($faxEndereco) {
		$this->faxEndereco = $faxEndereco;
	}

	/**
	 * @param $emailEndereco the $emailEndereco to set
	 */
	public function setEmailEndereco($emailEndereco) {
		$this->emailEndereco = $emailEndereco;
	}

	/**
	 * @param $idPessoa the $idPessoa to set
	 */
	public function setIdPessoa($idPessoa) {
		$this->idPessoa = $idPessoa;
	}

	/**
	 * @param $idEmpresa the $idEmpresa to set
	 */
	public function setIdEmpresa($idEmpresa) {
		$this->idEmpresa = $idEmpresa;
	}

	/**
	 * Método de retorno dos dados do endereço
	 * @return string
	 */
	public function mostraDadosEndereco()
	{
		$string = "";
		$string = "
		<b>endereço: </b>{$this->ruaEndereco}<br>
		<b>Complemento: </b>{$this->complementoEndereco}<br>
		<b>Bairro: </b>{$this->bairroEndereco}<br>
		<b>CEP: </b>{$this->cepEndereco}<br>
		<b>Cidade/Estado: </b>{$this->cidadeEndereco}/{$this->estadoEndereco}<br>
		<b>Telefone: </b>{$this->telefoneEndereco}<br>
		<b>Celular: </b>{$this->celEndereco}<br>
		<b>Fax: </b>{$this->faxEndereco}<br>
		<b>E-mail: </b>{$this->emailEndereco}<br>
		";
		
		return $string;
	}
}
?>