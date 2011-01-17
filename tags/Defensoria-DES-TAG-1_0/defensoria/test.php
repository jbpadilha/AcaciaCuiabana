<?php 
$combinacoesPossiveis = array();
?>
<html>
  <head>
    <title>Brincando com os números da MEGA-SENA</title>
  </head>

  <body bgcolor="#1991bd" text="#ffffff" link="yellow" alink="yellow" vlink="orange">

    <center>
      <font size='7' face='verdana, helvetica, arial'>
        <b>Brincando com os 6 números da Mega-Sena</b>
      </font>
    </center>

    <br /><br />

    <center>
      <table border='1' cellspacing='2' cellpadding='10' width="90%" align="center">
        <tbody>
          <tr>
            <td colspan='6' align='center'>
              <font face='verdana, helvetica, arial'><b>Os números sorteados foram:</b></font>
            </td>
          </tr>

          <tr>

          <?php
          /*
            Utiliza um gerador de números aleatórios com um LOOP para gerar os 
            números X e a cada LOOP você envia o número para um array, só que 
            dentro do LOOP coloque uma condição if testando se o número X já 
            existe no array, caso exista gere um novo.
          */
          $numero_de_X = 6;  // quantidade de números sorteados do concurso da Mega Sena
          $index       = 0;
          $matriz      = array();

          while($index < $numero_de_X)  // ENQUANTO $index FOR MENOR QUE $numero_de_X FACA
             {
                $rand        = mt_rand(0, 60);  // sorteia um número entre 0 até 60
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
                echo "<td>
                        <center>
                          <font size='6' face='verdana, helvetica, arial' color='yellow'><b>" . $valor . "</b></font>
                        </center>
                      </td>";
                $combinacaoSorteada[$valor];
             }
            $combinacoesPossiveis[$combinacaoSorteada];

          ?>

          </tr>
        </tbody>
      </table>
    </center>

    <br /><br />

    <center>
      <font size='4' face='verdana, helvetica, arial'>
        <b>Para SORTEAR 6 NOVOS números da MEGA-SENA, clique no botão ATUALIZAR (RELOAD) do seu navegador web (browser).</b>
      </font>
    </center>

  </body>

</html>