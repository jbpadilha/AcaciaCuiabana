<?php
/**
 * Classe de Persistкncia do Sistema. Inclusгo / Alteraзгo / Deleзгo
 * @author Joгo Batista Padilha e Silva	
 * @link DAO.php
 * @copyright Joгo Batista Padilha e Silva Especialista em TI (http://www.joaopadilha.eti.br) / joao.padilha@globo.com
 * @version 1.0
 */
class DAO
{
	
	/**
	 *  Mйtodo de retorno do ultimo Id Inserido na tabela
	 * @author Joгo Batista Padilha e Silva  * @param connect $conexao
	 * @return int
	*/
	public function ultimoIdInserido($conexao)
	{
		$prepare = mysqli_prepare($conexao,"SELECT LAST_INSERT_ID()");
		if(!mysqli_stmt_execute($prepare))
			throw new Exception("Nгo foi posssгvel conectar no banco de dados.");
		$id = "";
		mysqli_stmt_bind_result($prepare,$id);
		while(mysqli_stmt_fetch($prepare))
		{
			$ultimoId = $id;
		}
		return $ultimoId;
	}
	
	/**
	 * Mйtodo de cadastramento de Clientes
	 * @author Joгo Batista Padilha e Silva
	 * @param Logon $logon
	 */
	public function cadastrarLogon(Logon $logon)
	{
		$conecta = new Connecta();
		$valueObj = new Logon();
		$valueObj = (object)$logon;
		
		$idlogon = null;
		$login = '';
		$senha = '';
		$dataUltimoLogin = '';
		$nivelAcessoLogin = '';
		$idPessoa = '';
		$idClientes = '';
		
		try 
		{
			$sql = mysqli_prepare($conecta,"INSERT INTO logon (idLogon, login, senha, dataUltimoLogon,
			nivelAcessoLogon, idPessoa, idClientes) VALUES('',?,SHA1(?),?,?,?,?)");
			mysqli_bind_param($sql,'ssssii',$login, $senha, $dataUltimoLogin, $nivelAcessoLogin, 
			$idPessoa,$idClientes);
		
			$login = $valueObj->getLogin();
			$senha = $valueObj->getSenha();
			$dataUltimoLogin = $valueObj->getDataUltimoLogin();
			$nivelAcessoLogin = $valueObj->getNivelAcessoLogin();
			$idPessoa = $valueObj->getIdPessoa();
			$idClientes = $valueObj->getIdClientes();
			
			if(!mysqli_stmt_execute($sql))
				throw new Exception("Nгo foi posssгvel conectar no banco de dados.");
		}
		catch ( Exception $e)
		{
			throw new Exception($e->getMessage());
		}
		
	}
	
	/**
	 * Mйtodo de Alteraзгo de Usuбrios
	 * @author Joгo Batista Padilha e Silva
	 * @param Logon $logon
	 */
	public function updateLogon(Logon $logon)
	{
		$conecta = new Connecta();
		$valueObj = new Logon();
		$valueObj = (object)$logon;
		
		$idlogon = null;
		$login = '';
		$dataUltimoLogin = '';
		$nivelAcessoLogin = '';
		$idPessoa = '';
		$idClientes = '';
		
		try 
		{
			$sql = mysqli_prepare($conecta,"UPDATE logon SET login = ?, dataUltimoLogon=?, nivelAcessoLogon=?, idPessoa = ?, idClientes = ? WHERE idLogon = ?");
			mysqli_bind_param($sql,'ssiiii',$login, $dataUltimoLogin, $nivelAcessoLogin, $idPessoa, $idClientes, $idlogon);
			
			$login = $valueObj->getLogin();
			$dataUltimoLogin = $valueObj->getDataUltimoLogin();
			$nivelAcessoLogin = $valueObj->getNivelAcessoLogin();
			$idPessoa = $valueObj->getIdPessoa();
			$idlogon = $valueObj->getIdLogin();
			$idClientes = $valueObj->getIdClientes();
			
			if(!mysqli_stmt_execute($sql))
				throw new Exception("Nгo foi posssгvel realizar a operaзгo.");
		}
		catch ( Exception $e)
		{
			throw new Exception($e->getMessage());
		}
		$conecta = null;
	}
	
	/**
	 * Mйtodo de update de senha de Logon
	 * @author Joгo Batista Padilha e Silva
	 * @param Logon $logon
	 */
	public function alteraSenhaLogon(Logon $logon)
	{
		$conecta = new Connecta();
		$valueObj = new Logon();
		$valueObj = (object)$logon;
		
		$idlogon = '';
		$senha = '';
		
		try 
		{
			$sql = mysqli_prepare($conecta,"UPDATE logon SET senha=SHA1(?) WHERE idLogon = ?");
			mysqli_bind_param($sql,'ss',$senha, $idlogon);
			
			$senha = $valueObj->getSenha();
			$idlogon = $valueObj->getIdLogin();
			
			if(!mysqli_stmt_execute($sql))
				throw new Exception("Nгo foi posssгvel realizar a operaзгo.");
		}
		catch ( Exception $e)
		{
			throw new Exception($e->getMessage());
		}
		$conecta = null;
	}
	
