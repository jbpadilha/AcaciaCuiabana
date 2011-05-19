<?php
	include 'carregamentoInicial.php';  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8" />
		<title>AGEEMT - Associação de Gestores Governamentais do estado de Mato Grosso</title>
		<link rel="stylesheet" href="./style.css" type="text/css" media="screen" />
		<!--[if IE 6]><link rel="stylesheet" href="./style.ie6.css" type="text/css" media="screen" /><![endif]-->
		<!--[if IE 7]><link rel="stylesheet" href="./style.ie7.css" type="text/css" media="screen" /><![endif]-->
		<script type="text/javascript" src="./js/jquery.js"></script>
		<script type="text/javascript" src="./js/script.js"></script>
		<script type="text/javascript">
			function carregaPagina(url,id) { 
				$('#noticiaLista').html('');
			    $("div#"+id).html("<div aligh='center'><font color=\"#FF0000\">Carregando ...</font>  <img src='images/loading.gif' align='top' alt='aguarde' /></div>");
			            $.get(url,{ }
			            ,function(retorno){$("#"+id).html(retorno)});
			}

			function votar()
			{
				var formulario = $('#enquete').serialize(true);
				$("div#resultadoEnquete").html("<div aligh='center'><font color=\"#FF0000\">Carregando ...</font>  <img src='images/loading.gif' align='top' alt='aguarde' /></div>");
	            $.post($('#enquete').attr("action"), formulario, function(retorno){$("div#resultadoEnquete").html(retorno)});
			}
		</script>
	</head>
	<body>
		<div id="art-main">
			<div class="art-header">
				<div class="art-header-center">
					<div class="art-header-png"></div>
					<div class="art-header-jpeg"></div>
				</div>
				<div class="art-header-wrapper">
					<div class="art-header-inner">
						<div class="art-logo">
							<h1 id="name-text" class="art-logo-name"><a href="./index.html">AGGE - MT</a></h1>
							<h2 id="slogan-text" class="art-logo-text">Associação de Gestores Governamentais do estado de Mato Grosso</h2>
						</div>
					</div>
				</div>
			</div>
			<div class="art-nav">
				<div class="art-nav-wrapper">
					<div class="art-nav-inner">
						<?php 
						include 'menuHorizontal.php';
						?>
					</div>
				</div>
			</div>
			<div class="art-sheet">
				<div class="art-sheet-tl"></div>
				<div class="art-sheet-tr"></div>
				<div class="art-sheet-bl"></div>
				<div class="art-sheet-br"></div>
				<div class="art-sheet-tc"></div>
				<div class="art-sheet-bc"></div>
				<div class="art-sheet-cl"></div>
				<div class="art-sheet-cr"></div>
				<div class="art-sheet-cc"></div>
				<div class="art-sheet-body">
					<div class="art-content-layout">
						<div class="art-content-layout-row">
							<div class="art-layout-cell art-sidebar1">
								<div class="art-vmenublock">
									<div class="art-vmenublock-body">
										<div class="cleared"></div>
									</div>
								</div>
								<div class="art-block">
									<div class="art-block-body">
										<div class="art-blockheader">
											<div class="l"></div>
											<div class="r"></div>
											<h3 class="t">Agenda</h3>
										</div>
										<div class="art-blockcontent">
											<div class="art-blockcontent-body">`
												<?php 
												$agenda = new Agenda();
												$agenda->apagaAgendaPassada();
												$agenda->reset();
												$agenda->limit(2);
												$agenda->where("dataagenda > now()");
												if($agenda->find())
												{
													while ($agenda->fetch())
													{
														echo "<p>{$agenda->getDataAgendaFormatado()} - {$agenda->getTituloagenda()}</p>"; 
													}
												}
												else
												{
													echo "Não existem eventos cadastrados";
												}
												?>
												<div class="cleared"><a href="javascript:void(0);" onclick="carregaPagina('agenda.php','conteudo')">Veja mais</a> </div>
											</div>
										</div>
										<div class="cleared"></div>
									</div>
								</div>
								<div class="art-block">
									<div class="art-block-body">
										<div class="art-blockheader">
											<div class="l"></div>
											<div class="r"></div>
											<h3 class="t">Links</h3>
										</div>
										<div class="art-blockcontent">
											<div class="art-blockcontent-body">
												<div>
													<?php 
													$linksuteis = new Linksuteis();
													$linksuteis->reset();
													$linksuteis->limit(4);
													if($linksuteis->find())
													{
														echo '<ul>';
														while ($linksuteis->fetch())
														{
															if($linksuteis->getLink() != null)
															{
																echo '<li><a href="'.$linksuteis->getLink().'" target="_blank">'.$linksuteis->getDescricaolinksuteis().'</a></li>';
															}
															elseif($linksuteis->getIdanexo()!=null){
																$anexosLink = new Anexos();
																$anexosLink->setIdanexo($linksuteis->getIdanexo());
																$anexosLink->find(true);
																echo '<li><a href="imagens/'.$anexosLink->getCaminhoanexo().'" target="_blank">'.$linksuteis->getDescricaolinksuteis().'</a></li>';
															}
														}
														echo '</ul>';
													}
													?>
												</div>
												<div class="cleared"></div>
											</div>
										</div>
										<div class="cleared"></div>
									</div>
								</div>
								<div class="art-block">
									<div class="art-block-body">
										<div class="art-blockheader">
											<div class="l"></div>
											<div class="r"></div>
										</div>
										<div class="art-blockcontent">
											<div class="art-blockcontent-body">
												<div id="resultadoEnquete" class="resultenquete"></div>
												<div>
													<?php 
													$enquete = new Enquete();
													$enquete->setStatusenquete(1);
													$enquete->setTipoenquete(0);
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
													<div id="retornoVota"></div>
												</div>
												<div class="cleared"></div>
											</div>
										</div>
										<div class="cleared"></div>
									</div>
								</div>
								<div class="art-block">
									<div class="art-block-body">
										<div class="art-blockcontent">
											<div class="art-blockcontent-body">
												<div>
												<?php 
												$banners = new Banners();
												$banners->reset();
												$banners->setStatusbanner(1);
												if($banners->find())
												{
													while ($banners->fetch())
													{
														echo '<img src="'.PROJETO_CONTEXT.'public/images/'.$banners->getCaminhobanner().'" width="120" height="60" />';
														break;
													}
												}
												?>
												</div>
												<div class="cleared"></div>
											</div>
										</div>
										<div class="cleared"></div>
									</div>
								</div>
								<div class="cleared"></div>
							</div>
							<div class="art-layout-cell art-content">
								<div class="art-post">
									<div class="art-post-body">
										<div class="art-post-inner art-article" id="conteudo" style="overflow: auto;">
											<div class="art-postmetadataheader">
												<h2 class="art-postheader"><img src="./images/postheadericon.png" width="19" height="17" alt="" />Notícias</h2>
											</div>
											<div class="art-postcontent">
												<?php 
												$noticiaDestaque = new Noticias();
												$noticiaDestaque->setDestaque(1);
												if($noticiaDestaque->find()>0)
												{
													while($noticiaDestaque->fetch())
													{
														if($noticiaDestaque->getImagemnoticia())
															echo "<img src=\"images/{$noticiaDestaque->getImagemnoticia()}\" style=\"float:left\" width=\"300\" height=\"200\" /><br><br>";
														echo "<p>".$noticiaDestaque->getDatanoticiaFormatado()." - <b>".$noticiaDestaque->getTitulonoticia()."</b></p>";
														echo substr ($noticiaDestaque->getDescricaonoticia(), 0, 200);
													}
												}
												?>
											</div>
										</div>
										<div class="cleared"></div>
										<div id="noticiaLista">
											<?php 
											$noticias = new Noticias();
											$noticias->reset();
											$noticias->limit(4);
											$noticias->setStatusnoticia(1);
											if($noticias->find())
											{
												echo '<ul>';
												while ($noticias->fetch())
												{
													echo '<li><a href="javascript:void(0);" onClick="carregaPagina(\'noticia.php?idnoticia='.$noticias->getIdnoticia().'\',\'conteudo\')">'.$noticias->getDatanoticiaFormatado()." - ".$noticias->getTitulonoticia().'</a></li>';
												}
												echo '</ul>';
											}
											?>
											<a href="javascript:void(0);" onclick="carregaPagina('noticia.php','conteudo')">Veja mais</a>
											</div>
									</div>
								</div>
								<div class="cleared"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="art-footer">
				<div class="art-footer-t"></div>
				<div class="art-footer-l"></div>
				<div class="art-footer-b"></div>
				<div class="art-footer-r"></div>
				<div class="art-footer-body">
					<div class="art-footer-text">
						<p>Copyright © 2011. All Rights Reserved.<br/>
						
						</p>
					</div>
					<div class="cleared"></div>
				</div>
			</div>
			<div class="cleared"></div>
		</div>
	</body>
</html>
