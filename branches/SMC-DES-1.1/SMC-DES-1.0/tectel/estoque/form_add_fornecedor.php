<form method="post" name="form_fornecedores" id="form_fornecedores" action="">
	<fieldset>
		<?php TitleBar(); ?>
		<div id="fornecedores" class="formulario">
			<div class="left">
				<?php criarInputs('fornecedores'); ?>
			</div>
			<?php Submit(); ?>
		</div>
		<span id="legenda"></span>
	</fieldset>
</form>
