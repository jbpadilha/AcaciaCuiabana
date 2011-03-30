<?php
//####################################
// * Jo�o Batista Padilha e Silva Analista/Desenvolvedor (�baco Tecnologia)
// * Arquivo: Controla_TabelaBasica.php
// * Cria��o: Jo�o Batista Padilha e Silva
// * Revis�o: 
// * Data de cria��o: 10/07/2008
//####################################

require_once("TabelaBasicaVo.php");

/**
 * Classe de Controle das Papeis do Sistema
 * @author Jo�o Batista Padilha e Silva
 */
class Controla_TabelaBasica
{
	private $collVo = null;
	
	/**
	 * M�todo para buscar todos os papeis do sistema
	 * @author Jo�o Batista Padilha e Silva
	 * @param PapeisVo $papeisVo
	 */
	public function pesquisaTabelaBasica(TabelaBasicaVo $tabelaBasicaVo)
	{
		$businessEntity = new BusinessEntity();
		try 
		{
			$this->collVo = $businessEntity->pesquisarTabelaBasica($tabelaBasicaVo);
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
		}
		return $this->collVo;
	}
	
	/**
	 * M�todo que mostra a tabela Basica do Sistema
	 * @author Jo�o Batista Padilha e Silva
	 */
	public function mostraTabelaBasica(TabelaBasicaVo $tabelaBasicaVo)
	{
		$this->collVo = self::pesquisaTabelaBasica($tabelaBasicaVo);
		
		if(!is_null($this->collVo))
		{
		
			for($i = 0; $i < count($this->collVo); $i++)
			{
				$tabelaBasicaVo = (object) $this->collVo[$i];
				$classCss = ($i%2==0) ? "linhaListagem" : "linha2Listagem";
				echo '
					<tr class="'.$classCss.'">
					<td>Tabela B�sica</td>
					<td style="width:2%;">
					<a href="javascript:void(0);" onClick="carregaPagina(\'viewTabelaBasica.php?cadastro=true&idTabelaBasica='.$tabelaBasicaVo->getIdTabelaBasica().'\',\'formulario\');" title="Editar Tabela B�sica">
					<img src="imagens/alterar.jpg" alt="Editar Tabela B�sica" style="border:0;" />
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
				<td colspan="2">Tabela B�sica n�o cadastrados.</td>
				</tr>
			';
		}
	}
	
	/**
	 * M�todo para cadastrar Tabela B�sica
	 * @author Jo�o Batista Padilha e Silva
	 * @param TabelaBasicaVo $tabelaBasicaVo
	 */
	public function cadastraTabelaBasica(TabelaBasicaVo $tabelaBasicaVo)
	{
		$businessEntity = new BusinessEntity();
		try 
		{
			$businessEntity->cadastrarTabelaBasica($tabelaBasicaVo);
			
			/**
			 * Grava��o do LOG
			 */
			$dominio = new Dominio();
			if ($tabelaBasicaVo->getIdTabelaBasica() == '')
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
