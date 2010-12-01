<?php
require '../application/ProjetoUtil.php'; 
include 'carregamentoInicial.php';
session_start();
?>
<legend class="subtitulo">Cadastro de Defensor:</legend>
<br/>
<script type="text/javascript">

function pesquisar()
{
	if ( $('#nomePesquisa').val() == '' && $('#cpfPesquisa').val() == '' && $('#oabPesquisa').val() == '' && $('#complementoPesquisa').val() == '') {
		alert('Um dos parâmetros devem ser informados.');
		return false;
	}
	else
	{
		var formulario = $('#pesquisaDefensor').serialize(true);
		carregaPaginaPesquisa($('#pesquisaDefensor').attr("action"),'page',formulario);
	}
}

function alterar(idDefensor,idPessoa)
{
	var formulario = $('#deletaAltera').serialize(true);
	carregaPagina('defensor.php?idPessoa='+idPessoa+'&idDefensor='+idAtividades+'&cadastro=true','page');
}

function deletar(idDefensor)
{
	document.deletaAltera.function.value = "deletar";
	document.deletaAltera.idDefensor.value = idDefensor;
	var formulario = $('#deletaAltera').serialize(true);
	enviaFormulario($('#deletaAltera').attr("action"),'page',formulario);
}
function cadastra()
{
	$(document).ready(function(){
		$('#defensor').submit(function() {
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
			else if ( $('#oabCadastro').val() == '' ) {
				alert('A oab deve ser informado');
				return false;
			}
			else if ( $('#complementoCadastro').val() == '' ) {
				alert('o Complemento da oab deve ser informado');
				return false;
			}
			else {
				var formulario = $('#defensor').serialize(true);
				enviaFormulario($(this).attr("action"),'page',formulario);
			}
		});
	});
}
</script>
<form name="pesquisaDefensor" id="pesquisaDefensor" method="get" action="../application/recebePostGet.php" >
	<input type="hidden" id="control" name="control" value="Defensor"/>
	<input type="hidden" id="pesquisa" name="pesquisa" value="true"/>
	<fieldset>
		<legend class="subtitulo">Pesquisar Defensor:</legend>
		<table>
			<tr>
				<td>A pesquisa por um dos parâmetros é obrigatório.</td>
			</tr>
			<tr>
				<td>Nome:</td>
				<td colspan="2" align="left"><input type="text" name="nomePesquisa" id="nomePesquisa" style="text-transform: lowercase;" /></td>
			</tr>
			<tr>
				<td>CPF:</td>
				<td colspan="2"><input type="text" name="cpfPesquisa" id="cpfPesquisa" /></td>
			</tr>
			<tr>
				<td>OAB:</td>
				<td colspan="2"><input type="text" name="oabPesquisa" id="oabPesquisa" /></td>
			</tr>
			<tr>
				<td>Complemento OAB:</td>
				<td colspan="2">
					<select name="complementoOABPesquisa" id="complementoOABPesquisa" >
						<option value="" selected="selected">Selecione</option>        
						<option value="A">A</option>
	                	<option value="B">B</option>
		                <option value="D">D</option>
						<option value="E">E</option>
						<option value="N">N</option>
						<option value="P">P</option>
					</select> 
				</td>
			</tr>
			<tr>
				<td>Estado OAB:</td>
				<td>
					<select name="estadoOABPesquisa" id="estadoOABPesquisa" >
	                    <option>AC</option>
	                    <option>AL</option>
	                    <option>AM</option>
	                    <option>AP</option>		
	                    <option>BA</option>
	                    <option>CE</option>
	                    <option>DF</option>
	                    <option>ES</option>
	                    <option>GO</option>
	                    <option>MA</option>
	                    <option>MG</option>
	                    <option>MS</option>
	                    <option selected="selected">MT</option>
	                    <option>PA</option>
	                    <option>PB</option>
	                    <option>PE</option>
	                    <option>PI</option>
	                    <option>PR</option>
	                    <option>RJ</option>
	                    <option>RN</option>
	                    <option>RO</option>
	                    <option>RR</option>
	                    <option>RS</option>
	                    <option>SC</option>
	                    <option>SE</option>
	                    <option>SP</option>
	                    <option>TO</option>		 
               		</select>
				</td>
				<td><input type="button" name="submit" id="submit" value="Pesquisar" onclick="pesquisar()"/></td>
			</tr>
		</table>
	</fieldset>
