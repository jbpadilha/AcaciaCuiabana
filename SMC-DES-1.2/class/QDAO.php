<?php
/**
 * Classe Value Object para transfer�ncia entre as camadas.
 * @author Jo�o Batista Padilha e Silva
 * @link QDAO.php
 * @copyright Jo�o Batista Padilha e Silva Especialista em TI (http://www.joaopadilha.eti.br) / joao.padilha@globo.com
 * @version 1.0
 */
class QDAO 
{
	
	/**
	 * M�todo de Procurar logon
	 * @author Jo�o Padilha
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
				throw new Exception("N�o foi posss�vel conectar no banco de dados.");
			
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
			throw new Exception("N�o foi posss�vel listar a tabela logon. ".$e->getMessage());
		}
		$conecta = null;
		$valueObj = null;
		return $collVo;
	}

	/**
	 * M�todo de procura de Clientes
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
				throw new Exception("N�o foi posss�vel conectar no banco de dados.");
			
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
			throw new Exception("N�o foi posss�vel listar a tabela Clientes. ".$e->getMessage());
		}
		$conecta = null;
		$valueObj = null;
		return $collVo;
	}

	/**
	 * M�todo de procura de pessoas
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
			$where = "WHERE idCliente = ? AND nomePessoa like ?";
		}
		elseif(!is_null($valueObj->getIdCliente()))
		{
			$where = "WHERE idCliente = ?";
		}
		elseif(!is_null($valueObj->getCpfPessoa($cpfPessoa)))
		{
			$where = "WHERE cpfPessoa = ?";
		}
		elseif(is_null($valueObj->getIdCliente()) && !is_null($valueObj->getNomePessoa()))
		{
			$where = "WHERE nomePessoa like ?";
		}
		
		try 
		{
			$sql .= $where;
			$prepare = mysqli_prepare($conecta,$sql);
			
			if(!is_null($valueObj->getIdPessoa()))
			{
				mysqli_stmt_bind_param($prepare,'i',$idPessoa);
			}
			elseif(!is_null($valueObj->getIdCliente()) && !is_null($valueObj->getNomePessoa()))
			{
				mysqli_stmt_bind_param($prepare,'is',$idCliente,$nomePessoa);
			}
			elseif(!is_null($valueObj->getIdCliente()))
			{
				mysqli_stmt_bind_param($prepare,'i',$idCliente);
			}
			elseif(!is_null($valueObj->getCpfPessoa($cpfPessoa)))
			{
				mysqli_stmt_bind_param($prepare,'s',$valueObj->getCpfPessoa($cpfPessoa));
			}
			elseif(is_null($valueObj->getIdCliente()) && !is_null($valueObj->getNomePessoa()))
			{
				mysqli_stmt_bind_param($prepare,'s',$nomePessoa);
			}
						
			$idPessoa = $valueObj->getIdPessoa();
			$idCliente = $valueObj->getIdCliente();
			$cpfPessoa = $valueObj->getCpfPessoa();
			$nomePessoa = "%".$valueObj->getNomePessoa()."%";
			if(!mysqli_stmt_execute($prepare))
				throw new Exception("N�o foi posss�vel conectar no banco de dados.");
			
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
			throw new Exception("N�o foi posss�vel listar a tabela pessoa. ".$e->getMessage());
		}
		$conecta = null;
		$valueObj = null;
		return $collVo;
	}
	
	/**
	 * M�todo que retorna empresas
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
		elseif(!is_null($valueObj->getCnpjEmpresa()))
		{
			$where = "WHERE cnpjEmpresa = ?";
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
			elseif(!is_null($valueObj->getCnpjEmpresa()))
			{
				mysqli_stmt_bind_param($prepare,'s',$cnpjEmpresa);
			}
			
			$idEmpresa = $valueObj->getIdEmpresa();
			$idClientes = $valueObj->getIdClientes();
			$cnpjEmpresa = $valueObj->getCnpjEmpresa();
			
			if(!mysqli_stmt_execute($prepare))
				throw new Exception("N�o foi posss�vel conectar no banco de dados.");
			
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
			throw new Exception("N�o foi posss�vel listar a tabela empresas. ".$e->getMessage());
		}
		$conecta = null;
		$valueObj = null;
		return $collVo;
	}
	
	/**
	 * M�todo de busca de EmpresaCondutores
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
				throw new Exception("N�o foi posss�vel conectar no banco de dados.");
			
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
			throw new Exception("N�o foi posss�vel listar a tabela empresascondutores. ".$e->getMessage());
		}
		$conecta = null;
		$valueObj = null;
		return $collVo;
	}

	/**
	 * M�todo de procura de Condutores
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
				throw new Exception("N�o foi posss�vel conectar no banco de dados.");
			
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
			throw new Exception("N�o foi posss�vel listar a tabela condutores. ".$e->getMessage());
		}
		$conecta = null;
		$valueObj = null;
		return $collVo;
	}
	
	/**
	 * M�todo de procura de CNh
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
				throw new Exception("N�o foi posss�vel conectar no banco de dados.");
			
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
			throw new Exception("N�o foi posss�vel listar a tabela Cnh. ".$e->getMessage());
		}
		$conecta = null;
		$valueObj = null;
		return $collVo;
	}
	
	/**
	 * Lista de Ves�culos
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
		elseif(!is_null($valueObj->getPlacaVeiculos()))
		{
			$where = "WHERE placaVeiculos = ?";
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
			elseif(!is_null($valueObj->getPlacaVeiculos()))
			{
				mysqli_stmt_bind_param($prepare,'s',$placaVeiculos);
			}
			
			
			$idVeiculos = $valueObj->getIdVeiculos();
			$vencimentoIpvaVeiculos = $valueObj->getVencimentoIpvaVeiculos();
			$vencimentoSeguroVeiculos = $valueObj->getVencimentoSeguroVeiculos();
			$idClientes = $valueObj->getIdClientes();
			$placaVeiculos = $valueObj->getPlacaVeiculos();
			
			if(!mysqli_stmt_execute($prepare))
				throw new Exception("N�o foi posss�vel conectar no banco de dados.");
			
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
			throw new Exception("N�o foi posss�vel listar a tabela veiculos. ".$e->getMessage());
		}
		$conecta = null;
		$valueObj = null;
		return $collVo;
	}
	
	/**
	 * M�todo de procura de Revisões
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
				throw new Exception("N�o foi posss�vel conectar no banco de dados.");
			
			mysqli_stmt_bind_result($prepare,$idRevisoes,$dataRevisoes,$kmRevisoes,$proxDataRevisoes,
			$proxKmRevisoes,$idVeiculos,$idTipoRevisoes);
			while(mysqli_stmt_fetch($prepare))
			{
				$valueObj = new Revisoes();
				$valueObj->setIdRevisoes($idRevisoes);
				$valueObj->setDataRevisoes($dataRevisoes);
				$valueObj->setKmRevisoes($kmRevisoes);
				$valueObj->setProxDataRevisoes($proxDataRevisoes);
				$valueObj->setProxKmRevisoes($proxKmRevisoes);
				$valueObj->setIdVeiculos($idVeiculos);
				$valueObj->setIdTipoRevisoes($idTipoRevisoes);
				$collVo[] = $valueObj;
			}
		}
		catch (Exception $e)
		{
			throw new Exception("N�o foi posss�vel listar a tabela Revisoes. ".$e->getMessage());
		}
		$conecta = null;
		$valueObj = null;
		return $collVo;
	}

	/**
	 * M�todo de procura de Endereco
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
				throw new Exception("N�o foi posss�vel conectar no banco de dados.");
			
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
			throw new Exception("N�o foi posss�vel listar a tabela endere�o. ".$e->getMessage());
		}
		$conecta = null;
		$valueObj = null;
		return $collVo;
	}
	
	/**
	 * M�todo de Procura de Tipo de Revisões
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
				throw new Exception("N�o foi posss�vel conectar no banco de dados.");
			
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
			throw new Exception("N�o foi posss�vel listar a tabela Tipo de Revisões. ".$e->getMessage());
		}
		$conecta = null;
		$valueObj = null;
		return $collVo;
	}

	/**
	 * M�todo de Procura/Listagem de Abastecimentos
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
				throw new Exception("N�o foi posss�vel conectar no banco de dados.");
			
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
			throw new Exception("N�o foi posss�vel listar a tabela Abastecimentos. ".$e->getMessage());
		}
		$conecta = null;
		$valueObj = null;
		return $collVo;
	}

	/**
	 * M�todo de Procura/Listagem de Aviso de Ves�culos
	 * @param Avisosveiculos $avisoVeiculos
	 */
	public function findAvisos(Avisos $avisos)
	{
		$collVo = null;
		$valueObj = null;
		$valueObj = new Avisos();
		$conecta = new Connecta();
		
		$valueObj = $avisos;
		
		$idAvisos = '';
		$dataAvisos = '';
		$idClientes = '';
		$assuntoAvisos = '';
		
		$where = '';
		
		$sql = "SELECT * FROM avisos ";
		
		if(!is_null($valueObj->getIdAvisos()))
		{
			$where = "WHERE idAvisos = ?";
		}
		elseif(!is_null($valueObj->getIdClientes()) && !is_null($valueObj->getDataAvisos()))
		{
			$data = explode("-",$valueObj->getDataAvisos());
			$where = "WHERE idClientes = ? AND dataAvisos like '{$data[0]}-{$data[1]}-{$data[2]}%'";
		}
		elseif(!is_null($valueObj->getIdClientes()))
		{
			$where = "WHERE idClientes = ?";
		}
		
		
		try 
		{
			$sql .= $where;
			$prepare = mysqli_prepare($conecta,$sql);
			
			if(!is_null($valueObj->getIdAvisos()))
			{
				mysqli_stmt_bind_param($prepare,'i',$idAvisos);
			}
			elseif(!is_null($valueObj->getIdClientes()))
			{
				mysqli_stmt_bind_param($prepare,'i',$idClientes);
			}
						
			$idAvisos = $valueObj->getIdAvisos();
			$idClientes = $valueObj->getIdClientes();
			
			if(!mysqli_stmt_execute($prepare))
				throw new Exception("N�o foi posss�vel conectar no banco de dados.");
			
			mysqli_stmt_bind_result($prepare,$idAvisos,$dataAvisos,
			$idClientes, $assuntoAvisos);
			while(mysqli_stmt_fetch($prepare))
			{
				$valueObj = new Avisos();
				$valueObj->setIdAvisos($idAvisos);
				$valueObj->setDataAvisos($dataAvisos);
				$valueObj->setIdClientes($idClientes);
				$valueObj->setAssuntoAvisos($assuntoAvisos);
				$collVo[] = $valueObj;
			}
		}
		catch (Exception $e)
		{
			throw new Exception("N�o foi posss�vel listar a tabela Aviso. ".$e->getMessage());
		}
		$conecta = null;
		$valueObj = null;
		return $collVo;
	}
	
