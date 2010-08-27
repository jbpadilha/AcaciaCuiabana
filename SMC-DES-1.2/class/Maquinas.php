<?php

class Maquinas {
	
	private $idMaquinas;
	private $dataCadastro;
	private $idCliente;
	private $nomeMaquina;
	private $numeroSerieMaquina;
	private $fabricanteMaquinas;
	private $origemMaquinas;
	private $origemPaisMaquinas;
	private $modeloMaquinas;
	private $numeroChassiMaquinas;
	private $anoFabricacaoMaquinas;
	private $anoModeloMaquinas;
	private $tracaoMaquinas;
	private $corMaquinas;
	private $tipoCombustivelMaquinas;
	private $tanqueMaximoMaquinas;
	private $codIdInternoMaquinas;
	private $adicionaisMaquinas;
	private $contadorMaquinas;
	private $contadorVariacaoDiaMaquinas;
	private $nfFornecedorMaquinas;
	private $nfNumeroMaquinas;
	private $nfDataCompraMaquinas;
	private $nfValorCompraMaquinas;
	private $dataEntregaMaquinas;
	private $nfContadorEntregaMaquinas;
	private $numeroImobilizadoMaquinas;
	private $tempogarantiaMaquinas;
	private $unidadeGarantiaTempoMaquinas;
	private $dataFimGarantiaMaquinas;
	private $garantiaContadorMaquinas;
	private $unidadeGarantiaContadorMaquinas;
	private $valorFinalGarantiaMaquinas;
	private $possuiGarantiaExtendidaMaquinas;
	private $tempoGarantia2Maquinas;
	private $unidadeGarantiaTempo2Maquinas;
	private $dataFimGarantia2Maquinas;
	private $garantiaContador2Maquinas;
	private $unidadeGarantiaContador2Maquinas;
	private $valorFinalGarantia2Maquinas;
	private $possuiContratoManutencaoMaquinas;
	private $empresaContratoManutencaoMaquinas;
	private $dataInicioContratoManutencaoMaquinas;
	private $dataFimContratoManutencaoMaquinas;
	private $infoContratoManutencaoMaquinas;
	private $dataultimaLeituraMaquinas;
	private $contadorUltimaLeituraMaquinas;
	private $acompanhaTempoMaquinas;
	private $unidadeAcompanhaTempoMaquinas;
	private $acompanhaContadorMaquinas;
	private $unidadeAcompanhaContadorMaquinas;
	/**
	 * @return the $idMaquinas
	 */
	public function getIdMaquinas() {
		return $this->idMaquinas;
	}

	/**
	 * @return the $dataCadastro
	 */
	public function getDataCadastro() {
		return $this->dataCadastro;
	}

	/**
	 * @return the $idCliente
	 */
	public function getIdCliente() {
		return $this->idCliente;
	}

	/**
	 * @return the $nomeMaquina
	 */
	public function getNomeMaquina() {
		return $this->nomeMaquina;
	}

	/**
	 * @return the $numeroSerieMaquina
	 */
	public function getNumeroSerieMaquina() {
		return $this->numeroSerieMaquina;
	}

	/**
	 * @return the $fabricanteMaquinas
	 */
	public function getFabricanteMaquinas() {
		return $this->fabricanteMaquinas;
	}

	/**
	 * @return the $origemMaquinas
	 */
	public function getOrigemMaquinas() {
		return $this->origemMaquinas;
	}

	/**
	 * @return the $origemPaisMaquinas
	 */
	public function getOrigemPaisMaquinas() {
		return $this->origemPaisMaquinas;
	}

	/**
	 * @return the $modeloMaquinas
	 */
	public function getModeloMaquinas() {
		return $this->modeloMaquinas;
	}

	/**
	 * @return the $numeroChassiMaquinas
	 */
	public function getNumeroChassiMaquinas() {
		return $this->numeroChassiMaquinas;
	}

	/**
	 * @return the $anoFabricacaoMaquinas
	 */
	public function getAnoFabricacaoMaquinas() {
		return $this->anoFabricacaoMaquinas;
	}

	/**
	 * @return the $anoModeloMaquinas
	 */
	public function getAnoModeloMaquinas() {
		return $this->anoModeloMaquinas;
	}

	/**
	 * @return the $tracaoMaquinas
	 */
	public function getTracaoMaquinas() {
		return $this->tracaoMaquinas;
	}

