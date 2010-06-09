<?php
require_once ('../../class/Config.php');

if(!isset($_SESSION['usuarioLogon'])) {
    header("Location:../views/home.php?p=login");
}

$logon = new Logon();
$logon = $_SESSION["usuarioLogon"];
?>
<link rel="stylesheet" href="_css/listagem.css" type="text/css" media="all" />

<div id="listagem">

    <?php
    $data = "0-".date("m")."-0";
    $userLogon = new Logon();
    $userLogon = $_SESSION['usuarioLogon'];
    $mostraLinkMais = false;
    ?>

    <p class="evento">Aniversariantes do dia</p>
    <?php
//Aniversariantes - Clientes ou Administrador (todos os cadastros)
    $collVoPessoa = $controla->listarAniversariosClientes($userLogon,$data);

    if(!is_null($collVoPessoa)) {
        $cont = 0;
        foreach ($collVoPessoa as $pessoas) {
            if($cont == 0)
                $pessoaAtual = new Logon();
            $pessoaAtual = $pessoas;
            echo '<label title="'.$formataData->toViewDate($pessoaAtual->getDataNascimentoPessoa()).'">Anivers�rio de '.$pessoaAtual->getNomePessoa().'</label>';
            $cont++;
        }
    }

    ?>

    <p class="evento">CNH</p>
    <?php
//Lista CNH de Clientes
    $collVoCnh = $controla->listaCnhVencida($userLogon,$data);
    if(!is_null($collVoCnh)) {
        $cont = 0;
        foreach ($collVoCnh as $cnhs) {
            if($cont == 0)
                $cnhAtual = new Cnh();
            $cnhAtual = $cnhs;
            $pessoaAtual = new Pessoa();
            $pessoaAtual = $cnhAtual->returnaPessoa();
            echo "<label>CNH:".$cnhAtual->getNumeroCnh()." - ".$pessoaAtual->getNomePessoa()."</label>";
            $cont++;
        }
    }

    ?>

    <p class="evento">IPVA</p>
    <?php
//Lista de IPVA Vencido
    $collVoIpva = $controla->listaIpvaVencidos($userLogon,$data);
    if(!is_null($collVoIpva)) {
        $cont = 0;
        foreach ($collVoIpva as $ipvas) {
            if($cont == 0)
                $veiculoAtual = new Veiculos();
            $veiculoAtual = $ipvas;
            echo '<label title="">'.$veiculoAtual->getPlacaVeiculos().'</label>';
            $cont++;
        }
        echo '';
    }

    ?>

    <p class="evento">Seguro de veiculo</p>
    <?php
//Lista Seguros vencidos
    $collVoSeguro = $controla->listaSeguroVencidos($userLogon,$data);
    if(!is_null($collVoSeguro)) {
        $cont = 0;
        foreach ($collVoSeguro as $seguros) {
            if($cont == 0)
                $veiculoAtual = new Veiculos();
            $veiculoAtual = $seguros;
            echo '<label title="">'.$veiculoAtual->getPlacaVeiculos().'</label><br />';
            $cont++;
        }
        echo '';
    }

    ?>

    <p class="evento">Garantia</p>
    <?php
//Lista Vencimento de Garantia
    $collVoGarantias = $controla->ListaGarantiasVenc($userLogon,$data);
    if(!is_null($collVoGarantias)) {
        $cont = 0;
        foreach ($collVoGarantias as $garantias) {
            if($cont == 0)
                $veiculoAtual = new Veiculos();
            $veiculoAtual = $garantias;
            echo '<label title="">'.$veiculoAtual->getPlacaVeiculos().'</label>';
            $cont++;
        }
        echo '';
    }

    ?>

    <p class="evento">Revis�es agendadas</p>
    <?php
//Lista de Revis�es
    $collVoRevisoes = $controla->listaRevisoes($userLogon,$data);
    if(!is_null($collVoRevisoes)) {
        $cont = 0;
        foreach ($collVoRevisoes as $revisoes) {
            if($cont == 0)
                $revisoesAtual = new Revisoes();
            $revisoesAtual = $revisoes;
            $veiculoAtual = new Veiculos();
            $veiculoAtual->setIdVeiculos($revisoesAtual->getIdVeiculos());
            $collVeiculos = $controla->findVeiculos($veiculoAtual);
            $veiculoAtual = $collVeiculos[0];
            echo '<label title="">'.$veiculoAtual->getPlacaVeiculos().' - Revis�o agendada</label>';
            $cont++;
        }
        echo '';
    }

    ?>

    <p class="botoes"></p>

</div>