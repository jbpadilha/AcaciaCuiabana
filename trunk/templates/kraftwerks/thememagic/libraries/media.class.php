<?php   

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

// ------------------------------------------------------------------------

/**
 * Media Class. Compresses and concats JS/CSS. 
 *
 * @note Based on RokGzipper by RocketTheme http://www.rocketTheme.com  
 * You might ask, why do we need this here? Cant we just use the RokGzipper plugin?
 * The problem is this: we create and add JS after the plugin events so we need to call the class 
 * after we've added our files to the document head.
 *
 * TODO: Finish Ignored Files So We can Pass a Config Array Of files To Ignore.
 *    
 * @package		themeMagic
 * @subpackage  libraries
 * @version		1.0 Beta. 
 * @author		Ken Erickson AKA Bookworm http://www.bookwormproductions.net
 * @copyright 	Copyright 2009 - 2010 DesignBreakDown
 *      
 * @author      RocketTheme http://www.rockettheme.com
 * @copyright   Copyright (C) 2007 - 2010 RocketTheme, LLC      
 *
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2       
 * please visit the themeMagic site http://www.theme-magic.com  for support. 
 * Do not e-mail (or god forbid IM or call) me directly.
 *
 */                 
class media  
{    
	var $_ignores = array();
	 
	// I'll just leave this here.
	function media() { } 
	
	/**
	 * Class Ignition function. Causes everything to happen. 
	 *
	 * @note We need to be able to call the media Init function after class instantiation.
	 * Thats why we place this code here instead of in the constructor function.
	 *
	 * @return void
	 *
	 **/  
	function initMediaGZIP()
	{
		// Setup The Instances 
		global $mainframe;    
	    $magic          =& get_instance();
		
		// Setup The Vars
		$this->uri	        =& JURI::getInstance();
		$this->jBase	    = $this->uri->toString( array('scheme', 'host', 'port'));
		$this->jPath        = JURI::Root(true);  
		$this->jPath = trimSlashes($this->jPath);    
		$this->jBase2       = JURI::base();   
		$this->jDomain  = $this->uri->toString( array('scheme', 'host', 'port'));  
		
		// For Sub Folder Installs we will Need Subfolder Name.
		$this->jBaseName = str_replace($this->jDomain, "", $this->jBase2);       
		$this->jBaseName = trimSlashes($this->jBaseName);    
		
	    if (isAdmin()) return;
	    $this->_getIgnores();  
	
	    // This Cleans Up The Head Before We Parse It
	    $this->_cleanHeadData();
	
	    if($magic->admin->getCoreConfig('gzipCSS') == 'true') 
		{
		    $this->_processCSSFiles(); 
		}     
		
		if($magic->admin->getCoreConfig('gzipJS') == 'true') 
		{
		    $this->_processJSFiles();	
		}	   
				
		$this->_setHeadData();
	}       

// ------------------------------------------------------------------------

   /**
     * Clean The Head Data
     *
     **/ 
	function _cleanHeadData()  
	{
		$doc =& JFactory::getDocument();  
		$magic =& get_instance();   
		jimport('joomla.filesystem.file');

		$headData = $doc->getHeadData();        
	    $scripts = $headData['scripts'];   
	    $scripts =  $this->_cleanFileLinks($scripts);  
	
		// Remove Extra Jquery Instances      		
		foreach($scripts as $key => $script)
		{   
			$dir = $scripts[$key][0];     
			$filename = $scripts[$key][1];  
			$detailspath = $dir.DS.$filename; 
			
			if(stristr($filename, 'jquery') == true)
			{   
				if (JFile::exists($detailspath)) 
				{  
					$fileContents = JFile::read($detailspath);
					
					if(strpos($fileContents, 'jQuery JavaScript Library') AND !$filename == 'jquery.magic.min.js')  
					{
						unset($scripts[$key]);
					}     
				}           
			}
		}      
		   		
		$newscripts = array();
		 
		// Move Mootools To The Top
		foreach($scripts as $key => $script)
		{   
			$dir = $scripts[$key][0];   
			$filename = $scripts[$key][1];   
			$details =  $scripts[$key][2];
			$detailspath = $dir.DS.$filename; 
			if(stristr($filename, 'mootools') == true)
			{
				$newscripts["$details"] = 'text/javascript'; 
				unset($scripts[$key]);
			} 
		}      
		
		// Loop Through Again And Add The Rest
		foreach($scripts as $key => $script)
		{   
			$dir = $scripts[$key][0];   
			$filename = $scripts[$key][1];   
			$details =  $scripts[$key][2];
			$detailspath = $dir.DS.$filename; 
			$newscripts["$details"] = 'text/javascript';
		}

        $headData['scripts'] = $newscripts;     
	    $doc->setHeadData($headData);
	}   
	
// ------------------------------------------------------------------------

