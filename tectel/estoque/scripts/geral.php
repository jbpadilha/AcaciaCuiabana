<?php
mysql_connect('mysql02.servicodespertador.net','servicodespert1','tecteldezanos');
mysql_select_db('servicodespert1');

function TitleBar() {
	global $legend;
	echo "<span id=\"titulo\">\n";
	echo "<img src=\"img/".$_GET['form'].".png\" alt=\"".$_GET['form']."\" class=\"ico\" />\n";
	echo "<h2>".$legend."</h2>\n";
	echo "<a id=\"bt_fechar\" href=\"/index.php\"><img src=\"img/ico_x.png\" title=\"Fechar\" alt=\"Categorias\" class=\"ico_bt\" /></a>\n";
	echo "</span>\n";
}

function criarLinks($local) {
	$query = mysql_query("SELECT * FROM db_menus WHERE menu_local LIKE \"".$local."\" ORDER BY menu_ordem");
	while ($get = mysql_fetch_array($query)) {
		if ($get['menu_url_icone'] != "") { 
			$url_icone = "<img src=\"".$get['menu_url_icone']."\" alt=\"".$get['menu_title']."\" title=\"".$get['menu_title']."\" class=\"ico\" />";
		} else {
			$url_icone = "";
		}
		if (strtolower($get['menu_label']) == $_GET['form']) { $classe = " class=\"ativo\" "; } else { $classe = ""; }
		echo "<a href=\"index.php".$get['menu_url']."\" target=\"".$get['menu_target']."\" title=\"".$get['menu_title']."Atalho: ALT + ".$get['menu_atalho']."\" accesskey=\"".$get['menu_atalho']."\" ".$classe.">".$url_icone.$get['menu_label']."</a>\n";
	}
}

function criarInputs($local) {
	$query = mysql_query("SELECT * FROM db_inputs WHERE input_for = '".$local."' ORDER BY input_tabindex");
	while ($get = mysql_fetch_array($query)) {
		switch ($get['input_type']) {
			case "text":
				$input  = "<label accesskey=\"".$get['input_accesskey']."\">".$get['input_label']."\n";
				$input .= "<input type=\"text\" name=\"".$get['input_name_id']."\" id=\"".$get['input_name_id']."\" value=\"".$_POST[$get['input_name_id']]."\" size=\"".$get['input_size']."\" maxlength=\"".$get['input_maxlength']."\" alt=\"".$get['input_alt']."\" class=\"".$get['input_class']."\" /></label>\n";
				if ($get['input_linha'] == 1) { $input .= "<hr>\n"; }
				echo $input;
				break;
			case "select":
				$input  = "<label>".$get['input_label']."\n";
				$input .= "<select name=\"".$get['input_name_id']."\" id=\"".$get['input_name_id']."\" size=\"".$get['input_size']."\" alt=\"".$get['input_alt']."\" class=\"".$get['input_class']."\">\n";
				$input .= "<option></option>\n";
				$query2 = mysql_query("SELECT * FROM ".$get['input_select_from']." WHERE '".$get['input_select_value']."' != '' ORDER BY ".$get['input_select_text']."");
				while ($val = mysql_fetch_array($query2)) {
					if ($val[$get['input_select_value']] == $_POST[$get['input_name_id']]) { $selected = ' selected '; } else { $selected = ''; }
					$input .= "<option ".$selected." value=\"".$val[$get['input_select_value']]."\">".$val[$get['input_select_text']]."</option>\n";
				}
				$input .= "</select></label>\n";
				if ($get['input_linha'] == 1) { $input .= "<hr>\n"; }
				echo $input;
				break;
			case "textarea":
				$input1 = "<textarea";
				$input2 = "></textarea>";
				break;
		}
	}
}


function p($metodo) {
	switch ($metodo) {
		case "a": echo "<p>\n"; break;
		case "f": echo "</p>\n"; break;
		case "fa": echo "</p><p>\n"; break;
	}
}

$tab_n = '1';

function Input($params) {
	global $tab_n;
	$x = explode('|', $params);
	echo "<label>".$x[2]."<input type=\"".$x[0]."\" id=\"".$x[1]."\" name=\"".$x[1]."\" tabindex=\"".$tab_n."\" value=\"".$_POST[$x[1]]."\" alt=\"".$x[4]."\" class=\"".$x[3]."\" /></label>\n";
	$tab_n++;
}

function Select($params) {
	global $tab_n; 
	$x = explode('|', $params);
	echo "<label>".$x[0]."<select name=\"".$x[1]."\" id=\"".$x[1]."\" tabindex=\"".$tab_n."\" alt=\"".$x[6]."\" class=\"".$x[5]."\">\n";
	echo "<option></option>\n";
	$query = mysql_query('SELECT * FROM '.$x[2].' WHERE '.$x[3].' != "" ORDER BY '.$x[4].'');
	while ($get = mysql_fetch_array($query)) {
		if ($get[$x[3]] == $_POST[$x[1]]) { $selected = ' selected '; } else { $selected = ''; }
		echo "<option value=\"".$get[$x[3]]."\"".$selected.">".$get[$x[4]]."</option>\n";
	}
	echo "</select></label>\n";
	$tab_n++;
}

function SelectProduto($params) {
	global $tab_n; 
	$x = explode('|', $params);
	echo "<label>".$x[0]."<select name=\"".$x[1]."\" id=\"".$x[1]."\" tabindex=\"".$tab_n."\" alt=\"".$x[6]."\" class=\"".$x[5]."\">\n";
	echo "<option></option>\n";
	$query = mysql_query('SELECT * FROM '.$x[2].' WHERE '.$x[3].' != "" ORDER BY '.$x[4].'');
	while ($get = mysql_fetch_array($query)) {
		if ($get[$x[3]] == $_POST[$x[1]]) { $selected = ' selected '; } else { $selected = ''; }
		echo "<option value=\"".$get[$x[3]]."\"".$selected.">".$get[$x[4]]."</option>\n";
	}
	echo "</select></label>\n";
	$tab_n++;
}

Function Submit() {
	echo "<input type=\"submit\" class=\"submit\" value=\"Concluir\" accesskey=\"N\" title=\"Atalho: Alt + N\"/>\n";
}

if ($_POST) {
	foreach($_POST as $campo => $valor) {
		$campos_temp .= addslashes($campo).', ';
		$valores_temp .= '"'.addslashes($valor).'", ';
		$campos = substr($campos_temp, 0, -2);
		$valores = substr($valores_temp, 0, -2);
	}
//	echo $campos.'<br />';
//	echo $valores;

	$query = mysql_query('INSERT INTO '.$_GET['form'].' ('.$campos.') VALUES ('.$valores.')');

	if ($query) { echo '<script>alert("Incluido com sucesso");</script>'; }
	else { echo '<script>alert("ERRO: '.mysql_error().'");</script>'; }
}
?>