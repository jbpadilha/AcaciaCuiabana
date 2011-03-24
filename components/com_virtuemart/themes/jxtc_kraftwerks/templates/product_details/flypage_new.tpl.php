<?php

if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );


// Build a clickable grid with more product images
$maxcolumns = 4;	// Number of products per row

$html = '<div style="clear:both;border-top:1px solid #eeeeee"><table class="product-thumbs" width="100%" cellpadding="0" cellspacing="0"><tr>';
$html .= '<td><div class="thumb-wrap"><img src="'.$mm_action_url.'components/com_virtuemart/shop_image/product/'.$product_full_image.'" width="60" height="60" onmouseover="javascript:document.getElementById(\'zoomoo\').src = this.src"; /></div></td>';
$col=1;
foreach ($images as $image) {
	if ($image->file_is_image != 1) continue;
	$html .= '<td><div class="thumb-wrap"><img src="'.$image->file_url.'" width="60" height="60" onmouseover="javascript:document.getElementById(\'zoomoo\').src = this.src"; /></div></td>';
	if (++$col == $maxcolumns) {
		$html .= '</tr><tr>';
		$col=0;
	}
}
$html .= '</tr></table></div>';
// Comment the following line to use the standard Virtuemart code for "More Images"
$more_images = $html;

// Override 'Ask a Seller' var:
$ask_seller_href = $sess->url( $_SERVER ['PHP_SELF'].'?page=shop.ask&amp;flypage='.@$_REQUEST['flypage']."&amp;product_id=$product_id&amp;category_id=$category_id" );
$ask_seller_text = '<img src="components/com_virtuemart/themes/jxtc_kraftwerks/images/ask-a-question.png" alt="'.$VM_LANG->_('VM_PRODUCT_ENQUIRY_LBL').'" />';
$ask_seller = '<a href="'. $ask_seller_href .'">'. $ask_seller_text .'</a>';

// Module Position
jimport( 'joomla.application.module.helper' );
$attribs['style'] = 'xhtml';
$modules =& JModuleHelper::getModules('flypage');
$module_position = '';
foreach ($modules as $module) {
	$module_position .= JModuleHelper::renderModule( $module, $attribs );
}

?>
<table style="width:99%;padding-top:5px; padding-bottom:7px;" border="0">
  <tr>
    <td>
			<?php  // The PDF, Email and Print buttons
						if( $this->get_cfg( 'showPathway' )) {
							echo "<div class=\"pathway\">$navigation_pathway</div>";
						} 
						
							if( !empty( $next_product )) {		
								echo '<a class="next_page" href="'.$next_product_url.'">'.shopMakeHtmlSafe($next_product['product_name']).'</a>';
							}
							
							if( $this->get_cfg( 'product_navigation', 1 )) {
							if( !empty( $previous_product )) {
								echo '<a class="previous_page" href="'.$previous_product_url.'">'.shopMakeHtmlSafe($previous_product['product_name']).'</a>';
							}
						}
			?>
		</td>
  </tr>
</table>

<script type="text/javascript">

window.addEvent('load', function(){

	var wap = $$('.sliderwrapper');
	wap.setStyles({'width':'100%'});

	var contents = $$('.sliderwrapper .contentdiv');
	contents.setStyles({'opacity':0});
	contents.setStyles({'width':'100%'});
	contents[0].setStyles({'opacity':1});

	var menuVisited = false;

	var cdh = new Array();
	contents.each(function(cdu, i){
		cdh[i] = cdu.getStyle('height');
	});
	wap.setStyle('height', cdh[0]);

	var tigg = $$('.toc');
	var tigga = tigg[0];

	tigg.each(function(tig, i){

		  tig.addEvent('click',function(e){
			e = new Event(e).stop();

			if(i!=0){
			menuVisited = true;
			}

			wap.setStyle('height', cdh[i]);
			contents.setStyles({'opacity':0});
			contents[i].effect('opacity',{	duration: 400,
												transition: Fx.Transitions.bounceOut
									}).start(0,1);

		});
	});


});

</script>




<script type="text/javascript">
window.addEvent('domready', function(){

	$('tab-1-lnk').addEvent('click',function(){
		($('tab-1-lnk').getParent()).addClass('tab-bg-1');
		($('tab-2-lnk').getParent()).removeClass('tab-bg-2');
	});

	$('tab-2-lnk').addEvent('click',function(){
		($('tab-2-lnk').getParent()).addClass('tab-bg-2');
		($('tab-1-lnk').getParent()).removeClass('tab-bg-1');
	});

});
</script>



