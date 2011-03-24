<?php   

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

// ------------------------------------------------------------------------

/**
 * Creates A Color Input Field
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

class colorInput 
{   
    /**
     * Adds the Prerequisite JS for Color Inputs.
     * @note All Param constructors are pretty much only used for this purpose.
     *
     * @return void
     **/
	function colorInput()
	{
		$document =& JFactory::getDocument();  
		$colorJSpath = FRAMEWORKURLPATH . '/media/js/colorpicker/js/colorpicker.min.js';  
		$document->addScript($colorJSpath);        
		
		$colorCSSpath = FRAMEWORKURLPATH . '/media/js/colorpicker/css/colorpicker.css';  
		$document->addStyleSheet($colorCSSpath);
	}

// ------------------------------------------------------------------------

	/**
	 * Creates A Color Input Field
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
		<div class="param colorInput section">    
			<h3 class="heading"><?php echo $param->attributes()->label;?></h3>  
			<div class="option">
			   <div class="controls">  
				<div id="<?php echo $param->attributes()->name;?>" class="colorSelector"><div style="background-color: rgb(255, 255, 255);"></div></div>
				   <input class="colorInput" name="<?php echo $param->attributes()->name;?>" id="<?php echo $param->attributes()->name;?>" value="<?php echo $paramValue;?>" type="color"> 
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
	 * Creates The JS for a Color Param.
	 *  
	 * @param obj $param The Parameter Object
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
		jQuery('#<?php echo $param->attributes()->name; ?>').ColorPicker({
				onShow: function (colpkr) {
					jQuery(colpkr).fadeIn(500);
					return false;
				},
				onHide: function (colpkr) {
					jQuery(colpkr).fadeOut(500);
					return false;
				},
				onChange: function (hsb, hex, rgb) {
					jQuery('#<?php echo $param->attributes()->name; ?>').children('div').css('backgroundColor', '#' + hex);
					jQuery('#<?php echo $param->attributes()->name; ?>').next('input').attr('value','#' + hex);

					// Callback    
					<?php if(!$param->attributes()->affects == null): ?>
						jQuery('<?php echo $param->attributes()->affects; ?>').css('<?php echo $param->attributes()->changes; ?>', '#' + hex);
					<?php endif; ?>
				}
		 });
		<?php  
		$colorDeclare = ob_get_clean(); 
		$colorDeclare =  domReady($colorDeclare); 
		$document->addScriptDeclaration($colorDeclare); 
	}
	
}