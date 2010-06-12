<?php
require_once ('../../class/Config.php');

if(!isset($_SESSION['usuarioLogon'])) {
    header("Location:../views/home.php?p=login");
}

if(isset($_GET['msg'])) {
    echo "<script>alert('{$_GET['msg']}');</script>";
}

$logon = new Logon();
$logon = $_SESSION["usuarioLogon"];
$pessoa = new Pessoa();

if(!is_null($logon->getIdPessoa())) {
    $pessoa->setIdPessoa($logon->getIdPessoa());
    $collVoPessoa = $controla->findPessoas($pessoa);

    if(!is_null($collVoPessoa)) {
        $pessoa = $collVoPessoa[0];
    }
}
?>
<link rel="stylesheet" href="_css/formPadrao.css" type="text/css" media="all" />

<body>

    <form method="POST" action="../../class/RecebePostGet.php">
        <p class="caption">Dados pessoais</p>
        <fieldset>
            <div class="left">
                <label>Nome:
                    <input type="text" name="nome_cliente" value="<?php echo $pessoa->getNomePessoa(); ?>" class="long" />
                </label>
                <label>Nascimento:
                    <input type="text" name="nascimento_cliente" value="<?php echo $formataData->toViewDate($pessoa->getDataNascimentoPessoa()); ?>" onkeypress="return mascara(event,this,'##/##/####');return Onlynumbers(event);" onKeyUp="return autoTab(this, 10, event);" maxlength="10" class="data" />
                </label>
                <br />
                <label>Sexo:
                    <select name="sexo_cliente">
                        <option></option>
                        <option value="Masculino"<?php echo ($pessoa->getSexoPessoa()=="Masculino")?"selected":""; ?>>Masculino</option>
                        <option value="Feminino"<?php echo ($pessoa->getSexoPessoa()=="Feminino")?"selected":""; ?>>Feminino</option>
                    </select>
                </label>
                <label>Estado Civil:
                    <select name="ecivil_cliente" onchange="habilitaConjugue(this);" class="x3" >
                        <option></option>
                        <option value="Casado" <?php echo ($pessoa->getEstadoCivilPessoa()==="Casado")?"selected":""; ?>>Casado(a)</option>
                        <option value="Solteiro" <?php echo ($pessoa->getEstadoCivilPessoa()==="Solteiro")?"selected":""; ?>>Solteiro(a)</option>
                        <option value="União Estável" <?php echo ($pessoa->getEstadoCivilPessoa()==="União Estável")?"selected":""; ?>>União Estável</option>
                    </select>
                </label>
                <label>Observações:
                    <input type="text" name="nota" value="<?php echo $pessoa->getComplementoPessoa(); ?>" />
                </label>
            </div>
            <div class="right">
                <label>RG:
                    <input type="text" name="rg_cliente" value="<?php echo $pessoa->getRgPessoa(); ?>" class="doc" />
                </label>
                <label>Órgao Exp.:
                    <input type="text" name="orgexprg_cliente" value="<?php echo $pessoa->getOrgExpPessoa(); ?>" maxlength="3" class="small" />
                </label>
                <label>UF:
                    <select name="ufexprg_cliente">
                        <option selected></option>
                        <option value="MT" <?php echo ($pessoa->getUfOrgExpPessoa()==="MT")? "selected":""; ?>>MT</option>
                    </select>
                </label>
                <br />
                <label>CPF:
                    <input type="text" name="cpf_cliente" value="<?php echo $pessoa->getCpfPessoa(); ?>" maxlength="14" class="doc" />
                </label>
            </div>
        </fieldset>
        <?php
        $endereco= new Endereco();

        if(!is_null($pessoa->getIdPessoa())) {
            $endereco->setIdPessoa($pessoa->getIdPessoa());
            $collVoEnd = $controla->findEndereco($endereco);

            if(!is_null($collVoEnd)) {
                $endereco = $collVoEnd[0];
            }
        }
        ?>
        <p class="caption">Contato</p>
        <fieldset>
            <div class="left">
                <label>Rua, avenida, logradouro:
                    <input type="text" name="rua_contato" value="<?php echo $endereco->getRuaEndereco(); ?>" class="long" />
                </label>
                <label>Número:
                    <input type="text" name="numero" value="<?php echo $endereco->getRuaEndereco(); ?>" class="small" />
                </label>
                <br />
                <label>Complemento:
                    <input type="text" name="complemento_contato" value="<?php echo $endereco->getComplementoEndereco(); ?>" class="long" />
                </label>
                <br />
                <label>Bairro:
                    <input type="text" name="bairro_contato" value""<?php echo $endereco->getBairroEndereco(); ?> class="long" />
                </label>
                <label>CEP:
                    <input type="text" name="cep_contato" value="<?php echo $endereco->getCepEndereco(); ?>" maxlength="10" class="data" />
                </label>
                <br />
                <label>Cidade:
                    <input type="text" name="cidade_contato" value="<?php echo $endereco->getCidadeEndereco(); ?>" class="long" />
                </label>
                <label>UF:
                    <select name="estado_contato" class="x1" >
                        <option></option>
                        <option value="MT" <?php echo ($endereco->getEstadoEndereco()==="MT")? "selected":""; ?>>MT</option>
                    </select>
                </label>
                <br />
            </div>
            <div class="right">
                <label>DDD - Telefone:
                    <input type="text" name="tel_contato" value="<?php echo $endereco->getTelefoneEndereco(); ?>"	maxlength="9" class="doc" />
                </label>
                <br />
                <label>DDD - Celular:
                    <input type="text" name="cel_contato" value="<?php echo $endereco->getCelEndereco(); ?>" maxlength="9" class="doc" />
                </label>
                <br />
                <label>DDD - Fax:
                    <input type="text" name="fax_contato" value="<?php echo $endereco->getFaxEndereco(); ?>" maxlength="9" class="doc" />
                </label>
                <br />
                <label>E-mail:
                    <input type="text" name="email_contato" value="<?php echo $endereco->getEmailEndereco(); ?>" class="long" />
                </label>
            </div>
        </fieldset>
        <?php
        $pessoaConjugue = new Pessoa();

        if($pessoa->getIdConjuguePessoa() != null) {
            $pessoaConjugue->setIdPessoa($pessoa->getIdConjuguePessoa());
            $collVoConjugue = $controla->findPessoas($pessoaConjugue);

            if(!is_null($collVoConjugue)) {
                $pessoaConjugue = $collVoConjugue[0];
            }
        }
        ?>
        <p class="caption">Dados do(a) cônjuge</p>
        <fieldset>
            <div class="left">
                <label>Nome:
                    <input type="text" name="nome_conjuge" value="<?php echo $pessoaConjugue->getNomePessoa(); ?>" class="long" />
                </label>
            </div>
            <div class="right">
                <label>Nascimento:
                    <input type="text" name="nasc_conjuge" value="<?php echo $formataData->toViewDate($pessoaConjugue->getDataNascimentoPessoa()); ?>" maxlength="10" class="data" />
                </label>
                <label>Sexo:
                    <select name="sexo_conjuge" class="x3" >
                        <option selected></option>
                        <option value="Masculino"<?php echo ($pessoaConjugue->getSexoPessoa()=="Masculino")?"selected":""; ?>>Masculino</option>
                        <option value="Feminino"<?php echo ($pessoaConjugue->getSexoPessoa()=="Feminino")?"selected":""; ?>>Feminino</option>
                    </select>
                </label>
            </div>
        </fieldset>
        <?php
        if($pessoaConjugue->getIdPessoa() != null) {
            echo '<script>document.layerFrm1.style = "display:block"</script>';
        }
        ?>
        <p class="botoes">
            <input type="hidden" id="idPessoa" name="idPessoa" value="<?php echo $pessoa->getIdPessoa() ;?>"/>
            <input type="hidden" id="idEndereco" name="idEndereco" value="<?php echo $endereco->getIdEndereco(); ?>"/>
            <input type="hidden" id="idConjugue" name="idConjugue" value="<?php echo $pessoaConjugue->getIdPessoa(); ?>"/>
            <input type="hidden" id="acao" name="acao" value="cadastraMeuCpf" >
            <input type="submit" name="completo" value="Confirmar" >
            <input type="reset" value="Limpar campos" >
        </p>
    </form>

</body>