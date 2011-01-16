<?php 
$combinacoesPossiveis = array();

/*
	Utiliza um gerador de n�meros aleat�rios com um LOOP para gerar os 
	n�meros X e a cada LOOP voc� envia o n�mero para um array, s� que 
	dentro do LOOP coloque uma condi��o if testando se o n�mero X j� 
	existe no array, caso exista gere um novo.
*/
$numeroTotalCombinacoes = 5063860;
for($i=1;$i<=$numeroTotalCombinacoes;$i++) 
{
	$numero_de_X = 6;  // quantidade de n�meros sorteados do concurso da Mega Sena
	$index       = 0;
	$matriz      = array();

	while($index < $numero_de_X)  // ENQUANTO $index FOR MENOR QUE $numero_de_X FACA
	{
		$rand = mt_rand(0, 60);  // sorteia um n�mero entre 0 at� 60
		$qual_numero = $index + 1;
		if(!in_array($rand, $matriz))  // SE os 6 n�meros da mega sena N�O FOREM IGUAIS ENT�O
		{
			$matriz[$index] = $rand;
			$index++;
		}
	}

	/*
		Ordena os n�meros sorteados
	*/
	sort($matriz);
  	$combinacaoSorteada = array();
	while(list($chave, $valor) = each($matriz))
	{
		$combinacaoSorteada[] = $valor;
	}
	if(!in_array($combinacaoSorteada,$combinacoesPossiveis))
	{
		$combinacoesPossiveis[] = $combinacaoSorteada;
	}
	else
	{
		continue;
		$i = $i - 1;
	}
}

/*echo "<td>
				<center>
					<font size='6' face='verdana, helvetica, arial' color='yellow'><b>" . $valor . "</b></font>
				</center>
			</td>";*/
?>
