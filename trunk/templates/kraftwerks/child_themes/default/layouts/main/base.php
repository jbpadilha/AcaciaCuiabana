<?php

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );         

    // Output Header
    echo $magic->joomla->j_head(); 
    echo js($magic->tconfig->js);    
    $magic->CSScaffoldInit('template_styles.css'); 
    echo css($magic->tconfig->styles);  
?>
</head> 
	<body class="<?php echo bodyClass();?>">           
		<?php     
			if(JRequest::getString('style')) {
				$styleRequest = JRequest::getString('style') . '.css'; 
				echo '<div class="user_flash" style="display:none;">'; $magic->admin->save("styles", $styleRequest); echo '</div>';
			}          
			
			if(isAdmin() AND $magic->template->params->get( 'configBarEnable') == 'on') {
				echo $magic->admin->configBar(); 
			}       
			
		?>
		<div id="nav_container">
		    <div class="wrapper">  
		    	<div id="logo_wrap">
					<a id="logo" class="hideTxt" href="<?php echo JSITEURL;?>">Logo</a>
				</div>   
				<div id="navigation">
					<?php echo $magic->menu->createMenu('mainmenu', 'Main Menu'); ?>
				</div>
		    </div>   
		</div>        
		 <!-- /END nav_container --> 
	    <div id="nav_shadow"></div>
		 
	    <div class="clearBoth"></div>
		   
<?php if(module('newsflash')): ?>
		<div id="bg_wrap">   
<?php endif; ?>
		    <?php if(module('login') OR module('newsflash') OR module('top')): ?>                            			
				<div id="header_container">
				    <div class="wrapper" id="header">  
						<?php if(module('top')): ?>
					    	<div id="top" >
					    		<?php echo loadModule('top', 'simple', null, null, false); ?> 
							</div> 
						<?php endif; ?>      
						<?php if(module('login')): ?>  
							<div class="wrapper">  
	 	   					   <div id="login_wrapper">
									<div class="login_open_wrap"> 						   </div>  
									   	<a id="login_open" <?php if(loggedIn()):?>class="logout"<?php endif;?>><?php if(loggedIn()):?>Member Logout <?php else: ?>Login / Register<?php endif; ?></a>         
		  
								</div>  
                              
								<div id="login_popup" style="display:none;">
                               <div class="logintopper"><h4>Login or Register</h4></div>
									<div id="login_left">  
			                            <?php echo loadModule('logintop', 'simple', null, null, false); ?>
							    		<?php echo loadModule('login', 'simple', null, null, false); ?>     
									</div>
                                     <div class="login_side"> 
                                     <?php echo loadModule('loginside', 'simple', null, null, false); ?> 
								</div>  </div>     
							</div>
						<?php endif;?>
						<?php if(module('newsflash')): ?>
					        <div id="newsflash_wrap">
						    	<?php echo loadModule('newsflash', null, null, null, false) ; ?> 
					        </div>     
						<?php endif; ?>
				    </div>
				</div>  
				 <!-- /END header_container -->     
			<?php endif; ?>    
			
			<div class="clearBoth"></div>
			<div id="main_container">
			    <div class="wrapper" id="main_wrap">
			    	<?php loadColumns($magic->tconfig->mainColumns, '983', true, null, '13', true); ?> 
			    </div>    
				<?php loadLayout('main', 'mods-cols-sets'); ?>
			</div>        
			 <!-- /END MAIN CONTAINER -->     
			
			<?php if(!modules($magic->tconfig->userMods20_23) AND modules(!$magic->tconfig->legalMods)): ?>
				<div id="cart_push"></div> 
			<?php endif; ?>
				
			<?php if(module('bottomone') OR module('bottomtwo')) : ?>  
				<?php loadLayout('main', 'cart') ;?> 
			<?php endif; ?>
		    
			<div id="bg_bottom"></div> 
<?php if(module('newsflash')): ?>
		</div> 
		 <!-- /END bg_wrap --> 
<?php endif; ?>       

	    <?php if(isAdmin() AND $magic->template->params->get( 'styleEditorEnable') == 'on'):?>
			<?php loadLayout('admin', 'base'); ?>
		<?php endif;  ?>    
		
	</body> 
</html>
<?php $magic->media->initMediaGZIP();  ?>              