	/**
	 * @return the $corMaquinas
	 */
	public function getCorMaquinas() {
		return $this->corMaquinas;
	}

	/**
	 * @return the $tipoCombustivelMaquinas
	 */
	public function getTipoCombustivelMaquinas() {
		return $this->tipoCombustivelMaquinas;
	}

	/**
	 * @return the $tanqueMaximoMaquinas
	 */
	public function getTanqueMaximoMaquinas() {
		return $this->tanqueMaximoMaquinas;
	}

	/**
	 * @return the $codIdInternoMaquinas
	 */
	public function getCodIdInternoMaquinas() {
		return $this->codIdInternoMaquinas;
	}

	/**
	 * @return the $adicionaisMaquinas
	 */
	public function getAdicionaisMaquinas() {
		return $this->adicionaisMaquinas;
	}

	/**
	 * @return the $contadorMaquinas
	 */
	public function getContadorMaquinas() {
		return $this->contadorMaquinas;
	}

	/**
	 * @return the $contadorVariacaoDiaMaquinas
	 */
	public function getContadorVariacaoDiaMaquinas() {
		return $this->contadorVariacaoDiaMaquinas;
	}

	/**
	 * @return the $nfFornecedorMaquinas
	 */
	public function getNfFornecedorMaquinas() {
		return $this->nfFornecedorMaquinas;
	}

	/**
	 * @return the $nfNumeroMaquinas
	 */
	public function getNfNumeroMaquinas() {
		return $this->nfNumeroMaquinas;
	}

	/**
	 * @return the $nfDataCompraMaquinas
	 */
	public function getNfDataCompraMaquinas() {
		return $this->nfDataCompraMaquinas;
	}

	/**
	 * @return the $nfValorCompraMaquinas
	 */
	public function getNfValorCompraMaquinas() {
		return $this->nfValorCompraMaquinas;
	}

	/**
	 * @return the $dataEntregaMaquinas
	 */
	public function getDataEntregaMaquinas() {
		return $this->dataEntregaMaquinas;
	}

	/**
	 * @return the $nfContadorEntregaMaquinas
	 */
	public function getNfContadorEntregaMaquinas() {
		return $this->nfContadorEntregaMaquinas;
	}

	/**
	 * @return the $numeroImobilizadoMaquinas
	 */
	public function getNumeroImobilizadoMaquinas() {
		return $this->numeroImobilizadoMaquinas;
	}

	/**
	 * @return the $tempogarantiaMaquinas
	 */
	public function getTempogarantiaMaquinas() {
		return $this->tempogarantiaMaquinas;
	}

	/**
	 * @return the $unidadeGarantiaTempoMaquinas
	 */
	public function getUnidadeGarantiaTempoMaquinas() {
		return $this->unidadeGarantiaTempoMaquinas;
	}

	/**
	 * @return the $dataFimGarantiaMaquinas
	 */
	public function getDataFimGarantiaMaquinas() {
		return $this->dataFimGarantiaMaquinas;
	}

	/**
	 * @return the $garantiaContadorMaquinas
	 */
	public function getGarantiaContadorMaquinas() {
		return $this->garantiaContadorMaquinas;
	}

	/**
	 * @return the $unidadeGarantiaContadorMaquinas
	 */
	public function getUnidadeGarantiaContadorMaquinas() {
		return $this->unidadeGarantiaContadorMaquinas;
	}

	/**
	 * @return the $valorFinalGarantiaMaquinas
	 */
	public function getValorFinalGarantiaMaquinas() {
		return $this->valorFinalGarantiaMaquinas;
	}

	/**
	 * @return the $possuiGarantiaExtendidaMaquinas
	 */
	public function getPossuiGarantiaExtendidaMaquinas() {
		return $this->possuiGarantiaExtendidaMaquinas;
	}

	/**
	 * @return the $tempoGarantia2Maquinas
	 */
	public function getTempoGarantia2Maquinas() {
		return $this->tempoGarantia2Maquinas;
	}

	/**
	 * @return the $unidadeGarantiaTempo2Maquinas
	 */
	public function getUnidadeGarantiaTempo2Maquinas() {
		return $this->unidadeGarantiaTempo2Maquinas;
	}

	/**
	 * @return the $dataFimGarantia2Maquinas
	 */
	public function getDataFimGarantia2Maquinas() {
		return $this->dataFimGarantia2Maquinas;
	}

