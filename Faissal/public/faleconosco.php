<?php 
include ('carregamentoInicial.php');
include_once( 'ckeditor/ckeditor_php5.php' ) ;
if(isset($_POST['enviado']))
{
	$to = "joao.padilha@globo.com";//juracy_oliveira@terra.com.br
	$subject = $_POST['assunto'];
	$html = "
	<html>
	<body>
	".$_POST['descricao']."
	</body>
	</html>";
	$headers = "Content-Type: text/html; charset=iso-8859-1\n";
	$headers .="From: FAISSAL <joao.padilha@globo.com>";
	
	if (mail($to, $subject, $html, $headers)) {
	echo "<script>alert('Mensagem enviada com sucesso !');</script>";
	} else {
	echo "<script>alert('Ocorreu um erro durante o envio do email. Tente novamente');</script>";
	}
}

?>
<script type="text/javascript">
function enviar()
{
	if ( $('#nome').val() == '' && $('#assunto').val() == '') {
		alert('Todos campos devem ser preenchidos!');
		return false;
	} else {
		$('#descricao').val(CKEDITOR.instances.descricao.getData());
		var formulario = $('#cadastrar').serialize(true);
		enviaFormulario($('#cadastrar').attr("action"),'conteudo',formulario);
	}
}
</script>

<div>
	<h1 class="art-postheader">Fale Conosco</h1>
</div>
<form name="cadastrar" id="cadastrar" method="post" action="faleconosco.php">
	<input type="hidden" id="enviado" value="true" name="enviado">
	<table width="100%">
		<tr>
			<td valign="top"><p>Nome:</p></td>
			<td valign="top">
				<input type="text" id="nome" name="nome" value="" size="60">
			</td>
		</tr>
		<tr>
			<td valign="top"><p>Assunto:</p></td>
			<td valign="top">
				<input type="text" id="assunto" name="assunto" value="" size="20">
			</td>
		</tr>
		<tr>
			<td valign="top"><p>Descrição:</p></td>
			<td valign="top" colspan="2">
				<?php 
				$CKEditor = new CKEditor();
 				$CKEditor->editor("descricao", "");
 				?>
			</td>
		</tr>
		<tr>
			<td colspan="3">
				<input type="button" name="submit" id="submit" value="Enviar" onclick="enviar()"/>
			</td>
		</tr>
	</table>
</form>