$.fn.getFirstInput = function(index){
	$('input[type=text], textarea, select').each(function() {
		if ($(this).is(':visible') && $(this).attr('disabled') == false ) {
			index++;
			if (index == 1) {
				$(this).focus();
				$(this).addClass('ativo');
			}
		}
	});
}

$.fn.setAccessKey = function() {
	$('button').each(function() {
		var str = $(this).html();
		var accesskey = $(this).attr('accesskey');
		if (str && accesskey) {
			var pos = str.indexOf(accesskey);
			var label = '';
			for (i = 0; i < str.length; i++) {
				if (i == pos) label += '<u>' + str[i] + '</u>';
				else label += str[i];
			}
			$(this).html(label);
		}
	});
}

$(document).ready(function() {

	$(this).getFirstInput(0);
	$('.botoes button').setAccessKey();

	//Desabilita o BACKSPACE fora de INPUT, SELECT e TEXTAREA
	$('body')
		.keydown(function() {
			elem = window.event.srcElement.tagName;
			if (elem != 'INPUT' && elem != 'TEXTAREA') {
				if (window.event.keyCode == 8) {
					return false;
				}
			}
		});

	//Desabilita o BACKSPACE nos botoes SUBMIT e RESET
	$('.botoes input')
		.keydown(function() {
			if (window.event.keyCode == 8) {
				return false;
			}
		});

	//Confirma RESET no formulario
	$('input[type="RESET"]')
		.click(function() {
			if (!confirm('Esta ação irá apagar todas as informações dete formulário.')) return false;
		});

	//Desabilita os botoes
	// $('div.botoes input').attr('disabled', true);

	//Aplica mascaras
	$(".ano").mask("9999");
	$(".codFipe").mask("999999-9");
	$(".data").mask("99/99/9999");
	$(".hora").mask("99:99");
	$(".fone").mask("(99) 9999-9999");
	$(".docCPF").mask("999.999.999-99");
	$(".docPIS").mask("999.99999.99-9");
	$(".docCNPJ").mask("99.999.999/9999-99");
	$(".docIE").mask("99.999.999-9");
	$(".docCNH").mask("99999999999");
	$(".CEP").mask("99.999-999");
	$(".placa").mask("aaa-9999");
	
	$('.km').priceFormat({ prefix: '', centsSeparator: '',  limit:6, centsLimit: 0 }); 
	$('.decimal').priceFormat({ prefix: '', limit:5 }); 
	$('.valor').priceFormat({ limit:5, centsLimit: 4 }); 

	// $('fieldset#conjuge').hide();

	$('select[name="estadoCivil"]').change(function() {
		if ($(this).val() == 'CASADO(A)' || $(this).val() == 'UNIÃO ESTÁVEL') {
			$('fieldset#conjuge').slideDown();
		} else {
			$('fieldset#conjuge').slideUp();
		}
	});

	$('label input, label select, label textarea')
		.focus(function() { //Sinaliza o campo como ativo
			$(this).addClass('ativo');
		})
		.blur(function() { //Sinaliza o campo como normal
			$(this).val($(this).val().toUpperCase());
			$(this).removeClass('ativo');
		})
		.keypress(function() { //Atribuindo eventos ao apertar ENTER
			if (window.event.keyCode == 13) {
				$(this).val($(this).val().toUpperCase());
				$('.botoes input[type="submit"]').focus();
				$('.botoes button').focus();
				return false;
			}
		})

	$('label input')
		.blur(function() {
			if ($(this).val() && $(this).val() != '') {
				var target = $(this);
				var attrClass = target.attr('class').split(' ');
				var tipo;
				switch (attrClass[0]) {
					case 'nome': tipo = 'nome'; break;
					case 'docCPF': tipo = 'cpf'; break;
					case 'docCNPJ': tipo = 'cnpj'; break;
					case 'docCNH': tipo = 'cnh'; break;
					case 'num': tipo = 'numero'; break;
					case 'data': tipo = 'data'; break;
					case 'email': tipo = 'email'; break;
				}
				if (tipo) {
					$.ajax({
						type: "POST",
						url: "_php/validacaoAjax.php",
						data: "valor=" + target.val() + "&tipo=" + tipo,
						success: function(html){
							target.removeClass('statusERRO');
							target.removeClass('statusOK');
							target.addClass(html);
						}
					});
				}
			} else {
				$(this)
					.removeClass('statusERRO')
					.removeClass('statusOK');
			}
			return false;
		});
});