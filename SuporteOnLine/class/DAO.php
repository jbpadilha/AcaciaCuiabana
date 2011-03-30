<?php
//####################################
// * Joгo Batista Padilha e Silva Analista/Desenvolvedor (Бbaco Tecnologia)
// * Arquivo: DAO.php
// * Criaзгo: Joгo Batista Padilha e Silva
// * Revisгo:
// * Data de criaзгo: 02/07/2008
//####################################
/**
 * A Classe de Inserзгo e Alteraзгo no Banco de Dados. Ela й filha de Conexгo.
 * @author Joгo Batista Padilha e Silva
 */
class DAO extends Connecta
{
	private $valueObj = null;
	
	/**
	 * Mйtodo de inserзгo na tabela de Anexos
	 * @author Joгo Batista Padilha e Silva
	 * @param AnexosVo $anexosVo
	 */
	public function inserirAnexos(AnexosVo $anexosVo)
	{
		$conecta = new Connecta();
		$this->valueObj = new AnexosVo();
		$this->valueObj = (object) $anexosVo;
		
		//Inicializar variaveis
		$nomeAnexos = '';
		$descricaoAnexos = '';
		$caminhoAnexos = '';
		$dataInclusaoAnexos = '';
		
		try 
		{
			$sql = mysqli_prepare($conecta,"INSERT INTO Anexos (idAnexos,nomeAnexos,descricaoAnexos,caminhoAnexos,dataInclusaoAnexos) VALUES('',?,?,?,?)");
			mysqli_bind_param($sql,'ssss',$nomeAnexos,$descricaoAnexos,$caminhoAnexos,$dataInclusaoAnexos);
			
			$nomeAnexos = $this->valueObj->getNomeAnexos();
			$descricaoAnexos = $this->valueObj->getDescricaoAnexos();
			$caminhoAnexos = $this->valueObj->getCaminhoAnexos();
			$dataInclusaoAnexos = $this->valueObj->getDataInclusaoAnexos();
			
			if(!mysqli_stmt_execute($sql))
			{
				throw new Exception("Nгo foi possнvel conectar no banco de dados.");
			}
			$ultimoId = self::ultimoIdInserido($conecta);
		}
		catch ( Exception $e)
		{
			throw new Exception("Nгo foi possнvel incluir na tabela Anexos - ".$e->getMessage());
		}
		return $ultimoId;
	}
	
	/**
	 * Mйtodo de alteraзгo na tabela Anexos
	 * @author Joгo Batista Padilha e Silva
	 * @param AnexosVo $anexosVo
	 */
	public function alterarAnexos(AnexosVo $anexosVo)
	{
		$conecta = new Connecta();
		$this->valueObj = new AnexosVo();
		$this->valueObj = (object) $anexosVo;
		
		//Inicializar Variaveis
		$nomeAnexos = '';
		$descricaoAnexos = '';
		$caminhoAnexos = '';
		$dataInclusaoAnexos = '';
		$idAnexos = null;
		
		try 
		{
			$sql = mysqli_prepare($conecta,"UPDATE Anexos SET nomeAnexos = ?, descricaoAnexos = ?, caminhoAnexos = ?, dataInclusaoAnexos = ? WHERE idAnexos = ?");
			mysqli_bind_param($sql,'ssssi',$nomeAnexos,$descricaoAnexos,$caminhoAnexos,$dataInclusaoAnexos,$idAnexos);
			
			$nomeAnexos = $this->valueObj->getNomeAnexos();
			$descricaoAnexos = $this->valueObj->getDescricaoAnexos();
			$caminhoAnexos = $this->valueObj->getCaminhoAnexos();
			$dataInclusaoAnexos = $this->valueObj->getDataInclusaoAnexos();
			$idAnexos = $this->valueObj->getIdAnexos();
			
			if(!mysqli_stmt_execute($sql))
			{
				throw new Exception("Nгo foi possнvel conectar no banco de dados.");
			}
		}
		catch ( Exception $e)
		{
			throw new Exception("Nгo foi possнvel alterar na tabela Anexos - ".$e->getMessage());
		}
	}
	
	/**
	 * Mйtodo de inserзгo na tabela AtividadesPontoFuncaoHoras
	 * @author Joгo Batista Padilha e Silva
	 * @param AtividadesPontoFuncaoHorasVo $atividadesPFHVo
	 */
	public function inserirAtividadesPontoFuncaoHoras(AtividadesPontoFuncaoHorasVo $atividadesPFHVo)
	{
		$conecta = new Connecta();
		$this->valueObj = new AtividadesPontoFuncaoHorasVo();
		$this->valueObj = (object) $atividadesPFHVo;
		
		//Inicializar variaveis
		$idTecnologias = null;
		$nomeAtividadesPontoFuncaoHoras = '';
		$pontoFuncaoAtividadesPontoFuncaoHoras = '';
		$horasAtividadesPontoFuncaoHoras = '';
		
		try 
		{
			$sql = mysqli_prepare($conecta,"INSERT INTO AtividadesPontoFuncaoHoras (idAtividadesPontoFuncaoHoras, idTecnologias, nomeAtividadesPontoFuncaoHoras, pontoFuncaoAtividadesPontoFuncaoHoras, horasAtividadesPontoFuncaoHoras) VALUES('',?,?,?,?)");
			mysqli_bind_param($sql,'isds',$idTecnologias,$nomeAtividadesPontoFuncaoHoras,$pontoFuncaoAtividadesPontoFuncaoHoras,$horasAtividadesPontoFuncaoHoras);
			
			$idTecnologias = $this->valueObj->getIdTecnologias();
			$nomeAtividadesPontoFuncaoHoras = $this->valueObj->getNomeAtividadesPontoFuncaoHoras();
			$pontoFuncaoAtividadesPontoFuncaoHoras = $this->valueObj->getPontoFuncaoAtividadesPontoFuncaoHoras();
			$horasAtividadesPontoFuncaoHoras = $this->valueObj->getHorasAtividadesPontoFuncaoHoras();
			
			if(!mysqli_stmt_execute($sql))
			{
				throw new Exception("Nгo foi possнvel conectar no banco de dados.");
			}
		}
		catch ( Exception $e)
		{
			throw new Exception("Nгo foi possнvel incluir na tabela AtividadesPontoFuncaoHoras - ".$e->getMessage());
		}
	}
	
	/**
	 * Mйtodo Alteraзгo na tabela AtividadesPontoFuncaoHoras
	 * @author Joгo Batista Padilha e Silva
	 * @param AtividadesPontoFuncaoHoras $atividadesPFHVo
	 */
	public function alterarAtividadesPontoFuncaoHoras(AtividadesPontoFuncaoHorasVo $atividadesPFHVo)
	{
		$conecta = new Connecta();
		$this->valueObj = new AtividadesPontoFuncaoHorasVo();
		$this->valueObj = (object) $atividadesPFHVo;
		
		//Inicializar variaveis
		$idAtividadesPontoFuncaoHoras = null;
		$idTecnologias = null;
		$nomeAtividadesPontoFuncaoHoras = '';
		$pontoFuncaoAtividadesPontoFuncaoHoras = '';
		$horasAtividadesPontoFuncaoHoras = '';
		
		try 
		{
			$sql = mysqli_prepare($conecta,"UPDATE AtividadesPontoFuncaoHoras SET idTecnologias = ?, nomeAtividadesPontoFuncaoHoras = ?, pontoFuncaoAtividadesPontoFuncaoHoras = ?, horasAtividadesPontoFuncaoHoras = ? WHERE idAtividadesPontoFuncaoHoras = ?");
			mysqli_bind_param($sql,'isdsi',$idTecnologias,$nomeAtividadesPontoFuncaoHoras,$pontoFuncaoAtividadesPontoFuncaoHoras,$horasAtividadesPontoFuncaoHoras,$idAtividadesPontoFuncaoHoras);
			
			$idTecnologias = $this->valueObj->getIdTecnologias();
			$nomeAtividadesPontoFuncaoHoras = $this->valueObj->getNomeAtividadesPontoFuncaoHoras();
			$pontoFuncaoAtividadesPontoFuncaoHoras = $this->valueObj->getPontoFuncaoAtividadesPontoFuncaoHoras();
			$horasAtividadesPontoFuncaoHoras = $this->valueObj->getHorasAtividadesPontoFuncaoHoras();
			$idAtividadesPontoFuncaoHoras = $this->valueObj->getIdAtividadePontoFuncaoHoras();
			
			if(!mysqli_stmt_execute($sql))
			{
				throw new Exception("Nгo foi possнvel conectar no banco de dados.");
			}
		}
		catch ( Exception $e)
		{
			throw new Exception("Nгo foi possнvel alterar na tabela AtividadesPontoFuncaoHoras - ".$e->getMessage());
		}
	}
	
	/**
	 * Mйtodo de inserзгo na tabela de Clientes
	 * @author Joгo Batista Padilha e Silva
	 * @param ClientesVo $clientesVo
	 */
	public function inserirClientes(ClientesVo $clientesVo)
	{
		$conecta = new Connecta();
		$this->valueObj = new ClientesVo();
		$this->valueObj = (object) $clientesVo;
		
		//Inicializar variaveis
		$nomeClientes = '';
		
		try 
		{
			$sql = mysqli_prepare($conecta,"INSERT INTO Clientes (idClientes, nomeClientes) VALUES('',?)");
			mysqli_bind_param($sql,'s',$nomeClientes);
			
			$nomeClientes = $this->valueObj->getNomeClientes();
			
			if(!mysqli_stmt_execute($sql))
			{
				throw new Exception("Nгo foi possнvel conectar no banco de dados.");
			}
		}
		catch ( Exception $e)
		{
			throw new Exception("Nгo foi possнvel incluir na tabela Clientes - ".$e->getMessage());
		}
	}
	
	/**
	 * Mйtodo de alteraзгo na tabela de Clientes
	 * @author Joгo Batista Padilha e Silva
	 * @param ClientesVo $clientesVo
	 */
	public function alterarClientes(ClientesVo $clientesVo)
	{
		$conecta = new Connecta();
		$this->valueObj = new ClientesVo();
		$this->valueObj = (object) $clientesVo;
		
		//Inicializar variaveis
		$idClientes = null;
		$nomeClientes = '';
		
		try 
		{
			$sql = mysqli_prepare($conecta,"UPDATE Clientes SET nomeClientes = ? WHERE idClientes = ?");
			mysqli_bind_param($sql,'si',$nomeClientes,$idClientes);
			
			$nomeClientes = $this->valueObj->getNomeClientes();
			$idClientes = $this->valueObj->getIdClientes();
			
			if(!mysqli_stmt_execute($sql))
			{
				throw new Exception("Nгo foi possнvel conectar no banco de dados.");
			}
		}
		catch ( Exception $e)
		{
			throw new Exception("Nгo foi possнvel alterar na tabela Clientes - ".$e->getMessage());
		}
	}
	
