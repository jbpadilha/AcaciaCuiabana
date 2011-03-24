<?php

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

// ------------------------------------------------------------------------

/**
 * Menu Class. Just Generates A Menu. Most of the cool stuff happens in the over-ride.
 *
 *    
 * @package		themeMagic
 * @subpackage  libraries
 * @version		1.0 Beta. 
 * @author		Ken Erickson AKA Bookworm http://www.bookwormproductions.net
 * @copyright 	Copyright 2009 - 2010 DesignBreakDown     
 *
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2       
 * please visit the themeMagic site http://www.theme-magic.com  for support. 
 * Do not e-mail (or god forbid IM or call) me directly.
 *
 */
class menu 
{        
	/**  
	 * Menu Creation Function.
	 *
	 * @param string $menuType Specify the type of Joomla! Menu. e.g MainMenu.
	 * @param string $menuName The name of the menu to render    
	 * @param string $type The type of menu to render. Refers to markup and not Joomla! Menu Type.
	 * Options; Dropdown. More options coming soon.      
	 * @param string $menuClass A class to add to the menu. Optional.
	 * @param string $menuTheme Theme To Pull From The LWIS CSS Menu Framework Files. Optional 
	 * This also serves to enable the LWIS menu framework which by default is not added.
	 * @param string $menuThemeFiles Array of Files To Add With Menu Optional and Not Suggested.
	 * @param bool $customTheme Enable or Disable A Custom Theme. Must be structured like a LWIS theme.
	 * @param string $themeName The name the child theme that it should for the custom theme in.
	 */
	function createMenu($menuType, $menuName, $type = 'dropdown', $menuClass = null, $menuTheme = null, $menuThemeFiles = null, $customTheme = false, $themeName = null, $menuID = null)
	{ 
		jimport( 'joomla.application.module.helper' );
		$magic =& get_instance();  
		$document =& JFactory::getDocument();       
				      
		if($type == 'dropdown')
		{   
			
			if(!$menuTheme == null)
			{
				if($themeName == null) 
				{
					if(empty($magic->tconfig->themeName)) 
					{
						$themeName = 'default';
					}   else { $themeName = $magic->tconfig->themeName; } 
				}     
		
				$dropDownFilePath = $magic->template_path . '/thememagic' . '/media/css/dropdown/';
				$dropDownFileCheckPath = FRAMEWORKPATH . '/media/css/dropdown/';  
		   
		  
				if($customTheme == false)
				{
					$themeBasePath = $magic->template_path . '/thememagic' . '/media/css/dropdown/themes/' . $menuTheme . '/'; 
				}
		
				else {
					$themeBasePath = $magic->template_path . '/child_themes/' . $themeName .  '/media/css/dropdown/themes/' . $menuTheme . '/';   
				}  
		
				if(!is_array($menuThemeFiles)) $menuThemeFiles = array($menuThemeFiles);
		
				foreach($menuThemeFiles as $menuThemeFile)       
				{    
					$dropDownFileCheckPath =  $dropDownFileCheckPath  . $menuThemeFile . '.css';
					$dropDownFilePath = $dropDownFilePath . $menuThemeFile . '.css';
					if(file_exists($dropDownFileCheckPath)) 
					{  
						$document->addStyleSheet($dropDownFilePath);   
				
					}   
					else 
					{ 
						$menuThemeFilePath = $themeBasePath . $menuThemeFile . '.css'; 
						$document->addStyleSheet($menuThemeFilePath);  
					}

				}  
			}      
		      
		    $renderer	= $document->loadRenderer( 'module' ); 
			$menu = magicModHelper::getModule($menuType, $menuName);
			$menuParams = new JParameter( $menu->params );      
			$menuClass = $menuClass . ' ' . $menuParams->get( 'class_sfx' ); 
			$menuId = $menuID . ' ' . $menuParams->get( 'tag_id' );
		    $menu->params = "showAllChildren=1\ntag_id=" . $menuID . "\nclass_sfx=" . ' dropdown ' . $menuClass;
		    $attribs['style'] = 'raw';                                                                          
		    echo $renderer->render($menu, $attribs);                                                            
		}                                                                                                       
		                                                                                                        
		else                                                                                                    
		{                                                                                                       
		    $renderer	= $document->loadRenderer( 'module' );                                                  
			$menu = magicModHelper::getModule($menuType, $menuName);                                            
			$menuParams = new JParameter( $menu->params );                                                      
			$menuClass = $menuClass . ' ' . $menuParams->get( 'class_sfx' );                                    
			$menuId = $menuID . ' ' . $menuParams->get( 'tag_id' );                                             
		    $menu->params = "showAllChildren=1\ntag_id=" . $menuID . "\nclass_sfx=" . ' dropdown ' . $menuClass;
		    $attribs['style'] = 'raw';            
		    echo $renderer->render($menu, $attribs); 
		}
		 
	}
}