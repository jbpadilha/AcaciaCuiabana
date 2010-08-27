<?php

require 'scripts.php';

$valor = $_POST['valor'];
$tipo = $_POST['tipo'];

switch ($tipo) {
	case 'nome':
		if (sizeof(explode(' ', trim($valor))) <= 1) $msg = 'statusERRO';
		break;

	case 'cpf':
		$num = trim(setMask('off', $valor, '###.###.###-##'));

		if (
			strlen($num) != 11
			|| $num == '00000000000' || $num == '11111111111' || $num == '22222222222' || $num == '33333333333'
			|| $num == '44444444444' || $num == '55555555555' || $num == '66666666666' || $num == '77777777777'
			|| $num == '88888888888' || $num == '99999999999'
		) {
			$msg = 'statusERRO';
		} else {
			for ($t = 9; $t < 11; $t++) {
				for ($d = 0, $c = 0; $c < $t; $c++) { $d += $num{$c} * (($t + 1) - $c); }
				if ($num{$c} != ((10 * $d) % 11) % 10) { $msg = 'statusERRO'; }
			}
		}
		break;

	case 'cnh':
		if (is_numeric($valor) && strlen($valor) == 11) {
			for ($i = 0; $i <= 9; $i++) {
				$temp = $i.$i.$i.$i.$i.$i.$i.$i.$i.$i.$i;
				if ($temp == $valor) $msg = 'statusERRO';
			}
		}
		break;

	case 'data':
		$tmp = explode('/', $valor);
		if (!checkdate($tmp[1] * 1, $tmp[0] * 1, $tmp[2] * 1)) $msg = 'statusERRO';
		break;

	case 'numero':
		if (!is_numeric($valor)) $msg = 'statusERRO';
		break;

	case 'email':
		list($acc, $dominio) = explode('@', $valor);
		if (trim($acc) != '') {
			if (!checkdnsrr($dominio)) $msg = 'statusERRO';
		} else {
			$msg = 'statusERRO';
		}
		break;

}

if ($msg) echo $msg;
else echo 'statusOK';

?>