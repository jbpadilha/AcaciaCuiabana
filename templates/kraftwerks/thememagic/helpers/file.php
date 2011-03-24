<?php 

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

// ------------------------------------------------------------------------

/**
 * themeMagic File Helpers. Functions for working with files. 
 *
 * @note Those familiar with the Joomla! fromework are probably concerned as to why these are even here.
 * Why not use the JFile class? Well this is to maintain as much as possible platform agnosticism.
 * themeMagic is being ported to other platforms and I don't want the file helper functions to contain platform specific calls.
 * Trying to be as loosely coupled as possible.
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
 * Delete Files
 *
 * Deletes all files contained in the supplied directory path.
 * Files must be writable or owned by the system in order to be deleted.
 * If the second parameter is set to true, any directories contained
 * within the supplied base directory will be nuked as well.
 *
 * @access	public
 * @param	string	path to file
 * @param	bool	whether to delete any directories found in the path
 * @return	bool 
 *
 */	
if (!function_exists('deleteFiles'))
{
	function deleteFiles($path, $del_dir = false, $level = 0)
	{	
		// Trim the trailing slash
		$path = rtrim($path, DIRECTORY_SEPARATOR);
			
		if ( ! $current_dir = @opendir($path))
			return;
	
		while(false !== ($filename = @readdir($current_dir)))
		{
			if ($filename != "." and $filename != "..")
			{
				if (is_dir($path.DIRECTORY_SEPARATOR.$filename))
				{
					// Ignore empty folders
					if (substr($filename, 0, 1) != '.')
					{
						deleteFiles($path.DIRECTORY_SEPARATOR.$filename, $del_dir, $level + 1);
					}				
				}
				else
				{
					unlink($path.DIRECTORY_SEPARATOR.$filename);
				}
			}
		}
		@closedir($current_dir);
	
		if ($del_dir == true AND $level > 0)
		{
			@rmdir($path);
		}
	}
}

// ------------------------------------------------------------------------

/**
 * Get Filenames
 *
 * Reads the specified directory and builds an array containing the filenames.  
 * Any sub-folders contained within the specified path are read as well.
 *
 * @access	public
 * @param	string	path to source
 * @param	bool	whether to include the path as part of the filename
 * @param	bool	internal variable to determine recursion status - do not use in calls
 * @return	array     
 *
 */	
