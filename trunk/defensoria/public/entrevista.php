<?php 
include 'carregamentoInicial.php';
?>
<legend class="subtitulo">Cadastro de Entrevista:</legend>
<br/>
<script type="text/javascript">
function pesquisaDefensor()
{
	var formulario = $('#entrevista').serialize(true);
	carregaPagina('defensor.php?paramentrosDefensor=1&'+formulario,'page');
}
function pesquisaPromovente(tipoParte)
{
	var formulario = $('#entrevista').serialize(true);
	carregaPagina('pessoa.php?tipoParte='+tipoParte+'&paramentrosPessoa=1&'+formulario,'page');
}
function cadastra()
{
	if ( $('#idcomarca').val() == '' ) {
		alert('A comarca deve ser informado.');
		return false;
	}
	if ( $('#assuntoentrevista').val() == '' ) {
		alert('O assunto deve ser informado.');
		return false;
	} 
	else {
		var formulario = $('#entrevista').serialize(true);
		enviaFormulario($('#entrevista').attr("action"),'page',formulario);
	}
}
</script>
<form name="entrevista" id="entrevista" method="post" action="../application/recebePostGet.php">
	<input type="hidden" id="control" name="control" value="Entrevista"/>
	<input type="hidden" id="funcao" name="funcao" value="cadastrar"/>
	<table>
		<tr>
			<td width="120">Comarca:</td>
			<td width="144" colspan="2" align="left">
				<select id="idcomarca" name="idcomarca">
					<option value="">Selecione</option>
					<?php 
					$comarca = new Comarca();
					$comarca->find();
					if($comarca->fetch())
					{
					?>
					<option value="<?=$comarca->getIdcomarca()?>" <?=(isset($_GET['"idcomarca"']) && $_GET['"idcomarca"'] == $comarca->getIdcomarca())?"selected":""?>><?=$comarca->getNomecomarca()?></option>
					<?php 
					}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Defensor:</td>
			<td align="left">
				<input type="hidden" id="iddefensor" name="iddefensor" value="<?=(isset($_GET['iddefensor']))?$_GET['iddefensor']:""?>"/>
				<input type="hidden" id="nomeDefensor" name="nomeDefensor" value="<?=(isset($_GET['nomeDefensor']))?$_GET['nomeDefensor']:""?>"/>
				<?=(isset($_GET['nomeDefensor']))?$_GET['nomeDefensor']:""?>
			</td>
			<td align="left"><input type="button" name="selecione" id="selecione" value="Selecione" onclick="pesquisaDefensor();"/></td>
		</tr>
		<tr>
			<td>Tipo da Ação:</td>
			<td colspan="2" align="left">
				<select id="idtipoacao" name="idtipoacao">
					<option value="">Selecione</option>
					<?php 
					$tipoAcao = new TipoAcao();
					$tipoAcao->find();
					if($tipoAcao->fetch())
					{
					?>
					<option value="<?=$tipoAcao->getIdtipoacao()?>" <?=(isset($_GET['idtipoacao']) && $_GET['idtipoacao'] == $tipoAcao->getIdtipoacao())?"selected":""?>><?=$tipoAcao->getTipoacao()?></option>
					<?php 
					}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Natureza da Ação:</td>
			<td colspan="2" align="left">
				<select id="idnaturezaacao" name="idnaturezaacao">
					<option value="">Selecione</option>
					<?php 
					$naturezaAcao = new NaturezaAcao();
					$naturezaAcao->find();
					if($naturezaAcao->fetch())
					{
					?>
					<option value="<?=$naturezaAcao->getIdnaturezaacao()?>" <?=(isset($_GET['idnaturezaacao']) && $_GET['idnaturezaacao'] == $naturezaAcao->getIdnaturezaacao())?"selected":""?>><?=$naturezaAcao->getNaturezaacao()?></option>
					<?php 
					}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Juizo:</td>
			<td colspan="2" align="left">
				<select id="juizo" name="juizo">
					<option value="">Selecione</option>
					<option value="<?=ProjetoUtil::$juizo_Primeiro_Grau?>" <?=(isset($_GET['juizo']) && $_GET['juizo'] == ProjetoUtil::$juizo_Primeiro_Grau)? "selected":"" ?>><?=ProjetoUtil::$juizo_Primeiro_Grau_TXT?></option>
					<option value="<?=ProjetoUtil::$juizo_Segundo_Grau?>" <?=(isset($_GET['juizo']) && $_GET['juizo'] == ProjetoUtil::$juizo_Segundo_Grau)? "selected":"" ?>><?=ProjetoUtil::$juizo_Segundo_Grau_TXT?></option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Parte Promovente:</td>
			<td align="left">
				<input type="hidden" id="idpessoaPromovente" name="idpessoaPromovente" value="<?=(isset($_GET['idpessoaPromovente']))?$_GET['idpessoaPromovente']:""?>"/>
				<input type="hidden" id="nomePromovente" name="nomePromovente" value="<?=(isset($_GET['nomePromovente']))?$_GET['nomePromovente']:""?>"/>
				<?=(isset($_GET['nomePromovente']))?$_GET['nomePromovente']:""?>
				</td>
			<td align="left"><input type="button" name="selecione" id="selecione" value="Selecione" onclick="pesquisaPromovente(1);"/></td>
		</tr>
		<tr>
			<td>Parte Promovido:</td>
			<td align="left">
				<input type="hidden" id="idpessoaPromovido" name="idpessoaPromovido" value="<?=(isset($_GET['idpessoaPromovido']))?$_GET['idpessoaPromovido']:""?>"/>
				<input type="hidden" id="nomePromovido" name="nomePromovido" value="<?=(isset($_GET['nomePromovido']))?$_GET['nomePromovido']:""?>"/>
				<?=(isset($_GET['nomePromovido']))?$_GET['nomePromovido']:""?>
			</td>
			<td align="left"><input type="button" name="selecione" id="selecione" value="Selecione" onclick="pesquisaPromovente(2);"/></td>
		</tr>
		<tr>
			<td>Assunto:</td>
			<td colspan="2">
				<textarea rows="8" cols="100" id="assuntoentrevista" name="assuntoentrevista"><?=(isset($_GET['assuntoentrevista']))?$_GET['assuntoentrevista']:""?></textarea>
			</td>
		</tr>
	</table>
	<td width="49"><input type="button" name="submit" id="submit" value="Cadastrar" onclick="cadastra();"/></td>
</form>