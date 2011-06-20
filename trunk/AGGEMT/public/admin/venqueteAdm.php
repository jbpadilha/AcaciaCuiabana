<?php 
include ('../carregamentoInicial.php');
?>
<div class="art-postmetadataheader">
	<h2 class="art-postheader"><img src="../images/postheadericon.png" width="19" height="17" alt="" />Publicações</h2>
</div>
<?php 
$enquete = new Enquete();
$enquete->reset();
$enquete->setStatusenquete(1);
$enquete->setTipoenquete(1);
if($enquete->find()>0)
{
	while($enquete->fetch())
	{
		?>
		<form action="../application/recebePostGet.php" name="enquete" id="enquete">
		<input type="hidden" id="control" name="control" value="Enquete"/>
		<input type="hidden" id="funcao" name="funcao" value="votar"/>
		<table width="124" border="0" cellspacing="0" cellpadding="0">
        	<tr> 
            	<td height="101" colspan="2"> 
              		<div align="center">
                		<input type="hidden" name="idenquete" value="<?=$enquete->getIdenquete()?>"/>
                		<?php echo '<b>'.$enquete->getNomeenquete().'</b><br><br>'; ?>
                	</div>
              		<table width="94%" border="0" align="center" cellpadding="0" cellspacing="0">
                	<?php
              			for ($i = 1 ; $i <= $enquete->getNumeroPerguntas() ; $i++) 
              			{
            		?>
                		<tr> 
                  			<td>
                  					<input type="radio" name="resposta" value="<?=$i?>"/>
                  					<?php 
                  					$metodo = "getQuestao".$i."enquete";
                  					?> 
                    				<?=$enquete->$metodo()?><br/>
                    		</td>
                		</tr>
                	<?php 
              			}
              		?>
              		</table>
              		<div align="center"> 
                		<input type="button" name="Button" value="Votar" onclick="votar();" />
                	</div>
				</td>
          	</tr>
        </table>
        </form>
<?php 
	break;
	}
}
?>