<?php if(modules($magic->tconfig->userMods1_4)) : ?>
    <div class="wrapper userModColumnWrap" id="usermMods1-4">
    	<?php echo loadModuleSet($magic->tconfig->userMods1_4, $magic->tconfig->wrapperWidth, false, null, false, '13', true); ?>     
    </div>            
<?php endif; ?>  
<div id="userColumns"class="wrapper userModColumnWrap">   
	<?php loadColumns($magic->tconfig->userColumns, $magic->tconfig->wrapperWidth, true, null, '13'); ?>    
</div>   
<?php if(modules($magic->tconfig->userMods11_14)): ?>  
	<div id="userMods11-14" class="wrapper userModColumnWrap">
		<?php echo loadModuleSet($magic->tconfig->userMods11_14, $magic->tconfig->wrapperWidth, false,  null, false, '13', true); ?>
	</div>
<?php endif; ?>
<?php if(modules($magic->tconfig->userMods15_19)): ?>     
	<div id="userMods15-19" class="wrapper userModColumnWrap">    
		<?php echo loadModuleSet($magic->tconfig->userMods15_19, '957', false,  null, false, '13', true); ?>      
	</div>
<?php endif;?> 
<?php if(modules($magic->tconfig->userMods20_23) OR modules($magic->tconfig->legalMods)): ?>
	<div id="bottom_bg">   
		<?php if(modules($magic->tconfig->userMods20_23)): ?>
			<div id="userMods20-23" class="wrapper userModColumnWrap">    
				<?php echo loadModuleSet($magic->tconfig->userMods20_23, $magic->tconfig->wrapperWidth, false,  null, false, '13', true); ?>      
			</div>        
		<?php endif;?>          
		<?php if(modules($magic->tconfig->legalMods)): ?>    
			<div id="legalMods" class="wrapper userModColumnWrap">
				<?php echo loadModuleSet($magic->tconfig->legalMods, $magic->tconfig->wrapperWidth, false,  null, false, '13', true); ?>     
			</div>       
		<?php endif; ?>  
		</div>   
	</div>  
<?php endif; ?>  
	