<?php 
include 'carregamentoInicial.php';
?>
<script type="text/javascript">
	$(document).ready(function(){
		$("#salarioHipo").maskMoney({symbol:"R$",decimal:",",thousands:"."})
		$("#rendaHipo").maskMoney({symbol:"R$",decimal:",",thousands:"."})
	});
	function pesquisaPessoa()
	{
		var formulario = $('#hipossuficiencia').serialize(true);
		carregaPagina('pessoa.php?paramentrosPessoaHipo=1&'+formulario,'page');
	}
	function cadastra()
	{
		if ( $('#idPessoa').val() == '' ) {
			alert('A pessoa deve ser informado.');
			return false;
		} else {
			var formulario = $('#hipossuficiencia').serialize(true);
			enviaFormulario($('#hipossuficiencia').attr("action"),'page',formulario);
		}
	}
</script>
<?php
if(isset($_GET['gerarFicha']))
{
?>
<legend class="subtitulo">Gerar Ficha Hipossuficiência:</legend>
<br/>
<form name="FichaHipo" id="FichaHipo" method="get" action="../application/recebePostGet.php" target="_blank">
	<input type="hidden" id="control" name="control" value="GerarPDF"/>
	<input type="hidden" id="funcao" name="funcao" value="FichaHipo"/>
	<input type="hidden" id="idhipossuficiencia" name="idhipossuficiencia" value="<?=$_GET['idhipossuficiencia']?>"/>
	<input type="submit" name="submit" id="submit" value="Gerar Ficha Hipo em PDF"/>
</form>
<br/><br/><br/>
<?php
}
?>
<legend class="subtitulo">Cadastro de Hipossuficiência:</legend>
<br/>
<br/>
<form name="hipossuficiencia" id="hipossuficiencia" method="post" action="../application/recebePostGet.php">
	<input type="hidden" id="control" name="control" value="Hipossuficiencia"/>
	<input type="hidden" id="funcao" name="funcao" value="cadastrar"/>
	<table>
		<tr>
			<td width="83">Pessoa:</td>
			<td width="194" align="left">
				<input type="hidden" id="idpessoaHipo" name="idpessoaHipo" value="<?=(isset($_GET['idpessoaHipo']))?$_GET['idpessoaHipo']:""?>"/>
				<input type="hidden" id="nomeHipo" name="nomeHipo" value="<?=(isset($_GET['nomeHipo']))?$_GET['nomeHipo']:""?>"/>
				<?=(isset($_GET['nomeHipo']))?$_GET['nomeHipo']:""?>
				</td>
			<td width="385" align="left"><input type="button" name="selecione" id="selecione" value="Selecione" onclick="pesquisaPessoa()"/></td>
			<td align="left">&nbsp;</td>
		</tr>
		<tr>
			<td>Profissão:</td>
			<td colspan="3">
				<input type="text" name="profHipo" id="profHipo" value="<?=(isset($_GET['profHipo']))?$_GET['profHipo']:""?>">
			</td>
		</tr>
		<tr>
			<td>Salário:</td>
			<td colspan="3">
				<input type="text" name="salarioHipo" id="salarioHipo" value="<?=(isset($_GET['salarioHipo']))?$_GET['salarioHipo']:""?>">
			</td>
		</tr>
		<tr>
			<td>Empresa:</td>
			<td colspan="3">
				<input type="text" name="empresaHipo" id="empresaHipo" value="<?=(isset($_GET['empresaHipo']))?$_GET['empresaHipo']:""?>">
			</td>
		</tr>
		<tr>
			<td>Renda:</td>
			<td colspan="3">
				<input type="text" name="rendaHipo" id="rendaHipo" value="<?=(isset($_GET['rendaHipo']))?$_GET['rendaHipo']:""?>">
			</td>
		</tr>
		<tr>
			<td>Observações:</td>
			<td colspan="2">
				<textarea rows="8" cols="100" id="observacoesHipo" name="observacoesHipo"><?=(isset($_GET['observacoesHipo']))?$_GET['observacoesHipo']:""?></textarea>
			</td>
			<td width="213"><input type="button" name="submit" id="submit" value="Cadastrar" onclick="cadastra()"/></td>
		</tr>
	</table>
</form>
