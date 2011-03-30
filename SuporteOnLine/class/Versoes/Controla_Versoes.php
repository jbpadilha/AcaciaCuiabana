<?php
//####################################
// * João Batista Padilha e Silva Analista/Desenvolvedor (Ábaco Tecnologia)
// * Arquivo: Controla_Versoes.php
// * Criação: João Batista Padilha e Silva
// * Revisão: 
// * Data de criação: 11/07/2008
//####################################
require_once("VersoesVo.php");

/**
 * Classe de Controle das Versões de Sistema
 * @author João Batista Padilha e Silva
 */
class Controla_Versoes
{
	private $collVo = null;
		
	/**
	 * Método de busca de Versões
	 * @author João Batista Padilha e Silva
	 * @param VersoesVo $versoesVo
	 * @return $collVo
	 */
	public function buscaVersoes(VersoesVo $versoesVo)
	{
		try 
		{
			$businessEntity = new BusinessEntity();
			$this->collVo = $businessEntity->pesquisarVersoes($versoesVo);
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
		}
		return $this->collVo;
	}
	
	/**
	 * Método de retorno da pesquisa de Versões
	 * @author João Batista Padilha e Silva
	 * @param VersoesVo $versoesVo
	 */
	public function mostraVersoesPesquisa(VersoesVo $versoesVo)
	{
		$formataData = new FormataData();
		$this->collVo = self::buscaVersoes($versoesVo);
		
		echo '<table width="95%" border="0" cellpadding="1" cellspacing="0" class="tabelaListagem" align="center">
				  <tr>
					<td class="tituloListagem">Nome da Versão</td>
					<td class="tituloListagem">Data da Entrega</td>
					<td class="tituloListagem">Entrega para Cliente</td>
					<td class="tituloListagem" colspan="2">Projeto</td>
				  </tr>';
		
		if(!is_null($this->collVo))
		{
			
			for($i = 0; $i < count($this->collVo); $i++)
			{
				$versoesVo = (object) $this->collVo[$i];
				$classCss = ($i%2==0) ? "linhaListagem" : "linha2Listagem";
				
				$projetosVo = new  ProjetosVo();
				$controlaProjetos = new Controla_Projetos();
				$projetosVo->setIdProjetos($versoesVo->getIdProjetos());
				$collVo_Projetos = $controlaProjetos->pesquisarProjetos($projetosVo);
				$projetosVo = (object) $collVo_Projetos[0];
				
				echo '
					 <tr class="'.$classCss.'">
					 <td>'.$versoesVo->getNomeVersoes().'</td>
					 <td>'.$formataData->toViewDate($versoesVo->getDataEntregaVersoes()).'</td>
					 <td>'.$formataData->toViewDate($versoesVo->getDataEntregaVersoesClientes()).'</td>
					 <td>'.$projetosVo->getNomeProjetos().'</td>
					 <td style="width:2%;">';
				
				if((str_replace("-","",$versoesVo->getDataEntregaVersoes())) >= date("Ymd"))
				{
					echo '<a href="javascript:void(0);" onClick="carregaPagina(\'viewVersoes.php?cadastro=true&idVersoes='.$versoesVo->getIdVersoes().'\',\'formulario\');" title="Editar Versão '.$versoesVo->getNomeVersoes().'">
						  	<img src="imagens/alterar.jpg" alt="Editar Versões '.$versoesVo->getNomeVersoes().'" style="border:0;" />
						  </a>';
				}
				else 
				{
					echo '<a href="javascript:void(0);" onClick="carregaPagina(\'viewVersoes.php?cadastro=true&visualizar=true&idVersoes='.$versoesVo->getIdVersoes().'\',\'formulario\');" title="Editar Versão '.$versoesVo->getNomeVersoes().'">
						  	<img src="imagens/ico_localizar.gif" alt="Editar Versões '.$versoesVo->getNomeVersoes().'" style="border:0;" />
						  </a>';
				}
				echo '</td>
					  </tr>';
			}
		}
		else 
		{
			echo '
				<tr class="linhaListagem">
				<td colspan="2">Versão não encontrada.</td>
				</tr>
			';
		}
		echo '</table>';
	}
		
