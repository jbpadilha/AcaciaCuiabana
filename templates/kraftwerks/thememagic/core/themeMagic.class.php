<?php

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

// ------------------------------------------------------------------------

/**
 * The ThemeMagic Base Class.
 *
 * @note * 
 * Heres where all the magic happens.    
 * Handle with care and use gloves please.
 *    
 * @package		themeMagic
 * @subpackage  core
 * @version		1.0 Beta. 
 * @author		Ken Erickson AKA Bookworm http://www.bookwormproductions.net
 * @copyright 	Copyright 2009 - 2010 DesignBreakDown
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2       
 * please visit the themeMagic site http://www.theme-magic.com  for support. 
 * Do not e-mail (or god forbid IM or call) me directly.
 */    

class themeMagic Extends Base
{    
	/**
	 * Reference Variable for the Joomla! template
	 *
	 * @var $template
	 **/
	var $template;  
	
	// Template Paths
	var $template_path;
	var $directory_path;      
	
	// ThemeMagic Version Number
	var $versionNum = "1.0 Beta";
	 
	/**
	 * ThemeMagic Constructor
	 *
	 * @return void
	 **/
	function themeMagic(&$tmpl = null)
	{  
		/*
		 *  This is a reference to the Joomla! template object,
		 *  so it is available in magic. 
		 */      
	    $this->template =& $tmpl;      

		// Initialize Magic
		parent::Base();   
		$this->magic_initialize();          
	    $this->loadConfig();    	
	}              
	   
// ------------------------------------------------------------------------
	
	/**
	 * Initializes ThemeMagic. Instantiates all the classes, loads user files, loads helper etc etc
	 *
	 * @return void
	 **/
	function magic_initialize() 
	{    
	    // Intanstiate Loader class and Load Config 
		$this->load =& load_class('Loader');   
		if(!defined('MIN_MAGIC')) 
		{  
			if(defined('MYMAGIC_CONFIG')) { $this->core_config =& load_class(MYMAGIC_CONFIG, true, 'config');   }
            else { $this->core_config =& load_class('Core_Config', true, 'config');  }
		}  
		else { $this->core_config =& load_class('Min_Config', true, 'config'); }      
	   
   

		// Add Jquery  
		if($this->core_config->jquery == true AND !defined('MIN_MAGIC')) 
		{  
			// Add Jquery to Head
			$document =& JFactory::getDocument();  
			$jqueryPath = FRAMEWORKURLPATH . '/media/js/jquery.magic.min.js';  
			$document->addScript($jqueryPath);  

			// Add NoConflict To Avoid Conflicts With Other Libraries
		   	ob_start();
			?>
			jQuery.noConflict();
			<?php
			$jQueryNoConflictDeclare = ob_get_clean();
			$document->addScriptDeclaration($jQueryNoConflictDeclare); 
		}    

	    // Enable and Load all needed classes, libraries, helpers etc
	    foreach($this->core_config->enabled_core as $value) {       
			$this->$value =& load_class($value); 
		}  
		foreach($this->core_config->enabled_libraries as $value) {       
			$this->$value =& load_class($value, true, 'libraries'); 
		}      
		
		// Load The Helpers         
	    $this->load->helpers($this->core_config->enabled_helpers);
	   
	    // Load Custom User Functions
		if(!$this->core_config->custom_template_files == null)
		{
			$this->load->userFiles($this->core_config->custom_template_files);  
		}         
		
		// Load Admin Params
		foreach($this->core_config->enabled_admin_params as $value) 
		{   
			$path = FRAMEWORKPATH . '/admin/params/';    
			$this->admin->$value =& load_class($value, true, null, null, $path); 
		}  
		 
		// Load Filters
		foreach($this->core_config->enabled_filters as $value) 
		{   
			$path = FRAMEWORKPATH . '/filters/';    
			$this->filters->$value =& load_class($value, true, null, null, $path); 
		}   
		
		
	}       
	
// ------------------------------------------------------------------------

	/**
	 *  Loads A template Config File. Add Instantiates into the $magic->tconfig object.
	 *
	 * @return void
	 **/
	function loadConfig()    
	{   
		global $mainframe;
		
		// Joomla Template Values 
		$this->templateName = (string) $mainframe->getTemplate();
		$this->directory_path = JPATH_BASE . DS . 'templates' .  DS . $this->templateName; 
        $this->template_path = TEMPLATEURLPATH;

	    // Load The Template's Config and instanite a cool little object for it      
		$this->templateConfig = $this->templateName . '_Config';    
	    $this->tconfig =& load_class($this->templateConfig, true, 'config');  
	}        
	 
// ------------------------------------------------------------------------
	
	/**
	 * CCScaffold Initiation Function.
	 * @note CSScaffold will only initiate when this function is called otherwise its non-existent 
	 * and unavailable for use. It must be initialized somewhere in your template before it can be used.
	 *
	 * Usage: $magic->CSScaffoldInit($cssFile) . The path to css file is relative to media/css
	 *
	 * @return void
	 **/
	function CSScaffoldInit($cssFile)
	{   
		$this->CSScaffold =& load_class("CSScaffold", true, 'libraries', $cssFile);   
	}
	
}

