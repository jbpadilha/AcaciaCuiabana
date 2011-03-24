<?php if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );
mm_showMyFileName(__FILE__);
 ?>

<?php         

?>
BROWSE A
 <div style="width:147px; height:255px; background: #ffffff url(images/vmboxshadow.png) top repeat-x;">
<div style="width:147px; height:255px; background: url(images/vmbottomfade.png) bottom repeat-x;">
<div style="width:147px; height:255px; background: url(images/rightvborder.png) right repeat-y; border-bottom:1px solid #ffffff; font-size:11px !important;" align="center">

<img src="{product_thumb_image}" width="120" height="120" style="margin-top:16px;" />
<p style="font-family:Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#333333; margin-top:6px; margin-bottom:0px;"> {manufacturer_name} </p>
<p style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#666666; margin-top:0px; margin-top:4px; margin-bottom:7px;"> {product_name} </p>
<span style="font-family:Arial, Helvetica, sans-serif; font-size:12px !important;  font-weight:bold; color:#ff0000; margin-top:6px; margin-bottom:0px;"> {product_price} </span>

<div class="popuphover"><img src="images/productinfo.png" width="88" height="18" style="margin-top:12px;" border="0" />





<div class="pop">



<div style="float:left; width:519px; height:414px; background: url(images/backpanelblank.png) no-repeat;">
<div style="float:left; width:453px; height:350px; margin:30px 0px 0px 32px !important; font-family:Arial, Helvetica, sans-serif;">

<div style="float:left; width:188px; margin:21px 0px 0px 21px;">


<div style="width:178px; height:178px; padding:5px; background: #ebebeb;" >
<img src="{product_full_image}" width="178" height="178"  />
</div>


<p style="font-size:11px; color:#84bcd3; line-height:120%; margin-top:10px; margin-bottom:0px; font-weight:bold; "> Item Description:  </p>
<p style="font-size:11px; color:#888888; line-height:130%; margin-top:7px; "> {product_s_desc}  </p>

</div>


<div style="float:left; width:202px; height:290px; margin:21px 0px 0px 21px; padding:18px 0px 0px 0px; background: url(images/atcbkg.png) no-repeat;" >

<p style="font-size:22px; color:#84bcd3; margin:2px 0px 0px 20px; line-height:80%; height:47px; width:160px; "> {product_name} </p>

<div style="width:160px; margin-left:20px;"> {product_rating} </div>

<p style=" font-family:Verdana, Arial, Helvetica, sans-serif; font-size:22px !important; color:#777; font-weight:bold; margin:10px 0px 0px 20px; line-height:80%; width:160px;"> {product_price} </p>

<div style="width:202px; height:34px; margin-top:23px;" align="center"> {form_addtocart} 

<a href="{product_url}"><img src="images/moreinfo.png" style="margin-top:2px;" /></a>

<div style="width:160px; margin-top:10px;"> {product_availability} </div>

<img src="images/cc-small.png" style="margin-top:10px;" />

</div>

</div>


</div>
</div>









</div>






















</div>



</div>
</div>
</div>
    








 
</div>





  
 <div class="browseProductContainer">
         <div class="browseProductImageContainer" align="center"><?php echo ps_product::image_tag( $product_thumb_image, 'class="browseProductImage" align="center" border="0" title="'.$product_name.'" alt="'.$product_name .'"' ) ?></div>
       <div class="browseProductTitle"> <a href="<?php echo $product_flypage ?>">
           <?php echo $product_name ?></a>
        </div>




<!-- QUICK INFO -->
<div class="quickinfo-wrapper">

	<a href="#" class="quickinfo"><img src="components/com_virtuemart/themes/jxtc_kraftwerks/images/quickinfo.png" /></a>

	<!-- QUICK INFO CONTAINER -->
	<div class="quickinfo-container" style="display:none;">
		<a href="#" class="quickinfo-close" style="position:absolute;top:0px;right:0px;">close</a>
    <?php echo ps_product::image_tag( $product_thumb_image, 'class="browseProductImage" border="0" title="'.$product_name.'" alt="'.$product_name .'"' ) ?> 
     <?php echo $product_name ?>
        <?php echo $product_price ?>
		<?php echo $product_s_desc ?>
         <a href="<?php echo $product_flypage ?>" title="<?php echo $product_details ?>"><br />
			<?php echo $product_details ?>...</a>
              <?php echo $form_addtocart ?>
	</div>
	<!-- QUICK INFO CONTAINER END -->

</div>
<!-- QUICK INFO END -->





		<div class="browsePriceContainer">
            <?php echo $product_price ?>
        </div>
        
		
		

		
      
</div>

<div style="clear:both"></div>

 


 
    