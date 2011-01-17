<?php
require '../application/ProjetoUtil.php'; 
include 'carregamentoInicial.php';
?>
<html>
	<head>
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
				carregaPagina('pessoa.php?idpessoa='+idPessoa+'&cadastro=true','page');
			}
			
			function deletar(idPessoa)
			{
				document.deletaAltera.funcao.value = "deletar";
				document.deletaAltera.idPessoa.value = idPessoa;
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
				else {
					var formulario = $('#pessoa').serialize(true);
					enviaFormulario($('#pessoa').attr("action"),'page',formulario);
				}
			}
			
			<?php 
			if(isset($_GET['paramentrosPessoa']))
			{
			?>
			function selecionarPessoa(idPessoa,nomePessoa)
			{
				carregaPagina('entrevista.php?nomePromovente=<?=($_GET['tipoParte'] == 1)?"'+nomePessoa+'":$_GET['nomePromovente']?>&nomePromovido=<?=($_GET['tipoParte'] == 2)?"'+nomePessoa+'":$_GET['nomePromovido']?>&idpessoaPromovente=<?=($_GET['tipoParte'] == 1)?"'+idPessoa+'":$_GET['idpessoaPromovente']?>&idpessoaPromovido=<?=($_GET['tipoParte'] == 2) ? "'+idPessoa+'" : $_GET['idpessoaPromovido']?>&nomeDefensor=<?=$_GET['nomeDefensor']?>&iddefensor=<?=$_GET['iddefensor']?>&paramentrosPessoa=<?=$_GET['paramentrosPessoa']?>&idcomarca=<?=$_GET['idcomarca']?>&idtipoacao=<?=$_GET['idtipoacao']?>&idnaturezaacao=<?=$_GET['idnaturezaacao']?>&juizo=<?=$_GET['juizo']?>&assuntoentrevista=<?=$_GET['assuntoentrevista']?>','page');
			}
			<?php 
			} 
			elseif(isset($_GET['paramentrosPessoaHipo']))
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
	<input type="hidden" id="idcomarca" name="idcomarca" value="<?=$_GET['idcomarca']?>">
	<input type="hidden" id="idtipoacao" name="idtipoacao" value="<?=$_GET['idtipoacao']?>">
	<input type="hidden" id="iddefensor" name="iddefensor" value="<?=$_GET['iddefensor']?>">
	<input type="hidden" id="nomeDefensor" name="nomeDefensor" value="<?=$_GET['nomeDefensor']?>">
	<input type="hidden" id="idnaturezaacao" name="idnaturezaacao" value="<?=$_GET['idnaturezaacao']?>">
	<input type="hidden" id="juizo" name="juizo" value="<?=$_GET['juizo']?>">
	<input type="hidden" id="idpessoaPromovente" name="idpessoaPromovente" value="<?=$_GET['idpessoaPromovente']?>">
	<input type="hidden" id="nomePromovente" name="nomePromovente" value="<?=$_GET['nomePromovente']?>">
	<input type="hidden" id="idpessoaPromovido" name="idpessoaPromovido" value="<?=$_GET['idpessoaPromovido']?>">
	<input type="hidden" id="nomePromovido" name="nomePromovido" value="<?=$_GET['nomePromovido']?>">
	<input type="hidden" id="assuntoentrevista" name="assuntoentrevista" value="<?=$_GET['assuntoentrevista']?>">
	<input type="hidden" id="tipoParte" name="tipoParte" value="<?=$_GET['tipoParte']?>">
	<?php 
	}
	elseif(isset($_GET['paramentrosPessoaHipo']))
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
				<td colspan="2" align="left"><input type="text" name="nomePesquisa" id="nomePesquisa" style="text-transform: uppercase;" /></td>
			</tr>
			<tr>
				<td>CPF:</td>
				<td><input type="text" name="cpfPesquisa" id="cpfPesquisa" /></td>
				<td><input type="button" name="submit" id="submit" value="Pesquisar" onClick="pesquisar();"/></td>
			</tr>
		</table>
	</fieldset>
