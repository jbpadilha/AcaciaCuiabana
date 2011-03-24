<?php     

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

// ------------------------------------------------------------------------

/**
 * themeMagic Joomla! Helpers. These Functions interact and work with Joomla! Stuff.
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
 * Loads Modules From a Position
 *
 * @param string $moduleName Module Position to load modules from.
 * @param string $chrome The Chrome Function to Use. This is just a default and is over-ridden by suffix classes cfunc_chromeName
 * @param string $classCallBack This is userFunction called every time a module is loaded. 
 * The Class Returned is added to the module suffixes. Commonly used for even odd classes.
 * @param bool $inner add Inner Div Modules
 * @param string $innerClass Rhe class of the inner div      
 *
 * @return void       
 *
 **/
if(!function_exists('loadModule'))
{
	function loadModule($moduleName, $chrome = null, $class = null, $classCallback = null, $inner = true, $innerClass = 'modules', $modulesCSS = null, $moduleCSS = null, $raw = false)
	{   
		$magic =& get_instance();   
	    if(!module($moduleName)) return;
		$modules = magicModHelper::getModules($moduleName);
		
		$modulesCSS = "style=\"$modulesCSS\"";

	    if($raw == false) echo "<div id=\"$moduleName\" class=\"$class\" $modulesCSS >"; 
		if(!$inner == false) echo "<div class=\"$innerClass\">"  ; 
		if(!$chrome == null) $chrome = 'chrome_' . $chrome;   
		
		
		if($magic->admin->getCoreConfig('moduleTools') == 'true' AND isAdmin())  
		{
			echo '<div class="mod-details">';   
			ob_start(); 
			?>
			<div class="mod-details-position">[<?php echo $moduleName; ?>]</div>  
			<?php
			echo ob_get_clean();
		}	  
		  
		foreach($modules as $module)   
		{   
			$params = new JParameter($module->params);  
			$moduleClass = $params->get('moduleclass_sfx');

			if(!$classCallback == null)
			{   $previousID = $module->id - 1; 
				$currentID = $module->id;     
				$nextID = $module->id + 1;      
				$classCallbackArgs = array($currentID, $previousID, $nextID);
			    $moduleClass .= ' ' . call_user_func_array($classCallback, $classCallbackArgs); 
			}  

			if($module->content == null)  
			{
				$module->content = magicModHelper::renderModule($module); 
			}  
			
			$moduleClass = ' ' . $moduleClass;   
                    
			$callBackCheck = strrpos($moduleClass, "cfunc_");      
			if(!$callBackCheck == null)
			{    
				$chromeCallBackFunc = explode("cfunc_", $moduleClass);    
				$chromeCallBackFunc = explode(" ", $chromeCallBackFunc['1']); 
				$moduleClass = str_replace('cfunc_', ' ', $moduleClass);  
			}

			else 
			{
				$chromeCallBackFunc = null; 
			}      

			$chromeArgs = array($module, $params, $moduleClass, $moduleCSS);    

			if(!$chromeCallBackFunc == null) 
			{   
				$classFunc = 'chrome_' . $chromeCallBackFunc['0'];   
								   
	   			if(function_exists($classFunc))
				{   
					if($magic->admin->getCoreConfig('moduleTools') == 'true' and isAdmin())
					{
						echo $magic->joomla->moduleDetails($classFunc, $module, $params, $moduleClass, $moduleCSS);   
					}
					echo call_user_func_array($classFunc, $chromeArgs);   
				} 
				else 
				{  
		  			if($magic->admin->getCoreConfig('moduleTools') == 'true' and isAdmin())
					{
						echo $magic->joomla->moduleDetails($chrome, $module, $params, $moduleClass, $moduleCSS);   
					}     
				    echo $magic->joomla->moduleDefaultRender($module, $params, $moduleClass, $moduleCSS);
				} 
			} 

			else 
			{   
				if(!$chrome == null)
				{  
					if($magic->admin->getCoreConfig('moduleTools') == 'true' and isAdmin())
					{
						echo $magic->joomla->moduleDetails($chrome, $module, $params, $moduleClass, $moduleCSS);   
					}      
				    echo call_user_func_array($chrome, $chromeArgs);
				}   

				else
				{   
					if($magic->admin->getCoreConfig('moduleTools') == 'true' and isAdmin())
					{
						echo $magic->joomla->moduleDetails($chrome, $module, $params, $moduleClass, $moduleCSS);   
					}
					echo $magic->joomla->moduleDefaultRender($module, $params, $moduleClass, $moduleCSS);   
				}
			}

		}    


	    if($raw == false) echo "</div>";
		if(!$inner == false)  echo "</div>";  
		if($magic->admin->getCoreConfig('moduleTools') == 'true' and isAdmin())  
		{
			echo '</div>';  
		}    
	}  
}

