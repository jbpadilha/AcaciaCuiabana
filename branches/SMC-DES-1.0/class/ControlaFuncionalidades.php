<?php
require_once ('FormataData.php');
require_once ('Dominio.php');

require_once ('Abastecimentos.php');
require_once ('Avisos.php');
require_once ('EmpresaCondutores.php');
require_once ('Empresas.php');
require_once ('Pessoa.php');
require_once ('Clientes.php');
require_once ('Cnh.php');
require_once ('Condutores.php');
require_once ('Endereco.php');
require_once ('Logon.php');
require_once ('Revisoes.php');
require_once ('Tiporevisoes.php');
require_once ('Veiculos.php');

require_once ('Connecta.php');
require_once ('QDAO.php');
require_once ('DAO.php');

/**
 * Classe Controladora das funcionalidades do Sistema
 * @author João Batista Padilha e Silva
 * @link Controla_Funcionalidades.php
 * @copyright João Batista Padilha e Silva Especialista em TI (http://www.joaopadilha.eti.br) / joao.padilha@globo.com
 * @version 1.0
 */
class ControlaFuncionalidades 
{
	private $collVo = null;
	private $valueObj = null;
	
	/**
	 * Método que destroi a sessão e encaminha para a pagina inicial
	 * @author João Batista Padilha e Silva
	 */
	public function destroiSessao()
	{
		session_start();
		session_destroy();
		header("Location:../views/index.php");
	}
	
	public function enviarEmail($nom,$mail,$assunto,$desc)
	{
		$dominio = new Dominio();
		
		$assunto_email = "Formulário de Contato";
	
		$msg  = "<b>{$assunto}</b><br>
		<b>E-mail:</b> $mail <br>
		{$desc}";
		
		$emailRetorno = "cadastro@servicodespertador.net";
		$headers = "Content-Type: text/html; charset=iso-8859-1\n";
		$headers .="From: SMC Serviço Despertador <$emailRetorno>";
		/*if (mail($mail,$assunto_email,$msg,$headers))
		{
			$assunto = "Enviado E-mail para Usuário pelo Serviço Despertador - SMC";
			mail($emailRetorno,$assunto_email,$msg,$headers);
			$msgResposta = "Mensagem enviada com sucesso.";
			return $msgResposta;
		}
		else
		{
			$msgResposta = "Ocorreu um erro no envio da mensagem.Talvez o E-mail informado esteja incorreto.";
			throw new Exception($msgResposta);
		}*/
	}
	
	/**
	 * Método que testa o e-mail verificando se o e-mail é válido.
	 * @author João Batista Padilha e Silva
	 * @param var $email 
	 */
	public function testaEmail($email = '')
	{
		if($email != '')
		{
			if (!preg_match ("/^[A-Za-z0-9]+([_.-][A-Za-z0-9]+)*@[A-Za-z0-9]+([_.-][A-Za-z0-9]+)*\\.[A-Za-z0-9]{2,4}$/", $email))
			{
		        throw new Exception("O Email é inválido.");
		    }
		}
		return $email;
	}
	
	/**
	 * Método que retira caracteres que possam prejudicar ao gravar no banco de dados
	 * @param unknown_type $html
	 */
	public function corrigeHTML($html)
	{
		$novohtml = str_replace('\"','',$html);
		$novohtml = html_entity_decode($novohtml);
		$novohtml  =  preg_replace ("/\\\\([^'])/e", '"&#" . ord("$1") . ";"', $novohtml); 
   		// delete the backslashes inserted for protecting single quotes 
   		$novohtml  =  str_replace ("\\'", "&#" . ord ("'") . ";", $novohtml); 
		return $novohtml;
	}	
	
