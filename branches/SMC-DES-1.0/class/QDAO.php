<?php
/**
 * Classe Value Object para transferência entre as camadas.
 * @author João Batista Padilha e Silva
 * @link QDAO.php
 * @copyright João Batista Padilha e Silva Especialista em TI (http://www.joaopadilha.eti.br) / joao.padilha@globo.com
 * @version 1.0
 */
class QDAO 
{
	
	/**
	 * Método de Procurar logon
	 * @author João Padilha
	 * @param Logon $logon
	 */
	public function findLogon(Logon $logon)
	{
		$collVo = null;
		$valueObj = new Logon();
		$conecta = new Connecta();
		
		$valueObj = $logon;
		
		$where = '';
		
		
		$idlogon = null;
		$login = '';
		$senha = '';
		$dataUltimoLogin = '';
		$nivelAcessoLogin = '';
		$idPessoa = '';
		$idClientes = '';
		
		$sql = "SELECT * FROM logon ";
		
		if(!is_null($valueObj->getIdLogin()))
			$where = "WHERE idLogin = ?";
		elseif ($valueObj->getLogin() != '' && $valueObj->getSenha() != '')
		{
			$where = "WHERE login = ? AND senha = SHA1(?)";
		}
		elseif(!is_null($valueObj->getIdClientes()))
		{
			$where = "WHERE idClientes = ?";
		}

		try 
		{
			$sql .= $where;
			$prepare = mysqli_prepare($conecta,$sql);
			
			if(!is_null($valueObj->getIdLogin()))
			{
				mysqli_stmt_bind_param($prepare,'i',$idlogon);
			}
			elseif ($valueObj->getLogin() != '' && $valueObj->getSenha())
			{
				mysqli_stmt_bind_param($prepare,'ss',$login,$senha);
			}
			elseif(!is_null($valueObj->getIdClientes()))
			{
				mysqli_stmt_bind_param($prepare,'i',$idClientes);
			}
			
			
			$idlogon = $valueObj->getIdLogin();
			$login = $valueObj->getLogin();
			$senha = $valueObj->getSenha();
			$idClientes = $valueObj->getIdClientes();
			
			if(!mysqli_stmt_execute($prepare))
				throw new Exception("Não foi possível conectar no banco de dados.");
			
			mysqli_stmt_bind_result($prepare,$idlogon,$login,$senha,$dataUltimoLogin,$nivelAcessoLogin,$idPessoa,$idClientes);
			while(mysqli_stmt_fetch($prepare))
			{
				$valueObj = new Logon();
				$valueObj->setIdLogin($idlogon);
				$valueObj->setLogin($login);
				$valueObj->setSenha($senha);
				$valueObj->setDataUltimoLogin($dataUltimoLogin);
				$valueObj->setNivelAcessoLogin($nivelAcessoLogin);
				$valueObj->setIdPessoa($idPessoa);
				$valueObj->setIdClientes($idClientes);
				$collVo[] = $valueObj;
			}
		}
		catch (Exception $e)
		{
			throw new Exception("Não foi possível listar a tabela logon. ".$e->getMessage());
		}
		$conecta = null;
		$valueObj = null;
		return $collVo;
	}

	/**
	 * Método de procura de Clientes
	 * @param $cliente
	 */
	public function findClientes(Clientes $cliente)
	{
		$collVo = null;
		$valueObj = new Clientes();
		$conecta = new Connecta();
		
		$valueObj = $cliente;
		
		$idClientes = "";
		$dataRegistroClientes = "";
		$statusClientes = "";
		$idPessoa = null;
		$idEmpresa = null;
		
		$where = '';
		
		$sql = "SELECT * FROM clientes ";
		
		if(!is_null($valueObj->getIdClientes()))
		{
			$where = "WHERE idClientes = ?";
		}
		elseif (!is_null($valueObj->getIdPessoa()))
		{
			$where = "WHERE idPessoa = ?";
		}
		elseif (!is_null($valueObj->getIdPessoa()))
		{
			$where = "WHERE idEmpresa = ?";
		}
		
		try 
		{
			$sql .= $where;
			$prepare = mysqli_prepare($conecta,$sql);
			
			if(!is_null($valueObj->getIdClientes()))
			{
				mysqli_stmt_bind_param($prepare,'i',$idClientes);
			}
			elseif ($valueObj->getIdPessoa())
			{
				mysqli_stmt_bind_param($prepare,'s',$idPessoa);
			}
			elseif ($valueObj->getIdEmpresa())
			{
				mysqli_stmt_bind_param($prepare,'s',$idEmpresa);
			}
			
			$idClientes = $valueObj->getIdClientes();
			$idPessoa = $valueObj->getIdPessoa();
			$idEmpresa = $valueObj->getIdEmpresa();
			
			if(!mysqli_stmt_execute($prepare))
				throw new Exception("Não foi possível conectar no banco de dados.");
			
			mysqli_stmt_bind_result($prepare,$idClientes,$dataRegistroClientes,$statusClientes,
			$idPessoa,$idEmpresa);
			while(mysqli_stmt_fetch($prepare))
			{
				$valueObj = new Clientes();
				$valueObj->setIdClientes($idClientes);
				$valueObj->setDataRegistroClientes($dataRegistroClientes);
				$valueObj->setStatusClientes($statusClientes);
				$valueObj->setIdPessoa($idPessoa);
				$valueObj->setIdEmpresa($idEmpresa);
				$collVo[] = $valueObj;
			}
		}
		catch (Exception $e)
		{
			throw new Exception("Não foi possível listar a tabela Clientes. ".$e->getMessage());
		}
		$conecta = null;
		$valueObj = null;
		return $collVo;
	}

