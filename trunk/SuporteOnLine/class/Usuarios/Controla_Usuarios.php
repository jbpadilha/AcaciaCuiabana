<?php
//####################################
// * Jo�o Batista Padilha e Silva Analista/Desenvolvedor (�baco Tecnologia)
// * Arquivo: Controla_Usuarios.php
// * Cria��o: Jo�o Batista Padilha e Silva
// * Revis�o:
// * Data de cria��o: 02/07/2008
//####################################

/**
 * Requisi��es feitas via POST/GET - via Formulario
 * @author Jo�o Batista Padilha e Silva
 */

require("UsuariosVo.php");	

/**
 * Classe Controladora de Usu�rios do Sistema Suporte on Line
 * @author Jo�o Batista Padilha e Silva
 */
class Controla_Usuarios
{
	public $mensagemErro = "";
	private $collVo = null;	
	
	/**
	 * M�todo de pesquisa. � inst�nciada a classe de neg�cios BusinessEntity
	 * @author Jo�o Batista Padilha e Silva
	 * @param UsuariosVo $usuariosVo
	 */
	public static function pesquisaLoginUsuarios(UsuariosVo $usuariosVo)
	{
		if($usuariosVo->getLoginUsuarios() == '')
		{
			header("Location:../index.php?msg=O Login n�o pode estar em branco.");
			//throw new Exception("O Login n�o pode estar em branco.");
		}
		elseif($usuariosVo->getSenhaUsuarios() =='') 
		{
			//throw new Exception("A senha n�o pode estar em branco");
			header("Location:../index.php?msg=A senha n�o pode estar em branco.");
		}
		else
		{
			try 
			{
				$businessEntity = new BusinessEntity();
				$businessEntity->pesquisarUsuarios($usuariosVo);
				header("Location:../index.php");				
			}
			catch (Exception $e)
			{
				header("Location:../index.php?msg={$e->getMessage()}");
			}
		}
	}
	
