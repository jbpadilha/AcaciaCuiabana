<?php $magic->admin->adminInit(); ?>
<div id="editor_sidebar_container">
	<div id="editor_sidebar">
		<div id="editor_sidebar_inner">  
			<div id="sidebar_accordion" class="accordion">  
				<h2 class="text pane_head"><span class="icon"></span><span class="title">Text</span></h2>
				<div class="pane text">    
				    <div class="scrollpane"> 
				     	<?php echo $magic->admin->getCSSAdmin(); ?>  
						<?php echo $magic->admin->printParamSet('Text'); ?>   
					</div>  
				</div>    
				<h2 class="styles pane_head"><span class="icon"></span><span class="title">Styles</span></h2>
				<div class="pane">          
					<div class="scrollpane"> 
						 <?php echo $magic->admin->printParamSet('Styling-Images'); ?>   
					</div>
				</div>
				<h2 class="layout pane_head"><span class="icon"></span><span class="title">Layout</span></h2>
				<div class="pane">
					<div class="scrollpane"> 
						<?php echo $magic->admin->printParamSet('Layout-Options'); ?>   
					</div>
				</div>        
				<h2 class="options pane_head"><span class="icon"></span><span class="title">Options</span></h2>
				<div class="pane">  
					<div class="scrollpane"> 
						<?php echo $magic->admin->printParamSet('Options'); ?> 
					</div> 
				</div>   
				<form>				
			    <?php echo $magic->admin->multiAdminFormClose(); ?>
			</div>
		</div>      
		<a href="#" id="editor_sidebar_toggle"> </a>     
	</div>  
</div>