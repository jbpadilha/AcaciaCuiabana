<?php  

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

// ------------------------------------------------------------------------

/**
 * A Minimum Core Config.  Used for Ajax requests when you don't need the full framework.
 *
 * @note Don't add any new variables to this file. The only ones available are the ones below.
 * 
 * Usage: define('MIN_MAGIC', true);    
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

class Min_Config
{              
	function Min_Config() { }     
	 
//____ Media Class Options
   
	var $mediaProcessCSS = false;
	var $mediaProcessJS  = true;
    var $mediaCacheTime = '0';
    var $mediaPreserveCSSComments = 1;

//____ Stuff To Load  
 
	var $enabled_core = array(); 
	var $enabled_libraries = array('admin');
    var $enabled_helpers = array(); 
	var $custom_template_files = array(); 
	var $enabled_admin_params = array();     
	var $enabled_filters = array();
	
	/*
	* Usually you don't want to disable unless there is conflict issues with Jquery 
	* already being loaded by a component, module, plugin etc. 
	* Jquery is needed if any of the frameworks JS features are used; tabs, accordions etc. 
	*/      
	var $jquery = false;         
}