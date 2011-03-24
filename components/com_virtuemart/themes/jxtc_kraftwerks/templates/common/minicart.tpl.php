<?php

defined('_JEXEC') or die('Restricted access');

global $sess; 

if ($vmMinicart) return;	// From mod_virtuemart

$live_site = JURI::base();
if (!defined('VM_THEMEURL')) {	define('VM_THEMEURL',$live_site.'components/com_virtuemart/themes/jxtc_kraftwerks'); }
$jxtc = uniqid('jxtc');
$products_per_row = 6;
require_once( JPATH_ROOT.DS.'components'.DS.'com_virtuemart'.DS.'virtuemart_parser.php' );
require_once (CLASSPATH."ps_reviews.php");

$jsparms  = "{'opacityin':1,'opacityout':0,'verticalin':-265,'verticalout':-265,'horizontalin':-48,'horizontalout':-48,";
$jsparms .= "'durationin':250,'durationout':250,'fadein':0.5,'fadeout':0.5,'pause':1000,'transition':'Quad','subtransition':'easeIn','centered':'1'}";
$doc =&JFactory::getDocument();
$doc->addStyleSheet( VM_THEMEURL.'theme.css' );
$doc->addScript( VM_THEMEURL.'theme.js' );
$doc->addScript(VM_THEMEURL.'js/jxtcpops.js');
$doc->addScript(VM_THEMEURL.'js/showcaseFX.js');
$doc->addScript(VM_THEMEURL.'js/jxtcxtips.js');
$doc->addScriptDeclaration("window.addEvent('load', function(){minicartsettings = $jsparms;
var $jxtc = new showcasefx('$jxtc','slideHor','LeftRight',-1,1000,0,'Sine');
var $jxtc = new jxtcpops('$jxtc',minicartsettings);
});");

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

// Redo show cart link
$Itemid = vmGet($_REQUEST, "Itemid", null);
$href = $sess->url($mm_action_url."index.php?page=shop.cart");
$href2 = $sess->url($mm_action_url."index2.php?page=shop.cart", true);
$text = $VM_LANG->_('PHPSHOP_CART_SHOW');
if( @$_SESSION['vmUseGreyBox'] ) {
	$show_cart = vmCommonHTML::getGreyboxPopUpLink( $href2, $text, '', $text, '', 500, 800, $href );
}
else {
//	JHTML::_('behavior.modal',  'a.modal', array('onClose'=>'\function(){this.content.empty();}'));
	$show_cart = vmCommonHTML::hyperlink( $href, $text, '', $text, '' );
}
$button= '<img src="'.VM_THEMEURL.'images/cartcheck.png" class="cartBtnImg" alt="Go to Checkout" />';
$ini=strpos($show_cart,'>')+1;
$fin=strpos($show_cart,'<',$ini);
$show_cart = substr_replace($show_cart,$button,$ini,$fin-$ini);

