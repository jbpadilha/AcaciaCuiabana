<?php
require '../application/ProjetoUtil.php'; 
include 'carregamentoInicial.php';
session_start();

if(!isset($_GET['paramentrosDefensor']))
{
?>
<legend class="subtitulo">Cadastro de Defensor:</legend>
<?php 
}
else
{
?>
<legend class="subtitulo">Entrevista / Pesquisa de Defensor:</legend>
<?
}
?>
<br/>
<script type="text/javascript">

$(document).ready(function(){
	$("#datanascimento").mask("99/99/9999");
});

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

function alterar(idPessoa,idDefensor, idUsuario)
{
	var formulario = $('#deletaAltera').serialize(true);
	carregaPagina('defensor.php?idPessoa='+idPessoa+'&idDefensor='+idDefensor+'&idUsuario='+idUsuario+'&cadastro=true','page');
}

function deletar(idPessoa,idDefensor, idUsuario)
{
	document.deletaAltera.funcao.value = "deletar";
	document.deletaAltera.idPessoa.value = idPessoa;
	document.deletaAltera.idDefensor.value = idDefensor;
	document.deletaAltera.idUsuario.value = idUsuario;
	var formulario = $('#deletaAltera').serialize(true);
	enviaFormulario($('#deletaAltera').attr("action"),'page',formulario);
}
function cadastra()
{
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
		else if ( $('#usuario').val() == '' ) {
			alert('o Complemento da oab deve ser informado');
			return false;
		}
		else if ( $('#senha').val() == '' ) {
			alert('o Complemento da oab deve ser informado');
			return false;
		}
		else {
			var formulario = $('#defensor').serialize(true);
			enviaFormulario($('#defensor').attr("action"),'page',formulario);
		}
}



