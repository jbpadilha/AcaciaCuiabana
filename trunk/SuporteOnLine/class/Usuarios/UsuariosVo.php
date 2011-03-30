<?php
//####################################
// * Jo�o Batista Padilha e Silva Analista/Desenvolvedor (�baco Tecnologia)
// * Arquivo: UsuariosVo.php
// * Cria��o: Jo�o Batista Padilha e Silva
// * Revis�o:
// * Data de cria��o: 30/06/2008
//####################################
/**
 * Classe Value Objet. Serve para transportar os atributos dos usu�rios entre as camadas.
 * @author Jo�o Batista Padilha e Silva
 */
class UsuariosVo extends AbstractVo
{
	private $idUsuarios = null;
	private $nomeUsuarios = '';
	private $enderecoUsuarios = '';
	private $cepUsuarios = null;
	private $cidadeUsuarios = '';
	private $emailUsuarios = '';
	private $telUsuarios = null;
	private $telCelUsuarios = null;
	private $dataNascimentoUsuarios = '';
	private $loginUsuarios = '';
	private $senhaUsuarios = '';
	private $flagSuspenso = false;
	private $flagTipoUsuario = true;

	/**
	 * M�todo de modifica��o da identifica��o do Usuarios
	 * @author Jo�o Batista Padilha e Silva
	 * @param integer $id
	 */
	public function setIdUsuarios($id = null)
	{
		$this->idUsuarios = $id;
	}
	
	/**
	 * M�todo de retorno da identifica��o do Usuarios
	 * @author Jo�o Batista Padilha e Silva
	 * @return integer
	 */
	public function getIdUsuarios()
	{
		return $this->idUsuarios;
	}
	
	/**
	 * M�todo de modifica��o do nome do Usuarios
	 * @author Jo�o Batista Padilha e Silva
	 * @param var $nome
	 */
	public function setNomeUsuarios($nome = '')
	{
		$this->nomeUsuarios = $nome;
	}
	
	/**
	 * M�todo de retorno do nome do Usuarios
	 * @author Jo�o Batista Padilha e Silva
	 * @return var
	 */
	public function getNomeUsuarios()
	{
		return $this->nomeUsuarios;
	}
	
	/**
	 * M�todo de modifica��o do endere�o de Usuarios
	 * @author Jo�o Batista Padilha e Silva
	 * @param var $end
	 */
	public function setEnderecoUsuarios($end = '')
	{
		$this->enderecoUsuarios = $end;
	}
	
	/**
	 * M�todo de retorno do endere�o de Usuarios
	 * @author Jo�o Batista Padilha e Silva
	 * @return var
	 */
	public function getEnderecoUsuarios()
	{
		return $this->enderecoUsuarios;
	}
	
	/**
	 * M�todo de modifica��o do Cep de Usuarios
	 * @author Jo�o Batista Padilha e Silva
	 * @param integer $cep
	 */
	public function setCepUsuarios($cep = null)
	{
		$this->cepUsuarios = $cep;
	}
	
	/**
	 * M�todo de retorno o cep de Usuarios
	 * @author Jo�o Batista Padilha e Silva
	 * @return integer
	 */
	public function getCepUsuarios()
	{
		return $this->cepUsuarios;
	}
	
	/**
	 * M�todo de modifica��o da cidade de Usuarios
	 * @author Jo�o Batista Padilha e Silva
	 * @param var $cidade
	 */
	public function setCidadeUsuarios($cidade = '')
	{
		$this->cidadeUsuarios = $cidade;
	}
	
	/**
	 * M�todo de retorno de cidade de Usuarios
	 * @author Jo�o Batista Padilha e Silva
	 * @return var
	 */
	public function getCidadeUsuarios()
	{
		return $this->cidadeUsuarios;
	}
	
	/**
	 * M�todo de modifica��o de Email de Usuarios
	 * @author Jo�o Batista Padilha e Silva
	 * @param var $email
	 */
	public function setEmailUsuarios($email = '')
	{
		$this->emailUsuarios = $email;
	}
	
