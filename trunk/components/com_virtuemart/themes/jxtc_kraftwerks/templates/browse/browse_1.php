<?php if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );
mm_showMyFileName(__FILE__);
?>
<div class="box_diva" style="background: #ffffff url(images/vmboxshadow.png) top repeat-x;">
  <div class="box_divb" style="background: url(images/vmbottomfade.png) bottom repeat-x;">
    <div class="box_divc" style="background: url(images/rightvborder.png) right repeat-y; border-bottom:1px solid #ffffff; font-size:11px !important;" align="center">
			<div class="box_img">
				<a href="<?php echo $product_flypage ?>">
					<?php echo ps_product::image_tag( $product_thumb_image, 'class="browseProductImage" title="'.$product_name.'" alt="'.$product_name .'"' ) ?>
				</a>
			</div>
    	<div class="box_name">
				<a href="<?php echo $product_flypage ?>">
					<?php echo $product_name ?>
				</a>
	      <div class="box_desc">
	        <?php echo $product_s_desc ?>
		    </div>
      </div>
	    <div class="box_price">
     		<?php echo $product_price ?>
      </div>
      <div class="box_info popuphover">
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
                <p style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:22px !important; color:#777; font-weight:bold; margin:10px 0px 0px 20px; line-height:80%; width:160px;">
                  <?php echo $product_price ?>
                </p>
                <div style="width:202px; height:34px; margin-top:23px;" align="center">
                  <?php echo $form_addtocart ?>
                  <a href="<?php echo $product_flypage ?>">
                  	<img src="images/moreinfo.png" style="margin-top:2px;" alt="">
                  </a>
                  <div style="width:160px; margin-top:10px;">
                    <?php echo "<img align=\"middle\" src=\"".VM_THEMEURL."images/availability/".$product_availability."\" border=\"0\" alt=\"Availability\" />" ?>
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