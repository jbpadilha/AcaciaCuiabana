<?php
//####################################
// * Rafael Henrique Vieira de Moura / Desenvolvedor (�baco Tecnologia)
// * Arquivo: Historico_PedidosVo.php
// * Cria��o: Rafael Henrique Vieira de Moura
// * Revis�o:
// * Data de cria��o: 01/07/2008
//####################################
/*
   Classe Value Object. Serve para transportar os atributos dos hist�ricos dos
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
	 * M�todo de atribui��o da identifica��o do Historico do Pedido
	 * @author Rafael Henrique Vieira de Moura
	 * @param int $id
	 */
	public function setIdHistorico_Pedidos($id = null)
	{
		$this->idHistorico_Pedidos = $id;
	}
	
	/**
	 * M�todo de retorno da identifica��o do Historico do Pedido
	 * @author Rafael Henrique Vieira de Moura
	 * @return int
	 */
	public function getIdHistorico_Pedidos()
	{
		return $this->idHistorico_Pedidos;
	}
	
	/**
	 * M�todo de atribui��o da identifica��o do Pedido
	 * @author Rafael Henrique Vieira de Moura
	 * @param int $id
	 */
	public function setIdPedidos($id = null)
	{
		$this->idPedidos = $id;
	}
	
	/**
	 * M�todo de retorno da identifica��o do Pedido
	 * @author Rafael Henrique Vieira de Moura
	 * @return int
	 */
	public function getIdPedidos()
	{
		return $this->idPedidos;
	}
	
	/**
	 * M�todo de atribui��o da identifica��o do Anexo
	 * @author Rafael Henrique Vieira de Moura
	 * @param int $id
	 */
	public function setIdAnexos($id = null)
	{
		$this->idAnexos = $id;
	}
	
	/**
	 * M�todo de retorno da identifica��o do Anexo
	 * @author Rafael Henrique Vieira de Moura
	 * @return int
	 */
	public function getIdAnexos()
	{
		return $this->idAnexos;
	}
	
	/**
	 * M�todo de atribui��o da identifica��o do Usuario de Origem do Pedido
	 * @author Rafael Henrique Vieira de Moura
	 * @param int $id
	 */
	public function setIdUsuarioOrigem($id = null)
	{
		$this->idUsuarioOrigem = $id;
	}
	
	/**
	 * M�todo de retorno da identifica��o do Usuario Origem
	 * @author Rafael Henrique Vieira de Moura
	 * @return int
	 */
	public function getIdUsuarioOrigem()
	{
		return $this->idUsuarioOrigem;
	}
	
	/**
	 * M�todo de atribui��o do Papel de Origem
	 * @author Rafael Henrique Vieira de Moura
	 * @param int $id
	 */
	public function setIdPapeisOrigem($id = null)
	{
		$this->idPapeisOrigem = $id;
	}
	
	/**
	 * M�todo de retorno da identifica��o do Papel de Origem
	 * @author Rafael Henrique Vieira de Moura
	 * @return int
	 */
	public function getIdPapeisOrigem()
	{
		return $this->idPapeisOrigem;
	}
	
	/**
	 * M�todo de atribui��o da identifica��o do Usuario Destinat�rio
	 * @author Rafael Henrique Vieira de Moura
	 * @param int $id
	 */
	public function setIdUsuariosDestinatario($id = null)
	{
		$this->idUsuariosDestinatario = $id;
	}
	
	/**
	 * M�todo de retorno da identifica��o do Usuario Destinat�rio
	 * @author Rafael Henrique Vieira de Moura
	 * @return int
	 */
	public function getIdUsuariosDestinatario()
	{
		return $this->idUsuariosDestinatario;
	}
	
	/**
	 * M�todo de atribui��o da indetifica��o do Papel Destinat�rio
	 * @author Rafael Henrique Vieira de Moura
	 * @param int $id
	 */
	public function setIdPapeisDestinatario($id = null)
	{
		$this->idPapeisDestinatario = $id;
	}
	
	/**
	 * M�todo de retorno da indetifica��o do Papel Destinat�rio
	 * @author Rafael Henrique Vieira de Moura
	 * @return int
	 */
	public function getIdPapeisDestinatario()
	{
		return $this->idPapeisDestinatario;
	}
	
	/**
	 * M�todo de atribui��o da Data e Hora de Cria��o do Historico do Pedido
	 * @author Rafael Henrique Vieira de Moura
	 * @param date $dataHora
	 */
	public function setDataHoraHistorico_Pedidos($dataHora = '')
	{
		$this->dataHoraHistorico_Pedidos = $dataHora;
	}
	
	/**
	 * M�todo de retorno da Data de Cria��o do Hist�rico do Pedido
	 * @author Rafael Henrique Vieira de Moura
	 * @return date
	 */
	public function getDataHoraHistorico_Pedidos()
	{
		return $this->dataHoraHistorico_Pedidos;
	}
	
	/**
	 * M�todo de atribui��o do Complemento do Hist�rico
	 * @author Rafael Henrique Vieira de Moura
	 * @param var $desc
	 */
	public function setComplementoHistorico_Pedidos($desc = '')
	{
		$this->complementoHistorico_Pedidos = $desc;
	}
	
	/**
	 * M�todo de retorno do Complemento do Hist�rico do Pedido
	 * @author Rafael Henrique Vieira de Moura
	 * @return var
	 */
	public function getComplementoHistorico_Pedidos()
	{
		return $this->complementoHistorico_Pedidos;
	}
	
	/**
	 * M�todo de atribui��o do Fluxo Utilizado
	 * @author Rafael Henrique Vieira de Moura
	 * @param int $id
	 */
	public function setIdFluxos($id = null)
	{
		$this->idFluxos = $id;
	}
	
	/**
	 * M�todo de retorno da identifica��o do Fluxo Utilizado
	 * @author Rafael Henrique Vieira de Moura
	 * @return int
	 */
	public function getIdFluxos()
	{
		return $this->idFluxos;
	}
	
	/**
	 * M�todo de retorno da Data/Hora do Atendimento do Est�gio do Pedido
	 * @author Rafael Henrique Vieira de Moura
	 * @return date
	 */
	public function getDataHoraAtendimentoHistorico_Pedidos()
	{
		return $this->dataHoraAtendimentoHistorico_Pedidos;
	}
	
	/**
	 * M�todo de atribui��o da Data/Hora do Atendimento do Est�gio do Pedido
	 * @author Rafael Henrique Vieira de Moura
	 * @param date $data
	 */
	public function setDataHoraAtendimentoHistorico_Pedidos($data = '')
	{
		$this->dataHoraAtendimentoHistorico_Pedidos = $data;
	}
	
	/**
	 * M�todo de retorno da identifica��o do Usu�rio que fez a altera��o do hist�rico
	 * @author Rafael Henrique Vieira de Moura
	 * @return int
	 */
	public function getIdUsuarioHistorico_Pedidos()
	{
		return $this->idUsuariosHistorico_Pedidos;
	}
	
	/**
	 * M�todo de atribui��o da identifica��o do Usu�rio que fez a altera��o do Hist�rico
	 * @author Rafael Henrique Vieira de Moura
	 * @param int $id
	 */
	public function setIdUsuarioHistorico_Pedidos($id = null)
	{
		$this->idUsuariosHistorico_Pedidos = $id;
	}
	
	/**
	 * M�todo que retorna da identifica��o da Vers�o do Pedido at� o Historico Atual
	 * @author Jo�o Batista Padilha e Silva
	 * @return int
	 */
	public function getIdVersoes()
	{
		return $this->idVersoes;
	}
	
	/**
	 * M�todo que atribui a identifica��o da vers�o
	 * @author Jo�o Batista Padilha e Silva
	 * @param int $id
	 */
	public function setIdVersoes($id = null)
	{
		$this->idVersoes = $id;
	}
	
	/**
	 * M�todo de retorno Dom�nio Status do Pedido
	 * @author Jo�o Batista Padilha e Silva
	 * @return int
	 */
	public function getDomnStatusPedidoHistorico_Pedidos()
	{
		return $this->DomnStatusPedidoHistorico_Pedidos;
	}
	
	/**
	 * M�todo de atribui��o do Status do Pedido ao Hist�rico do Pedido
	 * @author Jo�o Batista Padilha e Silva
	 * @param int $status
	 */
	public function setDomnStatusPedidoHistorico_Pedidos($status = null)
	{
		$this->DomnStatusPedidoHistorico_Pedidos = $status;
	}
}
?>