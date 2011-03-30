<?php
/**
 * A Classe de consulta no Banco de Dados (Query Data Access Object). Ela é filha de Connecta.
 * 
 * @author João Batista Padilha e Silva/Rafael Henrique Vieira de Moura
 * @name QDAO
 * @copyright 2008
 */

class QDAO extends Connecta
{
	private $conecta;
	private $valueObj;
	private $array;
	private $sql;
	private $prepare;
	
	/**
	 * Metodo de pesquisa na tabela Anexos
	 * 
	 * @author Rafael Henrique Vieira de Moura 
	 * @access Public
	 * @param AnexosVo $anexosVo
	 * @return $this->array
	 */
	public function findAnexos(AnexosVo $anexosVo)
	{
		$this->valueObj = new AnexosVo();
		$this->valueObj = (object) $anexosVo;
		$this->conecta = new Connecta();
		$this->array = null;
		
		if (is_object($this->valueObj)) {
			if ($this->valueObj->getIdAnexos() != '') {
				$this->sql = "SELECT * FROM Anexos WHERE idAnexos = '{$this->valueObj->getIdAnexos()}'";
			} 
			else 
			{
				$this->sql = "SELECT * FROM Anexos {$this->valueObj->getParametroConsulta()}";
			}
		}
		
		try 
		{
			//Inicialização das variáveis
			$idAnexos = null;
			$nomeAnexos = '';
			$descricaoAnexos = '';
			$caminhoAnexos = '';
			$dataInclusaoAnexos = '';
			
			//Fim
			
			$prepare = mysqli_prepare($this->conecta,$this->sql);
			if(!mysqli_stmt_execute($prepare))
				throw new Exception("Não foi possível conectar no banco de dados.");
			
			mysqli_stmt_bind_result($prepare,$idAnexos,$nomeAnexos,$descricaoAnexos,$caminhoAnexos,$dataInclusaoAnexos);
			while(mysqli_stmt_fetch($prepare))
			{
				$this->valueObj = new AnexosVo();
				$this->valueObj->setIdAnexos($idAnexos);
				$this->valueObj->setNomeAnexos($nomeAnexos);
				$this->valueObj->setDescricaoAnexos($descricaoAnexos);
				$this->valueObj->setDataInclusaoAnexos($dataInclusaoAnexos);
				$this->valueObj->setCaminhoAnexos($caminhoAnexos);
				$this->array[] = $this->valueObj;
			}
		}
		catch (Exception $e)
		{
			throw new Exception("Não foi possível consultar tabela de Anexos - ".$e->getMessage());
		}
		return $this->array;
	}
	
	/**
	 * Método de pesquisa na tabela AtividadesPontoFuncaoHoras
	 *
	 * @author Rafael Henrique Vieira de Moura
	 * @access Public
	 * @param AtividadesPontoFuncaoHorasVo $atividadesPontoFuncaoHorasVo
	 * @return array $this->array
	 */
	public function findAtividadesPontoFuncaoHoras(AtividadesPontoFuncaoHorasVo $atividadesPontoFuncaoHorasVo)
	{
		$this->valueObj = new AtividadesPontoFuncaoHorasVo();
		$this->valueObj = (object) $atividadesPontoFuncaoHorasVo;
		$this->conecta = new Connecta();
		$this->array = null;
		
		if (is_object($this->valueObj)) {
			if ($this->valueObj->getIdAtividadePontoFuncaoHoras()!='') {
				$this->sql = "SELECT * FROM AtividadesPontoFuncaoHoras WHERE idAtividadesPontoFuncaoHoras = '{$this->valueObj->getIdAtividadePontoFuncaoHoras()}'";
			} else {
				$this->sql = "SELECT * FROM AtividadesPontoFuncaoHoras {$this->valueObj->getParametroConsulta()}";
			}
		}
		
		try 
		{
			//Inicialização das variáveis
			$idAtividadesPontoFuncaoHoras = null;
			$idTecnologias = null;
			$nomeAtividadesPontoFuncaoHoras = '';
			$pontoFuncaoAtividadesPontoFuncaoHoras = null;
			$horasAtividadesPontoFuncaoHoras = '';
			
			//Fim
			
			$prepare = mysqli_prepare($this->conecta,$this->sql);
			if(!mysqli_stmt_execute($prepare))
				throw new Exception("Não foi possível conectar no banco de dados.");
			
			mysqli_stmt_bind_result($prepare,$idAtividadesPontoFuncaoHoras,$idTecnologias,$nomeAtividadesPontoFuncaoHoras,$pontoFuncaoAtividadesPontoFuncaoHoras,$horasAtividadesPontoFuncaoHoras);
			while(mysqli_stmt_fetch($prepare))
			{
				$this->valueObj = new AtividadesPontoFuncaoHorasVo();
				$this->valueObj->setIdAtividadePontoFuncaoHoras($idAtividadesPontoFuncaoHoras);
				$this->valueObj->setIdTecnologias($idTecnologias);
				$this->valueObj->setNomeAtividadesPontoFuncaoHoras($nomeAtividadesPontoFuncaoHoras);
				$this->valueObj->setPontoFuncaoAtividadesPontoFuncaoHoras($pontoFuncaoAtividadesPontoFuncaoHoras);
				$this->valueObj->setHorasAtividadesPontoFuncaoHoras($horasAtividadesPontoFuncaoHoras);
				$this->array[] = $this->valueObj;
			}
		}
		catch (Exception $e)
		{
			throw new Exception("Não foi possível consultar tabela de Atividade Ponto Função - ".$e->getMessage());
		}
		return $this->array;
	}
	
	/**
	 * Método de pesquisa na tabela Clientes
	 *
	 * @author João Batista Padilha e Silva
	 * @access Public
	 * @param ClientesVo $clientesVo
	 * @return array $this->array
	 */
	public function findClientes(ClientesVo $clientesVo)
	{
		$this->valueObj = new ClientesVo();
		$this->valueObj = (object) $clientesVo;
		$this->conecta = new Connecta();
		$this->array = null;
		
		if(is_object($this->valueObj))
		{
			if($this->valueObj->getIdClientes()!='')
			{
				$this->sql = "SELECT * FROM Clientes WHERE idClientes = '{$this->valueObj->getIdClientes()}'";
			}
			else
			{
				$this->sql = "SELECT * FROM Clientes {$this->valueObj->getParametroConsulta()}";
			}
		}
		
		try 
		{
			//Inicialização das variáveis
			$idClientes = null;
			$nomeClientes = '';
			
			//Fim
			
			$prepare = mysqli_prepare($this->conecta,$this->sql);
			if(!mysqli_stmt_execute($prepare))
				throw new Exception("Não foi possível conectar no banco de dados.");
			
			mysqli_stmt_bind_result($prepare,$idClientes,$nomeClientes);
			while(mysqli_stmt_fetch($prepare))
			{
				$this->valueObj = new ClientesVo();
				$this->valueObj->setIdClientes($idClientes);
				$this->valueObj->setNomeClientes($nomeClientes);
				$this->array[] = $this->valueObj;
			}
		}
		catch (Exception $e)
		{
			throw new Exception("Não foi possível consultar tabela de Clientes - ".$e->getMessage());
		}
		return $this->array;
	}
	