	/**
	 * Pushes Any Files That Should Not Be Processed into an Ignored Files array.
	 *
	 * @return void
	 *
	 **/
	function _getIgnores()
	{  
	    jimport('joomla.filesystem.file');
		 
		// Get Magic
		$magic      =& get_instance();     
		
		$ignoredFiles = null;  
		
		if (!empty($ignoredFiles)){
			foreach($tmpIgnores as $ignoredFile => $file) {
				$filepath = $this->_getFilePath($ignoredFile);
				if (JFile::exists($filepath)){
					$this->_ignores[$ignoredFile] = $file;
				}
			}
		}
	}    
	  
// ------------------------------------------------------------------------
	
	/**
	 * Gets a File's Extension.
	 *
	 * @return void
	 *                   	
	 **/
	function _getFileExtension($filepath)
    {
        preg_match('/[^?]*/', $filepath, $matches);
        $string = $matches[0];
        $pattern = preg_split('/\./', $string, -1, PREG_SPLIT_OFFSET_CAPTURE);
        # check if there is any extension
        if(count($pattern) == 1)
        {
            return "";
        }
        if(count($pattern) > 1)
        {
            $filenamepart = $pattern[count($pattern)-1][0];
            preg_match('/[^?]*/', $filenamepart, $matches);
            return $matches[0];
        }
    }
     
// ------------------------------------------------------------------------
 
    /**
     * Processes the CSS files
     *
     * @return void
     * 
     **/
    function _processCSSFiles()
    {   
	    // Setup The Instances
	    $magic          =& get_instance();
		$uri	        =& JURI::getInstance();  
		$doc            =& JFactory::getDocument();
		
        // Get The StyleSheets
		$headData       = $doc->getHeadData();        
		$styleSheets    = $headData['styleSheets'];  
		
		// Config Options
		$cacheTime = $magic->core_config->mediaCacheTime;  
		$stripCSS = $magic->core_config->mediaPreserveCSSComments; 
		                                                 
		// Generate The StylesSheets File Array
        $styleSheetsClean = $this->_cleanFileLinks($styleSheets);  
         
        // We need to generate a unique hash for our file
        // Generated from all the filenames in the array    
		$md5sum = "";     
		foreach($styleSheetsClean as $files) 
		{
		    $dir = $files[0];
		    $filename = $files[1];
		    $details = $files[2];

	        $md5sum .= md5($filename);
	        $detailspath = $dir.DS.$filename;
		} 
		   
		/** Cache File Generation Code **/
		$cacheFilename = "css-".md5($md5sum).".php";
	    $cacheFullpath = JPATH_CACHE.DS.$cacheFilename;    
	
	    //see if file is stale
	    if (JFile::exists($cacheFullpath)) {
		    $diff = (time()-filectime($cacheFullpath));
		} else {
		    $diff = $cacheTime+1;
		}    
		
		// Setup Cache Contet
		if($diff > $cacheTime)
		{
			$outfile = $this->_getOutHeader("css"); 
			foreach ($styleSheetsClean as $files) { 
				// Setup Paths and FileNames
		        $dir = $files[0];
    		    $filename = $files[1];
    		    $details = $files[2];   

                // Options
				$options = array('currentDir' => $dir);
				if($stripCSS == 0) $options['preserveComments'] = false;
		        
		        $detailspath = $dir.DS.$filename;
		        if (JFile::exists($detailspath)) 
				{  
		            $cssFileContent = JFile::read($detailspath);
                    $cssFileContent = $magic->Minify_CSS->minify($cssFileContent, $options);
                    $outfile .= "\n\n/*** " . $filename . " ***/\n\n" . $cssFileContent;            
                } 
		    }
            JFile::write($cacheFullpath,$outfile);
		}    
		 
		 // Write The Caches Content To A File and Add To Head
		 $cacheFileURL = $this->jDomain . '/' . $this->jBaseName .  '/cache/'.$cacheFilename;
		 $doc->addStyleSheet($cacheFileURL);   
    }   
      
// ------------------------------------------------------------------------

