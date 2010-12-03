<?php
require '../application/ProjetoUtil.php'; 
include 'carregamentoInicial.php';
session_start();
?>
<html>
	<head>
		<script type="text/javascript">

			function pesquisar()
			{
				if ( $('#nomePesquisa').val() == '' && $('#cpfPesquisa').val() == '') {
					alert('O nome ou CPF deve ser informado.');
					return false;
				}
				else
				{
					var formulario = $('#pesquisaPessoa').serialize(true);
					carregaPaginaPesquisa($('#pesquisaPessoa').attr("action"),'page',formulario);
				}
			}
			
			function alterar(idPessoa)
			{
				var formulario = $('#deletaAltera').serialize(true);
				carregaPagina('pessoa.php?idPessoa='+idPessoa+'&cadastro=true','page');
			}
			
			function deletar(idPessoa)
			{
				document.deletaAltera.function.value = "deletar";
				document.deletaAltera.idPessoa.value = idPessoa;
				var formulario = $('#deletaAltera').serialize(true);
				enviaFormulario($('#deletaAltera').attr("action"),'page',formulario);
			}
			function cadastra()
			{
				$(document).ready(function(){
					$('#pessoa').submit(function() {
						if ( $('#nomeCadastro').val() == '' ) {
							alert('O nome deve ser informado');
							return false;
						} 
						else if ( $('#sexo').val() == '' ) {
							alert('O sexo deve ser informado');
							return false;
						}
						else if ( $('#cpfCadastro').val() == '' ) {
							alert('O cpf deve ser informado');
							return false;
						}
						else if ( $('#estadocivil').val() == '' ) {
							alert('O estado civil deve ser informado');
							return false;
						}
						else if ( $('#datanascimento').val() == '' ) {
							alert('A data de nascimento deve ser informado');
							return false;
						}	
						else {
							var formulario = $('#pessoa').serialize(true);
							enviaFormulario($(this).attr("action"),'page',formulario);
						}
					});
				});
			}
			
			<?php 
			if(isset($_GET['paramentrosPessoa']))
			{
			?>
			function selecionarPessoa(idPessoa,nomePessoa)
			{
				carregaPagina('entrevista.php?nomePromovente=<?=($_GET['tipoParte'] == 1)?"'+nomePessoa+'":$_GET['nomePromovente']?>&nomePromovido=<?=($_GET['tipoParte'] == 2)?"'+nomePessoa+'":$_GET['nomePromovido']?>&idpessoaPromovente=<?=($_GET['tipoParte'] == 1)?"'+idPessoa+'":$_GET['idpessoaPromovente']?>&idpessoaPromovido=<?=($_GET['tipoParte'] == 2) ? "'+idPessoa+'" : $_GET['idpessoaPromovido']?>&nomeDefensor=<?=$_GET['nomeDefensor']?>&idDefensor=<?=$_GET['idDefensor']?>&paramentrosPessoa=<?=$_GET['paramentrosPessoa']?>&comarca=<?=$_GET['comarca']?>&tipoAcao=<?=$_GET['tipoAcao']?>&naturezaAcao=<?=$_GET['naturezaAcao']?>&juizo=<?=$_GET['juizo']?>&assunto=<?=$_GET['assunto']?>','page');
			}
			<?php 
			}
			?>
			<?php 
			if(isset($_GET['paramentrosPessoaHipo']))
			{
			?>
			function selecionarPessoa(idPessoa,nomePessoa)
			{
				carregaPagina('hipossuficiencia.php?nomeHipo='+nomePessoa+'&idpessoaHipo='+idPessoa+'&profHipo=<?=$_GET['profHipo']?>&salarioHipo=<?=$_GET['salarioHipo']?>&empresaHipo=<?=$_GET['empresaHipo']?>&rendaHipo=<?=$_GET['rendaHipo']?>&observacoesHipo=<?=$_GET['observacoesHipo']?>','page');
			}
			<?php 
			}
			?>
		</script>
	</head>
	<body>
