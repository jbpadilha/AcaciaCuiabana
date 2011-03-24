<?php
/*******************************************************************************
********************************************************************************
***                                                                          ***
***   XTC Template Framework 1.0                                             ***
***                                                                          ***
***   Copyright (c) 2010 Monev Software LLC                                  ***
***                                                                          ***
***   All Rights Reserved                                                    ***
***                                                                          ***
********************************************************************************
*******************************************************************************/

// Support functions for XTC framework

if (defined( '_XTCFRAMEWORK' )) { // Raw CSS mode (live_site might have been setup by a custom php)
	define('JPATH_ROOT',dirname(dirname(dirname(dirname(__FILE__)))));
	if (!defined(DS)) { define('DS',DIRECTORY_SEPARATOR); }
	if (!isset($live_site)) $live_site = dirname(dirname(dirname(dirname('http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'])))).'/';
}
elseif (defined( '_JEXEC' )) { // Joomla mode
	$live_site = JURI::root();
	jimport( 'joomla.application.module.helper' );
}
else {
	die;
}

// Create XTC Framework Object
$xtc = new stdClass();
// Set defaults
$xtc->live_site = $live_site;
$xtc->templatePath = dirname(dirname(__FILE__));
$xtc->template = basename($xtc->templatePath);
$xtc->templateUrl = $live_site.'templates/'.$xtc->template.'/';
$xtc->CSSmode = 2;	// CSS mode: 1 = Single file, 2 = Separate files, 3 = Embedded in head
$xtc->CSScompression = false;	// enable/disable CSS compression
$xtc->cookieLifespan = (365*24*60*60);	// Make cookies last 1 year
$xtc->clearCookie = false;	// Clears cookie on every page load
$xtc->publicParams = isset($publicParams) ? $publicParams : array();
$xtc->showComponents = isset($showComponents) ? $showComponents : array();
$xtc->customPresets = isset($customPresets) ? $customPresets : array();

// Get Browser info
$devices = array(
    "android"       => "android",
    "blackberry"    => "blackberry",
    "iphone"        => "(iphone|ipod)",
    "ipad"        	=> "ipad",
    "opera"         => "opera mini",
    "palm"          => "(avantgo|blazer|elaine|hiptop|palm|plucker|xiino)",
    "windows"       => "windows ce; (iemobile|ppc|smartphone)",
    "generic"       => "(kindle|mobile|mmp|midp|o2|pda|pocket|psp|symbian|smartphone|treo|up.browser|up.link|vodafone|wap)"
);

//$xtc->agent = get_browser(null);

$xtc->agent = new stdClass();
$xtc->agent->isMobile = false;
$xtc->agent->device = 'generic';
$HTTP_USER_AGENT = $_SERVER['HTTP_USER_AGENT'];
$HTTP_ACCEPT = $_SERVER['HTTP_ACCEPT'];
if (isset($_SERVER['HTTP_X_WAP_PROFILE']) || isset($_SERVER['HTTP_PROFILE'])) {
    $xtc->agent->isMobile = true;
} elseif (strpos($HTTP_ACCEPT,'text/vnd.wap.wml') > 0 || strpos($HTTP_ACCEPT,'application/vnd.wap.xhtml+xml') > 0) {
    $xtc->agent->isMobile = true;
}
foreach ($devices as $device => $regexp) {
		preg_match("/".$regexp."/i", $HTTP_USER_AGENT,$null);
    if (isset($null[0])) {
        $xtc->agent->isMobile = true;
				$xtc->agent->device = $null[0];
    }
}

