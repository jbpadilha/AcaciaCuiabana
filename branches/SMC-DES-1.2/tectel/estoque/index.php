<?php
	$empresa_fantasia 	= "SMC";
	$empresa_razao 		= "SMC - Serviço de Manutenção e Consultoria";
	$empresa_cnpj 		= "99.999.999/0009-99";
	$empresa_insc 		= "99.999.999-99";
	$agora['data'] 		= date('d/m/Y');
	$agora['hora'] 		= date('H:i');
	$linkSMC 			= "<a href=\"http://servicodespertador.net\" target=\"_self\">http://servicodespertador.net</a>\n";
	$url_atual 			= "http://".$_SERVER['SERVER_NAME'].$_SERVER ['REQUEST_URI'];
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd"> 
<html>

<head>
	<title>[ GEst ] - <?php echo $empresa_fantasia; ?></title>
	<link rel="stylesheet" type="text/css" href="css/geral.css" />
	<script language="javascript" type="text/javascript" src="js/jquery-1.4.2.js"> </script>
	<script language="javascript" type="text/javascript" src="js/jquery.bsformaccelerator.js"> </script>
	<script language="javascript" type="text/javascript" src="js/jquery-maskedinput.js"> </script>
	<script language="javascript" type="text/javascript" src="js/jquery.maskMoney.0.2.js"> </script>
	<script language="javascript" type="text/javascript" src="js/jquery.ui.core.js"> </script>
<!--
	<script language="javascript" type="text/javascript" src="js/jquery.meio.mask.js"> </script>
	<script language="javascript" type="text/javascript" src="js/jquery.dragndrop.js"> </script>
	<script language="javascript" type="text/javascript" src="js/jquery.corner.js"> </script>
	<script language="javascript" type="text/javascript" src="js/jquery.jeditable.js"> </script>
-->
	<?php include 'scripts/geral.php'; ?>
</head>

<body id="form_estoque">

<div id="site">

<div id="topo">
	<img src="img/estoque.png" alt="Ícone" />
	<h2>[ GEst - Gestão de Estoque ] - <?php echo $empresa_fantasia; ?></h2>
	<img src="img/maximizar.png" id="bt_maximizar" alt="Maximiar" title="Maximizar" class="ico_bt" />
</div>

<div id="menu">
	<?php criarLinks('menu'); ?>
</div>
<div id="menu">
	<?php criarLinks($_GET['acao']); ?>
</div>

<div id="corpo">
<?php
	if ($_GET['form']) {
		echo "<form method=\"post\" name=\"".$_GET['form']."\" id=\"".$_GET['form']."\" action=\"\">\n";
		echo "<fieldset>\n";
		switch($_GET['form']) {
			case 'categorias' : 
				$target = "p_cat_cod";
				$legend = "Cadastro de categorias de produtos";
				TitleBar(); 
				echo "<div id=\"".$_GET['form']."\" class=\"formulario\">\n";
				criarInputs($_GET['form']);
				Submit();
				echo "</div>";
				break;
			case 'produtos' :
				$target = "p_cod";
				$legend = "Cadastro de produtos";
				TitleBar(); 
				echo "<div id=\"".$_GET['form']."\" class=\"formulario\">\n";
				criarInputs($_GET['form']);
				Submit();
				echo "</div>";
				break;
			case 'fornecedores' :
				$target = "f_fantasia";
				$legend = "Cadastro de fornecedores";
				TitleBar(); 
				echo "<div id=\"".$_GET['form']."\" class=\"formulario\">\n";
				criarInputs($_GET['form']);
				Submit();
				echo "</div>";
				break;
			case 'clientes' :
				$target = "cli_nome";
				$legend = "Cadastro de Clientes";
				TitleBar(); 
				echo "<div id=\"".$_GET['form']."\" class=\"formulario\">\n";
				criarInputs($_GET['form']);
				Submit();
				echo "</div>";
				break;
			case 'venda' :
				$target = "venda_p_cat_cod";
				$legend = "Venda de produtos";
				TitleBar(); 
				echo "<div id=\"".$_GET['form']."\" class=\"formulario\">\n";
				criarInputs($_GET['form']);
				Submit();
				echo "</div>";
				break;
		}
		echo "<span id=\"legenda\"></span>\n";
		echo "</fieldset>\n";
		echo "</form>\n";
	}
	
?>
</div>

</div>

<div id="rodape">
	<?php echo $linkSMC; ?>
</div>

</body>

<script type="text/javascript">
<?php
	if ($target != "") {
		echo "	document.getElementById(\"".$target."\").focus();\n";
		echo "	$('#bt_fechar').click(function() { $('div.formulario').toggle('slow'); return false;});\n";
		echo "	$('input[type=\'text\'], select, textarea').focus(function(){ $('span#legenda').html($(this).attr('alt')); })\n";
		echo "	$('input[type=\'text\'], select, textarea').blur(function(){\n";
		echo "		$('span#legenda').html('');\n";
		echo "		$(this).val($(this).val().toUpperCase());\n";
		echo "	})\n";
	}
	switch ($_GET['form']) {
		case 'categorias':
			echo "	$('input#p_cat_cod').mask('999999', { placeholder:'_'} )\n";
			break;
		case 'produtos':
			echo "	$('input#p_cod').mask('999999',{placeholder:'_'});\n";
			echo "	$('input#p_compra_data').mask('99/99/9999',{placeholder:'_'});\n";
			echo "	$('input#f_cnpj').mask('99.999.999/9999-99',{placeholder:'_'});\n";
			echo "	$('input#p_preco, input#p_custo').maskMoney({symbol:'R$',decimal:',',thousands:'.',precision:2});\n";
			break;
		case 'fornecedores':
			echo "	$('input#f_insc').mask('99.999-999',{placeholder:'_'});\n";
			echo "	$('input#f_end_cep').mask('99.999-999',{placeholder:'_'});\n";
			echo "	$('input#f_tel, input#f_cel, input#f_fax').mask('(99) 9999-9999',{placeholder:'_'});";
			break;
		case 'venda':
			echo "	$('input#venda_data').mask('99/99/9999',{placeholder:'_'});";
	}