	/**
	 * Mйtodo de cadastramento de pessoa
	 * @param Pessoa $pessoa
	 */
	public function cadastrarPessoa(Pessoa $pessoa)
	{
		$conecta = new Connecta();
		$valueObj = (object)$pessoa;
		
		$idPessoa = null;
		$cpfPessoa = '';
		$nomePessoa = '';
		$dataNascimentoPessoa = '';
		$sexoPessoa = '';
		$estadoCivilPessoa = '';
		$rgPessoa = '';
		$orgExpPessoa = '';
		$ufOrgExpPessoa = '';
		$complementoPessoa = '';
		$idConjuguePessoa = '';
		$idCliente = '';
		
		try 
		{
			$sql = mysqli_prepare($conecta,"INSERT INTO pessoa (idPessoa,cpfPessoa,nomePessoa,dataNascimentoPessoa,
			sexoPessoa,estadoCivilPessoa,rgPessoa,orgExpPessoa,ufOrgExpPessoa,complementoPessoa,idConjuguePessoa,idCliente) 
			VALUES('',?,?,?,?,?,?,?,?,?,?,?)");
			mysqli_bind_param($sql,'sssssssssii',$cpfPessoa,$nomePessoa,$dataNascimentoPessoa,$sexoPessoa,$estadoCivilPessoa,
			$rgPessoa,$orgExpPessoa,$ufOrgExpPessoa,$complementoPessoa,$idConjuguePessoa,$idCliente);
		
			$cpfPessoa = $valueObj->getCpfPessoa();
			$nomePessoa = $valueObj->getNomePessoa();
			$dataNascimentoPessoa = $valueObj->getDataNascimentoPessoa();
			$sexoPessoa = $valueObj->getSexoPessoa();
			$estadoCivilPessoa = $valueObj->getEstadoCivilPessoa();
			$rgPessoa = $valueObj->getRgPessoa();
			$orgExpPessoa = $valueObj->getOrgExpPessoa();
			$ufOrgExpPessoa = $valueObj->getUfOrgExpPessoa();
			$complementoPessoa = $valueObj->getComplementoPessoa();
			$idConjuguePessoa = $valueObj->getIdConjuguePessoa();
			$idCliente = $valueObj->getIdCliente();
			
			if(!mysqli_stmt_execute($sql))
				throw new Exception("Nгo foi posssгvel conectar no banco de dados.");
			
			return $ultimoId = self::ultimoIdInserido($conecta);
		}
		catch ( Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}

	/**
	 * Mйtodo de atualizaзгo de pessoa
	 * @param Pessoa $pessoa
	 */
	public function updatePessoa(Pessoa $pessoa)
	{
		$conecta = new Connecta();
		$valueObj = (object)$pessoa;
		
		$idPessoa = null;
		$cpfPessoa = '';
		$nomePessoa = '';
		$dataNascimentoPessoa = '';
		$sexoPessoa = '';
		$estadoCivilPessoa = '';
		$rgPessoa = '';
		$orgExpPessoa = '';
		$ufOrgExpPessoa = '';
		$complementoPessoa = '';
		$idConjuguePessoa = '';
		$idCliente = '';
		
		try 
		{
			$sql = mysqli_prepare($conecta,"UPDATE pessoa SET cpfPessoa = ?,nomePessoa = ?,dataNascimentoPessoa=?,
			sexoPessoa=?,estadoCivilPessoa=?,rgPessoa=?,orgExpPessoa=?,ufOrgExpPessoa=?,complementoPessoa=?,
			idConjuguePessoa=?, idCliente=? WHERE idPessoa=?");
			mysqli_bind_param($sql,'sssssssssiii',$cpfPessoa,$nomePessoa,$dataNascimentoPessoa,$sexoPessoa,$estadoCivilPessoa,
			$rgPessoa,$orgExpPessoa,$ufOrgExpPessoa,$complementoPessoa,$idConjuguePessoa, $idCliente, $idPessoa);
		
			$cpfPessoa = $valueObj->getCpfPessoa();
			$nomePessoa = $valueObj->getNomePessoa();
			$dataNascimentoPessoa = $valueObj->getDataNascimentoPessoa();
			$sexoPessoa = $valueObj->getSexoPessoa();
			$estadoCivilPessoa = $valueObj->getEstadoCivilPessoa();
			$rgPessoa = $valueObj->getRgPessoa();
			$orgExpPessoa = $valueObj->getOrgExpPessoa();
			$ufOrgExpPessoa = $valueObj->getUfOrgExpPessoa();
			$complementoPessoa = $valueObj->getComplementoPessoa();
			$idConjuguePessoa = $valueObj->getIdConjuguePessoa();
			$idCliente = $valueObj->getIdCliente();
			$idPessoa = $valueObj->getIdPessoa();
			
			if(!mysqli_stmt_execute($sql))
				throw new Exception("Nгo foi posssгvel conectar no banco de dados.");
			
			return $ultimoId = self::ultimoIdInserido($conecta);
		}
		catch ( Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	
	/**
	 * Mйtodo de cadastramento de endereзo
	 * @param Endereco $endereco
	 */
	public function cadastrarEndereco(Endereco $endereco)
	{
		$conecta = new Connecta();
		$valueObj = (object)$endereco;
		
		$ruaEndereco = '';
		$complementoEndereco = '';
		$bairroEndereco = '';
		$cepEndereco = '';
		$estadoEndereco = '';
		$cidadeEndereco = '';
		$telefoneEndereco = '';
		$celEndereco = '';
		$faxEndereco = '';
		$emailEndereco = '';
		$idPessoa = null;
		$idEmpresa = null;
		
		try 
		{
			$sql = mysqli_prepare($conecta,"INSERT INTO endereco (idEndereco,ruaEndereco,complementoEndereco,
			bairroEndereco,cepEndereco,estadoEndereco,cidadeEndereco,telefoneEndereco,celEndereco,faxEndereco,
			emailEndereco,idPessoa,idEmpresa) VALUES('',?,?,?,?,?,?,?,?,?,?,?,?)");
			mysqli_bind_param($sql,'ssssssssssii',$ruaEndereco,$complementoEndereco,$bairroEndereco,
			$cepEndereco,$estadoEndereco,$cidadeEndereco,$telefoneEndereco,$celEndereco,$faxEndereco,
			$emailEndereco,$idPessoa,$idEmpresa);
			
			$ruaEndereco = $valueObj->getRuaEndereco();
			$complementoEndereco = $valueObj->getComplementoEndereco();
			$bairroEndereco = $valueObj->getBairroEndereco();
			$cepEndereco = $valueObj->getCepEndereco();
			$estadoEndereco = $valueObj->getEstadoEndereco();
			$cidadeEndereco = $valueObj->getCidadeEndereco();
			$telefoneEndereco = $valueObj->getTelefoneEndereco();
			$celEndereco = $valueObj->getCelEndereco();
			$faxEndereco = $valueObj->getFaxEndereco();
			$emailEndereco = $valueObj->getEmailEndereco();
			$idPessoa = $valueObj->getIdPessoa();
			$idEmpresa = $valueObj->getIdEmpresa();
			
			
			if(!mysqli_stmt_execute($sql))
				throw new Exception("Nгo foi posssгvel conectar no banco de dados.");
			
		}
		catch ( Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}

	/**
	 * Mйtodo de UPDATE do endereco
	 * @param Endereco $endereco
	 */
	public function updateEndereco(Endereco $endereco)
	{
		$conecta = new Connecta();
		$valueObj = $endereco;
		
		$idEndereco = null;
		$ruaEndereco = '';
		$complementoEndereco = '';
		$bairroEndereco = '';
		$cepEndereco = '';
		$estadoEndereco = '';
		$cidadeEndereco = '';
		$telefoneEndereco = '';
		$celEndereco = '';
		$faxEndereco = '';
		$emailEndereco = '';
		$idPessoa = null;
		$idEmpresa = null;
		
		try 
		{
			$sql = mysqli_prepare($conecta,"UPDATE endereco SET ruaEndereco=?,complementoEndereco=?,
			bairroEndereco=?,cepEndereco=?,estadoEndereco=?,cidadeEndereco=?,telefoneEndereco=?,
			celEndereco=?,faxEndereco=?,emailEndereco=?,idPessoa=?,idEmpresa=? WHERE idEndereco=?");
			mysqli_bind_param($sql,'ssssssssssiii',$ruaEndereco,$complementoEndereco,$bairroEndereco,
			$cepEndereco,$estadoEndereco,$cidadeEndereco,$telefoneEndereco,$celEndereco,$faxEndereco,
			$emailEndereco,$idPessoa,$idEmpresa,$idEndereco);
			
			$ruaEndereco = $valueObj->getRuaEndereco();
			$complementoEndereco = $valueObj->getComplementoEndereco();
			$bairroEndereco = $valueObj->getBairroEndereco();
			$cepEndereco = $valueObj->getCepEndereco();
			$estadoEndereco = $valueObj->getEstadoEndereco();
			$cidadeEndereco = $valueObj->getCidadeEndereco();
			$telefoneEndereco = $valueObj->getTelefoneEndereco();
			$celEndereco = $valueObj->getCelEndereco();
			$faxEndereco = $valueObj->getFaxEndereco();
			$emailEndereco = $valueObj->getEmailEndereco();
			$idPessoa = $valueObj->getIdPessoa();
			$idEmpresa = $valueObj->getIdEmpresa();
			$idEndereco = $valueObj->getIdEndereco();
			
			if(!mysqli_stmt_execute($sql))
				throw new Exception("Nгo foi posssгvel conectar no banco de dados.");
			
		}
		catch ( Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	
	/**
	 * Mйtodo de Cadastrar uma empresa
	 * @param $empresas
	 */
	public function cadastrarEmpresa(Empresas $empresas)
	{
		$conecta = new Connecta();
		$valueObj = (object)$empresas;
		
		$cnpjEmpresa = '';
		$nomeEmpresa = '';
		$nomeFantasiaEmpresa = '';
		$dataFundacaoEmpresa = '';
		$origemEmpresa = '';
		$ramoEmpresa = '';
		$inscricaoEstadualEmpresa = '';
		$dataCadastro = '';
		$idDiretor = null;
		$idClientes = null;
		
		try 
		{
			$sql = mysqli_prepare($conecta,"INSERT INTO empresas (idEmpresa,cnpjEmpresa,nomeEmpresa,nomeFantasiaEmpresa,
			dataFundacaoEmpresa,origemEmpresa,ramoEmpresa,inscricaoEstadualEmpresa,dataCadastro,idDiretor,idClientes) VALUES('',?,?,?,?,?,?,?,?,?,?)");
			mysqli_bind_param($sql,'ssssssssii',$cnpjEmpresa,$nomeEmpresa,$nomeFantasiaEmpresa,$dataFundacaoEmpresa,
			$origemEmpresa,$ramoEmpresa,$inscricaoEstadualEmpresa,$dataCadastro,$idDiretor,$idClientes);
			
			$cnpjEmpresa = $valueObj->getCnpjEmpresa();
			$nomeEmpresa = $valueObj->getNomeEmpresa();
			$nomeFantasiaEmpresa = $valueObj->getNomeFantasiaEmpresa();
			$dataFundacaoEmpresa = $valueObj->getDataFundacaoEmpresa();
			$origemEmpresa = $valueObj->getOrigemEmpresa();
			$ramoEmpresa = $valueObj->getRamoEmpresa();
			$inscricaoEstadualEmpresa = $valueObj->getInscricaoEstadualEmpresa();
			$dataCadastro = date("Y-m-d hh:ii:ss");
			$idDiretor = $valueObj->getIdDiretor();
			$idClientes = $valueObj->getIdClientes();			
			
			if(!mysqli_stmt_execute($sql))
				throw new Exception("Nгo foi posssгvel conectar no banco de dados.");
				
			return $ultimoId = self::ultimoIdInserido($conecta);
		}
		catch ( Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}

	/**
	 * Mйtodo de Update em Empresa
	 * @param Empresas $empresas
	 */
	public function updateEmpresa(Empresas $empresas)
	{
		$conecta = new Connecta();
		$valueObj = (object)$empresas;
		
		$idEmpresa = null;
		$cnpjEmpresa = '';
		$nomeEmpresa = '';
		$nomeFantasiaEmpresa = '';
		$dataFundacaoEmpresa = '';
		$origemEmpresa = '';
		$ramoEmpresa = '';
		$inscricaoEstadualEmpresa = '';
		$dataCadastro = '';
		$idDiretor = '';
		$idClientes = '';
		
		try 
		{
			$sql = mysqli_prepare($conecta,"UPDATE empresas SET cnpjEmpresa=?,nomeEmpresa=?,nomeFantasiaEmpresa=?,
			dataFundacaoEmpresa=?,origemEmpresa=?,ramoEmpresa=?,inscricaoEstadualEmpresa=?,dataCadastro=?,
			idDiretor=?, idClientes = ? WHERE idEmpresa=?");
			mysqli_bind_param($sql,'ssssssssiii',$cnpjEmpresa,$nomeEmpresa,$nomeFantasiaEmpresa,$dataFundacaoEmpresa,
			$origemEmpresa,$ramoEmpresa,$inscricaoEstadualEmpresa,$dataCadastro,$idDiretor,$idClientes,$idEmpresa);
			
			$cnpjEmpresa = $valueObj->getCnpjEmpresa();
			$nomeEmpresa = $valueObj->getNomeEmpresa();
			$nomeFantasiaEmpresa = $valueObj->getNomeFantasiaEmpresa();
			$dataFundacaoEmpresa = $valueObj->getDataFundacaoEmpresa();
			$origemEmpresa = $valueObj->getOrigemEmpresa();
			$ramoEmpresa = $valueObj->getRamoEmpresa();
			$inscricaoEstadualEmpresa = $valueObj->getInscricaoEstadualEmpresa();
			$dataCadastro = date("Y-m-d hh:ii:ss");
			$idDiretor = $valueObj->getIdDiretor();
			$idEmpresa = $valueObj->getIdEmpresa();	
			$idClientes = $valueObj->getIdClientes();		
			
			if(!mysqli_stmt_execute($sql))
				throw new Exception("Nгo foi posssгvel conectar no banco de dados.");
			
		}
		catch ( Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	
	/**
	 * Mйtodo de cadastramento de clientes
	 * @param Clientes $clientes
	 */
	public function cadastrarClientes(Clientes $clientes)
	{
		$conecta = new Connecta();
		$valueObj = (object)$clientes;
		
		$dataRegistroClientes = '';
		$statusClientes = '';
		$idPessoa = '';
		$idEmpresa = '';
		
		try 
		{
			$sql = mysqli_prepare($conecta,"INSERT INTO clientes (idClientes,dataRegistroClientes,statusClientes,
			idPessoa,idEmpresa) VALUES('',?,?,?,?)");
			mysqli_bind_param($sql,'ssii',$dataRegistroClientes,$statusClientes,$idPessoa,$idEmpresa);
			
			$dataRegistroClientes = $valueObj->getDataRegistroClientes();
			$statusClientes = $valueObj->getStatusClientes();
			$idPessoa = $valueObj->getIdPessoa();
			$idEmpresa = $valueObj->getIdEmpresa();			
			
			if(!mysqli_stmt_execute($sql))
				throw new Exception("Nгo foi posssгvel conectar no banco de dados.");
			
			return $ultimoId = self::ultimoIdInserido($conecta);
		}
		catch ( Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}

	/**
	 * Mйtodo de atualizaзгo em Clientes
	 * @param Clientes $clientes
	 */
	public function updateClientes(Clientes $clientes)
	{
		$conecta = new Connecta();
		$valueObj = (object)$clientes;
		
		$idClientes = null;
		$dataRegistroClientes = '';
		$statusClientes = '';
		$idPessoa = '';
		$idEmpresa = '';
		
		try 
		{
			$sql = mysqli_prepare($conecta,"UPDATE clientes SET dataRegistroClientes=?,statusClientes=?,
			idPessoa=?,idEmpresa=? WHERE idClientes=?");
			mysqli_bind_param($sql,'ssiii',$dataRegistroClientes,$statusClientes,$idPessoa,$idEmpresa,$idClientes);
			
			$dataRegistroClientes = $valueObj->getDataRegistroClientes();
			$statusClientes = $valueObj->getStatusClientes();
			$idPessoa = $valueObj->getIdPessoa();
			$idEmpresa = $valueObj->getIdEmpresa();
			$idClientes = $valueObj->getIdClientes();			
			
			if(!mysqli_stmt_execute($sql))
				throw new Exception("Nгo foi posssгvel conectar no banco de dados.");
			
		}
		catch ( Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}

	/**
	 * Mйtodo de Cadastramento de Vesгculos
	 * @param Veiculos $veiculos
	 */
	public function cadastrarVeiculos(Veiculos $veiculos)
	{
		$conecta = new Connecta();
		$valueObj = (object)$veiculos;
		
		$idVeiculos = null;
		$placaVeiculos = '';
		$marcaVeiculos = '';
		$modeloVeiculos = '';
		$corVeiculos = '';
		$combustivelVeiculos = '';
		$capacidadeTanqueVeiculos = '';
		$anoFabricacaoVeiculos = '';
		$modeloFabricacaoVeiculos = '';
		$renavamVeiculos = '';
		$chassiVeiculos = '';
		$tipoVeiculos = '';
		$codFipeVeiculos = '';
		$placaNfVeiculos = '';
		$numeroNfVeiculos = '';
		$fornecedorNfVeiculos = '';
		$dataNfVeiculos = '';
		$cidadeNfVeiculos = '';
		$estadoNfVeiculos = '';
		$dataEntregaNfVeiculos = '';
		$kmEntregaNfVeiculos = '';
		$proprietarioNfVeiculos = '';
		$arrendatarioNfVeiculos = '';
		$contratanteNfveiculos = '';
		$tempoGarantiaNfVeiculos = '';
		$kmGarantiaVeiculos = '';
		$vencimentoSeguroVeiculos = '';
		$vencimentoIpvaVeiculos = '';
		$idClientes = '';
		
		try 
		{
			$sql = mysqli_prepare($conecta,"INSERT INTO veiculos (idVeiculos,placaVeiculos,marcaVeiculos,
			modeloVeiculos,corVeiculos,combustivelVeiculos,capacidadeTanqueVeiculos,anoFabricacaoVeiculos,
			modeloFabricacaoVeiculos,renavamVeiculos,chassiVeiculos,tipoVeiculos,codFipeVeiculos,
			placaNfVeiculos,numeroNfVeiculos,fornecedorNfVeiculos,dataNfVeiculos,cidadeNfVeiculos,
			estadoNfVeiculos,dataEntregaNfVeiculos,kmEntregaNfVeiculos,proprietarioNfVeiculos,
			arrendatarioNfVeiculos,contratanteNfVeiculos,tempoGarantiaNfVeiculos,kmGarantiaVeiculos,
			vencimentoSeguroVeiculos,vencimentoIpvaVeiculos,idClientes) 
			VALUES('',?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
			mysqli_bind_param($sql,'ssssssssssssssssssssssssssss',$placaVeiculos,
			$marcaVeiculos,$modeloVeiculos,$corVeiculos,$combustivelVeiculos,$capacidadeTanqueVeiculos,
			$anoFabricacaoVeiculos,$modeloFabricacaoVeiculos,$renavamVeiculos,$chassiVeiculos,$tipoVeiculos,
			$codFipeVeiculos,$placaNfVeiculos,$numeroNfVeiculos,$fornecedorNfVeiculos,$dataNfVeiculos,
			$cidadeNfVeiculos,$estadoNfVeiculos,$dataEntregaNfVeiculos,$kmEntregaNfVeiculos,
			$proprietarioNfVeiculos,$arrendatarioNfVeiculos,$contratanteNfveiculos,
			$tempoGarantiaNfVeiculos,$kmGarantiaVeiculos,$vencimentoSeguroVeiculos,
			$vencimentoIpvaVeiculos,$idClientes);
			
			$placaVeiculos = $valueObj->getPlacaVeiculos();
			$marcaVeiculos = $valueObj->getMarcaVeiculos();
			$modeloVeiculos = $valueObj->getModeloVeiculos();
			$corVeiculos = $valueObj->getCorVeiculos();
			$combustivelVeiculos = $valueObj->getCombustivelVeiculos();
			$capacidadeTanqueVeiculos = $valueObj->getCapacidadeTanqueVeiculos();
			$anoFabricacaoVeiculos = $valueObj->getAnoFabricacaoVeiculos();
			$modeloFabricacaoVeiculos = $valueObj->getModeloFabricacaoVeiculos();
			$renavamVeiculos = $valueObj->getRenavamVeiculos();
			$chassiVeiculos = $valueObj->getChassiVeiculos();
			$tipoVeiculos = $valueObj->getTipoVeiculos();
			$codFipeVeiculos = $valueObj->getCodFipeVeiculos();
			$placaNfVeiculos = $valueObj->getPlacaNfVeiculos();
			$numeroNfVeiculos = $valueObj->getNumeroNfVeiculos();
			$fornecedorNfVeiculos = $valueObj->getFornecedorNfVeiculos();
			$dataNfVeiculos = $valueObj->getDataNfVeiculos();
			$cidadeNfVeiculos = $valueObj->getCidadeNfVeiculos();
			$estadoNfVeiculos = $valueObj->getEstadoNfVeiculos();
			$dataEntregaNfVeiculos = $valueObj->getDataEntregaNfVeiculos();
			$kmEntregaNfVeiculos = $valueObj->getKmEntregaNfVeiculos();
			$proprietarioNfVeiculos = $valueObj->getProprietarioNfVeiculos();
			$arrendatarioNfVeiculos = $valueObj->getArrendatarioNfVeiculos();
			$contratanteNfveiculos = $valueObj->getContratanteNfveiculos();
			$tempoGarantiaNfVeiculos = $valueObj->getTempoGarantiaNfVeiculos();
			$kmGarantiaVeiculos = $valueObj->getKmGarantiaVeiculos();
			$vencimentoSeguroVeiculos = $valueObj->getVencimentoSeguroVeiculos();
			$vencimentoIpvaVeiculos = $valueObj->getVencimentoIpvaVeiculos();
			$idClientes = $valueObj->getIdClientes();			
			
			if(!mysqli_stmt_execute($sql))
				throw new Exception("Nгo foi posssгvel conectar no banco de dados.");
			
			return $ultimoId = self::ultimoIdInserido($conecta);
		}
		catch ( Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	
	/**
	 * Mйtodo de Updade em Vesгculos
	 * @param Veiculos $veiculos
	 */
	public function updateVeiculos(Veiculos $veiculos)
	{
		$conecta = new Connecta();
		$valueObj = (object)$veiculos;
		
		$idVeiculos = null;
		$placaVeiculos = '';
		$marcaVeiculos = '';
		$modeloVeiculos = '';
		$corVeiculos = '';
		$combustivelVeiculos = '';
		$capacidadeTanqueVeiculos = '';
		$anoFabricacaoVeiculos = '';
		$modeloFabricacaoVeiculos = '';
		$renavamVeiculos = '';
		$chassiVeiculos = '';
		$tipoVeiculos = '';
		$codFipeVeiculos = '';
		$placaNfVeiculos = '';
		$numeroNfVeiculos = '';
		$fornecedorNfVeiculos = '';
		$dataNfVeiculos = '';
		$cidadeNfVeiculos = '';
		$estadoNfVeiculos = '';
		$dataEntregaNfVeiculos = '';
		$kmEntregaNfVeiculos = '';
		$proprietarioNfVeiculos = '';
		$arrendatarioNfVeiculos = '';
		$contratanteNfveiculos = '';
		$tempoGarantiaNfVeiculos = '';
		$kmGarantiaVeiculos = '';
		$vencimentoSeguroVeiculos = '';
		$vencimentoIpvaVeiculos = '';
		$idClientes = '';
		
		try 
		{
			$sql = mysqli_prepare($conecta,"UPDATE veiculos SET placaVeiculos = ?,marcaVeiculos = ?,
			modeloVeiculos = ? ,corVeiculos=?,combustivelVeiculos = ?,capacidadeTanqueVeiculos = ?,
			anoFabricacaoVeiculos = ?,modeloFabricacaoVeiculos=?,renavamVeiculos=?,chassiVeiculos=?,
			tipoVeiculos=?,codFipeVeiculos=?,placaNfVeiculos=?,numeroNfVeiculos=?,fornecedorNfVeiculos=?,
			dataNfVeiculos=?,cidadeNfVeiculos=?,estadoNfVeiculos=?,dataEntregaNfVeiculos=?,
			kmEntregaNfVeiculos=?,proprietarioNfVeiculos=?,arrendatarioNfVeiculos=?,contratanteNfVeiculos=?,
			tempoGarantiaNfVeiculos=?,kmGarantiaVeiculos=?,vencimentoSeguroVeiculos=?,
			vencimentoIpvaVeiculos=?,idClientes=? WHERE idVeiculos = ?");
			mysqli_bind_param($sql,'ssssssssssssssssssssssssssssi',$placaVeiculos,
			$marcaVeiculos,$modeloVeiculos,$corVeiculos,$combustivelVeiculos,$capacidadeTanqueVeiculos,
			$anoFabricacaoVeiculos,$modeloFabricacaoVeiculos,$renavamVeiculos,$chassiVeiculos,$tipoVeiculos,
			$codFipeVeiculos,$placaNfVeiculos,$numeroNfVeiculos,$fornecedorNfVeiculos,$dataNfVeiculos,
			$cidadeNfVeiculos,$estadoNfVeiculos,$dataEntregaNfVeiculos,$kmEntregaNfVeiculos,
			$proprietarioNfVeiculos,$arrendatarioNfVeiculos,$contratanteNfveiculos,
			$tempoGarantiaNfVeiculos,$kmGarantiaVeiculos,$vencimentoSeguroVeiculos,
			$vencimentoIpvaVeiculos,$idClientes,$idVeiculos);
			
			$placaVeiculos = $valueObj->getPlacaVeiculos();
			$marcaVeiculos = $valueObj->getMarcaVeiculos();
			$modeloVeiculos = $valueObj->getModeloVeiculos();
			$corVeiculos = $valueObj->getCorVeiculos();
			$combustivelVeiculos = $valueObj->getCombustivelVeiculos();
			$capacidadeTanqueVeiculos = $valueObj->getCapacidadeTanqueVeiculos();
			$anoFabricacaoVeiculos = $valueObj->getAnoFabricacaoVeiculos();
			$modeloFabricacaoVeiculos = $valueObj->getModeloFabricacaoVeiculos();
			$renavamVeiculos = $valueObj->getRenavamVeiculos();
			$chassiVeiculos = $valueObj->getChassiVeiculos();
			$tipoVeiculos = $valueObj->getTipoVeiculos();
			$codFipeVeiculos = $valueObj->getCodFipeVeiculos();
			$placaNfVeiculos = $valueObj->getPlacaNfVeiculos();
			$numeroNfVeiculos = $valueObj->getNumeroNfVeiculos();
			$fornecedorNfVeiculos = $valueObj->getFornecedorNfVeiculos();
			$dataNfVeiculos = $valueObj->getDataNfVeiculos();
			$cidadeNfVeiculos = $valueObj->getCidadeNfVeiculos();
			$estadoNfVeiculos = $valueObj->getEstadoNfVeiculos();
			$dataEntregaNfVeiculos = $valueObj->getDataEntregaNfVeiculos();
			$kmEntregaNfVeiculos = $valueObj->getKmEntregaNfVeiculos();
			$proprietarioNfVeiculos = $valueObj->getProprietarioNfVeiculos();
			$arrendatarioNfVeiculos = $valueObj->getArrendatarioNfVeiculos();
			$contratanteNfveiculos = $valueObj->getContratanteNfveiculos();
			$tempoGarantiaNfVeiculos = $valueObj->getTempoGarantiaNfVeiculos();
			$kmGarantiaVeiculos = $valueObj->getKmGarantiaVeiculos();
			$vencimentoSeguroVeiculos = $valueObj->getVencimentoSeguroVeiculos();
			$vencimentoIpvaVeiculos = $valueObj->getVencimentoIpvaVeiculos();
			$idClientes = $valueObj->getIdClientes();
			$idVeiculos = $valueObj->getIdVeiculos();	
			
			if(!mysqli_stmt_execute($sql))
				throw new Exception("Nгo foi posssгvel conectar no banco de dados.");
			
		}
		catch ( Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	
	/**
	 * Mйtodo de cadastramento de Cnh
	 * @param Cnh $cnh
	 */
	public function cadastrarCnh(Cnh $cnh)
	{
		$conecta = new Connecta();
		$valueObj = (object)$cnh;
		
		$idCnh = '';
		$numeroCnh = '';
		$categoriaCnh = '';
		$ufCnh = '';
		$vencCnh = '';
		
		try 
		{
			$sql = mysqli_prepare($conecta,"INSERT INTO cnh (idCnh,numeroCnh,categoriaCnh,ufCnh,vencCnh) 
			VALUES('',?,?,?,?)");
			mysqli_bind_param($sql,'ssss',$numeroCnh,$categoriaCnh,$ufCnh,$vencCnh);
			
			$numeroCnh = $valueObj->getNumeroCnh();
			$categoriaCnh = $valueObj->getCategoriaCnh();
			$ufCnh = $valueObj->getUfCnh();
			$vencCnh = $valueObj->getVencCnh();			
			
			if(!mysqli_stmt_execute($sql))
				throw new Exception("Nгo foi posssгvel conectar no banco de dados.");
			
			return $ultimoId = self::ultimoIdInserido($conecta);
		}
		catch ( Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	
	/**
	 * Mйtodo de atualizaзгo de Cnh
	 * @param Cnh $cnh
	 */
	public function updateCnh(Cnh $cnh)
	{
		$conecta = new Connecta();
		$valueObj = (object)$cnh;
		
		$idCnh = '';
		$numeroCnh = '';
		$categoriaCnh = '';
		$ufCnh = '';
		$vencCnh = '';
		
		try 
		{
			$sql = mysqli_prepare($conecta,"UPDATE cnh SET numeroCnh=?,categoriaCnh=?,ufCnh=?,vencCnh=? 
			WHERE idCnh = ? ");
			mysqli_bind_param($sql,'ssssi',$numeroCnh,$categoriaCnh,$ufCnh,$vencCnh,$idCnh);
			
			$numeroCnh = $valueObj->getNumeroCnh();
			$categoriaCnh = $valueObj->getCategoriaCnh();
			$ufCnh = $valueObj->getUfCnh();
			$vencCnh = $valueObj->getVencCnh();
			$idCnh = $valueObj->getIdCnh();		
			
			if(!mysqli_stmt_execute($sql))
				throw new Exception("Nгo foi posssгvel conectar no banco de dados.");
			
		}
		catch ( Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}

	/**
	 * Mйtodo de Cadastramento de Condutores
	 * @param Condutores $condutores
	 */
	public function cadastrarCondutor(Condutores $condutores)
	{
		$conecta = new Connecta();
		$valueObj = (object)$condutores;
		
		$idCondutores = '';
		$dataRegistroCondutores = '';
		$obsCondutores = '';
		$idPessoa = '';
		$idCnh = '';
		
		try 
		{
			$sql = mysqli_prepare($conecta,"INSERT INTO condutores (idCondutores,dataRegistroCondutores,
			obsCondutores,idPessoa,idCnh) VALUES('',?,?,?,?)");
			mysqli_bind_param($sql,'ssss',$dataRegistroCondutores,$obsCondutores,$idPessoa,$idCnh);
			
			$dataRegistroCondutores = $valueObj->getDataRegistroCondutores();
			$obsCondutores = $valueObj->getObsCondutores();
			$idPessoa = $valueObj->getIdPessoa();
			$idCnh = $valueObj->getIdCnh();			
			
			if(!mysqli_stmt_execute($sql))
				throw new Exception("Nгo foi posssгvel conectar no banco de dados.");
			
		}
		catch ( Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	
	/**
	 * Mйtodo de atualizaзгo de Condutores
	 * @param Condutores $condutores
	 */
	public function updateCondutor(Condutores $condutores)
	{
		$conecta = new Connecta();
		$valueObj = (object)$condutores;
		
		$idCondutores = '';
		$dataRegistroCondutores = '';
		$obsCondutores = '';
		$idPessoa = '';
		$idCnh = '';
		
		try 
		{
			$sql = mysqli_prepare($conecta,"UPDATE condutores SET dataRegistroCondutores=?,
			obsCondutores=?,idPessoa=?,idCnh=? WHERE idCondutores=?");
			mysqli_bind_param($sql,'sssss',$dataRegistroCondutores,$obsCondutores,$idPessoa,$idCnh,$idCondutores);
			
			$dataRegistroCondutores = $valueObj->getDataRegistroCondutores();
			$obsCondutores = $valueObj->getObsCondutores();
			$idPessoa = $valueObj->getIdPessoa();
			$idCnh = $valueObj->getIdCnh();
			$idCondutores = $valueObj->getIdCondutores();		
			
			if(!mysqli_stmt_execute($sql))
				throw new Exception("Nгo foi posssгvel conectar no banco de dados.");
			
		}
		catch ( Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	
	/**
	 * Mйtodo de cadastramento de Tipo de RevisГµes
	 * @param Tiporevisoes $tipoRevisoes
	 */
	public function cadastrarTipoRevisoes(Tiporevisoes $tipoRevisoes)
	{
		$conecta = new Connecta();
		$valueObj = (object)$tipoRevisoes;
		
		$idTipoRevisoes = '';
		$descricaoTipoRevisoes = '';
		
		try 
		{
			$sql = mysqli_prepare($conecta,"INSERT INTO tiporevisoes (idTipoRevisoes,descricaoTipoRevisoes) 
			VALUES('',?)");
			mysqli_bind_param($sql,'s',$descricaoTipoRevisoes);
			
			$descricaoTipoRevisoes = $valueObj->getDescricaoTipoRevisoes();			
			
			if(!mysqli_stmt_execute($sql))
				throw new Exception("Nгo foi posssгvel conectar no banco de dados.");
			
		}
		catch ( Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	
	/**
	 * Mйtodo de atualizaзгo de Tipo de RevisГµes
	 * @param Tiporevisoes $tipoRevisoes
	 */
	public function updateTipoRevisoes(Tiporevisoes $tipoRevisoes)
	{
		$conecta = new Connecta();
		$valueObj = (object)$tipoRevisoes;
		
		$idTipoRevisoes = '';
		$descricaoTipoRevisoes = '';
		
		try 
		{
			$sql = mysqli_prepare($conecta,"UPDATE tiporevisoes SET descricaoTipoRevisoes = ? WHERE idTipoRevisoes = ?");
			mysqli_bind_param($sql,'si',$descricaoTipoRevisoes,$idTipoRevisoes);
			
			$descricaoTipoRevisoes = $valueObj->getDescricaoTipoRevisoes();
			$idTipoRevisoes = $valueObj->getIdTipoRevisoes();	
			
			if(!mysqli_stmt_execute($sql))
				throw new Exception("Nгo foi posssгvel conectar no banco de dados.");
			
		}
		catch ( Exception $e)
		{
			throw new Exception($e->getMessage());
		}	
	}
	
	/**
	 * Mйtodo de cadastramento de RevisГµes
	 * @param Revisoes $revisoes
	 */
	public function cadastrarRevisoes(Revisoes $revisoes)
	{
		$conecta = new Connecta();
		$valueObj = $revisoes;
		
		$idRevisoes = '';
		$dataRevisoes = '';
		$kmRevisoes = '';
		$proxDataRevisoes = '';
		$proxKmRevisoes = '';
		$idVeiculos = '';
		$idTipoRevisoes = '';
		
		try 
		{
			$sql = mysqli_prepare($conecta,"INSERT INTO revisoes (idRevisoes, dataRevisoes, kmRevisoes,
			proxDataRevisoes,proxKmRevisoes,idVeiculos,idTipoRevisoes) 
			VALUES('',?,?,?,?,?,?)");
			mysqli_bind_param($sql,'ssssss',$dataRevisoes,$kmRevisoes,$proxDataRevisoes,$proxKmRevisoes,
			$idVeiculos,$idTipoRevisoes);
			
			$dataRevisoes = $valueObj->getDataRevisoes();
			$kmRevisoes = $valueObj->getKmRevisoes();
			$proxDataRevisoes = $valueObj->getProxDataRevisoes();
			$proxKmRevisoes = $valueObj->getProxKmRevisoes();
			$idVeiculos = $valueObj->getIdVeiculos();
			$idTipoRevisoes = $valueObj->getIdTipoRevisoes();			
			
			if(!mysqli_stmt_execute($sql))
				throw new Exception("Nгo foi possнvel conectar no banco de dados.");
			
		}
		catch ( Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	
	/**
	 * Mйtodo de atualizaзгo de RevisГµes
	 * @param Revisoes $revisoes
	 */
	public function updateRevisoes(Revisoes $revisoes)
	{
		$conecta = new Connecta();
		$valueObj = (object)$revisoes;
		
		$idRevisoes = '';
		$dataRevisoes = '';
		$kmRevisoes = '';
		$proxDataRevisoes = '';
		$proxKmRevisoes = '';
		$idVeiculos = '';
		$idTipoRevisoes = '';
		
		try 
		{
			$sql = mysqli_prepare($conecta,"UPDATE revisoes SET dataRevisoes=?, kmRevisoes=?,
			proxDataRevisoes=?,proxKmRevisoes=?,idVeiculos=?,idTipoRevisoes=? 
			WHERE idRevisoes=?");
			mysqli_bind_param($sql,'ssssssi',$dataRevisoes,$kmRevisoes,$proxDataRevisoes,$proxKmRevisoes,
			$idVeiculos,$idTipoRevisoes,$idRevisoes);
			
			$dataRevisoes = $valueObj->getDataRevisoes();
			$kmRevisoes = $valueObj->getKmRevisoes();
			$proxDataRevisoes = $valueObj->getProxDataRevisoes();
			$proxKmRevisoes = $valueObj->getProxKmRevisoes();
			$idVeiculos = $valueObj->getIdVeiculos();
			$idTipoRevisoes = $valueObj->getIdTipoRevisoes();
			$idRevisoes = $valueObj->getIdRevisoes();			
			
			if(!mysqli_stmt_execute($sql))
				throw new Exception("Nгo foi posssгvel conectar no banco de dados.");
			
		}
		catch ( Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}

	/**
	 * Mйtodo de cadastramento de Abastecimentos
	 * @param Abastecimentos $abastecimentos
	 */
	public function cadastrarAbastecimentos(Abastecimentos $abastecimentos)
	{
		$conecta = new Connecta();
		$valueObj = (object)$abastecimentos;
		
		$idAbastecimentos = '';
		$dataAbastecimentos = '';
		$kmAbastecimentos = '';
		$postoAbastecimentos = '';
		$nfAbastecimentos = '';
		$tipoCombustivelAbastecimentos = '';
		$valorAbastecimentos = '';
		$litrosAbastecimentos = '';
		$idVeiculos = '';
		$idPessoa = '';
		
		try 
		{
			$sql = mysqli_prepare($conecta,"INSERT INTO abastecimentos (idAbastecimentos, dataAbastecimentos,
			kmAbastecimentos,postoAbastecimentos,nfAbastecimentos,tipoCombustivelAbastecimentos,
			valorAbastecimentos,litrosAbastecimentos,idVeiculos,idPessoa) VALUES('',
			?,?,?,?,?,?,?,?,?)");
			mysqli_bind_param($sql,'sssssssii',$dataAbastecimentos,$kmAbastecimentos,$postoAbastecimentos,
			$nfAbastecimentos,$tipoCombustivelAbastecimentos,$valorAbastecimentos,$litrosAbastecimentos,
			$idVeiculos,$idPessoa);
			
			$dataAbastecimentos = $valueObj->getDataAbastecimentos();
			$kmAbastecimentos = $valueObj->getKmAbastecimentos();
			$postoAbastecimentos = $valueObj->getPostoAbastecimentos();
			$nfAbastecimentos = $valueObj->getNfAbastecimentos();
			$tipoCombustivelAbastecimentos = $valueObj->getTipoCombustivelAbastecimentos();
			$valorAbastecimentos = $valueObj->getValorAbastecimentos();
			$litrosAbastecimentos = $valueObj->getLitrosAbastecimentos();
			$idVeiculos = $valueObj->getIdVeiculos();
			$idPessoa = $valueObj->getIdPessoa();	
			
			if(!mysqli_stmt_execute($sql))
				throw new Exception("Nгo foi posssгvel conectar no banco de dados.");
			
		}
		catch ( Exception $e)
		{
			throw new Exception($e->getMessage());
		}	
	}
	
	/**
	 * Mйtodo de atualizaзгo de Abastecimentos
	 * @param Abastecimentos $abastecimentos
	 */
	public function updateAbastecimentos(Abastecimentos $abastecimentos)
	{
		$conecta = new Connecta();
		$valueObj = (object)$abastecimentos;
		
		$idAbastecimentos = '';
		$dataAbastecimentos = '';
		$kmAbastecimentos = '';
		$postoAbastecimentos = '';
		$nfAbastecimentos = '';
		$tipoCombustivelAbastecimentos = '';
		$valorAbastecimentos = '';
		$litrosAbastecimentos = '';
		$idVeiculos = '';
		$idPessoa = '';
		
		try 
		{
			$sql = mysqli_prepare($conecta,"UPDATE abastecimentos SET dataAbastecimentos=?,
			kmAbastecimentos=?,postoAbastecimentos=?,nfAbastecimentos=?,tipoCombustivelAbastecimentos=?,
			valorAbastecimentos=?,litrosAbastecimentos=?,idVeiculos=?,idPessoa=? WHERE idAbastecimentos=?");
			mysqli_bind_param($sql,'sssssssiii',$dataAbastecimentos,$kmAbastecimentos,$postoAbastecimentos,
			$nfAbastecimentos,$tipoCombustivelAbastecimentos,$valorAbastecimentos,$litrosAbastecimentos,
			$idVeiculos,$idPessoa,$idAbastecimentos);
			
			$dataAbastecimentos = $valueObj->getDataAbastecimentos();
			$kmAbastecimentos = $valueObj->getKmAbastecimentos();
			$postoAbastecimentos = $valueObj->getPostoAbastecimentos();
			$nfAbastecimentos = $valueObj->getNfAbastecimentos();
			$tipoCombustivelAbastecimentos = $valueObj->getTipoCombustivelAbastecimentos();
			$valorAbastecimentos = $valueObj->getValorAbastecimentos();
			$litrosAbastecimentos = $valueObj->getLitrosAbastecimentos();
			$idVeiculos = $valueObj->getIdVeiculos();
			$idPessoa = $valueObj->getIdPessoa();
			$idAbastecimentos = $valueObj->getIdAbastecimentos();
			
			if(!mysqli_stmt_execute($sql))
				throw new Exception("Nгo foi posssгvel conectar no banco de dados.");
			
		}
		catch ( Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	
	/**
	 * Mйtodo de Cadastramento de Avisos
	 * @param Avisos $avisos
	 */
	public function cadastrarAvisos(Avisos $avisos)
	{
		$conecta = new Connecta();
		$valueObj = (object)$avisos;
		
		$idAvisos = '';
		$dataAvisos = '';
		$idClientes = '';
		$assuntoAvisos = '';
		
		try 
		{
			$sql = mysqli_prepare($conecta,"INSERT INTO avisos (idAvisos,dataAvisos,
			idClientes,assuntoAvisos) VALUES('',?,?,?)");
			mysqli_bind_param($sql,'sss',$dataAvisos,$idClientes,$assuntoAvisos);
			
			$dataAvisos = $valueObj->getDataAvisos();
			$idClientes = $valueObj->getIdClientes();
			$assuntoAvisos = $valueObj->getAssuntoAvisos();	
			
			if(!mysqli_stmt_execute($sql))
				throw new Exception("Nгo foi posssгvel conectar no banco de dados.");
			
		}
		catch ( Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	
	/**
	 * Mйtodo de atualizaзгo de Aviso de Veiculos
	 * @param Avisosveiculos $avisosVeiculos
	 */
	public function updateAvisos(Avisos $avisos)
	{
		$conecta = new Connecta();
		$valueObj = (object)$avisos;
		
		$idAvisos = '';
		$dataAvisos = '';
		$idClientes = '';
		$assuntoAvisos = '';
		
		try 
		{
			$sql = mysqli_prepare($conecta,"UPDATE avisos SET dataAvisos = ?,
			idClientes=?,assuntoAvisos=? WHERE idAvisos = ?");
			mysqli_bind_param($sql,'sssi',$dataAvisos,$idClientes,$assuntoAvisos,$idAvisos);
			
			$dataAvisos = $valueObj->getDataAvisos();
			$idClientes = $valueObj->getIdClientes();
			$assuntoAvisos = $valueObj->getAssuntoAvisos();
			$idAvisos = $valueObj->getIdAvisos();	
			
			if(!mysqli_stmt_execute($sql))
				throw new Exception("Nгo foi posssгvel conectar no banco de dados.");
			
		}
		catch ( Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	
}

?>