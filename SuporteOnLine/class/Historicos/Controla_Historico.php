<?php
//####################################
// * Joгo Batista Padilha e Silva Analista/Desenvolvedor (Бbaco Tecnologia)
// * Arquivo: Controla_Historico.php
// * Criaзгo: Joгo Batista Padilha e Silva
// * Revisгo: 
// * Data de criaзгo: 16/07/2008
//####################################
require_once("Historico_PedidosVo.php");

/**
 * Classe de Controle de Histуricos do Pedido
 * @author Joгo Batista Padilha e Silva
 */
class Controla_Historico
{
	private $collVo = null;
	
	/**
	 * Mйtodo de cadastramento de Historico de Pedidos
	 * @author Joгo Batista Padilha e Silva
	 * @param Historico_PedidosVo $historicoVo
	 */
	public function cadastrarHistorico(Historico_PedidosVo $historicoVo)
	{
		$business = new BusinessEntity();
		try 
		{
			$ultimoId = $business->cadastrarHistoricoPedidos($historicoVo);		
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
		return $ultimoId;
	}
	
	public function pesquisarHistorico(Historico_PedidosVo $historicoVo)
	{
		$businessEntity = new BusinessEntity();
		try 
		{
				$this->collVo = $businessEntity->pesquisarHistorico($historicoVo);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
		
		return $this->collVo;
	}
}
?>