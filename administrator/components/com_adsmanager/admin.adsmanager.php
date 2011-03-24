<?php
//
// Copyright (C) 2006 Thomas Papin
// http://www.gnu.org/copyleft/gpl.html GNU/GPL

// This file is part of the AdsManager Component,
// a Joomla! Classifieds Component by Thomas Papin
// Email: thomas.papin@free.fr
//
// no direct access
defined('_VALID_MOS') or die('Direct Access to this location is not allowed.');

// ensure user has access to this function
if (!($acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'all' )
		| $acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', $option ))) {
	mosRedirect( 'index2.php', _NOT_AUTH );
}

require_once( $mainframe->getPath( 'admin_html' ) );
require_once( $mainframe->getPath( 'class' ) );
if (file_exists($mosConfig_absolute_path .'/components/'.$option.'/lang/lang_' . $mosConfig_lang . '.php'))
	include_once( $mosConfig_absolute_path .'/components/'.$option.'/lang/lang_' . $mosConfig_lang . '.php' );
else
	include_once( $mosConfig_absolute_path .'/components/'.$option.'/lang/lang_english.php' );
	
if ( file_exists( $mosConfig_absolute_path . "/components/com_paidsystem/api.paidsystem.php")) 
{
	require_once($mosConfig_absolute_path . "/components/com_paidsystem/api.paidsystem.php");
}

$act = mosGetParam( $_REQUEST, 'act', "" );
switch($act)
{
	case "import":
		import();
		break;

	case "configuration":	
	switch($task) {
		case "save":
			saveConfiguration($option);
			break;

		case "edit":
		default:
			editConfiguration($option);
			break;
	}
	break;
				
	case "ads":
	switch ($task) {
		case "save" :
			saveAd($option);
			break;

		case "edit" :
			displayAd( $option);
			break;

		case "new" :
			$id = '';
			newAd( $option);
			break;
	
		case "delete" :
			deleteAd($option);
			break;

		case "publish" :
			publishAd($option);
			break;

		case "listCategories" :
			default:
			listAds($option);
			break;

	}
	break;
	
	case "categories" :	
	switch($task) {
		case "save" :
			saveCategory($option);
			break;
			
		case "edit" :
			displayCategory($option);
			break;

		case "new" :
			newCategory( $option);
			break;
			
		case "delete" :
			deleteCategory($option);
			break;
			
		case "publish" :
			publishCategory($option);
			break;
			
		case 'orderup':
		$tid = mosGetParam( $_REQUEST, 'tid', array(0) );
		if (!is_array( $tid )) {
			$tid = array(0);
		}
		orderCategory( intval( $tid[0]), -1, $option );
		break;

		case 'orderdown':
		$tid = mosGetParam( $_REQUEST, 'tid', array(0) );
		if (!is_array( $tid )) {
			$tid = array(0);
		}
		orderCategory( intval( $tid[0] ), 1, $option );
		break;
		
		case 'saveorder':
		$tid = mosGetParam( $_REQUEST, 'tid', array(0) );
		if (!is_array( $tid )) {
			$tid = array(0);
		}
		saveOrder( $tid ,$option);
		break;
			
		default:
			listCategories($option);
	}
	break;
	
	case "tools":
	{
		switch($task) {
			case "installjoomfish":
				installJoomfish($option);
				break;
			case "installsef":
				installSEF($option);
				break;
			default:
				displayTools($option);
				break;
		}
	}		
	break;
	
	case "columns":
	{	
		switch($task) {
			case "new":
			case "edit":
				editColumn($option);
				break;
				
			case "save":
				saveColumn($option);
				break;
				
			case "delete":
				removeColumn($option);
				break;
					
			default:
				showColumns($option);
				break;
		}
	}	
		break;
		
	case "positions":
	{	
		switch($task) {
			case "edit":
				editPosition($option);
				break;
				
			case "save":
				savePosition($option);
				break;
					
			default:
				showPositions($option);
				break;
		}
	}	
		break;
	
	case "fields":
	{	
		switch($task) {
			case "new":
			case "edit":
				editField($option);
				break;
				
			case "save":
				saveField($option);
				break;
				
			case "delete":
				removeField($option);
				break;
				
			case 'orderup':
			$tid = mosGetParam( $_REQUEST, 'tid', array(0) );
			if (!is_array( $tid )) {
				$tid = array(0);
			}
			orderField( intval( $tid[0]), -1, $option );
			break;
	
			case 'orderdown':
			$tid = mosGetParam( $_REQUEST, 'tid', array(0) );
			if (!is_array( $tid )) {
				$tid = array(0);
			}
			orderField( intval( $tid[0] ), 1, $option );
			break;
			
			case 'saveorder':
			$tid = mosGetParam( $_REQUEST, 'tid', array(0) );
			if (!is_array( $tid )) {
				$tid = array(0);
			}
			saveFieldOrder( $tid ,$option);
			break;
			
			case "publish" :
			publishField($option);
			break;
			
			case "required" :
			requiredField($option);
			break;
				
			default:
				showField($option);
				break;
		}
	}	
		break;
		
	case "plugins":
		switch($task) {
			case "delete" :
				deletePlugin($option);
			break;
			
			case "upload":
				installPlugin($option);
				break;
			default:
				listPlugins($option);
				break;
		}
		break;
	
	case "fieldimage":
		switch($task) {
			case "delete" :
				deleteFieldImage($option);
			break;
			
			case "upload":
				uploadFieldImage($option);
				break;
			default:
				listFieldImages($option);
				break;
		}
		break;
	
	default:
		displayMain($option);
		break;
}

function am_getLangDefinition  ($text) {
	if(defined($text)) $returnText = constant($text); 
	else $returnText = $text;
	return $returnText;
}

function get_plugins()
{
	global $mosConfig_absolute_path;
	
	if(!file_exists($mosConfig_absolute_path . "/images/com_adsmanager/plugins/")){
		@mkdir($mosConfig_absolute_path . "/images/com_adsmanager/plugins/");
	};
	
	$plugins = null;
	
	if(file_exists($mosConfig_absolute_path . "/images/com_adsmanager/plugins/")) { 
		$path = $mosConfig_absolute_path."/images/com_adsmanager/plugins/";
		$handle = opendir( $path );
		while ($file = readdir($handle)) {
			$dir = mosPathName( $path.'/'.$file, false );
			if (is_dir($dir))
			{
				if (($file != ".") && ($file != "..")) {
					require($path.'/'.$file.'/plug.php');
				}
			}
		}
	
		closedir($handle);
	}
	return $plugins;
}

/****************************************************************************/
/******************       Configuration          ****************************/
/****************************************************************************/

function saveConfiguration($option) {
	global $database;
	$row = new adsManagerConf($database);

	// bind it to the table
	if (!$row -> bind($_POST)) {
		echo "<script> alert('"
			.$row -> getError()
			."'); window.history.go(-1); </script>\n";
		exit();
	}

	// store it in the db
	if (!$row -> store()) {
		echo "<script> alert('"
			.$row -> getError()
			."'); window.history.go(-1); </script>\n";
		exit();	
	}
	
	// clean any existing cache files
	mosCache::cleanCache( $option );

	mosRedirect("index2.php?option=$option&act=configuration", ADSMANAGER_CONFIGURATION_SAVED);
}


function editConfiguration($option)
{
	global $database;

	$database->setQuery("SELECT * FROM #__adsmanager_config"  );
	$rows = $database -> loadObjectList();
	if ($database -> getErrorNum()) {
		echo $database -> stderr();
		return false;
	}
	
	HTML_adsmanager::editConfiguration($option, $rows[0]);
}


/****************************************************************************/
/******************       Categories             ****************************/
/****************************************************************************/
function saveOrder( &$tid,$option ) {
	global $database;

	$total		= count( $tid );
	$order 		= mosGetParam( $_POST, 'order', array(0) );
	$row 		= new adsManagerCategory( $database );

	// update ordering values
	for( $i=0; $i < $total; $i++ ) {
		$row->load( $tid[$i] );
		if ($row->ordering != $order[$i]) {
			$row->ordering = $order[$i];
			if (!$row->store()) {
				echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
				exit();
			} // if
		} // if
	} // for

	// clean any existing cache files
	mosCache::cleanCache( $option );
	
	mosRedirect("index2.php?option=$option&act=categories", ADSMANAGER_CATEGORIES_REORDER);
} // saveOrder

/**
* Moves the order of a record
* @param integer The increment to reorder by
*/
function orderCategory( $uid, $inc, $option ) {
	global $database;

	$row = new adsManagerCategory( $database );
	$row->load( $uid );
	$row->move( $inc, "parent = $row->parent" );

	// clean any existing cache files
	mosCache::cleanCache( $option );

	mosRedirect("index2.php?option=$option&act=categories", "");
}

function displayCategory($option){
	global $database;
	
	$id = mosGetParam( $_REQUEST, 'tid', array(0) );
	if (is_array( $id )) {
		$id = $id[0];
	}
	
	if(!isset($id))
	{
		mosRedirect("index2.php?option=$option&act=contest", ADSMANAGER_ERROR_IN_URL);
		return;
	}
	
	$database->setQuery( "SELECT c.* FROM #__adsmanager_categories as c ".
						 "WHERE 1 ORDER BY c.parent,c.ordering");
	$rows = $database->loadObjectList();
	if ($database -> getErrorNum()) {
		echo $database -> stderr();
		return false;
	}
						 
	// establish the hierarchy of the menu
	$children = array();
	// first pass - collect children
	foreach ($rows as $v ) {
		$pt 	= $v->parent;
		$list 	= @$children[$pt] ? $children[$pt] : array();
		array_push( $list, $v );
		$children[$pt] = $list;
	}
	

	$database->setQuery("SELECT * FROM #__adsmanager_categories WHERE id=".$id );
	$rows = $database -> loadObjectList();
	if ($database -> getErrorNum()) {
		echo $database -> stderr();
		return false;
	}
	
	HTML_adsmanager::displaycategory($option, $rows[0],$children);
}

function newCategory( $option){
	global $database;
	$database->setQuery( "SELECT c.* FROM #__adsmanager_categories as c ".
						 "WHERE 1 ORDER BY c.parent,c.ordering");
	$rows = $database->loadObjectList();
	if ($database -> getErrorNum()) {
		echo $database -> stderr();
		return false;
	}
						 
	// establish the hierarchy of the menu
	$children = array();
	// first pass - collect children
	foreach ($rows as $v ) {
		$pt 	= $v->parent;
		$list 	= @$children[$pt] ? $children[$pt] : array();
		array_push( $list, $v );
		$children[$pt] = $list;
	}
	
	$row = new adsManagerCategory($database);
	
	HTML_adsmanager::displaycategory($option, $row,$children);
}

