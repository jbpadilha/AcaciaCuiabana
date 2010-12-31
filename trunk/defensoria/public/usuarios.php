<?php 
include 'carregamentoInicial.php';
?>
<legend class="subtitulo">Cadastro de Usuários:</legend>
<br/>
<script type="text/javascript">

function alterar(idUsuario)
{
	var formulario = $('#deletaAltera').serialize(true);
	carregaPagina('usuarios.php?idUsuario='+idusuario,'page');
}

function deletar(idusuario)
{
	document.deletaAltera.function.value = "deletar";
	document.deletaAltera.idusuario.value = idusuario;
	var formulario = $('#deletaAltera').serialize(true);
	enviaFormulario($('#deletaAltera').attr("action"),'page',formulario);
}
function cadastra()
{
	$(document).ready(function(){
		$('#usuarios').submit(function() {
			if ( $('#usuario').val() == '' ) {
				alert('O nome do usuário deve ser informado !');
				return false;
			}
			if ( $('#senha').val() == '' ) {
				alert('A senha do usuário deve ser informado !');
				return false;
			} 
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
				var formulario = $(this).serialize(true);
				enviaFormulario($(this).attr("action"),'page',formulario);
			}
		});
	});
}
</script>
<form name="usuarios" id="usuarios" method="post" action="../application/recebePostGet.php">
	<?php
	$usuarios = new Usuarios();
	$pessoaAtual = new Pessoa();
	$enderecoAtual = new Endereco();
	if(isset($_GET['idusuario']))
	{
		$usuarios->reset();
		$usuarios->getIdusuario($_GET['idusuario']);
		$usuarios->find(true);
		$pessoaAtual->setIdpessoa($usuarios->getIdpessoa());
		$pessoaAtual->find(true);
		$enderecoAtual->setIdpessoa($usuarios->getIdpessoa());
		$enderecoAtual->find(true);
	}
	?>
	<input type="hidden" id="control" name="control" value="Usuarios"/>
	<input type="hidden" id="function" name="function" value="<?=(isset($_GET['idusuario']))?"alterar":"cadastrar"?>"/>
	<input type="hidden" id="idusuario" name="idusuario" value="<?=$usuarios->getIdusuario()?>"/>
	<table>
		<tr>
			<td>Usuário:</td>
			<td colspan="2"><input type="text" name="usuario" id="usuario" value="<?=$usuarios->getUsuario()?>"/></td>
		</tr>
		<tr>
			<td>Senha:</td>
			<td colspan="2"><input type="password" name="senha" id="senha" value=""/></td>
		</tr>
		<tr>
			<td>Grupo do Usuário:</td>
			<td colspan="2">
				<select id="grupousuario" name="grupousuario">
					<option value="">Selecione</option>
					<option value="<?=GruposUsuarios::$GRUPO_ADMIN?>" <?=($usuarios->getGrupousuario() == GruposUsuarios::$GRUPO_ADMIN)?"selected":""?>><?=GruposUsuarios::$GRUPO_ADMIN_TXT?></option>
					<option value="<?=GruposUsuarios::$GRUPO_ATENDENTE?>" <?=($usuarios->getGrupousuario() == GruposUsuarios::$GRUPO_ATENDENTE)?"selected":""?>><?=GruposUsuarios::$GRUPO_ATENDENTE_TXT?></option>
					<option value="<?=GruposUsuarios::$GRUPO_DEFENSOR?>" <?=($usuarios->getGrupousuario() == GruposUsuarios::$GRUPO_DEFENSOR)?"selected":""?>><?=GruposUsuarios::$GRUPO_DEFENSOR?></option>
					<option value="<?=GruposUsuarios::$GRUPO_ESTAGIARIO?>" <?=($usuarios->getGrupousuario() == GruposUsuarios::$GRUPO_ESTAGIARIO)?"selected":""?>><?=GruposUsuarios::$GRUPO_ESTAGIARIO_TXT?></option>
				</select>
			</td>
		</tr>
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
			<td colspan="2" align="left"><input type="text" name="cidadeendereco" id="cidadeendereco" value="<?=$enderecoAtual->getCidadeendereco()?>" /></td>		
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
			<td width="49"><input type="button" name="submit" id="submit" onClick="cadastra();" value="<?=(isset($_GET['idusuario']))?"Alterar":"Cadastrar"?>"/></td>		
		</tr>
	</table>
</form>
<?php
$usuarios = null;
$usuarios = new Usuarios();
$usuarios->reset();
if($usuarios->find()>0)
{
?>
<form name="deletaAltera" id="deletaAltera" method="post" action="../application/recebePostGet.php" >
	<input type="hidden" id="control" name="control" value="Usuarios"/>
	<input type="hidden" id="function" name="function" value=""/>
	<input type="hidden" id="idusuarios" name="idusuarios" value=""/>
<table>
	<tr>
		<td colspan="6">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="6">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="6"><strong>Usuarios Cadastrados</strong></td>
	</tr>
	<tr>
		<td colspan="6">&nbsp;</td>
	</tr>
	<tr>
		<td><strong>ID</strong></td>
		<td><strong>Nome</strong></td>
		<td><strong>Usuário</strong></td>
		<td colspan="3"><strong>Grupo</strong></td>
	</tr>
  <?php 
	while($usuarios->fetch())
	{
		$pessoa = new Pessoa();
		$pessoa->setIdpessoa($usuarios->getIdpessoa());
		$pessoa->find(true);
  ?>
	<tr>
		<td><?=$usuarios->getIdusuario()?></td>
	  	<td><?=$pessoa->getNomepessoa()?></td>
	  	<td><?=$usuarios->getUsuario()?></td>
	  	<td><?=$usuarios->getNomeGrupoUsuarios()?></td>
	  	<td width="31"><a href="javascript:void(0);" onclick="alterar(<?=$usuarios->getIdusuario()?>)"><img src="images/botao_editar.gif" width="16" height="16" border="0" /></a></td>
	  	<td width="20"><a href="javascript:void(0);" onclick="deletar(<?=$usuarios->getIdusuario()?>)"><img src="images/botao_apagar.gif" width="16" height="16" border="0" /></a></td>
  	</tr>
  <?php 
  	}
  ?>
</table>
</form>
<?php 
}
else
{
?>
Não existem usuários cadastrados.
<?php 
}
?>