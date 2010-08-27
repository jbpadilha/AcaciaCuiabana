<form method="post" name="form_familias" id="form_familias" action="">
	<fieldset>
		<?php TitleBar(); ?>
		<div id="categorias" class="formulario">
<?php
	criarInputs('categorias');
	Submit();
?>
		</div>
		<span id="legenda"></span>
	</fieldset>
</form>