function saveCategory($option){
	global $database,$mosConfig_absolute_path;
	$row = new adsManagerCategory($database);

	// bind it to the table
	if (!$row -> bind($_POST)) {
		echo "<script> alert('"
			.$row -> getError()
			."'); window.history.go(-1); </script>\n";
		exit();
	}
	
	// store it in the db
	if (!$row -> store()) {
		echo "<script> alert('"
			.$row -> getError()
			."'); window.history.go(-1); </script>\n";
		exit();	
	}
	
	// get configuration
	$database->setQuery( "SELECT * FROM #__adsmanager_config");
	$confs = $database->loadObjectList();
	if ($database -> getErrorNum()) {
		echo $database -> stderr();
		return false;
	}
	
	// image2 delete
	if ( $_POST['cb_image'] == "delete") {
		$pict = $mosConfig_absolute_path."/images/$option/categories/".$row->id."cat.jpg";
		if ( file_exists( $pict)) {
			unlink( $pict);
		}
		$pict = $mosConfig_absolute_path."/images/$option/categories/".$row->id."cat_t.jpg";
		if ( file_exists( $pict)) {
			unlink( $pict);
		}
	}
							
	if (isset( $_FILES['cat_image'])) {
		if ( $_FILES['cat_image']['size'] > $confs[0]->max_image_size) {
			mosRedirect("index2.php?option=$option&act=categories", ADSMANAGER_IMAGETOOBIG);
			return;
		}
	}

	// image1 upload
	if (isset( $_FILES['cat_image']) and !$_FILES['cat_image']['error'] ) {
		$path= $mosConfig_absolute_path."/images/$option/categories/";
		createImageAndThumb($_FILES['cat_image']['tmp_name'],$row->id."cat.jpg",$row->id."cat_t.jpg",
							$confs[0]->cat_max_width,
							$confs[0]->cat_max_height,
							$confs[0]->cat_max_width_t,
							$confs[0]->cat_max_height_t,
							"",
							$path,
							$_FILES['cat_image']['name']);
	}	
	
	// clean any existing cache files
	mosCache::cleanCache( $option );

	mosRedirect("index2.php?option=$option&act=categories", ADSMANAGER_CATEGORY_SAVED);
}

function deleteCategory($option){
	global $database;
	
	$tid = $_POST['tid'];
	if (!is_array($tid) || count($tid) < 1) {
		echo "<script> alert('Select an category to delete'); window.history.go(-1);</script>\n";
		exit();
	}

	if (count($tid))
	{
		$ids = implode(',', $tid);
		$database->setQuery("SELECT * FROM #__adsmanager_categories \nWHERE id not IN ($ids) AND parent IN ($ids)");
		if ($database->loadResult()) 
		{
			echo "<script> alert('".ADSMANAGER_DELETE_CATEGORY_SELECT_CHIDLS."'); window.history.go(-1); </script>\n";
			exit();
		}
		$database->setQuery("DELETE FROM #__adsmanager_categories \nWHERE id IN ($ids)");
		if (!$database->query()) {
		echo "<script> alert('"
			.$database -> getErrorMsg()
			."'); window.history.go(-1); </script>\n";
		}
	}
	
	if (count($tid))
	{
		$ids = implode(',', $tid);
		
		$database->setQuery( "SELECT a.id FROM #__adsmanager_ads as a ".
							 "LEFT JOIN #__adsmanager_adcat as adcat ON adcat.adid = a.id ".
							 "WHERE adcat.catid IN ($ids)");
		$idsarray = $database->loadResultArray();
		if (isset($idsarray))
		{
			// get configuration
			$database->setQuery( "SELECT * FROM #__adsmanager_config");
			$database->loadObject($conf);
		
			$plugins = get_plugins();
		
			foreach($idsarray as $adid)
			{
				remove_ad($adid,$conf,$plugins);
			}
		}
	}
	
	
	// clean any existing cache files
	mosCache::cleanCache( $option );
	
	mosRedirect("index2.php?option=$option&act=categories", ADSMANAGER_CATEGORIES_DELETED);
}

function remove_ad($adid,$conf,$plugins)
{
	global $database,$mosConfig_absolute_path;
	
	$database->setQuery("SELECT * FROM #__adsmanager_ads WHERE id=$adid");
	$database->loadObject($ad);
	if ($database -> getErrorNum()) {
		echo $database -> stderr();
		return false;
	}
	
	$database->setQuery("DELETE FROM #__adsmanager_ads WHERE id=$adid");
	if ($database->getErrorNum()) {
		echo $database->stderr();
	} else {
		$database->query();
	}
	
	$database->setQuery("DELETE FROM #__adsmanager_adcat WHERE adid=$adid");
	if ($database->getErrorNum()) {
		echo $database->stderr();
	} else {
		$database->query();
	}
	
	$database->setQuery( "SELECT name FROM #__adsmanager_fields WHERE `type` = 'file'");
	$file_fields = $database->loadObjectList();
	foreach($file_fields as $file_field)
	{
		$filename = "\$ad->".$file_field->name;
		eval("\$filename = \"$filename\";");
		@unlink($mosConfig_absolute_path."/images/com_adsmanager/files/".$filename);
	}

	$nbImages = $conf->nb_images;

	for($i = 1 ;$i < $nbImages + 1; $i++)
	{	
		$ext_name = chr(ord('a')+$i-1);
		$pict = $mosConfig_absolute_path."/images/com_adsmanager/ads/".$adid.$ext_name."_t.jpg";
		if ( file_exists( $pict)) {
			unlink( $pict);
		}
		$pic = $mosConfig_absolute_path."/images/com_adsmanager/ads/".$adid.$ext_name.".jpg";
		if ( file_exists( $pic)) {
			unlink( $pic);
		}
	}
	
	foreach($plugins as $plugin)
	{
		$plugin->onDelete(0,$adid);
	}
	
	if (function_exists('deletePaidAd')){
		deletePaidAd($adid);
	}
}

function listCategories($option){
	global $database,$mainframe,$mosConfig_list_limit;
	
	$limit = intval( $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit ) );
	$limitstart = intval( $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 ) );
	
	$database->setQuery( "SELECT c.* FROM #__adsmanager_categories as c ".
						 "WHERE 1 ORDER BY c.parent,c.ordering");
						
	$rows = $database->loadObjectList();
	if ($database -> getErrorNum()) {
		echo $database -> stderr();
		return false;
	}
	
	
	
	$database->setQuery("SELECT count(*) FROM #__adsmanager_categories WHERE 1");			
	$total = $database->loadResult();
	
	require_once( $GLOBALS['mosConfig_absolute_path'] . '/administrator/includes/pageNavigation.php' );
	$pageNav = new mosPageNav( $total, $limitstart,$limit );
						 
	// establish the hierarchy of the menu
	$children = array();
	// first pass - collect children
	foreach ($rows as $v ) {
		$pt 	= $v->parent;
		$list 	= @$children[$pt] ? $children[$pt] : array();
		array_push( $list, $v );
		$children[$pt] = $list;
	}
	
	// second pass - get an indent list of the items
	$list = mosTreeRecurse( 0, '', array(), $children);
	
	$list = array_slice( $list, $limitstart, $limit );
	
	HTML_adsmanager::listcategories($option,$total,$list,$pageNav);
}

function publishCategory($option){
	global $database;
	
	$tid = $_GET['tid'];
	if (!is_array($tid) || count($tid) < 1) {
		echo "<script> alert('Select an item to publish'); window.history.go(-1);</script>\n";
		exit();
	}
	
	if(isset($_GET['publish']))
	{
		$publish = $_GET['publish'];
	}
	else
	{
		mosRedirect("index2.php?option=$option&act=categories", ADSMANAGER_ERROR_IN_URL);
		return;
	}

	if (count($tid))
	{
		$ids = implode(',', $tid);
		$database->setQuery("UPDATE #__adsmanager_categories SET `published` = '$publish' WHERE `id` IN ($ids) ");
	}
	if (!$database->query()) {
		echo "<script> alert('"
			.$database -> getErrorMsg()
			."'); window.history.go(-1); </script>\n";
	}
	
	// clean any existing cache files
	mosCache::cleanCache( $option );
	
	mosRedirect("index2.php?option=$option&act=categories","");
}

/****************************************************************************/
/******************       Ads                    ****************************/
/****************************************************************************/
function createImageAndThumb($src_file,$image_name,$thumb_name,
							$max_width,
						    $max_height,
							$max_width_t,
							$max_height_t,
							$tag,
							$path,
							$orig_name)
{
    ini_set('memory_limit', '20M');
	
	$src_file = urldecode($src_file);
	
	/*if (extension_loaded('exif')) 
	{
		$type2 = exif_imagetype($src_file);
		$types = array( 
			IMAGETYPE_JPEG => 'jpeg', 
			IMAGETYPE_GIF => 'gif', 
			IMAGETYPE_PNG => 'png' 
		); 
    
		$type = $types[$type2]; 
	}
	else
	{*/
		$orig_name = strtolower($orig_name);
		$findme  = '.jpg';
		$pos = strpos($orig_name, $findme);
		if ($pos === false)
		{
			$findme  = '.jpeg';
			$pos = strpos($orig_name, $findme);
			if ($pos === false)
			{
				$findme  = '.gif';
				$pos = strpos($orig_name, $findme);
				if ($pos === false)
				{
					$findme  = '.png';
					$pos = strpos($orig_name, $findme);
					if ($pos === false)
					{
						return;
					}
					else
					{
						$type = "png";
					}
				}
				else
				{
					$type = "gif";
				}
			}
			else
			{
				$type = "jpeg";
			}
		}
		else
		{
			$type = "jpeg";
		}
	//}
	
	$max_h = $max_height;
	$max_w = $max_width;
	$max_thumb_h = $max_height_t;
	$max_thumb_w = $max_width_t;
	
	if ( file_exists( "$path/$image_name")) {
		unlink( "$path/$image_name");
	}
	
	if ( file_exists( "$path/$thumb_name")) {
		unlink( "$path/$thumb_name");
	}
	
	$read = 'imagecreatefrom' . $type; 
	$write = 'image' . $type; 
	
	$src_img = $read($src_file);
	
	// height/width
	$imginfo = getimagesize($src_file);
	$src_w = $imginfo[0];
	$src_h = $imginfo[1];
	
	$zoom_h = $max_h / $src_h;
    $zoom_w = $max_w / $src_w;
    $zoom   = min($zoom_h, $zoom_w);
    $dst_h  = $zoom<1 ? round($src_h*$zoom) : $src_h;
    $dst_w  = $zoom<1 ? round($src_w*$zoom) : $src_w;
	
	$zoom_h = $max_thumb_h / $src_h;
    $zoom_w = $max_thumb_w / $src_w;
    $zoom   = min($zoom_h, $zoom_w);
    $dst_thumb_h  = $zoom<1 ? round($src_h*$zoom) : $src_h;
    $dst_thumb_w  = $zoom<1 ? round($src_w*$zoom) : $src_w;
	
	$dst_img = imagecreatetruecolor($dst_w,$dst_h);
	$white = imagecolorallocate($dst_img,255,255,255);
	imagefill($dst_img,0,0,$white);
	imagecopyresampled($dst_img,$src_img, 0,0,0,0, $dst_w,$dst_h,$src_w,$src_h);
	$textcolor = imagecolorallocate($dst_img, 255, 255, 255);
	if (isset($tag))
		imagestring($dst_img, 5, 5, 5, "$tag", $textcolor);    
	if($type == 'jpeg'){
        $desc_img = $write($dst_img,"$path/$image_name", 75);
	}else{
        $desc_img = $write($dst_img,"$path/$image_name", 2);
	}
	
	
	$dst_t_img = imagecreatetruecolor($dst_thumb_w,$dst_thumb_h);
	$white = imagecolorallocate($dst_t_img,255,255,255);
	imagefill($dst_t_img,0,0,$white);
	imagecopyresampled($dst_t_img,$src_img, 0,0,0,0, $dst_thumb_w,$dst_thumb_h,$src_w,$src_h);
	$textcolor = imagecolorallocate($dst_t_img, 255, 255, 255);
	if (isset($tag))
		imagestring($dst_t_img, 2, 2, 2, "$tag", $textcolor);
	if($type == 'jpeg'){
        $desc_img = $write($dst_t_img,"$path/$thumb_name", 75);
	}else{
        $desc_img = $write($dst_t_img,"$path/$thumb_name", 2);
	}

}