	/**
	 * Método de procura de pessoas
	 * @param Pessoa $pessoa
	 */
	public function findPessoa(Pessoa $pessoa)
	{
		$collVo = null;
		$valueObj = null;
		$valueObj = new Pessoa();
		$conecta = new Connecta();
		
		$valueObj = $pessoa;
		
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
		
		$where = '';
		
		$sql = "SELECT * FROM pessoa ";
		
		if(!is_null($valueObj->getIdPessoa()) && is_null($valueObj->getDataNascimentoPessoa()))
		{
			$where = "WHERE idPessoa = ? ";
		}
		elseif(!is_null($valueObj->getIdPessoa()) && !is_null($valueObj->getDataNascimentoPessoa()))
		{
			$dataAniversario = explode("-",$valueObj->getDataNascimentoPessoa());
			if($dataAniversario[2] != 0)
			{
				$where = "WHERE idPessoa = ? AND dataNascimentoPessoa like '%{$dataAniversario[1]}-{$dataAniversario[2]}'";
			}
			else
			{
				$where = "WHERE idPessoa = ? AND dataNascimentoPessoa like '%-{$dataAniversario[1]}-%'";
			}
		}
		elseif(!is_null($valueObj->getIdCliente()) && !is_null($valueObj->getDataNascimentoPessoa()))
		{
			$dataAniversario = explode("-",$valueObj->getDataNascimentoPessoa());
			if($dataAniversario[2] != 0)
			{
				$where = "WHERE idCliente = ? AND dataNascimentoPessoa like '%{$dataAniversario[1]}-{$dataAniversario[2]}'";
			}
			else
			{
				$where = "WHERE idCliente = ? AND dataNascimentoPessoa like '%-{$dataAniversario[1]}-%'";
			}
		}
		elseif(!is_null($valueObj->getDataNascimentoPessoa()))
		{
			$dataAniversario = explode("-",$valueObj->getDataNascimentoPessoa());
			if($dataAniversario[2] != 0)
			{
				$where = "WHERE dataNascimentoPessoa like '%{$dataAniversario[1]}-{$dataAniversario[2]}'";
			}
			else 
			{
				$where = "WHERE dataNascimentoPessoa like '%-{$dataAniversario[1]}-%'";
			}
		}
		elseif(!is_null($valueObj->getIdCliente()) && !is_null($valueObj->getNomePessoa()))
		{
			$where = "WHERE idCliente = ? AND nomePessoa like '%{$valueObj->getNomePessoa()}%'";
		}
		elseif(!is_null($valueObj->getIdCliente()))
		{
			$where = "WHERE idCliente = ?";
		}
		
		try 
		{
			$sql .= $where;
			$prepare = mysqli_prepare($conecta,$sql);
			
			if(!is_null($valueObj->getIdPessoa()))
			{
				mysqli_stmt_bind_param($prepare,'i',$idPessoa);
			}
			elseif(!is_null($valueObj->getIdCliente()))
			{
				mysqli_stmt_bind_param($prepare,'i',$idCliente);
			}
						
			$idPessoa = $valueObj->getIdPessoa();
			$idCliente = $valueObj->getIdCliente();
			
			if(!mysqli_stmt_execute($prepare))
				throw new Exception("Não foi possível conectar no banco de dados.");
			
			mysqli_stmt_bind_result($prepare,$idPessoa,$cpfPessoa,$nomePessoa,$dataNascimentoPessoa,$sexoPessoa,
			$estadoCivilPessoa,$rgPessoa,$orgExpPessoa,$ufOrgExpPessoa,$complementoPessoa,$idConjuguePessoa,$idCliente);
			while(mysqli_stmt_fetch($prepare))
			{
				$valueObj = new Pessoa();
				$valueObj->setIdPessoa($idPessoa);
				$valueObj->setCpfPessoa($cpfPessoa);
				$valueObj->setNomePessoa($nomePessoa);
				$valueObj->setDataNascimentoPessoa($dataNascimentoPessoa);
				$valueObj->setSexoPessoa($sexoPessoa);
				$valueObj->setEstadoCivilPessoa($estadoCivilPessoa);
				$valueObj->setRgPessoa($rgPessoa);
				$valueObj->setOrgExpPessoa($orgExpPessoa);
				$valueObj->setUfOrgExpPessoa($ufOrgExpPessoa);
				$valueObj->setComplementoPessoa($complementoPessoa);
				$valueObj->setIdConjuguePessoa($idConjuguePessoa);
				$valueObj->setIdCliente($idCliente);
				$collVo[] = $valueObj;
			}
		}
		catch (Exception $e)
		{
			throw new Exception("Não foi possível listar a tabela pessoa. ".$e->getMessage());
		}
		$conecta = null;
		$valueObj = null;
		return $collVo;
	}
	
