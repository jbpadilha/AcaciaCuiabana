<?php
require_once('ControlaFuncionalidades.php');
//POST e GET
if(isset($_GET))
{
	if(isset($_GET['acao']))
	{
		if ($_GET['acao'] == "enviaEmail")
		{
			try
			{
				$controla = new ControlaFuncionalidades();
				$endereco = new Endereco();
				if($_GET['idEndereco'] != '')
				{
					$endereco->setIdEndereco($_GET['idEndereco']);
					$collVo = $controla->findEndereco($endereco);
					$endereco = $collVo[0];
					if(!is_null($endereco->getEmailEndereco()))
					{
						$nome = '';
						if(!is_null($endereco->getIdPessoa()))
						{
							$pessoa = new Pessoa();
							$pessoa->setIdPessoa($endereco->getIdPessoa());
							$collPessoa = $controla->findPessoas($pessoa);
							$pessoa = $collPessoa[0];
							$nome = $pessoa->getNomePessoa();
						}
						elseif(!is_null($endereco->getIdEmpresa()))
						{
							$empresa = new Empresa();
							$empresa->setIdEmpresa($endereco->getIdEmpresa());
							$collempresa = $controla->findEmpresas($empresa);
							$empresa = $collempresa[0];
							$nome = $empresa->getNomeFantasiaEmpresa();
						}
						$descricao = '';
						switch ($_GET['tipo'])
						{
							case 1: 
								{
									$pessoaTipo = new Pessoa();
									$pessoaTipo->setIdPessoa($_GET['idTipo']);
									$collVoTipo = $controla->findPessoas($pessoaTipo);
									$pessoaTipo = $collVoTipo[0];
									$dataNiver = explode("-",$pessoaTipo->getDataNascimentoPessoa());
									$descricao = '
									<b>SMC - Serviço Despertador</b>
									<label class="ativo">Aniversário do Dia</label><br><br>
									Aniversário de '.$pessoaTipo->getNomePessoa().'
									Dia: '.$dataNiver[1].'/'.$dataNiver[2].'
									';
									$assunto = 'Aviso de Aniversário';
									break;
								}
							case 2: 
								{
									$cnhAtual = new Cnh();
									$cnhAtual->setIdCnh($_GET['idTipo']);
									$collVo = $controla->findCnh($cnhAtual);
									$cnhAtual = $collVo[0]; 		
									$pessoaTipo = new Pessoa();
									$pessoaTipo = $cnhAtual->returnaPessoa();
									$descricao = '
									<b>SMC - Serviço Despertador</b>
									<label class="ativo">Vencimento de CNH</label><br><br>
									CNH NÂº '.$cnhAtual->getNumeroCnh().'
									Condutor: '.$pessoaTipo->getNomePessoa().'
									Data do vencimento: '.$formataData->toViewDate($cnhAtual->getVencCnh()).'
									';
									$assunto = 'Aviso de Vencimento de CNH';
									break;
								}
							case 3: 
								{
									$veiculo = new Veiculos();
									$veiculo->setIdVeiculos($_GET['idTipo']);
									$collVo = $controla->findVeiculos($veiculo);
									$veiculo = $collVo[0]; 		
									$descricao = '
									<b>SMC - Serviço Despertador</b>
									<label class="ativo">Vencimento de IPVA</label><br><br>
									Vesãculo placa '.$veiculo->getPlacaVeiculos().'
									Data do vencimento: '.$formataData->toViewDate($veiculo->getVencimentoIpvaVeiculos()).'
									';
									$assunto = 'Aviso de Vencimento de IPVA';
									break;
								}
							case 4: 
								{
									$veiculo = new Veiculos();
									$veiculo->setIdVeiculos($_GET['idTipo']);
									$collVo = $controla->findVeiculos($veiculo);
									$veiculo = $collVo[0]; 		
									$descricao = '
									<b>SMC - Serviço Despertador</b>
									<label class="ativo">Vencimento de Seguro</label><br><br>
									Vesãculo placa '.$veiculo->getPlacaVeiculos().'
									Data do vencimento: '.$formataData->toViewDate($veiculo->getVencimentoSeguroVeiculos()).'
									';
									$assunto = 'Aviso de Vencimento de Seguro';
									break;
								}
							case 5: 
								{
									$veiculo = new Veiculos();
									$veiculo->setIdVeiculos($_GET['idTipo']);
									$collVo = $controla->findVeiculos($veiculo);
									$veiculo = $collVo[0];
									$descricao = '
									<b>SMC - Serviço Despertador</b>
									<label class="ativo">Vencimento de Garantia</label><br><br>
									Vesãculo placa '.$veiculo->getPlacaVeiculos().'
									Data do vencimento: '.$formataData->toViewDate($veiculo->getDataEntregaNfVeiculos()).'
									';
									$assunto = 'Aviso de Vencimento de Garantia';
									break;
								}
							case 6:
								{
									$revisao = new Revisoes();
									$revisao->setIdRevisoes($_GET['idTipo']);
									$collVo = $controla->findRevisoes($revisao);
									$revisao = $collVo[0];
									$veiculo = new Veiculos();
									$veiculo = $revisao->getVeiculo();
									$descricao = '
									<b>SMC - Serviço Despertador</b>
									<label class="ativo">Revisão Agendada</label><br><br>
									Vesãculo placa '.$veiculo->getPlacaVeiculos().'
									Data da Revisão: '.$formataData->toViewDate($revisao->getDataRevisoes()).'
									';
									$assunto = 'Aviso de Revisão agendada.';
									break;
								}
						}
						$controla->enviarEmail($nome,$endereco->getEmailEndereco(),"SMC - Serviço Despertador - $assunto",$descricao);
						$mensagem = 'E-mail enviado com sucesso.';
						echo $mensagem;
					}
				}
			}
			catch (Exception $e)
			{
				echo $e;
			}
		}
		
		if($_GET['acao'] == "pesquisaRevisao")
		{
			$logon = new Logon();
			$logon = $_SESSION["usuarioLogon"];
			
			$revisoes = new Revisoes();
			$revisoes->setIdVeiculos($_GET['placa']);
			$collVo = $controla->findRevisoes($revisoes);
			if(!is_null($collVo))
				$_SESSION['revisoes'] = $collVo;
			else
				$_SESSION['revisoes'] = '';
			echo "<script type=\"text/javascript\" language=\"javascript\">document.location='../painel/index.php?p=rev_confirma';</script>";
		}
	}
}
if(isset($_POST))
{
	header("Content-Type: text/html; charset=ISO-8859-1");//
	$msg = "";
	$controla = new ControlaFuncionalidades();
	$formataData = new FormataData();
	$dominio = new Dominio();
	
	if(isset($_POST['loginAdm']))
	{
		date_default_timezone_set('America/Cuiaba');
		
		if($_POST['login'] == "" || $_POST['senha'] == "")
		{
			$mensagem = "Todos os campos devem ser peenchido.";
			header("Location: ../home.php?p=login&msg=$mensagem");
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
						header("Location:../painel/index.php?p=home");
					}
					else
					{
						header("Location:../painel/aguarde.php");
					}
				}
				else 
				{
					$mensagem = "usuário ou senha incorreto.";
					header("Location: ../home.php?p=login&msg=$mensagem");
				}
			}
			catch (Exception $e)
			{
				$mensagem = $e->getMessage();
				header("Location: ../home.php?p=login&msg=$mensagem");
			}
		}
		else 
		{
			$mensagem = "Senha Incorreta ou usuário Inválido.";
			header("Location: ../login.php?msg=$mensagem");
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
					$pessoa->setNomePessoa(trim($controla->validaNomes($_POST['lnome'])));
				else
					$mensagem .= "O nome Não pode estar em branco.";
				
				if($_POST['lemail'] != '')
					$endereco->setEmailEndereco($controla->testaEmail($_POST['lemail']));
				else
					$mensagem .= "O E-mail Não pode estar em branco.";
					
				if($_POST['llogin'] != '')
				{
					$pessoa->setCpfPessoa($controla->validaCpfIgual($controla->validaCPF($controla->retiraMascaraCPF($_POST['llogin']))));
					$logon->setLogin($pessoa->getCpfPessoa());
				}
				else
				{
					$mensagem .= "O CPF Não pode estar em branco.";
				}
				
				$logon->setSenha(trim($_POST['lsenha']));
				
				if($mensagem == '')
				{
					$idPessoa = $controla->cadastraPessoa($pessoa);
					
					$endereco->setIdPessoa($idPessoa);
					$controla->cadastraEndereco($endereco);
					
					$logon->setIdPessoa($idPessoa);
					$logon->setNivelAcessoLogin(0);
					echo "teste";
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
					
					$controla->enviarEmail($pessoa->getNomePessoa(),$endereco->getEmailEndereco(),"Cadastro de novo usuário",$descricao);
					$mensagem = "Cadastro realizado com sucesso. Um e-mail foi enviado para o e-mail cadastrado.";
					header("Location: ../home.php?page=login&msg=$mensagem");
					
				}
				else
				{
					header("Location: ../home.php?page=login&acao=cadastro&msg=$mensagem");
				}
			}
			catch (Exception $e)
			{
				$mensagem .= $e->getMessage();
				echo "<script type=\"text/javascript\" language=\"javascript\">document.location='../home.php?p=login&msg=$mensagem'</script>";
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
					$pessoa->setNomePessoa($controla->validaNomes($_POST['nome_cliente']));
				else
					$mensagem .= 'O nome do Cliente Não pode estar em branco.';
					
				if($_POST['nascimento_cliente'] != '')
					$pessoa->setDataNascimentoPessoa($formataData->toDBDate($controla->validaData($_POST['nascimento_cliente'])));
				else
					$mensagem .= 'O data de nascimento do Cliente Não pode estar em branco.';
					
				$pessoa->setSexoPessoa($_POST['sexo_cliente']);
				$pessoa->setEstadoCivilPessoa($_POST['ecivil_cliente']);
				$pessoa->setComplementoPessoa($_POST['nota']);
				$pessoa->setRgPessoa($_POST['rg_cliente']);
				$pessoa->setOrgExpPessoa($_POST['orgexprg_cliente']);
				$pessoa->setUfOrgExpPessoa(strtoupper($_POST['ufexprg_cliente']));
				
				if($_POST['cpf_cliente'] != '')
					$pessoa->setCpfPessoa($_POST['cpf_cliente']);
				else
					$mensagem .= 'O CPF do Cliente Não pode estar em branco.';
				
				
				//ENDERECO
				$endereco->setIdEndereco($_POST['idEndereco']);
				$endereco->setRuaEndereco($_POST['rua_contato']);
				$endereco->setComplementoEndereco($_POST['complemento_contato']);
				$endereco->setBairroEndereco($_POST['bairro_contato']);
				$endereco->setCepEndereco($_POST['cep_contato']);
				$endereco->setCidadeEndereco($_POST['cidade_contato']);
				$endereco->setEstadoEndereco($_POST['estado_contato']);
				if($_POST['email_contato'] != '')
				{
					$endereco->setEmailEndereco($controla->testaEmail($_POST['email_contato']));
				}
				else {
					$mensagem .= "O E-mail deve ser preenchido.";
				}
				$endereco->setTelefoneEndereco($_POST['tel_contato']);
				$endereco->setCelEndereco($_POST['cel_contato']);
				$endereco->setFaxEndereco($_POST['fax_contato']);
				$endereco->setIdPessoa($pessoa->getIdPessoa());
				
				//Conjugue
				if($pessoa->getEstadoCivilPessoa() == $dominio->CASADO || $pessoa->getEstadoCivilPessoa() == $dominio->UNIAO)
				{
					$pessoaConjugue->setIdPessoa($_POST['idConjugue']);
					if($_POST['nome_conjuge'] != '')
						$pessoaConjugue->setNomePessoa($controla->validaNomes($_POST['nome_conjuge']));
					else
						$mensagem = "O nome do Conjugue Não deve estar em branco.";
					
					if($_POST['nasc_conjuge']!= '')
						$pessoaConjugue->setDataNascimentoPessoa($formataData->toDBDate($controla->validaData($_POST['nasc_conjuge'])));
					else
						$mensagem .= 'A data de nascimento do Conjugue Não pode estar em branco.';
					
					$pessoaConjugue->setSexoPessoa($_POST['sexo_conjuge']);
					
					if($_POST['cpf_conjuge'] != '')
						$pessoaConjugue->setCpfPessoa($controla->validaCpfIgual($controla->validaCPF($controla->retiraMascaraCPF($_POST['cpf_conjuge']))));
					else
						$mensagem .= "O CPF do Conjugue deve ser preenchido.";
				}
				
				if($mensagem == '')
				{
					$clientes = new Clientes();
					$clientes->setDataRegistroClientes(date("Y-m-d H:i:s"));
					$clientes->setStatusClientes(1);
					$clientes->setIdPessoa($pessoa->getIdPessoa());
					$idCliente = $controla->cadastraClientes($clientes);
					$pessoa->setIdCliente($idCliente);
					$controla->updateEndereco($endereco);
					if($pessoa->getEstadoCivilPessoa() == $dominio->CASADO || $pessoa->getEstadoCivilPessoa() == $dominio->UNIAO)
					{
						$pessoaConjugue->setIdCliente($idCliente);
						$idConjugue = $controla->cadastraPessoa($pessoaConjugue);
						$endereco->setIdPessoa($idConjugue);
						$controla->cadastraEndereco($endereco);
						$pessoa->setIdConjuguePessoa($idConjugue);
					}
					$controla->updatePessoa($pessoa);
					
					$logon = new Logon();
					$logon = $_SESSION['usuarioLogon'];
					$logon->setIdClientes($idCliente);
					$controla->updateLogon($logon);
					
					$mensagem="Usuário Criado com sucesso.";
					
					$descricao = "
					<div align='left' style='font-size:12px;'>
					Seu cadastro no site SMC - Serviço Despertador foi conclusãdo com sucesso.<br>
					Por precaução, salve este e-mail.<br><br>
					<h3>Atenção: seu <font color='red'>CPF</font> é seu login de acesso para o painel de controle para gerenciamento de cadastro.<br>
					Em breve você receberá um e-mail com a senha de acesso.<h3><br>
					<font face=\"Verdana\">
					Estes são os dados principais do seu cadastro:<br><br>
					<fieldset><legend style='text-transform:capitalize;'>".$pessoa->getNomePessoa()."</legend>
					<b>RG:</b> ".$pessoa->getRgPessoa().";<br>
					<b>CPF:</b> ".$pessoa->getCpfPessoa().";<br>
					<b>Telefone para contato:</b> ".$endereco->getTelefoneEndereco().";<br>
					<b>Celular para contato:</b> ".$endereco->getCelEndereco().";<br>
					<b>Fax para contato:</b> ".$endereco->getFaxEndereco().";<br>
					<b>Email para contato:</b> ".$endereco->getEmailEndereco().";<br>
					<br><br><br>";
					if($pessoa->getEstadoCivilPessoa() == $dominio->CASADO || $pessoa->getEstadoCivilPessoa() == $dominio->UNIAO)
					{
						$descricao .= "
						<b>DADOS DO CONJUGUE</b><br><br>
						<b>Nome:</b> {$pessoaConjugue->getNomePessoa()}<br>
						<b>Data de Nascimento:</b>  {$formataData->toViewDate($pessoaConjugue->getDataNascimentoPessoa())}<br>
						";
					}
					$descricao .= "Registrado em: ".$formataData->toViewDateTime($clientes->getDataRegistroClientes()).";<br>
					</fieldset>
					<br>
					Este é um e-mail automático.
					</div>
					";
					
					$controla->enviarEmail($pessoa->getNomePessoa(),$endereco->getEmailEndereco(),"Usuario/Cliente Cadastrado",$descricao);
					unset($_SESSION['pessoaAtual']);
					unset($_SESSION['enderecoAtual']);
					unset($_SESSION['pessoaConjugueAtual']);
					header("Location: ../home.php?msg=$mensagem");
				}
				else
				{
					$_SESSION['pessoaAtual'] = $pessoa;
					$_SESSION['enderecoAtual'] = $endereco;
					$_SESSION['pessoaConjugueAtual'] = $pessoaConjugue;
					echo "<script type=\"text/javascript\" language=\"javascript\">document.location='../painel/add_meucpf.php?msg=$mensagem'</script>";
				}
					
			}
			catch (Exception $e)
			{
				$mensagem .= $e->getMessage();
				$_SESSION['pessoaAtual'] = $pessoa;
				$_SESSION['enderecoAtual'] = $endereco;
				$_SESSION['pessoaConjugueAtual'] = $pessoaConjugue;
				echo "<script type=\"text/javascript\" language=\"javascript\">document.location='../painel/add_meucpf.php?msg=$mensagem'</script>";
			}
		}
		
		if($_POST['acao'] == "cadastroPessoa")
		{
			try 
			{
				$logon = new Logon();
				$logon = $_SESSION["usuarioLogon"];
				
				$mensagem = '';
				//CADASTRO DE PESSOA
				$pessoaAtual = new Pessoa();
				$pessoaConjugue = new Pessoa();
				$endereco = new Endereco();
				
				if($_POST['nome'] != '')
					$pessoaAtual->setNomePessoa(trim($controla->validaNomes($_POST['nome'])));
				else 
					$mensagem .= "O Nome da Pessoa Não pode estar em branco.";
				
				if($_POST['dataNascimento'] != '')
					$pessoaAtual->setDataNascimentoPessoa($formataData->toDBDate($controla->validaData($_POST['dataNascimento'])));
				else
					$mensagem .= "A data de nascimento da pessoa deve ser preenchida.";
				
				$pessoaAtual->setSexoPessoa($_POST['sexo']);
				$pessoaAtual->setEstadoCivilPessoa($_POST['ecivil_cliente']);
				
				if($_POST['rg'] != '')
				{
					$pessoaAtual->setRgPessoa(trim($_POST['rg']));
					$pessoaAtual->setOrgExpPessoa(trim($_POST['rg_orgao']));
					$pessoaAtual->setUfOrgExpPessoa(strtoupper($_POST['rg_uf']));
				}
				else
				{
					$mensagem .= "O RG da pessoa Não deve estar em branco.";
				}
				
				if($_POST['cpf'] != '')
				{
					$pessoaAtual->setCpfPessoa($controla->validaCpfIgual($controla->validaCPF($controla->retiraMascaraCPF($_POST['cpf']))));
				}
				else 
				{
					$mensagem .= "O CPF Não deve estar em branco.";
				}
				
				//CADASTRO DE ENDERECO PARA PESSOA
				
				$endereco->setRuaEndereco(trim($_POST['rua']));
				$endereco->setComplementoEndereco(trim($_POST['complemento']));
				$endereco->setBairroEndereco(trim($_POST['bairro']));
				$endereco->setCepEndereco(trim($_POST['cep']));
				$endereco->setCidadeEndereco(trim($_POST['cidade']));
				$endereco->setEstadoEndereco($_POST['estado']);
				
				if($_POST['email'] != '')
				{
					$endereco->setEmailEndereco(trim($controla->testaEmail($_POST['email'])));
				}
				else
				{
					$mensagem .= "O E-mail da Pessoa Não pode estar em branco.";
				}
				
				$endereco->setTelefoneEndereco(trim($_POST['telefone']));
				$endereco->setCelEndereco(trim($_POST['celular']));
				$endereco->setFaxEndereco(trim($_POST['fax']));
				
				
				//Cadastro do Conjugue
				
				if($pessoa->getEstadoCivilPessoa() == $dominio->CASADO || $pessoa->getEstadoCivilPessoa() == $dominio->UNIAO)
				{
					
					if($_POST['nomeConjugue'] != '')
						$pessoaConjugue->setNomePessoa(trim($controla->validaNomes($_POST['nomeConjugue'])));
					else 
						$mensagem .= "O Nome do Conjugue Não pode estar em branco.";
					
					if($_POST['dataNascimentoConjugue'] != '')
						$pessoaConjugue->setDataNascimentoPessoa($formataData->toDBDate($controla->validaData($_POST['dataNascimentoConjugue'])));
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
						$mensagem .= "O RG do Conjugue Não deve estar em branco.";
					}
					
					if($_POST['cpfConjugue'] != '')
					{
						if($_POST['cpfConjugue'] != $pessoaAtual->getCpfPessoa())
							$pessoaConjugue->setCpfPessoa($controla->validaCpfIgual($controla->validaCPF($controla->retiraMascaraCPF($_POST['cpfConjugue']))));
						else
							$mensagem = "O CPF do Conjugue deve ser diferente da Pessoa";						
					}
					else
					{
						$mensagem .= "O CPF do Conjugue Não deve estar em branco.";
					}
				}
				
				//TESTE DE ERRO e UPDATE DE CADASTRO

				if($mensagem == '')
				{
					$pessoaAtual->setIdCliente($_POST['idCliente']);

					//Cadastrando Conjugue
					if($pessoa->getEstadoCivilPessoa() == $dominio->CASADO || $pessoa->getEstadoCivilPessoa() == $dominio->UNIAO)
					{
						$pessoaConjugue->setIdCliente($_POST['idCliente']);
						$idConjugue = $controla->cadastraPessoa($pessoaConjugue);
						$endereco->setIdPessoa($idConjugue);
						$controla->cadastraEndereco($endereco);
						$pessoaAtual->setIdConjuguePessoa($idConjugue);
					}
					$idPessoa = $controla->cadastraPessoa($pessoaAtual);
					$endereco->setIdPessoa($idPessoa);
					$controla->cadastraEndereco($endereco);
					
					
					$descricao = "
					<b>DADOS DA PESSOA</b>
					{$pessoaAtual->mostraDadosPessoa()}<br>
					<br>
					<b>endereço</b>
					{$endereco->mostraDadosEndereco()}<br>
					<br>";
					if($pessoa->getEstadoCivilPessoa() == $dominio->CASADO || $pessoa->getEstadoCivilPessoa() == $dominio->UNIAO)
					{
						$descricao = "
						<b>DADOS DO CONJUGUE</b>
						";
					}
					
					$controla->enviarEmail($pessoaAtual->getNomePessoa(),$endereco->getEmailEndereco(),"Cadastro de Pessoa",$descricao);
					$mensagem = "Cadastro realizado com sucesso. Um e-mail foi enviado para o e-mail cadastrado.";
					echo "<script type=\"text/javascript\" language=\"javascript\">document.location='../painel/index.php?p=home&msg=$mensagem'</script>";
					unset($_SESSION['pessoaAtual']);
					unset($_SESSION['enderecoAtual']);
					unset($_SESSION['pessoaConjugueAtual']);
				}
				else
				{
					$_SESSION['pessoaAtual'] = $pessoaAtual;
					$_SESSION['enderecoAtual'] = $endereco;
					$_SESSION['pessoaConjugueAtual'] = $pessoaConjugue;
					echo "<script type=\"text/javascript\" language=\"javascript\">document.location='../painel/index.php?p=add_cpf&msg=$mensagem'</script>"; 
				}
			}
			catch (Exception $e)
			{
				$mensagem .= $e->getMessage();
				$_SESSION['pessoaAtual'] = $pessoaAtual;
				$_SESSION['endereco'] = $endereco;
				$_SESSION['pessoaConjugue'] = $pessoaConjugue;
				echo "<script type=\"text/javascript\" language=\"javascript\">document.location='../painel/index.php?p=add_cpf&msg=$mensagem'</script>";
			}
		}
		
		if($_POST['acao'] == "cadastroEmpresa")
		{
			try
			{
				$mensagem = '';
				$empresas = new Empresas();
				
				$cliente = new Clientes();
				$pessoaDiretor = null;
				$enderecoDiretor = null;
				$pessoaConjugue = null;
				$endereco = new Endereco();
				
				
				$cliente->setIdClientes($_POST['idCliente']);
				$collVoCliente = $controla->findClientes($cliente);
				$cliente = $collVoCliente[0];
				
				if($_POST['nome_empresa'] != '')
					$empresas->setNomeEmpresa($controla->validaNomes($_POST['nome_empresa']));
				else	
					$mensagem .= "O nome da Empresa Não deve estar em branco.";
				
				if($_POST['nome_fantasia'] != '')	
					$empresas->setNomeFantasiaEmpresa($controla->validaNomes($_POST['nome_fantasia']));
				else 	
					$mensagem .= "O nome Fantasia deve ser preenchido.";
				
				if($_POST['data_fundacao'] != '')
				{
						$empresas->setDataFundacaoEmpresa($formataData->toDBDate($controla->validaData($_POST['data_fundacao'])));
				}
				$empresas->setIdClientes($cliente->getIdClientes());

				if($_POST['cnpj'] != '')
				{
					$empresas->setCnpjEmpresa($controla->validaCnpjIgual($controla->validaCNPJ($controla->retiraMascaraCNPJ($_POST['cnpj']))));
				}
				else 
				{
					$mensagem .= "O CNPJ Não pode estar em branco.";
				}
				
				$empresas->setInscricaoEstadualEmpresa($_POST['insc']);
				$empresas->setRamoEmpresa($_POST['ramo']);
				
				//DADOS DO endereço DA EMRPESA
				
				$endereco->setRuaEndereco(trim($_POST['rua']));
				$endereco->setComplementoEndereco(trim($_POST['complemento']));
				$endereco->setBairroEndereco(trim($_POST['bairro']));
				$endereco->setCepEndereco(trim($_POST['cep']));
				$endereco->setCidadeEndereco(trim($_POST['cidade']));
				$endereco->setEstadoEndereco($_POST['estado']);
				if($_POST['email'] != '')
				{
					$endereco->setEmailEndereco(trim($controla->testaEmail($_POST['email'])));
				}
				else 
				{
					$mensagem .= "O e-mail da empresa Não pode estar em branco.";	
				}
				$endereco->setTelefoneEndereco(trim($_POST['telefone']));
				$endereco->setCelEndereco(trim($_POST['celular']));
				$endereco->setFaxEndereco(trim($_POST['fax']));
				

				//DADOS DO DIRETOR DA EMPRESA
				
				if($_POST['preenche'] != '' && $_POST['preenche'] == "Sim")
				{
					$pessoaDiretor = new Pessoa();
					
					if($_POST['nome'] != '')
						$pessoaDiretor->setNomePessoa(trim($controla->validaNomes($_POST['nome'])));
					else 
						$mensagem .= "O Nome da Pessoa Não pode estar em branco.";
					
					if($_POST['dataNascimento'] != '')
						$pessoaDiretor->setDataNascimentoPessoa($formataData->toDBDate($controla->validaData($_POST['dataNascimento'])));
					else
						$mensagem .= "A data de nascimento da pessoa deve ser preenchida.";
					
					$pessoaDiretor->setSexoPessoa($_POST['sexo']);
					$pessoaDiretor->setEstadoCivilPessoa($_POST['ecivil_cliente']);
					
					if($_POST['rg'] != '')
					{
						$pessoaDiretor->setRgPessoa(trim($_POST['rg']));
						$pessoaDiretor->setOrgExpPessoa(trim($_POST['rg_orgao']));
						$pessoaDiretor->setUfOrgExpPessoa(strtoupper($_POST['rg_uf']));
					}
					else
					{
						$mensagem .= "O RG da pessoa Não deve estar em branco.";
					}
					
					if($_POST['cpf'] != '')
					{
						$pessoaDiretor->setCpfPessoa($controla->validaCpfIgual($controla->validaCPF($controla->retiraMascaraCPF($_POST['cpf']))));
					}
					else
					{
						$mensagem .= "O CPF Não deve estar em branco.";
					}
					
					//endereço DIRETOR DA EMPRESA
					$enderecoDiretor = new Endereco();
					$enderecoDiretor->setRuaEndereco(trim($_POST['ruaDiretor']));
					$enderecoDiretor->setComplementoEndereco(trim($_POST['complementoDiretor']));
					$enderecoDiretor->setBairroEndereco(trim($_POST['bairroDiretor']));
					$enderecoDiretor->setCepEndereco(trim($_POST['cepDiretor']));
					$enderecoDiretor->setCidadeEndereco(trim($_POST['cidadeDiretor']));
					$enderecoDiretor->setEstadoEndereco($_POST['estadoDiretor']);
					if($_POST['email'] != '')
					{
						$enderecoDiretor->setEmailEndereco(trim($controla->testaEmail($_POST['email'])));
					}
					else
					{
						$mensagem .= "O e-mail do Diretor deve ser preenchido"; 
					}	
					$enderecoDiretor->setTelefoneEndereco(trim($_POST['telefoneDiretor']));
					$enderecoDiretor->setCelEndereco(trim($_POST['celularDiretor']));
					$enderecoDiretor->setFaxEndereco(trim($_POST['faxDiretor']));
					
					
					//DADOS CONJUGUE DIRETOR
					
					if($pessoa->getEstadoCivilPessoa() == $dominio->CASADO || $pessoa->getEstadoCivilPessoa() == $dominio->UNIAO)
					{
						$pessoaConjugue = new Pessoa();
						if($_POST['nomeConjugue'] != '')
							$pessoaConjugue->setNomePessoa(trim($controla->validaNomes($_POST['nomeConjugue'])));
						else 
							$mensagem .= "O Nome do Conjugue Não pode estar em branco.";
						
						if($_POST['dataNascimentoConjugue'] != '')
							$pessoaConjugue->setDataNascimentoPessoa($formataData->toDBDate($controla->validaData($_POST['dataNascimentoConjugue'])));
						else
							$mensagem .= "A data de nascimento do Conjugue deve ser preenchida.";
						
						$pessoaConjugue->setSexoPessoa($_POST['sexoConjugue']);
						$pessoaConjugue->setEstadoCivilPessoa($_POST['estadoCivil']);
						
						if($_POST['rgConjugue'] != '')
						{
							$pessoaConjugue->setRgPessoa(trim($_POST['rgConjugue']));
							$pessoaConjugue->setOrgExpPessoa(trim($_POST['rg_orgaoConjugue']));
							$pessoaConjugue->setUfOrgExpPessoa(strtoupper($_POST['rg_ufConjugue']));
						}
						else
						{
							$mensagem .= "O RG do Conjugue Não deve estar em branco.";
						}
						
						if($_POST['cpfConjugue'] != '')
							$pessoaConjugue->setCpfPessoa($controla->validaCpfIgual($controla->validaCPF($controla->retiraMascaraCPF($_POST['cpfConjugue']))));
						else
							$mensagem .= "O CPF do Conjugue Não deve estar em branco.";
					}
				}
				
				//TESTE E CADASTRO
				if($mensagem == '')
				{
					if(!is_null($pessoaDiretor))
					{
						//Cadastrando Conjugue
						$idPessoaConjugue = null;
						if($pessoa->getEstadoCivilPessoa() == $dominio->CASADO || $pessoa->getEstadoCivilPessoa() == $dominio->UNIAO)
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
					
					$descricao = "
					<b>DADOS DA Empresa</b>
					{$empresas->mostraDados()}<br>
					<br>
					<b>endereço</b>
					{$endereco->mostraDadosEndereco()}<br>
					<br>";
					if($pessoa->getEstadoCivilPessoa() == $dominio->CASADO || $pessoa->getEstadoCivilPessoa() == $dominio->UNIAO)
					{
						$descricao = "
						<b>DADOS DO CONJUGUE</b>
						";
					}
					
					$controla->enviarEmail($empresas->getNomeEmpresa(),$endereco->getEmailEndereco(),"Cadastro de Empresa",$descricao);
					$mensagem = "Cadastro realizado com sucesso. Um e-mail foi enviado para o e-mail cadastrado.";
					echo "<script type=\"text/javascript\" language=\"javascript\">document.location='../painel/index.php?p=home&msg=$mensagem'</script>";
					unset($_SESSION['empresaAtual']);
					unset($_SESSION['enderecoEmpresaAtual']);
					unset($_SESSION['pessoaDiretorAtual']);
					unset($_SESSION['enderecoDiretorAtual']);
					unset($_SESSION['pessoaDiretorConjugueAtual']);
				}
				else 
				{
					$_SESSION['empresaAtual'] = $empresas;
					$_SESSION['enderecoEmpresaAtual'] = $endereco;
					$_SESSION['pessoaDiretorAtual'] = $pessoaDiretor;
					$_SESSION['enderecoDiretorAtual'] = $enderecoDiretor;
					$_SESSION['pessoaDiretorConjugueAtual'] = $pessoaConjugue;
					echo "<script type=\"text/javascript\" language=\"javascript\">document.location='../painel/index.php?p=add_cnpj&msg=$mensagem'</script>";
				}
			}
			catch (Exception $e)
			{
				$_SESSION['empresaAtual'] = $empresas;
				$_SESSION['enderecoEmpresaAtual'] = $endereco;
				$_SESSION['pessoaDiretorAtual'] = $pessoaDiretor;
				$_SESSION['enderecoDiretorAtual'] = $enderecoDiretor;
				$_SESSION['pessoaDiretorConjugueAtual'] = $pessoaConjugue;
				echo "<script type=\"text/javascript\" language=\"javascript\">document.location='../painel/index.php?p=add_cnpj&msg=$mensagem'</script>";
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
				{
					$veiculos->setPlacaVeiculos($controla->validaVeiculoIgual($_POST['placa']));
				}
				else
				{
					$mensagem .= "A placa do Veículo deve ser informada";
				}
				
				$veiculos->setMarcaVeiculos($_POST['marca']);
				$veiculos->setModeloVeiculos($_POST['modelo']);
				$veiculos->setCorVeiculos($_POST['cor']);
				$veiculos->setCombustivelVeiculos($_POST['combustivel']);
				$veiculos->setCapacidadeTanqueVeiculos($_POST['capacidade']);
				$veiculos->setAnoFabricacaoVeiculos($_POST['anofab']);
				if($_POST['tipo_veiculo']!='')
					$veiculos->setTipoVeiculos($_POST['tipo_veiculo']);
					
				$veiculos->setRenavamVeiculos($_POST['renavam']);
				$veiculos->setChassiVeiculos($_POST['chassi']);
				$veiculos->setCodFipeVeiculos($_POST['codigo_fipe']);
				$veiculos->setFornecedorNfVeiculos($_POST['fornecedor_nf']);
				$veiculos->setCidadeNfVeiculos($_POST['cidade_nf']);
				$veiculos->setEstadoNfVeiculos($_POST['estado_nf']);
				if($_POST['proprietario_nf'] != '')
					$veiculos->setProprietarioNfVeiculos($_POST['proprietario_nf']);
				else
					$mensagem .= "É necessário informar o Proprietátio do Veículo.";
				if($_POST['arrendatario_nf'] != '')
				{
					$veiculos->setArrendatarioNfVeiculos($_POST['arrendatario_nf']);
				}
				$veiculos->setPlacaNfVeiculos($_POST['placa_nf']);
				$veiculos->setNumeroNfVeiculos($_POST['numero_nf']);
				if($_POST['data_nf'] != '')
				{
					$veiculos->setDataNfVeiculos($formataData->toDBDate($controla->validaData($_POST['data_nf'])));
				}
				if($_POST['data_entrega_nf'] != '')
				{
					$veiculos->setDataEntregaNfVeiculos($formataData->toDBDate($controla->validaData($_POST['data_entrega_nf'])));
				}
				else
				{
					$mensagem .= "A data de entrega deve ser preenchida.";
				}
				$veiculos->setKmEntregaNfVeiculos($_POST['km_entrega_nf']);
				
				if($_POST['tempo_garantia'] != '')
					$veiculos->setTempoGarantiaNfVeiculos($_POST['tempo_garantia']);
					
				$veiculos->setKmGarantiaVeiculos($_POST['km_garantia']);
				
				if($_POST['vencimento_seguro']!= '')
				{
					$veiculos->setVencimentoSeguroVeiculos($formataData->toDBDate($controla->validaData($_POST['vencimento_seguro'])));
				}
				if($mensagem == '')
				{
					$controla->cadastraVeiculos($veiculos);
					$mensagem = 'Veículo Cadastrado com sucesso.';
					
					unset($_SESSION['veiculoAtual']);
					echo "<script type=\"text/javascript\" language=\"javascript\">document.location='../painel/index.php?p=home&msg=$mensagem'</script>";
					
				}
				else
				{
					$_SESSION['veiculoAtual'] = $veiculos;
					echo "<script type=\"text/javascript\" language=\"javascript\">document.location='../painel/index.php?p=add_veiculos&msg=$mensagem'</script>";
				}
				
			}
			catch (Exception $e)
			{
				$mensagem .= $e->getMessage();
				$_SESSION['veiculoAtual'] = $veiculos;
				echo "<script type=\"text/javascript\" language=\"javascript\">document.location='../painel/index.php?p=add_veiculos&msg=$mensagem'</script>";
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
					$cnh->setNumeroCnh(trim($controla->validaCnhIgual($_POST['cnh'])));
				else
					$mensagem .= 'você deve preencher o número da CNH.';
					
				if($_POST['cnhuf'] != '')
					$cnh->setUfCnh(trim(strtoupper($_POST['cnhuf'])));
				else
					$mensagem .= 'você deve selecionar o estado da carteira de habilitação.';
				
				if($_POST['cnhcat'] != '')
					$cnh->setCategoriaCnh(trim($_POST['cnhcat']));
				else
					$mensagem .= 'você deve informar a categoria da carteira de habilitação.';
				
				if($_POST['cnhvcto'] != '')
					$cnh->setVencCnh($formataData->toDBDate($controla->validaData($_POST['cnhvcto'])));
				else
					$mensagem .= 'você deve informar o a data do vencimento da carteira de habilitação.';

				if($mensagem == '')
				{
					$idCnh = $controla->cadastrarCnh($cnh);
					$pessoaCondutor->setDataRegistroCondutores(date("Y-m-d H:i:s"));
					$pessoaCondutor->setIdCnh($idCnh);
					$controla->cadastrarCondutores($pessoaCondutor);
					$mensagem = 'Condutor cadastrado com sucesso.';
					echo "<script type=\"text/javascript\" language=\"javascript\">document.location='../painel/index.php?p=home&msg=$mensagem'</script>";
					unset($_SESSION['condutoresAtual']);
					unset($_SESSION['cnhAtual']);
				}
				else
				{
					$_SESSION['condutoresAtual'] = $pessoaCondutor;
					$_SESSION['cnhAtual'] = $cnh;
					echo "<script type=\"text/javascript\" language=\"javascript\">document.location='../painel/index.php?p=add_motorista&msg=$mensagem'</script>";
				}				
			}
			catch (Exception $e)
			{
				$mensagem .= $e->getMessage();
				$_SESSION['condutoresAtual'] = $pessoaCondutor;
				$_SESSION['cnhAtual'] = $cnh;
				echo "<script type=\"text/javascript\" language=\"javascript\">document.location='../painel/index.php?p=add_motorista&msg=$mensagem'</script>";
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
					$mensagem .= 'A descrição do tipo de RevisÃµes Não deve estar em branco.';
				
				if($mensagem == '')
				{
					$controla->cadastrarTipoRevisoes($tipoRevisoes);
					$mensagem = 'Tipo de Revisão cadastrado com sucesso.';
					echo "<script type=\"text/javascript\" language=\"javascript\">document.location='../painel/index.php?p=home&msg=$mensagem'</script>";
					unset($_SESSION['tipoRevisoes']);
				}	
				else
				{
					$_SESSION['tipoRevisoes'] = $tipoRevisoes; 
					echo "<script type=\"text/javascript\" language=\"javascript\">document.location='../painel/index.php?p=add_tipo_rev&msg=$mensagem'</script>";
				}	
			}
			catch (Exception $e)
			{
				$mensagem .= $e->getMessage();
				$_SESSION['tipoRevisoes'] = $tipoRevisoes;
				echo "<script type=\"text/javascript\" language=\"javascript\">document.location='../painel/index.php?p=add_tipo_rev&msg=$mensagem'</script>";
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
					$mensagem .= 'Um Veículo deve ser selecionado.';
				
				if($_POST['revisao'] != '')
					$revisoes->setIdTipoRevisoes($_POST['revisao']);
				else
					$mensagem .= 'O tipo da Revisão deve ser selecionado.';
				
				$cont = $_SESSION['contRevisoes'];	
				$valores = null;
				for($i = 0 ; $i < $cont; $i++)
				{	
					if($_POST['data'.$i] != '')
						$valores[$i][0] = $controla->validaData($_POST['data'.$i]);
					else
						$mensagem .= "A data da Revisão deve ser preenchida.";
					
					if($_POST['km'.$i] != '')
						$valores[$i][1] = $_POST['km'.$i];
						
				}
				
				if($_POST['adicionaRevisao'] == "sim")
				{
					$cont++;
					$_SESSION['contRevisoes'] = $cont;
					$valores[$cont-1][0] = '';
					$valores[$cont-1][1] = '';
					$_SESSION['valoresAtual'] = $valores;
					$_SESSION['revisoesAtual'] = $revisoes;
					echo "<script type=\"text/javascript\" language=\"javascript\">document.location='../painel/index.php?p=add_rev_padrao'</script>";
					
				}
				elseif($mensagem == '')
				{
					for($i = 0 ; $i < $cont; $i++)
					{
						$revisoes->setProxDataRevisoes($formataData->toDBDate($valores[$i][0]));
						$revisoes->setProxKmRevisoes($valores[$i][1]);
						$controla->cadastrarRevisoes($revisoes);
					}
					$mensagem = 'Revisão cadastrado com sucesso.';
					unset($_SESSION['revisoesAtual']);
					unset($_SESSION['valoresAtual']);
					unset($_SESSION['contRevisoes']);
					echo "<script type=\"text/javascript\" language=\"javascript\">document.location='../painel/index.php?p=home&msg=$mensagem'</script>";
				}
				else
				{
					$_SESSION['valoresAtual'] = $valores;
					$_SESSION['revisoesAtual'] = $revisoes;
					echo "<script type=\"text/javascript\" language=\"javascript\">document.location='../painel/index.php?p=add_rev_padrao&msg=$mensagem'</script>";
				}
				
			}
			catch (Exception $e)
			{
				$mensagem .= $e->getMessage();
				$_SESSION['valores'] = $valores;
				$_SESSION['revisoesAtual'] = $revisoes;
				echo "<script type=\"text/javascript\" language=\"javascript\">document.location='../painel/index.php?p=add_rev_padrao&msg=$mensagem'</script>";
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
					$mensagem .= 'Um Vesãculo deve ser selecionado.';
				
				if($_POST['data'] != '')
					$abastecimentos->setDataAbastecimentos($formataData->toDBDate($controla->validaData($_POST['data'])));
				else
					$mensagem = "A data do Abastecimento deve ser preenchida.";
					
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
					unset($_SESSION['abastecimentosAtual']);
					echo "<script type=\"text/javascript\" language=\"javascript\">document.location='../painel/index.php?p=home&msg=$mensagem'</script>";
				}
				else
				{
					$_SESSION['abastecimentosAtual'] = $abastecimentos;
					echo "<script type=\"text/javascript\" language=\"javascript\">document.location='../painel/index.php?p=add_abastece&msg=$mensagem'</script>";
				}
				
			}
			catch (Exception $e)
			{
				$mensagem .= $e->getMessage();
				$_SESSION['abastecimentosAtual'] = $abastecimentos;
				echo "<script type=\"text/javascript\" language=\"javascript\">document.location='../painel/index.php?p=add_abastece&msg=$mensagem'</script>";
			}
		}
		
		if($_POST['acao'] == "cadastroMaquinas")
		{
			$mensagem = '';
			try
			{
				$maquinas = new Maquinas();
				if($_POST['nome'] != '')
					$maquinas->setNomeMaquina(trim($_POST['nome']));
				else
					$mensagem .= 'O nome da máquina deve ser informado.';
				
				if($_POST['numeroSerie'] != '')
					$maquinas->setNumeroSerieMaquina(trim($_POST['numeroSerie']));
				else
					$mensagem .= 'O número de série da máquina deve ser informado.';
				$maquinas->setDataCadastro(date("Y-m-d H:i:s"));
				$maquinas->setIdCliente($_POST['idCliente']);
				$maquinas->setFabricanteMaquinas($_POST['fabricante']);
				$maquinas->setOrigemMaquinas($_POST['origem']);
				$maquinas->setOrigemPaisMaquinas($_POST['origemPais']);
				$maquinas->setModeloMaquinas($_POST['modelo']);
				$maquinas->setNumeroChassiMaquinas($_POST['numeroChassi']);
				$maquinas->setAnoFabricacaoMaquinas($_POST['anoFabricacao']);
				$maquinas->setAnoModeloMaquinas($_POST['anoModelo']);
				$maquinas->setTracaoMaquinas($_POST['tracao']);
				
				$maquinas->setCorMaquinas($_POST['cor']);
				$maquinas->setTipoCombustivelMaquinas($_POST['tipoCombustivel']);
				$maquinas->setTanqueMaximoMaquinas($_POST['tanque']);
				$maquinas->setCodIdInternoMaquinas($_POST['codIdInterno']);
				$maquinas->setAdicionaisMaquinas($_POST['adicionais']);
				$maquinas->setContadorMaquinas($_POST['contador']);
				$maquinas->setContadorVariacaoDiaMaquinas($_POST['contadorVariacaoDia']);
				$maquinas->setNfFornecedorMaquinas($_POST['fornecedor']);
				$maquinas->setNfNumeroMaquinas($_POST['numeroNF']);
				$maquinas->setNfDataCompraMaquinas($formataData->toDBDate($_POST['dataCompra']));
				
				$maquinas->setNfValorCompraMaquinas($_POST['compraValor']);
				$maquinas->setNumeroImobilizadoMaquinas($_POST['numeroImobilizado']);
				$maquinas->setDataEntregaMaquinas($formataData->toDBDate($_POST['dataEntrega']));
				$maquinas->setNfContadorEntregaMaquinas($_POST['posicaoContadorEntrega']);
				$maquinas->setTempogarantiaMaquinas($_POST['tempoGarantia']);
				$maquinas->setUnidadeGarantiaTempoMaquinas($_POST['unidadeGarantiaTempo']);
				$maquinas->setDataFimGarantiaMaquinas($formataData->toDBDate($_POST['dataFimGarantia']));
				$maquinas->setGarantiaContadorMaquinas($_POST['garantiaContador']);
				$maquinas->setUnidadeGarantiaContadorMaquinas($_POST['unidadeGarantiaContador']);
				$maquinas->setValorFinalGarantiaMaquinas($_POST['valorFinalGarantia']);
				
				$maquinas->setPossuiGarantiaExtendidaMaquinas($_POST['possuiGarantiaExtendida']);
				$maquinas->setTempoGarantia2Maquinas($_POST['tempoGarantia2']);
				$maquinas->setUnidadeGarantiaTempo2Maquinas($_POST['unidadeGarantiaTempo2']);
				$maquinas->setDataFimGarantia2Maquinas($formataData->toDBDate($_POST['dataFimGarantia2']));
				$maquinas->setGarantiaContador2Maquinas($_POST['garantiaContador2']);
				$maquinas->setUnidadeGarantiaContador2Maquinas($_POST['unidadeGarantiaContador2']);
				$maquinas->setValorFinalGarantia2Maquinas($_POST['valorFinalGarantia2']);
				$maquinas->setPossuiContratoManutencaoMaquinas($_POST['possuiContratoManutencao']);
				$maquinas->setEmpresaContratoManutencaoMaquinas($_POST['empresaContratoManutencao']);
				$maquinas->setDataInicioContratoManutencaoMaquinas($formataData->toDBDate($_POST['dataInicioContratoManutencao']));
				
				$maquinas->setDataFimContratoManutencaoMaquinas($formataData->toDBDate($_POST['dataFimContratoManutencao']));
				$maquinas->setInfoContratoManutencaoMaquinas($_POST['infoContratoManutencao']);
				$maquinas->setDataultimaLeituraMaquinas($formataData->toDBDate($_POST['dataUltimaLeitura']));
				$maquinas->setContadorUltimaLeituraMaquinas($_POST['contadorUltimaLeitura']);
				$maquinas->setAcompanhaTempoMaquinas($_POST['acompanhaTempo']);
				$maquinas->setUnidadeAcompanhaTempoMaquinas($_POST['unidadeAcompanhaTempo']);
				$maquinas->setAcompanhaContadorMaquinas($_POST['acompanhaContador']);
				$maquinas->setUnidadeAcompanhaContadorMaquinas($_POST['unidadeAcompanhaContador']);
					
				if($mensagem == '')
				{
					$controla->cadastrarMaquinas($maquinas);
					$mensagem = 'Máquina cadastrada com sucesso.';
					unset($_SESSION['maquinaAtual']);
					echo "<script type=\"text/javascript\" language=\"javascript\">document.location='../painel/index.php?p=home&msg=$mensagem'</script>";
				}
				else
				{
					$_SESSION['maquinaAtual'] = $maquinas;
					echo "<script type=\"text/javascript\" language=\"javascript\">document.location='../painel/index.php?p=add_maquinas&msg=$mensagem'</script>";
				}
				
			}
			catch (Exception $e)
			{
				$mensagem .= $e->getMessage();
				$_SESSION['maquinaAtual'] = $maquinas;
				echo "<script type=\"text/javascript\" language=\"javascript\">document.location='../painel/index.php?p=add_maquinas&msg=$mensagem'</script>";
			}
		}
		
		if($_POST['acao'] == "cadastroEquipamentos")
		{
			$mensagem = '';
			try
			{
				$equipamentos = new Equipamentos();
				$equipamentos->setDataCadastro(date("Y-m-d H:i:s"));
				$equipamentos->setIdCliente($_POST['idCliente']);
				$equipamentos->setNome($_POST['nome']);
				$equipamentos->setNumeroSerie($_POST['numeroSerie']);
				$equipamentos->setFabricante($_POST['fabricante']);
				$equipamentos->setOrigem($_POST['origem']);
				$equipamentos->setOrigemPais($_POST['origemPais']);
				$equipamentos->setModelo($_POST['modelo']);
				$equipamentos->setNumeroChassi($_POST['numeroChassi']);
				$equipamentos->setAnoFabricacao($_POST['anoFabricacao']);
				$equipamentos->setAnoModelo($_POST['anoModelo']);
				$equipamentos->setCor($_POST['cor']);
				$equipamentos->setColdIdInterno($_POST['codIdInterno']);
				$equipamentos->setTipoAlimentacao($_POST['tipoAlimentacao']);
				$equipamentos->setTipoAlimentacaoAC($_POST['tipoAlimentacaoAC']);
				$equipamentos->setTipoAlimentacaoDC($_POST['tipoAlimentacaoDC']);
				$equipamentos->setAlimentacaoOutros($_POST['tipoAlimentacaoOutros']);
				$equipamentos->setPossuiAcessorios($_POST['possuiAcessorios']);
				$equipamentos->setAcessorios($_POST['acessorios']);
				$equipamentos->setAdicionais($_POST['adicionais']);
				$equipamentos->setNfFornecedor($_POST['fornecedor']);
				$equipamentos->setNfNumero($_POST['numeroNF']);
				$equipamentos->setNfDataCompra($formataData->toDBDate($_POST['dataCompra']));
				$equipamentos->setNfValorCompra($_POST['compraValor']);
				$equipamentos->setNfDataEntrega($formataData->toDBDate($_POST['dataEntrega']));
				$equipamentos->setNumeroImobilizado($_POST['numeroImobilizado']);
				$equipamentos->setTempoGarantia($_POST['tempoGarantia']);
				$equipamentos->setUnidadeGarantiaTempo($_POST['unidadeGarantiaTempo']);
				$equipamentos->setDataFimGarantia($formataData->toDBDate($_POST['dataFimGarantia']));
				$equipamentos->setPossuiGarantiaExtendida($_POST['possuiGarantiaExtendida']);
				$equipamentos->setTempoGarantia2($_POST['tempoGarantia2']);
				$equipamentos->setUnidadeGarantiaTempo2($_POST['unidadeGarantiaTempo2']);
				$equipamentos->setDatafimGarantia2($formataData->toDBDate($_POST['dataFimGarantia2']));
				$equipamentos->setPossuiContratoManutencao($_POST['possuiContratoManutencao']);
				$equipamentos->setEmpresaContratoManutencao($_POST['empresaContratoManutencao']);
				$equipamentos->setDataInicioContratoManutencao($formataData->toDBDate($_POST['dataInicioContratoManutencao']));
				$equipamentos->setDataFimContratoManutencao($formataData->toDBDate($_POST['dataFimContratoManutencao']));
				$equipamentos->setInfoContratoManutencao($_POST['infoContratoManutencao']);
				
				if($mensagem == '')
				{
					$controla->cadastrarEquipamentos($equipamentos);
					$mensagem = 'Equipamentos cadastrado com sucesso.';
					unset($_SESSION['equipamentosAtual']);
					echo "<script type=\"text/javascript\" language=\"javascript\">document.location='../painel/index.php?p=home&msg=$mensagem'</script>";
				}
				else
				{
					$_SESSION['equipamentosAtual'] = $equipamentos;
					echo "<script type=\"text/javascript\" language=\"javascript\">document.location='../painel/index.php?p=add_equipamentos&msg=$mensagem'</script>";
				}
				
			}
			catch (Exception $e)
			{
				$mensagem .= $e->getMessage();
				$_SESSION['equipamentosAtual'] = $equipamentos;
				echo "<script type=\"text/javascript\" language=\"javascript\">document.location='../painel/index.php?p=add_equipamentos&msg=$mensagem'</script>";
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
				$logon = new Logon();
				$logon = $_SESSION['usuarioLogon'];
				if($logon->getNivelAcessoLogin() != Dominio::$ADMINISTRADOR)
				{	
					$pessoa->setIdCliente($_POST['idCliente']);
				}
				if($mensagem == '')
				{
					$collVo = $controla->findPessoas($pessoa);
					$_SESSION['pessoasPesquisadas'] = $collVo;
					if(is_null($_SESSION['pessoasPesquisadas']))
						$_SESSION['pessoasPesquisadas'] = '';
					echo "<script type=\"text/javascript\" language=\"javascript\">document.location='../painel/index.php?p=busca_cpf'</script>";
				}
				else
				{
					header("Location: ../painel/index.php?p=busca_cpf&msg=$mensagem");
				}
			}
			catch (Exception $e)
			{
				$mensagem .= $e->getMessage();
				header("Location: ../painel/index.php?p=busca_cpf&msg=$mensagem");
			}
		}
		
		if($_POST['acao'] == "alterarPessoa")
		{
			try 
			{
				$mensagem = '';
				//CADASTRO DE PESSOA
				$pessoaAtual = new Pessoa();
				$pessoaConjugue = new Pessoa();
				$endereco = new Endereco();
				$pessoaAtual->setIdPessoa($_POST['idPessoa']);
				$pessoaAtual->setIdCliente($_POST['idCliente']);
				
				if($_POST['nome'] != '')
					$pessoaAtual->setNomePessoa(trim($controla->validaNomes($_POST['nome'])));
				else 
					$mensagem .= "O Nome da Pessoa Não pode estar em branco.";
					
				if($_POST['dataNascimento'] != '')
					$pessoaAtual->setDataNascimentoPessoa($formataData->toDBDate($controla->validaData($_POST['dataNascimento'])));
				else
					$mensagem .= "A data de nascimento da pessoa deve ser preenchida.";
				if($_POST['sexo'] != '')
					$pessoaAtual->setSexoPessoa($_POST['sexo']);
				if($_POST['estadoCivil'] != '')
					$pessoaAtual->setEstadoCivilPessoa($_POST['estadoCivil']);
				
				if($_POST['rg'] != '')
				{
					$pessoaAtual->setRgPessoa(trim($_POST['rg']));
					if($_POST['rg_orgao'] != '')
						$pessoaAtual->setOrgExpPessoa(trim($_POST['rg_orgao']));
					else
						$mensagem .= "O órgão expeditor do RG deve ser informado.";
					if($_POST['rg_uf'] != '')
						$pessoaAtual->setUfOrgExpPessoa(strtoupper($_POST['rg_uf']));
					else
						$mensagem .= "A UF do RG deve ser informado.";
				}
				else
				{
					$mensagem .= "O RG da pessoa Não deve estar em branco.";
				}
				
				if($_POST['cpf'] != '')
				{
					$pessoaTeste = new Pessoa();
					$pessoaTeste->setIdPessoa($pessoaAtual->getIdPessoa());
					$collVoTeste = $controla->findPessoas($pessoaTeste);
					$pessoaTeste = $collVoTeste[0]; 
					if($pessoaTeste->getCpfPessoa() == $controla->retiraMascaraCPF($_POST['cpf']))
						$pessoaAtual->setCpfPessoa($controla->retiraMascaraCPF($_POST['cpf']));
					else
						$pessoaAtual->setCpfPessoa($controla->validaCpfIgual($controla->validaCPF($controla->retiraMascaraCPF($_POST['cpf']))));
				}
				else
				{
					$mensagem .= "O CPF Não deve estar em branco.";
				}
				
				//CADASTRO DE ENDERECO PARA PESSOA
				
				$endereco->setRuaEndereco(trim($_POST['rua']));
				$endereco->setComplementoEndereco(trim($_POST['complemento']));
				$endereco->setBairroEndereco(trim($_POST['bairro']));
				$endereco->setCepEndereco(trim($_POST['cep']));
				$endereco->setCidadeEndereco(trim($_POST['cidade']));
				$endereco->setEstadoEndereco($_POST['estado']);
				if($_POST['email'] != '')
				{
					$endereco->setEmailEndereco(trim($controla->testaEmail($_POST['email'])));
				}
				else
				{
					$mensagem .= "O E-mail da pessoa deve ser preenchido.";
				}
				$endereco->setTelefoneEndereco(trim($_POST['telefone']));
				$endereco->setCelEndereco(trim($_POST['celular']));
				$endereco->setFaxEndereco(trim($_POST['fax']));
				
				
				//Cadastro do Conjugue
				
				if($pessoaAtual->getEstadoCivilPessoa() == "Casado" || $pessoaAtual->getEstadoCivilPessoa() == "União Estável" )
				{
					$pessoaConjugue->setIdCliente($_POST['idCliente']);
					if($_POST['idPessoaConjugue'] != '')
						$pessoaConjugue->setIdPessoa($_POST['idPessoaConjugue']);
						
					if($_POST['nomeConjugue'] != '')
						$pessoaConjugue->setNomePessoa(trim($controla->validaNomes($_POST['nomeConjugue'])));
					else 
						$mensagem .= "O Nome do Conjugue Não pode estar em branco.";
					
					if($_POST['dataNascimentoConjugue'] != '')
						$pessoaConjugue->setDataNascimentoPessoa($formataData->toDBDate($controla->validaData($_POST['dataNascimentoConjugue'])));
					else
						$mensagem .= "A data de nascimento do Conjugue deve ser preenchida.";
					
					$pessoaConjugue->setSexoPessoa($_POST['sexoConjugue']);
					$pessoaConjugue->setEstadoCivilPessoa($_POST['estadoCivil']);
					
					if($_POST['rgConjugue'] != '')
					{
						$pessoaConjugue->setRgPessoa(trim($_POST['rgConjugue']));
						$pessoaConjugue->setOrgExpPessoa(trim($_POST['rg_orgaoConjugue']));
						$pessoaConjugue->setUfOrgExpPessoa(strtoupper($_POST['rg_ufConjugue']));
					}

					
					if($_POST['cpfConjugue'] != '')
					{
						if($_POST['cpfConjugue'] != $pessoaAtual->getCpfPessoa())
						{
							if(!is_null($pessoaConjugue->getIdPessoa()))
							{
								$pessoaConjugueTeste = new Pessoa();
								$pessoaConjugueTeste->setIdPessoa($pessoaConjugue->getIdPessoa());
								$collVoConjugueTeste = $controla->findPessoas($pessoaConjugueTeste);
								$pessoaConjugueTeste = $collVoConjugueTeste[0]; 
								if($pessoaConjugueTeste->getCpfPessoa() == $controla->retiraMascaraCPF($_POST['cpfConjugue']))
									$pessoaConjugue->setCpfPessoa($controla->retiraMascaraCPF($_POST['cpfConjugue']));
								else
									$pessoaConjugue->setCpfPessoa($controla->validaCpfIgual($controla->validaCPF($controla->retiraMascaraCPF($_POST['cpfConjugue']))));
							}
							else
							{
								$pessoaConjugue->setCpfPessoa($formataData->toDBDate($controla->validaCpfIgual($controla->validaCPF($controla->retiraMascaraCPF($_POST['cpfConjugue'])))));
							}
						}
						else
						{
							$mensagem .= "O CPF do Conjugue não pode ser igual a da Pessoa.";
						}
					}
					else 
					{
						$mensagem .= "O CPF do Conjugue Não deve estar em branco.";
					}
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
							$endereco->setIdPessoa($pessoaConjugue->getIdPessoa());
							$endereco->setIdEndereco($_POST['idEnderecoConjugue']);
							$controla->updateEndereco($endereco);
						}
						else
						{
							$idPessoaConjugue = $controla->cadastraPessoa($pessoaConjugue);
							$pessoaConjugue->setIdPessoa($idPessoaConjugue);
							$endereco->setIdPessoa($pessoaConjugue->getIdPessoa());
							$endereco->setIdEndereco(null);
							$controla->cadastraEndereco($endereco);
						}
						$pessoaAtual->setIdConjuguePessoa($pessoaConjugue->getIdPessoa());
					}
					//atualização de endereço
					$controla->updatePessoa($pessoaAtual);
					$endereco->setIdPessoa($pessoaAtual->getIdPessoa());
					$endereco->setIdEndereco($_POST['idEndereco']);
					$controla->updateEndereco($endereco);
					
					$descricao = "
					<b>DADOS DA PESSOA</b>
					{$pessoaAtual->mostraDadosPessoa()}<br>
					<br>
					<b>endereço</b>
					{$endereco->mostraDadosEndereco()}<br>
					<br>";
					if($pessoaAtual->getEstadoCivilPessoa() == "Casado" || $pessoaAtual->getEstadoCivilPessoa() == "União Estável" )
					{
						$descricao = "
						<b>DADOS DO CONJUGUE</b>
						";
						echo $pessoaConjugue->mostraDadosPessoa();
					}
					
					$controla->enviarEmail($pessoaAtual->getNomePessoa(),$endereco->getEmailEndereco(),"Cadastro de Pessoa",$descricao);
					$mensagem = "atualização realizado com sucesso. Um e-mail foi enviado para o e-mail cadastrado.";
					unset($_SESSION['pessoaAtual']);
					unset($_SESSION['enderecoAtual']);
					unset($_SESSION['pessoaConjugueAtual']);
					header("Location: ../painel/index.php?p=home&msg=$mensagem");
				}
				else
				{
					$_SESSION['pessoaAtual'] = $pessoaAtual;
					$_SESSION['enderecoAtual'] = $endereco;
					$_SESSION['pessoaConjugueAtual'] = $pessoaConjugue;
					echo "<script type=\"text/javascript\" language=\"javascript\">document.location='../painel/index.php?p=detalhe_cpf&msg=$mensagem'</script>";
				}
			}
			catch (Exception $e)
			{
				$mensagem .= $e->getMessage();
				$_SESSION['pessoaAtual'] = $pessoaAtual;
				$_SESSION['enderecoAtual'] = $endereco;
				$_SESSION['pessoaConjugueAtual'] = $pessoaConjugue;
				//echo "<script type=\"text/javascript\" language=\"javascript\">document.location='../painel/index.php?p=detalhe_cpf&msg=$mensagem'</script>";
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
					$mensagem = 'Para efetuar a busca, você deve entrar com um parÃ¢metro.';
				$logon = new Logon();
				$logon = (object)$_SESSION['usuarioLogon'];
				if($logon->getNivelAcessoLogin() != Dominio::$ADMINISTRADOR)
				{
					$empresas->setIdClientes($_POST['idCliente']);
				}	
					
				if($mensagem == '')
				{
					$collVo = $controla->findEmpresas($empresas);
					$_SESSION['empresasPesquisadas'] = $collVo;
					if(is_null($_SESSION['empresasPesquisadas']))
						$_SESSION['empresasPesquisadas'] = '';
					echo "<script type=\"text/javascript\" language=\"javascript\">document.location='../painel/index.php?p=busca_cnpj'</script>";	
				}
				else
				{
					header("Location: ../painel/index.php?p=busca_cnpj&msg=$mensagem");
				}
			}
			catch (Exception $e)
			{
				$mensagem .= $e->getMessage();
				header("Location: ../painel/index.php?p=busca_cnpj&msg=$mensagem");
			}
		}
		
		if($_POST['acao'] == "alterarEmpresa")
		{
			try
			{
				$mensagem = '';
				$empresas = new Empresas();
				$endereco = new Endereco();
				$cliente = new Clientes();
				$enderecoDiretor = null;
				$pessoaDiretor = null;
				$pessoaConjugue = null;
				
				$cliente->setIdClientes($_POST['idCliente']);
				$collVoCliente = $controla->findClientes($cliente);
				$cliente = $collVoCliente[0];
				
				$empresas->setIdEmpresa($_POST['idEmpresa']);
				if($_POST['nome_empresa'] != '')
					$empresas->setNomeEmpresa($controla->validaNomes($_POST['nome_empresa']));
				else
					$mensagem .= "O nome da Empresa Não permitido.";
				
				if($_POST['nome_fantasia'] != '')
					$empresas->setNomeFantasiaEmpresa($controla->validaNomes($_POST['nome_fantasia']));
				else
					$mensagem .= "O nome Fantasia Não permitido.";
				
				if($_POST['data_fundacao'] != '')
					$empresas->setDataFundacaoEmpresa($formataData->toDBDate($controla->validaData($_POST['data_fundacao'])));
				$empresas->setIdClientes($cliente->getIdClientes());

				if($_POST['cnpj'] != '')
					$empresas->setCnpjEmpresa($_POST['cnpj']);
				else
					$mensagem = "O CNPJ Não pode estar em branco";
				
				$empresas->setInscricaoEstadualEmpresa($_POST['insc']);
				$empresas->setRamoEmpresa($_POST['ramo']);
				$empresas->setOrigemEmpresa($_POST['origem']);
				
				//DADOS DO endereço DA EMRPESA
				
				$endereco->setIdEndereco($_POST['idEndereco']);
				$endereco->setRuaEndereco(trim($_POST['rua']));
				$endereco->setComplementoEndereco(trim($_POST['complemento']));
				$endereco->setBairroEndereco(trim($_POST['bairro']));
				$endereco->setCepEndereco(trim($_POST['cep']));
				$endereco->setCidadeEndereco(trim($_POST['cidade']));
				$endereco->setEstadoEndereco($_POST['estado']);
				if($_POST['email'] != '')
				{
					$endereco->setEmailEndereco(trim($controla->testaEmail($_POST['email'])));
				}
				else
				{
					$mensagem .= "O e-mail da Empresa Não pode estar em Branco.";
				}
				$endereco->setTelefoneEndereco(trim($_POST['telefone']));
				$endereco->setCelEndereco(trim($_POST['celular']));
				$endereco->setFaxEndereco(trim($_POST['fax']));
				$endereco->setIdEmpresa($empresas->getIdEmpresa());

				if($_POST['preenche'] == "Sim")
				{
					//DADOS DO DIRETOR DA EMPRESA
					
					$pessoaDiretor = new Pessoa();
					
					if($_POST['nome'] != '')
						$pessoaDiretor->setNomePessoa(trim($controla->validaNomes($_POST['nome'])));
					else 
						$mensagem .= "O Nome da Pessoa Não permitido.";
					
					if($_POST['dataNascimento'] != '')
						$pessoaDiretor->setDataNascimentoPessoa($formataData->toDBDate($controla->validaData($_POST['dataNascimento'])));
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
						$pessoaDiretor->setUfOrgExpPessoa(strtoupper($_POST['rg_uf']));
					}
					else
					{
						$mensagem .= "O RG da pessoa Não deve estar em branco.";
					}
					
					if($_POST['cpf'] != '')
						$pessoaDiretor->setCpfPessoa($controla->retiraMascaraCPF($_POST['cpf']));
					else
						$mensagem .= "O CPF Não deve estar em branco.";
					
					//endereço DIRETOR DA EMPRESA
					$enderecoDiretor = new Endereco();
					$enderecoDiretor->setRuaEndereco(trim($_POST['ruaDiretor']));
					$enderecoDiretor->setComplementoEndereco(trim($_POST['complementoDiretor']));
					$enderecoDiretor->setBairroEndereco(trim($_POST['bairroDiretor']));
					$enderecoDiretor->setCepEndereco(trim($_POST['cepDiretor']));
					$enderecoDiretor->setCidadeEndereco(trim($_POST['cidadeDiretor']));
					$enderecoDiretor->setEstadoEndereco($_POST['estadoDiretor']);
					if($_POST['email'] != '')
					{
						$enderecoDiretor->setEmailEndereco(trim($controla->testaEmail($_POST['email'])));
					}
					else
					{
						$mensagem .= "O E-mail do Diretor deve ser preenchido.";
					}
					$enderecoDiretor->setTelefoneEndereco(trim($_POST['telefoneDiretor']));
					$enderecoDiretor->setCelEndereco(trim($_POST['celularDiretor']));
					$enderecoDiretor->setFaxEndereco(trim($_POST['faxDiretor']));
					$enderecoDiretor->setIdPessoa($pessoaDiretor->getIdPessoa());
					
					//DADOS CONJUGUE DIRETOR
					$pessoaConjugue = new Pessoa();
					if($pessoaDiretor->getEstadoCivilPessoa() == "Casado" || $pessoaDiretor->getEstadoCivilPessoa() == "União Estável" )
					{
						if($_POST['nomeConjugue'] != '')
							$pessoaConjugue->setNomePessoa(trim($controla->validaNomes($_POST['nomeConjugue'])));
						else 
							$mensagem .= "O Nome do Conjugue inválido.";
						
						if($_POST['dataNascimentoConjugue'] != '')
							$pessoaConjugue->setDataNascimentoPessoa($formataData->toDBDate($controla->validaData($_POST['dataNascimentoConjugue'])));
						else
							$mensagem .= "A data de nascimento do Conjugue deve ser preenchida.";
						
						$pessoaConjugue->setIdPessoa($_POST['idConjugueDiretor']);
						$pessoaConjugue->setSexoPessoa($_POST['sexoConjugue']);
						$pessoaConjugue->setEstadoCivilPessoa($_POST['estadoCivil']);
						
						if($_POST['rgConjugue'] != '')
						{
							$pessoaConjugue->setRgPessoa(trim($_POST['rgConjugue']));
							$pessoaConjugue->setOrgExpPessoa(trim($_POST['rg_orgaoConjugue']));
							$pessoaConjugue->setUfOrgExpPessoa(strtoupper($_POST['rg_ufConjugue']));
						}
						else
						{
							$mensagem .= "O RG do Conjugue Não deve estar em branco.";
						}
						
						if($_POST['cpfConjugue'] != '')
							$pessoaConjugue->setCpfPessoa($controla->retiraMascaraCPF($_POST['cpfConjugue']));
						else
							$mensagem .= "O CPF do Conjugue Não deve estar em branco.";
					}
				}
				//TESTE E CADASTRO
				if($mensagem == '')
				{
					//atualização DO DIRETOR DA EMPRESA E ENDERECO DO DIRETOR
					if($pessoaDiretor != null)
					{
						//atualização Conjugue
						if($pessoaDiretor->getEstadoCivilPessoa() == "Casado" || $pessoaDiretor->getEstadoCivilPessoa() == "União Estável" )
						{
							$pessoaConjugue->setIdCliente($cliente->getIdClientes());
							if($_POST['idConjugueDiretor'] != '')
								$pessoaConjugue->setIdPessoa($_POST['idConjugueDiretor']);
							
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
							if($_POST['idEnderecoConjugueDiretor'] != '')
								$enderecoDiretor->setIdEndereco($_POST['idEnderecoConjugueDiretor']);
							
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

					//atualização da Empresa
					$empresas->setIdDiretor($pessoaDiretor->getIdPessoa());
					$controla->updateEmpresa($empresas);
					
					if(!is_null($endereco->getIdEndereco()) && $endereco->getIdEndereco() != '')
					{
						$controla->updateEndereco($endereco);
					}
					else
					{
						$controla->cadastraEndereco($endereco);
					}
					//atualização de endereço da Empresa
					
					$controla->updateEmpresa($empresas);
										
					//
					
					$descricao = "
					<b>DADOS DA Empresa</b><br>
					{$empresas->mostraDados()}<br>
					<br>
					<b>endereço</b><br>
					{$endereco->mostraDadosEndereco()}<br>
					<br>
					<b>DIRETOR</b><br>
					{$pessoaDiretor->mostraDadosPessoa()}<br>
					";
					
					$controla->enviarEmail($empresas->getNomeEmpresa(),$endereco->getEmailEndereco(),"Cadastro de Pessoa",$descricao);
					$mensagem = "atualização de Empresas realizado com sucesso. Um e-mail foi enviado para o e-mail cadastrado.";
					unset($_SESSION['empresaAtual']);
					unset($_SESSION['enderecoAtual']);
					unset($_SESSION['pessoaDiretorAtual']);
					unset($_SESSION['enderecoDiretorAtual']);
					unset($_SESSION['pessoaConjugueAtual']);
					header("Location: ../painel/index.php?p=home&msg=$mensagem");
				}
				else 
				{
					$_SESSION['empresaAtual'] = $empresas;
					$_SESSION['enderecoAtual'] = $endereco;
					$_SESSION['pessoaDiretorAtual'] = $pessoaDiretor;
					$_SESSION['enderecoDiretorAtual'] = $enderecoDiretor;
					$_SESSION['pessoaConjugueAtual'] = $pessoaConjugue;
					echo "<script type=\"text/javascript\" language=\"javascript\">document.location='../painel/index.php?p=detalhe_cnpj&msg=$mensagem'</script>";
				}
			}
			catch (Exception $e)
			{
				$_SESSION['empresaAtual'] = $empresas;
				$_SESSION['enderecoAtual'] = $endereco;
				$_SESSION['pessoaDiretorAtual'] = $pessoaDiretor;
				$_SESSION['enderecoDiretorAtual'] = $enderecoDiretor;
				$_SESSION['pessoaConjugueAtual'] = $pessoaConjugue;
				$mensagem .= $e->getMessage();
				echo "<script type=\"text/javascript\" language=\"javascript\">document.location='../painel/index.php?p=detalhe_cnpj&msg=$mensagem'</script>";
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
					$veiculos->setPlacaVeiculos(trim($_POST['busca']));
				}
				else
					$mensagem = 'Para efetuar a busca, você deve entrar com um parÃ¢metro.';
				$logon = new Logon();
				$logon = (object)$_SESSION['usuarioLogon'];
				if($logon->getNivelAcessoLogin() != Dominio::$ADMINISTRADOR)
				{
					$veiculos->setIdClientes($_POST['idCliente']);
				}	
				if($mensagem == '')
				{
					$collVo = $controla->findVeiculos($veiculos);

					$_SESSION['veiculosPesquisados'] = $collVo;
					
					if(is_null($_SESSION['veiculosPesquisados']))
						$_SESSION['veiculosPesquisados'] = '';
					echo "<script type=\"text/javascript\" language=\"javascript\">document.location='../painel/index.php?p=busca_veiculos'</script>";	 
				}
				else
				{
					header("Location: ../painel/index.php?p=busca_cnpj&msg=$mensagem");
				}
			}
			catch (Exception $e)
			{
				$mensagem .= $e->getMessage();
				header("Location: ../painel/index.php?p=busca_cnpj&msg=$mensagem");
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
					$mensagem .= "A placa do Vesãculo deve ser informada";
				
				//teste de Placa Igual
				$veiculoTeste = new Veiculos();
				$veiculoTeste->setIdVeiculos($veiculos->getIdVeiculos());
				$collVoVeiculoTeste = $controla->findVeiculos($veiculoTeste);
				$veiculoTeste = $collVoVeiculoTeste[0]; 	
				if($veiculoTeste->getPlacaVeiculos() != $veiculos->getPlacaVeiculos())	
					$veiculos->setPlacaVeiculos($controla->validaVeiculoIgual($_POST['placa']));
				
				$veiculos->setMarcaVeiculos($_POST['marca']);
				$veiculos->setModeloVeiculos($_POST['modelo']);
				$veiculos->setCorVeiculos($_POST['cor']);
				$veiculos->setCombustivelVeiculos($_POST['combustivel']);
				$veiculos->setCapacidadeTanqueVeiculos($_POST['capacidade']);
				$veiculos->setAnoFabricacaoVeiculos($_POST['anofab']);
				if($_POST['tipo_veiculo']!='')
					$veiculos->setTipoVeiculos($_POST['tipo_veiculo']);
					
				$veiculos->setRenavamVeiculos($_POST['renavam']);
				$veiculos->setChassiVeiculos($_POST['chassi']);
				$veiculos->setCodFipeVeiculos($_POST['codigo_fipe']);
				$veiculos->setFornecedorNfVeiculos($_POST['fornecedor_nf']);
				$veiculos->setCidadeNfVeiculos($_POST['cidade_nf']);
				$veiculos->setEstadoNfVeiculos($_POST['estado_nf']);
				if($_POST['proprietario_nf'] != '')
					$veiculos->setProprietarioNfVeiculos($_POST['proprietario_nf']);
				else
					$mensagem .= "É necessário informar o Proprietátio do Veículo.";
				if($_POST['arrendatario_nf'] != '')
				{
					$veiculos->setArrendatarioNfVeiculos($_POST['arrendatario_nf']);
				}
				$veiculos->setPlacaNfVeiculos($_POST['placa_nf']);
				$veiculos->setNumeroNfVeiculos($_POST['numero_nf']);
				if($_POST['data_nf'] != '')
				{
					$veiculos->setDataNfVeiculos($formataData->toDBDate($controla->validaData($_POST['data_nf'])));
				}
				if($_POST['data_entrega_nf'] != '')
				{
					$veiculos->setDataEntregaNfVeiculos($formataData->toDBDate($controla->validaData($_POST['data_entrega_nf'])));
				}
				else
				{
					$mensagem .= "A data de entrega deve ser preenchida.";
				}
				$veiculos->setKmEntregaNfVeiculos($_POST['km_entrega_nf']);
				
				if($_POST['tempo_garantia'] != '')
					$veiculos->setTempoGarantiaNfVeiculos($_POST['tempo_garantia']);
					
				$veiculos->setKmGarantiaVeiculos($_POST['km_garantia']);
				
				if($_POST['vencimento_seguro']!= '')
				{
					$veiculos->setVencimentoSeguroVeiculos($formataData->toDBDate($controla->validaData($_POST['vencimento_seguro'])));
				}
				
				if($mensagem == '')
				{
					$controla->updateVeiculos($veiculos);
					$mensagem = 'Veículo Alterado com sucesso.';
					unset($_SESSION['veiculos']);
					header("Location: ../painel/index.php?p=home&msg=$mensagem");
				}
				else
				{
					$_SESSION['veiculosAtual'] = $veiculos; 
					echo "<script type=\"text/javascript\" language=\"javascript\">document.location='../painel/index.php?p=detalhe_veiculo&msg=$mensagem'</script>";
				}
				
			}
			catch (Exception $e)
			{
				$mensagem .= $e->getMessage();
				$_SESSION['veiculosAtual'] = $veiculos;
				echo "<script type=\"text/javascript\" language=\"javascript\">document.location='../painel/index.php?p=detalhe_veiculo&msg=$mensagem'</script>";
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
					$mensagem = 'Para efetuar a busca, você deve entrar com um parÃ¢metro.';
					
				$logon = new Logon();
				$logon = $_SESSION['usuarioLogon'];
	
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
									if($pessoaAtual->getIdCliente() == $_POST['idCliente'] || $logon->getNivelAcessoLogin() == Dominio::$ADMINISTRADOR)
									{
										$collVo[] = $condutorPesquisa;
										
									}
								}
							}
						}
					}
					
					$_SESSION['condutoresPesquisados'] = $collVo;
					header("Location: ../painel/index.php?p=busca_condutores"); 
				}
				else
				{
					header("Location: ../painel/index.php?p=busca_cnpj&msg=$mensagem");
				}
			}
			catch (Exception $e)
			{
				$mensagem .= $e->getMessage();
				header("Location: ../painel/index.php?p=busca_cnpj&msg=$mensagem");
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
					$mensagem .= 'você deve preencher o número da CNH.';

				// Teste de Cnh Igual
				$cnhTeste = new Cnh();
				$cnhTeste->setIdCnh($_POST['idCnh']);
				$collTeste = $controla->findCnh($cnhTeste);
				$cnhTeste = $collTeste[0];
				if($cnhTeste->getNumeroCnh() != $cnh->getNumeroCnh())
					$cnh->setNumeroCnh($controla->validaCnhIgual(trim($_POST['cnh']))); 
					
					
				if($_POST['cnhuf'] != '')
					$cnh->setUfCnh(trim(strtoupper($_POST['cnhuf'])));
				else
					$mensagem .= 'você deve selecionar o estado da carteira de habilitação.';
				
				if($_POST['cnhcat'] != '')
					$cnh->setCategoriaCnh(trim($_POST['cnhcat']));
				else
					$mensagem .= 'você deve informar a categoria da carteira de habilitação.';
				
				if($_POST['cnhvcto'] != '')
					$cnh->setVencCnh($formataData->toDBDate($controla->validaData($_POST['cnhvcto'])));
				else
					$mensagem .= 'você deve informar o a data do vencimento da carteira de habilitação.';

				if($mensagem == '')
				{
					$controla->updateCnh($cnh);
					$controla->updateCondutores($pessoaCondutor);
					$mensagem = 'Condutor alterado com sucesso.';
					unset($_SESSION['condutoresAtual']);
					header("Location: ../painel/index.php?p=home&msg=$mensagem");
				}
				else
				{
					$_SESSION['CnhAtual'] = $cnh;
					$_SESSION['condutoresAtual'] = $pessoaCondutor;
					echo "<script type=\"text/javascript\" language=\"javascript\">document.location='../painel/index.php?p=detalhe_condutores&msg=$mensagem'</script>";
				}				
			}
			catch (Exception $e)
			{
				$mensagem .= $e->getMessage();
				$_SESSION['CnhAtual'] = $cnh;
				$_SESSION['condutoresAtual'] = $pessoaCondutor; 
				echo "<script type=\"text/javascript\" language=\"javascript\">document.location='../painel/index.php?p=detalhe_condutores&msg=$mensagem'</script>";
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
					$mensagem = 'Para efetuar a busca, você deve entrar com um parÃ¢metro.';
				
				$logon = new Logon();
				$logon = (object)$_SESSION['usuarioLogon'];
				if($logon->getNivelAcessoLogin() != Dominio::$ADMINISTRADOR)
				{
					$veiculos->setIdClientes($_POST["idCliente"]);
				}	
					
				if($mensagem == '')
				{
					$collVoVeiculos = $controla->findVeiculos($veiculos);
					$collVo = null;
					if(!is_null($collVoVeiculos))
					{
						$veiculos = $collVoVeiculos[0];
						$revisoes->setIdVeiculos($veiculos->getIdVeiculos());
						$collVo = $controla->findRevisoes($revisoes);
					}
					$_SESSION['revisoesPesquisados'] = $collVo;
					$_SESSION['veiculosAtual'] = $veiculos;
					
					if(is_null($_SESSION['revisoesPesquisados']))
						$_SESSION['revisoesPesquisados'] = '';
					
					header("Location: ../painel/index.php?p=busca_revisoes");
				}
				else
				{
					header("Location: ../painel/index.php?p=busca_revisoes&msg=$mensagem");
				}
			}
			catch (Exception $e)
			{
				$mensagem .= $e->getMessage();
				header("Location: ../painel/index.php?p=busca_revisoes&msg=$mensagem");
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

				if($_POST['data'] != '')
					$revisoes->setProxDataRevisoes($formataData->toDBDate($controla->validaData($_POST['data'])));
				else	
					$mensagem .= "A data da Revisão deve ser preenchida.";
					
				$revisoes->setProxKmRevisoes($_POST['km']);
				
				if($mensagem == '')
				{
					$controla->updateRevisoes($revisoes);
					$mensagem = 'Revisão alterado com sucesso.';
					unset($_SESSION['revisoesAtual']);
					header("Location: ../painel/index.php?p=home&msg=$mensagem");
				}
				else
				{					
					$_SESSION['revisoesAtual'] = $revisoes;
					echo "<script type=\"text/javascript\" language=\"javascript\">document.location='../painel/index.php?p=detalhe_revisoes&msg=$mensagem'</script>";
				}
				
			}
			catch (Exception $e)
			{
				$mensagem .= $e->getMessage();
				$_SESSION['revisoesAtual'] = $revisoes;
				echo "<script type=\"text/javascript\" language=\"javascript\">document.location='../painel/index.php?p=detalhe_revisoes&msg=$mensagem'</script>";
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
					$abastecimentos->setIdVeiculos(trim($_POST['veiculo']));
				}
				else
					$mensagem = 'Para efetuar a busca, você deve entrar com um parÃ¢metro.';
					
				if($mensagem == '')
				{
					$collVo = $controla->findAbastecimentos($abastecimentos);
					$_SESSION['abastecimentosPesquisados'] = $collVo;
					
					if(is_null($_SESSION['abastecimentosPesquisados']))
						$_SESSION['abastecimentosPesquisados'] = '';
						
					header("Location: ../painel/index.php?p=busca_abastece");
				}
				else
				{
					header("Location: ../painel/index.php?p=busca_abastece&msg=$mensagem");
				}
			}
			catch (Exception $e)
			{
				$mensagem .= $e->getMessage();
				header("Location: ../painel/index.php?p=busca_abastece&msg=$mensagem");
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
				
				if($_POST['data'] != '')
					$abastecimentos->setDataAbastecimentos($formataData->toDBDate($controla->validaData($_POST['data'])));
					
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
					unset($_SESSION['abastecimentosAtual']);
					header("Location: ../painel/index.php?p=home&msg=$mensagem");
				}
				else
				{
					$_SESSION['abastecimentosAtual'] = $abastecimentos;
					echo "<script type=\"text/javascript\" language=\"javascript\">document.location='../painel/index.php?p=detalhe_abastecimentos&msg=$mensagem'</script>";
				}
				
			}
			catch (Exception $e)
			{
				$mensagem .= $e->getMessage();
				$_SESSION['abastecimentosAtual'] = $abastecimentos;
				echo "<script type=\"text/javascript\" language=\"javascript\">document.location='../painel/index.php?p=detalhe_abastecimentos&msg=$mensagem'</script>";
			}
		}
		
		if($_POST['acao'] == "confirmarRevisao")
		{
			$mensagem = '';
			try
			{
				$revisao = new Revisoes();
				$revisao->setIdRevisoes($_POST['idRevisao']);
				
				$collVo = $controla->findRevisoes($revisao);
				$revisao = $collVo[0];
				
				if(!is_null($_POST['data']))
					$revisao->setDataRevisoes($formataData->toDBDate($controla->validaData($_POST['data'])));
				else
					$mensagem .= 'A data da Revisão deve ser informada.';
				if(!is_null($_POST['km']))
					$revisao->setKmRevisoes($_POST['km']);
				else
					$mensagem .= 'O Km da revisão deve ser informada.';
				
				if($mensagem == '')
				{
					
					$controla->updateRevisoes($revisao);
					unset($_SESSION['revisoes']);
					$mensagem = 'A revisão foi confirmada.';
					header("Location: ../painel/index.php?p=home&msg=$mensagem");
				}
				else
				{
					echo "<script type=\"text/javascript\" language=\"javascript\">document.location='../painel/index.php?p=rev_confirma&msg=$mensagem'</script>";
				}
			}
			catch (Exception $e)
			{
				$mensagem .= $e->getMessage();
				echo "<script type=\"text/javascript\" language=\"javascript\">document.location='../painel/index.php?p=rev_confirma&msg=$mensagem'</script>";
			}
		}
	}
	
}
?>