	/**
	 * Método de pesquisa na tabela DestinatariosNaoConformidades
	 *
	 * @author Rafael Henrique Vieira de Moura
	 * @access Public
	 * @param DestinatariosNaoConformidadesVo $destinatariosNaoConformidadesVo
	 * @return array $this->array 
	 */
	public function findDestinatariosNaoConformidades(DestinatariosNaoConformidadesVo $destinatariosNaoConformidadesVo)
	{
		$this->valueObj = new DestinatariosNaoConformidadesVo();
		$this->valueObj = (object) $destinatariosNaoConformidadesVo;
		$this->conecta = new Connecta();
		$this->array = null;
		
		if (is_object($this->valueObj)) {
			if ($this->valueObj->getIdUsuarios()!='' && $this->valueObj->getIdProjetos()=='') {
				$this->sql = "SELECT idUsuarios, idProjetos FROM DestinatariosNaoConformidades WHERE idUsuarios = '{$this->valueObj->getIdUsuarios()}'";
			} elseif ($this->valueObj->getIdUsuarios()=='' && $this->valueObj->getIdProjetos()!='') {
				$this->sql = "SELECT idUsuarios, idProjetos FROM DestinatariosNaoConformidades WHERE idProjetos = '{$this->valueObj->getIdProjetos()}'";
			} elseif ($this->valueObj->getIdUsuarios()!='' && $this->valueObj->getIdProjetos()!='') {
				$this->sql = "SELECT idUsuarios, idProjetos FROM DestinatariosNaoConformidades WHERE idUsuarios = '{$this->valueObj->getIdUsuarios()}' AND idProjetos = '{$this->valueObj->getIdProjetos()}";
			} else {
				$this->sql = "SELECT idUsuarios, idProjetos FROM DestinatariosNaoConformidades {$this->valueObj->getParametroConsulta()}";
			}
		}
		
		try 
		{
			//Inicialização das variáveis
			$idUsuarios = null;
			$idProjetos = null;
			
			//Fim
			
			$prepare = mysqli_prepare($this->conecta,$this->sql);
			if(!mysqli_stmt_execute($prepare))
				throw new Exception("Não foi possível conectar no banco de dados.");
			
			mysqli_stmt_bind_result($prepare,$idUsuarios,$idProjetos);
			while(mysqli_stmt_fetch($prepare))
			{
				$this->valueObj = new DestinatariosNaoConformidadesVo();
				$this->valueObj->setIdUsuarios($idUsuarios);
				$this->valueObj->setIdProjetos($idProjetos);
				$this->array[] = $this->valueObj;
			}
			return $this->array;
		}
		catch (Exception $e)
		{
			throw new Exception("Não foi possível consultar tabela de Destinatarios Nao Conformidades - ".$e->getMessage());
		}
		return $this->array;
	}
	
	/**
	 * Método de pesquisa na tabela Funcionalidades
	 *
	 * @author Rafael Henrique Vieira de Moura
	 * @access Public
	 * @param FuncionalidadesVo $funcionalidadesVo
	 * @return array $this->array
	 */
	public function findFuncionalidades(FuncionalidadesVo $funcionalidadesVo)
	{
		$this->valueObj = new FuncionalidadesVo();
		$this->valueObj = (object) $funcionalidadesVo;
		$this->conecta = new Connecta();
		$this->array = null;
		
		if (is_object($this->valueObj)) {
			if ($this->valueObj->getIdFuncionalidades()!='') {
				$this->sql = "SELECT * FROM Funcionalidades WHERE idFuncionalidades = '{$this->valueObj->getIdFuncionalidades()}'";
			} else {
				$this->sql = "SELECT * FROM Funcionalidades {$this->valueObj->getParametroConsulta()}";
			}
		}
		
		try 
		{
			//Inicialização das variáveis
			$idFuncionalidades = null;
			$nomeFuncionalidades = '';
			$linkFuncionalidades = '';
			$DomnTipoFuncionalidades = null;
			$ordemFuncionalidades = null;
			$precedenteFuncionalidades = null;
			
			//Fim
			
			$prepare = mysqli_prepare($this->conecta,$this->sql);
			if(!mysqli_stmt_execute($prepare))
				throw new Exception("Não foi possível conectar no banco de dados.");
			
			mysqli_stmt_bind_result($prepare,$idFuncionalidades,$nomeFuncionalidades,$linkFuncionalidades,$DomnTipoFuncionalidades,$ordemFuncionalidades,$precedenteFuncionalidades);
			while(mysqli_stmt_fetch($prepare))
			{
				$this->valueObj = new FuncionalidadesVo();
				$this->valueObj->setIdFuncionalidades($idFuncionalidades);
				$this->valueObj->setNomeFuncionalidades($nomeFuncionalidades);
				$this->valueObj->setLinkFuncionalidades($linkFuncionalidades);
				$this->valueObj->setDomnTipoFuncionalidades($DomnTipoFuncionalidades);
				$this->valueObj->setOrdemFuncionalidades($ordemFuncionalidades);
				$this->valueObj->setPrecedenteFuncionalidades($precedenteFuncionalidades);
				$this->array[] = $this->valueObj;
			}
		}
		catch (Exception $e)
		{
			throw new Exception("Não foi possível consultar tabela de Funcionalidades - ".$e->getMessage());
		}
		return $this->array;
	}
	
	/**
	 * Método de pesquisa na tabela Fluxos
	 *
	 * @author Rafael Henrique Vieira de Moura
	 * @access Public
	 * @param FluxosVo $fluxosVo
	 * @return array $this->array
	 */
	public function findFluxos(FluxosVo $fluxosVo)
	{
		$this->valueObj = new FluxosVo();
		$this->valueObj = (object) $fluxosVo;
		$this->conecta = new Connecta();
		$this->array = null;
		
		if (is_object($this->valueObj)) {
			if ($this->valueObj->getIdFluxos()!='') {
				$this->sql = "SELECT * FROM Fluxos WHERE idFluxos = '{$this->valueObj->getIdFluxos()}'";
			} else {
				$this->sql = "SELECT * FROM Fluxos {$this->valueObj->getParametroConsulta()}";
			}
		}
		
		try 
		{
			//Inicialização das variáveis
			$idFluxos = null;
			$idGrupoFluxos = null;
			$idPapeisOrigem = null;
			$idPapeisDestinatario = null;
			$ordemFluxos = null;
			
			//Fim
			
			$prepare = mysqli_prepare($this->conecta,$this->sql);
			if(!mysqli_stmt_execute($prepare))
				throw new Exception("Não foi possível conectar no banco de dados.");
			
			mysqli_stmt_bind_result($prepare,$idFluxos,$idGrupoFluxos,$idPapeisOrigem,$idPapeisDestinatario,$ordemFluxos);
			while(mysqli_stmt_fetch($prepare))
			{
				$this->valueObj = new FluxosVo();
				$this->valueObj->setIdFluxos($idFluxos);
				$this->valueObj->setIdGrupoFluxos($idGrupoFluxos);
				$this->valueObj->setIdPapeisOrigem($idPapeisOrigem);
				$this->valueObj->setIdPapeisDestinatario($idPapeisDestinatario);
				$this->valueObj->setOrdemFluxos($ordemFluxos);
				$this->array[] = $this->valueObj;
			}
		}
		catch (Exception $e)
		{
			throw new Exception("Não foi possível consultar tabela de Fluxos - ".$e->getMessage());
		}
		return $this->array;
	}
	