// Render minicart
?>
<div id="<?php echo $jxtc ?>">
	<div class="cartBox">
		<div class="cartSlideBtn">
			<a href="#" id="<?php echo $jxtc ?>_back">
				<img src="<?php echo VM_THEMEURL ?>images/cartPrevBtn.png" />
			</a>
		</div>
		<div class="cartSliderWrap">
			<div id="<?php echo $jxtc ?>_sc">
				<?php
					$page = 1;
					$col=1;
					$db	=& JFactory::getDBO();
					// Loop through each row and build page tables
				  foreach ( $minicart as $cart ) {
						foreach ( $cart as $attr => $val ) {
						// Using this we make all the variables available in the template
						// translated example: $this->set( 'product_name', $product_name );
							$this->set( $attr, $val );
						}
				  	if ($col==1) { ?><div class="<?php echo $jxtc ?>shows" id="<?php echo $jxtc ?>_<?php echo $page ?>" style="display:block;"><table border="0" cellpadding="0" cellspacing="0"><tr><?php }
			    	// Get all product fields
						$ini=strpos($cart['url'],'product_id=')+11;
						$fin=strpos($cart['url'],'&',$ini);
						$product_id = substr($cart['url'],$ini,$fin-$ini);
						$q = "SELECT a.product_parent_id, a.product_thumb_image, a.product_full_image, a.product_availability, a.product_s_desc, a.product_desc, c.mf_name, b.manufacturer_id
						        FROM #__".VM_TABLEPREFIX."_product AS a
						        LEFT JOIN #__".VM_TABLEPREFIX."_product_mf_xref AS b ON ( (b.product_id = a.product_id AND a.product_parent_id = 0) OR (b.product_id = a.product_parent_id AND a.product_parent_id <> 0))
						        LEFT JOIN #__".VM_TABLEPREFIX."_manufacturer AS c ON (c.manufacturer_id = b.manufacturer_id)
						        WHERE a.product_id = '$product_id'";
						$db->setquery($q);
						$result=$db->loadObject();
						if ($result->product_parent_id != 0) {
							$q = "SELECT a.product_parent_id, a.product_thumb_image, a.product_full_image, a.product_availability, a.product_s_desc, a.product_desc, c.mf_name, b.manufacturer_id
							        FROM #__".VM_TABLEPREFIX."_product AS a
							        LEFT JOIN #__".VM_TABLEPREFIX."_product_mf_xref AS b ON ( (b.product_id = a.product_id AND a.product_parent_id = 0) OR (b.product_id = a.product_parent_id AND a.product_parent_id <> 0))
							        LEFT JOIN #__".VM_TABLEPREFIX."_manufacturer AS c ON (c.manufacturer_id = b.manufacturer_id)
											WHERE a.product_id = '$result->product_parent_id'";
							$db->setquery($q);
							$parent=$db->loadObject();
							if (empty($result->product_thumb_image)) $result->product_thumb_image = $parent->product_thumb_image;
							if (empty($result->product_full_image)) $result->product_full_image = $parent->product_full_image;
							if (empty($result->product_availability)) $result->product_availability = $parent->product_availability;
							if (empty($result->mf_name)) $result->mf_name = $parent->mf_name;
						}
						$full_image = $result->product_full_image;
						$full_image = empty($full_image) ? IMAGEURL.NO_IMAGE : IMAGEURL."product/".$full_image;
						$thumb_image = $result->product_thumb_image;
						$thumb_image = empty($thumb_image) ? IMAGEURL.NO_IMAGE : $live_site.'components/com_virtuemart/themes/jxtc_kraftwerks/show_image_in_imgtag.php?filename='.$thumb_image.'&newxsize=40&newysize=40&fileout="';
						$product_availability = empty($result->product_availability) ? '' : "<img align=\"middle\" src=\"".VM_THEMEURL."images/availability/".$result->product_availability."\" border=\"0\" alt=\"Availability\" />";
						$product_rating = ps_reviews::allvotes( $product_id );

			$form_addtocart = '<form action="index.php" method="post" name="addtocart" id="'.uniqid('addtocart_').'" style="padding:0;border:0;margin:0" onsubmit="handleAddToCart( this.id );return false;" >';
			$form_addtocart .= '<input type="image" src="'.VM_THEMEURL.'images/add-to-cart.png" ALT="Add To Cart" />';
			$form_addtocart .= '<input type="hidden" name="quantity[]" value="1" />';
			$form_addtocart .= '<input type="hidden" name="product_id" value="'.$product_id.'" />
	    <input type="hidden" name="prod_id[]" value="'.$product_id.'" />
	    <input type="hidden" name="page" value="shop.cart" />
    	<input type="hidden" name="manufacturer_id" value="'.$result->manufacturer_id.'" />
	    <input type="hidden" name="func" value="cartAdd" />
	    <input type="hidden" name="option" value="com_virtuemart" />
	    <input type="hidden" name="Itemid" value="'.$Itemid.'" />
	    <input type="hidden" name="set_price[]" value="" />
	    <input type="hidden" name="adjust_price[]" value="" />
	    <input type="hidden" name="master_product[]" value="" />
			</form>';						
			      ?>
						<td>
							<div onmouseover="javascript:jxtcxtips(this,<?php echo $jsparms ?>);" onmouseout="javascript:jxtcxtipsout(this);">
								<div>
									<a href="<?php echo $cart['url'] ?>" alt="<?php echo $cart['product_name'] ?>">
										<img src="<?php echo $thumb_image ?>" alt="<?php echo $cart['product_name']?>" class="cartImg" />
									</a>
								</div>
								<div class="tip" style="position:absolute;display:none;margin-top:0px;margin-left:0px;">

    <div style="width:147px; height:155px; background: #ffffff url(images/vmboxshadow.png) top repeat-x;">
      <div style="width:147px; height:155px; background: url(images/vmbottomfade.png) bottom repeat-x;">
        <div style="width:147px; height:155px;background: url(images/rightvborder.png) right repeat-y; border-bottom:1px solid #ffffff; font-size:11px !important;" align="center">
          <p style="font-family:Arial, Helvetica, sans-serif; font-size:10px; font-weight:bold; color:#777; margin-top:24px; margin-bottom:0px; padding-top:24px;">
            <?php echo $result->mf_name ?>
          </p>
          <p class="vmshowc" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#777; margin-top:0px; margin-top:4px; margin-bottom:7px;">
            <a style="color:#777;" href="<?php echo $cart['url'] ?>">
            	<?php echo $cart['product_name'] ?>
            </a>
          </p>
          <span style="font-family:Arial, Helvetica, sans-serif; font-size:12px !important; font-weight:bold; color:#84bcd3; margin-top:6px; margin-bottom:0px;">
          	<?php echo $cart['price'] ?>
          </span><br/>
            <a style="color:#777;" href="<?php echo $cart['url'] ?>">
	            <img src="images/productinfo.png" width="88" height="18" style="margin-top:12px;" border="0" alt="">
            </a>
          </div>
        </div>
      </div>
    </div>


									</div>
					    	</div>
					    </div>
				    </td>
			      <?php
			      if ($col++ == $products_per_row) {
			      	$page++; $col=1; 
			      	?></tr></table></div><?php
			      } 
				  }
				  if ($col > 1) { echo '</tr></table></div>'; }
				?>
			</div>
		</div>
		<div class="cartSlideBtn">
			<a href="#" id="<?php echo $jxtc ?>_foward">
				<img src="<?php echo VM_THEMEURL ?>images/cartNextBtn.png" />
			</a>
		</div>
		<div class="cartRightFiller1"></div>
		<div class="cartRight">
			<div class="cartTxt">
				<?php
					if ($empty_cart) {
						echo $VM_LANG->_('PHPSHOP_EMPTY_CART');
					}
					else {
						echo JText::_('Items').': '.count($minicart).' / '.$total_price;
					}
				?>
			</div>
			<div class="cartBtn">
				<?php
				 //$total_products
					echo ' '.$show_cart;
					echo ' '.$saved_cart;
				?>
			</div>
		</div>
		<div class="cartRightFiller2"></div>
	</div>
	<div style="clear:both"></div>
</div>
