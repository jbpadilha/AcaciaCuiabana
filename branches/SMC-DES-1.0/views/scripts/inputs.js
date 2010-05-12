var diaNomes = new Array('Domingo','Segunda-feira','Terça-feira','Quarta-feira','Quinta-feira','Sexta-feira','Sábado');
var mesNomes = new Array('Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro');
var diaID = new Array('01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31');
var mesID = new Array('01','02','03','04','05','06','07','08','09','10','11','12');
var getData = new Date();
var ano = getData.getYear();
if (ano < 1000) { ano += 1900; }
var dia_semana = diaNomes[getData.getDay()];
var hoje = diaID[getData.getDate() -1] + "/" + mesID[getData.getMonth()] + "/" + ano

function checkData(target, erro, ok, txt) {
	var xtarget = document.getElementById(target);
	var info = document.getElementById('i'+target);
	var idata = xtarget.value;
	
	xdata = new Date(idata.substr(6,4), idata.substr(3,2)-1, idata.substr(0,2));
	xhoje = new Date(hoje.substr(6,4), hoje.substr(3,2)-1, hoje.substr(0,2));
 var result = Math.ceil((xdata.getTime()-xhoje.getTime())/1000/60/60/24);
	
	if (idata != '') {
		if (result > 0) {
			xtarget.className = erro;
			info.innerHTML = txt;
		} else {
			xtarget.className = ok;
		}
	} else {
		xtarget.className = erro;
		info.innerHTML = 'Campo obrigatório';
	}
}

function compara(get1, get2) {
	xtarget = document.getElementById(get1);
	xget1 = document.getElementById(get1).value;
	info = document.getElementById('i' + get1);
	if (xget1 != '') {
		if (xget1 < get2) {
			alert ('não pode ser menor');
			xtarget.select();
		} else {
			xtarget.className = 'x3 foco_off ok';
		}
	} else {
		xtarget.className = 'x3 foco_off erro';
		info.innerHTML = 'Favor informar a kilometragem';
	}
}

function ToggleDiv(target) {
	target = document.getElementById(target);
	if (show == 'off') {
		show = 'on'; target.style.display = 'none';
	} else {
		show = 'off'; target.style.display = 'block';
	}
}

function ShowDiv(target) { document.getElementById(target).style.display = 'block'; }

function CloseDiv(target) { document.getElementById(target).style.display = 'none'; }


function IrPara(target) {
	target = document.getElementById(target);
	target.focus();
}

function getInput() {
	var ok = false;
	for (f = 0; f < document.forms.length; f++) {
		for (i = 0; i < document.forms[f].length; i++) {
			if (document.forms[f][i].type != 'hidden') {
				if (document.forms[f][i].disabled != true) {
					document.forms[f][i].focus();
					var ok = true;
				}
			}
		if (ok == true)
 break;
		}
	if (ok == true)
	break;
	}
}

function JumpField(campo) {
	if (campo.value.length == campo.maxLength) {
		for (var i = 0; i < campo.form.length; i++) {
			if (campo.form[i] == campo && campo.form[(i + 1)] && campo.form[(i + 1)].type != "hidden") {
				campo.form[(i + 1)].focus();
				break;
			}
		}
	}
}

function show(on,off,show,hide,foca) {
	document.getElementById(on).style.background = '#FF9900';
	document.getElementById(show).style.display = 'block';

	document.getElementById(off).style.background = '#FFBB00';
	document.getElementById(hide).style.display = 'none';

	document.getElementById(foca).focus();
}

function foco(alvo, estilo) { document.getElementById(alvo).className = estilo; }

function SetHelp(target,txt) { document.getElementById(target).innerHTML = txt; }

function checkform(f) {
	if (f.lnome.value == "") {
		alert ("Informe seu nome!");
		return false;
	}
	if (f.lemail.value == "") {
		alert ("Informe seu e-mail!");
		return false;
	}
	if (f.llogin.value == "") {
		alert ("Informe seu CPF!");
		return false;
	}
	if (f.lsenha.value == "") {
		alert ("Digite sua senha!");
		return false;
	}
	return true;
}

function mascara(e,src,mask) {
	if (window.event) { _TXT = e.keyCode; }
	else if (e.which) { _TXT = e.which; }
	if (_TXT > 47 && _TXT < 58) {
		var i = src.value.length;
		var saida = mask.substring(0,1);
		var texto = mask.substring(i);
		if (texto.substring(0,1) != saida) { src.value += texto.substring(0,1); }
		return true;
	} else {
		if (_TXT != 8) {
			return false;
		} else {
			return true;
		}
	}
}

function checkforml(f) {
	if (f.login.value == "") { 
		alert ("Informe seu login."); 
		return false;
	}
	if (f.senha.value == "") {
		alert ("Informe sua senha.");
		return false;
	}
	return true;
}

