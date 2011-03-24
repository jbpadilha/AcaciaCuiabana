<?php
/*
	JoomlaXTC Virtuemart Product Showcase module

	version 2.6
	
	Copyright (C) 2009  Monev Software LLC.	All Rights Reserved.
	
	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 2 of the License, or
	(at your option) any later version.
	
	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.
	
	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
	
	See COPYRIGHT.php for more information.
	See LICENSE.php for more information.
	
	WARNING:
	
	Other required files of this extension might not be freely distributable and are
	noted as such.
	
	Monev Software LLC
	www.joomlaxtc.com
*/

if (!defined('_JEXEC')) die('Direct Access to this location is not allowed.');

global $db, $mainframe,$sess,$VM_LANG,$category_id,$manufacturer_id, $my, $cart, $vmLogger,$func;

$live_site = JURI::base();

if( file_exists(dirname(__FILE__).'/../../components/com_virtuemart/virtuemart_parser.php' )) {
	require_once( dirname(__FILE__).'/../../components/com_virtuemart/virtuemart_parser.php' );
} else {
	require_once( dirname(__FILE__).'/../components/com_virtuemart/virtuemart_parser.php' );
}

$doc =&JFactory::getDocument();
$doc->addStyleSheet( VM_THEMEURL.'theme.css' );
$doc->addScript( VM_THEMEURL.'theme.js' );
if( !defined( "_MOOTOOLS_LOADED" )) { // VM's moo load routine
	if( $version  == '' ) {
		$version = 'mootools-release-1.11.js';
	}
	$doc->addScriptDeclaration( 'var cart_title = "'.$VM_LANG->_('PHPSHOP_CART_TITLE').'";var ok_lbl="'.$VM_LANG->_('CMN_CONTINUE').'";var cancel_lbl="'.$VM_LANG->_('CMN_CANCEL').'";var notice_lbl="'.$VM_LANG->_('PEAR_LOG_NOTICE').'";var live_site="'.$live_site.'";' );
	$doc->addScript( $live_site .'/components/'. VM_COMPONENT_NAME .'/js/mootools/'.$version );
	$doc->addScript( $live_site .'/components/'. VM_COMPONENT_NAME .'/js/mootools/mooPrompt.js' );
	$doc->addStyleSheet( $live_site .'/components/'. VM_COMPONENT_NAME .'/js/mootools/mooPrompt.css' );
	define ( "_MOOTOOLS_LOADED", "1" );
}

if (!is_object($db)) $db = new ps_DB;
$vmsc = new ps_DB;
$vmscp = new ps_DB;
$vmscr = new ps_DB;

require_once ( CLASSPATH. 'ps_product.php');
$ps_product = new ps_product;
require_once (CLASSPATH."ps_reviews.php");
require_once (CLASSPATH."ps_cart.php");
$ps_cart = new ps_cart;
require_once (CLASSPATH."ps_shopper_group.php");
require_once (CLASSPATH."htmlTools.class.php");

//echo '<script type="text/javascript">var live_site="'.$live_site.'";</script>';
//require_once(CLASSPATH . 'ps_product_attribute.php' );
//$ps_product_attribute = new ps_product_attribute;
$ps_shopper_group = new ps_shopper_group;
$shopper_group = $ps_shopper_group->get_shoppergroup_by_id( $my->id );
$shopper_group_id = $shopper_group['shopper_group_id'];
$auth = $_SESSION['auth'];
$itemid = $sess->getShopItemid();

$today = mktime();

