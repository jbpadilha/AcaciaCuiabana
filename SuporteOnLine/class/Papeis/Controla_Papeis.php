<?php
//####################################
// * João Batista Padilha e Silva Analista/Desenvolvedor (Ábaco Tecnologia)
// * Arquivo: Controla_Papeis.php
// * Criação: João Batista Padilha e Silva
// * Revisão: 
// * Data de criação: 07/07/2008
//####################################

require_once("PapeisVo.php");

/**
 * Classe de Controle das Papeis do Sistema
 * @author João Batista Padilha e Silva
 */
class Controla_Papeis
{
	private $collVo = null;
	
	/**
	 * Método para buscar todos os papeis do sistema
	 * @author João Batista Padilha e Silva
	 * @param PapeisVo $papeisVo
	 */
	public function pesquisarPapeis(PapeisVo $papeisVo)
	{
		$businessEntity = new BusinessEntity();
		try 
		{
			$this->collVo = $businessEntity->pesquisarPapeis($papeisVo);	
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
		}
		return $this->collVo;
	}
	
	/**
	 * Método que mostra todos os papeis do Sistema
	 * @author João Batista Padilha e Silva
	 */
	public function mostraPapeis(PapeisVo $papeisVo)
	{
		$this->collVo = self::pesquisarPapeis($papeisVo);
		
		if(!is_null($this->collVo))
		{
		
			for($i = 0; $i < count($this->collVo); $i++)
			{
				$papeisVo = (object) $this->collVo[$i];
				$classCss = ($i%2==0) ? "linhaListagem" : "linha2Listagem";
				echo '
					<tr class="'.$classCss.'">
					<td>'.$papeisVo->getNomePapeis().'</td>
					<td style="width:2%;">
					<a href="javascript:void(0);" onClick="carregaPagina(\'viewPapeis.php?cadastro=true&idPapel='.$papeisVo->getIdPapeis().'\',\'formulario\');" title="Editar Papel '.$papeisVo->getNomePapeis().'">
					<img src="imagens/alterar.jpg" alt="Editar Papel '.$papeisVo->getNomePapeis().'" style="border:0;" />
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
				<td colspan="2">Não existe papeis cadastrados.</td>
				</tr>
			';
		}
	}
	
	/**
	 * Método que mostra o resultado da pesquisa de Papeis
	 * @author João Batista Padilha e Silva
	 * @param PapeisVo $papeisVo
	 */
	public function mostraPapeisPesquisa(PapeisVo $papeisVo)
	{
		$this->collVo = self::pesquisarPapeis($papeisVo);
		
		echo '<table width="95%" border="0" cellpadding="1" cellspacing="0" class="tabelaListagem" align="center">
				  <tr>
					<td class="tituloListagem" colspan="2">Nome</td>
				  </tr>';
		
		if(!is_null($this->collVo))
		{
			
			for($i = 0; $i < count($this->collVo); $i++)
			{
				$papeisVo = (object) $this->collVo[$i];
				$classCss = ($i%2==0) ? "linhaListagem" : "linha2Listagem";
				echo '
					<tr class="'.$classCss.'">
					<td>'.$papeisVo->getNomePapeis().'</td>
					<td style="width:2%;">
					<a href="javascript:void(0);" onClick="carregaPagina(\'viewPapeis.php?cadastro=true&idPapel='.$papeisVo->getIdPapeis().'\',\'formulario\');" title="Editar Papel '.$papeisVo->getNomePapeis().'">
					<img src="imagens/alterar.jpg" alt="Editar Papel '.$papeisVo->getNomePapeis().'" style="border:0;" />
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
				<td colspan="2">Papel não existe.</td>
				</tr>
			';
		}
		echo '</table>';
	}
	
	/**
	 * Método para cadastrar Papeis
	 * @author João Batista Padilha e Silva
	 * @param PapeisVo $papeisVo
	 */
	public function cadastrarPapeis(PapeisVo $papeisVo)
	{
		$businessEntity = new BusinessEntity();
		$controlaPermissao = new Controla_Permissao();
		try 
		{
			$businessEntity->cadastrarPapeis($papeisVo);
			
			//Deletar Permissão do Papel se for alteração
			if($papeisVo->getIdPapeis() != '')
			{
				$permissaoVo = new Permissao_Usuarios_Funcionalidades_PapeisVo();
				$permissaoVo->setIdPapeis($papeisVo->getIdPapeis());
				$controlaPermissao->deletarPermissoes($permissaoVo);
			}
			else 
			{
				//Pegar o id do registro Inserido
				$this->collVo = $businessEntity->pesquisarPapeis($papeisVo);
				$i = count($this->collVo) - 1;
				$papeisVo = (object) $this->collVo[$i];
			}
			$array_funcionalidades = explode(";",rawurldecode($_POST['idFuncionalidades']));
			
			//Cadastrar Permissao das funcionalidades
			foreach ($array_funcionalidades as $funcionalidades)
			{
				if(!$funcionalidades == 0 || !$funcionalidades == '')
				{
					$permissaoVo = new Permissao_Usuarios_Funcionalidades_PapeisVo();
					$permissaoVo->setIdPapeis($papeisVo->getIdPapeis());
					$permissaoVo->setIdFuncionalidades($funcionalidades);
					$controlaPermissao->cadastraPermissoes($permissaoVo);
				}
			}
			
			/**
			 * Gravação do LOG
			 */
			$dominio = new Dominio();
			if ($papeisVo->getIdPapeis() == '')
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
	 * Método que retorna o nome do Papel, à partir da identificação passada
	 * @author João Batista Padilha e Silva
	 * @param PapeisVo $papeisVo
	 * @return var
	 */
	public function pesquisaNomePapeis(PapeisVo $papeisVo)
	{
		$dominio = new Dominio();
		$papelRetorno = '';
		if($papeisVo->getIdPapeis() != '')
		{
			if($papeisVo->getIdPapeis() == $dominio->DomnPapel_Usuario)
			{
				$papelRetorno = $dominio->DomnPapel_Usuario_TXT;
			}
			else 
			{
				$this->collVo = self::pesquisarPapeis($papeisVo);
				$papeisVo = (object) $this->collVo[0];
				$papelRetorno = $papeisVo->getNomePapeis();
			}
		}
		return $papelRetorno;
	}
	
}
?>
