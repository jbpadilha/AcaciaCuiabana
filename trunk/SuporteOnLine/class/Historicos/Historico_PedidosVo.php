<?php
//####################################
// * Rafael Henrique Vieira de Moura / Desenvolvedor (Бbaco Tecnologia)
// * Arquivo: Historico_PedidosVo.php
// * Criaзгo: Rafael Henrique Vieira de Moura
// * Revisгo:
// * Data de criaзгo: 01/07/2008
//####################################
/*
   Classe Value Object. Serve para transportar os atributos dos histуricos dos
   pedidos entre as camadas.
*/

class Historico_PedidosVo extends AbstractVo 
{
	private $idHistorico_Pedidos = null;
	private $idPedidos = null;
	private $idAnexos = null;
	private $idUsuarioOrigem = null;
	private $idPapeisOrigem = null;
	private $idUsuariosDestinatario = null;
	private $idPapeisDestinatario = null;
	private $dataHoraHistorico_Pedidos = '';
	private $complementoHistorico_Pedidos = '';
	private $dataHoraAtendimentoHistorico_Pedidos = null;
	private $idFluxos = null;
	private $idUsuariosHistorico_Pedidos = null;
	private $idVersoes = null;
	private $DomnStatusPedidoHistorico_Pedidos = null;
	
	/**
	 * Mйtodo de atribuiзгo da identificaзгo do Historico do Pedido
	 * @author Rafael Henrique Vieira de Moura
	 * @param int $id
	 */
	public function setIdHistorico_Pedidos($id = null)
	{
		$this->idHistorico_Pedidos = $id;
	}
	
	/**
	 * Mйtodo de retorno da identificaзгo do Historico do Pedido
	 * @author Rafael Henrique Vieira de Moura
	 * @return int
	 */
	public function getIdHistorico_Pedidos()
	{
		return $this->idHistorico_Pedidos;
	}
	
	/**
	 * Mйtodo de atribuiзгo da identificaзгo do Pedido
	 * @author Rafael Henrique Vieira de Moura
	 * @param int $id
	 */
	public function setIdPedidos($id = null)
	{
		$this->idPedidos = $id;
	}
	
	/**
	 * Mйtodo de retorno da identificaзгo do Pedido
	 * @author Rafael Henrique Vieira de Moura
	 * @return int
	 */
	public function getIdPedidos()
	{
		return $this->idPedidos;
	}
	
	/**
	 * Mйtodo de atribuiзгo da identificaзгo do Anexo
	 * @author Rafael Henrique Vieira de Moura
	 * @param int $id
	 */
	public function setIdAnexos($id = null)
	{
		$this->idAnexos = $id;
	}
	
	/**
	 * Mйtodo de retorno da identificaзгo do Anexo
	 * @author Rafael Henrique Vieira de Moura
	 * @return int
	 */
	public function getIdAnexos()
	{
		return $this->idAnexos;
	}
	
	/**
	 * Mйtodo de atribuiзгo da identificaзгo do Usuario de Origem do Pedido
	 * @author Rafael Henrique Vieira de Moura
	 * @param int $id
	 */
	public function setIdUsuarioOrigem($id = null)
	{
		$this->idUsuarioOrigem = $id;
	}
	
	/**
	 * Mйtodo de retorno da identificaзгo do Usuario Origem
	 * @author Rafael Henrique Vieira de Moura
	 * @return int
	 */
	public function getIdUsuarioOrigem()
	{
		return $this->idUsuarioOrigem;
	}
	
	/**
	 * Mйtodo de atribuiзгo do Papel de Origem
	 * @author Rafael Henrique Vieira de Moura
	 * @param int $id
	 */
	public function setIdPapeisOrigem($id = null)
	{
		$this->idPapeisOrigem = $id;
	}
	
	/**
	 * Mйtodo de retorno da identificaзгo do Papel de Origem
	 * @author Rafael Henrique Vieira de Moura
	 * @return int
	 */
	public function getIdPapeisOrigem()
	{
		return $this->idPapeisOrigem;
	}
	
	/**
	 * Mйtodo de atribuiзгo da identificaзгo do Usuario Destinatбrio
	 * @author Rafael Henrique Vieira de Moura
	 * @param int $id
	 */
	public function setIdUsuariosDestinatario($id = null)
	{
		$this->idUsuariosDestinatario = $id;
	}
	
	/**
	 * Mйtodo de retorno da identificaзгo do Usuario Destinatбrio
	 * @author Rafael Henrique Vieira de Moura
	 * @return int
	 */
	public function getIdUsuariosDestinatario()
	{
		return $this->idUsuariosDestinatario;
	}
	
	/**
	 * Mйtodo de atribuiзгo da indetificaзгo do Papel Destinatбrio
	 * @author Rafael Henrique Vieira de Moura
	 * @param int $id
	 */
	public function setIdPapeisDestinatario($id = null)
	{
		$this->idPapeisDestinatario = $id;
	}
	
