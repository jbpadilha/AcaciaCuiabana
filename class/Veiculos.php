<?php
/**
 * Classe Veiculos
 * @author Joao Padilha
 * @version 1.0
 */
class Veiculos
{

	private $idVeiculos;
	private $placaVeiculos;
	private $marcaVeiculos;
	private $modeloVeiculos;
	private $corVeiculos;
	private $combustivelVeiculos;
	private $capacidadeTanqueVeiculos;
	private $anoFabricacaoVeiculos;
	private $modeloFabricacaoVeiculos;
	private $renavamVeiculos;
	private $chassiVeiculos;
	private $tipoVeiculos;
	private $codFipeVeiculos;
	private $placaNfVeiculos;
	private $numeroNfVeiculos;
	private $fornecedorNfVeiculos;
	private $dataNfVeiculos;
	private $cidadeNfVeiculos;
	private $estadoNfVeiculos;
	private $dataEntregaNfVeiculos;
	private $kmEntregaNfVeiculos;
	private $proprietarioNfVeiculos;
	private $arrendatarioNfVeiculos;
	private $contratanteNfveiculos;
	private $tempoGarantiaNfVeiculos;
	private $kmGarantiaVeiculos;
	private $vencimentoSeguroVeiculos;
	private $vencimentoIpvaVeiculos;
	private $idClientes;
	
	/**
	 * @return the $idVeiculos
	 */
	/**
	 * @return the $vencimentoIpvaVeiculos
	 */
	public function getVencimentoIpvaVeiculos() {
		return $this->vencimentoIpvaVeiculos;
	}

	/**
	 * @param $vencimentoIpvaVeiculos the $vencimentoIpvaVeiculos to set
	 */
	public function setVencimentoIpvaVeiculos($vencimentoIpvaVeiculos) {
		$this->vencimentoIpvaVeiculos = $vencimentoIpvaVeiculos;
	}

	public function getIdVeiculos() {
		return $this->idVeiculos;
	}

	/**
	 * @return the $placaVeiculos
	 */
	public function getPlacaVeiculos() {
		return $this->placaVeiculos;
	}

	/**
	 * @return the $marcaVeiculos
	 */
	public function getMarcaVeiculos() {
		return $this->marcaVeiculos;
	}

	/**
	 * @return the $modeloVeiculos
	 */
	public function getModeloVeiculos() {
		return $this->modeloVeiculos;
	}

	/**
	 * @return the $corVeiculos
	 */
	public function getCorVeiculos() {
		return $this->corVeiculos;
	}

	/**
	 * @return the $combustivelVeiculos
	 */
	public function getCombustivelVeiculos() {
		return $this->combustivelVeiculos;
	}

	/**
	 * @return the $capacidadeTanqueVeiculos
	 */
	public function getCapacidadeTanqueVeiculos() {
		return $this->capacidadeTanqueVeiculos;
	}

	/**
	 * @return the $anoFabricacaoVeiculos
	 */
	public function getAnoFabricacaoVeiculos() {
		return $this->anoFabricacaoVeiculos;
	}

	/**
	 * @return the $modeloFabricacaoVeiculos
	 */
	public function getModeloFabricacaoVeiculos() {
		return $this->modeloFabricacaoVeiculos;
	}

	/**
	 * @return the $renavamVeiculos
	 */
	public function getRenavamVeiculos() {
		return $this->renavamVeiculos;
	}

	/**
	 * @return the $chassiVeiculos
	 */
	public function getChassiVeiculos() {
		return $this->chassiVeiculos;
	}

	/**
	 * @return the $tipoVeiculos
	 */
	public function getTipoVeiculos() {
		return $this->tipoVeiculos;
	}

	/**
	 * @return the $codFipeVeiculos
	 */
	public function getCodFipeVeiculos() {
		return $this->codFipeVeiculos;
	}

	/**
	 * @return the $placaNfVeiculos
	 */
	public function getPlacaNfVeiculos() {
		return $this->placaNfVeiculos;
	}

	/**
	 * @return the $numeroNfVeiculos
	 */
	public function getNumeroNfVeiculos() {
		return $this->numeroNfVeiculos;
	}

	/**
	 * @return the $fornecedorNfVeiculos
	 */
	public function getFornecedorNfVeiculos() {
		return $this->fornecedorNfVeiculos;
	}

	/**
	 * @return the $dataNfVeiculos
	 */
	public function getDataNfVeiculos() {
		return $this->dataNfVeiculos;
	}