<legend class="subtitulo"><?=(!isset($_GET['paramentrosPessoa']))?"Cadastro de Pessoa":"Pesquisa de Pessoa"?>:</legend>
<br/>

<form name="pesquisaPessoa" id="pesquisaPessoa" method="get" action="../application/recebePostGet.php" >
	<input type="hidden" id="control" name="control" value="Pessoa"/>
	<input type="hidden" id="pesquisa" name="pesquisa" value="true"/>
	<?php 
	if(isset($_GET['paramentrosPessoa']))
	{
	?>
	<input type="hidden" id="paramentrosPessoa" name="paramentrosPessoa" value="<?=$_GET['paramentrosPessoa']?>">
	<input type="hidden" id="comarca" name="comarca" value="<?=$_GET['comarca']?>">
	<input type="hidden" id="tipoAcao" name="tipoAcao" value="<?=$_GET['tipoAcao']?>">
	<input type="hidden" id="idDefensor" name="idDefensor" value="<?=$_GET['idDefensor']?>">
	<input type="hidden" id="naturezaAcao" name="naturezaAcao" value="<?=$_GET['naturezaAcao']?>">
	<input type="hidden" id="juizo" name="juizo" value="<?=$_GET['juizo']?>">
	<input type="hidden" id="idpessoaPromovente" name="idpessoaPromovente" value="<?=$_GET['idpessoaPromovente']?>">
	<input type="hidden" id="nomePromovente" name="nomePromovente" value="<?=$_GET['nomePromovente']?>">
	<input type="hidden" id="idpessoaPromovido" name="idpessoaPromovido" value="<?=$_GET['idpessoaPromovido']?>">
	<input type="hidden" id="nomePromovido" name="nomePromovido" value="<?=$_GET['nomePromovido']?>">
	<input type="hidden" id="assunto" name="assunto" value="<?=$_GET['assunto']?>">
	<input type="hidden" id="tipoParte" name="tipoParte" value="<?=$_GET['tipoParte']?>">
	<?php 
	}
	if(isset($_GET['paramentrosPessoaHipo']))
	{
	?>
	<input type="hidden" id="paramentrosPessoaHipo" name="paramentrosPessoaHipo" value="<?=$_GET['paramentrosPessoaHipo']?>">
	<input type="hidden" id="profHipo" name="profHipo" value="<?=$_GET['profHipo']?>">
	<input type="hidden" id="salarioHipo" name="salarioHipo" value="<?=$_GET['salarioHipo']?>">
	<input type="hidden" id="empresaHipo" name="empresaHipo" value="<?=$_GET['empresaHipo']?>">
	<input type="hidden" id="rendaHipo" name="rendaHipo" value="<?=$_GET['rendaHipo']?>">
	<input type="hidden" id="observacoesHipo" name="observacoesHipo" value="<?=$_GET['observacoesHipo']?>">

	<?php 
	}
	?>
	<fieldset>
		<legend class="subtitulo">Pesquisar Pessoa:</legend>
		<table>
			<tr>
				<td>A pesquisa pelo nome ou CPF é obrigatório.</td>
			</tr>
			<tr>
				<td>Nome:</td>
				<td colspan="2" align="left"><input type="text" name="nomePesquisa" id="nomePesquisa" style="text-transform: lowercase;" /></td>
			</tr>
			<tr>
				<td>CPF:</td>
				<td><input type="text" name="cpfpesquisa" id="cpfpesquisa" /></td>
				<td><input type="button" name="submit" id="submit" value="Pesquisar" onclick="pesquisar();"/></td>
			</tr>
		</table>
	</fieldset>
