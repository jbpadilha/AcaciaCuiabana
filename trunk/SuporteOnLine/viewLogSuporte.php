<?php
//####################################
// * Rafael Henrique Vieira de Moura /Desenvolvedor (Ábaco Tecnologia)
// * Arquivo: viewLogSuporte.php
// * Criação: Rafael Henrique Vieira de Moura
// * Revisão:
// * Data de criação: 14/07/2008
//####################################

/**
 * Página de Visualização de Logs
 */

require("config.php");
if(!isset($_SESSION["usuario_Logado"]))
{
	header("Location:index.php");
}
?>
<script type="text/javascript">
	$(document).ready(function(){
		$('#dataCriacaoLog').calendar({
			//autoPopUp: "button",
			clearText: "Limpar", //Nome do botao limpar
			closeText: "Fechar", //nome do botao fechar
			prevText: "&lt;Ant", // nome do botao anterior
			nextText: "Prox&gt;", //nome do botao proximo
			currentText: "Hoje", //nome do botao hoje
			dayNames: new Array("Dom","Seg","Ter","Qua","Qui","Sex","Sab"), // Array com dias da seman
			monthNames: new Array("Jan","Fev","Mar","Abr","Mai","Jun","Jul","Ago","Set","Out","Nov","Dez"), //array com os nome dos meses
			speed: "fast" //velocidade de abertura
			//buttonImageOnly: true, //apresentar botao somente na img
			//buttonImage: "/images/onix/calendar.gif", //nome da img e local onde vai abrir o click para o calendario
			//buttonText: "Calendario" //nome do botao
		});
		$('#dataCriacaoLog').mask('99/99/9999');
	})
	function consultar(){
		var formulario = $('#formPesqLogSuporte').serialize(true);
		$('#conteudo').block({message:'<h4>Aguarde...</h4><br/><img src="./imagens/loading.gif" border="0" />'});
		$.post('class/ControlaPostGet.php',formulario,function(retorno){
			$('#conteudo').unblock();
			$('#contentRetorno').empty().html(retorno);
			$('#contentRetorno').slideDown('slow');
		})
	}
</script>
<h3>LOGS</h3>
<div id="barra">
	<a href="javascript:void(0)" title="Localizar Log" onclick="carregaPagina('viewLogSuporte.php','formulario');"><img src="imagens/ico_localizar.gif" border="0"  />&nbsp;&nbsp;Localizar Logs</a>
</div>
<br />
<form method="post" id="formPesqLogSuporte" action="#" onsubmit="return false">
	<table align="center">
		<tr>
			<td colspan="3" align="center"><strong>Pesquisa de Log</strong></td>
		</tr>
		<tr>
			<td class="formTdEsquerdo">Usuário</td>
			<td>
				<select name="idUsuarios" class="campo">
					<option value="0">--SELECIONE--</option>
					<?php
						$usuariosVo = new UsuariosVo();
						$controlaUsuarios = new Controla_Usuarios();
						$usuariosVo->setParametroConsulta("ORDER BY nomeUsuarios ASC");
						$collVo = $controlaUsuarios->pesquisarUsuariosSistema($usuariosVo);
						for ($i=0;$i < count($collVo); $i++)
						{
							$usuariosVo = (object) $collVo[$i];
							echo '<option value="'.$usuariosVo->getIdUsuarios().'">'.$usuariosVo->getNomeUsuarios().'</option>\n';
						}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td class="formTdEsquerdo">Funcionalidades</td>
			<td>
				<select name="idFuncionalidades" class="campo">
					<option value="0">--SELECIONE--</option>
					<?php
						$funcionalidadesVo = new FuncionalidadesVo();
						$controlaFuncionalidades = new Controla_Funcionalidades();
						$collVo = $controlaFuncionalidades->pesquisarFuncionalidades($funcionalidadesVo);
						for ($i=0;$i < count($collVo); $i++)
						{
							$funcionalidadesVo = (object) $collVo[$i];
							echo '<option value="'.$funcionalidadesVo->getIdFuncionalidades().'">'.$funcionalidadesVo->getNomeFuncionalidades().'</option>\n';
						}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td class="formTdEsquerdo">Data</td>
			<td>
				<input type="text" name="dataCriacaoLog" id="dataCriacaoLog" size="12" maxlength="10" class="campo" />
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input type="button" name="<?=$dominio->botaoConfirmar?>" value="<?=$dominio->botaoConfirmar_TXT?>" title="<?=$dominio->botaoConfirmar_msg?>" class="botao" onclick="consultar()" />&nbsp;
				<input type="reset" name="<?=$dominio->botaoLimpar?>" value="<?=$dominio->botaoLimpar_TXT?>" title="<?=$dominio->botaoLimpar_msg?>" class="botao" />
			</td>
		</tr>
	</table>
	<input type="hidden" name="pagina" value="pesquisaLogSuporte" />
</form>
<br />
<div id="contentRetorno">
<?php
	$log_SuporteVo = new Log_SuporteVo();
	$controlaLogSuporte = new Controla_LogSuporte();
	$log_SuporteVo->setParametroConsulta(' ORDER BY dataCriacaoLog_Suporte DESC');
	$controlaLogSuporte->mostraListaLogSuporte($log_SuporteVo);
?>
</div>