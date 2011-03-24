<?php 

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 

// ------------------------------------------------------------------------

/**
 * On Off Field Parameter
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

class onOff
{                    
	
	/**
	 * Adds The On Off JS And Styling  
	 * @return void
	 */
	function onOff() 
	{       
		$document =& JFactory::getDocument();  
	}
	
	/**
	 * Creates A On Off Field
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
		
		
		// Setup Form Attributes      
	    $paramName = $param->attributes()->name;   
	   
		$this->_genJS($param, $paramValue);
		 
		ob_start();
		?>        
		<div class="param onOff section">    
			<h3 class="heading"><?php echo $param->attributes()->label;?></h3>  
			<div class="option">
			   <div class="controls">     
				  	<div id="radio-wrap-<?php echo $paramName;?>">
						<label for="<?php echo $paramName;?>-radio" class="on-off-radio"><span class='label'><?php echo $param->attributes()->label;?>:</span>
							<input type="radio" value="<?php echo $paramValue;?> " name="" id="<?php echo $paramName;?>-radio" class="on-off-radio">
						</label>   
					</div>  
					<input type="hidden" value="<?php echo $paramValue;?> " name="<?php echo $paramName;?>" id="<?php echo $paramName;?>" class="actual-value">
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
	 * Adds Some Radio JS for a On Off Button 
	 *
	 * @param mixed $param The Param Object
	 * @param string $paramValue The Params Value
	 * @return void
	 **/
	function _genJS($param, $paramValue)
	{   
		$document =& JFactory::getDocument();  

		// Reverse The Bool Setting Value for stupid jQuery plugin          
		if($paramValue == 'false') $paramValue2 = '1';
		else { $paramValue2 = '0'; }         

		ob_start();     
		?>
			jQuery("#radio-wrap-<?php echo $param->attributes()->name;?>").j3ssw({
			                index:<?php echo $paramValue2;?>,
							status:<?php echo $paramValue;?>,
							def:"def-radio", 
							off:"down-radio", 
							on:"up-radio",
							mode:2,
							callback:listener_<?php echo $param->attributes()->name;?>
		    });   
			function listener_<?php echo $param->attributes()->name;?>(selection, status, id, j3ssw){  
				jQuery('input#<?php echo $param->attributes()->name;?>').val(status);
			}          
		<?php  
	   	$paramDeclare = ob_get_clean(); 
		$paramDeclare =  domReady($paramDeclare); 
		$document->addScriptDeclaration($paramDeclare);    
	}   
}