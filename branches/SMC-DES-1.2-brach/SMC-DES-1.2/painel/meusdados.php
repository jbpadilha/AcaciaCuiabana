<?php 
	require_once ('../class/Config.php');

	if(!isset($_SESSION['usuarioLogon'])) header("Location:/smc/home.php?p=login");

	$logon = new Logon();
	$logon = $_SESSION["usuarioLogon"];
	$pessoa = new Pessoa();
	$pessoa->setIdPessoa($logon->getIdPessoa());
	$collVoPessoa = $controla->findPessoas($pessoa);
	if(!is_null($collVoPessoa)) $pessoa = $collVoPessoa[0];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br" lang="pt-br">

<head>
	<title>SMC - Serviço de Manutenção e Consultoria</title>
	<link rel="SHORTCUT ICON" href="imagens/smc.ico" />
	<meta http-equiv="Content-Language" content="pt-BR" />
	<meta name="author" content="Júnior Mendonça" />
	<meta name="copyright" content="SMC - Serviço de Manutenção e Consultoria">
	<meta name="description" content="SMC - Manutenção como deve ser feita." />
	<meta name="keywords" lang="pt-br" content="smc, serviço despertador, servico despertador, servicodespertador, manutenção, preventiva, gestão, frotas, ativos" />

	<link type="text/css" rel="stylesheet" media="screen" href="/_global/_css/smc/demo.css" />

	<script type="text/javascript" language="javascript" src="/_global/_js/jquery-1.4.2.js"></script>
	<script type="text/javascript" language="javascript" src="/_global/_js/jquery.maskedinput-1.2.2.js"></script>
	<script type="text/javascript" language="javascript" src="/_global/_js/jquery.price_format.1.2.js"></script>
	<script type="text/javascript" language="javascript" src="/_global/_js/jquery.gt.extensions.js"></script>
	<script type="text/javascript" language="javascript" src="/_global/_js/demo.js"></script>
</head>

<body>

<?php
	if(isset($_GET['msg'])) {
		echo "<script>alert('{$_GET['msg']}');</script>";
	}
