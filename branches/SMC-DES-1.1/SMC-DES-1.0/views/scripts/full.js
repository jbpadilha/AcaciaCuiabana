function selecionar(id) { document.getElementById(id).className = 'aba_selecionada'; }
// BLoqueia mouse
var tagsAbertas =["input", "textarea"]; //Nao bloqueados
tagsAbertas = tagsAbertas.join("|");

function fechaCamposFF(e){
var elemento = (e.target)?e.target:e.srcElement;
	if (tagsAbertas.indexOf(elemento.tagName.toLowerCase())==-1)
		return false;
}

function abreCamposFF(){
return true
}

function fechaCamposIE(){
var elemento = event.srcElement;
	if(tagsAbertas.indexOf(elemento.tagName.toLowerCase()) == -1)
		document.onselectstart = new Function ("return false");
}

function abreCamposIE(){
var elemento = event.srcElement;
	if(tagsAbertas.indexOf(elemento.tagName.toLowerCase()) == -1){
		document.onselectstart = new Function ("return false");
	}else{
		document.onselectstart = new Function ("return true");
	}
}

if (typeof document.onselectstart != "undefined"){
document.onmousedown	=	fechaCamposIE;
document.onmouseup		=	abreCamposIE;
document.onselectstart  = new Function ("return false");
}else{
document.onmousedown	=	fechaCamposFF;
document.onmouseup		=	abreCamposFF;
}
// Gerar campos
function gElem(elm){
	return (document.getElementById) ? document.getElementById(elm) : (document.layers) ? document.layers[elm] : document.all[elm];
}

function gTagN(elm){
	return (document.getElementsByTagName) ? document.getElementsByTagName(elm) : null;
}