<?php 
if(isset($_GET['paramentrosDefensor']))
{
?>
function selecionarDefensor(idDefensor,nomeDefensor)
{

	carregaPagina('entrevista.php?nomeDefensor='+nomeDefensor+'&idDefensor='+idDefensor+'&paramentrosDefensor=<?=$_GET['paramentrosDefensor']?>&comarca=<?=$_GET['comarca']?>&tipoAcao=<?=$_GET['tipoAcao']?>&naturezaAcao=<?=$_GET['naturezaAcao']?>&juizo=<?=$_GET['juizo']?>&idpessoaPromovente=<?=$_GET['idpessoaPromovente']?>&idpessoaPromovido=<?=$_GET['idpessoaPromovido']?>&assunto=<?=$_GET['assunto']?>&nomePromovente=<?=$_GET['nomePromovente']?>&nomePromovido=<?=$_GET['nomePromovido']?>','page');
}
<?php 
}
?>
</script>
<form name="pesquisaDefensor" id="pesquisaDefensor" method="get" action="../application/recebePostGet.php" >
	<input type="hidden" id="control" name="control" value="Defensor"/>
	<input type="hidden" id="pesquisa" name="pesquisa" value="true"/>
	<?php 
	if(isset($_GET['paramentrosDefensor']))
	{
	?>
	<input type="hidden" id="paramentrosDefensor" name="paramentrosDefensor" value="<?=$_GET['paramentrosDefensor']?>">
	<input type="hidden" id="comarca" name="comarca" value="<?=$_GET['comarca']?>">
	<input type="hidden" id="tipoAcao" name="tipoAcao" value="<?=$_GET['tipoAcao']?>">
	<input type="hidden" id="naturezaAcao" name="naturezaAcao" value="<?=$_GET['naturezaAcao']?>">
	<input type="hidden" id="juizo" name="juizo" value="<?=$_GET['juizo']?>">
	<input type="hidden" id="idpessoaPromovente" name="idpessoaPromovente" value="<?=$_GET['idpessoaPromovente']?>">
	<input type="hidden" id="nomePromovente" name="nomePromovente" value="<?=$_GET['nomePromovente']?>">
	<input type="hidden" id="idpessoaPromovido" name="idpessoaPromovido" value="<?=$_GET['idpessoaPromovido']?>">
	<input type="hidden" id="nomePromovido" name="nomePromovido" value="<?=$_GET['nomePromovido']?>">
	<input type="hidden" id="assunto" name="assunto" value="<?=$_GET['assunto']?>">
	<?php 
	}
	?>
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
if(isset($_GET['cadastro']) && !isset($_GET['paramentrosDefensor']))
{
	$pessoaAtual = new Pessoa();
	$defensor = new Defensor();
	$usuarios = new Usuarios();
	if(isset($_GET['idPessoa']) && isset($_GET['idDefensor']) && isset($_GET['idUsuario']))
	{
		$pessoaAtual->setIdpessoa($_GET['idPessoa']);
		$pessoaAtual->find(true);
		$defensor->setIddefensor($_GET['idDefensor']);
		$defensor->find(true);
		$usuarios->setIdusuario($_GET['idUsuario']);
		$usuarios->find(true);
	}
?>
<br/><br/><br/><br/>
<form name="defensor" id="defensor" method="post" action="../application/recebePostGet.php" >
	<input type="hidden" id="control" name="control" value="Defensor"/>
	<input type="hidden" id="funcao" name="funcao" value="<?=(isset($_GET['idPessoa']))?"alterar":"cadastrar"?>"/>
	<input type="hidden" id="idPessoa" name="idPessoa" value="<?=$pessoaAtual->getIdpessoa()?>"/>
	<input type="hidden" id="idDefensor" name="idDefensor" value="<?=$defensor->getIddefensor()?>"/>
	<input type="hidden" id="idUsuario" name="idUsuario" value="<?=$usuarios->getIdusuario()?>"/>
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
			<td colspan="2"><input type="text" name="oabCadastro" id="oabCadastro"  value="<?=$defensor->getOabdefensor()?>"/></td>
		</tr>
		<tr>
			<td>Complemento OAB:</td>
			<td colspan="2">
				<select name="complementoOABCadastro" id="complementoOABCadastro" >
					<option value="">Selecione</option>        
					<option value="A" <?=($defensor->getCompoabdefensor() == "A")? "Selected":""?>>A</option>					
                	<option value="B" <?=($defensor->getCompoabdefensor() == "B")? "Selected":""?>>B</option>
	                <option value="D" <?=($defensor->getCompoabdefensor() == "D")? "Selected":""?>>D</option>
					<option value="E" <?=($defensor->getCompoabdefensor() == "E")? "Selected":""?>>E</option>
					<option value="N" <?=($defensor->getCompoabdefensor() == "N")? "Selected":""?>>N</option>
					<option value="P" <?=($defensor->getCompoabdefensor() == "P")? "Selected":""?>>P</option>
				</select> 
			</td>
		</tr>
		<tr>
			<td>Estado OAB:</td>
			<td colspan="2">
				<select name="estadoOABCadastro" id="estadoOABCadastro" >
	                    <option value="AC" <?=($defensor->getEstadooabdefensor() == "AC")?"Selected":""?>>AC</option>
	                    <option value="AL" <?=($defensor->getEstadooabdefensor() == "AL")?"Selected":""?>>AL</option>
	                    <option value="AM" <?=($defensor->getEstadooabdefensor() == "AM")?"Selected":""?>>AM</option>
	                    <option value="AP" <?=($defensor->getEstadooabdefensor() == "AP")?"Selected":""?>>AP</option>		
	                    <option value="BA" <?=($defensor->getEstadooabdefensor() == "BA")?"Selected":""?>>BA</option>
	                    <option value="CE" <?=($defensor->getEstadooabdefensor() == "CE")?"Selected":""?>>CE</option>
	                    <option value="DF" <?=($defensor->getEstadooabdefensor() == "DF")?"Selected":""?>>DF</option>
	                    <option value="ES" <?=($defensor->getEstadooabdefensor() == "ES")?"Selected":""?>>ES</option>
	                    <option value="GO" <?=($defensor->getEstadooabdefensor() == "GO")?"Selected":""?>>GO</option>
	                    <option value="MA" <?=($defensor->getEstadooabdefensor() == "MA")?"Selected":""?>>MA</option>
	                    <option value="MG" <?=($defensor->getEstadooabdefensor() == "MG")?"Selected":""?>>MG</option>
	                    <option value="MS" <?=($defensor->getEstadooabdefensor() == "MS")?"Selected":""?>>MS</option>
	                    <option value="MT" <?=($defensor->getEstadooabdefensor() == "MT")?"Selected":""?>>MT</option>
	                    <option value="PA" <?=($defensor->getEstadooabdefensor() == "PA")?"Selected":""?>>PA</option>
	                    <option value="PB" <?=($defensor->getEstadooabdefensor() == "PB")?"Selected":""?>>PB</option>
	                    <option value="PE" <?=($defensor->getEstadooabdefensor() == "PE")?"Selected":""?>>PE</option>
	                    <option value="PI" <?=($defensor->getEstadooabdefensor() == "PI")?"Selected":""?>>PI</option>
	                    <option value="PR" <?=($defensor->getEstadooabdefensor() == "PR")?"Selected":""?>>PR</option>
	                    <option value="RJ" <?=($defensor->getEstadooabdefensor() == "RJ")?"Selected":""?>>RJ</option>
	                    <option value="RN" <?=($defensor->getEstadooabdefensor() == "RN")?"Selected":""?>>RN</option>
	                    <option value="RO" <?=($defensor->getEstadooabdefensor() == "RO")?"Selected":""?>>RO</option>
	                    <option value="RR" <?=($defensor->getEstadooabdefensor() == "RR")?"Selected":""?>>RR</option>
	                    <option value="RS" <?=($defensor->getEstadooabdefensor() == "RS")?"Selected":""?>>RS</option>
	                    <option value="SC" <?=($defensor->getEstadooabdefensor() == "SC")?"Selected":""?>>SC</option>
	                    <option value="SE" <?=($defensor->getEstadooabdefensor() == "SE")?"Selected":""?>>SE</option>
	                    <option value="SP" <?=($defensor->getEstadooabdefensor() == "SP")?"Selected":""?>>SP</option>
	                    <option value="TO" <?=($defensor->getEstadooabdefensor() == "TO")?"Selected":""?>>TO</option>		 
               		</select>
			</td>
		</tr>
		<tr>
			<td>Usuário:</td>
			<td colspan="2">
				<input type="text" id="usuario" name="usuario" value="<?=$usuarios->getUsuario()?>"/>
			</td>
		</tr>
		<tr>
			<td>Senha:</td>
			<td>
				<input type="password" id="senha" name="senha" value="<?=$usuarios->getSenha()?>"/>
			</td>
			<td width="49"><input type="button" name="submit" id="submit" onclick="cadastra();" value="<?=(isset($_GET['idPessoa']))?"Alterar":"Cadastrar"?>"/></td>
		</tr>
	</table>
</form>
<?php
}
else if(isset($_SESSION['pessoaPesquisa']) && isset($_SESSION['defensorPesquisa']) && isset($_SESSION['usuarioPesquisa']))
{
	$pessoaAtual = new Pessoa();
	$pessoaAtual->setIdpessoa($_SESSION['pessoaPesquisa']);
	$pessoaAtual->find(true);
	
	$defensor = new Defensor();
	$defensor->setIddefensor($_SESSION['defensorPesquisa']);
	$defensor->find(true);
	
	$usuarios = new Usuarios();
	$usuarios->setIdusuario($_SESSION['usuarioPesquisa']);
	$usuarios->find(true);
?>
<form name="deletaAltera" id="deletaAltera" method="post" action="../application/recebePostGet.php" >
	<input type="hidden" id="control" name="control" value="Defensor"/>
	<input type="hidden" id="function" name="function" value=""/>
	<input type="hidden" id="idPessoa" name="idPessoa" value=""/>
	<input type="hidden" id="idDefensor" name="idDefensor" value=""/>
	<input type="hidden" id="idUsuario" name="idUsuario" value=""/>
<table>
	<tr>
		<td colspan="4">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="4"><strong>Defensor Pesquisado</strong></td>
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
		<?php 
		if(!isset($_GET['paramentrosDefensor']))
		{
		?>
		<td width="31"><a href="javascript:void(0);" onclick="alterar(<?=$pessoaAtual->getIdpessoa()?>,<?=$defensor->getIddefensor()?>,<?=$usuarios->getIdusuario()?>)"><img src="images/botao_editar.gif" width="16" height="16" border="0" /></a></td>
		<td width="20"><a href="javascript:void(0);" onclick="deletar(<?=$pessoaAtual->getIdpessoa()?>,<?=$defensor->getIddefensor()?>,<?=$usuarios->getIdusuario()?>)"><img src="images/botao_apagar.gif" width="16" height="16" border="0" /></a></td>
		<?php 
		}
		else{
		?>
		<td width="20" colspan="2"><a href="javascript:void(0);" onclick="selecionarDefensor(<?=$defensor->getIddefensor()?>,'<?=$pessoaAtual->getNomepessoa()?>')"><img src="images/botao_editar.gif" width="16" height="16" border="0" /></a></td>
		<?php 
		}
		?>
  	</tr>
</table>
</form>
<?php
unset($_SESSION['pessoaPesquisa']); 
unset($_SESSION['defensorPesquisa']);
unset($_SESSION['usuarioPesquisa']);
}
?>