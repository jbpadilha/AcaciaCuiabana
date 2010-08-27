<?php
	require_once ('../class/Config.php');

	if (!isset($_SESSION['usuarioLogon'])) header("Location:../views/home.php?p=login");

	$logon = new Logon();
	$logon = $_SESSION["usuarioLogon"];
	$condutores = new Condutores();
	$cnh = new Cnh();

	if (isset($_SESSION['condutoresAtual'])) $condutores = $_SESSION['condutoresAtual'];

	if (isset($_SESSION['cnhAtual'])) $cnh = $_SESSION['cnhAtual'];
?>
<form method="post" action="../class/RecebePostGet.php">

    <div class="botoes">
        <input type="reset" value="Limpar campos" />
        <input name="completo" type="submit" value="Confirmar" />
    </div>

    <p class="caption">Cadastro de condutores</p>
	<fieldset>
    <div class="left">
        <label>Nome:
            <select name="pessoaCondutor" class="long">
                <option></option>
                <?php
                $pessoas = new Pessoa();
                $pessoas->setIdCliente($logon->getIdClientes());
                $collVoPessoaCliente = $controla->findPessoas($pessoas);

                if ($collVoPessoaCliente!=null) {
                    foreach ($collVoPessoaCliente as $pessoaAtual) {
                        $pessoas = $pessoaAtual;
                        ?>
                <option value="<?php echo $pessoas->getIdPessoa(); ?>"<?php echo ($condutores->getIdPessoa())?"Selected":""; ?>><?php echo $pessoas->getNomePessoa(); ?></option>
                        <?php
                    }
                }
                ?>
            </select>
        </label>
        <br />
    </div>
    <div class="right">
        <label>Nº CNH
            <input type="text" name="cnh" value="<?php echo $cnh->getNumeroCnh(); ?>" maxlength="12" class="docCNH" />
        </label>
        <label>UF
            <select name="cnhuf">
                <option></option>
                <option value="MT" <?php echo ($cnh->getUfCnh()==="MT")? "selected":""; ?>>MT</option>
            </select>
        </label>
        <label>Cat. CNH:
            <input type="text" name="cnhcat" value="<?php echo $cnh->getCategoriaCnh(); ?>" maxlength="2" class="small" />
        </label>
        <label>Vencimento CNH:
            <input type="text" name="cnhvcto" value="<?php echo $formataData->toViewDate($cnh->getVencCnh())?>" maxlength="10" class="data" />
        </label>
    </div>
	</fieldset>

	<input type="hidden" name="acao" value="cadastroMotorista" />
	<input type="hidden" name="idCliente" value="<?php echo $logon->getIdClientes(); ?>" />

</form>