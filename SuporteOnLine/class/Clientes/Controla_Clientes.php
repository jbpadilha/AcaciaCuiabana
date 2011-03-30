<?php
//####################################
// * Rafael Henrique Vieira de Moura / Desenvolvedor (Ábaco Tecnologia)
// * Arquivo: Controla_Clientes.php
// * Criação: Rafael Henrique Vieira de Moura
// * Revisão:
// * Data de criação: 10/07/2008

require("ClientesVo.php");
/**
 * Classe de controle de Clientes
 * @author Rafael Henrique V. Moura
 */
class Controla_Clientes
{
	private $collVo = null;
	
	/**
	 * Método para pesquisa de Clientes
	 * @author Rafael Henrique Vieira de Moura
	 * @param ClientesVo $clientesVo
	 * @return array $this->collVo
	 */
	public function pesquisarClientes(ClientesVo $clientesVo)
	{
		$businessEntity = new BusinessEntity();
		
		$clientesVo->setParametroConsulta("ORDER BY nomeClientes ASC");
		
		if ($clientesVo->getNomeClientes() != '')
		{
			$clientesVo->setParametroConsulta("WHERE nomeClientes LIKE '%{$clientesVo->getNomeClientes()}%'".$clientesVo->getParametroConsulta());
		}
		
		try 
		{
			$this->collVo = $businessEntity->pesquisarClientes($clientesVo);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
		
		return $this->collVo;
	}
	/**
	 * Método para mostrar listagem de Clientes
	 * @author Rafael Henrique Vieira de Moura
	 * @param ClientesVo $clientesVo
	 */
	public function mostraListaClientes(ClientesVo $clientesVo)
	{
		$this->collVo = self::pesquisarClientes($clientesVo);
		
		echo '<table width="95%" border="0" cellpadding="1" cellspacing="0" class="tabelaListagem" align="center">
				<tr>
					<td class="tituloListagem" colspan="2">Nome</td>
				</tr>';
		if(!is_null($this->collVo))
		{
			for($i = 0; $i < count($this->collVo); $i++)
			{
				$clientesVo = (object) $this->collVo[$i];
				$classCss = ($i%2==0) ? "linhaListagem" : "linha2Listagem";
								
				echo '
					<tr class="'.$classCss.'">
					<td>'.$clientesVo->getNomeClientes().'</td>
					<td style="width:2%;">
					<a href="javascript:void(0)" onclick="carregaPagina(\'viewClientes.php?cadastro=true&id='.$clientesVo->getIdClientes().'\',\'formulario\')" title="Editar cadastro do Cliente '.$clientesVo->getNomeClientes().'">
					<img src="imagens/alterar.jpg" alt="Editar cadastro do Cliente '.$clientesVo->getNomeClientes().'" style="border:0;" />
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
			<td colspan="2" align="center">Nenhum Cliente encontrado.</td>
			</tr>
			';
		}
		echo '</table>';
	}
	/**
	 * Método para cadastro e alteração de Clientes
	 * @author Rafael Henrique Vieira de Moura
	 * @param ClientesVo $clientesVo
	 */
	public function cadastrarClientes(ClientesVo $clientesVo)
	{
		$businessEntity = new BusinessEntity();
		
		try 
		{
			$businessEntity->cadastrarClientes($clientesVo);
			
			/**
			 * Gravação do LOG
			 */
			$dominio = new Dominio();
			if ($clientesVo->getIdClientes() == '')
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
}
?>