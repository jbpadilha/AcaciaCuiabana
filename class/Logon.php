<?php
/**
 * Classe Logon
 * @author Joao Padilha
 * @version 1.0
 */
class Logon
{

	private $idLogin;
	private $login;
	private $senha;
	private $dataUltimoLogin;
	private $nivelAcessoLogin;
	private $idPessoa;
	private $idClientes;
	
	/**
	 * @return the $idLogin
	 */
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

	public function getIdLogin() {
		return $this->idLogin;
	}

	/**
	 * @return the $login
	 */
	public function getLogin() {
		return $this->login;
	}

	/**
	 * @return the $senha
	 */
	public function getSenha() {
		return $this->senha;
	}

	/**
	 * @return the $dataUltimoLogin
	 */
	public function getDataUltimoLogin() {
		return $this->dataUltimoLogin;
	}

	/**
	 * @return the $nivelAcessoLogin
	 */
	public function getNivelAcessoLogin() {
		return $this->nivelAcessoLogin;
	}

	/**
	 * @return the $idPessoa
	 */
	public function getIdPessoa() {
		return $this->idPessoa;
	}

	/**
	 * @param $idLogin the $idLogin to set
	 */
	public function setIdLogin($idLogin) {
		$this->idLogin = $idLogin;
	}

	/**
	 * @param $login the $login to set
	 */
	public function setLogin($login) {
		$this->login = $login;
	}

	/**
	 * @param $senha the $senha to set
	 */
	public function setSenha($senha) {
		$this->senha = $senha;
	}

	/**
	 * @param $dataUltimoLogin the $dataUltimoLogin to set
	 */
	public function setDataUltimoLogin($dataUltimoLogin) {
		$this->dataUltimoLogin = $dataUltimoLogin;
	}

	/**
	 * @param $nivelAcessoLogin the $nivelAcessoLogin to set
	 */
	public function setNivelAcessoLogin($nivelAcessoLogin) {
		$this->nivelAcessoLogin = $nivelAcessoLogin;
	}

	/**
	 * @param $idPessoa the $idPessoa to set
	 */
	public function setIdPessoa($idPessoa) {
		$this->idPessoa = $idPessoa;
	}



}
?>