<?php
//####################################
// * João Batista Padilha e Silva Analista/Desenvolvedor (Ábaco Tecnologia)
// * Arquivo: ControlaPostGet.php
// * Criação: João Batista Padilha e Silva
// * Revisão:
// * Data de criação: 07/07/2008
//####################################

require_once("../config.php");

/**
 * Métodos $_GET
 * @author João Batista Padilha e Silva
 */
if(count($_GET) > 0)
{
	if(isset($_GET['pagina']))
	{
		switch ($_GET['pagina'])
		{
			case "cadastraAnexoPedido":
			{
				$controlaPedidos = new Controla_Pedidos();
				$controlaPedidos->cadastrarAnexoPedido();
				break;
			}
		}
	}
}

/**
 * Métodos $_POST
 * @author João Batista Padilha e Silva
 */
if(count($_POST) > 0)
{
	
	if(!empty($_POST['pagina']))
	{
		switch ($_POST['pagina'])
		{
			
			// LOGIN DO SISTEMA
			case "loginSistema":
			{
				$usuariosVo = new UsuariosVo();
				$usuariosVo->setloginUsuarios(strip_tags($_POST['login']));
				$usuariosVo->setSenhaUsuarios(strip_tags($_POST['senha']));
				$controlaUsuarios = new Controla_Usuarios(); //Instancia o Objeto dessa Classe
				$controlaUsuarios->pesquisaLoginUsuarios($usuariosVo);
				break;
			}
			//
			// Lembrar senha do Usuário
			case "lembrarSenha":
			{
				$usuariosVo = new UsuariosVo();
				$usuariosVo->setloginUsuarios($_POST['Login']);
				$controlaUsuarios = new Controla_Usuarios(); //Instancia o Objeto dessa Classe
				$controlaUsuarios->lembrarSenhaUsuarios($usuariosVo);	
				break;
			}
			//Pesquisar Usuários
			case "pesquisaUsuario":
			{
				$usuariosVo = new UsuariosVo();
				$usuariosVo->setNomeUsuarios(strip_tags(rawurldecode($_POST['nomeUsuarios'])));
				$usuariosVo->setFlagSuspenso(strip_tags($_POST['flagSuspenso']));
				$controlaUsuarios = new Controla_Usuarios();
				$controlaUsuarios->mostraUsuariosPesquisa($usuariosVo);
				break;
			}
			//Cadastro de Usuários
			case "cadastraUsuario":
			{
				$usuariosVo = new UsuariosVo();
				
				$idUsuarios = strip_tags(rawurldecode($_POST['idUsuarios']));
				settype($idUsuarios,"integer");
				
				$usuariosVo->setIdUsuarios($idUsuarios);
				$usuariosVo->setNomeUsuarios(strip_tags(rawurldecode($_POST['nomeUsuarios'])));
				$usuariosVo->setEnderecoUsuarios(strip_tags(rawurldecode($_POST['enderecoUsuarios'])));
				$usuariosVo->setCepUsuarios(eregi_replace("[^0-9]","",rawurldecode($_POST['cepUsuarios'])));
				$usuariosVo->setCidadeUsuarios(strip_tags(rawurldecode($_POST['cidadeUsuarios'])));
				$usuariosVo->setEmailUsuarios(strip_tags(rawurldecode($_POST['emailUsuarios'])));
				$usuariosVo->setTelUsuarios(eregi_replace("[^0-9]","",rawurldecode($_POST['telUsuarios'])));
				$usuariosVo->setTelCelUsuarios(eregi_replace("[^0-9]","",rawurldecode($_POST['telCelUsuarios'])));
				if($_POST['dataNascimentoUsuarios'] != '')
					$usuariosVo->setDataNascimentoUsuarios($converte->toDBDate($_POST['dataNascimentoUsuarios']));
				$usuariosVo->setloginUsuarios(strip_tags(rawurldecode($_POST['loginUsuarios'])));
				if(isset($_POST['senhaUsuarios']))
					$usuariosVo->setSenhaUsuarios(strip_tags(rawurldecode($_POST['senhaUsuarios'])));
				$usuariosVo->setFlagSuspenso(rawurldecode(strip_tags($_POST['flagSuspenso'])));
				$usuariosVo->setFlagTipoUsuario(rawurldecode(strip_tags($_POST['flagTipoUsuario'])));
				
				$controlaUsuarios = new Controla_Usuarios();
				$controlaUsuarios->cadastrarUsuarios($usuariosVo);
				break;
			}
			
			//alterar senha
			case "alteraSenhaUsuario":
			{
				$usuariosVo = new UsuariosVo();
				
				$idUsuarios = strip_tags(rawurldecode($_POST['idUsuarios']));
				settype($idUsuarios,"integer");
				$usuariosVo->setSenhaUsuarios(strip_tags(rawurldecode($_POST['senhaUsuarios'])));
				$usuariosVo->setIdUsuarios($idUsuarios);
				
				$controlaUsuarios = new Controla_Usuarios();
				$controlaUsuarios->alteraSenhaUsuarios($usuariosVo);
				break;
			}
			// Pesquisar Papeis
			case "pesquisaPapeis":
			{
				$papeisVo = new PapeisVo();
				$papeisVo->setNomePapeis(rawurldecode(strip_tags($_POST['nomePapeis'])));
				$controlaPapeis = new Controla_Papeis();
				$controlaPapeis->mostraPapeisPesquisa($papeisVo);
				break;
			}
			
			// Cadastrar/Alterar Papeis
			case "cadastraPapeis":
			{
				$papeisVo = new PapeisVo();
				$papeisVo->setNomePapeis(rawurldecode(strip_tags($_POST['nomePapeis'])));
				$idPapeis = strip_tags(rawurldecode($_POST['idPapeis']));
				settype($idPapeis, "integer");
				$papeisVo->setIdPapeis($idPapeis);
				$controlaPapeis = new Controla_Papeis();
				$controlaPapeis->cadastrarPapeis($papeisVo);
				break;
			}
			
			// Cadastrar / Alterar Funcionalidades
			case "cadastraFuncionalidades":
			{
				$funcionalidadesVo = new FuncionalidadesVo();
				$funcionalidadesVo->setNomeFuncionalidades(rawurldecode(strip_tags($_POST['nomeFuncionalidades'])));
				$funcionalidadesVo->setLinkFuncionalidades(rawurldecode(strip_tags($_POST['linkFuncionalidades'])));
				$funcionalidadesVo->setIdFuncionalidades(rawurldecode(strip_tags($_POST['idFuncionalidades'])));
				$funcionalidadesVo->setPrecedenteFuncionalidades(rawurldecode(strip_tags($_POST['precedenteFuncionalidades'])));
				$funcionalidadesVo->setDomnTipoFuncionalidades(strip_tags(rawurldecode($_POST['tipoFuncionalidades'])));
				
				$controlaFuncionalidades = new Controla_Funcionalidades();
				$controlaFuncionalidades->cadastraFuncionalidade($funcionalidadesVo);
				break;
			}
			// Pesquisar Funcionalidades
			case "pesquisarFuncionalidades":
			{
				$funcionalidadesVo = new FuncionalidadesVo();
				$funcionalidadesVo->setNomeFuncionalidades(rawurldecode(strip_tags($_POST['nomeFuncionalidades'])));
				$controlaFuncionalidades = new Controla_Funcionalidades();
				$controlaFuncionalidades->mostraFuncionalidadesPesquisa($funcionalidadesVo);
				break;
			}
			
			//Pesquisar Módulos
			case "pesquisaModulos":
			{
				$modulosVo = new ModulosVo();
				$modulosVo->setNomeModulos(rawurldecode(strip_tags($_POST['nomeModulo'])));
				$controla_Modulos = new Controla_Modulos();
				$controla_Modulos->mostraPesquisaModulos($modulosVo);
				break;
			}
			
			//Cadastrar Módulos
			case "cadastrarModulos":
			{
				$modulosVo = new ModulosVo();
				$modulosVo->setNomeModulos(rawurldecode(strip_tags($_POST['nomeModulo'])));
				$modulosVo->setIdModulos(rawurldecode(strip_tags($_POST['idModulos'])));
				$controla_Modulos = new Controla_Modulos();
				$controla_Modulos->cadastrarModulos($modulosVo);
				break;
			}
			
			//Pesquisar SubMódulos
			case "pesquisaSubModulos":
			{
				$subModulosVo = new SubModulosVo();
				$subModulosVo->setNomeSubModulos(rawurldecode(strip_tags($_POST['nomeSubModulos'])));
				$controlaSubModulos = new Controla_SubModulos();
				$controlaSubModulos->mostraListaSubModulos($subModulosVo);
				break;
			}
			
			//cadastrar SubMódulos
			case "cadastraSubModulos":
			{
				$subModulosVo = new SubModulosVo();
				$idSubModulos = strip_tags(rawurldecode($_POST['idSubModulos']));
				settype($idSubModulos,"integer");
				
				$subModulosVo->setIdSubModulos($idSubModulos);
				$subModulosVo->setNomeSubModulos(strip_tags(rawurldecode($_POST['nomeSubModulos'])));
				
				$controlaSubModulos = new Controla_SubModulos();
				
				$controlaSubModulos->cadastrarSubModulos($subModulosVo);
				break;
			}
			
			//Pesquisar Clientes
			case "pesquisaClientes":
			{
				$clientesVo = new ClientesVo();
				$clientesVo->setNomeClientes(strip_tags(rawurldecode($_POST['nomeClientes'])));
				$controlaClientes = new Controla_Clientes();
				$controlaClientes->mostraListaClientes($clientesVo);
				break;
			}
			
			//Cadastrar Clientes
			case "cadastraClientes":
			{
				$clientesVo = new ClientesVo();
				$idClientes = strip_tags(rawurldecode($_POST['idClientes']));
				settype($idClientes,"integer");
				
				$clientesVo->setIdClientes($idClientes);
				$clientesVo->setNomeClientes(strip_tags(rawurldecode($_POST['nomeClientes'])));
				
				$controlaClientes = new Controla_Clientes();
				$controlaClientes->cadastrarClientes($clientesVo);
				break;
			}
			
			//Cadastrar Tabela Basica
			case "cadastraTabelaBasica":
			{
				$tabelaBasicaVo = new TabelaBasicaVo();
				$tabelaBasicaVo->setEmailPadraoTabelaBasica(rawurldecode(strip_tags($_POST['emailPadraoTabelaBasica'])));
				$tabelaBasicaVo->setNomeRemetenteTabelaBasica(rawurldecode($_POST['remetentePadraoTabelaBasica']));
				$tabelaBasicaVo->setToleranciaHoraConformidade(rawurldecode($_POST['toleranciaTabelaBasica']));
				$tabelaBasicaVo->setIdTabelaBasica(rawurldecode(strip_tags($_POST['idTabelaBasica'])));
				
				$tabelaBasicaVo->setHorasBaseTrabalhadasTabelaBasica(rawurldecode(strip_tags($_POST['horasBaseTrabalhadasTabelaBasica'])));
				$tabelaBasicaVo->setHorasNaoTrabalhadasBaseTabelaBasica(rawurldecode(strip_tags($_POST['horasNaoTrabalhadasBaseTabelaBasica'])));
				$tabelaBasicaVo->setHorasInicioTrabalhoTabelaBasica(rawurldecode(strip_tags($_POST['horasInicioTrabalhoTabelaBasica'])));
				$tabelaBasicaVo->setHorasFimTrabalhoTabelaBasica(rawurldecode(strip_tags($_POST['horasFimTrabalhoTabelaBasica'])));
				$tabelaBasicaVo->setHorasIntervaloInicioTabelaBasica(rawurldecode(strip_tags($_POST['horasIntervaloInicioTabelaBasica'])));
				$tabelaBasicaVo->setHorasIntervaloFimTabelaBasica(rawurldecode(strip_tags($_POST['horasIntervaloFimTabelaBasica'])));
				$tabelaBasicaVo->setHorasBaseRecebimentoPedido(rawurldecode(strip_tags($_POST['horasBaseRecebimentoPedido'])));
				
				$controlaTabelaBasica = new Controla_TabelaBasica();
				$controlaTabelaBasica->cadastraTabelaBasica($tabelaBasicaVo);
				break;
			}
			
			//Pesquisar Tecnologias
			case "pesquisaTecnologias":
			{
				$tecnologiasVo = new TecnologiasVo();
				$tecnologiasVo->setNomeTecnologias(rawurldecode(strip_tags($_POST['nomeTecnologias'])));
				$controlaTecnologias = new Controla_Tecnologias();
				$controlaTecnologias->mostraTecnologiasPesquisa($tecnologiasVo);
				break;
			}
			
			//Cadastrar Tecnologias
			case "cadastraTecnologias":
			{
				$tecnologiasVo = new TecnologiasVo();
				$tecnologiasVo->setIdTecnologias(rawurldecode(strip_tags($_POST['idTecnologias'])));			
				$tecnologiasVo->setNomeTecnologias(rawurldecode(strip_tags($_POST['nomeTecnologias'])));
				
				$controlaTecnologias = new Controla_Tecnologias();
				$controlaTecnologias->cadastraTecnologia($tecnologiasVo);
				break;
			}
			
			//Pesquisar Versões
			case "pesquisaVersoes":
			{
				$versoesVo = new VersoesVo();
				$versoesVo->setNomeVersoes(rawurldecode(strip_tags($_POST['nomeVersoes'])));
				$versoesVo->setDataEntregaVersoes(rawurldecode($_POST['dataVersoes']));
				$versoesVo->setDataEntregaVersoesClientes(strip_tags(rawurldecode($_POST['dataVersoesClientes'])));
				$versoesVo->setIdProjetos(strip_tags(rawurldecode($_POST['idProjetos'])));
				$controlaVersoes = new Controla_Versoes();
				$controlaVersoes->mostraVersoesPesquisa($versoesVo);
				break;
			}
			
			//Cadastrar Versões
			case "cadastraVersoes":
			{
				$versoesVo = new VersoesVo();
				$versoesVo->setNomeVersoes(rawurldecode(strip_tags($_POST['nomeVersoes'])));
				$versoesVo->setDataEntregaVersoes(rawurldecode($_POST['dataVersoes']));
				$versoesVo->setIdAnexos(rawurldecode(strip_tags($_POST['selectAnexos'])));
				$versoesVo->setIdVersoes(rawurldecode(strip_tags($_POST['idVersoes'])));
				$versoesVo->setDataEntregaVersoesClientes(strip_tags(rawurldecode($_POST['dataVersoesClientes'])));
				$versoesVo->setIdProjetos(strip_tags(rawurldecode($_POST['idProjetos'])));
				
				$controlaVersoes = new Controla_Versoes();
				$controlaVersoes->cadastraVersoes($versoesVo);
				break;
			}
			
			//Pesquisar Atividades
			case "pesquisaAtividades":
			{
				$atividadesVo = new AtividadesPontoFuncaoHorasVo();
				$atividadesVo->setIdTecnologias(rawurldecode(strip_tags($_POST['selectTecnologias'])));
				$atividadesVo->setNomeAtividadesPontoFuncaoHoras(rawurldecode(strip_tags($_POST['nomeAtividades'])));
				$controlaAtividadesPontoFuncaoHoras = new Controla_AtividadesPontoFuncaoHoras();
				$controlaAtividadesPontoFuncaoHoras->mostraAtividadesPesquisa($atividadesVo);
				break;
			}
			
			//Cadastrar Versões
			case "cadastraAtividades":
			{
				$atividadesVo = new AtividadesPontoFuncaoHorasVo();
				$atividadesVo->setIdTecnologias(rawurldecode(strip_tags($_POST['selectTecnologias'])));
				$atividadesVo->setNomeAtividadesPontoFuncaoHoras(rawurldecode(strip_tags($_POST['nomeAtividades'])));
				$atividadesVo->setPontoFuncaoAtividadesPontoFuncaoHoras(rawurldecode(strip_tags($_POST['pontoFuncaoAtividades'])));
				$atividadesVo->setHorasAtividadesPontoFuncaoHoras(rawurldecode(strip_tags($_POST['horasAtividades'])));
				$atividadesVo->setIdAtividadePontoFuncaoHoras(rawurldecode(strip_tags($_POST['idAtividades'])));
				
				$controlaAtividadesPontoFuncaoHoras = new Controla_AtividadesPontoFuncaoHoras();
				$controlaAtividadesPontoFuncaoHoras->cadastraAtividades($atividadesVo);
				break;
			}
			
			//Cadastrar Versões
			case "cadastraAnexos":
			{
				$anexosVo = new AnexosVo();
				$idAnexos = strip_tags(rawurldecode($_POST['idAnexos']));
				settype($idAnexos,"integer");
				$anexosVo->setIdAnexos($idAnexos);
				$anexosVo->setNomeAnexos(strip_tags(rawurldecode($_POST['nomeAnexos'])));
				$anexosVo->setDescricaoAnexos(strip_tags(rawurldecode($_POST['descricaoAnexos'])));
				if ($anexosVo->getIdAnexos() != '')
					$anexosVo->setDataInclusaoAnexos(strip_tags(rawurldecode($_POST['dataInclusaoAnexos'])));
				else 
					$anexosVo->setDataInclusaoAnexos(date("Y-m-d"));
				$anexosVo->setCaminhoAnexos(strip_tags(rawurldecode($_POST['caminhoAnexos'])));
				
				$controlaAnexos = new Controla_Anexos();
				$controlaAnexos->cadastrarAnexos($anexosVo);
				break;
			}
			
			//pesquisar anexos
			case "pesquisaAnexos":
			{
				$anexosVo = new AnexosVo();
				$anexosVo->setNomeAnexos(strip_tags(rawurldecode($_POST['nomeAnexos'])));
				$controlaAnexos = new Controla_Anexos();
				$controlaAnexos->mostraListaAnexos($anexosVo);
				break;
			}
			
			//Pesquisar Grupo de Fluxos
			case "pesquisaGrupoFluxos":
			{
				$grupoFluxosVo = new GrupoFluxosVo();
				$grupoFluxosVo->setNomeGrupoFluxos(rawurldecode(strip_tags($_POST['nomeGrupoFluxos'])));
				$controlaGrupoFluxos = new Controla_GrupoFluxos();
				$controlaGrupoFluxos->mostraGrupoFluxosPesquisa($grupoFluxosVo);
				break;
			}
			
			//Cadastrar Grupo de Fluxos
			case "cadastraGrupoFluxos":
			{
				$grupoFluxosVo = new GrupoFluxosVo();
				$grupoFluxosVo->setNomeGrupoFluxos(rawurldecode(strip_tags($_POST['nomeGrupoFluxos'])));
				$grupoFluxosVo->setIdGrupoFluxos(rawurldecode(strip_tags($_POST['idGrupoFluxos'])));
				$controlaGrupoFluxos = new Controla_GrupoFluxos();
				$controlaGrupoFluxos->cadastraGrupoFluxos($grupoFluxosVo);
				break;
			}
			
			//Pesquisar Fluxos
			case "pesquisaFluxos":
			{
				$fluxosVo = new FluxosVo();
				$fluxosVo->setIdGrupoFluxos(rawurldecode(strip_tags($_POST['selectGrupoFluxos'])));
				$fluxosVo->setIdPapeisOrigem(rawurldecode(strip_tags($_POST['selectPapelOrigem'])));
				$fluxosVo->setIdPapeisDestinatario(rawurldecode(strip_tags($_POST['selectPapelDestinatario'])));
				$controlaFluxos = new Controla_Fluxos();
				$controlaFluxos->mostraFluxosPesquisa($fluxosVo);
				break;
			}
			
			//Cadastrar Fluxos
			case "cadastrarFluxos":
			{
				$fluxosVo = new FluxosVo();
				$fluxosVo->setIdFluxos(rawurldecode(strip_tags($_POST['idFluxos'])));
				$fluxosVo->setIdGrupoFluxos(rawurldecode(strip_tags($_POST['selectGrupoFluxos'])));
				$fluxosVo->setIdPapeisOrigem(rawurldecode(strip_tags($_POST['selectPapelOrigem'])));
				$fluxosVo->setIdPapeisDestinatario(rawurldecode(strip_tags($_POST['selectPapelDestinatario'])));
				$controlaFluxos = new Controla_Fluxos();
				$controlaFluxos->cadastraFluxos($fluxosVo);
				break;
			}
			
			//Pesquisar o Log do Suporte
			case "pesquisaLogSuporte":
			{
				$log_SuporteVo = new Log_SuporteVo();
				if (!empty($_POST['idUsuarios']))
					$log_SuporteVo->setIdUsuarios(strip_tags(rawurldecode($_POST['idUsuarios'])));
				if (!empty($_POST['idFuncionalidades']))
					$log_SuporteVo->setIdFuncionalidades(strip_tags(rawurldecode($_POST['idFuncionalidades'])));
				if (!empty($_POST['dataCriacaoLog']))
					$log_SuporteVo->setDataCriacaoLog_Suporte($converte->toDBDate($_POST['dataCriacaoLog']));
				$controlaLogSuporte = new Controla_LogSuporte();
				
				$log_SuporteVo->setParametroConsulta(' ORDER BY dataCriacaoLog_Suporte DESC');
				
				$controlaLogSuporte->mostraListaLogSuporte($log_SuporteVo);
				break;
			}
			
			//Pesquisar Projetos
			case "pesquisarProjetos":
			{
				$projetosVo = new ProjetosVo();
				$projetosVo->setNomeProjetos(rawurldecode(strip_tags($_POST['nomeProjetos'])));
				$projetosVo->setIdClientes(rawurldecode(strip_tags($_POST['selectClientes'])));
				
				$controlaProjetos = new Controla_Projetos();
				$controlaProjetos->mostraProjetosPesquisa($projetosVo);
				break;
			}
			
			//Cadastrar Fluxos
			case "cadastrarProjetos":
			{
				$projetosVo = new ProjetosVo();
				$projetosVo->setNomeProjetos(rawurldecode(strip_tags($_POST['nomeProjetos'])));
				$projetosVo->setIdClientes(rawurldecode(strip_tags($_POST['selectClientes'])));
				$projetosVo->setIdGrupoFluxos(rawurldecode(strip_tags($_POST['selectGrupoFluxos'])));
				$projetosVo->setIdProjetos(rawurldecode(strip_tags($_POST['idProjetos'])));
				
				$controlaProjetos = new Controla_Projetos();
				$controlaProjetos->cadastrarProjeto($projetosVo);
				break;
			}
			
			//Mostra os Fluxos de Acordo com o escolhido para o Projeto
			case "carregaFluxosProjetos":
			{
				$fluxosVo = new FluxosVo();
				$fluxosVo->setIdGrupoFluxos(rawurldecode(strip_tags($_POST['campoFluxos'])));
				
				$controlaFluxos = new Controla_Fluxos();
				$controlaFluxos->mostraFluxosGrupoSelecionadoProjetos($fluxosVo);
				break;
			}
			
			//Monta Select de Projetos da tela de Pedidos
			case "carregarProjetosPedidos":
			{
				$projetosVo = new ProjetosVo();
				$projetosVo->setIdClientes(rawurldecode(strip_tags($_POST['idClientes'])));
				$controlaPedidos = new Controla_Pedidos();
				if ($_POST['visualizarProjeto'] != '')
				{
					$selecionado = strip_tags(rawurldecode($_POST['visualizarProjeto']));
				}
				else
				{
					$selecionado = '';
				}
				echo $controlaPedidos->montaSelectProjetos($projetosVo,'consultarModulosPapeisUsuarios(this)',$selecionado);
				break;
			}
			
			//Monta Select de Modulos da tela de Pedidos
			case "carregarModulosPedidos":
			{
				$projetosModulosVo = new Projetos_ModulosVo();
				$projetosModulosVo->setIdProjetos(rawurldecode(strip_tags($_POST['idProjetos'])));
				$controlaPedidos = new Controla_Pedidos();
				echo $controlaPedidos->montaSelectModulos($projetosModulosVo,'consultarSubModulos(this)');
				break;
			}
			
			//Monta Select de Tecnologias da tela de Pedidos
			case "carregarTecnologiasPedidos":
			{
				$controlaPedidos = new Controla_Pedidos();
				echo $controlaPedidos->montaOptionsSelectTecnologias('consultarAtividades(this)');
				break;
			}
			
			//Monta Select de Papeis da tela de Pedidos
			case "carregarPapeisPedidos":
			{
				$projetosVo = new ProjetosVo();
				$projetosVo->setIdProjetos(rawurldecode(strip_tags($_POST['idProjetos'])));
				$controlaPedidos = new Controla_Pedidos();
				echo $controlaPedidos->montaSelectPapeis($projetosVo,'consultarUsuarios(this)');
				break;
			}
			
			//Monta Select de SubModulos da tela de Pedidos
			case "carregarSubModulosPedidos":
			{
				$modulosSubModulosVo = new Modulos_SubModulosVo();
				$modulosSubModulosVo->getIdModulos(rawurldecode(strip_tags($_POST['idModulo'])));
				$controlaPedidos = new Controla_Pedidos();
				echo $controlaPedidos->montaSelectSubModulos($modulosSubModulosVo,'');
				break;
			}
			
			//Monta Select de Atividades da tela de Pedidos
			case "carregarAtividadesPedidos":
			{
				$atividadesVo = new AtividadesPontoFuncaoHorasVo();
				$atividadesVo->setIdTecnologias(rawurldecode(strip_tags($_POST['idTecnologia'])));
				$controlaPedidos = new Controla_Pedidos();
				echo $controlaPedidos->montaSelectAtividades($atividadesVo,'consultarPrevisaoEntrega(this)');
				break;
			}
			
			//Monta Input de Previsão de Entrega da tela de Pedidos
			case "carregarPrevisaoEntregaPedidos":
			{
				$atividadesVo = new AtividadesPontoFuncaoHorasVo();
				if(isset($_POST['idAtividades']))
				{
					$atividadesVo->setIdAtividadePontoFuncaoHoras(rawurldecode(strip_tags($_POST['idAtividades'])));
				}
				$controlaPedidos = new Controla_Pedidos();
				echo $controlaPedidos->montaInputPrevisaoEntregaAtividades($atividadesVo);
				break;
			}
			
			//Monta Input de Previsão de Entrega da tela de Pedidos
			case "carregarUsuariosPedidos":
			{
				$papeisProjetosVo = new Papeis_ProjetosVo();
				$papeisProjetosVo->setIdPapeis(rawurldecode(strip_tags($_POST['idPapeis'])));
				$papeisProjetosVo->setIdProjetos(rawurldecode(strip_tags($_POST['idProjetos'])));
				$controlaPedidos = new Controla_Pedidos();
				echo $controlaPedidos->montaSelectUsuarios($papeisProjetosVo);
				break;
			}
			
			//Monta Input de Previsão de Entrega da tela de Pedidos
			case "carregarVersoesPedidos":
			{
				$versoesVo = new VersoesVo();
				$versoesVo->setIdVersoes(rawurldecode(strip_tags($_POST['idVersoes'])));
				$controlaPedidos = new Controla_Pedidos();
				echo $controlaPedidos->montaSelectVersoes($versoesVo);
				break;
			}
			
			//Monta Input de Previsão de Entrega da tela de Pedidos
			case "carregarSeveridadePedidos":
			{
				$controlaPedidos = new Controla_Pedidos();
				echo $controlaPedidos->montaSelectSeveridade();
				break;
			}
			
			//Monta Input de Previsão de Entrega da tela de Pedidos
			case "carregarDescricaoPedidos":
			{
				$controlaPedidos = new Controla_Pedidos();
				echo $controlaPedidos->montaDescricaoPedidos();
				break;
			}
			
			//Mostra o papel ocupado da tela de Pedidos
			case "carregarPapelOcupadoPedidos":
			{
				$papeisProjetosVo = new Papeis_ProjetosVo();
				$papeisProjetosVo->setIdProjetos(rawurldecode(strip_tags($_POST['idProjetos'])));
				$controlaPedidos = new Controla_Pedidos();
				echo $controlaPedidos->mostraPapelOcupado($papeisProjetosVo);
				break;
			}
			/*case "cadastrarPedidosClientes":
			{
				//Gravação no Vo de Pedidos
				$pedidosVo = new PedidosVo();
				$pedidosVo->setIdPedidos(rawurldecode(strip_tags($_POST['idPedidos'])));
				$pedidosVo->setIdUsuarios($_SESSION['id_Usuario']);
				$pedidosVo->setIdProjetos(rawurldecode($_POST['selectProjetos']));
				
				$controlaPedidos = new Controla_Pedidos();
				$controlaPedidos->cadastrarPedidos($pedidosVo);
				
				break;
			}*/
			case "cadastrarPedidos":
			{
				//Gravação no Vo de Pedidos
				$pedidosVo = new PedidosVo();
				if(isset($_POST['idPedidos']))
				{
					$pedidosVo->setIdPedidos(rawurldecode(strip_tags($_POST['idPedidos'])));
				}
				$pedidosVo->setIdUsuarios($_SESSION['id_Usuario']);
				if(isset($_POST['selectAtividades']))
				{
					$pedidosVo->setIdAtividadesPontoFuncaoHoras(rawurldecode($_POST['selectAtividades']));
				}
				$pedidosVo->setIdProjetos(rawurldecode($_POST['selectProjetos']));
				if(isset($_POST['selectVersoes']))
				{
					$pedidosVo->setIdVersoes(rawurldecode(strip_tags($_POST['selectVersoes'])));
				}
				if(isset($_POST['selectModulos']))
				{
					$pedidosVo->setIdModulos(rawurldecode(strip_tags($_POST['selectModulos'])));
				}
				if(isset($_POST['selectSubModulos']))
				{
					$pedidosVo->setIdSubModulos(rawurldecode(strip_tags($_POST['selectSubModulos'])));	
				}
				if(isset($_POST['previsaoEntrega']))
				{
					$pedidosVo->setDataHoraPrevisaoPedidos(rawurldecode(strip_tags($_POST['previsaoEntrega'])));
				}
				$pedidosVo->setPrecedentePedidos(rawurldecode(strip_tags($_POST['idPrecedente'])));
				$pedidosVo->setDomnSeveridadePedidos(rawurldecode(strip_tags($_POST['severidadePedidos'])));
				$pedidosVo->setAssuntoPedidos(rawurldecode(strip_tags($_POST['campoAssunto'])));
				$controlaPedidos = new Controla_Pedidos();
				$controlaPedidos->cadastrarPedidos($pedidosVo);
				break;
			}
			
			case "alterarStatusComplementoPedido":
			{
				$pedidosVo = new PedidosVo();
				$pedidosVo->setIdPedidos(rawurldecode(strip_tags($_POST['idPedido'])));
				if(isset($_POST['selectAtividades']))
				{
					$pedidosVo->setIdAtividadesPontoFuncaoHoras(rawurldecode(strip_tags($_POST['selectAtividades'])));
				}
				if(isset($_POST['previsaoEntrega']))
				{
					$pedidosVo->setDataHoraPrevisaoPedidos(rawurldecode(strip_tags($_POST['previsaoEntrega'])));
				}
				$controlaPedidos = new Controla_Pedidos();
				$controlaPedidos->alteraStatusdoPedidoEnviaEmail($pedidosVo,rawurldecode(strip_tags($_POST['statusAtual'])));
				break;
			}
			
			case "carregarCamposPermissoes":
			{
				$projetosVo = new ProjetosVo();
				$projetosVo->setIdProjetos(rawurldecode(strip_tags($_POST['idProjetos'])));
				
				$pedidosVo = new PedidosVo();
				if(isset($_POST['idPedido']))
				{
					$pedidosVo->setIdPedidos(rawurldecode(strip_tags($_POST['idPedido'])));
				}
				
				$controlaPedidos = new Controla_Pedidos();
				$controlaPedidos->mostraCamposDeAcordoPermissao($projetosVo,$pedidosVo);
				break;
			}
			
			case "carregarAssunto":
			{
				$controlaPedidos = new Controla_Pedidos();
				$assunto = '';
				if(isset($_POST['assunto']))
				{
					$assunto = rawurldecode(strip_tags($_POST['assunto']));
				}
				echo $controlaPedidos->montaAssuntoPedidos($assunto);
				break;
			}
			
			case "carregarCampoAnexo":
			{
				$controlaPedidos = new Controla_Pedidos();
				echo $controlaPedidos->mostraCampoAnexo();
				break;
			}
			
			case "pesquisaPedido":
			{
				$controlaPedidos = new Controla_Pedidos();
				$pedidosVo = new PedidosVo();
				$pedidosVo->setIdPedidos(rawurldecode(strip_tags($_POST['numeroPedido'])));
				if(isset($_POST['selectProjetos']))
				{
					$pedidosVo->setIdProjetos(rawurldecode(strip_tags($_POST['selectProjetos'])));
				}
				echo $controlaPedidos->mostraPequisaPedidos($pedidosVo);
				break;	
			}
			
			case "atualizarNaoConformidades":
			{
				$controlaNaoConformidades = new Controla_NaoConformidades();
				$naoConformidadesVo = new NaoConformidadesVo();
				$naoConformidadesVo->setIdNaoConformidades(strip_tags(rawurldecode($_POST['idNaoConformidades'])));
				$naoConformidadesVo->setDataNaoConformidades(strip_tags(rawurldecode($_POST['dataNaoConformidades'])));
				$naoConformidadesVo->setIdPedidos(strip_tags(rawurldecode($_POST['idPedidos'])));
				if(isset($_POST['justificativaNaoConformidades']))
				{
					$naoConformidadesVo->setJustificativaNaoConformidades(strip_tags(rawurldecode($_POST['justificativaNaoConformidades'])));
				}
				if(isset($_POST['contraMedidasNaoConformidades']))
				{
					$naoConformidadesVo->setContraMedidasNaoConformidades(strip_tags(rawurldecode($_POST['contraMedidasNaoConformidades'])));
				}
				if (isset($_POST['domnMotivo']))
				{
					$naoConformidadesVo->setDomnMotivo(strip_tags(rawurldecode($_POST['domnMotivo'])));
				}
				
				$controlaNaoConformidades->atualizarNaoConformidades($naoConformidadesVo);
				break;
			}
			
			case "consultarNaoConformidades":
			{
				$controlaNaoConformidades = new Controla_NaoConformidades();
				$naoConformidadesVo = new NaoConformidadesVo();
				$formataData = new FormataData();
				
				$naoConformidadesVo->setIdPedidos(strip_tags(rawurldecode($_POST['idPedidos'])));
				$naoConformidadesVo->setDataNaoConformidades($formataData->toDBDate(strip_tags(rawurldecode($_POST['dataNaoConformidades']))));
				
				$controlaNaoConformidades->montaListaPesquisaNaoConformidades($naoConformidadesVo);
				break;
			}
		}
				
	}
}

?>