	/**
	 * Método que retorna empresas
	 * @param $empresas
	 */
	public function findEmpresas(Empresas $empresas)
	{
		$collVo = null;
		$valueObj = null;
		$valueObj = new Empresas();
		$conecta = new Connecta();
		
		$valueObj = $empresas;
		
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
		
		$where = '';
		
		$sql = "SELECT * FROM empresas ";
		
		if(!is_null($valueObj->getIdEmpresa()))
		{
			$where = "WHERE idEmpresa = ?";
		}
		elseif(!is_null($valueObj->getIdClientes()) && !is_null($valueObj->getNomeEmpresa()))
		{
			$where = "WHERE idClientes = ? AND (nomeEmpresa like '%{$valueObj->getNomeEmpresa()}%' OR nomeFantasiaEmpresa like '%{$valueObj->getNomeFantasiaEmpresa()}%')";
		}
		elseif(!is_null($valueObj->getIdClientes()))
		{
			$where = "WHERE idClientes = ?";
		}
		try 
		{
			$sql .= $where;
			$prepare = mysqli_prepare($conecta,$sql);
			
			if(!is_null($valueObj->getIdEmpresa()))
			{
				mysqli_stmt_bind_param($prepare,'i',$idEmpresa);
			}
			elseif(!is_null($valueObj->getIdClientes()))
			{
				mysqli_stmt_bind_param($prepare,'i',$idClientes);
			}
			
			$idEmpresa = $valueObj->getIdEmpresa();
			$idClientes = $valueObj->getIdClientes();
			
			if(!mysqli_stmt_execute($prepare))
				throw new Exception("Não foi possível conectar no banco de dados.");
			
			mysqli_stmt_bind_result($prepare,$idEmpresa,$cnpjEmpresa,$nomeEmpresa,
			$nomeFantasiaEmpresa,$dataFundacaoEmpresa,$origemEmpresa,
			$ramoEmpresa,$inscricaoEstadualEmpresa,$dataCadastro,$idDiretor,$idClientes);
			while(mysqli_stmt_fetch($prepare))
			{
				$valueObj = new Empresas();
				$valueObj->setIdEmpresa($idEmpresa);
				$valueObj->setCnpjEmpresa($cnpjEmpresa);
				$valueObj->setNomeEmpresa($nomeEmpresa);
				$valueObj->setNomeFantasiaEmpresa($nomeFantasiaEmpresa);
				$valueObj->setDataFundacaoEmpresa($dataFundacaoEmpresa);
				$valueObj->setOrigemEmpresa($origemEmpresa);
				$valueObj->setRamoEmpresa($ramoEmpresa);
				$valueObj->setInscricaoEstadualEmpresa($inscricaoEstadualEmpresa);
				$valueObj->setDataCadastro($dataCadastro);
				$valueObj->setIdDiretor($idDiretor);
				$valueObj->setIdClientes($idClientes);
				$collVo[] = $valueObj;
			}
		}
		catch (Exception $e)
		{
			throw new Exception("Não foi possível listar a tabela empresas. ".$e->getMessage());
		}
		$conecta = null;
		$valueObj = null;
		return $collVo;
	}
	
	/**
	 * Método de busca de EmpresaCondutores
	 * @param EmpresaCondutores $empresaCondutores
	 */
	public function findEmpresasCondutores(EmpresaCondutores $empresaCondutores)
	{
		$collVo = null;
		$valueObj = null;
		$valueObj = new EmpresaCondutores();
		$conecta = new Connecta();
		
		$valueObj = $empresaCondutores;
		
		$idEmpresaCondutores = null;
		$idEmpresa = null;
		$idCondutores = null;
		
		$where = '';
		
		$sql = "SELECT * FROM empresacondutores ";
		
		if(!is_null($valueObj->getIdEmpresa()))
		{
			$where = "WHERE idEmpresa = ?";
		}
		elseif(!is_null($valueObj->getIdCondutores()))
		{
			$where = "WHERE idCondutores = ?";
		}
		try 
		{
			$sql .= $where;
			$prepare = mysqli_prepare($conecta,$sql);
			
			if(!is_null($valueObj->getIdEmpresa()))
			{
				mysqli_stmt_bind_param($prepare,'i',$idEmpresa);
			}
			elseif (!is_null($valueObj->getIdCondutores()))
			{
				mysqli_stmt_bind_param($prepare,'i',$idCondutores);
			}
			
			$idEmpresa = $valueObj->getIdEmpresa();
			
			if(!mysqli_stmt_execute($prepare))
				throw new Exception("Não foi possível conectar no banco de dados.");
			
			mysqli_stmt_bind_result($prepare,$idEmpresaCondutores,$idEmpresa,$idCondutores);
			
			while(mysqli_stmt_fetch($prepare))
			{
				$valueObj = new EmpresaCondutores();
				$valueObj->setIdEmpresaCondutores($idEmpresaCondutores);
				$valueObj->setIdEmpresa($idEmpresa);
				$valueObj->setIdCondutores($idCondutores);
				$collVo[] = $valueObj;
			}
		}
		catch (Exception $e)
		{
			throw new Exception("Não foi possível listar a tabela empresascondutores. ".$e->getMessage());
		}
		$conecta = null;
		$valueObj = null;
		return $collVo;
	}

	/**
	 * Método de procura de Condutores
	 * @param Condutores $condutores
	 */
	public function findCondutores(Condutores $condutores)
	{
		$collVo = null;
		$valueObj = null;
		$valueObj = new Condutores();
		$conecta = new Connecta();
		
		$valueObj = $condutores;
		
		$idCondutores = null;
		$dataRegistroCondutores = '';
		$obsCondutores = '';
		$idPessoa = null;
		$idCnh = null;
		
		$where = '';
		
		$sql = "SELECT * FROM condutores ";
		
		if(!is_null($valueObj->getIdCondutores()))
		{
			$where = "WHERE idCondutores = ?";
		}
		elseif (!is_null($valueObj->getIdCnh()))
		{
			$where = "WHERE idCnh = ?";
		}
		elseif (!is_null($valueObj->getIdPessoa()))
		{
			$where = "WHERE idPessoa = ?";
		}
		
		try 
		{
			$sql .= $where;
			$prepare = mysqli_prepare($conecta,$sql);
			
			if(!is_null($valueObj->getIdCondutores()))
			{
				mysqli_stmt_bind_param($prepare,'i',$idCondutores);
			}
			elseif (!is_null($valueObj->getIdCnh()))
			{
				mysqli_stmt_bind_param($prepare,'i',$idCnh);
			}
			elseif (!is_null($valueObj->getIdPessoa()))
			{
				mysqli_stmt_bind_param($prepare,'i',$idPessoa);
			}
			
			$idCondutores = $valueObj->getIdCondutores();
			$idCnh = $valueObj->getIdCnh();
			$idPessoa = $valueObj->getIdPessoa();
			
			if(!mysqli_stmt_execute($prepare))
				throw new Exception("Não foi possível conectar no banco de dados.");
			
			mysqli_stmt_bind_result($prepare,$idCondutores,$dataRegistroCondutores,
			$obsCondutores,$idPessoa,$idCnh);
			
			while(mysqli_stmt_fetch($prepare))
			{
				$valueObj = new Condutores();
				$valueObj->setIdCondutores($idCondutores);
				$valueObj->setDataRegistroCondutores($dataRegistroCondutores);
				$valueObj->setObsCondutores($obsCondutores);
				$valueObj->setIdPessoa($idPessoa);
				$valueObj->setIdCnh($idCnh);
				$collVo[] = $valueObj;
			}
		}
		catch (Exception $e)
		{
			throw new Exception("Não foi possível listar a tabela condutores. ".$e->getMessage());
		}
		$conecta = null;
		$valueObj = null;
		return $collVo;
	}
	