?>

    <form>

		<div class="botoes">
			<button type="reset" accesskey="L">Limpar campos</button>
			<button type="submit" name="completo" accesskey="C">Confirmar</button>
        </div>

        <p class="caption">Dados pessoais</p>

        <fieldset>
            <div class="left">
                <label>Nome:
                    <input type="text" name="nome_cliente" readonly value="<?php echo $pessoa->getNomePessoa(); ?>" class="nome" />
                </label>
                <label>Nascimento:
                    <input type="text" name="nascimento_cliente" value="<?php echo $formataData->toViewDate($pessoa->getDataNascimentoPessoa()); ?>" class="data" />
                </label>
                <br />
                <label>Sexo:
                    <select name="sexo_cliente">
                        <option></option>
						<?php
						foreach ($sexo as $x => $xx) {
							$x = strtoupper($x);
							$xx = strtoupper($xx);
							$attr = $pessoa->getSexoPessoa() == $x ? " selected" : "";
							echo "\n<option value=\"".$x."\"".$attr.">".$xx."</option>";
						}
						?>
                    </select>
                </label>
                <label>Estado Civil:
                    <select name="ecivil_cliente">
                        <option></option>
						<?php
						$n = 1;
						foreach ($estadoCivil as $x) {
							$x = strtoupper($x);
							$attr = $pessoa->getEstadoCivilPessoa() == $n ? " selected" : "";
							echo "\n<option value=\"".$x."\"".$attr.">".$x."</option>";
							$n++;
						}
						?>
                    </select>
                </label>
                <br />
                <label>Observações:
                    <input type="text" name="nota" value="<?php echo $pessoa->getComplementoPessoa(); ?>" class="long" />
                </label>
            </div>
            <div class="right">
                <label>RG:
                    <input type="text" name="rg_cliente" value="<?php echo $pessoa->getRgPessoa(); ?>" class="docRG" />
                </label>
                <label>Órgao Exp.:
                    <input type="text" name="orgexprg_cliente" value="<?php echo $pessoa->getOrgExpPessoa(); ?>" class="small" />
                </label>
                <label>UF:
                    <select name="ufexprg_cliente">
                        <option></option>
						<?php
						foreach ($estados as $uf => $estado) {
							$attr = $pessoa->getUfOrgExpPessoa() == $uf ? " selected" : "";
							echo "\n<option value=\"".$uf."\"".$attr.">".$uf."</option>";
						}
						?>
                    </select>
                </label>
				<br />
                <label>CPF:
                    <input type="text" readonly name="cpf_cliente" value="<?php echo $pessoa->getCpfPessoa(); ?>" class="docCPF" />
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
                    <input type="text" name="rua_contato" value="<?php echo $endereco->getRuaEndereco(); ?>" class="long" />
                </label>
                <br />
                <label>Complemento:
                    <input type="text" name="complemento_contato" value="<?php echo $endereco->getComplementoEndereco(); ?>" class="long" />
                </label>
                <br />
                <label>Bairro:
                    <input type="text" name="bairro_contato" value="<?php echo $endereco->getBairroEndereco(); ?>" class="long" />
                </label>
                <label>CEP:
                    <input type="text" name="cep_contato" value="<?php echo $endereco->getCepEndereco(); ?>" class="CEP" />
                </label>
                <br />
                <label>Cidade:
                    <input type="text" name="cidade_contato" value="<?php echo $endereco->getCidadeEndereco(); ?>" class="long" />
                </label>
                <label>Estado:
                    <select name="estado_contato">
                        <option></option>
						<?php
						foreach ($estados as $uf => $estado) {
							$attr = $endereco->getEstadoEndereco() == $uf ? "selected":"";
							echo "\n<option value=\"".$uf."\"".$attr.">".$uf."</option>";
						}
						?>
                    </select>
                </label>
                <br />
            </div>
            <div class="right">
                <label>Telefone:
                    <input type="text" name="tel_contato" value="<?php echo $endereco->getTelefoneEndereco(); ?>" class="fone" />
                </label>
                <br />
                <label>Celular:
                    <input type="text" name="cel_contato" value="<?php echo $endereco->getCelEndereco(); ?>" class="fone" />
                </label>
                <br />
                <label>Fax:
                    <input type="text" name="fax_contato" value="<?php echo $endereco->getFaxEndereco(); ?>" class="fone" />
                </label>
                <br />
                <label>E-mail:
                    <input type="text" name="email_contato" value="<?php echo $endereco->getEmailEndereco(); ?>" class="email" />
                </label>
            </div>
        </fieldset>
<?php
	if ($pessoa->getIdConjuguePessoa() != null) {
		$pessoaConjugue = new Pessoa();
		$pessoaConjugue->setIdPessoa($pessoa->getIdConjuguePessoa());
		$collVoConjugue = $controla->findPessoas($pessoaConjugue);
		
		if (!is_null($collVoConjugue)) $pessoaConjugue = $collVoConjugue[0];
?>
        <p class="caption">Dados do cônjuge</p>

        <fieldset>
            <div class="left">
                <label>Nome:
                    <input type="text" name="nome_conjuge" value="<?php echo $pessoaConjugue->getNomePessoa(); ?>" class="nome" />
                </label>
                <label>Nascimento:
                    <input type="text" name="nasc_conjuge" value="<?php echo $formataData->toViewDate($pessoaConjugue->getDataNascimentoPessoa()); ?>" class="data" />
                </label>
				<br />
                <label>Sexo:
                    <select name="sexo_conjuge">
                        <option></option>
						<?php
						foreach ($sexo as $x => $xx) {
							$x = strtoupper($x);
							$xx = strtoupper($xx);
							$attr = $pessoaConjugue->getSexoPessoa() == $x ? " selected" : "";
							echo "\n<option value=\"".$x."\"".$attr.">".$xx."</option>";
						}
						?>
                    </select>
                </label>
            </div>
            <div class="right">
                <label>CPF:
                    <input type="text" name="cpf_conjuge" value="<?php echo $pessoaConjugue->getCpfPessoa(); ?>" maxlength="14" class="docCPF" />
                </label>
            </div>
        </fieldset>
            <?php
        }
        ?>
    </form>

</body>