$parent_filter = $params->get( 'parent_filter', "parent" );
$category_filter = $params->get( 'category_filter', "0" );
$manufacturer_filter = $params->get( 'manufacturer_filter', "0" );
$special_filter = $params->get( 'special_filter', "0" );
$discount_filter = $params->get( 'discount_filter', 0 );
$image_filter = $params->get( 'image_filter', "0" );
$date_filter = $params->get( 'date_filter', "any" );
$recentp_filter = $params->get( 'recentp_filter', 0 );
$min_stock = $params->get( 'min_stock', 1 );
$min_rate = $params->get( 'min_rate', 0 );
$min_price = $params->get( 'min_price' );
$max_price = $params->get( 'max_price' );
$product_list = $params->get( 'product_list', 0 );
$manufacturer_list = $params->get( 'manufacturer_list',0 );
$category_list = $params->get( 'category_list', 0 );
$product_order = $params->get( 'product_order', "random" );
$display_style = $params->get( 'display_style', "table" );
$rows = $params->get( 'rows', 2 );
$columns = $params->get( 'columns', 4 );
$pages = $params->get( 'pages', 2 );
$use_sectioncolor = $params->get( 'use_sectioncolor', "0" );
$use_review = $params->get( 'use_review', 0 );
$use_review_limit = $params->get( 'use_review_limit', 1 );
$use_review_template = $params->get('use_review_template', '{review_stars}' );
$template_head = $params->get( 'htmlini', '' );
$product_template = $params->get( 'html', '' );
$template_foot = $params->get( 'htmlfin', '' );
$plugins = $params->get( 'plugins', 0 );
$show_addtocart = $params->get( 'show_addtocart', "button" );
$addtocart_image = $params->get( 'addtocart_image', '' );
$show_qty_box = $params->get( 'show_qty_box', "none" );
$default_qty = $params->get( 'default_qty', 1 );
$date_format = $params->get( 'date_format', "Y-m-d" );
$image_width = $params->get( 'image_width', PSHOP_IMG_WIDTH );
$image_height = $params->get( 'image_height', PSHOP_IMG_HEIGHT );
$product_class = $params->get( 'product_class', "" );
$slidepause = $params->get( 'slidepause', 4000 );
$slidespeed = $params->get( 'slidespeed', 1500 );
$slideflow = $params->get('slideflow', 0);
$transition = $params->get('transition', 1);
$buttonpos = $params->get( 'buttonpos', 3 );
$pagebuttons = $params->get('pagebuttons',0);
$button = $params->get( 'button', 'grey');
$desclen = $params->get('desclen',0);
$tabtitle = $params->get('tabtitle','');
$width = $params->get('width',200);
$height = $params->get('height',200);
/* SlideBox */
$sbFX = $params->get('npslideitfx','BT');
$sbXi = $params->get('npslixin',0);
$sbXo = $params->get('npslixout',0);
$sbYi = $params->get('npsliyin',0);
$sbYo = $params->get('npsliyout',0);
$sbObj = "{xi:$sbXi,xo:$sbXo,yi:$sbYi,yo:$sbYo}";
$sbAnim = $params->get('npsliAnim','Quad');
$sbEase = $params->get('npsliEase','easeIn');
$sbFps = $params->get('npslidi',50);
$sbDura = $params->get('npslido',800);
$sbTran = "{anim:'$sbAnim',ease:'$sbEase',dura:$sbDura,frames:$sbFps}";
/* Jxtctips */
$nptipoi = $params->get('nptipoi',1);		// Opacity
$nptipoo = $params->get('nptipoo',0);
$nptipvi = $params->get('nptipvi',0);		// Vertical
$nptipvo = $params->get('nptipvo',0);
$nptiphi = $params->get('nptiphi',0);		// Horizontal
$nptipho = $params->get('nptipho',0);
$nptipdi = $params->get('nptipdi',550);	// Duration
$nptipdo = $params->get('nptipdo',550);
$nptipfi = $params->get('nptipfi',0);	// Fade Opacity
$nptipfo = $params->get('nptipfo',0);
$nptpause = $params->get('nptpause',1000); 
$nptipAnim = $params->get('nptipAnim','Quad');
$nptipEase = $params->get('nptipEase','easeIn');
$nptipCenter = $params->get('nptipCenter',1);
/* Jxtc Hover */
$hoi = $params->get('hoifx','#CECECE');// Hover out color
$hoo = $params->get('hoofx','#FFFFFF');// Hover in color

$max_items = $rows * $columns;
switch ($display_style) {
	case 'tabs':
		$max_items = $max_items * $pages;
	break;
	case 'vslide':
		if ($pages == 1) $display_style = 'table';
		$slideeffect = 'slideVer';
		$slideflow = ($slideflow == 0) ? 'TopBottom' : 'BottomTop';
		$max_items = $max_items * $pages;
	break;
	case 'hslide':
		if ($pages == 1) $display_style = 'table';
		$slideeffect = 'slideHor';
		$slideflow = ($slideflow == 0) ? 'LeftRight' : 'RightLeft';
		$max_items = $max_items * $pages;
	break;
	case 'fade':
		if ($pages == 1) $display_style = 'table';
		$slideeffect = 'fade';
		$slideflow = 'none';
		$max_items = $max_items * $pages;
	break;
}

if ($addtocart_image) {
	$addtocart_image = $live_site.'components/com_virtuemart/shop_image/ps_image/'.$addtocart_image;
}
else {
	$show_addtocart = "button";
}

$pos_pro = $neg_pro = array() ;
if (!is_array($product_list)) $product_list = array($product_list);
if (count($product_list) > 0) {
	foreach ($product_list as $pro_id) {
		if ($pro_id < 0) $neg_pro[] = abs($pro_id);
		elseif ($pro_id > 0) $pos_pro[] = $pro_id;
	}
}

$pos_cat = $neg_cat = array() ;
if (!is_array($category_list)) $category_list = array($category_list);
if (count($category_list) > 0) {
	foreach ($category_list as $cat_id) {
		if ($cat_id < 0) $neg_cat[] = abs($cat_id);
		elseif ($cat_id > 0) $pos_cat[] = $cat_id;
	}
}

$pos_man = $neg_man = array() ;
if (!is_array($manufacturer_list)) $manufacturer_list = array($manufacturer_list);
if (count($manufacturer_list) > 0) {
	foreach ($manufacturer_list as $man_id) {
		if ($man_id < 0) $neg_man[] = abs($man_id);
		elseif ($man_id > 0) $pos_man[] = $man_id;
	}
}

// Get recent products
$recentproducts = $_SESSION['recent'];
$recent = array();
if ($recentproducts['idx'] > 0) {
	for ($i=$recentproducts['idx']-1;$i >= 0;$i--) {
		$recent[]=$recentproducts[$i]['product_id'];
	}
}