	/**
	 * Método de pesquisa na tabela Historico_Pedidos
	 *
	 * @author Rafael Henrique Vieira de Moura
	 * @access Public
	 * @param Historico_PedidosVo $historico_PedidosVo
	 * @return array $this->array
	 */
	public function findHistorico_Pedidos(Historico_PedidosVo $historico_PedidosVo)
	{
		$this->valueObj = new Historico_PedidosVo();
		$this->valueObj = (object) $historico_PedidosVo;
		$this->conecta = new Connecta();
		$this->array = null;
		
		if (is_object($this->valueObj)) {
			if ($this->valueObj->getIdPedidos() != '')
			{
				$this->sql = "SELECT * FROM Historico_Pedidos WHERE idPedidos = '{$this->valueObj->getIdPedidos()}'";
			} 
			elseif ($this->valueObj->getIdHistorico_Pedidos() != '')
			{
				$this->sql = "SELECT * FROM Historico_Pedidos WHERE idHistorico_Pedidos = '{$this->valueObj->getIdHistorico_Pedidos()}'";
			}
			else 
			{
				$this->sql = "SELECT * FROM Historico_Pedidos {$this->valueObj->getParametroConsulta()}";
			}
		}
		
		try 
		{
			//Inicialização das variáveis
			$idHistorico_Pedidos = null;
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
			
			//Fim
			
			$prepare = mysqli_prepare($this->conecta,$this->sql);
			if(!mysqli_stmt_execute($prepare))
				throw new Exception("Não foi possível conectar no banco de dados.");
			
			mysqli_stmt_bind_result($prepare,$idHistorico_Pedidos,$idPedidos,$idAnexos,$idUsuariosOrigem,$idPapeisOrigem,$idUsuariosDestinatario,$idPapeisDestinatario,$dataHoraHistorico_Pedidos,$complementoHistorico_Pedidos,$idFluxos,$dataHoraAtendimentoHistorico_Pedidos, $idUsuariosHistorico_Pedidos, $idVersoes, $DomnStatusPedidoHistorico_Pedidos);
			while(mysqli_stmt_fetch($prepare))
			{
				$this->valueObj = new Historico_PedidosVo();
				$this->valueObj->setIdHistorico_Pedidos($idHistorico_Pedidos);
				$this->valueObj->setIdPedidos($idPedidos);
				$this->valueObj->setIdAnexos($idAnexos);
				$this->valueObj->setIdUsuarioOrigem($idUsuariosOrigem);
				$this->valueObj->setIdPapeisOrigem($idPapeisOrigem);
				$this->valueObj->setIdUsuariosDestinatario($idUsuariosDestinatario);
				$this->valueObj->setIdPapeisDestinatario($idPapeisDestinatario);
				$this->valueObj->setDataHoraHistorico_Pedidos($dataHoraHistorico_Pedidos);
				$this->valueObj->setComplementoHistorico_Pedidos($complementoHistorico_Pedidos);
				$this->valueObj->setIdFluxos($idFluxos);
				$this->valueObj->setDataHoraAtendimentoHistorico_Pedidos($dataHoraAtendimentoHistorico_Pedidos);
				$this->valueObj->setIdUsuarioHistorico_Pedidos($idUsuariosHistorico_Pedidos);
				$this->valueObj->setIdVersoes($idVersoes);
				$this->valueObj->setDomnStatusPedidoHistorico_Pedidos($DomnStatusPedidoHistorico_Pedidos);
				$this->array[] = $this->valueObj;
			}
		}
		catch (Exception $e)
		{
			throw new Exception("Não foi possível consultar tabela de Historico - ".$e->getMessage());
		}
		return $this->array;
	}
	
	/**
	 * Método de pesquisa na tabela Log_Suporte
	 *
	 * @author Rafael Henrique Vieira de Moura
	 * @access Public
	 * @param Log_SuporteVo $log_SuporteVo
	 * @return array $this->array
	 */
	public function findLog_Suporte(Log_SuporteVo $log_SuporteVo)
	{
		$this->valueObj = new Log_SuporteVo();
		$this->valueObj = (object) $log_SuporteVo;
		$this->conecta = new Connecta();
		$this->array = null;
		
		if (is_object($this->valueObj)) {
			if ($this->valueObj->getIdLog_Suporte()!='') {
				$this->sql = "SELECT * FROM Log_Suporte WHERE idLog_Suporte = '{$this->valueObj->getIdLog_Suporte()}'";
			} else {
				$this->sql = "SELECT * FROM Log_Suporte {$this->valueObj->getParametroConsulta()}";
			}
		}
		
		try 
		{
			//Inicialização das variáveis
			$idLog_Suporte = null;
			$idUsuarios = null;
			$idFuncionalidades = null;
			$DomnAcao = null;
			$dataCriacaoLog_Suporte = '';
			
			//Fim
			
			$prepare = mysqli_prepare($this->conecta,$this->sql);
			if(!mysqli_stmt_execute($prepare))
				throw new Exception("Não foi possível conectar no banco de dados.");
			
			mysqli_stmt_bind_result($prepare,$idLog_Suporte,$idUsuarios,$idFuncionalidades,$DomnAcao,$dataCriacaoLog_Suporte);
			while(mysqli_stmt_fetch($prepare))
			{
				$this->valueObj = new Log_SuporteVo();
				$this->valueObj->setIdLog_Suporte($idLog_Suporte);
				$this->valueObj->setIdUsuarios($idUsuarios);
				$this->valueObj->setIdFuncionalidades($idFuncionalidades);
				$this->valueObj->setDomnAcao($DomnAcao);
				$this->valueObj->setDataCriacaoLog_Suporte($dataCriacaoLog_Suporte);
				$this->array[] = $this->valueObj;
			}
		}
		catch (Exception $e)
		{
			throw new Exception("Não foi possível consultar tabela de Log Suporte - ".$e->getMessage());
		}
		return $this->array;
	}

	/**
	 * Método de pesquisa na tabela Modulos
	 *
	 * @author Rafael Henrique Vieira de Moura
	 * @access Public
	 * @param ModulosVo $modulosVo
	 * @return array $this->array
	 */
	public function findModulos(ModulosVo $modulosVo)
	{
		$this->valueObj = new ModulosVo();
		$this->valueObj = (object) $modulosVo;
		$this->conecta = new Connecta();
		$this->array = null;
		
		if (is_object($this->valueObj)) {
			if ($this->valueObj->getIdModulos()!='') {
				$this->sql = "SELECT * FROM Modulos WHERE idModulos = '{$this->valueObj->getIdModulos()}'";
			} else {
				$this->sql = "SELECT * FROM Modulos {$this->valueObj->getParametroConsulta()}";
			}
		}
		
		try 
		{
			//Inicialização das variáveis
			$idModulos = null;
			$nomeModulos = '';
			
			//Fim
			
			$prepare = mysqli_prepare($this->conecta,$this->sql);
			if(!mysqli_stmt_execute($prepare))
				throw new Exception("Não foi possível conectar no banco de dados.");
			
			mysqli_stmt_bind_result($prepare,$idModulos,$nomeModulos);
			while(mysqli_stmt_fetch($prepare))
			{
				$this->valueObj = new ModulosVo();
				$this->valueObj->setIdModulos($idModulos);
				$this->valueObj->setNomeModulos($nomeModulos);
				$this->array[] = $this->valueObj;
			}
		}
		catch (Exception $e)
		{
			throw new Exception("Não foi possível consultar tabela de Módulos - ".$e->getMessage());
		}
		return $this->array;
	}
	
