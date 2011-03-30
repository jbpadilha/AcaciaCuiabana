<?php
//####################################
// * João Batista Padilha e Silva Analista/Desenvolvedor (Ábaco Tecnologia)
// * Arquivo: Controla_Projetos.php
// * Criação: João Batista Padilha e Silva
// * Revisão: 
// * Data de criação: 14/07/2008
//####################################
require_once("ProjetosVo.php");
require_once("Projetos_ModulosVo.php");
require_once("Papeis_ProjetosVo.php");

/**
 * Classe de Controle de Projetos
 * @author João Batista Padilha e Silva
 */
class Controla_Projetos
{
	private $collVo = null;
	
	/**
	 * Método de cadastramento de projetos
	 * @author João Batista Padilha e Silva
	 * @param ProjetosVo $projetosVo
	 */
	public function cadastrarProjeto(ProjetosVo $projetosVo)
	{
		$businessEntity = new BusinessEntity();
		$papeisProjetosVo = new Papeis_ProjetosVo();
		$destinatariosVo = new DestinatariosNaoConformidadesVo();
		$projetosModulosVo =new Projetos_ModulosVo();
		$controlaNaoConformidade = new Controla_NaoConformidades();
		$array_papeisUsuariosProjetos = null;
		$array_destinatarios = null;
		$array_modulos = null;
		
		try 
		{
			$businessEntity->cadastrarProjetos($projetosVo);
			
			/**
			 * Gravação do LOG
			 */
			$dominio = new Dominio();
			if ($projetosVo->getIdProjetos() == '')
				$DomnAcao = $dominio->DomnAcao_Log_Suporte_Incluir;
			else 
				$DomnAcao = $dominio->DomnAcao_Log_Suporte_Alterar;
			
			$businessEntity->gravaLog(strip_tags($_POST['funcionalidade']),$DomnAcao);
			/**
			 * Fim da gravação do LOG
			 */
						
			if($projetosVo->getIdProjetos() == '')
			{
				//Pegar id caso seja primeiro cadastro
				$this->collVo = self::pesquisarProjetos($projetosVo);
				$projetosVo = (object) $this->collVo[count($this->collVo)-1];
			}
			
			// Atribui a identificação do Projeto aos três VO PapeisProjetos, DestinatariosNaoConformidades e ProjetosModulos
			$papeisProjetosVo->setIdProjetos($projetosVo->getIdProjetos());
			$destinatariosVo->setIdProjetos($projetosVo->getIdProjetos());
			$projetosModulosVo->setIdProjetos($projetosVo->getIdProjetos());

			/**
			 * ----------------------------------------------------------------
			 * -----------Cadastra todos os Papeis Projetos--------------------
			 * ----------------------------------------------------------------
			 */
			
			//Deleta todas os Papeis Projetos
			self::deletaPapeisProjetos($papeisProjetosVo);
			
			
			//Pegas as ids Papeis / Projetos / Usuários  e cadastra
			if(rawurldecode(strip_tags($_POST['idsPapeisProjetos'])) != '')
				$array_papeisUsuariosProjetos = explode(";",rawurldecode(strip_tags($_POST['idsPapeisProjetos'])));
				
			if($array_papeisUsuariosProjetos != null)
			{
				foreach ($array_papeisUsuariosProjetos as $idsPapeisUsuarios)
				{
					$idsPapeisUsuarios = explode("-",$idsPapeisUsuarios);
					$papeisProjetosVo->setIdPapeis($idsPapeisUsuarios[0]);
					$papeisProjetosVo->setIdUsuarios($idsPapeisUsuarios[1]);
					self::cadastrarPapeisProjetos($papeisProjetosVo);
				}
			}
			/**
			 * Testa se o Projeto Novo é do Cliente Ábaco, se sim Adiciona todos os usuários tipo Interno como papel Usuario do projeto
			 */
			if($projetosVo->getIdClientes() == $dominio->DomnClientes_Abaco)
			{
				$this->collVo = null;
				$usuariosVo = new UsuariosVo();
				$usuariosVo->setFlagTipoUsuario(1);
				$controlaUsuarios = new Controla_Usuarios();
				$this->collVo = $controlaUsuarios->pesquisarClientesPorTipoUsuario($usuariosVo);
				
				if(!is_null($this->collVo))
				{
					foreach ($this->collVo as $usuario)
					{
						$usuariosVo = (object) $usuario;
						$papeisProjetosVo = new Papeis_ProjetosVo();
						$papeisProjetosVo->setIdProjetos($projetosVo->getIdProjetos());
						$papeisProjetosVo->setIdUsuarios($usuariosVo->getIdUsuarios());
						$papeisProjetosVo->setIdPapeis($dominio->DomnPapel_Usuario);
						self::cadastrarPapeisProjetos($papeisProjetosVo);
					}
				}
			}

			/**
			 * ----------------------------------------------------------------
			 * -----------Cadastra todos Destinatários não conformidades-------
			 * ----------------------------------------------------------------
			 */
			//Deleta todos os Usuarios Não conformidades
			$controlaNaoConformidade->deletaDestinatariosNaoConformidades($destinatariosVo);
			//Pegas as ids Usuários Destinatários e cadastra
			if(rawurldecode(strip_tags($_POST['idUsuarios'])) != '')
				$array_destinatarios = explode(";",rawurldecode(strip_tags($_POST['idUsuarios'])));
			if($array_destinatarios != null)
			{
				foreach ($array_destinatarios as $destinatarios)
				{
					$destinatariosVo->setIdUsuarios($destinatarios);
					$controlaNaoConformidade->cadastraDestinatariosNaoConformidades($destinatariosVo);
				}
			}
			
			
			/**
			 * ----------------------------------------------------------------
			 * -----------Cadastra Módulos para o Projeto----------------------
			 * ----------------------------------------------------------------
			 */
			//Deleta todos os Módulos do Projeto
			self::deletaProjetosModulos($projetosModulosVo);
			//Pegas as ids dos módulos e cadastra
			if(rawurldecode(strip_tags($_POST['idModulos'])) != '')
				$array_modulos = explode(";",rawurldecode(strip_tags($_POST['idModulos'])));
			if($array_modulos != null)
			{
				foreach ($array_modulos as $modulos)
				{
					$projetosModulosVo->setIdModulos($modulos);
					self::cadastrarProjetosModulos($projetosModulosVo);
				}
			}
			
			
			
			echo "1";
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
		}
	}

