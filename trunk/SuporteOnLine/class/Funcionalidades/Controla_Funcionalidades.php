<?php
//####################################
// * João Batista Padilha e Silva Analista/Desenvolvedor (Ábaco Tecnologia)
// * Arquivo: Controla_Funcionalidades.php
// * Criação: João Batista Padilha e Silva
// * Revisão: 
// * Data de criação: 04/07/2008
//####################################
require_once("FuncionalidadesVo.php");

/**
 * Classe de Controle das Funcionalidades de Usuários
 * @author João Batista Padilha e Silva
 */
class Controla_Funcionalidades
{
	private $collVo = null;
	
	/**
	 * Método que monta o Select das funcionalidades para escolher apenas 1
	 * @author João Batista Padilha e Silva
	 * @param integer $select
	 * @param var $nomeSelect
	 * @return var
	 */
	public function montaSelectFuncionalidades($select,$nomeSelect)
	{
		$dominio = new Dominio();
		$funcionalidadesVo = new FuncionalidadesVo();
		$this->collVo = self::pesquisarFuncionalidades($funcionalidadesVo);
		$selected = '';
				
		$montaSelect = '<select id="'.$nomeSelect.'" name='.$nomeSelect.' class="campo">
							<option value="">'.$dominio->select.'</option>';

		for($i = 0; $i < count($this->collVo); $i++)
		{
			$funcionalidadesVo = (object) $this->collVo[$i];
			
			$selected = ($select == $funcionalidadesVo->getIdFuncionalidades()) ? 'selected="selected"' : '';
			
			$montaSelect .= '<option value="'.$funcionalidadesVo->getIdFuncionalidades().'" '.$selected.'>'.$funcionalidadesVo->getNomeFuncionalidades().'</option>';
		}

		$montaSelect .= '</select>';
		
		return $montaSelect;
	}
	