	/**
	 * Mйtodo de inserзгo na tabela de DestinatariosNaoConformidades
	 * @author Joгo Batista Padilha e Silva
	 * @param DestinatariosNaoConformidadesVo $destNaoConfVo
	 */
	public function inserirDestinatariosNaoConformidades(DestinatariosNaoConformidadesVo $destNaoConfVo)
	{
		$conecta = new Connecta();
		$this->valueObj = new DestinatariosNaoConformidadesVo();
		$this->valueObj = (object) $destNaoConfVo;
		
		//Inicializar variaveis
		$idUsuarios = null;
		$idProjetos = null;
		
		try 
		{
			$sql = mysqli_prepare($conecta,"INSERT INTO DestinatariosNaoConformidades (idDestinatariosNaoConformidades, idUsuarios, idProjetos) VALUES('',?,?)");
			mysqli_bind_param($sql,'ii',$idUsuarios,$idProjetos);
			
			$idUsuarios = $this->valueObj->getIdUsuarios();
			$idProjetos = $this->valueObj->getIdProjetos();
			
			if(!mysqli_stmt_execute($sql))
			{
				throw new Exception("Nгo foi possнvel conectar no banco de dados.");
			}
		}
		catch ( Exception $e)
		{
			throw new Exception("Nгo foi possнvel incluir na tabela DestinatariosNaoConformidades - ".$e->getMessage());
		}
	}
	
	/**
	 * Mйtodo que deleta os DestinatariosNaoConformidades
	 * @author Joгo Batista Padilha e Silva
	 * @param DestinatariosNaoConformidadesVo $destNaoConfVo
	 */
	public function deletaDestinatariosNaoConformidades(DestinatariosNaoConformidadesVo $destNaoConfVo)
	{
		$conecta = new Connecta();
		$this->valueObj = new DestinatariosNaoConformidadesVo();
		$this->valueObj = (object) $destNaoConfVo;
		
		//Inicializar variaveis
		$idProjetos = null;
		
		$sql = "DELETE FROM DestinatariosNaoConformidades WHERE idProjetos = ?";

		
		try 
		{
			$sql = mysqli_prepare($conecta,$sql);
			mysqli_bind_param($sql,'i',$idProjetos);
			$idProjetos = $this->valueObj->getIdProjetos();
			
			if(!mysqli_stmt_execute($sql))
			{
				throw new Exception("Nгo foi possнvel conectar no banco de dados.");
			}
		}
		catch ( Exception $e)
		{
			throw new Exception("Nгo foi possнvel deletar na tabela DestinatariosNaoConformidades - ".$e->getMessage());
		}
	}
	
	/**
	 * Mйtodo de inserзгo na tabela de Fluxos
	 * @author Joгo Batista Padilha e Silva
	 * @param FluxosVo $fluxosVo
	 */
	public function inserirFluxos(FluxosVo $fluxosVo)
	{
		$conecta = new Connecta();
		$this->valueObj = new FluxosVo();
		$this->valueObj = (object) $fluxosVo;
		
		//Inicializar variaveis
		$idGrupoFluxos = null;
		$idPapeisOrigem = null;
		$idPapeisDestino = null;
		$ordemFluxos = null;
		
		try 
		{
			$sql = mysqli_prepare($conecta,"INSERT INTO Fluxos (idFluxos, idGrupoFluxos, idPapeisOrigem, idPapeisDestinatario, ordemFluxos) VALUES('',?,?,?,?)");
			mysqli_bind_param($sql,'iiii',$idGrupoFluxos, $idPapeisOrigem, $idPapeisDestino, $ordemFluxos);
			
			$idGrupoFluxos = $this->valueObj->getIdGrupoFluxos();
			$idPapeisOrigem = $this->valueObj->getIdPapeisOrigem();
			$idPapeisDestino = $this->valueObj->getIdPapeisDestinatario();
			$ordemFluxos = $this->valueObj->getOrdemFluxos();
			
			if(!mysqli_stmt_execute($sql))
			{
				throw new Exception("Nгo foi possнvel conectar no banco de dados.");
			}
		}
		catch ( Exception $e)
		{
			throw new Exception("Nгo foi possнvel incluir na tabela Fluxos - ".$e->getMessage());
		}
	}
	
	/**
	 * Mйtodo de alteraзгo na tabela Fluxos
	 * @author Joгo Batista Padilha e Silva
	 * @param FluxosVo $fluxosVo
	 */
	public function alterarFluxos(FluxosVo $fluxosVo)
	{
		$conecta = new Connecta();
		$this->valueObj = new FluxosVo();
		$this->valueObj = (object) $fluxosVo;
		
		//Inicializar variaveis
		$idFluxos = null;
		$idGrupoFluxos = null;
		$idPapeisOrigem = null;
		$idPapeisDestino = null;
		$ordemFluxos = null;
		
		try 
		{
			$sql = mysqli_prepare($conecta,"UPDATE Fluxos SET idGrupoFluxos = ?, idPapeisOrigem = ?, idPapeisDestinatario = ?, ordemFluxos = ? WHERE idFluxos = ?");
			mysqli_bind_param($sql,'iiiii',$idGrupoFluxos,$idPapeisOrigem,$idPapeisDestino,$ordemFluxos,$idFluxos);
			
			$idGrupoFluxos = $this->valueObj->getIdGrupoFluxos();
			$idPapeisOrigem = $this->valueObj->getIdPapeisOrigem();
			$idPapeisDestino = $this->valueObj->getIdPapeisDestinatario();
			$ordemFluxos = $this->valueObj->getOrdemFluxos();
			$idFluxos = $this->valueObj->getIdFluxos();
			
			if(!mysqli_stmt_execute($sql))
			{
				throw new Exception("Nгo foi possнvel conectar no banco de dados.");
			}
		}
		catch ( Exception $e)
		{
			throw new Exception("Nгo foi possнvel alterar na tabela Fluxos - ".$e->getMessage());
		}
	}
	
	/**
	 * Mйtodo de inserзгo na tabela de Funcionalidades
	 * @author Joгo Batista Padilha e Silva
	 * @param FuncionalidadesVo $funcionalidadesVo
	 */
	public function inserirFuncionalidades(FuncionalidadesVo $funcionalidadesVo)
	{
		$conecta = new Connecta();
		$this->valueObj = new FuncionalidadesVo();
		$this->valueObj = (object) $funcionalidadesVo;
		
		//Inicializar variaveis
		$nomeFuncionalidades = '';
		$linkFuncionalidades = '';
		$DomnTipoFuncionalidades = null;
		$ordemFuncionalidades = null;
		$precedenteFuncionalidades = null;
		
		try 
		{
			$sql = mysqli_prepare($conecta,"INSERT INTO Funcionalidades (idFuncionalidades, nomeFuncionalidades, linkFuncionalidades, DomnTipoFuncionalidades, ordemFuncionalidades, precedenteFuncionalidades) VALUES('',?,?,?,?,?)");
			mysqli_bind_param($sql,'ssiii',$nomeFuncionalidades,$linkFuncionalidades,$DomnTipoFuncionalidades,$ordemFuncionalidades,$precedenteFuncionalidades);
			
			$nomeFuncionalidades = $this->valueObj->getNomeFuncionalidades();
			$linkFuncionalidades = $this->valueObj->getLinkFuncionalidades();
			$DomnTipoFuncionalidades = $this->valueObj->getDomnTipoFuncionalidades();
			$ordemFuncionalidades = $this->valueObj->getOrdemFuncionalidades();
			$precedenteFuncionalidades = $this->valueObj->getPrecedenteFuncionalidades();
			
			if(!mysqli_stmt_execute($sql))
			{
				throw new Exception("Nгo foi possнvel conectar no banco de dados.");
			}
		}
		catch ( Exception $e)
		{
			throw new Exception("Nгo foi possнvel incluir na tabela Funcionalidades - ".$e->getMessage());
		}
	}
	
	/**
	 * Mйtodo de alteraзгo na tabela de Funcionalidades
	 * @author Joгo Batista Padilha e Silva
	 * @param FuncionalidadesVo $funcionalidadesVo
	 */
	public function alterarFuncionalidades(FuncionalidadesVo $funcionalidadesVo)
	{
		$conecta = new Connecta();
		$this->valueObj = new FuncionalidadesVo();
		$this->valueObj = (object) $funcionalidadesVo;
		
		//Inicializar variaveis
		$idFuncionalidades = null;
		$nomeFuncionalidades = '';
		$linkFuncionalidades = '';
		$DomnTipoFuncionalidades = null;
		$ordemFuncionalidades = null;
		$precedenteFuncionalidades = null;
		
		try 
		{
			$sql = mysqli_prepare($conecta,"UPDATE Funcionalidades SET nomeFuncionalidades = ?, linkFuncionalidades = ?, DomnTipoFuncionalidades = ?, ordemFuncionalidades = ?, precedenteFuncionalidades = ? WHERE idFuncionalidades = ?");
			mysqli_bind_param($sql,'ssiiii',$nomeFuncionalidades, $linkFuncionalidades, $DomnTipoFuncionalidades, $ordemFuncionalidades, $precedenteFuncionalidades, $idFuncionalidades);
			
			$nomeFuncionalidades = $this->valueObj->getNomeFuncionalidades();
			$linkFuncionalidades = $this->valueObj->getLinkFuncionalidades();
			$DomnTipoFuncionalidades = $this->valueObj->getDomnTipoFuncionalidades();
			$ordemFuncionalidades = $this->valueObj->getOrdemFuncionalidades();
			$precedenteFuncionalidades = $this->valueObj->getPrecedenteFuncionalidades();
			$idFuncionalidades = $this->valueObj->getIdFuncionalidades();
			
			if(!mysqli_stmt_execute($sql))
			{
				throw new Exception("Nгo foi possнvel conectar no banco de dados.");
			}
		}
		catch ( Exception $e)
		{
			throw new Exception("Nгo foi possнvel alterar na tabela Funcionalidades - ".$e->getMessage());
		}
	}
	