	/**
	 * Método de pesquisa na tabela Modulos_SubModulos
	 *
	 * @author Rafael Henrique Vieira de Moura
	 * @access Public
	 * @param Modulos_SubModulosVo $modulos_SubModulosVo
	 * @return array $this->array
	 */
	public function findModulos_SubModulos(Modulos_SubModulosVo $modulos_SubModulosVo)
	{
		$this->valueObj = new Modulos_SubModulosVo();
		$this->valueObj = (object) $modulos_SubModulosVo;
		$this->conecta = new Connecta();
		$this->array = null;
		
		if (is_object($this->valueObj)) {
			if ($this->valueObj->getIdModulos() != '' && $this->valueObj->getIdSubModulos() == '') {
				$this->sql = "SELECT idModulos, idSubModulos FROM Modulos_SubModulos WHERE idModulos = '{$this->valueObj->getIdModulos()}'";
			} elseif ($this->valueObj->getIdModulos()=='' && $this->valueObj->getIdSubModulos()!='') {
				$this->sql = "SELECT idModulos, idSubModulos FROM Modulos_SubModulos WHERE idSubModulos = '{$this->valueObj->getIdSubModulos()}'";
			} elseif ($this->valueObj->getIdModulos()!='' && $this->valueObj->getIdSubModulos()!='') {
				$this->sql = "SELECT idModulos, idSubModulos FROM Modulos_SubModulos WHERE idModulos = '{$this->valueObj->getIdModulos()}' AND idSubModulos = '{$this->valueObj->getIdSubModulos()}'";
			} else {
				$this->sql = "SELECT idModulos, idSubModulos FROM Modulos_SubModulos {$this->valueObj->getParametroConsulta()}";
			}
		}
		
		try 
		{
			//Inicialização das variáveis
			$idModulos = null;
			$idSubModulos = null;
			
			//Fim
			
			$prepare = mysqli_prepare($this->conecta,$this->sql);
			if(!mysqli_stmt_execute($prepare))
				throw new Exception("Não foi possível conectar no banco de dados.");
			
			mysqli_stmt_bind_result($prepare,$idModulos,$idSubModulos);
			while(mysqli_stmt_fetch($prepare))
			{
				$this->valueObj = new Modulos_SubModulosVo();
				$this->valueObj->setIdModulos($idModulos);
				$this->valueObj->setIdSubModulos($idSubModulos);
				$this->array[] = $this->valueObj;
			}
		}
		catch (Exception $e)
		{
			throw new Exception("Não foi possível consultar tabela de Modulos/SubModulos - ".$e->getMessage());
		}
		return $this->array;
	}
	
	/**
	 * Método de pesquisa na tabela NaoConformidades
	 *
	 * @author Rafael Henrique Vieira de Moura
	 * @access Public
	 * @param NaoConformidadesVo $naoConformidadesVo
	 * @return array $this->array
	 */
	public function findNaoConformidades(NaoConformidadesVo $naoConformidadesVo)
	{
		$this->valueObj = new NaoConformidadesVo();
		$this->valueObj = (object) $naoConformidadesVo;
		$this->conecta = new Connecta();
		$this->array = null;
		
		if (is_object($this->valueObj)) {
			if ($this->valueObj->getIdNaoConformidades()!='') {
				$this->sql = "SELECT * FROM NaoConformidades WHERE idNaoConformidades = '{$this->valueObj->getIdNaoConformidades()}'";
			} else {
				$this->sql = "SELECT * FROM NaoConformidades {$this->valueObj->getParametroConsulta()}";
			}
		}
		
		try 
		{
			//Inicialização das variáveis
			$idNaoConformidades = null;
			$idPedidos = null;
			$justificativaNaoConformidades = '';
			$dataNaoConformidades = '';
			$contraMedidaNaoConformidades = '';
			$DomnMotivo = null;
			
			//Fim
			
			$prepare = mysqli_prepare($this->conecta,$this->sql);
			if(!mysqli_stmt_execute($prepare))
				throw new Exception("Não foi possível conectar no banco de dados.");
			
			mysqli_stmt_bind_result($prepare,$idNaoConformidades,$idPedidos,$justificativaNaoConformidades,$dataNaoConformidades,$contraMedidaNaoConformidades,$DomnMotivo);
			while(mysqli_stmt_fetch($prepare))
			{
				$this->valueObj = new NaoConformidadesVo();
				$this->valueObj->setIdNaoConformidades($idNaoConformidades);
				$this->valueObj->setIdPedidos($idPedidos);
				$this->valueObj->setJustificativaNaoConformidades($justificativaNaoConformidades);
				$this->valueObj->setDataNaoConformidades($dataNaoConformidades);
				$this->valueObj->setContraMedidasNaoConformidades($contraMedidaNaoConformidades);
				$this->valueObj->setDomnMotivo($DomnMotivo);
				$this->array[] = $this->valueObj;
			}
		}
		catch (Exception $e)
		{
			throw new Exception("Não foi possível consultar tabela de Não Conformidades - ".$e->getMessage());
		}
		return $this->array;
	}
	
	/**
	 * Método de pesquisa na tabela Papeis
	 *
	 * @author Rafael Henrique Vieira de Moura
	 * @access Public
	 * @param PapeisVo $papeisVo
	 * @return array $this->array
	 */
	public function findPapeis(PapeisVo $papeisVo)
	{
		$this->valueObj = new PapeisVo();
		$this->valueObj = (object) $papeisVo;
		$this->conecta = new Connecta();
		$this->array = null;
		
		if (is_object($this->valueObj)) {
			if ($this->valueObj->getIdPapeis() != '') 
			{
				$this->sql = "SELECT * FROM Papeis WHERE idPapeis = '{$this->valueObj->getIdPapeis()}'";
			}
			elseif ($this->valueObj->getNomePapeis() != '')
			{
				$this->sql = "SELECT * FROM Papeis WHERE nomePapeis Like '%{$this->valueObj->getNomePapeis()}%'";
			}
			else
			{
				$this->sql = "SELECT * FROM Papeis {$this->valueObj->getParametroConsulta()}";
			}
		}
		
		try 
		{
			//Inicialização das variáveis
			$idPapeis = null;
			$nomePapeis = '';
			
			//Fim
			
			$prepare = mysqli_prepare($this->conecta,$this->sql);
			if(!mysqli_stmt_execute($prepare))
				throw new Exception("Não foi possível conectar no banco de dados.");
			
			mysqli_stmt_bind_result($prepare,$idPapeis,$nomePapeis);
			while(mysqli_stmt_fetch($prepare))
			{
				$this->valueObj = new PapeisVo();
				$this->valueObj->setIdPapeis($idPapeis);
				$this->valueObj->setNomePapeis($nomePapeis);
				$this->array[] = $this->valueObj;
			}
		}
		catch (Exception $e)
		{
			throw new Exception("Não foi possível consultar tabela de Papéis - ".$e->getMessage());
		}
		return $this->array;
	}
	
