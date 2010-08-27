<?php

function intervaloDataHora($inicio, $fim) {
	$data1 = explode ('/', $inicio);
	$data2 = explode ('/', $fim);

	$inicio = mktime(0,0,0,$data1[1],$data1[0],$data1[2]);
	$fim = mktime(0,0,0,$data2[1],$data2[0],$data2[2]);

	$dias = ($fim - $inicio) / 86400;

	return $dias;
}

function idade($data) {
	list($dia, $mes, $ano) = explode('/', $data); 
	$hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y')); 
	$nascimento = mktime( 0, 0, 0, $mes, $dia, $ano); 
	$idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25); 
	return $idade;
}

function verAniversario($data) {
	if (valida($data, 'data')) {
		$data = explode("/", $data);
		$anos = date('Y') - $data[2];
		
		$diffDia = $data[0] - date('d');
		$diffMes = $data[1] - date('m');
		$diffAno = $data[2] - date('Y');
		
		if ($diffMes <= 0) {
			if ($diffDia >= 0) {
				if ($diffMes == 0) {
					if ($diffDia == 0) {
						$texto = paragrafo(negrito('Hoje é o seu aniversário!')).paragrafo('A '.negrito('SMC').' deseja a você um '.cor('FELIZ ANIVERSÁRIO! Parabéns...', '#FF0000'));
					} else if ($diffDia > 0 && $diffDia <= 7) {
						$texto = paragrafo(negrito('Seu aniversário está próximo!!!')).paragrafo('Faltam apenas <b>'.str_pad($diffDia, 2, "0", STR_PAD_LEFT).'</b> dia(s)');
					}
				}
				$idade = $anos;
			} else {
				$idade = $anos - 1;
			}
		}
		
		$idade = $anos;
	}
	if ($texto) return $texto.'<hr />';
}

function verVencimentoCNH($nascimento, $data) {
	if (valida($data, 'data')) {
	$tmp = explode ('/', $data);
		if ($tmp[2] <= 1998) {
			$texto .= paragrafo(cor('Em cumprimento à Resolução 168, os condutores que tiraram sua Primeira Habilitação com data inferior ao ano de 1998, terão de passar pelo Curso de Atualização.', '#FF0000'));
		}
		if (idade($nascimento) >= 65) $tempo = 3;
		else $tempo = 5;
		for ($i = $tmp[2] + $tempo; $i <= date('Y') + $tempo; $i = $i + $tempo) {
			$texto .= paragrafo('<span class="rec">Renovar habilitação em '.$tmp[0].'/'.$tmp[1].'/'.$i.'</span>');
		}
		if ($texto) return paragrafo(negrito('Vencimento de CNH')).$texto.'<hr />';
	}
}

function verVencimentoIPVA($placa) {
	if (valida($placa, 'placa')) {
		$final = substr($placa, -1);
		$texto = paragrafo('Veículos com placa final "<b>'.$final.'</b>" têm os seguintes vencimentos:');
		require 'tabelaIPVA.php';
		$texto .= paragrafo('Até '.$IPVA[$final][0].' - '.$msgIPVA[0].'.');
		$texto .= paragrafo('Até '.$IPVA[$final][1].' - '.$msgIPVA[1].'.');
		$texto .= paragrafo('Após '.$IPVA[$final][1].' - '.$msgIPVA[2].'.');
		if ($texto) return paragrafo(negrito('Vencimento do IPVA')).$texto.'<hr />';
	}
}

function verVeiculoGarantia($data, $tempo) {
	if (valida($data, 'data')) {
		$fimGarantia = somarData($data, 0, 0, $tempo);
		$dif = intervaloDataHora(date('d/m/Y'), $fimGarantia);
		// return $dif;
		if ($dif > 0 && $dif <= 7) {
			$texto .= paragrafo('<span class="rec">A garantia do seu veículo vence em '.str_pad($dif, 2, 0, STR_PAD_LEFT).' dia(s).</span>');
		} else if ($dif == 0) {
			$texto .= paragrafo('<span class="req">A garantia do seu veículo vence hoje.</span>');
		} else if ($dif < 0) {
			$texto .= paragrafo('<span class="req">A garantia do seu veículo venceu no dia '.$fimGarantia.'.</span>');
		} else {
			$texto .= paragrafo('A garantia do seu veículo vence em '.$fimGarantia);
		}

		if ($texto) return paragrafo(negrito('Vencimento da Garantia do veículo')).$texto.'<hr />';
	}
}

function verVeiculoRevisoes($data, $intervalo, $dataFinal) {
	if (valida($data, 'data') && valida($dataFinal, 'data')) {
		$texto = paragrafo(negrito('Próximas revisões'));
	}
}

function somarData($data, $dias, $meses, $ano) {
   $data = explode("/", $data);
   $newData = date("d/m/Y", mktime(0, 0, 0, $data[1] + $meses, $data[0] + $dias, $data[2] + $ano));
   return $newData;
}