$q  = "SELECT p.*, c.category_name, c.category_id, c.category_flypage, c.category_thumb_image, c.category_full_image, m.mf_name, m.mf_url, m.manufacturer_id, oi.cdate as oi_cdate ";
$q .= " FROM #__{vm}_product AS p
 LEFT JOIN #__{vm}_product_votes AS pv ON (pv.product_id = p.product_id)
 LEFT JOIN #__{vm}_product_price AS pp ON (pp.product_id = p.product_id)
 LEFT JOIN #__{vm}_product_mf_xref AS mx ON (mx.product_id = p.product_id)
 LEFT JOIN #__{vm}_manufacturer as m ON (m.manufacturer_id = mx.manufacturer_id)
 LEFT JOIN jos_vm_order_item AS oi ON (oi.product_id = p.product_id AND order_status = 'P'),
 #__{vm}_product_category_xref as pcx, #__{vm}_category AS c, #__{vm}_category_xref as cx ";
$q .= " WHERE c.category_publish = 'Y' ";
$q .= " AND c.category_id = pcx.category_id ";
$q .= " AND p.product_publish='Y' ";

switch ($parent_filter) {
	case 'parent':
	$q .= "AND pcx.product_id = p.product_id AND p.product_parent_id = 0 ";
  break;
	case 'child':
	$q .= "AND pcx.product_id = p.product_parent_id AND p.product_parent_id <> 0 ";
  break;
	case 'both':
	$q .= "AND (pcx.product_id = p.product_id OR pcx.product_id = p.product_parent_id) ";
	break;
}
//$q .= "AND mx.product_id = p.product_id AND m.manufacturer_id = mx.manufacturer_id ";

if( CHECK_STOCK && PSHOP_SHOW_OUT_OF_STOCK_PRODUCTS != "1") $q .= "AND p.product_in_stock > 0 ";

if (count($pos_pro) > 0) $q .= "AND (p.product_id = ".implode($pos_pro," OR p.product_id = ").") ";
if (count($neg_pro) > 0) $q .= "AND (p.product_id <> ".implode($neg_pro," AND p.product_id <> ").") ";
if (count($pos_cat) > 0) $q .= "AND (pcx.category_id = ".implode($pos_cat," OR pcx.category_id = ").") ";
if (count($neg_cat) > 0) $q .= "AND (pcx.category_id <> ".implode($neg_cat," AND pcx.category_id <> ").") ";
if (count($pos_man) > 0) $q .= "AND (mx.manufacturer_id = ".implode($pos_man," OR mx.manufacturer_id = ").") ";
if (count($neg_man) > 0) $q .= "AND (mx.manufacturer_id <> ".implode($pos_man," AND mx.manufacturer_id <> ").") ";

if ($min_stock > 0) $q .= "AND p.product_in_stock >= $min_stock ";

if ($min_rate > 0) $q .= "AND pv.rating >= $min_rate ";

if ($special_filter == 1) $q .= "AND p.product_special = 'Y' ";

if ($category_filter > 0 && $category_id > 0) {
	$q .= $category_filter == 1 ? " AND pcx.category_id = $category_id " : " AND (pcx.category_id = $category_id OR (pcx.category_id = cx.category_child_id AND cx.category_parent_id = $category_id)) ";
}
else {
	$q .= " AND cx.category_child_id = pcx.category_id ";
}

if ($min_price or $max_price) {
	$q .= "AND pp.product_currency = '".$_SESSION['vendor_currency']."' ";
	$q .= "AND pp.shopper_group_id = '".$shopper_group_id."' ";
	if ($min_price) $q .= "AND pp.product_price >= $min_price ";
	if ($max_price) $q .= "AND pp.product_price <= $max_price ";
}

if ($discount_filter == 1) $q .= 'AND p.product_discount_id > 0 ';

if ( $manufacturer_filter == 1 && $manufacturer_id > 0 ) $q .= "AND p.manufacturer_id = '$manufacturer_id' ";

switch ($date_filter) {
	case 'current':
	$q .= "AND p.product_available_date <= $today ";
	break;
	case 'future':
	$q .= "AND p.product_available_date > $today ";
	break;
}

if ($image_filter == 1) $q .="AND p.product_full_image <> '' ";

if ($recentp_filter == 1) $q .=" AND p.product_id IN (".implode(',',$recent).")";

if ($product_order == 'sales') {
	$q .= "AND p.product_sales > 0 ";
}	

$q .= " GROUP BY p.product_id ";
switch ($product_order) {
	case 'random':
	$q .= "ORDER BY RAND() ";
	break;
	case 'recent':
	$q .= "ORDER BY p.product_id DESC ";
	break;
	case 'sales':
	$q .= "ORDER BY p.product_sales DESC ";
	break;
	case 'adate':
	$q .= "ORDER BY p.product_available_date DESC ";
	case 'sdate':
	$q .= "ORDER BY oi.cdate DESC ";
	break;
}
$q .= " LIMIT $max_items";