<table border="0" style="width: 100%;">
  <tbody>
		<tr>
		  <tr>
<td rowspan="3" valign="top" style="text-align:center; padding-right: 12px;"><br/> <?php echo $product_image ?><br/><br/> </td>

		  
			</td>
		  <td colspan="2" align="left" valign="top" width="50%" col="4" style="padding:26px 0px 0px 0px;">
		  	<h3 style="font-size:250%; margin-bottom: 6px;"> <?php echo $product_name ?> <?php echo $edit_link ?> <?php if( $this->get_cfg( 'showFeedIcon', 1 ) && (VM_FEED_ENABLED == 1) ) { ?>
<a href="index.php?option=<?php echo VM_COMPONENT_NAME ?>&amp;page=shop.feed&amp;category_id=<?php echo $category_id ?>"><img src="<?php echo VM_THEMEURL ?>/images/feed-icon-14x14.png" v-align="middle" alt="feed" border="0"/></a>
<?php } ?></h3>
        <h3 style="font-size:95%"><?php echo $manufacturer_link ?></h3>
        <h3 style="font-size:80%"><?php echo $vendor_link ?></h3>
        <div class="reviews"><?php if (PSHOP_ALLOW_REVIEWS == '1') { echo ps_reviews::allvotes( $product_id );} ?></div>
			</td>
		</tr>
		<tr>
			<td width="25%" valign="top">
		  	<div class="price"> <?php echo $product_price ?></div>
		  	<div><?php echo $module_position; ?></div>
		 	</td>
      <td width="25%">
				<div class="cartwrap">
        	<div class="cartinner"><?php echo $addtocart ?>
	        <div class="cartpad">
	        	<?php echo $ask_seller ?>
	        </div>
	        <div class="cartpad2">
	        	<?php echo $product_availability ?>
	        </div>
					<div class="cartpad3">
						<img src="components/com_virtuemart/themes/jxtc_kraftwerks/images/creditcards.png" />
					</div>
			  	<br />
		  	</div>
      </div>
		  <?php echo $buttons_header; ?>
			</td>
		</tr>
		<tr>
			<td width="40%" valign="top" align="left">
				<br />
			</td>
		</tr>
		<tr>
			<td colspan="3"> </td>
		</tr>
	</tbody>
</table>

 <table style="width:97%;" border="0">
   <tr>
     <td >
	 
	 <div class="tabs-wrap" style="margin-top:30px; padding-top:10px;  margin-bottom:10px; padding-bottom:10px; border-bottom:1px solid #eeeeee;">
					<ul class="shadetabs">
						<li class="tab-1 tab-bg-1"><a href="#" id="tab-1-lnk" class="toc">Product Description</a></li>
						<li class="tab-2"><a href="#" id="tab-2-lnk" class="toc anotherclass">Customer Reviews</a></li>
					</ul>
				</div>
			  <div class="sliderwrapper">
					<div class="contentdiv">
                    <div style="width:30%;float:left; font-size:24px; margin-top: 46px;color: #777;">features</div>
                    <div style="width:65%;float:left; padding-right: 12px;">
						<?php echo $product_description ?>
                        	</div>
                            	<br />
                                	<br />
                           <div style="width:30%;float:left; font-size:24px; margin-top: 26px;color: #777;">additional info</div>
                    <div style="width:65%;float:left;margin-top: 26px; padding-right: 12px;">
						<div class="specs">
						<?php echo $product_type ?>
						</div>
						<div class="specs">
						<?php echo $product_packaging ?>
                        <br />
                        Units:<?php echo $product_unit ?>
						</div>
						<div class="specs">
							Product Weight:<?php echo $product_weight_uom ?>
						</div>
						<div class="specs">
							Product Length:<?php echo $product_length  ?>
						</div>
						<div class="specs">
							Product Height:<?php echo $product_height ?>
						</div>
						<div class="specs">
							Product Width:<?php echo $product_width ?>
						</div>
						<div class="specs">
							In Stock:<?php echo $product_in_stock ?>
						</div>
						<div class="specs">
							Available Date:<?php echo $product_available_date ?>
						</div>
						
							
						
						<br />
					</div>
					<div class="contentdiv">
					<?php echo $product_reviews ?><br /><?php echo $product_reviewform ?>
					</div>
				</div>
	<!-- </p> --></div>
			 	<br /><?php echo $related_products ?><br />






  <br /></td>
   </tr>
 </table>
 <?php echo $navigation_childlist ?><br style="clear:both"/>
