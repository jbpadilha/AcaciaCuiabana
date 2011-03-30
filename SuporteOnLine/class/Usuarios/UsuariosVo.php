<?php
//####################################
// * Joгo Batista Padilha e Silva Analista/Desenvolvedor (Бbaco Tecnologia)
// * Arquivo: UsuariosVo.php
// * Criaзгo: Joгo Batista Padilha e Silva
// * Revisгo:
// * Data de criaзгo: 30/06/2008
//####################################
/**
 * Classe Value Objet. Serve para transportar os atributos dos usuбrios entre as camadas.
 * @author Joгo Batista Padilha e Silva
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
	 * Mйtodo de modificaзгo da identificaзгo do Usuarios
	 * @author Joгo Batista Padilha e Silva
	 * @param integer $id
	 */
	public function setIdUsuarios($id = null)
	{
		$this->idUsuarios = $id;
	}
	
	/**
	 * Mйtodo de retorno da identificaзгo do Usuarios
	 * @author Joгo Batista Padilha e Silva
	 * @return integer
	 */
	public function getIdUsuarios()
	{
		return $this->idUsuarios;
	}
	
	/**
	 * Mйtodo de modificaзгo do nome do Usuarios
	 * @author Joгo Batista Padilha e Silva
	 * @param var $nome
	 */
	public function setNomeUsuarios($nome = '')
	{
		$this->nomeUsuarios = $nome;
	}
	
	/**
	 * Mйtodo de retorno do nome do Usuarios
	 * @author Joгo Batista Padilha e Silva
	 * @return var
	 */
	public function getNomeUsuarios()
	{
		return $this->nomeUsuarios;
	}
	
	/**
	 * Mйtodo de modificaзгo do endereзo de Usuarios
	 * @author Joгo Batista Padilha e Silva
	 * @param var $end
	 */
	public function setEnderecoUsuarios($end = '')
	{
		$this->enderecoUsuarios = $end;
	}
	
	/**
	 * Mйtodo de retorno do endereзo de Usuarios
	 * @author Joгo Batista Padilha e Silva
	 * @return var
	 */
	public function getEnderecoUsuarios()
	{
		return $this->enderecoUsuarios;
	}
	
	/**
	 * Mйtodo de modificaзгo do Cep de Usuarios
	 * @author Joгo Batista Padilha e Silva
	 * @param integer $cep
	 */
	public function setCepUsuarios($cep = null)
	{
		$this->cepUsuarios = $cep;
	}
	
	/**
	 * Mйtodo de retorno o cep de Usuarios
	 * @author Joгo Batista Padilha e Silva
	 * @return integer
	 */
	public function getCepUsuarios()
	{
		return $this->cepUsuarios;
	}
	
	/**
	 * Mйtodo de modificaзгo da cidade de Usuarios
	 * @author Joгo Batista Padilha e Silva
	 * @param var $cidade
	 */
	public function setCidadeUsuarios($cidade = '')
	{
		$this->cidadeUsuarios = $cidade;
	}
	
	/**
	 * Mйtodo de retorno de cidade de Usuarios
	 * @author Joгo Batista Padilha e Silva
	 * @return var
	 */
	public function getCidadeUsuarios()
	{
		return $this->cidadeUsuarios;
	}
	
	/**
	 * Mйtodo de modificaзгo de Email de Usuarios
	 * @author Joгo Batista Padilha e Silva
	 * @param var $email
	 */
	public function setEmailUsuarios($email = '')
	{
		$this->emailUsuarios = $email;
	}
	
	/**
	 * Mйtodo de retorno de Email de Usuarios
	 * @author Joгo Batista Padilha e Silva
	 * @return var
	 */
	public function getEmailUsuarios()
	{
		return $this->emailUsuarios;
	}
	
	/**
	 * Mйtodo de modificaзгo de Telefone de Usuarios
	 * @author Joгo Batista Padilha e Silva
	 * @param var $tel
	 */
	public function setTelUsuarios($tel = null)
	{
		$this->telUsuarios = $tel;
	}
	
	/**
	 * Mйtodo de retorno de telefone de Usuarios
	 * @author Joгo Batista Padilha e Silva
	 * @return var
	 */
	public function getTelUsuarios()
	{
		return $this->telUsuarios;
	}
	
	/**
	 * Mйtodo de modificaзгo de Telefone Celular de Usuarios
	 * @author Joгo Batista Padilha e Silva
	 * @param var $telCel
	 */
	public function setTelCelUsuarios($telCel = null)
	{
		$this->telCelUsuarios = $telCel;
	}
	
	/**
	 * Mйtodo de retorno de Telefone Celular de Usuarios
	 * @author Joгo Batista Padilha e Silva
	 * @return var
	 */
	public function getTelCelUsuarios()
	{
		return $this->telCelUsuarios;
	}
	
	/**
	 * Mйtodo de modificaзгo de Data de Nascimento de Usuarios
	 * @author Joгo Batista Padilha e Silva
	 * @param date $data
	 */
	public function setDataNascimentoUsuarios($data = null)
	{
		$this->dataNascimentoUsuarios = $data;
	}
	
	/**
	 * Mйtodo de retorno de data de Nascimento de Usuarios
	 * @author Joгo Batista Padilha e Silva
	 * @return date
	 */
	public function getDataNascimentoUsuarios()
	{
		return $this->dataNascimentoUsuarios;
	}
	
	/**
	 * Mйtodo de modificaзгo de login de Usuarios
	 * @author Joгo Batista Padilha e Silva
	 * @param var $login
	 */
	public function setloginUsuarios($login = '')
	{
		$this->loginUsuarios = $login;
	}
	
	/**
	 * Mйtodo de retorno de Login de Usuarios
	 * @author Joгo Batista Padilha e Silva
	 * @return var
	 */
	public function getLoginUsuarios()
	{
		return $this->loginUsuarios;
	}
	
	/**
	 * Mйtodo de modificaзгo de Senha de Usuarios
	 * @author Joгo Batista Padilha e Silva
	 * @param var $senha
	 */
	public function setSenhaUsuarios($senha = '')
	{
		$this->senhaUsuarios = $senha;
	}
	
	/**
	 * Mйtodo de retorno de Senha de Usuarios
	 * @author Joгo Batista Padilha e Silva
	 * @return var
	 */
	public function getSenhaUsuarios()
	{
		return $this->senhaUsuarios;
	}
	
	/**
	 * Mйtodo de Modificaзгo se o usuбrio estб suspenso ou nгo
	 * @author Joгo Batista Padilha e Silva
	 * @param boolean $flag
	 */
	public function setFlagSuspenso($flag = false)
	{
		$this->flagSuspenso = $flag;
	}
	
	/**
	 * Mйtodo de retorno se o usuбrio estб suspenso ou nгo
	 * @author Joгo Batista Padilha e Silva
	 * @return boolean
	 */
	public function getFlagSuspenso()
	{
		return $this->flagSuspenso;
	}
	
	/**
	 * Mйtodo que atribui Se o usuбrio й Interno ou nгo
	 * @author Joгo Batista Padilha e Silva
	 * @param bool $flag
	 */
	public function setFlagTipoUsuario($flag)
	{
		$this->flagTipoUsuario = $flag;
	}
	
	/**
	 * Mйtodo de retorno se o Usuбrio й cliente Interno ou Externo
	 * @author Joгo Batista Padilha e Silva
	 * @return unknown
	 */
	public function getFlagTipoUsuario()
	{
		return $this->flagTipoUsuario;
	}
}
?>