?>
	eval(function(p,a,c,k,e,r){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('(4($){2 w=($.21.1V?\'1U\':\'1Q\')+".C";2 x=(1o.1E!=1A);$.C={1m:{\'9\':"[0-9]",\'a\':"[A-1k-z]",\'*\':"[A-1k-1s-9]"}};$.28.1i({D:4(b,c){3(5.y==0)6;3(1h b==\'1f\'){c=(1h c==\'1f\')?c:b;6 5.11(4(){3(5.13){5.1e();5.13(b,c)}B 3(5.1d){2 a=5.1d();a.1B(V);a.1z(\'Y\',c);a.1c(\'Y\',b);a.1x()}})}B{3(5[0].13){b=5[0].1w;c=5[0].1v}B 3(15.S&&15.S.1a){2 d=15.S.1a();b=0-d.1D().1c(\'Y\',-1y);c=b+d.29.y}6{I:b,W:c}}},X:4(){6 5.1F("X")},C:4(m,n){3(!m&&5.y>0){2 o=$(5[0]);2 q=o.R("12");6 $.18(o.R("14"),4(c,i){6 q[i]?c:E}).19(\'\')}n=$.1i({F:"1G",U:E},n);2 r=$.C.1m;2 q=[];2 s=m.y;2 u=E;2 v=m.y;$.11(m.1b(""),4(i,c){3(c==\'?\'){v--;s=i}B{q.1I(r[c]?20 22(r[c]):E);3(q[q.y-1]&&u==E)u=q.y-1}});6 5.11(4(){2 f=$(5);2 g=$.18(m.1b(""),4(c,i){3(c!=\'?\')6 r[c]?n.F:c});2 h=G;2 l=f.7();f.R("14",g).R("12",q);4 K(a){Z(++a<v){3(q[a])6 a}6 v};4 1g(a){Z(!q[a]&&a>=0)a--;P(2 i=a;i<v;i++){3(q[i]){g[i]=n.F;2 j=K(i);3(j<v&&q[i].O(g[j])){g[i]=g[j]}B Q}}H();f.D(1t.1u(u,a))};4 1j(a){P(2 i=a,c=n.F;i<v;i++){3(q[i]){2 j=K(i);2 t=g[i];g[i]=c;3(j<v&&q[j].O(t))c=t;B Q}}};4 1l(e){2 a=$(5).D();2 k=e.10;h=(k<16||(k>16&&k<17)||(k>17&&k<1n));3((a.I-a.W)!=0&&(!h||k==8||k==T))M(a.I,a.W);3(k==8||k==T||(x&&k==1H)){1g(a.I+(k==T?0:-1));6 G}B 3(k==27){M(0,v);H();$(5).D(u);6 G}};4 1p(e){3(h){h=G;6(e.10==8)?G:E}e=e||1o.1J;2 k=e.1K||e.10||e.1L;2 a=$(5).D();3(e.1M||e.1N){6 V}B 3((k>=1n&&k<=1O)||k==17||k>1P){2 p=K(a.I-1);3(p<v){2 c=1R.1S(k);3(q[p].O(c)){1j(p);g[p]=c;H();2 b=K(p);$(5).D(b);3(n.U&&b==v)n.U.1T(f)}}}6 G};4 M(a,b){P(2 i=a;i<b&&i<v;i++){3(q[i])g[i]=n.F}};4 H(){6 f.7(g.19(\'\')).7()};4 J(a){2 b=f.7();2 d=-1;P(2 i=0,N=0;i<v;i++){3(q[i]){g[i]=n.F;Z(N++<b.y){2 c=b.1W(N-1);3(q[i].O(c)){g[i]=c;d=i;Q}}3(N>b.y)Q}}3(!a&&d+1<s){f.7("");M(0,v)}B 3(a||d+1>=s){H();3(!a)f.7(f.7().1X(0,d+1))}6(s?i:u)};f.1Y("X",4(){f.1Z(".C").1q("14").1q("12")}).L("1e.C",4(){l=f.7();2 a=J();H();1r(4(){f.D(a)},0)}).L("23.C",4(){J();3(f.7()!=l)f.24()}).L("25.C",1l).L("26.C",1p).L(w,4(){1r(4(){f.D(J(V))},0)});J()})}})})(1C);',62,134,'||var|if|function|this|return|val|||||||||||||||||||||||||||length|||else|mask|caret|null|placeholder|false|writeBuffer|begin|checkVal|seekNext|bind|clearBuffer|pos|test|for|break|data|selection|46|completed|true|end|unmask|character|while|keyCode|each|tests|setSelectionRange|buffer|document||32|map|join|createRange|split|moveStart|createTextRange|focus|number|shiftL|typeof|extend|shiftR|Za|keydownEvent|definitions|41|window|keypressEvent|removeData|setTimeout|z0|Math|max|selectionEnd|selectionStart|select|100000|moveEnd|undefined|collapse|jQuery|duplicate|orientation|trigger|_|127|push|event|charCode|which|ctrlKey|altKey|122|186|input|String|fromCharCode|call|paste|msie|charAt|substring|one|unbind|new|browser|RegExp|blur|change|keydown|keypress||fn|text'.split('|'),0,{}))
</script>

</html>