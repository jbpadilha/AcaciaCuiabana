<?php
//####################################
// * João Batista Padilha e Silva Analista/Desenvolvedor (Ábaco Tecnologia)
// * Arquivo: Controla_TabelaBasica.php
// * Criação: João Batista Padilha e Silva
// * Revisão: 
// * Data de criação: 10/07/2008
//####################################

require_once("TabelaBasicaVo.php");

/**
 * Classe de Controle das Papeis do Sistema
 * @author João Batista Padilha e Silva
 */
class Controla_TabelaBasica
{
	private $collVo = null;
	
	/**
	 * Método para buscar todos os papeis do sistema
	 * @author João Batista Padilha e Silva
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
	 * Método que mostra a tabela Basica do Sistema
	 * @author João Batista Padilha e Silva
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
					<td>Tabela Básica</td>
					<td style="width:2%;">
					<a href="javascript:void(0);" onClick="carregaPagina(\'viewTabelaBasica.php?cadastro=true&idTabelaBasica='.$tabelaBasicaVo->getIdTabelaBasica().'\',\'formulario\');" title="Editar Tabela Básica">
					<img src="imagens/alterar.jpg" alt="Editar Tabela Básica" style="border:0;" />
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
				<td colspan="2">Tabela Básica não cadastrados.</td>
				</tr>
			';
		}
	}
	
	/**
	 * Método para cadastrar Tabela Básica
	 * @author João Batista Padilha e Silva
	 * @param TabelaBasicaVo $tabelaBasicaVo
	 */
	public function cadastraTabelaBasica(TabelaBasicaVo $tabelaBasicaVo)
	{
		$businessEntity = new BusinessEntity();
		try 
		{
			$businessEntity->cadastrarTabelaBasica($tabelaBasicaVo);
			
			/**
			 * Gravação do LOG
			 */
			$dominio = new Dominio();
			if ($tabelaBasicaVo->getIdTabelaBasica() == '')
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
	
}
?>