	/**
	 * @return the $garantiaContador2Maquinas
	 */
	public function getGarantiaContador2Maquinas() {
		return $this->garantiaContador2Maquinas;
	}

	/**
	 * @return the $unidadeGarantiaContador2Maquinas
	 */
	public function getUnidadeGarantiaContador2Maquinas() {
		return $this->unidadeGarantiaContador2Maquinas;
	}

	/**
	 * @return the $valorFinalGarantia2Maquinas
	 */
	public function getValorFinalGarantia2Maquinas() {
		return $this->valorFinalGarantia2Maquinas;
	}

	/**
	 * @return the $possuiContratoManutencaoMaquinas
	 */
	public function getPossuiContratoManutencaoMaquinas() {
		return $this->possuiContratoManutencaoMaquinas;
	}

	/**
	 * @return the $empresaContratoManutencaoMaquinas
	 */
	public function getEmpresaContratoManutencaoMaquinas() {
		return $this->empresaContratoManutencaoMaquinas;
	}

	/**
	 * @return the $dataInicioContratoManutencaoMaquinas
	 */
	public function getDataInicioContratoManutencaoMaquinas() {
		return $this->dataInicioContratoManutencaoMaquinas;
	}

	/**
	 * @return the $dataFimContratoManutencaoMaquinas
	 */
	public function getDataFimContratoManutencaoMaquinas() {
		return $this->dataFimContratoManutencaoMaquinas;
	}

	/**
	 * @return the $infoContratoManutencaoMaquinas
	 */
	public function getInfoContratoManutencaoMaquinas() {
		return $this->infoContratoManutencaoMaquinas;
	}

	/**
	 * @return the $dataultimaLeituraMaquinas
	 */
	public function getDataultimaLeituraMaquinas() {
		return $this->dataultimaLeituraMaquinas;
	}

	/**
	 * @return the $contadorUltimaLeituraMaquinas
	 */
	public function getContadorUltimaLeituraMaquinas() {
		return $this->contadorUltimaLeituraMaquinas;
	}

	/**
	 * @return the $acompanhaTempoMaquinas
	 */
	public function getAcompanhaTempoMaquinas() {
		return $this->acompanhaTempoMaquinas;
	}

	/**
	 * @return the $unidadeAcompanhaTempoMaquinas
	 */
	public function getUnidadeAcompanhaTempoMaquinas() {
		return $this->unidadeAcompanhaTempoMaquinas;
	}

	/**
	 * @return the $acompanhaContadorMaquinas
	 */
	public function getAcompanhaContadorMaquinas() {
		return $this->acompanhaContadorMaquinas;
	}

	/**
	 * @return the $unidadeAcompanhaContadorMaquinas
	 */
	public function getUnidadeAcompanhaContadorMaquinas() {
		return $this->unidadeAcompanhaContadorMaquinas;
	}

	/**
	 * @param $idMaquinas the $idMaquinas to set
	 */
	public function setIdMaquinas($idMaquinas) {
		$this->idMaquinas = $idMaquinas;
	}

	/**
	 * @param $dataCadastro the $dataCadastro to set
	 */
	public function setDataCadastro($dataCadastro) {
		$this->dataCadastro = $dataCadastro;
	}

	/**
	 * @param $idCliente the $idCliente to set
	 */
	public function setIdCliente($idCliente) {
		$this->idCliente = $idCliente;
	}

	/**
	 * @param $nomeMaquina the $nomeMaquina to set
	 */
	public function setNomeMaquina($nomeMaquina) {
		$this->nomeMaquina = $nomeMaquina;
	}

	/**
	 * @param $numeroSerieMaquina the $numeroSerieMaquina to set
	 */
	public function setNumeroSerieMaquina($numeroSerieMaquina) {
		$this->numeroSerieMaquina = $numeroSerieMaquina;
	}

	/**
	 * @param $fabricanteMaquinas the $fabricanteMaquinas to set
	 */
	public function setFabricanteMaquinas($fabricanteMaquinas) {
		$this->fabricanteMaquinas = $fabricanteMaquinas;
	}

	/**
	 * @param $origemMaquinas the $origemMaquinas to set
	 */
	public function setOrigemMaquinas($origemMaquinas) {
		$this->origemMaquinas = $origemMaquinas;
	}

