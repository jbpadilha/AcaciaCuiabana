<?php
//####################################
// * João Batista Padilha e Silva Analista/Desenvolvedor (Ábaco Tecnologia)
// * Arquivo: Login.php
// * Criação: João Batista Padilha e Silva
// * Revisão:
// * Data de criação: 24/06/2008
//####################################
/**
 * Página de Login do Usuário. Informe o Login e a senha para acesso ao sistema
 */
include_once("config.php");

if(!stristr($_SERVER['HTTP_USER_AGENT'],'MSIE'))
	header("Content-Type: text/html; charset=UTF-8",true);
else 
	header("Content-Type: text/html; charset=ISO-8859-1");

?>
<style type="text/css">
#conteudo{
	height:400px;
}
</style>
<form name="form" action="class/ControlaPostGet.php" method="POST">
		<div style="position:absolute; border:1px solid #306181; background-color:#f8f9fb; width:280px; height:180px; /*padding-right:5px;*/top:50%;left:50%;margin-left:-140px;margin-top:-90px;">
			<div style="width:250px; height:49px; margin-top:10px; margin-left:20px; text-align:justify"><img src="imagens/ponto.gif" alt="" />&nbsp;&nbsp;Informe seu login e senha para acessar o sistema.</div>
			<table border="0" align="center" width="100%">
				<tr>
					<td class="formTdEsquerdo" width="80">Login</td>
					<td><input type="text" size="18" name="login" id="login" class="campo" /></td>
				</tr>
				<tr>
					<td class="formTdEsquerdo">Senha</td>
					<td><input type="password" size="18" name="senha" id="senha" class="campo" /></td>
				</tr>
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>          
				<tr>
					<td colspan="2" align="center"><input type="submit" value="   entrar   " name="btLogar" id="btLogar" class="botao"/></td>
				</tr>          
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>          
				<tr>
					<td colspan="2" align="right"><a href="javascript:carregaPagina('lembrarSenha.php','conteudo')" class="linkPequeno" title="Esqueceu sua senha? Clique aqui.">Esqueci minha senha</a></td>
				</tr>
			 </table>
		</div>
		<div id="msgResposta" style="position:absolute;top:75%;left:50%;margin-left:-150px;width:300px;"><span align="right"><?=(!empty($_GET["msg"]))?strip_tags(rawurldecode($_GET["msg"])):VERSAO?></span></div>
		<input name="idPedido" id="idPedido" type="hidden" value="<?=$idPedido?>"/>
		<input type="hidden" name="pagina" id="pagina" value="loginSistema"/>
</form>