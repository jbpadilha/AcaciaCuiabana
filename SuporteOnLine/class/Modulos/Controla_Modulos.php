<?php
//####################################
// * Jo�o Batista Padilha e Silva Analista/Desenvolvedor (�baco Tecnologia)
// * Arquivo: Controla_Modulos.php
// * Cria��o: Jo�o Batista Padilha e Silva
// * Revis�o: 
// * Data de cria��o: 07/07/2008
//####################################

require_once("ModulosVo.php");
require_once("Modulos_SubModulosVo.php");	

/**
 * Classe de Controle das Modulos do Sistema
 * @author Jo�o Batista Padilha e Silva
 */
class Controla_Modulos
{
	private $collVo = null;
	
	/**
	 * M�todo de pesquisa de M�dulos do Sistema
	 * @author Jo�o Batista Padilha e Silva
	 * @param ModulosVo $modulosVo
	 * @return array $this->collVo
	 */
	public function pesquisaModulos(ModulosVo $modulosVo)
	{
		$businessEntity = new BusinessEntity();
		try 
		{
			$this->collVo = $businessEntity->pesquisarModulos($modulosVo);
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
		}
		return $this->collVo;
	}
	
	/**
	 * M�todo que mostra os M�dulos do Sistema
	 * @author Jo�o Batista Padilha e Silva
	 * @param ModulosVo $modulosVo
	 * @return var
	 */
	public function mostraModulos(ModulosVo $modulosVo)
	{
		$this->collVo = self::pesquisaModulos($modulosVo);
		
		if(!is_null($this->collVo))
		{
		
			for($i = 0; $i < count($this->collVo); $i++)
			{
				$modulosVo = (object) $this->collVo[$i];
				$classCss = ($i%2==0) ? "linhaListagem" : "linha2Listagem";
				echo '
					<tr class="'.$classCss.'">
					<td>'.$modulosVo->getNomeModulos().'</td>
					<td style="width:2%;">
					<a href="javascript:void(0);" onClick="carregaPagina(\'viewModulos.php?cadastro=true&idModulos='.$modulosVo->getIdModulos().'\',\'formulario\');" title="Editar Papel '.$modulosVo->getNomeModulos().'">
					<img src="imagens/alterar.jpg" alt="Editar Papel '.$modulosVo->getNomeModulos().'" style="border:0;" />
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
				<td colspan="2">N�o existe m�dulos cadastrados.</td>
				</tr>
			';
		}
	}
	
	/**
	 * M�todo de cadastramento de m�dulos
	 * @author Jo�o Batista Padilha e Silva
	 * @param ModulosVo $modulosVo
	 */
	public function cadastrarModulos(ModulosVo $modulosVo)
	{
		$businessEntity = new BusinessEntity();
		try 
		{
			$businessEntity->cadastrarModulos($modulosVo);							
			
			// Cadastrar SubM�sulos se houver
			if(isset($_POST['idSubModulos']))
			{
				$modulos_SubModulosVo = new Modulos_SubModulosVo();
				
				// Para Cadastros Novos
				if($modulosVo->getIdModulos() == '')
				{
					$modulosBuscaVo = new ModulosVo();
					$this->collVo = self::pesquisaModulos($modulosBuscaVo);
					$modulosBuscaVo = (object) $this->collVo[count($this->collVo)-1];
					$modulosVo->setIdModulos($modulosBuscaVo->getIdModulos());	
				}
				
				
				// Apaga os SubModulos Cadastrado para este m�dulo
				$modulos_SubModulosVo->setIdModulos($modulosVo->getIdModulos());
				self::deletaModulosSubModulos($modulos_SubModulosVo);
				
				
				$arraySubModulos = explode(";",rawurldecode($_POST['idSubModulos']));
				
				foreach ($arraySubModulos as $subModulos)
				{
					$modulos_SubModulosVo->setIdModulos($modulosVo->getIdModulos());
					$modulos_SubModulosVo->setIdSubModulos($subModulos);
					$businessEntity->cadastrarModulosSubModulos($modulos_SubModulosVo);
				}
			}
			
			/**
			 * Grava��o do LOG
			 */
			$dominio = new Dominio();
			if ($modulosVo->getIdModulos() == '')
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
	
	/**
	 * M�todo de pesquisa de SubModulos para o M�dulo
	 * @author Jo�o Batista Padilha e Silva
	 * @param Modulos_SubModulosVo $modulosSubModulosVo
	 * @return array $this->collVo
	 */
	public function pesquisarModulosSubModulos(Modulos_SubModulosVo $modulosSubModulosVo)
	{
		$businessEntity = new BusinessEntity();
		try 
		{
			$this->collVo = $businessEntity->pesquisarModulosSubModulos($modulosSubModulosVo);
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
		}
		return $this->collVo;
	}
	
	/**
	 * M�todo de dele��o de SubModulos do M�dulo
	 * @author Jo�o Batista Padilha e Silva
	 * @param Modulos_SubModulosVo $modulosSubModulosVo
	 */
	public function deletaModulosSubModulos(Modulos_SubModulosVo $modulosSubModulosVo)
	{
		$businessEntity = new BusinessEntity();
		try 
		{
			$this->collVo = $businessEntity->deletaModulosSubModulos($modulosSubModulosVo);
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
		}
	}
	
	/**
	 * M�todo que mostra o resultado da pesquisa de m�dulos
	 * @author Jo�o Batista Padilha e Silva
	 * @param ModulosVo $modulosVo
	 */
	public function mostraPesquisaModulos(ModulosVo $modulosVo)
	{
		$this->collVo = self::pesquisaModulos($modulosVo);
		
		echo '<table width="95%" border="0" cellpadding="1" cellspacing="0" class="tabelaListagem" align="center">
				<tr>
					<td class="tituloListagem" colspan="2">Nome do M�dulo</td>
				</tr>';
		if(!is_null($this->collVo))
		{
			for($i = 0; $i < count($this->collVo); $i++)
			{
				$modulosVo = (object) $this->collVo[$i];
				$classCss = ($i%2==0) ? "linhaListagem" : "linha2Listagem";
								
				echo '
					<tr class="'.$classCss.'">
					<td>'.$modulosVo->getNomeModulos().'</td>
					<td style="width:2%;">
					<a href="javascript:void(0)" onclick="carregaPagina(\'viewModulos.php?cadastro=true&idModulos='.$modulosVo->getIdModulos().'\',\'formulario\')" title="Editar cadastro do M�dulo '.$modulosVo->getNomeModulos().'">
					<img src="imagens/alterar.jpg" alt="Editar cadastro do M�dulo '.$modulosVo->getNomeModulos().'" style="border:0;" />
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
			<td colspan="2" align="center">Nenhum M�dulo encontrado.</td>
			</tr>
			';
		}
		echo '</table>';
	}
	
	/**
	 * M�todo que mostra os M�dulos para sele��o
	 * @author Jo�o Batista Padilha e Silva
	 */
	public function mostraSelecionarModulos()
	{
		$modulosVo = new ModulosVo();
		$this->collVo = self::pesquisaModulos($modulosVo);
		
		if(!is_null($this->collVo))
		{
		
			for($i = 0; $i < count($this->collVo); $i++)
			{
				$modulosVo = (object) $this->collVo[$i];
				$classCss = ($i%2==0) ? "linhaListagem" : "linha2Listagem";

				echo '
					<tr class="'.$classCss.'">
						<td><input type="checkbox" name="'.$modulosVo->getIdModulos().'" id="'.$modulosVo->getIdModulos().'" value="'.$modulosVo->getIdModulos()."&".$modulosVo->getNomeModulos().'" /></td>
						<td>'.$modulosVo->getNomeModulos().'</td>
					</tr>
				';
			}
		}
		else 
		{
			echo '
				<tr class="linhaListagem">
				<td colspan="2">N�o existe M�dulos cadastrados.</td>
				</tr>
			';
		}
	}
	
}
?>