<?php if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );
mm_showMyFileName(__FILE__);
global $db;
if (empty($manufacturer_id)) {
	$manufacturer_name = '';
}
else {
	$db->query( "SELECT manufacturer_id, mf_name, mf_desc FROM #__{vm}_manufacturer WHERE manufacturer_id='$manufacturer_id'");
	$db->next_record();
	$manufacturer_name = shopMakeHtmlSafe( $db->f("mf_name") );
}
?>
<div style="width:147px; height:255px; background: #ffffff url(images/vmboxshadow.png) top repeat-x;">
  <div style="width:147px; height:255px; background: url(images/vmbottomfade.png) bottom repeat-x;">
    <div style="width:147px; height:255px; background: url(images/rightvborder.png) right repeat-y; border-bottom:1px solid #ffffff; font-size:11px !important;" align="center">
			<?php echo ps_product::image_tag( $product_thumb_image, 'class="browseProductImage" border="0" width="120" height="120" style="margin-top:16px;" title="'.$product_name.'" alt="'.$product_name .'"' ) ?>
      <p style="font-family:Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#333333; margin-top:6px; margin-bottom:0px;">
        <?php echo $manufacturer_name ?>
      </p>
      <p style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#666666; margin-top:0px; margin-top:4px; margin-bottom:7px;">
        <?php echo $product_name ?>
      </p><span style="font-family:Arial, Helvetica, sans-serif; font-size:12px !important; font-weight:bold; color:#777; margin-top:6px; margin-bottom:0px;"><?php echo $product_price ?></span>
      <div class="popuphover">
        <img src="images/productinfo.png" width="88" height="18" style="margin-top:12px;" border="0" alt="">
        <div class="pop" style="display:none">
          <div style="float:left; width:519px; height:414px; background: url(images/backpanelblank.png) no-repeat;">
            <div style="float:left; width:453px; height:350px; margin:30px 0px 0px 32px !important; font-family:Arial, Helvetica, sans-serif;">
              <div style="float:left; width:188px; margin:21px 0px 0px 21px;">
                <div style="width:178px; height:178px; padding:5px; background: #ebebeb;">
									<?php echo ps_product::image_tag( $product_full_image, ' border="0" width="178" height="178" alt="'.$product_name .'"' ) ?>
                </div>
                <p style="font-size:11px; color:#84bcd3; line-height:120%; margin-top:10px; margin-bottom:0px; font-weight:bold;">
                  Item Description:
                </p>
                <p style="font-size:11px; color:#888888; line-height:130%; margin-top:7px;">
                  <?php echo $product_s_desc ?>
                </p>
              </div>
              <div style="float:left; width:202px; height:290px; margin:21px 0px 0px 21px; padding:18px 0px 0px 0px; background: url(images/atcbkg.png) no-repeat;">
                <p style="font-size:22px; color:#84bcd3; margin:2px 0px 0px 20px; line-height:80%; height:47px; width:160px;">
                  <?php echo $product_name ?>
                </p>
                <div style="width:160px; margin-left:20px;">
                  <?php echo $product_rating ?>
                </div>
                <p style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:22px !important; color:#84bcd3; font-weight:bold; margin:10px 0px 0px 20px; line-height:80%; width:160px;">
                  <?php echo $product_price ?>
                </p>
                <div style="width:202px; height:34px; margin-top:23px;" align="center">
                  <?php echo $form_addtocart ?>
                  <a href="<?php echo $product_flypage ?>">
                  	<img src="images/moreinfo.png" style="margin-top:2px;" alt="">
                  </a>
                  <div style="width:160px; margin-top:10px;">
                    <?php echo $product_availability ?>
                  </div><img src="images/cc-small.png" style="margin-top:10px;" alt="">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>