	/**
	 * Método que mostra todas as Tecnologias
	 * @author João Batista Padilha e Silva
	 */
	public function mostraVersoes()
	{
		$versoesVo = new VersoesVo();
		$formataData = new FormataData();
		$this->collVo = self::buscaVersoes($versoesVo);
		
		if(!is_null($this->collVo))
		{
		
			for($i = 0; $i < count($this->collVo); $i++)
			{
				$versoesVo = (object) $this->collVo[$i];
				$classCss = ($i%2==0) ? "linhaListagem" : "linha2Listagem";
				
				$projetosVo = new  ProjetosVo();
				$controlaProjetos = new Controla_Projetos();
				$projetosVo->setIdProjetos($versoesVo->getIdProjetos());
				$collVo_Projetos = $controlaProjetos->pesquisarProjetos($projetosVo);
				$projetosVo = (object) $collVo_Projetos[0];
				
				echo '
					 <tr class="'.$classCss.'">
					 <td>'.$versoesVo->getNomeVersoes().'</td>
					 <td>'.$formataData->toViewDate($versoesVo->getDataEntregaVersoes()).'</td>
					 <td>'.$formataData->toViewDate($versoesVo->getDataEntregaVersoesClientes()).'</td>
					 <td>'.$projetosVo->getNomeProjetos().'</td>
					 <td style="width:2%;">';
				
				if((str_replace("-","",$versoesVo->getDataEntregaVersoes())) >= date("Ymd"))
				{
					echo '<a href="javascript:void(0);" onClick="carregaPagina(\'viewVersoes.php?cadastro=true&idVersoes='.$versoesVo->getIdVersoes().'\',\'formulario\');" title="Editar Versão '.$versoesVo->getNomeVersoes().'">
						  	<img src="imagens/alterar.jpg" alt="Editar Versões '.$versoesVo->getNomeVersoes().'" style="border:0;" />
						  </a>';
				}
				else 
				{
					echo '<a href="javascript:void(0);" onClick="carregaPagina(\'viewVersoes.php?cadastro=true&visualizar=true&idVersoes='.$versoesVo->getIdVersoes().'\',\'formulario\');" title="Editar Versão '.$versoesVo->getNomeVersoes().'">
						  	<img src="imagens/ico_localizar.gif" alt="Editar Versões '.$versoesVo->getNomeVersoes().'" style="border:0;" />
						  </a>';
				}
				echo '</td>
					  </tr>';
			}
		}
		else 
		{
			echo '
				<tr class="linhaListagem">
				<td colspan="5">Não existe Versões cadastrados.</td>
				</tr>
			';
		}
	}
	
	/**
	 * Método que monta o select dos Anexos para a versão. Caso seja apenas visualização, não aparecer outros anexos à não ser o escolhido
	 *
	 * @param VersoesVo $versoesVo
	 * @param var $visualizar
	 * @return var
	 */
	public function montaSelectAnexos(VersoesVo $versoesVo, $visualizar = '')
	{
		$dominio = new Dominio();
		
		//Busca todos os Anexos Existentes
		$controlaAnexos = new Controla_Anexos();
		$anexosVo = new AnexosVo();
		$collVo_Anexos = $controlaAnexos->pesquisaAnexos($anexosVo);
		
		$montaSelect = '<select id="selectAnexos" name="selectAnexos" class="campo">
									<option value="">'.$dominio->select.'</option>';
		
		if($versoesVo->getIdAnexos() != '')
		{		
			if($visualizar == '')
			{
				if($collVo_Anexos != null)
				{
					foreach ($collVo_Anexos as $anexos)
					{
						$anexosVo = (object)$anexos;
						$selected = ($versoesVo->getIdAnexos() == $anexosVo->getIdAnexos())?'selected="selected"':'';
						$montaSelect .='<option value="'.$anexosVo->getIdAnexos().'" '.$selected.'>'.$anexosVo->getNomeAnexos().'</option>\n';
					}
				}
			}
			else 
			{
				if($collVo_Anexos != null)
				{
					foreach ($collVo_Anexos as $anexos)
					{
						$anexosVo = (object)$anexos;
						if($versoesVo->getIdAnexos() == $anexosVo->getIdAnexos())
							$montaSelect .='<option value="'.$anexosVo->getIdAnexos().'">'.$anexosVo->getNomeAnexos().'</option>\n';
					}
				}
			}
		}
		else 
		{
			if($collVo_Anexos != null)
			{
				foreach ($collVo_Anexos as $anexos)
				{
					$anexosVo = (object)$anexos;
					$montaSelect .='<option value="'.$anexosVo->getIdAnexos().'">'.$anexosVo->getNomeAnexos().'</option>\n';
				}
			}
		}
		$montaSelect .= '</select>';
		return $montaSelect;
	}
		
