<fieldset class="cadastro"><legend onclick="show('formcadastro','formlogin')"><label><img src="imagens/right.png" alt="" />Não sou registrado</label></legend>
	<form id="formcadastro" class="cadastro" name="loga" action="painel/cadastra.php" method="post" onsubmit="return checkform(this)">
		<p> <label for="lnome" 	> Nome completo: 	</label> <input class="nome" 	type="text" 	name="lnome" 	id="lnome" 	></p>
		<p> <label for="lemail" > E-mail: 			</label> <input class="nome" 	type="text" 	name="lemail" 	id="lemail" ></p>
		<p> <label for="llogin" > CPF: 				</label> <input class="normal" 	type="text" 	name="llogin"	id="llogin" maxlength="14" onkeypress="return mascara(event,this,'###.###.###-##');" ><label for="llogin" class="obs">(Login)</label></p>
		<p> <label for="lsenha" > Senha: 			</label> <input class="normal" 	type="password" name="lsenha" 	id="lsenha" maxlength="14" ></p>
		<input type="submit" class="botao" value="Cadastrar" name="cadastra">
	</form>
</fieldset>
