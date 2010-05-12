function TamanhoFonte(id, valor) {
	var Target = document.getElementById(id);
	var Atual = Target.style.fontSize;
	var Novo = Atual + valor;
	Target.style.fontSize = Novo + 'px'
}