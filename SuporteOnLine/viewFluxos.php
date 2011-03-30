<?php
//####################################
// * João Batista Padilha e Silva Analista/Desenvolvedor (Ábaco Tecnologia)
// * Arquivo: viewFluxos.php
// * Criação: João Batista Padilha e Silva
// * Revisão:
// * Data de criação: 11/07/2008
//####################################
/**
 * Página de Manter Fluxos do Sistema
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
sel1len = document.form1.ordemFluxos.length ;
for ( i=0; i<sel1len ; i++)
	{
    	if (nElementos == 0)
		{
    		retorno=document.form1.ordemFluxos.options[i].value;

		}
	else
		{
    		retorno+=';'+document.form1.ordemFluxos.options[i].value;
		}
		nElementos++;
	}
    document.form1.idsOrdem.value = retorno;
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
			carregaPagina('viewFluxos.php','formulario');
		}
		else
		{
			$('#informacao').empty().html(retorno);
			$('#informacao').slideDown('slow');$('#informacao').slideDown('slow');
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
	sel1len = document.form1.ordemFluxos.length ;
	ponto=1;
	for ( i=0; i<sel1len ; i++)
	{
		if (document.form1.ordemFluxos.options[i].selected == true )
		{
			ponto=i;
		}
	}
	if (!((ponto+deslocamento < 0) || (ponto+deslocamento >= sel1len)))
	{       
		pivot_text=document.form1.ordemFluxos.options[ponto].text;
		pivot_value=document.form1.ordemFluxos.options[ponto].value;
		document.form1.ordemFluxos.options[ponto].text = document.form1.ordemFluxos.options[ponto+deslocamento].text;
		document.form1.ordemFluxos.options[ponto].value = document.form1.ordemFluxos.options[ponto+deslocamento].value;
		document.form1.ordemFluxos.options[ponto+deslocamento].text=pivot_text; 
		document.form1.ordemFluxos.options[ponto+deslocamento].value=pivot_value; 
		document.form1.ordemFluxos.options[ponto+deslocamento].selected=true;
		document.form1.ordemFluxos.options[ponto].selected=false;	
	}
}


</script>

<h3>Fluxos Cadastrados</h3>
<div id="barra">
	<a href="javascript:void(0)" title="Cadastrar Novo Fluxo" onclick="carregaPagina('viewFluxos.php?cadastro=true','formulario');"><img src="imagens/ico_novo.jpg" border="0"  />&nbsp;&nbsp;Novo Fluxo&nbsp;&nbsp;|&nbsp;&nbsp;</a>
	<a href="javascript:void(0)" title="Localizar Fluxos" onclick="carregaPagina('viewFluxos.php','formulario');"><img src="imagens/ico_localizar.gif" border="0"  />&nbsp;&nbsp;Localizar Fluxos&nbsp;&nbsp;|&nbsp;&nbsp;</a>
</div>
<br />
<div id="informacao" class="informacao" style="display:none"></div>
<?php
if (!isset($_GET['cadastro']) && !isset($_GET['pesquisa']))
{
		$controlaFluxos = new Controla_Fluxos();
		$fluxosVo = new FluxosVo();
		
?>
<form method="post" id="formPesquisa" action="#" onsubmit="return false">
	<table align="center">
		<tr>
			<td class="formTdEsquerdo">Grupo de Fluxos:</td>
			<td>
			<?=$controlaFluxos->montaSelectGruposFluxos($fluxosVo)?>
			</td>
		</tr>
		<tr>
			<td class="formTdEsquerdo">Papel Origem:</td>
			<td>
				<?=$controlaFluxos->montaSelectPapeis('selectPapelOrigem')?>
			</td>
		</tr>
		<tr>
			<td class="formTdEsquerdo">Papel Destinatário:</td>
			<td>
				<?=$controlaFluxos->montaSelectPapeis('selectPapelDestinatario')?>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input type="button" name="<?=$dominio->botaoConfirmar?>" value="<?=$dominio->botaoConfirmar_TXT?>" title="<?=$dominio->botaoConfirmar_msg?>" class="botao" onclick="consultar()" />&nbsp;
				<input type="reset" name="<?=$dominio->botaoLimpar?>" value="<?=$dominio->botaoLimpar_TXT?>" title="<?=$dominio->botaoLimpar_msg?>" class="botao" />
			</td>
		</tr>
	</table>
	<input type="hidden" name="pagina" value="pesquisaFluxos" />
</form>
<div id="contentRetorno">
<table width="95%" border="0" cellpadding="1" cellspacing="0" class="tabelaListagem" align="center">
	<tr>
		<td class="tituloListagem">Ordem do Fluxo</td>
		<td class="tituloListagem">Papel Origem</td>
		<td class="tituloListagem">Papel Destinatáro</td>
		<td class="tituloListagem" colspan="2">Grupo de Fluxo Pertencente</td>
	</tr>
	<?=$controlaFluxos->mostraFluxos();?>
</table>
</div>
<?php
} 
elseif (!isset($_GET['pesquisa'])) 
{
	$controlaFluxos = new Controla_Fluxos();
	$fluxosVo = new FluxosVo();
	// Caso seja alteração
	if(isset($_GET['idFluxos']))
	{
		$fluxosVo->setIdFluxos($_GET['idFluxos']);
		$collVo = $controlaFluxos->pesquisarFluxos($fluxosVo);
		$fluxosVo = (object) $collVo[0];
	}
?>
<form action="" method="POST" id="form1" name="form1">
	<table align="center" width="100%">
		<tr>
			<td class="formTdEsquerdo">Grupo do Fluxo:<span class="asterisco"> *</span></td>
			<td colspan="2">
			<?=$controlaFluxos->montaSelectGruposFluxos($fluxosVo)?>
			</td>
		</tr>
		<tr>
			<td class="formTdEsquerdo">Papel Origem do Fluxo:<span class="asterisco"> *</span></td>
			<td colspan="2">
			<?=$controlaFluxos->montaSelectPapeis('selectPapelOrigem',$fluxosVo->getIdPapeisOrigem())?>
			</td>
		</tr>
		<tr>
			<td class="formTdEsquerdo">Papel Destinatário do Fluxo:<span class="asterisco"> *</span></td>
			<td colspan="2">
			<?=$controlaFluxos->montaSelectPapeis('selectPapelDestinatario',$fluxosVo->getIdPapeisDestinatario())?>
			</td>
		</tr>
		<?php
		/**
		 * Buscar os Fluxos na ordem. Caso não seja alteração, apenas seta a ordem, na ultima posição, caso contrário, selecione a ordem.
		 */
		$fluxosVo_ordem = new FluxosVo();
		$fluxosVo_ordem->setIdGrupoFluxos($fluxosVo->getIdGrupoFluxos());
		$collVo_ordem = $controlaFluxos->pesquisarFluxos($fluxosVo_ordem);	
		if(!isset($_GET['idFluxos']))
		{
			$ordem_nova = count($collVo_ordem) + 1;
			echo '<input type="hidden" name="ordemFluxos" id="ordemFluxos" value="'.$ordem_nova.'"/>';
		}
		else
		{
		?>
		<tr>
			<td class="formTdEsquerdo">Ordem do Fluxo:</td>
			<td>
			<select name="ordemFluxos" size="7" id="ordemFluxos" class="campo">
				<?php				
					for($i = 0; $i < count($collVo_ordem); $i++)
					{
						$fluxosVo_ordem = (object) $collVo_ordem[$i];
						
						// Buscar o nome do Papel Origem
						if($fluxosVo_ordem->getIdPapeisOrigem() == $dominio->DomnPapel_Usuario)
						{
							$papelOrigem = $dominio->DomnPapel_Usuario_TXT;
						}
						else 
						{
							$papeisVo = new PapeisVo();
							$controlaPapeis = new Controla_Papeis();
							$papeisVo->setIdPapeis($fluxosVo_ordem->getIdPapeisOrigem());
							$collVo = $controlaPapeis->pesquisarPapeis($papeisVo);
							$papeisVo = (object) $collVo[0];
							$papelOrigem = $papeisVo->getNomePapeis();
						}
						// Buscar o nome do Papel Destinatário
						if($fluxosVo_ordem->getIdPapeisDestinatario() == $dominio->DomnPapel_Usuario)
						{
							$papelDestinatario = $dominio->DomnPapel_Usuario_TXT;
						}
						else 
						{
							$papeisVo = new PapeisVo();
							$controlaPapeis = new Controla_Papeis();
							$papeisVo->setIdPapeis($fluxosVo_ordem->getIdPapeisDestinatario());
							$collVo = $controlaPapeis->pesquisarPapeis($papeisVo);
							$papeisVo = (object) $collVo[0];
							$papelDestinatario = $papeisVo->getNomePapeis();
						}
						
						echo '<option value="'.$fluxosVo_ordem->getIdFluxos().'">'.$papelOrigem.' -> '.$papelDestinatario.'</option>';
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
			<input type="button" value="<?=$dominio->botaoVoltar_TXT?>" id="<?=$dominio->botaoVoltar?>" class="botao" onClick="carregaPagina('viewFluxos.php','formulario');"/>
			</td>
		</tr>
	</table>
	<input type="hidden" name="pagina" id="pagina" value="cadastrarFluxos"/>
	<input type="hidden" name="idFluxos" id="idFluxos" value="<?=$fluxosVo->getIdFluxos()?>"/>
	<input type="hidden" name="idsOrdem" id="idsOrdem" value=""/>
	<input type="hidden" name="funcionalidade" value="<?=basename(__FILE__)?>" />
</form>
<?php
}
?>