	/**
	 * Mйtodo de retorno da indetificaзгo do Papel Destinatбrio
	 * @author Rafael Henrique Vieira de Moura
	 * @return int
	 */
	public function getIdPapeisDestinatario()
	{
		return $this->idPapeisDestinatario;
	}
	
	/**
	 * Mйtodo de atribuiзгo da Data e Hora de Criaзгo do Historico do Pedido
	 * @author Rafael Henrique Vieira de Moura
	 * @param date $dataHora
	 */
	public function setDataHoraHistorico_Pedidos($dataHora = '')
	{
		$this->dataHoraHistorico_Pedidos = $dataHora;
	}
	
	/**
	 * Mйtodo de retorno da Data de Criaзгo do Histуrico do Pedido
	 * @author Rafael Henrique Vieira de Moura
	 * @return date
	 */
	public function getDataHoraHistorico_Pedidos()
	{
		return $this->dataHoraHistorico_Pedidos;
	}
	
	/**
	 * Mйtodo de atribuiзгo do Complemento do Histуrico
	 * @author Rafael Henrique Vieira de Moura
	 * @param var $desc
	 */
	public function setComplementoHistorico_Pedidos($desc = '')
	{
		$this->complementoHistorico_Pedidos = $desc;
	}
	
	/**
	 * Mйtodo de retorno do Complemento do Histуrico do Pedido
	 * @author Rafael Henrique Vieira de Moura
	 * @return var
	 */
	public function getComplementoHistorico_Pedidos()
	{
		return $this->complementoHistorico_Pedidos;
	}
	
	/**
	 * Mйtodo de atribuiзгo do Fluxo Utilizado
	 * @author Rafael Henrique Vieira de Moura
	 * @param int $id
	 */
	public function setIdFluxos($id = null)
	{
		$this->idFluxos = $id;
	}
	
	/**
	 * Mйtodo de retorno da identificaзгo do Fluxo Utilizado
	 * @author Rafael Henrique Vieira de Moura
	 * @return int
	 */
	public function getIdFluxos()
	{
		return $this->idFluxos;
	}
	
	/**
	 * Mйtodo de retorno da Data/Hora do Atendimento do Estбgio do Pedido
	 * @author Rafael Henrique Vieira de Moura
	 * @return date
	 */
	public function getDataHoraAtendimentoHistorico_Pedidos()
	{
		return $this->dataHoraAtendimentoHistorico_Pedidos;
	}
	
	/**
	 * Mйtodo de atribuiзгo da Data/Hora do Atendimento do Estбgio do Pedido
	 * @author Rafael Henrique Vieira de Moura
	 * @param date $data
	 */
	public function setDataHoraAtendimentoHistorico_Pedidos($data = '')
	{
		$this->dataHoraAtendimentoHistorico_Pedidos = $data;
	}
	
	/**
	 * Mйtodo de retorno da identificaзгo do Usuбrio que fez a alteraзгo do histуrico
	 * @author Rafael Henrique Vieira de Moura
	 * @return int
	 */
	public function getIdUsuarioHistorico_Pedidos()
	{
		return $this->idUsuariosHistorico_Pedidos;
	}
	
	/**
	 * Mйtodo de atribuiзгo da identificaзгo do Usuбrio que fez a alteraзгo do Histуrico
	 * @author Rafael Henrique Vieira de Moura
	 * @param int $id
	 */
	public function setIdUsuarioHistorico_Pedidos($id = null)
	{
		$this->idUsuariosHistorico_Pedidos = $id;
	}
	
	/**
	 * Mйtodo que retorna da identificaзгo da Versгo do Pedido atй o Historico Atual
	 * @author Joгo Batista Padilha e Silva
	 * @return int
	 */
	public function getIdVersoes()
	{
		return $this->idVersoes;
	}
	
	/**
	 * Mйtodo que atribui a identificaзгo da versгo
	 * @author Joгo Batista Padilha e Silva
	 * @param int $id
	 */
	public function setIdVersoes($id = null)
	{
		$this->idVersoes = $id;
	}
	
	/**
	 * Mйtodo de retorno Domнnio Status do Pedido
	 * @author Joгo Batista Padilha e Silva
	 * @return int
	 */
	public function getDomnStatusPedidoHistorico_Pedidos()
	{
		return $this->DomnStatusPedidoHistorico_Pedidos;
	}
	
	/**
	 * Mйtodo de atribuiзгo do Status do Pedido ao Histуrico do Pedido
	 * @author Joгo Batista Padilha e Silva
	 * @param int $status
	 */
	public function setDomnStatusPedidoHistorico_Pedidos($status = null)
	{
		$this->DomnStatusPedidoHistorico_Pedidos = $status;
	}
}
?>