$xtc->agent->browserName  =  strtok($HTTP_USER_AGENT,  "/"); 
$xtc->agent->browserVersion  =  strtok( "  "); 
if (ereg( "MSIE",  $HTTP_USER_AGENT)) { 
	$xtc->agent->browserName  =  "MSIE"; 
  $xtc->agent->browserVersion  =  strtok( "MSIE"); 
  $xtc->agent->browserVersion  =  strtok( "  "); 
  $xtc->agent->browserVersion  =  strtok( ";"); 
} 
/*  try  to  figure  out  what  platform,  windows  or  mac  */ 
$xtc->agent->platform  =  "unknown"; 
if (ereg( "Windows",$HTTP_USER_AGENT) || ereg( "WinNT",$HTTP_USER_AGENT) || ereg( "Win95",$HTTP_USER_AGENT)) { 
	$xtc->agent->platform  =  "Windows"; 
}
if (ereg( "Mac",  $HTTP_USER_AGENT)) { 
	$xtc->agent->platform  =  "Macintosh"; 
} 

$GLOBALS['xtc']=&$xtc;

// CORE FUNCTIONS

function xtcLoadParams() {
// Load raw params.ini file and returns param object (also set on $GLOBALS)
// public parameters on URL or on cookie will override template parameters
	$xtc = &$GLOBALS['xtc'];

	$parameterFile = $xtc->templatePath.DS.'params.ini';

//	if (@is_array($xtc->customPresets)) { //Choose correct parameter file considering overrides
//		foreach (array_keys($xtc->customPresets) as $key) {
//			@list($var,$value)=explode('=',$key);
//			$getValue = cleanGet($var);
//			if ($getValue == $value) {
//				$parameterFile = $xtc->templatePath.DS.'presets'.DS.$xtc->customPresets[$key];
//			}
//		}
//	}

	if (!is_readable($parameterFile)) {
		echo "/* ERROR READING TEMPLATE PARAMETERS FILE [$parameterFile]<br>PLEASE CHECK TEMPLATE CONFIGURATION. */";
		return;
	}

	// Get cookie variables array
	$cookieName=$xtc->template.'Template';
	$cookie=array();

	if ($xtc->publicParams) { // there are public parameters, cookie them!
		if (isset($_COOKIE[$cookieName])) $cookie = unserialize(base64_decode($_COOKIE[$cookieName]));
		if (! $cookie) $cookie = array();
		foreach ($xtc->publicParams as $parm) {
			$value = cleanGet($parm);
			if ($value) { // We have a URL override
				$cookie[$parm]=$value;
			}
		}

		if (!empty($cookie) || $xtc->clearCookie) { // Save/clear cookie if not empty
			$lifespan = $xtc->clearCookie ? (time()-3600) : (time()+$xtc->cookieLifespan);
			setcookie($cookieName, base64_encode(serialize($cookie)), $lifespan,'/');  /* expire in 1 year */
		}
	}

// Build parameter object

	$obj = new stdClass();
	$obj->group = new stdClass();
	$obj->prefix = array();
	$obj->groups = array();

	// Parse parameters file
	$data = file($parameterFile);
	foreach ($data as $rec) {
		$rec=trim($rec);
		$pos=strpos($rec,'=');
		if ($pos===false) { continue; }
		$parm=substr($rec,0,$pos);
		$value=stripcslashes(substr($rec,$pos+1));

		if (substr($parm,0,1) == '{') { // It's from a group
			$pos=strpos($parm,'}');
			$group=substr($parm,1,$pos-1);
			@list($prefix,$group)=explode('+',$group);
			$parm=substr($parm,$pos+1);
			if (!isset($obj->group->$group)) {
				$obj->group->$group = new stdClass();
				$obj->prefix[$group] = $prefix;
				$obj->groups[]= $group;
			}
		}
		else { // No group
			$group = '';
		}

		if (array_key_exists($parm,$cookie)) {
//echo "override [$parm] [$value] [".$cookie[$parm]."]";
			$value = $cookie[$parm];	// Override with value on cookie parm, if present
		}

		if ($group) { // It's from a group
			$obj->group->$group->$parm = $value;
		}
		else {
			$obj->$parm = $value;
		}
//echo "parm: [$group][$parm][$value]<br>";
	}

	// Check for XTC parameters	

	if (isset($obj->CSSmode)) $xtc->CSSmode = $obj->CSSmode;	// CSS mode: 1 = Single file, 2 = Separate files, 3 = Embedded in head
	if (isset($obj->CSScompression)) $xtc->CSScompression = $obj->CSScompression;	// CSS compression 0 = off, 1 = on
	if (isset($obj->cookieLifespan)) $xtc->cookieLifespan = $obj->cookieLifespan;	// Cookie lifespan in seconds
	if (isset($obj->clearCookie)) $xtc->clearCookie = $obj->clearCookie;	// Clears cookie on every page load
	if (isset($obj->publicParams)) { // Public parameters
		$xtc->publicParams = array_map('trim',explode(',',$obj->publicParams));
	}
	if (isset($obj->showComponents)) { // Frontpage components
		$xtc->showComponents = array();
		foreach (explode('|',$obj->showComponents) as $component) {
			if ($component != 'all') $xtc->showComponents[] = $component;
		}
	}

	$GLOBALS['templateParameters']=&$obj;
	return $obj;
}

