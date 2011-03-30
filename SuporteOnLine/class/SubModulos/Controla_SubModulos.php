<?php
//####################################
// * Rafael Henrique Vieira de Moura / Desenvolvedor (�baco Tecnologia)
// * Arquivo: Controla_Usuarios.php
// * Cria��o: Rafael Henrique Vieira de Moura
// * Revis�o:
// * Data de cria��o: 10/07/2008
//####################################

require("SubModulosVo.php");

/**
 * Classe de controle de SubM�dulos dos M�dulos de Projetos
 * @author Rafael Henrique Vieira de Moura
 */
class Controla_SubModulos{
	private $collVo = null;
	
	/**
	 * M�todo para pesquisa de SubModulos
	 * @author Rafael H. V. Moura
	 * @param SubModulosVo $subModulosVo
	 * @return array $this->collVo
	 */
	public function pesquisaSubModulos(SubModulosVo $subModulosVo)
	{
		$businessEntity = new BusinessEntity();
		
		if ($subModulosVo->getIdSubModulos() != '')
		{
			$subModulosVo->setParametroConsulta("WHERE idSubModulos = '{$subModulosVo->getIdSubModulos()}'");
		}
		elseif ($subModulosVo->getNomeSubModulos() != '')
		{
			$subModulosVo->setParametroConsulta("WHERE nomeSubModulos LIKE '%{$subModulosVo->getNomeSubModulos()}%'");
		}
		
		try 
		{
			$this->collVo = $businessEntity->pesquisarSubModulos($subModulosVo);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
		
		return $this->collVo;
	}
	
	/**
	 * M�todo para mostrar listagem de SubModulos cadastrados
	 * @author Rafael Henrique V. Moura
	 * @param SubModulosVo $subModulosVo
	 */
	public function mostraListaSubModulos(SubModulosVo $subModulosVo)
	{
		$this->collVo = self::pesquisaSubModulos($subModulosVo);
		
		echo '<table width="95%" border="0" cellpadding="1" cellspacing="0" class="tabelaListagem" align="center">
				<tr>
					<td class="tituloListagem" colspan="2">Nome</td>
				</tr>';
		if(!is_null($this->collVo))
		{
			for($i = 0; $i < count($this->collVo); $i++)
			{
				$subModulosVo = (object) $this->collVo[$i];
				$classCss = ($i%2==0) ? "linhaListagem" : "linha2Listagem";
								
				echo '
					<tr class="'.$classCss.'">
					<td>'.$subModulosVo->getNomeSubModulos().'</td>
					<td style="width:2%;">
					<a href="javascript:void(0)" onclick="carregaPagina(\'viewSubModulos.php?cadastro=true&id='.$subModulosVo->getIdSubModulos().'\',\'formulario\')" title="Editar cadastro do SubM�dulo '.$subModulosVo->getNomeSubModulos().'">
					<img src="imagens/alterar.jpg" alt="Editar cadastro do SubM�dulo '.$subModulosVo->getNomeSubModulos().'" style="border:0;" />
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
			<td colspan="2" align="center">Nenhum SubM�dulo encontrado.</td>
			</tr>
			';
		}
		echo '</table>';
	}
	
	/**
	 * M�todo para cadastro de SubModulos
	 * @author Rafael Henrique Vieira de Moura
	 * @param SubModulosVo $subModulosVo
	 */
	public function cadastrarSubModulos(SubModulosVo $subModulosVo)
	{
		$businessEntity = new BusinessEntity();
		
		try 
		{
			$businessEntity->cadastrarSubModulos($subModulosVo);
			
			/**
			 * Grava��o do LOG
			 */
			$dominio = new Dominio();
			if ($subModulosVo->getIdSubModulos() == '')
				$DomnAcao = $dominio->DomnAcao_Log_Suporte_Incluir;
			else 
				$DomnAcao = $dominio->DomnAcao_Log_Suporte_Alterar;
			
			$businessEntity->gravaLog(strip_tags($_POST['funcionalidade']),$DomnAcao);
			/**
			 * Fim da grava��o do LOG
			 */
			
			echo '1';
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
		}
	}
	
	/**
	 * M�todo para mostrar listagem de SubM�dulos
	 * @author Rafael Henrique Vieira de Moura
	 */
	public function mostraSelecionarSubModulos()
	{
		$subModulosVo = new SubModulosVo();
		$this->collVo = self::pesquisaSubModulos($subModulosVo);
		
		if(!is_null($this->collVo))
		{
		
			for($i = 0; $i < count($this->collVo); $i++)
			{
				$subModulosVo = (object) $this->collVo[$i];
				$classCss = ($i%2==0) ? "linhaListagem" : "linha2Listagem";
											
				echo '
					<tr class="'.$classCss.'">
						<td><input type="checkbox" name="'.$subModulosVo->getIdSubModulos().'" id="'.$subModulosVo->getIdSubModulos().'" value="'.$subModulosVo->getIdSubModulos()."&".$subModulosVo->getNomeSubModulos().'" /></td>
						<td>'.$subModulosVo->getNomeSubModulos().'</td>
					</tr>
				';
			}
		}
		else 
		{
			echo '
				<tr class="linhaListagem">
				<td colspan="2">N�o existe Sub-M�dulos cadastrados.</td>
				</tr>
			';
		}
	}
}
?>