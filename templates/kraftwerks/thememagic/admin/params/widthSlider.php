<?php  

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

// ------------------------------------------------------------------------

/**
 * Width Slider Parameter
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

class widthSlider
{    
	
	/**
     * Adds the Prerequisite JS for Color Inputs.
     * @note All Param constructors are pretty much only used for this purpose.
     *
     * @return void
     **/
	function widthSlider()
	{
		$document =& JFactory::getDocument();  
		$dependJSpath = FRAMEWORKURLPATH . '/media/js/jslider/js/jquery.dependClass.js';  
		$document->addScript($dependJSpath);     
		
		$jsliderJSpath = FRAMEWORKURLPATH . '/media/js/jslider/js/jquery.slider-min.js';  
		$document->addScript($jsliderJSpath);    
		
		$jsliderCSSpath = FRAMEWORKURLPATH . '/media/js/jslider/css/jslider.css';  
		$document->addStyleSheet($jsliderCSSpath);
	}    
	
// ------------------------------------------------------------------------
  
	/**
	 * Creates A Width Slider
	 *
	 * @return void                              
	 **/
	function create($param)
	{    
		// Setup the Params Default Value.
	    if(empty($param->value))
		{ 
			$paramValue = $param->attributes()->default;  
		} else { $paramValue = $param->value; }  
		
		  
		$this->_createJS($param, $paramValue);

		ob_start();
		?>        
		<div class="param <?php echo $param->attributes()->name;?> widthSlider section">    
			<h3 class="heading"><?php echo $param->attributes()->label;?></h3>  
			<div class="option">
			   <div class="controls">    
			      <input id="<?php echo $param->attributes()->name; ?>" class="slider" type="slider" name="<?php echo $param->attributes()->name; ?>" value="<?php echo $paramValue; ?>" />
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
	 * Generates JS for the width slider
	 *
	 * @return void                              
	 **/ 
	function _createJS($param, $paramValue)
	{
		$document =& JFactory::getDocument();  
	
		ob_start();
		?>
		jQuery("input.slider#<?php echo $param->attributes()->name;?>").slider({ 
			from: 5, to: 960, 
			step: 10, 
			round: 1, 
			dimension: 'px',   
			onstatechange: function( value ){   
				if(value != <?php echo $paramValue; ?>)  
				{
					<?php if(!$param->attributes()->steal == null): ?>
						var currentWidth = jQuery("<?php echo $param->attributes()->steal; ?>").width();  
						var realValue = value - <?php echo $paramValue; ?>;
						var newWidth = currentWidth - realValue;    
						jQuery("<?php echo $param->attributes()->steal; ?>").width(newWidth);					
					<?php endif; ?>   
				}  
		  }
		});   
		<?php  
		$widthSliderDeclare = ob_get_clean(); 
		$widthSliderDeclare =  domReady($widthSliderDeclare); 
		$document->addScriptDeclaration($widthSliderDeclare);
	}
}