var num = 1;
function GeraCampos(tbl,rot,qnt){
	var tb = document.getElementById(tbl); 

	for(var i=0; i<qnt; i++){
		num++;
		var lg = tb.rows.length;
		var tr = document.createElement('tr');   
		var tr = tb.insertRow(lg-1); 
		var th = document.createElement('th'); 
		th.setAttribute('colspan', '2');
		th.appendChild(document.createTextNode(rot+" "+num+":")); 
		tr.appendChild(th); 
		
		var td = document.createElement('td');  
		var fe = document.createElement('input');
		td.setAttribute('colspan', '2');
		fe.setAttribute('type', 'file');
		fe.setAttribute('name', 'file[]');
		fe.setAttribute('id', 'file[]');
		fe.setAttribute('size', '50');
		fe.setAttribute((document.all ? 'className' : 'class'),'file');
		td.appendChild(fe);
		tr.appendChild(td);
	}
}
// Bloqueia Enter
function handleEnter (field, event) {
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
// Valida Email
var emailfilter=/^\w+[\+\.\w-]*@([\w-]+\.)*\w+[\w-]*\.([a-z]{2,4}|\d+)$/i
function checkmail(e){
var returnval=emailfilter.test(e.value)
if (returnval==false){
alert("E-mail inválido.")
e.select()
}
return returnval
}

// Valida todos os campos
function validaForm(form){
        /*for (i=0;i<form.length;i++){
                if (i!=2 && i!=3 && i!=4 && i!=5 && i!=6 && i!=6){
                        if (form[i].value == "" ){
                                var nome = form[i].name;
                        
                                alert("O campo " + nome.toUpperCase() + " é obrigatório!");
                        
                                form[i].focus();
                                return false
                        } 
                }
        }*/	
        return confirm('Tem certeza de que todos os campos estão preenchidos corretamente?');
}
// Bloqueia enter
function Enter() {
  var teste = window.event.keyCode;
  if (teste == 13){
      return false;
  }
  return true;
}
// Checando o status do registro
function checkSubmit() {
document.getElementById("btsubmit").value = "Enviando dados…";
document.getElementById("btsubmit").disabled = true;
return true;
}
// Mostra o navegador
function whatBrowser() {
document.Browser.Name.value=navigator.appName;
document.Browser.Version.value=navigator.appVersion;
document.Browser.Code.value=navigator.appCodeName;
document.Browser.Agent.value=navigator.userAgent;
}
// Libera div de conjuge
function selecionouestadocivil(selectestadocivil, idNomeestadocivil, edtNomeestadocivil) {
if (selectestadocivil.value == "0") {
document.getElementById(idNomeestadocivil).style.visibility="visible";
document.getElementById("idNomeestadocivilLabel").style.visibility="visible";
} else {
edtNomeestadocivil.value = "";
document.getElementById(idNomeestadocivil).style.visibility="hidden";
document.getElementById("idNomeestadocivilLabel").style.visibility="hidden";
}
}
// Somente numeros ou letras
function Onlynumbers(e)
{
        var tecla=new Number();
        if(window.event) {
                tecla = e.keyCode;
        }
        else if(e.which) {
                tecla = e.which;
        }
        else {
                return true;
        }
        if((tecla >= "97") && (tecla <= "122")){
                return false;
        }
}
function Onlychars(e)
{
        var tecla=new Number();
        if(window.event) {
                tecla = e.keyCode;
        }
        else if(e.which) {
                tecla = e.which;
        }
        else {
                return true;
        }
        if((tecla >= "48") && (tecla <= "57")){
                return false;
        }
}
// Agree
agree = 0;
// Mostra hora
function showFilled(Value) {
return (Value > 9) ? "" + Value : "0" + Value;
}
function StartClock24() {
  TheTime = new Date;
  document.clock.showTime.value = showFilled(TheTime.getHours()) + ":" + showFilled(TheTime.getMinutes()) + ":" + showFilled(TheTime.getSeconds());
  setTimeout("StartClock24()",1000)
}
// Jump no select
function jumpto()
{
	var page = prompt('Escreva o número da página a qual você deseja ir:', '1');
	var perpage = '';
	var base_url = '';

	if (page !== null && !isNaN(page) && page > 0)
	{
		document.location.href = base_url.replace(/&amp;/g, '&') + '&start=' + ((page - 1) * perpage);
	}
}
// Javascript Document
//adiciona mascara de cnpj
function MascaraCNPJ(cnpj){
        if(mascaraInteiro(cnpj)==false){
                event.returnValue = false;
        }       
        return formataCampo(cnpj, '00.000.000/0000-00', event);
}

//adiciona mascara de cep
function MascaraCep(cep){
                if(mascaraInteiro(cep)==false){
                event.returnValue = false;
        }       
        return formataCampo(cep, '00.000-000', event);
}

//adiciona mascara de data
function MascaraData(data){
        if(mascaraInteiro(data)==false){
                event.returnValue = false;
        }       
        return formataCampo(data, '00/00/0000', event);
}

//adiciona mascara ao telefone
function MascaraTelefone(tel){  
        if(mascaraInteiro(tel)==false){
                event.returnValue = false;
        }       
        return formataCampo(tel, '(00) 0000-0000', event);
}

//adiciona mascara ao CPF
function MascaraCPF(cpf){
        if(mascaraInteiro(cpf)==false){
                event.returnValue = false;
        }       
        return formataCampo(cpf, '000.000.000-00', event);
}

//valida telefone
function ValidaTelefone(tel){
        exp = /\(\d{2}\)\ \d{4}\-\d{4}/
        if(!exp.test(tel.value))
                alert('Numero de Telefone Invalido!');
}

//valida CEP
function ValidaCep(cep){
        exp = /\d{2}\.\d{3}\-\d{3}/
        if(!exp.test(cep.value))
                alert('Numero de Cep Invalido!');               
}

//valida data
function ValidaData(data){
        exp = /\d{2}\/\d{2}\/\d{4}/
        if(!exp.test(data.value))
                alert('Data Invalida!');                        
}

//valida o CPF digitado
function ValidarCPF(Objcpf){
        var cpf = Objcpf.value;
        exp = /\.|\-/g
        cpf = cpf.toString().replace( exp, "" ); 
        var digitoDigitado = eval(cpf.charAt(9)+cpf.charAt(10));
        var soma1=0, soma2=0;
        var vlr =11;
        
        for(i=0;i<9;i++){
                soma1+=eval(cpf.charAt(i)*(vlr-1));
                soma2+=eval(cpf.charAt(i)*vlr);
                vlr--;
        }       
        soma1 = (((soma1*10)%11)==10 ? 0:((soma1*10)%11));
        soma2=(((soma2+(2*soma1))*10)%11);
        
        var digitoGerado=(soma1*10)+soma2;
        if(digitoGerado!=digitoDigitado)        
                alert('CPF Invalido!');         
}

//valida numero inteiro com mascara
function mascaraInteiro(){
        if (event.keyCode < 48 || event.keyCode > 57){
                event.returnValue = false;
                return false;
        }
        return true;
}

//valida o CNPJ digitado
function ValidarCNPJ(ObjCnpj){
        var cnpj = ObjCnpj.value;
        var valida = new Array(6,5,4,3,2,9,8,7,6,5,4,3,2);
        var dig1= new Number;
        var dig2= new Number;
        
        exp = /\.|\-|\//g
        cnpj = cnpj.toString().replace( exp, "" ); 
        var digito = new Number(eval(cnpj.charAt(12)+cnpj.charAt(13)));
                
        for(i = 0; i<valida.length; i++){
                dig1 += (i>0? (cnpj.charAt(i-1)*valida[i]):0);  
                dig2 += cnpj.charAt(i)*valida[i];       
        }
        dig1 = (((dig1%11)<2)? 0:(11-(dig1%11)));
        dig2 = (((dig2%11)<2)? 0:(11-(dig2%11)));
        
        if(((dig1*10)+dig2) != digito)  
                alert('CNPJ Invalido!');
                
}

//formata de forma generica os campos
function formataCampo(campo, Mascara, evento) { 
        var boleanoMascara; 
        
        var Digitato = evento.keyCode;
        exp = /\-|\.|\/|\(|\)| /g
        campoSoNumeros = campo.value.toString().replace( exp, "" ); 
   
        var posicaoCampo = 0;    
        var NovoValorCampo="";
        var TamanhoMascara = campoSoNumeros.length;; 
        
        if (Digitato != 8) { // backspace 
                for(i=0; i<= TamanhoMascara; i++) { 
                        boleanoMascara  = ((Mascara.charAt(i) == "-") || (Mascara.charAt(i) == ".")
                                                                || (Mascara.charAt(i) == "/")) 
                        boleanoMascara  = boleanoMascara || ((Mascara.charAt(i) == "(") 
                                                                || (Mascara.charAt(i) == ")") || (Mascara.charAt(i) == " ")) 
                        if (boleanoMascara) { 
                                NovoValorCampo += Mascara.charAt(i); 
                                  TamanhoMascara++;
                        }else { 
                                NovoValorCampo += campoSoNumeros.charAt(posicaoCampo); 
                                posicaoCampo++; 
                          }              
                  }      
                campo.value = NovoValorCampo;
                  return true; 
        }else { 
                return true; 
        }
}
// Mascaras 2
function mascara(e,src,mask) {
if(window.event) {
_TXT = e.keyCode;
} else
if(e.which) {
_TXT = e.which;
}
if(_TXT > 47 && _TXT < 58) {
var i = src.value.length;
var saida = mask.substring(0,1);
var texto = mask.substring(i);
if(texto.substring(0,1) != saida) {
src.value += texto.substring(0,1);
}
return true;
} else {
if (_TXT != 8) {
return false;
} else {
return true;
}
}
}
// Auto tab nos input
var isNN = (navigator.appName.indexOf("Netscape")!=-1);
function autoTab(input,len, e) {
var keyCode = (isNN) ? e.which : e.keyCode; 
var filter = (isNN) ? [0,8,9] : [0,8,9,16,17,18,37,38,39,40,46];
if(input.value.length >= len && !containsElement(filter,keyCode)) {
input.value = input.value.slice(0, len);
input.form[(getIndex(input)+1) % input.form.length].focus();
}
function containsElement(arr, ele) {
var found = false, index = 0;
while(!found && index < arr.length)
if(arr[index] == ele)
found = true;
else
index++;
return found;
}
function getIndex(input) {
var index = -1, i = 0, found = false;
while (i < input.form.length && index == -1)
if (input.form[i] == input)index = i;
else i++;
return index;
}
return true;
}
// Imprimir tela
function printWindow() {
bV = parseInt(navigator.appVersion);
if (bV >= 4) window.print();
}
//mostra/esconde fieldsets
function blocking(nr) {
	if (document.layers) {
		current = (document.layers[nr].display == 'none') ? 'block' : 'none';
		document.layers[nr].display = current;
	}
	else if (document.all) {
		current = (document.all[nr].style.display == 'none') ? 'block' : 'none';
		document.all[nr].style.display = current;
	}
	else if (document.getElementById) {
		vista = (document.getElementById(nr).style.display == 'none') ? 'block' : 'none';
		document.getElementById(nr).style.display = vista;
	}
}

/**
 * Função de abertura de POP UP
 * @param page
 * @param width
 * @param height
 * @return
 */
function abrepagina(page, width, height)

{

	xposition=0;

	yposition=0;

	if (width==0) { width = 415; };

	if (height==0) { height = 290; };

	if (parseInt(navigator.appVersion) >= 4) {

		xposition = (screen.width - width) / 2;

		yposition = (screen.height - height) / 2;

		yposition = yposition - 20;

}

	args = "width=" + width + ", height=" + height + ", location=0, menubar=0, " +

		"resizable=0, scrollbars=1, status=1, titlebar=0, " +

		"toolbar=0, hotkeys=0, screenx=" + xposition + ", screeny=" +

		yposition + ", left=" + xposition + ", top=" + yposition;

	window.open(page, "_blank", args);

}

function formatar_mascara(src, mascara) {
	var campo = src.value.length;
	var saida = mascara.substring(0,1);
	var texto = mascara.substring(campo);
	if(texto.substring(0,1) != saida) {
		src.value += texto.substring(0,1);
	}
}