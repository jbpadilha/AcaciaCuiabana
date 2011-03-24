<?php 

// ------------------------------------------------------------------------

/** 
 *
 * The base class for all the plugins          
 * 
 * @note The CSScaffold in themeMagic is a port/re-imagining of CSScaffold (http://wiki.github.com/anthonyshort/csscaffold/) 
 * by Anthony Short   
 *    
 * @package		themeMagic
 * @subpackage  config
 * @version		1.0 Beta.  
 * @author		Ken Erickson AKA Bookworm http://www.bookwormproductions.net
 * @copyright 	Copyright 2009 - 2010 DesignBreakDown   
 *
 * @author Anthony Short http://www.anthonyshort.com.au     
 * @copyright Copyright 2010 Anthony Short
 *
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2       
 * please visit the themeMagic site http://www.theme-magic.com  for support. 
 * Do not e-mail (or god forbid IM or call) me directly.
 *
 */   
class CSScaffold_Plugins
{
	/**
	 * Place any importing here. This will happen
	 * before everything else. 
	 */
	public static function importProcess() {}

	/**
	 * For any preprocessing of the css. Arranging the css,
	 * stripping comments.. etc.
	 */
	public static function preProcess() {}
	
	/**
	 * The main grunt of the processing of the css string
	 */
	public static function process() {}
	
	/**
	 * For formatters, compressors and prettifiers
	 */
	public static function postProcess() {}

	/**
	 * For formatters, compressors and prettifiers
	 */
	public static function formattingProcess() {}
	
	/**
	 * For loading views and display a page other than the CSS
	 */
	public static function output() {}
	
	/**
	 * Loads a library
	 */
	public static function loadLibrary($library) 
	{
		//require_once();
	}

}