	/**
	 * M�todo de Procura / Listagem de Maquinas
	 * @param Maquinas $maquinas
	 * @return Maquinas
	 */
	public function findMaquinas(Maquinas $maquinas)
	{
		$collVo = null;
		$valueObj = null;
		$valueObj = new Maquinas();
		$conecta = new Connecta();
		
		$valueObj = $maquinas;
		
		$idMaquinas = '';
		$dataCadastro = '';
		$idCliente = '';
		$nomeMaquina = '';
		$numeroSerieMaquina = '';
		$fabricanteMaquinas = '';
		$origemMaquinas = '';
		$origemPaisMaquinas = '';
		$modeloMaquinas = '';
		$numeroChassiMaquinas = '';
		$anoFabricacaoMaquinas = '';
		$anoModeloMaquinas = '';
		$tracaoMaquinas = '';
		$corMaquinas = '';
		$tipoCombustivelMaquinas = '';
		$tanqueMaximoMaquinas = '';
		$codIdInternoMaquinas = '';
		$adicionaisMaquinas = '';
		$contadorMaquinas = '';
		$contadorVariacaoDiaMaquinas = '';
		$nfFornecedorMaquinas = '';
		$nfNumeroMaquinas = '';
		$nfDataCompraMaquinas = '';
		$nfValorCompraMaquinas = '';
		$dataEntregaMaquinas = '';
		$nfContadorEntregaMaquinas = '';
		$numeroImobilizadoMaquinas = '';
		$tempogarantiaMaquinas = '';
		$unidadeGarantiaTempoMaquinas = '';
		$dataFimGarantiaMaquinas = '';
		$garantiaContadorMaquinas = '';
		$unidadeGarantiaContadorMaquinas = '';
		$valorFinalGarantiaMaquinas = '';
		$possuiGarantiaExtendidaMaquinas = '';
		$tempoGarantia2Maquinas = '';
		$unidadeGarantiaTempo2Maquinas = '';
		$dataFimGarantia2Maquinas = '';
		$garantiaContador2Maquinas = '';
		$unidadeGarantiaContador2Maquinas = '';
		$valorFinalGarantia2Maquinas = '';
		$possuiContratoManutencaoMaquinas = '';
		$empresaContratoManutencaoMaquinas = '';
		$dataInicioContratoManutencaoMaquinas = '';
		$dataFimContratoManutencaoMaquinas = '';
		$infoContratoManutencaoMaquinas = '';
		$dataultimaLeituraMaquinas = '';
		$contadorUltimaLeituraMaquinas = '';
		$acompanhaTempoMaquinas = '';
		$unidadeAcompanhaTempoMaquinas = '';
		$acompanhaContadorMaquinas = '';
		$unidadeAcompanhaContadorMaquinas = '';
		
		$where = '';
		
		$sql = "SELECT * FROM dbmaquinas ";
		
		if(!is_null($valueObj->getIdMaquinas()))
		{
			$where = "WHERE id = ?";
		}		
		
		try 
		{
			$sql .= $where;
			$prepare = mysqli_prepare($conecta,$sql);
			
			if(!is_null($valueObj->getIdMaquinas()))
			{
				mysqli_stmt_bind_param($prepare,'i',$idMaquinas);
			}
						
			$idMaquinas = $valueObj->getIdMaquinas();
			
			if(!mysqli_stmt_execute($prepare))
				throw new Exception("N�o foi posss�vel conectar no banco de dados.");
			
			mysqli_stmt_bind_result($prepare,$idMaquinas, $dataCadastro, $idCliente,$nomeMaquina,
			$numeroSerieMaquina, $fabricanteMaquinas,$origemMaquinas, $origemPaisMaquinas,
			$modeloMaquinas, $numeroChassiMaquinas, $anoFabricacaoMaquinas, $anoModeloMaquinas,
			$tracaoMaquinas, $corMaquinas, $tipoCombustivelMaquinas, $tanqueMaximoMaquinas,
			$codIdInternoMaquinas, $adicionaisMaquinas, $contadorMaquinas, $contadorVariacaoDiaMaquinas,
			$nfFornecedorMaquinas, $nfNumeroMaquinas, $nfDataCompraMaquinas, $nfValorCompraMaquinas,
			$dataEntregaMaquinas, $nfContadorEntregaMaquinas, $numeroImobilizadoMaquinas,
			$tempogarantiaMaquinas, $unidadeGarantiaTempoMaquinas, $dataFimGarantiaMaquinas, 
			$garantiaContadorMaquinas, $unidadeGarantiaContadorMaquinas, $valorFinalGarantiaMaquinas,
			$possuiGarantiaExtendidaMaquinas, $tempoGarantia2Maquinas, $unidadeGarantiaTempo2Maquinas,
			$dataFimGarantia2Maquinas, $garantiaContador2Maquinas, $unidadeGarantiaContador2Maquinas,
			$valorFinalGarantia2Maquinas, $possuiContratoManutencaoMaquinas, 
			$empresaContratoManutencaoMaquinas, $dataInicioContratoManutencaoMaquinas, 
			$dataFimContratoManutencaoMaquinas, $infoContratoManutencaoMaquinas, 
			$dataultimaLeituraMaquinas, $contadorUltimaLeituraMaquinas, $acompanhaTempoMaquinas,
			$unidadeAcompanhaTempoMaquinas, $acompanhaContadorMaquinas,
			$unidadeAcompanhaContadorMaquinas);
			
			while(mysqli_stmt_fetch($prepare))
			{
				$valueObj = new Maquinas();
				$valueObj->setIdMaquinas($idMaquinas);
				$valueObj->setDataCadastro($dataCadastro);
				$valueObj->setIdCliente($idCliente);
				$valueObj->setNomeMaquina($nomeMaquina);
				$valueObj->setNumeroSerieMaquina($numeroSerieMaquina);
				$valueObj->setFabricanteMaquinas($fabricanteMaquinas);
				$valueObj->setOrigemMaquinas($origemMaquinas);
				$valueObj->setOrigemPaisMaquinas($origemPaisMaquinas);
				$valueObj->setModeloMaquinas($modeloMaquinas);
				$valueObj->setNumeroChassiMaquinas($numeroChassiMaquinas);
				$valueObj->setAnoFabricacaoMaquinas($anoFabricacaoMaquinas);
				$valueObj->setAnoModeloMaquinas($anoModeloMaquinas);
				$valueObj->setTracaoMaquinas($tracaoMaquinas);
				$valueObj->setCorMaquinas($corMaquinas);
				$valueObj->setTipoCombustivelMaquinas($tipoCombustivelMaquinas);
				$valueObj->setTanqueMaximoMaquinas($tanqueMaximoMaquinas);
				$valueObj->setCodIdInternoMaquinas($codIdInternoMaquinas);
				$valueObj->setAdicionaisMaquinas($adicionaisMaquinas);
				$valueObj->setContadorMaquinas($contadorMaquinas);
				$valueObj->setContadorVariacaoDiaMaquinas($contadorVariacaoDiaMaquinas);
				$valueObj->setNfFornecedorMaquinas($nfFornecedorMaquinas);
				$valueObj->setNfNumeroMaquinas($nfNumeroMaquinas);
				$valueObj->setNfDataCompraMaquinas($nfDataCompraMaquinas);
				$valueObj->setNfValorCompraMaquinas($nfValorCompraMaquinas);
				$valueObj->setDataEntregaMaquinas($dataEntregaMaquinas);
				$valueObj->setNfContadorEntregaMaquinas($nfContadorEntregaMaquinas);
				$valueObj->setNumeroImobilizadoMaquinas($numeroImobilizadoMaquinas);
				$valueObj->setTempogarantiaMaquinas($tempogarantiaMaquinas);
				$valueObj->setUnidadeGarantiaTempoMaquinas($unidadeGarantiaTempoMaquinas);
				$valueObj->setDataFimGarantiaMaquinas($dataFimGarantiaMaquinas);
				$valueObj->setGarantiaContadorMaquinas($garantiaContadorMaquinas);
				$valueObj->setUnidadeGarantiaContadorMaquinas($unidadeGarantiaContadorMaquinas);
				$valueObj->setValorFinalGarantiaMaquinas($valorFinalGarantiaMaquinas);
				$valueObj->setPossuiGarantiaExtendidaMaquinas($possuiGarantiaExtendidaMaquinas);
				$valueObj->setTempoGarantia2Maquinas($tempoGarantia2Maquinas);
				$valueObj->setUnidadeGarantiaTempo2Maquinas($unidadeGarantiaTempo2Maquinas);
				$valueObj->setDataFimGarantia2Maquinas($dataFimGarantia2Maquinas);
				$valueObj->setGarantiaContador2Maquinas($garantiaContador2Maquinas);
				$valueObj->setUnidadeGarantiaContador2Maquinas($unidadeGarantiaContador2Maquinas);
				$valueObj->setValorFinalGarantia2Maquinas($valorFinalGarantia2Maquinas);
				$valueObj->setPossuiContratoManutencaoMaquinas($possuiContratoManutencaoMaquinas);
				$valueObj->setEmpresaContratoManutencaoMaquinas($empresaContratoManutencaoMaquinas);
				$valueObj->setDataInicioContratoManutencaoMaquinas($dataInicioContratoManutencaoMaquinas);
				$valueObj->setDataFimContratoManutencaoMaquinas($dataFimContratoManutencaoMaquinas);
				$valueObj->setInfoContratoManutencaoMaquinas($infoContratoManutencaoMaquinas);
				$valueObj->setDataultimaLeituraMaquinas($dataultimaLeituraMaquinas);
				$valueObj->setContadorUltimaLeituraMaquinas($contadorUltimaLeituraMaquinas);
				$valueObj->setAcompanhaTempoMaquinas($acompanhaTempoMaquinas);
				$valueObj->setUnidadeAcompanhaTempoMaquinas($unidadeAcompanhaTempoMaquinas);
				$valueObj->setAcompanhaContadorMaquinas($acompanhaContadorMaquinas);
				$valueObj->setUnidadeAcompanhaContadorMaquinas($unidadeAcompanhaContadorMaquinas);
				$collVo[] = $valueObj;
			}
		}
		catch (Exception $e)
		{
			throw new Exception("N�o foi posss�vel listar a tabela dbMaquinas. ".$e->getMessage());
		}
		$conecta = null;
		$valueObj = null;
		return $collVo;
	}
	
