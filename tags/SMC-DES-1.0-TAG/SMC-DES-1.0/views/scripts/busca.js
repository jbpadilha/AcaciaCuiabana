function openAjax() {
	var Ajax;
	try { Ajax = new XMLHttpRequest(); } // XMLHttpRequest para browsers mais populares, como: Firefox, Safari, dentre outros.
	catch (ee) {
		try { Ajax = new ActiveXObject("Msxml2.XMLHTTP"); } // Para o IE da MS
		catch (e) {
			try { Ajax = new ActiveXObject("Microsoft.XMLHTTP"); }
			catch (e) { Ajax = false; }
		}
	}
	return Ajax;
} 

function carregaAjax(div, getURL) {
	document.getElementById(div).style.display = "block";
	if (document.getElementById) { // Para os browsers complacentes com o DOM W3C.
		var exibeResultado = document.getElementById(div); // div que exibirá o resultado.
		var Ajax = openAjax(); // Inicia o Ajax.
		Ajax.open("GET", getURL, true); // fazendo a requisição
		Ajax.onreadystatechange = function() {
			if (Ajax.readyState == 1) { exibeResultado.innerHTML = "<img src='../imagens/carregando.gif' />Procurando..."; } // Quando estiver carregando, exibe: carregando...
			if (Ajax.readyState == 4) { // Quando estiver tudo pronto.
				if (Ajax.status == 200) {
					var resultado = Ajax.responseText; // Coloca o retornado pelo Ajax nessa variável
					resultado = resultado.replace(/\+/g,""); // Resolve o problema dos acentos (saiba mais aqui: http://www.plugsites.net/leandro/?p=4)
					//resultado = resultado.replace(/ã/g,"a");
					resultado = unescape(resultado); // Resolve o problema dos acentos
					exibeResultado.innerHTML = resultado;
				} else {
					exibeResultado.innerHTML = "Nenhum resultado.";
				}
			}
		}
		Ajax.send(null); // submete
	}
}