    /**
     * Processes the JS files
     *
     * @return void
     **/
    function _processJSFiles()
    {   
	    // Setup The Instances
	    $magic          =& get_instance();
		$uri	        =& JURI::getInstance();  
		$doc            =& JFactory::getDocument();
		
        // Get The Scripts Array
		$headData       = $doc->getHeadData();        
		$scripts        = $headData['scripts'];  
		
		// Config Options
		$cacheTime = $magic->core_config->mediaCacheTime;  
		                                                 
		// Generate The Scripts File Array
        $scriptsClean = $this->_cleanFileLinks($scripts);  
         
        // We need to generate a unique hash for our file
        // Generated from all the filenames in the array    
		$md5sum = "";     
		foreach($scriptsClean as $files) 
		{
		    $dir = $files[0];
		    $filename = $files[1];
		    $details = $files[2];

	        $md5sum .= md5($filename);
	        $detailspath = $dir.DS.$filename;
		} 
		   
		/** Cache File Generation Code **/
		$cacheFilename = "js-".md5($md5sum).".php";
	    $cacheFullpath = JPATH_CACHE.DS.$cacheFilename;    
	
	    //see if file is stale
	    if (JFile::exists($cacheFullpath)) {
		    $diff = (time()-filectime($cacheFullpath));
		} else {
		    $diff = $cacheTime+1;
		}   
		
		if($diff > $cacheTime)
		{
			$outfile = $this->_getOutHeader("js"); 
			foreach ($scriptsClean as $files) {
		        $dir = $files[0];
    		    $filename = $files[1];
    		    $details = $files[2];
		        
		        $detailspath = $dir.DS.$filename;
		        if (JFile::exists($detailspath)) {
		            $jsFileContent = JFile::read($detailspath); 
					$jsFileContent = $magic->Minify_JS->minify($jsFileContent);   
                    $outfile .= "\n\n/*** " . $filename . " ***/\n\n" . $jsFileContent;            
                } 
		    }
            JFile::write($cacheFullpath,$outfile);
		}    
		 
		 $cacheFileURL = $this->jDomain . '/' . $this->jBaseName .  '/cache/'.$cacheFilename;
		 $doc->addScript($cacheFileURL);   
    }
        
// ------------------------------------------------------------------------

    /**
     * Cleans the File array of ignored files etc and 
     * adds a full file path to the returned array
     *
     * @param array $files The Array of styleSheets or scripts from headData
     * @return array
     * 
     **/
    function _cleanFileLinks($files)
    {    
	    $orderedFiles = array();   
	
	    foreach ($files as $file => $tag) {
            // strip query string if there is one
            if (strpos($file, '?') !== false){
                $file = substr($file, 0, strpos($file, '?'));
            }

            $filepath = $this->_getFilePath($file);         
            if (!array_key_exists($filepath, $this->_ignores) && $this->_getFileExtension($filepath) != "php" && file_exists($filepath)) {
               $orderedFiles[] = array(dirname($filepath),basename($filepath),$file);
            }
		}	
		
		return $orderedFiles;  
    }     

// ------------------------------------------------------------------------

