<?php 

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 

// ------------------------------------------------------------------------

/**
 * Font Family Parameter
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

class fontFamily
{                    
	
	// Declaring a empty contructor is like praying a hedge of protection only much more effective.
	function fontFamily() { }
	
	/**
	 * Creates A Font Family Select List
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
		 
		$cssAdminConfigPath = FRAMEWORKPATH . DS . 'config' . DS . 'CSS_Config.php';    
		require($cssAdminConfigPath);      
		
		$fontsList = $cssFontFamilies;
		
		 
		ob_start();
		?>        
		<div class="param fontFamily section">    
			<h3 class="heading"><?php echo $param->attributes()->label;?></h3>  
			<div class="option">
			   <div class="controls">     
				   <?php echo formDropdown($param->attributes()->name, $fontsList, $paramValue); ?>    
			   </div>      
			   <div class="explain">    
					<?php echo $param->description; ?>
				</div>
			</div>
		</div>
		<?php
		echo ob_get_clean();
	} 
}