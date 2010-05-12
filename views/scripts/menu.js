function showmenu(menuid) {		
	var aba_menu = new Array("menu_aba", "menu_aba1", "menu_aba2", "menu_aba3", "menu_aba4", "menu_aba5", "menu_aba6"); 
	for(jmenu = 0; jmenu < 7; jmenu++) {
		document.getElementById(aba_menu[jmenu]).className = 'aba';
		document.getElementById(aba_menu[jmenu]+'-div').style.display = 'none';
	}
	document.getElementById(menuid).className = 'aba_selecionada';		
	document.getElementById(menuid+'-div').style.display = 'block';
}