function cleanGet($varname='',$base64=false) {
	if ($varname && isset($_GET[$varname])) return $base64 ? preg_replace('/[^a-zA-Z0-9]_,/', '', base64_decode($_GET[$varname])) : preg_replace('/[^a-zA-Z0-9]_,/', '', $_GET[$varname]);
}

// JOOMLA FUNCTIONS
function xtcCSS() {
	$xtc = &$GLOBALS['xtc'];
	$templateParameters = &$GLOBALS['templateParameters'];
	$live_site = JURI::root();
	$groups=func_get_args();

	switch ($xtc->CSSmode) {
		case 1:	// Single file
			$doc =&JFactory::getDocument();
			$doc->addStyleSheet( $xtc->templateUrl.'XTC/css.php?groups='.implode(',',$groups), 'text/css');
		break;
		case 2: // Separate files
			$doc =&JFactory::getDocument();
			xtcCSScall('default.css');
			foreach ($groups as $group) {
				xtcGroupCSScall($group);
			}
			xtcCSScall('dualfish.css');
			$doc->addStyleSheet( $live_site.'templates/system/css/system.css', 'text/css');
			$doc->addStyleSheet( $live_site.'templates/system/css/general.css', 'text/css');
			xtcCSScall('template.css');									// User overrides CSS
		break;
		case 3: // Embedded
			echo "<style type=\"text/css\">\n";
			$params = $templateParameters;
			$imgpath = $xtc->templateUrl.'images';
			require $xtc->templatePath.DS.'css'.DS.'default.css';
			foreach ($groups as $group) {
				xtcGroupCSS($group);
			}
			require JPATH_ROOT.DS.'templates'.DS.'system'.DS.'css'.DS.'system.css';
			require JPATH_ROOT.DS.'templates'.DS.'system'.DS.'css'.DS.'general.css';
			require $xtc->templatePath.DS.'css'.DS.'template.css';
			echo "\n</style>\n";
		break;
	}
}

function xtcCSScall($file='') {
	$xtc = &$GLOBALS['xtc'];
	$doc =&JFactory::getDocument();
	$file=basename($file);
	if (is_readable($xtc->templatePath.DS.'css'.DS.$file)) {
		$doc->addStyleSheet( $xtc->templateUrl.'XTC/cssproc.php?file='.$file, 'text/css');
	}
	return;
}

function xtcGroupCSScall($group='') {
	$xtc = &$GLOBALS['xtc'];
	$doc =&JFactory::getDocument();
	$templateParameters = &$GLOBALS['templateParameters'];
	$prefix = $templateParameters->prefix[$group];
	if (is_readable($xtc->templatePath.DS.'css'.DS.$group.'.css')) {
		$doc->addStyleSheet( $xtc->templateUrl.'XTC/cssproc.php?group='.$group.'&amp;file='.$group, 'text/css');
	}
	else {
		$doc->addStyleSheet( $xtc->templateUrl.'XTC/cssproc.php?group='.$group.'&amp;file='.$prefix, 'text/css');
	}
}