	/**
	 * Método de procura de CNh
	 * @param Cnh $cnh
	 */
	public function findCnh(Cnh $cnh)
	{
		$collVo = null;
		$valueObj = null;
		$valueObj = new Cnh();
		$conecta = new Connecta();
		
		$valueObj = $cnh;
		
		$idCnh = null;
		$numeroCnh = '';
		$categoriaCnh = '';
		$ufCnh = '';
		$vencCnh = '';
		$idCondutores = '';
		
		$where = '';
		
		$sql = "SELECT * FROM cnh ";
		
		if(!is_null($valueObj->getIdCnh()) && !is_null($valueObj->getVencCnh()))
		{
			$dataCnh = explode("-",$valueObj->getVencCnh());
			if($dataCnh[0] == 0 && $dataCnh[2] == 0)
			{
				$where = "WHERE idCnh = ? AND vencCnh like '%-{$dataCnh[1]}-%'";
			}
			else
			{
				$where = "WHERE idCnh = ? AND vencCnh = ?";
			}
		}
		elseif(!is_null($valueObj->getIdCnh()))
		{
			$where = "WHERE idCnh = ?";
		}
		elseif(!is_null($valueObj->getVencCnh()))
		{
			$dataCnh = explode("-",$valueObj->getVencCnh());
			if($dataCnh[0] == 0 && $dataCnh[2] == 0)
			{
				$where = "WHERE vencCnh like '%-{$dataCnh[1]}-%'";
			}
			else
			{
				$where = "WHERE vencCnh = ?";
			}
		}
		elseif(!is_null($valueObj->getNumeroCnh()))
		{
			$where = "WHERE numeroCnh = ?";
		}
		
		try 
		{
			$sql .= $where;
			$prepare = mysqli_prepare($conecta,$sql);
			
			if(!is_null($valueObj->getIdCnh()) && !is_null($valueObj->getVencCnh()))
			{
				$dataCnh = explode("-",$valueObj->getVencCnh());
				if(!($dataCnh[0] == 0 && $dataCnh[2] == 0))
				{
					mysqli_stmt_bind_param($prepare,'is',$idCnh,$vencCnh);
				}
				else
				{
					mysqli_stmt_bind_param($prepare,'i',$idCnh);
				}
			}
			elseif(!is_null($valueObj->getIdCnh()))
			{
				mysqli_stmt_bind_param($prepare,'i',$idCnh);
			}
			elseif(!is_null($valueObj->getVencCnh()))
			{
				$dataCnh = explode("-",$valueObj->getVencCnh());
				if(!($dataCnh[0] == 0 && $dataCnh[2] == 0))
				{
					mysqli_stmt_bind_param($prepare,'s',$vencCnh);
				}
			}
			elseif(!is_null($valueObj->getNumeroCnh()))
			{
				mysqli_stmt_bind_param($prepare,'s',$numeroCnh);
			}
						
			$idCnh = $valueObj->getIdCnh();
			$vencCnh = $valueObj->getVencCnh();
			$numeroCnh = $valueObj->getNumeroCnh();
			
			if(!mysqli_stmt_execute($prepare))
				throw new Exception("Não foi possível conectar no banco de dados.");
			
			mysqli_stmt_bind_result($prepare,$idCnh,$numeroCnh,$categoriaCnh,$ufCnh,$vencCnh);
			while(mysqli_stmt_fetch($prepare))
			{
				$valueObj = new Cnh();
				$valueObj->setIdCnh($idCnh);
				$valueObj->setNumeroCnh($numeroCnh);
				$valueObj->setCategoriaCnh($categoriaCnh);
				$valueObj->setUfCnh($ufCnh);
				$valueObj->setVencCnh($vencCnh);
				$collVo[] = $valueObj;
			}
		}
		catch (Exception $e)
		{
			throw new Exception("Não foi possível listar a tabela Cnh. ".$e->getMessage());
		}
		$conecta = null;
		$valueObj = null;
		return $collVo;
	}
	
