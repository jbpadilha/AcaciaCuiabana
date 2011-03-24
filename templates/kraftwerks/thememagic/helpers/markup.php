<?php

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 

// ------------------------------------------------------------------------

/**
 * themeMagic Markup Helpers for working with markup. Adds JS, CSS, create links etc.
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

/**
 * Loads a Layout . Basically a quick include function
 *
 * @return void
 * 
 **/     
if(!function_exists('loadLayout'))    
{
	function loadLayout($layoutType, $layoutName, $themeName = null)  
	{   
	    $magic =& get_instance();  

	   	if($themeName == null) 
		{
			if(empty($magic->tconfig->themeName)) 
			{
				$themeName = 'default';
			}   else { $themeName = $magic->tconfig->themeName; } 
		}  

		$layout = BASEPATH . '/child_themes/' . $themeName . '/layouts/' . $layoutType . '/' . $layoutName;
		include(''.$layout.'.php') ;    
	} 
}
   
// ------------------------------------------------------------------------ 

/**
 * Adds a stylesheet or stylesheets to Joomla! Head 
 * 
 * @param mixed $fileName Name of the file or files to add.
 * @param string $cssPath Optional path to the file. Defaults to media/css
 * @return void
 * 
 **/ 
if(!function_exists('css'))  
{
	function css($fileName, $cssPath = null) 
	{    
		$magic =& get_instance(); 
		$document =& JFactory::getDocument(); 

		if(is_array($fileName)){   
			foreach($fileName as $style) 
			{  
			   if(is_array($style))    
				{
						$cssPath = $magic->template_path . '/media/css/' . $style['path'] . '/' . $style['style'] . '.css';
					    $document->addStyleSheet($cssPath);
				}   

				else {
				   $cssPath = $magic->template_path . '/media/css/' . $style . '.css';         
				   $document->addStyleSheet($cssPath);
				}

			}
		}

		else 
		{
			if($cssPath == null) $cssPath = $magic->template_path . '/media/css/' . $fileName . '.css'; 
		    $document->addStyleSheet($cssPath);

		}
	}   
}

// ------------------------------------------------------------------------ 

/**
 * Adds a script or scripts to Joomla! Head 
 * 
 * @param mixed $fileName Name of the file or files to add.
 * @param string $jsPath Optional path to the file. Defaults to media/js
 * @return void
 * 
 **/  
if(!function_exists('js')) 
{
	function js($fileName, $jsPath = null) 
	{    
		// Lets get some instances
		$magic =& get_instance();  
		$document =& JFactory::getDocument();

		if(is_array($fileName)){   
			foreach($fileName as $js) 
			{  
				$jsPath = $magic->template_path . '/media/js/' . $js . '.js'; 
			    $document->addScript($jsPath);
			}
		}

		else 
		{
			if($jsPath == null)  $jsPath = $magic->template_path . '/media/js/' . $fileName . '.js'; 
		    $document->addScript($jsPath);
		}
	} 
}

// ------------------------------------------------------------------------ 

/**
 * Cufon Helper Functions
 * 
 * @param string $font Name of the font to use 
 * @param mixed  $selectors CSS Selector or CSS Selectors to add the font to.
 * @param array  $options Options to pass to the script.
 * @param string $fontPath Optional path to the file. Defaults to media/fonts
 * @return void
 * 
 **/  
if(!function_exists('cufon'))
{
	function cufon($font, $selectors, $options = array(), $fontPath = null)
	{   
		// Lets get some instances
		$magic =& get_instance();  
		$document =& JFactory::getDocument();   

		if(!is_array($selectors))
		{
			$selectors = array($selectors);
		} 


		$fontPath = $magic->template_path . '/media/fonts/' . $font . '.font.js'; 
		$cufonPath = $magic->template_path . '/thememagic' . '/media/js/' . 'cufon.min.js'; 
	    $document->addScript($cufonPath); 
		$document->addScript($fontPath);


		ob_start();
		?>
		Cufon.replace('<?php foreach($selectors as $selector)
		{
		  echo $selector . ',';  
		}?>', { fontFamily: '<?php echo $font;?>' }
		<?php if(!$options == null) 
		{
			foreach($options as $option)
			{ 
				echo ",{
						$option\['option']\: '$option\['value']\'
					}"; 
			}  
		}?> 	
		 );
		<?php         

	    $cufonDeclare = ob_get_clean();  
		$document->addScriptDeclaration($cufonDeclare);     
	}   
}

// ------------------------------------------------------------------------

/**
 * Unordered List
 *
 * Generates an HTML unordered list from an single or multi-dimensional array.
 *
 * @access	public
 * @param	array
 * @param	mixed
 * @return	string 
 *
 */
if (!function_exists('ul'))
{
	function ul($list, $attributes = '')
	{
		return _list('ul', $list, $attributes);
	}
}

// ------------------------------------------------------------------------

/**
 * Ordered List
 *
 * Generates an HTML ordered list from an single or multi-dimensional array.
 *
 * @access	public
 * @param	array
 * @param	mixed
 * @return	string 
 * 
 */
