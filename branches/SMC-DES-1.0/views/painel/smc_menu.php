<link type="text/css" rel="stylesheet" href="../css/smc_menu.css" />

<body class="painel">
<div id="painel">
	<div class="menu">
		<ul id="nav-container" class="nav-container">
			<li class="opcao" onclick="window.location='?p=home';"><img class="ico" src="../imagens/home.png" alt="Ins„cio" />Ins„cio </li>

			<li class="opcao" ><img class="ico" src="../imagens/cadastro.png" alt="Cadastros" />Cadastros
				<ul>
					<li class="titulo" >Cadastrar...</li>
					<li class="opcao" onclick="window.location='?p=add_cpf';">Clientes - Pessoa fs„sica</a></li>
					<li class="opcao" onclick="window.location='?p=add_cnpj';">Clientes - Pessoa jurs„dica</a></li>
					<li class="opcao" onclick="window.location='?p=add_veiculos';">Ves„culos</a></li>
					<li class="opcao" onclick="window.location='?p=add_motorista';">Condutores</a></li>
					<li class="opcao" onclick="window.location='?p=add_tipo_rev';">Revis√µes (tipos)</a></li>
					<li class="opcao" onclick="window.location='?p=add_rev_padrao';">Revis√µes</a></li>
					<li class="opcao" onclick="window.location='?p=add_abastece';">Abastecimentos</a></li>
				</ul>
			</li>

			<li class="opcao" ><img class="ico" src="../imagens/search.png" alt="Consultar" />Consultas
				<ul>
					<li class="titulo" >Procurar...</li>
					<li class="opcao" onclick="window.location='?p=listagem';">Lista vencimentos</a></li>
					<li class="divisor"></li>
					<li class="opcao" onclick="window.location='?p=busca_cpf';">Clientes - Pessoa fs„sica</a></li>
					<li class="opcao" onclick="window.location='?p=busca_cnpj';">Clientes - Pessoa jurs„dica</a></li>
					<li class="opcao" onclick="window.location='?p=busca_veiculos';">Ves„culos</a></li>
					<li class="opcao" onclick="window.location='?p=busca_condutores';">Condutores</a></li>
					<li class="opcao" onclick="window.location='?p=busca_revisoes';">Revis√µes</a></li>
					<li class="opcao" onclick="window.location='?p=busca_abastece';">Abastecimentos</a></li>
				</ul>
			</li>

			<li class="opcao" onclick="window.location='?p=rev_confirma';"><img class="ico" src="../imagens/engrenagens.gif" alt="Confirma" />Confirmar Revis„o </li>

			<li class="opcao" onclick="ToggleDiv('webmail');" ><img class="ico" src="../imagens/small_contato.png" alt="Webmail" />Webmail </li>

			<li class="opcao" title="Encerrar sess„o" onclick="window.location='?destroi=sim';"><img class="ico" src="../imagens/ico_cancel.png" alt="Sair" />Sair </li>
			
		<li class="opcao fright" title="Acessar"> <img class="ng" src="../imagens/ng20.png" alt="" onclick="window.open('http://acesso.ngi.com.br:8088/clientes/MntFrota.html','NGi','width=100%','height=100%');"/> </li>

		</ul>
	</div>
</div>

<div id="separador"></div>

<div id="webmail">
	<form class="webmail" name="f_webmail" method="POST" action="http://webmail.servicodespertador.net/mod_perl/chklogin.pl" target="_new">
	<p><label for="username">Login:</label><input type="text"name="username" id="username" /><label for="username">@servicodespertador.net</label></p>
	<p><label for="password">Senha:</label><input type="password" name="password" id="password"><input type="submit" value="Entrar"></p>
	</form>
</div>

</body>