	/**
	 * Lista de Veículos
	 * @param Veiculos $veiculos
	 */
	public function findVeiculos(Veiculos $veiculos)
	{
		$collVo = null;
		$valueObj = null;
		$valueObj = new Veiculos();
		$conecta = new Connecta();
		
		$valueObj = $veiculos;
		
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
		
		$where = '';
		
		$sql = "SELECT * FROM veiculos ";
		
		if(!is_null($valueObj->getIdVeiculos()) && !is_null($valueObj->getVencimentoIpvaVeiculos()) && is_null($valueObj->getVencimentoSeguroVeiculos()))
		{
			$dataIpva = explode("-",$valueObj->getVencimentoIpvaVeiculos());
			if($dataIpva[0] == 0 && $dataIpva[2] == 0)
			{
				$where = "WHERE idVeiculos = ? AND vencimentoIpvaVeiculos like '%-{$dataIpva[1]}-%'";
			}
			else
			{
				$where = "WHERE idVeiculos = ? AND vencimentoIpvaVeiculos = ?";
			}
		}
		elseif(!is_null($valueObj->getIdVeiculos()) && is_null($valueObj->getVencimentoIpvaVeiculos()) && !is_null($valueObj->getVencimentoSeguroVeiculos()))
		{
			$dataSeguro = explode("-",$valueObj->getVencimentoSeguroVeiculos());
			if($dataSeguro[0] == 0 && $dataSeguro[2] == 0)
			{
				$where = "WHERE idVeiculos = ? AND vencimentoSeguroVeiculos like '%-{$dataSeguro[1]}-%'";
			}
			else
			{
				$where = "WHERE idVeiculos = ? AND vencimentoSeguroVeiculos = ?";
			}
		}
		elseif(!is_null($valueObj->getIdVeiculos()))
		{
			$where = "WHERE idVeiculos = ?";
		}
		elseif (!is_null($valueObj->getVencimentoIpvaVeiculos()))
		{
			$dataIpva = explode("-",$valueObj->getVencimentoIpvaVeiculos());
			if($dataIpva[0] == 0 && $dataIpva[2] == 0)
			{
				$where = "WHERE vencimentoIpvaVeiculos like '%-{$dataIpva[1]}-%'";
			}
			else
			{
				$where = "WHERE vencimentoIpvaVeiculos = ?";
			}
		}
		elseif (!is_null($valueObj->getVencimentoSeguroVeiculos()))
		{
			$dataSeguro = explode("-",$valueObj->getVencimentoSeguroVeiculos());
			if($dataSeguro[0] == 0 && $dataSeguro[2] == 0)
			{
				$where = "WHERE vencimentoSeguroVeiculos like '%-{$dataSeguro[1]}-%'";
			}
			else
			{
				$where = "WHERE vencimentoSeguroVeiculos = ?";
			}
		}
		elseif(!is_null($valueObj->getIdClientes()))
		{
			$where = "WHERE idClientes = ?";
		}
		
		try 
		{
			$sql .= $where;
			$prepare = mysqli_prepare($conecta,$sql);
			
			if(!is_null($valueObj->getIdVeiculos()) && !is_null($valueObj->getVencimentoIpvaVeiculos()) && is_null($valueObj->getVencimentoSeguroVeiculos()))
			{
				$dataIpva = explode("-",$valueObj->getVencimentoIpvaVeiculos());
				if(!($dataIpva[0] == 0 && $dataIpva[2] == 0))
				{
					mysqli_stmt_bind_param($prepare,'is',$idVeiculos,$vencimentoIpvaVeiculos);
				}
				else
				{
					mysqli_stmt_bind_param($prepare,'i',$idVeiculos);
				}
			}
			elseif(!is_null($valueObj->getIdVeiculos()) && is_null($valueObj->getVencimentoIpvaVeiculos()) && !is_null($valueObj->getVencimentoSeguroVeiculos()))
			{
				$dataSeguro = explode("-",$valueObj->getVencimentoSeguroVeiculos());
				if(!($dataSeguro[0] == 0 && $dataSeguro[2] == 0))
				{
					mysqli_stmt_bind_param($prepare,'is',$idVeiculos,$vencimentoSeguroVeiculos);
				}
				else
				{
					mysqli_stmt_bind_param($prepare,'i',$idVeiculos);
				}
			}
			elseif(!is_null($valueObj->getIdVeiculos()))
			{
				mysqli_stmt_bind_param($prepare,'i',$idVeiculos);
			}
			elseif (!is_null($valueObj->getVencimentoIpvaVeiculos()))
			{
				$dataIpva = explode("-",$valueObj->getVencimentoIpvaVeiculos());
				if(!($dataIpva[0] == 0 && $dataIpva[2] == 0))
				{
					mysqli_stmt_bind_param($prepare,'s',$vencimentoIpvaVeiculos);
				}
			}
			elseif (!is_null($valueObj->getVencimentoSeguroVeiculos()))
			{
				$dataSeguro = explode("-",$valueObj->getVencimentoSeguroVeiculos());
				if(!($dataSeguro[0] == 0 && $dataSeguro[2] == 0))
				{
					mysqli_stmt_bind_param($prepare,'s',$vencimentoSeguroVeiculos);
				}
			}
			elseif(!is_null($valueObj->getIdClientes()))
			{
				mysqli_stmt_bind_param($prepare,'s',$idClientes);
			}
			
			
			$idVeiculos = $valueObj->getIdVeiculos();
			$vencimentoIpvaVeiculos = $valueObj->getVencimentoIpvaVeiculos();
			$vencimentoSeguroVeiculos = $valueObj->getVencimentoSeguroVeiculos();
			$idClientes = $valueObj->getIdClientes();
			
			if(!mysqli_stmt_execute($prepare))
				throw new Exception("Não foi possível conectar no banco de dados.");
			
			mysqli_stmt_bind_result($prepare,$idVeiculos,$placaVeiculos,$marcaVeiculos,
			$modeloVeiculos,$corVeiculos,$combustivelVeiculos,$capacidadeTanqueVeiculos,
			$anoFabricacaoVeiculos,$modeloFabricacaoVeiculos,$renavamVeiculos,$chassiVeiculos,
			$tipoVeiculos,$codFipeVeiculos,$placaNfVeiculos,$numeroNfVeiculos,$fornecedorNfVeiculos,
			$dataNfVeiculos,$cidadeNfVeiculos,$estadoNfVeiculos,$dataEntregaNfVeiculos,
			$kmEntregaNfVeiculos,$proprietarioNfVeiculos,$arrendatarioNfVeiculos,$contratanteNfveiculos,
			$tempoGarantiaNfVeiculos,$kmGarantiaVeiculos,$vencimentoSeguroVeiculos,$vencimentoIpvaVeiculos,
			$idClientes);
			
			while(mysqli_stmt_fetch($prepare))
			{
				$valueObj = new Veiculos();
				$valueObj->setIdVeiculos($idVeiculos);
				$valueObj->setPlacaVeiculos($placaVeiculos);
				$valueObj->setMarcaVeiculos($marcaVeiculos);
				$valueObj->setModeloVeiculos($modeloVeiculos);
				$valueObj->setCorVeiculos($corVeiculos);
				$valueObj->setCombustivelVeiculos($combustivelVeiculos);
				$valueObj->setCapacidadeTanqueVeiculos($capacidadeTanqueVeiculos);
				$valueObj->setAnoFabricacaoVeiculos($anoFabricacaoVeiculos);
				$valueObj->setModeloFabricacaoVeiculos($modeloFabricacaoVeiculos);
				$valueObj->setRenavamVeiculos($renavamVeiculos);
				$valueObj->setChassiVeiculos($chassiVeiculos);
				$valueObj->setTipoVeiculos($tipoVeiculos);
				$valueObj->setCodFipeVeiculos($codFipeVeiculos);
				$valueObj->setPlacaNfVeiculos($placaNfVeiculos);
				$valueObj->setNumeroNfVeiculos($numeroNfVeiculos);
				$valueObj->setFornecedorNfVeiculos($fornecedorNfVeiculos);
				$valueObj->setDataNfVeiculos($dataNfVeiculos);
				$valueObj->setCidadeNfVeiculos($cidadeNfVeiculos);
				$valueObj->setEstadoNfVeiculos($estadoNfVeiculos);
				$valueObj->setDataEntregaNfVeiculos($dataEntregaNfVeiculos);
				$valueObj->setKmEntregaNfVeiculos($kmEntregaNfVeiculos);
				$valueObj->setProprietarioNfVeiculos($proprietarioNfVeiculos);
				$valueObj->setArrendatarioNfVeiculos($arrendatarioNfVeiculos);
				$valueObj->setContratanteNfveiculos($contratanteNfveiculos);
				$valueObj->setTempoGarantiaNfVeiculos($tempoGarantiaNfVeiculos);
				$valueObj->setKmGarantiaVeiculos($kmGarantiaVeiculos);
				$valueObj->setVencimentoSeguroVeiculos($vencimentoSeguroVeiculos);
				$valueObj->setVencimentoIpvaVeiculos($vencimentoIpvaVeiculos);
				$valueObj->setIdClientes($idClientes);
				$collVo[] = $valueObj;
			}
		}
		catch (Exception $e)
		{
			throw new Exception("Não foi possível listar a tabela veiculos. ".$e->getMessage());
		}
		$conecta = null;
		$valueObj = null;
		return $collVo;
	}
	
