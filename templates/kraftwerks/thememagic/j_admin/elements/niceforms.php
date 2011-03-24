<?php         

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );   

// ------------------------------------------------------------------------

/**
 * A Parameter Interface for Loading NiceForms.  Niceforms www.emblematiq.com/lab/niceforms
 *                                              
 * @note 
 * Usage: Just add this to templateDetails.xml
 * <params addpath="/templates/magic/thememagic/j_admin/elements">  
 *     and 	
 * <param name="" type="niceforms" default=""/>
 *
 *
 *    
 * @package		themeMagic
 * @subpackage  config
 * @version		1.0 Beta. 
 * @author		Ken Erickson AKA Bookworm http://www.bookwormproductions.net
 * @copyright 	Copyright 2009 - 2010 DesignBreakDown
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2       
 * please visit the themeMagic site http://www.theme-magic.com  for support. 
 * Do not e-mail (or god forbid IM or call) me directly.
 *
 */
class JElementniceforms extends JElement 
{   
  
	function fetchElement($name, $value, &$node, $control_name)
	{
		$document =& JFactory::getDocument();      
	    global $mainframe;
	 
		$adminMediaPath  =  '../templates/magic/thememagic/j_admin/media/';
		$niceformsPath = $adminMediaPath . 'js/niceforms.js';  
		$niceformsCSSPath = $adminMediaPath . 'css/niceforms-default.css'; 
		
		$document->addScript($niceformsPath);  
		$document->addStyleSheet($niceformsCSSPath); 
	} 

}   





