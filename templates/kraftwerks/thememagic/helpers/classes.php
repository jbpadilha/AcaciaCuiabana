<?php   

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );     

// ------------------------------------------------------------------------

/**
 * Class Helpers. 
 * @note These Functions help you work with Joomla! page and component classes.
 *
 * @package		themeMagic
 * @subpackage	Helpers
 * @version		1.0 Beta. 
 * @author		Ken Erickson AKA Bookworm http://www.bookwormproductions.net
 * @copyright 	Copyright 2009 - 2010 DesignBreakDown
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2       
 * please visit the themeMagic site http://www.theme-magic.com  for support. 
 * Do not e-mail (or god forbid IM or call) me directly.
 */

// ------------------------------------------------------------------------ 

/**
 * BodyClass Function
 * 
 * @param mixed $bodyClass a extra body or body classes
 * @return string
 **/ 
if(!function_exists('bodyClass')) 
{
	function bodyClass($bodyClass = null) 
	{  
		global $mainframe;
		$magic =& get_instance();
		$params =& $mainframe->getParams();   
		$pageclass = $params->get('pageclass_sfx'); 
		$pageclass .= ' ' .JRequest::getVar('option');   
		
		// Push Classes From Template Config Into the Body Class Array
		if(isset($magic->tconfig->bodyClasses) AND is_array($magic->tconfig->bodyClasses))
		{   
			foreach($magic->tconfig->bodyClasses as $val) {
				$pageclass .= ' ' . $val;
			}
		}     

		// Push Passed Classes Into the Body Class Array 
		if ($bodyClass) 
		{                
			if(!is_array($bodyClass)) $bodyClasses = array($bodyClass);
			foreach($bodyClasses2 as $bodyClass) {
			    $pageclass .= ' ' . $bodyClass;
			}  	
		}     
		
	    $browser = strtolower($magic->browser->getBrowser());   
		$pageclass .=  ' ' . $browser;
		return $pageclass;  
	}  
}