// DEBUG
/*
echo "\n<!-- SHOWCASE DEBUG INFO:\nSession:\n";
echo var_dump($_SESSION);
echo "\nSQL:\n";
echo str_replace('#__{vm}','jos_vm',$q);
echo "\n-->\n";
*/
$vmsc->query($q);
if ($vmsc->num_rows() > 0) {
	$products=array();
	$i = 1;	// Product counter
	while($vmsc->next_record()) {
		$product_id = $vmsc->f("product_id");
		$product_html = $product_template;

		// If it is child item get parent:
		$product_parent_id = $vmsc->f("product_parent_id");
		if ($product_parent_id != 0) {
			$vmscp->query("SELECT product_full_image,product_thumb_image,product_name,product_s_desc FROM #__{vm}_product WHERE product_id='$product_parent_id'" );
			$vmscp->next_record();
		}
		
		// If using reviews, get the right one
		$review_html = '';
		if ($use_review > 0) {
			$review_product = ($product_parent_id != 0) ? $product_parent_id : $product_id;
			switch ($use_review) {
				case 1: // Most recent
				$q = "SELECT r.*,u.name,u.username FROM #__{vm}_product_reviews AS r, #__users as u WHERE r.published='Y' AND r.product_id='$review_product' AND u.id=r.userid ORDER BY r.time DESC LIMIT ".$use_review_limit;
				break;
				case 2: // Top rated
				$q = "SELECT r.*,u.name,u.username FROM #__{vm}_product_reviews AS r, #__users as u WHERE r.published='Y' AND r.product_id='$review_product' AND u.id=r.userid ORDER BY r.user_rating DESC, r.time DESC LIMIT ".$use_review_limit;
				break;
				case 3: // Random
				$q = "SELECT r.*,u.name,u.username FROM #__{vm}_product_reviews AS r, #__users as u WHERE r.published='Y' AND r.product_id='$review_product' AND u.id=r.userid ORDER BY RAND() LIMIT ".$use_review_limit;
				break;
			}

			$vmscr->query($q);
			while ($vmscr->next_record()) {
				$review_comment = $vmscr->f('comment');
				$review_rating = $vmscr->f('user_rating');
				$review_stars = '<img src="'.VM_THEMEURL.'images/stars/'.$review_rating.'.gif" align="middle" border="0" alt="'.$review_rating.' stars" />';
				$review_time = date($date_format,$vmscr->f('time'));
				$review_name = $vmscr->f('name');
				$review_username = $vmscr->f('username');
				
				$review_template = $use_review_template;
				$review_template = str_replace( '{review_comment}', $review_comment, $review_template );
				$review_template = str_replace( '{review_rating}', $review_rating, $review_template );
				$review_template = str_replace( '{review_stars}', $review_stars, $review_template );
				$review_template = str_replace( '{review_time}', $review_time, $review_template );
				$review_template = str_replace( '{review_name}', $review_name, $review_template );
				$review_template = str_replace( '{review_username}', $review_username, $review_template );
				$review_html .= '<div>'.$review_template.'</div>';
			}
		}
		$flypage = $vmsc->f("category_flypage");
		if (empty($flypage)) $flypage = FLYPAGE;
		$url = JRoute::_($live_site."index.php?option=com_virtuemart&page=shop.product_details&flypage=$flypage&product_id=".$product_id)."&Itemid=".$itemid;
		$product_html = str_replace( '{product_flypage}', $url , $product_html );

		$product_thumb_image = $vmsc->f("product_thumb_image");
		if (empty($product_thumb_image)) $product_thumb_image = $vmscp->f("product_thumb_image");
		if ( $product_thumb_image ) {
			if ( strtolower(substr( $product_thumb_image, 0, 4) != "http" )) {
				if (PSHOP_IMG_RESIZE_ENABLE == '1') $product_thumb_image = $live_site.'components/com_virtuemart/show_image_in_imgtag.php?filename='.urlencode($product_thumb_image).'&amp;newxsize='.$image_width.'&amp;newysize='.$image_height.'&amp;fileout=';
				else {
					if ( file_exists( IMAGEPATH."product/".$product_thumb_image )) $product_thumb_image = IMAGEURL."product/".$product_thumb_image;
          else $product_thumb_image = IMAGEURL.NO_IMAGE;
				}
			}
		}
		else $product_thumb_image = IMAGEURL.NO_IMAGE;
		$product_html = str_replace( '{product_thumb_image}', $product_thumb_image, $product_html );

		$product_html = str_replace( '{thumb_image_width}', $image_width, $product_html );
		$product_html = str_replace( '{thumb_image_height}', $image_height, $product_html );

		$full_image_width = ""; $full_image_height = "";
		$product_full_image = $vmsc->f("product_full_image");
		if (empty($product_full_image)) $product_full_image = $vmscp->f("product_full_image");
		if( $product_full_image ) {
			if( strtolower(substr( $product_full_image, 0, 4) != "http" )) {
				if( file_exists( IMAGEPATH."product/".$product_full_image )) {
					$full_image_info = getimagesize( IMAGEPATH."product/$product_full_image" );
					$full_image_width = $full_image_info[0];
					$full_image_height = $full_image_info[1];
					$product_full_image = IMAGEURL."product/".$product_full_image;
				}
        else $product_full_image = IMAGEURL.NO_IMAGE;
			}
		}
		else $product_full_image = IMAGEURL.NO_IMAGE;
		
		$product_html = str_replace( '{product_full_image}', $product_full_image, $product_html );

		if ( strtolower(substr( $product_full_image, 0, 4) == "http" )) {
			$product_html = str_replace( "{image_url}product/", "", $product_html );
		}
		else {
			$product_html = str_replace( "{image_url}", IMAGEURL, $product_html );
		}
	
		$product_html = str_replace( '{full_image_width}', $full_image_width, $product_html );
		$product_html = str_replace( '{full_image_height}', $full_image_height, $product_html );

		$product_name = $vmsc->f("product_name");
		if ( $vmsc->f("product_publish") == "N" ) $product_name .= " (".$VM_LANG->_('CMN_UNPUBLISHED',false).")";
		if( empty($product_name) && $product_parent_id!=0 ) $product_name = $vmscp->f("product_name");
		$product_html = str_replace( '{product_name}', shopMakeHtmlSafe( $product_name ), $product_html );
		
		$product_s_desc = $vmsc->f("product_s_desc");
		if( empty($product_s_desc) && $product_parent_id!=0 ) $product_s_desc = $vmscp->f("product_s_desc");
		if ($desclen > 0 && strlen($product_s_desc) > $desclen) $product_s_desc = trim(substr($product_s_desc,0,$desclen)).'...';
		$product_html = str_replace( '{product_s_desc}', $product_s_desc , $product_html );
	
		$product_html = str_replace( '{product_details...}', $VM_LANG->_('PHPSHOP_FLYPAGE_LBL'), $product_html );

		$product_rating = (PSHOP_ALLOW_REVIEWS == '1' && @$_REQUEST['output'] != "pdf") ? ps_reviews::allvotes( $product_id ) : "";
		$product_html = str_replace( '{product_rating}', $product_rating, $product_html );

		$product_price = (_SHOW_PRICES == '1' && $auth['show_prices']) ? $ps_product->show_price( $product_id ) : "";
		$product_html = str_replace( '{product_price}', $product_price, $product_html );
		
		if (USE_AS_CATALOGUE != '1' && !stristr( $product_price, $VM_LANG->_('PHPSHOP_PRODUCT_CALL') )) {
			$product_in_stock = $vmsc->f('product_in_stock');
			$button_lbl = $VM_LANG->_('PHPSHOP_CART_ADD_TO');
			$button_cls = 'addtocart_button';
			if ( CHECK_STOCK == '1' && !$product_in_stock ) {
				$button_lbl = $VM_LANG->_('VM_CART_NOTIFY');
				$button_cls = 'notify_button';
				$notify = true;
			} else {
				$notify = false;
			}
	
			$form_addtocart = '<form action="index.php" method="post" name="addtocart" id="'.uniqid('addtocart_').'" style="padding:0;border:0;margin:0" onsubmit="handleAddToCart( this.id );return false;" >';
	
			$form_button = ($show_addtocart == 'button')
				? '<input type="submit" class="'.$button_cls.'" value="'.$button_lbl.'" title="'.$button_lbl.'" />'
				: '<input type="image" src="'.$addtocart_image.'" ALT="'.$button_lbl.'" />';
	      
			$form_box = ($show_qty_box != 'none')
				? '<input id="quantity_'.$i.'" class="inputbox" type="text" size="1" name="quantity[]" value="'.$default_qty.'" />'
				: '<input type="hidden" name="quantity[]" value="'.$default_qty.'" />';
	
      switch ($show_qty_box) {
      	case 'top':
        $form_addtocart .= $form_box . '<br />' . $form_button;
    		break;
      	case 'right':
        $form_addtocart .= $form_button . '&nbsp;' . $form_box;
    		break;
      	case 'bottom':
        $form_addtocart .= $form_button . '<br />' . $form_box;
    		break;
      	case 'left':
        $form_addtocart .= $form_box .'&nbsp;' . $form_button;
    		break;
      	case 'none':
        $form_addtocart .= $form_button.$form_box;
    		break;
			}
	
			$form_addtocart .= '
	    <input type="hidden" name="product_id" value="'.$vmsc->f('product_id').'" />
	    <input type="hidden" name="prod_id[]" value="'.$vmsc->f('product_id').'" />
	    <input type="hidden" name="flypage" value="'.$flypage.'" />
	    <input type="hidden" name="page" value="shop.cart" />
    	<input type="hidden" name="manufacturer_id" value="'.$manufacturer_id.'" />
			<input type="hidden" name="category_id" value="'.$vmsc->f('category_id').'" />
	    <input type="hidden" name="func" value="cartAdd" />
	    <input type="hidden" name="option" value="com_virtuemart" />
	    <input type="hidden" name="Itemid" value="'.$itemid.'" />
	    <input type="hidden" name="set_price[]" value="" />
	    <input type="hidden" name="adjust_price[]" value="" />
	    <input type="hidden" name="master_product[]" value="" />
			</form>';

			$product_html = str_replace( '{form_addtocart}', $form_addtocart, $product_html );
		}
		else {
			$product_html = str_replace( '{form_addtocart}', '', $product_html );
		}

		$product_html = str_replace( '{product_sku}', $vmsc->f("product_sku"), $product_html );
		$product_html = str_replace( '{category_name}', $vmsc->f("category_name"), $product_html );

		$caturl = JRoute::_($sess->url($live_site."index.php?option=com_virtuemart&page=shop.browse&category_id=".$vmsc->f("category_id")));

		$product_html = str_replace('{category_url}', $caturl, $product_html ) ;

		$product_html = str_replace( '{product_cdate}', date($date_format,$vmsc->f("cdate")), $product_html );
		$product_html = str_replace( '{product_mdate}', date($date_format,$vmsc->f("mdate")), $product_html );
		$product_html = str_replace( '{product_adate}', date($date_format,$vmsc->f("product_available_date")), $product_html );
		$product_html = str_replace( '{product_weight}', $vmsc->f("product_weight")+0 .' '. $vmsc->f("product_weight_uom"), $product_html );
		$product_html = str_replace( '{product_width}', $vmsc->f("product_width")+0 .' '. $vmsc->f("product_lwh_uom"), $product_html );
		$product_html = str_replace( '{product_length}', $vmsc->f("product_length")+0 .' '. $vmsc->f("product_lwh_uom"), $product_html );
		$product_html = str_replace( '{product_height}', $vmsc->f("product_height")+0 .' '. $vmsc->f("product_lwh_uom"), $product_html );
		$product_html = str_replace( '{product_stock}', $vmsc->f("product_in_stock"), $product_html );
		$product_html = str_replace( '{product_url}', $vmsc->f("product_url"), $product_html );
		$product_html = str_replace( '{manufacturer_name}', $vmsc->f("mf_name"), $product_html );
		$product_html = str_replace( '{manufacturer_url}', $vmsc->f("mf_url"), $product_html );

		$product_html = str_replace( '{reviews}', $review_html, $product_html );

		$pav = $vmsc->f("product_availability");
		if ($pav != '') $pav = "<img align=\"middle\" src=\"".VM_THEMEURL."images/availability/".$pav."\" border=\"0\" alt=\"$pav\" />";
		$product_html = str_replace( '{product_availability}', $pav, $product_html );

		$category_image = $vmsc->f("category_full_image");
		$category_image = empty($category_image) ? '' : IMAGEURL.$category_image;
		$product_html = str_replace( '{category_image}', $category_image, $product_html );

		$category_thumb = $vmsc->f("category_thumb_image");
		$category_thumb = empty($category_thumb) ? '' : IMAGEURL.$category_thumb;
		$product_html = str_replace( '{category_thumb}', $category_thumb, $product_html );

		if ($plugins) {
			$GLOBALS['jxtc_product_id'] = $product_id;
			$product_html = vmCommonHTML::ParseContentByPlugins($product_html);
		}

		$products[]=$product_html;
		$i++;	
	}
// Render module box
JHTML::_('behavior.mootools');
$jxtc = uniqid('jxtc');
/* JXTC Settings */
$jxtcsettings = $jxtc."jxtcsettings = {
  'opacityin':$nptipoi,
  'opacityout':$nptipoo,
  'verticalin':$nptipvi,
  'verticalout':$nptipvo,
  'horizontalin':$nptiphi,
  'horizontalout':$nptipho,
  'durationin':$nptipdi,
  'durationout':$nptipdo,
  'fadein':$nptipfi,
  'fadeout':$nptipfo,
  'pause':$nptpause,
  'transition':'$nptipAnim',
  'subtransition':'$nptipEase',
  'centered':'$nptipCenter'
}";
$doc->addScriptDeclaration($jxtcsettings);