function checkformc(f) {
	if (f.nome.value == "") {
		alert ("Informe seu nome");
		return false;
	}
	if (f.email.value == "") {
		alert ("Informe seu e-mail");
		return false;
	}
	if (f.mensagem.value == "") {
		alert ("Digite uma mensagem");
		return false;
	}
	return true;
}

function confirmaForm(form) { return confirm ('Deseja realmente realizar esta ação?'); }

function valida() {
	var dadoscond = document.cadcar.dadoscond.value;
	if (dadoscond == "0") {
		alert ("É necessário selecionar um condutor. Caso o condutor ainda não seja cliente, é necessário preencher os campos de Dados do condutor.");
		document.cadcar.dadoscond.focus();
		return false;
	}
	var dadosresp = document.cadcar.dadosresp.value;
	if (dadosresp == "0") {
		alert ("É necessário selecionar um responsável. Caso o responsável ainda não seja cliente, é necessário preencher os campos de Dados do Responsável.");
		document.cadcar.dadosresp.focus();
		return false;
	}
	return true;
	document.cadcar.submit();
}

function onChange(p, target) {
	var valor = document.getElementById(target).value.toUpperCase();
	var url = window.location;
	window.location = ('index.php?p=' + p + '&' + target + '=' + valor);
}

function getDados(id,alvo) {
	var origem = document.getElementById(id);
	var target = document.getElementById(alvo);
	target.value = origem.innerHTML;
}

function SetValue(target, txt) {
	if (target.value == '') { 
		target.value = txt;
	}
	return false;
}

function initDragDrop() {
	__dragX = 0; // cursor X 
	__dragY = 0; // cursor Y 
	__dragId = ""; // ID do el. a ser movido 
	__dragging = false; // true se há um el. sendo movido 
	document.body.onmousedown = __dragDown;
	document.body.onmousemove = __dragMove;
	document.body.onmouseup = function() { __dragging = false; };
}

function __dragMove(e) {
	if (typeof __dragging == "undefined" || !__dragging) { return; }
	e = e ? e : window.event;
	__dragEl.style.left = (e.clientX - __dragX)+"px";
	__dragEl.style.top = (e.clientY - __dragY)+"px";
}

function __dragDown(e) {
	e = e ? e : window.event;
	__dragEl = document.getElementById(__dragId) || null;
	var _target = document.all ? e.srcElement : e.target;
	if (!__dragEl || !(/drag/.test(_target.className))) { return; }
	__dragX = e.clientX - __dragEl.offsetLeft;
	__dragY = e.clientY - __dragEl.offsetTop;
	__dragging = true;
};

function VerificaCPF(campo, classe, info) {
	var xcampo = document.getElementById(campo);
	if (!info) { info = 'off'; } else { var xinfo = document.getElementById(info); }
	var xvalor = xcampo.value;
	if (xcampo.value != '') {
		if (xvalor.lenght = 14) { 
			xvalor = xvalor.replace(".","");
			xvalor = xvalor.replace(".","");
			xvalor = xvalor.replace("-","");
		}
		if (valida_cpf(xvalor)) {
			xcampo.className = classe + ' ok';
			if (info != 'off') { xinfo.innerHTML = ''; }
		} else { 
			xcampo.className = classe +' erro';
			if (info != 'off') { xinfo.innerHTML = 'CPF Inválido'; }
		}
	} else { xcampo.className = classe; }
}

function valida_cpf(cpf) {
	var digitos_iguais = 1;
	if (cpf.length != 11) { return false; }
	for (var i = 0; i < cpf.length - 1; i++) {
		if (cpf.charAt(i) != cpf.charAt(i + 1)) {
			digitos_iguais = 0;
			break;
		}
	}
	if (!digitos_iguais) {
		var numeros = cpf.substring(0,9);
		var digitos = cpf.substring(9);
		var soma = 0;
		for (i = 10; i > 1; i--) { soma += numeros.charAt(10 - i) * i; }
		var resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
		if (resultado != digitos.charAt(0)) { return false; }
		numeros = cpf.substring(0,10);
		soma = 0;
		for (i = 11; i > 1; i--) { soma += numeros.charAt(11 - i) * i; }
		resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
		if (resultado != digitos.charAt(1)) { return false; }
		return true;
	} else { return false; }
}

function EnterTAB (field, event) {
	var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
	if (keyCode == 13) {
		var i;
		for (i = 0; i < field.form.elements.length; i++)
			if (field == field.form.elements[i])
				break;
		i = (i + 1) % field.form.elements.length;
		field.form.elements[i].focus();
		return false;
	} 
	else
	return true;
}      
