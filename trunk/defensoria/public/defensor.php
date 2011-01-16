<?php
require '../application/ProjetoUtil.php'; 
include 'carregamentoInicial.php';

if(isset($_GET['paramentrosConvite']))
{
?>
<legend class="subtitulo">Agendamento Carta Convite / Pesquisa de Defensor:</legend>
<?php	
}
elseif(isset($_GET['paramentrosDefensor']))
{
?>
<legend class="subtitulo">Entrevista / Pesquisa de Defensor:</legend>
<?php 
}
else
{
?>
<legend class="subtitulo">Cadastro de Defensor:</legend>
<?
}
?>
<br/>
<script type="text/javascript">

$(document).ready(function(){
	$("#usuario").alphanumeric(); 
	$("#datanascimentopessoa").mask("99/99/9999");
	$("#cpfpessoa").mask("999.999.999-99");
	$("#cpfPesquisa").mask("999.999.999-99");
	$("#cependereco").mask("99999-999");
	$("#rgpessoa").numeric();
	$("#numeroendereco").numeric();
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

function alterar(idpessoa,iddefensor, idusuario)
{
	var formulario = $('#deletaAltera').serialize(true);
	carregaPagina('defensor.php?idpessoa='+idpessoa+'&iddefensor='+iddefensor+'&idusuario='+idusuario+'&cadastro=true','page');
}

function deletar(idPessoa,idDefensor, idUsuario)
{
	document.deletaAltera.funcao.value = "deletar";
	document.deletaAltera.idpessoa.value = idpessoa;
	document.deletaAltera.iddefensor.value = iddefensor;
	document.deletaAltera.idusuario.value = idusuario;
	var formulario = $('#deletaAltera').serialize(true);
	enviaFormulario($('#deletaAltera').attr("action"),'page',formulario);
}
function cadastra()
{
		if ( $('#nomepessoa').val() == '' ) {
			alert('O nome deve ser informado');
			return false;
		} 
		else if ( $('#sexopessoa').val() == '' ) {
			alert('O sexo deve ser informado');
			return false;
		}
		else if ( $('#cpfpessoa').val() == '' ) {
			alert('O cpf deve ser informado');
			return false;
		}
		else if ( $('#estadocivilpessoa').val() == '' ) {
			alert('O estado civil deve ser informado');
			return false;
		}
		else if ( $('#datanascimentopessoa').val() == '' ) {
			alert('A data de nascimento deve ser informado');
			return false;
		}
		else if ( $('#oabdefensor').val() == '' ) {
			alert('A oab deve ser informado');
			return false;
		}
		else if ( $('#compoabdefensor').val() == '' ) {
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
function selecionarDefensor(defensor,nomeDefensor)
{
	carregaPagina(
			'entrevista.php?nomeDefensor='
			+nomeDefensor+
			'&iddefensor='
			+defensor+
			'&paramentrosDefensor=<?=$_GET['paramentrosDefensor']?>&idcomarca=<?=$_GET['idcomarca']?>&idtipoacao=<?=$_GET['idtipoacao']?>&idnaturezaacao=<?=$_GET['idnaturezaacao']?>&juizo=<?=$_GET['juizo']?>&idpessoaPromovente=<?=$_GET['idpessoaPromovente']?>&idpessoaPromovido=<?=$_GET['idpessoaPromovido']?>&assuntoentrevista=<?=$_GET['assuntoentrevista']?>&nomePromovente=<?=$_GET['nomePromovente']?>&nomePromovido=<?=$_GET['nomePromovido']?>','page');
}
<?php 
}
elseif(isset($_GET['paramentrosConvite']))
{
?>
function selecionarDefensor(defensor,nomeDefensor)
{
	carregaPagina(
			'convite.php?nomeDefensor='+nomeDefensor+'&iddefensor='+defensor+'&paramentrosConvite=<?=$_GET['paramentrosConvite']?>&idparteprocesso=<?=$_GET['idparteprocesso']?>&numeroProcesso=<?=$_GET['numeroProcesso']?>&datacartaconvite=<?=$_GET['datacartaconvite']?>&idcartaconvite=<?=$_GET['idcartaconvite']?>','page');
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
	<input type="hidden" id="idcomarca" name="idcomarca" value="<?=$_GET['idcomarca']?>">
	<input type="hidden" id="idtipoacao" name="idtipoacao" value="<?=$_GET['idtipoacao']?>">
	<input type="hidden" id="idnaturezaacao" name="idnaturezaacao" value="<?=$_GET['idnaturezaacao']?>">
	<input type="hidden" id="juizo" name="juizo" value="<?=$_GET['juizo']?>">
	<input type="hidden" id="idpessoaPromovente" name="idpessoaPromovente" value="<?=$_GET['idpessoaPromovente']?>">
	<input type="hidden" id="nomePromovente" name="nomePromovente" value="<?=$_GET['nomePromovente']?>">
	<input type="hidden" id="idpessoaPromovido" name="idpessoaPromovido" value="<?=$_GET['idpessoaPromovido']?>">
	<input type="hidden" id="nomePromovido" name="nomePromovido" value="<?=$_GET['nomePromovido']?>">
	<input type="hidden" id="assuntoentrevista" name="assuntoentrevista" value="<?=$_GET['assuntoentrevista']?>">
	<?php 
	}
	elseif(isset($_GET['paramentrosConvite']))
	{
	?>
	<input type="hidden" id="paramentrosConvite" name="paramentrosConvite" value="<?=$_GET['paramentrosConvite']?>">
	<input type="hidden" id="idparteprocesso" name="idparteprocesso" value="<?=$_GET['idparteprocesso']?>">
	<input type="hidden" id="numeroProcesso" name="numeroProcesso" value="<?=$_GET['numeroProcesso']?>">
	<input type="hidden" id="datacartaconvite" name="datacartaconvite" value="<?=$_GET['datacartaconvite']?>">
	<input type="hidden" id="idcartaconvite" name="idcartaconvite" value="<?=$_GET['idcartaconvite']?>">
	<?php 
	}
	?>
	<fieldset>
		<legend class="subtitulo">Pesquisar Defensor:</legend>
		<table>
			<tr>
				<td colspan="3">A pesquisa por um dos parâmetros é obrigatório.</td>
			</tr>
			<tr>
				<td width="143">Nome:</td>
				<td colspan="2" align="left"><input type="text" name="nomePesquisa" id="nomePesquisa" style="text-transform: uppercase;" /></td>
			</tr>
			<tr>
				<td>CPF:</td>
				<td colspan="2" align="left"><input type="text" name="cpfPesquisa" id="cpfPesquisa" /></td>
			</tr>
			<tr>
				<td>OAB:</td>
				<td colspan="2" align="left"><input type="text" name="oabPesquisa" id="oabPesquisa" /></td>
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
				<td width="154">
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
				<td width="71"><input type="button" name="submit" id="submit" value="Pesquisar" onclick="pesquisar()"/></td>
			</tr>
		</table>
	</fieldset>
</form>
<?php 
if(isset($_GET['cadastro']) && !isset($_GET['paramentrosDefensor']) && !isset($_GET['paramentrosConvite']))
{
	$pessoaAtual = new Pessoa();
	$defensor = new Defensor();
	$usuarios = new Usuarios();
	$enderecoAtual = new Endereco();
	if(isset($_GET['idpessoa']) && isset($_GET['idpefensor']) && isset($_GET['idusuario']))
	{
		$pessoaAtual->setIdpessoa($_GET['idpessoa']);
		$pessoaAtual->find(true);
		$enderecoAtual->setIdpessoa($_GET['idpessoa']);
		$enderecoAtual->find(true);
		$defensor->setIddefensor($_GET['iddefensor']);
		$defensor->find(true);
		$usuarios->setIdusuario($_GET['idusuario']);
		$usuarios->find(true);
	}
?>
<br/><br/><br/><br/>
<form name="defensor" id="defensor" method="post" action="../application/recebePostGet.php" >
	<input type="hidden" id="control" name="control" value="Defensor"/>
	<input type="hidden" id="funcao" name="funcao" value="<?=(isset($_GET['idpessoa']))?"alterar":"cadastrar"?>"/>
	<input type="hidden" id="idpessoa" name="idpessoa" value="<?=$pessoaAtual->getIdpessoa()?>"/>
	<input type="hidden" id="iddefensor" name="iddefensor" value="<?=$defensor->getIddefensor()?>"/>
	<input type="hidden" id="idusuario" name="idusuario" value="<?=$usuarios->getIdusuario()?>"/>
	<input type="hidden" id="idendereco" name="idendereco" value="<?=$enderecoAtual->getIdendereco()?>"/>
	<table width="644">
		<tr>
			<td colspan="3"><span class="subTitulo">DADOS PESSOAIS</span></td>
		</tr>
		<tr>
			<td width="104" align="left">Nome:</td>
			<td colspan="2" align="left"><input name="nomepessoa" type="text" id="nomepessoa" style="text-transform: uppercase;" value="<?=$pessoaAtual->getNomepessoa()?>" size="60"/></td>		
		</tr>
		<tr>
			<td align="left">CPF:</td>
			<td colspan="2" align="left"><input name="cpfpessoa" type="text" id="cpfpessoa" value="<?=$pessoaAtual->getCpfpessoa()?>" size="14" /></td>		
		</tr>
		<tr>
			<td align="left">RG:</td>
			<td colspan="2" align="left"><input type="text" name="rgpessoa" id="rgpessoa" value="<?=$pessoaAtual->getRgpessoa()?>" /></td>		
		</tr>
		<tr>
			<td align="left">Emissor:</td>
			<td colspan="2" align="left"><input type="text" name="emissorpessoa" id="emissorpessoa" value="<?=$pessoaAtual->getEmissorpessoa()?>" /></td>		
		</tr>
		<tr>
			<td align="left">Sexo:</td>
			<td colspan="2" align="left">
				<select id="sexopessoa" name="sexopessoa">
					<option selected="selected" value="M">Masculino</option>
					<option value="F" <?=($pessoaAtual->getSexopessoa() == "F")?"selected":""?>>Feminino</option>
				</select>
			</td>		
		</tr>
		<tr>
			<td align="left">Estado Civil:</td>
			<td colspan="2" align="left">
				<select id="estadocivilpessoa" name="estadocivilpessoa">
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
			<td align="left">Apelido:</td>
			<td colspan="2" align="left"><input type="text" name="apelidopessoa" id="apelidopessoa" value="<?=$pessoaAtual->getApelidopessoa()?>" /></td>		
		</tr>
		<tr>
			<td align="left">Naturalidade:</td>
			<td colspan="2" align="left"><input type="text" name="naturalidadepessoa" id="naturalidadepessoa" value="<?=$pessoaAtual->getNaturalidadepessoa()?>" /></td>		
		</tr>
		<tr>
			<td align="left">Data de Nascimento:</td>
			<td colspan="2" align="left"><input type="text" name="datanascimentopessoa" id="datanascimentopessoa" value="<?=$pessoaAtual->getDataNascimentoFormatado()?>" /> (ex. 11/11/2010)</td>		
		</tr>
		<tr>
			<td colspan="3" class="subTitulo">ENDEREÇO</td>
		</tr>
		<tr>
			<td align="left">Logradouro:</td>
			<td colspan="2" align="left"><input name="logradouroendereco" type="text" id="logradouroendereco" value="<?=$enderecoAtual->getLogradouroendereco()?>" size="60" /></td>		
		</tr>
		<tr>
			<td align="left">Complemento:</td>
			<td colspan="2" align="left"><input name="complementoendereco" type="text" id="complementoendereco" value="<?=$enderecoAtual->getComplementoendereco()?>" size="60" /></td>		
		</tr>
		<tr>
			<td align="left">Bairro:</td>
			<td colspan="2" align="left"><input name="bairroendereco" type="text" id="bairroendereco" value="<?=$enderecoAtual->getBairroendereco()?>" size="30" /></td>		
		</tr>
		<tr>
			<td align="left">Número:</td>
			<td colspan="2" align="left"><input type="text" name="numeroendereco" id="numeroendereco" value="<?=$enderecoAtual->getNumeroendereco()?>" /></td>		
		</tr>
		<tr>
			<td align="left">CEP:</td>
			<td colspan="2" align="left"><input type="text" name="cependereco" id="cependereco" value="<?=$enderecoAtual->getCependereco()?>" /></td>		
		</tr>
		<tr>
			<td align="left">Cidade:</td>
			<td colspan="2" align="left"><input type="text" name="cidadeendereco" id="cidadeendereco" value="<?=$enderecoAtual->getCidadeendereco()?>" style="text-transform: uppercase;"/></td>		
		</tr>
		<tr>
			<td align="left">Estado:</td>
			<td colspan="2" align="left">
				<select name="estadoendereco" id="estadoendereco" >
                    <option value="AC" <?=($enderecoAtual->getEstadoendereco() == "AC")?"Selected":""?>>AC</option>
                    <option value="AL" <?=($enderecoAtual->getEstadoendereco() == "AL")?"Selected":""?>>AL</option>
                    <option value="AM" <?=($enderecoAtual->getEstadoendereco() == "AM")?"Selected":""?>>AM</option>
                    <option value="AP" <?=($enderecoAtual->getEstadoendereco() == "AP")?"Selected":""?>>AP</option>		
                    <option value="BA" <?=($enderecoAtual->getEstadoendereco() == "BA")?"Selected":""?>>BA</option>
                    <option value="CE" <?=($enderecoAtual->getEstadoendereco() == "CE")?"Selected":""?>>CE</option>
                    <option value="DF" <?=($enderecoAtual->getEstadoendereco() == "DF")?"Selected":""?>>DF</option>
                    <option value="ES" <?=($enderecoAtual->getEstadoendereco() == "ES")?"Selected":""?>>ES</option>
                    <option value="GO" <?=($enderecoAtual->getEstadoendereco() == "GO")?"Selected":""?>>GO</option>
                    <option value="MA" <?=($enderecoAtual->getEstadoendereco() == "MA")?"Selected":""?>>MA</option>
                    <option value="MG" <?=($enderecoAtual->getEstadoendereco() == "MG")?"Selected":""?>>MG</option>
                    <option value="MS" <?=($enderecoAtual->getEstadoendereco() == "MS")?"Selected":""?>>MS</option>
                    <option value="MT" <?=($enderecoAtual->getEstadoendereco() == "MT")?"Selected":""?>>MT</option>
                    <option value="PA" <?=($enderecoAtual->getEstadoendereco() == "PA")?"Selected":""?>>PA</option>
                    <option value="PB" <?=($enderecoAtual->getEstadoendereco() == "PB")?"Selected":""?>>PB</option>
                    <option value="PE" <?=($enderecoAtual->getEstadoendereco() == "PE")?"Selected":""?>>PE</option>
                    <option value="PI" <?=($enderecoAtual->getEstadoendereco() == "PI")?"Selected":""?>>PI</option>
                    <option value="PR" <?=($enderecoAtual->getEstadoendereco() == "PR")?"Selected":""?>>PR</option>
                    <option value="RJ" <?=($enderecoAtual->getEstadoendereco() == "RJ")?"Selected":""?>>RJ</option>
                    <option value="RN" <?=($enderecoAtual->getEstadoendereco() == "RN")?"Selected":""?>>RN</option>
                    <option value="RO" <?=($enderecoAtual->getEstadoendereco() == "RO")?"Selected":""?>>RO</option>
                    <option value="RR" <?=($enderecoAtual->getEstadoendereco() == "RR")?"Selected":""?>>RR</option>
                    <option value="RS" <?=($enderecoAtual->getEstadoendereco() == "RS")?"Selected":""?>>RS</option>
                    <option value="SC" <?=($enderecoAtual->getEstadoendereco() == "SC")?"Selected":""?>>SC</option>
                    <option value="SE" <?=($enderecoAtual->getEstadoendereco() == "SE")?"Selected":""?>>SE</option>
                    <option value="SP" <?=($enderecoAtual->getEstadoendereco() == "SP")?"Selected":""?>>SP</option>
                    <option value="TO" <?=($enderecoAtual->getEstadoendereco() == "TO")?"Selected":""?>>TO</option>		 
               	</select>
			</td>		
		</tr>
		<tr>
			<td align="left">Telefone:</td>
			<td colspan="2" align="left"><input type="text" name="telefoneendereco" id="telefoneendereco" value="<?=$enderecoAtual->getTelefoneendereco()?>" /></td>		
		</tr>
		<tr>
			<td align="left">Referência:</td>
			<td colspan="2" align="left"><input type="text" name="referenciaendereco" id="referenciaendereco" value="<?=$enderecoAtual->getReferenciaendereco()?>" /></td>		
		</tr>
		<tr>
			<td colspan="3" class="subTitulo">DADOS DEFENSOR</td>
		</tr>
		<tr>
			<td align="left">OAB:</td>
			<td colspan="2" align="left"><input type="text" name="oabdefensor" id="oabdefensor"  value="<?=$defensor->getOabdefensor()?>"/></td>
		</tr>
		<tr>
			<td align="left">Complemento OAB:</td>
			<td colspan="2" align="left">
				<select name="compoabdefensor" id="compoabdefensor" >
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
			<td align="left">Estado OAB:</td>
			<td colspan="2" align="left">
				<select name="estadooabdefensor" id="estadooabdefensor" >
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
			<td colspan="3" class="subTitulo">DADOS DE USUÁRIO DE ACESSO</td>
		</tr>
		<tr>
			<td align="left">Usuário:</td>
			<td colspan="2" align="left">
				<input type="text" id="usuario" name="usuario" value="<?=$usuarios->getUsuario()?>"/>
			</td>
		</tr>
		<tr>
			<td align="left">Senha:</td>
			<td width="194" align="left">
				<input type="password" id="senha" name="senha" value="<?=$usuarios->getSenha()?>"/>
			</td>
			<td width="330" align="left"><input type="button" name="submit" id="submit" onclick="cadastra();" value="<?=(isset($_GET['idPessoa']))?"Alterar":"Cadastrar"?>"/></td>
		</tr>
	</table>
	<br/><br/><br/>
</form>
<?php
}
else if(isset($_SESSION['defensorPesquisa']))
{
?>
<form name="deletaAltera" id="deletaAltera" method="post" action="../application/recebePostGet.php" >
	<input type="hidden" id="control" name="control" value="Defensor"/>
	<input type="hidden" id=funcao name="funcao" value=""/>
	<input type="hidden" id="idpessoa" name="idpessoa" value=""/>
	<input type="hidden" id="iddefensor" name="iddefensor" value=""/>
	<input type="hidden" id="idusuario" name="idusuario" value=""/>
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
	<?php 
	$arrayDefensor = array();
	$arrayDefensor = $_SESSION['defensorPesquisa'];
	if(count($arrayDefensor)>0)
	{
    	foreach ($arrayDefensor as $array)
    	{
		$defensor = new Defensor();
		$defensor->setIddefensor($array);
		$defensor->find(true);
		$pessoaAtual = new Pessoa();
		$pessoaAtual->setIdpessoa($defensor->getIdpessoa());
		$pessoaAtual->find(true);
		$usuarios = new Usuarios();
		$usuarios->setIdpessoa($pessoaAtual->getIdpessoa());
		$usuarios->find(true);
	?>
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
		if(isset($_GET['paramentrosDefensor']) || isset($_GET['paramentrosConvite']))
		{
		?>
		<td width="20" colspan="2"><a href="javascript:void(0);" onclick="selecionarDefensor(<?=$defensor->getIddefensor()?>,'<?=$pessoaAtual->getNomepessoa()?>')"><img src="images/botao_editar.gif" width="16" height="16" border="0" /></a></td>
		<?php 
		}
		else{
		?>
		<td width="31"><a href="javascript:void(0);" onclick="alterar(<?=$pessoaAtual->getIdpessoa()?>,<?=$defensor->getIddefensor()?>,<?=$usuarios->getIdusuario()?>)"><img src="images/botao_editar.gif" width="16" height="16" border="0" /></a></td>
		<td width="20"><a href="javascript:void(0);" onclick="deletar(<?=$pessoaAtual->getIdpessoa()?>,<?=$defensor->getIddefensor()?>,<?=$usuarios->getIdusuario()?>)"><img src="images/botao_apagar.gif" width="16" height="16" border="0" /></a></td>
		<?php 
		}
		?>
  	</tr>
  	<?php
    	} 
	}
  	?>
</table>
</form>
<?php
unset($_SESSION['pessoaPesquisa']); 
unset($_SESSION['defensorPesquisa']);
unset($_SESSION['usuarioPesquisa']);
}
?>