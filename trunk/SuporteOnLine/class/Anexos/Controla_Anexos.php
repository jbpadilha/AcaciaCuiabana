<?php
//####################################
// * Rafael Henrique Vieira de Moura / Desenvolvedor (Ábaco Tecnologia)
// * Arquivo: Controla_Anexos.php
// * Criação: Rafael Henrique Vieira de Moura
// * Revisão:
// * Data de criação: 11/07/2008

require("AnexosVo.php");

/**
 * Classe de controle de Anexos
 * @author Rafael Henrique Vieira de Moura
 */
class Controla_Anexos
{
	private $collVo = null;
	
	/**
	 * Método para pesquisa de Anexos
	 * @author Rafael Henrique Vieira de Moura
	 * @param AnexosVo $anexosVo
	 * @return Array $this->collVo
	 */
	public function pesquisaAnexos(AnexosVo $anexosVo)
	{
		$businessEntity = new BusinessEntity();
		
		if ($anexosVo->getNomeAnexos() != '')
		{
			$anexosVo->setParametroConsulta("WHERE nomeAnexos LIKE '%{$anexosVo->getNomeAnexos()}%' ");
		}
		
		$anexosVo->setParametroConsulta($anexosVo->getParametroConsulta()."ORDER BY dataInclusaoAnexos DESC");
		
		try 
		{
			$this->collVo = $businessEntity->pesquisarAnexos($anexosVo);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
		
		return $this->collVo;
	}
	
	/**
	 * Método para mostrar listagem de Anexos
	 * @author Rafael Henrique Vieira de Moura
	 * @param AnexosVo $anexosVo
	 */
	public function mostraListaAnexos(AnexosVo $anexosVo)
	{
		$this->collVo = self::pesquisaAnexos($anexosVo);
		
		echo '<table width="95%" border="0" cellpadding="1" cellspacing="0" class="tabelaListagem" align="center">
				<tr>
					<td class="tituloListagem">Nome</td>
					<td class="tituloListagem" colspan="2">Data</td>
				</tr>';
		if(!is_null($this->collVo))
		{
			for($i = 0; $i < count($this->collVo); $i++)
			{
				$anexosVo = (object) $this->collVo[$i];
				$classCss = ($i%2==0) ? "linhaListagem" : "linha2Listagem";
				$converte = new FormataData();
				echo '
					<tr class="'.$classCss.'">
					<td>'.$anexosVo->getNomeAnexos().'</td>
					<td>'.$converte->toViewDate($anexosVo->getDataInclusaoAnexos()).'</td>
					<td style="width:2%;">
					<a href="javascript:void(0)" onclick="carregaPagina(\'viewAnexos.php?cadastro=true&id='.$anexosVo->getIdAnexos().'\',\'formulario\')" title="Editar Anexo">
					<img src="imagens/alterar.jpg" alt="Editar Anexo" style="border:0;" />
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
			<td colspan="3" align="center">Nenhum Anexo encontrado.</td>
			</tr>
			';
		}
		echo '</table>';
	}
	
	/**
	 * Método para cadastro de anexo
	 * @author Rafael Henrique Vieira de Moura
	 * @param AnexosVo $anexosVo
	 */
	public function cadastrarAnexos(AnexosVo $anexosVo)
	{
		$businessEntity = new BusinessEntity();
		
		try 
		{
			/*if ($anexosVo->getIdAnexos() != '' && isset($_FILES['arquivoAnexos']['tmp_name'])) {
				$businessEntity->deletarArquivoAnexos($anexosVo);
				$caminhoAnexos = $businessEntity->uploadArquivoAnexos($_FILES['arquivoAnexos']);
				$anexosVo->setCaminhoAnexos($caminhoAnexos);
			} elseif ($anexosVo->getIdAnexos() == '') {*/
			$caminhoAnexos = $businessEntity->uploadArquivoAnexos($_FILES['arquivoAnexo']);
			$anexosVo->setCaminhoAnexos($caminhoAnexos);
			//}
			$businessEntity->cadastrarAnexos($anexosVo);
				
			/**
			 * Gravação do LOG
			 */
			$dominio = new Dominio();
			if ($anexosVo->getIdAnexos() == '')
				$DomnAcao = $dominio->DomnAcao_Log_Suporte_Incluir;
			else 
				$DomnAcao = $dominio->DomnAcao_Log_Suporte_Alterar;
			
			$businessEntity->gravaLog(strip_tags($_POST['funcionalidade']),$DomnAcao);
			/**
			 * Fim da gravação do LOG
			 */
			
			echo '1';
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
		}
	}
	
	/**
	 * Método de cadastramento de Anexos à partir do Pedido Criado
	 * @author João Batista Padilha e Silva
	 * @param AnexosVo $anexosVo
	 * @return int $ultimoIdInserido
	 */
	public function cadastrarAnexosPedidos(AnexosVo $anexosVo)
	{
		$businessEntity = new BusinessEntity();
		
		try 
		{
			$caminhoAnexos = $businessEntity->uploadArquivoAnexos($_FILES['arquivoAnexo']);
			$anexosVo->setCaminhoAnexos($caminhoAnexos);
			$idAnexo = $businessEntity->cadastrarAnexos($anexosVo);

			return $idAnexo;
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
		}
		return $idAnexo;
	}
}
?>