	/**
	 * @param $origemPaisMaquinas the $origemPaisMaquinas to set
	 */
	public function setOrigemPaisMaquinas($origemPaisMaquinas) {
		$this->origemPaisMaquinas = $origemPaisMaquinas;
	}

	/**
	 * @param $modeloMaquinas the $modeloMaquinas to set
	 */
	public function setModeloMaquinas($modeloMaquinas) {
		$this->modeloMaquinas = $modeloMaquinas;
	}

	/**
	 * @param $numeroChassiMaquinas the $numeroChassiMaquinas to set
	 */
	public function setNumeroChassiMaquinas($numeroChassiMaquinas) {
		$this->numeroChassiMaquinas = $numeroChassiMaquinas;
	}

	/**
	 * @param $anoFabricacaoMaquinas the $anoFabricacaoMaquinas to set
	 */
	public function setAnoFabricacaoMaquinas($anoFabricacaoMaquinas) {
		$this->anoFabricacaoMaquinas = $anoFabricacaoMaquinas;
	}

	/**
	 * @param $anoModeloMaquinas the $anoModeloMaquinas to set
	 */
	public function setAnoModeloMaquinas($anoModeloMaquinas) {
		$this->anoModeloMaquinas = $anoModeloMaquinas;
	}

	/**
	 * @param $tracaoMaquinas the $tracaoMaquinas to set
	 */
	public function setTracaoMaquinas($tracaoMaquinas) {
		$this->tracaoMaquinas = $tracaoMaquinas;
	}

	/**
	 * @param $corMaquinas the $corMaquinas to set
	 */
	public function setCorMaquinas($corMaquinas) {
		$this->corMaquinas = $corMaquinas;
	}

	/**
	 * @param $tipoCombustivelMaquinas the $tipoCombustivelMaquinas to set
	 */
	public function setTipoCombustivelMaquinas($tipoCombustivelMaquinas) {
		$this->tipoCombustivelMaquinas = $tipoCombustivelMaquinas;
	}

	/**
	 * @param $tanqueMaximoMaquinas the $tanqueMaximoMaquinas to set
	 */
	public function setTanqueMaximoMaquinas($tanqueMaximoMaquinas) {
		$this->tanqueMaximoMaquinas = $tanqueMaximoMaquinas;
	}

	/**
	 * @param $codIdInternoMaquinas the $codIdInternoMaquinas to set
	 */
	public function setCodIdInternoMaquinas($codIdInternoMaquinas) {
		$this->codIdInternoMaquinas = $codIdInternoMaquinas;
	}

	/**
	 * @param $adicionaisMaquinas the $adicionaisMaquinas to set
	 */
	public function setAdicionaisMaquinas($adicionaisMaquinas) {
		$this->adicionaisMaquinas = $adicionaisMaquinas;
	}

	/**
	 * @param $contadorMaquinas the $contadorMaquinas to set
	 */
	public function setContadorMaquinas($contadorMaquinas) {
		$this->contadorMaquinas = $contadorMaquinas;
	}

	/**
	 * @param $contadorVariacaoDiaMaquinas the $contadorVariacaoDiaMaquinas to set
	 */
	public function setContadorVariacaoDiaMaquinas($contadorVariacaoDiaMaquinas) {
		$this->contadorVariacaoDiaMaquinas = $contadorVariacaoDiaMaquinas;
	}

	/**
	 * @param $nfFornecedorMaquinas the $nfFornecedorMaquinas to set
	 */
	public function setNfFornecedorMaquinas($nfFornecedorMaquinas) {
		$this->nfFornecedorMaquinas = $nfFornecedorMaquinas;
	}

	/**
	 * @param $nfNumeroMaquinas the $nfNumeroMaquinas to set
	 */
	public function setNfNumeroMaquinas($nfNumeroMaquinas) {
		$this->nfNumeroMaquinas = $nfNumeroMaquinas;
	}

	/**
	 * @param $nfDataCompraMaquinas the $nfDataCompraMaquinas to set
	 */
	public function setNfDataCompraMaquinas($nfDataCompraMaquinas) {
		$this->nfDataCompraMaquinas = $nfDataCompraMaquinas;
	}

	/**
	 * @param $nfValorCompraMaquinas the $nfValorCompraMaquinas to set
	 */
	public function setNfValorCompraMaquinas($nfValorCompraMaquinas) {
		$this->nfValorCompraMaquinas = $nfValorCompraMaquinas;
	}

