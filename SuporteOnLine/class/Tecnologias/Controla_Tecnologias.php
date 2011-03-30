<?php
//####################################
// * Jo�o Batista Padilha e Silva Analista/Desenvolvedor (�baco Tecnologia)
// * Arquivo: Controla_Tecnologias.php
// * Cria��o: Jo�o Batista Padilha e Silva
// * Revis�o: 
// * Data de cria��o: 11/07/2008
//####################################
require_once("TecnologiasVo.php");

/**
 * Classe de Controle das Tecnologias do Sistema
 * @author Jo�o Batista Padilha e Silva
 */
class Controla_Tecnologias
{
	private $collVo = null;
	
	/**
	 * M�todo de busca das Tecnologias
	 * @author Jo�o Batista Padilha e Silva
	 * @param TecnologiasVo $tecnologiasVo
	 * @return $collVo
	 */
	public function pesquisarTecnologias(TecnologiasVo $tecnologiasVo)
	{
		try 
		{
			$businessEntity = new BusinessEntity();
			$this->collVo = $businessEntity->pesquisarTecnologias($tecnologiasVo);
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
		}
		return $this->collVo;
	}
		
	/**
	 * M�todo de retorno da pesquisa de Tecnologias
	 * @author Jo�o Batista Padilha e Silva
	 * @param TecnologiasVo $tecnologiasVo
	 */
	public function mostraTecnologiasPesquisa(TecnologiasVo $tecnologiasVo)
	{
		$this->collVo = self::pesquisarTecnologias($tecnologiasVo);
		
		echo '<table width="95%" border="0" cellpadding="1" cellspacing="0" class="tabelaListagem" align="center">
				  <tr>
					<td class="tituloListagem" colspan="2">Nome da Tecnologia</td>
				  </tr>';
		
		if(!is_null($this->collVo))
		{
			
			for($i = 0; $i < count($this->collVo); $i++)
			{
				$tecnologiasVo = (object) $this->collVo[$i];
				$classCss = ($i%2==0) ? "linhaListagem" : "linha2Listagem";
				echo '
					<tr class="'.$classCss.'">
					<td>'.$tecnologiasVo->getNomeTecnologias().'</td>
					<td style="width:2%;">
					<a href="javascript:void(0);" onClick="carregaPagina(\'viewTecnologias.php?cadastro=true&idTecnologias='.$tecnologiasVo->getIdTecnologias().'\',\'formulario\');" title="Editar Tecnologia '.$tecnologiasVo->getNomeTecnologias().'">
					<img src="imagens/alterar.jpg" alt="Editar Tecnologia '.$tecnologiasVo->getNomeTecnologias().'" style="border:0;" />
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
				<td colspan="2">Tecnologia n�o existe.</td>
				</tr>
			';
		}
		echo '</table>';
	}
	
	/**
	 * M�todo que mostra todas as Tecnologias
	 * @author Jo�o Batista Padilha e Silva
	 */
	public function mostraTecnologias()
	{
		$tecnologiasVo = new TecnologiasVo();
		$this->collVo = self::pesquisarTecnologias($tecnologiasVo);
		
		if(!is_null($this->collVo))
		{
		
			for($i = 0; $i < count($this->collVo); $i++)
			{
				$tecnologiasVo = (object) $this->collVo[$i];
				$classCss = ($i%2==0) ? "linhaListagem" : "linha2Listagem";
							
				echo '
					<tr class="'.$classCss.'">
					<td>'.$tecnologiasVo->getNomeTecnologias().'</td>
					<td style="width:2%;">
					<a href="javascript:void(0);" onClick="carregaPagina(\'viewTecnologias.php?cadastro=true&idTecnologias='.$tecnologiasVo->getIdTecnologias().'\',\'formulario\');" title="Editar Tecnologia '.$tecnologiasVo->getNomeTecnologias().'">
					<img src="imagens/alterar.jpg" alt="Editar Tecnologia '.$tecnologiasVo->getNomeTecnologias().'" style="border:0;" />
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
				<td colspan="2">N�o existe Tecnologias cadastradas.</td>
				</tr>
			';
		}
	}
	
	/**
	 * M�todo para Cadastrar/Alterar Tecnologias no Sistema
	 * @author Jo�o Batista Padilha e Silva
	 * @param TecnologiasVo $tecnologiasVo
	 */
	public function cadastraTecnologia(TecnologiasVo $tecnologiasVo)
	{
		$businessEntity = new BusinessEntity();
		try 
		{				
			$businessEntity->cadastrarTecnologias($tecnologiasVo);
			
			/**
			 * Grava��o do LOG
			 */
			$dominio = new Dominio();
			if ($tecnologiasVo->getIdTecnologias() == '')
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