function saveAd($option){
	global $database,$mosConfig_absolute_path;
	$row = new adsManagerAd($database);

	// get configuration
	$database->setQuery( "SELECT * FROM #__adsmanager_config");
	$database->loadObject($conf);
	if ($database -> getErrorNum()) {
		echo $database -> stderr();
		return false;
	}
	
	// bind it to the table
	if (!$row -> bind($_POST)) {
		echo "<script> alert('"
			.$row -> getError()
			."'); window.history.go(-1); </script>\n";
		exit();
	}
	
	if ($row->id != "")
		$isUpdateMode = 1;
	else
		$isUpdateMode = 0;

	if ($isUpdateMode == 0)
	{
		$row->date_created = date("Y-m-d");
		$delta = $conf->ad_duration;  
		$row->expiration_date = date("Y-m-d",mktime()+($delta*24*3600)); 
	}
	
	// store it in the db
	if (!$row -> store()) {
		echo "<script> alert('"
			.$row -> getError()
			."'); window.history.go(-1); </script>\n";
		exit();	
	}
	
	// Add Ad/Category relation
	$query = "SELECT catid FROM #__adsmanager_adcat WHERE adid = '$row->id' ";
	$database->setQuery($query);
	$prevcats = $database->loadResultArray();
	
	$query = "DELETE FROM #__adsmanager_adcat WHERE adid = '$row->id' ";
	$database->setQuery($query);
	$database->query();
	
	$query = "DELETE FROM #__adsmanager_adcat WHERE adid = '$row->id' ";
	$database->setQuery($query);
	$database->query();
	
	if (function_exists("getMaxCats"))
		$maxcats = getMaxCats($conf->nbcats);
	else
		$maxcats = $conf->nbcats;
		
	if ($maxcats > 1)
	{
		$selected_cats = mosGetParam( $_POST, "selected_cats", array() );
		if (count($selected_cats) > $maxcats)
		{
			$selected_cats = array_slice ($selected_cats, 0, $maxcats);
		}

		$query = "INSERT IGNORE INTO #__adsmanager_adcat (`adid`,`catid`) VALUES ";
		foreach($selected_cats as $key => $cat)
		{
			if ($key != 0)
					$query .= ",";
			$query .= "('$row->id','$cat')";
		}
		$database->setQuery($query);
		$database->query();
		$catid = $selected_cats[0];
	}
	else
	{
		$category = mosGetParam( $_POST, "category", 0 );
		$query = "INSERT IGNORE INTO #__adsmanager_adcat (`adid`,`catid`) VALUES ('$row->id','$category')";
		$database->setQuery($query);
		$database->query();
		$catid = $category;
	}
	
	if (function_exists("savePaidAd"))
	{
		if ($maxcats == 1)
		{
			$selected_cats = array();
			$selected_cats[] = $category;
		}
		echo "savePaidAd,selected_cats=".count($selected_cats)."<br/>";
		$status = savePaidAd($row->id,$row->userid,$isUpdateMode,$errormsg,$conf,$prevcats,$selected_cats,"admin");
		echo "$status<br/>";
		if ($status == -1)
		{
			return;
		}
		else if ($status == -2)
		{
			$redirect_text = $errormsg;
		}
	}
	
	//get fields
	$database->setQuery( "SELECT * FROM #__adsmanager_fields WHERE published = 1");
	$fields = $database->loadObjectList();
	if ($database -> getErrorNum()) {
		echo $database -> stderr();
		return false;
	}	
	
	$plugins = get_plugins();
	$query = "UPDATE #__adsmanager_ads ";
	
	$first=0;
	foreach($fields as $field)
	{ 	
		if ($field->type == "multiselect")
		{	
			$value = mosGetParam( $_POST, $field->name, array() );
			//$valueA = explode("|*|",$value);
			$value = ",".implode(',', $value).",";	
		}
		else if (($field->type == "multicheckbox")||($field->type == "multicheckboximage"))
		{
			$value = mosGetParam( $_POST, $field->name, array() );
			$value = ",".implode(',', $value).",";
		}
		else if ($field->type == "file")
		{
			if (isset( $_FILES[$field->name]) and !$_FILES[$field->name]['error'] ) {
				$database->setQuery( "SELECT ".$field->name." FROM #__adsmanager_ads WHERE id = ".$row->id);
				$old_filename = $database->loadResult();
				@unlink($mosConfig_absolute_path."/images/com_adsmanager/files/".$old_filename);
				
				$filename = $_FILES[$field->name]['name'];
				while(file_exists($mosConfig_absolute_path."/images/com_adsmanager/files/".$filename)){
					$filename = "copy_".$filename;
				}
				@move_uploaded_file($_FILES[$field->name]['tmp_name'],
									$mosConfig_absolute_path."/images/com_adsmanager/files/".$filename);									
			}
			continue;
		}
		else if ($field->type == "editor")
		{
			$value = mosGetParam( $_POST, $field->name, "",_MOS_ALLOWHTML );
		}
		//Plugins
		else if (isset($plugins[$field->type]))
		{
			$plugins[$field->type]->onFormSave($row->id,$field->fieldid,$isUpdateMode);
			continue;
		}
		else
		{
			$value = mosGetParam( $_POST, $field->name, "" );
		}
		
		if (!get_magic_quotes_gpc()) {
			$value = addslashes( $value );
		}
						
		if ($first == 0)
			$query .= "SET"; 
		else
			$query .= ",";
		$first = 1;
		$query .= " $field->name = '".$value."' ";		
	}
	$query .= "WHERE id = ".$row->id;
	
	if ($first != 0)
	{
		if (function_exists("savePaidFields")) 
		{
			echo "savePaidFields";
			if (savePaidFields($isUpdateMode,$row,$errormsg,"admin") != 0) // Error
			{
				echo "error";
				$redirect_text = $errormsg;
			}
			else
			{
				echo "ok<br/>";
				echo $query;
				$database->setQuery( $query);
				$database->query();
			}
		}
		else
		{
			$database->setQuery( $query);
			$database->query();
		}
	}
	
	$nbImages = $conf->nb_images;
	
	for($i = 1 ;$i < $nbImages + 1; $i++)
	{	
		$ext_name = chr(ord('a')+$i-1);
		$cb_image = mosGetParam( $_POST, "cb_image$i", "" );
		// image1 delete
		if ( $cb_image == "delete") {
			$pict = $mosConfig_absolute_path."/images/$option/ads/".$row->id.$ext_name."_t.jpg";
			if ( file_exists( $pict)) {
				unlink( $pict);
			}
			$pic = $mosConfig_absolute_path."/images/$option/ads/".$row->id.$ext_name.".jpg";
			if ( file_exists( $pic)) {
				unlink( $pic);
			}
		}
							
		if (isset( $_FILES["ad_picture$i"])) {
			if ( $_FILES["ad_picture$i"]['size'] > $conf->max_image_size) {
				mosRedirect("index2.php?option=$option&act=ads&catid=".$row->category, ADSMANAGER_IMAGETOOBIG);
				return;
			}
		}
		
		// image1 upload
		if (isset( $_FILES["ad_picture$i"]) and !$_FILES["ad_picture$i"]['error'] ) {
			createImageAndThumb($_FILES["ad_picture$i"]['tmp_name'],$row->id.$ext_name.".jpg",$row->id.$ext_name."_t.jpg",
								$conf->max_width,
								$conf->max_height,
								$conf->max_width_t,
								$conf->max_height_t,
								$conf->tag,
								$mosConfig_absolute_path."/images/$option/ads/",
								$_FILES["ad_picture$i"]['name']);
		}
	}
	
	// clean any existing cache files
	mosCache::cleanCache( $option );

	mosRedirect("index2.php?option=$option&act=ads&catid=".$catid, ADSMANAGER_AD_SAVED);
}