function xtcGroupCSS($group='',$debug=false) {
	$xtc = &$GLOBALS['xtc'];
	$templateParameters = &$GLOBALS['templateParameters'];
	$prefix = $templateParameters->prefix[$group];
	$params = $templateParameters->group->$group;	// Parameters for the selected group
	$imgpath = $xtc->templateUrl.'images';
	if (is_readable($xtc->templatePath.DS.'css'.DS.$group.'.css')) {
		require $xtc->templatePath.DS.'css'.DS.$group.'.css';
	}
	else {
		require $xtc->templatePath.DS.'css'.DS.$prefix.'.css';
	}
}

function xtcIsFrontpage() {
//	return (JRequest::getCmd( 'option' ) == 'com_content' && JRequest::getCmd( 'view' ) == 'frontpage');
	return (JRequest::getCmd( 'view' ) == 'frontpage');
}

function xtcCanShowComponent() {
	$xtc = &$GLOBALS['xtc'];
	$option = JRequest::getCmd('option');
	if ( !empty($xtc->showComponents) && xtcIsFrontpage() ) { return in_array($option, $xtc->showComponents); }
	else { return true; }
}

function xtcGrid($areaWidth,$gutter,$order,$includeCall,$customWidths=array(),$columnClass='',$columnPad=0,$debug=false) {
	$xtc = &$GLOBALS['xtc'];

	$order = empty($order) ? array_keys($includeCall) : explode(",",$order);
	if (!is_array($customWidths)) settype($customWidths,"array");
	if (isset($xtc->debug) && $xtc->debug) $debug = true;

	$doc = &JFactory::getDocument();

 	// Get list of columns to show based on joomla content count per column
 	$columnsToShow = array(); // holds the actual columns to be shown
 	$columnsToShowCount = array(); // holds the total spaces per column
	foreach ($order as $column) {
		if ( array_key_exists($column,$includeCall) && ($total = _xtcJdocCount($doc,$includeCall[$column])) > 0 ) {
			$columnsToShow[] = $column;
			$columnsToShowCount[$column] = $total;
		}
	}

	if (empty($columnsToShow)) return; // Not columns to show

	 // Get custom column widths and adjust area width accordingly
	$originalAreaWidth = $areaWidth; // To compute % widths
	$widthsToShow = array();	// Holds columns-to-show widths
 	foreach ($columnsToShow as $column) {
		if (array_key_exists($column,$customWidths)) {  // column has custom width
			$customWidth = trim(strtolower($customWidths[$column]));
			$customWidth = (substr($customWidth,-1) == '%') ? floor($originalAreaWidth * (substr($customWidth,0,-1)/100)) : (int) $customWidth;
			if ($customWidth != 0) {
				$areaWidth -= $customWidth;
				$widthsToShow[$column]=$customWidth;
			}
		}
	}
	$freeColumns = count($columnsToShow) - count($widthsToShow);

	$gutters = count($columnsToShow) -1; // get number of gutters
	$areaWidth -= ($gutter * $gutters); // compensate for spacing between columns
	$freeColumnWidth = ($freeColumns) ? $areaWidth/$freeColumns : 0; // default module width

	$grid = ''; $debughtml='';
	if ($debug) $debughtml = "<span style=\"color:#000;background-color:#ddd;\"><b>Area Width:</b> {$originalAreaWidth}px, <b>Gutters:</b> $gutters x {$gutter}px, <b>Free column area:</b> {$areaWidth}px, <b>Free column width:</b> {$freeColumnWidth}px</span><div style=\"clear:both\"></div>";
	while ($columnsToShow) {
		$column=array_shift($columnsToShow);
		$width = (array_key_exists($column,$widthsToShow)) ? $widthsToShow[$column] : floor($freeColumnWidth);
		$width -= $columnPad;
		if (!$grid && !$columnsToShow) { $class = 'singlecolumn'; }
		elseif (!$grid && $columnsToShow) { $class = 'firstcolumn'; }
		elseif (! $columnsToShow) { $class = 'lastcolumn'; }
		else { $class = 'centercolumn'; }
		if ($columnClass) $class .= ' '.$columnClass;

		$style='float:left;';
		if ($width) $style .= ' width:'.$width.'px;';
		if (!empty($columnsToShow) && $gutter) $style .= ' margin-right:'.$gutter.'px;';

		$grid .= '<div id="'.$column.'" class="'.$class.'" style="'.$style.'">';
		$grid .= _xtcJdocRender($doc,$includeCall[$column],$columnsToShowCount[$column]);
		$grid .= '</div>';

		if ($debug) {
			switch ($debug) {
				case 1: // Show column area only
					$debughtml .= '<div id="'.$column.'" class="'.$class.'" style="'.$style.';background-color:'.sprintf('#%02X%02X%02X;', rand(128,250),rand(128,250),rand(128,250)).'">';
					$debughtml .= "<span style=\"color:#000\"><b>Column:</b> $column<br/><b>Class:</b> $class<br/><b>Style:</b> ".htmlentities($style)."<br><b>Areas to show:</b> ".$columnsToShowCount[$column]."<br/><b>Raw code:</b><br>".htmlentities($includeCall[$column])."</span>";
					$debughtml .= '</div>';
				break;
				case 2: // Show boxes instead of jdoc output
					$hold = $includeCall[$column];
					foreach ($matches[0] as $jdocCall) {
						$hold = str_replace($jdocCall,htmlentities($jdocCall),$hold);
					}
					$debughtml .= '<div id="'.$column.'" class="'.$class.'" style="'.$style.';background-color:'.sprintf('#%02X%02X%02X;', rand(128,250),rand(128,250),rand(128,250)).'">';
					$debughtml .= "<span style=\"color:#000\"><b>Column:</b> $column<br/><b>Class:</b> $class<br/><b>Style:</b> ".htmlentities($style)."<br><b>jdoc calls:</b> $jdocs<br>".htmlentities($hold)."</span>";
					$debughtml .= '</div>';
				break;
			}
		}
	}
	return ( $debug ? $debughtml : $grid);
}