	/**
	 * M�todo de retorno de Email de Usuarios
	 * @author Jo�o Batista Padilha e Silva
	 * @return var
	 */
	public function getEmailUsuarios()
	{
		return $this->emailUsuarios;
	}
	
	/**
	 * M�todo de modifica��o de Telefone de Usuarios
	 * @author Jo�o Batista Padilha e Silva
	 * @param var $tel
	 */
	public function setTelUsuarios($tel = null)
	{
		$this->telUsuarios = $tel;
	}
	
	/**
	 * M�todo de retorno de telefone de Usuarios
	 * @author Jo�o Batista Padilha e Silva
	 * @return var
	 */
	public function getTelUsuarios()
	{
		return $this->telUsuarios;
	}
	
	/**
	 * M�todo de modifica��o de Telefone Celular de Usuarios
	 * @author Jo�o Batista Padilha e Silva
	 * @param var $telCel
	 */
	public function setTelCelUsuarios($telCel = null)
	{
		$this->telCelUsuarios = $telCel;
	}
	
	/**
	 * M�todo de retorno de Telefone Celular de Usuarios
	 * @author Jo�o Batista Padilha e Silva
	 * @return var
	 */
	public function getTelCelUsuarios()
	{
		return $this->telCelUsuarios;
	}
	
	/**
	 * M�todo de modifica��o de Data de Nascimento de Usuarios
	 * @author Jo�o Batista Padilha e Silva
	 * @param date $data
	 */
	public function setDataNascimentoUsuarios($data = null)
	{
		$this->dataNascimentoUsuarios = $data;
	}
	
	/**
	 * M�todo de retorno de data de Nascimento de Usuarios
	 * @author Jo�o Batista Padilha e Silva
	 * @return date
	 */
	public function getDataNascimentoUsuarios()
	{
		return $this->dataNascimentoUsuarios;
	}
	
	/**
	 * M�todo de modifica��o de login de Usuarios
	 * @author Jo�o Batista Padilha e Silva
	 * @param var $login
	 */
	public function setloginUsuarios($login = '')
	{
		$this->loginUsuarios = $login;
	}
	
	/**
	 * M�todo de retorno de Login de Usuarios
	 * @author Jo�o Batista Padilha e Silva
	 * @return var
	 */
	public function getLoginUsuarios()
	{
		return $this->loginUsuarios;
	}
	
	/**
	 * M�todo de modifica��o de Senha de Usuarios
	 * @author Jo�o Batista Padilha e Silva
	 * @param var $senha
	 */
	public function setSenhaUsuarios($senha = '')
	{
		$this->senhaUsuarios = $senha;
	}
	
	/**
	 * M�todo de retorno de Senha de Usuarios
	 * @author Jo�o Batista Padilha e Silva
	 * @return var
	 */
	public function getSenhaUsuarios()
	{
		return $this->senhaUsuarios;
	}
	
	/**
	 * M�todo de Modifica��o se o usu�rio est� suspenso ou n�o
	 * @author Jo�o Batista Padilha e Silva
	 * @param boolean $flag
	 */
	public function setFlagSuspenso($flag = false)
	{
		$this->flagSuspenso = $flag;
	}
	
	/**
	 * M�todo de retorno se o usu�rio est� suspenso ou n�o
	 * @author Jo�o Batista Padilha e Silva
	 * @return boolean
	 */
	public function getFlagSuspenso()
	{
		return $this->flagSuspenso;
	}
	
	/**
	 * M�todo que atribui Se o usu�rio � Interno ou n�o
	 * @author Jo�o Batista Padilha e Silva
	 * @param bool $flag
	 */
	public function setFlagTipoUsuario($flag)
	{
		$this->flagTipoUsuario = $flag;
	}
	
	/**
	 * M�todo de retorno se o Usu�rio � cliente Interno ou Externo
	 * @author Jo�o Batista Padilha e Silva
	 * @return unknown
	 */
	public function getFlagTipoUsuario()
	{
		return $this->flagTipoUsuario;
	}
}
?>