    /**
	 * Returns an Associative Array For the Files
     *
     * @param array $files The Array of styleSheets or Scripts from headData
     * @return array
     * 
     **/
    function _assocArrLinks($files)
    {    

	    foreach ($files as $key => $tag) 
		{
		   	$files[$key]['dir']       = $files[$key][0];   
			$files[$key]['filename']  = $files[$key][1];                      
			$files[$key]['details']   = $files[$key][2]; 
			
			unset($files[$key][0]);  
			unset($files[$key][1]); 
			unset($files[$key][2]);
		}	

		return $files;  
    }  

// ------------------------------------------------------------------------

    /**
	 * Returns an Associative Array For the Files
     *
     * @param array $files The Array of styleSheets or Scripts from headData
     * @return array
     * 
     **/
    function _rebuildHeadData($files)
    {   
	    $rebuiltFiles = array(); 

	    foreach ($files as $key => $tag) 
		{   
			$filename = $files[$key][2];                      
			
			$rebuiltFiles[$filename] = 'text/javascript';
		}	

		return $rebuiltFiles;   

    }   

// ------------------------------------------------------------------------
   
   /**
     * Returns The Full Path to a file
     *
     * @param string $url The path to a file relative to the Joomla! install dir
     * @return string
     * 
     **/
	function _getFilePath($url) {
	    if ($url && $this->jBase && strpos($url,$this->jBase)!==false) $url = str_replace($this->jBase,"",$url);
	    if ($url && $this->jBaseName && strpos($url,$this->jBaseName)!==false) $url = preg_replace("/\/$this->jBaseName/","",$url, 1);
	
	    if (substr($url,0,1) != DS) $url = DS.$url;
	    $filepath = JPATH_SITE.$url;
	    return $filepath;    
	}
	
// ------------------------------------------------------------------------

   /**
     * Returns The GZIp OutPut Header
     *
     * @param string $type The type of header needed 
     * @return ob
     * 
     **/
	function _getOutHeader($type="css") {
	    if ($type=="css") {
    	    $header='<?php 
ob_start ("ob_gzhandler");
header("Content-type: text/css; charset: UTF-8");
header("Cache-Control: must-revalidate");
$offset = 60 * 60 ;
$ExpStr = "Expires: " . 
gmdate("D, d M Y H:i:s",
time() + $offset) . " GMT";
header($ExpStr);
                ?>';
        } else {
            $header='<?php 
ob_start ("ob_gzhandler");
header("Content-type: application/x-javascript; charset: UTF-8");
header("Cache-Control: must-revalidate");
$offset = 60 * 60 ;
$ExpStr = "Expires: " . 
gmdate("D, d M Y H:i:s",
time() + $offset) . " GMT";
header($ExpStr);
                ?>';
        }
        return $header;
	}   
	
// ------------------------------------------------------------------------

   /**
     * Populate Joomla! Head With the Compressed Stylesheet and Script linkes
     *
     **/ 
	function _setHeadData()  
	{
		$doc =& JFactory::getDocument();  
		$magic =& get_instance();
		 
		$headData = $doc->getHeadData();        
		if($magic->admin->getCoreConfig('gzipCSS') == 'true') $styles = $headData['styleSheets'];    
	    if($magic->admin->getCoreConfig('gzipJS') == 'true') $scripts = $headData['scripts'];  
	    
		if($magic->admin->getCoreConfig('gzipCSS') == 'true')
		{
			// Remove The Crompressed Styles
		    foreach($styles as $key => $style) 
			{   
				if(!strpos($key, 'php'))
				{
					unset($styles[$key]);    	
				}
			}  
		} 
        
		if($magic->admin->getCoreConfig('gzipJS') == 'true') 
		{
			// Remove The Crompressed Scripts
			foreach($scripts as $key => $script) 
			{   
				if(!strpos($key, 'php'))
				{
					unset($scripts[$key]);    	
				}
			} 
		}  
		
		// Set The HeadData Arrays To the Now Clean Arrays
		if($magic->admin->getCoreConfig('gzipCSS') == 'true') $headData['styleSheets'] = $styles;  
	    if($magic->admin->getCoreConfig('gzipJS') == 'true')  $headData['scripts'] = $scripts;     
	    $doc->setHeadData($headData);
	}         
}