	/**
	 * @return the $cidadeNfVieculos
	 */
	public function getCidadeNfVeiculos() {
		return $this->cidadeNfVeiculos;
	}

	/**
	 * @return the $estadoNfVeiculos
	 */
	public function getEstadoNfVeiculos() {
		return $this->estadoNfVeiculos;
	}

	/**
	 * @return the $dataEntregaNfVeiculos
	 */
	public function getDataEntregaNfVeiculos() {
		return $this->dataEntregaNfVeiculos;
	}

	/**
	 * @return the $kmEntregaNfVeiculos
	 */
	public function getKmEntregaNfVeiculos() {
		return $this->kmEntregaNfVeiculos;
	}

	/**
	 * @return the $proprietarioNfVeiculos
	 */
	public function getProprietarioNfVeiculos() {
		return $this->proprietarioNfVeiculos;
	}

	/**
	 * @return the $arrendatárioNfVeiculos
	 */
	public function getArrendatarioNfVeiculos() {
		return $this->arrendatarioNfVeiculos;
	}

	/**
	 * @return the $contratanteNfveiculos
	 */
	public function getContratanteNfveiculos() {
		return $this->contratanteNfveiculos;
	}

	/**
	 * @return the $tempoGarantiaNfVeiculos
	 */
	public function getTempoGarantiaNfVeiculos() {
		return $this->tempoGarantiaNfVeiculos;
	}

	/**
	 * @return the $kmGarantiaVeiculos
	 */
	public function getKmGarantiaVeiculos() {
		return $this->kmGarantiaVeiculos;
	}

	/**
	 * @return the $vencimentoSeguroVeiculos
	 */
	public function getVencimentoSeguroVeiculos() {
		return $this->vencimentoSeguroVeiculos;
	}

	/**
	 * @return the $idClientes
	 */
	public function getIdClientes() {
		return $this->idClientes;
	}

	/**
	 * @param $idVeiculos the $idVeiculos to set
	 */
	public function setIdVeiculos($idVeiculos) {
		$this->idVeiculos = $idVeiculos;
	}

	/**
	 * @param $placaVeiculos the $placaVeiculos to set
	 */
	public function setPlacaVeiculos($placaVeiculos) {
		$this->placaVeiculos = $placaVeiculos;
	}

	/**
	 * @param $marcaVeiculos the $marcaVeiculos to set
	 */
	public function setMarcaVeiculos($marcaVeiculos) {
		$this->marcaVeiculos = $marcaVeiculos;
	}

	/**
	 * @param $modeloVeiculos the $modeloVeiculos to set
	 */
	public function setModeloVeiculos($modeloVeiculos) {
		$this->modeloVeiculos = $modeloVeiculos;
	}

	/**
	 * @param $corVeiculos the $corVeiculos to set
	 */
	public function setCorVeiculos($corVeiculos) {
		$this->corVeiculos = $corVeiculos;
	}

	/**
	 * @param $combustivelVeiculos the $combustivelVeiculos to set
	 */
	public function setCombustivelVeiculos($combustivelVeiculos) {
		$this->combustivelVeiculos = $combustivelVeiculos;
	}

	/**
	 * @param $capacidadeTanqueVeiculos the $capacidadeTanqueVeiculos to set
	 */
	public function setCapacidadeTanqueVeiculos($capacidadeTanqueVeiculos) {
		$this->capacidadeTanqueVeiculos = $capacidadeTanqueVeiculos;
	}

	/**
	 * @param $anoFabricacaoVeiculos the $anoFabricacaoVeiculos to set
	 */
	public function setAnoFabricacaoVeiculos($anoFabricacaoVeiculos) {
		$this->anoFabricacaoVeiculos = $anoFabricacaoVeiculos;
	}

	/**
	 * @param $modeloFabricacaoVeiculos the $modeloFabricacaoVeiculos to set
	 */
	public function setModeloFabricacaoVeiculos($modeloFabricacaoVeiculos) {
		$this->modeloFabricacaoVeiculos = $modeloFabricacaoVeiculos;
	}

	/**
	 * @param $renavamVeiculos the $renavamVeiculos to set
	 */
	public function setRenavamVeiculos($renavamVeiculos) {
		$this->renavamVeiculos = $renavamVeiculos;
	}

	/**
	 * @param $chassiVeiculos the $chassiVeiculos to set
	 */
	public function setChassiVeiculos($chassiVeiculos) {
		$this->chassiVeiculos = $chassiVeiculos;
	}

