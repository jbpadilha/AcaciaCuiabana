var xmlhttp = null;

function Request(url, target) {
	var target = document.getElementById(target);

	if (window.XMLHttpRequest) { xmlhttp = new XMLHttpRequest(); } // code for IE7+, Firefox, Chrome, Opera, Safari
	else { xmlhttp = new ActiveXObject("Microsoft.XMLHTTP"); } // code for IE6, IE5
		
	xmlhttp.open("GET",url,false);
	xmlhttp.send(null);
	target.innerHTML = xmlhttp.responseText;
}

function SelectAba(target) {
	var classe = target.className;
	var abas = document.getElementById('abas').getElementsByTagName('li');
	for (i = 1; i <= abas.length; i++) {
		document.getElementById('aba' + i).className = classe;
	}
	target.className = 'aba_selecionada';
}

function Loading(id) {
	target = document.getElementById(id);
	target.innerHTML = '<img src="../imagens/loading.gif" alt="" />';
}