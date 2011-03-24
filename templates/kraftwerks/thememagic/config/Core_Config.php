<?php 

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

// ------------------------------------------------------------------------

/**
 * Core Config. 
 *
 * @note Don't add any new variables to this file. The only ones available are the ones below. 
 * @package		themeMagic
 * @subpackage  config
 * @version		1.0 Beta. 
 * @author		Ken Erickson AKA Bookworm http://www.bookwormproductions.net
 * @copyright 	Copyright 2009 - 2010 DesignBreakDown
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2       
 * please visit the themeMagic site http://www.theme-magic.com  for support. 
 * Do not e-mail (or god forbid IM or call) me directly.
 */          
class Core_Config
{   
	// Just Here Because Empty Constructors Prevent Others From Playing God           
	function Core_Config() { }    
	
	/**
	 * This Enables or Disables The Core Config Admin Bar which allows you to enable/disable core stuff
	 * from the frontend. 
	 * If this is enabled you can only enable or disable the config bar options using the config bar. 
	 * Changing them in the config php files will have no effect.
	 */      
	var $configBar = "enabled";  
	
//____ Media Class Options   
    var $mediaCacheTime = '60';
    var $mediaPreserveCSSComments = 1;

//____ Stuff To Load   

	var $enabled_core = array('Hooks'); 
	var $enabled_libraries = array('browser', 'joomla', 'admin', 'menu', 'media', 'Minify_CSS', 'Minify_JS');
    var $enabled_helpers = array('markup', 'classes', 'joomla', 'file', 'form', 'jquery', 'jsTools', 'string', 'columns', 'misc', 'array'); 
	var $custom_template_files = array('chromes', 'column-checks', 'template-logic', 'param-overRides'); 
	var $enabled_admin_params = array('textInput', 'textArea', 'fileSelect', 'colorInput', 'explodeArray', 'sizer', 'onOff', 'fontFamily', 'imgSelect');     
	var $enabled_filters = array('typography');           
	
	/**
	 * Usually you don't want to disable unless there is conflict issues with Jquery 
	 * already being loaded by a component, module, plugin etc. 
	 * Jquery is needed if any of the frameworks JS features are used; tabs, accordions etc.
	 * In most case initiating the media class should prevent conflicts but it is not full-proof. 
	 */      
	var $jquery = true;
	
	/**
	* Defines the available  Doctypes For The Doctype Helper.
	*/  
	var $doctypes = array(
		'xhtml11'		=> '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">',
		'xhtml1-strict'	=> '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">',
		'xhtml1-trans'	=> '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">',
		'xhtml1-frame'	=> '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">',
		'html5'			=> '<!DOCTYPE html>',
		'html4-strict'	=> '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">',
		'html4-trans'	=> '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">',
		'html4-frame'	=> '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">'   
	);    
}