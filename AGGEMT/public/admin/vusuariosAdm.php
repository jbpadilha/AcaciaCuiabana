<?php 
include '../carregamentoInicial.php';
require '../../application/GruposUsuarios.php';
include_once( '../ckeditor/ckeditor_php5.php' ) ;
header("Content-Type: text/html; charset=UTF-8",true);
?>
<script type="text/javascript">
		Calendar.setup({
	    inputField : "datanascimentopessoa",
	    trigger    : "f_btn1",
	    onSelect   : function() { this.hide() },
	    dateFormat : "%d-%m-%Y",
	    showTime: 24
	  });
		$("#usuario").alphanumeric(); 
		$("#datanascimentopessoa").mask("99/99/9999");
		$("#cpfpessoa").mask("999.999.999-99");
		$("#cependereco").mask("99999-999");
		$("#rgpessoa").numeric();
		$("#numeroendereco").numeric();
      function alterar(idusuario)
      {
      	var formulario = $('#deletaAltera').serialize(true);
      	carregaPagina('usuariosAdm.php?idusuario='+idusuario,'conteudo');
      }

      function cadastra()
      {
    	  if ( $('#usuario').val() == '' ) {
				alert('O nome do usuï¿½rio deve ser informado !');
				return false;
			}
			if ( $('#senha').val() == '' ) {
				alert('A senha do usuï¿½rio deve ser informado !');
				return false;
			} 
			if ( $('#grupousuario').val() == '' ) {
				alert('O grupo de acesso do usuï¿½rio deve ser informado !');
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
			else {
				$('#cursospessoa').val(CKEDITOR.instances.cursospessoa.getData());
				$('#projetospessoa').val(CKEDITOR.instances.projetospessoa.getData());
      		var formulario = $('#cadastrar').serialize(true);
      		enviaFormulario($('#cadastrar').attr("action"),'conteudo',formulario);
      	}
      }
</script>
<table>
	<tr>
		<td class="tituloAdm">Modificar Meus Dados</td>
	</tr>
</table>
<br>
<br>
<div id="cadastroClass" <?php if (!isset($_GET['idusuario'])) echo "style=\"display:none;\"";?>>
<h3 class="t">Cadastro de Usuários</h3>
<?php 
$usuarios = new Usuarios();
$pessoaAtual = new Pessoa();
$enderecoAtual = new Endereco();
if(isset($_GET['idusuario']))
{
	$usuarios->setIdusuario($_GET['idusuario']);
	$usuarios->find(true);
	$pessoaAtual->setIdpessoa($usuarios->getIdpessoa());
	$pessoaAtual->find(true);
	$enderecoAtual->setIdpessoa($usuarios->getIdpessoa());
	$enderecoAtual->find(true);
}

?>
<form name="cadastrar" id="cadastrar" method="post" action="../../application/recebePostGet.php">
	<input type="hidden" id="control" name="control" value="Usuarios"/>
	<input type="hidden" id="funcao" name="funcao" value="<?=(isset($_GET['idusuario']))?"alterar":"cadastrar"?>"/>
	<input type="hidden" id="idusuario" name="idusuario" value="<?=$usuarios->getIdusuario()?>"/>
	<input type="hidden" id="idpessoa" name="idpessoa" value="<?=$usuarios->getIdpessoa()?>"/>
	<input type="hidden" id="idendereco" name="idendereco" value="<?=$enderecoAtual->getIdendereco()?>"/>
	<input type="hidden" id="datacadastropessoa" name="datacadastropessoa" value="<?=$pessoaAtual->getDatacadastropessoa()?>"/>
	<table>
		<tr>
			<td>Usuário:</td>
			<td>
			<?=$usuarios->getUsuario()?>
			<input type="hidden" name="usuario" id="usuario" value="<?=$usuarios->getUsuario()?>"/>
			</td>
		</tr>
		<tr>
			<td>Senha:</td>
			<td><input type="password" name="senha" id="senha" value=""/></td>
		</tr>
		<tr>
			<td>Grupo do Usuário:</td>
			<td>
				<?php 
				if($usuarios->getGrupousuario() == GruposUsuarios::$GRUPO_ADMIN)
				{
					echo GruposUsuarios::$GRUPO_ADMIN_TXT;
				}
				else if($usuarios->getGrupousuario() == GruposUsuarios::$GRUPO_ASSOCIADO)
				{
					echo GruposUsuarios::$GRUPO_ASSOCIADO_TXT;
				} 
				else if($usuarios->getGrupousuario() == GruposUsuarios::$GRUPO_ESTAGIARIO)
				{
					echo GruposUsuarios::$GRUPO_ESTAGIARIO_TXT;
				} 
				?>
				<input type="hidden" id="grupousuario" name="grupousuario" value="<?=$usuarios->getGrupousuario()?>">
			</td>
		</tr>
		<tr>
			<td colspan="2"><span class="subTitulo">DADOS PESSOAIS</span></td>
		</tr>
		<tr>
			<td width="104" align="left">Nome:</td>
			<td align="left"><input name="nomepessoa" type="text" id="nomepessoa" style="text-transform: uppercase;" value="<?=$pessoaAtual->getNomepessoa()?>" size="60"/></td>		
		</tr>
		<tr>
			<td align="left">CPF:</td>
			<td align="left"><input name="cpfpessoa" type="text" id="cpfpessoa" value="<?=$pessoaAtual->getCpfpessoa()?>" size="14" /></td>		
		</tr>
		<tr>
			<td align="left">RG:</td>
			<td align="left"><input type="text" name="rgpessoa" id="rgpessoa" value="<?=$pessoaAtual->getRgpessoa()?>" /></td>		
		</tr>
		<tr>
			<td align="left">Emissor:</td>
			<td align="left"><input type="text" name="emissorpessoa" id="emissorpessoa" value="<?=$pessoaAtual->getEmissorpessoa()?>" /></td>		
		</tr>
		<tr>
			<td align="left">Data de Nascimento:</td>
			<td align="left"><input type="text" name="datanascimentopessoa" id="datanascimentopessoa" value="<?=$pessoaAtual->getDataNascimentoFormatado()?>" /> (ex. 11/11/2010)
			<a id="f_btn1" href="javascript:void(0);"><img src="../images/bot-calendario.png" border="0"></a></td>		
		</tr>
        <tr>
			<td colspan="2" class="tituloAdm">ENDEREÇO</td>
		</tr>
		<tr>
			<td align="left">Logradouro:</td>
			<td align="left"><input name="logradouroendereco" type="text" id="logradouroendereco" value="<?=$enderecoAtual->getLogradouroendereco()?>" size="60" /></td>		
		</tr>
		<tr>
			<td align="left">Complemento:</td>
			<td align="left"><input name="complementoendereco" type="text" id="complementoendereco" value="<?=$enderecoAtual->getComplementoendereco()?>" size="60" /></td>		
		</tr>
		<tr>
			<td align="left">Bairro:</td>
			<td align="left"><input name="bairroendereco" type="text" id="bairroendereco" value="<?=$enderecoAtual->getBairroendereco()?>" size="30" /></td>		
		</tr>
		<tr>
			<td align="left">Número:</td>
			<td align="left"><input type="text" name="numeroendereco" id="numeroendereco" value="<?=$enderecoAtual->getNumeroendereco()?>" /></td>		
		</tr>
		<tr>
			<td align="left">CEP:</td>
			<td align="left"><input type="text" name="cependereco" id="cependereco" value="<?=$enderecoAtual->getCependereco()?>" /></td>		
		</tr>
		<tr>
			<td align="left">Cidade:</td>
			<td align="left"><input type="text" name="cidadeendereco" id="cidadeendereco" value="<?=$enderecoAtual->getCidadeendereco()?>" style="text-transform: uppercase;" /></td>		
		</tr>
		<tr>
			<td align="left">Estado:</td>
			<td align="left">
				<select name="estadoendereco" id="estadoendereco" >
					<option value="MT" <?=($enderecoAtual->getEstadoendereco() == "MT")?"Selected":""?>>MT</option>
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
			<td align="left"><input type="text" name="telefoneendereco" id="telefoneendereco" value="<?=$enderecoAtual->getTelefoneendereco()?>" /></td>		
		</tr>
		<tr>
			<td align="left">Cursos Feitos:</td>
			<td align="left">
				<?php 
				$CKEditor = new CKEditor();
 				$CKEditor->editor("cursospessoa", $pessoaAtual->getCursospessoa());
 				?>
			</td>		
		</tr>
		<tr>
			<td align="left">Projetos Desenvolvidos:</td>
			<td align="left">
				<?php 
 				$CKEditor->editor("projetospessoa", $pessoaAtual->getProjetospessoa());
 				?>
			</td>		
		</tr>
		<tr>
			<td width="49" colspan="2"><input type="button" name="submit" id="submit" onClick="cadastra();" value="<?=(isset($_GET['idusuario']))?"Alterar":"Cadastrar"?>"/></td>		
		</tr>
	</table>
</form>
</div>
		