function displayAd( $option ){
	global $database;
	
	$id = mosGetParam( $_REQUEST, 'tid', array(0) );
	if (is_array( $id )) {
		$id = $id[0];
	}
	
	if(!isset($id))
	{
		mosRedirect("index2.php?option=$option&act=ads", ADSMANAGER_ERROR_IN_URL);
		return;
	}
	
	$database->setQuery( "SELECT c.* FROM #__adsmanager_categories as c ".
						 "WHERE 1 ORDER BY c.parent,c.ordering");
	$rows = $database->loadObjectList();
	if ($database -> getErrorNum()) {
		echo $database -> stderr();
		return false;
	}
						 
	// establish the hierarchy of the menu
	$children = array();
	// first pass - collect children
	foreach ($rows as $v ) {
		$pt 	= $v->parent;
		$list 	= @$children[$pt] ? $children[$pt] : array();
		array_push( $list, $v );
		$children[$pt] = $list;
	}

	$database->setQuery("SELECT * FROM #__adsmanager_ads WHERE id=".$id );
	$database -> loadObject($ad);
	if ($database -> getErrorNum()) {
		echo $database -> stderr();
		return false;
	}
	
	// get configuration
	$database->setQuery( "SELECT * FROM #__adsmanager_config");
	$database->loadObject($conf);
	if ($database -> getErrorNum()) {
		echo $database -> stderr();
		return false;
	}
	
	//get fields
	$database->setQuery( "SELECT * FROM #__adsmanager_fields WHERE published = 1 ORDER by ordering");
	$fields = $database->loadObjectList();
	if ($database -> getErrorNum()) {
		echo $database -> stderr();
		return false;
	}	
	
	//get value fields
	$database->setQuery( "SELECT * FROM #__adsmanager_field_values ORDER by ordering ");
	$fieldvalues = $database->loadObjectList();
	if ($database -> getErrorNum()) {
		echo $database -> stderr();
		return false;
	}
	
	$field_values = array();
	// first pass - collect children
	foreach ($fieldvalues as $v ) {
		$pt 	= $v->fieldid;
		$list 	= @$field_values[$pt] ? $field_values[$pt] : array();
		array_push( $list, $v );
		$field_values[$pt] = $list;
	}
	
	foreach($fields as $field)
	{
		if ($field->cbfieldvalues != "-1")
		{
			/*get CB value fields */
			$database->setQuery( "SELECT *, fieldtitle as fieldvalue FROM #__comprofiler_field_values WHERE fieldid = $field->cbfieldvalues ORDER by ordering ");
			$cbfieldvalues = $database->loadObjectList();
			if ($database -> getErrorNum()) {
				echo $database -> stderr();
				return false;
			}
			$field_values[$field->fieldid] = $cbfieldvalues;
		}
	}
	
	//get users
	$database->setQuery( "SELECT * FROM #__users WHERE 1 ORDER BY username ASC");
	$users = $database->loadObjectList();
	if ($database -> getErrorNum()) {
		echo $database -> stderr();
		return false;
	}
	
	$database->setQuery("SELECT f.cb_field,f.name as name,c.name as cbname,c.table FROM #__comprofiler_fields as c ".
						"LEFT JOIN #__adsmanager_fields as f ON f.cb_field  = c.fieldid ".
						"WHERE f.cb_field <> 1 AND f.published = 1");
									
	$rows = $database->loadObjectList();
	$cbvalues[] = array();
	for($i=0,$nb=count($rows);$i<$nb;$i++)
	{
		if ($rows[$i]->table == "#__comprofiler")
			$sql= " SELECT DISTINCT ".$rows[$i]->cbname." FROM #__comprofiler as cb WHERE 1 ORDER BY ".$rows[$i]->cbname." ASC";
		else
			$sql= " SELECT DISTINCT ".$rows[$i]->cbname." FROM #__users AS u WHERE 1 ORDER BY ".$rows[$i]->cbname." ASC";
		$database->setQuery($sql);
		$cbvalues[$rows[$i]->cb_field] = $database->loadResultArray();
	}	

	$database->setQuery("SELECT catid FROM #__adsmanager_adcat WHERE adid=$id");
	$selectedcats = $database->loadResultArray();
	if ($database -> getErrorNum()) {
		echo $database -> stderr();
		return false;
	}	
	$ad->selectedcats = $selectedcats;
	
	$plugins = get_plugins();

	HTML_adsmanager::displayAd($option, $ad,$fields,$field_values,$children,$conf,$users,$cbvalues,1,$plugins);
}

function newAd( $option){
	global $database;
	
	$database->setQuery( "SELECT c.* FROM #__adsmanager_categories as c ".
						 "WHERE 1 ORDER BY c.parent,c.ordering");
	$rows = $database->loadObjectList();
	if ($database -> getErrorNum()) {
		echo $database -> stderr();
		return false;
	}
						 
	// establish the hierarchy of the menu
	$children = array();
	// first pass - collect children
	foreach ($rows as $v ) {
		$pt 	= $v->parent;
		$list 	= @$children[$pt] ? $children[$pt] : array();
		array_push( $list, $v );
		$children[$pt] = $list;
	}
	
	$row = new adsManagerAd($database);
	
	// get configuration
	$database->setQuery( "SELECT * FROM #__adsmanager_config");
	$database->loadObject($conf);
	if ($database -> getErrorNum()) {
		echo $database -> stderr();
		return false;
	}
	
	//get fields
	$database->setQuery( "SELECT * FROM #__adsmanager_fields WHERE published = 1 ORDER by ordering");
	$fields = $database->loadObjectList();
	if ($database -> getErrorNum()) {
		echo $database -> stderr();
		return false;
	}	
	
	//get value fields
	$database->setQuery( "SELECT * FROM #__adsmanager_field_values ORDER by ordering ");
	$fieldvalues = $database->loadObjectList();
	if ($database -> getErrorNum()) {
		echo $database -> stderr();
		return false;
	}
	
	$field_values = array();
	// first pass - collect children
	foreach ($fieldvalues as $v ) {
		$pt 	= $v->fieldid;
		$list 	= @$field_values[$pt] ? $field_values[$pt] : array();
		array_push( $list, $v );
		$field_values[$pt] = $list;
	}
	
	foreach($fields as $field)
	{
		if ($field->cbfieldvalues != "-1")
		{
			/*get CB value fields */
			$database->setQuery( "SELECT *, fieldtitle as fieldvalue FROM #__comprofiler_field_values WHERE fieldid = $field->cbfieldvalues ORDER by ordering ");
			$cbfieldvalues = $database->loadObjectList();
			if ($database -> getErrorNum()) {
				echo $database -> stderr();
				return false;
			}
			$field_values[$field->fieldid] = $cbfieldvalues;
		}
	}
	
	//get users
	$database->setQuery( "SELECT * FROM #__users WHERE 1  ORDER BY username ASC");
	$users = $database->loadObjectList();
	if ($database -> getErrorNum()) {
		echo $database -> stderr();
		return false;
	}
	
	$database->setQuery("SELECT f.name as name,c.name as cbname,c.table FROM #__comprofiler_fields as c ".
						"LEFT JOIN #__adsmanager_fields as f ON f.cb_field  = c.fieldid ".
						"WHERE f.cb_field <> 1 AND f.published = 1");
									
	$rows = $database->loadObjectList();
	$sql="SELECT ";
	for($i=0,$nb=count($rows);$i<$nb;$i++)
	{
		if ($rows[$i]->table == "#__comprofiler")
			$sql .= "cb.".$rows[$i]->cbname." as ".$rows[$i]->name;
		else
			$sql .= "u.".$rows[$i]->cbname." as ".$rows[$i]->name;
			
		if ($i != $nb - 1)
			$sql .= ",";
	}				

	$database->setQuery("$sql FROM #__comprofiler as cb WHERE 1");										
	$cbvalues = $database->loadObjectList();	
	$row->selectedcats = null;
	
	$plugins = get_plugins();
	
	HTML_adsmanager::displayAd($option,$row,$fields,$field_values,$children,$conf,$users,$cbvalues,0,$plugins);
}

function deleteAd($option){	
	global $database,$mosConfig_absolute_path;
	
	$tid = $_POST['tid'];
	if (!is_array($tid) || count($tid) < 1) {
		echo "<script> alert('Select an item to delete'); window.history.go(-1);</script>\n";
		exit();
	}

	// get configuration
	$database->setQuery( "SELECT * FROM #__adsmanager_config");
	$database->loadObject($conf);
	if ($database -> getErrorNum()) {
		echo $database -> stderr();
		return false;
	}
	
	$plugins = get_plugins();

	foreach ($tid as $adid)
	{
		remove_ad($adid,$conf,$plugins);
	}
	
	// clean any existing cache files
	mosCache::cleanCache( $option );
	
	mosRedirect("index2.php?option=$option&act=ads", ADSMANAGER_ADS_DELETED);
}

function recurseSearch ($rows,&$list,$catid){
	foreach($rows as $row) {
		if ($row->parent == $catid)
		{
			$list[]= $row->id;
			recurseSearch($rows,$list,$row->id);
		} 
	}
}

function listAds($option){
	global $database,$mosConfig_list_limit,$mainframe;
	
	//$catid = mosGetParam( $_REQUEST, 'catid', 0 );
	$catid = $mainframe->getUserStateFromRequest( "catid", 'catid', "0" );
	$filterPublish = $mainframe->getUserStateFromRequest( "filterPublish", 'filterPublish', "" );
	
	if ($filterPublish != "")
		$sql_filter = " AND a.published = $filterPublish";
	else
		$sql_filter = "";
		
	$database->setQuery("SELECT c.name, c.id FROM #__adsmanager_categories as c WHERE id=".$catid);
	$cats = $database -> loadObjectList();
	if ($database -> getErrorNum()) {
		echo $database -> stderr();
		return false;
	}
	
	/****************************/	
	$database->setQuery( "SELECT c.* FROM #__adsmanager_categories as c ".
						 "WHERE 1 ORDER BY c.parent,c.ordering");
	$rows = $database->loadObjectList();
	if ($database -> getErrorNum()) {
		echo $database -> stderr();
		return false;
	}
						 
	// establish the hierarchy of the menu
	$children = array();
	// first pass - collect children
	foreach ($rows as $v ) {
		$pt 	= $v->parent;
		$listtemp 	= @$children[$pt] ? $children[$pt] : array();
		array_push( $listtemp, $v );
		$children[$pt] = $listtemp;
	}
	
	$search = $mainframe->getUserStateFromRequest( "search", 'search', "" );
	
	// establish the hierarchy of the menu
	$list[] = $catid;
	recurseSearch($rows,$list,$catid);
	$listids = implode(',', $list);
	$database->setQuery("SELECT count(*) FROM #__adsmanager_ads as a ".
						"LEFT JOIN #__users as u ON a.userid = u.id ". 
						"LEFT JOIN #__adsmanager_adcat as adcat ON adcat.adid = a.id ".
						"WHERE adcat.catid IN ($listids) AND (a.userid = 0 OR (u.username LIKE '%$search%' OR u.name LIKE '%$search%'))".$sql_filter);			
	$total = $database->loadResult();
		
	$limit = intval( $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit ) );
	$limitstart = intval( $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 ) );
		
	$database->setQuery("SELECT a.*,u.username,c.name as catname,adcat.catid as category FROM #__adsmanager_ads as a ".
						"LEFT JOIN #__users as u ON a.userid = u.id ". 
						"LEFT JOIN #__adsmanager_adcat as adcat ON adcat.adid = a.id ".
						"LEFT JOIN #__adsmanager_categories as c ON c.id = adcat.catid ".
						"WHERE adcat.catid IN ($listids) AND (a.userid = 0 OR (u.username LIKE '%$search%' OR u.name LIKE '%$search%')) $sql_filter ".
						"GROUP BY a.id ORDER BY a.id DESC",
						$limitstart,$limit);
		
	/********************************/				
	require_once( $GLOBALS['mosConfig_absolute_path'] . '/administrator/includes/pageNavigation.php' );
	$pageNav = new mosPageNav( $total, $limitstart,$limit );
	$navlink = "index2.php?option=$option&act=ads&catid=".$catid;

	$rows = $database -> loadObjectList();
	if ($database -> getErrorNum()) {
		echo $database -> stderr();
		return false;
	}
	
	if(!isset($cats[0]))
	{
		$cats[0]->id = 0;
		$cats[0]->name ="";
	}
	
	// get configuration
	$database->setQuery( "SELECT * FROM #__adsmanager_config");
	$database->loadObject($conf);
	if ($database -> getErrorNum()) {
		echo $database -> stderr();
		return false;
	}
	
	$nbimages = $conf->nb_images;
	if (function_exists("getMaxPaidSystemImages"))
	{
		$nbimages += getMaxPaidSystemImages();
	}
	
	HTML_adsmanager::listAds($cats[0],$option, $rows,$pageNav,$navlink,$children,$nbimages,$search,$filterPublish);
}