	/**
	 * Método de pesquisa na tabela Papeis_Projetos
	 *
	 * @author Rafael Henrique Vieira de Moura
	 * @access Public
	 * @param Papeis_ProjetosVo $papeis_ProjetosVo
	 * @return array $this->array
	 */
	public function findPapeis_Projetos(Papeis_ProjetosVo $papeis_ProjetosVo)
	{
		$this->valueObj = new Papeis_ProjetosVo();
		$this->valueObj = (object) $papeis_ProjetosVo;
		$this->conecta = new Connecta();
		$this->array = null;
		
		if (is_object($this->valueObj)) {
			$this->sql = "SELECT idPapeis, idProjetos, idUsuarios FROM Papeis_Projetos";
			
			if ($this->valueObj->getIdPapeis() != '' || $this->valueObj->getIdProjetos() != '' || $this->valueObj->getIdUsuarios() != '') {
				$this->valueObj->setParametroConsulta(" WHERE ");
			}
			if ($this->valueObj->getIdPapeis()!='') {
				$this->valueObj->setParametroConsulta($this->valueObj->getParametroConsulta()." idPapeis = '{$this->valueObj->getIdPapeis()}'");
			}
			if ($this->valueObj->getIdProjetos() != '') {
				if ($this->valueObj->getIdPapeis() !='') {
					$this->valueObj->setParametroConsulta($this->valueObj->getParametroConsulta()." AND ");
				}
				$this->valueObj->setParametroConsulta($this->valueObj->getParametroConsulta()."idProjetos = '{$this->valueObj->getIdProjetos()}'");
			}
			
			if ($this->valueObj->getIdUsuarios()!='') {
				if ($this->valueObj->getIdPapeis() != '' || $this->valueObj->getIdProjetos() != '') {
					$this->valueObj->setParametroConsulta($this->valueObj->getParametroConsulta()." AND ");
				}
				$this->valueObj->setParametroConsulta($this->valueObj->getParametroConsulta()."idUsuarios = '{$this->valueObj->getIdUsuarios()}'");
			}
			
			$this->sql .= $this->valueObj->getParametroConsulta();
		}
		
		try 
		{
			//Inicialização das variáveis
			$idPapeis = null;
			$idProjetos = null;
			$idUsuarios = null;
			
			//Fim
			
			$prepare = mysqli_prepare($this->conecta,$this->sql);
			if(!mysqli_stmt_execute($prepare))
				throw new Exception("Não foi possível conectar no banco de dados.");
			
			mysqli_stmt_bind_result($prepare,$idPapeis,$idProjetos,$idUsuarios);
			while(mysqli_stmt_fetch($prepare))
			{
				$this->valueObj = new Papeis_ProjetosVo();
				$this->valueObj->setIdPapeis($idPapeis);
				$this->valueObj->setIdProjetos($idProjetos);
				$this->valueObj->setIdUsuarios($idUsuarios);
				$this->array[] = $this->valueObj;
			}
		}
		catch (Exception $e)
		{
			throw new Exception("Não foi possível consultar tabela de Papeis/Projetos - ".$e->getMessage());
		}
		return $this->array;
	}
	
	/**
	 * Método de pesquisa na tabela Pedidos
	 *
	 * @author Rafael Henrique Vieira de Moura
	 * @access Public
	 * @param PedidosVo $pedidosVo
	 * @return array $this->array
	 */
	public function findPedidos(PedidosVo $pedidosVo)
	{
		$this->valueObj = new PedidosVo();
		$this->valueObj = (object) $pedidosVo;
		$this->conecta = new Connecta();
		$this->array = null;
		
		if (is_object($this->valueObj)) {
			if ($this->valueObj->getIdPedidos() != '' && $this->valueObj->getIdProjetos() == '')
			{
				$this->sql = "SELECT * FROM Pedidos WHERE idPedidos = '{$this->valueObj->getIdPedidos()}'";
			}
			elseif ($this->valueObj->getIdPedidos() != '' && $this->valueObj->getIdProjetos() != '')
			{
				$this->sql = "SELECT * FROM Pedidos WHERE idPedidos = '{$this->valueObj->getIdPedidos()}' AND idProjetos = '{$this->valueObj->getIdProjetos()}'";
			}
			else
			{
				$this->sql = "SELECT * FROM Pedidos {$this->valueObj->getParametroConsulta()}";
			}
		}
		
		try 
		{
			//Inicialização das variáveis
			$idPedidos = null;
			$idUsuarios = null;
			$idAtividadesPontoFuncaoHoras = null;
			$idProjetos = null;
			$idVersoes = null;
			$idModulos = null;
			$idSubModulos = null;
			$dataHoraPrevisaoPedidos = '';
			$precedentePedidos = null;
			$DomnStatusPedidos = null;
			$DomnSeveridadePedidos = null;
			$assuntoPedidos = '';
			
			//Fim
			
			$prepare = mysqli_prepare($this->conecta,$this->sql);
			if(!mysqli_stmt_execute($prepare))
				throw new Exception("Não foi possível conectar no banco de dados.");
			
			mysqli_stmt_bind_result($prepare,$idPedidos,$idUsuarios,$idAtividadesPontoFuncaoHoras,$idProjetos,$idVersoes,$idModulos,$idSubModulos,$dataHoraPrevisaoPedidos,$precedentePedidos,$DomnStatusPedidos,$DomnSeveridadePedidos,$assuntoPedidos);
			while(mysqli_stmt_fetch($prepare))
			{
				$this->valueObj = new PedidosVo();
				$this->valueObj->setIdPedidos($idPedidos);
				$this->valueObj->setIdUsuarios($idUsuarios);
				$this->valueObj->setIdAtividadesPontoFuncaoHoras($idAtividadesPontoFuncaoHoras);
				$this->valueObj->setIdProjetos($idProjetos);
				$this->valueObj->setIdVersoes($idVersoes);
				$this->valueObj->setIdModulos($idModulos);
				$this->valueObj->setIdSubModulos($idSubModulos);
				$this->valueObj->setDataHoraPrevisaoPedidos($dataHoraPrevisaoPedidos);
				$this->valueObj->setPrecedentePedidos($precedentePedidos);
				$this->valueObj->setDomnStatusPedidos($DomnStatusPedidos);
				$this->valueObj->setDomnSeveridadePedidos($DomnSeveridadePedidos);
				$this->valueObj->setAssuntoPedidos($assuntoPedidos);
				$this->array[] = $this->valueObj;
			}
		}
		catch (Exception $e)
		{
			throw new Exception("Não foi possível consultar tabela de Pedidos - ".$e->getMessage());
		}
		return $this->array;
	}
	