	/**
	 * @param $dataEntregaMaquinas the $dataEntregaMaquinas to set
	 */
	public function setDataEntregaMaquinas($dataEntregaMaquinas) {
		$this->dataEntregaMaquinas = $dataEntregaMaquinas;
	}

	/**
	 * @param $nfContadorEntregaMaquinas the $nfContadorEntregaMaquinas to set
	 */
	public function setNfContadorEntregaMaquinas($nfContadorEntregaMaquinas) {
		$this->nfContadorEntregaMaquinas = $nfContadorEntregaMaquinas;
	}

	/**
	 * @param $numeroImobilizadoMaquinas the $numeroImobilizadoMaquinas to set
	 */
	public function setNumeroImobilizadoMaquinas($numeroImobilizadoMaquinas) {
		$this->numeroImobilizadoMaquinas = $numeroImobilizadoMaquinas;
	}

	/**
	 * @param $tempogarantiaMaquinas the $tempogarantiaMaquinas to set
	 */
	public function setTempogarantiaMaquinas($tempogarantiaMaquinas) {
		$this->tempogarantiaMaquinas = $tempogarantiaMaquinas;
	}

	/**
	 * @param $unidadeGarantiaTempoMaquinas the $unidadeGarantiaTempoMaquinas to set
	 */
	public function setUnidadeGarantiaTempoMaquinas($unidadeGarantiaTempoMaquinas) {
		$this->unidadeGarantiaTempoMaquinas = $unidadeGarantiaTempoMaquinas;
	}

	/**
	 * @param $dataFimGarantiaMaquinas the $dataFimGarantiaMaquinas to set
	 */
	public function setDataFimGarantiaMaquinas($dataFimGarantiaMaquinas) {
		$this->dataFimGarantiaMaquinas = $dataFimGarantiaMaquinas;
	}

	/**
	 * @param $garantiaContadorMaquinas the $garantiaContadorMaquinas to set
	 */
	public function setGarantiaContadorMaquinas($garantiaContadorMaquinas) {
		$this->garantiaContadorMaquinas = $garantiaContadorMaquinas;
	}

	/**
	 * @param $unidadeGarantiaContadorMaquinas the $unidadeGarantiaContadorMaquinas to set
	 */
	public function setUnidadeGarantiaContadorMaquinas($unidadeGarantiaContadorMaquinas) {
		$this->unidadeGarantiaContadorMaquinas = $unidadeGarantiaContadorMaquinas;
	}

	/**
	 * @param $valorFinalGarantiaMaquinas the $valorFinalGarantiaMaquinas to set
	 */
	public function setValorFinalGarantiaMaquinas($valorFinalGarantiaMaquinas) {
		$this->valorFinalGarantiaMaquinas = $valorFinalGarantiaMaquinas;
	}

	/**
	 * @param $possuiGarantiaExtendidaMaquinas the $possuiGarantiaExtendidaMaquinas to set
	 */
	public function setPossuiGarantiaExtendidaMaquinas($possuiGarantiaExtendidaMaquinas) {
		$this->possuiGarantiaExtendidaMaquinas = $possuiGarantiaExtendidaMaquinas;
	}

	/**
	 * @param $tempoGarantia2Maquinas the $tempoGarantia2Maquinas to set
	 */
	public function setTempoGarantia2Maquinas($tempoGarantia2Maquinas) {
		$this->tempoGarantia2Maquinas = $tempoGarantia2Maquinas;
	}

	/**
	 * @param $unidadeGarantiaTempo2Maquinas the $unidadeGarantiaTempo2Maquinas to set
	 */
	public function setUnidadeGarantiaTempo2Maquinas($unidadeGarantiaTempo2Maquinas) {
		$this->unidadeGarantiaTempo2Maquinas = $unidadeGarantiaTempo2Maquinas;
	}

	/**
	 * @param $dataFimGarantia2Maquinas the $dataFimGarantia2Maquinas to set
	 */
	public function setDataFimGarantia2Maquinas($dataFimGarantia2Maquinas) {
		$this->dataFimGarantia2Maquinas = $dataFimGarantia2Maquinas;
	}

	/**
	 * @param $garantiaContador2Maquinas the $garantiaContador2Maquinas to set
	 */
	public function setGarantiaContador2Maquinas($garantiaContador2Maquinas) {
		$this->garantiaContador2Maquinas = $garantiaContador2Maquinas;
	}

