<?php
require '../application/GruposUsuarios.php';
require '../application/ProjetoUtil.php'; 
include 'carregamentoInicial.php';
?>
<html>
	<head>
		<script type="text/javascript">
		$(document).ready(function(){ 
			$("#dataPesquisa").mask("99/99/9999");
			$("#datacartaconvite").mask("99/99/9999");
			$("#cpfpessoa").mask("999.999.999-99");
			$("#cpfPesquisa").mask("999.999.999-99");
			$("#numeroProcesso").numeric();
			$("#processoPesquisa").numeric();
		});
			function pesquisar()
			{
				if ( $('processoPesquisa').val() == '' && $('#nomePesquisa').val() == '' && $('#cpfPesquisa').val() == '' && $('#dataPesquisa').val == '') {
					alert('O nome/CPF ou data  deve ser informado.');
					return false;
				}
				else
				{
					var formulario = $('#pesquisaCartaConvite').serialize(true);
					carregaPaginaPesquisa($('#pesquisaCartaConvite').attr("action"),'page',formulario);
				}
			}
			
			function alterar(idcartaconvite)
			{
				var formulario = $('#deletaAltera').serialize(true);
				carregaPagina('convite.php?idcartaconvite='+idcartaconvite,'page');
			}
			function cadastra()
			{
				if ( $('#iddefensor').val() == '' ) {
					alert('O defensor deve ser selecionado');
					return false;
				} 
				else if ( $('#idparteprocesso').val() == '' ) {
					alert('A parte deve ser selecionada.');
					return false;
				}
				else if ( $('#datacartaconvite').val() == '' ) {
					alert('A data do agendamento deve ser informado.');
					return false;
				}
				else {
					var formulario = $('#cartaconvite').serialize(true);
					enviaFormulario($('#cartaconvite').attr("action"),'page',formulario);
				}
			}
			function pesquisaDefensor()
			{
				var formulario = $('#cartaconvite').serialize(true);
				carregaPagina('defensor.php?paramentrosConvite=1&'+formulario,'page');
			}
			function carregaParteProcesso(obj)
			{
				var formulario = $('#cartaconvite').serialize(true);
				carregaPagina('convite.php?numeroProcesso='+obj.value+'&'+formulario,'page');
			}
		</script>
	</head>
	<body>
		<form name="pesquisaCartaConvite" id="pesquisaCartaConvite" method="get" action="../application/recebePostGet.php" >
			<input type="hidden" id="control" name="control" value="Convite"/>
			<input type="hidden" id="pesquisa" name="pesquisa" value="true"/>
			<fieldset>
				<legend class="subtitulo">Pesquisar Carta Convite Emitida:</legend>
				<table>
					<tr>
						<td colspan="3">A pesquisa pela data, numero do processo ou Parte do Processo(Nome ou CPF) é obrigatório.</td>
					</tr>
					<tr>
						<td>Número do Processo:</td>
						<td colspan="2" align="left"><input type="text" name="processoPesquisa" id="processoPesquisa" /></td>
					</tr>
					<tr>
						<td>Nome:</td>
						<td colspan="2" align="left"><input type="text" name="nomePesquisa" id="nomePesquisa" style="text-transform: uppercase;" /></td>
					</tr>
					<tr>
						<td>CPF:</td>
						<td colspan="2" align="left"><input type="text" name="cpfPesquisa" id="cpfPesquisa" /></td>
					</tr>
					<tr>
						<td>Data:</td>
						<td align="left"><input type="text" name="dataPesquisa" id="dataPesquisa" /></td>
					  <td align="left"><input type="button" name="submit" id="submit" value="Pesquisar" onClick="pesquisar();"/></td>
					</tr>
				</table>
			</fieldset>
		</form>
		<?php
		if(isset($_SESSION['convitePesquisa']))
		{
			$arrayConvites = $_SESSION['convitePesquisa'];
		?>
		<form name="deletaAltera" id="deletaAltera" method="post" action="../application/recebePostGet.php" >
			<input type="hidden" id="control" name="control" value="Pessoa"/>
			<input type="hidden" id="funcao" name="funcao" value=""/>
			<input type="hidden" id="idPessoa" name="idPessoa" value=""/>
	      <table width="694">
		      <tr>
		        <td colspan="6">&nbsp;</td>
	        </tr>
		      <tr>
		        <td colspan="6"><strong>Convites Emitidos</strong></td>
	        </tr>
		      <tr>
		        <td colspan="6">&nbsp;</td>
	        </tr>
		      <tr>
		        <td width="63"><strong>Parte</strong></td>
		        <td width="173"><strong>Nº do Processo</strong></td>
		        <td width="224"><strong>Data de Agendamento</strong></td>
		        <td><strong>Marcado Leitura</strong></td>
		        <td colspan="2">&nbsp;</td>
	        </tr>
		      <?php 
				foreach ($arrayConvites as $conviteAtual)
				{
					$cartaConvitePesquisa = new CartasConvites();
					$cartaConvitePesquisa->setIdcartaconvite($conviteAtual);
					$cartaConvitePesquisa->find(true);
				?>
		      <tr>
		        <td><?=$cartaConvitePesquisa->getParteProcesso()->getPessoa()->getNomepessoa()?></td>
		        <td><?=$cartaConvitePesquisa->getParteProcesso()->getProcesso()->getNumeroprocesso()?></td>
		        <td><?=$cartaConvitePesquisa->getDataCartaConviteFormatado()?></td>
		        <td width="138"><?=($cartaConvitePesquisa->getLeitura() == 0)?"Não lido":"lido"?></td>
		        <?php
					$usuario = new Usuarios();
					$usuario->setUsuario($_SESSION["loginusuario"]);
					$usuario->find(true);
					if($usuario->getPessoa()->isDefensor() || $usuario->getGrupousuario() == GruposUsuarios::$GRUPO_ADMIN)
					{ 
					?>
		        <td width="16"><a href="javascript:void(0);" onClick="alterar(<?=$cartaConvitePesquisa->getIdcartaconvite()?>)"><img src="images/botao_editar.gif" width="16" height="16" border="0" /></a></td>
		        <td width="32"><a href="javascript:void(0);" onClick="gerarPdf(<?=$cartaConvitePesquisa->getIdcartaconvite()?>)"><img src="images/pdf.jpg" width="16" height="16" border="0" /></a></td>
		        <?php
					}
					else 
					{?>
		        <td width="16" colspan="2"><a href="javascript:void(0);" onClick="gerarPdf(<?=$cartaConvitePesquisa->getIdcartaconvite()?>)"><img src="images/pdf.jpg" width="16" height="16" border="0" /></a></td>
		        <?} 
					?>
	        </tr>
		      <?php 
				}
			  	?>
	      </table>
		</form>
		<?php
		unset($_SESSION['convitePesquisa']); 
		}
			
		$cartaConvite = new CartasConvites();
		if(isset($_GET['idcartaconvite']) && $_GET['idcartaconvite'] != '')
		{
			$cartaConvite->setIdcartaconvite($_GET['idcartaconvite']);
			$cartaConvite->find(true);
			$numeroProcesso = $cartaConvite->getParteProcesso()->getProcesso()->getNumeroprocesso();
			$idparteprocesso = $cartaConvite->getParteProcesso()->getIdparteprocesso();
			$iddefensor = $cartaConvite->getIddefensor();
			$nomeDefensor = $cartaConvite->getDefensor()->getPessoa()->getNomepessoa();
			$datacartaconvite = $cartaConvite->getDataCartaConviteFormatado();
		}
		else
		{
			$numeroProcesso = (isset($_GET['numeroProcesso']))?$_GET['numeroProcesso']:"";
			$idparteprocesso = (isset($_GET['idparteprocesso']))?$_GET['idparteprocesso']:"";
			$iddefensor = (isset($_GET['iddefensor']))?$_GET['iddefensor']:"";
			$nomeDefensor = (isset($_GET['nomeDefensor']))?$_GET['nomeDefensor']:"";
			$datacartaconvite =  (isset($_GET['datacartaconvite']))?$_GET['datacartaconvite']:"";
		}
		?>
		<br/><br/><br/><br/>
		<form name="cartaconvite" id="cartaconvite" method="post" action="../application/recebePostGet.php" >
			<?php 
			if(!isset($_GET['idcartaconvite']) || $_GET['idcartaconvite'] == '')
			{
				?>
				<input type="hidden" id="leitura" name="leitura" value="0"/>
				<?
			}
			?>
			<input type="hidden" id="control" name="control" value="Convite"/>
			<input type="hidden" id="funcao" name="funcao" value="<?=(isset($_GET['idcartaconvite']) && $_GET['idcartaconvite']!='')?"alterar":"cadastrar"?>"/>
			<input type="hidden" id="idcartaconvite" name="idcartaconvite" value="<?=(isset($_GET['idcartaconvite']))?$_GET['idcartaconvite']:""?>"/>
			<fieldset>
				<legend class="subtitulo"><?=(isset($_GET['idcartaconvite']) && $_GET['idcartaconvite']!=''?"Alterar":"Cadastrar")?>/Gerar Carta Convite:</legend>
				<table width="633">
					<tr>
						<td width="95" align="left">Número do Processo:</td>
						<td width="144" align="left">
							<input type="text" id="numeroProcesso" name="numeroProcesso" value="<?=$numeroProcesso?>"/>
						</td>
						<td align="left">
							<input type="button" value="Pesquisar Parte" onClick="carregaParteProcesso(this);">
						</td>
					</tr>
					<tr id="parteProc">
						<td align="left">Parte:</td>
						<td align="left" colspan="2">
						  <select id="idparteprocesso" name="idparteprocesso">
								<option>Selecione a parte do Processo</option>
								<?php 
								if($numeroProcesso!='')
								{
									$processo = new Processo();
									$processo->setNumeroprocesso($numeroProcesso);
									if($processo->find(true))
									{
										$parteProcesso = new ParteProcesso();
										$parteProcesso->setIdprocesso($processo->getIdprocesso());
										$parteProcesso->find();
										while ($parteProcesso->fetch())
										{
											echo '<option value="'.$parteProcesso->getIdparteprocesso().'"';
											if($idparteprocesso == $parteProcesso->getIdparteprocesso())
												echo "selected";
											echo '>'.$parteProcesso->getPessoa()->getNomepessoa();
											if($parteProcesso->getIddefensor() != null)
												echo "(Assistido)";
											echo "</option>";
										}
									}
								}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td width="95" align="left">Defensor:</td>
						<td width="144" align="left">
						  <input type="hidden" id="iddefensor" name="iddefensor" value="<?=$iddefensor?>"/>
							<input type="hidden" id="nomeDefensor" name="nomeDefensor" value="<?=$nomeDefensor?>"/>
							<?=$nomeDefensor?>
						</td>
						<td width="378" align="left"><input type="button" name="selecione" id="selecione" value="Selecione" onClick="pesquisaDefensor();"/></td>
					</tr>
					<?php 
					if(isset($_GET['idcartaconvite']) && $_GET['idcartaconvite'] != '')
					{
						$usuario = new Usuarios();
						$usuario->setUsuario($_SESSION["loginusuario"]);
						$usuario->find(true);
						if($usuario->getPessoa()->isDefensor() || $usuario->getGrupousuario() == GruposUsuarios::$GRUPO_ADMIN)
						{
					?>
					<tr>
						<td align="left">Marcar Leitura</td>
						<td align="left">
						  <select id="leitura" name="leitura">
								<option value="0" <?=($cartaConvite->getLeitura() == 0)?"Selected": ""?>>Não</option>
								<option value="1" <?=($cartaConvite->getLeitura() == 1)?"Selected": ""?>>Sim</option>
							</select>
						</td>
					</tr>
					<?php
						} 
					}
					?>
					<tr>
						<td align="left">Data do Agendamento:</td>
						<td align="left"><input type="text" name="datacartaconvite" id="datacartaconvite" value="<?=$datacartaconvite?>" /> (ex. 11/11/2010)</td>
						<td align="left"><input type="button" name="submit" id="submit" onClick="cadastra();" value="<?=(isset($_GET['idcartaconvite']) && $_GET['idcartaconvite']!='')?"Alterar":"Cadastrar"?>"/></td>		
					</tr>
				</table>
			</fieldset>
		</form>
	</body>
</html>