<?php

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );  

// ------------------------------------------------------------------------

/**
 * Text Area Parameter
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

class textArea
{     
	
	// Declaring a empty contructor keeps people out, like a big fracking gicantic wall, well, a wall with guns.
	function textArea() { }
	
	/**
	 * Creates A Text Area
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
		$data = array(    
			 'name'   => "$param->attributes()->name",
			 'value'  => "$paramValue",
			 'rows'   => '8',
             'cols'   => '8'
		);   
		
		ob_start();
		?>        
		<div class="param textArea section">    
			<h3 class="heading"><?php echo $param->attributes()->label;?></h3>  
			<div class="option">
			   <div class="controls">   
				   <?php echo formTextarea($data);  ?>
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