/* JXTC Slidebox */
$doc->addScript($live_site."modules/mod_jxtc_vmshowcase/js/slidebox.js");
$doc->addScriptDeclaration("window.addEvent('load', function(){var ".$jxtc."slidebox = new slidebox('$jxtc','$sbFX',$sbObj,$sbTran); });");

/* JXTC Pop Up */
$doc->addScript($live_site."modules/mod_jxtc_vmshowcase/js/jxtcpops.js");
$doc->addScriptDeclaration("window.addEvent('load', function(){var ".$jxtc."jxtcpops = new jxtcpops('$jxtc',".$jxtc."jxtcsettings); });");

/* JXTC Tips */
$doc->addScript($live_site."modules/mod_jxtc_vmshowcase/js/jxtctips.js");
$doc->addScriptDeclaration("window.addEvent('load', function(){var ".$jxtc."jxtctips = new jxtctips('$jxtc',".$jxtc."jxtcsettings); });");

/* JXTC Hover */
$doc->addScript($live_site."modules/mod_jxtc_vmshowcase/js/jxtchover.js");
$doc->addScriptDeclaration("window.addEvent('load', function(){var ".$jxtc."jxtchover = new jxtchover('$jxtc','$hoi','$hoo'); });");

/* vmshowcase */
$doc->addStyleSheet($live_site.'modules/mod_jxtc_vmshowcase/css/vmshowcase.css','text/css');
$cell_width = intval(100 / $columns);