// Get number of Joomla positions with content from a string/array of jdoc calls

function _xtcJdocCount(&$doc,$includeCalls) {
	$matches = array();
	if (!is_array($includeCalls)) $includeCalls = array($includeCalls);

	$total = 0;
	foreach ($includeCalls as $includeCall) {

		$jdocs = preg_match_all('/<jdoc:include\ type="([^"]+)" (.*)\/>/iU', $includeCall, $matches);
		$count = count($matches[1]);
	
		for ($i = 0; $i < $count; $i++) {
			$attribs = JUtility::parseAttributes( $matches[2][$i] );
			$type  = $matches[1][$i];
			$name  = isset($attribs['name']) ? $attribs['name'] : null;
	
			switch ($type) {
				case 'component';
					$total += xtcCanShowComponent() ? 1 : 0;
				break;
				case 'message';
					$total += strlen($doc->getBuffer($type,$name,'')) > 0 ? 1 : 0;
				break;
				default: // modules
					$total += (isset($doc->_buffer[$type][$name]) && $doc->_buffer[$type][$name] === false) ? 0 : count(JModuleHelper::getModules($name));
				break;
			}
		}
	}
	return $total;
}

function _xtcJdocRender(&$doc,$includeCalls,&$total) { // Resolves jdoc calls in a string/array

	$matches = array();
	if (!is_array($includeCalls)) $includeCalls = array($includeCalls);

	$idx = 0;
	$output = '';

	foreach ($includeCalls as $includeCall) {

		$jdocs = preg_match_all('/<jdoc:include\ type="([^"]+)" (.*)\/>/iU', $includeCall, $matches);
		$count = count($matches[1]);
		$jdocsCount = 0;
	
		for ($i = 0; $i < $count; $i++) {
			$attribs = JUtility::parseAttributes( $matches[2][$i] );
			$type  = $matches[1][$i];
			$name  = isset($attribs['name']) ? $attribs['name'] : null;
			$jdocCall = $matches[0][$i];
	
			switch ($type) {
				case 'component';
					$buffer = xtcCanShowComponent() ? $doc->getBuffer($type,$name,$attribs) : '';
					if ($idx == 0 && $total == 1) { $class = 'singlearea'; }
					elseif ($idx ==0 && $total > 1) {$class = 'firstarea'; }
					elseif ($idx == ($total - 1)) {$class = 'lastarea'; }
					else {$class = 'centerarea'; }
					if ($buffer) { $buffer = '<div class="'.$class.'">'.$buffer.'</div>'; $idx++; $jdocsCount++; }
				break;
				case 'message';
					$buffer = $doc->getBuffer($type,$name,$attribs);
					if ($idx == 0 && $total == 1) { $class = 'singlearea'; }
					elseif ($idx ==0 && $total > 1) {$class = 'firstarea'; }
					elseif ($idx == ($total - 1)) {$class = 'lastarea'; }
					else {$class = 'centerarea'; }
					if ($buffer) { $buffer = '<div class="'.$class.'">'.$buffer.'</div>'; $idx++; $jdocsCount++; }
				break;
				default: // modules
					$buffer = '';
					$renderer = $doc->loadRenderer('module');
					if(isset($doc->_buffer[$type][$name])) {
						$result = $doc->_buffer[$type][$name];
					}
					else { $result = null; }
					$modules = JModuleHelper::getModules($name);
					$buffer = '';
					foreach ($modules as $mod)  {
						$temp = $renderer->render($mod, $attribs, $result);
						if ($idx == 0 && $total == 1) { $class = 'singlearea'; }
						elseif ($idx ==0 && $total > 1) {$class = 'firstarea'; }
						elseif ($idx == ($total - 1)) {$class = 'lastarea'; }
						else {$class = 'centerarea'; }
						if ($temp) {$buffer .= '<div class="'.$class.'">'.$temp.'</div>'; $idx++; $jdocsCount++; }
					}
				break;
			}
			$includeCall = str_replace($jdocCall,$buffer,$includeCall);
		}
		if ($jdocsCount) $output .= $includeCall;
	}
	return $output;
}

