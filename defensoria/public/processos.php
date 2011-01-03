<?php 
require '../application/GruposUsuarios.php';
include 'carregamentoInicial.php';
?>
<html>
	<head>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#cpfpesquisa").mask("999.999.999-99");
				$("#numeroprocessoPesquisa").numeric();
				$("#numeroprocesso").numeric();
			});
			function pesquisar()
			{
				if ( $('#nomePesquisa').val() == '' && $('#cpfpesquisa').val() == '' && $('#numeroprocesso').val() == '') {
					alert('O nome, CPF ou número do processo deve ser informado.');
				}
				else
				{
					var formulario = $('#pesquisaParte').serialize(true);
					carregaPaginaPesquisa($('#pesquisaParte').attr("action"),'page',formulario);
				}
			}

			function analisaProcesso(idprocesso)
			{
				carregaPagina('processos.php?processoAnalisa='+idprocesso,'page');
			}
			function analisar()
			{
				if ( $('#idcomarca').val() == '' ) {
					alert('A comarca deve ser informado.');
					return false;
				}else if ( $('#assuntoentrevista').val() == '' ) {
					alert('O assunto deve ser informado.');
					return false;
				} 
				else if ( $('#numeroprocesso').val() == '' ) {
					alert('O Número do Processo deve ser informado.');
					return false;
				}
				else {
					var formulario = $('#analisaProcesso').serialize(true);
					enviaFormulario($('#analisaProcesso').attr("action"),'page',formulario);
				}
			}
		</script>
	</head>
	<body>
		<legend class="subtitulo">Acompanhamento de Processo:</legend>
		<br/>
		<form name="pesquisaParte" id="pesquisaParte" method="get" action="../application/recebePostGet.php" >
			<input type="hidden" id="control" name="control" value="Processos"/>
			<input type="hidden" id="pesquisa" name="pesquisa" value="true"/>
			<fieldset>
			<legend class="subtitulo">Pesquisar Pessoa:</legend>
				<table>
					<tr>
						<td>A pesquisa pelo nome, CPF ou número do processo é obrigatório.</td>
					</tr>
					<tr>
						<td>Nome:</td>
						<td colspan="2" align="left"><input type="text" name="nomePesquisa" id="nomePesquisa" style="text-transform: uppercase;" /></td>
					</tr>
					<tr>
						<td>CPF:</td>
						<td colspan="2" align="left"><input type="text" name="cpfpesquisa" id="cpfpesquisa" /></td>
					</tr>
					<tr>
						<td>Número do Processo:</td>
						<td align="left"><input type="text" name="numeroprocessoPesquisa" id="numeroprocessoPesquisa" /></td>
					  <td align="left"><input type="button" name="submit" id="submit" value="Pesquisar" onClick="pesquisar();"/></td>
					</tr>
				</table>
			</fieldset>
		</form>
		
		<?php 
		if(isset($_SESSION['processoPesquisa']))
		{
			?>
			<form name="visualizaProcesso" id="visualizaProcesso" method="post" action="../application/recebePostGet.php" >
				<input type="hidden" id="control" name="control" value="Processos"/>
				<input type="hidden" id="funcao" name="funcao" value="Visualiza"/>
				<table width="994">
					<tr>
						<td colspan="4">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="4"><strong>Processo Pesquisado</strong></td>
					</tr>
					<tr>
						<td colspan="4">&nbsp;</td>
					</tr>
					<tr>
						<td width="158"><strong>Nº do Processo</strong></td>
						<td width="158"><strong>Parte Assistida</strong></td>
						<td><strong>Defensor</strong></td>
						<td>&nbsp;</td>
					</tr>
			<?php 
			foreach ($_SESSION['processoPesquisa'] as $proc) 
			{
				$processo = new Processo();
				$processo->setIdprocesso($proc);
				$processo->find(true);
				$parteProcessoAssistido = new ParteProcesso();
				$idParteProcessoAssistido = $parteProcessoAssistido->getIdParteProcessoAssistido($proc);
				if($idParteProcessoAssistido != null)
				{
					$parteProcessoAssistido->setIdparteprocesso($idParteProcessoAssistido);
					$parteProcessoAssistido->find(true);
				}
				?>
					<tr>
						<td><?=$processo->getNumeroprocesso()?></td>
						<td><?=$parteProcessoAssistido->getPessoa()->getNomepessoa();?></td>
						<td width="255"><?=$parteProcessoAssistido->getDefensor()->getPessoa()->getNomepessoa();?></td>
						<td width="395">
							Processo não analisado pelo Defensor.<br/>
							<?php 
							if($_SESSION['grupo'] == GruposUsuarios::$GRUPO_ADMIN || ($_SESSION['grupo'] == GruposUsuarios::$GRUPO_DEFENSOR && $_SESSION['loginusuario'] == $parteProcessoAssistido->getIddefensor()) )
							{
								if($processo->getNumeroprocesso()==null || $processo->getIdvara() == null)
								{
								?>
								<a href="javascript:void(0);" onClick="analisaProcesso(<?=$processo->getIdprocesso()?>)">Analise agora</a>
								<?
								}
								else
								{
									?>
									<a href="javascript:void(0);" onClick="alterarProcesso(<?=$processo->getIdprocesso()?>)">Alterar</a>&nbsp;&nbsp;&nbsp;
									<a href="javascript:void(0);" onClick="visualizarProcesso(<?=$processo->getIdprocesso()?>)">Visualizar</a>
									<?
								}
							}
							?>
						</td>
					</tr>
				<?
			}
			?>
					<tr>
						<td colspan="4">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="4">&nbsp;</td>
					</tr>
				</table>
			</form>
			<?php 
			unset($_SESSION['processoPesquisa']);	
		}
		if(isset($_GET['processoAnalisa']))
		{
			$processo = new Processo();
			$processo->setIdprocesso($_GET['processoAnalisa']);
			
			$processo->find(true);
			?>
			<form name="analisaProcesso" id="analisaProcesso" method="post" action="../application/recebePostGet.php" >
				<input type="hidden" id="control" name="control" value="Processos"/>
				<input type="hidden" id="funcao" name="funcao" value="Analisar"/>
				<input type="hidden" id="idprocesso" name="idprocesso" value="<?=$processo->getIdprocesso()?>"/>
				<table width="613">
					<tr>
						<td>Número do Processo:</td>
						<td><input id="numeroprocesso" name="numeroprocesso" value="<?=$processo->getNumeroprocesso()?>"></td>
					</tr>
					<tr>
						<td width="269">Comarca:</td>
						<td width="332" colspan="2" align="left">
							<select id="idcomarca" name="idcomarca">
								<option value="">Selecione</option>
								<?php 
								$comarca = new Comarca();
								$comarca->find();
								if($comarca->fetch())
								{
								?>
								<option value="<?=$comarca->getIdcomarca()?>" <?=$processo->getIdcomarca() == $comarca->getIdcomarca()?"selected":""?>><?=$comarca->getNomecomarca()?></option>
								<?php 
								}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td>Vara:</td>
						<td>
							<select id="idvara" name="idvara">
								<option value="">Selecione</option>
								<?php 
								$vara = new Vara();
								$vara->find();
								if($vara->fetch())
								{
								?>
								<option value="<?=$vara->getIdvara()?>" <?=$processo->getIdvara() == $vara->getIdvara()?"selected":""?>><?=$vara->getCodvara()."-".$vara->getNomevara()?></option>
								<?php 
								}
								?>
							</select>
						</td>
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
								<option value="<?=$tipoAcao->getIdtipoacao()?>" <?=$processo->getIdtipoacao() == $tipoAcao->getIdtipoacao()?"selected":""?>><?=$tipoAcao->getTipoacao()?></option>
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
								<option value="<?=$naturezaAcao->getIdnaturezaacao()?>" <?=$processo->getIdnaturezaacao() == $naturezaAcao->getIdnaturezaacao()?"selected":""?>><?=$naturezaAcao->getNaturezaacao()?></option>
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
								<option value="<?=ProjetoUtil::$juizo_Primeiro_Grau?>" <?=$processo->getJuizo() == ProjetoUtil::$juizo_Primeiro_Grau? "selected":"" ?>><?=ProjetoUtil::$juizo_Primeiro_Grau_TXT?></option>
								<option value="<?=ProjetoUtil::$juizo_Segundo_Grau?>" <?=$processo->getJuizo() == ProjetoUtil::$juizo_Segundo_Grau? "selected":"" ?>><?=ProjetoUtil::$juizo_Segundo_Grau_TXT?></option>
							</select>
						</td>
					</tr>
					<?php 
					$parteProcesso = new ParteProcesso();
					$parteProcesso->setIdprocesso($processo->getIdprocesso());
					if($parteProcesso->find())
					{
						while($parteProcesso->fetch())
						{
					?>
					<tr>
						<td>Parte <?=$parteProcesso->getTipoParteTxt();?><?=($parteProcesso->getIddefensor()!=null)?"(Assistido)":""?>:</td>
						<td><?=$parteProcesso->getPessoa()->getNomepessoa()?></td>
					</tr>
					<?php
						} 
					}
					?>
					<tr>
						<td colspan="2">
							<input type="button" name="submit" id="submit" value="Cadastrar" onClick="analisar();"/>
						</td>
					</tr>
				</table>
			</form>
			<?php
		}
		?>
	</body>
</html>