<?php   

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

// ------------------------------------------------------------------------

/**
 * Creates A Re-sizer.  Good For font Re-size fields.
 *    
 * @package		themeMagic
 * @subpackage  admin.params
 * @version		1.0 Beta. 
 * @author		Ken Erickson AKA Bookworm http://www.bookwormproductions.net
 * @copyright 	Copyright 2009 - 2010 DesignBreakDown
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2       
 * please visit the themeMagic site http://www.theme-magic.com  for support. 
 * Do not e-mail (or god forbid IM or call) me directly.
 */ 

class sizer
{   
    /**
     * Empty Constructor For Now
     *
     * @return void
     **/
	function sizer() { }

// ------------------------------------------------------------------------

	/**
	 * Creates A Sizer Field. 
	 *  
	 * @param obj $param The Parameter Object
	 * @return void
	 **/
	function create($param)
	{   
		// Setup the Params Default Value.
	    if(empty($param->value))
		{ 
			$paramValue = $param->attributes()->default;  
		} else { $paramValue = $param->value; }
		
		// Generate Some Unique Js For the Param   
		$this->_createJS($param, $paramValue);
		
		ob_start();
		?>        
		<div class="param sizer section">    
			<h3 class="heading"><?php echo $param->attributes()->label;?></h3>  
			<div class="option">
			   <div class="controls">  
				<div id="<?php echo $param->attributes()->name;?>" class="sizer">
				    <input class="sizer" name="<?php echo $param->attributes()->name;?>" id="input-<?php echo $param->attributes()->name;?>" value="<?php echo $paramValue;?>">
					<a class="increase" href="#">+</a><a class="decrease" href="#">-</a> 
				</div>
			   </div>      
			   <div class="explain">    
					<?php echo $param->description; ?>
			   </div>
			</div>
		</div>
		<?php
		echo ob_get_clean();
	} 
	
// ------------------------------------------------------------------------

	/**
	 * Creates The JS for a Sizer Param
	 *  
	 * @param obj $param The Parameter Object 
	 * @param string $paramValue The Params Current Value
	 * @return void
	 **/  
	function _createJS($param, $paramValue)
	{   
		$document =& JFactory::getDocument();  
		
		ob_start();
		?>       
		    <?php if(!$param->attributes()->affects == null): ?>
		     	jQuery('<?php echo $param->attributes()->affects; ?>').css('<?php echo $param->attributes()->changes; ?>', '<?php echo $paramValue;?>');
			<?php endif; ?>    
			jQuery("#<?php echo $param->attributes()->name;?> a.increase").click(function() {  
			     var size = jQuery('#<?php echo $param->attributes()->name;?> input.sizer').val(); 
			     if(size == null) 
				 {
					size = jQuery('<?php echo $param->attributes()->affects; ?>').css('<?php echo $param->attributes()->changes; ?>');
				 }  
			     var newSize = parseInt(size.replace(/px/, "")) + 1;
			     jQuery('<?php echo $param->attributes()->affects; ?>').css("<?php echo $param->attributes()->changes; ?>", newSize + "px");  
			     jQuery('#<?php echo $param->attributes()->name;?> input.sizer').val(newSize + 'px');
			});
			jQuery("#<?php echo $param->attributes()->name;?> a.decrease").click(function() {
			     var size = jQuery('#<?php echo $param->attributes()->name;?> input.sizer').val();
			     var newSize = parseInt(size.replace(/px/, "")) - 1;
			     jQuery('<?php echo $param->attributes()->affects; ?>').css("<?php echo $param->attributes()->changes; ?>", newSize + "px");  
			     jQuery('#<?php echo $param->attributes()->name;?> input.sizer').val(newSize + 'px');
			});  
		<?php  
		$sizerDeclare = ob_get_clean(); 
		$sizerDeclare =  domReady($sizerDeclare); 
		$document->addScriptDeclaration($sizerDeclare); 
	}
	
}