function publishAd($option){
	global $database;
	
	$tid = $_GET['tid'];
	if (!is_array($tid) || count($tid) < 1) {
		echo "<script> alert('Select an item to publish'); window.history.go(-1);</script>\n";
		exit();
	}
	
	if(isset($_GET['publish']))
	{
		$publish = $_GET['publish'];
	}
	else
	{
		mosRedirect("index2.php?option=$option&act=ads", ADSMANAGER_ERROR_IN_URL);
		return;
	}

	if (count($tid))
	{
		$ids = implode(',', $tid);
		$database->setQuery("UPDATE #__adsmanager_ads SET `published` = '$publish' WHERE `id` IN ($ids) ");
	}
	if (!$database->query()) {
		echo "<script> alert('"
			.$database -> getErrorMsg()
			."'); window.history.go(-1); </script>\n";
	}
	mosRedirect("index2.php?option=$option&act=ads","");
}

function displayTools($option){
	HTML_adsmanager::displayTools($option);
}

function displayMain($option){
	HTML_adsmanager::displayMain($option);
}

function showField( $option ) {
	global $database;

	$database->setQuery( "SELECT f.* FROM #__adsmanager_fields AS f ".
						 "WHERE 1 ORDER by f.ordering" );

	$rows = $database->loadObjectList();
	if ($database->getErrorNum()) {
		echo $database->stderr();
		return;
	}
	
	require_once( $GLOBALS['mosConfig_absolute_path'] . '/administrator/includes/pageNavigation.php' );
	$pageNav = new mosPageNav( count($rows), 0,count($rows) );

	HTML_adsmanager::showFields( $rows, $option ,$pageNav );
}

function editField($option) {
	global $database,$mosConfig_dbprefix,$mosConfig_absolute_path;

	$tid = mosGetParam( $_REQUEST, 'tid', 0 );
	if (is_array( $tid )) {
		$tid = $tid[0];
	}

	$row = new adsManagerField( $database );
	// load the row from the db table
	$row->load( $tid );
	
	
	$database->setQuery( "SELECT c.* FROM #__adsmanager_columns AS c ".
						 "WHERE 1 ORDER by c.ordering" );

	$rows = $database->loadObjectList();
	if ($database->getErrorNum()) {
		echo $database->stderr();
		return;
	}
	
	$database->setQuery( "SELECT c.* FROM #__adsmanager_positions AS c WHERE 1 " );

	$rows2 = $database->loadObjectList();
	if ($database->getErrorNum()) {
		echo $database->stderr();
		return;
	}
	
	/****************************/	
	$database->setQuery( "SELECT c.* FROM #__adsmanager_categories as c ".
						 "WHERE 1 ORDER BY c.parent,c.ordering");
	$catstemp = $database->loadObjectList();
	if ($database -> getErrorNum()) {
		echo $database -> stderr();
		return false;
	}
						 
	// establish the hierarchy of the menu
	$cats = array();
	// first pass - collect children
	foreach ($catstemp as $v ) {
		$pt 	= $v->parent;
		$listtemp 	= @$cats[$pt] ? $cats[$pt] : array();
		array_push( $listtemp, $v );
		$cats[$pt] = $listtemp;
	}
	
	$columns = array();
	$types = array();
	$lists = array();
	$positions = array();
	$cbfields = array();
	$sort_direction = array();
	$display_title_list = array();

	$types[] = mosHTML::makeOption( 'checkbox', 'Check Box (Single)' );
	$types[] = mosHTML::makeOption( 'multicheckbox', 'Check Box (Muliple)' );
	$types[] = mosHTML::makeOption( 'multicheckboximage', 'Check Box (Muliple Images)' );
	$types[] = mosHTML::makeOption( 'date', 'Date' );
	$types[] = mosHTML::makeOption( 'select', 'Drop Down (Single Select)' );
	$types[] = mosHTML::makeOption( 'multiselect', 'Drop Down (Multi-Select)' );
	$types[] = mosHTML::makeOption( 'emailaddress', 'Email Address' );	
	$types[] = mosHTML::makeOption( 'number', 'Number Text' );	
	$types[] = mosHTML::makeOption( 'price', 'Price' );	
	$types[] = mosHTML::makeOption( 'editor', 'Editor Text Area' );
	$types[] = mosHTML::makeOption( 'textarea', 'Text Area' );
	$types[] = mosHTML::makeOption( 'text', 'Text Field' );
	$types[] = mosHTML::makeOption( 'url', 'URL' );
	$types[] = mosHTML::makeOption( 'radio', 'Radio Button' );
	$types[] = mosHTML::makeOption ('radioimage','Radio Button (Image)');
	$types[] = mosHTML::makeOption( 'file', 'File' );
	
	$plugins = get_plugins();
	if(isset($plugins))
		foreach($plugins as $key => $plug)
		{
			$types[] = mosHTML::makeOption( $key, $plug->getFieldName() ); 
		}
	
	$columns[] = mosHTML::makeOption( '-1', 'No Column' );
	foreach($rows as $col)
	{
		if ((@$col->name)&&($col->name!=""))
			$coln = am_getLangDefinition  ($col->name);
		$columns[] = mosHTML::makeOption( "$col->id", "$coln" );
	}
	
	$fvalues = $database->setQuery( "SELECT fieldtitle,fieldvalue "
		. "\n FROM #__adsmanager_field_values"
		. "\n WHERE fieldid=$tid"
		. "\n ORDER BY ordering" );
	$fvalues = $database->loadObjectList();
	
	$database->setQuery("SHOW TABLES LIKE '".$mosConfig_dbprefix."comprofiler_fields'"  );
	//echo "SHOW TABLES LIKE '".$mosConfig_dbprefix."comprofiler_fields'" ;
	$tables = $database -> loadObjectList();
	if (count($tables) > 0)
	{
		$database->setQuery("SELECT * FROM #__comprofiler_fields WHERE 1"  );
		$cb_fields = $database -> loadObjectList();
	}
	
	$cbfields[] = mosHTML::makeOption( '-1', ADSMANAGER_NOT_USED );
	if (isset($cb_fields))
	{
		foreach($cb_fields as $cb)
		{
			$cbfields[] = mosHTML::makeOption( $cb->fieldid, "(".$cb->fieldid.") ".$cb->name );
		}
	}
	//echo "count=".count($cb_fields);
	
	$positions[] = mosHTML::makeOption( '-1', ADSMANAGER_NO_DISPLAY );
	
	foreach($rows2 as $pos)
	{
		if ((@$pos->title)&&($pos->title!=""))
			$p = "(".am_getLangDefinition ($pos->title).")";
		else
			$p = "";
		$positions[] = mosHTML::makeOption( "$pos->id", "$pos->name.$p" );
	}

	$sort_direction[] = mosHTML::makeOption( 'DESC', ADSMANAGER_CMN_SORT_DESC );
	$sort_direction[] = mosHTML::makeOption( 'ASC', ADSMANAGER_CMN_SORT_ASC );
	
	$display_title_list[] = mosHTML::makeOption( '0', ADSMANAGER_NO_DISPLAY );
	$display_title_list[] = mosHTML::makeOption( '1', ADSMANAGER_DISPLAY_DETAILS );
	$display_title_list[] = mosHTML::makeOption( '2', ADSMANAGER_DISPLAY_LIST );
	$display_title_list[] = mosHTML::makeOption( '3', ADSMANAGER_DISPLAY_LIST_AND_DETAILS );
	
	$lists['display_title'] = mosHTML::selectList( $display_title_list, 'display_title', 'class="inputbox" size="1"', 'value', 'text', $row->display_title );
		
	$lists['type'] = mosHTML::selectList( $types, 'type', 'class="inputbox" size="1" onchange="selType(this.options[this.selectedIndex].value);"', 'value', 'text', $row->type );

	$lists['required'] = mosHTML::yesnoSelectList( 'required', 'class="inputbox" size="1"', $row->required );
	
	$lists['columns'] = mosHTML::selectList( $columns, 'columnid', 'class="inputbox" size="1"', 'value', 'text', $row->columnid );

	$lists['positions'] = mosHTML::selectList( $positions, 'pos', 'class="inputbox" size="1"', 'value', 'text', $row->pos );

	$lists['profile'] = mosHTML::yesnoSelectList( 'profile', 'class="inputbox" size="1"', $row->profile );

	$lists['cbfields'] = mosHTML::selectList( $cbfields, 'cb_field', 'class="inputbox" size="1"', 'value', 'text', $row->cb_field );
	$lists['cbfieldvalues'] = mosHTML::selectList( $cbfields, 'cbfieldvalues', 'class="inputbox" size="1"', 'value', 'text', $row->cbfieldvalues );
	
	if (!isset($row->editable))
		$row->editable = 1;
	$lists['editable'] = mosHTML::yesnoSelectList( 'editable', 'class="inputbox" size="1"', $row->editable );
	
	$lists['searchable'] = mosHTML::yesnoSelectList( 'searchable', 'class="inputbox" size="1"', $row->searchable );
	
	$lists['sort'] = mosHTML::yesnoSelectList( 'sort', 'class="inputbox" size="1"', $row->sort );
	
	$lists['sort_direction'] = mosHTML::selectList( $sort_direction, 'sort_direction', 'class="inputbox" size="1"', 'value', 'text', $row->sort_direction );
	
	$lists['published'] = mosHTML::yesnoSelectList( 'published', 'class="inputbox" size="1"', $row->published );
	
	$path = "$mosConfig_absolute_path/images/$option/fields";
	$handle = opendir( $path );

	$fieldimages = array();
	while ($file = readdir($handle)) {
		$dir = mosPathName( $path.'/'.$file, false );
		if (!is_dir($dir))
		{
			if (($file != ".") && ($file != "..")) {
			$fieldimages[] = $file;
			}
		}
	}
	closedir($handle);

	HTML_adsmanager::editfield( $row, $lists, $fvalues, $option, $tid ,$cats,count($catstemp),$plugins,$fieldimages);
}

