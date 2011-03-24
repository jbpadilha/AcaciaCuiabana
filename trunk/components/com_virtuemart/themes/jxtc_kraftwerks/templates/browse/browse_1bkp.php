<?php if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );
mm_showMyFileName(__FILE__);
 ?>

<?php         

?>

 
  
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

 


 
    