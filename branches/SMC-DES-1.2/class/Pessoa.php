<?php
/**
 * CLasse Pessoa
 * @author Joao Padilha
 * @version 1.0
 */
class Pessoa
{

	private $idPessoa;
	private $cpfPessoa;
	private $nomePessoa;
	private $dataNascimentoPessoa;
	private $sexoPessoa;
	private $estadoCivilPessoa;
	private $rgPessoa;
	private $orgExpPessoa;
	private $ufOrgExpPessoa;
	private $complementoPessoa;
	private $idConjuguePessoa;
	private $idCliente;
	
	/**
	 * @return the $idPessoa
	 */
	public function getIdPessoa() {
		return $this->idPessoa;
	}

	/**
	 * @return the $cpfPessoa
	 */
	public function getCpfPessoa() {
		return $this->cpfPessoa;
	}

	/**
	 * @return the $NomePessoa
	 */
	public function getNomePessoa() {
		return $this->nomePessoa;
	}

	/**
	 * @return the $dataNascimentoPessoa
	 */
	public function getDataNascimentoPessoa() {
		return $this->dataNascimentoPessoa;
	}

	/**
	 * @return the $sexoPessoa
	 */
	public function getSexoPessoa() {
		return $this->sexoPessoa;
	}

	/**
	 * @return the $estadoCivilPessoa
	 */
	public function getEstadoCivilPessoa() {
		return $this->estadoCivilPessoa;
	}

	/**
	 * @return the $rgPessoa
	 */
	public function getRgPessoa() {
		return $this->rgPessoa;
	}

	/**
	 * @return the $orgExpPessoa
	 */
	public function getOrgExpPessoa() {
		return $this->orgExpPessoa;
	}

	/**
	 * @return the $ufOrgExpPessoa
	 */
	public function getUfOrgExpPessoa() {
		return $this->ufOrgExpPessoa;
	}

	/**
	 * @return the $complementoPessoa
	 */
	public function getComplementoPessoa() {
		return $this->complementoPessoa;
	}

	/**
	 * @param $idPessoa the $idPessoa to set
	 */
	public function setIdPessoa($idPessoa) {
		if($idPessoa != '')
			$this->idPessoa = $idPessoa;
	}

	/**
	 * @param $cpfPessoa the $cpfPessoa to set
	 */
	public function setCpfPessoa($cpfPessoa) 
	{
		if($cpfPessoa != '')
			$this->cpfPessoa = $cpfPessoa;
	}

	/**
	 * @param $NomePessoa the $NomePessoa to set
	 */
	public function setNomePessoa($nomePessoa) 
	{
		if($nomePessoa != '')
			$this->nomePessoa = $nomePessoa;
	}

	/**
	 * @param $dataNascimentoPessoa the $dataNascimentoPessoa to set
	 */
	public function setDataNascimentoPessoa($dataNascimentoPessoa) 
	{
		if($dataNascimentoPessoa != '')
			$this->dataNascimentoPessoa = $dataNascimentoPessoa;
	}

	/**
	 * @param $sexoPessoa the $sexoPessoa to set
	 */
	public function setSexoPessoa($sexoPessoa) 
	{
		if($sexoPessoa != '')
			$this->sexoPessoa = $sexoPessoa;
	}

	/**
	 * @param $estadoCivilPessoa the $estadoCivilPessoa to set
	 */
	public function setEstadoCivilPessoa($estadoCivilPessoa) 
	{
		if($estadoCivilPessoa != '')
			$this->estadoCivilPessoa = $estadoCivilPessoa;
	}

	/**
	 * @param $rgPessoa the $rgPessoa to set
	 */
	public function setRgPessoa($rgPessoa) 
	{
		if($rgPessoa != '')
			$this->rgPessoa = $rgPessoa;
	}

	/**
	 * @param $orgExpPessoa the $orgExpPessoa to set
	 */
	public function setOrgExpPessoa($orgExpPessoa) 
	{
		if($orgExpPessoa != '')
			$this->orgExpPessoa = $orgExpPessoa;
	}

	/**
	 * @param $ufOrgExpPessoa the $ufOrgExpPessoa to set
	 */
	public function setUfOrgExpPessoa($ufOrgExpPessoa) 
	{
		if($ufOrgExpPessoa != '')
			$this->ufOrgExpPessoa = $ufOrgExpPessoa;
	}

	/**
	 * @param $complementoPessoa the $complementoPessoa to set
	 */
	public function setComplementoPessoa($complementoPessoa) 
	{
		if($complementoPessoa != '')
			$this->complementoPessoa = $complementoPessoa;
	}

	/**
	 * @return the $idConjuguePessoa
	 */
	public function getIdConjuguePessoa() {
		return $this->idConjuguePessoa;
	}

	/**
	 * @param $idConjuguePessoa the $idConjuguePessoa to set
	 */
	public function setIdConjuguePessoa($idConjuguePessoa) 
	{
		if($idConjuguePessoa != '')
			$this->idConjuguePessoa = $idConjuguePessoa;
	}
	
	/**
	 * Método que mostra todos os dados de uma pessoa, em formato String
	 * @return string
	 */
	public function mostraDadosPessoa()
	{
		$formataData = new FormataData();
		$string = '';
		$string = "
		<b>Nome:</b> {$this->nomePessoa}<br>
		<b>CPF:</b> {$this->cpfPessoa}<br>
		<b>Data de Nascimento:</b> {$formataData->toViewDate($this->dataNascimentoPessoa)}<br>
		<b>Sexo:</b> {$this->sexoPessoa}<br>
		<b>Estado Civil:</b> {$this->estadoCivilPessoa}<br>
		<b>RG:</b> {$this->rgPessoa}<br>
		<b>Org. Expeditor:</b> {$this->orgExpPessoa}<br>
		<b>Complemento:</b> {$this->complementoPessoa}<br>
		";
		return $string;
	}
	/**
	 * @return the $idCliente
	 */
	public function getIdCliente() {
		return $this->idCliente;
	}

	/**
	 * @param $idCliente the $idCliente to set
	 */
	public function setIdCliente($idCliente) 
	{
		if($idCliente != '')
			$this->idCliente = $idCliente;
	}

	public function retornaEndereco()
	{
		$controla = new ControlaFuncionalidades();
		$endereco = new Endereco();
		$endereco->setIdPessoa($this->getIdPessoa());
		$collVo = $controla->findEndereco($endereco);
		$endereco = $collVo[0];
		return $endereco; 
	}
}
?>