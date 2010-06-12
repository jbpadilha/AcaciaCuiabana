<?php 
require_once ('../../class/Config.php');
if(!isset($_SESSION['usuarioLogon'])) {
    header("Location:../views/home.php?p=login");
}
$logon = new Logon();
$logon = $_SESSION["usuarioLogon"];

$pessoa = new Pessoa();
$pessoa->setIdPessoa($logon->getIdPessoa());

$collVoPessoa = $controla->findPessoas($pessoa);
if(!is_null($collVoPessoa)) {
    $pessoa = $collVoPessoa[0];
}

?>
<link rel="stylesheet" href="_css/formPadrao.css" type="text/css" media="all" />
<form>
    <p class="caption">Dados pessoais</p>

    <fieldset>
        <div class="left">
            <label>Nome:
                <input type="text" name="nome_cliente" readonly value="<?=$pessoa->getNomePessoa()?>" />
            </label>
            <label>Nascimento:
                <input type="text" name="nascimento_cliente" readonly value="<?=$formataData->toViewDate($pessoa->getDataNascimentoPessoa())?>" />
            </label>
            <label>Sexo:
                <input type="text" name="sexo_cliente" readonly value="<?=$pessoa->getSexoPessoa()?>" />
            </label>
            <label>Estado Civil:
                <input type="text" name="ecivil_cliente" readonly value="<?=$pessoa->getEstadoCivilPessoa()?>">
            </label>
            <label>Observa��es:
                <input type="text" name="nota" readonly value="<?=$pessoa->getComplementoPessoa()?>" />
            </label>
        </div>
        <div class="right">
            <label>RG:
                <input type="text" name="rg_cliente" readonly value="<?=$pessoa->getRgPessoa()?>" />
            </label>
            <label>�rgao Exped./UF:
                <input type="text" name="orgexprg_cliente" readonly value="<?=$pessoa->getOrgExpPessoa()?>" />
            </label>
            <label> - 
                <input type="text" name="ufexprg_cliente" readonly value="<?=$pessoa->getUfOrgExpPessoa()?>">
            </label>
            <label>CPF:
                <input type="text" name="cpf_cliente"   	readonly value="<?=$pessoa->getCpfPessoa()?>" />
            </label>
        </div>
    </fieldset>
    <?php
    $endereco = new Endereco();
    $endereco->setIdPessoa($pessoa->getIdPessoa());
    $collVoEndereco = $controla->findEndereco($endereco);
    if(!is_null($collVoEndereco)) {
        $endereco = $collVoEndereco[0];
    }
    ?>
    <p class="caption">Contato</p>

    <fieldset>
        <div class="left">
            <label>Rua, avenida, logradouro:
                <input type="text" name="rua_contato" readonly value="<?=$endereco->getRuaEndereco()?>" />
            </label>
            <label>Complemento:
                <input type="text" name="complemento_contato" readonly value="<?=$endereco->getComplementoEndereco()?>" />
            </label>
            <label>Bairro:
                <input type="text" name="bairro_contato" readonly value="<?=$endereco->getBairroEndereco()?>" />
            </label>
            <label>CEP:
                <input type="text" name="cep_contato" readonly value="<?=$endereco->getCepEndereco()?>" />
            </label>
            <label>Cidade:
                <input type="text" name="cidade_contato" readonly value="<?=$endereco->getCidadeEndereco()?>" />
            </label>
            <label >Estado:
                <input type="text" name="estado_contato" readonly value="<?=$endereco->getEstadoEndereco()?>" />
            </label>
            <label>E-mail:
                <input type="text" name="email_contato" readonly value="<?=$endereco->getEmailEndereco()?>" />
            </label>
        </div>
        <div class="right">
            <label>Telefone:
                <input type="text" name="tel_contato" readonly value="<?=$endereco->getTelefoneEndereco()?>" />
            </label>
            <label>Celular:
                <input type="text" name="cel_contato" readonly value="<?=$endereco->getCelEndereco()?>" />
            </label>
            <label>Fax:
                <input type="text" name="fax_contato" readonly value="<?=$endereco->getFaxEndereco()?>" />
            </label>
        </div>
    </fieldset>
    <?php
    if($pessoa->getIdConjuguePessoa() != null) {
        $pessoaConjugue = new Pessoa();
        $pessoaConjugue->setIdPessoa($pessoa->getIdConjuguePessoa());
        $collVoConjugue = $controla->findPessoas($pessoaConjugue);
        if(!is_null($collVoConjugue)) {
            $pessoaConjugue = $collVoConjugue[0];
        }
        ?>
    <p class="caption">Dados do c�njuge</p>
    
    <fieldset>
        <div class="left">
            <label>Nome:
                <input type="text" name="nome_conjuge"  readonly value="<?=$pessoaConjugue->getNomePessoa()?>" />
            </label>
        </div>
        <div class="right">
            <label>Nascimento:
                <input type="text" name="nasc_conjuge" readonly value="<?=$formataData->toViewDate($pessoaConjugue->getDataNascimentoPessoa())?>" />
            </label>
            <label>Sexo:
                <input type="text" name="sexo_cliente" readonly value="<?=$pessoaConjugue->getSexoPessoa()?>" />
            </label>
        </div>
    </fieldset>
        <?php
    }
    ?>
</form>