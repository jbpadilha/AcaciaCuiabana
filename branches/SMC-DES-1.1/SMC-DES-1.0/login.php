<link type="text/css" rel="Stylesheet" media="screen" href="/_global/_css/smc/login.css" />

<div id="conteudo_top" style="border-bottom:4px solid #F84; ">
	<a href="home.php?page=login&acao=login" target="_self" class="login">
		<img src="/_global/_img/smc/right.png" alt="" />
		Sou cadastrado
	</a>

	<a href="home.php?page=login&acao=cadastro" target="_self" class="cadastro">
		<img src="/_global/_img/smc/right.png" alt="" />
		Não sou cadastrado
	</a>
</div>

<div id="conteudo">

	<form method="post" action="/smc/class/RecebePostGet.php">
<?php
	if (!$_GET['acao'] || $_GET['acao'] == 'login') {
?>
		<label>Login:
			<input type="text" name="login" maxlength="14" class="docCPF" />
		</label>
		<br />
		<label>Senha:
			<input type="password" name="senha" maxlength="12" class="senha" />
		</label>
		<br />
		<input type="submit" value="Entrar" />
		<input type="hidden" name="loginAdm" value="1" />
<?php
	} else {
?>
		<label>Nome completo:
			<input type="text" name="lnome" class="nome" />
		</label>
		<br />
		<label>E-mail:
			<input type="text" name="lemail" class="email" />
		</label>
		<br />
		<label>CPF:
			<input type="text" name="llogin" maxlength="14" class="docCPF" />
		</label>
		<br />
		<label>Senha:
			<input type="password" name="lsenha" maxlength="12" class="senha" />
		</label>
		<label>Confirma senha:
			<input type="password" name="lsenha2" maxlength="12" class="senha" />
		</label>

		<br />
		<br />

		<input type="hidden" name="acao" value="cadastroLogin" />
		<input type="submit" name="cadastra" value="Cadastrar" />
		
<script type="text/javascript">
$(document).ready(function() {
	$('[type="submit"]').hide();
	$('[name="lsenha2"]').bind({
		keyup: function() {
			var senha1 = $('[name="lsenha"]').val();
			var senha2 = $('[name="lsenha2"]').val();
			if (senha1 == senha2) $('[type="submit"]').show();
			else $('[type="submit"]').hide();
		}
	});
});
</script>

<?php
	}
?>
	</form>

</div>

<div id="conteudo_bottom"></div>