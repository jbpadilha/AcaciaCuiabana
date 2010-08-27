<link type="text/css" rel="stylesheet" href="/_global/_css/smc/menuPainel.css" />

<ul id="painel">

    <li>
        <a href="?p=home">
            <img src="/_global/_img/smc/ico_inicio.png" alt="Início" />
            Início
        </a>
    </li>

    <li><img src="/_global/_img/smc/ico_cadastro.png" alt="Cadastros" />
        Cadastros
        <ul>
            <li class="titulo">
                Cadastrar...
            </li>
            <li>
                <a href="?p=add_cpf">
                    Clientes - Pessoa física
                </a>
            </li>
            <li>
                <a href="?p=add_cnpj">
                    Clientes - Pessoa jurídica
                </a>
            </li>
            <li>
                <a href="?p=add_veiculos">
                    Veículos
                </a>
            </li>
            <li>
                <a href="?p=add_motorista">
                    Condutores
                </a>
            </li>
            <li>
                <a href="?p=add_tipo_rev">
                    Revisões (tipos)
                </a>
            </li>
            <li>
                <a href="?p=add_rev_padrao">
                    Revisões
                </a>
            </li>
            <li>
                <a href="?p=add_abastece">
                    Abastecimentos
                </a>
            </li>
        </ul>
    </li>

    <li><img src="/_global/_img/smc/ico_consulta.png" alt="Consultar" />
        Consultas
        <ul>
            <li>
                <a href="?p=listagem">
                    Lista vencimentos
                </a>
            </li>
            <li class="titulo">
                Procurar...
            </li>
            <li>
                <a href="?p=busca_cpf&limpa=1">
                    Clientes - Pessoa física
                </a>
            </li>
            <li>
                <a href="?p=busca_cnpj&limpa=1">
                    Clientes - Pessoa jurídica
                </a>
            </li>
            <li>
                <a href="?p=busca_veiculos&limpa=1">
                    Veículos
                </a>
            </li>
            <li>
                <a href="?p=busca_condutores&limpa=1">
                    Condutores
                </a>
            </li>
            <li>
                <a href="?p=busca_revisoes&limpa=1">
                    Revisões
                </a>
            </li>
            <li>
                <a href="?p=busca_abastece&limpa=1">
                    Abastecimentos
                </a>
            </li>
        </ul>
    </li>

    <li>
        <a href="?p=rev_confirma">
            <img src="/_global/_img/smc/checked.png" alt="Confirma" />
            Confirmar Revisão
        </a>
    </li>

    <li>
        <a href="http://webmail.servicodespertador.net" target="_blank">
            <img src="/_global/_img/smc/ico_contato.png" alt="Webmail" />
            Webmail
        </a>
    </li>

    <li title="Encerrar sessão" style="float:right; ">
        <a href="?destroi=sim">
            <img src="/_global/_img/smc/ico_logoff.png" alt="Sair" />
            Sair
        </a>
    </li>

    <li style="display:none; ">
        <a href="http://acesso.ngi.com.br:8088/clientes/MntFrota.html" target="_blank">
            <img src="/_global/_img/smc/ng20.png" alt="" />
        </a>
    </li>

</ul>

<div id="webmail">
    <form class="webmail" name="f_webmail" method="POST" action="http://webmail.servicodespertador.net/mod_perl/chklogin.pl" target="_blank">
        <label for="username">Login:</label>
        <input type="text" name="username" />
        <label for="username">@servicodespertador.net</label>
        <br />
        <label for="password">Senha:</label>
        <input type="password" name="password" />
        <input type="submit" value="Entrar" />
    </form>
</div>