	/**
	 * M�todo para retornar a listagem de usu�rios cadastrados. / Usado para Login no sistema
	 * @author Rafael Henrique Vieira de Moura
	 * @param UsuariosVo $usuariosVo
	 * @return array $this->collVo
	 */
	public function pesquisarUsuariosSistema(UsuariosVo $usuariosVo)
	{
		$businessEntity = new BusinessEntity();
		if ($usuariosVo->getIdUsuarios() != '') {
			$usuariosVo->setParametroConsulta("WHERE idUsuarios = '{$usuariosVo->getIdUsuarios()}'");
		}
		try 
		{
			$this->collVo = $businessEntity->pesquisarUsuarios($usuariosVo);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
		return $this->collVo;
	}
	
	/**
	 * M�todo para exibir lista de usu�rios cadastrados
	 * @author Rafael Henrique Vieira de Moura
	 */
	public function mostraUsuariosSistema()
	{
		$usuariosVo = new UsuariosVo();
		$this->collVo = self::pesquisarUsuariosSistema($usuariosVo);
		
		if(!is_null($this->collVo))
		{
			for($i = 0; $i < count($this->collVo); $i++)
			{
				$usuariosVo = (object) $this->collVo[$i];
				$classCss = ($i%2==0) ? "linhaListagem" : "linha2Listagem";
				$cssSuspenso = ($usuariosVo->getFlagSuspenso()) ? ' class="suspenso"':"";
				
				echo '
					<tr class="'.$classCss.'">
					<td'.$cssSuspenso.'>'.$usuariosVo->getNomeUsuarios().'</td>
					<td'.$cssSuspenso.'>'.$usuariosVo->getLoginUsuarios().'</td>
					<td style="width:2%;">
					<a href="javascript:void(0)" onclick="carregaPagina(\'viewUsuarios.php?cadastro=true&id='.$usuariosVo->getIdUsuarios().'\',\'formulario\')" title="Editar cadastro de '.$usuariosVo->getNomeUsuarios().'">
					<img src="imagens/alterar.jpg" alt="Editar cadastro de '.$usuariosVo->getNomeUsuarios().'" style="border:0;" />
					</a>
					</td>
					</tr>
				';
			}
		}
		else
		{
			echo '
			<tr class="linhaListagem">
			<td colspan="3">N�o existe usu�rios cadastrados.</td>
			</tr>
			';
		}
	}
	
	/**
	 * M�todo para buscar usu�rios conforme parametros informados no formul�rio de consulta
	 * @author Rafael Henrique Vieira de Moura
	 * @param UsuariosVo $usuariosVo
	 * @return array $this->collVo
	 */
	public function pesquisarUsuarios(UsuariosVo $usuariosVo)
	{
		$businessEntity = new BusinessEntity();
		
		$usuariosVo->setParametroConsulta('WHERE');
			
		if ($usuariosVo->getNomeUsuarios() != '') {
			$usuariosVo->setParametroConsulta($usuariosVo->getParametroConsulta()." nomeUsuarios LIKE '%{$usuariosVo->getNomeUsuarios()}%'");
		}
		if ($usuariosVo->getFlagSuspenso() !== '') {
			if ($usuariosVo->getNomeUsuarios() != '') {
				$usuariosVo->setParametroConsulta($usuariosVo->getParametroConsulta()." AND");
			}
			$usuariosVo->setParametroConsulta($usuariosVo->getParametroConsulta()." flagSuspenso = '{$usuariosVo->getFlagSuspenso()}'");
		}
		
		try 
		{
			$this->collVo = $businessEntity->pesquisarUsuarios($usuariosVo);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
		return $this->collVo;
	}
	
	/**
	 * M�todo para retornar usu�rios encontrados pela pesquisa
	 * @author Rafael Henrique Vieira de Moura
	 */
	public function mostraUsuariosPesquisa(UsuariosVo $usuariosVo)
	{
		$this->collVo = self::pesquisarUsuarios($usuariosVo);
		
		echo '<table width="95%" border="0" cellpadding="1" cellspacing="0" class="tabelaListagem" align="center">
				<tr>
					<td class="tituloListagem">Nome</td>
					<td class="tituloListagem" colspan="2">Login</td>
				</tr>';
		
		if(!is_null($this->collVo))
		{
			for($i = 0; $i < count($this->collVo); $i++)
			{
				$usuariosVo = (object) $this->collVo[$i];
				$classCss = ($i%2==0) ? "linhaListagem" : "linha2Listagem";
				$cssSuspenso = ($usuariosVo->getFlagSuspenso()) ? ' class="suspenso"':"";
				
				echo '
					<tr class="'.$classCss.'">
					<td'.$cssSuspenso.'>'.$usuariosVo->getNomeUsuarios().'</td>
					<td'.$cssSuspenso.'>'.$usuariosVo->getLoginUsuarios().'</td>
					<td style="width:2%;">
					<a href="javascript:void(0)" onclick="carregaPagina(\'viewUsuarios.php?cadastro=true&id='.$usuariosVo->getIdUsuarios().'\',\'formulario\')" title="Editar cadastro de '.$usuariosVo->getNomeUsuarios().'">
					<img src="imagens/alterar.jpg" alt="Editar cadastro de '.$usuariosVo->getNomeUsuarios().'" style="border:0;" />
					</a>
					</td>
					</tr>
				';
			}
		}
		else
		{
			echo '
			<tr class="linhaListagem">
			<td colspan="3" align="center">A busca n�o retornou resultados.</td>
			</tr>
			';
		}
		echo '</table>';
	}
	
	/**
	 * M�todo para cadastro de usu�rios
	 * @author Rafael Henrique Vieira de Moura
	 * @param UsuariosVo $usuariosVo
	 */
	public function cadastrarUsuarios(UsuariosVo $usuariosVo)
	{
		$businessEntity = new BusinessEntity();
		$controlaPermissao = new Controla_Permissao();
		$dominio = new Dominio();
		
		try
		{
			$businessEntity->cadastrarUsuarios($usuariosVo);
			
			//Deletar Permiss�o de Usu�rio se for altera��o
			if($usuariosVo->getIdUsuarios() != '')
			{
				$permissaoVo = new Permissao_Usuarios_Funcionalidades_PapeisVo();
				$permissaoVo->setIdUsuarios($usuariosVo->getIdUsuarios());
				$controlaPermissao->deletarPermissoes($permissaoVo);
			}
			else 
			{
				//Pegar o id do registro Inserido
				$usuariosVo_Busca = new UsuariosVo();
				$this->collVo = $businessEntity->pesquisarUsuarios($usuariosVo_Busca);
				$i = count($this->collVo) - 1;
				$usuariosVo_Busca = (object) $this->collVo[$i];
				
				$usuariosVo->setIdUsuarios($usuariosVo_Busca->getIdUsuarios());
			}
			
			$array_funcionalidades = explode(";",rawurldecode($_POST['idFuncionalidades']));
			
			//Cadastrar Permissao das funcionalidades caso exista;
			foreach ($array_funcionalidades as $funcionalidades)
			{
				if($funcionalidades != '' || $funcionalidades != 0)
				{
					$permissaoVo = new Permissao_Usuarios_Funcionalidades_PapeisVo();
					$permissaoVo->setIdUsuarios($usuariosVo->getIdUsuarios());
					$permissaoVo->setIdFuncionalidades($funcionalidades);
					$controlaPermissao->cadastraPermissoes($permissaoVo);
				}
			}
			
			/**
			 * Verificar se o Usu�rio � Interno. Caso seja, adiciona como papel Usu�rio nos projetos da �baco
			 */
			if($usuariosVo->getFlagTipoUsuario() == $dominio->DomnClientes_Abaco)
			{
				//Pesquisa todos os projetos do Cliente �baco
				$this->collVo = null;
				$controlaProjetos = new Controla_Projetos();
				$projetosVo = new ProjetosVo();
				$projetosVo->setIdClientes($dominio->DomnClientes_Abaco);
				$this->collVo = $controlaProjetos->pesquisarProjetos($projetosVo);
				
				if(!is_null($this->collVo))
				{
					foreach ($this->collVo as $projetos)
					{
						$projetosVo = (object) $projetos;
						$papeisProjetosVo = new Papeis_ProjetosVo();
						$papeisProjetosVo->setIdProjetos($projetosVo->getIdProjetos());
						if($usuariosVo->getIdUsuarios() == '')
						{
							$papeisProjetosVo->setIdUsuarios($_SESSION['id_Usuario']);
						}
						else 
						{
							$papeisProjetosVo->setIdUsuarios($usuariosVo->getIdUsuarios());
						}
						$papeisProjetosVo->setIdPapeis($dominio->DomnPapel_Usuario);
						
						//Pesquisar se j� existe esse papel para o usu�rio.
						$collVo_Verifica = null;
						$collVo_Verifica = $controlaProjetos->pesquisarUsuariosPapeisProjetos($papeisProjetosVo);
						if(is_null($collVo_Verifica))
						{
							$controlaProjetos->cadastrarPapeisProjetos($papeisProjetosVo);
						}
					}
				}
				
			}
			
			/**
			 * Grava��o do LOG
			 */
			$dominio = new Dominio();
			if ($usuariosVo->getIdUsuarios() == '')
				$DomnAcao = $dominio->DomnAcao_Log_Suporte_Incluir;
			else 
				$DomnAcao = $dominio->DomnAcao_Log_Suporte_Alterar;
			
			$businessEntity->gravaLog(strip_tags($_POST['funcionalidade']),$DomnAcao);
			/**
			 * Fim da grava��o do LOG
			 */
			
			echo '1';
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
		}
	}
	
	/**
	 * M�todo para alterar a senha do Usu�rio
	 * @author Rafael Henrique Vieira de Moura
	 * @param UsuariosVo $usuariosVo
	 */
	public function alteraSenhaUsuarios(UsuariosVo $usuariosVo)
	{
		$businessEntity = new BusinessEntity();
		
		try 
		{
			$businessEntity->alteraSenhaUsuarios($usuariosVo);
			echo '1';
		}
		catch (Exception $e)
		{
			echo $e->getMessage();			
		}
	}
	
	/**
	 * M�todo de lembrar senha do usu�rio. � chamada a classe de neg�cios BusinessEntity
	 * @author Jo�o Batista Padilha e Silva
	 * @param UsuariosVo $usuariosVo
	 */
	public static function lembrarSenhaUsuarios(UsuariosVo $usuariosVo)
	{
		if($usuariosVo->getLoginUsuarios() == '')
		{
			header("Location:../index.php?msg=O Login n�o pode estar em branco.");
			//throw new Exception("O Login n�o pode estar em branco.");
		}
		else 
		{
			try 
			{
				$businessEntity = new BusinessEntity();
				$businessEntity->pesquisarUsuarios($usuariosVo);
				$msgResposta = "Mensagem enviada com sucesso.";
				header("Location:../index.php?msg=$msgResposta");
			}
			catch (Exception $e)
			{
				header("Location:../index.php?msg={$e->getMessage()}");
			}
		}
	}
	
	/**
	 * M�todo que mostra o select de usu�rios para sele��o
	 * @author Jo�o Batista Padilha e Silva
	 */
	public function mostraSelecionarUsuarios()
	{
		$usuariosVo = new UsuariosVo();
		$usuariosVo->setParametroConsulta('WHERE flagSuspenso = 0');
		
		$this->collVo = self::pesquisarUsuariosSistema($usuariosVo);
		
		if(!is_null($this->collVo))
		{
		
			for($i = 0; $i < count($this->collVo); $i++)
			{
				$usuariosVo = (object) $this->collVo[$i];
				$classCss = ($i%2==0) ? "linhaListagem" : "linha2Listagem";
				echo '
					<tr class="'.$classCss.'">
						<td><input type="checkbox" name="'.$usuariosVo->getIdUsuarios().'" id="'.$usuariosVo->getIdUsuarios().'" value="'.$usuariosVo->getIdUsuarios()."&".$usuariosVo->getNomeUsuarios().'" /></td>
						<td>'.$usuariosVo->getNomeUsuarios().'</td>
					</tr>
				';
			}
		}
		else 
		{
			echo '
				<tr class="linhaListagem">
				<td colspan="2">N�o existe Usu�rios cadastrados.</td>
				</tr>
			';
		}
	}
	
	/**
	 * M�todo de pesquisa de usu�rios que sejam clientes internos
	 * @author Jo�o Batista Padilha e Silva
	 * @param UsuariosVo $usuariosVo
	 * @return array $this->collVo
	 */
	public function pesquisarClientesPorTipoUsuario(UsuariosVo $usuariosVo)
	{
		$businessEntity = new BusinessEntity();
		if ($usuariosVo->getFlagTipoUsuario() != '') {
			$usuariosVo->setParametroConsulta("WHERE flagTipoUsuarios = '{$usuariosVo->getFlagTipoUsuario()}'");
		}
		try 
		{
			$this->collVo = $businessEntity->pesquisarUsuarios($usuariosVo);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
		return $this->collVo;
	}
}
?>