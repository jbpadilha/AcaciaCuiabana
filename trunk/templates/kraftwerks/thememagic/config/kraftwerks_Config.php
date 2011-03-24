<?php 
      
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

// ------------------------------------------------------------------------

/**
 * The Template's Config. The class should be named templatename_Config.   
 *
 * @note All but one variable(themeName) and the constructor are optional.  
 * if you need a variable available outside of the class abbreviate with $this and it will be available
 * in magic e.g $magic->tconfig->var 
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

class kraftwerks_Config 
{   
    // Required var for themeMagic to work
    var $themeName = 'default'; 

    // Vars Specific to kraftwekrs/template
    var $styles = array();
    var $js = array(); 
	var $menuStyle;
	var $flip5;
	var $wrapperWidth;     
	var $bodyClasses = array();

	/**
	 * Constructor Function. Gets a instance of magic and thats it.    
	 * 
	 * @note the config initialize call is not require use an functions. 
	 * even place all your config options 
	 * @return void
	 **/
	function kraftwerks_Config() 
	{  
	   // Make Magic Available to This file. Then init class.     
	   $this->magic =& get_instance();  
	   $this->config_init();
	
	}    
	
	function config_init() 
	{
		$this->js = array
		(
			'jquery.easing.min',   
			'superfish', 
			'jquery.lavalamp.min',  
			'jquery.form', 
			'scripts'
		);
        
		$this->styles = array
		(  
		);  
		
		
// ------------------------------------------------------------------------
/*
 * Template Params
 */	    
		// User Style Push
	    $userStyle = $this->magic->admin->getParam('styles');  
		$userStyle = str_replace('.css', '', $userStyle);   
		if(JRequest::getString('style')) {  
			$userStyle =  JRequest::getString('style');
		}
		$userStyle = 'styles/' . $userStyle;   
	    array_push($this->styles, $userStyle); 
		  
		// Menu Style Push
	    $menuStyle = $this->magic->admin->getParam('menustyles');  
		$menuStyle = str_replace('.css', '', $menuStyle);   
		$this->menuStyle = $menuStyle;
		$menuStyle = 'menus/' . $menuStyle;
		array_push($this->styles, $menuStyle);       
		
		// Menu Script Push  
		$menuScript = $this->magic->admin->getParam('menuscripts');  
		$menuScript = str_replace('.js', '', $menuScript);  
		$menuScript = 'menus/' . $menuScript;
		array_push($this->js, $menuScript);

		// Wrapper Width
		$this->wrapperWidth = (string) $this->magic->admin->getParam('wrapperwidth');     
		
		// User Five Width and User % Flip
		$this->flip5 =  (string) $this->magic->admin->getParam('userfiveflip'); 
		$this->user5width =  (string) $this->magic->admin->getParam('user5width');   
		  
		// Header Image
		$headerImg = $this->magic->admin->getParam('headerImg');
		$headerImgName = $headerImg['name'];  
		$this->headerImgName = str_replace('.jpg', '', $headerImgName);         
		     

// ------------------------------------------------------------------------                              
/*
 * Setup and Define The Columns    
 */      
        // Column Widths
        $leftColumnWidth = (string) $this->magic->admin->getParam('leftwidth');    
        $rightColumnWidth = (string) $this->magic->admin->getParam('rightwidth');       

		// Main Columns	  
		$this->leftColumn =  array( 'column' => 'col-left', 'class' => 'col-left', 'callback' => 'leftColCheck', 'width' => $leftColumnWidth);  
		$this->centerColumn = array( 'column' => 'col-center', 'class' => 'col-center', 'callback' => 'centerColCheck'); 
		$this->rightColumn =  array( 'column' => 'col-right', 'class' => 'col-right', 'callback' => 'rightColCheck', 'width' => $rightColumnWidth);  
		
		// We will pass this array into a column loader in base.php
		$this->mainColumns = array($this->leftColumn, $this->centerColumn, $this->rightColumn);   
		
		// User Columns	  
		$this->user5Column =  array( 'column' => 'col-user5', 'class' => 'col-left', 'callback' => 'user5ColCheck', 'width' => $this->user5width);  
		$this->userModsColumn = array( 'column' => 'col-usermods', 'class' => 'col-center', 'callback' => 'userModsColCheck'); 

		// We will pass this array into a column loader in base.php  
		if($this->flip5 == 'true')  {
			$this->userColumns = array($this->userModsColumn, $this->user5Column);
		} else {
			$this->userColumns = array($this->user5Column, $this->userModsColumn);
		}
		   
// ------------------------------------------------------------------------
/*
 * Setup and Define The Module Sets
 */          
		// User1 - User4    
		$user1 = array('module' => 'user1', 'chrome' => 'box', 'class' => 'user');
		$user2 = array('module' => 'user2', 'chrome' => 'box', 'class' => 'user');
		$user3 = array('module' => 'user3', 'chrome' => 'box', 'class' => 'user');
		$user4 = array('module' => 'user4', 'chrome' => 'box', 'class' => 'user');
		
		$this->userMods1_4 = array($user1, $user2, $user3, $user4);    
		
		// User6 - User8    
		$user6 = array('module' => 'user6', 'chrome' => 'box', 'class' => 'user');
		$user7 = array('module' => 'user7', 'chrome' => 'box', 'class' => 'user');
		$user8 = array('module' => 'user8', 'chrome' => 'box', 'class' => 'user');
		                            
		$this->userMods6_8 = array($user6, $user7, $user8); 
		
		// User9 - User11   
		$user9 = array('module' =>  'user9', 'chrome' => 'box', 'class' => 'user');
		$user10 = array('module' => 'user10', 'chrome' => 'box', 'class' => 'user');
		                                   
		$this->userMods9_10 = array($user9, $user10); 
		
		// User12 - User14    
		$user11 = array('module' => 'user11', 'chrome' => 'box', 'class' => 'user');
		$user12 = array('module' => 'user12', 'chrome' => 'box', 'class' => 'user');
		$user13 = array('module' => 'user13', 'chrome' => 'box', 'class' => 'user');
		$user14 = array('module' => 'user14', 'chrome' => 'box', 'class' => 'user');

		$this->userMods11_14 = array($user11, $user12, $user13, $user14);   
		
		// User15 - User19    
		$user15 = array('module' => 'user15', 'chrome' => 'simple', 'class' => 'user');
		$user16 = array('module' => 'user16', 'chrome' => 'simple', 'class' => 'user');
		$user17 = array('module' => 'user17', 'chrome' => 'simple', 'class' => 'user');
		$user18 = array('module' => 'user18', 'chrome' => 'simple', 'class' => 'user'); 
		$user19 = array('module' => 'user19', 'chrome' => 'simple', 'class' => 'user');
		
		$this->userMods15_19 = array($user15, $user16, $user17, $user18, $user19);       
		
		// User20 - User23    
		$user20 = array('module' => 'user20', 'chrome' => 'simple', 'class' => 'user');
		$user21 = array('module' => 'user21', 'chrome' => 'simple', 'class' => 'user');
		$user22 = array('module' => 'user22', 'chrome' => 'simple', 'class' => 'user');
		$user23 = array('module' => 'user23', 'chrome' => 'simple', 'class' => 'user'); 
		
		$this->userMods20_23 = array($user20, $user21, $user22, $user23); 
		
		// Legal Mods    
		$footer = array('module' => 'footer', 'chrome' => 'simple', 'width' => '700', 'class' => 'col-left');
		$legals = array('module' => 'legals', 'chrome' => 'simple', 'class' => 'col-right');
		
		$this->legalMods = array($footer, $legals);    
		
		if(module('user5'))  
		{
			$this->userModsWidth = 734; 			 
		} else { $this->userModsWidth =  $this->wrapperWidth; }    
 
// ------------------------------------------------------------------------
/*
 * Body Clases
 */       

	// Push Some Body Classes
	array_push($this->bodyClasses, $this->headerImgName);   
	array_push($this->bodyClasses, $this->menuStyle);      
	if(!module('login') AND !module('newsflash') AND !module('top')) 
	{
		array_push($this->bodyClasses, 'noHeader');      
	}   
	if(!module('newsflash'))   
	{	
		array_push($this->bodyClasses, 'noNewsflash');           
	}

// ------------------------------------------------------------------------
/*
 * Config Logic
 */   
		// Push The Admin Styles
		if(isAdmin())   
		{
			array_push($this->styles, 'admin/jScrollPane');   
			array_push($this->styles, 'admin/admin-style');   
			array_push($this->styles, 'admin/admin-elements'); 	
			array_push($this->js, 'admin/jquery.mousewheel');    
			array_push($this->js, 'admin/jquery.jscrollpane');    
			array_push($this->js, 'admin/admin');    
		}  
		
		// Push IE7 Styles
		if($this->magic->browser->getBrowser() == 'Internet Explorer' AND $this->magic->browser->getVersion() == 7)
		{   
			array_push($this->styles, 'IE7');   
		}   
				
		// The Components Excluded From Wrapping
		$this->excludedComs = array
		(
			'com_mtree',
			'com_community',
			'com_kunena',
			'com_seyret',
			'com_eventlist',
			'com_quickfaq',
			'com_adsmanager',
			'com_docman',
		);  
		
		// Show These On Frontpage No Matter What
		$this->excludedComsFront = array 
		(   
			'com_community',
			'com_virtuemart'
		);
	}
}
