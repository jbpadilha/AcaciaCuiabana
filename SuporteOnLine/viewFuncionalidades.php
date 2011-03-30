<?php
//####################################
// * João Batista Padilha e Silva Analista/Desenvolvedor (Ábaco Tecnologia)
// * Arquivo: viewFuncionalidades.php
// * Criação: João Batista Padilha e Silva
// * Revisão:
// * Data de criação: 07/07/2008
//####################################
/**
 * Página de Manter Papeis do Sistema
 */

require("config.php");

if(!isset($_SESSION["usuario_Logado"]))
{
	header("Location:index.php");
}
?>
<script type="text/javascript">

function salvarOrdem()
{
retorno='';
nElementos=0;
sel1len = document.form1.ordemFuncionalidade.length ;
for ( i=0; i<sel1len ; i++)
	{
    	if (nElementos == 0)
		{
    		retorno=document.form1.ordemFuncionalidade.options[i].value;

		}
	else
		{
    		retorno+=';'+document.form1.ordemFuncionalidade.options[i].value;
		}
		nElementos++;
	}
    document.form1.idsOrdem.value = retorno;
	
}

/**
 * Função que verifica qual o tipo da funcionalidade selecionada. Caso seja SubMenu, deve mostrar o campo para selecionar o Menu Pai
 */
function verificaTipoFuncionalidades(tipoFuncionalidade)
{
	tipoFuncionalidade = tipoFuncionalidade.options[tipoFuncionalidade.selectedIndex].value;
	if(tipoFuncionalidade == '<?=$dominio->DomnTipoFuncionalidade_SubMenu?>')
	{
		document.getElementById('subMenu').style.display = 'block';
	}
	else
	{
		document.getElementById('subMenu').style.display = 'none';
	}
	
}

/**
 *	Função que envia o formulário via Ajax. Basta passar o nome do formulario em "var formulario = $('#form1').serialize();"
 *  e indicar o retorno, como sera visto, em uma div ou dar um alert.
 * @author Rafael Moura
 */
function cadastrar()
{
	salvarOrdem();
	var formulario = $('#form1').serialize(true);
	$('#conteudo').block({message:'<h4>Aguarde...</h4><br/><img src="./imagens/loading.gif" border="0" />'});
	$.post('class/ControlaPostGet.php',formulario,function(retorno){
		$('#conteudo').unblock();
		if(retorno == "1")
		{
			alert('Cadastrado com sucesso.');
			carregaPagina('interna.php','conteudo');
		}
		else
		{
			$('#informacao').empty().html(retorno);
			$('#informacao').slideDown('slow');
		}
		
	})
}

/**
 *	Função que envia o formulário via Ajax. Basta passar o nome do formulario em "var formulario = $('#form1').serialize();"
 *  e indicar o retorno, como sera visto, em uma div ou dar um alert.
 * @author Rafael Moura
 */
function consultar()
{
	var formulario = $('#formPesquisa').serialize(true);
	$('#conteudo').block({message:'<h4>Aguarde...</h4><br/><img src="./imagens/loading.gif" border="0" />'});
	$.post('class/ControlaPostGet.php',formulario,function(retorno){
		$('#conteudo').unblock();
		$('#contentRetorno').empty().html(retorno);
		$('#contentRetorno').slideDown('slow');
	})
}

/**
 *	Função que move o registro para cima ou baixo de acordo com a opção escolhida
 * @author João Batista Padilha e Silva
 */
