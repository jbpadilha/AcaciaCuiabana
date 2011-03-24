<?php echo loadModule('inset', 'box', null, null, false) ;
	$currentCom = $magic->joomla->currentComponent;
?> 

<?php if(isFrontPage()): ?>                                                                                         
	<?php if(in_array($currentCom, $magic->tconfig->excludedComs)): ?>   
		<?php echo component(); ?>    
	<?php else: ?>           
		<div class="box component <?php echo $currentCom;?>">
			<div class="box_left_title">  
				<div class="box_right_title"> 
					<?php $pagetitle = explode(" ", $magic->joomla->pageTitle, 2); ?>
					<h1 class="pagetitle"><span class="first_word"><?php echo $pagetitle[0]; ?> </span><span class="rest"><?php echo $pagetitle[1]; ?></span></h1>   
				</div>
			</div> 
			<div class="box_content_left">   
				<div class="box_content_right">      
					<?php echo component(); ?>   
				</div>
			</div>   
			<div class="box_footer_left"><div class="box_footer_right"></div> </div>
		</div>
	<?php endif; ?>   
<?php endif; ?>