	/**
	 * Mйtodo de inserзгo na tabela de HistoricosPedidos
	 * @author Joгo Batista Padilha e Silva
	 * @param Historico_PedidosVo $historicosPedidosVo
	 */
	public function inserirHistoricosPedidos(Historico_PedidosVo $historicosPedidosVo)
	{
		$conecta = new Connecta();
		$this->valueObj = new Historico_PedidosVo();
		$this->valueObj = (object) $historicosPedidosVo;
		
		//Inicializar variaveis
		$idPedidos = null;
		$idAnexos = null;
		$idUsuariosOrigem = null;
		$idPapeisOrigem = null;
		$idUsuariosDestinatario = null;
		$idPapeisDestinatario = null;
		$dataHoraHistorico_Pedidos = '';
		$complementoHistorico_Pedidos = '';
		$idFluxos = null;
		$dataHoraAtendimentoHistorico_Pedidos = '';
		$idUsuariosHistorico_Pedidos = null;
		$idVersoes = null;
		$DomnStatusPedidoHistorico_Pedidos = null;
		
		try 
		{
			$sql = mysqli_prepare($conecta,"INSERT INTO Historico_Pedidos (idHistorico_Pedidos, idPedidos, idAnexos, idUsuariosOrigem, idPapeisOrigem, idUsuariosDestinatario, idPapeisDestinatario, dataHoraHistorico_Pedidos, complementoHistorico_Pedidos, idFluxos, dataHoraAtendimentoHistorico_Pedidos, idUsuariosHistorico_Pedidos, idVersoes, DomnStatusPedidoHistorico_Pedidos) VALUES('',?,?,?,?,?,?,?,?,?,?,?,?,?)");
			mysqli_bind_param($sql,'iiiiiissisiii',$idPedidos,$idAnexos,$idUsuariosOrigem,$idPapeisOrigem,$idUsuariosDestinatario,$idPapeisDestinatario,$dataHoraHistorico_Pedidos,$complementoHistorico_Pedidos,$idFluxos,$dataHoraAtendimentoHistorico_Pedidos, $idUsuariosHistorico_Pedidos, $idVersoes, $DomnStatusPedidoHistorico_Pedidos);
			
			$idPedidos = $this->valueObj->getIdPedidos();
			$idAnexos = $this->valueObj->getIdAnexos();
			$idUsuariosOrigem = $this->valueObj->getIdUsuarioOrigem();
			$idPapeisOrigem = $this->valueObj->getIdPapeisOrigem();
			$idUsuariosDestinatario = $this->valueObj->getIdUsuariosDestinatario();
			$idPapeisDestinatario = $this->valueObj->getIdPapeisDestinatario();
			$dataHoraHistorico_Pedidos = $this->valueObj->getDataHoraHistorico_Pedidos();
			$complementoHistorico_Pedidos = $this->valueObj->getComplementoHistorico_Pedidos();
			$idFluxos = $this->valueObj->getIdFluxos();
			$dataHoraAtendimentoHistorico_Pedidos = $this->valueObj->getDataHoraAtendimentoHistorico_Pedidos();
			$idUsuariosHistorico_Pedidos = $this->valueObj->getIdUsuarioHistorico_Pedidos();
			$idVersoes = $this->valueObj->getIdVersoes();
			$DomnStatusPedidoHistorico_Pedidos = $this->valueObj->getDomnStatusPedidoHistorico_Pedidos();
			
			if(!mysqli_stmt_execute($sql))
			{
				throw new Exception("Nгo foi possнvel conectar no banco de dados.");
			}
			$ultimoId = self::ultimoIdInserido($conecta);
		}
		catch ( Exception $e)
		{
			throw new Exception("Nгo foi possнvel incluir na tabela Historico_Pedidos - ".$e->getMessage());
		}
		return $ultimoId;
	}
	
	/**
	 * Mйtodo de alteraзгo na tabela de HistoricosPedidos
	 * @author Joгo Batista Padilha e Silva
	 * @param Historico_PedidosVo $historicosPedidosVo
	 */
	public function alterarHistoricosPedidos(Historico_PedidosVo $historicosPedidosVo)
	{
		$conecta = new Connecta();
		$this->valueObj = new Historico_PedidosVo();
		$this->valueObj = (object) $historicosPedidosVo;
		
		//Inicializar variaveis
		$idPedidos = null;
		$idAnexos = null;
		$idUsuariosOrigem = null;
		$idPapeisOrigem = null;
		$idUsuariosDestinatario = null;
		$idPapeisDestinatario = null;
		$dataHoraHistorico_Pedidos = '';
		$complementoHistorico_Pedidos = '';
		$idFluxos = null;
		$dataHoraAtendimentoHistorico_Pedidos = '';
		$idUsuariosHistorico_Pedidos = null;
		$idHistorico_Pedidos = null;
		$idVersoes = null;
		$DomnStatusPedidoHistorico_Pedidos = null;
		
		try 
		{
			$sql = mysqli_prepare($conecta,"UPDATE Historico_Pedidos SET idPedidos = ?, idAnexos = ?, idUsuariosOrigem = ?, idPapeisOrigem = ?, idUsuariosDestinatario = ?, idPapeisDestinatario = ?, dataHoraHistorico_Pedidos = ?, complementoHistorico_Pedidos = ?, idFluxos = ?, dataHoraAtendimentoHistorico_Pedidos = ?, idUsuariosHistorico_Pedidos = ?, idVersoes = ?, DomnStatusPedidoHistorico_Pedidos = ? WHERE idHistorico_Pedidos = ?");
			mysqli_bind_param($sql,'iiiiiissisiiii',$idPedidos,$idAnexos,$idUsuariosOrigem,$idPapeisOrigem,$idUsuariosDestinatario,$idPapeisDestinatario,$dataHoraHistorico_Pedidos,$complementoHistorico_Pedidos,$idFluxos,$dataHoraAtendimentoHistorico_Pedidos, $idUsuariosHistorico_Pedidos, $idVersoes, $DomnStatusPedidoHistorico_Pedidos,$idHistorico_Pedidos);
			
			$idPedidos = $this->valueObj->getIdPedidos();
			$idAnexos = $this->valueObj->getIdAnexos();
			$idUsuariosOrigem = $this->valueObj->getIdUsuarioOrigem();
			$idPapeisOrigem = $this->valueObj->getIdPapeisOrigem();
			$idUsuariosDestinatario = $this->valueObj->getIdUsuariosDestinatario();
			$idPapeisDestinatario = $this->valueObj->getIdPapeisDestinatario();
			$dataHoraHistorico_Pedidos = $this->valueObj->getDataHoraHistorico_Pedidos();
			$complementoHistorico_Pedidos = $this->valueObj->getComplementoHistorico_Pedidos();
			$idFluxos = $this->valueObj->getIdFluxos();
			$dataHoraAtendimentoHistorico_Pedidos = $this->valueObj->getDataHoraAtendimentoHistorico_Pedidos();
			$idUsuariosHistorico_Pedidos = $this->valueObj->getIdUsuarioHistorico_Pedidos();
			$idVersoes = $this->valueObj->getIdVersoes();
			$DomnStatusPedidoHistorico_Pedidos = $this->valueObj->getDomnStatusPedidoHistorico_Pedidos();
			$idHistorico_Pedidos = $this->valueObj->getIdHistorico_Pedidos();
			
			if(!mysqli_stmt_execute($sql))
			{
				throw new Exception("Nгo foi possнvel conectar no banco de dados.");
			}
		}
		catch ( Exception $e)
		{
			throw new Exception("Nгo foi possнvel alterar na tabela Historico_Pedidos - ".$e->getMessage());
		}
	}
	
	/**
	 * Mйtodo de inserзгo na tabela de LogSuporte
	 * @author Joгo Batista Padilha e Silva
	 * @param Log_SuporteVo $logSuporteVo
	 */
	public function inserirLogSuporte(Log_SuporteVo $logSuporteVo)
	{
		$conecta = new Connecta();
		$this->valueObj = new Log_SuporteVo();
		$this->valueObj = (object) $logSuporteVo;
		
		//Inicializar variaveis
		$idUsuarios = null;
		$idFuncionalidades = null;
		$domnAcao = null;
		$dataCriacaoLog_Suporte = '';
		
		try 
		{
			$sql = mysqli_prepare($conecta,"INSERT INTO Log_Suporte (idLog_Suporte, idUsuarios, idFuncionalidades, DomnAcao, dataCriacaoLog_Suporte) VALUES('',?,?,?,?)");
			mysqli_bind_param($sql,'iiis',$idUsuarios, $idFuncionalidades, $domnAcao, $dataCriacaoLog_Suporte);
			
			$idUsuarios = $this->valueObj->getIdUsuarios();
			$idFuncionalidades = $this->valueObj->getIdFuncionalidades();
			$domnAcao = $this->valueObj->getDomnAcao();
			$dataCriacaoLog_Suporte = $this->valueObj->getDataCriacaoLog_Suporte();
			
			if(!mysqli_stmt_execute($sql))
			{
				throw new Exception("Nгo foi possнvel conectar no banco de dados.");
			}
		}
		catch ( Exception $e)
		{
			throw new Exception("Nгo foi possнvel incluir na tabela Log_Suporte - ".$e->getMessage());
		}
	}
	
	/**
	 * Mйtodo de alteraзгo na tabela de LogSuporte
	 * @author Joгo Batista Padilha e Silva
	 * @param Log_SuporteVo $logSuporteVo
	 */
	public function alterarLogSuporte(Log_SuporteVo $logSuporteVo)
	{
		$conecta = new Connecta();
		$this->valueObj = new Log_SuporteVo();
		$this->valueObj = (object) $logSuporteVo;
		
		//Inicializar variaveis
		$idUsuarios = null;
		$idFuncionalidades = null;
		$domnAcao = null;
		$dataCriacaoLog_Suporte = '';
		$idLog_Suporte = null;
		
		try 
		{
			$sql = mysqli_prepare($conecta,"UPDATE Log_Suporte SET idUsuarios = ?, idFuncionalidades = ?, DomnAcao = ?, dataCriacaoLog_Suporte = ? WHERE idLog_Suporte = ?");
			mysqli_bind_param($sql,'iiisi',$idUsuarios, $idFuncionalidades, $domnAcao, $dataCriacaoLog_Suporte, $idLog_Suporte);
			
			$idUsuarios = $this->valueObj->getIdUsuarios();
			$idFuncionalidades = $this->valueObj->getIdFuncionalidades();
			$domnAcao = $this->valueObj->getDomnAcao();
			$dataCriacaoLog_Suporte = $this->valueObj->getDataCriacaoLog_Suporte();
			$idLog_Suporte = $this->valueObj->getIdLog_Suporte();
			
			if(!mysqli_stmt_execute($sql))
			{
				throw new Exception("Nгo foi possнvel conectar no banco de dados.");
			}
		}
		catch ( Exception $e)
		{
			throw new Exception("Nгo foi possнvel alterar na tabela Log_Suporte - ".$e->getMessage());
		}
	}
	
	/**
	 * Mйtodo de inserзгo na tabela de Modulos
	 * @author Joгo Batista Padilha e Silva
	 * @param ModulosVo $modulosVo
	 */
	public function inserirModulos(ModulosVo $modulosVo)
	{
		$conecta = new Connecta();
		$this->valueObj = new ModulosVo();
		$this->valueObj = (object) $modulosVo;
		
		//Inicializar variaveis
		$nomeModulos = '';
		
		try 
		{
			$sql = mysqli_prepare($conecta,"INSERT INTO Modulos (idModulos, nomeModulos) VALUES('',?)");
			mysqli_bind_param($sql,'s',$nomeModulos);
			
			$nomeModulos = $this->valueObj->getNomeModulos();
			
			if(!mysqli_stmt_execute($sql))
			{
				throw new Exception("Nгo foi possнvel conectar no banco de dados.");
			}
		}
		catch ( Exception $e)
		{
			throw new Exception("Nгo foi possнvel incluir na tabela Modulos - ".$e->getMessage());
		}
	}
	
	/**
	 * Mйtodo de alteraзгo na tabela de Modulos
	 * @author Joгo Batista Padilha e Silva
	 * @param ModulosVo $modulosVo
	 */
	public function alterarModulos(ModulosVo $modulosVo)
	{
		$conecta = new Connecta();
		$this->valueObj = new ModulosVo();
		$this->valueObj = (object) $modulosVo;
		
		//Inicializar variaveis
		$nomeModulos = '';
		$idModulos = null;
		
		try 
		{
			$sql = mysqli_prepare($conecta,"UPDATE Modulos SET nomeModulos = ? WHERE idModulos = ?");
			mysqli_bind_param($sql,'si',$nomeModulos, $idModulos);
			
			$nomeModulos = $this->valueObj->getNomeModulos();
			$idModulos = $this->valueObj->getIdModulos();
			
			if(!mysqli_stmt_execute($sql))
			{
				throw new Exception("Nгo foi possнvel conectar no banco de dados.");
			}
		}
		catch ( Exception $e)
		{
			throw new Exception("Nгo foi possнvel alterar na tabela Modulos - ".$e->getMessage());
		}
	}
	
