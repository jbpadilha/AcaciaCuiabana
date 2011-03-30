<?php
//####################################
// * Jo�o Batista Padilha e Silva Analista/Desenvolvedor (�baco Tecnologia)
// * Arquivo: Controla_NaoConformidades.php
// * Cria��o: Jo�o Batista Padilha e Silva
// * Revis�o: 
// * Data de cria��o: 15/07/2008
//####################################
require_once("NaoConformidadesVo.php");
require_once("DestinatariosNaoConformidadesVo.php");

/**
 * Classe de Controle de N�o Conformidades
 * @author Jo�o Batista Padilha e Silva
 */
class Controla_NaoConformidades
{
	private $collVo = null;
	
	/**
	 * M�todo de pesquisa de destinatatariosNaoConformidades
	 * @author Jo�o Batista Padilha e Silva
	 * @param DestinatariosNaoConformidadesVo $destinatariosVo
	 * @return array $this->collVo
	 */
	public function pesquisarDestinatariosNaoConformidades(DestinatariosNaoConformidadesVo $destinatariosVo)
	{
		$businessEntity = new BusinessEntity();
		
		try 
		{
			$this->collVo = $businessEntity->pesquisarDestinatariosNaoConformidades($destinatariosVo); 
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
		return $this->collVo;
	}
	
	/**
	 * M�todo que deleta todos os destinat�rios N�o Conformidade para o projeto
	 * @author Jo�o Batista Padilha e Silva
	 * @param DestinatariosNaoConformidadesVo $destinatariosVo
	 */
	public function deletaDestinatariosNaoConformidades(DestinatariosNaoConformidadesVo $destinatariosVo)
	{
		$businessEntity = new BusinessEntity();
		try 
		{
			$businessEntity->deletaDestinatariosNaoConformidades($destinatariosVo);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	
	/**
	 * M�todo de cadastro dos DestinatariosNaoConformidades
	 * @author Jo�o Batista Padilha e Silva
	 * @param DestinatariosNaoConformidadesVo $destinatariosVo
	 */
	public function cadastraDestinatariosNaoConformidades(DestinatariosNaoConformidadesVo $destinatariosVo)
	{
		$businessEntity = new BusinessEntity();
		try 
		{
			$businessEntity->cadastrarDestinatariosNaoConformidades($destinatariosVo);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	
	/**
	 * M�todo para pesquisa de N�o Conformidades
	 * @author Rafael Henrique Vieira de Moura
	 * @param NaoConformidadesVo $naoConformidadesVo
	 * @return array $this->collVo
	 */
	public function pesquisarNaoConformidades(NaoConformidadesVo $naoConformidadesVo)
	{
		$businessEntity = new BusinessEntity();
		
		try
		{
			$this->collVo = $businessEntity->pesquisarNaoConformidades($naoConformidadesVo);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
		
		return $this->collVo;
	}
	
	/**
	 * M�todo para exibi��o da lista de N�o Conformidades existentes no Sistema
	 * @author Rafael Henrique Vieira de Moura
	 */
	public function montaListaNaoConformidades()
	{
		$controlaPedidos = new Controla_Pedidos();
		$pedidosVo = new PedidosVo();
		$pedidosVo_aux = new PedidosVo();
		$naoConformidadesVo = new NaoConformidadesVo();
		$controlaNaoConformidades = new Controla_NaoConformidades();
		$controlaHistorico = new Controla_Historico();
		$historicoVo = new Historico_PedidosVo();
		
		//$naoConformidadesVo->setParametroConsulta("WHERE justificativaNaoConformidades = '' OR contraMedidaNaoConformidades = ''");
		$collVo_NaoConformidades = self::pesquisarNaoConformidades($naoConformidadesVo);
		
		if (!is_null($collVo_NaoConformidades))
		{
			$cont = 0;
			$montaListaPendentes = '';
			$montaListaFechados = '';
			
			foreach ($collVo_NaoConformidades as $naoConformidades)
			{
				$naoConformidadesVo = (object) $naoConformidades;
				$pedidosVo_aux->setIdPedidos($naoConformidadesVo->getIdPedidos());
				
				$collVo_Pedidos = $controlaPedidos->pesquisarPedidos($pedidosVo_aux);
				$pedidosVo = (object) $collVo_Pedidos[0];
				
				//Carregar os id's do Usu�rios respons�veis por receber as N�o Conformidades
				$destinatariosNaoConformidadesVo = new DestinatariosNaoConformidadesVo();
				$destinatariosNaoConformidadesVo->setIdProjetos($pedidosVo->getIdProjetos());
				$collVo_Destinatarios = self::pesquisarDestinatariosNaoConformidades($destinatariosNaoConformidadesVo);
				
				$arrayDestinatarios = array();
				if (!is_null($collVo_Destinatarios))
				{
					foreach ($collVo_Destinatarios as $destinatarios)
					{
						$destinatariosNaoConformidadesVo = (object) $destinatarios;
						$arrayDestinatarios[] = $destinatariosNaoConformidadesVo->getIdUsuarios();
					}
				}
				
				//Carregar o id do Usu�rio que dever� justificar a N�o Conformidade
				$historicoVo->setIdPedidos($pedidosVo->getIdPedidos());
				$collVo_Historico = $controlaHistorico->pesquisarHistorico($historicoVo);
				$i = count($collVo_Historico) - 1;
				$historicoVo = (object) $collVo_Historico[$i];
				
				//Montar listagem
				$formataData = new FormataData();
				$css = '';
				if (in_array($_SESSION['id_Usuario'],$arrayDestinatarios) || $_SESSION['id_Usuario'] == $historicoVo->getIdUsuariosDestinatario())
				{
					$css = ($cont % 2 == 0) ? "linhaListagem" : "linha2Listagem";
					
					if ($naoConformidadesVo->getJustificativaNaoConformidades() == '' && $naoConformidadesVo->getContraMedidasNaoConformidades() == '' && (in_array($_SESSION['id_Usuario'],$arrayDestinatarios) || $_SESSION['id_Usuario'] == $historicoVo->getIdUsuariosDestinatario()))
					{
						$montaListaPendentes .= '
						<tr class="'.$css.'">
							<td><a href="javascript:void(0)" onclick="carregaPagina(\'viewPedidos.php?visualiza=true&amp;idPedidos='.$naoConformidadesVo->getIdPedidos().'\',\'formulario\')" title="Ver Pedido N� '.$naoConformidadesVo->getIdPedidos().'">'.$naoConformidadesVo->getIdPedidos().'</a></td>
							<td>'.$formataData->toViewDateTime($naoConformidadesVo->getDataNaoConformidades()).'</td>
							<td width="2%"><a href="javascript:void(0)" onclick="carregaPagina(\'viewNaoConformidades.php?idNaoConformidades='.$naoConformidadesVo->getIdNaoConformidades().'\',\'formulario\')" title="Ver N�o Conformidade"><img src="'.PATH.'/imagens/ico_localizar.gif" alt="" border="0" /></a></td>
						</tr>
						';
					}
					elseif ($naoConformidadesVo->getJustificativaNaoConformidades() != '' && $naoConformidadesVo->getContraMedidasNaoConformidades() == '' && in_array($_SESSION['id_Usuario'],$arrayDestinatarios))
					{
						$montaListaPendentes .= '
						<tr class="'.$css.'">
							<td><a href="javascript:void(0)" onclick="carregaPagina(\'viewPedidos.php?visualiza=true&amp;idPedidos='.$naoConformidadesVo->getIdPedidos().'\',\'formulario\')" title="Ver Pedido N� '.$naoConformidadesVo->getIdPedidos().'">'.$naoConformidadesVo->getIdPedidos().'</a></td>
							<td>'.$formataData->toViewDateTime($naoConformidadesVo->getDataNaoConformidades()).'</td>
							<td width="2%"><a href="javascript:void(0)" onclick="carregaPagina(\'viewNaoConformidades.php?idNaoConformidades='.$naoConformidadesVo->getIdNaoConformidades().'\',\'formulario\')" title="Ver N�o Conformidade"><img src="'.PATH.'/imagens/ico_localizar.gif" alt="" border="0" /></a></td>
						</tr>
						';
					}
					elseif ($naoConformidadesVo->getJustificativaNaoConformidades() != '' && $naoConformidadesVo->getContraMedidasNaoConformidades() != '' && (in_array($_SESSION['id_Usuario'],$arrayDestinatarios) || $_SESSION['id_Usuario'] == $historicoVo->getIdUsuariosDestinatario()))
					{
						$justificativa = $naoConformidadesVo->getJustificativaNaoConformidades();
						$justificativa = substr($justificativa,0,20);
						$contraMedida = $naoConformidadesVo->getContraMedidasNaoConformidades();
						$contraMedida = substr($contraMedida,0,20);
						
						$montaListaFechados .= '
						<tr class="'.$css.'">
							<td><a href="javascript:void(0)" onclick="carregaPagina(\'viewPedidos.php?visualiza=true&amp;idPedidos='.$naoConformidadesVo->getIdPedidos().'\',\'formulario\')" title="Ver Pedido N� '.$naoConformidadesVo->getIdPedidos().'">'.$naoConformidadesVo->getIdPedidos().'</a></td>
							<td>'.$formataData->toViewDateTime($naoConformidadesVo->getDataNaoConformidades()).'</td>
							<td>'.$justificativa.'...</td>
							<td>'.$contraMedida.'...</td>
							<td width="2%"><a href="javascript:void(0)" onclick="carregaPagina(\'viewNaoConformidades.php?idNaoConformidades='.$naoConformidadesVo->getIdNaoConformidades().'\',\'formulario\')" title="Ver N�o Conformidade"><img src="'.PATH.'/imagens/ico_localizar.gif" alt="" border="0" /></a></td>
						</tr>
						';
					}
					$cont++;
				}
			}
			if ($montaListaPendentes != '')
			{
				echo '
				<table width="95%" border="0" cellpadding="1" cellspacing="0" class="tabelaListagem" align="center">
					<tr>
						<td class="tituloListagem" colspan="3"><strong>N�o Conformidades Pendentes</strong></td>
					</tr>
				</table>
				<table width="95%" border="0" cellpadding="1" cellspacing="0" class="tabelaListagem" align="center">
					<tr>
						<td class="tituloListagem">Pedido</td>
						<td class="tituloListagem" colspan="2">Data N�o Conformidade</td>
					</tr>
					'.$montaListaPendentes.'
				</table>
				';
			}
			
			if ($montaListaFechados != '')
			{
				echo '
				<br />
				<table width="95%" border="0" cellpadding="1" cellspacing="0" class="tabelaListagem" align="center">
					<tr>
						<td class="tituloListagem" colspan="5"><strong>N�o Conformidades Fechadas</strong></td>
					</tr>
				</table>
				<table width="95%" border="0" cellpadding="1" cellspacing="0" class="tabelaListagem" align="center">
					<tr>
						<td class="tituloListagem">Pedido</td>
						<td class="tituloListagem">Data N�o Conformidade</td>
						<td class="tituloListagem">Justificativa</td>
						<td class="tituloListagem" colspan="2">Contra Medida</td>
					</tr>
					'.$montaListaFechados.'
				</table>
				';
			}
		}
	}
	
	/**
	 * M�todo para montar a lista de pesquisa de N�o Conformidades
	 * @author Rafael Henrique Vieira de Moura
	 * @param NaoConformidadesVo $naoConformidadesVo
	 */
	public function montaListaPesquisaNaoConformidades(NaoConformidadesVo $naoConformidadesVo)
	{
		$controlaPedidos = new Controla_Pedidos();
		$pedidosVo = new PedidosVo();
		$pedidosVo_aux = new PedidosVo();
		$controlaNaoConformidades = new Controla_NaoConformidades();
		$controlaHistorico = new Controla_Historico();
		$historicoVo = new Historico_PedidosVo();
		
		$collVo_NaoConformidades = self::pesquisarNaoConformidades($naoConformidadesVo);
		
		if (!is_null($collVo_NaoConformidades))
		{
			$cont = 0;
			$montaListaPendentes = '';
			$montaListaFechados = '';
			
			foreach ($collVo_NaoConformidades as $naoConformidades)
			{
				$naoConformidadesVo = (object) $naoConformidades;
				$pedidosVo_aux->setIdPedidos($naoConformidadesVo->getIdPedidos());
				
				$collVo_Pedidos = $controlaPedidos->pesquisarPedidos($pedidosVo_aux);
				$pedidosVo = (object) $collVo_Pedidos[0];
				
				//Carregar os id's do Usu�rios respons�veis por receber as N�o Conformidades
				$destinatariosNaoConformidadesVo = new DestinatariosNaoConformidadesVo();
				$destinatariosNaoConformidadesVo->setIdProjetos($pedidosVo->getIdProjetos());
				$collVo_Destinatarios = self::pesquisarDestinatariosNaoConformidades($destinatariosNaoConformidadesVo);
				
				$arrayDestinatarios = array();
				if (!is_null($collVo_Destinatarios))
				{
					foreach ($collVo_Destinatarios as $destinatarios)
					{
						$destinatariosNaoConformidadesVo = (object) $destinatarios;
						$arrayDestinatarios[] = $destinatariosNaoConformidadesVo->getIdUsuarios();
					}
				}
				
				//Carregar o id do Usu�rio que dever� justificar a N�o Conformidade
				$historicoVo->setIdPedidos($pedidosVo->getIdPedidos());
				$collVo_Historico = $controlaHistorico->pesquisarHistorico($historicoVo);
				$i = count($collVo_Historico) - 1;
				$historicoVo = (object) $collVo_Historico[$i];
				
				//Montar listagem
				$formataData = new FormataData();
				if (in_array($_SESSION['id_Usuario'],$arrayDestinatarios) || $_SESSION['id_Usuario'] == $historicoVo->getIdUsuariosDestinatario())
				{
					$css = ($cont % 2 == 0) ? "linhaListagem" : "linha2Listagem";
					if ($naoConformidadesVo->getJustificativaNaoConformidades() == '' && $naoConformidadesVo->getContraMedidasNaoConformidades() == '' && (in_array($_SESSION['id_Usuario'],$arrayDestinatarios) || $_SESSION['id_Usuario'] == $historicoVo->getIdUsuariosDestinatario()))
					{
						$montaListaPendentes .= '
						<tr class="'.$css.'">
							<td><a href="javascript:void(0)" onclick="carregaPagina(\'viewPedidos.php?visualiza=true&amp;idPedidos='.$naoConformidadesVo->getIdPedidos().'\',\'formulario\')" title="Ver Pedido N� '.$naoConformidadesVo->getIdPedidos().'">'.$naoConformidadesVo->getIdPedidos().'</a></td>
							<td>'.$formataData->toViewDateTime($naoConformidadesVo->getDataNaoConformidades()).'</td>
							<td width="2%"><a href="javascript:void(0)" onclick="carregaPagina(\'viewNaoConformidades.php?idNaoConformidades='.$naoConformidadesVo->getIdNaoConformidades().'\',\'formulario\')" title="Ver N�o Conformidade"><img src="'.PATH.'/imagens/ico_localizar.gif" alt="" border="0" /></a></td>
						</tr>
						';
					}
					elseif ($naoConformidadesVo->getJustificativaNaoConformidades() != '' && $naoConformidadesVo->getContraMedidasNaoConformidades() == '' && in_array($_SESSION['id_Usuario'],$arrayDestinatarios))
					{
						$montaListaPendentes .= '
						<tr class="'.$css.'">
							<td><a href="javascript:void(0)" onclick="carregaPagina(\'viewPedidos.php?visualiza=true&amp;idPedidos='.$naoConformidadesVo->getIdPedidos().'\',\'formulario\')" title="Ver Pedido N� '.$naoConformidadesVo->getIdPedidos().'">'.$naoConformidadesVo->getIdPedidos().'</a></td>
							<td>'.$formataData->toViewDateTime($naoConformidadesVo->getDataNaoConformidades()).'</td>
							<td width="2%"><a href="javascript:void(0)" onclick="carregaPagina(\'viewNaoConformidades.php?idNaoConformidades='.$naoConformidadesVo->getIdNaoConformidades().'\',\'formulario\')" title="Ver N�o Conformidade"><img src="'.PATH.'/imagens/ico_localizar.gif" alt="" border="0" /></a></td>
						</tr>
						';
					}
					elseif ($naoConformidadesVo->getJustificativaNaoConformidades() != '' && $naoConformidadesVo->getContraMedidasNaoConformidades() != '' && (in_array($_SESSION['id_Usuario'],$arrayDestinatarios) || $_SESSION['id_Usuario'] == $historicoVo->getIdUsuariosDestinatario()))
					{
						$justificativa = $naoConformidadesVo->getJustificativaNaoConformidades();
						$justificativa = substr($justificativa,0,20);
						$contraMedida = $naoConformidadesVo->getContraMedidasNaoConformidades();
						$contraMedida = substr($contraMedida,0,20);
						
						$montaListaFechados .= '
						<tr class="'.$css.'">
							<td><a href="javascript:void(0)" onclick="carregaPagina(\'viewPedidos.php?visualiza=true&amp;idPedidos='.$naoConformidadesVo->getIdPedidos().'\',\'formulario\')" title="Ver Pedido N� '.$naoConformidadesVo->getIdPedidos().'">'.$naoConformidadesVo->getIdPedidos().'</a></td>
							<td>'.$formataData->toViewDateTime($naoConformidadesVo->getDataNaoConformidades()).'</td>
							<td>'.$justificativa.'...</td>
							<td>'.$contraMedida.'...</td>
							<td width="2%"><a href="javascript:void(0)" onclick="carregaPagina(\'viewNaoConformidades.php?idNaoConformidades='.$naoConformidadesVo->getIdNaoConformidades().'\',\'formulario\')" title="Ver N�o Conformidade"><img src="'.PATH.'/imagens/ico_localizar.gif" alt="" border="0" /></a></td>
						</tr>
						';
					}
					$cont++;
				}
			}
			if ($montaListaPendentes != '')
			{
				echo '
				<table width="95%" border="0" cellpadding="1" cellspacing="0" class="tabelaListagem" align="center">
					<tr>
						<td class="tituloListagem" colspan="3"><strong>N�o Conformidades Pendentes</strong></td>
					</tr>
				</table>
				<table width="95%" border="0" cellpadding="1" cellspacing="0" class="tabelaListagem" align="center">
					<tr>
						<td class="tituloListagem">Pedido</td>
						<td class="tituloListagem" colspan="2">Data N�o Conformidade</td>
					</tr>
					'.$montaListaPendentes.'
				</table>
				';
			}
			
			if ($montaListaFechados != '')
			{
				echo '
				<br />
				<table width="95%" border="0" cellpadding="1" cellspacing="0" class="tabelaListagem" align="center">
					<tr>
						<td class="tituloListagem" colspan="5"><strong>N�o Conformidades Fechadas</strong></td>
					</tr>
				</table>
				<table width="95%" border="0" cellpadding="1" cellspacing="0" class="tabelaListagem" align="center">
					<tr>
						<td class="tituloListagem">Pedido</td>
						<td class="tituloListagem">Data N�o Conformidade</td>
						<td class="tituloListagem">Justificativa</td>
						<td class="tituloListagem" colspan="2">Contra Medida</td>
					</tr>
					'.$montaListaFechados.'
				</table>
				';
			}
		}
		else
		{
			echo '
			<table width="95%" border="0" cellpadding="1" cellspacing="0" class="tabelaListagem" align="center">
				<tr>
					<td class="tituloListagem">Pedido</td>
					<td class="tituloListagem">Data N�o Conformidade</td>
				</tr>
				<tr>
					<td colspan="2" align="center">N�o foi encontrada nenhuma N�o Conformidade</td>
				</tr>
			</table>
			';
		}
	}
	
	/**
	 * M�todo para cadastro de n�o conformidades
	 * @author Rafael Henrique Vieira de Moura
	 */
	public function cadastrarNaoConformidades()
	{
		$businessEntity = new BusinessEntity();
		$dominio = new Dominio();
		
		$controlaPedidos = new Controla_Pedidos();
		$controlaHistorico = new Controla_Historico();
		$controlaTabelaBasica = new Controla_TabelaBasica();
		$controlaUsuarios = new Controla_Usuarios();
		
		$pedidosVo = new PedidosVo();
		$tabelaBasicaVo = new TabelaBasicaVo();
		$naoConformidadesVo_aux = new NaoConformidadesVo();
		$usuariosVo = new UsuariosVo();
		$destinatariosNaoConformidadesVo = new DestinatariosNaoConformidadesVo();
		
		$tempoToleranciaNaoConformidades = '';
		
		
		try
		{
			$collVo_TabelaBasica = $controlaTabelaBasica->pesquisaTabelaBasica($tabelaBasicaVo);
			$tabelaBasicaVo = (object) $collVo_TabelaBasica[0];
			
			$collVo_Pedidos = $controlaPedidos->pesquisarPedidosNaoConformidades($pedidosVo);
			
			if (!is_null($collVo_Pedidos))
			{
				foreach ($collVo_Pedidos as $pedido)
				{
					$pedidosVo = (object) $pedido;
					
					$naoConformidadesVo_aux->setIdPedidos($pedidosVo->getIdPedidos());
					$collVo_NaoConformidades = self::pesquisarNaoConformidades($naoConformidadesVo_aux);
					
					$gerarNaoConformidades = true;
					if (!is_null($collVo_NaoConformidades))
					{
						foreach ($collVo_NaoConformidades as $naoConformidade)
						{
							$naoConformidadesVo_aux = (object) $naoConformidade;
							
							if ($naoConformidadesVo_aux->getJustificativaNaoConformidades() == '')
							{
								$gerarNaoConformidades = false;
							}
						}
					}
					
					if ($gerarNaoConformidades === true)
					{
						$tempoToleranciaNaoConformidades = $tabelaBasicaVo->getToleranciaHoraConformidade();
						list($horaTolerancia, $minutosTolerancia, $segundosTolerancia) = explode(":",$tempoToleranciaNaoConformidades);
						
						$previsaoEntrega = $pedidosVo->getDataHoraPrevisaoPedidos();
						$dataHoje = date("Y-m-d H:i:s");
						$dataAux = explode(" ",$dataHoje);
						$dataHoje = explode("-",$dataAux[0]);
						$horaHoje = explode(":",$dataAux[1]);
						$dataVerificacao = date("Y-m-d H:i:s",mktime($horaHoje[0]+$horaTolerancia,$horaHoje[1]+$minutosTolerancia,$horaHoje[2]+$segundosTolerancia,$dataHoje[1],$dataHoje[2],$dataHoje[0]));
						
						if(date($dataVerificacao) > date($previsaoEntrega))
						{
							//Gera a nao conformidade
							$naoConformidadesVo = new NaoConformidadesVo();
							$naoConformidadesVo->setDataNaoConformidades(date("Y-m-d H:i:s"));
							$naoConformidadesVo->setIdPedidos($pedidosVo->getIdPedidos());
							$businessEntity->cadastrarNaoConformidades($naoConformidadesVo);
							$businessEntity->enviaNaoConformidades($pedidosVo);
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
	 * M�todo para gravar Justificativa/Contra-Medidas das N�o Conformidades
	 * @author Rafael Henrique Vieira de Moura
	 * @param NaoConformidadesVo $naoConformidadesVo
	 */
	public function atualizarNaoConformidades(NaoConformidadesVo $naoConformidadesVo)
	{
		$businessEntity = new BusinessEntity();
		
		try
		{
			$businessEntity->cadastrarNaoConformidades($naoConformidadesVo,true);
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
		}
	}
	
	/**
	 * M�todo para pesquisar se um pedido tem n�o conformidades
	 * @author Rafael Henrique Vieira de Moura
	 * @param NaoConformidadesVo $naoConformidadesVo
	 * @return boolean
	 */
	public function pesquisarNaoConformidadesPedidos(NaoConformidadesVo $naoConformidadesVo)
	{
		$naoConformidadesVo->setParametroConsulta('WHERE idPedidos = "'.$naoConformidadesVo->getIdPedidos().'"');
		$collVo_NaoConformidades = self::pesquisarNaoConformidades($naoConformidadesVo);
		
		$temNaoConformidades = false;
		
		if(!is_null($collVo_NaoConformidades))
		{
			foreach ($collVo_NaoConformidades as $naoConformidades)
			{
				$naoConformidadesVo = (object) $naoConformidades;
				if($naoConformidadesVo->getJustificativaNaoConformidades() == '' || $naoConformidadesVo->getContraMedidasNaoConformidades() == '')
				{
					$temNaoConformidades = true;
				}
			}
		}
		
		if ($temNaoConformidades === true)
			return true;
		else 
			return false;
	}
}
?>