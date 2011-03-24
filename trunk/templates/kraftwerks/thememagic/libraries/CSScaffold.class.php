<?php    

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 

// ------------------------------------------------------------------------

/**
 * CSScaffold Core and Initiation class.
 *              
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
 */

// Load The Plugins and Config
require FRAMEWORKPATH . '/libraries/CSScaffold/Plugins.php';     
$configpath =  FRAMEWORKPATH . '/config/CSScaffold_Config.php';    
require $configpath; 

define('SCAFFOLDPATH', FRAMEWORKPATH . DS . 'libraries' . DS . 'CSScaffold');    

//  Set the docroot  
$document_root = $_SERVER['DOCUMENT_ROOT'];    
define('DOCROOT', str_replace('\\', '/', $document_root). '/');     
define('CSScAFOLDCONFIG', $configpath);
require FRAMEWORKPATH . '/libraries/CSScaffold/CSS.php';

class CSScaffold
{
	/**
	 * The configuration settings
	 */     
	
	private static $configuration;
	
	var $cachedFile; 
	
	/**
	 * Modules
	 */
	protected static $modules = array
	(
		'Constants',
		'Expression',
		'Import',
		'Iteration',
		'Mixins',
		'NestedSelectors',
		'Layout'
	);
	
	/**
	 * Plugins that are installed
	 */
	public static $plugins = array();    
	
	var $includePaths;  
	
// ------------------------------------------------------------------------ 
	
	/**
	 * Constructor Function
	 *
	 * @return void
	 **/   
	function CSScaffold($cssfile)   
	{   
		// Lets get some instances
		$magic =& get_instance();  
		$document =& JFactory::getDocument();
		
		// CSS File Paths
		$cssfilepath = MEDIAPATH . '/css/' . $cssfile;  
		$cssfileurl =  MEDIAURLPATH . '/css/' . $cssfile;       
		
		/**
		 * Before We Go through Anything lets check if we are in dev mode 
		 * If We aren't then we need to get the file and exit.
		 */ 
		$cacheDir = MEDIAPATH . DS . '/css/cache';     
		
		if($magic->admin->getCoreConfig('cssProcess') == 'true' OR $magic->admin->getCoreConfig('cssProcess') == 'false')
		{
			$IN_DEVELOPMENT = (bool) $magic->admin->getCoreConfig('cssProcess');
		} else { $IN_DEVELOPMENT = IN_DEVELOPMENT; }
		
		if($IN_DEVELOPMENT == false) 
		{
			$cacheFileName = mostRecentFile($cacheDir); 
			$cacheFileURL  =  MEDIAURLPATH . '/css/cache/' . $cacheFileName . '.css';
			$doc->addStyleSheet($cacheFileURL);
			return;   
		}      
	   
		# Set the recache to true if needed		
		if(self::config('core.always_recache') OR isset($url_params['recache']))
			$recache = true;
		
		# Set it back to false if it's locked
		if(self::config('core.cache_lock') === true)
			$recache = false;

		# Load the modules.
		self::loadAddons(self::$modules, 'modules'); 
		      
		if(file_exists($cssfilepath)) 
		{
		  if (!isCSS($cssfilepath)) die('Not a CSS file');
		
		} else { die( 'CSScaffold CSS File Does not Exist, Please check the file you\'re passing in' ); }   
		                                 
	    chdir(dirname($cssfilepath));       
	
		# Load the CSS file into the object
	    CSS::load(file_get_contents($cssfilepath));     
	   
		$this->parseCSS();   
		$this->_outputCSS();      
	}   

// ------------------------------------------------------------------------ 
	 
	/**
	 * Loads modules and plugins
	 *
	 * @param $addons An array of addon names
	 * @param $type The type of addon to load.
	 * @return void
	 */
	function loadAddons($addons, $type = 'modules')  
	{   
		
		$directory  = SCAFFOLDPATH . DS . $type;
		foreach($addons as $addon)
		{
			// The addon folder
			$folder = realpath(joinPath($directory, $addon));  
			
			// The controller for the plugin (Optional)
			$controller = joinPath($folder,$addon. '.php');

			// Include the addon controller
			if(file_exists($controller))
			{
				require_once($controller);
			}
		}    
	} 
	  
// ------------------------------------------------------------------------ 
	