	/**
	 * Método de procura de Revisões
	 * @param Revisoes $revisoes
	 */
	public function findRevisoes(Revisoes $revisoes)
	{
		$collVo = null;
		$valueObj = null;
		$valueObj = new Revisoes();
		$conecta = new Connecta();
		
		$valueObj = $revisoes;
		
		$idRevisoes = null;
		$dataRevisoes = "";
		$kmRevisoes = "";
		$proxDataRevisoes = "";
		$proxKmRevisoes = "";
		$oleoKmRevisoes = "";
		$idVeiculos = null;
		$idTipoRevisoes = null;
		
		$where = '';
		
		$sql = "SELECT * FROM revisoes ";
		
		if(!is_null($valueObj->getIdRevisoes()) && !is_null($valueObj->getProxDataRevisoes()))
		{
			$data = explode("-",$valueObj->getProxDataRevisoes());
			if($data[0] == 0 && $data[2] == 0)
			{
				$where = "WHERE idRevisoes = ? AND proxDataRevisoes like '%-{$data[1]}-%'";
			}
			else
			{
				$where = "WHERE idRevisoes = ? AND proxDataRevisoes = ?";
			}
		}
		elseif(!is_null($valueObj->getIdRevisoes()))
		{
			$where = "WHERE idRevisoes = ?";
		}
		elseif(!is_null($valueObj->getProxDataRevisoes()))
		{
			$data = explode("-",$valueObj->getProxDataRevisoes());
			if($data[0] == 0 && $data[2] == 0)
			{
				$where = "WHERE proxDataRevisoes like '%-{$data[1]}-%'";
			}
			else
			{
				$where = "WHERE proxDataRevisoes = ?";
			}

		}
		elseif (!is_null($valueObj->getIdVeiculos()))
		{
			$where = "WHERE idVeiculos = ?";
		}
		
		try 
		{
			$sql .= $where;
			$prepare = mysqli_prepare($conecta,$sql);
			
			if(!is_null($valueObj->getIdRevisoes()) && !is_null($valueObj->getProxDataRevisoes()))
			{
				$data = explode("-",$valueObj->getProxDataRevisoes());
				if(!($data[0] == 0 && $data[2] == 0))
				{
					mysqli_stmt_bind_param($prepare,'is',$idRevisoes,$proxDataRevisoes);
				}
				else
				{
					mysqli_stmt_bind_param($prepare,'i',$idRevisoes);
				}
			}
			elseif(!is_null($valueObj->getIdRevisoes()))
			{
				mysqli_stmt_bind_param($prepare,'i',$idRevisoes);
			}
			elseif(!is_null($valueObj->getProxDataRevisoes()))
			{
				$data = explode("-",$valueObj->getProxDataRevisoes());
				if(!($data[0] == 0 && $data[2] == 0))
				{
					mysqli_stmt_bind_param($prepare,'s',$proxDataRevisoes);
				}
			}
			elseif (!is_null($valueObj->getIdVeiculos()))
			{
				mysqli_stmt_bind_param($prepare,'s',$idVeiculos);
			}
						
			$idRevisoes = $valueObj->getIdRevisoes();
			$proxDataRevisoes = $valueObj->getProxDataRevisoes();
			$idVeiculos = $valueObj->getIdVeiculos();
			
			if(!mysqli_stmt_execute($prepare))
				throw new Exception("Não foi possível conectar no banco de dados.");
			
			mysqli_stmt_bind_result($prepare,$idRevisoes,$dataRevisoes,$kmRevisoes,$proxDataRevisoes,
			$proxKmRevisoes,$oleoKmRevisoes,$idVeiculos,$idTipoRevisoes);
			while(mysqli_stmt_fetch($prepare))
			{
				$valueObj = new Revisoes();
				$valueObj->setIdRevisoes($idRevisoes);
				$valueObj->setDataRevisoes($dataRevisoes);
				$valueObj->setKmRevisoes($kmRevisoes);
				$valueObj->setProxDataRevisoes($proxDataRevisoes);
				$valueObj->setProxKmRevisoes($proxKmRevisoes);
				$valueObj->setOleoKmRevisoes($oleoKmRevisoes);
				$valueObj->setIdVeiculos($idVeiculos);
				$valueObj->setIdTipoRevisoes($idTipoRevisoes);
				$collVo[] = $valueObj;
			}
		}
		catch (Exception $e)
		{
			throw new Exception("Não foi possível listar a tabela Revisoes. ".$e->getMessage());
		}
		$conecta = null;
		$valueObj = null;
		return $collVo;
	}

