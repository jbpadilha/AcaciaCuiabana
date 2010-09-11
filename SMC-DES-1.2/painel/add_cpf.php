<?php
	require_once ('../class/Config.php');

	if(!isset($_SESSION['usuarioLogon'])) {
		header("Location:../views/home.php?p=login");
	}

	$logon = new Logon();
	$logon = $_SESSION["usuarioLogon"];
	$pessoa = new Pessoa();

	if(isset($_SESSION['pessoaAtual'])) {
		$pessoa = $_SESSION['pessoaAtual'];
	}
?>
<form method="post" action="../class/RecebePostGet.php">
	<input type="hidden" name="acao" value="cadastroPessoa" />
    <div class="botoes">
        <button type="reset" accesskey="L">Limpar campos</button>
        <button type="submit" name="completo" accesskey="C">Confirmar</button>
    </div>
	<p class="caption">
		Cliente
	</p>
	<fieldset>
       	<?php
       	if($logon->getIdClientes() != null)
       	{ 
       	?>
       	<input type="hidden" name="idCliente" value="<?=$logon->getIdClientes(); ?>" />
       	<?php 
       	}
       	else
       	{
       	?>
             <label>Nome
				<select name="idCliente" class="long">
					<option><?=SELECIONE?></option>
                    <?php 
						$clientes = new Clientes();
                    	$listaClientes = $controla->findClientes($clientes);
						if($listaClientes != null)
						{
							$clientes = new Clientes();
							foreach ($listaClientes as $cliente)
							{
								$clientes = $cliente;
								echo "<option value=\"{$clientes->getIdClientes()}\">{$clientes->getNomeCliente()}</option>";
							}
						} 
					?>
                    </select>
             </label>
		<?php 
       	}
		?>
    </fieldset>
	<p class="caption">Dados pessoais</p>
    <fieldset>
        <div class="left">
            <label>Nome:<input type="text" name="nome" value="<?php echo $pessoa->getNomePessoa(); ?>" class="nome" /></label>
            <label>Nascimento:<input type="text" name="dataNascimento" value="<?php echo $formataData->toViewDate($pessoa->getDataNascimentoPessoa()); ?>" class="data" /></label>
            <br />
            <label>Sexo:
                <select name="sexo">
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
					<?=$dominio->listaDominioEstadoCivilSelect($pessoa->getEstadoCivilPessoa())?>
            </label>
        </div>

        <div class="right">
            <label>RG:<input type="text" name="rg" value="<?php echo $pessoa->getRgPessoa(); ?>" class="docRG" /></label>
            <label>Órgao Exp.:<input type="text" name="rg_orgao"  value="<?php echo $pessoa->getOrgExpPessoa(); ?>" maxlength="3" class="small" /></label>
            <label>UF:
                <select name="rg_uf">
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
            <label>CPF:<input type="text" name="cpf" value="<?php echo $pessoa->getCpfPessoa(); ?>" maxlength="14" class="docCPF" /></label>
        </div>
    </fieldset>

    <?php
    $endereco= new Endereco();

    if(isset($_SESSION['enderecoAtual'])) {
        $endereco = $_SESSION['enderecoAtual'];
    }
    ?>

	<p class="caption">Dados para contato</p>
    <fieldset>
        <div class="left">
            <label>Endereço:<input type="text" name="rua"  value="<?php echo $endereco->getRuaEndereco(); ?>" class="long" /></label>
            <br />
            <label>Complemento:<input type="text" name="complemento"  value="<?php echo $endereco->getComplementoEndereco(); ?>" class="long" /></label>
            <br />
            <label>Bairro:<input type="text" name="bairro"  value="<?php echo $endereco->getBairroEndereco(); ?>" class="long" /></label>
            <label>CEP:<input type="text" name="cep"  value="<?php echo $endereco->getCepEndereco(); ?>" maxlength="10" class="CEP" /></label>
            <br />
            <label>Cidade:<input type="text" name="cidade"  value="<?php echo $endereco->getCidadeEndereco(); ?>" class="long" /></label>
            <label>Estado:
                <select name="estado">
					<option></option>
					<?php
					foreach ($estados as $uf => $estado) {
						$attr = $pessoa->getUfOrgExpPessoa() == $uf ? "selected":"";
						echo "\n<option value=\"".$uf."\"".$attr.">".$uf."</option>";
					}
					?>
                </select>
            </label>
        </div>
        <div class="right">
            <label>DDD - Telefone:<input type="text" name="telefone" value="<?php echo $endereco->getTelefoneEndereco(); ?>" maxlength="14" class="fone" /></label>
            <br />
            <label>DDD - Celular:<input type="text" name="celular" value="<?php echo $endereco->getCelEndereco(); ?>" maxlength="14" class="fone" /></label>
            <br />
            <label>DDD - Fax:<input type="text" name="fax" value="<?php echo $endereco->getFaxEndereco(); ?>" maxlength="14" class="fone" /></label>
            <br />
            <label>E-mail:<input type="text" name="email"  value="<?php echo $endereco->getEmailEndereco(); ?>" class="email" /></label>
        </div>
    </fieldset>

    <?php
    $pessoaConjugue = new Pessoa();

    if(isset($_SESSION['pessoaConjugue'])) {
        $pessoaConjugue = $_SESSION['pessoaConjugueAtual'];
    }
    ?>

	<p class="caption">Dados do(a) cônjuge</p>
    <fieldset>
        <div class="left">
            <label>Nome:<input type="text" name="nomeConjugue" value="<?php echo $pessoaConjugue->getNomePessoa(); ?>" class="email" /></label>
            <label>Nascimento:<input type="text" name="dataNascimentoConjugue" value="<?php echo $formataData->toViewDate($pessoaConjugue->getDataNascimentoPessoa()); ?>" maxlength="10" class="data" /></label>
            <br />
            <label>Sexo:
                <select name="sexoConjugue">
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
            <label>RG:<input type="text" name="rgConjugue" value="<?php echo $pessoaConjugue->getRgPessoa(); ?>" class="docRG" /></label>
            <label>Órgao Exp.:<input type="text" name="rg_orgaoConjugue"  value="<?php echo $pessoaConjugue->getOrgExpPessoa(); ?>" maxlength="6" class="small" /></label>
            <label>UF:
                <select name="rg_ufConjugue">
					<option></option>
					<?php
					foreach ($estados as $uf => $estado) {
						$attr = $pessoaConjugue->getUfOrgExpPessoa() == $uf ? "selected":"";
						echo "\n<option value=\"".$uf."\"".$attr.">".$uf."</option>";
					}
					?>
                </select>
            </label>
            <br />
            <label>CPF:<input type="text" name="cpfConjugue" value="<?php echo $pessoaConjugue->getCpfPessoa(); ?>" maxlength="14" class="docCPF" /></label>
        </div>
    </fieldset>
</form>