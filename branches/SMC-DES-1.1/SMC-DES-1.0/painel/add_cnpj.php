<?php
require_once ('../class/Config.php');

if(!isset($_SESSION['usuarioLogon'])) {
    header("Location:../views/home.php?p=login");
}

$logon = new Logon();
$logon = $_SESSION["usuarioLogon"];
$empresa = new Empresas();

if(isset($_GET['empresas'])) {
    $empresa = (object)unserialize(base64_decode($_GET['empresas']));
}
?>
<form method="post" action="../class/RecebePostGet.php">

    <div class="botoes">
        <input type="hidden" id="acao" name="acao" value="cadastroEmpresa">
        <input type="hidden" id="idCliente" name="idCliente" value="<?php echo $logon->getIdClientes(); ?>">
        <button type="reset" accesskey="L">Limpar campos</button>
        <button type="submit" name="completo2" accesskey="C">Confirmar</button>
    </div>

	<p class="caption">Informações gerais</p>
    <fieldset>
		<div class="left">
			<label>Razão social:
				<input type="text" name="nome_empresa" value="<?php echo $empresa->getNomeEmpresa(); ?>" class="nome" />
			</label>
			<label>Data da fundação:
				<input type="text" name="data_fundacao" value="<?php echo $formataData->toViewDate($empresa->getDataFundacaoEmpresa()); ?>" maxlength="10" class="data" />
			</label>
			<br />
			<label>Nome Fantasia:<input type="text" name="nome_fantasia" value="<?php echo $empresa->getNomeFantasiaEmpresa(); ?>" class="long" /></label>
		</div>
		<div class="right">
			<label>CNPJ:<input type="text" name="cnpj" value="<?php echo $empresa->getCnpjEmpresa(); ?>" maxlength="18" class="docCNPJ" /></label>
			<br />
			<label>Inscrição Estadual:<input type="text" name="insc" value="<?php echo $empresa->getInscricaoEstadualEmpresa(); ?>" class="docIE" /></label>
			<br />
			<label>Ramo de atividade:<input type="text" name="ramo" value="<?php echo $empresa->getRamoEmpresa(); ?>" class="long" /></label>
		</div>
    </fieldset>

    <?php
    $endereco= new Endereco();

    if(isset($_GET['endereco'])) {
        $endereco = (object)unserialize(base64_decode($_GET['endereco']));
    }
    ?>

	<p class="caption"> Contato</p>
    <fieldset>
        <div class="left">
            <label>Rua, avenida, logradouro:<input type="text" name="rua" value="<?php echo $endereco->getRuaEndereco(); ?>" class="long" /></label>
            <label>Número:<input type="text" name="numero" value="<?php echo $endereco->getRuaEndereco(); ?>" class="num" /></label>
            <br />
            <label>Complemento:<input type="text" name="complemento" value="<?php echo $endereco->getComplementoEndereco(); ?>" class="long" /></label>
            <br />
            <label>Bairro:<input type="text" name="bairro" value="<?php echo $endereco->getBairroEndereco(); ?>" class="long" /></label>
            <label>CEP:<input type="text" name="cep" value="<?php echo $endereco->getCepEndereco(); ?>" maxlength="10" class="CEP" /></label>
            <br />
            <label>Cidade:<input type="text" name="cidade" value="<?php echo $endereco->getCidadeEndereco(); ?>" class="long" /></label>
            <label>Estado:
                <select name="estado">
                    <option selected></option>
                    <option value="MT" <?php echo ($endereco->getEstadoEndereco()==="MT")? "selected":""; ?>>MT</option>
                </select>
            </label>
        </div>
        <div class="right">
            <label>DDD - Telefone:<input type="text" name="telefone" value="<?php echo $endereco->getTelefoneEndereco(); ?>" maxlength="12" class="fone" ></label>
            <br />
            <label>DDD - Celular:<input type="text" name="celular" value="<?php echo $endereco->getCelEndereco(); ?>" maxlength="12" class="fone" ></label>
            <br />
            <label>DDD - Fax:<input type="text" name="fax" value="<?php echo $endereco->getFaxEndereco(); ?>" maxlength="12" class="fone" ></label>
            <br />
            <label>E-mail:<input type="text" name="email" value="<?php echo $endereco->getEmailEndereco(); ?>" class="email" /></label>
        </div>
    </fieldset>

    <?php
    $pessoa = new Pessoa();

    if(isset($_GET['pessoaDiretor'])) {
        $pessoa = (object)unserialize(base64_decode($_GET['pessoaDiretor']));
    }

    ?>

    <fieldset>
        <label>Dados do diretor?
        </label>
            <select name="preenche">
                <option></option>
                <option value="Sim">Sim</option>
                <option value="Não">Não</option>
            </select>
	</fieldset>
	
	<p class="caption">Dados do diretor</p>
    <fieldset>
        <div class="left">
            <label>Nome:<input type="text" name="nome" value="<?php echo $pessoa->getNomePessoa(); ?>" class="nome" /></label>
            <label>Nascimento:<input type="text" name="dataNascimento" value="<?php echo $formataData->toViewDate($pessoa->getDataNascimentoPessoa()); ?>" maxlength="10" class="data" /></label>
            <br />
            <label>Sexo:
                <select name="sexo">
                    <option selected></option>
                    <option value="M"<?php echo ($pessoa->getSexoPessoa()=="M")?"selected":""; ?>>Masculino</option>
                    <option value="F"<?php echo ($pessoa->getSexoPessoa()=="F")?"selected":""; ?>>Feminino</option>
                </select>
            </label>
            <label>Estado Civil:
                <select name="estadoCivil">
                    <option selected></option>
                    <option value="Casado" <?php echo ($pessoa->getEstadoCivilPessoa()==="Casado")?"selected":""; ?>>Casado(a)</option>
                    <option value="Solteiro" <?php echo ($pessoa->getEstadoCivilPessoa()==="Solteiro")?"selected":""; ?>>Solteiro(a)</option>
                    <option value="União EstÃ¡vel" <?php echo ($pessoa->getEstadoCivilPessoa()==="União EstÃ¡vel")?"selected":""; ?>>União EstÃ¡vel</option>
                </select>
            </label>
        </div>
        <div class="right">
            <label>RG:<input type="text" name="rg" value="<?php echo $pessoa->getRgPessoa(); ?>" class="docRG" /></label>
            <label>Órgao Exp.:<input type="text" name="rg_orgao" value="<?php echo $pessoa->getOrgExpPessoa(); ?>" maxlength="3" class="small" /></label>
            <label>UF:
                <select name="rg_uf">
                    <option selected></option>
                    <option value="MT" <?php echo ($pessoa->getUfOrgExpPessoa()==="MT")? "selected":""; ?>>MT</option>
                </select>
            </label>
            <br />
            <label>CPF:<input type="text" name="cpf" value="<?php echo $pessoa->getCpfPessoa(); ?>" maxlength="14" class="docCPF" /></label>
        </div>
		</fieldset>

        <?php
        $enderecoDiretor= new Endereco();

        if(isset($_GET['enderecoDiretor'])) {
            $enderecoDiretor = (object)unserialize(base64_decode($_GET['enderecoDiretor']));
        }        
        ?>

		<p class="caption">Endereço</p>
		<fieldset>
        <div class="left">
            <label>Rua, avenida, logradouro:<input type="text" name="ruaDiretor" value="<?php echo $enderecoDiretor->getRuaEndereco(); ?>" class="long" /></label>
            <label>Número:<input type="text" name="numeroDiretor" value="<?php echo $enderecoDiretor->getRuaEndereco(); ?>" class="num" /></label>
            <br />
            <label>Complemento:<input type="text" name="complementoDiretor" value="<?php echo $enderecoDiretor->getComplementoEndereco(); ?>" class="long" /></label>
            <br />
            <label>Bairro:<input type="text" name="bairroDiretor" value="<?php echo $enderecoDiretor->getBairroEndereco(); ?>" class="long" /></label>
            <label>CEP:<input type="text" name="cepDiretor" value="<?php echo $enderecoDiretor->getCepEndereco(); ?>" maxlength="10" class="CEP" /></label>
            <br />
            <label>Cidade:<input type="text" name="cidadeDiretor" value="<?php echo $enderecoDiretor->getCidadeEndereco(); ?>" class="long" /></label>
            <label>Estado:
                <select name="estadoDiretor">
                    <option selected></option>
                    <option value="MT" <?php echo ($endereco->getEstadoEndereco()==="MT")? "selected":""; ?>>MT</option>
                </select>
            </label>
        </div>
        <div class="right">
            <label>DDD - Telefone:<input type="text" name="telefoneDiretor" value="<?php echo $enderecoDiretor->getTelefoneEndereco(); ?>" maxlength="12" class="fone" ></label>
            <br />
            <label>DDD - Celular:<input type="text" name="celularDiretor" value="<?php echo $enderecoDiretor->getCelEndereco(); ?>" maxlength="12" class="fone" ></label>
            <br />
            <label>DDD - Fax:<input type="text" name="faxDiretor" value="<?php echo $enderecoDiretor->getFaxEndereco(); ?>" maxlength="12" class="fone" ></label>
            <br />
            <label>E-mail:<input type="text" name="emailDiretor" value="<?php echo $enderecoDiretor->getEmailEndereco(); ?>" class="email" /></label>
        </div>
		</fieldset>

        <?php
        $pessoaConjugue = new Pessoa();

        if(isset($_GET['pessoaConjugue'])) {
            $pessoaConjugue = (object) unserialize(base64_decode($_GET['pessoaConjugue']));
        }

        ?>

        <p class="caption">Dados do(a) cônjuge</p>
		<fieldset>
        <div class="left">
            <label>Nome:<input type="text" name="nomeConjugue" value="<?php echo $pessoaConjugue->getNomePessoa(); ?>" class="nome" /></label>
            <label>Nascimento:<input type="text" name="dataNascimentoConjugue" value="<?php echo $formataData->toViewDate($pessoaConjugue->getDataNascimentoPessoa()); ?>" maxlength="10" class="data" /></label>
            <br />
            <label>Sexo:
                <select name="sexoConjugue">
                    <option selected></option>
                    <option value="M"<?php echo ($pessoaConjugue->getSexoPessoa()=="M")?"selected":""; ?>>Masculino</option>
                    <option value="F"<?php echo ($pessoaConjugue->getSexoPessoa()=="F")?"selected":""; ?>>Feminino</option>
                </select>
            </label>
        </div>
        <div class="right">
            <label>RG:<input type="text" name="rgConjugue" value="<?php echo $pessoaConjugue->getRgPessoa(); ?>" class="docRG" /></label>
            <label>Órgao Exp.:<input type="text" name="rg_orgaoConjugue" value="<?php echo $pessoaConjugue->getOrgExpPessoa(); ?>" maxlength="3" class="small" /></label>
            <label>UF:
                <select name="rg_ufConjugue">
                    <option selected></option>
                    <option value="MT" <?php echo ($pessoa->getUfOrgExpPessoa()==="MT")? "selected":""; ?>>MT</option>
                </select>
            </label>
            <br />
            <label>CPF:<input type="text" name="cpfConjugue" value="<?php echo $pessoaConjugue->getCpfPessoa(); ?>" maxlength="14" class="docCPF" />
            </label>
        </div>
    </fieldset>

</form>