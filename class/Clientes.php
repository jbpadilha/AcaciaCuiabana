<?php
/**
 * Classe de Clientes
 * @author Joao Padilha
 * @version 1.0
 */
class Clientes
{

	private $idClientes;
	private $dataRegistroClientes;
	private $statusClientes;
	private $idPessoa;
	private $idEmpresa;
	
	/**
	 * @return the $idClientes
	 */
	public function getIdClientes() {
		return $this->idClientes;
	}

	/**
	 * @return the $dataRegistroClientes
	 */
	public function getDataRegistroClientes() {
		return $this->dataRegistroClientes;
	}

	/**
	 * @return the $statusClientes
	 */
	public function getStatusClientes() {
		return $this->statusClientes;
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
	 * @param $idClientes the $idClientes to set
	 */
	public function setIdClientes($idClientes) {
		$this->idClientes = $idClientes;
	}

	/**
	 * @param $dataRegistroClientes the $dataRegistroClientes to set
	 */
	public function setDataRegistroClientes($dataRegistroClientes) {
		$this->dataRegistroClientes = $dataRegistroClientes;
	}

	/**
	 * @param $statusClientes the $statusClientes to set
	 */
	public function setStatusClientes($statusClientes) {
		$this->statusClientes = $statusClientes;
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

	public function getNomeCliente()
	{
		$controle = new ControlaFuncionalidades();
		if($this->getIdPessoa() != null)
		{
			$pessoa = new Pessoa();
			$pessoa->setIdPessoa($this->getIdPessoa());
			$valueObj =  $controle->findPessoas($pessoa);
			$pessoa = $valueObj[0];
			return $pessoa->getNomePessoa();
		}
		elseif ($this->getIdEmpresa())
		{
			$empresas = new Empresas();
			$empresas->setIdEmpresa($this->getIdEmpresa());
			$valueObj =  $controle->findEmpresas($empresas);
			$empresas = $valueObj[0];
			return $empresas->getNomeEmpresa();
		}
	}
	
	public function getEnderecoCliente()
	{
		$controle = new ControlaFuncionalidades();
		if($this->getIdPessoa() != null)
		{
			$pessoa = new Pessoa();
			$pessoa->setIdPessoa($this->getIdPessoa());
			$valueObj =  $controle->findPessoas($pessoa);
			$pessoa = new Pessoa($valueObj[0]);
			$endereco = new Endereco();
			$endereco = $pessoa->retornaEndereco();
			return $endereco;
		}
		elseif ($this->getIdEmpresa())
		{
			$empresas = new Empresas();
			$empresas->setIdEmpresa($this->getIdEmpresa());
			$valueObj =  $controle->findEmpresas($empresas);
			$empresas = new Empresas($valueObj[0]);
			$endereco = new Endereco();
			$endereco = $empresas->getEnderecoEmpresa();
			return $endereco;
		}
	}
}
?>