$html = '';
$cell_width = intval(100 / $columns);
$class = (empty($product_class) ) ? '' : 'class="'.$product_class.'"';
$i = 1;	// Product counter
$c = 1; // column
$r = 1; // row
$p = 1; // page
switch ($display_style) {
	case 'float':
		foreach ($products as $product_html) {
			$html .= '<div '.$class.' style="float:left">' . $product_html . '</div>';
		}
		$html .= '<div style="clear:both"></div>';
	break;
	case 'table':
		$trclass = '';
		$html .= '<table border="0" cellpadding="0" cellspacing="0" style="float:left;width:99%">';
		for ($r=1;$r<=$rows;$r++) {
			if ($use_sectioncolor == 1) { $trclass = ($r % 2 == 0)	? 'class="sectiontableentry2"' : 'class="sectiontableentry1"'; }
			$html .= '<tr '.$trclass.'>';
			for ($c=1;$c<=$columns;$c++) {
				$product_html = array_shift($products);
				if (!empty($product_html)) {
					$html .= '<td width="'.$cell_width.'%" align="center" valign="middle" '.$class.'>';
					$html .= $product_html;
					$html .= '</td>';
				}
			}
			$html .='</tr>';
		}
		$html .= '</table>';
	break;
	case 'olist':
		$html .= '<table border="0" cellpadding="0" cellspacing="0" width="99%">';
		foreach ($products as $product_html) {
			if ($use_sectioncolor == 1) { $trclass = ($i % 2 == 0)	? 'class="sectiontableentry2"' : 'class="sectiontableentry1"'; }
			$html .= '<tr '.$trclass.'><td align="right" valign="middle">&nbsp;'.$i.'&nbsp;</td><td>'.$product_html.'</td></tr>';
			$i++;
		}
		$html .= '</table>';
	break;
	case 'ulist':
		$html .=  '<ul>';
		foreach ($products as $product_html) {
			$html .= '<li '.$class.'>'.$product_html.'</li>';
		}
		$html .= '</ul>';
	break;
	case 'tabs':
		jimport('joomla.html.pane');
		$doc->addStyleSheet($live_site.'modules/mod_jxtc_vmshowcase/css/tabs.css');
		$casetabs = & JPane::getInstance('tabs', array('startOffset'=>0));
		$html .= $casetabs->startPane( 'pane' );
		for($p=1;$p<=$pages;$p++) {
			$html .= $casetabs->startPanel( $tabtitle." $p", 'tab'.$p );
			$html .= '<table border="0" cellpadding="0" cellspacing="0" width="100%">';
			for ($r=1;$r<=$rows;$r++) {
				$html .= '<tr>';
				for ($c=1;$c<=$columns;$c++) {
					$product_html = array_shift($products);
				if (!empty($product_html)) {
						$html .= '<td width="'.$cell_width.'%" align="center" valign="middle" '.$class.'>';
						$html .= $product_html;
						$html .= '</td>';
					}
				}
				$html .='</tr>';
			}
			$html .= '</table>';
			$html .= $casetabs->endPanel();
		}
		$html .= $casetabs->endPane();
	break;
	case 'vslide':
	case 'hslide':
	case 'fade':
		switch ($buttonpos) {
			case 2:	// top
			$html .= '<table class="jsc_buttonbar"><tr><td align="center" valign="middle" class="jsc_prev"><a href="#" id="'.$jxtc.'_back"><img src="modules/mod_jxtc_vmshowcase/buttons/'.$button.'/prev.gif" style="margin:0"/></a></td>';
			if ($pagebuttons) {
				for($p=1;$p<=$pages;$p++) {
					$html .= '<td align="center" class="jsc_pag"><a href="#" class="'.$jxtc.'_pag" id="'.$jxtc.'_p'.$p.'">'.$p.'</a></td>';
				}
			}
			$html .= '<td align="center" valign="middle" class="jsc_next"><a href="#" id="'.$jxtc.'_foward"><img src="modules/mod_jxtc_vmshowcase/buttons/'.$button.'/next.gif" style="margin:0"/></a></td></tr></table>';
			break;
			case 3: // bottom
			break;
			case 4:	// top/bottom
			break;
		}
		$html .= '<div id="'.$jxtc.'_sc">';
		$row=1;
		$col=1;
		$page=1;
		foreach ($products as $product_html) {
			if ($row==1 && $col==1) { // new page table
				$html .= '<div class="'.$jxtc.'shows" id="'.$jxtc.'_'.$page.'" style="display:none;">';
				$html .= '<table border="0" cellpadding="0" cellspacing="0">';
			}
			if ($col==1) { // New row
				$html .= '<tr>';
			}
			$html .= '<td  align="center" valign="middle" '.$class.'>';
			$html .= $product_html;
			$html .= '</td>';
			if ($col++ == $columns) { // New row
				$html .='</tr>';
				$row++;
				$col=1;
			}
			if ($row > $rows) { // Close page
				$html .= '</table>';
				$html .= '</div>';
				$page++;
				$row=1;
				$col=1;
			}
		}
		if ($col > 1) {
				$html .='</tr>';
				$html .= '</table>';
				$html .= '</div>';
		}
		$html .= '</div>';
		if ($pages > 1) {
			switch ($buttonpos) {
				case 2:	// top
				break;
				case 3: // bottom
				$html .= '<table width="100%" class="jsc_buttonbar"><tr><td align="center" valign="middle" class="jsc_prev"><a href="#" id="'.$jxtc.'_back"><img src="modules/mod_jxtc_vmshowcase/buttons/'.$button.'/prev.gif" style="margin:0"/></a></td>';
				if ($pagebuttons) {
					for($p=1;$p<=$pages;$p++) {
						$html .= '<td align="center" class="jsc_pag"><a href="#" class="'.$jxtc.'_pag" id="'.$jxtc.'_p'.$p.'">'.$p.'</a></td>';
					}
				}
				$html .= '<td align="center" valign="middle" class="jsc_next"><a href="#" id="'.$jxtc.'_foward"><img src="modules/mod_jxtc_vmshowcase/buttons/'.$button.'/next.gif" style="margin:0"/></a></td></tr></table>';
				break;
				case 4:	// top/bottom
				break;
			}
		}
	$doc->addScript($live_site."modules/mod_jxtc_vmshowcase/js/showcaseFX.js");
	$doc->addScriptDeclaration("window.addEvent('load', function(){var $jxtc = new showcasefx('$jxtc','$slideeffect','$slideflow',$slidepause,$slidespeed,0,'$transition');});");
	break;
	case 'wind':
		$doc->addScript($live_site."modules/mod_jxtc_vmshowcase/js/wallFX.js");
		$doc->addScriptDeclaration("window.addEvent('load', function(){var $jxtc = new wallfx('$jxtc',$width,$height,0);});");
		$html .= '<div id="'.$jxtc.'_sc">';
		for($p=1;$p<=$pages;$p++) {
			$html .= '<div class="'.$jxtc.'shows" id="'.$jxtc.'_'.$p.'" style="display:none;">';
			$html .= '<table border="0" cellpadding="0" cellspacing="0" width="99%">';
			for ($r=1;$r<=$rows;$r++) {
				$html .= '<tr>';
				for ($c=1;$c<=$columns;$c++) {
					$product_html = array_shift($products);
					if (!empty($product_html)) {
						$html .= '<td width="'.$cell_width.'%" align="center" valign="middle" '.$class.'>';
						$html .= $product_html;
						$html .= '</td>';
					}
				}
				$html .='</tr>';
			}
			$html .= '</table>';
			$html .= '</div>';
		}
		$html .= '</div>';
	break;
	case 'winz':
		$doc->addScript($live_site."modules/mod_jxtc_vmshowcase/js/wallFX.js");
		$doc->addScriptDeclaration("window.addEvent('load', function(){var $jxtc = new wallfx('$jxtc',$width,$height,1);});");
		$html .= '<div id="'.$jxtc.'_sc">';
		for($p=1;$p<=$pages;$p++) {
			$html .= '<div class="'.$jxtc.'shows" id="'.$jxtc.'_'.$p.'" style="display:none;">';
			$html .= '<table border="0" cellpadding="0" cellspacing="0" width="99%">';
			for ($r=1;$r<=$rows;$r++) {
				$html .= '<tr>';
				for ($c=1;$c<=$columns;$c++) {
					$product_html = array_shift($products);
					if (!empty($product_html)) {
						$html .= '<td width="'.$cell_width.'%" align="center" valign="middle" '.$class.'>';
						$html .= $product_html;
						$html .= '</td>';
					}
				}
				$html .='</tr>';
			}
			$html .= '</table>';
			$html .= '</div>';
		}
		$html .= '</div>';
	break;
	
}

