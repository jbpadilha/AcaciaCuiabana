<?php

class Equipamentos {

	private $idequipamentos;
	private $dataCadastro;
	private $idCliente;
	private $nome;
	private $numeroSerie;
	private $fabricante;
	private $origem;
	private $origemPais;
	private $modelo;
	private $numeroChassi;
	private $anoFabricacao;
	private $anoModelo;
	private $cor;
	private $coldIdInterno;
	private $tipoAlimentacao;
	private $tipoAlimentacaoAC;
	private $tipoAlimentacaoDC;
	private $alimentacaoOutros;
	private $possuiAcessorios;
	private $acessorios;
	private $adicionais;
	private $nfFornecedor;
	private $nfNumero;
	private $nfDataCompra;
	private $nfValorCompra;
	private $nfDataEntrega;
	private $numeroImobilizado;
	private $tempoGarantia;
	private $unidadeGarantiaTempo;
	private $dataFimGarantia;
	private $possuiGarantiaExtendida;
	private $tempoGarantia2;
	private $unidadeGarantiaTempo2;
	private $datafimGarantia2;
	private $possuiContratoManutencao;
	private $empresaContratoManutencao;
	private $dataInicioContratoManutencao;
	private $dataFimContratoManutencao;
	private $infoContratoManutencao;
	/**
	 * @return the $idequipamentos
	 */
	public function getIdequipamentos() {
		return $this->idequipamentos;
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
	 * @return the $nome
	 */
	public function getNome() {
		return $this->nome;
	}

	/**
	 * @return the $numeroSerie
	 */
	public function getNumeroSerie() {
		return $this->numeroSerie;
	}

	/**
	 * @return the $fabricante
	 */
	public function getFabricante() {
		return $this->fabricante;
	}

	/**
	 * @return the $origem
	 */
	public function getOrigem() {
		return $this->origem;
	}

	/**
	 * @return the $origemPais
	 */
	public function getOrigemPais() {
		return $this->origemPais;
	}

	/**
	 * @return the $modelo
	 */
	public function getModelo() {
		return $this->modelo;
	}

	/**
	 * @return the $numeroChassi
	 */
	public function getNumeroChassi() {
		return $this->numeroChassi;
	}

	/**
	 * @return the $anoFabricacao
	 */
	public function getAnoFabricacao() {
		return $this->anoFabricacao;
	}

	/**
	 * @return the $anoModelo
	 */
	public function getAnoModelo() {
		return $this->anoModelo;
	}

	/**
	 * @return the $cor
	 */
	public function getCor() {
		return $this->cor;
	}

	/**
	 * @return the $coldIdInterno
	 */
	public function getColdIdInterno() {
		return $this->coldIdInterno;
	}

	/**
	 * @return the $tipoAlimentacao
	 */
	public function getTipoAlimentacao() {
		return $this->tipoAlimentacao;
	}

	/**
	 * @return the $tipoAlimentacaoAC
	 */
	public function getTipoAlimentacaoAC() {
		return $this->tipoAlimentacaoAC;
	}

	/**
	 * @return the $tipoAlimentacaoDC
	 */
	public function getTipoAlimentacaoDC() {
		return $this->tipoAlimentacaoDC;
	}

	/**
	 * @return the $alimentacaoOutros
	 */
	public function getAlimentacaoOutros() {
		return $this->alimentacaoOutros;
	}

	/**
	 * @return the $possuiAcessorios
	 */
	public function getPossuiAcessorios() {
		return $this->possuiAcessorios;
	}

	/**
	 * @return the $acessorios
	 */
	public function getAcessorios() {
		return $this->acessorios;
	}

	/**
	 * @return the $adicionais
	 */
	public function getAdicionais() {
		return $this->adicionais;
	}

	/**
	 * @return the $nfFornecedor
	 */
	public function getNfFornecedor() {
		return $this->nfFornecedor;
	}

	/**
	 * @return the $nfNumero
	 */
	public function getNfNumero() {
		return $this->nfNumero;
	}

	/**
	 * @return the $nfDataCompra
	 */
	public function getNfDataCompra() {
		return $this->nfDataCompra;
	}

	/**
	 * @return the $nfValorCompra
	 */
	public function getNfValorCompra() {
		return $this->nfValorCompra;
	}

	/**
	 * @return the $nfDataEntrega
	 */
	public function getNfDataEntrega() {
		return $this->nfDataEntrega;
	}

	/**
	 * @return the $numeroImobilizado
	 */
	public function getNumeroImobilizado() {
		return $this->numeroImobilizado;
	}

	/**
	 * @return the $tempoGarantia
	 */
	public function getTempoGarantia() {
		return $this->tempoGarantia;
	}

	/**
	 * @return the $unidadeGarantiaTempo
	 */
	public function getUnidadeGarantiaTempo() {
		return $this->unidadeGarantiaTempo;
	}

	/**
	 * @return the $dataFimGarantia
	 */
	public function getDataFimGarantia() {
		return $this->dataFimGarantia;
	}

	/**
	 * @return the $possuiGarantiaExtendida
	 */
	public function getPossuiGarantiaExtendida() {
		return $this->possuiGarantiaExtendida;
	}

	/**
	 * @return the $tempoGarantia2
	 */
	public function getTempoGarantia2() {
		return $this->tempoGarantia2;
	}

	/**
	 * @return the $unidadeGarantiaTempo2
	 */
	public function getUnidadeGarantiaTempo2() {
		return $this->unidadeGarantiaTempo2;
	}

	/**
	 * @return the $datafimGarantia2
	 */
	public function getDatafimGarantia2() {
		return $this->datafimGarantia2;
	}

	/**
	 * @return the $possuiContratoManutencao
	 */
	public function getPossuiContratoManutencao() {
		return $this->possuiContratoManutencao;
	}

	/**
	 * @return the $empresaContratoManutencao
	 */
	public function getEmpresaContratoManutencao() {
		return $this->empresaContratoManutencao;
	}

	/**
	 * @return the $dataInicioContratoManutencao
	 */
	public function getDataInicioContratoManutencao() {
		return $this->dataInicioContratoManutencao;
	}

	/**
	 * @return the $dataFimContratoManutencao
	 */
	public function getDataFimContratoManutencao() {
		return $this->dataFimContratoManutencao;
	}

	/**
	 * @return the $infoContratoManutencao
	 */
	public function getInfoContratoManutencao() {
		return $this->infoContratoManutencao;
	}

	/**
	 * @param $idequipamentos the $idequipamentos to set
	 */
	public function setIdequipamentos($idequipamentos) {
		$this->idequipamentos = $idequipamentos;
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
	 * @param $nome the $nome to set
	 */
	public function setNome($nome) {
		$this->nome = $nome;
	}

	/**
	 * @param $numeroSerie the $numeroSerie to set
	 */
	public function setNumeroSerie($numeroSerie) {
		$this->numeroSerie = $numeroSerie;
	}

	/**
	 * @param $fabricante the $fabricante to set
	 */
	public function setFabricante($fabricante) {
		$this->fabricante = $fabricante;
	}

	/**
	 * @param $origem the $origem to set
	 */
	public function setOrigem($origem) {
		$this->origem = $origem;
	}

	/**
	 * @param $origemPais the $origemPais to set
	 */
	public function setOrigemPais($origemPais) {
		$this->origemPais = $origemPais;
	}

	/**
	 * @param $modelo the $modelo to set
	 */
	public function setModelo($modelo) {
		$this->modelo = $modelo;
	}

	/**
	 * @param $numeroChassi the $numeroChassi to set
	 */
	public function setNumeroChassi($numeroChassi) {
		$this->numeroChassi = $numeroChassi;
	}

	/**
	 * @param $anoFabricacao the $anoFabricacao to set
	 */
	public function setAnoFabricacao($anoFabricacao) {
		$this->anoFabricacao = $anoFabricacao;
	}

	/**
	 * @param $anoModelo the $anoModelo to set
	 */
	public function setAnoModelo($anoModelo) {
		$this->anoModelo = $anoModelo;
	}

	/**
	 * @param $cor the $cor to set
	 */
	public function setCor($cor) {
		$this->cor = $cor;
	}

	/**
	 * @param $coldIdInterno the $coldIdInterno to set
	 */
	public function setColdIdInterno($coldIdInterno) {
		$this->coldIdInterno = $coldIdInterno;
	}

	/**
	 * @param $tipoAlimentacao the $tipoAlimentacao to set
	 */
	public function setTipoAlimentacao($tipoAlimentacao) {
		$this->tipoAlimentacao = $tipoAlimentacao;
	}

	/**
	 * @param $tipoAlimentacaoAC the $tipoAlimentacaoAC to set
	 */
	public function setTipoAlimentacaoAC($tipoAlimentacaoAC) {
		$this->tipoAlimentacaoAC = $tipoAlimentacaoAC;
	}

	/**
	 * @param $tipoAlimentacaoDC the $tipoAlimentacaoDC to set
	 */
	public function setTipoAlimentacaoDC($tipoAlimentacaoDC) {
		$this->tipoAlimentacaoDC = $tipoAlimentacaoDC;
	}

	/**
	 * @param $alimentacaoOutros the $alimentacaoOutros to set
	 */
	public function setAlimentacaoOutros($alimentacaoOutros) {
		$this->alimentacaoOutros = $alimentacaoOutros;
	}

	/**
	 * @param $possuiAcessorios the $possuiAcessorios to set
	 */
	public function setPossuiAcessorios($possuiAcessorios) {
		$this->possuiAcessorios = $possuiAcessorios;
	}

	/**
	 * @param $acessorios the $acessorios to set
	 */
	public function setAcessorios($acessorios) {
		$this->acessorios = $acessorios;
	}

	/**
	 * @param $adicionais the $adicionais to set
	 */
	public function setAdicionais($adicionais) {
		$this->adicionais = $adicionais;
	}

	/**
	 * @param $nfFornecedor the $nfFornecedor to set
	 */
	public function setNfFornecedor($nfFornecedor) {
		$this->nfFornecedor = $nfFornecedor;
	}

	/**
	 * @param $nfNumero the $nfNumero to set
	 */
	public function setNfNumero($nfNumero) {
		$this->nfNumero = $nfNumero;
	}

	/**
	 * @param $nfDataCompra the $nfDataCompra to set
	 */
	public function setNfDataCompra($nfDataCompra) {
		$this->nfDataCompra = $nfDataCompra;
	}

	/**
	 * @param $nfValorCompra the $nfValorCompra to set
	 */
	public function setNfValorCompra($nfValorCompra) {
		$this->nfValorCompra = $nfValorCompra;
	}

	/**
	 * @param $nfDataEntrega the $nfDataEntrega to set
	 */
	public function setNfDataEntrega($nfDataEntrega) {
		$this->nfDataEntrega = $nfDataEntrega;
	}

	/**
	 * @param $numeroImobilizado the $numeroImobilizado to set
	 */
	public function setNumeroImobilizado($numeroImobilizado) {
		$this->numeroImobilizado = $numeroImobilizado;
	}

	/**
	 * @param $tempoGarantia the $tempoGarantia to set
	 */
	public function setTempoGarantia($tempoGarantia) {
		$this->tempoGarantia = $tempoGarantia;
	}

	/**
	 * @param $unidadeGarantiaTempo the $unidadeGarantiaTempo to set
	 */
	public function setUnidadeGarantiaTempo($unidadeGarantiaTempo) {
		$this->unidadeGarantiaTempo = $unidadeGarantiaTempo;
	}

	/**
	 * @param $dataFimGarantia the $dataFimGarantia to set
	 */
	public function setDataFimGarantia($dataFimGarantia) {
		$this->dataFimGarantia = $dataFimGarantia;
	}

	/**
	 * @param $possuiGarantiaExtendida the $possuiGarantiaExtendida to set
	 */
	public function setPossuiGarantiaExtendida($possuiGarantiaExtendida) {
		$this->possuiGarantiaExtendida = $possuiGarantiaExtendida;
	}

	/**
	 * @param $tempoGarantia2 the $tempoGarantia2 to set
	 */
	public function setTempoGarantia2($tempoGarantia2) {
		$this->tempoGarantia2 = $tempoGarantia2;
	}

	/**
	 * @param $unidadeGarantiaTempo2 the $unidadeGarantiaTempo2 to set
	 */
	public function setUnidadeGarantiaTempo2($unidadeGarantiaTempo2) {
		$this->unidadeGarantiaTempo2 = $unidadeGarantiaTempo2;
	}

	/**
	 * @param $datafimGarantia2 the $datafimGarantia2 to set
	 */
	public function setDatafimGarantia2($datafimGarantia2) {
		$this->datafimGarantia2 = $datafimGarantia2;
	}

	/**
	 * @param $possuiContratoManutencao the $possuiContratoManutencao to set
	 */
	public function setPossuiContratoManutencao($possuiContratoManutencao) {
		$this->possuiContratoManutencao = $possuiContratoManutencao;
	}

	/**
	 * @param $empresaContratoManutencao the $empresaContratoManutencao to set
	 */
	public function setEmpresaContratoManutencao($empresaContratoManutencao) {
		$this->empresaContratoManutencao = $empresaContratoManutencao;
	}

	/**
	 * @param $dataInicioContratoManutencao the $dataInicioContratoManutencao to set
	 */
	public function setDataInicioContratoManutencao($dataInicioContratoManutencao) {
		$this->dataInicioContratoManutencao = $dataInicioContratoManutencao;
	}

	/**
	 * @param $dataFimContratoManutencao the $dataFimContratoManutencao to set
	 */
	public function setDataFimContratoManutencao($dataFimContratoManutencao) {
		$this->dataFimContratoManutencao = $dataFimContratoManutencao;
	}

	/**
	 * @param $infoContratoManutencao the $infoContratoManutencao to set
	 */
	public function setInfoContratoManutencao($infoContratoManutencao) {
		$this->infoContratoManutencao = $infoContratoManutencao;
	}



}


?>
