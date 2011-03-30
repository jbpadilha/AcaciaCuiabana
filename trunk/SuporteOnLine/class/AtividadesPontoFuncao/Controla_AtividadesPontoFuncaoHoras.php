<?php
//####################################
// * João Batista Padilha e Silva Analista/Desenvolvedor (Ábaco Tecnologia)
// * Arquivo: Controla_AtividadesPontoFuncaoHoras.php
// * Criação: João Batista Padilha e Silva
// * Revisão: 
// * Data de criação: 11/07/2008
//####################################
require_once("AtividadesPontoFuncaoHorasVo.php");

/**
 * Classe de Controle de Atividades do Sistema
 * @author João Batista Padilha e Silva
 */
class Controla_AtividadesPontoFuncaoHoras
{
	private $collVo = null;
		
	/**
	 * Método de busca de Atividades Ponto Função Horas
	 * @author João Batista Padilha e Silva
	 * @param AtividadesPontoFuncaoHorasVo $atividadesVo
	 * @return $collVo
	 */
	public function pesquisarAtividades(AtividadesPontoFuncaoHorasVo $atividadesVo)
	{
		try 
		{
			$businessEntity = new BusinessEntity();
			$this->collVo = $businessEntity->pesquisarAtividades($atividadesVo);
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
		}
		return $this->collVo;
	}
	
	
	/**
	 * Método de retorno da pesquisa de Atividades Ponto Função Horas
	 * @author João Batista Padilha e Silva
	 * @param AtividadesPontoFuncaoHorasVo $atividadesVo
	 */
	public function mostraAtividadesPesquisa(AtividadesPontoFuncaoHorasVo $atividadesVo)
	{
		$this->collVo = self::pesquisarAtividades($atividadesVo);
		
		echo '	<table width="95%" border="0" cellpadding="1" cellspacing="0" class="tabelaListagem" align="center">
				<tr>
					<td class="tituloListagem">Nome da Atividade</td>
					<td class="tituloListagem" colspan="2">Tecnologia</td>
				</tr>';
		
		if(!is_null($this->collVo))
		{
			
			for($i = 0; $i < count($this->collVo); $i++)
			{
				$atividadesVo = (object) $this->collVo[$i];
				
				// Busca o Nome da tecnologia
				$controlaTecnologias = new Controla_Tecnologias();
				$tecnologiasVo = new TecnologiasVo();
				$tecnologiasVo->setIdTecnologias($atividadesVo->getIdTecnologias());
				$collVo_Tecnologias = $controlaTecnologias->pesquisarTecnologias($tecnologiasVo);
				$tecnologiasVo = (object) $collVo_Tecnologias[0];
								
				$classCss = ($i%2==0) ? "linhaListagem" : "linha2Listagem";
				echo '
						<tr class="'.$classCss.'">
							<td>'.$atividadesVo->getNomeAtividadesPontoFuncaoHoras().'</td>
							<td>'.$tecnologiasVo->getNomeTecnologias().'</td>
							<td style="width:2%;">
								<a href="javascript:void(0);" onClick="carregaPagina(\'viewAtividadesPontoFuncaoHoras.php?cadastro=true&idAtividades='.$atividadesVo->getIdAtividadePontoFuncaoHoras().'\',\'formulario\');" title="Editar Versão '.$atividadesVo->getNomeAtividadesPontoFuncaoHoras().'">
									<img src="imagens/alterar.jpg" alt="Editar Atividade '.$atividadesVo->getNomeAtividadesPontoFuncaoHoras().'" style="border:0;" />
								</a>
							</td>
						</tr>';
			}
		}
		else 
		{
			echo '
				<tr class="linhaListagem">
				<td colspan="2">Atividade não existe.</td>
				</tr>
			';
		}
		echo '</table>';
	}
		
	/**
	 * Método que mostra todas as Atividades do Sistema
	 * @author João Batista Padilha e Silva
	 */
	public function mostraAtividades()
	{
		$atividadesVo = new AtividadesPontoFuncaoHorasVo();
		$this->collVo = self::pesquisarAtividades($atividadesVo);
		
		if(!is_null($this->collVo))
		{
			
			for($i = 0; $i < count($this->collVo); $i++)
			{
				$atividadesVo = (object) $this->collVo[$i];
				
				// Busca o Nome da tecnologia
				$controlaTecnologias = new Controla_Tecnologias();
				$tecnologiasVo = new TecnologiasVo();
				$tecnologiasVo->setIdTecnologias($atividadesVo->getIdTecnologias());
				$collVo_Tecnologias = $controlaTecnologias->pesquisarTecnologias($tecnologiasVo);
				$tecnologiasVo = (object) $collVo_Tecnologias[0];
								
				$classCss = ($i%2==0) ? "linhaListagem" : "linha2Listagem";
				echo '
						<tr class="'.$classCss.'">
							<td>'.$atividadesVo->getNomeAtividadesPontoFuncaoHoras().'</td>
							<td>'.$tecnologiasVo->getNomeTecnologias().'</td>
							<td style="width:2%;">
								<a href="javascript:void(0);" onClick="carregaPagina(\'viewAtividadesPontoFuncaoHoras.php?cadastro=true&idAtividades='.$atividadesVo->getIdAtividadePontoFuncaoHoras().'\',\'formulario\');" title="Editar Versão '.$atividadesVo->getNomeAtividadesPontoFuncaoHoras().'">
									<img src="imagens/alterar.jpg" alt="Editar Atividade '.$atividadesVo->getNomeAtividadesPontoFuncaoHoras().'" style="border:0;" />
								</a>
							</td>
						</tr>';
			}
		}
		else 
		{
			echo '
				<tr class="linhaListagem">
				<td colspan="2">Atividade não existe.</td>
				</tr>
			';
		}
	}
	
	/**
	 * Método que monta o select das Tecnologias para Cadastro de Atividades
	 * @author João Batista Padilha e Silva
	 * @param AtividadesPontoFuncaoHorasVo $atividadesVo
	 * @return var
	 */
	public function montaSelectTecnologias(AtividadesPontoFuncaoHorasVo $atividadesVo)
	{
		$dominio = new Dominio();
		
		$montaSelect = '<select id="selectTecnologias" name="selectTecnologias" class="campo">
									<option value="">'.$dominio->select.'</option>';
		
		$tecnologiasVo = new TecnologiasVo();
		$controlaTecnologias = new Controla_Tecnologias();
		$collVo_Tecnologias = $controlaTecnologias->pesquisarTecnologias($tecnologiasVo);
		
		foreach ($collVo_Tecnologias as $tecnologias)
		{
			$tecnologiasVo = (object) $tecnologias;
			$selected = ($atividadesVo->getIdTecnologias() == $tecnologiasVo->getIdTecnologias())? 'selected="selected"':'';			
			$montaSelect .= '<option value="'.$tecnologiasVo->getIdTecnologias().'" '.$selected.'>'.$tecnologiasVo->getNomeTecnologias().'</option>';
		}
		
		$montaSelect .= '</select>';
		return $montaSelect;
	}
		
	/**
	 * Método para Cadastrar/Alterar Versões de Sistema
	 * @author João Batista Padilha e Silva
	 * @param VersoesVo $versoesVo
	 */
	public function cadastraAtividades(AtividadesPontoFuncaoHorasVo $atividadesVo)
	{
		$businessEntity = new BusinessEntity();
		try 
		{
			$businessEntity->cadastrarAtividades($atividadesVo);
			
			/**
			 * Gravação do LOG
			 */
			$dominio = new Dominio();
			if ($atividadesVo->getIdAtividadePontoFuncaoHoras() == '')
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