</form>
<?php 
if(isset($_GET['cadastro']))
{
	$pessoaAtual = new Pessoa();
	$defensor = new Defensor();
	if(isset($_GET['idPessoa']) && isset($_GET['idDefensor']))
	{
		$pessoaAtual->setIdpessoa($_GET['idPessoa']);
		$pessoaAtual->find(true);
		$defensor->setIddefensor($_GET['idDefensor']);
		$defensor->find(true);
	}
?>
<br/><br/><br/><br/>
<form name="defensor" id="defensor" method="post" action="../application/recebePostGet.php" >
	<input type="hidden" id="control" name="control" value="Defensor"/>
	<input type="hidden" id="function" name="function" value="<?=(isset($_GET['idPessoa']))?"alterar":"cadastrar"?>"/>
	<input type="hidden" id="idPessoa" name="idPessoa" value="<?=$pessoaAtual->getIdpessoa()?>"/>
	<input type="hidden" id="idDefensor" name="idDefensor" value="<?=$defensor->getIddefensor()?>"/>
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
		<tr>
			<td>OAB:</td>
			<td colspan="2"><input type="text" name="oabCadastro" id="oabCadastro" /></td>
		</tr>
		<tr>
			<td>Complemento OAB:</td>
			<td colspan="2">
				<select name="complementoOABCadastro" id="complementoOABCadastro" >
					<option value="" selected="selected">Selecione</option>        
					<option value="A">A</option>
                	<option value="B">B</option>
	                <option value="D">D</option>
					<option value="E">E</option>
					<option value="N">N</option>
					<option value="P">P</option>
				</select> 
			</td>
		</tr>
		<tr>
			<td>Estado OAB:</td>
			<td>
				<select name="estadoOABCadastro" id="estadoOABCadastro" >
	                    <option>AC</option>
	                    <option>AL</option>
	                    <option>AM</option>
	                    <option>AP</option>		
	                    <option>BA</option>
	                    <option>CE</option>
	                    <option>DF</option>
	                    <option>ES</option>
	                    <option>GO</option>
	                    <option>MA</option>
	                    <option>MG</option>
	                    <option>MS</option>
	                    <option selected="selected">MT</option>
	                    <option>PA</option>
	                    <option>PB</option>
	                    <option>PE</option>
	                    <option>PI</option>
	                    <option>PR</option>
	                    <option>RJ</option>
	                    <option>RN</option>
	                    <option>RO</option>
	                    <option>RR</option>
	                    <option>RS</option>
	                    <option>SC</option>
	                    <option>SE</option>
	                    <option>SP</option>
	                    <option>TO</option>		 
               		</select>
			</td>
			<td width="49"><input type="submit" name="submit" id="submit" onclick="cadastra();" value="<?=(isset($_GET['idPessoa']))?"Alterar":"Cadastrar"?>"/></td>
		</tr>
	</table>
</form>
<?php
}
else if(isset($_SESSION['pessoaPesquisa']) && isset($_SESSION['defensorPesquisa']))
{
	$pessoaAtual = new Pessoa();
	$pessoaAtual->setIdpessoa($_SESSION['pessoaPesquisa']);
	$pessoaAtual->find(true);
	
	$defensor = new Defensor();
	$defensor->setIddefensor($_SESSION['defensorPesquisa']);
?>
<form name="deletaAltera" id="deletaAltera" method="post" action="../application/recebePostGet.php" >
	<input type="hidden" id="control" name="control" value="Defensor"/>
	<input type="hidden" id="function" name="function" value=""/>
	<input type="hidden" id="idPessoa" name="idPessoa" value=""/>
<table>
	<tr>
		<td colspan="4">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="4"><strong>Defensor Pesquisada</strong></td>
	</tr>
	<tr>
		<td width="126">&nbsp;</td>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td><strong>Nome</strong></td>
		<td><strong>OAB</strong></td>
		<td colspan="3"><strong>Complemento OAB</strong></td>
	</tr>
	<tr>
		<td><?=$pessoaAtual->getNomepessoa()?></td>
		<td><?=$defensor->getOabdefensor()?></td>
		<td width="243"><?=$defensor->getCompoabdefensor()?></td>
		<td width="31"><a href="javascript:void(0);" onclick="alterar(<?=$pessoaAtual->getIdpessoa()?>,<?=$defensor->getIddefensor()?>)"><img src="images/botao_editar.gif" width="16" height="16" border="0" /></a></td>
		<td width="20"><a href="javascript:void(0);" onclick="deletar(<?=$pessoaAtual->getIdpessoa()?>,<?=$defensor->getIddefensor()?>)"><img src="images/botao_apagar.gif" width="16" height="16" border="0" /></a></td>
  	</tr>
</table>
</form>
<?php
unset($_SESSION['pessoaPesquisa']); 
unset($_SESSION['pessoaPesquisa']);
}
?>