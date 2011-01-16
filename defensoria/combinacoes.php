<?php 
$combinacoesPossiveis = array();

/*
	Utiliza um gerador de números aleatórios com um LOOP para gerar os 
	números X e a cada LOOP você envia o número para um array, só que 
	dentro do LOOP coloque uma condição if testando se o número X já 
	existe no array, caso exista gere um novo.
*/
$numeroTotalCombinacoes = 5063860;
for($i=1;$i<=$numeroTotalCombinacoes;$i++) 
{
	$numero_de_X = 6;  // quantidade de números sorteados do concurso da Mega Sena
	$index       = 0;
	$matriz      = array();

	while($index < $numero_de_X)  // ENQUANTO $index FOR MENOR QUE $numero_de_X FACA
	{
		$rand = mt_rand(0, 60);  // sorteia um número entre 0 até 60
		$qual_numero = $index + 1;
		if(!in_array($rand, $matriz))  // SE os 6 números da mega sena NÃO FOREM IGUAIS ENTÃO
		{
			$matriz[$index] = $rand;
			$index++;
		}
	}

	/*
		Ordena os números sorteados
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