</form>
<?php 
if(isset($_GET['cadastro']))
{
	$pessoaAtual = new Pessoa();
	$enderecoAtual = new Endereco();
	if(isset($_GET['idpessoa']))
	{
		$pessoaAtual->setIdpessoa($_GET['idpessoa']);
		$pessoaAtual->find(true);
		$enderecoAtual->setIdpessoa($_GET['idpessoa']);
		$enderecoAtual->find(true);
	}
?>
<br/><br/><br/><br/>
<form name="pessoa" id="pessoa" method="post" action="../application/recebePostGet.php" >
	<input type="hidden" id="control" name="control" value="Pessoa"/>
	<input type="hidden" id="funcao" name="funcao" value="<?=(isset($_GET['idpessoa']))?"alterar":"cadastrar"?>"/>
	<input type="hidden" id="idpessoa" name="idpessoa" value="<?=$pessoaAtual->getIdpessoa()?>"/>
	<input type="hidden" id="idendereco" name="idendereco" value="<?=$enderecoAtual->getIdendereco()?>"/>
	<?php 
	if(isset($_GET['paramentrosPessoa']))
	{
	?>
	<input type="hidden" id="paramentrosPessoa" name="paramentrosPessoa" value="<?=$_GET['paramentrosPessoa']?>">
	<input type="hidden" id="idcomarca" name="idcomarca" value="<?=$_GET['idcomarca']?>">
	<input type="hidden" id="idtipoacao" name="idtipoacao" value="<?=$_GET['idtipoacao']?>">
	<input type="hidden" id="iddefensor" name="iddefensor" value="<?=$_GET['iddefensor']?>">
	<input type="hidden" id="nomeDefensor" name="nomeDefensor" value="<?=$_GET['nomeDefensor']?>">
	<input type="hidden" id="idnaturezaacao" name="idnaturezaacao" value="<?=$_GET['idnaturezaacao']?>">
	<input type="hidden" id="juizo" name="juizo" value="<?=$_GET['juizo']?>">
	<input type="hidden" id="idpessoaPromovente" name="idpessoaPromovente" value="<?=$_GET['idpessoaPromovente']?>">
	<input type="hidden" id="nomePromovente" name="nomePromovente" value="<?=$_GET['nomePromovente']?>">
	<input type="hidden" id="idpessoaPromovido" name="idpessoaPromovido" value="<?=$_GET['idpessoaPromovido']?>">
	<input type="hidden" id="nomePromovido" name="nomePromovido" value="<?=$_GET['nomePromovido']?>">
	<input type="hidden" id="assuntoentrevista" name="assuntoentrevista" value="<?=$_GET['assuntoentrevista']?>">
	<input type="hidden" id="tipoParte" name="tipoParte" value="<?=$_GET['tipoParte']?>">
	<?php 
	}
	elseif(isset($_GET['paramentrosConvite']))
	{
	?>
	<input type="hidden" id="paramentrosConvite" name="paramentrosConvite" value="<?=$_GET['paramentrosConvite']?>">
	<input type="hidden" id="idparteprocesso" name="idparteprocesso" value="<?=$_GET['idparteprocesso']?>">
	<input type="hidden" id="nomeParte" name="nomeParte" value="<?=$_GET['nomeParte']?>">
	<input type="hidden" id="datacartaconvite" name="datacartaconvite" value="<?=$_GET['datacartaconvite']?>">
	<input type="hidden" id="idcartaconvite" name="idcartaconvite" value="<?=$_GET['idcartaconvite']?>">
	<input type="hidden" id="iddefensor" name="iddefensor" value="<?=$_GET['iddefensor']?>">
	<input type="hidden" id="nomeDefensor" name="nomeDefensor" value="<?=$_GET['nomeDefensor']?>">
	<?php 
	}
	?>
	?>
	<table width="633">
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
			<td align="left"><input type="text" name="referenciaendereco" id="referenciaendereco" value="<?=$enderecoAtual->getReferenciaendereco()?>" /></td>
			<td width="49"><input type="button" name="submit" id="submit" onClick="cadastra();" value="<?=(isset($_GET['idpessoa']))?"Alterar":"Cadastrar"?>"/></td>		
		</tr>
	</table>
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
	<input type="hidden" id="funcao" name="funcao" value=""/>
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
			<td width="31"><a href="javascript:void(0);" onClick="alterar(<?=$pessoaAtual->getIdpessoa()?>)"><img src="images/botao_editar.gif" width="16" height="16" border="0" /></a></td>
			<td width="20"><a href="javascript:void(0);" onClick="deletar(<?=$pessoaAtual->getIdpessoa()?>)"><img src="images/botao_apagar.gif" width="16" height="16" border="0" /></a></td>
	  		<?php 
			}
			else
			{
	  		?>
	  		<td width="20" colspan="2"><a href="javascript:void(0);" onClick="selecionarPessoa(<?=$pessoaAtual->getIdpessoa()?>,'<?=$pessoaAtual->getNomepessoa()?>')"><img src="images/botao_editar.gif" width="16" height="16" border="0" /></a></td>
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