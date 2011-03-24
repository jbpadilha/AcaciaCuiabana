<?php      

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

// ------------------------------------------------------------------------

/**
 * Explode Data Into Array Parameter
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

class explodeArray
{    
	// Declaring a empty contructor keeps others from exploding this param. #lamepun 
	function explodeArray() { }
	
	/**
	 * Creates A Text Field That is Exploded when you get it
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
		  
		// Setup The Form Input Attributes
		$data = array(    
			 'name'   => "$param->attributes()->name",
			 'value'  => "$paramValue"
		);    
		
		ob_start();
		?>        
		<div class="param textInput explodeArray section">    
			<h3 class="heading"><?php echo $param->attributes()->label;?></h3>  
			<div class="option">
			   <div class="controls">     
				   <?php echo formInput($data);  ?>
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
	 * Explodes The Text into a array
	 *
	 * @return array
	 **/
	function get($param)
	{    
		$pieces = explode(",", $param->value); 
		return $pieces; 
	} 
}