<div id="conteudo_top">
	<h1>Contato</h1>
</div>

<div id="conteudo">
	<form name="formcontato" method="post" action="enviar_contato.php">
		<label>Nome:
			<input type="text" name="nome" class="nome" />
		</label>
		<br />
		<label>E-mail:
			<input type="text" name="email" class="email" />
		</label>
		<br />
		<label>Empresa:
			<input type="text" name="empresa" class="long" />
		</label>
		<br />
		<label>Fone:
			<input type="text" name="fone" maxlength="14" class="fone" />
		</label>
		<br />
		<label>Mensagem:
			<span></span>
			<textarea name="mensagem" cols="35" rows="6" ></textarea>
		</label>
		<br />

		<input type="submit" name="Submit" value="Enviar">
	</form>
</div>

<div id="conteudo_bottom">
</div>

<script type="text/javascript">
$('textarea').keyup(function() {
	if ($(this).html() == '') {
		$(this).prev('span').html('0 caracter.');
	} else {
		if ($(this).text().length <= 1) {
			texto = ' caracter.';
		} else {
			texto = ' caracteres.';
		}
		$(this).prev('span').html($(this).text().length + texto);
	}
});
</script>