	/**
	 * Método para Cadastrar/Alterar Versões de Sistema
	 * @author João Batista Padilha e Silva
	 * @param VersoesVo $versoesVo
	 */
	public function cadastraVersoes(VersoesVo $versoesVo)
	{
		$businessEntity = new BusinessEntity();
		try 
		{
			$businessEntity->cadastrarVersoes($versoesVo);
			
			/**
			 * Gravação do LOG
			 */
			$dominio = new Dominio();
			if ($versoesVo->getIdAnexos() == '')
				$DomnAcao = $dominio->DomnAcao_Log_Suporte_Incluir;
			else 
				$DomnAcao = $dominio->DomnAcao_Log_Suporte_Alterar;
			
			$businessEntity->gravaLog(strip_tags($_POST['funcionalidade']),$DomnAcao);
			/**
			 * Fim da gravação do LOG
			 */
			
			echo "1";
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
		}
	}
	
	/**
	 * Método para montar html do combo de projetos 
	 * @author Rafael Henrique Vieira de Moura
	 * @param VersoesVo $versoesVo
	 * @param string $visualizar
	 * @return string $montaSelect
	 */
	public function montaSelectProjetos(VersoesVo $versoesVo,$visualizar = '')
	{
		$dominio = new Dominio();
		
		//Busca todos os Projetos Existentes
		$projetosVo = new ProjetosVo();
		$controlaProjetos = new Controla_Projetos();
		$collVo_Projetos = $controlaProjetos->pesquisarProjetos($projetosVo);
		
		$montaSelect = '<select id="idProjetos" name="idProjetos" class="campo">
									<option value="">'.$dominio->select.'</option>';
		
		if($versoesVo->getIdProjetos() != '')
		{		
			if($visualizar == '')
			{
				if($collVo_Projetos != null)
				{
					foreach ($collVo_Projetos as $projetos)
					{
						$projetosVo = (object) $projetos;
						$selected = ($versoesVo->getIdProjetos() == $projetosVo->getIdProjetos())?'selected="selected"':'';
						$montaSelect .='<option value="'.$projetosVo->getIdProjetos().'" '.$selected.'>'.$projetosVo->getNomeProjetos().'</option>\n';
					}
				}
			}
			else 
			{
				if($collVo_Projetos != null)
				{
					foreach ($collVo_Projetos as $projetos)
					{
						$projetosVo = (object) $projetos;
						if($versoesVo->getIdProjetos() == $projetosVo->getIdProjetos())
							$montaSelect .='<option value="'.$projetosVo->getIdProjetos().'">'.$projetosVo->getNomeProjetos().'</option>\n';
					}
				}
			}
		}
		else 
		{
			if($collVo_Projetos != null)
			{
				foreach ($collVo_Projetos as $projetos)
				{
					$projetosVo = (object) $projetos;
					$montaSelect .='<option value="'.$projetosVo->getIdProjetos().'">'.$projetosVo->getNomeProjetos().'</option>\n';
				}
			}
		}
		$montaSelect .= '</select>';
		return $montaSelect;
	}
}
?>