	/**
	 * Mйtodo de inserзгo na tabela de Modulos_SubModulos
	 * @author Joгo Batista Padilha e Silva
	 * @param ModulosSubModulosVo $modulosSubModulosVo
	 */
	public function inserirModulos_SubModulos(Modulos_SubModulosVo $modulosSubModulosVo)
	{
		$conecta = new Connecta();
		$this->valueObj = new Modulos_SubModulosVo();
		$this->valueObj = (object) $modulosSubModulosVo;
		
		//Inicializar variaveis
		$idModulos = null;
		$idSubModulos = null;
		
		try 
		{
			$sql = mysqli_prepare($conecta,"INSERT INTO Modulos_SubModulos (idModulos_SubModulos, idModulos, idSubModulos) VALUES('',?,?)");
			mysqli_bind_param($sql,'ii',$idModulos, $idSubModulos);
			
			$idModulos = $this->valueObj->getIdModulos();
			$idSubModulos = $this->valueObj->getIdSubModulos();
			
			if(!mysqli_stmt_execute($sql))
			{
				throw new Exception("Nгo foi possнvel conectar no banco de dados.");
			}
		}
		catch ( Exception $e)
		{
			throw new Exception("Nгo foi possнvel incluir na tabela Modulos_SubModulos - ".$e->getMessage());
		}
	}
	
	/**
	 * Mйtodo de alteraзгo na tabela de Modulos_SubModulos
	 * @author Joгo Batista Padilha e Silva
	 * @param ModulosSubModulosVo $modulosSubModulosVo
	 */
	public function alterarModulos_SubModulos(Modulos_SubModulosVo $modulosSubModulosVo)
	{
		$conecta = new Connecta();
		$this->valueObj = new Modulos_SubModulosVo();
		$this->valueObj = (object) $modulosSubModulosVo;
		
		//Inicializar variaveis
		$idModulos = null;
		$idSubModulos = null;
		$idModulos_SubModulos = null;
		
		try 
		{
			$sql = mysqli_prepare($conecta,"UPDATE Modulos_SubModulos SET idModulos = ?, idSubModulos = ? WHERE idModulos_SubModulos = ?");
			mysqli_bind_param($sql,'iii',$idModulos, $idSubModulos, $idModulos_SubModulos);
			
			$idModulos = $this->valueObj->getIdModulos();
			$idSubModulos = $this->valueObj->getIdSubModulos();
			$idModulos_SubModulos = $this->valueObj->getIdModulosSubModulos();
			
			if(!mysqli_stmt_execute($sql))
			{
				throw new Exception("Nгo foi possнvel conectar no banco de dados.");
			}
		}
		catch ( Exception $e)
		{
			throw new Exception("Nгo foi possнvel alterar na tabela Modulos_SubModulos - ".$e->getMessage());
		}
	}
	
	/**
	 * Mйtodo para deletar Sub-Mуdulos para o Mуdulo
	 * @author Joгo Batista Padilha e Silva
	 * @param Modulos_SubModulosVo $modulosSubModulosVo
	 */
	public function deletarModulos_SubModulos(Modulos_SubModulosVo $modulosSubModulosVo)
	{
		$conecta = new Connecta();
		$this->valueObj = new Modulos_SubModulosVo();
		$this->valueObj = (object) $modulosSubModulosVo;
		
		//Inicializar variaveis
		$idModulos = null;
		$idSubModulos = null;
		
		$sql = "DELETE FROM Modulos_SubModulos WHERE ";

		if($this->valueObj->getIdModulos() != '')
		{
			$sql = $sql."idModulos = ?";
		}
		elseif ($this->valueObj->getIdSubModulos() != '')
		{
			$sql = $sql."idSubModulos = ?";
		}
		elseif ($this->valueObj->getIdModulos() != '' && $this->valueObj->getIdSubModulos() != '')
		{
			$sql = $sql . "idModulos = ? AND idSubModulos = ?";
		}
		
		try 
		{
			$sql = mysqli_prepare($conecta,$sql);
			
			if($this->valueObj->getIdModulos() != '')
			{
				mysqli_bind_param($sql,'i',$idModulos);
			}
			elseif ($this->valueObj->getIdSubModulos() != '')
			{
				mysqli_bind_param($sql,'i',$idSubModulos);
			}
			elseif ($this->valueObj->getIdModulos() != '' && $this->valueObj->getIdSubModulos() != '')
			{
				mysqli_bind_param($sql,'ii',$idModulos,$idSubModulos);
			}
			
			$idModulos = $this->valueObj->getIdModulos();
			$idSubModulos = $this->valueObj->getIdSubModulos();
			
			if(!mysqli_stmt_execute($sql))
			{
				throw new Exception("Nгo foi possнvel conectar no banco de dados.");
			}
		}
		catch ( Exception $e)
		{
			throw new Exception("Nгo foi possнvel deletar na tabela Modulos_SubModulos - ".$e->getMessage());
		}
	}
	
	/**
	 * Mйtodo de inserзгo na tabela de NaoConformidades
	 * @author Joгo Batista Padilha e Silva
	 * @param NaoConformidadesVo $naoConformidadesVo
	 */
	public function inserirNaoConformidades(NaoConformidadesVo $naoConformidadesVo)
	{
		$conecta = new Connecta();
		$this->valueObj = new NaoConformidadesVo();
		$this->valueObj = (object) $naoConformidadesVo;
		
		//Inicializar variaveis
		$idPedidos = null;
		$justificativaNaoConformidades = '';
		$dataNaoConformidades = '';
		$contraMedidaNaoConformidades = '';
		$DomnMotivo = null;
		
		try 
		{
			$sql = mysqli_prepare($conecta,"INSERT INTO NaoConformidades (idNaoConformidades, idPedidos, justificativaNaoConformidades, dataNaoConformidades, contraMedidaNaoConformidades, DomnMotivo) VALUES('',?,?,?,?,?)");
			mysqli_bind_param($sql,'issss',$idPedidos, $justificativaNaoConformidades, $dataNaoConformidades, $contraMedidaNaoConformidades, $DomnMotivo);
			
			$idPedidos = $this->valueObj->getIdPedidos();
			$justificativaNaoConformidades = $this->valueObj->getJustificativaNaoConformidades();
			$dataNaoConformidades = $this->valueObj->getDataNaoConformidades();
			$contraMedidaNaoConformidades = $this->valueObj->getContraMedidasNaoConformidades();
			$DomnMotivo = $this->valueObj->getDomnMotivo();
			
			if(!mysqli_stmt_execute($sql))
			{
				throw new Exception("Nгo foi possнvel conectar no banco de dados.");
			}
		}
		catch ( Exception $e)
		{
			throw new Exception("Nгo foi possнvel incluir na tabela NaoConformidades - ".$e->getMessage());
		}
	}
	
	/**
	 * Mйtodo de alteraзгo na tabela de NaoConformidades
	 * @author Joгo Batista Padilha e Silva
	 * @param NaoConformidadesVo $naoConformidadesVo
	 */
	public function alterarNaoConformidades(NaoConformidadesVo $naoConformidadesVo)
	{
		$conecta = new Connecta();
		$this->valueObj = new NaoConformidadesVo();
		$this->valueObj = (object) $naoConformidadesVo;
		
		//Inicializar variaveis
		$idPedidos = null;
		$justificativaNaoConformidades = '';
		$dataNaoConformidades = '';
		$contraMedidaNaoConformidades = '';
		$DomnMotivo = null;
		$idNaoConformidades = null;
		
		try 
		{
			$sql = mysqli_prepare($conecta,"UPDATE NaoConformidades SET idPedidos = ?, justificativaNaoConformidades = ?, dataNaoConformidades = ?, contraMedidaNaoConformidades = ?, DomnMotivo = ? WHERE idNaoConformidades = ?");
			mysqli_bind_param($sql,'issssi',$idPedidos, $justificativaNaoConformidades, $dataNaoConformidades, $contraMedidaNaoConformidades, $DomnMotivo, $idNaoConformidades);
			
			$idPedidos = $this->valueObj->getIdPedidos();
			$justificativaNaoConformidades = $this->valueObj->getJustificativaNaoConformidades();
			$dataNaoConformidades = $this->valueObj->getDataNaoConformidades();
			$contraMedidaNaoConformidades = $this->valueObj->getContraMedidasNaoConformidades();
			$DomnMotivo = $this->valueObj->getDomnMotivo();
			$idNaoConformidades = $this->valueObj->getIdNaoConformidades();
			
			if(!mysqli_stmt_execute($sql))
			{
				throw new Exception("Nгo foi possнvel conectar no banco de dados.");
			}
		}
		catch ( Exception $e)
		{
			throw new Exception("Nгo foi possнvel alterar na tabela NaoConformidades - ".$e->getMessage());
		}
	}
	
	/**
	 * Mйtodo de inserзгo na tabela de Papeis
	 * @author Joгo Batista Padilha e Silva
	 * @param PapeisVo $papeisVo
	 */
	public function inserirPapeis(PapeisVo $papeisVo)
	{
		$conecta = new Connecta();
		$this->valueObj = new PapeisVo();
		$this->valueObj = (object) $papeisVo;
		
		//Inicializar variaveis
		$nomePapeis = '';
		
		try 
		{
			$sql = mysqli_prepare($conecta,"INSERT INTO Papeis (idPapeis, nomePapeis) VALUES('',?)");
			mysqli_bind_param($sql,'s',$nomePapeis);
			
			$nomePapeis = $this->valueObj->getNomePapeis();
			
			if(!mysqli_stmt_execute($sql))
			{
				throw new Exception("Nгo foi possнvel conectar no banco de dados.");
			}
		}
		catch ( Exception $e)
		{
			throw new Exception("Nгo foi possнvel incluir na tabela Papeis - ".$e->getMessage());
		}
	}
	
	/**
	 * Mйtodo de alteraзгo na tabela de Papeis
	 * @author Joгo Batista Padilha e Silva
	 * @param PapeisVo $papeisVo
	 */
	public function alterarPapeis(PapeisVo $papeisVo)
	{
		$conecta = new Connecta();
		$this->valueObj = new PapeisVo();
		$this->valueObj = (object) $papeisVo;
		
		//Inicializar variaveis
		$nomePapeis = '';
		$idPapeis = null;
		
		try 
		{
			$sql = "UPDATE Papeis SET nomePapeis = ? WHERE idPapeis = ?";
			$sql = mysqli_prepare($conecta,$sql);
			mysqli_bind_param($sql,'si',$nomePapeis, $idPapeis);
			
			$nomePapeis = $this->valueObj->getNomePapeis();
			$idPapeis = $this->valueObj->getIdPapeis();
			
			if(!mysqli_stmt_execute($sql))
			{
				throw new Exception("Nгo foi possнvel conectar no banco de dados.");
			}
		}
		catch ( Exception $e)
		{
			throw new Exception("Nгo foi possнvel alterar na tabela Papeis - ".$e->getMessage());
		}
	}
	