	/**
	 * M�todo de Procura / Listagem de Equipamentos
	 * @param Maquinas $equipamentos
	 * @return Maquinas
	 */
	public function findEquipamentos(Equipamentos $equipamentos)
	{
		$collVo = null;
		$valueObj = null;
		$valueObj = new Equipamentos();
		$conecta = new Connecta();
		
		$valueObj = $equipamentos;
		
		$idequipamentos = '';
		$dataCadastro = '';
		$idCliente = '';
		$nome = '';
		$numeroSerie = '';
		$fabricante = '';
		$origem = '';
		$origemPais = '';
		$modelo = '';
		$numeroChassi = '';
		$anoFabricacao = '';
		$anoModelo = '';
		$cor = '';
		$coldIdInterno = '';
		$tipoAlimentacao = '';
		$tipoAlimentacaoAC = '';
		$tipoAlimentacaoDC = '';
		$alimentacaoOutros = '';
		$possuiAcessorios = '';
		$acessorios = '';
		$adicionais = '';
		$nfFornecedor = '';
		$nfNumero = '';
		$nfDataCompra = '';
		$nfValorCompra = '';
		$nfDataEntrega = '';
		$numeroImobilizado = '';
		$tempoGarantia = '';
		$unidadeGarantiaTempo = '';
		$dataFimGarantia = '';
		$possuiGarantiaExtendida = '';
		$tempoGarantia2 = '';
		$unidadeGarantiaTempo2 = '';
		$datafimGarantia2 = '';
		$possuiContratoManutencao = '';
		$empresaContratoManutencao = '';
		$dataInicioContratoManutencao = '';
		$dataFimContratoManutencao = '';
		$infoContratoManutencao = '';
		
		$where = '';
		
		$sql = "SELECT * FROM dbequipamentos ";
		
		if(!is_null($valueObj->getIdequipamentos()))
		{
			$where = "WHERE id = ?";
		}		
		
		try 
		{
			$sql .= $where;
			$prepare = mysqli_prepare($conecta,$sql);
			
			if(!is_null($valueObj->getIdequipamentos()))
			{
				mysqli_stmt_bind_param($prepare,'i',$idequipamentos);
			}
						
			$idequipamentos = $valueObj->getIdequipamentos();
			
			if(!mysqli_stmt_execute($prepare))
				throw new Exception("N�o foi posss�vel conectar no banco de dados.");
			
			mysqli_stmt_bind_result($prepare,$idequipamentos, $dataCadastro, $idCliente, $nome, $numeroSerie, 
			$fabricante, $origem, $origemPais, $modelo, $numeroChassi,
			$anoFabricacao, $anoModelo, $cor, $coldIdInterno, $tipoAlimentacao, $tipoAlimentacaoAC, $tipoAlimentacaoDC,
			$alimentacaoOutros, $possuiAcessorios, $acessorios, $adicionais, $nfFornecedor, $nfNumero, $nfDataCompra, 
			$nfValorCompra, $nfDataEntrega, $numeroImobilizado, $tempoGarantia, $unidadeGarantiaTempo, $dataFimGarantia,
			$possuiGarantiaExtendida, $tempoGarantia2, $unidadeGarantiaTempo2, $datafimGarantia2, $possuiContratoManutencao,
			$empresaContratoManutencao, $dataInicioContratoManutencao, $dataFimContratoManutencao, $infoContratoManutencao);
			
			while(mysqli_stmt_fetch($prepare))
			{
				$valueObj = new Equipamentos();
				$valueObj->setIdequipamentos($idequipamentos);
				$valueObj->setDataCadastro($dataCadastro);
				$valueObj->setIdCliente($idCliente);
				$valueObj->setNome($nome);
				$valueObj->setNumeroSerie($numeroSerie);
				$valueObj->setFabricante($fabricante);
				$valueObj->setOrigem($origem);
				$valueObj->setOrigemPais($origemPais);
				$valueObj->setModelo($modelo);
				$valueObj->setNumeroChassi($numeroChassi);
				$valueObj->setAnoFabricacao($anoFabricacao);
				$valueObj->setAnoModelo($anoModelo);
				$valueObj->setCor($cor);
				$valueObj->setColdIdInterno($coldIdInterno);
				$valueObj->setTipoAlimentacao($tipoAlimentacao);
				$valueObj->setTipoAlimentacaoAC($tipoAlimentacaoAC);
				$valueObj->setTipoAlimentacaoDC($tipoAlimentacaoDC);
				$valueObj->setAlimentacaoOutros($alimentacaoOutros);
				$valueObj->setPossuiAcessorios($possuiAcessorios);
				$valueObj->setAcessorios($acessorios);
				$valueObj->setAdicionais($adicionais);
				$valueObj->setNfFornecedor($nfFornecedor);
				$valueObj->setNfNumero($nfNumero);
				$valueObj->setNfDataCompra($nfDataCompra);
				$valueObj->setNfValorCompra($nfValorCompra);
				$valueObj->setNfDataEntrega($nfDataEntrega);
				$valueObj->setNumeroImobilizado($numeroImobilizado);
				$valueObj->setTempoGarantia($tempoGarantia);
				$valueObj->setUnidadeGarantiaTempo($unidadeGarantiaTempo);
				$valueObj->setDataFimGarantia($dataFimGarantia);
				$valueObj->setPossuiGarantiaExtendida($possuiGarantiaExtendida);
				$valueObj->setTempoGarantia2($tempoGarantia2);
				$valueObj->setUnidadeGarantiaTempo2($unidadeGarantiaTempo2);
				$valueObj->setDatafimGarantia2($datafimGarantia2);
				$valueObj->setPossuiContratoManutencao($possuiContratoManutencao);
				$valueObj->setEmpresaContratoManutencao($empresaContratoManutencao);
				$valueObj->setDataInicioContratoManutencao($dataInicioContratoManutencao);
				$valueObj->setDataFimContratoManutencao($dataFimContratoManutencao);
				$valueObj->setInfoContratoManutencao($infoContratoManutencao);
				$collVo[] = $valueObj;
			}
		}
		catch (Exception $e)
		{
			throw new Exception("N�o foi posss�vel listar a tabela dbEquipamentos. ".$e->getMessage());
		}
		$conecta = null;
		$valueObj = null;
		return $collVo;
	}
	
}

?>