	/**
	 * Método de pesquisa na tabela Permissao_Usuarios_Funcionalidades_Papeis
	 *
	 * @author Rafael Henrique Vieira de Moura
	 * @access Public
	 * @param Permissao_Usuarios_Funcionalidades_PapeisVo $permissao_Usuarios_Funcionalidades_PapeisVo
	 * @return array $this->array
	 */
	public function findPermissoes_Usuarios_Funcionalidades_Papeis(Permissao_Usuarios_Funcionalidades_PapeisVo $permissao_Usuarios_Funcionalidades_PapeisVo)
	{
		$this->valueObj = new Permissao_Usuarios_Funcionalidades_PapeisVo();
		$this->valueObj = (object) $permissao_Usuarios_Funcionalidades_PapeisVo;
		$this->conecta = new Connecta();
		$this->array = null;
		
		if (is_object($this->valueObj)) {
			$this->sql = "SELECT idUsuarios, idPapeis, idFuncionalidades FROM Permissao_Usuarios_Funcionalidades_Papeis";
			
			if ($this->valueObj->getIdUsuarios()!='' || $this->valueObj->getIdPapeis()!='' || $this->valueObj->getIdFuncionalidades()!='') {
				$this->valueObj->setParametroConsulta(" WHERE");
			}
			
			if ($this->valueObj->getIdUsuarios()!='') {
				$this->valueObj->setParametroConsulta($this->valueObj->getParametroConsulta()." idUsuarios = '{$this->valueObj->getIdUsuarios()}'");
			}
			if ($this->valueObj->getIdPapeis()!='') {
				if ($this->valueObj->getIdUsuarios()!='') {
					$this->valueObj->setParametroConsulta($this->valueObj->getParametroConsulta()." AND ");
				}
				$this->valueObj->setParametroConsulta($this->valueObj->getParametroConsulta()." idPapeis = '{$this->valueObj->getIdPapeis()}'");
			}
			
			if ($this->valueObj->getIdFuncionalidades()!='') {
				if ($this->valueObj->getIdUsuarios()!='' || $this->valueObj->getIdPapeis()!='') {
					$this->valueObj->setParametroConsulta($this->valueObj->getParametroConsulta()." AND ");
				}
				$this->valueObj->setParametroConsulta($this->valueObj->getParametroConsulta()."idFuncionalidades = '{$this->valueObj->getIdFuncionalidades()}'");
			}
			
			$this->sql .= $this->valueObj->getParametroConsulta();
		}
		
		try 
		{
			//Inicialização das variáveis
			$idUsuarios = null;
			$idPapeis = null;
			$idFuncionalidades = null;
			//Fim
			
			$prepare = mysqli_prepare($this->conecta,$this->sql);
			if(!mysqli_stmt_execute($prepare))
				throw new Exception("Não foi possível conectar no banco de dados.");
			
			mysqli_stmt_bind_result($prepare,$idUsuarios,$idPapeis,$idFuncionalidades);
			while(mysqli_stmt_fetch($prepare))
			{
				$this->valueObj = new Permissao_Usuarios_Funcionalidades_PapeisVo();
				$this->valueObj->setIdUsuarios($idUsuarios);
				$this->valueObj->setIdPapeis($idPapeis);
				$this->valueObj->setIdFuncionalidades($idFuncionalidades);
				$this->array[] = $this->valueObj;
			}
		}
		catch (Exception $e)
		{
			throw new Exception("Não foi possível consultar tabela de Permissao/Usuarios - ".$e->getMessage());
		}
		return $this->array;
	}
	
	/**
	 * Método de pesquisa na tabela Projetos
	 *
	 * @author Rafael Henrique Vieira de Moura
	 * @access Public
	 * @param ProjetosVo $projetosVo
	 * @return array $this->array
	 */
	public function findProjetos(ProjetosVo $projetosVo)
	{
		$this->valueObj = new ProjetosVo();
		$this->valueObj = (object) $projetosVo;
		$this->conecta = new Connecta();
		$this->array = null;
		
		if (is_object($this->valueObj)) {
			if($this->valueObj->getIdProjetos()){
				$this->sql = "SELECT * FROM Projetos WHERE idProjetos = '{$this->valueObj->getIdProjetos()}'";
			} else {
				$this->sql = "SELECT * FROM Projetos {$this->valueObj->getParametroConsulta()}";
			}
		}
		
		try 
		{
			//Inicialização das variáveis
			$idProjetos = null;
			$nomeProjetos = '';
			$idGrupoFluxos = null;
			$idClientes = null;
			
			//Fim
			
			$prepare = mysqli_prepare($this->conecta,$this->sql);
			if(!mysqli_stmt_execute($prepare))
				throw new Exception("Não foi possível conectar no banco de dados.");
			
			mysqli_stmt_bind_result($prepare,$idProjetos,$nomeProjetos,$idGrupoFluxos,$idClientes);
			while(mysqli_stmt_fetch($prepare))
			{
				$this->valueObj = new ProjetosVo();
				$this->valueObj->setIdProjetos($idProjetos);
				$this->valueObj->setNomeProjetos($nomeProjetos);
				$this->valueObj->setIdGrupoFluxos($idGrupoFluxos);
				$this->valueObj->setIdClientes($idClientes);
				$this->array[] = $this->valueObj;
			}
		}
		catch (Exception $e)
		{
			throw new Exception("Não foi possível consultar tabela de Projetos - ".$e->getMessage());
		}
		return $this->array;
	}
	
	/**
	 * Método de pesquisa na tabela Projetos_Modulos
	 *
	 * @author Rafael Henrique Vieira de Moura
	 * @access Public
	 * @param Projetos_ModulosVo $projetos_ModulosVo
	 * @return array $this->array
	 */
	public function findProjetosModulos(Projetos_ModulosVo $projetos_ModulosVo)
	{
		$this->valueObj = new Projetos_ModulosVo();
		$this->valueObj = (object) $projetos_ModulosVo;
		$this->conecta = new Connecta();
		$this->array = null;
		
		if (is_object($this->valueObj)) {
			if ($this->valueObj->getIdProjetos()!='' && $this->valueObj->getIdModulos()=='') {
				$this->sql = "SELECT idProjetos, idModulos FROM Projetos_Modulos WHERE idProjetos = '{$this->valueObj->getIdProjetos()}'";
			} elseif ($this->valueObj->getIdProjetos()=='' && $this->valueObj->getIdModulos()!='') {
				$this->sql = "SELECT idProjetos, idModulos FROM Projetos_Modulos WHERE idModulos = '{$this->valueObj->getIdModulos()}'";
			} elseif ($this->valueObj->getIdProjetos()!='' && $this->valueObj->getIdModulos()!='') {
				$this->sql = "SELECT idProjetos, idModulos FROM Projetos_Modulos WHERE idProjetos = '{$this->valueObj->getIdProjetos()}' AND idModulos = '{$this->valueObj->getIdModulos()}'";
			} else {
				$this->sql = "SELECT idProjetos, idModulos FROM Projetos_Modulos {$this->valueObj->getParametroConsulta()}";
			}
		}
		
		try 
		{
			//Inicialização das variáveis
			$idProjetos = null;
			$idModulos = null;
			
			//Fim
			
			$prepare = mysqli_prepare($this->conecta,$this->sql);
			if(!mysqli_stmt_execute($prepare))
				throw new Exception("Não foi possível conectar no banco de dados.");
			
			mysqli_stmt_bind_result($prepare,$idProjetos,$idModulos);
			while(mysqli_stmt_fetch($prepare))
			{
				$this->valueObj = new Projetos_ModulosVo();
				$this->valueObj->setIdProjetos($idProjetos);
				$this->valueObj->setIdModulos($idModulos);
				$this->array[] = $this->valueObj;
			}
		}
		catch (Exception $e)
		{
			throw new Exception("Não foi possível consultar tabela de Projetos/Modulos - ".$e->getMessage());
		}
		return $this->array;
	}
	
