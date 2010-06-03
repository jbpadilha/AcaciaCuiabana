$(document).ready(function() {

	$('input[type=text], select, textarea').focus(function() {
		$(this).removeClass('foco_off');
		$(this).addClass('foco_on');
	});

	$('input[type=text], select, textarea').blur(function() {
		$(this).removeClass('foco_on');
		$(this).addClass('foco_off');
	});

	//Referente ao formulario de clientes
	$('input[name="rg"], input[name="rgConjugue"], input[name="cpf"], input[name="cep"]').keypress(function() { return Onlynumbers(event); });

	$('input[name="km"], input[name="data"], input[name="km_garantia"], input[name="tempo_garantia"], input[name="renavam"], input[name="anofab"], input[name="capacidade"], input[name="data_nf"], input[name="data_entrega_nf"], input[name="vencimento_ipva"], input[name="vencimento_seguro"], input[name="km_entrega_nf"]').keypress(function() {
		return Onlynumbers(event);
	});

	//Referente ao formulário de revisões
	$('input[name="revDataUltima"], input[name="revDataProxima"]').keypress(function() { return mascara(event,this,'##/##/####'); });
	$('input[name="revKmUlt"], input[name="revKmProx"]').keypress(function() { return Onlynumbers(event); });

	//Referente ao formulário de veículos
	$('input[name="data_nf"], input[name="data_entrega_nf"], input[name="vencimento_ipva"], input[name="vencimento_seguro"]').keypress(function() { return mascara(event,this,'##/##/####'); });	

	//Referente ao formulário de abastecimento
	$('input[name="abasteceData"]').keypress(function() { return mascara(event,this,'##/##/####'); });
	$('input[name="abasteceValor"]').keypress(function() { return mascara(event,this,'#,####'); });
	$('input[name="abasteceData"], input[name="abasteceKm"], input[name="abasteceValor"]').focus(function() { $(this).next('label').text($(this).attr('alt')); });
	$('input[name="abasteceData"], input[name="abasteceValor"], input[name="abasteceKm"]').blur(function() { $(this).next('label').text(''); });
	$('input[name="abasteceKm"], input[name="abasteceNf"]').keypress(function() { return Onlynumbers(event); });


	$('input[name="cpf"]').keypress(function() {
		return mascara(event,this,'###.###.###-##');
	});

	$('input[name="cep"]').keypress(function() {
		return mascara(event,this,'##.###-###');
	});

	$('input[name="codigo_fipe"]').keypress(function() {
		return mascara(event,this,'######-#');
	});

	$('input[name="telefone"], input[name="celular"], input[name="fax"]').keypress(function() {
		return mascara(event,this,'## ####-###');
	});

	$('input[name="rg_orgao"], input[name="rg_orgaoConjugue"]').keypress(function() {
		return Onlychars(event);
	});
	
	$('input[name="cpf"]').blur(function() {
		VerificaCPF($(this).attr('name'),'x3');
	});
	
	$('input').keyup(function() {
		if ($(this).attr('maxlength') > 0) {
			return autoTab(this, $(this).attr('maxlength'), event);
		}
	});
	
	$('select[name="estadoCivil"]').change(function() {
		if ($(this).val()) {
			if ($(this).val() == 'Casado' || $(this).val() == 'União estável') {
				$('#conjuge').show();
			} else {
				$('#conjuge').hide();
			}
		}
	});
	
});