if ($plugins) {
	unset($GLOBALS['jxtc_product_id']);
	$template_head = vmCommonHTML::ParseContentByPlugins($template_head);
	$template_foot = vmCommonHTML::ParseContentByPlugins($template_foot);
}

$leftbuttonhtml = ($pages == 1) ? '' : '<a href="#" id="'.$jxtc.'_back"><img src="'.$live_site.'modules/mod_jxtc_vmshowcase/buttons/'.$button.'/prev.png" style="margin:0"/></a>';
$rightbuttonhtml = ($pages == 1) ? '' : '<a href="#" id="'.$jxtc.'_foward"><img src="'.$live_site.'modules/mod_jxtc_vmshowcase/buttons/'.$button.'/next.png" style="margin:0"/></a>';
$pageshtml = '';
if ($pages > 0) {
	for($p=1;$p<=$pages;$p++) {
		$pageshtml .= '<a href="#" class="'.$jxtc.'_pag" id="'.$jxtc.'_p'.$p.'">'.$p.'</a>';
	}
}

$modulehtml = '<div id="'.$jxtc.'" >'.$template_head.$html.$template_foot.'</div>';
$modulehtml = str_replace( '{leftbutton}', $leftbuttonhtml, $modulehtml );
$modulehtml = str_replace( '{rightbutton}', $rightbuttonhtml, $modulehtml );
//$modulehtml = str_replace( '{pages}', $pageshtml, $modulehtml );

echo $modulehtml;
}	
?>
<div style="display:none"><a href="http://www.joomlaxtc.com">JoomlaXTC VMShowcase - Copyright 2008,2009,2010 Monev Software LLC</a></div>
