<?php
//####################################
// * Rafael Henrique Vieira de Moura / Desenvolvedor (�baco Tecnologia)
// * Arquivo: Controla_LogSuporte.php
// * Cria��o: Rafael Henrique Vieira de Moura
// * Revis�o:
// * Data de cria��o: 14/07/2008

require("Log_SuporteVo.php");

/**
 * Classe de controle de Log
 * @author Rafael Henrique Vieira de Moura
 */
class Controla_LogSuporte
{
	private $collVo = null;
	
	/**
	 * M�todo para grava��o de Log das a��es executadas
	 * @author Rafael Henrique Vieira de Moura
	 * @param Log_SuporteVo $log_SuporteVo
	 */
	public function cadastrarLogSuporte(Log_SuporteVo $log_SuporteVo)
	{
		try 
		{
			$businessEntity = new BusinessEntity();
			$businessEntity->cadastrarLogSuporte($log_SuporteVo);
		}
		catch (Exception $e)
		{
			throw new Exception("N�o foi possivel gravar o Log - ".$e->getMessage());
		}
	}
	
	/**
	 * M�todo para pesquisa do log
	 * @author Rafael Henrique Vieira de Moura
	 * @param Log_SuporteVo $log_SuporteVo
	 * @return array $this->collVo
	 */
	public function pesquisarLogSuporte(Log_SuporteVo $log_SuporteVo)
	{
		try 
		{
			$businessEntity = new BusinessEntity();
			$this->collVo = $businessEntity->pesquisarLogSuporte($log_SuporteVo);
		}
		catch (Exception $e)
		{
			throw new Exception("N�o foi poss�vel continuar - ".$e->getMessage());
		}
		
		return $this->collVo;
	}
	
	/**
	 * M�todo para mostrar listagem de Log
	 * @author Rafael Henrique Vieira de Moura
	 * @param Log_SuporteVo $log_SuporteVo
	 */
	public function mostraListaLogSuporte(Log_SuporteVo $log_SuporteVo)
	{
		$this->collVo = self::pesquisarLogSuporte($log_SuporteVo);
		$businessEntity = new BusinessEntity();
		$dominio = new Dominio();
		$formataData = new FormataData();
		
		echo '<table width="95%" border="0" cellpadding="1" cellspacing="0" class="tabelaListagem" align="center">
				<tr>
					<td class="tituloListagem">Data</td>
					<td class="tituloListagem">Usu�rio</td>
					<td class="tituloListagem">Funcionalidade</td>
					<td class="tituloListagem">A��o</td>
				</tr>';
		if(!is_null($this->collVo))
		{
			for($i = 0; $i < count($this->collVo); $i++)
			{
				$log_SuporteVo = (object) $this->collVo[$i];
				$classCss = ($i%2==0) ? "linhaListagem" : "linha2Listagem";
				
				//Pesquisa o nome do Usu�rio
				$usuariosVo = new UsuariosVo();
				$usuariosVo->setIdUsuarios($log_SuporteVo->getIdUsuarios());
				$usuarios_CollVo = $businessEntity->pesquisarUsuarios($usuariosVo);
				$usuariosVo = (object) $usuarios_CollVo[0];
				
				//Pesquisa o nome da funcionalidade
				$funcionalidadeVo = new FuncionalidadesVo();
				$funcionalidadeVo->setIdFuncionalidades($log_SuporteVo->getIdFuncionalidades());
				$funcionalidade_CollVo = $businessEntity->pesquisarFuncionalidades($funcionalidadeVo);
				$funcionalidadeVo = (object) $funcionalidade_CollVo[0];
				
				//Retornar o Dominio da A��o
				$DomnAcao = ($log_SuporteVo->getDomnAcao() == 1) ? $dominio->DomnAcao_Log_Suporte_Incluir_TXT : $dominio->DomnAcao_Log_Suporte_Alterar_TXT;
				
				echo '
					<tr class="'.$classCss.'">
					<td>'.$formataData->toViewDateTime($log_SuporteVo->getDataCriacaoLog_Suporte()).'</td>
					<td>'.$usuariosVo->getNomeUsuarios().'</td>
					<td>'.$funcionalidadeVo->getNomeFuncionalidades().'</td>
					<td>'.$DomnAcao.'</td>
					</tr>
				';
			}
		}
		else
		{
			echo '
			<tr class="linhaListagem">
			<td colspan="4" align="center">Nenhum log encontrado.</td>
			</tr>
			';
		}
		echo '</table>';
	}
}
?>