// ------------------------------------------------------------------------       

/**
 * Checks if a module is published
 *
 * @return bool
 * 
 **/    
if(!function_exists('module'))
{
	function module($published)
	{  	
		$magic =& get_instance(); 
	    return $magic->template->countModules($published);       
	}  
} 

// ------------------------------------------------------------------------    
  
/**
 * Checks if any from array of modules is published
 *  
 * @param array $modules an array of modules. 
 * 
 * @return bool
 * 
 **/   
if(!function_exists('modules')) 
{
	function modules($modules) 
	{  
		if(is_array($modules))  
		{   
			foreach($modules as $key => $value) 
			{  
			   $publishCheck = module($modules[$key]['module']);
		       if($publishCheck == true) return true;
			}
			
			return false;  
		} 
	}  
}

// ------------------------------------------------------------------------    

/**
 * Removes Unpublished Modules from an array of modules. 
 * 
 * @param array $modules an array of modules. 
 * @return array
 * 
 **/  
if(!function_exists('cleanDisabledMods'))
{
	function cleanDisabledMods($modules)
	{   
		//Remove Any Unpublished Modules From Array 
	    if(is_array($modules))  {   
			foreach($modules as $key => $value) {  
			   $publishCheck = module($modules[$key]['module']);
			   if(!module($modules[$key]['module'])) {
					unset($modules[$key]);  
			   } 
			}  
		} 

		return $modules;
	}   
}  



// ------------------------------------------------------------------------    

/**
 * Loads a group of modules
 * 
 * @param array $modules a list of modules. Properties available module name, chrome, width, class and css    
 * @param int $parentWidth width of the parent item. 
 *   
 * @return void
 * 
 **/ 
if(!function_exists('loadModuleSet'))   
{
	function loadModuleSet($modules, $parentWidth, $inner = true, $loadModulesFunc = null, $raw = false, $sepWidth = null, $wrap = true, $wrapClass = null)
	{   
		
		if(count($modules) ==  1) { $sepWidth = null; }
		
	    if(is_array($modules))
		{  	
		   	// Setup the Modules array    
			$modules = cleanDisabledMods($modules);  
		    $modules = widthCalc($modules, $parentWidth, $sepWidth); 
		    $modules = cssSetter($modules, ' last-module-column', ' module-column');  
		   
	        if($wrap == true) echo "<div class=\"module-set $wrapClass\">"; 
			foreach($modules as $module) {   
	             if(isset($module['callFunc']))  
				 {  
					$loadModulesFunc = $module['callFunc']; 
					$modArgs = array($module, $inner);
					call_user_func($loadModulesFunc, $modArgs);        
			     } else {
						echo loadModule($module['module'], $module['chrome'], $module['class'], null, $inner, 'modules', $module['css'], null, $raw);  
	             }
			}    
			
			if($wrap == true) echo '</div>'; 
	        

		} else {
			return "Please Send a Modules array and parent width";
		}     

	} 
}
 
// ------------------------------------------------------------------------
    
/**
 * Loads the Component
 *
 * @return void      
 *
 **/   
if(!function_exists('component'))
{
	function component()
	{   
		$magic =& get_instance();

		ob_start();
		?>
			<div id="component-<?php echo $magic->joomla->currentComponent;?>">
				<jdoc:include type="component" />
			</div>   
		<?php
	    return ob_get_clean();
	}   
} 
  