function move (deslocamento) {
	sel1len = document.form1.ordemFuncionalidade.length ;
	ponto=1;
	for ( i=0; i<sel1len ; i++)
	{
		if (document.form1.ordemFuncionalidade.options[i].selected == true )
		{
			ponto=i;
		}
	}
	if (!((ponto+deslocamento < 0) || (ponto+deslocamento >= sel1len)))
	{       
		pivot_text=document.form1.ordemFuncionalidade.options[ponto].text;
		pivot_value=document.form1.ordemFuncionalidade.options[ponto].value;
		document.form1.ordemFuncionalidade.options[ponto].text = document.form1.ordemFuncionalidade.options[ponto+deslocamento].text;
		document.form1.ordemFuncionalidade.options[ponto].value = document.form1.ordemFuncionalidade.options[ponto+deslocamento].value;
		document.form1.ordemFuncionalidade.options[ponto+deslocamento].text=pivot_text; 
		document.form1.ordemFuncionalidade.options[ponto+deslocamento].value=pivot_value; 
		document.form1.ordemFuncionalidade.options[ponto+deslocamento].selected=true;
		document.form1.ordemFuncionalidade.options[ponto].selected=false;	
	}
}
</script>

<h3>Funcionalidades Cadastradas</h3>
<div id="barra">
	<a href="javascript:void(0)" title="Cadastrar Nova Funcionalidade" onclick="carregaPagina('viewFuncionalidades.php?cadastro=true','formulario');"><img src="imagens/ico_novo.jpg" border="0"  />&nbsp;&nbsp;Nova Funcionalidade&nbsp;&nbsp;|&nbsp;&nbsp;</a>
	<a href="javascript:void(0)" title="Localizar Funcionalidade" onclick="carregaPagina('viewFuncionalidades.php','formulario');"><img src="imagens/ico_localizar.gif" border="0"  />&nbsp;&nbsp;Localizar Funcionalidade&nbsp;&nbsp;|&nbsp;&nbsp;</a>