	function validaCPF($cpf)
	{	// Verifiva se o número digitado contém todos os digitos
	    $cpf = str_pad(ereg_replace('[^0-9]', '', $cpf), 11, '0', STR_PAD_LEFT);
		
		// Verifica se nenhuma das sequências abaixo foi digitada, caso seja, retorna falso
	    if (strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999')
		{
		return false;
	    }
		else
		{   // Calcula os números para verificar se o CPF é verdadeiro
	        for ($t = 9; $t < 11; $t++) {
	            for ($d = 0, $c = 0; $c < $t; $c++) {
	                $d += $cpf{$c} * (($t + 1) - $c);
	            }
	
	            $d = ((10 * $d) % 11) % 10;
	
	            if ($cpf{$c} != $d) {
	                return false;
	            }
	        }
	
	        return true;
	    }
	}
	
	/**
	 * Método que retira a mascara do CPF
	 * @param string $cpf
	 */
	public function retiraMascaraCPF($cpf)
	{
		$novoCpf = str_ireplace(".","",$cpf);
		$novoCpf = str_ireplace("-","",$novoCpf);
		return trim($novoCpf);
	}

	/**
	 * Método que retira a mascara do CNPJ
	 * @param string $cnpj
	 */
	public function retiraMascaraCNPJ($cnpj)
	{
		$novoCnpj = str_ireplace(".","",$cnpj);
		$novoCnpj = str_ireplace("/","",$novoCnpj);
		$novoCnpj = str_ireplace("-","",$novoCnpj);
		return trim($novoCnpj);
	}
	
	/**
	 * Método de listagem de Usuários
	 * @author João Batista Padilha e Silva
	 * @param Logon $logon
	 * @return array $this->collVo
	 */
	public function findLogon(Logon $logon)
	{
		$qdao = new QDAO();
		try 
		{
			$this->collVo = $qdao->findLogon($logon);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
		return $this->collVo;
	}
	
	/**
	 * Método de busca de Clientes
	 * @param Clientes $clientes
	 */
	public function findClientes(Clientes $clientes)
	{
		$qdao = new QDAO();
		try
		{
			$this->collVo = $qdao->findClientes($clientes);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
		return $this->collVo;
	}
	
	/**
	 * Método de busca de pessoas
	 * @param Pessoa $pessoa
	 */
	public function findPessoas(Pessoa $pessoa)
	{
		$qdao = new QDAO();
		try
		{
			$this->collVo = $qdao->findPessoa($pessoa);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
		return $this->collVo;
	}
	
	/**
	 * Método que retorna empresa
	 * @param Empresas $empresas
	 */
	public function findEmpresas(Empresas $empresas)
	{
		$qdao = new QDAO();
		try
		{
			$this->collVo = $qdao->findEmpresas($empresas);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
		return $this->collVo;
	}

	/**
	 * Método de busca de Empresas Condutores
	 * @param EmpresaCondutores $empresaCondutores
	 */
	public function findEmpresasCond(EmpresaCondutores $empresaCondutores)
	{
		$qdao = new QDAO();
		try
		{
			$this->collVo = $qdao->findEmpresasCondutores($empresaCondutores);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
		return $this->collVo;
	}
	
	/**
	 * Lista de condutores
	 * @param Condutores $condutores
	 */
	public function findCondutores(Condutores $condutores)
	{
		$qdao = new QDAO();
		try
		{
			$this->collVo = $qdao->findCondutores($condutores);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
		return $this->collVo;
	}
	
	/**
	 * Lista Cnh
	 * @param Cnh $cnh
	 */
	public function findCnh(Cnh $cnh)
	{
		$qdao = new QDAO();
		try
		{
			$this->collVo = $qdao->findCnh($cnh);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
		return $this->collVo;
	}
	
	/**
	 * Lista de Veículos
	 * @param Veiculos $veiculos
	 */
	public function findVeiculos(Veiculos $veiculos)
	{
		$qdao = new QDAO();
		try
		{
			$this->collVo = $qdao->findVeiculos($veiculos);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
		return $this->collVo;
	}
	
	/**
	 * Método que lista Revisoes
	 * @param $revisoes
	 */
	public function findRevisoes(Revisoes $revisoes)
	{
		$qdao = new QDAO();
		try
		{
			$this->collVo = $qdao->findRevisoes($revisoes);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
		return $this->collVo;
	}
	
	/**
	 * Método que lista endereços
	 * @param Endereco $endereco
	 */
	public function findEndereco(Endereco $endereco)
	{
		$qdao = new QDAO();
		try
		{
			$this->collVo = $qdao->findEndereco($endereco);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
		return $this->collVo;
	}
	
	/**
	 * Método de procura de Revisões
	 * @param Tiporevisoes $tipoRevisoes
	 */
	public function findTipoRevisoes(Tiporevisoes $tipoRevisoes)
	{
		$qdao = new QDAO();
		try
		{
			$this->collVo = $qdao->findTipoRevisoes($tipoRevisoes);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
		return $this->collVo;
	}
	
	/**
	 * Método de Procura/Listagem de Abastecimentos
	 * @param Abastecimentos $abastecimentos
	 */
	public function findAbastecimentos(Abastecimentos $abastecimentos)
	{
		$qdao = new QDAO();
		try
		{
			$this->collVo = $qdao->findAbastecimentos($abastecimentos);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
		return $this->collVo;
	}
	
	/**
	 * Método de Procura/Listagem de Avisos de Veículos
	 * @param Avisos $avisosVeiculos
	 */
	public function findAvisos(Avisos $avisos)
	{
		$qdao = new QDAO();
		try
		{
			$this->collVo = $qdao->findAvisos($avisos);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
		return $this->collVo;
	}

	
	/**
	 * Método de soma de datas
	 * @param DateTime $dataInicio
	 * @param DateTime $dataFinal
	 */
	public function somarData(DateTime $dataInicio, DateTime $dataFinal) {
		$newData = date('Y-m-d', mktime(0, 0, 0, $dataInicio->format("m") + $dataFinal->format("m"), $dataInicio->format("d") + $dataFinal->format("d"), $dataInicio->format("Y") + $dataFinal->format("Y")));
		return $newData;
	}
	
	/**
	 * Método de listagem de aniversários de clientes 
	 * @param Logon $usuario Logado , DateTime  $data
	 * @author João Padilha
	 */
	public function listarAniversariosClientes(Logon $logon, $data)
	{
		$qdao = new QDAO();
		$data = explode("-",$data);
		if(!is_null($logon))
		{
			$collVoPessoas = new ArrayObject();
			// Verificar Aniversários de Clientes - Caso Seja Administrador trazer todos.
			if($logon->getIdClientes() != null)
			{
				$cliente = new Clientes();
				$cliente->setIdClientes($logon->getIdClientes());
				$collVoCli = $this->findClientes($cliente);
				$cliente = $collVoCli[0];
				
				$pessoasCliente = new Pessoa();
				$pessoasCliente->setIdCliente($cliente->getIdClientes());
				$pessoasCliente->setDataNascimentoPessoa($data[0]."-".$data[1]."-".$data[2]);
				$collVoPessoasCli = $this->findPessoas($pessoasCliente);
				if(!is_null($collVoPessoasCli))
				{
					foreach ($collVoPessoasCli as $pessoas)
					{
						$collVoPessoas->append($pessoas);
					}	
				}
			}
			elseif($logon->getNivelAcessoLogin() == 5)
			{
				$pessoa = new Pessoa();
				$pessoa->setDataNascimentoPessoa($data[0]."-".$data[1]."-".$data[2]);
				$collVoP =  $this->findPessoas($pessoa);
				if(!is_null($collVoP))
				{
					foreach ($collVoP as $pessoas)
					{
						$collVoPessoas->append($pessoas);
					}
				}
			}
			return $collVoPessoas;
		}
		else
		{
			throw new Exception("Não existe usuário logado.");
		}
	}
	
	/**
	 * Listagem de Cnh`s Vencidas
	 */
	public function listaCnhVencida(Logon $logon, $data)
	{
		$qdao = new QDAO();
		$data = explode("-",$data);
		if(!is_null($logon))
		{
			$collVoCnh = new ArrayObject();
			// Verificar CNH de Clientes Vencidos - Caso Seja Administrador trazer todos.
			if($logon->getIdClientes() != null)
			{				
				$cliente = new Clientes();
				$cliente->setIdClientes($logon->getIdClientes());
				$collVoCli = $this->findClientes($cliente);
				$cliente = new Clientes();
				$cliente = $collVoCli[0];
				
				$pessoaPesquisa = new Pessoa();
				$pessoaPesquisa->setIdCliente($cliente->getIdClientes());
				$collVoPessoasCli = $this->findPessoas($pessoaPesquisa);
				if(!is_null($collVoPessoasCli))
				{
					foreach($collVoPessoasCli as $pessoaAtual)
					{
						$pessoaPesquisa = $pessoaAtual;
						$condutorCli = new Condutores();
						$condutorCli->setIdPessoa($pessoaPesquisa->getIdPessoa());
						$collVoCondutores = $this->findCondutores($condutorCli);
						if(!is_null($collVoCondutores))
						{
							foreach ($collVoCondutores as $condutorAtual)
							{
								$condutorCli = $condutorAtual;
								$cnh = new Cnh();
								$cnh->setIdCnh($condutorCli->getIdCnh());
								$cnh->setVencCnh($data[0]."-".$data[1]."-".$data[2]);
								$collCnh = $this->findCnh($cnh);
								if(!is_null($collCnh))
								{
									foreach ($collCnh as $cnhAtual)
									{
										$collVoCnh->append($cnhAtual);
									}
								}
							}
						}
					}
				}
			}
			elseif($logon->getNivelAcessoLogin() == 5)
			{
				$cnh = new Cnh();
				$cnh->setVencCnh($data[0]."-".$data[1]."-".$data[2]);
				$collVo = $this->findCnh($cnh);
				if(!is_null($collVo))
				{
					foreach ($collVo as $cnhs)
					{
						$collVoCnh->append($cnhs);
					}
				} 
			}
			return $collVoCnh;
		}
		else
		{
			throw new Exception("Não existe usuário logado.");
		}
	}
	
	/**
	 * Método que lista os IPVA vencidos
	 * @param Logon $logon
	 * @param DateTime $data
	 */
	public function listaIpvaVencidos(Logon $logon, $data)
	{
		$qdao = new QDAO();
		$data = explode("-",$data);
		if(!is_null($logon))
		{
			// Verificar IPVA de Veiculos de Clientes Vencidos - Caso Seja Administrador trazer todos.
			$collVoVei = new ArrayObject();
			if($logon->getIdClientes() != null)
			{
				$veiculos = new Veiculos();
				$veiculos->setIdClientes($logon->getIdClientes());
				$veiculos->setVencimentoIpvaVeiculos($data[0]."-".$data[1]."-".$data[2]);
				$coll = $this->findVeiculos($veiculos);
				if(!is_null($coll))
				{
					foreach ($coll as $veiculo)
					{
						$collVoVei->append($veiculo);	
					}
				}
			}
			elseif($logon->getNivelAcessoLogin() == 5)
			{
				$veiculos = new Veiculos();
				$veiculos->setVencimentoIpvaVeiculos($data[0]."-".$data[1]."-".$data[2]);
				$coll = $this->findVeiculos($veiculos);
				if(!is_null($coll))
				{
					foreach ($coll as $veiculo)
					{
						$collVoVei->append($veiculo);
					}
				}
			}
			return $collVoVei;
		}
		else
		{
			throw new Exception("Não existe usuário logado.");
		}
	}
	
	/**
	 * Método que lista os seguros vencidos dos veículos
	 * @param Logon $logon
	 * @param DateTime $data
	 */
	public function listaSeguroVencidos(Logon $logon, $data)
	{
		$qdao = new QDAO();
		$data = explode("-",$data);
		if(!is_null($logon))
		{
			// Verificar Seguro de carro Vencidos dos clientes - Caso Seja Administrador trazer todos.
			$collVoSeguros = new ArrayObject();
			if($logon->getIdClientes() != null)
			{
				$veiculos = new Veiculos();
				$veiculos->setIdClientes($logon->getIdClientes());
				$veiculos->setVencimentoSeguroVeiculos($data[0]."-".$data[1]."-".$data[2]);
				$coll = $this->findVeiculos($veiculos);
				if(!is_null($coll))
				{
					foreach ($coll as $veiculo)
					{
						$collVoSeguros->append($veiculo);
					}
				}
			}
			elseif($logon->getNivelAcessoLogin() == 5)
			{
				$veiculos = new Veiculos();
				$veiculos->setVencimentoSeguroVeiculos($data[0]."-".$data[1]."-".$data[2]);
				$coll = $this->findVeiculos($veiculos);
				if(!is_null($coll))
				{
					foreach ($coll as $veiculo)
					{
						$collVoSeguros->append($veiculo);
					}
				}
			}
			return $collVoSeguros;
		}
		else
		{
			throw new Exception("Não existe usuário logado.");
		}
	}
	
	/**
	 * Método para listar garantias de veiculos vencido
	 * @param Logon $logon
	 * @param DateTime $data
	 */
	public function listaGarantiasVenc(Logon $logon, $data)
	{
		$qdao = new QDAO();
		$formataData = new FormataData();
		if(!is_null($logon))
		{
			// Verificar Garantias Vencida dos veículos dos clientes - Caso Seja Administrador trazer todos.
			$collVoGarantias = new ArrayObject();
			if($logon->getIdClientes() != null)
			{
				$veiculos = new Veiculos();
				$veiculos->setIdClientes($logon->getIdClientes());
				$collVoVeiculos = $this->findVeiculos($veiculos);
				if(!is_null($collVoVeiculos))
				{
					foreach ($collVoVeiculos as $arrayVeiculos)
					{
						$veiculos = $arrayVeiculos;
						if(!is_null($veiculos->getTempoGarantiaNfVeiculos()) && !is_null($veiculos->getDataNfVeiculos()))
						{
							$tempoGarantia = new DateTime();
							$tempoGarantia->setDate(0,$veiculos->getTempoGarantiaNfVeiculos(),0);
							$dataNfVeiulos = new DateTime();
							$dataQuebra = explode("-",$veiculos->getDataNfVeiculos());
							$dataNfVeiulos->setDate($dataQuebra[0],$dataQuebra[1],$dataQuebra[2]);
							$data_fim_garantia = $this->somarData($dataNfVeiulos,$tempoGarantia);
							$data = $data[0]."-".$data[1]."-".$data[2];
							if($data==$data_fim_garantia)
							{
								$collVoGarantias->append($veiculos);
							}
						}
					}
				}
				
			}
			elseif($logon->getNivelAcessoLogin() == 5)
			{
				$veiculos = new Veiculos();
				$collVoVeiculos = $this->findVeiculos($veiculos);
				if(!is_null($collVoVeiculos))
				{
					foreach ($collVoVeiculos as $arrayVeiculos)
					{
						$veiculos = new Veiculos();
						$veiculos = $arrayVeiculos;
						$data_fim_garantia = new DateTime();
						$tempoGarantia = new DateTime();
						$tempoGarantia->setDate(0,$veiculos->getTempoGarantiaNfVeiculos(),0);
						
						$dataNfVeiculo = new DateTime();
						if($veiculos->getDataNfVeiculos()!=null)
						{
							$dataNf = explode("-",$veiculos->getDataNfVeiculos());			
							$dataNfVeiculo->setDate($dataNf[0],$dataNf[1],$dataNf[2]); 
							
							$data_fim_garantia = $this->somarData($dataNfVeiculo,$tempoGarantia);
							$data = $data[0]."-".$data[1]."-".$data[2];
							if($data==$data_fim_garantia)
							{
								$collVoGarantias->append($veiculos);
							}
						}
					}
				}
			}
			return $collVoGarantias;
		}
		else
		{
			throw new Exception("Não existe usuário logado.");
		}
	}

	/**
	 * Método que lista todas as revisoes por data
	 * @param $logon
	 * @param $data
	 */
	public function listaRevisoes(Logon $logon, $data)
	{
		$qdao = new QDAO();
		$data = explode("-",$data);
		if(!is_null($logon))
		{
			// Verificar Revisoes dos veículos dos clientes - Caso Seja Administrador trazer todos.
			$collVoRevisoes = new ArrayObject();
			if($logon->getIdClientes() != null)
			{
				$veiculos = new Veiculos();
				$veiculos->setIdClientes($logon->getIdClientes());
				$collVoVeiculos = $this->findVeiculos($veiculos);
				if(!is_null($collVoVeiculos))
				{
					foreach ($collVoVeiculos as $arrayVeiculos)
					{
						//$veiculos = $arrayVeiculos;
						$revisoes = new Revisoes();
						$revisoes->setIdVeiculos($veiculos->getIdVeiculos());
						$revisoes->setProxDataRevisoes($data[0]."-".$data[1]."-".$data[2]);
						$collvoAtual = $this->findRevisoes($revisoes);
						if(!is_null($collvoAtual))
						{
							$collVoRevisoes->append($collvoAtual[0]);
						}
					}
				}
				
			}
			elseif($logon->getNivelAcessoLogin() == 5)
			{
				$revisoes = new Revisoes();
				$revisoes->setProxDataRevisoes($data[0]."-".$data[1]."-".$data[2]);
				$coll = $this->findRevisoes($revisoes);
				if(!is_null($coll))
				{
					foreach ($coll as $revisao)
					{
						$collVoRevisoes->append($revisao);
					}
				}
				
			}
			return $collVoRevisoes;
		}
		else
		{
			throw new Exception("Não existe usuário logado.");
		}
	}
	
	// FUNCIONALIDADE CADASTRO e UPDADE
	
	/**
	 * Método de UPDATE de usuário
	 * @param Logon $logon
	 */
	public function updateLogon(Logon $logon)
	{
		$dao = new DAO();
		try 
		{
			$this->collVo = $dao->updateLogon($logon);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	
	/**
	 * Método de atualização de Pessoa
	 * @param Pessoa $pessoa
	 */
	public function updatePessoa(Pessoa $pessoa)
	{
		$dao = new DAO();
		try 
		{
			$this->collVo = $dao->updatePessoa($pessoa);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	
	/**
	 * Método de Atualização de Endereco
	 * @param Endereco $endereco
	 */
	public function updateEndereco(Endereco $endereco)
	{
		$dao = new DAO();
		try 
		{
			$this->collVo = $dao->updateEndereco($endereco);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	
	/**
	 * Método de Atualização de Empresas
	 * @param $empresas
	 */
	public function updateEmpresa(Empresas $empresas)
	{
		$dao = new DAO();
		try 
		{
			$this->collVo = $dao->updateEmpresa($empresas);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	
	/**
	 * Método de Atualização de Clientes
	 * @param Clientes $clientes
	 */
	public function updateClientes(Clientes $clientes)
	{
		$dao = new DAO();
		try 
		{
			$this->collVo = $dao->updateClientes($clientes);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	
	/**
	 * Método de Update Veículos
	 * @param $veiculos
	 */
	public function updateVeiculos(Veiculos $veiculos)
	{
		$dao = new DAO();
		try 
		{
			$dao->updateVeiculos($veiculos);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	
	/**
	 * Método de atualização de condutores
	 * @param Condutores $condutores
	 */
	public function updateCondutores(Condutores $condutores)
	{
		$dao = new DAO();
		try 
		{
			$dao->updateCondutor($condutores);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}

	/**
	 * Método de Atualização de Revisoes
	 * @param Revisoes $revisoes
	 */
	public function updateRevisoes(Revisoes $revisoes)
	{
		$dao = new DAO();
		try 
		{
			$dao->updateRevisoes($revisoes);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	
	/**
	 * Método de Atualização de Revisões
	 * @param Tiporevisoes $tipoRevisoes
	 */
	public function updateTipoRevisoes(Tiporevisoes $tipoRevisoes)
	{
		$dao = new DAO();
		try 
		{
			$dao->updateTipoRevisoes($tipoRevisoes);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	
	/**
	 * Método de Atualização de Abastecimentos
	 * @param Abastecimentos $abastecimentos
	 */
	public function updateAbastecimentos(Abastecimentos $abastecimentos)
	{
		$dao = new DAO();
		try 
		{
			$dao->updateAbastecimentos($abastecimentos);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	
	/**
	 * Método de Atualização de Aviso de Veículos
	 * @param Avisos $avisosVeiculos
	 */
	public function updateAvisos(Avisos $avisos)
	{
		$dao = new DAO();
		try 
		{
			$dao->updateAvisos($avisos);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	
	/**
	 * Método de atualização de Cnh
	 * @param Cnh $cnh
	 */
	public function updateCnh(Cnh $cnh)
	{
		$dao = new DAO();
		try 
		{
			$dao->updateCnh($cnh);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	
	/**
	 * Método de cadastramento de Logon
	 * @param Logon $logon
	 */
	public function cadastraLogon(Logon $logon)
	{
		$dao = new DAO();
		try 
		{
			$dao->cadastrarLogon($logon);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	
	/**
	 * Método de cadastramento de pessoa
	 * @param Pessoa $pessoa
	 */
	public function cadastraPessoa(Pessoa $pessoa)
	{
		$dao = new DAO();
		try 
		{
			return $dao->cadastrarPessoa($pessoa);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}

	/**
	 * Método de cadastramento de endereço
	 * @param Endereco $endereco
	 */
	public function cadastraEndereco(Endereco $endereco)
	{
		$dao = new DAO();
		try 
		{
			$dao->cadastrarEndereco($endereco);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	
	/**
	 * Método de cadastramento de Empresas
	 * @param Empresas $empresas
	 */
	public function cadastraEmpresa(Empresas $empresas)
	{
		$dao = new DAO();
		try 
		{
			return $dao->cadastrarEmpresa($empresas);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}	
	}

	/**
	 * Método de cadastrar clientes
	 * @param Clientes $clientes
	 */
	public function cadastraClientes(Clientes $clientes)
	{
		$dao = new DAO();
		try 
		{
			return $dao->cadastrarClientes($clientes);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}

	/**
	 * Método de Cadastrar Veículos
	 * @param $veiculos
	 */
	public function cadastraVeiculos(Veiculos $veiculos)
	{
		$dao = new DAO();
		try 
		{
			return $dao->cadastrarVeiculos($veiculos);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}

	/**
	 * Método de cadastramento de Cnh
	 * @param Cnh $cnh
	 */
	public function cadastrarCnh(Cnh $cnh)
	{
		$dao = new DAO();
		try 
		{
			return $dao->cadastrarCnh($cnh);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}

	/**
	 * Método de cadastramento de condutores
	 * @param Condutores $condutores
	 */
	public function cadastrarCondutores(Condutores $condutores)
	{
		$dao = new DAO();
		try 
		{
			$dao->cadastrarCondutor($condutores);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}

	/**
	 * Método de Cadastrar Revisões
	 * @param Revisoes $revisoes
	 */
	public function cadastrarRevisoes(Revisoes $revisoes)
	{
		$dao = new DAO();
		try 
		{
			$dao->cadastrarRevisoes($revisoes);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}

	/**
	 * Método de Cadastramento de Tipo de Revisões
	 * @param Tiporevisoes $tipoRevisoes
	 */
	public function cadastrarTipoRevisoes(Tiporevisoes $tipoRevisoes)
	{
		$dao = new DAO();
		try 
		{
			$dao->cadastrarTipoRevisoes($tipoRevisoes);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	
	/**
	 * Método de Cadastramento de Abastecimentos
	 * @param Abastecimentos $abastecimentos
	 */
	public function cadastrarAbastecimentos(Abastecimentos $abastecimentos)
	{
		$dao = new DAO();
		try 
		{
			$dao->cadastrarAbastecimentos($abastecimentos);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}

	/**
	 * Método de Cadastramento de Avisos de Veículos
	 * @param $avisosVeiculos
	 */
	public function cadastrarAvisos(Avisos $avisos)
	{
		$dao = new DAO();
		try 
		{
			$dao->cadastrarAvisos($avisos);
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}

	public function pesquisaVencimentosDisparaEmail()
	{
		$data = date("Y-m-d");
		
		$clientes = new Clientes();
		$collClientes = $this->findClientes($clientes);
		if(!is_null($collClientes))
		{
			foreach ($collClientes as $clienteAtual)
			{
				$clientes = $clienteAtual;
				
				$avisos = new Avisos();
				$avisos->setIdClientes($clientes->getIdClientes());
				$avisos->setDataAvisos(date("Y-m-d"));
				$collVoAvisos = $this->findAvisos($avisos);
				if(!is_null($collVoAvisos) && count($collVoAvisos)>0)
				{
					continue;
				}
				
				$pessoaAtual = new Pessoa();
				$empresas = new Empresas();
				$endereco = new Endereco();
				$email = '';
				$nome = '';
				if(!is_null($clientes->getIdPessoa()))
				{
					$pessoaAtual->setIdPessoa($clientes->getIdPessoa());
					$collPessoa = $this->findPessoas($pessoaAtual);
					$pessoaAtual = $collPessoa[0];
					$endereco->setIdPessoa($pessoaAtual->getIdPessoa());
					$collEnd = $this->findEndereco($endereco);
					if(!is_null($collEnd))
					{
						$endereco =  $collEnd[0];
						$email = $endereco->getEmailEndereco();
					} 
					$nome = $pessoaAtual->getNomePessoa();
				}
				elseif(!is_null($clientes->getIdPessoa()))
				{
					$empresas->setIdEmpresa($clientes->getIdEmpresa());
					$collEmpresa = $this->findEmpresas($empresas);
					$empresas = $collEmpresa[0];
					$endereco->setIdEmpresa($empresas->getIdEmpresa());
					$collEnd = $this->findEndereco($endereco);
					if(!is_null($collEnd))
					{
						$endereco =  $collEnd[0];
						$email = $endereco->getEmailEndereco();
					}
					$nome = $empresas->getNomeEmpresa();
				}
				
				$collVoPessoa = $this->listarAniversariosClientes($clientes,$data);
				$collVoCnh = $this->listaCnhVencida($clientes,$data);
				$collVoIpva = $this->listaIpvaVencidos($clientes,$data);
				$collVoSeguro = $this->listaSeguroVencidos($clientes,$data);
				$collVoGarantias = $this->ListaGarantiasVenc($clientes,$data);
				$collVoRevisoes = $this->listaRevisoes($clientes,$data);
				
				if(!is_null($collVoPessoa) || !is_null($collVoCnh) || !is_null($collVoIpva) || 
				!is_null($collVoSeguro) || !is_null($collVoGarantias) || !is_null($collVoRevisoes))
				{
					$descricao = "";
					
					if(!is_null($collVoPessoa))
					{
						$cont = 0;
						foreach ($collVoPessoa as $pessoas)
						{
							if($cont == 0)
								echo '<label class="ativo">Aniversário do Dia</label><br><br>';
							$pessoaAtual = new Logon();
							$pessoaAtual = $pessoas;
							echo '<label class="ativo" title="'.$formataData->toViewDate($pessoaAtual->getDataNascimentoPessoa()).'">Aniversário de '.$pessoaAtual->getNomePessoa().'</label><br>';
							$cont++;
						}
						echo '<br><br>';
						$this->enviarEmail($nome,$email,"SMC - Serviço Despertador - Aviso de Aniversário",$descricao);
						$avisosGrava = new Avisos();
						$avisosGrava->setAssuntoAvisos("SMC - Serviço Despertador - Aviso de Aniversário");
						$avisosGrava->setDataAvisos(date("Y-m-d"));
						$avisosGrava->setIdClientes($clientes->getIdClientes());
						
					}
					
					if(!is_null($collVoCnh))
					{
						$cont = 0;
						foreach ($collVoCnh as $cnhs)
						{
							if($cont == 0)
								$descricao .= '<label class="ativo">CNH vencendo Hoje</label><br><br>';
							$cnhAtual = new Cnh();
							$cnhAtual = $cnhs;
							$pessoaAtual = new Pessoa();
							$pessoaAtual = $cnhAtual->returnaPessoa();
							$descricao .= '<label class="ativo" title="">CNH numero '.$cnhAtual->getNumeroCnh().', <b>nome:</b> '.$pessoaAtual->getNomePessoa().'</label><br>';
							$cont++;
						}
						$descricao .= '<br><br>';
						$this->enviarEmail($nome,$email,"SMC - Serviço Despertador - Aviso de Vencimento de CNH",$descricao);
						$avisosGrava = new Avisos();
						$avisosGrava->setAssuntoAvisos("SMC - Serviço Despertador - Aviso de Vencimento de CNH");
						$avisosGrava->setDataAvisos(date("Y-m-d"));
						$avisosGrava->setIdClientes($clientes->getIdClientes());
					}
					if(!is_null($collVoIpva))
					{
						$cont = 0;
						foreach ($collVoIpva as $ipvas)
						{
							if($cont == 0)
								$descricao .= '<label class="ativo">IPVA vencendo Hoje</label><br>';
							$veiculoAtual = new Veiculos(); 
							$veiculoAtual = $ipvas;
							$descricao .= '<label class="ativo" title="">'.$veiculoAtual->getPlacaVeiculos().' - IPVA vencendo</label><br>';
							$cont++;
						}
						$descricao .= '<br><br>';
						$this->enviarEmail($nome,$email,"SMC - Serviço Despertador - Aviso de Vencimento de IPVa",$descricao);
						$avisosGrava = new Avisos();
						$avisosGrava->setAssuntoAvisos("SMC - Serviço Despertador - Aviso de Vencimento de IPVA");
						$avisosGrava->setDataAvisos(date("Y-m-d"));
						$avisosGrava->setIdClientes($clientes->getIdClientes());
					}
					if(!is_null($collVoSeguro))
					{
						$cont = 0;
						foreach ($collVoSeguro as $seguros)
						{
							if($cont == 0)
								$descricao .= '<label class="ativo">Seguro do Carro vencendo Hoje</label><br>';
							$veiculoAtual = new Veiculos(); 
							$veiculoAtual = $seguros;
							$descricao .= '<label class="ativo" title="">'.$veiculoAtual->getPlacaVeiculos().' - Seguro vencendo</label><br>';
							$cont++;
						}
						$descricao .= '<br><br>';
						$this->enviarEmail($nome,$email,"SMC - Serviço Despertador - Aviso de Vencimento de Seguro",$descricao);
						$avisosGrava = new Avisos();
						$avisosGrava->setAssuntoAvisos("SMC - Serviço Despertador - Aviso de Vencimento de Seguro");
						$avisosGrava->setDataAvisos(date("Y-m-d"));
						$avisosGrava->setIdClientes($clientes->getIdClientes());
					}
					if(!is_null($collVoGarantias))
					{
						$cont = 0;
						foreach ($collVoGarantias as $garantias)
						{
							if($cont == 0)
								$descricao .= '<label class="ativo">Garantia vencendo hoje</label><br>';
							$veiculoAtual = new Veiculos(); 
							$veiculoAtual = $garantias;
							$descricao .= '<label class="ativo" title="">'.$veiculoAtual->getPlacaVeiculos().' - Garantia vencendo</label><br>';
							$cont++;
						}
						$descricao .= '<br><br>';
						$this->enviarEmail($nome,$email,"SMC - Serviço Despertador - Aviso de Vencimento de Garantia",$descricao);
						$avisosGrava = new Avisos();
						$avisosGrava->setAssuntoAvisos("SMC - Serviço Despertador - Aviso de Vencimento de Garantia");
						$avisosGrava->setDataAvisos(date("Y-m-d"));
						$avisosGrava->setIdClientes($clientes->getIdClientes());
					}
					if(!is_null($collVoRevisoes))
					{
						$cont = 0;
						foreach ($collVoRevisoes as $revisoes)
						{
							if($cont == 0)
								$descricao .= '<label class="ativo">Revisão agendanda</label><br>';
							$revisoesAtual = new Revisoes();
							$revisoesAtual = $revisoes;
							$veiculoAtual = new Veiculos();
							$veiculoAtual->setIdVeiculos($revisoesAtual->getIdVeiculos());
							$collVeiculos = $controla->findVeiculos($veiculoAtual);
							$veiculoAtual = $collVeiculos[0]; 
							$descricao .= '<label class="ativo" title="">'.$veiculoAtual->getPlacaVeiculos().' - Revisão agendada</label><br>';
							$cont++;
						}
						$descricao .= '<br><br>';
						$this->enviarEmail($nome,$email,"SMC - Serviço Despertador - Aviso de Revisão agendada",$descricao);
						$avisosGrava = new Avisos();
						$avisosGrava->setAssuntoAvisos("SMC - Serviço Despertador - Aviso de Revisão agendada");
						$avisosGrava->setDataAvisos(date("Y-m-d"));
						$avisosGrava->setIdClientes($clientes->getIdClientes());
					}			
				}
			}
		}
	}
}


if(isset($_POST))


//POST e GET
if(isset($_POST))
{
	header("Content-Type: text/html; charset=ISO-8859-1");
	$msg = "";
	$controla = new ControlaFuncionalidades();
	$formataData = new FormataData();
	
	if(isset($_POST['loginAdm']))
	{
		date_default_timezone_set('America/Cuiaba');
		
		if($_POST['login'] == "" || $_POST['senha'] == "")
		{
			$mensagem = "Todos os campos devem ser peenchido.";
			header("Location: ../views/home.php?p=login&msg=$mensagem");
		}
		
		if($_POST['login'] != '' && $_POST['senha'] != '')
		{			
			$controla = new ControlaFuncionalidades();
			$logon = new Logon();
			$logon->setLogin($controla->retiraMascaraCPF($_POST['login']));
			$logon->setSenha($_POST['senha']);
			try 
			{
				session_cache_limiter(5);
				$logon_aux = new Logon();
				$collVo_Login = $controla->findLogon($logon);
				if(count($collVo_Login) == 1)
				{
					$logon_aux = new Logon();
					$logon_aux = $collVo_Login[0];
					$_SESSION["usuarioLogon"] = $logon_aux;
					$logon_aux->setDataUltimoLogin(date("Y-m-d H:i:s"));
					$controla->updateLogon($logon_aux);
					if($logon_aux->getNivelAcessoLogin() > 0)
					{
						header("Location:../views/painel/index.php?p=home");
					}
					else
					{
						header("Location:../views/painel/aguarde.php");
					}
				}
				else 
				{
					throw new Exception("Usuário e senha incorretos.");
				}
			}
			catch (Exception $e)
			{
				$mensagem = $e->getMessage();
				header("Location: ../views/home.php?p=login&msg=$mensagem");
			}
		}
		else 
		{
			$mensagem = "Senha Incorreta ou Usuário Inválido.";
			header("Location: ../views/login.php?msg=$mensagem");
		}
	}
	
	
	//Recebimento de Cadastros
	if(isset($_POST['acao']))
	{
	if($_POST['acao'] == "cadastroLogin")
		{
			$mensagem = '';
			$pessoa = new Pessoa();
			$endereco = new Endereco();
			$logon = new Logon();

			try
			{
				if($_POST['lnome'] != '')
					$pessoa->setNomePessoa(trim($_POST['lnome']));
				else
					$mensagem .= "O nome não pode estar em branco.";
				
				if($_POST['lemail'] != '')
					$endereco->setEmailEndereco($controla->testaEmail($_POST['lemail']));
				else
					$mensagem .= "O E-mail não pode estar em branco.";
					
				if($_POST['llogin'] != '')
				{
					$pessoa->setCpfPessoa($controla->retiraMascaraCPF($_POST['llogin']));
					$logon->setLogin($controla->retiraMascaraCPF($_POST['llogin']));
				}
				else
				{
					$mensagem .= "O CPF não pode estar em branco.";
				}
				
				$logon->setSenha(trim($_POST['lsenha']));
				
				if($mensagem == '')
				{
					$idPessoa = $controla->cadastraPessoa($pessoa);
					
					$endereco->setIdPessoa($idPessoa);
					$controla->cadastraEndereco($endereco);
					
					$logon->setIdPessoa($idPessoa);
					$logon->setNivelAcessoLogin(0);
					$controla->cadastraLogon($logon);
					
					$descricao = "
					<div align='left' style='font-family: Verdana;'>
					<fieldset><legend style='text-transform:capitalize;'>{$pessoa->getNomePessoa()}</legend>
					CPF (Login): {$logon->getLogin()};<br>
					Senha: {$logon->getSenha()};<br>
					Email para contato: {$endereco->getEmailEndereco()};<br>
					<br>
					</fieldset>
					<br><br>
					Este é um e-mail automático. Não responda.
					</div>
					";
					
					$controla->enviarEmail($pessoa->getNomePessoa(),$endereco->getEmailEndereco(),"Cadastro de novo Usuário",$descricao);
					$mensagem = "Cadastro realizado com sucesso. Um e-mail foi enviado para o e-mail cadastrado.";
					header("Location: ../views/home.php?msg={$mensagem}");
					
				}
				else
				{
					header("Location: ../views/home.php?p=login&msg=$mensagem&pessoa=".urlencode(serialize($pessoa))."&endereco=".urlencode(serialize($endereco))."&logon=".urlencode(serialize($logon))."");
				}
			}
			catch (Exception $e)
			{
				$mensagem .= $e;
				header("Location: ../views/home.php?p=login&msg=$mensagem&pessoa=".urlencode(serialize($pessoa))."&endereco=".urlencode(serialize($endereco))."&logon=".urlencode(serialize($logon))."");
			}
			
		}		
		
		if($_POST['acao'] == "cadastraMeuCpf")
		{
			$mensagem = '';
			try
			{
				$pessoa = new Pessoa();
				$endereco = new Endereco();
				$pessoaConjugue = new Pessoa();
				
				
				$pessoa->setIdPessoa($_POST['idPessoa']);
				
				if($_POST['nome_cliente'] != '')
					$pessoa->setNomePessoa($_POST['nome_cliente']);
				else
					$mensagem .= 'O nome do Cliente não pode estar em branco.';

				$pessoa->setDataNascimentoPessoa($formataData->toDBDate($_POST['nascimento_cliente']));
				$pessoa->setSexoPessoa($_POST['sexo_cliente']);
				$pessoa->setEstadoCivilPessoa($_POST['ecivil_cliente']);
				$pessoa->setComplementoPessoa($_POST['nota']);
				$pessoa->setRgPessoa($_POST['rg_cliente']);
				$pessoa->setOrgExpPessoa($_POST['orgexprg_cliente']);
				$pessoa->setUfOrgExpPessoa($_POST['ufexprg_cliente']);
				
				if($_POST['cpf_cliente'] != '')
					$pessoa->setCpfPessoa($_POST['cpf_cliente']);
				else
					$mensagem .= 'O CPF do Cliente não pode estar em branco.';
				
				
				//ENDERECO
				$endereco->setIdEndereco($_POST['idEndereco']);
				$endereco->setRuaEndereco($_POST['rua_contato']);
				$endereco->setComplementoEndereco($_POST['complemento_contato']);
				$endereco->setBairroEndereco($_POST['bairro_contato']);
				$endereco->setCepEndereco($_POST['cep_contato']);
				$endereco->setCidadeEndereco($_POST['cidade_contato']);
				$endereco->setEstadoEndereco($_POST['estado_contato']);
				$endereco->setEmailEndereco($_POST['email_contato']);
				$endereco->setTelefoneEndereco($_POST['tel_contato']);
				$endereco->setCelEndereco($_POST['cel_contato']);
				$endereco->setFaxEndereco($_POST['cel_contato']);
				$endereco->setIdPessoa($pessoa->getIdPessoa());
				
				//Conjugue
				if($pessoa->getEstadoCivilPessoa() == "Casado" || $pessoa->getEstadoCivilPessoa() == "União Estável")
				{
					$pessoaConjugue->setIdPessoa($_POST['idConjugue']);
					$pessoaConjugue->setNomePessoa($_POST['nome_conjuge']);
					$pessoaConjugue->setDataNascimentoPessoa($formataData->toDBDate($_POST['nasc_conjuge']));
					$pessoaConjugue->setSexoPessoa($_POST['sexo_conjuge']);
				}
				
				if($mensagem == '')
				{
					$clientes = new Clientes();
					$clientes->setDataRegistroClientes(date("Y-m-d H:i:s"));
					$clientes->setStatusClientes(1);
					$clientes->setIdPessoa($pessoa->getIdPessoa());
					$idCliente = $controla->cadastraClientes($clientes);
					
					$pessoa->setIdCliente($idCliente);
					$controla->updatePessoa($pessoa);
					$controla->updateEndereco($endereco);
					if($pessoa->getEstadoCivilPessoa() == "Casado" || $pessoa->getEstadoCivilPessoa() == "União Estável")
					{
						$controla->updatePessoa($pessoaConjugue);
					}
					
					$logon = new Logon();
					$logon = $_SESSION['usuarioLogon'];
					$logon->setIdClientes($idCliente);
					$controla->updateLogon($logon);
					
					$mensagem="Usuário Criado com sucesso.";
					
					$descricao = "
					<div align='left' style='font-size:12px;'>
					Seu cadastro no site SMC - Serviço Despertador foi concluído com sucesso.<br>
					Por precaução, salve este e-mail.<br><br>
					<h3>Atenção: seu <font color='red'>CPF</font> é seu login de acesso para o painel de controle para gerenciamento de cadastro.<br>
					Em breve você receberá um e-mail com a senha de acesso.<h3><br>
					<font face=\"Verdana\">
					Estes são os dados principais do seu cadastro:<br><br>
					<fieldset><legend style='text-transform:capitalize;'>".$pessoa->getNomePessoa()."</legend>
					RG: ".$pessoa->getRgPessoa().";<br>
					CPF: ".$pessoa->getCpfPessoa().";<br>
					Telefone para contato: ".$endereco->getTelefoneEndereco().";<br>
					Celular para contato: ".$endereco->getCelEndereco().";<br>
					Fax para contato: ".$endereco->getFaxEndereco().";<br>
					Email para contato: ".$endereco->getEmailEndereco().";<br>
					<br>
					Registrado em: ".$formataData->toViewDateTime($clientes->getDataRegistroClientes()).";<br>
					</fieldset>
					<br>
					Este é um e-mail automático.
					</div>
					";
					
					$controla->enviarEmail($pessoa->getNomePessoa(),$endereco->getEmailEndereco(),"Usuario/Cliente Cadastrado",$descricao);
					
					header("Location: ../views/home.php?msg=$mensagem");
				}
				else
				{
					header("Location: ../views/painel/add_meucpf.php?msg=$mensagem&pessoa=".urlencode(serialize($pessoa))."&endereco=".urlencode(serialize($endereco))."&pessoaConjugue=".urlencode(serialize($pessoaConjugue))."");
				}
				
					
			}
			catch (Exception $e)
			{
				$mensagem .= $e;
				header("Location: ../views/painel/add_meucpf.php?msg=$mensagem&pessoa=".urlencode(serialize($pessoa))."&endereco=".urlencode(serialize($endereco))."&pessoaConjugue=".urlencode(serialize($pessoaConjugue))."");
			}
		}
		
		if($_POST['acao'] == "cadastroPessoa")
		{
			try 
			{
				$mensagem = '';
				//CADASTRO DE PESSOA
				$pessoaAtual = new Pessoa();
				
				$pessoaAtual->setIdCliente($_POST['idCliente']);
				
				if($_POST['nome'] != '')
					$pessoaAtual->setNomePessoa(trim($_POST['nome']));
				else 
					$mensagem .= "O Nome da Pessoa não pode estar em branco.";
				
				if($_POST['dataNascimento'] != '')
					$pessoaAtual->setDataNascimentoPessoa($formataData->toDBDate($_POST['dataNascimento']));
				else
					$mensagem .= "A data de nascimento da pessoa deve ser preenchida.";
				
				$pessoaAtual->setSexoPessoa($_POST['sexo']);
				$pessoaAtual->setEstadoCivilPessoa($_POST['estadoCivil']);
				
				if($_POST['rg'] != '')
				{
					$pessoaAtual->setRgPessoa(trim($_POST['rg']));
					$pessoaAtual->setOrgExpPessoa(trim($_POST['rg_orgao']));
					$pessoaAtual->setUfOrgExpPessoa($_POST['rg_uf']);
				}
				else
				{
					$mensagem .= "O RG da pessoa não deve estar em branco.";
				}
				
				if($_POST['cpf'] != '')
					$pessoaAtual->setCpfPessoa($controla->retiraMascaraCPF($_POST['cpf']));
				else
					$mensagem .= "O CPF não deve estar em branco.";
				
				//CADASTRO DE ENDERECO PARA PESSOA
				
				$endereco = new Endereco();
				
				$endereco->setRuaEndereco(trim($_POST['rua']));
				$endereco->setComplementoEndereco(trim($_POST['complemento']));
				$endereco->setBairroEndereco(trim($_POST['bairro']));
				$endereco->setCepEndereco(trim($_POST['cep']));
				$endereco->setCidadeEndereco(trim($_POST['cidade']));
				$endereco->setEstadoEndereco($_POST['estado']);
				
				if($controla->testaEmail($_POST['email']))
					$endereco->setEmailEndereco(trim($_POST['email']));
				
				$endereco->setTelefoneEndereco(trim($_POST['telefone']));
				$endereco->setCelEndereco(trim($_POST['celular']));
				$endereco->setFaxEndereco(trim($_POST['fax']));
				
				
				//Cadastro do Conjugue
				
				$pessoaConjugue = new Pessoa();
				if($pessoaAtual->getEstadoCivilPessoa() == "Casado" || $pessoaAtual->getEstadoCivilPessoa() == "União Estável" )
				{
					
					if($_POST['nomeConjugue'] != '')
						$pessoaConjugue->setNomePessoa(trim($_POST['nomeConjugue']));
					else 
						$mensagem .= "O Nome do Conjugue não pode estar em branco.";
					
					if($_POST['dataNascimentoConjugue'] != '')
						$pessoaConjugue->setDataNascimentoPessoa($formataData->toDBDate($_POST['dataNascimentoConjugue']));
					else
						$mensagem .= "A data de nascimento do Conjugue deve ser preenchida.";
					
					$pessoaConjugue->setSexoPessoa($_POST['sexoConjugue']);
					$pessoaConjugue->setEstadoCivilPessoa($_POST['estadoCivil']);
					
					if($_POST['rgConjugue'] != '')
					{
						$pessoaConjugue->setRgPessoa(trim($_POST['rgConjugue']));
						$pessoaConjugue->setOrgExpPessoa(trim($_POST['rg_orgaoConjugue']));
						$pessoaConjugue->setUfOrgExpPessoa($_POST['rg_ufConjugue']);
					}
					else
					{
						$mensagem .= "O RG do Conjugue não deve estar em branco.";
					}
					
					if($_POST['cpfConjugue'] != '')
						$pessoaConjugue->setCpfPessoa($controla->retiraMascaraCPF($_POST['cpfConjugue']));
					else
						$mensagem .= "O CPF do Conjugue não deve estar em branco.";
				}
				
				//TESTE DE ERRO e UPDATE DE CADASTRO
				
				if($mensagem == '')
				{
					//Atualização de Endereço
					$idPessoa = $controla->cadastraPessoa($pessoaAtual);
					$endereco->setIdPessoa($idPessoa);
					$controla->cadastraEndereco($endereco);
					
					//Cadastrando Conjugue
					if($pessoaAtual->getEstadoCivilPessoa() == "Casado" || $pessoaAtual->getEstadoCivilPessoa() == "União Estável" )
					{
						$idConjugue = $controla->cadastraPessoa($pessoaConjugue);
						$endereco->setIdPessoa($idConjugue);
						$pessoaAtual->setIdConjuguePessoa($idConjugue);	
						$controla->cadastraEndereco($endereco);
					}
					
					
					
					$descricao = "
					<b>DADOS DA PESSOA</b>
					{$pessoaAtual->mostraDadosPessoa()}<br>
					<br>
					<b>ENDEREÇO</b>
					{$endereco->mostraDadosEndereco()}<br>
					<br>";
					if($pessoaAtual->getEstadoCivilPessoa() == "Casado" || $pessoaAtual->getEstadoCivilPessoa() == "União Estável" )
					{
						$descricao = "
						<b>DADOS DO CONJUGUE</b>
						";
					}
					
					$controla->enviarEmail($pessoaAtual->getNomePessoa(),$endereco->getEmailEndereco(),"Cadastro de Pessoa",$descricao);
					$mensagem = "Cadastro realizado com sucesso. Um e-mail foi enviado para o e-mail cadastrado.";
					header("Location: ../views/painel/index.php?p=home&msg=$mensagem");
				}
				else
				{
					header("Location: ../views/painel/index.php?p=add_cpf&msg=$mensagem&pessoa=".urlencode(serialize($pessoaAtual))."&endereco=".urlencode(serialize($endereco))."&pessoaConjugue=".urlencode(serialize($pessoaConjugue))."");
				}
			}
			catch (Exception $e)
			{
				$mensagem .= $e;
				header("Location: ../views/painel/index.php?p=add_cpf&msg=$mensagem&pessoa=".urlencode(serialize($pessoaAtual))."&endereco=".urlencode(serialize($endereco))."&pessoaConjugue=".urlencode(serialize($pessoaConjugue))."");
			}
		}
		
		if($_POST['acao'] == "cadastroEmpresa")
		{
			try
			{
				$mensagem = '';
				$empresas = new Empresas();
				
				$cliente = new Clientes();
				$cliente->setIdClientes($_POST['idCliente']);
				$collVoCliente = $controla->findClientes($cliente);
				$cliente = $collVoCliente[0];
				
				$empresas->setNomeEmpresa($_POST['nome_empresa']);
				$empresas->setNomeFantasiaEmpresa($_POST['nome_fantasia']);
				$empresas->setDataFundacaoEmpresa($formataData->toDBDate($_POST['data_fundacao']));
				$empresas->setIdClientes($cliente->getIdClientes());

				if($_POST['cnpj'] != '')
					$empresas->setCnpjEmpresa($_POST['cnpj']);
				else
					$mensagem = "O CNPJ não pode estar em branco";
				
				$empresas->setInscricaoEstadualEmpresa($_POST['insc']);
				$empresas->setRamoEmpresa($_POST['ramo']);
				$empresas->setOrigemEmpresa($_POST['origem']);
				
				//DADOS DO ENDEREÇO DA EMRPESA
				$endereco = new Endereco();
				
				$endereco->setRuaEndereco(trim($_POST['rua']));
				$endereco->setComplementoEndereco(trim($_POST['complemento']));
				$endereco->setBairroEndereco(trim($_POST['bairro']));
				$endereco->setCepEndereco(trim($_POST['cep']));
				$endereco->setCidadeEndereco(trim($_POST['cidade']));
				$endereco->setEstadoEndereco($_POST['estado']);
				
				if($controla->testaEmail($_POST['email']))
					$endereco->setEmailEndereco(trim($_POST['email']));
				
				$endereco->setTelefoneEndereco(trim($_POST['telefone']));
				$endereco->setCelEndereco(trim($_POST['celular']));
				$endereco->setFaxEndereco(trim($_POST['fax']));
				

				//DADOS DO DIRETOR DA EMPRESA
				
				$pessoaDiretor = null;
				
				if($_POST['preenche'] == "Sim")
				{
					$pessoaDiretor = new Pessoa();
					if($_POST['nome'] != '')
						$pessoaDiretor->setNomePessoa(trim($_POST['nome']));
					else 
						$mensagem .= "O Nome da Pessoa não pode estar em branco.";
					
					if($_POST['dataNascimento'] != '')
						$pessoaDiretor->setDataNascimentoPessoa($formataData->toDBDate($_POST['dataNascimento']));
					else
						$mensagem .= "A data de nascimento da pessoa deve ser preenchida.";
					
					$pessoaDiretor->setSexoPessoa($_POST['sexo']);
					$pessoaDiretor->setEstadoCivilPessoa($_POST['estadoCivil']);
					
					if($_POST['rg'] != '')
					{
						$pessoaDiretor->setRgPessoa(trim($_POST['rg']));
						$pessoaDiretor->setOrgExpPessoa(trim($_POST['rg_orgao']));
						$pessoaDiretor->setUfOrgExpPessoa($_POST['rg_uf']);
					}
					else
					{
						$mensagem .= "O RG da pessoa não deve estar em branco.";
					}
					
					if($_POST['cpf'] != '')
						$pessoaDiretor->setCpfPessoa($controla->retiraMascaraCPF($_POST['cpf']));
					else
						$mensagem .= "O CPF não deve estar em branco.";
					
					//ENDEREÇO DIRETOR DA EMPRESA
					$enderecoDiretor = new Endereco();
					$enderecoDiretor->setRuaEndereco(trim($_POST['ruaDiretor']));
					$enderecoDiretor->setComplementoEndereco(trim($_POST['complementoDiretor']));
					$enderecoDiretor->setBairroEndereco(trim($_POST['bairroDiretor']));
					$enderecoDiretor->setCepEndereco(trim($_POST['cepDiretor']));
					$enderecoDiretor->setCidadeEndereco(trim($_POST['cidadeDiretor']));
					$enderecoDiretor->setEstadoEndereco($_POST['estadoDiretor']);
					
					if($controla->testaEmail($_POST['email']))
						$enderecoDiretor->setEmailEndereco(trim($_POST['emailDiretor']));
					
					$enderecoDiretor->setTelefoneEndereco(trim($_POST['telefoneDiretor']));
					$enderecoDiretor->setCelEndereco(trim($_POST['celularDiretor']));
					$enderecoDiretor->setFaxEndereco(trim($_POST['faxDiretor']));
					
					
					//DADOS CONJUGUE DIRETOR
					$pessoaConjugue = new Pessoa();
					if($pessoaDiretor->getEstadoCivilPessoa() == "Casado" || $pessoaDiretor->getEstadoCivilPessoa() == "União Estável" )
					{
						if($_POST['nomeConjugue'] != '')
							$pessoaConjugue->setNomePessoa(trim($_POST['nomeConjugue']));
						else 
							$mensagem .= "O Nome do Conjugue não pode estar em branco.";
						
						if($_POST['dataNascimentoConjugue'] != '')
							$pessoaConjugue->setDataNascimentoPessoa($formataData->toDBDate($_POST['dataNascimentoConjugue']));
						else
							$mensagem .= "A data de nascimento do Conjugue deve ser preenchida.";
						
						$pessoaConjugue->setSexoPessoa($_POST['sexoConjugue']);
						$pessoaConjugue->setEstadoCivilPessoa($_POST['estadoCivil']);
						
						if($_POST['rgConjugue'] != '')
						{
							$pessoaConjugue->setRgPessoa(trim($_POST['rgConjugue']));
							$pessoaConjugue->setOrgExpPessoa(trim($_POST['rg_orgaoConjugue']));
							$pessoaConjugue->setUfOrgExpPessoa($_POST['rg_ufConjugue']);
						}
						else
						{
							$mensagem .= "O RG do Conjugue não deve estar em branco.";
						}
						
						if($_POST['cpfConjugue'] != '')
							$pessoaConjugue->setCpfPessoa($controla->retiraMascaraCPF($_POST['cpfConjugue']));
						else
							$mensagem .= "O CPF do Conjugue não deve estar em branco.";
					}
				}
				
				//TESTE E CADASTRO
				if($mensagem == '')
				{
					if(!is_null($pessoaDiretor))
					{
						//Cadastrando Conjugue
						$idPessoaConjugue = null;
						if($pessoaDiretor->getEstadoCivilPessoa() == "Casado" || $pessoaDiretor->getEstadoCivilPessoa() == "União Estável" )
						{
							$pessoaConjugue->setIdCliente($cliente->getIdClientes());
							$idPessoaConjugue = $controla->cadastraPessoa($pessoaConjugue);
							$enderecoDiretor->setIdPessoa($idPessoaConjugue);
							$controla->cadastraEndereco($enderecoDiretor);
						}
						//CADASTRAMENTO DO DIRETOR DA EMPRESA E ENDERECO DO DIRETOR
						$pessoaDiretor->setIdCliente($cliente->getIdClientes());
						$pessoaDiretor->setIdConjuguePessoa($idPessoaConjugue);
						$idDiretor = $controla->cadastraPessoa($pessoaDiretor);
						$enderecoDiretor->setIdPessoa($idDiretor);
						$controla->cadastraEndereco($enderecoDiretor);
						$empresas->setIdDiretor($idDiretor);
					}
					
					
					//Cadastramento da Empresa
					$idEmpresa = $controla->cadastraEmpresa($empresas);
					$endereco->setIdEmpresa($idEmpresa);
					$controla->cadastraEndereco($endereco);
					
					$cliente->setIdEmpresa($idEmpresa);
					$controla->updateClientes($cliente);
					
					
					$descricao = "
					<b>DADOS DA Empresa</b>
					{$empresas->mostraDados()}<br>
					<br>
					<b>ENDEREÇO</b>
					{$endereco->mostraDadosEndereco()}<br>
					<br>";
					if($pessoaDiretor->getEstadoCivilPessoa() == "Casado" || $pessoaDiretor->getEstadoCivilPessoa() == "União Estável" )
					{
						$descricao = "
						<b>DADOS DO CONJUGUE</b>
						";
					}
					
					$controla->enviarEmail($empresa->getNomeEmpresa(),$endereco->getEmailEndereco(),"Cadastro de Empresa",$descricao);
					$mensagem = "Cadastro realizado com sucesso. Um e-mail foi enviado para o e-mail cadastrado.";
					header("Location: ../views/painel/index.php?p=home&msg={$mensagem}");
				}
				else 
				{
					header("Location: ../views/painel/index.php?p=add_cnpj&msg=$mensagem&empresas=".urlencode(serialize($empresas))."&endereco=".urlencode(serialize($endereco))."&pessoaDiretor=".urlencode(serialize($pessoaDiretor))."&enderecoDiretor=".urlencode(serialize($enderecoDiretor))."&pessoaConjugue=".urlencode(serialize($pessoaConjugue))."");
				}
			}
			catch (Exception $e)
			{
				$mensagem .= $e;
				header("Location: ../views/painel/index.php?p=add_cnpj&msg=$mensagem&empresas=".urlencode(serialize($empresas))."&endereco=".urlencode(serialize($endereco))."&pessoaDiretor=".urlencode(serialize($pessoaDiretor))."&enderecoDiretor=".urlencode(serialize($enderecoDiretor))."&pessoaConjugue=".urlencode(serialize($pessoaConjugue))."");
			}
		}
		
		if($_POST['acao'] == "CadastraVeiculos")
		{
			try
			{
				$mensagem = '';
				$veiculos = new Veiculos();
				$veiculos->setIdClientes($_POST['idClientes']);
				
				if($_POST['placa'] != '')
					$veiculos->setPlacaVeiculos($_POST['placa']);
				else
					$mensagem .= "A placa do veículo deve ser informada";
				
				$veiculos->setMarcaVeiculos($_POST['marca']);
				$veiculos->setModeloVeiculos($_POST['modelo']);
				$veiculos->setCorVeiculos($_POST['cor']);
				$veiculos->setCombustivelVeiculos($_POST['combustivel']);
				$veiculos->setCapacidadeTanqueVeiculos($_POST['capacidade']);
				$veiculos->setAnoFabricacaoVeiculos($_POST['anofab']);
				$veiculos->setRenavamVeiculos($_POST['renavam']);
				$veiculos->setChassiVeiculos($_POST['chassi']);
				$veiculos->setCodFipeVeiculos($_POST['codigo_fipe']);
				$veiculos->setFornecedorNfVeiculos($_POST['fornecedor_nf']);
				$veiculos->setCidadeNfVeiculos($_POST['cidade_nf']);
				$veiculos->setProprietarioNfVeiculos($_POST['proprietario_nf']);
				$veiculos->setArrendatarioNfVeiculos($_POST['arrendatario_nf']);
				$veiculos->setPlacaNfVeiculos($_POST['placa_nf']);
				$veiculos->setNumeroNfVeiculos($_POST['numero_nf']);
				$veiculos->setDataNfVeiculos($formataData->toDBDate($_POST['data_nf']));
				$veiculos->setKmEntregaNfVeiculos($_POST['km_entrega_nf']);
				$veiculos->setTempoGarantiaNfVeiculos($_POST['tempo_garantia']);
				$veiculos->setKmGarantiaVeiculos($_POST['km_garantia']);
				$veiculos->setVencimentoIpvaVeiculos($formataData->toDBDate($_POST['vencimento_ipva']));
				$veiculos->setVencimentoSeguroVeiculos($formataData->toDBDate($_POST['vencimento_seguro']));
				
				if($mensagem == '')
				{
					$controla->cadastraVeiculos($veiculos);
					$mensagem = 'Veículo Cadastrado com sucesso.';
					header("Location: ../views/painel/index.php?p=home&msg={$mensagem}");
				}
				else
				{
					header("Location: ../views/painel/index.php?p=add_veiculos&msg=$mensagem&veiculos=".urlencode(serialize($veiculos))."");
				}
				
			}
			catch (Exception $e)
			{
				$mensagem .= $e;
				header("Location: ../views/painel/index.php?p=add_veiculos&msg=$mensagem&veiculos=".urlencode(serialize($veiculos))."");
			}
		}
		
		if($_POST['acao'] == "cadastroMotorista")
		{
			$mensagem = '';
			try
			{
				$cnh = new Cnh();
				$pessoaCondutor = new Condutores();
				
				if($_POST['pessoaCondutor'] != '')
					$pessoaCondutor->setIdPessoa($_POST['pessoaCondutor']);
				else
					$mensagem .= 'Você deve escolher uma pessoa cadastrada para completar o cadastro.';
				
				if($_POST['cnh'] != '')
					$cnh->setNumeroCnh(trim($_POST['cnh']));
				else
					$mensagem .= 'Você deve preencher o número da CNH.';
					
				if($_POST['cnhuf'] != '')
					$cnh->setUfCnh(trim($_POST['cnhuf']));
				else
					$mensagem .= 'Você deve selecionar o estado da carteira de habilitação.';
				
				if($_POST['cnhcat'] != '')
					$cnh->setCategoriaCnh(trim($_POST['cnhcat']));
				else
					$mensagem .= 'Você deve informar a categoria da carteira de habilitação.';
				
				if($_POST['cnhvcto'] != '')
					$cnh->setVencCnh($formataData->toDBDate($_POST['cnhvcto']));
				else
					$mensagem .= 'Você deve informar o a data do vencimento da carteira de habilitação.';

				if($mensagem == '')
				{
					$idCnh = $controla->cadastrarCnh($cnh);
					$collVoPessoa = $controla->findCondutores($pessoaCondutor);
					if(is_null($collVoPessoa))
					{
						$pessoaCondutor->setDataRegistroCondutores(date("Y-m-d H:i:s"));
						$pessoaCondutor->setIdCnh($idCnh);
						$controla->cadastrarCondutores($pessoaCondutor);
					}
					else
					{
						$pessoaCondutor = $collVoPessoa[0];
						$pessoaCondutor->setDataRegistroCondutores(date("Y-m-d H:i:s"));
						$pessoaCondutor->setIdCnh($idCnh);
						$controla->updateCondutores($pessoaCondutor);
						
					}
					$mensagem = 'Condutor cadastrado com sucesso.';
					header("Location: ../views/painel/index.php?p=home&msg=$mensagem");
				}
				else
				{
					header("Location: ../views/painel/index.php?p=add_motorista&msg=$mensagem&condutores=".urlencode(serialize($pessoaCondutor))."&cnh=".urlencode(serialize($cnh))."");
				}				
			}
			catch (Exception $e)
			{
				$mensagem .= $e;
				header("Location: ../views/painel/index.php?p=add_motorista&msg=$mensagem&condutores=".urlencode(serialize($pessoaCondutor))."&cnh=".urlencode(serialize($cnh))."");
			}
		}
		
		if($_POST['acao'] == "cadastroTipoRevisoes")
		{
			$mensagem = '';
			try
			{
				$tipoRevisoes = new Tiporevisoes();
				if($_POST['descricao'] != '')
					$tipoRevisoes->setDescricaoTipoRevisoes($_POST['descricao']);
				else
					$mensagem .= 'A descrição do tipo de Revisões não deve estar em branco.';
				
				if($mensagem == '')
				{
					$controla->cadastrarTipoRevisoes($tipoRevisoes);
					$mensagem = 'Tipo de revisão cadastrado com sucesso.';
					header("Location: ../views/painel/index.php?p=home&msg=$mensagem");
				}	
				else
				{
					header("Location: ../views/painel/index.php?p=add_tipo_rev&msg=$mensagem&tipoRevisoes=".urlencode(serialize($tipoRevisoes))."");
				}
					
			}
			catch (Exception $e)
			{
				$mensagem .= $e;
				header("Location: ../views/painel/index.php?p=add_tipo_rev&msg=$mensagem&tipoRevisoes=".urlencode(serialize($tipoRevisoes))."");
			}
		}
		if($_POST['acao'] == "cadastroRevisoes")
		{
			$mensagem = '';
			try
			{
				$revisoes = new Revisoes();
				
				if($_POST['placa'] != '')
					$revisoes->setIdVeiculos($_POST['placa']);
				else
					$mensagem .= 'Um veículo deve ser selecionado.';
				
				if($_POST['revisao'] != '')
					$revisoes->setIdTipoRevisoes($_POST['revisao']);
				else
					$mensagem .= 'O tipo da Revisão deve ser selecionado.';

				$revisoes->setDataRevisoes($formataData->toDBDate($_POST['tult']));
				$revisoes->setKmRevisoes($_POST['kult']);
				$revisoes->setProxDataRevisoes($formataData->toDBDate($_POST['tprox']));
				$revisoes->setProxKmRevisoes($_POST['kprox']);

				if($mensagem == '')
				{
					$controla->cadastrarRevisoes($revisoes);
					$mensagem = 'Revisão cadastrado com sucesso.';
					header("Location: ../views/painel/index.php?p=home&msg=$mensagem");
				}
				else
				{
					header("Location: ../views/painel/index.php?p=add_rev_padrao&msg=$mensagem&revisoes=".urlencode(serialize($revisoes))."");
				}
				
			}
			catch (Exception $e)
			{
				$mensagem .= $e;
				header("Location: ../views/painel/index.php?p=add_rev_padrao&msg=$mensagem&revisoes=".urlencode(serialize($revisoes))."");
			}
		}
		
		if($_POST['acao'] == "cadastroAbastecimento")
		{
			$mensagem = '';
			try
			{
				$abastecimentos = new Abastecimentos();
				if($_POST['placa'] != '')
					$abastecimentos->setIdVeiculos($_POST['placa']);
				else
					$mensagem .= 'Um veículo deve ser selecionado.';
				
				$abastecimentos->setDataAbastecimentos($formataData->toDBDate($_POST['data']));
				$abastecimentos->setKmAbastecimentos($_POST['km']);
				$abastecimentos->setPostoAbastecimentos($_POST['posto']);
				$abastecimentos->setNfAbastecimentos($_POST['nf']);
				$abastecimentos->setTipoCombustivelAbastecimentos($_POST['combustivel']);
				$abastecimentos->setValorAbastecimentos($_POST['valor']);
				$abastecimentos->setLitrosAbastecimentos($_POST['litros']);

				if($mensagem == '')
				{
					$controla->cadastrarAbastecimentos($abastecimentos);
					$mensagem = 'Abastecimento cadastrado com sucesso.';
					header("Location: ../views/painel/index.php?p=home&msg=$mensagem");
				}
				else
				{
					header("Location: ../views/painel/index.php?p=add_abastece&msg=$mensagem&abastecimentos=".urlencode(serialize($abastecimentos))."");
				}
				
			}
			catch (Exception $e)
			{
				$mensagem .= $e;
				header("Location: ../views/painel/index.php?p=add_abastece&msg=$mensagem&abastecimentos=".urlencode(serialize($abastecimentos))."");
			}
		}
		
		if($_POST['acao'] == "buscaCpf")
		{
			$mensagem = '';
			try 
			{
				$pessoa = new Pessoa();
				if($_POST['busca'] != '')
					$pessoa->setNomePessoa(trim($_POST['busca']));
				else
					$mensagem = 'Para efetuar a busca, você deve entrar com um parâmetro.';
				
				$pessoa->setIdCliente($_POST['idCliente']);
				
				if($mensagem == '')
				{
					$collVo = null;
					$collVo = $controla->findPessoas($pessoa);
					if(!is_null($collVo))
						header("Location: ../views/painel/index.php?p=busca_cpf&pessoasPesquisadas=".urlencode(serialize($collVo)).""); 
					else
						header("Location: ../views/painel/index.php?p=busca_cpf&pessoasPesquisadas=");
				}
				else
				{
					header("Location: ../views/painel/index.php?p=busca_cpf&msg=$mensagem");
				}
			}
			catch (Exception $e)
			{
				$mensagem .= $e;
				header("Location: ../views/painel/index.php?p=busca_cpf&msg=$mensagem");
			}
		}
		
		if($_POST['acao'] == "alterarPessoa")
		{
			try 
			{
				$mensagem = '';
				//CADASTRO DE PESSOA
				$pessoaAtual = new Pessoa();
				$pessoaAtual->setIdPessoa($_POST['idPessoa']);
				$pessoaAtual->setIdCliente($_POST['idCliente']);
				
				if($_POST['nome'] != '')
					$pessoaAtual->setNomePessoa(trim($_POST['nome']));
				else 
					$mensagem .= "O Nome da Pessoa não pode estar em branco.";
				
				if($_POST['dataNascimento'] != '')
					$pessoaAtual->setDataNascimentoPessoa($formataData->toDBDate($_POST['dataNascimento']));
				else
					$mensagem .= "A data de nascimento da pessoa deve ser preenchida.";
				
				$pessoaAtual->setSexoPessoa($_POST['sexo']);
				$pessoaAtual->setEstadoCivilPessoa($_POST['estadoCivil']);
				
				if($_POST['rg'] != '')
				{
					$pessoaAtual->setRgPessoa(trim($_POST['rg']));
					$pessoaAtual->setOrgExpPessoa(trim($_POST['rg_orgao']));
					$pessoaAtual->setUfOrgExpPessoa($_POST['rg_uf']);
				}
				else
				{
					$mensagem .= "O RG da pessoa não deve estar em branco.";
				}
				
				if($_POST['cpf'] != '')
					$pessoaAtual->setCpfPessoa($controla->retiraMascaraCPF($_POST['cpf']));
				else
					$mensagem .= "O CPF não deve estar em branco.";
				
				//CADASTRO DE ENDERECO PARA PESSOA
				
				$endereco = new Endereco();
				$endereco->setIdEndereco($_POST['idEndereco']);
				$endereco->setRuaEndereco(trim($_POST['rua']));
				$endereco->setComplementoEndereco(trim($_POST['complemento']));
				$endereco->setBairroEndereco(trim($_POST['bairro']));
				$endereco->setCepEndereco(trim($_POST['cep']));
				$endereco->setCidadeEndereco(trim($_POST['cidade']));
				$endereco->setEstadoEndereco($_POST['estado']);
				
				if($controla->testaEmail($_POST['email']))
					$endereco->setEmailEndereco(trim($_POST['email']));
				
				$endereco->setTelefoneEndereco(trim($_POST['telefone']));
				$endereco->setCelEndereco(trim($_POST['celular']));
				$endereco->setFaxEndereco(trim($_POST['fax']));
				
				
				//Cadastro do Conjugue
				
				$pessoaConjugue = new Pessoa();
				if($pessoaAtual->getEstadoCivilPessoa() == "Casado" || $pessoaAtual->getEstadoCivilPessoa() == "União Estável" )
				{
					if($_POST['idPessoaConjugue'] != '')
						$pessoaConjugue->setIdPessoa($_POST['idPessoaConjugue']);
						
					if($_POST['nomeConjugue'] != '')
						$pessoaConjugue->setNomePessoa(trim($_POST['nomeConjugue']));
					else 
						$mensagem .= "O Nome do Conjugue não pode estar em branco.";
					
					if($_POST['dataNascimentoConjugue'] != '')
						$pessoaConjugue->setDataNascimentoPessoa($formataData->toDBDate($_POST['dataNascimentoConjugue']));
					else
						$mensagem .= "A data de nascimento do Conjugue deve ser preenchida.";
					
					$pessoaConjugue->setSexoPessoa($_POST['sexoConjugue']);
					$pessoaConjugue->setEstadoCivilPessoa($_POST['estadoCivil']);
					
					if($_POST['rgConjugue'] != '')
					{
						$pessoaConjugue->setRgPessoa(trim($_POST['rgConjugue']));
						$pessoaConjugue->setOrgExpPessoa(trim($_POST['rg_orgaoConjugue']));
						$pessoaConjugue->setUfOrgExpPessoa($_POST['rg_ufConjugue']);
					}
					else
					{
						$mensagem .= "O RG do Conjugue não deve estar em branco.";
					}
					
					if($_POST['cpfConjugue'] != '')
						$pessoaConjugue->setCpfPessoa($controla->retiraMascaraCPF($_POST['cpfConjugue']));
					else
						$mensagem .= "O CPF do Conjugue não deve estar em branco.";
				}
				
				//TESTE DE ERRO e UPDATE DE CADASTRO
				
				if($mensagem == '')
				{
					//Cadastrando Conjugue
					if($pessoaAtual->getEstadoCivilPessoa() == "Casado" || $pessoaAtual->getEstadoCivilPessoa() == "União Estável" )
					{
						if($pessoaConjugue->getIdPessoa() != null)
						{
							$controla->updatePessoa($pessoaConjugue);
						}
						else
						{
							$idPessoaConjugue = $controla->cadastraPessoa($pessoaConjugue);
							$pessoaConjugue->setIdPessoa($idPessoaConjugue);					
						}
						$endereco->setIdPessoa($pessoaConjugue->getIdPessoa());	
						$controla->updateEndereco($endereco);
						$pessoaAtual->setIdConjuguePessoa($pessoaConjugue->getIdPessoa());
					}
					//Atualização de Endereço
					$controla->updatePessoa($pessoaAtual);
					$endereco->setIdPessoa($pessoaAtual->getIdPessoa());
					$controla->updateEndereco($endereco);
					
					
					$descricao = "
					<b>DADOS DA PESSOA</b>
					{$pessoaAtual->mostraDadosPessoa()}<br>
					<br>
					<b>ENDEREÇO</b>
					{$endereco->mostraDadosEndereco()}<br>
					<br>";
					if($pessoaAtual->getEstadoCivilPessoa() == "Casado" || $pessoaAtual->getEstadoCivilPessoa() == "União Estável" )
					{
						$descricao = "
						<b>DADOS DO CONJUGUE</b>
						";
					}
					
					$controla->enviarEmail($pessoaAtual->getNomePessoa(),$endereco->getEmailEndereco(),"Cadastro de Pessoa",$descricao);
					$mensagem = "Atualização realizado com sucesso. Um e-mail foi enviado para o e-mail cadastrado.";
					header("Location: ../views/painel/index.php?p=home&msg=$mensagem");
				}
				else
				{
					header("Location: ../views/painel/index.php?p=detalhe_cpf&msg=$mensagem&pessoa=".urlencode(serialize($pessoaAtual))."&endereco=".urlencode(serialize($endereco))."&pessoaConjugue=".urlencode(serialize($pessoaConjugue))."");
				}
			}
			catch (Exception $e)
			{
				$mensagem .= $e;
				header("Location: ../views/painel/index.php?p=detalhe_cpf&msg=$mensagem&pessoa=".urlencode(serialize($pessoaAtual))."&endereco=".urlencode(serialize($endereco))."&pessoaConjugue=".urlencode(serialize($pessoaConjugue))."");
			}
		}
		
		if($_POST['acao'] == "buscaCnpj")
		{
			$mensagem = '';
			try 
			{
				$empresas = new Empresas();
				if($_POST['busca'] != '')
				{
					$empresas->setNomeEmpresa(trim($_POST['busca']));
					$empresas->setNomeFantasiaEmpresa(trim($_POST['busca']));
				}
				else
					$mensagem = 'Para efetuar a busca, você deve entrar com um parâmetro.';
				
				$empresas->setIdClientes($_POST['idCliente']);	
					
				if($mensagem == '')
				{
					$collVo = null;
					$collVo = $controla->findEmpresas($empresas);
					if(!is_null($collVo))
						header("Location: ../views/painel/index.php?p=busca_cnpj&empresasPesquisadas=".urlencode(serialize($collVo)).""); 
					else
						header("Location: ../views/painel/index.php?p=busca_cnpj&empresasPesquisadas=");
				}
				else
				{
					header("Location: ../views/painel/index.php?p=busca_cnpj&msg=$mensagem");
				}
			}
			catch (Exception $e)
			{
				$mensagem .= $e;
				header("Location: ../views/painel/index.php?p=busca_cnpj&msg=$mensagem");
			}
		}
		
		if($_POST['acao'] == "alterarEmpresa")
		{
			try
			{
				$mensagem = '';
				$empresas = new Empresas();
				
				$cliente = new Clientes();
				$cliente->setIdClientes($_POST['idCliente']);
				$collVoCliente = $controla->findClientes($cliente);
				$cliente = $collVoCliente[0];
				
				$empresas->setIdEmpresa($_POST['idEmpresa']);
				$empresas->setNomeEmpresa($_POST['nome_empresa']);
				$empresas->setNomeFantasiaEmpresa($_POST['nome_fantasia']);
				$empresas->setDataFundacaoEmpresa($formataData->toDBDate($_POST['data_fundacao']));
				$empresas->setIdClientes($cliente->getIdClientes());

				if($_POST['cnpj'] != '')
					$empresas->setCnpjEmpresa($_POST['cnpj']);
				else
					$mensagem = "O CNPJ não pode estar em branco";
				
				$empresas->setInscricaoEstadualEmpresa($_POST['insc']);
				$empresas->setRamoEmpresa($_POST['ramo']);
				$empresas->setOrigemEmpresa($_POST['origem']);
				
				//DADOS DO ENDEREÇO DA EMRPESA
				$endereco = new Endereco();
				
				$endereco->setIdEndereco($_POST['idEndereco']);
				$endereco->setRuaEndereco(trim($_POST['rua']));
				$endereco->setComplementoEndereco(trim($_POST['complemento']));
				$endereco->setBairroEndereco(trim($_POST['bairro']));
				$endereco->setCepEndereco(trim($_POST['cep']));
				$endereco->setCidadeEndereco(trim($_POST['cidade']));
				$endereco->setEstadoEndereco($_POST['estado']);
				
				if($controla->testaEmail($_POST['email']))
					$endereco->setEmailEndereco(trim($_POST['email']));
				
				$endereco->setTelefoneEndereco(trim($_POST['telefone']));
				$endereco->setCelEndereco(trim($_POST['celular']));
				$endereco->setFaxEndereco(trim($_POST['fax']));
				$endereco->setIdEmpresa($empresas->getIdEmpresa());

				$pessoaDiretor = null;
				if($_POST['preenche'] == "Sim")
				{
					//DADOS DO DIRETOR DA EMPRESA
					
					$pessoaDiretor = new Pessoa();
					
					if($_POST['nome'] != '')
						$pessoaDiretor->setNomePessoa(trim($_POST['nome']));
					else 
						$mensagem .= "O Nome da Pessoa não pode estar em branco.";
					
					if($_POST['dataNascimento'] != '')
						$pessoaDiretor->setDataNascimentoPessoa($formataData->toDBDate($_POST['dataNascimento']));
					else
						$mensagem .= "A data de nascimento da pessoa deve ser preenchida.";
						
					if($_POST['idDiretor'] != '')
					{
						$pessoaDiretor->setIdPessoa($_POST['idDiretor']);
					}
					$pessoaDiretor->setSexoPessoa($_POST['sexo']);
					$pessoaDiretor->setEstadoCivilPessoa($_POST['estadoCivil']);
					
					if($_POST['rg'] != '')
					{
						$pessoaDiretor->setRgPessoa(trim($_POST['rg']));
						$pessoaDiretor->setOrgExpPessoa(trim($_POST['rg_orgao']));
						$pessoaDiretor->setUfOrgExpPessoa($_POST['rg_uf']);
					}
					else
					{
						$mensagem .= "O RG da pessoa não deve estar em branco.";
					}
					
					if($_POST['cpf'] != '')
						$pessoaDiretor->setCpfPessoa($controla->retiraMascaraCPF($_POST['cpf']));
					else
						$mensagem .= "O CPF não deve estar em branco.";
					
					//ENDEREÇO DIRETOR DA EMPRESA
					$enderecoDiretor = new Endereco();
					$enderecoDiretor->setRuaEndereco(trim($_POST['ruaDiretor']));
					$enderecoDiretor->setComplementoEndereco(trim($_POST['complementoDiretor']));
					$enderecoDiretor->setBairroEndereco(trim($_POST['bairroDiretor']));
					$enderecoDiretor->setCepEndereco(trim($_POST['cepDiretor']));
					$enderecoDiretor->setCidadeEndereco(trim($_POST['cidadeDiretor']));
					$enderecoDiretor->setEstadoEndereco($_POST['estadoDiretor']);
					
					if($controla->testaEmail($_POST['email']))
						$enderecoDiretor->setEmailEndereco(trim($_POST['emailDiretor']));
					
					$enderecoDiretor->setTelefoneEndereco(trim($_POST['telefoneDiretor']));
					$enderecoDiretor->setCelEndereco(trim($_POST['celularDiretor']));
					$enderecoDiretor->setFaxEndereco(trim($_POST['faxDiretor']));
					$enderecoDiretor->setIdPessoa($pessoaDiretor->getIdPessoa());
					
					//DADOS CONJUGUE DIRETOR
					$pessoaConjugue = new Pessoa();
					if($pessoaDiretor->getEstadoCivilPessoa() == "Casado" || $pessoaDiretor->getEstadoCivilPessoa() == "União Estável" )
					{
						if($_POST['nomeConjugue'] != '')
							$pessoaConjugue->setNomePessoa(trim($_POST['nomeConjugue']));
						else 
							$mensagem .= "O Nome do Conjugue não pode estar em branco.";
						
						if($_POST['dataNascimentoConjugue'] != '')
							$pessoaConjugue->setDataNascimentoPessoa($formataData->toDBDate($_POST['dataNascimentoConjugue']));
						else
							$mensagem .= "A data de nascimento do Conjugue deve ser preenchida.";
						
						$pessoaConjugue->setIdPessoa($_POST['idConjugueDiretor']);
						$pessoaConjugue->setSexoPessoa($_POST['sexoConjugue']);
						$pessoaConjugue->setEstadoCivilPessoa($_POST['estadoCivil']);
						
						if($_POST['rgConjugue'] != '')
						{
							$pessoaConjugue->setRgPessoa(trim($_POST['rgConjugue']));
							$pessoaConjugue->setOrgExpPessoa(trim($_POST['rg_orgaoConjugue']));
							$pessoaConjugue->setUfOrgExpPessoa($_POST['rg_ufConjugue']);
						}
						else
						{
							$mensagem .= "O RG do Conjugue não deve estar em branco.";
						}
						
						if($_POST['cpfConjugue'] != '')
							$pessoaConjugue->setCpfPessoa($controla->retiraMascaraCPF($_POST['cpfConjugue']));
						else
							$mensagem .= "O CPF do Conjugue não deve estar em branco.";
					}
				}
				
				//TESTE E CADASTRO
				if($mensagem == '')
				{
					//Atualização DO DIRETOR DA EMPRESA E ENDERECO DO DIRETOR
					if($pessoaDiretor != null)
					{
						//Atualização Conjugue
						if($pessoaDiretor->getEstadoCivilPessoa() == "Casado" || $pessoaDiretor->getEstadoCivilPessoa() == "União Estável" )
						{
							$pessoaConjugue->setIdCliente($cliente->getIdClientes());
							if(!is_null($pessoaConjugue->getIdPessoa()) && $pessoaConjugue->getIdPessoa()!='')
							{
								$controla->updatePessoa($pessoaConjugue);
							}
							else
							{
								$idConjugue = $controla->cadastraPessoa($pessoaConjugue);
								$pessoaConjugue->setIdPessoa($idConjugue);
							}
							if($_POST['idConjugueDiretor'] != '')
								$enderecoDiretor->setIdEndereco($_POST['idConjugueDiretor']);
							$enderecoDiretor->setIdPessoa($pessoaConjugue->getIdPessoa());
							
							if(!is_null($enderecoDiretor->getIdEndereco()) && $enderecoDiretor->getIdEndereco()!='')
							{
								$controla->updateEndereco($enderecoDiretor);
							}
							else 
							{
								$controla->cadastraEndereco($enderecoDiretor);
							}
						}
						$pessoaDiretor->setIdCliente($cliente->getIdClientes());
						if($pessoaDiretor->getIdPessoa()!=null)
						{
							$controla->updatePessoa($pessoaDiretor);
						}
						else
						{
							$idPessoaDiretor = $controla->cadastraPessoa($pessoaDiretor);
							$pessoaDiretor->setIdPessoa($idPessoaDiretor);
						}
						if($_POST['idEnderecoDiretor'] != '')
							$enderecoDiretor->setIdEndereco($_POST['idEnderecoDiretor']);
							
						$enderecoDiretor->setIdPessoa($pessoaDiretor->getIdPessoa());
						
						if(!is_null($enderecoDiretor->getIdEndereco()) && $enderecoDiretor->getIdEndereco()!='')
						{
							$controla->updateEndereco($enderecoDiretor);
						}
						else 
						{
							$controla->cadastraEndereco($enderecoDiretor);
						}
					}

					//Atualização da Empresa
					$empresas->setIdDiretor($pessoaDiretor->getIdPessoa());
					$controla->updateEmpresa($empresas);
					$endereco->setIdEmpresa($empresas->getIdEmpresa());
					if(!is_null($endereco->getIdEndereco()) && $endereco->getIdEndereco() != '')
					{
						$controla->updateEndereco($endereco);
					}
					else
					{
						$controla->cadastraEndereco($endereco);
					}
					//Atualização de Endereço da Empresa
					
					$controla->updateEmpresa($empresas);
					
					$cliente->setIdEmpresa($empresas->getIdEmpresa());
					$controla->updateClientes($cliente);
					
					//
					
					$descricao = "
					<b>DADOS DA Empresa</b><br>
					{$empresas->mostraDados()}<br>
					<br>
					<b>ENDEREÇO</b><br>
					{$endereco->mostraDadosEndereco()}<br>
					<br>
					<b>DIRETOR</b><br>
					{$pessoaDiretor->mostraDadosPessoa()}<br>
					";
					
					$controla->enviarEmail($empresas->getNomeEmpresa(),$endereco->getEmailEndereco(),"Cadastro de Pessoa",$descricao);
					$mensagem = "Atualização de Empresas realizado com sucesso. Um e-mail foi enviado para o e-mail cadastrado.";
					header("Location: ../views/painel/index.php?p=home&msg={$mensagem}");
				}
				else 
				{
					header("Location: ../views/painel/index.php?p=detalhe_cnpj&msg=$mensagem&empresas=".urlencode(serialize($empresas))."&endereco=".urlencode(serialize($endereco))."&pessoaDiretor=".urlencode(serialize($pessoaDiretor))."&enderecoDiretor=".urlencode(serialize($enderecoDiretor))."&pessoaConjugue=".urlencode(serialize($pessoaConjugue))."");
				}
			}
			catch (Exception $e)
			{
				$mensagem .= $e;
				header("Location: ../views/painel/index.php?p=detalhe_cnpj&msg=$mensagem&empresas=".urlencode(serialize($empresas))."&endereco=".urlencode(serialize($endereco))."&pessoaDiretor=".urlencode(serialize($pessoaDiretor))."&enderecoDiretor=".urlencode(serialize($enderecoDiretor))."&pessoaConjugue=".urlencode(serialize($pessoaConjugue))."");
			}
		}
		
		if($_POST['acao'] == "buscaVeiculos")
		{
			$mensagem = '';
			try 
			{
				$veiculos = new Veiculos();
				if($_POST['busca'] != '')
				{
					$veiculos->getPlacaVeiculos(trim($_POST['busca']));
				}
				else
					$mensagem = 'Para efetuar a busca, você deve entrar com um parâmetro.';
				
				$veiculos->setIdClientes($_POST['idCliente']);	
					
				if($mensagem == '')
				{
					$collVo = null;
					$collVo = $controla->findVeiculos($veiculos);
					if(!is_null($collVo))
						header("Location: ../views/painel/index.php?p=busca_veiculos&veiculosPesquisados=".urlencode(serialize($collVo)).""); 
					else
						header("Location: ../views/painel/index.php?p=busca_veiculos&veiculosPesquisados=");
				}
				else
				{
					header("Location: ../views/painel/index.php?p=busca_cnpj&msg=$mensagem");
				}
			}
			catch (Exception $e)
			{
				$mensagem .= $e;
				header("Location: ../views/painel/index.php?p=busca_cnpj&msg=$mensagem");
			}
		}
		
		if($_POST['acao'] == "alterarVeiculos")
		{
			try
			{
				$mensagem = '';
				$veiculos = new Veiculos();
				$veiculos->setIdVeiculos($_POST['idVeiculos']);
				$veiculos->setIdClientes($_POST['idClientes']);
				
				if($_POST['placa'] != '')
					$veiculos->setPlacaVeiculos($_POST['placa']);
				else
					$mensagem .= "A placa do veículo deve ser informada";
				
				$veiculos->setMarcaVeiculos($_POST['marca']);
				$veiculos->setModeloVeiculos($_POST['modelo']);
				$veiculos->setCorVeiculos($_POST['cor']);
				$veiculos->setCombustivelVeiculos($_POST['combustivel']);
				$veiculos->setCapacidadeTanqueVeiculos($_POST['capacidade']);
				$veiculos->setAnoFabricacaoVeiculos($_POST['anofab']);
				$veiculos->setRenavamVeiculos($_POST['renavam']);
				$veiculos->setChassiVeiculos($_POST['chassi']);
				$veiculos->setCodFipeVeiculos($_POST['codigo_fipe']);
				$veiculos->setFornecedorNfVeiculos($_POST['fornecedor_nf']);
				$veiculos->setCidadeNfVeiculos($_POST['cidade_nf']);
				$veiculos->setProprietarioNfVeiculos($_POST['proprietario_nf']);
				$veiculos->setArrendatarioNfVeiculos($_POST['arrendatario_nf']);
				$veiculos->setPlacaNfVeiculos($_POST['placa_nf']);
				$veiculos->setNumeroNfVeiculos($_POST['numero_nf']);
				$veiculos->setDataNfVeiculos($formataData->toDBDate($_POST['data_nf']));
				$veiculos->setKmEntregaNfVeiculos($_POST['km_entrega_nf']);
				$veiculos->setTempoGarantiaNfVeiculos($_POST['tempo_garantia']);
				$veiculos->setKmGarantiaVeiculos($_POST['km_garantia']);
				$veiculos->setVencimentoIpvaVeiculos($formataData->toDBDate($_POST['vencimento_ipva']));
				$veiculos->setVencimentoSeguroVeiculos($formataData->toDBDate($_POST['vencimento_seguro']));
				
				if($mensagem == '')
				{
					$controla->updateVeiculos($veiculos);
					$mensagem = 'Veículo Alterado com sucesso.';
					header("Location: ../views/painel/index.php?p=home&msg={$mensagem}");
				}
				else
				{
					header("Location: ../views/painel/index.php?p=detalhe_veiculo&msg=$mensagem&veiculos=".urlencode(serialize($veiculos))."");
				}
				
			}
			catch (Exception $e)
			{
				$mensagem .= $e;
				header("Location: ../views/painel/index.php?p=detalhe_veiculo&msg=$mensagem&veiculos=".urlencode(serialize($veiculos))."");
			}
		}
		
		if($_POST['acao'] == "buscaCondutores")
		{
			$mensagem = '';
			try 
			{
				$condutores = new Condutores();
				$cnh = new Cnh();
				if($_POST['busca'] != '')
				{
					$cnh->setNumeroCnh(trim($_POST['busca']));
				}
				else
					$mensagem = 'Para efetuar a busca, você deve entrar com um parâmetro.';
					
				if($mensagem == '')
				{
					$collVo = null;
					$collVoCnh = $controla->findCnh($cnh);
					if(!is_null($collVoCnh))
					{
						foreach ($collVoCnh as $cnhs)
						{
							$cnh = $cnhs;
							$condutorPesquisa = new Condutores();
							$condutorPesquisa->setIdCnh($cnh->getIdCnh());
							$collVoCondutor = $controla->findCondutores($condutorPesquisa);
							if(!is_null($collVoCondutor))
							{
								foreach ($collVoCondutor as $condutores)
								{
									$condutorPesquisa = $condutores;
									$pessoaAtual = new Pessoa();
									$pessoaAtual->setIdPessoa($condutorPesquisa->getIdPessoa());
									$collVoPessoaAtual = $controla->findPessoas($pessoaAtual);
									$pessoaAtual = $collVoPessoaAtual[0];
									if($pessoaAtual->getIdCliente() == $_POST['idCliente'])
									{
										$collVo[] = $condutorPesquisa;
										
									}
								}
							}
						}
					}
					if(!is_null($collVo))
						header("Location: ../views/painel/index.php?p=busca_condutores&condutoresPesquisados=".urlencode(serialize($collVo)).""); 
					else
						header("Location: ../views/painel/index.php?p=busca_condutores&condutoresPesquisados=");
				}
				else
				{
					header("Location: ../views/painel/index.php?p=busca_cnpj&msg=$mensagem");
				}
			}
			catch (Exception $e)
			{
				$mensagem .= $e;
				header("Location: ../views/painel/index.php?p=busca_cnpj&msg=$mensagem");
			}
		}
		
		if($_POST['acao'] == "alterarCondutores")
		{
			$mensagem = '';
			try
			{
				$pessoaCondutor = new Condutores();
				$pessoaCondutor->setIdCondutores($_POST['idCondutor']);
				$pessoaCondutor->setIdCnh($_POST['idCnh']);
				$pessoaCondutor->setIdPessoa($_POST['idPessoa']);
				
				$cnh = new Cnh();
				$cnh->setIdCnh($pessoaCondutor->getIdCnh());
				
				if($_POST['cnh'] != '')
					$cnh->setNumeroCnh(trim($_POST['cnh']));
				else
					$mensagem .= 'Você deve preencher o número da CNH.';
					
				if($_POST['cnhuf'] != '')
					$cnh->setUfCnh(trim($_POST['cnhuf']));
				else
					$mensagem .= 'Você deve selecionar o estado da carteira de habilitação.';
				
				if($_POST['cnhcat'] != '')
					$cnh->setCategoriaCnh(trim($_POST['cnhcat']));
				else
					$mensagem .= 'Você deve informar a categoria da carteira de habilitação.';
				
				if($_POST['cnhvcto'] != '')
					$cnh->setVencCnh($formataData->toDBDate($_POST['cnhvcto']));
				else
					$mensagem .= 'Você deve informar o a data do vencimento da carteira de habilitação.';

				if($mensagem == '')
				{
					$controla->updateCnh($cnh);
					$controla->updateCondutores($pessoaCondutor);
					$mensagem = 'Condutor alterado com sucesso.';
					header("Location: ../views/painel/index.php?p=home&msg=$mensagem");
				}
				else
				{
					header("Location: ../views/painel/index.php?p=detalhe_condutores&msg=$mensagem&condutores=".urlencode(serialize($pessoaCondutor))."&cnh=".urlencode(serialize($cnh))."");
				}				
			}
			catch (Exception $e)
			{
				$mensagem .= $e;
				header("Location: ../views/painel/index.php?p=detalhe_condutores&msg=$mensagem&condutores=".urlencode(serialize($pessoaCondutor))."&cnh=".urlencode(serialize($cnh))."");
			}
		}
		
		if($_POST['acao'] == "buscaRevisoes")
		{
			$mensagem = '';
			try 
			{
				$veiculos = new Veiculos();
				$revisoes = new Revisoes();
				if($_POST['busca'] != '')
				{
					$veiculos->setPlacaVeiculos(trim($_POST['busca']));
				}
				else
					$mensagem = 'Para efetuar a busca, você deve entrar com um parâmetro.';
					
				if($mensagem == '')
				{
					$collVo = null;
					$collVoVeiculos = $controla->findVeiculos($veiculos);
					if(!is_null($collVoVeiculos))
					{
						$veiculos = $collVoVeiculos[0];
						$revisoes->setIdVeiculos($veiculos->getIdVeiculos());
						$collVo = $controla->findRevisoes($revisoes);
					}
					if(!is_null($collVo))
					{
						
						header("Location: ../views/painel/index.php?p=busca_revisoes&revisoesPesquisados=".urlencode(serialize($collVo))."&veiculos=".urlencode(serialize($veiculos))."");
					} 
					else 
					{
						header("Location: ../views/painel/index.php?p=busca_revisoes&revisoesPesquisados=");
					}
				}
				else
				{
					header("Location: ../views/painel/index.php?p=busca_cnpj&msg=$mensagem");
				}
			}
			catch (Exception $e)
			{
				$mensagem .= $e;
				header("Location: ../views/painel/index.php?p=busca_cnpj&msg=$mensagem");
			}
		}
		if($_POST['acao'] == "alterarRevisoes")
		{
			$mensagem = '';
			try
			{
				$revisoes = new Revisoes();
				$revisoes->setIdRevisoes($_POST['idRevisoes']);
				$revisoes->setIdVeiculos($_POST['idVeiculos']);
				$revisoes->setIdTipoRevisoes($_POST['idTipoRevisoes']);

				$revisoes->setDataRevisoes($formataData->toDBDate($_POST['tult']));
				$revisoes->setKmRevisoes($_POST['kult']);
				$revisoes->setProxDataRevisoes($formataData->toDBDate($_POST['tprox']));
				$revisoes->setProxKmRevisoes($_POST['kprox']);

				if($mensagem == '')
				{
					$controla->updateRevisoes($revisoes);
					$mensagem = 'Revisão alterado com sucesso.';
					header("Location: ../views/painel/index.php?p=home&msg=$mensagem");
				}
				else
				{
					header("Location: ../views/painel/index.php?p=detalhe_revisoes&msg=$mensagem&revisoes=".urlencode(serialize($revisoes))."");
				}
				
			}
			catch (Exception $e)
			{
				$mensagem .= $e;
				header("Location: ../views/painel/index.php?p=detalhe_revisoes&msg=$mensagem&revisoes=".urlencode(serialize($revisoes))."");
			}
		}
		if($_POST['acao'] == "buscaAbastecimentos")
		{
			$mensagem = '';
			try 
			{
				$abastecimentos = new Abastecimentos();
				if($_POST['veiculo'] != '')
				{
					$abastecimentos->getIdVeiculos(trim($_POST['veiculo']));
				}
				else
					$mensagem = 'Para efetuar a busca, você deve entrar com um parâmetro.';
					
				if($mensagem == '')
				{
					$collVo = $controla->findAbastecimentos($abastecimentos);
					
					if(!is_null($collVo))
					{
						
						header("Location: ../views/painel/index.php?p=busca_abastece&abastecimentosPesquisados=".urlencode(serialize($collVo))."");
					} 
					else 
					{
						header("Location: ../views/painel/index.php?p=busca_abastece&abastecimentosPesquisados=");
					}
				}
				else
				{
					header("Location: ../views/painel/index.php?p=busca_abastece&msg=$mensagem");
				}
			}
			catch (Exception $e)
			{
				$mensagem .= $e;
				header("Location: ../views/painel/index.php?p=busca_abastece&msg=$mensagem");
			}
		}
		
		if($_POST['acao'] == "alterarAbastecimento")
		{
			$mensagem = '';
			try
			{
				$abastecimentos = new Abastecimentos();
				$abastecimentos->setIdAbastecimentos($_POST['idAbastecimentos']);
				$abastecimentos->setIdVeiculos($_POST['idVeiculos']);
				
				$abastecimentos->setDataAbastecimentos($formataData->toDBDate($_POST['data']));
				$abastecimentos->setKmAbastecimentos($_POST['km']);
				$abastecimentos->setPostoAbastecimentos($_POST['posto']);
				$abastecimentos->setNfAbastecimentos($_POST['nf']);
				$abastecimentos->setTipoCombustivelAbastecimentos($_POST['combustivel']);
				$abastecimentos->setValorAbastecimentos($_POST['valor']);
				$abastecimentos->setLitrosAbastecimentos($_POST['litros']);

				if($mensagem == '')
				{
					$controla->updateAbastecimentos($abastecimentos);
					$mensagem = 'Abastecimento alterado com sucesso.';
					header("Location: ../views/painel/index.php?p=home&msg=$mensagem");
				}
				else
				{
					header("Location: ../views/painel/index.php?p=detalhe_abastecimentos&msg=$mensagem&abastecimentos=".urlencode(serialize($abastecimentos))."");
				}
				
			}
			catch (Exception $e)
			{
				$mensagem .= $e;
				header("Location: ../views/painel/index.php?p=detalhe_abastecimentos&msg=$mensagem&abastecimentos=".urlencode(serialize($abastecimentos))."");
			}
		}
	}
	
}
?>
