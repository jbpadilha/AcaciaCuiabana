<?php
//####################################
// * Rafael Henrique Vieira de Moura / Desenvolvedor (�baco Tecnologia)
// * Arquivo: PedidosVo.php
// * Cria��o: Rafael Henrique Vieira de Moura
// * Revis�o:
// * Data de cria��o: 01/07/2008
//####################################
/*
   Classe Value Object. Serve para transportar os atributos dos pedidos entre as camadas.
*/

class PedidosVo extends AbstractVo 
{
	private $idPedidos = null;
	private $idUsuarios = null;
	private $idAtividadesPontoFuncaoHoras = null;
	private $idProjetos = null;
	private $idVersoes = null;
	private $idModulos = null;
	private $idSubModulos = null;
	private $dataHoraPrevisaoPedidos = '';
	private $precedentePedidos = null;
	private $domnStatusPedidos = null;
	private $domnSeveridadePedidos = null;
	private $assuntoPedidos = '';
	
	/**
	 * M�todo de Atribui��o de idPedidos
	 * @author Jo�o Batista Padilha e Silva
	 * @param int $id
	 */
	public function setIdPedidos($id)
	{
		$this->idPedidos = $id;
	}
	
	/**
	 * M�todo de retorno da identifica��o do Pedido
	 * @author Jo�o Batista Padilha e Silva
	 * @return int
	 */
	public function getIdPedidos()
	{
		return $this->idPedidos;
	}
	
	/**
	 * M�todo de atribui��o da identifica��o do Usuario que abriu o Pedido
	 * @author Jo�o Batista Padilha e Silva
	 * @param int $id
	 */
	public function setIdUsuarios($id)
	{
		$this->idUsuarios = $id;
	}
	
	/**
	 * M�todo de retorno da identifica��o do Usu�rio
	 * @author Jo�o Batista Padilha e Silva
	 * @return int
	 */
	public function getIdUsuarios()
	{
		return $this->idUsuarios;
	}
	
	/**
	 * M�todo de atribui��o da identifica��o da Atividade Ponto Fun��o Hora
	 * @author Jo�o Batista Padilha e Silva
	 * @param int $id
	 */
	public function setIdAtividadesPontoFuncaoHoras($id)
	{
		$this->idAtividadesPontoFuncaoHoras = $id;
	}
	
	/**
	 * M�todo de retorno da identifica��o da Atividade Ponto Fun��o Hora
	 * @author Jo�o Batista Padilha e Silva
	 * @return int
	 */
	public function getIdAtividadesPontoFuncaoHoras()
	{
		return $this->idAtividadesPontoFuncaoHoras;
	}
	
	/**
	 * M�todo de atribui��o da identifica��o do Projeto
	 * @author Jo�o Batista Padilha e Silva
	 * @param int $id
	 */
	public function setIdProjetos($id)
	{
		$this->idProjetos = $id;
	}
	
	/**
	 * M�todo de retorno da identifica��o do Projeto
	 * @author Jo�o Batista Padilha e Silva
	 * @return int
	 */
	public function getIdProjetos()
	{
		return $this->idProjetos;
	}
	
	/**
	 * M�todo de atribui��o da identifica��o da Vers�o do Projeto
	 * @author Jo�o Batista Padilha e Silva
	 * @param int $id
	 */
	public function setIdVersoes($id)
	{
		$this->idVersoes = $id;
	}
	
	/**
	 * M�todo de retorno da identifica��o da Vers�o
	 * @author Jo�o Batista Padilha e Silva
	 * @return int
	 */
	public function getIdVersoes()
	{
		return $this->idVersoes;
	}
	
	/**
	 * M�todo de atribui��o da identifica��o do M�dulo
	 * @author Jo�o Batista Padilha e Silva
	 * @param int $id
	 */
	public function setIdModulos($id)
	{
		$this->idModulos = $id;
	}
	
	/**
	 * M�todo de retorno da identifica��o do m�dulo
	 * @author Jo�o Batista Padilha e Silva
	 * @return int
	 */
	public function getIdModulos()
	{
		return $this->idModulos;
	}
	
	/**
	 * M�todo de atribui��o do sub-m�dulo 
	 * @author Jo�o Batista Padilha e Silva
	 * @param int $id
	 */
	public function setIdSubModulos($id)
	{
		$this->idSubModulos = $id;
	}
	
	/**
	 * M�todo de retorno da identifica��o do SubModulo
	 * @author Jo�o Batista Padilha e Silva
	 * @return int
	 */
	public function getIdSubModulos()
	{
		return $this->idSubModulos;
	}
	
	/**
	 * M�todo de atribui��o da Data de Previs�o do Pedido
	 * @author Jo�o Batista Padilha e Silva
	 * @param date $dataHora
	 */
	public function setDataHoraPrevisaoPedidos($dataHora)
	{
		$this->dataHoraPrevisaoPedidos = $dataHora;
	}
	
	/**
	 * M�todo de retorno da data de previs�o do Pedido
	 * @author Jo�o Batista Padilha e Silva
	 * @return date
	 */
	public function getDataHoraPrevisaoPedidos()
	{
		return $this->dataHoraPrevisaoPedidos;
	}
		
	/**
	 * M�todo de atribui��o do Pai do Pedido, em caso de sub-pedido
	 * @author Jo�o Batista Padilha e Silva
	 * @param int $idPrecedente
	 */
	public function setPrecedentePedidos($idPrecedente)
	{
		$this->precedentePedidos = $idPrecedente;
	}
	
	/**
	 * M�todo de retorno do pai do Pedido, em caso de sub-pedido
	 * @author Jo�o Batista Padilha e Silva
	 * @return int
	 */
	public function getPrecedentePedidos()
	{
		return $this->precedentePedidos;
	}
	
	/**
	 * M�todo de atribui��o do Status do pedido. Dom�nio
	 * @author Jo�o Batista Padilha e Silva
	 * @param int $status
	 */
	public function setDomnStatusPedidos($status)
	{
		$this->domnStatusPedidos = $status;
	}
	
	/**
	 * M�todo de retorno do Status do Pedido
	 * @author Jo�o Batista Padilha e Silva
	 * @return int
	 */
	public function getDomnStatusPedidos()
	{
		return $this->domnStatusPedidos;
	}
	
	/**
	 * M�todo de Atribui��o da Severidade do Pedido/ Dominio
	 * @author Jo�o Batista Padilha e Silva
	 * @param int $severidade
	 */
	public function setDomnSeveridadePedidos($severidade)
	{
		$this->domnSeveridadePedidos = $severidade;
	}
	
	/**
	 * M�todo de retorno da Severidade do Pedido / Dominio
	 * @author Jo�o Batista Padilha e Silva
	 * @return int
	 */
	public function getDomnSeveridadePedidos()
	{
		return $this->domnSeveridadePedidos;
	}
	
	/**
	 * M�todo de atribui��o do assunto do Pedido
	 * @author Jo�o Batista Padilha e Silva
	 * @param var $assunto
	 */
	public function setAssuntoPedidos($assunto)
	{
		$this->assuntoPedidos = $assunto;
	}
	
	/**
	 * M�todo de retorno do assunto do Pedido
	 * @author Jo�o Batista Padilha e Silva
	 * @return var
	 */
	public function getAssuntoPedido()
	{
		return $this->assuntoPedidos;
	}
}
?>