	/**
	 * Método de procura de Endereco
	 * @param Endereco $endereco
	 */
	public function findEndereco(Endereco $endereco)
	{
		$collVo = null;
		$valueObj = null;
		$valueObj = new Endereco();
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
		$idPessoa = '';
		$idEmpresa = '';
		
		$where = '';
		
		$sql = "SELECT * FROM endereco ";
		
		if(!is_null($valueObj->getIdEndereco()) && !is_null($valueObj->getIdPessoa()))
		{
			$where = "WHERE idEndereco = ? AND idPessoa = ?";
		}
		elseif(!is_null($valueObj->getIdEndereco()) && is_null($valueObj->getIdPessoa()) && !is_null($valueObj->getIdEmpresa()))
		{
			$where = "WHERE idEndereco = ? AND idEmpresa = ?";
		}
		elseif(!is_null($valueObj->getIdPessoa()))
		{
			$where = "WHERE idPessoa = ?";
		}
		elseif(!is_null($valueObj->getIdEmpresa()))
		{
			$where = "WHERE idEmpresa = ?";
		}
		
		try 
		{
			$sql .= $where;
			$prepare = mysqli_prepare($conecta,$sql);
			
			if(!is_null($valueObj->getIdEndereco()) && !is_null($valueObj->getIdPessoa()))
			{
				mysqli_stmt_bind_param($prepare,'ii',$idEndereco,$idPessoa);
			}
			elseif(!is_null($valueObj->getIdEndereco()) && is_null($valueObj->getIdPessoa()) && !is_null($valueObj->getIdEmpresa()))
			{
				mysqli_stmt_bind_param($prepare,'ii',$idEndereco,$idEmpresa);
			}
			elseif(!is_null($valueObj->getIdPessoa()))
			{
				mysqli_stmt_bind_param($prepare,'i',$idPessoa);
			}
			elseif(!is_null($valueObj->getIdEmpresa()))
			{
				mysqli_stmt_bind_param($prepare,'i',$idEmpresa);
			}
						
			$idEndereco = $valueObj->getIdEndereco();
			$idPessoa = $valueObj->getIdPessoa();
			$idEmpresa = $valueObj->getIdEmpresa();
			
			if(!mysqli_stmt_execute($prepare))
				throw new Exception("Não foi possível conectar no banco de dados.");
			
			mysqli_stmt_bind_result($prepare,$idEndereco,$ruaEndereco,$complementoEndereco,
			$bairroEndereco,$cepEndereco,$estadoEndereco,$cidadeEndereco,$telefoneEndereco,
			$celEndereco,$faxEndereco,$emailEndereco,$idPessoa,$idEmpresa);
			while(mysqli_stmt_fetch($prepare))
			{
				$valueObj = new Endereco();
				$valueObj->setIdEndereco($idEndereco);
				$valueObj->setRuaEndereco($ruaEndereco);
				$valueObj->setComplementoEndereco($complementoEndereco);
				$valueObj->setBairroEndereco($bairroEndereco);
				$valueObj->setCepEndereco($cepEndereco);
				$valueObj->setEstadoEndereco($estadoEndereco);
				$valueObj->setCidadeEndereco($cidadeEndereco);
				$valueObj->setTelefoneEndereco($telefoneEndereco);
				$valueObj->setCelEndereco($celEndereco);
				$valueObj->setFaxEndereco($faxEndereco);
				$valueObj->setEmailEndereco($emailEndereco);
				$valueObj->setIdPessoa($idPessoa);
				$valueObj->setIdEmpresa($idEmpresa);
				$collVo[] = $valueObj;
			}
		}
		catch (Exception $e)
		{
			throw new Exception("Não foi possível listar a tabela Endereço. ".$e->getMessage());
		}
		$conecta = null;
		$valueObj = null;
		return $collVo;
	}
	
	/**
	 * Método de Procura de Tipo de Revisões
	 * @param Revisoes $revisoes
	 */
	public function findTipoRevisoes(Tiporevisoes  $tipoRevisoes)
	{
		$collVo = null;
		$valueObj = null;
		$valueObj = new Tiporevisoes();
		$conecta = new Connecta();
		
		$valueObj = $tipoRevisoes;
		
		$idTipoRevisoes = '';
		$descricaoTipoRevisoes = '';
		
		$where = '';
		
		$sql = "SELECT * FROM tiporevisoes ";
		
		if(!is_null($valueObj->getIdTipoRevisoes()))
		{
			$where = "WHERE idTipoRevisoes = ?";
		}
		
		try 
		{
			$sql .= $where;
			$prepare = mysqli_prepare($conecta,$sql);
			
			if(!is_null($valueObj->getIdTipoRevisoes()))
			{
				mysqli_stmt_bind_param($prepare,'i',$idTipoRevisoes);
			}
						
			$idTipoRevisoes = $valueObj->getIdTipoRevisoes();
			
			if(!mysqli_stmt_execute($prepare))
				throw new Exception("Não foi possível conectar no banco de dados.");
			
			mysqli_stmt_bind_result($prepare,$idTipoRevisoes,$descricaoTipoRevisoes);
			while(mysqli_stmt_fetch($prepare))
			{
				$valueObj = new Tiporevisoes();
				$valueObj->setIdTipoRevisoes($idTipoRevisoes);
				$valueObj->setDescricaoTipoRevisoes($descricaoTipoRevisoes);
				$collVo[] = $valueObj;
			}
		}
		catch (Exception $e)
		{
			throw new Exception("Não foi possível listar a tabela Tipo de Revisões. ".$e->getMessage());
		}
		$conecta = null;
		$valueObj = null;
		return $collVo;
	}