	/**
	 * Mйtodo de inserзгo na tabela de Papeis_Projetos
	 * @author Joгo Batista Padilha e Silva
	 * @param PapeisProjetosVo $papeisProjetosVo
	 */
	public function inserirPapeisProjetos(Papeis_ProjetosVo $papeisProjetosVo)
	{
		$conecta = new Connecta();
		$this->valueObj = new Papeis_ProjetosVo();
		$this->valueObj = (object) $papeisProjetosVo;
		
		//Inicializar variaveis
		$idPapeis = null;
		$idProjetos = null;
		$idUsuarios = null;
		
		try 
		{
			$sql = mysqli_prepare($conecta,"INSERT INTO Papeis_Projetos (idPapeis_Projetos, idPapeis, idProjetos, idUsuarios) VALUES('',?,?,?)");
			mysqli_bind_param($sql,'iii',$idPapeis, $idProjetos, $idUsuarios);
			
			$idPapeis = $this->valueObj->getIdPapeis();
			$idProjetos = $this->valueObj->getIdProjetos();
			$idUsuarios = $this->valueObj->getIdUsuarios();
			
			if(!mysqli_stmt_execute($sql))
			{
				throw new Exception("Nгo foi possнvel conectar no banco de dados.");
			}
		}
		catch ( Exception $e)
		{
			throw new Exception("Nгo foi possнvel incluir na tabela Papeis - ".$e->getMessage());
		}
	}
	
	/**
	 * Mйtodo para deletar Papeis Projetos
	 * @author Joгo Batista Padilha e Silva
	 * @param PapeisProjetosVo $papeisProjetosVo
	 */
	public function deletaPapeisProjetos(Papeis_ProjetosVo $papeisProjetosVo)
	{
		$conecta = new Connecta();
		$this->valueObj = new Papeis_ProjetosVo();
		$this->valueObj = (object) $papeisProjetosVo;
		
		//Inicializar variaveis
		$idProjetos = null;
		
		$sql = "DELETE FROM Papeis_Projetos WHERE idProjetos = ?";
		
		try 
		{
			$sql = mysqli_prepare($conecta,$sql);
			mysqli_bind_param($sql,'i',$idProjetos);
			$idProjetos = $this->valueObj->getIdProjetos();
			
			if(!mysqli_stmt_execute($sql))
			{
				throw new Exception("Nгo foi possнvel conectar no banco de dados.");
			}
		}
		catch ( Exception $e)
		{
			throw new Exception("Nгo foi possнvel deletar na tabela Papeis_Projetos - ".$e->getMessage());
		}
	}
	
	/**
	 * Mйtodo de inserзгo na tabela de Pedidos
	 * @author Joгo Batista Padilha e Silva
	 * @param PedidosVo $pedidosVo
	 */
	public function inserirPedidos(PedidosVo $pedidosVo)
	{
		$conecta = new Connecta();
		$this->valueObj = new PedidosVo();
		$this->valueObj = (object) $pedidosVo;
		
		//Inicializar variaveis
		$idUsuarios = null;
		$idAtividadesPontoFuncao = null;
		$idProjetos = null;
		$idVersoes = null;
		$idModulos = null;
		$idSubModulos = null;
		$dataHoraAberturaPedidos = '';
		$precedentePedidos = null;
		$DomnStatusPedidos = null;
		$DomnSeveridadePedidos = null;
		$assuntoPedidos = '';
		
		try 
		{
			$sql = mysqli_prepare($conecta,"INSERT INTO Pedidos (idPedidos, idUsuarios, idAtividadesPontoFuncaoHoras, idProjetos, idVersoes, idModulos, idSubModulos, dataHoraPrevisaoPedidos, precedentePedidos, DomnStatusPedidos, DomnSeveridadePedidos, assuntoPedidos) VALUES('',?,?,?,?,?,?,?,?,?,?,?)");
			mysqli_bind_param($sql,'iiiiiisiiis',$idUsuarios, $idAtividadesPontoFuncao, $idProjetos, $idVersoes, $idModulos, $idSubModulos, $dataHoraPrevisaoPedidos,$precedentePedidos, $DomnStatusPedidos, $DomnSeveridadePedidos, $assuntoPedidos);
			
			$idUsuarios = $this->valueObj->getIdUsuarios();
			$idAtividadesPontoFuncao = $this->valueObj->getIdAtividadesPontoFuncaoHoras();
			$idProjetos = $this->valueObj->getIdProjetos();
			$idVersoes = $this->valueObj->getIdVersoes();
			$idModulos = $this->valueObj->getIdModulos();
			$idSubModulos = $this->valueObj->getIdSubModulos();
			$dataHoraPrevisaoPedidos = $this->valueObj->getDataHoraPrevisaoPedidos();
			$precedentePedidos = $this->valueObj->getPrecedentePedidos();
			$DomnStatusPedidos = $this->valueObj->getDomnStatusPedidos();
			$DomnSeveridadePedidos = $this->valueObj->getDomnSeveridadePedidos();
			$assuntoPedidos = $this->valueObj->getAssuntoPedido();
			
			if(!mysqli_stmt_execute($sql))
			{
				throw new Exception("Nгo foi possнvel conectar no banco de dados.");
			}
			
			$ultimoId = self::ultimoIdInserido($conecta);
		}
		catch ( Exception $e)
		{
			throw new Exception("Nгo foi possнvel incluir na tabela Pedidos - ".$e->getMessage());
		}
		return $ultimoId;
	}
	
	/**
	 * Mйtodo de alteraзгo na tabela de Pedidos
	 * @author Joгo Batista Padilha e Silva
	 * @param PedidosVo $pedidosVo
	 */
	public function alterarPedidos(PedidosVo $pedidosVo)
	{
		$conecta = new Connecta();
		$this->valueObj = new PedidosVo();
		$this->valueObj = (object) $pedidosVo;
		
		//Inicializar variaveis
		$idUsuarios = null;
		$idAtividadesPontoFuncao = null;
		$idProjetos = null;
		$idVersoes = null;
		$idModulos = null;
		$idSubModulos = null;
		$dataHoraAberturaPedidos = '';
		$dataHoraPrevisaoPedidos = '';
		$dataHoraAtendimentoPedidos = '';
		$precedentePedidos = null;
		$DomnStatusPedidos = null;
		$DomnSeveridadePedidos = null;
		$assuntoPedidos = '';
		$idPedidos = null;
		
		try 
		{
			$sql = mysqli_prepare($conecta,"UPDATE Pedidos SET idUsuarios = ?, idAtividadesPontoFuncaoHoras = ?, idProjetos = ?, idVersoes = ?, idModulos = ?, idSubModulos = ?, dataHoraPrevisaoPedidos = ?, precedentePedidos = ?, DomnStatusPedidos = ?, DomnSeveridadePedidos = ?, assuntoPedidos = ? WHERE idPedidos = ?");
			mysqli_bind_param($sql,'iiiiiisiiisi',$idUsuarios, $idAtividadesPontoFuncao, $idProjetos, $idVersoes, $idModulos, $idSubModulos, $dataHoraPrevisaoPedidos, $precedentePedidos, $DomnStatusPedidos, $DomnSeveridadePedidos, $assuntoPedidos, $idPedidos);
			
			$idUsuarios = $this->valueObj->getIdUsuarios();
			$idAtividadesPontoFuncao = $this->valueObj->getIdAtividadesPontoFuncaoHoras();
			$idProjetos = $this->valueObj->getIdProjetos();
			$idVersoes = $this->valueObj->getIdVersoes();
			$idModulos = $this->valueObj->getIdModulos();
			$idSubModulos = $this->valueObj->getIdSubModulos();
			$dataHoraPrevisaoPedidos = $this->valueObj->getDataHoraPrevisaoPedidos();
			$precedentePedidos = $this->valueObj->getPrecedentePedidos();
			$DomnStatusPedidos = $this->valueObj->getDomnStatusPedidos();
			$DomnSeveridadePedidos = $this->valueObj->getDomnSeveridadePedidos();
			$assuntoPedidos = $this->valueObj->getAssuntoPedido();
			$idPedidos = $this->valueObj->getIdPedidos();
			
			if(!mysqli_stmt_execute($sql))
			{
				throw new Exception("Nгo foi possнvel conectar no banco de dados.");
			}
		}
		catch ( Exception $e)
		{
			throw new Exception("Nгo foi possнvel alterar na tabela Pedidos - ".$e->getMessage());
		}
	}
	
	/**
	 * Mйtodo de inserзгo na tabela de Permissao_Usuarios_Funcionalidades_Papeis
	 * @author Joгo Batista Padilha e Silva
	 * @param Permissao_Usuarios_Funcionalidades_PapeisVo $permUserFuncPapeisVo
	 */
	public function inserirPermissaoUsuariosFuncionalidadesPapeis(Permissao_Usuarios_Funcionalidades_PapeisVo $permUserFuncPapeisVo)
	{
		$conecta = new Connecta();
		$this->valueObj = new Permissao_Usuarios_Funcionalidades_PapeisVo();
		$this->valueObj = (object) $permUserFuncPapeisVo;
		
		//Inicializar variaveis
		$idUsuarios = null;
		$idPapeis = null;
		$idFuncionalidades = null;
		
		try 
		{
			$sql = mysqli_prepare($conecta,"INSERT INTO Permissao_Usuarios_Funcionalidades_Papeis (idPermissao_Usuarios_Funcionalidades_Papeis, idUsuarios, idPapeis, idFuncionalidades) VALUES('',?,?,?)");
			mysqli_bind_param($sql,'iii',$idUsuarios, $idPapeis, $idFuncionalidades);
			
			$idUsuarios = $this->valueObj->getIdUsuarios();
			$idPapeis = $this->valueObj->getIdPapeis();
			$idFuncionalidades = $this->valueObj->getIdFuncionalidades();
			
			if(!mysqli_stmt_execute($sql))
			{
				throw new Exception("Nгo foi possнvel conectar no banco de dados.");
			}
		}
		catch ( Exception $e)
		{
			throw new Exception("Nгo foi possнvel incluir na tabela Permissao_Usuarios_Funcionalidades_Papeis - ".$e->getMessage());
		}
	}
	
	/**
	 * Mйtodo de alteraзгo na tabela de Permissao_Usuarios_Funcionalidades_Papeis
	 * @author Joгo Batista Padilha e Silva
	 * @param Permissao_Usuarios_Funcionalidades_PapeisVo $permUserFuncPapeisVo
	 */
	public function alterarPermissaoUsuariosFuncionalidadesPapeis(Permissao_Usuarios_Funcionalidades_PapeisVo $permUserFuncPapeisVo)
	{
		$conecta = new Connecta();
		$this->valueObj = new Permissao_Usuarios_Funcionalidades_PapeisVo();
		$this->valueObj = (object) $permUserFuncPapeisVo;
		
		//Inicializar variaveis
		$idUsuarios = null;
		$idPapeis = null;
		$idFuncionalidades = null;
		$idPermissaoUsuariosFucionalidadesPedidos = null;
		
		try 
		{
			$sql = mysqli_prepare($conecta,"UPDATE Permissao_Usuarios_Funcionalidades_Papeis SET idUsuarios = ?, idPapeis = ?, idFuncionalidades = ? WHERE idPermissao_Usuarios_Funcionalidades_Papeis = ?");
			mysqli_bind_param($sql,'iiii',$idUsuarios, $idPapeis, $idFuncionalidades, $idPermissaoUsuariosFucionalidadesPedidos);
			
			$idUsuarios = $this->valueObj->getIdUsuarios();
			$idPapeis = $this->valueObj->getIdPapeis();
			$idFuncionalidades = $this->valueObj->getIdFuncionalidades();
			$idPermissaoUsuariosFucionalidadesPedidos = $this->valueObj->getIdPermissao_Usuarios_Funcionalidades_Papeis();
			
			if(!mysqli_stmt_execute($sql))
			{
				throw new Exception("Nгo foi possнvel conectar no banco de dados.");
			}
		}
		catch ( Exception $e)
		{
			throw new Exception("Nгo foi possнvel alterar na tabela Permissao_Usuarios_Funcionalidades_Papeis - ".$e->getMessage());
		}
	}
	