	/**
	 * Método de pesquisa na tabela SubModulos
	 *
	 * @author Rafael Henrique Vieira de Moura
	 * @access Public
	 * @param SubModulosVo $subModulosVo
	 * @return array $this->array
	 */
	public function findSubModulos(SubModulosVo $subModulosVo)
	{
		$this->valueObj = new SubModulosVo();
		$this->valueObj = (object) $subModulosVo;
		$this->conecta = new Connecta();
		$this->array = null;
		
		if (is_object($this->valueObj)) {
			if($this->valueObj->getIdSubModulos()!='') {
				$this->sql = "SELECT * FROM SubModulos WHERE idSubModulos = '{$this->valueObj->getIdSubModulos()}'";
			} else {
				$this->sql = "SELECT * FROM SubModulos {$this->valueObj->getParametroConsulta()}";
			}
		}
		
		try 
		{
			//Inicialização das variáveis
			$idSubModulos = null;
			$nomeSubModulos = '';
			
			//Fim
			
			$prepare = mysqli_prepare($this->conecta,$this->sql);
			if(!mysqli_stmt_execute($prepare))
				throw new Exception("Não foi possível conectar no banco de dados.");
			
			mysqli_stmt_bind_result($prepare,$idSubModulos,$nomeSubModulos);
			while(mysqli_stmt_fetch($prepare))
			{
				$this->valueObj = new SubModulosVo();
				$this->valueObj->setIdSubModulos($idSubModulos);
				$this->valueObj->setNomeSubModulos($nomeSubModulos);
				$this->array[] = $this->valueObj;
			}
		}
		catch (Exception $e)
		{
			throw new Exception("Não foi possível consultar tabela de SubMódulos - ".$e->getMessage());
		}
		return $this->array;
	}
	
	/**
	 * Método de pesquisa na tabela TabelaBasica
	 *
	 * @author Rafael Henrique Vieira de Moura
	 * @access Public
	 * @param TabelaBasicaVo $tabelaBasicaVo
	 * @return array $this->array
	 */
	public function findTabelaBasica(TabelaBasicaVo $tabelaBasicaVo)
	{
		$this->valueObj = new TabelaBasicaVo();
		$this->valueObj = (object) $tabelaBasicaVo;
		$this->conecta = new Connecta();
		$this->array = null;
		
		if (is_object($this->valueObj)) {
			if ($this->valueObj->getIdTabelaBasica()!='') {
				$this->sql = "SELECT * FROM TabelaBasica WHERE idTabelaBasica = '{$this->valueObj->getIdTabelaBasica()}'";
			} else {
				$this->sql = "SELECT * FROM TabelaBasica {$this->valueObj->getParametroConsulta()}";
			}
		}
		
		try 
		{
			//Inicialização das variáveis
			$idTabelaBasica = null;
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
			
			//Fim
			
			$prepare = mysqli_prepare($this->conecta,$this->sql);
			if(!mysqli_stmt_execute($prepare))
				throw new Exception("Não foi possível conectar no banco de dados.");
			
			mysqli_stmt_bind_result($prepare,$idTabelaBasica,$emailPadraoTabelaBasica,$nomeRemetenteTabelaBasica,$toleranciaHoraConformidade,$horasBaseTrabalhadasTabelaBasica,$horasNaoTrabalhadasTabelaBasica,$horasInicioTrabalhoTabelaBasica,$horasFimTrabalhoTabelaBasica,$horasIntervaloInicioTabelaBasica,$horasIntervaloFimTabelaBasica,$horasBaseRecebimentoPedido);
			while(mysqli_stmt_fetch($prepare))
			{
				$this->valueObj = new TabelaBasicaVo();
				$this->valueObj->setIdTabelaBasica($idTabelaBasica);
				$this->valueObj->setEmailPadraoTabelaBasica($emailPadraoTabelaBasica);
				$this->valueObj->setNomeRemetenteTabelaBasica($nomeRemetenteTabelaBasica);
				$this->valueObj->setToleranciaHoraConformidade($toleranciaHoraConformidade);
				$this->valueObj->setHorasBaseTrabalhadasTabelaBasica($horasBaseTrabalhadasTabelaBasica);
				$this->valueObj->setHorasNaoTrabalhadasBaseTabelaBasica($horasNaoTrabalhadasTabelaBasica);
				$this->valueObj->setHorasInicioTrabalhoTabelaBasica($horasInicioTrabalhoTabelaBasica);
				$this->valueObj->setHorasFimTrabalhoTabelaBasica($horasFimTrabalhoTabelaBasica);
				$this->valueObj->setHorasIntervaloInicioTabelaBasica($horasIntervaloInicioTabelaBasica);
				$this->valueObj->setHorasIntervaloFimTabelaBasica($horasIntervaloFimTabelaBasica);
				$this->valueObj->setHorasBaseRecebimentoPedido($horasBaseRecebimentoPedido);
				$this->array[] = $this->valueObj;
			}
		}
		catch (Exception $e)
		{
			throw new Exception("Não foi possível consultar tabela de TabelaBasica - ".$e->getMessage());
		}
		return $this->array;
	}
	
	/**
	 * Método de pesquisa na tabela Tecnologias
	 *
	 * @author Rafael Henrique Vieira de Moura
	 * @access Public
	 * @param TecnologiasVo $tecnologiasVo
	 * @return array $this->array
	 */
	public function findTecnologias(TecnologiasVo $tecnologiasVo)
	{
		$this->valueObj = new TecnologiasVo();
		$this->valueObj = (object) $tecnologiasVo;
		$this->conecta = new Connecta();
		$this->array = null;
		
		if (is_object($this->valueObj)) {
			if ($this->valueObj->getIdTecnologias()!='') {
				$this->sql = "SELECT * FROM Tecnologias WHERE idTecnologias = '{$this->valueObj->getIdTecnologias()}'";
			} else {
				$this->sql = "SELECT * FROM Tecnologias {$this->valueObj->getParametroConsulta()}";
			}
		}
		
		try 
		{
			//Inicialização das variáveis
			$idTecnologias = null;
			$nomeTecnologias = '';
			
			//Fim
			
			$prepare = mysqli_prepare($this->conecta,$this->sql);
			if(!mysqli_stmt_execute($prepare))
				throw new Exception("Não foi possível conectar no banco de dados.");
			
			mysqli_stmt_bind_result($prepare,$idTecnologias,$nomeTecnologias);
			while(mysqli_stmt_fetch($prepare))
			{
				$this->valueObj = new TecnologiasVo();
				$this->valueObj->setIdTecnologias($idTecnologias);
				$this->valueObj->setNomeTecnologias($nomeTecnologias);
				$this->array[] = $this->valueObj;
			}
		}
		catch (Exception $e)
		{
			throw new Exception("Não foi possível consultar tabela de Tecnologias - ".$e->getMessage());
		}
		return $this->array;
	}
	