function xtcMenu($group) { // DELETE THIS
	// Call the menu initialization program with the menu group parameters
	$xtc = &$GLOBALS['xtc'];
	$templateParameters = &$GLOBALS['templateParameters'];
	$prefix = $templateParameters->prefix[$group];
	$menu=substr($group,strlen($prefix));
	if (isset($templateParameters->group->$group)) {
		$params = $templateParameters->group->$group;
		if (is_readable($xtc->templatePath.DS.'menus'.DS.$menu.DS.'menu.php')) require $xtc->templatePath.DS.'menus'.DS.$menu.DS.'menu.php';
	}
}

function print_gzipped_page() {

  if ( strpos($_SERVER["HTTP_ACCEPT_ENCODING"], 'x-gzip') !== false ) {
      $encoding = 'x-gzip';
  }
  elseif ( strpos($_SERVER["HTTP_ACCEPT_ENCODING"],'gzip') !== false ) {
      $encoding = 'gzip';
  }
  else {
      $encoding = false;
  }

  if ( $encoding ) {
    $contents = ob_get_contents();
    ob_end_clean();
    header('Content-Encoding: '.$encoding, false);
    print("\x1f\x8b\x08\x00\x00\x00\x00\x00");
    $size = strlen($contents);
    $contents = gzcompress($contents, 9);
		//$contents = substr($contents, 0, $size);
    print($contents);
    exit();
	}
	else {
    ob_end_flush();
    exit();
  }
}