	/**
	 * Parse the CSS
	 *
	 * @return string - The processes css file as a string  
	 **/
	function parseCSS()
	{						
		# Compress it before parsing
		CSS::compress(CSS::$css);
					
		# Import CSS files
		Import::parse();   
	
	   	if(self::config('core.auto_include_mixins') === true)
		{
			# Import the mixins in the plugin/module folders
			Mixins::import_mixins('framework/mixins');
		}       
		
		# Parse our css through the plugins
		foreach(self::$plugins as $plugin)
		{
			call_user_func(array($plugin,'import_process'));
		}
		
		# Compress it before parsing
		CSS::compress(CSS::$css);   
		
		# Parse the constants
		Constants::parse();

		foreach(self::$plugins as $plugin)
		{
			call_user_func(array($plugin,'pre_process'));
		}
		
		# Parse the @grid
		Layout::parse_grid();
		
		# Replace the constants
		Constants::replace();
		
		# Parse @for loops
		Iteration::parse();
		
		foreach(self::$plugins as $plugin)
		{
			call_user_func(array($plugin,'process'));
		}
		
		# Compress it before parsing
		CSS::compress(CSS::$css);
		
		# Parse the mixins
		Mixins::parse();
		
		# Find missing constants
		Constants::replace();
		
		# Compress it before parsing
		CSS::compress(CSS::$css);
		
		foreach(self::$plugins as $plugin)
		{
			call_user_func(array($plugin,'post_process'));
		}
		
		# Parse the expressions
		Expression::parse();
		
		# Parse the nested selectors
		NestedSelectors::parse();
		
		# Convert all url()'s to absolute paths if required
		if(self::config('core.absolute_urls') === true)
		{
			CSS::convert_to_absolute_urls();
		}
		
		# Replaces url()'s that start with ~ to lead to the CSS directory
		CSS::replace_css_urls();
		
		# Add the extra string we've been storing
		CSS::$css .= CSS::$append;
		
		CSS::pretty();
		
		# Formatting hook
		foreach(self::$plugins as $plugin)
		{
			call_user_func(array($plugin,'formatting_process'));
		}
	}
	
// ------------------------------------------------------------------------ 
	
	/**
	 * Get a config item or group.
	 *
	 * @param   string   item name
	 * @param   boolean  force a forward slash (/) at the end of the item
	 * @param   boolean  is the item required?
	 * @return  mixed
	 */
	function config($key, $slash = FALSE, $required = FALSE)
	{
		if (self::$configuration === NULL)
		{
			// Load core configuration
			self::$configuration['core'] = self::configLoad('core');
	  
		}

		// Get the group name from the key
		$group = explode('.', $key, 2);
		$group = $group[0];

		if ( ! isset(self::$configuration[$group]))
		{
			// Load the configuration group
			self::$configuration[$group] = self::configLoad($group, $required);
		}

		// Get the value of the key string
		$value = keyString(self::$configuration, $key);

		if ($slash === TRUE AND is_string($value) AND $value !== '')
		{
			// Force the value to end with "/"
			$value = rtrim($value, '/').'/';
		}

		return $value;
	}  
	  
// ------------------------------------------------------------------------ 
	
	/**
	 * Clears a config group from the cached configuration.
	 *
	 * @param   string  config group
	 * @return  void
	 */
	public static function configClear($group)
	{
		// Remove the group from config
		unset(self::$configuration[$group], self::$internal_cache['configuration'][$group]);
	}
        
// ------------------------------------------------------------------------ 

	/**
	 * Load a config file.
	 *
	 * @param   string   config filename, without extension
	 * @param   boolean  is the file required?
	 * @return  array
	 */
	public static function configLoad($name, $required = TRUE)
	{
		if ($name === 'core')
		{
			// Load the application configuration file
			require CSScAFOLDCONFIG;

			if ( ! isset($config['cache_lock']))
			{
				// Invalid config file
				die('Your configuration file is not valid.');
			}

			return $config;
		}

		if (isset(self::$internal_cache['configuration'][$name]))
			return self::$internal_cache['configuration'][$name];

		// Load matching configs
		$configuration = array();


		return self::$internal_cache['configuration'][$name] = $configuration;
	}
	   
// ------------------------------------------------------------------------ 
	
	/**
	 * Sets a configuration item, if allowed.
	 *
	 * @param   string   config key string
	 * @param   string   config value
	 * @return  boolean
	 */
	public static function configSet($key, $value)
	{
		// Do this to make sure that the config array is already loaded
		self::config($key);

		// Convert dot-noted key string to an array
		$keys = explode('.', $key);

		// Used for recursion
		$conf =& self::$configuration;
		$last = count($keys) - 1;

		foreach ($keys as $i => $k)
		{
			if ($i === $last)
			{
				$conf[$k] = $value;
			}
			else
			{
				$conf =& $conf[$k];
			}
		}
		
		if ($key === 'core.modules' OR $key === 'core.plugins')
		{
		  
		}

		return TRUE;
	}   
	     
// ------------------------------------------------------------------------ 
	
	/**
	 * Outputs The CSS to a File
	 *
	 * @return void                    
	 **/
	function _outputCSS()
	{     
		$magic =& get_instance();
		$doc  =& JFactory::getDocument();      
		
		jimport('joomla.filesystem.file');
	    
		
		$cacheDir = getcwd() . DS . 'cache';
		$md5sum = md5(CSS::$css); 
		$cacheFileName = 'css-' . $md5sum; 
		$cacheFilePath  = $cacheDir . DS . $cacheFileName . '.css';
		$cacheFileURL  =  MEDIAURLPATH . '/css/cache/' . $cacheFileName . '.css';
		
		if(file_exists($cacheFilePath))
		{    			
			 $doc->addStyleSheet($cacheFileURL);
		} 
		
		else 
		{     
			$outfile = CSS::$css;
			JFile::write($cacheFilePath, $outfile);  
			$doc->addStyleSheet($cacheFileURL);
		}
	}    
}   