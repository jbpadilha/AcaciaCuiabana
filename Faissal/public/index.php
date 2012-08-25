<?php 
include("carregamentoInicial.php");
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">
	<head>
		<title>Faissal - Futuro Vereador - 40.444</title>
		<meta name="Keywords" content=" " />
		<meta name="Description" content=" " />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		
		<!-- CSS -->
		<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
		<!-- The next line calls the font for the headings. Use it like this: "style-fontname.css". Options are bitter, droidsans, droidserif, franchise, museo, nevis, or rokkitt */ -->
		<link rel="stylesheet" type="text/css" href="fonts/style-nevis.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="includes/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
		
		<!-- The Favicon -->
		<link rel="shortcut icon" href="images/favicon.png" />
		
		<!-- START DEMO -->
		<link rel="stylesheet" href="switcher.css" type="text/css" media="screen" />
		
		<!-- END DEMO -->
		<script type="text/javascript" src="./js/jquery.js"></script>
		<script type="text/javascript" src="./js/script.js"></script>
		<script type="text/javascript">
		function carregaPagina(url,id) { 
			$('#noticiaLista').html('');
		    $("div#"+id).html("<div aligh='center'><font color=\"#FF0000\">Carregando ...</font>  <img src='images/loading.gif' align='top' alt='aguarde' /></div>");
		            $.get(url,{ }
		            ,function(retorno){$("#"+id).html(retorno)});
		}
		</script>
	</head>
	<!-- options for the body classes are // content_left, content_right // bg_linen, bg_freckles, bg_cork, bg_fabric, bg_pinstripes, bg_none // body_boxed, body_span // scheme_blue, scheme_red, scheme_green, scheme_yellow -->
	<body class="content_left bg_linen body_boxed scheme_blue ">
	<!-- START DEMO -->
	<div id="switcher_wrap">
	<div id="switcher"  style="display:none;">
	<div id="title">Options</div>
	<ul>
		<li>
			<strong>Color Scheme</strong>
			<a href="#" onclick="javascript:return false;" class="blue">Blue</a>
			<a href="#" onclick="javascript:return false;" class="red">Red</a>
			<a href="#" onclick="javascript:return false;" class="green">Green</a>
			<a href="#" onclick="javascript:return false;" class="yellow">Yellow</a>
			<div class="clear"></div>
		</li>
		<li>
			<strong>Body Style</strong>
			<a href="#" onclick="javascript:return false;" class="bbox">Boxed</a>
			<a href="#" onclick="javascript:return false;" class="bspan">Full Width</a>
			<div class="clear"></div>
		</li>
		<li class="bgpat">
			<strong>Background</strong>
			<a href="#" onclick="javascript:return false;" class="cork">Cork</a>
			<a href="#" onclick="javascript:return false;" class="fabric">Fabric</a>
			<a href="#" onclick="javascript:return false;" class="freckles">Freckles</a>
			<a href="#" onclick="javascript:return false;" class="linen">Linen</a>
			<a href="#" onclick="javascript:return false;" class="pinstripes">Pinstripes</a>
			<a href="#" onclick="javascript:return false;" class="none">None</a>
			<div class="clear"></div>
		</li>
		<li>
			<strong>Layout</strong>
			<a href="#" style="display:block;" onclick="javascript:return false;" class="cleft">Left</a>
			<a href="#" style="display:block;" onclick="javascript:return false;" class="cright">Right</a>
			<div class="clear"></div>
		</li>
	</ul>
	</div>
	<div id="dc_options_toggle">
			<div id="dc_hide_options"  style="display:none;">Hide Options</div>
			<div id="dc_show_options">Show Options</div>
		</div>
	</div>
	<!-- END DEMO -->

		<div id="main_wrap">
			<div class="wrapper" id="header">
				<div id="pre_header"></div>
				<div class="container">
					<div id="logo_wrap">
						<div id="the_logo">
							<a href="#" title="Campaign" class="left the_logo">
								<img src="images/campaignlogo.png" alt="Campaign" id="logo" />
							</a>
						</div>
						<form method="get" id="searchform" action="#">
							<div>
								<img src="images/faissal.png" alt="Campaign" id="logo">
								<div class="clear"></div>
							</div>
						</form>
						<div class="clear"></div>
					</div>
					<br/><br/>
					<div id="clear"></div>
				</div>
				<div id="main_menu">
					<div class="container">
						<div id="main_menu_wrap">
							<div class="menu-main-container">
								<ul id="menu-main" class="menu">
									<?
									include("menu.php");
									?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="wrapper" id="content"> <!-- #content ends in footer.php -->
				<div class="container">
				<div id="conteudo">
				<div id="slides_wrap">
	<div id="slides">
		<div class="slidearea slides_container">
			<div>
				<div class="slide_image_wrap">
					<a href="#" title="Campaign Slide">
						<img width="600" height="300" src="images/_demo//htmlslide1.png" alt="Campaign Slide" />
					</a>
				</div>
			</div>
			<div>
				<iframe src="http://player.vimeo.com/video/7449107?portrait=0" width="600" height="300" frameborder="0"></iframe>
			</div>
			<div>
				<div class="slide_image_wrap">
					<div class="slide_text_overlay">
						This slide has a little bit of text overlaid on the bottom.
					</div>
					<a href="#" title="Campaign Slide">
						<img width="600" height="300" src="images/_demo/htmlslide2.png" alt="Campaign Slide" />
					</a>
				</div>
			</div>
		</div>
	</div>
	<div id="slide_widget" class="campaign_email_slide">
		<div id="slide_widget_inner">
			<div class="widget campaign_email_capture_wrap">
				<h3 class="widgettitle">Vote Faissal</h3>
				<span>Cadastre-se para receber agenda de Faissal.</span>
				<div id="campaign_email_capture">
					<form action="#" method="post">
						<div>
							<input type="text" class="campaign-email-capture-name campaign-email-capture-name-active" name="campaign-email-capture-name" title="Seu Nome" />
							<input type="text" class="campaign-email-capture-email campaign-email-capture-email-active" name="campaign-email-capture-email" title="Seu E-mail" />
							<input type="submit" class="campaign-email-capture-submit" value="Receba agenda de Faissal" name="Submit" />
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>
</div>
<div id="home_widgets">
	<div id="home_widget_wrap">
		<div class="widget">
			<h3 class="widgettitle">Educação</h3>
			<div>Proposta na Educação</div>
			<a href="#" class="button button_gray">Mais</a>
		</div>
		<div class="widget">
			<h3 class="widgettitle">Saúde</h3>
			<div>Proposta na Saúde.</div>
			<a href="#" class="button button_gray">Mais</a>
		</div>
		<div class="widget">
			<h3 class="widgettitle">Segurança</h3>
			<div>Proposta Saúde.</div>
			<a href="#" class="button button_gray">Mais</a>
		</div>
		<div class="clear"></div>
	</div>
