<?php
//####################################
// * Jo�o Batista Padilha e Silva Analista/Desenvolvedor (�baco Tecnologia)
// * Arquivo: Controla_Fluxos.php
// * Cria��o: Jo�o Batista Padilha e Silva
// * Revis�o: 
// * Data de cria��o: 11/07/2008
//####################################
require_once("FluxosVo.php");

/**
 * Classe de Controle dos Fluxos do Sistema
 * @author Jo�o Batista Padilha e Silva
 */
class Controla_Fluxos
{
	private $collVo = null;
		
	/**
	 * M�todo de busca de Fluxos do Sistema
	 * @author Jo�o Batista Padilha e Silva
	 * @param FluxosVo $fluxosVo
	 * @return $collVo
	 */
	public function pesquisarFluxos(FluxosVo $fluxosVo)
	{
		try 
		{
			$businessEntity = new BusinessEntity();
			$this->collVo = $businessEntity->pesquisarFluxos($fluxosVo);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
		return $this->collVo;
	}

	/**
	 * M�todo de retorno da pesquisa de Fluxos do Sistema
	 * @author Jo�o Batista Padilha e Silva
	 * @param FluxosVo $fluxosVo
	 */
	public function mostraFluxosPesquisa(FluxosVo $fluxosVo)
	{
		$this->collVo = self::pesquisarFluxos($fluxosVo);
		
		echo '	<table width="95%" border="0" cellpadding="1" cellspacing="0" class="tabelaListagem" align="center">
				<tr>
					<td class="tituloListagem">Identifica��o do Fluxo</td>
					<td class="tituloListagem">Grupo Pertencente</td>
					<td class="tituloListagem" colspan="2">Ordem do Fluxo</td>
				</tr>';
		
		if(!is_null($this->collVo))
		{
			
			for($i = 0; $i < count($this->collVo); $i++)
			{
				$fluxosVo = (object) $this->collVo[$i];
				
				// Busca o Nome do Grupo
				$controlaGrupoFluxos = new Controla_GrupoFluxos();
				$grupoFluxosVo = new GrupoFluxosVo();
				$grupoFluxosVo->setIdGrupoFluxos($fluxosVo->getIdGrupoFluxos());
				$collVo_GrupoFluxos = $controlaGrupoFluxos->pesquisarGrupoFluxos($grupoFluxosVo);
				$grupoFluxosVo = (object) $collVo_GrupoFluxos[0];
								
				$classCss = ($i%2==0) ? "linhaListagem" : "linha2Listagem";
				echo '
						<tr class="'.$classCss.'">
							<td>'.$fluxosVo->getIdFluxos().'</td>
							<td>'.$grupoFluxosVo->getNomeGrupoFluxos().'</td>
							<td>'.$fluxosVo->getOrdemFluxos().'</td>
							<td style="width:2%;">
								<a href="javascript:void(0);" onClick="carregaPagina(\'viewFluxos.php?cadastro=true&idFluxos='.$fluxosVo->getIdFluxos().'\',\'formulario\');" title="Editar Fluxo">
									<img src="imagens/alterar.jpg" alt="Editar Fluxos" style="border:0;" />
								</a>
							</td>
						</tr>';
			}
		}
		else 
		{
			echo '
				<tr class="linhaListagem">
				<td colspan="2">Fluxo n�o existe.</td>
				</tr>
			';
		}
		echo '</table>';
	}
		
	/**
	 * M�todo que mostra todas os Fluxos do Sistema
	 * @author Jo�o Batista Padilha e Silva
	 */
	public function mostraFluxos()
	{
		$fluxosVo = new FluxosVo();
		$dominio = new Dominio();
		$this->collVo = self::pesquisarFluxos($fluxosVo);
		
		if(!is_null($this->collVo))
		{
			
			for($i = 0; $i < count($this->collVo); $i++)
			{
				$fluxosVo = (object) $this->collVo[$i];
				
				// Busca o Nome do Grupo
				$controlaGrupoFluxos = new Controla_GrupoFluxos();
				$grupoFluxosVo = new GrupoFluxosVo();
				$grupoFluxosVo->setIdGrupoFluxos($fluxosVo->getIdGrupoFluxos());
				$collVo_GrupoFluxos = $controlaGrupoFluxos->pesquisarGrupoFluxos($grupoFluxosVo);
				$grupoFluxosVo = (object) $collVo_GrupoFluxos[0];
				
				// Buscar o nome do Papel Origem
				if($fluxosVo->getIdPapeisOrigem() == $dominio->DomnPapel_Usuario)
				{
					$papelOrigem = $dominio->DomnPapel_Usuario_TXT;
				}
				else 
				{
					$papeisVo = new PapeisVo();
					$controlaPapeis = new Controla_Papeis();
					$papeisVo->setIdPapeis($fluxosVo->getIdPapeisOrigem());
					$collVo = $controlaPapeis->pesquisarPapeis($papeisVo);
					$papeisVo = (object) $collVo[0];
					$papelOrigem = $papeisVo->getNomePapeis();
				}
				
				// Buscar o nome do Papel Destinat�rio
				if($fluxosVo->getIdPapeisDestinatario() == $dominio->DomnPapel_Usuario)
				{
					$papelDestinatario = $dominio->DomnPapel_Usuario_TXT;
				}
				else 
				{
					$papeisVo = new PapeisVo();
					$controlaPapeis = new Controla_Papeis();
					$papeisVo->setIdPapeis($fluxosVo->getIdPapeisDestinatario());
					$collVo = $controlaPapeis->pesquisarPapeis($papeisVo);
					$papeisVo = (object) $collVo[0];
					$papelDestinatario = $papeisVo->getNomePapeis();
				}
							
				$classCss = ($i%2==0) ? "linhaListagem" : "linha2Listagem";
				echo '
						<tr class="'.$classCss.'">
							<td>'.$fluxosVo->getOrdemFluxos().'</td>
							<td>'.$papelOrigem.'</td>
							<td>'.$papelDestinatario.'</td>
							<td>'.$grupoFluxosVo->getNomeGrupoFluxos().'</td>
							<td style="width:2%;">
								<a href="javascript:void(0);" onClick="carregaPagina(\'viewFluxos.php?cadastro=true&idFluxos='.$fluxosVo->getIdFluxos().'\',\'formulario\');" title="Editar Fluxo">
									<img src="imagens/alterar.jpg" alt="Editar Fluxos" style="border:0;" />
								</a>
							</td>
						</tr>';
			}
		}
		else 
		{
			echo '
				<tr class="linhaListagem">
				<td colspan="2">Fluxos n�o existe.</td>
				</tr>
			';
		}
	}
	
	/**
	 * M�todo que monta o select dos Grupos de Fluxos para incluir o Fluxos no Grupo
	 * @author Jo�o Batista Padilha e Silva
	 * @param FluxosVo $fluxosVo
	 * @return var
	 */
	public function montaSelectGruposFluxos(FluxosVo $fluxosVo)
	{
		$dominio = new Dominio();
		
		$montaSelect = '<select id="selectGrupoFluxos" name="selectGrupoFluxos" class="campo">
									<option value="">'.$dominio->select.'</option>';
		
		$grupoFluxosVo = new GrupoFluxosVo();
		$controlaGrupoFluxos = new Controla_GrupoFluxos();
		$collVo_GrupoFluxos = $controlaGrupoFluxos->pesquisarGrupoFluxos($grupoFluxosVo);
		
		foreach ($collVo_GrupoFluxos as $grupo)
		{
			if($grupo != '' || $grupo != 0)
			{
				$grupoFluxosVo = (object) $grupo;
				$selected = (($grupoFluxosVo->getIdGrupoFluxos()) == ($fluxosVo->getIdGrupoFluxos()))? 'selected="selected"':'';
				$montaSelect .= '<option value="'.$grupoFluxosVo->getIdGrupoFluxos().'" '.$selected.'>'.$grupoFluxosVo->getNomeGrupoFluxos().'</option>';
			}
		}
		
		$montaSelect .= '</select>';
		return $montaSelect;
	}
	
	/**
	 * M�todo de monstagem do Select de Pesquisa de Papeis
	 * @author Jo�o Batista Padilha e Silva
	 * @param int $idPapelComparacao
	 * @param var $nomeSelect
	 * @return var
	 */
	public function montaSelectPapeis($nomeSelect, $idPapelComparacao = '')
	{
		$dominio = new Dominio();
		
		$montaSelect = '<select id="'.$nomeSelect.'" name="'.$nomeSelect.'" class="campo">
									<option value="">'.$dominio->select.'</option>';
		
		//Monta Options de Papeis Dominio
		$montaSelect .= $dominio->montaOptionsDomnPapeis($idPapelComparacao);
		
		$controlaPapeis = new Controla_Papeis();
		$papeisVo = new PapeisVo();
		$collVo_Papeis = $controlaPapeis->pesquisarPapeis($papeisVo);
		
		if(!is_null($collVo_Papeis))
		{
			foreach ($collVo_Papeis as $papeis)
			{
				if($papeis != '' || $papeis != 0)
				{
					$papeisVo = (object) $papeis;
					$selected = ($idPapelComparacao == $papeisVo->getIdPapeis())? 'selected="selected"':'';
					$montaSelect .= '<option value="'.$papeisVo->getIdPapeis().'" '.$selected.'>'.$papeisVo->getNomePapeis().'</option>';
				}
			}
		}
		$montaSelect .= '</select>';
		return $montaSelect;
	}
		
	/**
	 * M�todo para Cadastrar/Alterar Fluxos do Sistema
	 * @author Jo�o Batista Padilha e Silva
	 * @param FluxosVo $fluxosVo
	 */
	public function cadastraFluxos(FluxosVo $fluxosVo)
	{
		$businessEntity = new BusinessEntity();
		try 
		{			
			$businessEntity->cadastrarFluxos($fluxosVo);
			
			/**
			 * Grava��o do LOG
			 */
			$dominio = new Dominio();
			if ($fluxosVo->getIdFluxos() == '')
				$DomnAcao = $dominio->DomnAcao_Log_Suporte_Incluir;
			else 
				$DomnAcao = $dominio->DomnAcao_Log_Suporte_Alterar;
			
			$businessEntity->gravaLog(strip_tags($_POST['funcionalidade']),$DomnAcao);
			/**
			 * Fim da grava��o do LOG
			 */
			
			if($fluxosVo->getIdFluxos() != '')
			{
				//Gravar uma Nova ordem caso seja altera��o
				$idOrdens = explode(";",rawurldecode($_POST['idsOrdem']));
				$i = 1;
				foreach ($idOrdens as $ordem)
				{
					//Pega o Id
					$fluxosVo_ordem = new FluxosVo();
					$fluxosVo_ordem->setIdFluxos($ordem);
					//Pega o Registro Completo
					$collVo_Ordem = self::pesquisarFluxos($fluxosVo_ordem);
					
					$fluxosVo_ordem = (object) $collVo_Ordem[0];
					//Seta a Ordem
					$fluxosVo_ordem->setOrdemFluxos($i);
					
					//Inicia Processo de Grava��o
					$businessEntity->cadastrarFluxos($fluxosVo_ordem);
					$i++;
				}
			}
			
			echo "1";
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
		}
	}
	
	public function mostraFluxosGrupoSelecionadoProjetos(FluxosVo $fluxosVo)
	{
		$dominio = new Dominio();
		$this->collVo = self::pesquisarFluxos($fluxosVo);
		$papelOrigem = '';
		$papelDestinatario = '';
		
		echo '	<table width="95%" border="0" cellpadding="1" cellspacing="0" class="tabelaListagem" align="center">
				<tr>
					<td class="tituloListagem">Ordem do Fluxo</td>
					<td class="tituloListagem">Papel de Origem</td>
					<td class="tituloListagem">Papel de Destinat�rio</td>
				</tr>';
		
		if(!is_null($this->collVo))
		{
			
			for($i = 0; $i < count($this->collVo); $i++)
			{
				$fluxosVo = (object) $this->collVo[$i];
				
				// Buscar o nome do Papel Origem
				$papeisVo = new PapeisVo();
				$controlaPapeis = new Controla_Papeis();
				if($fluxosVo->getIdPapeisOrigem() == $dominio->DomnPapel_Usuario)
				{
					$papeisVo->setIdPapeis($fluxosVo->getIdPapeisOrigem());
					$papelOrigem = $dominio->DomnPapel_Usuario_TXT;
				}
				else 
				{
					$papeisVo->setIdPapeis($fluxosVo->getIdPapeisOrigem());
					$collVo = $controlaPapeis->pesquisarPapeis($papeisVo);
					$papeisVo = (object) $collVo[0];
					$papelOrigem = $papeisVo->getNomePapeis();
				}
				// Buscar o nome do Papel Destinat�rio
				$papeisVo = new PapeisVo();
				$controlaPapeis = new Controla_Papeis();
				if($fluxosVo->getIdPapeisDestinatario() == $dominio->DomnPapel_Usuario)
				{
					$papeisVo->setIdPapeis($fluxosVo->getIdPapeisOrigem());
					$papelOrigem = $dominio->DomnPapel_Usuario_TXT;
				}
				else 
				{
					$papeisVo->setIdPapeis($fluxosVo->getIdPapeisDestinatario());
					$collVo = $controlaPapeis->pesquisarPapeis($papeisVo);
					$papeisVo = (object) $collVo[0];
					$papelDestinatario = $papeisVo->getNomePapeis();
				}
							
				$classCss = ($i%2==0) ? "linhaListagem" : "linha2Listagem";
				echo '
						<tr class="'.$classCss.'">
							<td>'.$fluxosVo->getOrdemFluxos().'</td>
							<td>'.$papelOrigem.'</td>
							<td>'.$papelDestinatario.'</td>
						</tr>';
			}
		}
		else 
		{
			echo '
				<tr class="linhaListagem">
				<td colspan="2">N�o existe Fluxos para este grupo.</td>
				</tr>
			';
		}
		echo '</table>';
	}
}
?>