function saveField( $option ) {
	global $database, $my, $_POST, $mosConfig_live_site, $ueConfig;

	$row = new adsManagerField( $database );
	if (!$row->bind( $_POST )) {
		echo "<script type=\"text/javascript\"> alert('".addslashes(end($row -> getErrors()))."'); window.history.go(-1); </script>\n";
		exit();
	}
	
	mosMakeHtmlSafe($row);

	$row->name = str_replace(" ", "", strtolower($row->name));
	
	if (!$row->check()) {
		echo "<script type=\"text/javascript\"> alert('".addslashes(end($row -> getErrors()))."'); window.history.go(-2); </script>\n";
		exit();
	}
	if (!$row->store($_POST['fieldid'])) {
		echo "<script type=\"text/javascript\"> alert('".addslashes(end($row -> getErrors()))."'); window.history.go(-2); </script>\n";
		exit();
	}
	$fieldValues = array();
	$fieldNames  = array();
	$fieldNames  = $_POST['vNames'];
	$fieldValues = $_POST['vValues'];
	$fieldImagesSelect = $_POST['vSelectImages'];
	$fieldImagesValues = $_POST['vImagesValues'];
	$j=1;
	if($row->fieldid > 0) {
		$database->setQuery( "DELETE FROM #__adsmanager_field_values"
			. " WHERE fieldid='".$row->fieldid."'" );
		if(!$database->loadResult()) echo $database->getErrorMsg();
	} else {
		$database->setQuery( "SELECT MAX(fieldid) FROM #__adsmanager_fields");
		$maxID=$database->loadResult();
		$row->fieldid=$maxID;
		echo $database->getErrorMsg();
	}

	//foreach ($fieldNames as $fieldName) {
	switch($row->type) {
		case "select":
	    case "multiselect":
		case "radio":
		case "multicheckbox":
		case "price":
			$j=0;$i=0;
			while(isset($fieldNames[$i])){
				$fieldName  = $fieldNames[$i];
				$fieldValue = $fieldValues[$i];
				$i++;
				
				if(trim($fieldName)!=null || trim($fieldName)!='') {
					$database->setQuery( "INSERT INTO #__adsmanager_field_values (fieldid,fieldtitle,fieldvalue,ordering)"
						. " VALUES('$row->fieldid','".htmlspecialchars($fieldName)."','".htmlspecialchars($fieldValue)."',$j)"
					);
					if(!$database->loadResult()) echo $database->getErrorMsg();
					$j++;
				}
			}
			break;
		case 'radioimage':
		case 'multicheckboximage':
			$j=0;$i=0;
			while(isset($fieldImagesSelect[$i])){
				$fieldName  = $fieldImagesSelect[$i];
				$fieldValue = $fieldImagesValues[$i];
				$i++;
				
				if(trim($fieldName)!=null && trim($fieldName)!='' && trim($fieldName)!='null') {
					$database->setQuery( "INSERT INTO #__adsmanager_field_values (fieldid,fieldtitle,fieldvalue,ordering)"
						. " VALUES('$row->fieldid','".htmlspecialchars($fieldName)."','".htmlspecialchars($fieldValue)."',$j)"
					);
					if(!$database->loadResult()) echo $database->getErrorMsg();
					$j++;
				}
			}
			break;
	}
	
	$field_catsid = mosGetParam( $_POST, "field_catsid", array() );
	$field_catsid = ",".implode(',', $field_catsid).",";
	if ($field_catsid != "")
	{
		$query = "UPDATE #__adsmanager_fields SET catsid ='$field_catsid' WHERE fieldid=$row->fieldid ";
		$database->setQuery( $query);
		$database->query();
	}
	
	//Update Content Fields
	$plugins = get_plugins(); 
	$plugfield = false;
	if (isset($plugins["$row->type"]))
	{
		$plugins["$row->type"]->saveFieldOptions($row->fieldid);
		$plugfield = true;
		//return;
	}
	
	if ($plugfield == false)
	{
		//Update Ad Fields
	    $database->setQuery("SELECT $row->name FROM #__adsmanager_ads WHERE 1");
	    $database->loadObjectList();
		if ($database->getErrorNum()) {
			$database->setQuery("ALTER TABLE #__adsmanager_ads ADD `$row->name` TEXT NOT NULL");
			$result = $database->query();
	    }
	    
	    if ($row->profile == 1)
	    {
			//Update Profile Fields
			$database->setQuery("SELECT $row->name FROM #__adsmanager_profile WHERE 1");
			$database->loadObjectList();
			if ($database->getErrorNum()) {
				$database->setQuery("ALTER TABLE #__adsmanager_profile ADD `$row->name` TEXT NOT NULL");
				$result = $database->query();
			}
		}
		else
		{
			//Update Profile Fields
			$database->setQuery("SELECT $row->name FROM #__adsmanager_profile WHERE 1");
			$database->loadObjectList();
			if (!$database->getErrorNum()) {
				$database->setQuery("ALTER TABLE #__adsmanager_profile DROP `$row->name`");
				$result = $database->query();
			}
		}
	}
	mosRedirect( "index2.php?option=$option&act=fields", ADSMANAGER_UPDATE_SUCCESSFULL);
}

function removeField($option ) {
	global $database, $acl, $ueConfig;

	$tid = mosGetParam( $_REQUEST, 'tid', 0 );
	
	if (!is_array( $tid ) || count( $tid ) < 1) {
		echo "<script type=\"text/javascript\"> alert('Select an item to delete'); window.history.go(-1);</script>\n";
		exit;
	}
	$msg = '';
	
	foreach($tid as $id)
	{
		$row = new adsManagerField( $database );
		// load the row from the db table
		$row->load( $id );
		
		if(($row->name == "name")||($row->name == "email")||($row->name == "ad_text")||($row->name == "ad_headline"))
		{
			mosRedirect( "index2.php?option=$option&act=fields", ADSMANAGER_ERROR_SYSTEM_FIELD);
			return;
		}
	
		//Update Ad Fields
		$database->setQuery("SELECT $row->name FROM #__adsmanager_ads WHERE 1");
		$database->loadObjectList();
		if (!$database->getErrorNum()) {
			$database->setQuery("ALTER TABLE #__adsmanager_ads DROP `$row->name`");
			$result = $database->query();
		}
		
		//Update Profile Fields
		$database->setQuery("SELECT $row->name FROM #__adsmanager_profile WHERE 1");
		$database->loadObjectList();
		if (!$database->getErrorNum()) {
			$database->setQuery("ALTER TABLE #__adsmanager_profile DROP `$row->name`");
			$result = $database->query();
		}
	}
	
	if (count($tid))
	{
		$ids = implode(',', $tid);
		$database->setQuery("DELETE FROM #__adsmanager_fields WHERE fieldid IN ($ids)");
	}
	if (!$database->query()) {
		echo "<script> alert('"
			.$database -> getErrorMsg()
			."'); window.history.go(-1); </script>\n";
	}
	
	if (count($tid))
	{
		
		$ids = implode(',', $tid);
		$database->setQuery("DELETE FROM #__adsmanager_field_values WHERE fieldid  IN ($ids)");
	}
	if (!$database->query()) {
		echo "<script> alert('"
			.$database -> getErrorMsg()
			."'); window.history.go(-1); </script>\n";
	}
	
	mosRedirect( "index2.php?option=$option&act=fields", $msg );
}


function saveFieldOrder( &$tid,$option ) {
	global $database;

	$total		= count( $tid );
	$order 		= mosGetParam( $_POST, 'order', array(0) );
	$row 		= new adsManagerField( $database );

	// update ordering values
	for( $i=0; $i < $total; $i++ ) {
		$row->load( $tid[$i] );
		if ($row->ordering != $order[$i]) {
			$row->ordering = $order[$i];
			if (!$row->store()) {
				echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
				exit();
			} // if
		} // if
	} // for

	// clean any existing cache files
	mosCache::cleanCache( $option );
	
	mosRedirect("index2.php?option=$option&act=fields", ADSMANAGER_FIELDS_REORDER);
} // saveOrder

/**
* Moves the order of a record
* @param integer The increment to reorder by
*/
function orderField( $uid, $inc, $option ) {
	global $database;

	$row = new adsManagerField( $database );
	$row->load( $uid );
	$row->move( $inc, "1" );

	// clean any existing cache files
	mosCache::cleanCache( $option );

	mosRedirect("index2.php?option=$option&act=fields", "");
}

function publishField($option){
	global $database;
	
	$tid = $_GET['tid'];
	if (!is_array($tid) || count($tid) < 1) {
		echo "<script> alert('Select an item to publish'); window.history.go(-1);</script>\n";
		exit();
	}
	
	if(isset($_GET['publish']))
	{
		$publish = $_GET['publish'];
	}
	else
	{
		mosRedirect("index2.php?option=$option&act=fields", ADSMANAGER_ERROR_IN_URL);
		return;
	}

	if (count($tid))
	{
		$ids = implode(',', $tid);
		$database->setQuery("UPDATE #__adsmanager_fields SET `published` = '$publish' WHERE `fieldid` IN ($ids) ");
	}
	if (!$database->query()) {
		echo "<script> alert('"
			.$database -> getErrorMsg()
			."'); window.history.go(-1); </script>\n";
	}
	else
		mosRedirect("index2.php?option=$option&act=fields", "");
}

function requiredField($option){
	global $database;
	
	$tid = $_GET['tid'];
	if (!is_array($tid) || count($tid) < 1) {
		echo "<script> alert('Select an item to publish'); window.history.go(-1);</script>\n";
		exit();
	}
	
	if(isset($_GET['required']))
	{
		$required = $_GET['required'];
	}
	else
	{
		mosRedirect("index2.php?option=$option&act=fields", ADSMANAGER_ERROR_IN_URL);
		return;
	}

	if (count($tid))
	{
		$ids = implode(',', $tid);
		echo "UPDATE #__adsmanager_ads SET `required` = '$required' WHERE `fieldid` IN ($ids) ";
		$database->setQuery("UPDATE #__adsmanager_fields SET `required` = '$required' WHERE `fieldid` IN ($ids) ");
	}
	if (!$database->query()) {
		echo "<script> alert('"
			.$database -> getErrorMsg()
			."'); window.history.go(-1); </script>\n";
	}
	else
		mosRedirect("index2.php?option=$option&act=fields", ADSMANAGER_UPDATE_SUCCESSFULL);
}