	/**
	 * Método para cadastrar Papeis Projetos
	 * @author João Batista Padilha e Silva
	 * @param Papeis_ProjetosVo $papeisProjetos
	 */
	public function cadastrarPapeisProjetos(Papeis_ProjetosVo $papeisProjetos)
	{
		$businessEntity = new BusinessEntity();
		
		try 
		{
			$businessEntity->cadastrarPapeisProjetos($papeisProjetos);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	
	/**
	 * Método de cadastro de Módulos para o Projeto
	 * @author João Batista Padilha e Silva
	 * @param Projetos_ModulosVo $projetosModulosVo
	 */
	public function cadastrarProjetosModulos(Projetos_ModulosVo $projetosModulosVo)
	{
		$businessEntity = new BusinessEntity();
		
		try 
		{
			$businessEntity->cadastrarProjetosModulos($projetosModulosVo);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	
	/**
	 * Método que deleta os Papeis Projetos
	 * @author João Batista Padilha e Silva
	 * @param Papeis_ProjetosVo $papeisProjetos
	 */
	public function deletaPapeisProjetos(Papeis_ProjetosVo $papeisProjetos)
	{
		$businessEntity = new BusinessEntity();
		
		try 
		{
			$businessEntity->deletaPapeisProjetos($papeisProjetos);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	
	/**
	 * Deleta Módulos do Projeto
	 * @author João Batista Padilha e Silva
	 * @param Projetos_ModulosVo $projetosModulosVo
	 */
	public function deletaProjetosModulos(Projetos_ModulosVo $projetosModulosVo)
	{
		$businessEntity = new BusinessEntity();
		
		try 
		{
			$businessEntity->deletaProjetosModulos($projetosModulosVo);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	
	/**
	 * Método que monta o Select com todos os grupos de Fluxos cadastrados no sistema
	 * @author João Batista Padilha e Silva
	 * @param int $idGrupo
	 * @return var
	 */
	public function montaSelectGrupoFluxos($idGrupo = null,$evento = '')
	{
		$dominio = new Dominio();
		
		$montaSelect = '<select id="selectGrupoFluxos" name="selectGrupoFluxos" class="campo" '.$evento.'>
									<option value="">'.$dominio->select.'</option>';
		
		$grupoFluxosVo = new GrupoFluxosVo();
		$controlaGrupoFluxos = new Controla_GrupoFluxos();
		$collVo_GrupoFluxos = $controlaGrupoFluxos->pesquisarGrupoFluxos($grupoFluxosVo);
		
		foreach ($collVo_GrupoFluxos as $grupo)
		{
			if($grupo != '' || $grupo != 0)
			{
				$grupoFluxosVo = (object) $grupo;
				$selected = (($grupoFluxosVo->getIdGrupoFluxos()) == $idGrupo)? 'selected="selected"':'';
				$montaSelect .= '<option value="'.$grupoFluxosVo->getIdGrupoFluxos().'" '.$selected.'>'.$grupoFluxosVo->getNomeGrupoFluxos().'</option>';
			}
		}
		
		$montaSelect .= '</select>';
		return $montaSelect;
	}
	
	/**
	 * Método que monta o select dos clientes para o projeto
	 * @author João Batista Padilha e Silva
	 * @param int $idCliente
	 * @return var
	 */
	public function montaSelectClientes($idCliente = null)
	{
		$dominio = new Dominio();
		
		$montaSelect = '<select id="selectClientes" name="selectClientes" class="campo">
									<option value="">'.$dominio->select.'</option>';
		
		$montaSelect .= $dominio->montaOptionsDomnClientes($idCliente);
		
		$clientesVo = new ClientesVo;
		$controlaClientes = new Controla_Clientes();
		$collVo_Clientes = $controlaClientes->pesquisarClientes($clientesVo);
		if(!is_null($collVo_Clientes))
		{
			foreach ($collVo_Clientes as $cliente)
			{
				if($cliente != '' || $cliente != 0)
				{
					$clientesVo = (object) $cliente;
					$selected = ($clientesVo->getIdClientes() == $idCliente)? 'selected="selected"':'';
					$montaSelect .= '<option value="'.$clientesVo->getIdClientes().'" '.$selected.'>'.$clientesVo->getNomeClientes().'</option>';
				}
			}
		}
		
		$montaSelect .= '</select>';
		return $montaSelect;
	}
	
	/**
	 * Método que monta o select de papeis e executa evento vindo de parâmetro caso haja
	 * @author João Batista Padilha e Silva
	 * @param var $evento
	 * @return var
	 */
	public function montaSelectPapeis($evento = '')
	{
		$dominio = new Dominio();
		
		$montaSelect = '<select id="selectPapeis" name="selectPapeis" class="campo" '.$evento.'>
									<option value="">'.$dominio->select.'</option>';
		
		$papeisVo = new PapeisVo();
		$controlaPapeis = new Controla_Papeis();
		$collVo_Papeis = $controlaPapeis->pesquisarPapeis($papeisVo);
		
		//Monta Select de Papeis Domínio
		$montaSelect .= $dominio->montaOptionsDomnPapeis();
		
		if(!is_null($collVo_Papeis))
		{
			foreach ($collVo_Papeis as $papel)
			{
				if($papel != '' || $papel != 0)
				{
					$papeisVo = (object) $papel;
					$montaSelect .= '<option value="'.$papeisVo->getIdPapeis().'">'.$papeisVo->getNomePapeis().'</option>';
				}
			}
			}
		
		
		$montaSelect .= '</select>';
		return $montaSelect;
	}
	
	/**
	 * Método que monta o Select de usuários do sistema, executa o evento vindo do parâmetro caso haja.
	 * @author João Batista Padilha e Silva
	 * @param var $nomeSelect
	 * @return var
	 */
	public function montaSelectUsuarios($nomeSelect = '')
	{
		$dominio = new Dominio();
		
		$montaSelect = '<select id="'.$nomeSelect.'" name="'.$nomeSelect.'" class="campo">
									<option value="">'.$dominio->select.'</option>';
		
		$usuariosVo = new UsuariosVo();
		$controlaUsuarios = new Controla_Usuarios();
		$collVo_Usuarios = $controlaUsuarios->pesquisarUsuarios($usuariosVo);
		
		foreach ($collVo_Usuarios as $usuario)
		{
			if($usuario != '' || $usuario != 0)
			{
				$usuariosVo = (object) $usuario;
				$montaSelect .= '<option value="'.$usuariosVo->getIdUsuarios().'">'.$usuariosVo->getNomeUsuarios().'</option>';
			}
		}
		
		$montaSelect .= '</select>';
		return $montaSelect;
	}
	
	/**
	 * Método que mostra todos os projetos
	 * @author João Batista Padilha e Silva
	 */
	public function mostraProjetos(ProjetosVo $projetosVo)
	{
		$this->collVo = self::pesquisarProjetos($projetosVo);
		
		if(!is_null($this->collVo))
		{
		
			for($i = 0; $i < count($this->collVo); $i++)
			{
				$projetosVo = (object) $this->collVo[$i];
				$classCss = ($i%2==0) ? "linhaListagem" : "linha2Listagem";
				echo '
					<tr class="'.$classCss.'">
					<td>'.$projetosVo->getNomeProjetos().'</td>
					<td style="width:2%;">
					<a href="javascript:void(0);" onClick="carregaPagina(\'viewProjetos.php?cadastro=true&idProjetos='.$projetosVo->getIdProjetos().'\',\'formulario\');" title="Editar Projeto '.$projetosVo->getNomeProjetos().'">
					<img src="imagens/alterar.jpg" alt="Editar Projeto '.$projetosVo->getNomeProjetos().'" style="border:0;" />
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
				<td colspan="2">Não existe projetos cadastrados.</td>
				</tr>
			';
		}
	}
	
	/**
	 * Método que mostra o resultado da pesquisa de Projetos
	 * @author João Batista Padilha e Silva
	 * @param PapeisVo $papeisVo
	 */
	public function mostraProjetosPesquisa(ProjetosVo $projetosVo)
	{
		$this->collVo = self::pesquisarProjetos($projetosVo);
		
		echo '<table width="95%" border="0" cellpadding="1" cellspacing="0" class="tabelaListagem" align="center">
				  <tr>
					<td class="tituloListagem" colspan="2">Nome do Projeto</td>
				  </tr>';
		
		if(!is_null($this->collVo))
		{
			
			for($i = 0; $i < count($this->collVo); $i++)
			{
				$projetosVo = (object) $this->collVo[$i];
				$classCss = ($i%2==0) ? "linhaListagem" : "linha2Listagem";
				echo '
					<tr class="'.$classCss.'">
					<td>'.$projetosVo->getNomeProjetos().'</td>
					<td style="width:2%;">
					<a href="javascript:void(0);" onClick="carregaPagina(\'viewProjeto.php?cadastro=true&idProjetos='.$projetosVo->getIdProjetos().'\',\'formulario\');" title="Editar Projeto '.$projetosVo->getNomeProjetos().'">
					<img src="imagens/alterar.jpg" alt="Editar Projeto '.$projetosVo->getNomeProjetos().'" style="border:0;" />
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
				<td colspan="2">Projeto não existe.</td>
				</tr>
			';
		}
		echo '</table>';
	}
	
	/**
	 * Método que mostra no campo text para cada papel, qual usuário está lotado.
	 * @author João Batista Padilha e Silva
	 * @param ProjetosVo $projetosVo
	 */
	public function montaTextoPapeisUsuarios(ProjetosVo $projetosVo)
	{
		$this->collVo = null;
		$dominio = new Dominio();
		$papeisProjetosVo = new Papeis_ProjetosVo();
		$papeisProjetosVo->setIdProjetos($projetosVo->getIdProjetos());
		
		$controlaPapeis = new Controla_Papeis();
		$controlaUsuarios = new Controla_Usuarios();
		
		if($papeisProjetosVo->getIdProjetos() != '')
		{
			$this->collVo = self::pesquisarUsuariosPapeisProjetos($papeisProjetosVo);
		}
		
		$mostra = '';
		if(!is_null($this->collVo))
		{
			foreach ($this->collVo as $papeisUsuarios)
			{
				if($papeisUsuarios != '' && $papeisUsuarios != 0)
				{
					$papeisProjetosVo = (object) $papeisUsuarios;
				
					if($papeisProjetosVo->getIdPapeis() == $dominio->DomnPapel_Usuario)
					{
						$papeisVo = new PapeisVo();
						$papeisVo->setIdPapeis($dominio->DomnPapel_Usuario);
						$papeisVo->setNomePapeis($dominio->DomnPapel_Usuario_TXT);
					}
					else 
					{
						//Pesquisa o nome do Papel
						$papeisVo = new PapeisVo();
						$papeisVo->setIdPapeis($papeisProjetosVo->getIdPapeis());
						$collVo_Papeis = $controlaPapeis->pesquisarPapeis($papeisVo);
						$papeisVo = (object) $collVo_Papeis[0];
					}
					//Pesquisa o nome do Usuário
					$usuariosVo = new UsuariosVo();
					$usuariosVo->setIdUsuarios($papeisProjetosVo->getIdUsuarios());
					$collVo_Usuarios = $controlaUsuarios->pesquisarUsuarios($usuariosVo);
					$usuariosVo = (object) $collVo_Usuarios[0];
					
					$mostra .= "<option value=\"".$papeisVo->getIdPapeis()."-".$usuariosVo->getIdUsuarios()."\">".$papeisVo->getNomePapeis()." - ".$usuariosVo->getNomeUsuarios()."</option>";
				}
			}
		}
		echo $mostra;
	}
	
	/**
	 * Método que mostra os Ids que já foram inseridos para alteração.
	 * @author João Batista Padilha e Silva
	 * @param ProjetosVo $projetosVo
	 */
	public function montaIdsPapeisUsuarios(ProjetosVo $projetosVo)
	{
		$papeisProjetosVo = new Papeis_ProjetosVo();
		$papeisProjetosVo->setIdProjetos($projetosVo->getIdProjetos());
		
		$controlaPapeis = new Controla_Papeis();
		$controlaUsuarios = new Controla_Usuarios();
		
		$this->collVo = self::pesquisarUsuariosPapeisProjetos($papeisProjetosVo);
		
		$mostra = '';
		if(!is_null($this->collVo))
		{
			foreach ($this->collVo as $papeisUsuarios)
			{
				if($mostra != '')
					$mostra .= ";";
				$papeisProjetosVo = (object) $papeisUsuarios;
				$mostra .= $papeisProjetosVo->getIdPapeis()."-".$papeisProjetosVo->getIdUsuarios();
			}
		}
		echo $mostra;
	}
	
	/**
	 * Método que pesquisa os projetos existentes
	 * @author João Batista Padilha e Silva
	 * @param ProjetosVo $projetosVo
	 * @return array $this->collVo
	 */
	public function pesquisarProjetos(ProjetosVo $projetosVo)
	{
		$businessEntity = new BusinessEntity();
		try 
		{
			$this->collVo = $businessEntity->pesquisarProjetos($projetosVo);
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
		}
		return $this->collVo;
	}
	
	/**
	 * Método de pesquisa de Papeis para o projeto
	 * @author João Batista Padilha e Silva
	 * @param Papeis_ProjetosVo $papeisProjetosVo
	 * @return array $this->collVo
	 */
	public function pesquisarUsuariosPapeisProjetos(Papeis_ProjetosVo $papeisProjetosVo)
	{
		$businessEntity = new BusinessEntity();
		try 
		{
			$this->collVo = $businessEntity->pesquisarPapeisProjetos($papeisProjetosVo);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
		return $this->collVo;
	}
	
	/**
	 * Método de pesquisa dos Módulos de Projeots
	 * @author João Batista Padilha e Silva
	 * @param Projetos_ModulosVo $projetosModulosVo
	 * @return array $this->collVo
	 */
	public function pesquisarProjetosModulos(Projetos_ModulosVo $projetosModulosVo)
	{
		$businessEntity = new BusinessEntity();
		try 
		{
			$this->collVo = $businessEntity->pesquisarProjetosModulos($projetosModulosVo);
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
		}
		return $this->collVo;
	}
}
?>