if (!function_exists('ol'))
{
	function ol($list, $attributes = '')
	{
		return _list('ol', $list, $attributes);
	}
}

// ------------------------------------------------------------------------

/**
 * Generates the list
 *
 * Generates an HTML ordered list from an single or multi-dimensional array.
 *
 * @access	private
 * @param	string
 * @param	mixed
 * @param	mixed
 * @param	intiger
 * @return	string      
 *
 */
if (!function_exists('_list'))
{
	function _list($type = 'ul', $list, $attributes = '', $depth = 0)
	{
		// If an array wasn't submitted there's nothing to do...
		if (!is_array($list))
		{
			return $list;
		}

		// Set the indentation based on the depth
		$out = str_repeat(" ", $depth);

		// Were any attributes submitted?  If so generate a string
		if (is_array($attributes))
		{
			$atts = '';
			foreach ($attributes as $key => $val)
			{
				$atts .= ' ' . $key . '="' . $val . '"';
			}
			$attributes = $atts;
		}

		// Write the opening list tag
		$out .= "<".$type.$attributes.">\n";

		// Cycle through the list elements.  If an array is
		// encountered we will recursively call _list()

		static $_last_list_item = '';
		foreach ($list as $key => $val)
		{
			$_last_list_item = $key;

			$out .= str_repeat(" ", $depth + 2);
			$out .= "<li>";

			if (!is_array($val))
			{
				$out .= $val;
			}
			else
			{
				$out .= $_last_list_item."\n";
				$out .= _list($type, $val, '', $depth + 4);
				$out .= str_repeat(" ", $depth + 2);
			}

			$out .= "</li>\n";
		}

		// Set the indentation for the closing tag
		$out .= str_repeat(" ", $depth);

		// Write the closing list tag
		$out .= "</".$type.">\n";

		return $out;
	}
}

// ------------------------------------------------------------------------

/**
 * Generates HTML BR tags based on number supplied
 *
 * @access	public
 * @param	integer
 * @return	string   
 *
 */
if (!function_exists('br'))
{
	function br($num = 1)
	{
		return str_repeat("<br />", $num);
	}
}

// ------------------------------------------------------------------------

/**
 * Doctype
 *
 * Generates a page document type declaration
 *
 * Valid options are xhtml-11, xhtml-strict, xhtml-trans, xhtml-frame,
 * html4-strict, html4-trans, and html4-frame.  Values are saved in the
 * doctypes config file.
 *
 * @access	public
 * @param	string	type	The doctype to be generated
 * @return	string   
 *
 */
if (!function_exists('doctype'))
{
	function doctype($type = 'xhtml1-strict')
	{
		global $_doctypes;

		if (!is_array($_doctypes))
		{
			if (!require_once(FRAMEWORKPATH.'/config/doctypes.php'))
			{
				return false;
			}
		}

		if (isset($_doctypes[$type]))
		{
			return $_doctypes[$type];
		}
		else
		{
			return false;
		}
	}
}

// ------------------------------------------------------------------------

/**
 * Generates meta tags from an array of key/values
 *
 * @access	public
 * @param	array
 * @return	string  
 *
 */
if (!function_exists('meta'))
{
	function meta($name = '', $content = '', $type = 'name', $newline = "\n")
	{
		// Since we allow the data to be passes as a string, a simple array
		// or a multidimensional one, we need to do a little prepping.
		if (!is_array($name))
		{
			$name = array(array('name' => $name, 'content' => $content, 'type' => $type, 'newline' => $newline));
		}
		else
		{
			// Turn single array into multidimensional
			if (isset($name['name']))
			{
				$name = array($name);
			}
		}

		$str = '';
		foreach ($name as $meta)
		{
			$type 		= (!isset($meta['type']) OR $meta['type'] == 'name') ? 'name' : 'http-equiv';
			$name 		= (!isset($meta['name'])) 	? '' 	: $meta['name'];
			$content	= (!isset($meta['content']))	? '' 	: $meta['content'];
			$newline	= (!isset($meta['newline']))	? "\n"	: $meta['newline'];

			$str .= '<meta '.$type.'="'.$name.'" content="'.$content.'" />'.$newline;
		}

		return $str;
	}
}

// ------------------------------------------------------------------------

/**
 * Generates non-breaking space entities based on number supplied
 *
 * @access	public
 * @param	integer
 * @return	string  
 *
 */
if (!function_exists('nbs'))
{
	function nbs($num = 1)
	{
		return str_repeat("&nbsp;", $num);
	}
}   


// ------------------------------------------------------------------------ 

/**
 * Returns a Powered By Link to themeMagic.
 * 
 * @return void
 * 
 **/
if(!function_exists('poweredBy')) 
{  
	function poweredBy($about = true)
	{
		ob_start();
		?>
		<p class="powered_by">Powered By <a href="http://www.theme-magic.com">ThemeMagic</a> <?php if($about == true): ?>, a Joomla! template framework<?php endif;?></p> 
		<?php 
		echo ob_get_clean();
	}
}
  


