<?php
//####################################
// * Rafael Henrique Vieira de Moura / Desenvolvedor (Бbaco Tecnologia)
// * Arquivo: PedidosVo.php
// * Criaзгo: Rafael Henrique Vieira de Moura
// * Revisгo:
// * Data de criaзгo: 01/07/2008
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
	 * Mйtodo de Atribuiзгo de idPedidos
	 * @author Joгo Batista Padilha e Silva
	 * @param int $id
	 */
	public function setIdPedidos($id)
	{
		$this->idPedidos = $id;
	}
	
	/**
	 * Mйtodo de retorno da identificaзгo do Pedido
	 * @author Joгo Batista Padilha e Silva
	 * @return int
	 */
	public function getIdPedidos()
	{
		return $this->idPedidos;
	}
	
	/**
	 * Mйtodo de atribuiзгo da identificaзгo do Usuario que abriu o Pedido
	 * @author Joгo Batista Padilha e Silva
	 * @param int $id
	 */
	public function setIdUsuarios($id)
	{
		$this->idUsuarios = $id;
	}
	
	/**
	 * Mйtodo de retorno da identificaзгo do Usuбrio
	 * @author Joгo Batista Padilha e Silva
	 * @return int
	 */
	public function getIdUsuarios()
	{
		return $this->idUsuarios;
	}
	
	/**
	 * Mйtodo de atribuiзгo da identificaзгo da Atividade Ponto Funзгo Hora
	 * @author Joгo Batista Padilha e Silva
	 * @param int $id
	 */
	public function setIdAtividadesPontoFuncaoHoras($id)
	{
		$this->idAtividadesPontoFuncaoHoras = $id;
	}
	
	/**
	 * Mйtodo de retorno da identificaзгo da Atividade Ponto Funзгo Hora
	 * @author Joгo Batista Padilha e Silva
	 * @return int
	 */
	public function getIdAtividadesPontoFuncaoHoras()
	{
		return $this->idAtividadesPontoFuncaoHoras;
	}
	
	/**
	 * Mйtodo de atribuiзгo da identificaзгo do Projeto
	 * @author Joгo Batista Padilha e Silva
	 * @param int $id
	 */
	public function setIdProjetos($id)
	{
		$this->idProjetos = $id;
	}
	
	/**
	 * Mйtodo de retorno da identificaзгo do Projeto
	 * @author Joгo Batista Padilha e Silva
	 * @return int
	 */
	public function getIdProjetos()
	{
		return $this->idProjetos;
	}
	
	/**
	 * Mйtodo de atribuiзгo da identificaзгo da Versгo do Projeto
	 * @author Joгo Batista Padilha e Silva
	 * @param int $id
	 */
	public function setIdVersoes($id)
	{
		$this->idVersoes = $id;
	}
	
	/**
	 * Mйtodo de retorno da identificaзгo da Versгo
	 * @author Joгo Batista Padilha e Silva
	 * @return int
	 */
	public function getIdVersoes()
	{
		return $this->idVersoes;
	}
	
	/**
	 * Mйtodo de atribuiзгo da identificaзгo do Mуdulo
	 * @author Joгo Batista Padilha e Silva
	 * @param int $id
	 */
	public function setIdModulos($id)
	{
		$this->idModulos = $id;
	}
	
	/**
	 * Mйtodo de retorno da identificaзгo do mуdulo
	 * @author Joгo Batista Padilha e Silva
	 * @return int
	 */
	public function getIdModulos()
	{
		return $this->idModulos;
	}
	
	/**
	 * Mйtodo de atribuiзгo do sub-mуdulo 
	 * @author Joгo Batista Padilha e Silva
	 * @param int $id
	 */
	public function setIdSubModulos($id)
	{
		$this->idSubModulos = $id;
	}
	
	/**
	 * Mйtodo de retorno da identificaзгo do SubModulo
	 * @author Joгo Batista Padilha e Silva
	 * @return int
	 */
	public function getIdSubModulos()
	{
		return $this->idSubModulos;
	}
	
	/**
	 * Mйtodo de atribuiзгo da Data de Previsгo do Pedido
	 * @author Joгo Batista Padilha e Silva
	 * @param date $dataHora
	 */
	public function setDataHoraPrevisaoPedidos($dataHora)
	{
		$this->dataHoraPrevisaoPedidos = $dataHora;
	}
	
	/**
	 * Mйtodo de retorno da data de previsгo do Pedido
	 * @author Joгo Batista Padilha e Silva
	 * @return date
	 */
	public function getDataHoraPrevisaoPedidos()
	{
		return $this->dataHoraPrevisaoPedidos;
	}
		
	/**
	 * Mйtodo de atribuiзгo do Pai do Pedido, em caso de sub-pedido
	 * @author Joгo Batista Padilha e Silva
	 * @param int $idPrecedente
	 */
	public function setPrecedentePedidos($idPrecedente)
	{
		$this->precedentePedidos = $idPrecedente;
	}
	
	/**
	 * Mйtodo de retorno do pai do Pedido, em caso de sub-pedido
	 * @author Joгo Batista Padilha e Silva
	 * @return int
	 */
	public function getPrecedentePedidos()
	{
		return $this->precedentePedidos;
	}
	
	/**
	 * Mйtodo de atribuiзгo do Status do pedido. Domнnio
	 * @author Joгo Batista Padilha e Silva
	 * @param int $status
	 */
	public function setDomnStatusPedidos($status)
	{
		$this->domnStatusPedidos = $status;
	}
	
	/**
	 * Mйtodo de retorno do Status do Pedido
	 * @author Joгo Batista Padilha e Silva
	 * @return int
	 */
	public function getDomnStatusPedidos()
	{
		return $this->domnStatusPedidos;
	}
	
	/**
	 * Mйtodo de Atribuiзгo da Severidade do Pedido/ Dominio
	 * @author Joгo Batista Padilha e Silva
	 * @param int $severidade
	 */
	public function setDomnSeveridadePedidos($severidade)
	{
		$this->domnSeveridadePedidos = $severidade;
	}
	
	/**
	 * Mйtodo de retorno da Severidade do Pedido / Dominio
	 * @author Joгo Batista Padilha e Silva
	 * @return int
	 */
	public function getDomnSeveridadePedidos()
	{
		return $this->domnSeveridadePedidos;
	}
	
	/**
	 * Mйtodo de atribuiзгo do assunto do Pedido
	 * @author Joгo Batista Padilha e Silva
	 * @param var $assunto
	 */
	public function setAssuntoPedidos($assunto)
	{
		$this->assuntoPedidos = $assunto;
	}
	
	/**
	 * Mйtodo de retorno do assunto do Pedido
	 * @author Joгo Batista Padilha e Silva
	 * @return var
	 */
	public function getAssuntoPedido()
	{
		return $this->assuntoPedidos;
	}
}
?>