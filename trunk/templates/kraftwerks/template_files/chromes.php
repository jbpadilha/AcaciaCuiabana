<?php 

function chrome_simple($module, &$params, $moduleClass, $moduleCSS = null)
{    
  	if(!$moduleCSS == null) $moduleCSS = "style=\"$moduleCSS\"";
	ob_start();
	?>  
		<div class="simple module <?php echo $moduleClass;?>" <?php echo $moduleCSS; ?>>
			<?php if ($module->showtitle != 0) : ?>
				<?php $modtitle = explode(" ", $module->title, 2); ?>
				<h3 class="modtitle">	  	
					<span class="first_word">
					<?php  
						if(!empty($modtitle[0])) { echo $modtitle[0];  }
						else { echo $module->title; }    
					?> 
					</span><span class="rest"><?php if(!empty($modtitle[1])) echo $modtitle[1]; ?></span>  
				</h3>
			<?php endif; ?>              
			<div class="module_content">
				<?php echo $module->content; ?>   
			</div>
		</div>   
	<?php
    return ob_get_clean();    
}    

function chrome_box($module, &$params, $moduleClass, $moduleCSS = null)
{    
  	if(!$moduleCSS == null) $moduleCSS = "style=\"$moduleCSS\"";
	ob_start();
	?>  
		<div class="box module <?php echo $moduleClass;?>" <?php echo $moduleCSS; ?>>
		<?php if ($module->showtitle != 0) : ?>  
			<div class="box_left_title">  
				<div class="box_right_title"> 
					<?php $modtitle = explode(" ", $module->title, 2); ?>
					<h3 class="modtitle">
						<span class="first_word">
						<?php  
							if(!empty($modtitle[0])) { echo $modtitle[0];  }
							else { echo $module->title; }    
						?> 
						</span><span class="rest"><?php if(!empty($modtitle[1])) echo $modtitle[1]; ?></span></h3>   
				</div>
			</div> 
		<?php endif; ?>     
			<div class="box_content_left">   
				<div class="box_content_right">      
					<?php echo $module->content; ?>  
				</div>
			</div>   
			<div class="box_footer_left"><div class="box_footer_right"></div> </div>
		</div>
	<?php
    return ob_get_clean();    
}    


function chrome_flip($module, &$params, $moduleClass, $moduleCSS = null)
{    
  	if(!$moduleCSS == null) $moduleCSS = "style=\"$moduleCSS\"";
	ob_start();
	?>  
		<div class="box flipped module <?php echo $moduleClass;?>" <?php echo $moduleCSS; ?>>    
			<div class="box_left_title">  
				<div class="box_right_title"> 
				</div>
			</div>
			<div class="box_content_left">   
				<div class="box_content_right">      
					<?php echo $module->content; ?>  
				</div>
			</div> 
			<?php if ($module->showtitle != 0) : ?>
				<div class="box_footer_left"><div class="box_footer_right">  
				<?php $modtitle = explode(" ", $module->title, 2); ?>
				<h3 class="modtitle">	  	
					<span class="first_word">
					<?php  
						if(!empty($modtitle[0])) { echo $modtitle[0];  }
						else { echo $module->title; }    
					?> 
					</span><span class="rest"><?php if(!empty($modtitle[1])) echo $modtitle[1]; ?></span>  
				</h3></div> </div>     
			<?php endif; ?> 
		</div>   
	<?php
    return ob_get_clean();    
}     



