<?php  

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );  

// ------------------------------------------------------------------------

/**
 * themeMagic jQuery Helpers.
 *
 *
 * @package		themeMagic
 * @subpackage	Helpers
 * @version		1.0 Beta. 
 * @author		Ken Erickson AKA Bookworm http://www.bookwormproductions.net
 * @copyright 	Copyright 2009 - 2010 DesignBreakDown
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2       
 * please visit the themeMagic site http://www.theme-magic.com  for support. 
 * Do not e-mail (or god forbid IM or call) me directly.
 *
 */

// ------------------------------------------------------------------------

/**
 * Wraps JS in document ready
 *
 * @param mixed $content the content top wrap it in.      
 *
 **/   
if(!function_exists('domReady'))
{
	function domReady($content)
	{   
		ob_start();
		?>
		jQuery.noConflict();
	  
		jQuery(document).ready(function($) {
			<?php echo $content;?>
		});   

		<?php
		return ob_get_clean();  
	}  
}  

// ------------------------------------------------------------------------
         
/**
 * Takes some plugin options and returns a jQueyr formatted settings object
 *
 * @param array $options An Array of Config options.      
 *
 **/      
if(!function_exists('jqOptions'))
{
	function jqOptions($options)
	{  
		ob_start();
		?>
		<?php $l = count($options);
	    foreach($options as $i => $option): ?> 
			<?php echo "$option:"; echo "' "; echo $option['config']; echo" '"; if (!$i == $l - 1) echo',';  ?>  
		<?php endforeach;?>  

		<?php
		return ob_get_clean();     
	}  
}