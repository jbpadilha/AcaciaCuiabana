<?php

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

// ------------------------------------------------------------------------

/**
 * Loader Class.
 *
 * @note 
 * Basically a bunch of fancy schmancy (I have no idea how to speel that) include functions. 
 * On a side note I hate it when a spell correction becomes a ticket for a Open Source Project
 * It takes more time to make the ticket than to just correct it. 
 * It should fall under DRY; to make the ticket you have to correct the spelling error and then correct once again to fix it.
 *    
 * @package		themeMagic
 * @subpackage  core
 * @version		1.0 Beta. 
 * @author		Ken Erickson AKA Bookworm http://www.bookwormproductions.net
 * @copyright 	Copyright 2009 - 2010 DesignBreakDown
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2       
 * please visit the themeMagic site http://www.theme-magic.com  for support. 
 * Do not e-mail (or god forbid IM or call) me directly.
 *
 */
class Loader 
{   
	// Just here to prevent Instantiation. Think of it like a bureaucract.
	function Loader() { }   
	
// ------------------------------------------------------------------------
	
	/**
	 * Include the helpers. 
	 * 
	 * @param array $helpers Array of Helper files to load.
	 * @return void
	 **/
	function helper($helpers = array())
	{  
		$filePath =  FRAMEWORKPATH . '/helpers/';
		$this->loadFiles($helpers, $filePath);                                
	}   
	   
// ------------------------------------------------------------------------
	
	/**
	 * Plural Reference to helper
	 * 
	 * @param array $helpers Array of Helper files to load.
	 * @return void
	 **/
	function helpers($helpers = array())
	{
		$this->helper($helpers);  
	}    
	
 // ------------------------------------------------------------------------
	  
	/**
	 * Loads the files from the template. Used for Chrome functions, Hooks etc.
	 * 
	 * @param array $userFiles Array of files to load.
	 * @return void
	 **/
	function userFile($userFiles = array())
	{
		$filePath =  BASEPATH . '/template_files/';
		$this->loadFiles($userFiles, $filePath); 
	}   

// ------------------------------------------------------------------------

	/**
	 * Plural Reference to userFile
	 * 
	 * @param array $userFiles Array of files to load.
	 * @return void
	 **/
	function userFiles($userFiles = array())
	{
		$this->userFile($userFiles);  
	}    
	  
// ------------------------------------------------------------------------
	
	/**
	 * The fancy include function everything else in this class.
	 * just passes into this function
	 * 
	 * @param array $files Array of files to load.
	 * @param string $filePath The location of the files.
	 * @return void
	 **/
	function loadFiles($files = array(), $filePath)
	{    
		                               
		if (!is_array($files))
		{
			$files = array($files);
		}
		
		foreach ($files as $file)
		{		
			include_once($filePath .$file.'.php');
		}  
	}
}