function showColumns( $option ) {
	global $database;

	$database->setQuery( "SELECT c.* FROM #__adsmanager_columns AS c ".
						 "WHERE 1 ORDER by c.ordering" );

	$rows = $database->loadObjectList();
	if ($database->getErrorNum()) {
		echo $database->stderr();
		return;
	}
	
	$database->setQuery( "SELECT c.* FROM #__adsmanager_fields AS c ".
						 "WHERE c.columnid != -1 ORDER by c.columnorder,c.fieldid" );

	$fields = $database->loadObjectList();
	if ($database->getErrorNum()) {
		echo $database->stderr();
		return;
	}
	
	// establish the hierarchy of the menu
	$fColumn = array();
	// first pass - collect children
	foreach ($fields as $f ) {
		$pt 	= $f->columnid;
		$list 	= @$fColumn[$pt] ? $fColumn[$pt] : array();
		array_push( $list, $f );
		$fColumn[$pt] = $list;
	}

	HTML_adsmanager::showColumns( $rows, $fColumn,$option );
}

function editColumn($option) {
	global $database;

	$tid = mosGetParam( $_REQUEST, 'tid', 0 );
	if (is_array( $tid )) {
		$tid = $tid[0];
	}

	$row = new adsManagerColumn( $database );
	// load the row from the db table
	$row->load( $tid );
	
	
	/************* Mod by TomekOmel ***********/
	$database->setQuery( "SELECT c.* FROM #__adsmanager_categories as c ".
						 "WHERE 1 ORDER BY c.parent,c.ordering");
	$catstemp = $database->loadObjectList();
	if ($database -> getErrorNum()) {
		echo $database -> stderr();
		return false;
	}
			 
	// establish the hierarchy of the menu
	$cats = array();
	// first pass - collect children
	foreach ($catstemp as $v ) {
		$pt 	= $v->parent;
		$listtemp 	= @$cats[$pt] ? $cats[$pt] : array();
		array_push( $listtemp, $v );
		$cats[$pt] = $listtemp;
	}
	/************ Mod by TomekOmel *************/

	HTML_adsmanager::editColumn( $row, $option, $cats, count($catstemp));
}

function saveColumn( $option ) {
	global $database, $my, $_POST, $mosConfig_live_site, $ueConfig;

	$row = new adsManagerColumn( $database );
	if (!$row->bind( $_POST )) {
		echo "<script type=\"text/javascript\"> alert('".addslashes(end($row -> getErrors()))."'); window.history.go(-1); </script>\n";
		exit();
	}
	
	/************* Mod by TomekOmel ***********/
	
	mosMakeHtmlSafe($row);
	
	$field_catsid = mosGetParam( $_POST, "catsid", array() );
	$field_catsid = ",".implode(',', $field_catsid).",";
	
	if ($field_catsid != "")
	{
		$query = "UPDATE #__adsmanager_columns SET catsid ='$field_catsid' WHERE id=$row->id ";
		$database->setQuery( $query);
		$database->query();
	}
	/************ Mod by TomekOmel *************/
	
	if (!$row->store()) {
		echo "<script type=\"text/javascript\"> alert('".addslashes(end($row -> getErrors()))."'); window.history.go(-2); </script>\n";
		exit();
	}
	
	mosCache::cleanCache( $option );

	mosRedirect( "index2.php?option=$option&act=columns", ADSMANAGER_UPDATE_SUCCESSFULL);
}

function removeColumn($option ) {
	global $database, $acl, $ueConfig;

	$tid = mosGetParam( $_REQUEST, 'tid', 0 );
	
	if (!is_array( $tid ) || count( $tid ) < 1) {
		echo "<script type=\"text/javascript\"> alert('".ADSMANAGER_SELECT_ITEM_TO_BE_DELETED."'); window.history.go(-1);</script>\n";
		exit;
	}
	$msg = '';
	
	if (count($tid))
	{
		$ids = implode(',', $tid);
		$database->setQuery("DELETE FROM #__adsmanager_columns WHERE id IN ($ids)");
	}
	if (!$database->query()) {
		echo "<script> alert('"
			.$database -> getErrorMsg()
			."'); window.history.go(-1); </script>\n";
	}
	
	if (count($tid))
	{
		$ids = implode(',', $tid);
		$database->setQuery("UPDATE #__adsmanager_fields SET `columnid` = '-1' WHERE `columnid` IN ($ids) ");
	}
	if (!$database->query()) {
		echo "<script> alert('"
			.$database -> getErrorMsg()
			."'); window.history.go(-1); </script>\n";
	}
	
	mosRedirect( "index2.php?option=$option&act=columns", $msg );
}


function showPositions( $option ) {
	global $database;

	$database->setQuery( "SELECT * FROM #__adsmanager_positions WHERE 1 " );

	$rows = $database->loadObjectList();
	if ($database->getErrorNum()) {
		echo $database->stderr();
		return;
	}
	
	$database->setQuery( "SELECT f.* FROM #__adsmanager_fields AS f ".
						 "WHERE 1 ORDER by f.posorder" );

	$fields = $database->loadObjectList();
	if ($database->getErrorNum()) {
		echo $database->stderr();
		return;
	}
	
	// establish the hierarchy of the menu
	$fDisplay = array();
	// first pass - collect children
	foreach ($fields as $f ) {
		$pt 	= $f->pos;
		$list 	= @$fDisplay[$pt] ? $fDisplay[$pt] : array();
		array_push( $list, $f );
		$fDisplay[$pt] = $list;
	}

	HTML_adsmanager::showPositions( $rows, $fDisplay,$option );
}

function editPosition($option) {
	global $database;

	$tid = mosGetParam( $_REQUEST, 'tid', 0 );
	if (is_array( $tid )) {
		$tid = $tid[0];
	}

	$row = new adsManagerPosition( $database );
	// load the row from the db table
	$row->load( $tid );

	HTML_adsmanager::editPosition( $row, $option);
}

function savePosition( $option ) {
	global $database, $my, $_POST, $mosConfig_live_site, $ueConfig;

	$row = new adsManagerPosition( $database );
	if (!$row->bind( $_POST )) {
		echo "<script type=\"text/javascript\"> alert('".addslashes(end($row -> getErrors()))."'); window.history.go(-1); </script>\n";
		exit();
	}
	
	if (!$row->store()) {
		echo "<script type=\"text/javascript\"> alert('".addslashes(end($row -> getErrors()))."'); window.history.go(-2); </script>\n";
		exit();
	}

	mosRedirect( "index2.php?option=$option&act=positions", ADSMANAGER_UPDATE_SUCCESSFULL);
}

function installjoomfish($option)
{
	global $mosConfig_absolute_path;
	
	if(file_exists($mosConfig_absolute_path . "/administrator/components/com_joomfish/contentelements/")){
		$error = 0;
		
		@copy($mosConfig_absolute_path . "/administrator/components/$option/joomfish/adsmanager_ads.xml",$mosConfig_absolute_path . "/administrator/components/com_joomfish/contentelements/adsmanager_ads.xml");
			
		@copy($mosConfig_absolute_path . "/administrator/components/$option/joomfish/adsmanager_categories.xml",$mosConfig_absolute_path . "/administrator/components/com_joomfish/contentelements/adsmanager_categories.xml");

		@copy($mosConfig_absolute_path . "/administrator/components/$option/joomfish/adsmanager_columns.xml",$mosConfig_absolute_path . "/administrator/components/com_joomfish/contentelements/adsmanager_columns.xml");
			
		@copy($mosConfig_absolute_path . "/administrator/components/$option/joomfish/adsmanager_config.xml",$mosConfig_absolute_path . "/administrator/components/com_joomfish/contentelements/adsmanager_config.xml");
			
		@copy($mosConfig_absolute_path . "/administrator/components/$option/joomfish/adsmanager_fields.xml",$mosConfig_absolute_path . "/administrator/components/com_joomfish/contentelements/adsmanager_fields.xml");
		
		@copy($mosConfig_absolute_path . "/administrator/components/$option/joomfish/adsmanager_field_values.xml",$mosConfig_absolute_path . "/administrator/components/com_joomfish/contentelements/adsmanager_field_values.xml");
		
			
		mosRedirect( "index2.php?option=$option&act=tools", ADSMANAGER_INSTALL_SUCCESSFULL);
	}
	else
	{
		mosRedirect( "index2.php?option=$option&act=tools", ADSMANAGER_ERROR_INSTALL);
	}
}

function installsef($option)
{
	global $mosConfig_absolute_path;
	
	if(file_exists($mosConfig_absolute_path . "/components/com_sef/sef_ext/")){
		if(!file_exists($mosConfig_absolute_path . "/components/com_sef/sef_ext/$option.php"))
		{
			@copy($mosConfig_absolute_path . "/administrator/components/$option/sef/$option.php",$mosConfig_absolute_path . "/components/com_sef/sef_ext/$option.php");
			mosRedirect( "index2.php?option=$option&act=tools", ADSMANAGER_INSTALL_SUCCESSFULL);
		}
		else
		{
			mosRedirect( "index2.php?option=$option&act=tools", ADSMANAGER_ALREADY_INSTALL);
		}	
	}
	else
	{
		mosRedirect( "index2.php?option=$option&act=tools", ADSMANAGER_ERROR_INSTALL);
	}
}


function rmdir_rf($dirName) {
    if(empty($dirName)) {
		@rmdir($dirName);
        return;
    }
    if(file_exists($dirName)) {
        $dir = dir($dirName);
        while($file = $dir->read()) {
            if($file != '.' && $file != '..') {
                if(is_dir($dirName.'/'.$file)) {
                    rmdir_rf($dirName.'/'.$file);
                } else {
                    @unlink($dirName.'/'.$file);
                }
            }
        }
        @rmdir($dirName.'/'.$file);
    } 
}

function listPlugins($option)
{
	global $mosConfig_absolute_path,$database;
	$path = $mosConfig_absolute_path."/images/com_adsmanager/plugins/";
	$handle = opendir( $path );
	$plugins = null;
	while ($file = readdir($handle)) {
		$dir = mosPathName( $path.'/'.$file, false );
		if (is_dir($dir))
		{
			if (($file != ".") && ($file != "..")) {
				if (!file_exists($path.'/'.$file.'/plug.php'))
					rmdir_rf($path);
				else
					$plugins[] = $file;
			}
		}
	}
	closedir($handle);
	
	HTML_adsmanager::listPlugins($plugins,$option);
}

/**
* @param string The class name for the installer
* @param string The URL option
* @param string The element name
*/