	/**
	 * Método de pesquisa na tabela Usuarios
	 *
	 * @author João Batista Padilha e Silva
	 * @access Public
	 * @param UsuariosVo $usuariosVo
	 * @return array $this->array
	 */
	public function findUsuarios(UsuariosVo $usuariosVo)
	{
		$this->valueObj = new UsuariosVo();
		$this->valueObj = (object) $usuariosVo;
		$this->conecta = new Connecta();
		$this->array = null;
		
		if(is_object($this->valueObj))
		{
			if($this->valueObj->getIdUsuarios()=='' && $this->valueObj->getLoginUsuarios()!='' && $this->valueObj->getSenhaUsuarios() != '')
			{
				$this->sql = "SELECT * FROM Usuarios WHERE loginUsuarios = '{$this->valueObj->getLoginUsuarios()}' AND senhaUsuarios=SHA1('{$this->valueObj->getSenhaUsuarios()}') AND flagSuspenso <> 1";
			}
			elseif ($this->valueObj->getIdUsuarios()!='')
			{
				$this->sql = "SELECT * FROM Usuarios WHERE idUsuarios = '{$this->valueObj->getIdUsuarios()}'";
			}
			elseif($this->valueObj->getIdUsuarios()=='' && $this->valueObj->getParametroConsulta()!='')
			{
				$this->sql = "SELECT * FROM Usuarios {$this->valueObj->getParametroConsulta()}";
			}
			else 
			{
				$this->sql = "SELECT * FROM Usuarios";
			}
		}
		try 
		{
			//Inicialização das variáveis
			$idUsuarios = null;
			$nomeUsuarios = '';
			$enderecoUsuarios = '';
			$cepUsuarios = null;
			$cidadeUsuarios = '';
			$emailUsuarios = '';
			$telUsuarios = '';
			$telCelUsuarios = '';
			$dataNascimentoUsuarios = '';
			$loginUsuarios = '';
			$senhaUsuarios = '';
			$flagSuspenso = false;
			$flagTipoUsuario = true;
			
			//Fim
			
			$prepare = mysqli_prepare($this->conecta,$this->sql);
			if(!mysqli_stmt_execute($prepare))
				throw new Exception("Não foi possível conectar no banco de dados.");
			
			mysqli_stmt_bind_result($prepare,$idUsuarios,$nomeUsuarios,$enderecoUsuarios,$cepUsuarios,$cidadeUsuarios,$emailUsuarios,$telUsuarios,$telCelUsuarios,$dataNascimentoUsuarios,$loginUsuarios,$senhaUsuarios,$flagSuspenso,$flagTipoUsuario);
			while(mysqli_stmt_fetch($prepare))
			{
				$this->valueObj = new UsuariosVo();
				$this->valueObj->setIdUsuarios($idUsuarios);
				$this->valueObj->setNomeUsuarios($nomeUsuarios);
				$this->valueObj->setEnderecoUsuarios($enderecoUsuarios);
				$this->valueObj->setCepUsuarios($cepUsuarios);
				$this->valueObj->setCidadeUsuarios($cidadeUsuarios);
				$this->valueObj->setEmailUsuarios($emailUsuarios);
				$this->valueObj->setTelUsuarios($telUsuarios);
				$this->valueObj->setTelCelUsuarios($telCelUsuarios);
				$this->valueObj->setDataNascimentoUsuarios($dataNascimentoUsuarios);
				$this->valueObj->setloginUsuarios($loginUsuarios);
				$this->valueObj->setSenhaUsuarios($senhaUsuarios);
				$this->valueObj->setFlagSuspenso($flagSuspenso);
				$this->valueObj->setFlagTipoUsuario($flagTipoUsuario);
				$this->array[] = $this->valueObj;
			}
		}
		catch (Exception $e)
		{
			throw new Exception("Não foi possível consultar tabela de Usuários - ".$e->getMessage());
		}
		return $this->array;
	}
	
	/**
	 * Método de pesquisa na tabela Versoes
	 *
	 * @author Rafael Henrique Vieira de Moura
	 * @access Public
	 * @param VersoesVo $versoesVo
	 * @return array $this->array
	 */
	public function findVersoes(VersoesVo $versoesVo)
	{
		$this->valueObj = new VersoesVo();
		$this->valueObj = (object) $versoesVo;
		$this->conecta = new Connecta();
		$this->array = null;
		
		if (is_object($this->valueObj)) {
			if ($this->valueObj->getIdVersoes()!='') {
				$this->sql = "SELECT * FROM Versoes WHERE idVersoes = '{$this->valueObj->getIdVersoes()}'";
			} else {
				$this->sql = "SELECT * FROM Versoes {$this->valueObj->getParametroConsulta()}";
			}
		}
		
		try 
		{
			//Inicialização das variáveis
			$idVersoes = null;
			$nomeVersoes = '';
			$dataEntregaVersoes = '';
			$idAnexos = null;
			$dataEntregaVersoesClientes = '';
			$idProjetos = null;
			
			//Fim
			
			$prepare = mysqli_prepare($this->conecta,$this->sql);
			if(!mysqli_stmt_execute($prepare))
				throw new Exception("Não foi possível conectar no banco de dados.");
			
			mysqli_stmt_bind_result($prepare,$idVersoes,$nomeVersoes,$dataEntregaVersoes,$idAnexos,$dataEntregaVersoesClientes,$idProjetos);
			while(mysqli_stmt_fetch($prepare))
			{
				$this->valueObj = new VersoesVo();
				$this->valueObj->setIdVersoes($idVersoes);
				$this->valueObj->setNomeVersoes($nomeVersoes);
				$this->valueObj->setDataEntregaVersoes($dataEntregaVersoes);
				$this->valueObj->setIdAnexos($idAnexos);
				$this->valueObj->setDataEntregaVersoesClientes($dataEntregaVersoesClientes);
				$this->valueObj->setIdProjetos($idProjetos);
				$this->array[] = $this->valueObj;
			}
		}
		catch (Exception $e)
		{
			throw new Exception("Não foi possível consultar tabela de Versoes - ".$e->getMessage());
		}
		return $this->array;
	}
	
	/**
	 * Método de Pesquisa de Grupo de Fluxos do Sistema
	 * @author João Batista Padilha e Silva
	 * @param GrupoFluxosVo $grupoFluxosVo
	 * @return $this->array
	 */
	public function findGrupoFluxos(GrupoFluxosVo $grupoFluxosVo)
	{
		$this->valueObj = new GrupoFluxosVo();
		$this->valueObj = (object) $grupoFluxosVo;
		$this->conecta = new Connecta();
		$this->array = null;
		
		if (is_object($this->valueObj)) {
			if ($this->valueObj->getIdGrupoFluxos() != '') {
				$this->sql = "SELECT * FROM GrupoFluxos WHERE idGrupoFluxos = '{$this->valueObj->getIdGrupoFluxos()}'";
			} else {
				$this->sql = "SELECT * FROM GrupoFluxos {$this->valueObj->getParametroConsulta()}";
			}
		}
		
		try 
		{
			//Inicialização das variáveis
			$idGrupoFluxos = null;
			$nomeGrupoFluxos = '';
			
			//Fim
			
			$prepare = mysqli_prepare($this->conecta,$this->sql);
			if(!mysqli_stmt_execute($prepare))
				throw new Exception("Não foi possível conectar no banco de dados.");
			
			mysqli_stmt_bind_result($prepare,$idGrupoFluxos, $nomeGrupoFluxos);
			while(mysqli_stmt_fetch($prepare))
			{
				$this->valueObj = new GrupoFluxosVo();
				$this->valueObj->setIdGrupoFluxos($idGrupoFluxos);
				$this->valueObj->setNomeGrupoFluxos($nomeGrupoFluxos);
				$this->array[] = $this->valueObj;
			}
		}
		catch (Exception $e)
		{
			throw new Exception("Não foi possível consultar tabela de GrupoFluxos - ".$e->getMessage());
		}
		return $this->array;
	}
}
?>