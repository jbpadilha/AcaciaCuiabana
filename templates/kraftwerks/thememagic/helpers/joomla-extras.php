<?php  

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );   

// ------------------------------------------------------------------------

/**
 * Some Extra Joomla! Helpers. You might or might not find this useful.
 *
 * @package		themeMagic
 * @subpackage	Helpers
 * @version		1.0 Beta. 
 * @author		Ken Erickson AKA Bookworm http://www.bookwormproductions.net
 * @copyright 	Copyright 2009 - 2010 DesignBreakDown
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2       
 * please visit the themeMagic site http://www.theme-magic.com  for support. 
 * Do not e-mail (or god forbid IM or call) me directly.
 */  

// ------------------------------------------------------------------------          

/**
 * Loads Params Directly From Ini file 
 *    
 * @param string $paramsPath The path to the param's file. Defaults to params.ini
 * @return void
 **/
function loadParams($paramsPath = null)
{   
	if($paramsPath == null)  $paramsPath = $this->directory_path . '/params.ini';  
	
	if (is_writable($paramsPath)) {
		$params_array = parse_ini_file($paramsPath);
		return $params_array;      
	} 
	
	else { 
		die("Params.ini needs to be writable for template to function");
	}     
} 

// ------------------------------------------------------------------------          

/**
 * Writes a Param
 * 
 * @param string $paramName name of the parameter to write  
 * @param mixed $paramValue the value to write to the param
 * @param string $paramsPath The path to the param's file. Defaults to params.ini     
 *
 * @return void
 **/
function writeParam($paramName, $paramValue, $paramsPath = null) 
{ 
	$params_array = $this->loadParams();    
	if($paramsPath == null) $paramsPath = $this->directory_path . '/params.ini';  
	$params_array[$paramName] = $paramValue;  
	  
    if(is_writable($paramsPath)) { 
		$path = $paramsPath;   
		$assoc_arr = $params_array;
        $content = "";                     

        // Loop over the params and store for writing
        foreach ($assoc_arr as $key=>$elem) {
            if(is_array($elem))
            {
                for($i=0;$i<count($elem);$i++)
                {
                   $content .= $key."[] = ".$elem[$i]."\n";
                }
            }
            else if($elem=="") $content .= $key."=\n";
            else $content .= $key."=".$elem."\n";
        }  

		// Write Params  
        if (!$handle = fopen($path, 'w')) {
            return false;
        }
        if (!fwrite($handle, $content)) {
            return false;
        }
        fclose($handle);
        return true;
	}
}