<?php
//####################################
// * João Batista Padilha e Silva Analista/Desenvolvedor (Ábaco Tecnologia)
// * Arquivo: Controla_Pedidos.php
// * Criação: João Batista Padilha e Silva
// * Revisão: 
// * Data de criação: 16/07/2008
//####################################
require_once("PedidosVo.php");

/**
 * Classe de Controle de Pedidos
 * @author João Batista Padilha e Silva
 */
class Controla_Pedidos
{
	private $collVo = null;
	private $collVo_PapeisProjetosPermissao = null;
	private $collVo_PapeisProjetos = null;
	private $collVo_Projetos = null;
	private $collVo_Clientes = null;
	private $collVo_ProjetosModulos = null;
	private $collVo_SubModulos = null;
	private $collVo_Atividades = null;
	private $collVo_Usuarios = null;
	private $collVo_PermissoesAcesso = null;
	
	/**
	 * Método de pesquisa de pedidos
	 * @author João Batista Padilha e Silva
	 * @param PedidosVo $pedidosVo
	 * @return $this->collVo
	 */
	public function pesquisarPedidos(PedidosVo $pedidosVo,$idsDominio = '')
	{
		$businessEntity = new BusinessEntity();
		try 
		{
			if($idsDominio == '')
			{
				$this->collVo = $businessEntity->pesquisarPedidos($pedidosVo);
			}
			else
			{
				$this->collVo = $businessEntity->pesquisarPedidosStatus($pedidosVo,$idsDominio);
			}
			
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
		
		return $this->collVo;
	}
	
	/**
	 * Método de Pesquisa de Pedidos por projeto
	 * @author João Batista Padilha e Silva
	 * @param PedidosVo $pedidosVo
	 * @return array $this->collVo
	 */
	public function pesquisarPedidosPorProjeto(PedidosVo $pedidosVo)
	{
		$businessEntity = new BusinessEntity();
		try 
		{
			$this->collVo = $businessEntity->pesquisarPedidosPorProjeto($pedidosVo);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
		
		return $this->collVo;
	}
	
	/**
	 * Método de Pesquisa de Pedidos por precedente
	 * @author João Batista Padilha e Silva
	 * @param PedidosVo $pedidosVo
	 * @return array $this->CollVo
	 */
	public function pesquisarPedidosPorPrecedente(PedidosVo $pedidosVo)
	{
		$businessEntity = new BusinessEntity();
		try 
		{
			$this->collVo = $businessEntity->pesquisarPedidosPorPrecedente($pedidosVo);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
		
		return $this->collVo;
	}
	
	/**
	 * Método que monta o Select de Clientes do Sistema / Permissão somente projetos alocados
	 * @author João Batista Padilha e Silva
	 * @param PedidosVo $pedidosVo
	 * @param var $eventoOnChange
	 * @return var
	 */
	public function montaSelectClientes(PedidosVo $pedidosVo,$eventoOnChange = '')
	{
		//Carregando CollVo
		self::pesquisarUsuariosPermissao();
		self::pesquisarProjetos();
		self::pesquisarClientes();
		$dominio = new Dominio();
		$idCliente = '';
		//Pesquisar o nome do Cliente para o Projeto, caso exista
		if($pedidosVo->getIdProjetos() != '')
		{
			if(!is_null($this->collVo_Projetos))
			{
				foreach ($this->collVo_Projetos as $projeto)
				{
					$projetosVo_Pesquisa = new ProjetosVo();
					$projetosVo_Pesquisa = (object) $projeto;
					
					if($projetosVo_Pesquisa->getIdProjetos() == $pedidosVo->getIdProjetos())
					{
						$idCliente = $projetosVo_Pesquisa->getIdClientes();
					}
				}
			}
		}
		
		$montaSelect = '<select id="selectClientes" name="selectClientes" class="campo" onChange="'.$eventoOnChange.'">
									<option value="">'.$dominio->select.'</option>';
		
		$clientesVo = new ClientesVo;
		if(!is_null($this->collVo_Clientes))
		{
			foreach ($this->collVo_Clientes as $cliente)
			{
				$selected = '';
				if($cliente != '' || $cliente != 0)
				{
					$clientesVo = (object) $cliente;
					if ($clientesVo->getIdClientes() == $idCliente)
					{
						$selected = 'selected="selected"';
					}
					$montaSelect .= '<option value="'.$clientesVo->getIdClientes().'" '.$selected.'>'.$clientesVo->getNomeClientes().'</option>';
				}
			}
		}
		$montaSelect .= '</select>';
		return $montaSelect;
	}
	
	/**
	 * Método que monta o Select de Projetos / Somente Projetos Alocados.
	 * @author João Batista Padilha e Silva
	 * @param ProjetosVo $projetosVo
	 * @param var $eventoOnChange
	 * @return var
	 */
	public function montaSelectProjetos(ProjetosVo $projetosVo,$eventoOnChange = '')
	{
		//Carregando CollVo
		self::pesquisarUsuariosPermissao();
		self::pesquisarProjetos($projetosVo);
		$dominio = new Dominio();
		$selected = '';
		
		$montaSelect = '<select id="selectProjetos" name="selectProjetos" class="campo" onChange="'.$eventoOnChange.'">
									<option value="">'.$dominio->select.'</option>';
		
		$projetosVo_aux = new ProjetosVo();
		if(!is_null($this->collVo_Projetos))
		{
			foreach ($this->collVo_Projetos as $projetos)
			{
				$projetosVo_aux = (object) $projetos;
				if($projetosVo->getIdClientes() == $projetosVo_aux->getIdClientes())
				{
					if($projetosVo->getIdProjetos() == $projetosVo_aux->getIdProjetos())
					{
						$selected = 'selected="selected"';
					}
					$montaSelect .= '<option value="'.$projetosVo_aux->getIdProjetos().'" '.$selected.'>'.$projetosVo_aux->getNomeProjetos().'</option>';
				}
			}
		}
		$montaSelect .= '</select>';
		return $montaSelect;
	}
	
	/**
	 * Método que monta o Select de Modulos do Sistema / Somente Módulos do Projeto Selecionado
	 * @author João Batista Padilha e Silva
	 * @param Projetos_ModulosVo $projetosModulosVo
	 * @param var $eventoOnChange
	 * @return var
	 */
	public function montaSelectModulos(Projetos_ModulosVo $projetosModulosVo, $eventoOnChange = '')
	{
		//Carregando CollVo
		self::pesquisarUsuariosPermissao();
		self::pesquisarProjetos();
		self::pesquisarProjetosModulos();
		
		$dominio = new Dominio();
		
		$montaSelect = '<select id="selectModulos" name="selectModulos" class="campo" onChange="'.$eventoOnChange.'">
									<option value="">'.$dominio->select.'</option>';
		$selected = '';
		$projetosModulosVo_aux = new Projetos_ModulosVo();
		$controlaModulos = new Controla_Modulos();
		if(!is_null($this->collVo_ProjetosModulos))
		{
			foreach ($this->collVo_ProjetosModulos as $projetosModulos)
			{
				$projetosModulosVo_aux = (object) $projetosModulos;
				if($projetosModulosVo->getIdProjetos() == $projetosModulosVo_aux->getIdProjetos())
				{
					$modulosVo = new ModulosVo();
					$modulosVo->setIdModulos($projetosModulosVo_aux->getIdModulos());
					$collVo = $controlaModulos->pesquisaModulos($modulosVo);
					$modulosVo = (object) $collVo[0];
					
					if($modulosVo->getIdModulos() == $projetosModulosVo->getIdModulos())
					{
						$selected = 'selected="selected"';
					}
					
					$montaSelect .= '<option value="'.$modulosVo->getIdModulos().'" '.$selected.'>'.$modulosVo->getNomeModulos().'</option>';
				}
			}
		}
		$montaSelect .= '</select>';
		return $montaSelect;
	}
	
	/**
	 * Método que monta o Select de Papeis do Projeto
	 * @author João Batista Padilha e Silva
	 * @param ProjetosVo $projetosVo
	 * @param var $eventoOnChange
	 * @return var
	 */
	public function montaSelectPapeis(ProjetosVo $projetosVo, $eventoOnChange = '')
	{
		//Carregando CollVo
		$papeisProjetoVo = new Papeis_ProjetosVo();
		$papeisProjetoVo->setIdProjetos($projetosVo->getIdProjetos());	
		self::pesquisarPapeis($papeisProjetoVo);
		
		$dominio = new Dominio();
		$controlaPapeis = new Controla_Papeis();
		$controlaProjetos = new Controla_Projetos();
		$controlaFluxos = new Controla_Fluxos();
		$businessEntity = new BusinessEntity();
		$collVo_aux = null;
		
		$montaSelect = '<select id="selectPapeis" name="selectPapeis" class="campo" onChange="'.$eventoOnChange.'">
									<option value="">'.$dominio->select.'</option>';
		
		if(!is_null($this->collVo_PapeisProjetos))
		{
			$papeisSelecionados = null;
			
			/**
			 * Pesquisar Quais papeis altorizados pelo Fluxo
			 */
			//Pesquisar o Grupo do Fluxo
			$collVo_Projetos = $controlaProjetos->pesquisarProjetos($projetosVo);
			$projetosVo = (object) $collVo_Projetos[0];
			// Pesquisar o Fluxo Completo do Grupo
			$fluxosVo = new FluxosVo();
			$fluxosVo->setIdGrupoFluxos($projetosVo->getIdGrupoFluxos());
			$collVo_Fluxos = null;
			$collVo_Fluxos = $controlaFluxos->pesquisarFluxos($fluxosVo);

			/**
			 * Pesquisar Papeis Ocupados
			 */
			$papeisOcupados = null;
			foreach ($this->collVo_PapeisProjetos as $papeisProjetoOcupado)
			{
				$papeisProjetoVo_ocupado = new Papeis_ProjetosVo();
				$papeisProjetoVo_ocupado = (object) $papeisProjetoOcupado;
				if($papeisProjetoVo_ocupado->getIdUsuarios() == $_SESSION['id_Usuario'])
				{
					$papeisOcupados[] = $papeisProjetoVo_ocupado->getIdPapeis();
				}
			}
					
			foreach ($this->collVo_PapeisProjetos as $papeisProjeto)
			{
				$papeisProjetoVo = new Papeis_ProjetosVo();
				$papeisProjetoVo = (object) $papeisProjeto;
				$mostraPapel = false;
				
				if(!is_null($collVo_Fluxos))
				{
					foreach ($collVo_Fluxos as $fluxo)
					{
						$fluxosVo = (object) $fluxo;
						
						foreach ($papeisOcupados as $papeisOcupadosSelec)
						{
							if($papeisOcupadosSelec == $fluxosVo->getIdPapeisOrigem())
							{
								if($papeisProjetoVo->getIdPapeis() == $fluxosVo->getIdPapeisDestinatario())
								{
									$mostraPapel = true;
									break;
								}
							}
						}
						
					}
				}
								
				if($mostraPapel)
				{
					if($papeisSelecionados == '')
					{
						$papeisSelecionados[] = $papeisProjetoVo->getIdPapeis();
						if($papeisProjetoVo->getIdProjetos() == $projetosVo->getIdProjetos())
						{
							$papeisVo = new PapeisVo();
							if($papeisProjetoVo->getIdPapeis() == $dominio->DomnPapel_Usuario)
							{
								$papeisVo->setIdPapeis($dominio->DomnPapel_Usuario);
								$papeisVo->setNomePapeis($dominio->DomnPapel_Usuario_TXT);
								$montaSelect .= '<option value="'.$papeisVo->getIdPapeis().'">'.$papeisVo->getNomePapeis().'</option>';
							}
							elseif($papeisProjetoVo->getIdPapeis() != $dominio->DomnPapel_Usuario) 
							{
								$papeisVo->setIdPapeis($papeisProjetoVo->getIdPapeis());
								$this->collVo = $controlaPapeis->pesquisarPapeis($papeisVo);
								$papeisVo = (object) $this->collVo[0];
								$montaSelect .= '<option value="'.$papeisVo->getIdPapeis().'">'.$papeisVo->getNomePapeis().'</option>';
							}
						}
					}
					else 
					{
						$testePapeis = false;
						foreach ($papeisSelecionados as $papeis)
						{
							if($papeis == $papeisProjetoVo->getIdPapeis())
								$testePapeis = true;
							break;
						}
						if (!$testePapeis)
						{
							$papeisSelecionados[] = $papeisProjetoVo->getIdPapeis();
							if($papeisProjetoVo->getIdProjetos() == $projetosVo->getIdProjetos())
							{
								$papeisVo = new PapeisVo();
								if($papeisProjetoVo->getIdPapeis() == $dominio->DomnPapel_Usuario)
								{
									$papeisVo->setIdPapeis($dominio->DomnPapel_Usuario);
									$papeisVo->setNomePapeis($dominio->DomnPapel_Usuario_TXT);
									$montaSelect .= '<option value="'.$papeisVo->getIdPapeis().'">'.$papeisVo->getNomePapeis().'</option>';
								}
								elseif($papeisProjetoVo->getIdPapeis() != $dominio->DomnPapel_Usuario) 
								{
									$papeisVo->setIdPapeis($papeisProjetoVo->getIdPapeis());
									$this->collVo = $controlaPapeis->pesquisarPapeis($papeisVo);
									$papeisVo = (object) $this->collVo[0];
									$montaSelect .= '<option value="'.$papeisVo->getIdPapeis().'">'.$papeisVo->getNomePapeis().'</option>';
								}
							}
						}
					}
				}
			}
		}
		$montaSelect .= '</select>';
		return $montaSelect;
	}
	
	/**
	 * Método que monta Somente os Options de Tecnologias. Não persiste, apenas serve de parâmetro para montar Atividades
	 * @author João Batista Padilha e Silva
	 * @param var $eventoOnChange
	 * @return var
	 */
	public function montaOptionsSelectTecnologias($eventoOnChange = '', $idAtividade = '')
	{
		$businessEntity = new BusinessEntity();
		$dominio = new Dominio();
		$monta = '';
		try 
		{
			$controlaTecnologias = new Controla_Tecnologias();
			$tecnologiasVo = new TecnologiasVo();
			$this->collVo = $controlaTecnologias->pesquisarTecnologias($tecnologiasVo);
			
			$monta .= '<select id="selectTecnologia" name="selectTecnologia" class="campo" onChange="'.$eventoOnChange.'">
					<option value="">'.$dominio->select.'</option>';
			$selected = '';
			
			
			//Pesquisa a tecnologia da Atividade. Caso exista
			$atividadesVo = new AtividadesPontoFuncaoHorasVo();
			if($idAtividade != '')
			{
				$controlaAtividades = new Controla_AtividadesPontoFuncaoHoras();
				$atividadesVo->setIdAtividadePontoFuncaoHoras($idAtividade);
				$collVoAtividade = $controlaAtividades->pesquisarAtividades($atividadesVo);
				$atividadesVo = (object) $collVoAtividade[0];
			}
			
			
			if(!is_null($this->collVo))
			{
				foreach ($this->collVo as $tecnologias)
				{
					$tecnologiasVo = (object) $tecnologias;
					if($atividadesVo->getIdTecnologias() == $tecnologiasVo->getIdTecnologias())
					{
						$selected = 'selected="selected"';
					}
					$monta .= "<option value=\"{$tecnologiasVo->getIdTecnologias()}\" {$selected}>{$tecnologiasVo->getNomeTecnologias()}</option>";
				}
			}
			$monta .= '</select>';
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
		}
		return $monta;
	}
	
	/**
	 * Método que monta o Select de Sub-Módulos do Sistema / A partir do Módulo Selecionado
	 * @author João Batista Padilha e Silva
	 * @param Modulos_SubModulosVo $modulosSubModulosVo
	 * @param var $eventoOnChange
	 * @return var
	 */
	public function montaSelectSubModulos(Modulos_SubModulosVo $modulosSubModulosVo,$eventoOnChange = '')
	{
		//Carregando CollVo
		self::pesquisarSubModulos($modulosSubModulosVo);
		
		$dominio = new Dominio();
		
		$montaSelect = '<select id="selectSubModulos" name="selectSubModulos" class="campo" onChange="'.$eventoOnChange.'">
									<option value="">'.$dominio->select.'</option>';
		
		if(!is_null($this->collVo_SubModulos))
		{
			foreach ($this->collVo_SubModulos as $subModulos)
			{
				$subModulosVo = new SubModulosVo();
				$subModulosVo = (object) $subModulos;
				$montaSelect .= '<option value="'.$subModulosVo->getIdSubModulos().'">'.$subModulosVo->getNomeSubModulos().'</option>';
			}
		}
		$montaSelect .= '</select>';
		return $montaSelect;
	}
	
	/**
	 * Método que monta o select de atividades / Recebe a tecnologia como parâmetro
	 * @author João Batista Padilha e Silva
	 * @param AtividadesPontoFuncaoHorasVo $atividadesVo
	 * @param var $eventoOnChange
	 * @return var
	 */
	public function montaSelectAtividades(AtividadesPontoFuncaoHorasVo $atividadesVo, $eventoOnChange = '')
	{
		//Carregando CollVo
		self::pesquisarAtividades($atividadesVo);
		
		$dominio = new Dominio();
		
		$montaSelect = '<select id="selectAtividades" name="selectAtividades" class="campo" onChange="'.$eventoOnChange.'">
									<option value="">'.$dominio->select.'</option>';
		
		if(!is_null($this->collVo_Atividades))
		{
			foreach ($this->collVo_Atividades as $atividades)
			{
				$atividadesVo = (object) $atividades;
				$montaSelect .= '<option value="'.$atividadesVo->getIdAtividadePontoFuncaoHoras().'">'.$atividadesVo->getNomeAtividadesPontoFuncaoHoras().'</option>';
			}
		}
		$montaSelect .= '</select>';
		return $montaSelect;
	}

	/**
	 * Método que monta o Input de Previsão de Entrega das Atividades
	 * @author João Batista Padilha e Silva
	 * @param AtividadesPontoFuncaoHorasVo $atividadesVo
	 * @return var
	 */
	public function montaInputPrevisaoEntregaAtividades(AtividadesPontoFuncaoHorasVo $atividadesVo,$dataPrevisaoSelecionada = '')
	{
		//Carregando CollVo
		if($atividadesVo->getIdAtividadePontoFuncaoHoras() != '' || $atividadesVo->getIdTecnologias() != '')
		{
			self::pesquisarAtividades($atividadesVo);
		}
		$formataData = new FormataData();
		$value = '';
		
		if(!is_null($this->collVo_Atividades))
		{
			foreach ($this->collVo_Atividades as $atividades)
			{
				$atividadesVo = (object) $atividades;
				$value = $atividadesVo->getHorasAtividadesPontoFuncaoHoras();
			}
		}
		if($dataPrevisaoSelecionada != '')
		{
			$value = $formataData->toViewDateTime($dataPrevisaoSelecionada);
		}
		
		$montaSelect = '<input type="text" id="previsaoEntrega" name="previsaoEntrega" value="'.$value.'" class="campo">';

		return $montaSelect;
	}
	
	/**
	 * Método que monta o Select de Usuários / Apenas os Usuários do Projeto
	 * @author João Batista Padilha e Silva
	 * @param Papeis_ProjetosVo $papeisProjetosVo
	 * @return unknown
	 */
	public function montaSelectUsuarios(Papeis_ProjetosVo $papeisProjetosVo)
	{
		//Carregando CollVo
		self::pesquisarUsuariosProjeto($papeisProjetosVo);
		
		$dominio = new Dominio();
		$businessEntity = new BusinessEntity();
		$controlaUsuarios = new Controla_Usuarios();
		$collVoUsuarios = null;
		
		$montaSelect = '<select id="selectUsuarios" name="selectUsuarios" class="campo">
									<option value="">'.$dominio->select.'</option>';
		
		if(!is_null($this->collVo_Usuarios))
		{
			foreach ($this->collVo_Usuarios as $papeisProjetoUsuarios)
			{
				$papeisProjetosVo = (object) $papeisProjetoUsuarios;
				$usuariosVo = new UsuariosVo();
				$usuariosVo->setIdUsuarios($papeisProjetosVo->getIdUsuarios());
				$this->collVo = $controlaUsuarios->pesquisarUsuarios($usuariosVo);
				$usuariosVo = (object) $this->collVo[0];
				$collVoUsuarios = $businessEntity->popularCollVo($usuariosVo, $collVoUsuarios);
			}
			if(!is_null($collVoUsuarios))
			{
				foreach ($collVoUsuarios as $usuarios)
				{
					$usuariosVo = new UsuariosVo();
					$usuariosVo = (object) $usuarios;
					$montaSelect .= '<option value="'.$usuariosVo->getIdUsuarios().'">'.$usuariosVo->getNomeUsuarios().'</option>';
				}
			}
		}
		
		$montaSelect .= '</select>';
		return $montaSelect;
	}
	
	/**
	 * Método que monta o Select de Versões
	 * @author João Batista Padilha e Silva
	 * @param VersoesVo $versoesVo
	 * @return var
	 */
	public function montaSelectVersoes(VersoesVo $versoesVo)
	{
		$dominio = new Dominio();
		$monta = '';
		$selected = '';
		try 
		{
			$controlaVersoes = new Controla_Versoes();
			$idSelecionada = $versoesVo->getIdVersoes();
			$versoesVo->setIdVersoes('');
			$this->collVo = $controlaVersoes->buscaVersoes($versoesVo);
			
			$monta .= '<select id="selectVersoes" name="selectVersoes" class="campo">
					<option value="">'.$dominio->select.'</option>';
			
			if(!is_null($this->collVo))
			{
				foreach ($this->collVo as $versoes)
				{
					$versoesVo = (object) $versoes;
					if($idSelecionada == $versoesVo->getIdVersoes())
					{
						$selected = 'selected="selected"';
					}
					$monta .= "<option value=\"{$versoesVo->getIdVersoes()}\" {$selected}>{$versoesVo->getNomeVersoes()}</option>";
				}
			}
			$monta .= '</select>';
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
		}
		return $monta;
	}
	
	/**
	 * Método que monta a descricao dos Pedidos / Persiste na Tabela Historico
	 * @author João Batista Padilha e Silva
	 * @return var
	 */
	public function montaDescricaoPedidos()
	{
		$dominio = new Dominio();
		$monta = '';
		try 
		{
			$monta .= '<textarea name="descricaoPedido" name="descricaoPedido" cols="60" rows="5" class="campo"></textarea>';
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
		}
		return $monta;
	}
	
	/**
	 * Método que monta o Input do Assunto do pedido
	 * @author João Batista Padilha e Silva
	 * @param var $assunto
	 * @return var
	 */
	public function montaAssuntoPedidos($assunto = '')
	{
		$monta = '';
		$monta .= '<input type="text" name="campoAssunto" id="campoAssunto" value="'.rawurldecode($assunto).'" class="campo" size="63">';
		return $monta;
	}
	
	/**
	 * Método que monta o Select de Severidade. Instância o Dominio e chama o monta Select a partir de lá.
	 * @author João Batista Padilha e Silva
	 * @return var
	 */
	public function montaSelectSeveridade()
	{
		$dominio = new Dominio();
		$monta= $dominio->montaSelectSeveridade();
		return $monta;
	}
	
	/**
	 * Método que mostra os nomes dos papeis que o usuário ocupa no projeto
	 * @author João Batista Padilha e Silva
	 * @param Papeis_ProjetosVo $papeisProjetosVo
	 * @return var
	 */
	public function mostraPapelOcupado(Papeis_ProjetosVo $papeisProjetosVo)
	{
		self::pesquisarUsuariosPermissao();
		$controlaPapeis = new Controla_Papeis();
		$mostra = '';
		$campoHidden = '';
		$dominio = new Dominio();
		if(!is_null($this->collVo_PapeisProjetosPermissao))
		{
			foreach ($this->collVo_PapeisProjetosPermissao as $permissoes)
			{
				$papeisPermissoesVo = new Papeis_ProjetosVo();
				$papeisPermissoesVo = (object) $permissoes;
				if($papeisPermissoesVo->getIdProjetos() == $papeisProjetosVo->getIdProjetos())
				{
					$papeisVo = new PapeisVo();
					if($papeisPermissoesVo->getIdPapeis() == $dominio->DomnPapel_Usuario)
					{
						$papeisVo->setIdPapeis($papeisPermissoesVo->getIdPapeis());
						$papeisVo->setNomePapeis($dominio->DomnPapel_Usuario_TXT);
						$papelNovo = $dominio->DomnPapel_Usuario_TXT;
					}
					else 
					{
						$papeisVo->setIdPapeis($papeisPermissoesVo->getIdPapeis());
						$papelNovo = $controlaPapeis->pesquisaNomePapeis($papeisVo);
					}
					
					if($mostra != '')
					{
						$mostra .= '<br>';
					}
					if($campoHidden != '')
					{
						$campoHidden .= ';';
					}
					//Verifica se o Papel já foi mostrado
					$retorno = '';
					if($campoHidden != '')
					{
						$ids = explode(";",$campoHidden);
						foreach ($ids as $id)
						{
							if($id == $papeisPermissoesVo->getIdPapeis())
							{
								$retorno = "sim";
							}
						}
					}
					if($retorno == '')
					{
						$campoHidden .= $papeisPermissoesVo->getIdPapeis();
						$mostra .= $papelNovo;
					}
					
				}
			}
		}
		$campoHidden = '<input type="hidden" name="idsPapeisOcupado" id="idsPapeisOcupado" value="'.$campoHidden.'"/>';
		$mostra .= $campoHidden;
		return $mostra;
	}
	
	/**
	 * Método que mostra as funcionalidades do pedido, conforme permissão.
	 * @author João Batista Padilha e Silva
	 * @param ProjetosVo $projetosVo
	 */
	public function mostraCamposDeAcordoPermissao(ProjetosVo $projetosVo, PedidosVo $pedidosVo = null)
	{
		//Carregando CollVo
		self::pesquisarUsuariosPermissao();
		$papeisProjetosVo = new Papeis_ProjetosVo();
		$dominio = new Dominio();
		
		if(!is_null($this->collVo_PapeisProjetosPermissao))
		{
			foreach ($this->collVo_PapeisProjetosPermissao as $papeisProjetos)
			{
				$papeisProjetosVo = (object) $papeisProjetos;
				if($papeisProjetosVo->getIdProjetos() == $projetosVo->getIdProjetos())
				{
					$permissaoVo = new Permissao_Usuarios_Funcionalidades_PapeisVo();
					$permissaoVo->setIdPapeis($papeisProjetosVo->getIdPapeis());
					self::pesquisarPermissoesAcesso($permissaoVo);
				}
			}
		}
		
		//Pesquisar as Permissões do Usuário.
		$controlaPermissoes = new Controla_Permissao();
		$this->collVo = $controlaPermissoes->buscaPermissoesUsuarios();
		
		if(!is_null($this->collVo))
		{
			foreach ($this->collVo as $permissao)
			{
				$permissaoVo = new Permissao_Usuarios_Funcionalidades_PapeisVo();
				$permissaoVo = (object) $permissao;
				self::pesquisarPermissoesAcesso($permissaoVo);
			}
		}
		
		//Pesquisar pedido enviado - caso seja diferente de nulo
		$pedidosVo = new PedidosVo();
		$historicoVo = new Historico_PedidosVo();
		if($pedidosVo->getIdPedidos() != '')
		{
			$controlaPedidos = new Controla_Pedidos();
			$collVo_Pedidos = $controlaPedidos->pesquisarPedidos($pedidosVo);
			$pedidosVo = (object) $collVo_Pedidos[0];
			
			//Pesquisa Historico
			$historicoVo->setIdPedidos($pedidosVo->getIdPedidos());
			$controlaHistorico = new Controla_Historico();
			$collVo_Historico = $controlaHistorico->pesquisarHistorico($historicoVo);
			
			$historicoVo = (object) $collVo_Historico[0];
		}
		
		
		/**
		 * Mostra as Funcionalidades
		 */
			
		if(!is_null($this->collVo_PermissoesAcesso))	
		{
			echo '<table width="100%" border="0" align="center" cellpadding="2" cellspacing="3">';
			
			foreach ($this->collVo_PermissoesAcesso as $acesso)
			{
				$permissaoVo = (object) $acesso;
				if($permissaoVo->getIdFuncionalidades() == $dominio->DomnFuncionalidade_Pedidos_Modulo_SubModulo) //Caso seja Módulo-SubMódulo
				{
					$projetosModulosVo = new Projetos_ModulosVo();
					$projetosModulosVo->setIdProjetos($projetosVo->getIdProjetos());
					$projetosModulosVo->setIdModulos($pedidosVo->getIdModulos());
					echo '
					<tr>
						<td width="25%" valign="top" class="formTdEsquerdo"><b>M&oacute;dulo:</b></td>
						<td width="31%" valign="top" id="mostraModulos">
						'.self::montaSelectModulos($projetosModulosVo,'consultarSubModulos(this)').'</td>
						<td width="20%" valign="top" class="formTdEsquerdo"><b>Sub-M&oacute;dulo:</b></td>
						<td width="24%" valign="top" id="mostraSubModulos">&nbsp;</td>
					</tr>
					';
				}
								
				if($permissaoVo->getIdFuncionalidades() == $dominio->DomnFuncionalidade_Pedidos_Tecnologia_Atividades) //Caso seja Tecnologia-Atividades
				{
					echo '
					<tr>
						<td width="25%" valign="top" class="formTdEsquerdo"><b>Tecnologia Utilizada:</b></td>
						<td width="31%" valign="top" id="mostraTecnologias">'.self::montaOptionsSelectTecnologias('consultarAtividades(this)',$pedidosVo->getIdAtividadesPontoFuncaoHoras()).'</td>
						<td width="20%" valign="top" class="formTdEsquerdo"><b>Atividade:</b></td>
						<td width="24%" valign="top" id="mostraAtividades">';
					$atividadesVo = new AtividadesPontoFuncaoHorasVo();
					if($pedidosVo->getIdAtividadesPontoFuncaoHoras() != '')
					{
						$atividadesVo = new AtividadesPontoFuncaoHorasVo();
						$atividadesVo->setIdAtividadePontoFuncaoHoras($pedidosVo->getIdAtividadesPontoFuncaoHoras());
						echo self::montaSelectAtividades($atividadesVo,'consultarPrevisaoEntrega(this)');
					}
					echo '&nbsp;</td>
					</tr>
					<tr>
						<td width="25%" valign="top" class="formTdEsquerdo"><b>Previs&atilde;o de Entrega:</b></td>
						<td width="31%" valign="top" id="mostraPrevisaoEntrega">'.self::montaInputPrevisaoEntregaAtividades($atividadesVo).'&nbsp;</td>
						<td width="20%" valign="top" class="formTdEsquerdo">&nbsp;</td>
						<td width="24%" valign="top">&nbsp;</td>
					</tr>
					';
					
				}
				
				if($permissaoVo->getIdFuncionalidades() == $dominio->DomnFuncionalidade_Pedidos_Versao) //Caso seja Versões
				{
					$versoesVo = new VersoesVo();
					$versoesVo->setIdProjetos($projetosVo->getIdProjetos());
					$versoesVo->setIdVersoes($pedidosVo->getIdVersoes());
					echo '
					<tr>
						<td width="25%" valign="top" class="formTdEsquerdo"><b>Vers&atilde;o:</b></td>
						<td width="31%" valign="top" id="mostraVersoes">'.self::montaSelectVersoes($versoesVo).'</td>
						<td width="20%" valign="top" class="formTdEsquerdo"></td>
						<td width="24%" valign="top">&nbsp;</td>
					</tr>
					';
				}
								
				if($permissaoVo->getIdFuncionalidades() == $dominio->DomnFuncionalidade_Pedidos_Papel_Usuario_Destinatario) //Caso seja Papel/Usuario Destinatário
				{
					$papeisProjetosVo = new Papeis_ProjetosVo();
					$papeisProjetosVo->setIdProjetos($projetosVo->getIdProjetos());
					echo '
					<tr>
						<td width="25%" valign="top" class="formTdEsquerdo"><b>Papel Destinat&aacute;rio:</b></td>
						<td width="31%" valign="top" id="mostraPapeis">'.self::montaSelectPapeis($projetosVo,'consultarUsuarios(this)').'</td>
						<td width="20%" valign="top" class="formTdEsquerdo"><b>Selecionar Usu&aacute;rio:</b></td>
						<td width="24%" valign="top" id="mostraUsuarios">&nbsp;</td>
					</tr>
					';
				}
								
			}
			echo '</table>';
		}
		
	}
	
	/**
	 * Método que mostra o campo Anexo do Pedido
	 * @author João Batista Padilha e Silva
	 * @return var
	 */
	public function mostraCampoAnexo()
	{
		$mostra = '';
		$mostra = '<input name="arquivoAnexo" type="file" id="arquivoAnexo" class="campo"/>';
		return $mostra;
	}
	
	/**
	 * Método que popula as permissões às funcionalidades do Usuario ou do Papel
	 * @author João Batista Padilha e Silva
	 * @param Permissao_Usuarios_Funcionalidades_PapeisVo $permissaoVo
	 */
	public function pesquisarPermissoesAcesso(Permissao_Usuarios_Funcionalidades_PapeisVo $permissaoVo)
	{
		$businessEntity = new BusinessEntity();
		$controlaPermissao = new Controla_Permissao();
		$this->collVo = $controlaPermissao->buscaPermissoesSemMensagem($permissaoVo);
		if(!is_null($this->collVo))
		{
			foreach ($this->collVo as $permissao)
			{
				$permissaoVo = (object) $permissao;
				$this->collVo_PermissoesAcesso = $businessEntity->popularCollVo($permissaoVo,$this->collVo_PermissoesAcesso);
			}
		}
		
	}
	
	/**
	 * Método que pesquisa todas as permissões que o usuario tem acesso.
	 * @author João Batista Padilha e Silva
	 */
	public function pesquisarUsuariosPermissao()
	{
		$controlaProjetos = new Controla_Projetos();
		$papeisProjetosVo = new Papeis_ProjetosVo();
		try 
		{
			$papeisProjetosVo->setIdUsuarios($_SESSION['id_Usuario']);
			$this->collVo_PapeisProjetosPermissao = $controlaProjetos->pesquisarUsuariosPapeisProjetos($papeisProjetosVo);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	
	/**
	 * Método que pesquisa todos os papeis que o Usuario pertence ou que o projeto tem
	 * @author João Batista Padilha e Silva
	 * @param Papeis_ProjetosVo $papeisProjetosVo
	 */
	public function pesquisarPapeis(Papeis_ProjetosVo $papeisProjetosVo)
	{
		$controlaProjetos = new Controla_Projetos();
		try 
		{
			$this->collVo_PapeisProjetos = $controlaProjetos->pesquisarUsuariosPapeisProjetos($papeisProjetosVo);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	
	/**
	 * Método que pesquisa todos os Projetos existentes / Que o usuário está alocado
	 * @author João Batista Padilha e Silva
	 * @param ProjetosVo $projetosVo
	 */
	public function pesquisarProjetos(ProjetosVo $projetosVo = null)
	{
		$controlaProjetos = new Controla_Projetos();		
		$papeisProjetosVo = new Papeis_ProjetosVo();
		$businessEntity = new BusinessEntity();
		$dominio = new Dominio();
		try 
		{
			//Iterando o CollVo de Papeis Projetos
			if(!is_null($this->collVo_PapeisProjetosPermissao))
			{
				foreach ($this->collVo_PapeisProjetosPermissao as $papeisProjetos)
				{
					$collVoProjeto = null;
					if (!is_null($projetosVo))
					{
						$projetosVo_aux = new ProjetosVo();
						$papeisProjetosVo = (object) $papeisProjetos;
						$projetosVo_aux->setIdProjetos($papeisProjetosVo->getIdProjetos());
						$collVoProjeto = $controlaProjetos->pesquisarProjetos($projetosVo_aux);
						$projetosVo_aux = (object) $collVoProjeto[0];
						if($projetosVo_aux->getIdClientes() == $projetosVo->getIdClientes())
							$this->collVo_Projetos = $businessEntity->popularCollVo($projetosVo_aux,$this->collVo_Projetos);
					}
					else 
					{
						$projetosVo_aux = new ProjetosVo();
						$papeisProjetosVo = (object) $papeisProjetos;
						$projetosVo_aux->setIdProjetos($papeisProjetosVo->getIdProjetos());
						$collVoProjeto = $controlaProjetos->pesquisarProjetos($projetosVo_aux);
						$projetosVo_aux = (object) $collVoProjeto[0];
						$this->collVo_Projetos = $businessEntity->popularCollVo($projetosVo_aux,$this->collVo_Projetos);
					}
				}
				
			}
			//Carregar Projeto do Cliente Ábaco, caso o cliente seja selecionado como Ábaco
			if (!is_null($projetosVo))
			{
				if($projetosVo->getIdClientes() == $dominio->DomnClientes_Abaco)
				{
					$projetosVo_aux = new ProjetosVo();
					$projetosVo_aux->setIdClientes($dominio->DomnClientes_Abaco);
					$this->collVo = $controlaProjetos->pesquisarProjetos($projetosVo_aux);
					if (!is_null($this->collVo)) 
					{
						foreach ($this->collVo as $projeto)
						{
							$projetosVo_aux = (object) $projeto;
							$this->collVo_Projetos = $businessEntity->popularCollVo($projetosVo_aux,$this->collVo_Projetos);
						}
					}
					$projetosVo_aux = null;
					$this->collVo = null;
				}
			}
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	
	/**
	 * Método que pesquisa todos os Clientes
	 * @author João Batista Padilha e Silva
	 */
	public function pesquisarClientes()
	{
		$controlaClientes = new Controla_Clientes();
		$projetosVo = new ProjetosVo();
		$businessEntity = new BusinessEntity();
		$dominio = new Dominio();
		try 
		{	
			//Iterando CollVo de Projetos
			if(!is_null($this->collVo_Projetos))
			{
				foreach ($this->collVo_Projetos as $projetos)
				{
					$projetosVo = (object) $projetos;
					$clientesVo = new ClientesVo();
					if($projetosVo->getIdClientes() == $dominio->DomnClientes_Abaco)
					{
						$clientesVo->setIdClientes($projetosVo->getIdClientes());
						$clientesVo->setNomeClientes($dominio->DomnClientes_Abaco_TXT);
						$this->collVo_Clientes = $businessEntity->popularCollVo($clientesVo, $this->collVo_Clientes);
					}
					else 
					{
						$clientesVo->setIdClientes($projetosVo->getIdClientes());
						$collVoClientes = $controlaClientes->pesquisarClientes($clientesVo);
						$clientesVo = (object) $collVoClientes[0];
						$this->collVo_Clientes = $businessEntity->popularCollVo($clientesVo, $this->collVo_Clientes);
					}
				}
			}
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	
	/**
	 * Método que pesquisa todos os módulos do Projeto
	 * @author João Batista Padilha e Silva
	 */
	public function pesquisarProjetosModulos()
	{
		$controlaModulos = new Controla_Modulos();
		$controlaProjetos = new Controla_Projetos();
		$projetosVo = new ProjetosVo();
		$businessEntity = new BusinessEntity();
		$collVoProjetosModulos = null;
		try 
		{	
			//Iterando CollVo de Projetos
			if(!is_null($this->collVo_Projetos))
			{
				foreach ($this->collVo_Projetos as $projetos)
				{
					$projetosVo = (object) $projetos;
					//Pesquisar todos os Modulos desse Projeto
					$projetosModulosVo = new Projetos_ModulosVo();
					$projetosModulosVo->setIdProjetos($projetosVo->getIdProjetos());
					$collVoProjetosModulos = $controlaProjetos->pesquisarProjetosModulos($projetosModulosVo);
					
					if(!is_null($collVoProjetosModulos))
					{
						foreach ($collVoProjetosModulos as $projetosModulos)
						{
							$projetosModulosVo = (object) $projetosModulos;
								
							//Grava no CollVo de Projetos/Modulos
							$this->collVo_ProjetosModulos = $businessEntity->popularCollVo($projetosModulosVo,$this->collVo_ProjetosModulos);
						}
					}
				}
			}
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	
	/**
	 * Método que pesquisa todos os sub-módulos do módulo selecionado
	 * @author João Batista Padilha e Silva
	 * @param Modulos_SubModulosVo $modulosSubModulosVo
	 */
	public function pesquisarSubModulos(Modulos_SubModulosVo $modulosSubModulosVo)
	{
		$controlaModulos = new Controla_Modulos();
		$controlaSubModulos = new Controla_SubModulos();
		$businessEntity = new BusinessEntity();
		try 
		{	
			$this->collVo = $controlaModulos->pesquisarModulosSubModulos($modulosSubModulosVo);
			
			if(!is_null($this->collVo))
			{
				foreach ($this->collVo as $modulosSubModulos)
				{
					$modulosSubModulosVo = (object) $modulosSubModulos;
					$subModulosVo = new SubModulosVo();
					$subModulosVo->setIdSubModulos($modulosSubModulosVo->getIdSubModulos());
					$collVoSubModulos = $controlaSubModulos->pesquisaSubModulos($subModulosVo);
					$subModulosVo = (object) $collVoSubModulos[0];
					$this->collVo_SubModulos = $businessEntity->popularCollVo($subModulosVo, $this->collVo_SubModulos);
				}
			}
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	
	/**
	 * Método que pesquisa todas as atividades do projeto
	 * @author João Batista Padilha e Silva
	 * @param AtividadesPontoFuncaoHorasVo $atividadesVo
	 */
	public function pesquisarAtividades(AtividadesPontoFuncaoHorasVo $atividadesVo)
	{
		$controlaAtividades = new Controla_AtividadesPontoFuncaoHoras();
		try 
		{
			$this->collVo_Atividades = $controlaAtividades->pesquisarAtividades($atividadesVo);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	
	/**
	 * Método que pesquisa todos os usuários do projeto
	 * @author João Batista Padilha e Silva
	 * @param Papeis_ProjetosVo $papeisProjetosVo
	 */
	public function pesquisarUsuariosProjeto(Papeis_ProjetosVo $papeisProjetosVo)
	{
		$controlaProjetos = new Controla_Projetos();
		try 
		{
			$this->collVo_Usuarios = $controlaProjetos->pesquisarUsuariosPapeisProjetos($papeisProjetosVo);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	
	/**
	 * Método que pesquisa o horário Inicial de Atendimento
	 * @author João Batista Padilha e Silva
	 * @return date
	 */
	public function pesquisarDataHoraAtendimentoInicial()
	{
		$controlaTabelaBasica = new Controla_TabelaBasica();
		$tabelaBasicaVo = new TabelaBasicaVo();
		$collVoTabelaBasica = $controlaTabelaBasica->pesquisaTabelaBasica($tabelaBasicaVo);
		$tabelaBasicaVo = (object) $collVoTabelaBasica[0];
		
		$time = explode(":",$tabelaBasicaVo->getHorasBaseRecebimentoPedido());
		$horasAtendimentoInicial = date("H:i:s",mktime($time[0],$time[1],$time[2],0,0,0));
		
		$time = explode(":",$tabelaBasicaVo->getHorasBaseTrabalhadasTabelaBasica());
		$horaTrabalhadaBase = date("His",mktime($time[0],$time[1],$time[2]));
		
		$time = explode(":",$tabelaBasicaVo->getHorasNaoTrabalhadasBaseTabelaBasica());
		$horasNaoTrabalhadasBase = date("His",mktime($time[0],$time[1],$time[2]));
		$horasNaoTrabalhadasBase_TesteDias = $tabelaBasicaVo->getHorasNaoTrabalhadasBaseTabelaBasica();
		
		$time = explode(":",$tabelaBasicaVo->getHorasInicioTrabalhoTabelaBasica());
		$horasInicioTrabalho = date("His",mktime($time[0],$time[1],$time[2]));
		$horasInicioTrabalho_testeHoras = $tabelaBasicaVo->getHorasInicioTrabalhoTabelaBasica();
		
		$time = explode(":",$tabelaBasicaVo->getHorasFimTrabalhoTabelaBasica());
		$horasFimTrabalho = date("His",mktime($time[0],$time[1],$time[2]));
		$horasFimTrabalho_TesteHoras = $tabelaBasicaVo->getHorasFimTrabalhoTabelaBasica();
		
		$time = explode(":",$tabelaBasicaVo->getHorasIntervaloInicioTabelaBasica());
		$horasIntervaloInicio = date("His",mktime($time[0],$time[1],$time[2]));
		$horasIntervaloInicio_testeHoras = $tabelaBasicaVo->getHorasIntervaloInicioTabelaBasica();
		
		$time = explode(":",$tabelaBasicaVo->getHorasIntervaloFimTabelaBasica());
		$horasIntervaloFim = date("His",mktime($time[0],$time[1],$time[2]));
		$horasIntervaloFim_testeHoras = $tabelaBasicaVo->getHorasIntervaloFimTabelaBasica();
		
		$dataTimeAtual = date("Y-m-d H:i:s");
		$horaAtual = date("His");
		
		$time_verifica = str_replace(":","",$horasAtendimentoInicial);
		$time = explode(":",$horasAtendimentoInicial);
		
		// Verificar se o horário de Abertura do Pedido está no horário de expediente, senão, colocar o horário mais próximo.
		if($horaAtual > $horasFimTrabalho || $horaAtual < $horasInicioTrabalho)
		{
			$time_aux = explode(":",$tabelaBasicaVo->getHorasInicioTrabalhoTabelaBasica());
			$dataTimeAtual = date('Y-m-d H:i:s',mktime($time_aux[0],$time_aux[1],$time_aux[2],date('m'),date('d')+1,date('Y')));
			$diaAtual = date("D",mktime($time_aux[0],$time_aux[1],$time_aux[2],date('m'),date('d')+1,date('Y')));
			if($diaAtual == "Sat")
			{
				$dataTimeAtual = date('Y-m-d H:i:s',mktime($time_aux[0],$time_aux[1],$time_aux[2],date('m'),date('d')+3,date('Y')));
			}
			if($diaAtual == "Sun")
			{
				$dataTimeAtual = date('Y-m-d H:i:s',mktime($time_aux[0],$time_aux[1],$time_aux[2],date('m'),date('d')+2,date('Y')));
			}
		}
		elseif ($horaAtual > $horasIntervaloInicio && $horaAtual < $horasIntervaloFim)
		{
			$time_aux = explode(":",$tabelaBasicaVo->getHorasIntervaloFimTabelaBasica());
			$dataTimeAtual = date('Y-m-d H:i:s',mktime($time_aux[0],$time_aux[1],$time_aux[2],date('m'),date('d'),date('Y')));
		}
		//Fim Verificação de Horário de Abertura
		//Verificar a Data de Abertura
		$auxDataHora = explode(" ",$dataTimeAtual);
		$dataAtual= explode("-",$auxDataHora[0]);
		$horaAtual = explode(":",$auxDataHora[1]);
		$diaAtual = date("D",mktime($horaAtual[0],$horaAtual[1],$horaAtual[2],$dataAtual[1],$dataAtual[2],$dataAtual[0]));
		if($diaAtual == "Sat")
		{
			$time_aux = explode(":",$tabelaBasicaVo->getHorasInicioTrabalhoTabelaBasica());
			$dataTimeAtual = date('Y-m-d H:i:s',mktime($time_aux[0],$time_aux[1],$time_aux[2],$dataAtual[1],$dataAtual[2]+2,$dataAtual[0]));
		}
		if($diaAtual == "Sun")
		{
			$time_aux = explode(":",$tabelaBasicaVo->getHorasInicioTrabalhoTabelaBasica());
			$dataTimeAtual = date('Y-m-d H:i:s',mktime($time_aux[0],$time_aux[1],$time_aux[2],$dataAtual[1],$dataAtual[2]+1,$dataAtual[0]));
		}
		//Fim Verificação Data Abertura
		
		$auxDataHora = explode(" ",$dataTimeAtual);
		$dataAtual= explode("-",$auxDataHora[0]);
		$horaAtual = explode(":",$auxDataHora[1]);
		$retornoDataHoraAtendimento = date("Y-m-d H:i:s",mktime($horaAtual[0]+$time[0], $horaAtual[1]+$time[1],$horaAtual[2]+$time[2],$dataAtual[1],$dataAtual[2],$dataAtual[0]));
		
		//Verifica Novamente se ficou como sabado ou se ultrapassou a hora do expediente
		$auxDataHora = explode(" ",$retornoDataHoraAtendimento);
		$dataAtual= explode("-",$auxDataHora[0]);
		$horaAtual = explode(":",$auxDataHora[1]);
		$diaAtual = date("D",mktime($horaAtual[0],$horaAtual[1],$horaAtual[2],$dataAtual[1],$dataAtual[2],$dataAtual[0]));
		if($diaAtual == "Sat")
		{
			$retornoDataHoraAtendimento = date('Y-m-d H:i:s',mktime($horaAtual[0],$horaAtual[1],$horaAtual[2],$dataAtual[1],$dataAtual[2]+2,$dataAtual[0]));
		}
		if($diaAtual == "Sun")
		{
			$retornoDataHoraAtendimento = date('Y-m-d H:i:s',mktime($horaAtual[0],$horaAtual[1],$horaAtual[2],$dataAtual[1],$dataAtual[2]+1,$dataAtual[0]));
		}
		/**
		 * Horário
		 */
		$auxDataHora = explode(" ",$retornoDataHoraAtendimento);
		$dataAtual= explode("-",$auxDataHora[0]);
		$horaAtual = explode(":",$auxDataHora[1]);
		$horaAtual_teste = $horaAtual[0].$horaAtual[1].$horaAtual[2];
		if($horaAtual_teste > $horasFimTrabalho || $horaAtual_teste < $horasInicioTrabalho)
		{
			if($horaAtual_teste > $horasFimTrabalho)
			{
				$horaFim = explode(":",$horasFimTrabalho_TesteHoras);
				$horaNova = date("H:i:s",mktime($horaAtual[0] - $horaFim[0],$horaAtual[1] - $horaFim[1],$horaAtual[2] - $horaFim[2],0,0,0));
				$horaNova = explode(":",$horaNova);
				$retornoDataHoraAtendimento = date('Y-m-d H:i:s',mktime($horaNova[0],$horaNova[1],$horaNova[2],$dataAtual[1],$dataAtual[2],$dataAtual[0]));
			}
			elseif ($horaAtual_teste < $horasInicioTrabalho)
			{
				$time_aux = explode(":",$tabelaBasicaVo->getHorasInicioTrabalhoTabelaBasica());
				$retornoDataHoraAtendimento = date('Y-m-d H:i:s',mktime($time_aux[0],$time_aux[1],$time_aux[2],$dataAtual[1],$dataAtual[2],$dataAtual[0]));
			}
			$auxDataHora = explode(" ",$retornoDataHoraAtendimento);
			$dataAtual= explode("-",$auxDataHora[0]);
			$horaAtual = explode(":",$auxDataHora[1]);
			$diaAtual = date("D",mktime($horaAtual[0],$horaAtual[1],$horaAtual[2],$dataAtual[1],$dataAtual[2],$dataAtual[0]));
			if($diaAtual == "Sat")
			{
				$retornoDataHoraAtendimento = date('Y-m-d H:i:s',mktime($horaAtual[0],$horaAtual[1],$horaAtual[2],$dataAtual[1],$dataAtual[2]+3,$dataAtual[0]));
			}
			if($diaAtual == "Sun")
			{
				$retornoDataHoraAtendimento = date('Y-m-d H:i:s',mktime($horaAtual[0],$horaAtual[1],$horaAtual[2],$dataAtual[1],$dataAtual[2]+2,$dataAtual[0]));
			}
		}
		elseif ($horaAtual_teste > $horasIntervaloInicio && $horaAtual_teste < $horasIntervaloFim)
		{
			$horaIntervado = explode(":",$horasIntervaloInicio_testeHoras);
			$horaIntervaloInicio = explode(":",$horasIntervaloFim_testeHoras);
			$horaNova = date("H:i:s",mktime($horaAtual[0] - $horaIntervado[0],$horaAtual[1] - $horaIntervado[1],$horaAtual[2] - $horaIntervado[2],0,0,0));
			$horaNova = explode(":",$horaNova);
			$retornoDataHoraAtendimento = date('Y-m-d H:i:s',mktime($horaIntervaloInicio[0]+$horaNova[0],$horaIntervaloInicio[1]+$horaNova[1],$horaIntervaloInicio[2]+$horaNova[2],$dataAtual[1],$dataAtual[2],$dataAtual[0]));
		}
		//Fim Verificação Teste de Datas e Horas
		
		//Fim Verificação
		
		return $retornoDataHoraAtendimento;
	}
	
	/**
	 * Método que pesquisa a data e hora de previsão de atendimento, após receber o pedido
	 * @author João Batista Padilha e Silva
	 * @param time $time
	 * @return datetime
	 */
	public function pesquisarDataHoraAtendimento($timeNovo)
	{
		$controlaTabelaBasica = new Controla_TabelaBasica();
		$tabelaBasicaVo = new TabelaBasicaVo();
		$collVoTabelaBasica = $controlaTabelaBasica->pesquisaTabelaBasica($tabelaBasicaVo);
		$tabelaBasicaVo = (object) $collVoTabelaBasica[0];
		
		$time = explode(":",$tabelaBasicaVo->getHorasBaseTrabalhadasTabelaBasica());
		$horaTrabalhadaBase = date("His",mktime($time[0],$time[1],$time[2]));
		
		$time = explode(":",$tabelaBasicaVo->getHorasNaoTrabalhadasBaseTabelaBasica());
		$horasNaoTrabalhadasBase = date("His",mktime($time[0],$time[1],$time[2]));
		$horasNaoTrabalhadasBase_TesteDias = $tabelaBasicaVo->getHorasNaoTrabalhadasBaseTabelaBasica();
		
		$time = explode(":",$tabelaBasicaVo->getHorasInicioTrabalhoTabelaBasica());
		$horasInicioTrabalho = date("His",mktime($time[0],$time[1],$time[2]));
		$horasInicioTrabalho_testeHoras = $tabelaBasicaVo->getHorasInicioTrabalhoTabelaBasica();
		
		$time = explode(":",$tabelaBasicaVo->getHorasFimTrabalhoTabelaBasica());
		$horasFimTrabalho = date("His",mktime($time[0],$time[1],$time[2]));
		$horasFimTrabalho_TesteHoras = $tabelaBasicaVo->getHorasFimTrabalhoTabelaBasica();
		
		$time = explode(":",$tabelaBasicaVo->getHorasIntervaloInicioTabelaBasica());
		$horasIntervaloInicio = date("His",mktime($time[0],$time[1],$time[2]));
		$horasIntervaloInicio_testeHoras = $tabelaBasicaVo->getHorasIntervaloInicioTabelaBasica();
		
		$time = explode(":",$tabelaBasicaVo->getHorasIntervaloFimTabelaBasica());
		$horasIntervaloFim = date("His",mktime($time[0],$time[1],$time[2]));
		$horasIntervaloFim_testeHoras = $tabelaBasicaVo->getHorasIntervaloFimTabelaBasica();
		
		//Fim		
		
		$retornoDataHoraAtendimento = '';
		
		$time_verifica = str_replace(":","",$timeNovo);
		
		$time = explode(":",$timeNovo);
		
		//Verifica a quantidade de dias que irá durar de acordo com o tempo passado.
		$quantidadeDiasPeloTempo = floor($time_verifica/$horaTrabalhadaBase);		
		
		$dataTimeAtual = date("Y-m-d H:i:s");
		$horaAtual = date("His");
		
		// Verificar se o horário de Abertura do Pedido está no horário de expediente, senão, colocar o horário mais próximo.
		if($horaAtual > $horasFimTrabalho || $horaAtual < $horasInicioTrabalho)
		{
			$time_aux = explode(":",$tabelaBasicaVo->getHorasInicioTrabalhoTabelaBasica());
			$dataTimeAtual = date('Y-m-d H:i:s',mktime($time_aux[0],$time_aux[1],$time_aux[2],date('m'),date('d')+1,date('Y')));
			$diaAtual = date("D",mktime($time_aux[0],$time_aux[1],$time_aux[2],date('m'),date('d')+1,date('Y')));
			if($diaAtual == "Sat")
			{
				$dataTimeAtual = date('Y-m-d H:i:s',mktime($time_aux[0],$time_aux[1],$time_aux[2],date('m'),date('d')+3,date('Y')));
			}
			if($diaAtual == "Sun")
			{
				$dataTimeAtual = date('Y-m-d H:i:s',mktime($time_aux[0],$time_aux[1],$time_aux[2],date('m'),date('d')+2,date('Y')));
			}
		}
		elseif ($horaAtual > $horasIntervaloInicio && $horaAtual < $horasIntervaloFim)
		{
			$time_aux = explode(":",$tabelaBasicaVo->getHorasFimTrabalhoTabelaBasica());
			$dataTimeAtual = date('Y-m-d H:i:s',mktime($time_aux[0],$time_aux[1],$time_aux[2],date('m'),date('d'),date('Y')));
		}
		//Fim Verificação de Horário de Abertura
		//Verificar a Data de Abertura
		$auxDataHora = explode(" ",$dataTimeAtual);
		$dataAtual= explode("-",$auxDataHora[0]);
		$horaAtual = explode(":",$auxDataHora[1]);
		$diaAtual = date("D",mktime($horaAtual[0],$horaAtual[1],$horaAtual[2],$dataAtual[1],$dataAtual[2],$dataAtual[0]));
		$time_aux = explode(":",$tabelaBasicaVo->getHorasInicioTrabalhoTabelaBasica());
		if($diaAtual == "Sat")
		{
			$dataTimeAtual = date('Y-m-d H:i:s',mktime($time_aux[0],$time_aux[1],$time_aux[2],$dataAtual[1],$dataAtual[2]+2,$dataAtual[0]));
		}
		if($diaAtual == "Sun")
		{
			$dataTimeAtual = date('Y-m-d H:i:s',mktime($time_aux[0],$time_aux[1],$time_aux[2],$dataAtual[1],$dataAtual[2]+1,$dataAtual[0]));
		}
		//Fim Verificação Data Abertura
		
		
		
		// Inserir a hora passada por parâmetro
		$auxDataHora = explode(" ",$dataTimeAtual);
		$dataAtual= explode("-",$auxDataHora[0]);
		$horaAtual = explode(":",$auxDataHora[1]);
		$retornoDataHoraAtendimento = date("Y-m-d H:i:s",mktime($horaAtual[0]+$time[0], $horaAtual[1]+$time[1],$horaAtual[2]+$time[2],$dataAtual[1],$dataAtual[2],$dataAtual[0]));
		
		
		for($i = 1; $i <= $quantidadeDiasPeloTempo; $i++)
		{
			//Adiciona o Horário de Fora de hora de expediente
			$auxDataHora = explode(" ",$retornoDataHoraAtendimento);
			$dataAtual= explode("-",$auxDataHora[0]);
			$horaAtual = explode(":",$auxDataHora[1]);
			//Horario nao trabalhado
			$horasNaoTrabalhadasBase_aux = explode(":",$horasNaoTrabalhadasBase_TesteDias);
			
			$retornoDataHoraAtendimento = date("Y-m-d H:i:s",mktime($horaAtual[0]+$horasNaoTrabalhadasBase_aux[0], $horaAtual[1]+$horasNaoTrabalhadasBase_aux[1],$horaAtual[2]+$horasNaoTrabalhadasBase_aux[2],$dataAtual[1],$dataAtual[2],$dataAtual[0]));
			
		}
		
		//Verifica Novamente se ficou como sabado ou se ultrapassou a hora do expediente
		$auxDataHora = explode(" ",$retornoDataHoraAtendimento);
		$dataAtual= explode("-",$auxDataHora[0]);
		$horaAtual = explode(":",$auxDataHora[1]);
		$diaAtual = date("D",mktime($horaAtual[0],$horaAtual[1],$horaAtual[2],$dataAtual[1],$dataAtual[2],$dataAtual[0]));
		if($diaAtual == "Sat")
		{
			$retornoDataHoraAtendimento = date('Y-m-d H:i:s',mktime($horaAtual[0],$horaAtual[1],$horaAtual[2],$dataAtual[1],$dataAtual[2]+2,$dataAtual[0]));
		}
		if($diaAtual == "Sun")
		{
			$retornoDataHoraAtendimento = date('Y-m-d H:i:s',mktime($horaAtual[0],$horaAtual[1],$horaAtual[2],$dataAtual[1],$dataAtual[2]+1,$dataAtual[0]));
		}
		/**
		 * Horário
		 */
		$auxDataHora = explode(" ",$retornoDataHoraAtendimento);
		$dataAtual= explode("-",$auxDataHora[0]);
		$horaAtual = explode(":",$auxDataHora[1]);
		$horaAtual_teste = $horaAtual[0].$horaAtual[1].$horaAtual[2];
		if($horaAtual_teste > $horasFimTrabalho || $horaAtual_teste < $horasInicioTrabalho)
		{
			if($horaAtual_teste > $horasFimTrabalho)
			{
				$time_aux = explode(":",$tabelaBasicaVo->getHorasInicioTrabalhoTabelaBasica());
				$horaFim = explode(":",$horasFimTrabalho_TesteHoras);
				$horaNova = date("H:i:s",mktime($horaAtual[0] - $horaFim[0],$horaAtual[1] - $horaFim[1],$horaAtual[2] - $horaFim[2],0,0,0));
				$horaNova = explode(":",$horaNova);
				$retornoDataHoraAtendimento = date('Y-m-d H:i:s',mktime($time_aux[0]+$horaNova[0],$time_aux[1]+$horaNova[1],$time_aux[2]+$horaNova[2],$dataAtual[1],$dataAtual[2]+1,$dataAtual[0]));
			}
			elseif ($horaAtual_teste < $horasInicioTrabalho)
			{
				$time_aux = explode(":",$tabelaBasicaVo->getHorasInicioTrabalhoTabelaBasica());
				$retornoDataHoraAtendimento = date('Y-m-d H:i:s',mktime($time_aux[0],$time_aux[1],$time_aux[2],$dataAtual[1],$dataAtual[2],$dataAtual[0]));
			}
			$auxDataHora = explode(" ",$retornoDataHoraAtendimento);
			$dataAtual= explode("-",$auxDataHora[0]);
			$horaAtual = explode(":",$auxDataHora[1]);
			$diaAtual = date("D",mktime($horaAtual[0],$horaAtual[1],$horaAtual[2],$dataAtual[1],$dataAtual[2],$dataAtual[0]));
			if($diaAtual == "Sat")
			{
				$retornoDataHoraAtendimento = date('Y-m-d H:i:s',mktime($horaAtual[0],$horaAtual[1],$horaAtual[2],$dataAtual[1],$dataAtual[2]+3,$dataAtual[0]));
			}
			if($diaAtual == "Sun")
			{
				$retornoDataHoraAtendimento = date('Y-m-d H:i:s',mktime($horaAtual[0],$horaAtual[1],$horaAtual[2],$dataAtual[1],$dataAtual[2]+2,$dataAtual[0]));
			}
		}
		elseif ($horaAtual_teste > $horasIntervaloInicio && $horaAtual_teste < $horasIntervaloFim)
		{
			$horaIntervado = explode(":",$horasIntervaloInicio_testeHoras);
			$horaIntervaloInicio = explode(":",$horasIntervaloFim_testeHoras);
			$horaNova = date("H:i:s",mktime($horaAtual[0] - $horaIntervado[0],$horaAtual[1] - $horaIntervado[1],$horaAtual[2] - $horaIntervado[2],0,0,0));
			$horaNova = explode(":",$horaNova);
			$retornoDataHoraAtendimento = date('Y-m-d H:i:s',mktime($horaIntervaloInicio[0]+$horaNova[0],$horaIntervaloInicio[1]+$horaNova[1],$horaIntervaloInicio[2]+$horaNova[2],$dataAtual[1],$dataAtual[2],$dataAtual[0]));
		}
		//Fim Verificação Teste de Datas e Horas
		
		//Fim Verificação		
		
		return 	$retornoDataHoraAtendimento;
	}
	
	/**
	 * Método que mostra os Pedidos por status passado
	 * @author João Batista Padilha e Silva
	 * @param PedidosVo $pedidosVo
	 * @param var $dominioRecebe variável no formato ex.(1;2;3;4)
	 */
	public function mostraPedidosStatus(PedidosVo $pedidosVo,$dominioRecebe, $cssTabelas = '')
	{
		$this->collVo = self::pesquisarPedidos($pedidosVo,$dominioRecebe);
		$pedidosVo->setParametroConsulta("");
		$formataData = new FormataData();
		$dominio = new Dominio();
		$retorno = '';
		$mostra = '	<table width="95%" border="0" cellpadding="1" cellspacing="0" class="tabelaListagem'.$cssTabelas.'" align="center">
					<tr>
						<td class="tituloListagem'.$cssTabelas.'">Nº do Pedido</td>
						<td class="tituloListagem'.$cssTabelas.'">Data de Abertura</td>
						<td class="tituloListagem'.$cssTabelas.'">Projeto/Sistema</td>
						<td class="tituloListagem'.$cssTabelas.'">Situação</td>
						<td class="tituloListagem'.$cssTabelas.'" colspan="2">Severidade</td>
					</tr>';
		
		if(!is_null($this->collVo))
		{
			
			for($i = 0; $i < count($this->collVo); $i++)
			{
				$pedidosVo = (object) $this->collVo[$i];
				
				// Busca o Nome do Projeto
				$controlaProjetos = new Controla_Projetos();
				$projetosVo = new ProjetosVo();
				$projetosVo->setIdProjetos($pedidosVo->getIdProjetos());
				$collVo_Projetos = $controlaProjetos->pesquisarProjetos($projetosVo);
				$projetosVo = (object) $collVo_Projetos[0];
				
				// Busca Histórico do Pedido
				$controlaHistorico = new Controla_Historico();
				$historicoVo = new Historico_PedidosVo();
				$historicoVo->setIdPedidos($pedidosVo->getIdPedidos());
				$collVo_Historico = $controlaHistorico->pesquisarHistorico($historicoVo);
				$historicoVo = (object) $collVo_Historico[0];
				
				if($historicoVo->getIdUsuariosDestinatario() == $_SESSION['id_Usuario'] || ($pedidosVo->getDomnStatusPedidos() == $dominio->DomnStatusPedido_Fechado && $historicoVo->getIdUsuarioOrigem() == $_SESSION['id_Usuario']) || ($pedidosVo->getDomnStatusPedidos() == $dominio->DomnStatusPedido_Devolvido && $historicoVo->getIdUsuarioOrigem() == $_SESSION['id_Usuario']))
				{
					$classCss = ($i%2==0) ? "linhaListagem".$cssTabelas : "linha2Listagem".$cssTabelas;
					$retorno .= '
								<tr class="'.$classCss.'">
									<td>'.$pedidosVo->getIdPedidos().'</td>
									<td>'.$formataData->toViewDateTime($historicoVo->getDataHoraHistorico_Pedidos()).'</td>
									<td>'.$projetosVo->getNomeProjetos().'</td>
									<td>'.$dominio->mostraDomnStatusPedido($pedidosVo->getDomnStatusPedidos()).'</td>
									<td>'.$dominio->mostraDomnSeveridade($pedidosVo->getDomnSeveridadePedidos()).'</td>
									<td style="width:2%;">
										<a href="javascript:void(0);" onClick="carregaPagina(\'viewPedidos.php?visualiza=true&idPedidos='.$pedidosVo->getIdPedidos().'\',\'formulario\');" title="Visualizar Pedido">
											<img src="imagens/ico_localizar.gif" alt="Visualizar Pedido" style="border:0;" />
										</a>
									</td>
								</tr>';
				}
			}
			if($retorno == '')
			{
				$retorno = '
							<tr class="linhaListagem'.$cssTabelas.'">
								<td colspan="6">Não existem pedidos cadastrados.</td>
							</tr>
							';
			}
			$mostra .= $retorno;
		}
		else 
		{
			$mostra .= '
						<tr class="linhaListagem'.$cssTabelas.'">
							<td colspan="6">Não existem pedidos cadastrados.</td>
						</tr>
						';
		}
		$mostra .= '</table>';
		echo $mostra;
	}
	
	/**
	 * Método que mostra todos os Pedidos de acordo com o Projeto que o Usuário está locado
	 * @author João Batista Padilha e Silva
	 * @param PedidosVo $pedidosVo
	 * @param int $dominioRecebe
	 * @return var
	 */
	public function mostraPedidosProjetos(PedidosVo $pedidosVo,$dominioRecebe,$cssTabelas = '')
	{
		$businessEntity = new BusinessEntity();
		$formataData = new FormataData();
		$dominio = new Dominio();
		$papeisProjetosVo = new Papeis_ProjetosVo();
		$controlaProjetos = new Controla_Projetos();
		$this->collVo_Projetos = null;
		$collVoProjetos = null;
		$idsProjetos = '';
		//Pesquisar Projetos que o usuário está locado.
		self::pesquisarUsuariosPermissao();
		
		//Pegar os Ids de todos os Projetos que eu estou presente
		if(!is_null($this->collVo_PapeisProjetosPermissao))
		{
			foreach ($this->collVo_PapeisProjetosPermissao as $papeisProjetos)
			{
				$papeisProjetosVo = (object)$papeisProjetos;
				if($idsProjetos == '')
				{
					$idsProjetos[]= $papeisProjetosVo->getIdProjetos();
				}
				else 
				{
					$existe = 0;
					foreach ($idsProjetos as $ids)
					{
						if($ids == $papeisProjetosVo->getIdProjetos())
						{
							$existe = 1;
						}
					}
					if($existe == 0)
					{
						$idsProjetos[] = $papeisProjetosVo->getIdProjetos();
					}
				}
			}
		}
		
		if($idsProjetos != '')
		{
			foreach ($idsProjetos as $id)
			{
				$projetosVo = new ProjetosVo();
				$projetosVo->setIdProjetos($id);
				$collVoProjetos = $controlaProjetos->pesquisarProjetos($projetosVo);
				$projetosVo = (object)$collVoProjetos[0];
				$this->collVo_Projetos = $businessEntity->popularCollVo($projetosVo,$this->collVo_Projetos);
			}
		}
		//self::pesquisarProjetos();
		
		//Percorrer todos os projetos que o usuário está locado.
		$retorno = '';
		if(!is_null($this->collVo_Projetos))
		{
			foreach ($this->collVo_Projetos as $projeto)
			{
				$dominioRecebeStatus = explode(";",$dominioRecebe);
				foreach ($dominioRecebeStatus as $status)
				{
					$projetosVo = new ProjetosVo();
					$projetosVo = (object) $projeto;
					$pedidosVo = new PedidosVo();
					$pedidosVo->setIdProjetos($projetosVo->getIdProjetos());
					$this->collVo = self::pesquisarPedidos($pedidosVo,$status);
					$pedidosVo->setParametroConsulta("");			
				
					if(!is_null($this->collVo))
					{
						
						for($i = 0; $i < count($this->collVo); $i++)
						{
							$pedidosVo = (object) $this->collVo[$i];
							
							// Busca Histórico do Pedido
							$controlaHistorico = new Controla_Historico();
							$historicoVo = new Historico_PedidosVo();
							$historicoVo->setIdPedidos($pedidosVo->getIdPedidos());
							$collVo_Historico = $controlaHistorico->pesquisarHistorico($historicoVo);
							$historicoVo = (object) $collVo_Historico[0];
							$mostrando = 0;
							
							if($historicoVo->getIdUsuariosDestinatario() != $_SESSION['id_Usuario'])
							{
								$mostrando = 1;
								if($pedidosVo->getDomnStatusPedidos() == $dominio->DomnStatusPedido_Devolvido || $pedidosVo->getDomnStatusPedidos() == $dominio->DomnStatusPedido_Fechado || $pedidosVo->getDomnStatusPedidos() == $dominio->DomnStatusPedido_Concluido)
								{
									if($historicoVo->getIdUsuarioOrigem() == $_SESSION['id_Usuario'])
									{
										$mostrando = 0;
									}
								}					
							}
							if($mostrando == 1)
							{
								$classCss = ($i%2==0) ? "linhaListagem".$cssTabelas : "linha2Listagem".$cssTabelas;
								$retorno .= '
											<tr class="'.$classCss.'">
												<td>'.$pedidosVo->getIdPedidos().'</td>
												<td>'.$formataData->toViewDateTime($historicoVo->getDataHoraHistorico_Pedidos()).'</td>
												<td>'.$projetosVo->getNomeProjetos().'</td>
												<td>'.$dominio->mostraDomnStatusPedido($pedidosVo->getDomnStatusPedidos()).'</td>
												<td>'.$dominio->mostraDomnSeveridade($pedidosVo->getDomnSeveridadePedidos()).'</td>
												<td style="width:2%;">
													<a href="javascript:void(0);" onClick="carregaPagina(\'viewPedidos.php?visualiza=true&idPedidos='.$pedidosVo->getIdPedidos().'\',\'formulario\');" title="Visualizar Pedido">
														<img src="imagens/ico_localizar.gif" alt="Visualizar Pedido" style="border:0;" />
													</a>
												</td>
											</tr>';
							}
						}
					}
				}
			}
		}
		if($retorno == '')
		{
			$retorno = '<tr class="linhaListagem'.$cssTabelas.'">
							<td colspan="2">Não existem pedidos cadastrados no projeto em que você está locado.</td>
						</tr>
						';
		}
		return $retorno;
	}
	
	/**
	 * Método que mostra todos os pedidos da Pesquisa
	 * @author João Batista Padilha e Silva
	 * @param PedidosVo $pedidosVo
	 * @return var
	 */
	public function mostraPequisaPedidos(PedidosVo $pedidosVo)
	{
		$businessEntity = new BusinessEntity();
		$formataData = new FormataData();
		$dominio = new Dominio();
		$controlaHistorico = new Controla_Historico();
		$controlaProjetos = new Controla_Projetos();
		$controlaPermissoes = new Controla_Permissao();
		$retorno = '';
		$collVo_Pedidos = null;
		
		if($_POST['selectClientes'] != '' && $_POST['selectProjetos'] == '' && $_POST['numeroPedido'] == '')
		{
			$projetosVo = new ProjetosVo();
			$projetosVo->setIdClientes(rawurldecode(strip_tags($_POST['selectClientes'])));
			$collVo_Projetos = $controlaProjetos->pesquisarProjetos($projetosVo);
			
			if(!is_null($collVo_Projetos))
			{
				foreach ($collVo_Projetos as $projeto)
				{
					$collVo_Aux = null;
					$projetosVo = (object) $projeto;
					$pedidosVo->setIdProjetos($projetosVo->getIdProjetos());
					if(is_null($this->collVo))
					{
						$collVo_Pedidos = self::pesquisarPedidosPorProjeto($pedidosVo);
					}
					else 
					{
						$collVo_Aux = self::pesquisarPedidosPorProjeto($pedidosVo);
						if(!is_null($collVo_Aux))
						{
							foreach ($collVo_Aux as $pedidoAux)
							{
								$pedidoVo_aux = new PedidosVo();
								$pedidoVo_aux = (object) $pedidoAux;
								$collVo_Pedidos[]  = (object) $pedidoVo_aux;
							}
						}
					}
				}
			}
		}
		elseif($_POST['selectClientes'] != '' && $_POST['selectProjetos'] != '' && $_POST['numeroPedido'] == '')
		{
			$collVo_Pedidos = self::pesquisarPedidosPorProjeto($pedidosVo);
		}
		else 
		{
			$collVo_Pedidos = self::pesquisarPedidos($pedidosVo);
		}
		
		$mostra = '	<table width="95%" border="0" cellpadding="1" cellspacing="0" class="tabelaListagem" align="center">
					<tr>
						<td class="tituloListagem">Nº do Pedido</td>
						<td class="tituloListagem">Data de Abertura</td>
						<td class="tituloListagem">Projeto/Sistema</td>
						<td class="tituloListagem">Situação</td>
						<td class="tituloListagem" colspan="2">Severidade</td>
					</tr>';
		
		if(!is_null($collVo_Pedidos))
		{
			$i = 0;
			foreach ($collVo_Pedidos as $pedidos)
			{
				$autorizaMostragem = false;
				$pedidosVo = (object) $pedidos;
						
				// Busca Histórico do Pedido
				$historicoVo = new Historico_PedidosVo();
				$historicoVo->setIdPedidos($pedidosVo->getIdPedidos());
				$collVo_Historico = $controlaHistorico->pesquisarHistorico($historicoVo);
				$historicoVo = (object) $collVo_Historico[0];
				
				//Busca o Nome do Projeto
				$projetosVo = new ProjetosVo();
				$projetosVo->setIdProjetos($pedidosVo->getIdProjetos());
				$collVo_Projetos = $controlaProjetos->pesquisarProjetos($projetosVo);
				$projetosVo = (object) $collVo_Projetos[0];
				
				//Busca permissao de Papeis Projeto
				$papeisProjetosVo = new Papeis_ProjetosVo();
				$papeisProjetosVo->setIdProjetos($projetosVo->getIdProjetos());
				$papeisProjetosVo->setIdUsuarios($_SESSION['id_Usuario']);
				$collVo_Papeis = $controlaProjetos->pesquisarUsuariosPapeisProjetos($papeisProjetosVo);
				
				if(!is_null($collVo_Papeis))
				{
					foreach ($collVo_Papeis as $papeisProjetos)
					{
						//Pesquisa por papel Ocupado
						$papeisProjetosVo = (object) $papeisProjetos;
						$permissaoVo = new Permissao_Usuarios_Funcionalidades_PapeisVo();
						$permissaoVo->setIdPapeis($papeisProjetosVo->getIdPapeis());
						$collVo_Permissao = $controlaPermissoes->buscaPermissoesSemMensagem($permissaoVo);
						if(!is_null($collVo_Permissao))
						{
							foreach ($collVo_Permissao as $permissao)
							{
								$permissaoVo = (object)$permissao;
								if($permissaoVo->getIdFuncionalidades() == $dominio->DomnFuncionalidade_Pedidos_Pesquisar_Todos_Pedidos)
								{
									$autorizaMostragem = true;
								}
							}
						}
					}
				}
				
				//Pesquisa Permissão por Usuário
				$permissaoVo = new Permissao_Usuarios_Funcionalidades_PapeisVo();
				$permissaoVo->setIdUsuarios($_SESSION['id_Usuario']);
				$collVo_Permissao = $controlaPermissoes->buscaPermissoesSemMensagem($permissaoVo);
				if(!is_null($collVo_Permissao))
				{
					foreach ($collVo_Permissao as $permissao)
					{
						$permissaoVo = (object)$permissao;
						if($permissaoVo->getIdFuncionalidades() == $dominio->DomnFuncionalidade_Pedidos_Pesquisar_Todos_Pedidos)
						{
							$autorizaMostragem = true;
						}
					}
				}
				
				if($historicoVo->getIdUsuarioOrigem() == $_SESSION['id_Usuario'] || $historicoVo->getIdUsuariosDestinatario() == $_SESSION['id_Usuario'])
				{
					$autorizaMostragem = true;
				}
				
				if($autorizaMostragem)
				{
					$classCss = ($i%2==0) ? "linhaListagem" : "linha2Listagem";
					$retorno .= '
								<tr class="'.$classCss.'">
									<td>'.$pedidosVo->getIdPedidos().'</td>
									<td>'.$formataData->toViewDateTime($historicoVo->getDataHoraHistorico_Pedidos()).'</td>
									<td>'.$projetosVo->getNomeProjetos().'</td>
									<td>'.$dominio->mostraDomnStatusPedido($pedidosVo->getDomnStatusPedidos()).'</td>
									<td>'.$dominio->mostraDomnSeveridade($pedidosVo->getDomnSeveridadePedidos()).'</td>
									<td style="width:2%;">
										<a href="javascript:void(0);" onClick="carregaPagina(\'viewPedidos.php?visualiza=true&idPedidos='.$pedidosVo->getIdPedidos().'\',\'formulario\');" title="Visualizar Pedido">
											<img src="imagens/ico_localizar.gif" alt="Visualizar Pedido" style="border:0;" />
										</a>
									</td>
								</tr>';
					$i++;
				}
			}
		}
		if($retorno == '')
		{
			$retorno = '
							<tr class="linhaListagem">
								<td colspan="2">Pedidos não encontrados.</td>
							</tr>
							';
		}
		$mostra .= $retorno;
		return $mostra;
	}
	
	/**
	 * Método de Cadastramento de Pedidos do Sistema
	 * @author João Batista Padilha e Silva
	 * @param PedidosVo $pedidosVo
	 */
	public function cadastrarPedidos(PedidosVo $pedidosVo)
	{
		//Instância os Vos e Controladores Necessários
		$businessEntity = new BusinessEntity();
		$historicoVo = new Historico_PedidosVo();
		$controlaHistorico = new Controla_Historico();
		$controlaFluxos = new Controla_Fluxos();
		$controlaProjetos = new Controla_Projetos();
		$fluxosVo = new FluxosVo();
		$projetosVo = new ProjetosVo();
		$dominio = new Dominio();
		$idsPapeisOcupados = null;
		$retornoFluxo = 0;
		
		try 
		{
			//Pesquisa Dados do Projeto
			$projetosVo->setIdProjetos($pedidosVo->getIdProjetos());
			$this->collVo = $controlaProjetos->pesquisarProjetos($projetosVo);
			$projetosVo = (object) $this->collVo[0];
			
			
			// Popula o Vo de Histórico
			
			$historicoVo->setIdUsuarioOrigem($pedidosVo->getIdUsuarios());
			if(isset($_POST['selectPapeis']))
			{
				$historicoVo->setIdPapeisDestinatario(rawurldecode(strip_tags($_POST['selectPapeis'])));
			}
			if(isset($_POST['selectUsuarios']))
			{
				$historicoVo->setIdUsuariosDestinatario(rawurldecode(strip_tags($_POST['selectUsuarios'])));
			}
			$historicoVo->setDataHoraHistorico_Pedidos(date('Y-m-d H:m:s'));
			$historicoVo->setIdUsuarioHistorico_Pedidos($_SESSION['id_Usuario']);
			if(isset($_POST['descricaoPedido']))
			{
				$historicoVo->setComplementoHistorico_Pedidos(rawurldecode(strip_tags($_POST['descricaoPedido'])));
			}
			$historicoVo->setIdVersoes($pedidosVo->getIdVersoes());
			
			if($pedidosVo->getAssuntoPedido() == '')
			{
				throw new Exception("O Assunto do pedido deve ser preenchido.");
			}
			if($pedidosVo->getDomnSeveridadePedidos() == '')
			{
				throw new Exception("A Severidade do Pedido deve ser selecionada.");
			}
			if($historicoVo->getComplementoHistorico_Pedidos() == '')
			{
				throw new Exception("A descrição do Pedido deve ser preenchida.");
			}
			
			//Verifica as Permissões do Fluxo
			$this->collVo = null;
			$fluxosVo->setIdGrupoFluxos($projetosVo->getIdGrupoFluxos());
			$this->collVo = $controlaFluxos->pesquisarFluxos($fluxosVo);
			
			// Pegar os Papeis Ocupados pelo Usuário e Verificar o Fluxo se está de acordo. Se sim Preencher o Vo de Histórico
			// com o id do Papel Origem e do Fluxo correspondente
			if($_POST['idsPapeisOcupado'] != '')
			{
				$idsPapeisOcupados = explode(";",rawurldecode(strip_tags($_POST['idsPapeisOcupado'])));
				
				foreach ($idsPapeisOcupados as $idsPapeis)
				{
					if(!is_null($this->collVo))
					{
						foreach ($this->collVo as $fluxos)
						{
							$fluxosVo = (object) $fluxos;
							if($fluxosVo->getIdPapeisOrigem() == $idsPapeis && $retornoFluxo != 1)
							{
								$historicoVo->setIdPapeisOrigem($fluxosVo->getIdPapeisOrigem());
								if($historicoVo->getIdPapeisDestinatario() == '')
								{
									$historicoVo->setIdPapeisDestinatario($fluxosVo->getIdPapeisDestinatario());
									$historicoVo->setIdFluxos($fluxosVo->getIdFluxos());
									$retornoFluxo = 1;
								}
								elseif ($historicoVo->getIdPapeisDestinatario() == $fluxosVo->getIdPapeisDestinatario())
								{
									$historicoVo->setIdFluxos($fluxosVo->getIdFluxos());
									$retornoFluxo = 1;
								}
							}
						}
					}
				}
			}
			
			if($retornoFluxo == 0)
			{
				throw new Exception("Usuário não autorizado a enviar pedidos.");
			}
			
			
			
			$this->collVo = null;
			//Atribui o Status do Pedido
			$pedidosVo->setDomnStatusPedidos($dominio->DomnStatusPedido_Novo);
			
			//Verifica a data de previsão do Pedido.
			$dataPrevisao = '';
			if($pedidosVo->getDataHoraPrevisaoPedidos() != '')
			{
				$dataPrevisao = self::pesquisarDataHoraAtendimento($pedidosVo->getDataHoraPrevisaoPedidos());
			}
			else 
			{
				$dataPrevisao = self::pesquisarDataHoraAtendimentoInicial();
			}
			
			//Grava a data prevista para atendimento Inicial
			$pedidosVo->setDataHoraPrevisaoPedidos($dataPrevisao);
			
			//Pesquisar o id do Usuário destinatário caso não tenha sido escolhido
			if($historicoVo->getIdUsuariosDestinatario() == '')
			{
				$papeisProjetosVo = new Papeis_ProjetosVo();
				$papeisProjetosVo->setIdPapeis($historicoVo->getIdPapeisDestinatario());
				$papeisProjetosVo->setIdProjetos($pedidosVo->getIdProjetos());
				$collVoPapeis_Aux = $controlaProjetos->pesquisarUsuariosPapeisProjetos($papeisProjetosVo);
				
				if(is_null($collVoPapeis_Aux))
				{
					throw new Exception("Usuário Destinatário para este Papel não encontrado.");
				}
			}
			
			/**
			 * Criação de SubPedidos mudar o Pedido Pai para em Desenvolvimento
			 */
			if($pedidosVo->getPrecedentePedidos() != '')
			{
				$pedidosVo_precedente = new PedidosVo();
				$pedidosVo_precedente->setIdPedidos($pedidosVo->getPrecedentePedidos());
				$collVo_Precedente = self::pesquisarPedidos($pedidosVo_precedente);
				$pedidosVo_precedente = (object) $collVo_Precedente[0];
				//Muda o Status do pedido
				$pedidosVo_precedente->setDomnStatusPedidos($dominio->DomnStatusPedido_Desenvolvimento);
				$businessEntity->cadastrarPedidos($pedidosVo_precedente);
				
				//Grava o Historico como em Desenvolvimento.
				$historicoVo_Precedente = new Historico_PedidosVo();
				$historicoVo_Precedente->setIdPedidos($pedidosVo_precedente->getIdPedidos());
				$collVo_Historico_Precedente = $controlaHistorico->pesquisarHistorico($historicoVo_Precedente);
				$ultimoIdHistorico_Precedente = count($collVo_Historico_Precedente) - 1;
				$historicoVo_Precedente = (object) $collVo_Historico_Precedente[$ultimoIdHistorico_Precedente];
				$historicoVo_Precedente->setDataHoraAtendimentoHistorico_Pedidos('');
				$historicoVo_Precedente->setIdAnexos('');
				$historicoVo_Precedente->setDataHoraHistorico_Pedidos(date("Y-m-d H:i:s"));
				$historicoVo_Precedente->setComplementoHistorico_Pedidos('');
				$historicoVo_Precedente->setDomnStatusPedidoHistorico_Pedidos($dominio->DomnStatusPedido_Desenvolvimento);
				
				$controlaHistorico->cadastrarHistorico($historicoVo_Precedente);
			}
			
			/**
			 * Inserção do Pedido no Banco
			 */
			$ultimoId = $businessEntity->cadastrarPedidos($pedidosVo);
			
			// Verificar a ultima identificação inserida.
			$pedidosVo->setIdPedidos($ultimoId);
			
			$historicoVo->setIdPedidos($pedidosVo->getIdPedidos());
			$historicoVo->setDomnStatusPedidoHistorico_Pedidos($pedidosVo->getDomnStatusPedidos());
			
			$controlaHistorico = new Controla_Historico();
			$ultimoIdHistorico = '';
			//Enviando para todos papeis o Histórico e a mensagem no e-mail.
			if($historicoVo->getIdUsuariosDestinatario() == '')
			{
				foreach ($collVoPapeis_Aux as $usuariosPapeis)
				{
					$papeisProjetosVo = (object) $usuariosPapeis;
					$historicoVo->setIdUsuariosDestinatario($papeisProjetosVo->getIdUsuarios());
					$ultimoIdHistorico[] = $controlaHistorico->cadastrarHistorico($historicoVo);
					$businessEntity->enviaPedidoUsuario($pedidosVo,$historicoVo);
				}
			}
			else 
			{
				$controlaHistorico->cadastrarHistorico($historicoVo);
				$businessEntity->enviaPedidoUsuario($pedidosVo,$historicoVo);
			}
			
			//Gravar o Id Do histórico na Sessão para inserir o Anexo, caso exista
			$_SESSION['id_Historico_Pedido'] = $ultimoIdHistorico;
			
			echo 'Sucesso';
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
		}
	}
	
	/**
	 * Método de Cadastramento do Anexo
	 * @author João Batista Padilha e Silva
	 */
	public function cadastrarAnexoPedido()
	{
		$controlaAnexos = new Controla_Anexos();
		$controlaHistorico = new Controla_Historico();
		$historicoVo = new Historico_PedidosVo();
		
		//Pesquisar o Nº do pedido
		$array = null;
		
		$array = $_SESSION['id_Historico_Pedido'];
		
		if(!is_null($array))
		{
			foreach ($array as $idHistorico)
			{
				$historicoVo->setIdHistorico_Pedidos($idHistorico);
				$collVo_Historico = $controlaHistorico->pesquisarHistorico($historicoVo);
				$historicoVo = (object) $collVo_Historico[0];
				
				$anexoVo = new AnexosVo();
				$anexoVo->setNomeAnexos("Anexo Pedido Nº".$historicoVo->getIdPedidos()." - Historico Nº ".$historicoVo->getIdHistorico_Pedidos());
				$anexoVo->setDataInclusaoAnexos(date("Y-m-d"));
				try 
				{
					$idAnexo = $controlaAnexos->cadastrarAnexosPedidos($anexoVo);
					self::cadastraAnexoHistoricoPedido($historicoVo,$idAnexo);
					echo "{";
					echo "error: '',\n";
					echo "msg: ''\n";
					echo "}";
				}
				catch (Exception $e)
				{
					echo "{";
					echo "error: '{$e->getMessage()}',\n";
					echo "msg: ''\n";
					echo "}";
				}
			}
		}
		
	}
	
	/**
	 * Método de Cadastro de Anexo ao Historico do pedido
	 * @author João Batista Padilha e Silva
	 * @param Historico_PedidosVo $historicoVo
	 * @param int $idAnexo
	 */
	public function cadastraAnexoHistoricoPedido(Historico_PedidosVo $historicoVo,$idAnexo)
	{
		try 
		{
			$controlaHistorico = new Controla_Historico();
			$historicoVo->setIdAnexos($idAnexo);
			$controlaHistorico->cadastrarHistorico($historicoVo);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
		
	}
	
	/**
	 * Método de alteração do Status do Pedido
	 * @author João Batista Padilha e Silva
	 * @param PedidosVo $pedidosVo
	 * @param int $idStatusAtual
	 */
	public function alteraStatusdoPedidoEnviaEmail(PedidosVo $pedidosVo, $idStatusNovo)
	{
		$dominio = new Dominio();
		$collVoPedidos = self::pesquisarPedidos($pedidosVo);
		$previsaoNova = $pedidosVo->getDataHoraPrevisaoPedidos();
		$pedidosVo = (object) $collVoPedidos[0];
		if($previsaoNova != '')
		{
			$pedidosVo->setDataHoraPrevisaoPedidos($previsaoNova);
		}
		$businessEntity = new BusinessEntity();
		$controlaHistorico = new Controla_Historico();
		$historicoVo = new Historico_PedidosVo();
		try 
		{
			switch ($idStatusNovo)
			{
				case $dominio->DomnStatusPedido_Recebido:
					$pedidosVo->setDomnStatusPedidos($dominio->DomnStatusPedido_Recebido);
					break;
				case $dominio->DomnStatusPedido_Novo:
					$pedidosVo->setDomnStatusPedidos($dominio->DomnStatusPedido_Novo);
					if(isset($_POST['MudancaStatus']))
					{
						if($_POST['descricaoPedido'] == '')
						{
							throw new Exception("Você deve preencher o Motivo para o pedido ser Re-enviado.");
						}
					}
					break;
				case $dominio->DomnStatusPedido_Desenvolvimento:
					$pedidosVo->setDomnStatusPedidos($dominio->DomnStatusPedido_Desenvolvimento);
					break;
				case $dominio->DomnStatusPedido_Devolvido:
					$pedidosVo->setDomnStatusPedidos($dominio->DomnStatusPedido_Devolvido);
					if(isset($_POST['MudancaStatus']))
					{
						if($_POST['descricaoPedido'] == '')
						{
							throw new Exception("Você deve preencher o Motivo para o pedido ser ".$dominio->mostraDomnStatusPedido($pedidosVo->getDomnStatusPedidos()));
						}
					}
					break;
				case $dominio->DomnStatusPedido_Concluido:
					$pedidosVo->setDomnStatusPedidos($dominio->DomnStatusPedido_Concluido);
					if(isset($_POST['MudancaStatus']))
					{
						if($_POST['descricaoPedido'] == '')
						{
							throw new Exception("Você deve preencher o Motivo para o pedido ser ".$dominio->mostraDomnStatusPedido($pedidosVo->getDomnStatusPedidos()));
						}
					}
					break;
				case $dominio->DomnStatusPedido_Fechado:
					$pedidosVo->setDomnStatusPedidos($dominio->DomnStatusPedido_Fechado);
					if(isset($_POST['MudancaStatus']))
					{
						if($_POST['descricaoPedido'] == '')
						{
							throw new Exception("Você deve preencher o Motivo para o pedido ser ".$dominio->mostraDomnStatusPedido($pedidosVo->getDomnStatusPedidos()));
						}
					}
					break;
			}
		
			$historicoVo->setIdPedidos($pedidosVo->getIdPedidos());
			
			//Pesquisa o ultimo Histórico
			$collVo_pesquisaHistorico = $controlaHistorico->pesquisarHistorico($historicoVo);
			$id = count($collVo_pesquisaHistorico)-1;
			$historicoVo = (object) $collVo_pesquisaHistorico[$id];
			$historicoVo->setDataHoraAtendimentoHistorico_Pedidos(date("Y-m-d H:i:s"));
			$controlaHistorico->cadastrarHistorico($historicoVo);
						
			//Grava o Novo Historico
			$historicoVo->setComplementoHistorico_Pedidos('');
			if(isset($_POST['descricaoPedido']))
			{
				if($_POST['descricaoPedido'] != '' && $_POST['pagina'] == 'alterarStatusComplementoPedido')
				{
					$historicoVo->setComplementoHistorico_Pedidos(rawurldecode(strip_tags($_POST['descricaoPedido'])));
				}
			}
			$historicoVo->setIdAnexos();
			$historicoVo->setDataHoraAtendimentoHistorico_Pedidos(null);
			$historicoVo->setIdHistorico_Pedidos();
			$historicoVo->setDataHoraHistorico_Pedidos(date("Y-m-d H:i:s"));
			$historicoVo->setIdUsuarioHistorico_Pedidos($_SESSION['id_Usuario']);
			$historicoVo->setDomnStatusPedidoHistorico_Pedidos($pedidosVo->getDomnStatusPedidos());
			
			if(isset($_POST['selectVersoes']))
			{
				if($_POST['selectVersoes'] != '')
				{
					$historicoVo->setIdVersoes(rawurldecode(strip_tags($_POST['selectVersoes'])));
					$pedidosVo->setIdVersoes(rawurldecode(strip_tags($_POST['selectVersoes'])));
				}
			}
			
			$ultimoIdHistorico[] = $controlaHistorico->cadastrarHistorico($historicoVo);
			
			//Gravar o Id Do histórico na Sessão para inserir o Anexo, caso exista
			$_SESSION['id_Historico_Pedido'] = $ultimoIdHistorico;
			
			if($_POST['pagina'] == 'alterarStatusComplementoPedido')
			{
				//Grava o novo Prazo
				if($previsaoNova == '')
				{
					switch ($pedidosVo->getDomnStatusPedidos())
					{
						case $dominio->DomnStatusPedido_Recebido:
							$dataNova = self::pesquisarDataHoraAtendimentoInicial();
							$pedidosVo->setDataHoraPrevisaoPedidos($dataNova);
							break;
						case $dominio->DomnStatusPedido_Novo:
							$dataNova = self::pesquisarDataHoraAtendimentoInicial();
							$pedidosVo->setDataHoraPrevisaoPedidos($dataNova);
							break;
						case $dominio->DomnStatusPedido_Devolvido:
							$dataNova = self::pesquisarDataHoraAtendimentoInicial();
							$pedidosVo->setDomnStatusPedidos($dominio->DomnStatusPedido_Devolvido);
							break;
						case $dominio->DomnStatusPedido_Concluido:
							$pedidosVo->setDomnStatusPedidos($dominio->DomnStatusPedido_Concluido);
							break;
						case $dominio->DomnStatusPedido_Fechado:
							$pedidosVo->setDomnStatusPedidos($dominio->DomnStatusPedido_Fechado);
							break;
					}
				}
				else 
				{
					$dataNova = self::pesquisarDataHoraAtendimento($pedidosVo->getDataHoraPrevisaoPedidos());
					$pedidosVo->setDataHoraPrevisaoPedidos($dataNova);
				}
				$businessEntity->cadastrarPedidos($pedidosVo);
			}
			else 
			{
				//Grava o novo Prazo
				switch ($pedidosVo->getDomnStatusPedidos())
				{
					case $dominio->DomnStatusPedido_Recebido:
						$dataNova = self::pesquisarDataHoraAtendimentoInicial();
						$pedidosVo->setDataHoraPrevisaoPedidos($dataNova);
						break;
					case $dominio->DomnStatusPedido_Novo:
						$dataNova = self::pesquisarDataHoraAtendimentoInicial();
						$pedidosVo->setDataHoraPrevisaoPedidos($dataNova);
						break;
					case $dominio->DomnStatusPedido_Devolvido:
						$dataNova = self::pesquisarDataHoraAtendimentoInicial();
						$pedidosVo->setDomnStatusPedidos($dominio->DomnStatusPedido_Devolvido);
						break;
					case $dominio->DomnStatusPedido_Concluido:
						$pedidosVo->setDomnStatusPedidos($dominio->DomnStatusPedido_Concluido);
						break;
					case $dominio->DomnStatusPedido_Fechado:
						$pedidosVo->setDomnStatusPedidos($dominio->DomnStatusPedido_Fechado);
						break;
				}
				$businessEntity->cadastrarPedidos($pedidosVo);
			}
			echo 'Sucesso';
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
		}
		
	}
	
	/**
	 * Método que verifica se existe subPedido para o Pedido
	 *
	 * @param PedidosVo $pedidosVo
	 * @return unknown
	 */
	public function verificaSubPedidosExistentes(PedidosVo $pedidosVo)
	{
		$subPedidoVo = new PedidosVo();
		$collVo_SubPedidos = null;
		$subPedidoVo->setPrecedentePedidos($pedidosVo->getIdPedidos());
		$collVo_SubPedidos = self::pesquisarPedidosPorPrecedente($subPedidoVo);
		$dominio = new Dominio();
		
		if(!is_null($collVo_SubPedidos))
		{
			$retorno = false;
			foreach ($collVo_SubPedidos as $subPedido)
			{
				$subPedidoVo = (object) $subPedido;
				if($subPedidoVo->getDomnStatusPedidos() != $dominio->DomnStatusPedido_Concluido)
				{
					if($subPedidoVo->getDomnStatusPedidos() != $dominio->DomnStatusPedido_Fechado)
					{
						$retorno = true;
					}
				}
			}
			return  $retorno;
		}
		else 
		{
			return false;
		}
	}
	
	/**
	 * Pesquisar SubPedidos Existentes por Status
	 * @author João Batista Padilha e Silva
	 * @param PedidosVo $pedidosVo
	 * @param int $idStatus
	 * @return boolean
	 */
	public function verificaSubPedidosExistentesPorStatus(PedidosVo $pedidosVo, $idStatus)
	{
		$subPedidoVo = new PedidosVo();
		$collVo_SubPedidos = null;
		$subPedidoVo->setPrecedentePedidos($pedidosVo->getIdPedidos());
		$collVo_SubPedidos = self::pesquisarPedidosPorPrecedente($subPedidoVo);
		$dominio = new Dominio();
		$retorno = false;
		
		if(!is_null($collVo_SubPedidos))
		{
			
			foreach ($collVo_SubPedidos as $subPedido)
			{
				$subPedidoVo = (object) $subPedido;
				if($subPedidoVo->getDomnStatusPedidos() == $idStatus)
				{
					$retorno = true;
				}
			}
		}
		return $retorno;
	}
	
	/**
	 * Método que mostra os Sub-Pedidos Existentes do Pedido.
	 * @author João Batista Padilha e Silva
	 * @param PedidosVo $pedidosVo
	 * @return var
	 */
	public function mostraSubPedidosExistentes(PedidosVo $pedidosVo)
	{
		$subPedidoVo = new PedidosVo();
		$collVo_SubPedidos = null;
		$subPedidoVo->setPrecedentePedidos($pedidosVo->getIdPedidos());
		$collVo_SubPedidos = self::pesquisarPedidosPorPrecedente($subPedidoVo);
		$dominio = new Dominio();
		$mostra = '';
		
		if(!is_null($collVo_SubPedidos))
		{
			foreach ($collVo_SubPedidos as $subPedido)
			{
				$subPedidoVo = (object) $subPedido;
				if($mostra != '')
				{
					$mostra .= '<br>';
				}
				$mostra .= '<a href="javascript:void(0);" onclick="carregaPagina(\'viewPedidos.php?visualiza=true&idPedidos='.$subPedidoVo->getIdPedidos().'\',\'formulario\');" class="thickbox" id="destinatarios">Nº '.$subPedidoVo->getIdPedidos().' - '.$dominio->mostraDomnStatusPedido($subPedidoVo->getDomnStatusPedidos()).'</a>';
				if($subPedidoVo->getDomnStatusPedidos() == $dominio->DomnStatusPedido_Fechado || $subPedidoVo->getDomnStatusPedidos() == $dominio->DomnStatusPedido_Devolvido)
				{
					$mostra .= "&nbsp;&nbsp;Favor analisar este pedido.";
				}
			}
		}
		return $mostra;
	}
	
	/**
	 * Método para pesquisar os pedidos que entraram em não conformidade
	 * @author Rafael Henrique Vieira de Moura
	 * @param PedidosVo $pedidosVo
	 * @return array $this->collVo
	 */
	public function pesquisarPedidosNaoConformidades(PedidosVo $pedidosVo)
	{
		$businessEntity = new BusinessEntity();
		
		try
		{
			$this->collVo = $businessEntity->pesquisarPedidosNaoConformidades($pedidosVo);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
		
		return $this->collVo;
	}
	
	/**
	 * Método que mostra os Botoes das Ações do Pedido
	 * @author João Batista Padilha e Silva
	 * @param PedidosVo $pedidosVo
	 * @param Historico_PedidosVo $historicoVo
	 */
	public function mostrarBotoesAcaoPedidos(PedidosVo $pedidosVo, Historico_PedidosVo $historicoVo)
	{
		$dominio = new Dominio();
		//Verifica Não Conformidade
		$naoConformidadesVo = new NaoConformidadesVo();
		$controla_NaoConformidades = new Controla_NaoConformidades();
		$naoConformidadesVo->setIdPedidos($pedidosVo->getIdPedidos());
		//Verifica se Existe Sub-Pedido para este Pedido
		
		$botaoMostrado = 0;
		if(!$controla_NaoConformidades->pesquisarNaoConformidadesPedidos($naoConformidadesVo))
		{
			if($historicoVo->getIdUsuariosDestinatario() == $_SESSION['id_Usuario'])
			{
												
				if($pedidosVo->getDomnStatusPedidos() == $dominio->DomnStatusPedido_Novo)
				{
					$botao = $dominio->botaoReceberPedido;
					$botao_txt = $dominio->botaoReceberPedido_TXT;
					$mensagem = "Pedido Recebido com sucesso.";
					$link = "alterarStatusPedido({$pedidosVo->getIdPedidos()},{$dominio->DomnStatusPedido_Recebido}, '{$mensagem}');";
					
					echo '&nbsp;
					<input type="button" value="'.$botao_txt.'" id="'.$botao.'" class="botao" onClick="'.$link.'"/>
					';
					
				}
				if($pedidosVo->getDomnStatusPedidos() == $dominio->DomnStatusPedido_Recebido)
				{
					$mensagem_Atendimento = "Iniciado Atendimento do Pedido.";
					$mensagem_Devolvido = "Pedido Devolvido ao remetente.";
					$link_Atendimento = "alterarStatusPedido({$pedidosVo->getIdPedidos()},{$dominio->DomnStatusPedido_Desenvolvimento}, '{$mensagem_Atendimento}');";
					$bt_SubPedido = '<input alt="viewSubPedidos.php?idPedido='.$pedidosVo->getIdPedidos().'&KeepThis=true&TB_iframe=true&height=400&width=600" title="Novo Sub Pedido" class="thickbox botao" type="button" value="'.$dominio->botaoSubPedido_TXT.'" />';
					echo '&nbsp;
					<input type="button" value="'.$dominio->botaoIniciarDesenvolvimentoPedido_TXT.'" id="'.$dominio->botaoIniciarDesenvolvimentoPedido.'" class="botao" onClick="'.$link_Atendimento.'"/>
					&nbsp;';
					echo $bt_SubPedido;
					echo '&nbsp;
					<input type="button" value="'.$dominio->botaoDevolverPedido_TXT.'" id="'.$dominio->botaoDevolverPedido.'" class="botao" onClick="devolverConcluirFecharReenviarPedido('.$pedidosVo->getIdPedidos().','.$dominio->DomnStatusPedido_Devolvido.',\''.$mensagem_Devolvido.'\',\'Motivo:\');"/>
					&nbsp;
					<input type="button" value="'.$dominio->botaoComplementarPedido_TXT.'" id="'.$dominio->botaoComplementarPedido.'" class="botao" onClick="complementarPedido();"/>
					';
				}
				if($pedidosVo->getDomnStatusPedidos() == $dominio->DomnStatusPedido_Desenvolvimento)
				{
					$retornoSubPedidoFechados = self::verificaSubPedidosExistentesPorStatus($pedidosVo,$dominio->DomnStatusPedido_Fechado);
					$retornoSubPedidoConcluidos = self::verificaSubPedidosExistentesPorStatus($pedidosVo,$dominio->DomnStatusPedido_Concluido);
					if($retornoSubPedidoFechados == false && $retornoSubPedidoConcluidos == true)
					{
						$mensagem_Fechar = "Finalizado Atendimento do pedido.";
						$bt_SubPedido = '<input alt="viewSubPedidos.php?idPedido='.$pedidosVo->getIdPedidos().'&KeepThis=true&TB_iframe=true&height=400&width=600" title="Novo Sub Pedido" class="thickbox botao" type="button" value="'.$dominio->botaoSubPedido_TXT.'" />';
						echo '&nbsp;
						<input type="button" value="'.$dominio->botaoFecharPedido_TXT.'" id="'.$dominio->botaoFecharPedido.'" class="botao" onClick="devolverConcluirFecharReenviarPedido('.$pedidosVo->getIdPedidos().','.$dominio->DomnStatusPedido_Fechado.',\''.$mensagem_Fechar.'\',\'Observação:\');"/>
						&nbsp;
						'.$bt_SubPedido.'
						&nbsp;
						<input type="button" value="'.$dominio->botaoComplementarPedido_TXT.'" id="'.$dominio->botaoComplementarPedido.'" class="botao" onClick="complementarPedido();"/>
						';
					}
				}
			}
			if ($pedidosVo->getIdUsuarios() == $_SESSION['id_Usuario'])
			{
				if($pedidosVo->getDomnStatusPedidos() == $dominio->DomnStatusPedido_Fechado)
				{
					$mensagem = "Pedido Concluido com sucesso.";
					$mensagem_Devolvido = "Pedido Devolvido ao remetente.";
					echo '&nbsp;
					<input type="button" value="'.$dominio->botaoConcluirPedido_TXT.'" id="'.$dominio->botaoConcluirPedido.'" class="botao" onClick="devolverConcluirFecharReenviarPedido('.$pedidosVo->getIdPedidos().','.$dominio->DomnStatusPedido_Concluido.',\''.$mensagem.'\',\'Observação:\');"/>';
					echo '&nbsp;
					<input type="button" value="'.$dominio->botaoDevolverPedido_TXT.'" id="'.$dominio->botaoDevolverPedido.'" class="botao" onClick="devolverConcluirFecharReenviarPedido('.$pedidosVo->getIdPedidos().','.$dominio->DomnStatusPedido_Novo.',\''.$mensagem_Devolvido.'\',\'Motivo:\');"/>
					&nbsp;
					<input type="button" value="'.$dominio->botaoComplementarPedido_TXT.'" id="'.$dominio->botaoComplementarPedido.'" class="botao" onClick="complementarPedido();"/>';
					$botaoMostrado = 1;
				}
				elseif($pedidosVo->getDomnStatusPedidos() == $dominio->DomnStatusPedido_Devolvido)
				{
					$mensagemConcluido = "Pedido Concluido com sucesso.";
					$mensagem_Reenviado = "Pedido Re-enviado com sucesso.";
					echo '&nbsp;
					<input type="button" value="'.$dominio->botaoComplementarPedido_TXT.'" id="'.$dominio->botaoComplementarPedido.'" class="botao" onClick="complementarPedido();"/>
					&nbsp;
					<input type="button" value="'.$dominio->botaoConcluirPedido_TXT.'" id="'.$dominio->botaoConcluirPedido.'" class="botao" onClick="devolverConcluirFecharReenviarPedido('.$pedidosVo->getIdPedidos().','.$dominio->DomnStatusPedido_Concluido.',\''.$mensagemConcluido.'\',\'Motivo:\');"/>
					&nbsp;
					<input type="button" value="'.$dominio->botaoReenviarPedido_TXT.'" id="'.$dominio->botaoReenviarPedido.'" class="botao" onClick="devolverConcluirFecharReenviarPedido('.$pedidosVo->getIdPedidos().','.$dominio->DomnStatusPedido_Novo.',\''.$mensagem_Reenviado.'\',\'Motivo:\');"/>';
					$botaoMostrado = 1;
				}
				elseif($pedidosVo->getDomnStatusPedidos() != $dominio->DomnStatusPedido_Concluido) 
				{
					echo '&nbsp;
					<input type="button" value="'.$dominio->botaoComplementarPedido_TXT.'" id="'.$dominio->botaoComplementarPedido.'" class="botao" onClick="complementarPedido();"/>';
				}
			}
			//Pesquisar se existe permissão para o Usuário Concluir o Pedido
			if($pedidosVo->getDomnStatusPedidos() != $dominio->DomnStatusPedido_Concluido)
			{
				$collVo_permissao = null;
				$permissaoVo = new Permissao_Usuarios_Funcionalidades_PapeisVo();
				$controla_Permissao = new Controla_Permissao();
				$permissaoVo->setIdUsuarios($_SESSION['id_Usuario']);
				$collVo_permissao = $controla_Permissao->buscaPermissoesSemMensagem($permissaoVo);
				$retornoPermissaoConclui = 0;
				if(!is_null($collVo_permissao))
				{
					foreach ($collVo_permissao as $permissao)
					{
						$permissaoVo = (object) $permissao;
						if($permissaoVo->getIdFuncionalidades() == $dominio->DomnFuncionalidade_Pedidos_Concluir_Pedido)
						{
							$retornoPermissaoConclui = 1;
						}
					}
				}
				
				//Pesquisar se existe permissão para o Papel Concluir ou Homologar o Pedido
				$collVo_permissao = null;
				$permissaoVo = new Permissao_Usuarios_Funcionalidades_PapeisVo();
				$controla_Permissao = new Controla_Permissao();
				if($historicoVo->getIdUsuarioOrigem() == $_SESSION['id_Usuario'])
				{
					$permissaoVo->setIdPapeis($historicoVo->getIdPapeisOrigem());
					$collVo_permissao = $controla_Permissao->buscaPermissoesSemMensagem($permissaoVo);
					$retornoPermissaoConclui = 0;
					$retornoPermissaoHomologa = 0;
					if(!is_null($collVo_permissao))
					{
						foreach ($collVo_permissao as $permissao)
						{
							$permissaoVo = (object) $permissao;
							if($permissaoVo->getIdFuncionalidades() == $dominio->DomnFuncionalidade_Pedidos_Concluir_Pedido)
							{
								$retornoPermissaoConclui = 1;
							}
						}
					}
				}
				if($retornoPermissaoConclui == 1 && $retornoSubPedido == false && $botaoMostrado == 0)
				{
					$mensagem = "Pedido Concluido com sucesso.";
					//$link = "alterarStatusPedido({$pedidosVo->getIdPedidos()},{$dominio->DomnStatusPedido_Concluido}, '{$mensagem}');";
					echo '&nbsp;&nbsp;&nbsp;
					<input type="button" value="'.$dominio->botaoConcluirPedido_TXT.'" id="'.$dominio->botaoConcluirPedido.'" class="botao" onClick="devolverConcluirFecharReenviarPedido('.$pedidosVo->getIdPedidos().','.$dominio->DomnStatusPedido_Concluido.',\''.$mensagem.'\',\'Observação:\');"/>';
				}
			}
		}
		else 
		{
			$link = "carregaPagina('viewNaoConformidades.php?idPedidos={$pedidosVo->getIdPedidos()}','formulario');";
			echo '
			<br><br><span class="informacao">Foi gerada uma não conformidade para este pedido.</span><br><br>
			&nbsp;&nbsp;&nbsp;
			<input type="button" value="'.$dominio->botaoVerNaoConformidadePedido_TXT.'" id="'.$dominio->botaoVerNaoConformidadePedido.'" class="botao" onClick="'.$link.'"/>
			';
		}
	}
}
?>