	/**
	 * Mйtodo para deletar Permissгo a partir do Papel ou do id do Usuбrio
	 * @author Joгo Batista Padilha e Silva
	 * @param Permissao_Usuarios_Funcionalidades_PapeisVo $permUserFuncPapeisVo
	 */
	public function deletarPermissaoUsuariosFuncionalidadesPapeis(Permissao_Usuarios_Funcionalidades_PapeisVo $permUserFuncPapeisVo)
	{
		$conecta = new Connecta();
		$this->valueObj = new Permissao_Usuarios_Funcionalidades_PapeisVo();
		$this->valueObj = (object) $permUserFuncPapeisVo;
		
		//Inicializar variaveis
		$idUsuarios = null;
		$idPapeis = null;
		
		$sql = "DELETE FROM Permissao_Usuarios_Funcionalidades_Papeis WHERE ";

		if($this->valueObj->getIdPapeis() != '')
		{
			$sql = $sql."idPapeis = ?";
		}
		elseif ($this->valueObj->getIdUsuarios() != '')
		{
			$sql = $sql."idUsuarios = ?";
		}
		elseif ($this->valueObj->getIdPapeis() != '' && $this->valueObj->getIdUsuarios() != '')
		{
			$sql = $sql . "idPapeis = ? AND idUsuarios = ?";
		}
		
		try 
		{
			$sql = mysqli_prepare($conecta,$sql);
			
			if($this->valueObj->getIdPapeis() != '')
			{
				mysqli_bind_param($sql,'i',$idPapeis);
			}
			elseif ($this->valueObj->getIdUsuarios() != '')
			{
				mysqli_bind_param($sql,'i',$idUsuarios);
			}
			elseif ($this->valueObj->getIdPapeis() != '' && $this->valueObj->getIdUsuarios() != '')
			{
				mysqli_bind_param($sql,'ii',$idPapeis,$idUsuarios);
			}
			
			$idUsuarios = $this->valueObj->getIdUsuarios();
			$idPapeis = $this->valueObj->getIdPapeis();
			
			if(!mysqli_stmt_execute($sql))
			{
				throw new Exception("Nгo foi possнvel conectar no banco de dados.");
			}
		}
		catch ( Exception $e)
		{
			throw new Exception("Nгo foi possнvel deletar na tabela Permissao_Usuarios_Funcionalidades_Papeis - ".$e->getMessage());
		}
	}
	
	/**
	 * Mйtodo de inserзгo na tabela de Projetos
	 * @author Joгo Batista Padilha e Silva
	 * @param ProjetosVo $projetosVo
	 */
	public function inserirProjetos(ProjetosVo $projetosVo)
	{
		$conecta = new Connecta();
		$this->valueObj = new ProjetosVo();
		$this->valueObj = (object) $projetosVo;
		
		//Inicializar variaveis
		$nomeProjetos = '';
		$idGrupoFluxos = null;
		$idClientes = null;
		
		try 
		{
			$sql = mysqli_prepare($conecta,"INSERT INTO Projetos (idProjetos, nomeProjetos, idGrupoFluxos, idClientes) VALUES('',?,?,?)");
			mysqli_bind_param($sql,'sii',$nomeProjetos,$idGrupoFluxos,$idClientes);
			
			$nomeProjetos = $this->valueObj->getNomeProjetos();
			$idGrupoFluxos = $this->valueObj->getIdGrupoFluxos();
			$idClientes = $this->valueObj->getIdClientes();
			
			if(!mysqli_stmt_execute($sql))
			{
				throw new Exception("Nгo foi possнvel conectar no banco de dados.");
			}
		}
		catch ( Exception $e)
		{
			throw new Exception("Nгo foi possнvel incluir na tabela Projetos - ".$e->getMessage());
		}
	}
	
	/**
	 * Mйtodo de alteraзгo na tabela de Projetos
	 * @author Joгo Batista Padilha e Silva
	 * @param ProjetosVo $projetosVo
	 */
	public function alterarProjetos(ProjetosVo $projetosVo)
	{
		$conecta = new Connecta();
		$this->valueObj = new ProjetosVo();
		$this->valueObj = (object) $projetosVo;
		
		//Inicializar variaveis
		$nomeProjetos = '';
		$idGrupoFluxos = null;
		$idClientes = null;
		$idProjetos = null;
		
		try 
		{
			$sql = mysqli_prepare($conecta,"UPDATE Projetos SET nomeProjetos = ?, idGrupoFluxos = ?, idClientes = ? WHERE idProjetos = ?");
			mysqli_bind_param($sql,'siii',$nomeProjetos, $idGrupoFluxos, $idClientes, $idProjetos);
			
			$nomeProjetos = $this->valueObj->getNomeProjetos();
			$idGrupoFluxos = $this->valueObj->getIdGrupoFluxos();
			$idClientes = $this->valueObj->getIdClientes();
			$idProjetos = $this->valueObj->getIdProjetos();
			
			if(!mysqli_stmt_execute($sql))
			{
				throw new Exception("Nгo foi possнvel conectar no banco de dados.");
			}
		}
		catch ( Exception $e)
		{
			throw new Exception("Nгo foi possнvel alterar na tabela Projetos - ".$e->getMessage());
		}
	}
	
	/**
	 * Mйtodo de inserзгo na tabela de Projetos_Modulos
	 * @author Joгo Batista Padilha e Silva
	 * @param Projetos_ModulosVo $Projetos_ModulosVo
	 */
	public function inserirProjetosModulos(Projetos_ModulosVo $Projetos_ModulosVo)
	{
		$conecta = new Connecta();
		$this->valueObj = new Projetos_ModulosVo();
		$this->valueObj = (object) $Projetos_ModulosVo;
		
		//Inicializar variaveis
		$idProjetos = null;
		$idModulos = null;
		
		try 
		{
			$sql = mysqli_prepare($conecta,"INSERT INTO Projetos_Modulos (idProjetos_Modulos, idProjetos, idModulos) VALUES('',?,?)");
			mysqli_bind_param($sql,'ii',$idProjetos, $idModulos);
			
			$idProjetos = $this->valueObj->getIdProjetos();
			$idModulos = $this->valueObj->getIdModulos();
			
			if(!mysqli_stmt_execute($sql))
			{
				throw new Exception("Nгo foi possнvel conectar no banco de dados.");
			}
		}
		catch ( Exception $e)
		{
			throw new Exception("Nгo foi possнvel incluir na tabela Projetos_Modulos - ".$e->getMessage());
		}
	}
	
	/**
	 * Mйtodo de deleзгo na tabela de Projetos_Modulos
	 * @author Joгo Batista Padilha e Silva
	 * @param Projetos_ModulosVo $Projetos_ModulosVo
	 */
	public function deletarProjetosModulos(Projetos_ModulosVo $Projetos_ModulosVo)
	{
		$conecta = new Connecta();
		$this->valueObj = new Projetos_ModulosVo();
		$this->valueObj = (object) $Projetos_ModulosVo;
		
		//Inicializar variaveis
		$idProjetos = null;
		
		try 
		{
			$sql = "DELETE FROM Projetos_Modulos WHERE idProjetos = ?";
			$sql = mysqli_prepare($conecta,$sql);
			mysqli_bind_param($sql,'i',$idProjetos);
			$idProjetos = $this->valueObj->getIdProjetos();
			
			if(!mysqli_stmt_execute($sql))
			{
				throw new Exception("Nгo foi possнvel conectar no banco de dados.");
			}
		}
		catch ( Exception $e)
		{
			throw new Exception("Nгo foi possнvel deletar na tabela Projetos_Modulos - ".$e->getMessage());
		}
	}
	
	/**
	 * Mйtodo de inserзгo na tabela de SubModulos
	 * @author Joгo Batista Padilha e Silva
	 * @param SubModulosVo $subModulosVo
	 */
	public function inserirSubModulos(SubModulosVo $subModulosVo)
	{
		$conecta = new Connecta();
		$this->valueObj = new SubModulosVo();
		$this->valueObj = (object) $subModulosVo;
		
		//Inicializar variaveis
		$nomeSubModulos = '';
		
		try 
		{
			$sql = mysqli_prepare($conecta,"INSERT INTO SubModulos (idSubModulos, nomeSubModulos) VALUES('',?)");
			mysqli_bind_param($sql,'s',$nomeSubModulos);
			
			$nomeSubModulos = $this->valueObj->getNomeSubModulos();
			
			if(!mysqli_stmt_execute($sql))
			{
				throw new Exception("Nгo foi possнvel conectar no banco de dados.");
			}
		}
		catch ( Exception $e)
		{
			throw new Exception("Nгo foi possнvel incluir na tabela SubModulos - ".$e->getMessage());
		}
	}
	
	/**
	 * Mйtodo de alteraзгo na tabela de SubModulos
	 * @author Joгo Batista Padilha e Silva
	 * @param SubModulosVo $subModulosVo
	 */
	public function alterarSubModulos(SubModulosVo $subModulosVo)
	{
		$conecta = new Connecta();
		$this->valueObj = new SubModulosVo();
		$this->valueObj = (object) $subModulosVo;
		
		//Inicializar variaveis
		$nomeSubModulos = '';
		$idSubModulos = null;
		
		try 
		{
			$sql = mysqli_prepare($conecta,"UPDATE SubModulos SET nomeSubModulos = ? WHERE idSubModulos = ?");
			mysqli_bind_param($sql,'si',$nomeSubModulos, $idSubModulos);
			
			$nomeSubModulos = $this->valueObj->getNomeSubModulos();
			$idSubModulos = $this->valueObj->getIdSubModulos();
			
			if(!mysqli_stmt_execute($sql))
			{
				throw new Exception("Nгo foi possнvel conectar no banco de dados.");
			}
		}
		catch ( Exception $e)
		{
			throw new Exception("Nгo foi possнvel alterar na tabela SubModulos - ".$e->getMessage());
		}
	}
	