function installPlugin($option ) {

	global $mosConfig_absolute_path;

	// Check that the zlib is available
	if(!extension_loaded('zlib')) {
		mosRedirect( "index2.php?option=$option&act=plugins", "The installer can't continue before zlib is installed" );
	}

	$userfile = mosGetParam( $_FILES, 'userfile', null );
	$name = substr ( $userfile['name'], 0 , strpos($userfile['name'],'.')); 
	if (eregi( '.zip$', $userfile['name'] )) {
		// Extract functions
		require_once( $mosConfig_absolute_path . '/administrator/includes/pcl/pclzip.lib.php' );
		require_once( $mosConfig_absolute_path . '/administrator/includes/pcl/pclerror.lib.php' );
		//require_once( $mosConfig_absolute_path . '/administrator/includes/pcl/pcltrace.lib.php' );
		//require_once( $mosConfig_absolute_path . '/administrator/includes/pcl/pcltar.lib.php' );
		$zipfile = new PclZip( $userfile['tmp_name'] );
		if(substr(PHP_OS, 0, 3) == 'WIN') {
			define('OS_WINDOWS',1);
		} else {
			define('OS_WINDOWS',0);
		}

		$ret = $zipfile->extract( PCLZIP_OPT_PATH, $mosConfig_absolute_path."/images/$option/plugins/".$name );
		if($ret == 0) {
			$this->setError( 1, 'Unrecoverable error "'.$zipfile->errorName(true).'"' );
			return false;
		}
	} else {
		require_once( $mosConfig_absolute_path . '/includes/Archive/Tar.php' );
		$archive = new Archive_Tar( $userfile['tmp_name'] );
		$archive->setErrorHandling( PEAR_ERROR_PRINT );

		if (!$archive->extractModify( $mosConfig_absolute_path."/images/$option/plugins/".$name, '' )) {
			$this->setError( 1, 'Extract Error' );
			return false;
		}
	}
	
	require_once($mosConfig_absolute_path."/images/$option/plugins/".$name."/plug.php");
	foreach($plugins as $plug)
	{
		$plug->install();
	}
	
	mosRedirect("index2.php?option=$option&act=plugins", "");
}

function deletePlugin($option){
	global $database,$mosConfig_absolute_path;
	
	$tid = $_POST['tid'];
	if (!is_array($tid) || count($tid) < 1) {
		echo "<script> alert('Select an plugin to delete'); window.history.go(-1);</script>\n";
		exit();
	}
	foreach($tid as $pluginname)
	{
		$adsmanagerPlugins = array();
		$path = $mosConfig_absolute_path."/images/com_adsmanager/plugins/$pluginname";
		
		require_once($path."/plug.php");
		foreach($adsmanagerPlugins as $plug)
		{
			$plug->uninstall();
		}
	
		if ($pluginname != "")
			rmdir_rf($path);
	}
	
	mosRedirect("index2.php?option=$option&act=plugins", "");
}

function listFieldImages($option)
{
	global $mosConfig_absolute_path,$database;
	$path = $mosConfig_absolute_path."/images/$option/fields";
	$handle = opendir( $path );
	$fieldimages = array();
	while ($file = readdir($handle)) {
		$dir = mosPathName( $path.'/'.$file, false );
		if (!is_dir($dir))
		{
			if (($file != ".") && ($file != "..")) {
			$fieldimages[] = $file;
			}
		}
	}
	closedir($handle);	
	
	HTML_adsmanager::listFieldImages($fieldimages,$option);
}

/**
* @param string The class name for the installer
* @param string The URL option
* @param string The element name
*/
function uploadFieldImage($option ) {

	global $mosConfig_absolute_path;

	$userfile = mosGetParam( $_FILES, 'userfile', null );
	$filename = $userfile['name'];
	while(file_exists($mosConfig_absolute_path."/images/$option/fields/".$filename)){
		$filename = "copy_".$filename;
	}
	@move_uploaded_file($userfile['tmp_name'],
						$mosConfig_absolute_path."/images/$option/fields/".$filename);	
												
	mosRedirect("index2.php?option=$option&act=fieldimage", "");
}

function deleteFieldImage($option,$directory){
	global $database,$mosConfig_absolute_path;
	
	$tid = $_POST['tid'];
	if (!is_array($tid) || count($tid) < 1) {
		echo "<script> alert('Select an category to delete'); window.history.go(-1);</script>\n";
		exit();
	}
	foreach($tid as $filename)
	{
		if ($filename != "")
		{
			@unlink($mosConfig_absolute_path."/images/$option/fields/".$filename);
		}
	}
	mosRedirect("index2.php?option=$option&act=fieldimage", "");
}

/**
     * Create a 2D array from a CSV string
     *
     * @param mixed $data 2D array
     * @param string $delimiter Field delimiter
     * @param string $enclosure Field enclosure
     * @param string $newline Line seperator
     * @return
     */
function parseCSV($data, $delimiter = ',', $enclosure = '"', $newline = "\n"){
	$pos = $last_pos = -1;
	$end = strlen($data);
	$row = 0;
	$quote_open = false;
	$trim_quote = false;

	$return = array();

	// Create a continuous loop
	for ($i = -1;; ++$i){
		++$pos;
		// Get the positions
		$comma_pos = strpos($data, $delimiter, $pos);
		$quote_pos = strpos($data, $enclosure, $pos);
		$newline_pos = strpos($data, $newline, $pos);

		// Which one comes first?
		$pos = min(($comma_pos === false) ? $end : $comma_pos, ($quote_pos === false) ? $end : $quote_pos, ($newline_pos === false) ? $end : $newline_pos);

		// Cache it
		$char = (isset($data[$pos])) ? $data[$pos] : null;
		$done = ($pos == $end);

		// It it a special character?
		if ($done || $char == $delimiter || $char == $newline){

			// Ignore it as we're still in a quote
			if ($quote_open && !$done){
				continue;
			}

			$length = $pos - ++$last_pos;

			// Is the last thing a quote?
			if ($trim_quote){
				// Well then get rid of it
				--$length;
			}

			// Get all the contents of this column
			$return[$row][] = ($length > 0) ? str_replace($enclosure . $enclosure, $enclosure, substr($data, $last_pos, $length)) : '';

			// And we're done
			if ($done){
				break;
			}

			// Save the last position
			$last_pos = $pos;

			// Next row?
			if ($char == $newline){
				++$row;
			}

			$trim_quote = false;
		}
		// Our quote?
		else if ($char == $enclosure){

			// Toggle it
			if ($quote_open == false){
				// It's an opening quote
				$quote_open = true;
				$trim_quote = false;

				// Trim this opening quote?
				if ($last_pos + 1 == $pos){
					++$last_pos;
				}

			}
			else {
				// It's a closing quote
				$quote_open = false;

				// Trim the last quote?
				$trim_quote = true;
			}

		}

	}
	
	for($i=0 ; $i < count($return);$i++)
	{
		$r = $return[$i];
	//	echo "".$r[count($r)-1];
		$return[$i][count($r)-1] = substr($r[count($r)-1],0,strlen($r[count($r)-1])-1);
	}

	return $return;
}

function import()
{
	global $mosConfig_absolute_path,$database;
	
	$filename =  $mosConfig_absolute_path."/import/ads.csv";
	$handle = fopen( $filename , "r");
	$contents = fread($handle, filesize($filename));
	fclose($handle);
	
	$contents = parseCSV($contents);
	$fields = array();
	//var_dump($contents[1]);
	$fieldnamelist = "'".implode("','",$contents[0])."'";
	$query = "SELECT fieldid,name,type FROM #__adsmanager_fields WHERE name IN ($fieldnamelist)";
	//echo $query;
	$database->setQuery($query);
	$fields = $database->loadObjectList("name");
	//var_dump($fields);
	
	//get value fields
	$database->setQuery( "SELECT * FROM #__adsmanager_field_values ORDER by ordering ");
	$fieldvalues = $database->loadObjectList();
	if ($database -> getErrorNum()) {
		echo $database -> stderr();
		return false;
	}
	
	//get value fields
	$database->setQuery( "SELECT id,name FROM #__adsmanager_categories");
	$categories = $database->loadObjectList("name");
	if ($database -> getErrorNum()) {
		echo $database -> stderr();
		return false;
	}
	
	// get configuration
	$database->setQuery( "SELECT * FROM #__adsmanager_config");
	$database->loadObject($conf);
	if ($database -> getErrorNum()) {
		echo $database -> stderr();
		return false;
	}
	
	for($i = 1; $i < count($contents);$i++)
	{
		$ad_contents = $contents[$i];
		$list_fields = array();
		$list_values = array();
		$images = array();
		$catpresent = false;
		$useridpresent = false;
		foreach($ad_contents as $key => $content)
		{
				if ($content != "")
				{			
					//echo count($contents[0]);
					$fieldname = strtolower($contents[0][$key]);
					if (strpos($fieldname,"image_") !== false)
					{
						$images[] = $content;
					}
					else if ($fieldname == "category")
					{
						$list_fields[] = $fieldname;
						$list_values[] = $categories["$content"]->id;
						$catpresent = true;
					}
					else if ($fieldname == "userid")
					{
						$list_fields[] = $fieldname;
						$list_values[] = $content;
						$useridpresent = true;
					}
					else
					{
						switch($fields[$fieldname]->type)
						{
							case "select":
							case "multiselect":
							case "checkbox":
							case "multicheckbox":
							case "multicheckboximage":
								$found = 0;
								foreach($fieldvalues as $fieldvalue)
								{
									//echo $fieldvalue->fieldid." == ".$fields[$fieldname]->fieldid."<br/>";
									if ($fieldvalue->fieldid == $fields["$fieldname"]->fieldid )
									{
										//echo "$fieldvalue->fieldtitle == $content<br/>";
										if ($fieldvalue->fieldtitle == $content)
										{
											$list_values[] = $fieldvalue->fieldid;
											$list_fields[] = $fieldname;
											$found = 1;
											break;
										}
									}
								}	
								if ($found == 0)
								{
									echo "Ligne ".($key+1).": '$content' n'est pas une valeur possible pour le champ $fieldname<br/>";
								}
								break;
							default:
								$list_fields[] = $fieldname;
								$list_values[] = addslashes($content);
						}
					}
				}
		}
		if ((count($list_fields ) > 0)&&($catpresent == true)&&($useridpresent == true))
		{
			$list_fields[] = "date_created";
			$list_values[] = date("Y-m-d");
			$list_fields[] = "published";
			$list_values[] = "1";
			
			$list_fields = "`".implode("`,`",$list_fields)."`";
			$list_values = "'".implode("','",$list_values)."'";
			$query = "INSERT INTO #__adsmanager_ads ($list_fields) VALUES ($list_values)";
			echo $query;
			$database->setQuery($query);
			$database->query();
			if (!$database -> getErrorNum()) {
				$id = $database->insertid();
				if ($id != "")
				{
					for($i = 0 ;$i < count($images); $i++)
					{	
						$ext_name = chr(ord('a')+$i);
						
						createImageAndThumb($mosConfig_absolute_path."/import/".$images[$i],$id.$ext_name.".jpg",$id.$ext_name."_t.jpg",
											$conf->max_width,
											$conf->max_height,
											$conf->max_width_t,
											$conf->max_height_t,
											$conf->tag,
											$mosConfig_absolute_path."/images/com_adsmanager/ads/",
											$images[$i]);
					}
				}
				else
				{
					echo "Get last ID ERROR<br/>";
				}
			}
			else
			{
				echo $database -> stderr();
				return false;
			}
			
		}
	}
}

?>