function valida($value, $tipo) {
	$num = preg_replace('/[^0-9]/','',$value);
	switch ($tipo) {
		case 'nome':
			if (sizeof(explode(' ', trim($value))) >= 2) return true;
			break;
	
		case 'numero':
			if (is_numeric($value)) return true;
			break;

		case 'cpf':
			$num = trim($num);

			if (
				strlen($num) != 11
				|| $num == '00000000000' || $num == '11111111111' || $num == '22222222222' || $num == '33333333333'
				|| $num == '44444444444' || $num == '55555555555' || $num == '66666666666' || $num == '77777777777'
				|| $num == '88888888888' || $num == '99999999999'
			) {
				return false;
			} else {
				for ($t = 9; $t < 11; $t++) {
					for ($d = 0, $c = 0; $c < $t; $c++) { $d += $num{$c} * (($t + 1) - $c); }
					if ($num{$c} != ((10 * $d) % 11) % 10) { return false; }
				}
				return true;
			}
			break;

		case 'cnpj':
			if (strlen($num) != 14) return false;
			else {
				for ($t = 12; $t < 14; $t++) {
					for ($d = 0, $p = $t - 7, $c = 0; $c < $t; $c++) {
						$d += $num{$c} * $p;
						$p = ($p < 3) ? 9 : --$p;
					}

					if ($num{$c} != ((10 * $d) % 11) % 10) return false;
				}
				return true;
			}
			break;

		case 'cnh':
			if (is_numeric($value) && strlen($value) == 11) {
				for ($i = 0; $i <= 9; $i++) {
					$temp = $i.$i.$i.$i.$i.$i.$i.$i.$i.$i.$i;
					if ($temp == $value) return false;
				}
				return true;
			}
			break;
		
		case 'categoriaCNH':
			foreach (array('', 'A', 'B', 'C', 'D', 'E', 'AB', 'AC', 'AD', 'AE') as $tmp) {
				if ($value == $tmp) return true;
			}
			break;

		case 'data':
			$tmp = explode('/', $value);
			if (checkdate($tmp[1] * 1, $tmp[0] * 1, $tmp[2] * 1)) return true;
			break;

		case 'email':
			list($acc, $dominio) = explode('@', $value);
			if (trim($acc) != '' && checkdnsrr($dominio)) return true;
			break;

		case 'fone':
			if (strlen($value) == 14) return true;
			break;

		case 'placa':
			for ($i = 0; $i < strlen($value); $i++) $value = str_replace('_', '', $value);
			if (strlen($value) == 8) return true;
			break;

	}
}

function select($field) {
	global $$field;
	switch ($field) {
		case 'sexo':
		case 'sexoConjuge':
			$opcoes = array('', 'MASCULINO', 'FEMININO');
			break;
		case 'estadoCivil':
			$opcoes = array('', 'SOLTEIRO(A)', 'CASADO(A)', 'DIVORCIADO(A)', 'UNIÃO ESTÁVEL');
			break;
		case 'RGuf':
		case 'enderecoUF':
			$opcoes = array('', 'AC', 'AL', 'AM', 'AP', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA', 'MG', 'MS', 'MT', 'PA', 'PB', 'PE', 'PI', 'PR', 'RJ', 'RN', 'RO', 'RR', 'RS', 'SC', 'SE', 'SP', 'TO');
			break;
		case 'CNHcategoria':
		case 'CNHcategoriaConjuge':
			$opcoes = array('', 'A', 'B', 'C', 'D', 'E', 'AB', 'AC', 'AD', 'AE');
			break;
	}
	foreach ($opcoes as $opcao) {
		if ($opcao == $$field) {
			$attr = ' selected';
		} else {
			$attr = '';
		}
		echo "<option value=\"".$opcao."\"".$attr.">".$opcao."</option>n";
	}
}

function paragrafo($txt) {
	return "\n<p>".$txt."</p>";
}

function negrito($txt) {
	return "<b>".$txt."</b>";
}

function cor($txt, $cor) {
	return "<font color=\"".$cor."\">".$txt."</font>";
}

function setMask($s, $valor, $mascara) {
	// Exemplos:
	// Placa 	-> setMask('on', 'GIU2202', '###-####'); = GIU-2202
	// CPF 		-> setMask('on', '99489236187', '###.###.###-##'); = 994.892.361-87
	// Telefone -> setMask('on', '6599912087', '(##) ####-####'); = (65) 9991-2087
	// Telefone -> setMask('off', '(65) 9991-2087', '(##) ####-####'); = 6599912087
	// -----------------------------------------------------------
	for ($i = 0; $i <= strlen($mascara); $i++) {
		switch ($s) {
			case 'on':
				if ($mascara[$i] == '#') {
					$resultado .= $valor[$x];
					$x++;
				} else {
					$resultado .= $mascara[$i];
				}
				break;
			case 'off':
			if ($mascara[$i] == '#') {
				$resultado .= $valor[$i];
			}
		}
	}
	return $resultado;
}

function datetimeFormat($value, $param) {
	// Exemplo:
	// datetimeFormat('2010-06-10 16:45:00', 'data - hora')
	$TEMP = explode(' ', $value);
	$erroew = explode(' - ', $param);

	$dataEN = $TEMP[0];
	$tmpData = explode('-', $dataEN);
	$data = $tmpData[2].'/'.$tmpData[1].'/'.$tmpData[0];

	$horaFull = $TEMP[1];
	$tmpHora = explode(':', $horaFull);
	$hora = $tmpHora[0].':'.$tmpHora[1];

	if ($$erroew[1]) { $tmp = ' - '.$$erroew[1]; }

	return $$erroew[0].$tmp;
}

function Formata($value, $param) {
	switch ($param) {
		case 'data':
			$tmp = explode(' ', $value);
			$Ymd = $tmp[0];
			$tmp = explode('-', $Ymd);
			$valor = $tmp[2].'/'.$tmp[1].'/'.$tmp[0];
			break;
		case 'hora':
			$tmp = explode(' ', $value);
			$His = $tmp[1];
			$tmp = explode(':', $His);
			$valor = $tmp[0].':'.$tmp[1];
			break;
		case 'inteiro':
			$valor = str_replace('(', '', $value);
			$valor = str_replace(')', '', $value);
			$valor = str_replace('.', '', $value);
			$valor = str_replace('-', '', $value);
			$valor = str_replace('/', '', $value);
			$valor = str_replace(' ', '', $value);
			break;
	}
	return $valor;
}

?>