	/**
	 * Método de busca de funcionalidades
	 * @author João Batista Padilha e Silva
	 * @param FuncionalidadesVo $funcionalidadesVo
	 * @return $collVo
	 */
	public function pesquisarFuncionalidades(FuncionalidadesVo $funcionalidadesVo)
	{
		try 
		{
			$businessEntity = new BusinessEntity();
			$this->collVo = $businessEntity->pesquisarFuncionalidades($funcionalidadesVo);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
		return $this->collVo;
	}
	
	/**
	 * Método de Pesquisar de Funcionalidades por Link
	 *
	 * @param FuncionalidadesVo $funcionalidadesVo
	 * @return unknown
	 */
	public function pesquisarFuncionalidadesPorLink(FuncionalidadesVo $funcionalidadesVo)
	{
		try 
		{
			$businessEntity = new BusinessEntity();
			$this->collVo = $businessEntity->pesquisarFuncionalidadesPorLink($funcionalidadesVo);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
		return $this->collVo;
	}
	
	/**
	 * Método que mostra todas as funcionalidades no Menu
	 * @author João Batista Padilha e Silva
	 * @return var
	 */
	public function mostraFuncionalidadesMenu()
	{
		//Verifica Permissão do Usuário
		$dominio = new Dominio();
		$controlaPermissao = new Controla_Permissao();
		$permissaoVo = new Permissao_Usuarios_Funcionalidades_PapeisVo();
		$permissaoSubVo = new Permissao_Usuarios_Funcionalidades_PapeisVo();
		$collVoPermissao = $controlaPermissao->buscaPermissoesUsuarios();
		$mostra = '';
		
		//Grava Sessão com as Permissões do Usuário
		
		$_SESSION['permissaoUsuarios'] = $collVoPermissao;
		
		//
			
		$funcionalidadesMenuVo = new FuncionalidadesVo();
		$funcionalidadesSubMenuVo = new FuncionalidadesVo();
		
		//Busca Menu
		$funcionalidadesMenuVo->setDomnTipoFuncionalidades($dominio->DomnTipoFuncionalidade_Menu);
		$collVoFuncionalidadesMenu = self::pesquisarFuncionalidades($funcionalidadesMenuVo);
		
		//Busca SubMenu
		$funcionalidadesSubMenuVo->setDomnTipoFuncionalidades($dominio->DomnTipoFuncionalidade_SubMenu);
		$collVoFuncionalidadesSubMenu = self::pesquisarFuncionalidades($funcionalidadesSubMenuVo);


		for($i=0;$i<count($collVoFuncionalidadesMenu);$i++)
		{
			$funcionalidadesMenuVo = (object) $collVoFuncionalidadesMenu[$i];
			
			for ($p = 0; $p < count($collVoPermissao); $p++)
			{
				$permissaoVo = (object) $collVoPermissao[$p];
				
				if($permissaoVo->getIdFuncionalidades() == $funcionalidadesMenuVo->getIdFuncionalidades())
				{
					$link = '';
					if($funcionalidadesMenuVo->getLinkFuncionalidades() != '')
					{
						$link = "carregaPagina('{$funcionalidadesMenuVo->getLinkFuncionalidades()}','formulario');";
					}
					$mostra .= "
					<ul>
						<li><h4><a href=\"javascript:void(0);\" onClick=\"{$link}\">{$funcionalidadesMenuVo->getNomeFuncionalidades()}</h4>";
					
					for($j=0;$j<count($collVoFuncionalidadesSubMenu);$j++)
					{
						for($pp = 0; $pp < count($collVoPermissao);$pp++)
						{
							$permissaoSubVo = (object) $collVoPermissao[$pp];
							$funcionalidadesSubMenuVo = (object) $collVoFuncionalidadesSubMenu[$j];
							
							if($permissaoSubVo->getIdFuncionalidades() == $funcionalidadesSubMenuVo->getIdFuncionalidades())
							{
								if($funcionalidadesSubMenuVo->getPrecedenteFuncionalidades() == $funcionalidadesMenuVo->getIdFuncionalidades())
								{
									if($j == 0) $mostra .= '<ul>';
									$mostra .= '<li><a href="javascript:void(0);" onclick="carregaPagina(\''.$funcionalidadesSubMenuVo->getLinkFuncionalidades().'\',\'formulario\');">'.$funcionalidadesSubMenuVo->getNomeFuncionalidades().'</a></li>';
									if($j == count($collVoFuncionalidadesSubMenu) - 1) $mostra .= '</ul>';
								}
							}
						}
						
					}
					$mostra .= "</li>
					</ul>";
				}
			}
		}
		return $mostra;
	}
	
	/**
	 * Método de retorno da pesquisa de Funcionalidades
	 * @author João Batista Padilha e Silva
	 * @param FuncionalidadesVo $funcionalidadesVo
	 */
	public function mostraFuncionalidadesPesquisa(FuncionalidadesVo $funcionalidadesVo)
	{
		$this->collVo = self::pesquisarFuncionalidades($funcionalidadesVo);
		
		echo '<table width="95%" border="0" cellpadding="1" cellspacing="0" class="tabelaListagem" align="center">
				  <tr>
					<td class="tituloListagem" colspan="2">Nome da Funcionalidade</td>
				  </tr>';
		
		if(!is_null($this->collVo))
		{
			
			for($i = 0; $i < count($this->collVo); $i++)
			{
				$funcionalidadesVo = (object) $this->collVo[$i];
				$classCss = ($i%2==0) ? "linhaListagem" : "linha2Listagem";
				echo '
					<tr class="'.$classCss.'">
					<td>'.$funcionalidadesVo->getNomeFuncionalidades().'</td>
					<td style="width:2%;">
					<a href="javascript:void(0);" onClick="carregaPagina(\'viewFuncionalidades.php?cadastro=true&idFuncionalidades='.$funcionalidadesVo->getIdFuncionalidades().'\',\'formulario\');" title="Editar Papel '.$funcionalidadesVo->getNomeFuncionalidades().'">
					<img src="imagens/alterar.jpg" alt="Editar Funcionalidade '.$funcionalidadesVo->getNomeFuncionalidades().'" style="border:0;" />
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
				<td colspan="2">Funcionalidade não existe.</td>
				</tr>
			';
		}
		echo '</table>';
	}
	
	/**
	 * Método que preenche a página de selecionar funcionalidade para permissão em Usuarios e Papeis
	 * @author João Batista Padilha e Silva
	 */
	public function mostraSelecionarFuncionalidades()
	{
		$funcionalidadesVo = new FuncionalidadesVo();
		$dominio = new Dominio();
		$this->collVo = self::pesquisarFuncionalidades($funcionalidadesVo);
		
		//Mostrar as Funcionalidades Dominios
		echo $dominio->mostraTodosDomnFuncionalidades();
		
		if(!is_null($this->collVo))
		{
		
			for($i = 0; $i < count($this->collVo); $i++)
			{
				$funcionalidadesVo = (object) $this->collVo[$i];
				$classCss = ($i%2==0) ? "linhaListagem" : "linha2Listagem";
				
				$tipo = self::pesquisarTipoFuncionalidade($funcionalidadesVo->getDomnTipoFuncionalidades());
				
				//Pegar o Menu Pertencente se houver.
				$nomeMenuPrecedente = '';
				if($funcionalidadesVo->getPrecedenteFuncionalidades() != 0)
				{
					$funcionalidadesVo_aux = new FuncionalidadesVo();
					for($j = 0; $j < count($this->collVo); $j++)
					{
						$funcionalidadesVo_aux = (object) $this->collVo[$j];
						if($funcionalidadesVo_aux->getIdFuncionalidades() == $funcionalidadesVo->getPrecedenteFuncionalidades())
						{
							$nomeMenuPrecedente = $funcionalidadesVo_aux->getNomeFuncionalidades();
						}
					}
				}
				
				
				echo '
					<tr class="'.$classCss.'">
						<td><input type="checkbox" name="'.$funcionalidadesVo->getIdFuncionalidades().'" id="'.$funcionalidadesVo->getIdFuncionalidades().'" value="'.$funcionalidadesVo->getIdFuncionalidades()."&".$funcionalidadesVo->getNomeFuncionalidades().'" /></td>
						<td>'.$funcionalidadesVo->getNomeFuncionalidades().'</td>
						<td>'.$tipo.'</td>
						<td>'.$nomeMenuPrecedente.'</td>
					</tr>
				';
			}
		}
	}
	
	/**
	 * Método que mostra todas as funcionalidades
	 * @author João Batista Padilha e Silva
	 */
	public function mostraFuncionalidades()
	{
		$funcionalidadesVo = new FuncionalidadesVo();
		$this->collVo = self::pesquisarFuncionalidades($funcionalidadesVo);
		
		if(!is_null($this->collVo))
		{
			for($i = 0; $i < count($this->collVo); $i++)
			{
				$funcionalidadesVo = (object) $this->collVo[$i];
				$classCss = ($i%2==0) ? "linhaListagem" : "linha2Listagem";
				
				$tipo = self::pesquisarTipoFuncionalidade($funcionalidadesVo->getDomnTipoFuncionalidades());
				
				echo '
					<tr class="'.$classCss.'">
					<td>'.$funcionalidadesVo->getNomeFuncionalidades().'</td>
					<td>'.$tipo.'</td>
					<td style="width:2%;">
					<a href="javascript:void(0);" onClick="carregaPagina(\'viewFuncionalidades.php?cadastro=true&idFuncionalidades='.$funcionalidadesVo->getIdFuncionalidades().'\',\'formulario\');" title="Editar Funcionalidade '.$funcionalidadesVo->getNomeFuncionalidades().'">
					<img src="imagens/alterar.jpg" alt="Editar Funcionalidade '.$funcionalidadesVo->getNomeFuncionalidades().'" style="border:0;" />
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
				<td colspan="2">Não existe funcionalidades cadastradas.</td>
				</tr>
			';
		}
	}
	
	/**
	 * Método que busca o texto do tipo da funcionalidade
	 * @author João Batista Padilha e Silva
	 * @param var $tipoFuncionalidade
	 * @return var
	 */
	public function pesquisarTipoFuncionalidade($tipoFuncionalidade)
	{
		$dominio = new Dominio();
		if($tipoFuncionalidade == $dominio->DomnTipoFuncionalidade_Botao)
		{
			$tipo = $dominio->DomnTipoFuncionalidade_Botao_TXT;
		}
		elseif ($tipoFuncionalidade == $dominio->DomnTipoFuncionalidade_Menu)
		{
			$tipo = $tipo = $dominio->DomnTipoFuncionalidade_Menu_TXT;
		}
		elseif ($tipoFuncionalidade == $dominio->DomnTipoFuncionalidade_SubMenu)
		{
			$tipo = $dominio->DomnTipoFuncionalidade_SubMenu_TXT;
		}
		elseif ($tipoFuncionalidade == $dominio->DomnTipoFuncionalidade_Campo)
		{
			$tipo = $dominio->DomnTipoFuncionalidade_Campo_TXT;
		}
		return $tipo;
	}
	
	/**
	 * Método para Cadastrar/Alterar Funcionalidades no Sistema
	 * @author João Batista Padilha e Silva
	 * @param FuncionalidadesVo $funcionalidadesVo
	 */
	public function cadastraFuncionalidade(FuncionalidadesVo $funcionalidadesVo)
	{
		$businessEntity = new BusinessEntity();
		try 
		{
			if($funcionalidadesVo->getIdFuncionalidades() == '')
				$funcionalidadesVo->setOrdemFuncionalidades(rawurldecode($_POST['ordemFuncionalidade']));
			
			$businessEntity->cadastrarFuncionalidades($funcionalidadesVo);
			
			if($funcionalidadesVo->getIdFuncionalidades() != '')
			{
				//Gravar uma Nova ordem caso seja alteração
				$idOrdens = explode(";",rawurldecode($_POST['idsOrdem']));
				$i = 1;
				foreach ($idOrdens as $ordem)
				{
					//Pega o Id
					$funcionalidadesVo_ordem = new FuncionalidadesVo();
					$funcionalidadesVo_ordem->setIdFuncionalidades($ordem);
					//Pega o Registro Completo
					$collVo_Ordem = self::pesquisarFuncionalidades($funcionalidadesVo_ordem);
					
					$funcionalidadesVo_ordem = (object) $collVo_Ordem[0];
					//Seta a Ordem
					$funcionalidadesVo_ordem->setOrdemFuncionalidades($i);
					
					//Inicia Processo de Gravação
					$businessEntity->cadastrarFuncionalidades($funcionalidadesVo_ordem);
					$i++;
				}
			}
			
			/**
			 * Gravação do LOG
			 */
			$dominio = new Dominio();
			if ($funcionalidadesVo->getIdFuncionalidades() == '')
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