	/**
	 * Mйtodo de inserзгo na tabela de TabelaBasica
	 * @author Joгo Batista Padilha e Silva
	 * @param TabelaBasicaVo $tabelaBasicaVo
	 */
	public function inserirTabelaBasica(TabelaBasicaVo $tabelaBasicaVo)
	{
		$conecta = new Connecta();
		$this->valueObj = new TabelaBasicaVo();
		$this->valueObj = (object) $tabelaBasicaVo;
		
		//Inicializar variaveis
		$emailPadraoTabelaBasica = '';
		$nomeRemetenteTabelaBasica = '';
		$toleranciaHoraConformidade = '';
		
		$horasBaseTrabalhadasTabelaBasica = '';
		$horasNaoTrabalhadasTabelaBasica = '';
		$horasInicioTrabalhoTabelaBasica = '';
		$horasFimTrabalhoTabelaBasica = '';
		$horasIntervaloInicioTabelaBasica = '';
		$horasIntervaloFimTabelaBasica = '';
		$horasBaseRecebimentoPedido = '';
		
		try 
		{
			$sql = mysqli_prepare($conecta,"INSERT INTO TabelaBasica (idTabelaBasica, emailPadraoTabelaBasica, nomeRemetenteTabelaBasica, toleranciaHoraConformidade, horasBaseTrabalhadasTabelaBasica, horasNaoTrabalhadasBaseTabelaBasica, horasInicioTrabalhoTabelaBasica, horasFimTrabalhoTabelaBasica, horasIntervaloInicioTabelaBasica, horasIntervaloFimTabelaBasica, horasBaseRecebimentoPedido) VALUES('',?,?,?,?,?,?,?,?,?,?)");
			mysqli_bind_param($sql,'ssssssssss',$emailPadraoTabelaBasica, $nomeRemetenteTabelaBasica, $toleranciaHoraConformidade, $horasBaseTrabalhadasTabelaBasica, $horasNaoTrabalhadasTabelaBasica, $horasInicioTrabalhoTabelaBasica, $horasFimTrabalhoTabelaBasica, $horasIntervaloInicioTabelaBasica, $horasIntervaloFimTabelaBasica, $horasBaseRecebimentoPedido);
			
			$emailPadraoTabelaBasica = $this->valueObj->getEmailPadraoTabelaBasica();
			$nomeRemetenteTabelaBasica = $this->valueObj->getNomeRemetenteTabelaBasica();
			$toleranciaHoraConformidade = $this->valueObj->getToleranciaHoraConformidade();
			
			$horasBaseTrabalhadasTabelaBasica = $this->valueObj->getHorasBaseTrabalhadasTabelaBasica();
			$horasNaoTrabalhadasTabelaBasica = $this->valueObj->getHorasNaoTrabalhadasBaseTabelaBasica();
			$horasInicioTrabalhoTabelaBasica = $this->valueObj->getHorasInicioTrabalhoTabelaBasica();
			$horasFimTrabalhoTabelaBasica = $this->valueObj->getHorasFimTrabalhoTabelaBasica();
			$horasIntervaloInicioTabelaBasica = $this->valueObj->getHorasIntervaloInicioTabelaBasica();
			$horasIntervaloFimTabelaBasica = $this->valueObj->getHorasIntervaloFimTabelaBasica();
			$horasBaseRecebimentoPedido = $this->valueObj->getHorasBaseRecebimentoPedido();
			
			if(!mysqli_stmt_execute($sql))
			{
				throw new Exception("Nгo foi possнvel conectar no banco de dados.");
			}
		}
		catch ( Exception $e)
		{
			throw new Exception("Nгo foi possнvel incluir na tabela TabelaBasica - ".$e->getMessage());
		}
	}
	
	/**
	 * Mйtodo de alteraзгo na tabela de TabelaBasica
	 * @author Joгo Batista Padilha e Silva
	 * @param TabelaBasicaVo $tabelaBasicaVo
	 */
	public function alterarTabelaBasica(TabelaBasicaVo $tabelaBasicaVo)
	{
		$conecta = new Connecta();
		$this->valueObj = new TabelaBasicaVo();
		$this->valueObj = (object) $tabelaBasicaVo;
		
		//Inicializar variaveis
		$emailPadraoTabelaBasica = '';
		$nomeRemetenteTabelaBasica = '';
		$toleranciaHoraConformidade = '';
		$idTabelaBasica = null;
		
		$horasBaseTrabalhadasTabelaBasica = '';
		$horasNaoTrabalhadasTabelaBasica = '';
		$horasInicioTrabalhoTabelaBasica = '';
		$horasFimTrabalhoTabelaBasica = '';
		$horasIntervaloInicioTabelaBasica = '';
		$horasIntervaloFimTabelaBasica = '';
		$horasBaseRecebimentoPedido = '';
		
		try 
		{
			$sql = mysqli_prepare($conecta,"UPDATE TabelaBasica SET emailPadraoTabelaBasica = ?, nomeRemetenteTabelaBasica = ?, toleranciaHoraConformidade = ? , horasBaseTrabalhadasTabelaBasica = ?, horasNaoTrabalhadasBaseTabelaBasica = ?, horasInicioTrabalhoTabelaBasica = ?, horasFimTrabalhoTabelaBasica = ?, horasIntervaloInicioTabelaBasica = ?, horasIntervaloFimTabelaBasica = ?, horasBaseRecebimentoPedido = ? WHERE idTabelaBasica = ?");
			mysqli_bind_param($sql,'ssssssssssi',$emailPadraoTabelaBasica, $nomeRemetenteTabelaBasica, $toleranciaHoraConformidade, $horasBaseTrabalhadasTabelaBasica, $horasNaoTrabalhadasTabelaBasica, $horasInicioTrabalhoTabelaBasica, $horasFimTrabalhoTabelaBasica, $horasIntervaloInicioTabelaBasica, $horasIntervaloFimTabelaBasica, $horasBaseRecebimentoPedido, $idTabelaBasica);
			
			$emailPadraoTabelaBasica = $this->valueObj->getEmailPadraoTabelaBasica();
			$nomeRemetenteTabelaBasica = $this->valueObj->getNomeRemetenteTabelaBasica();
			$toleranciaHoraConformidade = $this->valueObj->getToleranciaHoraConformidade();
			
			$horasBaseTrabalhadasTabelaBasica = $this->valueObj->getHorasBaseTrabalhadasTabelaBasica();
			$horasNaoTrabalhadasTabelaBasica = $this->valueObj->getHorasNaoTrabalhadasBaseTabelaBasica();
			$horasInicioTrabalhoTabelaBasica = $this->valueObj->getHorasInicioTrabalhoTabelaBasica();
			$horasFimTrabalhoTabelaBasica = $this->valueObj->getHorasFimTrabalhoTabelaBasica();
			$horasIntervaloInicioTabelaBasica = $this->valueObj->getHorasIntervaloInicioTabelaBasica();
			$horasIntervaloFimTabelaBasica = $this->valueObj->getHorasIntervaloFimTabelaBasica();
			$horasBaseRecebimentoPedido = $this->valueObj->getHorasBaseRecebimentoPedido();
			
			$idTabelaBasica = $this->valueObj->getIdTabelaBasica();
			
			if(!mysqli_stmt_execute($sql))
			{
				throw new Exception("Nгo foi possнvel conectar no banco de dados.");
			}
		}
		catch ( Exception $e)
		{
			throw new Exception("Nгo foi possнvel alterar na tabela TabelaBasica - ".$e->getMessage());
		}
	}
	
	/**
	 * Mйtodo de inserзгo na tabela de Tecnologias
	 * @author Joгo Batista Padilha e Silva
	 * @param TecnologiasVo $tecnologiasVo
	 */
	public function inserirTecnologias(TecnologiasVo $tecnologiasVo)
	{
		$conecta = new Connecta();
		$this->valueObj = new TecnologiasVo();
		$this->valueObj = (object) $tecnologiasVo;
		
		//Inicializar variaveis
		$nomeTecnologias = '';
		
		try 
		{
			$sql = mysqli_prepare($conecta,"INSERT INTO Tecnologias (idTecnologias, nomeTecnologias) VALUES('',?)");
			mysqli_bind_param($sql,'s',$nomeTecnologias);
			
			$nomeTecnologias = $this->valueObj->getNomeTecnologias();
			
			if(!mysqli_stmt_execute($sql))
			{
				throw new Exception("Nгo foi possнvel conectar no banco de dados.");
			}
		}
		catch ( Exception $e)
		{
			throw new Exception("Nгo foi possнvel incluir na tabela TabelaBasica - ".$e->getMessage());
		}
	}
	
	/**
	 * Mйtodo de alteraзгo na tabela de Tecnologias
	 * @author Joгo Batista Padilha e Silva
	 * @param TecnologiasVo $tecnologiasVo
	 */
	public function alterarTecnologias(TecnologiasVo $tecnologiasVo)
	{
		$conecta = new Connecta();
		$this->valueObj = new TecnologiasVo();
		$this->valueObj = (object) $tecnologiasVo;
		
		//Inicializar variaveis
		$nomeTecnologias = '';
		$idTecnologias = null;
		
		try 
		{
			$sql = mysqli_prepare($conecta,"UPDATE Tecnologias SET nomeTecnologias = ? WHERE idTecnologias = ?");
			mysqli_bind_param($sql,'si',$nomeTecnologias, $idTecnologias);
			
			$nomeTecnologias = $this->valueObj->getNomeTecnologias();
			$idTecnologias = $this->valueObj->getIdTecnologias();
			
			if(!mysqli_stmt_execute($sql))
			{
				throw new Exception("Nгo foi possнvel conectar no banco de dados.");
			}
		}
		catch ( Exception $e)
		{
			throw new Exception("Nгo foi possнvel alterar na tabela TabelaBasica - ".$e->getMessage());
		}
	}
	
	/**
	 * Mйtodo de inserзгo na tabela de Usuarios
	 * @author Joгo Batista Padilha e Silva
	 * @param UsuariosVo $usuariosVo
	 */
	public function inserirUsuarios(UsuariosVo $usuariosVo)
	{
		$conecta = new Connecta();
		$this->valueObj = new UsuariosVo();
		$this->valueObj = (object) $usuariosVo;
		
		//Inicializar variaveis
		$nomeUsuarios = '';
		$enderecoUsuarios = '';
		$cepUsuarios = null;
		$cidadeUsuarios = '';
		$emailUsuarios = '';
		$telUsuarios = null;
		$telCelUsuarios = null;
		$dataNascimentoUsuarios = '';
		$loginUsuarios = '';
		$senhaUsuarios = '';
		$flagUsuarios = false;
		$flagTipoUsuarios = true;
		
		try 
		{
			$sql = mysqli_prepare($conecta,"INSERT INTO Usuarios (idUsuarios, nomeUsuarios, enderecoUsuarios, cepUsuarios, cidadeUsuarios, emailUsuarios, telUsuarios, telCelUsuarios, dataNascimentoUsuarios, loginUsuarios, senhaUsuarios, flagSuspenso, flagTipoUsuarios) VALUES('',?,?,?,?,?,?,?,?,?,SHA1(?),?,?)");
			mysqli_bind_param($sql,'ssdssddsssss',$nomeUsuarios, $enderecoUsuarios, $cepUsuarios, $cidadeUsuarios, $emailUsuarios, $telUsuarios, $telCelUsuarios, $dataNascimentoUsuarios, $loginUsuarios, $senhaUsuarios, $flagUsuarios,$flagTipoUsuarios);
			
			$nomeUsuarios = $this->valueObj->getNomeUsuarios();
			$enderecoUsuarios = $this->valueObj->getEnderecoUsuarios();
			$cepUsuarios = $this->valueObj->getCepUsuarios();
			$cidadeUsuarios = $this->valueObj->getCidadeUsuarios();
			$emailUsuarios = $this->valueObj->getEmailUsuarios();
			$telUsuarios = $this->valueObj->getTelUsuarios();
			$telCelUsuarios = $this->valueObj->getTelCelUsuarios();
			$dataNascimentoUsuarios = $this->valueObj->getDataNascimentoUsuarios();
			$loginUsuarios = $this->valueObj->getLoginUsuarios();
			$senhaUsuarios = $this->valueObj->getSenhaUsuarios();
			$flagUsuarios = $this->valueObj->getFlagSuspenso();
			$flagTipoUsuarios = $this->valueObj->getFlagTipoUsuario();
			
			if(!mysqli_stmt_execute($sql))
			{
				throw new Exception("Nгo foi possнvel conectar no banco de dados.");
			}
		}
		catch ( Exception $e)
		{
			throw new Exception("Nгo foi possнvel incluir na tabela Usuбrios - ".$e->getMessage());
		}
	}
	