</div>
<br />
<div id="informacao" class="informacao" style="display:none"></div>
<?php
if (!isset($_GET['cadastro']))
{
?>
<form method="post" id="formPesquisa" action="#" onsubmit="return false">
	<table align="center">
		<tr>
			<td class="formTdEsquerdo">Nome da Funcionalidade:</td>
			<td><input type="text" size="30" name="nomeFuncionalidades" id="nomeFuncionalidades" class="campo" /></td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input type="button" name="<?=$dominio->botaoConfirmar?>" value="<?=$dominio->botaoConfirmar_TXT?>" title="<?=$dominio->botaoConfirmar_msg?>" class="botao" onclick="consultar()" />&nbsp;
				<input type="reset" name="<?=$dominio->botaoLimpar?>" value="<?=$dominio->botaoLimpar_TXT?>" title="<?=$dominio->botaoLimpar_msg?>" class="botao" />
			</td>
		</tr>
	</table>
	<input type="hidden" name="pagina" value="pesquisarFuncionalidades" />
</form>
<div id="contentRetorno">
<table width="95%" border="0" cellpadding="1" cellspacing="0" class="tabelaListagem" align="center">
	<tr>
		<td class="tituloListagem">Nome da Funcionalidade</td>
		<td class="tituloListagem" colspan="2">Tipo</td>
	</tr>
	<?php
		$controlaFuncionalidades = new Controla_Funcionalidades();
		echo $controlaFuncionalidades->mostraFuncionalidades();
	?>
</table>
</div>
<?php
} 
else 
{
	$controlaFuncionalidades = new Controla_Funcionalidades();
	$funcionalidadesVo = new FuncionalidadesVo();
	
	// Caso seja alteração
	if(isset($_GET['idFuncionalidades']))
	{
		$funcionalidadesVo->setIdFuncionalidades($_GET['idFuncionalidades']);
		$collVo = $controlaFuncionalidades->pesquisarFuncionalidades($funcionalidadesVo);
		$funcionalidadesVo = (object) $collVo[0];
		
	}
?>
<form action="#" method="POST" id="form1" name="form1">
	<table align="center" width="95%">
		<tr>
			<td width="25%" class="formTdEsquerdo">Nome da Funcionalidade:<span class="asterisco">*</span></td>
			<td colspan="2"><input type="text" name="nomeFuncionalidades" id="nomeFuncionalidades" size="20" value="<?=$funcionalidadesVo->getNomeFuncionalidades()?>" class="campo"/></td>
		</tr>
		<tr>
			<td class="formTdEsquerdo">Link da Funcionalidade:</td>
			<td colspan="2"><input type="text" name="linkFuncionalidades" id="linkFuncionalidades" size="20" value="<?=$funcionalidadesVo->getLinkFuncionalidades()?>" class="campo"/></td>
		</tr>
		<tr>
			<td class="formTdEsquerdo">Tipo da Funcionalidade:<span class="asterisco">*</span></td>
			<td colspan="2">
				<?=$dominio->montaSelectDomnTipoFuncionalidades($funcionalidadesVo->getDomnTipoFuncionalidades(),'verificaTipoFuncionalidades(this)')?>			</td>
		</tr>
		<tr>
			<td colspan="3">
				<div id="subMenu" style="display:none;">
					<table align="center" width="100%">
						<tr>
							<td width="51%" class="formTdEsquerdo">Pertencente ao Menu:<span class="asterisco">*</span></td>
							<td width="49%">
								<?=$controlaFuncionalidades->montaSelectFuncionalidades($funcionalidadesVo->getPrecedenteFuncionalidades(),'precedenteFuncionalidades');?>						  </td>
						</tr>
				    </table>
				</div>
			</td>
		</tr>
		<?php
		/**
		 * Buscar As funcionalidades na ordem. Caso não seja alteração, apenas seta a ordem, na ultima posição, caso contrário, selecione a ordem.
		 */
		$funcionalidadesVo_ordem = new FuncionalidadesVo();
		$funcionalidadesVo_ordem->setPrecedenteFuncionalidades($funcionalidadesVo->getPrecedenteFuncionalidades());
		$collVo_ordem = $controlaFuncionalidades->pesquisarFuncionalidades($funcionalidadesVo_ordem);
		if(!isset($_GET['idFuncionalidades']))
		{
			$ordem_nova = count($collVo_ordem) + 1;
			echo '<input type="hidden" name="ordemFuncionalidade" id="ordemFuncionalidade" value="'.$ordem_nova.'"/>';
		}
		else
		{
		?>
		<tr>
			<td class="formTdEsquerdo">Ordem da Funcionalidade:</td>
			<td>
			<select name="ordemFuncionalidade" size="7" id="ordemFuncionalidade" class="campo" name="ordemFuncionalidade">
				<?php				
					for($i = 0; $i < count($collVo_ordem); $i++)
					{
						$funcionalidadesVo_ordem = (object) $collVo_ordem[$i];
						echo '<option value="'.$funcionalidadesVo_ordem->getIdFuncionalidades().'">'.$funcionalidadesVo_ordem->getNomeFuncionalidades().'</option>';
					}
				?>
		    </select>
	      </td>
		    <td valign="top" width="56%">
			  <input name="button" type="button" onclick="move(-1);" value="Sobe" class="botao" />
              <br />
          	  <input name="button" type="button" onclick="move(1);" value="Desce" class="botao" />
          	</td>
		</tr>
		<?php
		}
		?>			
		<tr align="center">
			<td colspan="3" class="formTdCentro">
				<input type="button" value="<?=$dominio->botaoConfirmar_TXT?>" id="<?=$dominio->botaoConfirmar?>" class="botao" onclick="cadastrar()"/>
				&nbsp;
				<input type="button" value="<?=$dominio->botaoVoltar_TXT?>" id="<?=$dominio->botaoVoltar?>" class="botao" onClick="carregaPagina('viewFuncionalidades.php','formulario')" />
			</td>
		</tr>
	</table>
	<input type="hidden" name="pagina" id="pagina" value="cadastraFuncionalidades"/>
	<input type="hidden" name="idFuncionalidades" id="idFuncionalidades" value="<?=$funcionalidadesVo->getIdFuncionalidades()?>"/>
	<input type="hidden" name="idsOrdem" id="idsOrdem" value=""/>
	<input type="hidden" name="funcionalidade" value="<?=basename(__FILE__)?>" />
</form>
<script type="text/javascript">
verificaTipoFuncionalidades(document.form1.tipoFuncionalidades);
</script>
<?php
}
?>