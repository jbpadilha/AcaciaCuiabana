<?php
/**
 * Classe Empresas
 * @author Joao Padilha
 * @version 1.0
 */
class Empresas
{

	private $idEmpresa;
	private $cnpjEmpresa;
	private $nomeEmpresa;
	private $nomeFantasiaEmpresa;
	private $dataFundacaoEmpresa;
	private $origemEmpresa;
	private $ramoEmpresa;
	private $inscricaoEstadualEmpresa;
	private $dataCadastro;
	private $idDiretor;
	private $idClientes;
	
	/**
	 * @return the $idEmpresa
	 */
	public function getIdEmpresa() {
		return $this->idEmpresa;
	}

	/**
	 * @return the $cnpjEmpresa
	 */
	public function getCnpjEmpresa() {
		return $this->cnpjEmpresa;
	}

	/**
	 * @return the $nomeEmpresa
	 */
	public function getNomeEmpresa() {
		return $this->nomeEmpresa;
	}

	/**
	 * @return the $nomeFantasiaEmpresa
	 */
	public function getNomeFantasiaEmpresa() {
		return $this->nomeFantasiaEmpresa;
	}

	/**
	 * @return the $dataFundacaoEmpresa
	 */
	public function getDataFundacaoEmpresa() {
		return $this->dataFundacaoEmpresa;
	}

	/**
	 * @return the $origemEmpresa
	 */
	public function getOrigemEmpresa() {
		return $this->origemEmpresa;
	}

	/**
	 * @return the $ramoEmpresa
	 */
	public function getRamoEmpresa() {
		return $this->ramoEmpresa;
	}

	/**
	 * @return the $inscricaoEstadualEmpresa
	 */
	public function getInscricaoEstadualEmpresa() {
		return $this->inscricaoEstadualEmpresa;
	}

	/**
	 * @return the $dataCadastro
	 */
	public function getDataCadastro() {
		return $this->dataCadastro;
	}

	/**
	 * @return the $idDiretor
	 */
	public function getIdDiretor() {
		return $this->idDiretor;
	}

	/**
	 * @param $idEmpresa the $idEmpresa to set
	 */
	public function setIdEmpresa($idEmpresa) {
		$this->idEmpresa = $idEmpresa;
	}

	/**
	 * @param $cnpjEmpresa the $cnpjEmpresa to set
	 */
	public function setCnpjEmpresa($cnpjEmpresa) {
		$this->cnpjEmpresa = $cnpjEmpresa;
	}

	/**
	 * @param $nomeEmpresa the $nomeEmpresa to set
	 */
	public function setNomeEmpresa($nomeEmpresa) {
		$this->nomeEmpresa = $nomeEmpresa;
	}

	/**
	 * @param $nomeFantasiaEmpresa the $nomeFantasiaEmpresa to set
	 */
	public function setNomeFantasiaEmpresa($nomeFantasiaEmpresa) {
		$this->nomeFantasiaEmpresa = $nomeFantasiaEmpresa;
	}

	/**
	 * @param $dataFundacaoEmpresa the $dataFundacaoEmpresa to set
	 */
	public function setDataFundacaoEmpresa($dataFundacaoEmpresa) {
		$this->dataFundacaoEmpresa = $dataFundacaoEmpresa;
	}

	/**
	 * @param $origemEmpresa the $origemEmpresa to set
	 */
	public function setOrigemEmpresa($origemEmpresa) {
		$this->origemEmpresa = $origemEmpresa;
	}

	/**
	 * @param $ramoEmpresa the $ramoEmpresa to set
	 */
	public function setRamoEmpresa($ramoEmpresa) {
		$this->ramoEmpresa = $ramoEmpresa;
	}

	/**
	 * @param $inscricaoEstadualEmpresa the $inscricaoEstadualEmpresa to set
	 */
	public function setInscricaoEstadualEmpresa($inscricaoEstadualEmpresa) {
		$this->inscricaoEstadualEmpresa = $inscricaoEstadualEmpresa;
	}

	/**
	 * @param $dataCadastro the $dataCadastro to set
	 */
	public function setDataCadastro($dataCadastro) {
		$this->dataCadastro = $dataCadastro;
	}

	/**
	 * @param $idDiretor the $idDiretor to set
	 */
	public function setIdDiretor($idDiretor) {
		$this->idDiretor = $idDiretor;
	}
	/**
	 * @return the $idClientes
	 */
	public function getIdClientes() {
		return $this->idClientes;
	}

	/**
	 * @param $idClientes the $idClientes to set
	 */
	public function setIdClientes($idClientes) {
		$this->idClientes = $idClientes;
	}
	
	/**
	 * Método que lista os dados da empresa
	 */
	public function mostraDados()
	{
		$formataData = new FormataData();
		$string = '';
		$string = "
		<b>Nome da Empresa:</b> {$this->nomeEmpresa}<br>
		<b>Nome Fantasia:</b> {$this->nomeFantasiaEmpresa}<br>
		<b>CNPJ:</b> {$this->cnpjEmpresa}<br>
		<b>Data de Fundação:</b> {$formataData->toViewDate($this->dataFundacaoEmpresa)}<br>
		<b>Origem:</b> {$this->origemEmpresa}<br>
		<b>Ramo:</b> {$this->ramoEmpresa}<br>
		<b>Inscrição Estadual:</b> {$this->inscricaoEstadualEmpresa}<br>
		";
		return $string;
		
	}

	public function getEnderecoEmpresa()
	{
		$controla = new ControlaFuncionalidades();
		$endereco = new Endereco();
		$endereco->setIdEmpresa($this->getIdEmpresa());
		$collVo = $controla->findEndereco($endereco);
		$endereco = (object)$collVo[0];
		if(is_null($endereco->getEmailEndereco()))
		{
			$endereco = new Endereco();
			$endereco->setIdPessoa($this->getIdDiretor());
			$collVo = $controla->findEndereco($endereco);
			$endereco = (object)$collVo[0];
		}
		return $endereco;
	}
}
?>