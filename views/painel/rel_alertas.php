<?php 
	if (isset($_GET['require']))
	{
		require ('../../class/Config.php');
	}
	$show_month = 1;
	$month = null;
	$year = null;
	$day = null;

	if (isset($show_month)) {
		if ($show_month == '>') {
			if($month == 12) { $month=1; $year++; }
			else { $month++; }
		}
		if ($show_month == '<') {
			if (month == 1) { $month=12; $year--; }
			else { $month--; }
		}
	}

	if (isset($day)) { str_pad($day, 2, '0', STR_PAD_LEFT); }
	if (isset($month)) { str_pad($month, 2, '0', STR_PAD_LEFT); }
	if (!isset($year)) { $year = isset($_GET['ano']) ? $_GET['ano'] : date('Y'); }

	if (!isset($month)) {
		$month=date('m');
		$month = isset($_GET['mes']) ? $_GET['mes'] : $month;
		if ($month == 0) { $month = 12; $year--; }
		if ($month == 13) { $month = 1; $year++; }
	}

	if (!isset($day)) { $day=date('d'); }

	$thisday = $year.'-'.$month-$day;
	$day_name = array('Seg','Ter','Qua','Qui','Sex','Sáb','Dom');
	$month_abbr = array('','Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez');

	switch ($month) {
		case 1: $month_name = 'Janeiro'; break;
		case 2: $month_name = 'Fevereiro'; break;
		case 3: $month_name = 'Março'; break;
		case 4: $month_name = 'Abril'; break;
		case 5: $month_name = 'Maio'; break;
		case 6: $month_name = 'Junho'; break;
		case 7: $month_name = 'Julho'; break;
		case 8: $month_name = 'Agosto'; break;
		case 9: $month_name = 'Setembro'; break;
		case 10: $month_name = 'Outubro'; break;
		case 11: $month_name = 'Novembro'; break;
		case 12: $month_name = 'Dezembro'; break;
	}

?>
<script type="text/javascript" language="javascript" src="../scripts/ajax.js"> </script>
<script type="text/javascript" language="javascript" src="../scripts/jquery.js"> </script>
<script type="text/javascript" language="javascript" src="../scripts/full.js"></script>
<link rel="stylesheet" type="text/css" href="../css/jquery.lightbox-0.5.css" media="screen" />
    <!-- / fim dos arquivos utilizados pelo jQuery lightBox plugin -->
    
    <!-- Ativando o jQuery lightBox plugin -->
    <script type="text/javascript">
    $(function() {
        $('#aniversarios a').lightBox();
    });
    </script>