if ( ! function_exists('getFilenames'))
{
	function getFilenames($source_dir, $include_path = false, $_recursion = false)
	{
		static $_filedata = array();
				
		if ($fp = @opendir($source_dir))
		{
			// reset the array and make sure $source_dir has a trailing slash on the initial call
			if ($_recursion === false)
			{
				$_filedata = array();
				$source_dir = rtrim(realpath($source_dir), DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR;
			}
			
			while (false !== ($file = readdir($fp)))
			{
				if (@is_dir($source_dir.$file) && strncmp($file, '.', 1) !== 0)
				{
					 getFilenames($source_dir.$file.DIRECTORY_SEPARATOR, $include_path, true);
				}
				elseif (strncmp($file, '.', 1) !== 0)
				{
					$_filedata[] = ($include_path == true) ? $source_dir.$file : $file;
				}
			}
			return $_filedata;
		}
		else
		{
			return false;
		}
	}
}

// --------------------------------------------------------------------

/**
 * Get Directory File Information
 *
 * Reads the specified directory and builds an array containing the filenames,  
 * filesize, dates, and permissions
 *
 * Any sub-folders contained within the specified path are read as well.
 *
 * @access	public
 * @param	string	path to source
 * @param	bool	whether to include the path as part of the filename
 * @param	bool	internal variable to determine recursion status - do not use in calls
 * @return	array 
 *
 */	
if (!function_exists('getDirFileInfo'))
{
	function getDirFileInfo($source_dir, $include_path = false, $_recursion = false)
	{
		static $_filedata = array();
		$relative_path = $source_dir;

		if ($fp = @opendir($source_dir))
		{
			// reset the array and make sure $source_dir has a trailing slash on the initial call
			if ($_recursion === false)
			{
				$_filedata = array();
				$source_dir = rtrim(realpath($source_dir), DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR;
			}

			while (false !== ($file = readdir($fp)))
			{
				if (@is_dir($source_dir.$file) && strncmp($file, '.', 1) !== 0)
				{
					 getDirFileInfo($source_dir.$file.DIRECTORY_SEPARATOR, $include_path, true);
				}
				elseif (strncmp($file, '.', 1) !== 0)
				{
					$_filedata[$file] = getDirFileInfo($source_dir.$file);
					$_filedata[$file]['relative_path'] = $relative_path;
				}
			}
			return $_filedata;
		}
		else
		{
			return false;
		}
	}
}

// --------------------------------------------------------------------

/**
* Get File Info
*
* Given a file and path, returns the name, path, size, date modified
* Second parameter allows you to explicitly declare what information you want returned
* Options are: name, server_path, size, date, readable, writable, executable, fileperms
* Returns false if the file cannot be found.
*
* @access	public
* @param	string	path to file
* @param	mixed	array or comma separated string of information returned
* @return	array      
*
*/
if (!function_exists('getFileInfo'))
{
	function getFileInfo($file, $returned_values = array('name', 'server_path', 'size', 'date'))
	{

		if ( ! file_exists($file))
		{
			return false;
		}

		if (is_string($returned_values))
		{
			$returned_values = explode(',', $returned_values);
		}

		foreach ($returned_values as $key)
		{
			switch ($key)
			{
				case 'name':
					$fileinfo['name'] = substr(strrchr($file, DIRECTORY_SEPARATOR), 1);
					break;
				case 'server_path':
					$fileinfo['server_path'] = $file;
					break;
				case 'size':
					$fileinfo['size'] = filesize($file);
					break;
				case 'date':
					$fileinfo['date'] = filectime($file);
					break;
				case 'readable':
					$fileinfo['readable'] = is_readable($file);
					break;
				case 'writable':
					// There are known problems using is_weritable on IIS.  It may not be reliable - consider fileperms()
					$fileinfo['writable'] = is_writable($file);
					break;
				case 'executable':
					$fileinfo['executable'] = is_executable($file);
					break;
				case 'fileperms':
					$fileinfo['fileperms'] = fileperms($file);
					break;
			}
		}

		return $fileinfo;
	}
}

// --------------------------------------------------------------------

/**
 * Get Mime by Extension
 *
 * Translates a file extension into a mime type based on config/mimes.php. 
 * Returns false if it can't determine the type, or open the mime config file
 *
 * Note: this is NOT an accurate way of determining file mime types, and is here strictly as a convenience
 * It should NOT be trusted, and should certainly NOT be used for security
 *
 * @access	public
 * @param	string	path to file
 * @return	mixed    
 *
 */	
if (!function_exists('getMimeByExtension'))
{
	function getMimeByExtension($file)
	{
		$extension = substr(strrchr($file, '.'), 1);

		global $mimes;

		if ( ! is_array($mimes))
		{
			if ( ! require_once(FRAMEWORKPATH.'/config/mimes.php'))
			{
				return false;
			}
		}

		if (array_key_exists($extension, $mimes))
		{
			if (is_array($mimes[$extension]))
			{
				// Multiple mime types, just give the first one
				return current($mimes[$extension]);
			}
			else
			{
				return $mimes[$extension];
			}
		}
		else
		{
			return false;
		}
	}
}

// --------------------------------------------------------------------

/**
 * Symbolic Permissions
 *
 * Takes a numeric value representing a file's permissions and returns
 * standard symbolic notation representing that value
 *
 * @access	public
 * @param	int
 * @return	string 
 *
 */	
if (!function_exists('symbolicPermissions'))
{
	function symbolicPermissions($perms)
	{	
		if (($perms & 0xC000) == 0xC000)
		{
			$symbolic = 's'; // Socket
		}
		elseif (($perms & 0xA000) == 0xA000)
		{
			$symbolic = 'l'; // Symbolic Link
		}
		elseif (($perms & 0x8000) == 0x8000)
		{
			$symbolic = '-'; // Regular
		}
		elseif (($perms & 0x6000) == 0x6000)
		{
			$symbolic = 'b'; // Block special
		}
		elseif (($perms & 0x4000) == 0x4000)
		{
			$symbolic = 'd'; // Directory
		}
		elseif (($perms & 0x2000) == 0x2000)
		{
			$symbolic = 'c'; // Character special
		}
		elseif (($perms & 0x1000) == 0x1000)
		{
			$symbolic = 'p'; // FIFO pipe
		}
		else
		{
			$symbolic = 'u'; // Unknown
		}

		// Owner
		$symbolic .= (($perms & 0x0100) ? 'r' : '-');
		$symbolic .= (($perms & 0x0080) ? 'w' : '-');
		$symbolic .= (($perms & 0x0040) ? (($perms & 0x0800) ? 's' : 'x' ) : (($perms & 0x0800) ? 'S' : '-'));

		// Group
		$symbolic .= (($perms & 0x0020) ? 'r' : '-');
		$symbolic .= (($perms & 0x0010) ? 'w' : '-');
		$symbolic .= (($perms & 0x0008) ? (($perms & 0x0400) ? 's' : 'x' ) : (($perms & 0x0400) ? 'S' : '-'));

		// World
		$symbolic .= (($perms & 0x0004) ? 'r' : '-');
		$symbolic .= (($perms & 0x0002) ? 'w' : '-');
		$symbolic .= (($perms & 0x0001) ? (($perms & 0x0200) ? 't' : 'x' ) : (($perms & 0x0200) ? 'T' : '-'));

		return $symbolic;		
	}
}

// --------------------------------------------------------------------

/**
 * Octal Permissions
 *
 * Takes a numeric value representing a file's permissions and returns
 * a three character string representing the file's octal permissions
 *
 * @access	public
 * @param	int
 * @return	string     
 *
 */	
if ( ! function_exists('octalPermissions'))
{
	function octalPermissions($perms)
	{
		return substr(sprintf('%o', $perms), -3);
	}
}   

// --------------------------------------------------------------------

/**
 * Checks if a file is an image.
 *
 * @param $path string
 *
 */     
if(!function_exists('isImage'))  
{
	function isImage($path)
	{
		if (array_search(extension($path), array('gif', 'jpg', 'jpeg', 'png')))
		{
			return true;
		}
		else
		{
			return false;
		}
	}  
}

// --------------------------------------------------------------------

/**
 * Checks if a file is css.
 *
 * @param $path string   
 *
 */	   
if(!function_exists('isCSS'))
{
	function isCSS($path)
	{
		return (extension($path) == 'css') ? true : false;
	}  
}  

// --------------------------------------------------------------------

/**
 * Outputs a filesize in a human readable format
 *
 * @param $val The filesize in bytes
 * @param $round   
 *
 */         
if(!function_exists('readableSize'))   
{
	function readableSize($val, $round = 0)
	{
		$unit = array('','K','M','G','T','P','E','Z','Y');

		while($val >= 1000)
		{
			$val /= 1024;
			array_shift($unit);
		}

		return round($val, $round) . array_shift($unit) . 'B';
	}  
}
    
// --------------------------------------------------------------------

/**
 * Takes a relative path, gets the full server path, removes
 * the www root path, leaving only the url path to the file/folder
 *
 * @param $relative_path    
 *
 */   
if(!function_exists('urlpath'))
{
	function urlpath($relative_path) 
	{
		return  str_replace($_SERVER['DOCUMENT_ROOT'],'', realpath($relative_path) );
	}
	 
}  

// --------------------------------------------------------------------

/**
 * Joins any number of paths together
 *
 * @param $path   
 *
 */  
if(!function_exists('joinPath'))
{
	function joinPath($path)
	{
		$num_args = func_num_args();
		$args = func_get_args();
		$path = $args[0];

		if( $num_args > 1 )
		{
			for ($i = 1; $i < $num_args; $i++)
			{
				$path .= DIRECTORY_SEPARATOR.$args[$i];
			}
		}

		return reduceDoubleSlashes($path);
	}
}

// --------------------------------------------------------------------

/**
 * Returns a DirName for a path.
 *
 * @param $path   
 *
 */
function fixPath($path)
{
	return dirname($path . './');
}   

// --------------------------------------------------------------------

/**
 * Loads and returns a file
 *
 * @param string $f name of file
 *
 */
if(!function_exists('load'))
{
	function load($f)
	{
		if(!file_exists($f))
		{
			error("Cannot load file: $f");
			exit;
		}
		elseif(is_dir($f))
		{
			return loadDir($f);
		}
		else
		{
			return file_get_contents($f);
		}
	}  
} 

// --------------------------------------------------------------------

/**
 * Loads every file in a directory to a string 
 *
 * @param string $director name of the directory to load    
 *
 */
if(!function_exists('loadDirToString')) 
{
	function loadDirToString($directory)
	{	
		$loaded = "";

		if ($dir_handle = opendir($directory)) 
		{
			while (($file = readdir($dir_handle)) !== false) 
			{
				if (!checkPrefix($file))
				{ 
					continue; 
				}

				$loaded .= file_get_contents($directory . "/" .$file);
			}

			closedir($dir_handle);
		}
		return $loaded;
	}
} 

// --------------------------------------------------------------------

/**
 * Returns the extension of the file
 *	
 * @param $path 
 *
 */
if(!function_exists('extension'))
{
	function extension($path) 
	{
		$qpos = strpos($path, "?");

		if ($qpos!==false) $path = substr($path, 0, $qpos);
		return pathinfo($path, PATHINFO_EXTENSION);  
	}  
} 

// --------------------------------------------------------------------

/**
 * Returns the filename of the most recent file in a directory
 *	
 * @param $path 
 *
 */     
if(!function_exists('mostRecentFile'))
{
	function mostRecentFile($dir) 
	{
		$pattern = '\.([a-zA-Z])$';

		$newstamp = 0;
		$newname = "";
		$dc = opendir($dir);
		while ($fn = readdir($dc)) {
		  # Eliminate current directory, parent directory
		  if (ereg('^\.{1,2}$',$fn)) continue;
		  # Eliminate other pages not in pattern
		  if (! ereg($pattern,$fn)) continue;
		  $timedat = filemtime("$dir/$fn");
		  if ($timedat > $newstamp) {
		    $newstamp = $timedat;
		    $newname = $fn;
		  }
		}    

		return $newname;
	}  
}

   