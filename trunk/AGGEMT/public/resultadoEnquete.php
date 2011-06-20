<?php 
include ('carregamentoInicial.php');
?>
<div class="art-postmetadataheader">
	<h2 class="art-postheader"><img src="./images/postheadericon.png" width="19" height="17" alt="" />Resultado da Enquete</h2>
</div>
<div>
<?php 
if(isset($_GET['idenquete']))
{
	$enquetePesquisa = new Enquete();
	$enquetePesquisa->reset();
	$enquetePesquisa->setIdenquete($_GET['idenquete']);
	if($enquetePesquisa->find())
	{
		while($enquetePesquisa->fetch())
		{
			$total_votos = $enquetePesquisa->getTotalVotos();
			?>
			<h2 class="art-postheader"><?=$enquetePesquisa->getNomeenquete()?></h2>
			<table width="94%" border="0" cellspacing="0" cellpadding="0">
		        <?php
		                //inicio ciclo...
		
		                for ($i=1;$i<=$enquetePesquisa->getNumeroPerguntas();$i++) {
		                	$metodoPerg = "getQuestao".$i."enquete";
		                	$metodoVotos = "getVotos".$i."enqueste";
		                    if ($total_votos >= 1) {
		                    	
		                        $porc = ((100 * $enquetePesquisa->$metodoVotos())/$total_votos);
		                        $porc = (int) $porc;
		                        $resto = 100 - $porc;
		                    } else {
		                        $porc = 0;
		                        $resto = 100;
		                    }
		                ?>
		          <tr>
		            <td width="39%" height="17"><font size="1" face="Arial, Helvetica, sans-serif"><b><font color="#000000"><?=$enquetePesquisa->$metodoPerg(); ?></font></b></font></td>
		            <td width="61%" valign="middle" align="left" height="17"><img src="images/barra.jpg" width="<? echo $porc; ?>" height="13"><img src="images/barra2.jpg" width="<? echo $resto; ?>" height="13">
		              <font size="1" face="Arial, Helvetica, sans-serif"><? echo $porc; ?>%</font></td>
		          </tr>
		        <?php
		                }
		                //fim ciclo...
		        ?>
		        <tr bgcolor="#000066"> 
				    <td bgcolor="#FF9900" colspan="2"> 
				      <div align="center"><b><font size="2" face="Arial, Helvetica, sans-serif" color="#FFFFFF">Total 
				        de Votos:</font></b> <font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif"><b><?php echo $total_votos; ?></b></font></div>
				    </td>
			  </tr>
		         </table>
			<?php
		}
	}
}
?>
</div>