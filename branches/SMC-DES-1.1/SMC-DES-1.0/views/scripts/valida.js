function ValidaEmail(id, hint, style) {
	var emailfilter=/^\w+[\+\.\w-]*@([\w-]+\.)*\w+[\w-]*\.([a-z]{2,4}|\d+)$/i
	var target = document.getElementById(id);
	var hint = document.getElementById(hint);
	var returnval = emailfilter.test(target.value)
	if (returnval == false) {
		target.className = style + ' erro';
		hint.innerHTML = 'Este não é um e-mail válido';
	} else {
		target.className = style + ' ok';
		hint.innerHTML = '';
	}
	return returnval
}

function CountWords(id, hint, style) {
	var target = document.getElementById(id);
	var hint = document.getElementById(hint);
	var contar = target.value;
	contar = contar.split(" ");
	if (contar.length > 1) {
		target.className = style + ' ok';
		hint.innerHTML = '';
	} else {
		target.className = style + ' erro';
		hint.innerHTML = 'Informe o nome completo, por favor';
	}
}

function ValidaSenha(id, hint) {
	campo = document.getElementById(id)
	info = document.getElementById(hint)
    var valor = campo.value;
    var contemNumeros = /[0-9]/;
    var contemLetras = /[a-z]/i;
    var contemEspecial = /[@#$%&*]/;
	var contagem = 0;
    var mensagem = "";
 
    if ( valor.length > 0 ) {
        if ( contemNumeros.test( valor ) ) contagem++;
        if ( contemLetras.test( valor ) ) contagem++;
        if ( contemEspecial.test( valor ) ) contagem++;
 
        switch (contagem) {
            case 1: mensagem = "39%"; break;
            case 2: mensagem = "69%"; break;
            case 3: mensagem = "99%"; break;
            default: mensagem = "?"; }
 
        info.innerHTML = 'Nível de segurança: ' + mensagem;
    } else { info.innerHTML = ''; }
}