</div>
<div class="posts-wrap">
	<div id="home_video_wrap">
		<div id="home_video">
			<iframe src="http://www.youtube.com/embed/rOrnZ5wo8nM" frameborder="0" width="380" height="223" ></iframe>
		</div>
		<div id="home_video_desc">
			<h4>Pedido Especial</h4>
			<p>Senador Pedro Taques e um pedido especial para você.</p>
		</div>
		<div class="clear"></div>
	</div>
	<div id="home_latest_posts">
		<h4 class="entry-title" id="latest-posts-title">Últimas ações</h4>
		<div class="single_latest left">
			<a href="blog-single.php" title="Single Post" class="single_latest_img_link">
				<img width="170" height="120" src="images/latest_fallback.png" alt="Image" />
			</a>
			<h5><a href="blog-single.php" title="Single Post">Single Post</a></h5>
			<div class="meta">
				Posted on February 21, 2012
			</div>
		</div>
		<div class="single_latest left">
			<a href="blog-single.php" title="Single Post" class="single_latest_img_link">
				<img width="170" height="120" src="images/latest_fallback.png" alt="Image" />
			</a>
			<h5><a href="blog-single.php" title="Single Post">Single Post</a></h5>
			<div class="meta">
				Posted on February 21, 2012
			</div>
		</div>
		<div class="single_latest left">
			<a href="blog-single.php" title="Single Post" class="single_latest_img_link">
				<img width="170" height="120" src="images/latest_fallback.png" alt="Image" />
			</a>
			<h5><a href="blog-single.php" title="Single Post">Single Post</a></h5>
			<div class="meta">
				Posted on February 21, 2012
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<div id="sidebar">
		<div class="widget"><h4 class="widgettitle">Agenda</h4>
		<ul class="upcoming">
			<?php 
			$agenda = new Agenda();
			$agenda->reset();
			$agenda->limit(2);
			$agenda->where("dataagenda > now()");
			if($agenda->find())
			{
				while ($agenda->fetch())
				{
					
					echo "<li class=\"event_list_item\">
					<div class=\"when\">
						{$agenda->getDataAgendaFormatado()}
					</div>
					<div class=\"event\">
						<p>{$agenda->getTituloagenda()}</p></li>
					</div>
					";
				}
			}
			else
			{
				echo "<tr><td>Sem agenda.</td><tr>";
			}
			?>
			
		</ul>
		<div class="dig-in"><a href="javascript:void(0);" onclick="carregaPagina('agenda.php','conteudo')">veja todas</a></div>
	</div>
	<div class="widget_testimonial widget"><h4 class="widgettitle">Testemunhal</h4>
		<div class="the_testimonial">Insira aqui o testemunho de Faissal</div>
		<div class="the_testimonial_author">
			<strong>- Faissal</strong>
		</div>
		<div class="clear"></div>
	</div>
	</div>					<div class="clear"></div>
				</div><!-- end div.container, begins in header.php -->
			</div><!-- end div.wrapper, begins in header.php -->
		</div><!-- end div#main_wrap, begins in header.php -->
		<div id="footer" class="wrapper">
			<div class="container">
				<h1 id="footer_slogan">A mudança é agora.</h1>
				<div id="footer_widgets">
					
				</div>
				<div id="post_footer">
					<div id="socnets_wrap">
						<div id="socnets">
							<a href="#" title="Twitter">
								<img src="images/socnets/twitter.png" alt="Twitter" />
							</a>
							<a href="https://www.facebook.com/faissal.calil" title="Facebook">
								<img src="images/socnets/facebook.png" alt="Facebook" />
							</a>
							<a href="#" title="Google+">
								<img src="images/socnets/google.png" alt="Google+" />
							</a>
							<a href="#" title="Flickr">
								<img src="images/socnets/flickr.png" alt="Flickr" />
							</a>
							<a href="#" title="Tumblr">
								<img src="images/socnets/tumblr.png" alt="Tumblr" />
							</a>
							<a href="#" title="Vimeo">
								<img src="images/socnets/vimeo.png" alt="Vimeo" />
							</a>
							<a href="#" title="YouTube">
								<img src="images/socnets/youtube.png" alt="YouTube" />
							</a>
						</div>
						<div class="clear"></div>
					</div>
					<div id="site_info">
						&copy; 2012&nbsp;&nbsp;:&nbsp;
						<a href="mailto:joao.padilha@globo.com" title="Campaign WordPress Theme">by João Padilha</a>
					</div>
				</div>
			</div>
		</div>
		<!-- jQuery We Need -->
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
		<script type="text/javascript" src="includes/js/jquery.slabtext.min.js"></script>
		<script type="text/javascript" src="includes/js/jquery.easing.1.3.js"></script>
		<script type="text/javascript" src="includes/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
		<script type="text/javascript" src="includes/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
		<script type="text/javascript" src="includes/js/slides.jquery.js"></script>
		<script type="text/javascript" src="includes/js/campaign.js"></script>
		<script type="text/javascript">
			/* <![CDATA[  */ 
			var J = jQuery.noConflict();
			J(document).ready(function(){
				
				//Style Switcher
				J('.cright').click( function(){
					J('body').removeClass('content_left').addClass('content_right');
				});
				
				J('.cleft').click( function(){
					J('body').removeClass('content_right').addClass('content_left');
				});
				
				J('.bspan').click( function(){
					J('body').removeClass('body_boxed').addClass('body_span');
					J('.bgpat').hide();
				});
				
				J('.bbox').click( function(){
					J('body').removeClass('body_span').addClass('body_boxed');
					J('.bgpat').show();
				});
				
				// colors
				J('.blue').click( function(){
					J('body').removeClass('scheme_blue').addClass('scheme_blue');
					J('body').removeClass('scheme_red').addClass('scheme_blue');
					J('body').removeClass('scheme_green').addClass('scheme_blue');
					J('body').removeClass('scheme_yellow').addClass('scheme_blue');
				});
				
				J('.green').click( function(){
					J('body').removeClass('scheme_blue').addClass('scheme_green');
					J('body').removeClass('scheme_red').addClass('scheme_green');
					J('body').removeClass('scheme_green').addClass('scheme_green');
					J('body').removeClass('scheme_yellow').addClass('scheme_green');
				});
				
				J('.yellow').click( function(){
					J('body').removeClass('scheme_blue').addClass('scheme_yellow');
					J('body').removeClass('scheme_red').addClass('scheme_yellow');
					J('body').removeClass('scheme_green').addClass('scheme_yellow');
					J('body').removeClass('scheme_yellow').addClass('scheme_yellow');
				});
				
				J('.red').click( function(){
					J('body').removeClass('scheme_blue').addClass('scheme_red');
					J('body').removeClass('scheme_red').addClass('scheme_red');
					J('body').removeClass('scheme_green').addClass('scheme_red');
					J('body').removeClass('scheme_yellow').addClass('scheme_red');
				});
				
				J('.cork').click( function(){
					J('body').removeClass('bg_cork').addClass('bg_cork');
					J('body').removeClass('bg_fabric').addClass('bg_cork');
					J('body').removeClass('bg_freckles').addClass('bg_cork');
					J('body').removeClass('bg_linen').addClass('bg_cork');
					J('body').removeClass('bg_pinstripe').addClass('bg_cork');
					J('body').removeClass('bg_none').addClass('bg_cork');
				});
				
				J('.fabric').click( function(){
					J('body').removeClass('bg_cork').addClass('bg_fabric');
					J('body').removeClass('bg_fabric').addClass('bg_fabric');
					J('body').removeClass('bg_freckles').addClass('bg_fabric');
					J('body').removeClass('bg_linen').addClass('bg_fabric');
					J('body').removeClass('bg_pinstripe').addClass('bg_fabric');
					J('body').removeClass('bg_none').addClass('bg_fabric');
				});
				
				J('.freckles').click( function(){
					J('body').removeClass('bg_cork').addClass('bg_freckles');
					J('body').removeClass('bg_fabric').addClass('bg_freckles');
					J('body').removeClass('bg_freckles').addClass('bg_freckles');
					J('body').removeClass('bg_linen').addClass('bg_freckles');
					J('body').removeClass('bg_pinstripe').addClass('bg_freckles');
					J('body').removeClass('bg_none').addClass('bg_freckles');
				});
				
				J('.linen').click( function(){
					J('body').removeClass('bg_cork').addClass('bg_linen');
					J('body').removeClass('bg_fabric').addClass('bg_linen');
					J('body').removeClass('bg_freckles').addClass('bg_linen');
					J('body').removeClass('bg_linen').addClass('bg_linen');
					J('body').removeClass('bg_pinstripe').addClass('bg_linen');
					J('body').removeClass('bg_none').addClass('bg_linen');
				});
				
				J('.pinstripes').click( function(){
					J('body').removeClass('bg_cork').addClass('bg_pinstripe');
					J('body').removeClass('bg_fabric').addClass('bg_pinstripe');
					J('body').removeClass('bg_freckles').addClass('bg_pinstripe');
					J('body').removeClass('bg_linen').addClass('bg_pinstripe');
					J('body').removeClass('bg_pinstripe').addClass('bg_pinstripe');
					J('body').removeClass('bg_none').addClass('bg_pinstripe');
				});
				
				J('.none').click( function(){
					J('body').removeClass('bg_cork').addClass('bg_none');
					J('body').removeClass('bg_fabric').addClass('bg_none');
					J('body').removeClass('bg_freckles').addClass('bg_none');
					J('body').removeClass('bg_linen').addClass('bg_none');
					J('body').removeClass('bg_pinstripe').addClass('bg_none');
					J('body').removeClass('bg_none').addClass('bg_none');
				});

				J('#dc_hide_options').click(function() {
					J('#dc_show_options').show();
					J('#dc_hide_options').hide();
  					J('#switcher').slideToggle('fast', function() {
					});
				});
				
				J('#dc_show_options').click(function() {
					J('#dc_hide_options').show();
					J('#dc_show_options').hide();
  					J('#switcher').slideToggle('fast', function() {
					});
				});
				
			});
			
			/* ]]> */
		</script>
		<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-19161846-11']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
	</body>
</html>