	/**
	 * Método de Procura/Listagem de Abastecimentos
	 * @param Abastecimentos $abastecimentos
	 */
	public function findAbastecimentos(Abastecimentos $abastecimentos)
	{
		$collVo = null;
		$valueObj = null;
		$valueObj = new Abastecimentos();
		$conecta = new Connecta();
		
		$valueObj = $abastecimentos;
		
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
		
		$where = '';
		
		$sql = "SELECT * FROM abastecimentos ";
		
		if(!is_null($valueObj->getIdAbastecimentos()))
		{
			$where = "WHERE idAbastecimentos = ?";
		}
		elseif(!is_null($valueObj->getIdVeiculos()))
		{
			$where = "WHERE idVeiculos = ?";
		}
		elseif(!is_null($valueObj->getIdPessoa()))
		{
			$where = "WHERE idPessoa = ?";
		}
		
		try 
		{
			$sql .= $where;
			$prepare = mysqli_prepare($conecta,$sql);
			
			if(!is_null($valueObj->getIdAbastecimentos()))
			{
				mysqli_stmt_bind_param($prepare,'i',$idAbastecimentos);
			}
			elseif(!is_null($valueObj->getIdVeiculos()))
			{
				mysqli_stmt_bind_param($prepare,'i',$idVeiculos);
			}
			elseif(!is_null($valueObj->getIdPessoa()))
			{
				mysqli_stmt_bind_param($prepare,'i',$idPessoa);
			}
						
			$idAbastecimentos = $valueObj->getIdAbastecimentos();
			$idVeiculos = $valueObj->getIdVeiculos();
			$idPessoa = $valueObj->getIdPessoa();
			
			if(!mysqli_stmt_execute($prepare))
				throw new Exception("Não foi possível conectar no banco de dados.");
			
			mysqli_stmt_bind_result($prepare,$idAbastecimentos,$dataAbastecimentos,
			$kmAbastecimentos,$postoAbastecimentos,$nfAbastecimentos,$tipoCombustivelAbastecimentos,
			$valorAbastecimentos,$litrosAbastecimentos,$idVeiculos,$idPessoa);
			while(mysqli_stmt_fetch($prepare))
			{
				$valueObj = new Abastecimentos();
				$valueObj->setIdAbastecimentos($idAbastecimentos);
				$valueObj->setDataAbastecimentos($dataAbastecimentos);
				$valueObj->setKmAbastecimentos($kmAbastecimentos);
				$valueObj->setPostoAbastecimentos($postoAbastecimentos);
				$valueObj->setNfAbastecimentos($nfAbastecimentos);
				$valueObj->setTipoCombustivelAbastecimentos($tipoCombustivelAbastecimentos);
				$valueObj->setValorAbastecimentos($valorAbastecimentos);
				$valueObj->setLitrosAbastecimentos($litrosAbastecimentos);
				$valueObj->setIdVeiculos($idVeiculos);
				$valueObj->setIdPessoa($idPessoa);
				$collVo[] = $valueObj;
			}
		}
		catch (Exception $e)
		{
			throw new Exception("Não foi possível listar a tabela Abastecimentos. ".$e->getMessage());
		}
		$conecta = null;
		$valueObj = null;
		return $collVo;
	}

	/**
	 * Método de Procura/Listagem de Aviso de Veículos
	 * @param Avisosveiculos $avisoVeiculos
	 */
	public function findAvisoVeiculos(Avisosveiculos $avisoVeiculos)
	{
		$collVo = null;
		$valueObj = null;
		$valueObj = new Avisosveiculos();
		$conecta = new Connecta();
		
		$valueObj = $avisoVeiculos;
		
		$idAvisosVeiculos = '';
		$dataAvisoVeiculos = '';
		$idVeiculos = '';
		
		$where = '';
		
		$sql = "SELECT * FROM avisosveiculos ";
		
		if(!is_null($valueObj->getIdAvisosVeiculos()))
		{
			$where = "WHERE idAvisosVeiculos = ?";
		}
		elseif(!is_null($valueObj->getIdVeiculos()))
		{
			$where = "WHERE idVeiculos = ?";
		}
		
		try 
		{
			$sql .= $where;
			$prepare = mysqli_prepare($conecta,$sql);
			
			if(!is_null($valueObj->getIdAvisosVeiculos()))
			{
				mysqli_stmt_bind_param($prepare,'i',$idAvisosVeiculos);
			}
			elseif(!is_null($valueObj->getIdVeiculos()))
			{
				mysqli_stmt_bind_param($prepare,'i',$idVeiculos);
			}
						
			$idAvisosVeiculos = $valueObj->getIdAvisosVeiculos();
			$idVeiculos = $valueObj->getIdVeiculos();
			
			if(!mysqli_stmt_execute($prepare))
				throw new Exception("Não foi possível conectar no banco de dados.");
			
			mysqli_stmt_bind_result($prepare,$idAvisosVeiculos,$dataAvisoVeiculos,
			$idVeiculos);
			while(mysqli_stmt_fetch($prepare))
			{
				$valueObj = new Avisosveiculos();
				$valueObj->setIdAvisosVeiculos($idAvisosVeiculos);
				$valueObj->setDataAvisoVeiculos($dataAvisoVeiculos);
				$valueObj->setIdVeiculos($idVeiculos);
				$collVo[] = $valueObj;
			}
		}
		catch (Exception $e)
		{
			throw new Exception("Não foi possível listar a tabela Aviso de Veiculos. ".$e->getMessage());
		}
		$conecta = null;
		$valueObj = null;
		return $collVo;
	}
	
}

?>