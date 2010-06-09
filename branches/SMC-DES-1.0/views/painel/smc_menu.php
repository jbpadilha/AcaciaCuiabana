<link type="text/css" rel="stylesheet" href="_css/smc_menu.css" />

<ul id="painel">

    <li>
        <a href="?p=home" alt="">
            <img src="../imagens/home.png" alt="Início" />
            Início
        </a>
    </li>

    <li>
        <img src="../imagens/cadastro.png" alt="Cadastros" />
        Cadastros
        <ul>
            <li class="titulo">
                Cadastrar...
            </li>
            <li>
                <a href="?p=add_cpf" alt="">
                    Clientes - Pessoa física
                </a>
            </li>
            <li>
                <a href="?p=add_cnpj" alt="">
                    Clientes - Pessoa jurídica
                </a>
            </li>
            <li>
                <a href="?p=add_veiculos" alt="">
                    Veículos
                </a>
            </li>
            <li>
                <a href="?p=add_motorista" alt="">
                    Condutores
                </a>
            </li>
            <li>
                <a href="?p=add_tipo_rev" alt="">
                    Revisões (tipos)
                </a>
            </li>
            <li>
                <a href="?p=add_rev_padrao&limpa=1" alt="">
                    Revisões
                </a>
            </li>
            <li>
                <a href="?p=add_abastece" alt="">
                    Abastecimentos
                </a>
            </li>
        </ul>
    </li>

    <li>
        <img src="../imagens/search.png" alt="Consultar" />
        Consultas
        <ul>
            <li class="titulo">
                Procurar...
            </li>
            <li>
                <a href="?p=listagem" alt="">
                    Lista vencimentos
                </a>
            </li>
            <li class="divisor"></li>
            <li>
                <a href="?p=busca_cpf&limpa=1" alt="">
                    Clientes - Pessoa física
                </a>
            </li>
            <li>
                <a href="?p=busca_cnpj&limpa=1" alt="">
                    Clientes - Pessoa jurídica
                </a>
            </li>
            <li>
                <a href="?p=busca_veiculos&limpa=1" alt="">
                    Veículos
                </a>
            </li>
            <li>
                <a href="?p=busca_condutores&limpa=1" alt="">
                    Condutores
                </a>
            </li>
            <li>
                <a href="?p=busca_revisoes&limpa=1" alt="">
                    Revisões
                </a>
            </li>
            <li>
                <a href="?p=busca_abastece&limpa=1" alt="">
                    Abastecimentos
                </a>
            </li>
        </ul>
    </li>

    <li>
        <a href="?p=rev_confirma" alt="">
            <img src="../imagens/engrenagens.gif" alt="Confirma" />
            Confirmar Revisão
        </a>
    </li>

    <li>
        <a href="http://webmail.servicodespertador.net" target="_blank">
            <img src="../imagens/small_contato.png" alt="Webmail" />
            Webmail
        </a>
    </li>

    <li title="Encerrar sessão">
        <a href="?destroi=sim" alt="">
            <img src="../imagens/ico_cancel.png" alt="Sair" />
            Sair
        </a>
    </li>

    <li>
        <a href="http://acesso.ngi.com.br:8088/clientes/MntFrota.html" target="_blank">
            <img src="../imagens/ng20.png" alt="" />
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