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
		if (@mail($mail,$assunto_email,$msg,$headers))
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
		}
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
	
	/**
	 * Método de validação de CPF
	 * @param $cpf
	 */
	public function validaCPF($cpf)
	{	// Verifiva se o número digitado contém todos os digitos
	    $cpf = str_pad(ereg_replace('[^0-9]', '', $cpf), 11, '0', STR_PAD_LEFT);
		
		// Verifica se nenhuma das sequências abaixo foi digitada, caso seja, retorna falso
	    if (strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999')
		{
			throw new Exception("CPF Inválido.");
	    }
		else
		{   // Calcula os números para verificar se o CPF é verdadeiro
	        for ($t = 9; $t < 11; $t++) {
	            for ($d = 0, $c = 0; $c < $t; $c++) {
	                $d += $cpf{$c} * (($t + 1) - $c);
	            }
	
	            $d = ((10 * $d) % 11) % 10;
	
	            if ($cpf{$c} != $d) {
	                throw new Exception("CPF Inválido.");
	            }
	        }
	    }
	    return $cpf;
	}
	
	/**
	 * Validar CNPJ
	 * @return CNPJ formatado ou false
	 * @param $str
	 */
	public function validaCNPJ($str)
	{
		if (!preg_match('|^(\d{2,3})\.?(\d{3})\.?(\d{3})\/?(\d{4})\-?(\d{2})$|', $str, $matches))
			throw new Exception("CNPJ Inválido.");
		return $str;
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
	 * Método de validação de data
	 */
	public function validaData($data)
	{
		$dataN = explode("/",$data);
		if($dataN[2] < 1900)
		{
			throw new Exception("Data Inválida.");
		}
		if(strlen($dataN[2]) < 4 || strlen($dataN[2]) > 4)
		{
			throw new Exception("Data Inválida.");
		}
		return $data;
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
	 * Validação de Tamanho de Nomes
	 * @param unknown_type $nomes
	 */
	public function validaNomes($nomes)
	{
		if(strlen($nomes) < 3 )
			throw new Exception("O nome deve conter mais que 3 letras.");
		else
			return $nomes;
	}
	
	/**
	 * Validação de CPF
	 * @param unknown_type $cpf
	 */
	public function validaCpfIgual($cpf)
	{
		$qdao = new QDAO();
		$pessoa = new Pessoa();
		$pessoa->setCpfPessoa($cpf);
		$collVo = $qdao->findPessoa($pessoa);
		if(!is_null($collVo))
		{
			throw new Exception("CPF já cadastrado.");
		}
		return $cpf;
	}

	/**
	 * Validação de CNPJ
	 * @param unknown_type $cnpj
	 */
	public function validaCnpjIgual($cnpj)
	{
		$qdao = new QDAO();		
		$empresas = new Empresas();
		$empresas->setCnpjEmpresa($cnpj);
		$collVo = $qdao->findEmpresas($empresas);
		if(!is_null($collVo))
		{
			throw new Exception("CNPJ já cadastrado.");
		}
		return $cnpj;
	}

	/**
	 * Validação de Veiculo
	 * @param unknown_type $placa
	 */
	public function validaVeiculoIgual($placa)
	{
		$qdao = new QDAO();		
		$veiculos = new Veiculos();
		$veiculos->setPlacaVeiculos($placa);
		$collVo = $qdao->findVeiculos($veiculos);
		if(!is_null($collVo))
		{
			throw new Exception("Veículo já cadastrado.");
		}
		return $placa;
	}

	/**
	 * Validação de CNh
	 * @param unknown_type $cnh
	 */
	public function validaCnhIgual($ncnh)
	{
		$qdao = new QDAO();		
		$cnh = new Cnh();
		$cnh->setNumeroCnh($ncnh);
		$collVo = $qdao->findCnh($cnh);
		if(!is_null($collVo))
		{
			throw new Exception("CNH já cadastrada.");
		}
		return $ncnh;
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
			if($logon->getNivelAcessoLogin() == 5)
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
			elseif($logon->getIdClientes() != null)
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
			if($logon->getNivelAcessoLogin() == 5)
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
			elseif($logon->getIdClientes() != null)
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
			if($logon->getNivelAcessoLogin() == 5)
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
			elseif($logon->getIdClientes() != null)
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
			if($logon->getNivelAcessoLogin() == 5)
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
			elseif($logon->getIdClientes() != null)
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
			if($logon->getNivelAcessoLogin() == 5)
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
			elseif($logon->getIdClientes() != null)
			{
				$veiculos = new Veiculos();
				$veiculos->setIdClientes($logon->getIdClientes());
				$collVoVeiculos = $this->findVeiculos($veiculos);
				if(!is_null($collVoVeiculos))
				{
					foreach ($collVoVeiculos as $arrayVeiculos)
					{
						$veiculos = $arrayVeiculos;
						if(!is_null($veiculos->getTempoGarantiaNfVeiculos()) && !is_null($veiculos->getDataNfVeiculos())
						&& $veiculos->getTempoGarantiaNfVeiculos() != '')
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
			if($logon->getNivelAcessoLogin() == 5)
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
			elseif($logon->getIdClientes() != null)
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
				
				$logon = new Logon();
				$logon->setIdClientes($clientes->getIdClientes());
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
				
				$collVoPessoa = new ArrayObject();
				$collVoCnh = new ArrayObject();
				$collVoIpva = new ArrayObject();
				$collVoSeguro = new ArrayObject();
				$collVoGarantias = new ArrayObject();
				$collVoRevisoes = new ArrayObject();
				
				$dataAniv = explode("-",$data);
				$dataAniv = "0-{$dataAniv[1]}-{$dataAniv[2]}";
				$collVoPessoa = $this->listarAniversariosClientes($logon,$dataAniv);
				$collVoCnh = $this->listaCnhVencida($logon,$data);
				$collVoIpva = $this->listaIpvaVencidos($logon,$data);
				$collVoSeguro = $this->listaSeguroVencidos($logon,$data);
				$collVoGarantias = $this->ListaGarantiasVenc($logon,$data);
				$collVoRevisoes = $this->listaRevisoes($logon,$data);
				
				if($collVoPessoa->count()>0 || $collVoCnh->count()>0 || $collVoIpva->count()>0 || 
				$collVoSeguro->count()>0 || $collVoGarantias->count()>0 || $collVoRevisoes->count()>0)
				{
					$descricao = "";
					$formataData = new FormataData();
					if($collVoPessoa->count()>0)
					{
						$cont = 0;
						foreach ($collVoPessoa as $pessoas)
						{
							if($cont == 0)
								$descricao .= '<label class="ativo">Aniversário do Dia</label><br><br>';
							$pessoaAtual = new Logon();
							$pessoaAtual = $pessoas;
							$descricao .= '<label class="ativo" title="'.$formataData->toViewDate($pessoaAtual->getDataNascimentoPessoa()).'">Aniversário de '.$pessoaAtual->getNomePessoa().'</label><br>';
							$cont++;
						}
						$descricao .= '<br><br>';
						$this->enviarEmail($nome,$email,"SMC - Serviço Despertador - Aviso de Aniversário",$descricao);
						$avisosGrava = new Avisos();
						$avisosGrava->setAssuntoAvisos("SMC - Serviço Despertador - Aviso de Aniversário");
						$avisosGrava->setDataAvisos(date("Y-m-d H:i:s"));
						$avisosGrava->setIdClientes($clientes->getIdClientes());
						$this->cadastrarAvisos($avisosGrava);
					}
					
					if($collVoCnh->count()>0)
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
						$avisosGrava->setDataAvisos(date("Y-m-d H:i:s"));
						$avisosGrava->setIdClientes($clientes->getIdClientes());
						$this->cadastrarAvisos($avisosGrava);
					}
					if($collVoIpva->count()>0)
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
						$avisosGrava->setDataAvisos(date("Y-m-d H:i:s"));
						$avisosGrava->setIdClientes($clientes->getIdClientes());
						$this->cadastrarAvisos($avisosGrava);
					}
					if($collVoSeguro->count()>0)
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
						$avisosGrava->setDataAvisos(date("Y-m-d H:i:s"));
						$avisosGrava->setIdClientes($clientes->getIdClientes());
						$this->cadastrarAvisos($avisosGrava);
					}
					if($collVoGarantias->count()>0)
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
						$avisosGrava->setDataAvisos(date("Y-m-d H:i:s"));
						$avisosGrava->setIdClientes($clientes->getIdClientes());
						$this->cadastrarAvisos($avisosGrava);
					}
					if($collVoRevisoes->count()>0)
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
						$avisosGrava->setDataAvisos(date("Y-m-d H:i:s"));
						$avisosGrava->setIdClientes($clientes->getIdClientes());
						$this->cadastrarAvisos($avisosGrava);
					}			
				}
			}
		}
	}
}
?>