// ------------------------------------------------------------------------
    
/**
 * Loads a Component OverRide;
 * 
 * @param obj    &$obj Reference to the $this obj.
 * @param string $themeName The name of the theme to get the over-ride from
 * @param string  
 * @return void   
 * 
 **/ 
if(!function_exists('loadComponentOverRide'))
{
	function loadComponentOverRide($themeName = null) 
	{
		$magic =& get_instance();   
		
		/* 
		 * We use backtrace to get the location that function is called on and to pass in the view object $this.
		 * I feel fearful using something named debug in production code so hopefully this has no issues 
		 * or security consequences.      
		 * 
		 **/
	    $trace = debug_backtrace(); 
	
		// Reference The Obj So We can pass it into files   
		$obj =& $trace[2]['object'];       
		
        
        // Get the Component Name 
        $componentName  = $trace[0]['file'];  
		$componentName = preg_match('/(?=)com_[\w]*/i', $componentName, $matches);
        $componentName = str_replace('.php', '', $matches[0]);   
        
        // Clean Path
        $cleanPath = BASEPATH . DS . 'html' . DS . $componentName; 
        $cleanPath = str_replace($cleanPath, '', $trace[0]['file']); 
        
        // Get the Components Theme   
        ${configThemeVar} = $componentName . 'Theme';   
        $configTheme = $magic->tconfig->{$configThemeVar};
	   
	    // Setup the Theme Name
        if(empty($configTheme)) 
		{
			if($themeName == null) 
			{
				if(empty($magic->tconfig->themeName)) 
				{
					$themeName = 'default';
				}   else { $themeName = $magic->tconfig->themeName; } 
			}
		}     
		
		else 
		{
			$themeName = $configTheme;
		}
        
	    $overRidePath = BASEPATH . DS . 'child_themes' . DS . $themeName . DS . 'components' . DS . $componentName .  $cleanPath;
	    include($overRidePath);
	}
} 

// ------------------------------------------------------------------------
    
/**
 * Loads a Template File.
 *
 * @param string $template The Name of The Template.
 * @param obj    &$obj Reference to the $this obj.  
 * @return void  
 *
 **/ 
if(!function_exists('loadTemplate'))
{
	function loadTemplate($template) 
	{   
		$magic =& get_instance();  
		   
		/* 
		 * We use backtrace to get the location that function is called on and to pass in the view object $this.
		 * I feel fearful using something named debug in production code so hopefully this has no issues 
		 * or security consequences.      
		 * 
		 **/
		$trace = debug_backtrace();
	    $path = dirname($trace[0]['file']);        
	    $obj =& $trace[4]['object'];  
	    $filePath = $path . '/'  . $template . '.php';
	
		ob_start();
	    include($filePath);
		$output = ob_get_contents();
		ob_end_clean();

		return $output; 
	}
}

// ------------------------------------------------------------------------
    
/**
 * Checks To See If a User is an Administrator
 *  
 * @return bool       
 *
 **/ 
if(!function_exists('isAdmin')) 
{
	function isAdmin()
	{
		$user =& JFactory::getUser();

		if($user->usertype == "Super Administrator") {
			return true;
		}
		else {
			return false;
		}  
	}
}    
  
// ------------------------------------------------------------------------
    
/**
 * Checks To See If Its the Homepage
 *  
 * @return bool 
 *
 **/ 
if(!function_exists('isHome')) 
{
	function isHome()
	{
		$menu = & JSite::getMenu();  

		if($menu->getActive() == $menu->getDefault()){
			return true;
		} else { return false; }
	}
}

// ------------------------------------------------------------------------
    
/**
 * Checks If a User is Logged In
 *  
 * @return bool 
 *
 **/ 
if(!function_exists('loggedIn')) 
{
	function loggedIn()
	{
		$user =& JFactory::getUser();

		if($user->id){
			return true;
		} else { return false; }
	}
}
