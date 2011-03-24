<div class="clearBoth"></div>
<div id="cart_wrap">
	<div id="cart">
	  <div class="wrapper">
	    <span id="kraftwerks-bottom-panel-toggler"></span>
		    <div id="kraftwerks-wrap-l">
					<?php if(module('bottomone')) : ?>
					<?php echo loadModule('bottomone', 'simple', null, null, false) ; ?>
					<?php endif; ?>   
		    </div>    
		    <div id="kraftwerks-wrap-r">
			    <?php if(module('bottomtwo')) : ?>  							
					<?php echo loadModule('bottomtwo', 'simple', null, null, false) ; ?>
				 <?php endif; ?>
		    </div>    
	  </div>
	</div>       
</div>