	/**
	 * Mйtodo de alteraзгo na tabela de Usuarios
	 * @author Joгo Batista Padilha e Silva
	 * @param UsuariosVo $usuariosVo
	 */
	public function alterarUsuarios(UsuariosVo $usuariosVo)
	{
		$conecta = new Connecta();
		$this->valueObj = new UsuariosVo();
		$this->valueObj = (object) $usuariosVo;
		
		//Inicializar variaveis
		$nomeUsuarios = '';
		$enderecoUsuarios = '';
		$cepUsuarios = null;
		$cidadeUsuarios = '';
		$emailUsuarios = '';
		$telUsuarios = null;
		$telCelUsuarios = null;
		$dataNascimentoUsuarios = '';
		$loginUsuarios = '';
		$flagUsuarios = false;
		$flagTipoUsuarios = true;
		$idUsuarios = null;
		
		try 
		{
			$sql = mysqli_prepare($conecta,"UPDATE Usuarios SET nomeUsuarios = ?, enderecoUsuarios = ?, cepUsuarios = ?, cidadeUsuarios = ?, emailUsuarios = ?, telUsuarios = ?, telCelUsuarios = ?, dataNascimentoUsuarios = ?, loginUsuarios = ?, flagSuspenso = ?, flagTipoUsuarios = ? WHERE idUsuarios = ?");
			mysqli_bind_param($sql,'ssdssddssssi',$nomeUsuarios, $enderecoUsuarios, $cepUsuarios, $cidadeUsuarios, $emailUsuarios, $telUsuarios, $telCelUsuarios, $dataNascimentoUsuarios, $loginUsuarios, $flagUsuarios, $flagTipoUsuarios, $idUsuarios);
			$nomeUsuarios = $this->valueObj->getNomeUsuarios();
			$enderecoUsuarios = $this->valueObj->getEnderecoUsuarios();
			$cepUsuarios = $this->valueObj->getCepUsuarios();
			$cidadeUsuarios = $this->valueObj->getCidadeUsuarios();
			$emailUsuarios = $this->valueObj->getEmailUsuarios();
			$telUsuarios = $this->valueObj->getTelUsuarios();
			$telCelUsuarios = $this->valueObj->getTelCelUsuarios();
			$dataNascimentoUsuarios = $this->valueObj->getDataNascimentoUsuarios();
			$loginUsuarios = $this->valueObj->getLoginUsuarios();
			$flagUsuarios = $this->valueObj->getFlagSuspenso();
			$flagTipoUsuarios = $this->valueObj->getFlagTipoUsuario();
			$idUsuarios = $this->valueObj->getIdUsuarios();
			
			if(!mysqli_stmt_execute($sql))
			{
				throw new Exception("Erro ao conectar no banco de dados.");
			}
		}
		catch ( Exception $e)
		{
			throw new Exception("Nгo foi possнvel alterar na tabela Usuarios - ".$e->getMessage());
		}
	}
	
	/**
	 * Mйtodo para alteraзгo de senha do usuбrio
	 * @author Rafael Henrique Vieira de Moura
	 * @param UsuariosVo $usuariosVo
	 */
	public function alterarSenhaUsuarios(UsuariosVo $usuariosVo)
	{
		$conecta = new Connecta();
		$this->valueObj = new UsuariosVo();
		$this->valueObj = (object) $usuariosVo;
		
		$senhaUsuarios = '';
		$idUsuarios = null;
		
		try 
		{
			$sql = mysqli_prepare($conecta,"UPDATE Usuarios SET senhaUsuarios = SHA1(?) WHERE idUsuarios = ?");
			mysqli_bind_param($sql,'si', $senhaUsuarios, $idUsuarios);
			
			$idUsuarios = $this->valueObj->getIdUsuarios();
			$senhaUsuarios = $this->valueObj->getSenhaUsuarios();
			
			if(!mysqli_stmt_execute($sql))
			{
				throw new Exception("Nгo foi possнvel conectar no banco de dados.");
			}
		}
		catch (Exception $e)
		{
			throw new Exception("Nгo foi possнvel alterar na tabela Usuarios - ".$e->getMessage());
		}
	}
	
	/**
	 * Mйtodo de inserзгo na tabela de Versхes
	 * @author Joгo Batista Padilha e Silva
	 * @param VersoesVo $versoesVo
	 */
	public function inserirVersoes(VersoesVo $versoesVo)
	{
		$conecta = new Connecta();
		$this->valueObj = new VersoesVo();
		$this->valueObj = (object) $versoesVo;
		
		//Inicializar variaveis
		$nomeVersoes = '';
		$dataEntregaVersoes = '';
		$idAnexos = null;
		$dataEntregaVersoesClientes = '';
		$idProjetos = null;
		
		try 
		{
			$sql = mysqli_prepare($conecta,"INSERT INTO Versoes (idVersoes, nomeVersoes, dataEntregaVersoes, idAnexos, dataEntregaVersoesClientes, idProjetos) VALUES('',?,?,?,?,?)");
			mysqli_bind_param($sql,'ssisi',$nomeVersoes, $dataEntregaVersoes, $idAnexos, $dataEntregaVersoesClientes,$idProjetos);
			
			$nomeVersoes = $this->valueObj->getNomeVersoes();
			$dataEntregaVersoes = $this->valueObj->getDataEntregaVersoes();
			$idAnexos = $this->valueObj->getIdAnexos();
			$dataEntregaVersoesClientes = $this->valueObj->getDataEntregaVersoesClientes();
			$idProjetos = $this->valueObj->getIdProjetos();
			
			if(!mysqli_stmt_execute($sql))
			{
				throw new Exception("Nгo foi possнvel conectar no banco de dados.");
			}
		}
		catch ( Exception $e)
		{
			throw new Exception("Nгo foi possнvel incluir na tabela Versoes - ".$e->getMessage());
		}
	}
	
	/**
	 * Mйtodo de alteraзгo na tabela de Versхes
	 * @author Joгo Batista Padilha e Silva
	 * @param VersoesVo $versoesVo
	 */
	public function alterarVersoes(VersoesVo $versoesVo)
	{
		$conecta = new Connecta();
		$this->valueObj = new VersoesVo();
		$this->valueObj = (object) $versoesVo;
		
		//Inicializar variaveis
		$nomeVersoes = '';
		$dataEntregaVersoes = '';
		$idAnexos = null;
		$idVersoes = null;
		$dataEntregaVersoesClientes = '';
		$idProjetos = null;
		
		try 
		{
			$sql = mysqli_prepare($conecta,"UPDATE Versoes SET nomeVersoes = ?, dataEntregaVersoes = ?, idAnexos = ?, dataEntregaVersoesClientes = ?, idProjetos = ? WHERE idVersoes = ?");
			mysqli_bind_param($sql,'ssssii',$nomeVersoes, $dataEntregaVersoes, $idAnexos, $dataEntregaVersoesClientes, $idProjetos, $idVersoes);
			
			$nomeVersoes = $this->valueObj->getNomeVersoes();
			$dataEntregaVersoes = $this->valueObj->getDataEntregaVersoes();
			$idAnexos = $this->valueObj->getIdAnexos();
			$idVersoes = $this->valueObj->getIdVersoes();
			$dataEntregaVersoesClientes = $this->valueObj->getDataEntregaVersoesClientes();
			$idProjetos = $this->valueObj->getIdProjetos();
			
			if(!mysqli_stmt_execute($sql))
			{
				throw new Exception("Nгo foi possнvel conectar no banco de dados.");
			}
		}
		catch ( Exception $e)
		{
			throw new Exception("Nгo foi possнvel alterar na tabela Versoes - ".$e->getMessage());
		}
	}
	
	/**
	 * Mйtodo que inclui na tabela de GrupoFluxos
	 * @author Joгo Batista Padilha e Silva
	 * @param GrupoFluxosVo $grupoFluxosVo
	 */
	public function inserirGrupoFluxos(GrupoFluxosVo $grupoFluxosVo)
	{
		$conecta = new Connecta();
		$this->valueObj = new GrupoFluxosVo();
		$this->valueObj = (object) $grupoFluxosVo;
		
		//Inicializar variaveis
		$nomeGrupoFluxos = '';
		
		try 
		{
			$sql = mysqli_prepare($conecta,"INSERT INTO GrupoFluxos (idgrupoFluxos, nomeGrupoFluxos) VALUES('',?)");
			mysqli_bind_param($sql,'s',$nomeGrupoFluxos);
			
			$nomeGrupoFluxos = $this->valueObj->getNomeGrupoFluxos();
			
			if(!mysqli_stmt_execute($sql))
			{
				throw new Exception("Nгo foi possнvel conectar no banco de dados.");
			}
		}
		catch ( Exception $e)
		{
			throw new Exception("Nгo foi possнvel incluir na tabela GrupoFluxos - ".$e->getMessage());
		}
	}
	
	/**
	 * Mйtodo que altera a tabela de Grupo de Fluxos
	 * @author Joгo Batista Padilha e Silva
	 * @param GrupoFluxosVo $grupoFluxosVo
	 */
	public function alterarGrupoFluxos(GrupoFluxosVo $grupoFluxosVo)
	{
		$conecta = new Connecta();
		$this->valueObj = new GrupoFluxosVo();
		$this->valueObj = (object) $grupoFluxosVo;
		
		//Inicializar variaveis
		$nomeGrupoFluxos = '';
		$idGrupoFluxos = null;
		
		try 
		{
			$sql = mysqli_prepare($conecta,"UPDATE GrupoFluxos SET nomeGrupoFluxos = ? WHERE idGrupoFluxos = ?");
			mysqli_bind_param($sql,'si',$nomeGrupoFluxos,$idGrupoFluxos);
			
			$nomeGrupoFluxos = $this->valueObj->getNomeGrupoFluxos();
			$idGrupoFluxos = $this->valueObj->getIdGrupoFluxos();
			
			if(!mysqli_stmt_execute($sql))
			{
				throw new Exception("Nгo foi possнvel conectar no banco de dados.");
			}
		}
		catch ( Exception $e)
		{
			throw new Exception("Nгo foi possнvel alterar na tabela GrupoFluxos - ".$e->getMessage());
		}
	}
	
	/**
	 * Mйtodo de retorno do ultimo Id Inserido na tabela
	 * @author Rafael Henrique Vieira de Moura
	 * @param connect $conexao
	 * @return int
	 */
	public function ultimoIdInserido($conexao)
	{
		$prepare = mysqli_prepare($conexao,"SELECT LAST_INSERT_ID()");
		if(!mysqli_stmt_execute($prepare))
			throw new Exception("Nгo foi possнvel conectar no banco de dados.");
		
		mysqli_stmt_bind_result($prepare,$id);
		while(mysqli_stmt_fetch($prepare))
		{
			$ultimoId = $id;
		}
		return $ultimoId;
	}
}
?>