</form>
<?php 
if(isset($_GET['cadastro']))
{
	$pessoaAtual = new Pessoa();
	if(isset($_GET['idPessoa']))
	{
		$pessoaAtual->setIdpessoa($_GET['idPessoa']);
		$pessoaAtual->find(true);
	}
?>
<br/><br/><br/><br/>
<form name="pessoa" id="pessoa" method="post" action="../application/recebePostGet.php" >
	<input type="hidden" id="control" name="control" value="Pessoa"/>
	<input type="hidden" id="function" name="function" value="<?=(isset($_GET['idPessoa']))?"alterar":"cadastrar"?>"/>
	<input type="hidden" id="idPessoa" name="idPessoa" value="<?=$pessoaAtual->getIdpessoa()?>"/>
	<?php 
	if(isset($_GET['paramentrosPessoa']))
	{
	?>
	<input type="hidden" id="paramentrosPessoa" name="paramentrosPessoa" value="<?=$_GET['paramentrosPessoa']?>">
	<input type="hidden" id="comarca" name="comarca" value="<?=$_GET['comarca']?>">
	<input type="hidden" id="tipoAcao" name="tipoAcao" value="<?=$_GET['tipoAcao']?>">
	<input type="hidden" id="idDefensor" name="idDefensor" value="<?=$_GET['idDefensor']?>">
	<input type="hidden" id="naturezaAcao" name="naturezaAcao" value="<?=$_GET['naturezaAcao']?>">
	<input type="hidden" id="juizo" name="juizo" value="<?=$_GET['juizo']?>">
	<input type="hidden" id="idpessoaPromovente" name="idpessoaPromovente" value="<?=$_GET['idpessoaPromovente']?>">
	<input type="hidden" id="nomePromovente" name="nomePromovente" value="<?=$_GET['nomePromovente']?>">
	<input type="hidden" id="idpessoaPromovido" name="idpessoaPromovido" value="<?=$_GET['idpessoaPromovido']?>">
	<input type="hidden" id="nomePromovido" name="nomePromovido" value="<?=$_GET['nomePromovido']?>">
	<input type="hidden" id="assunto" name="assunto" value="<?=$_GET['assunto']?>">
	<input type="hidden" id="tipoParte" name="tipoParte" value="<?=$_GET['tipoParte']?>">
	<?php 
	}
	?>
	<table>
		<tr>
			<td width="120">Nome:</td>
			<td width="144" colspan="2"><input type="text" name="nomeCadastro" id="nomeCadastro" value="<?=$pessoaAtual->getNomepessoa()?>"/></td>		
		</tr>
		<tr>
			<td width="120">CPF:</td>
			<td width="144" colspan="2"><input type="text" name="cpfCadastro" id="cpfCadastro" value="<?=$pessoaAtual->getCpfpessoa()?>" /></td>		
		</tr>
		<tr>
			<td width="120">RG:</td>
			<td width="144" colspan="2"><input type="text" name="rg" id="rg" value="<?=$pessoaAtual->getRgpessoa()?>" /></td>		
		</tr>
		<tr>
			<td width="120">Emissor:</td>
			<td width="144" colspan="2"><input type="text" name="emissor" id="emissor" value="<?=$pessoaAtual->getEmissorpessoa()?>" /></td>		
		</tr>
		<tr>
			<td width="120">Sexo:</td>
			<td width="144" colspan="2">
				<select id="sexo" name="sexo">
					<option selected="selected" value="M">Masculino</option>
					<option value="F" <?=($pessoaAtual->getSexopessoa() == "F")?"selected":""?>>Feminino</option>
				</select>
			</td>		
		</tr>
		<tr>
			<td width="120">Estado Civil:</td>
			<td width="144" colspan="2">
				<select id="estadocivil" name="estadocivil">
					<option value="">Escolha o Estado Civil</option>
					<option value="<?=ProjetoUtil::$DOMINIO_CASADO?>" <?=($pessoaAtual->getEstadocivilpessoa() == ProjetoUtil::$DOMINIO_CASADO)?"selected":""?>><?=ProjetoUtil::$DOMINIO_CASADO_TXT?></option>
					<option value="<?=ProjetoUtil::$DOMINIO_OUTROS?>" <?=($pessoaAtual->getEstadocivilpessoa() == ProjetoUtil::$DOMINIO_OUTROS)?"selected":""?>><?=ProjetoUtil::$DOMINIO_OUTROS_TXT?></option>
					<option value="<?=ProjetoUtil::$DOMINIO_SEPARADO?>" <?=($pessoaAtual->getEstadocivilpessoa() == ProjetoUtil::$DOMINIO_SEPARADO)?"selected":""?>><?=ProjetoUtil::$DOMINIO_SEPARADO_TXT?></option>
					<option value="<?=ProjetoUtil::$DOMINIO_SOLTEIRO?>" <?=($pessoaAtual->getEstadocivilpessoa() == ProjetoUtil::$DOMINIO_SOLTEIRO)?"selected":""?>><?=ProjetoUtil::$DOMINIO_SOLTEIRO_TXT?></option>
					<option value="<?=ProjetoUtil::$DOMINIO_VIUVO?>" <?=($pessoaAtual->getEstadocivilpessoa() == ProjetoUtil::$DOMINIO_VIUVO)?"selected":""?>><?=ProjetoUtil::$DOMINIO_VIUVO_TXT?></option>
				</select>
			</td>
		</tr>
		<tr>
			<td width="120">Apelido:</td>
			<td width="144" colspan="2"><input type="text" name="apelido" id="apelido" value="<?=$pessoaAtual->getApelidopessoa()?>" /></td>		
		</tr>
		<tr>
			<td width="120">Naturalidade:</td>
			<td width="144" colspan="2"><input type="text" name="naturalidade" id="naturalidade" value="<?=$pessoaAtual->getNaturalidadepessoa()?>" /></td>		
		</tr>
		<tr>
			<td width="120">Data de Nascimento:</td>
			<td width="144" colspan="2"><input type="text" name="datanascimento" id="datanascimento" value="<?=$pessoaAtual->getDataNascimentoFormatado()?>" /> (ex. 11/11/2010)</td>		
		</tr>
	</table>
	<td width="49"><input type="submit" name="submit" id="submit" onclick="cadastra();" value="<?=(isset($_GET['idPessoa']))?"Alterar":"Cadastrar"?>"/></td>
</form>
<?php
}
else if(isset($_SESSION['pessoaPesquisa']))
{
	$pessoaAtual = new Pessoa();
	$pessoaAtual->setIdpessoa($_SESSION['pessoaPesquisa']);
	$pessoaAtual->find(true);
?>
<form name="deletaAltera" id="deletaAltera" method="post" action="../application/recebePostGet.php" >
	<input type="hidden" id="control" name="control" value="Pessoa"/>
	<input type="hidden" id="function" name="function" value=""/>
	<input type="hidden" id="idPessoa" name="idPessoa" value=""/>
<table>
	<tr>
		<td colspan="4">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="4"><strong>Pessoa Pesquisada</strong></td>
	</tr>
	<tr>
		<td width="126">&nbsp;</td>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td><strong>Nome</strong></td>
		<td colspan="3"><strong>CPF</strong></td>
	</tr>
	<tr>
		<td><?=$pessoaAtual->getNomepessoa()?></td>
		<td width="243"><?=$pessoaAtual->getCpfpessoa()?></td>
		<?php 
		if(!isset($_GET['paramentrosPessoa']) && !isset($_GET['paramentrosPessoaHipo']))
		{
		?>
		<td width="31"><a href="javascript:void(0);" onclick="alterar(<?=$pessoaAtual->getIdpessoa()?>)"><img src="images/botao_editar.gif" width="16" height="16" border="0" /></a></td>
		<td width="20"><a href="javascript:void(0);" onclick="deletar(<?=$pessoaAtual->getIdpessoa()?>)"><img src="images/botao_apagar.gif" width="16" height="16" border="0" /></a></td>
  		<?php 
		}
		else
		{
  		?>
  		<td width="20" colspan="2"><a href="javascript:void(0);" onclick="selecionarPessoa(<?=$pessoaAtual->getIdpessoa()?>,'<?=$pessoaAtual->getNomepessoa()?>')"><img src="images/botao_editar.gif" width="16" height="16" border="0" /></a></td>
  		<?php 
		}
  		?>
  	</tr>
</table>
</form>
<?php
unset($_SESSION['pessoaPesquisa']); 
}
?>
	</body>
</html>