	/**
	 * @param $tipoVeiculos the $tipoVeiculos to set
	 */
	public function setTipoVeiculos($tipoVeiculos) {
		$this->tipoVeiculos = $tipoVeiculos;
	}

	/**
	 * @param $codFipeVeiculos the $codFipeVeiculos to set
	 */
	public function setCodFipeVeiculos($codFipeVeiculos) {
		$this->codFipeVeiculos = $codFipeVeiculos;
	}

	/**
	 * @param $placaNfVeiculos the $placaNfVeiculos to set
	 */
	public function setPlacaNfVeiculos($placaNfVeiculos) {
		$this->placaNfVeiculos = $placaNfVeiculos;
	}

	/**
	 * @param $numeroNfVeiculos the $numeroNfVeiculos to set
	 */
	public function setNumeroNfVeiculos($numeroNfVeiculos) {
		$this->numeroNfVeiculos = $numeroNfVeiculos;
	}

	/**
	 * @param $fornecedorNfVeiculos the $fornecedorNfVeiculos to set
	 */
	public function setFornecedorNfVeiculos($fornecedorNfVeiculos) {
		$this->fornecedorNfVeiculos = $fornecedorNfVeiculos;
	}

	/**
	 * @param $dataNfVeiculos the $dataNfVeiculos to set
	 */
	public function setDataNfVeiculos($dataNfVeiculos) {
		$this->dataNfVeiculos = $dataNfVeiculos;
	}

	/**
	 * @param $cidadeNfVieculos the $cidadeNfVieculos to set
	 */
	public function setCidadeNfVeiculos($cidadeNfVeiculos) {
		$this->cidadeNfVeiculos = $cidadeNfVeiculos;
	}

	/**
	 * @param $estadoNfVeiculos the $estadoNfVeiculos to set
	 */
	public function setEstadoNfVeiculos($estadoNfVeiculos) {
		$this->estadoNfVeiculos = $estadoNfVeiculos;
	}

	/**
	 * @param $dataEntregaNfVeiculos the $dataEntregaNfVeiculos to set
	 */
	public function setDataEntregaNfVeiculos($dataEntregaNfVeiculos) {
		$this->dataEntregaNfVeiculos = $dataEntregaNfVeiculos;
	}

	/**
	 * @param $kmEntregaNfVeiculos the $kmEntregaNfVeiculos to set
	 */
	public function setKmEntregaNfVeiculos($kmEntregaNfVeiculos) {
		$this->kmEntregaNfVeiculos = $kmEntregaNfVeiculos;
	}

	/**
	 * @param $proprietarioNfVeiculos the $proprietarioNfVeiculos to set
	 */
	public function setProprietarioNfVeiculos($proprietarioNfVeiculos) {
		$this->proprietarioNfVeiculos = $proprietarioNfVeiculos;
	}

	/**
	 * @param $arrendatárioNfVeiculos the $arrendatárioNfVeiculos to set
	 */
	public function setArrendatarioNfVeiculos($arrendatarioNfVeiculos) {
		$this->arrendatarioNfVeiculos = $arrendatarioNfVeiculos;
	}

	/**
	 * @param $contratanteNfveiculos the $contratanteNfveiculos to set
	 */
	public function setContratanteNfveiculos($contratanteNfveiculos) {
		$this->contratanteNfveiculos = $contratanteNfveiculos;
	}

	/**
	 * @param $tempoGarantiaNfVeiculos the $tempoGarantiaNfVeiculos to set
	 */
	public function setTempoGarantiaNfVeiculos($tempoGarantiaNfVeiculos) {
		$this->tempoGarantiaNfVeiculos = $tempoGarantiaNfVeiculos;
	}

	/**
	 * @param $kmGarantiaVeiculos the $kmGarantiaVeiculos to set
	 */
	public function setKmGarantiaVeiculos($kmGarantiaVeiculos) {
		$this->kmGarantiaVeiculos = $kmGarantiaVeiculos;
	}

	/**
	 * @param $vencimentoSeguroVeiculos the $vencimentoSeguroVeiculos to set
	 */
	public function setVencimentoSeguroVeiculos($vencimentoSeguroVeiculos) {
		$this->vencimentoSeguroVeiculos = $vencimentoSeguroVeiculos;
	}

	/**
	 * @param $idClientes the $idClientes to set
	 */
	public function setIdClientes($idClientes) {
		$this->idClientes = $idClientes;
	}


}
?>