<style>
	body { margin:0px auto; padding:0px; font:normal 12px "Segoe UI", Verdana, Arial; color:#000; }
	table { width:100%; }
	a { text-decoration:none; color:#000; }
	tr.dias td { border-width:1px; border-style:solid; border-color:#FFF #AAA #AAA #FFF; width:150px; height:60px; vertical-align:top; padding:0px; }
	td.hoje { background:#FFCC00; }
	td.dia { background:#FFAA00; }
	td.dia:hover { background:#FFBB22; }
	td.dia .link, td.hoje .link { font-weight:bold; margin:0px; float:left; width:100%; text-align:left; padding:2px 4px; width:24px; height:20px; background:url('../imagens/bg-topleft.png') no-repeat top left; cursor:default; }

	div.titulo { text-align:center; margin:10px; }
	div.titulo label { font:bold 22px "Segoe UI", Verdana, Arial; width:280px; }
	div.titulo img { cursor:pointer; height:32px; vertical-align:bottom; padding:0px 20px; }

	.tcenter { text-align:center; }
	tr.head { background:#EEE; font:bold 16px "Segoe UI", Verdana; text-align:center; cursor:default; }
	tr.head td { padding:4px; border-color:#AAA #000 #000 #AAA; border-width:1px; border-style:solid; }
	tr.head td:hover { background:#DDD; }

	label.ativo { clear:both; float:left; width:100%; text-align:left; font-family:Consolas, Courier; margin:2px 0px 0px 0px; color:#444; padding:2px 0px; cursor:pointer; }
	label.ativo:hover { color:#FFF; font-weight:bold; background:#FFD800; }
</style>

<div id="cal">
	<div class="titulo">
		<img src="../imagens/left.png" alt="Anterior" title="mês anterior" onclick="Request('<?php echo 'rel_alertas.php?require=sim&mes='.($month-1).'&ano='.($year); ?>', 'cal')" />
		<label> <?php echo $month_name .' de '. $year; ?> </label>
		<img src="../imagens/right.png" alt="PrÃ³ximo" title="prÃ³ximo mês" onclick="Request('<?php echo 'rel_alertas.php?require=sim&mes='.($month+1).'&ano='.($year); ?>', 'cal')" />
	</div>

<table>
	<tr class="head">
	<?php
		for ($i = 0; $i < 7; $i++) {
			echo '<td>'.$day_name[$i].'</td>';
		}
	?>
	</tr>
	<tr class="dias">
	<?php
		if (date('w',mktime(0,0,0,$month,1,$year))==0) { $start = 7; }
		else { $start=date ('w',mktime(0,0,0,$month,1,$year)); }
		for ($a = ($start-2); $a >= 0; $a--) {
			$d = date('t',mktime(0,0,0,$month,0,$year))-$a;
			echo '<td>'.$d.'</td>';
		}
		for ($d = 1; $d <= date('t',mktime(0,0,0,($month+1),0,$year)); $d++) {
			$dia = str_pad($d, 2, '0', STR_PAD_LEFT);
			$_mes = str_pad($month, 2, '0', STR_PAD_LEFT);
			$date = $dia.'/'.$_mes.'/'.$year;
	?>
	<td class="<?php if ($dia == date('d',mktime()) && $_mes == date('m', mktime())) { echo 'hoje'; } else { echo 'dia'; } ?>" >
		<label class="link"><?php echo $dia; ?></label>
		<?php
			$data = $year."-".$_mes."-".$dia;
			$userLogon = new Logon();
			$userLogon = $_SESSION['usuarioLogon'];
			$mostraLinkMais = false;
			
			//Aniversariantes - Clientes ou Administrador (todos os cadastros)
			
			$collVoPessoa = $controla->listarAniversariosClientes($userLogon,$data);
				
			if(!is_null($collVoPessoa) && count($collVoPessoa)>0)
			{
				$pessoaAtual = new Pessoa();
				$pessoaAtual = $collVoPessoa[0];
				echo '<label class="ativo" title="'.$formataData->toViewDate($pessoaAtual->getDataNascimentoPessoa()).'">Aniversário de '.$pessoaAtual->getNomePessoa().'</label>';
				$mostraLinkMais = true;
				$_SESSION['listaPessoa'] = $collVoPessoa;
			}
			
			//Lista CNH de Clientes
			$collVoCnh = $controla->listaCnhVencida($userLogon,$data);
			if(!is_null($collVoCnh) && count($collVoCnh)>0)
			{
				echo '<label class="ativo" title="">Vencimento de CNH</label>';
				$mostraLinkMais = true;
				$_SESSION['listaCnh'] = $collVoPessoa;
			}
			
			//Lista de IPVA Vencido
			$collVoIpva = $controla->listaIpvaVencidos($userLogon,$data);
			if(!is_null($collVoIpva) && count($collVoIpva)>0)
			{
				echo '<label class="ativo" title="">Vencimento de IPVA</label>';
				$mostraLinkMais = true;
				$_SESSION['listaIpva'] = $collVoPessoa;
			}
			
			//Lista Seguros vencidos
			$collVoSeguro = $controla->listaSeguroVencidos($userLogon,$data);
			if(!is_null($collVoSeguro) && count($collVoSeguro)>0)
			{
				echo '<label class="ativo" title="">Vencimento de Seguro</label>';
				$mostraLinkMais = true;
				$_SESSION['listaSeguro'] = $collVoPessoa;
			}
			
			$collVoGarantias = $controla->ListaGarantiasVenc($userLogon,$data);
			if(!is_null($collVoGarantias) && count($collVoGarantias)>0)
			{
				echo '<label class="ativo" title="">Vencimento de Garantia</label>';
				$mostraLinkMais = true;
				$_SESSION['listaRevisoes'] = $collVoPessoa;
			}
			
			//Lista de RevisÃµes
			$collVoRevisoes = $controla->listaRevisoes($userLogon,$data);
			if(!is_null($collVoGarantias) && count($collVoGarantias)>0)
			{
				echo '<label class="ativo" title="">Revisão agendada para Hoje</label>';
				$mostraLinkMais = true;
			}
			if($mostraLinkMais)
			{
				echo "<label class=\"ativo\"><div id=\"vejaMais\">
				<a href=\"javascript:void(0);\" onClick=\"abrepagina('vejaMais.php', 300, 300);\">Veja mais ++</a></div></label>";
			}
		?>
	</td>
		<?php
			if (date('w',mktime(0,0,0,$month,$d,$year)) == 0 && date('t',mktime(0,0,0,($month+1),0,$year)) > $d) {
		?>
	</tr>
	<tr class="dias">
	<?php
		}
	}
	if (date('w',mktime(0,0,0,$month+1,1,$year)) <> 1) {
		$d = 1;
		while (date('w',mktime(0,0,0,($month+1),$d,$year)) <> 1) {
	?>
			<td>
				<?php echo str_pad($d, 2, '0', STR_PAD_LEFT); ?>
			</td>
<?php
			$d++;
		}
	}
?>
	</tr>
</table>
</div>