	/**
	 * @param $unidadeGarantiaContador2Maquinas the $unidadeGarantiaContador2Maquinas to set
	 */
	public function setUnidadeGarantiaContador2Maquinas($unidadeGarantiaContador2Maquinas) {
		$this->unidadeGarantiaContador2Maquinas = $unidadeGarantiaContador2Maquinas;
	}

	/**
	 * @param $valorFinalGarantia2Maquinas the $valorFinalGarantia2Maquinas to set
	 */
	public function setValorFinalGarantia2Maquinas($valorFinalGarantia2Maquinas) {
		$this->valorFinalGarantia2Maquinas = $valorFinalGarantia2Maquinas;
	}

	/**
	 * @param $possuiContratoManutencaoMaquinas the $possuiContratoManutencaoMaquinas to set
	 */
	public function setPossuiContratoManutencaoMaquinas($possuiContratoManutencaoMaquinas) {
		$this->possuiContratoManutencaoMaquinas = $possuiContratoManutencaoMaquinas;
	}

	/**
	 * @param $empresaContratoManutencaoMaquinas the $empresaContratoManutencaoMaquinas to set
	 */
	public function setEmpresaContratoManutencaoMaquinas($empresaContratoManutencaoMaquinas) {
		$this->empresaContratoManutencaoMaquinas = $empresaContratoManutencaoMaquinas;
	}

	/**
	 * @param $dataInicioContratoManutencaoMaquinas the $dataInicioContratoManutencaoMaquinas to set
	 */
	public function setDataInicioContratoManutencaoMaquinas($dataInicioContratoManutencaoMaquinas) {
		$this->dataInicioContratoManutencaoMaquinas = $dataInicioContratoManutencaoMaquinas;
	}

	/**
	 * @param $dataFimContratoManutencaoMaquinas the $dataFimContratoManutencaoMaquinas to set
	 */
	public function setDataFimContratoManutencaoMaquinas($dataFimContratoManutencaoMaquinas) {
		$this->dataFimContratoManutencaoMaquinas = $dataFimContratoManutencaoMaquinas;
	}

	/**
	 * @param $infoContratoManutencaoMaquinas the $infoContratoManutencaoMaquinas to set
	 */
	public function setInfoContratoManutencaoMaquinas($infoContratoManutencaoMaquinas) {
		$this->infoContratoManutencaoMaquinas = $infoContratoManutencaoMaquinas;
	}

	/**
	 * @param $dataultimaLeituraMaquinas the $dataultimaLeituraMaquinas to set
	 */
	public function setDataultimaLeituraMaquinas($dataultimaLeituraMaquinas) {
		$this->dataultimaLeituraMaquinas = $dataultimaLeituraMaquinas;
	}

	/**
	 * @param $contadorUltimaLeituraMaquinas the $contadorUltimaLeituraMaquinas to set
	 */
	public function setContadorUltimaLeituraMaquinas($contadorUltimaLeituraMaquinas) {
		$this->contadorUltimaLeituraMaquinas = $contadorUltimaLeituraMaquinas;
	}

	/**
	 * @param $acompanhaTempoMaquinas the $acompanhaTempoMaquinas to set
	 */
	public function setAcompanhaTempoMaquinas($acompanhaTempoMaquinas) {
		$this->acompanhaTempoMaquinas = $acompanhaTempoMaquinas;
	}

	/**
	 * @param $unidadeAcompanhaTempoMaquinas the $unidadeAcompanhaTempoMaquinas to set
	 */
	public function setUnidadeAcompanhaTempoMaquinas($unidadeAcompanhaTempoMaquinas) {
		$this->unidadeAcompanhaTempoMaquinas = $unidadeAcompanhaTempoMaquinas;
	}

	/**
	 * @param $acompanhaContadorMaquinas the $acompanhaContadorMaquinas to set
	 */
	public function setAcompanhaContadorMaquinas($acompanhaContadorMaquinas) {
		$this->acompanhaContadorMaquinas = $acompanhaContadorMaquinas;
	}

	/**
	 * @param $unidadeAcompanhaContadorMaquinas the $unidadeAcompanhaContadorMaquinas to set
	 */
	public function setUnidadeAcompanhaContadorMaquinas($unidadeAcompanhaContadorMaquinas) {
		$this->unidadeAcompanhaContadorMaquinas = $unidadeAcompanhaContadorMaquinas;
	}

	
	

}

?>