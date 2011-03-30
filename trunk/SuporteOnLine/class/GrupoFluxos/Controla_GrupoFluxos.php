<?php
//####################################
// * Jo�o Batista Padilha e Silva Analista/Desenvolvedor (�baco Tecnologia)
// * Arquivo: Controla_GrupoFluxos.php
// * Cria��o: Jo�o Batista Padilha e Silva
// * Revis�o: 
// * Data de cria��o: 11/07/2008
//####################################
require_once("GrupoFluxosVo.php");

/**
 * Classe de Controle das Tecnologias do Sistema
 * @author Jo�o Batista Padilha e Silva
 */
class Controla_GrupoFluxos
{
	private $collVo = null;
	
	/**
	 * M�todo de busca das Grupo de Fluxos
	 * @author Jo�o Batista Padilha e Silva
	 * @param GrupoFluxosVo $grupoFluxosVo
	 * @return $collVo
	 */
	public function pesquisarGrupoFluxos(GrupoFluxosVo $grupoFluxosVo)
	{
		try 
		{
			$businessEntity = new BusinessEntity();
			$this->collVo = $businessEntity->pesquisarGrupoFluxos($grupoFluxosVo);
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
		}
		return $this->collVo;
	}
		
	/**
	 * M�todo de retorno da pesquisa de Grupo de Fluxos - mostra na View
	 * @author Jo�o Batista Padilha e Silva
	 * @param GrupoFluxosVo $grupoFluxosVo
	 */
	public function mostraGrupoFluxosPesquisa(GrupoFluxosVo $grupoFluxosVo)
	{
		$this->collVo = self::pesquisarGrupoFluxos($grupoFluxosVo);
		
		echo '<table width="95%" border="0" cellpadding="1" cellspacing="0" class="tabelaListagem" align="center">
				  <tr>
					<td class="tituloListagem" colspan="2">Nome do Grupo</td>
				  </tr>';
		
		if(!is_null($this->collVo))
		{
			
			for($i = 0; $i < count($this->collVo); $i++)
			{
				$grupoFluxosVo = (object) $this->collVo[$i];
				$classCss = ($i%2==0) ? "linhaListagem" : "linha2Listagem";
				echo '
					<tr class="'.$classCss.'">
					<td>'.$grupoFluxosVo->getNomeGrupoFluxos().'</td>
					<td style="width:2%;">
					<a href="javascript:void(0);" onClick="carregaPagina(\'viewGrupoFluxos.php?cadastro=true&idGrupoFluxos='.$grupoFluxosVo->getIdGrupoFluxos().'\',\'formulario\');" title="Editar Grupo '.$grupoFluxosVo->getNomeGrupoFluxos().'">
					<img src="imagens/alterar.jpg" alt="Editar Grupo '.$grupoFluxosVo->getNomeGrupoFluxos().'" style="border:0;" />
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
				<td colspan="2">Grupo de Fluxos n�o existe.</td>
				</tr>
			';
		}
		echo '</table>';
	}
	
	/**
	 * M�todo que mostra todas os Grupos de Fluxos
	 * @author Jo�o Batista Padilha e Silva
	 */
	public function mostraGrupoFluxos()
	{
		$grupoFluxosVo = new GrupoFluxosVo();
		$this->collVo = self::pesquisarGrupoFluxos($grupoFluxosVo);
		
		if(!is_null($this->collVo))
		{
		
			for($i = 0; $i < count($this->collVo); $i++)
			{
				$grupoFluxosVo = (object) $this->collVo[$i];
				$classCss = ($i%2==0) ? "linhaListagem" : "linha2Listagem";
							
				echo '
					<tr class="'.$classCss.'">
					<td>'.$grupoFluxosVo->getNomeGrupoFluxos().'</td>
					<td style="width:2%;">
					<a href="javascript:void(0);" onClick="carregaPagina(\'viewGrupoFluxos.php?cadastro=true&idGrupoFluxos='.$grupoFluxosVo->getIdGrupoFluxos().'\',\'formulario\');" title="Editar Grupo '.$grupoFluxosVo->getNomeGrupoFluxos().'">
					<img src="imagens/alterar.jpg" alt="Editar Grupo '.$grupoFluxosVo->getNomeGrupoFluxos().'" style="border:0;" />
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
				<td colspan="2">N�o existe Grupo de Fluxos cadastrados.</td>
				</tr>
			';
		}
	}
	
	/**
	 * M�todo para Cadastrar/Alterar Grupo de Fluxos do Sistema
	 * @author Jo�o Batista Padilha e Silva
	 * @param GrupoFluxosVo $grupoFluxosVo
	 */
	public function cadastraGrupoFluxos(GrupoFluxosVo $grupoFluxosVo)
	{
		$businessEntity = new BusinessEntity();
		try 
		{				
			$businessEntity->cadastrarGrupoFluxos($grupoFluxosVo);
			
			/**
			 * Grava��o do LOG
			 */
			$dominio = new Dominio();
			if ($grupoFluxosVo->getIdGrupoFluxos() == '')
				$DomnAcao = $dominio->DomnAcao_Log_Suporte_Incluir;
			else 
				$DomnAcao = $dominio->DomnAcao_Log_Suporte_Alterar;
			
			$businessEntity->gravaLog(strip_tags($_POST['funcionalidade']),$DomnAcao);
			/**
			 * Fim da grava��o do LOG
			 */
			
			echo "1";
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
		}
	}
}
?>
