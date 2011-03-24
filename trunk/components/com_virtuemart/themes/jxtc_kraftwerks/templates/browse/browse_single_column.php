<?php if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );
mm_showMyFileName(__FILE__);
?>

 <div class="productSeperator">
  
 <div class="browseProductContainer">
        SINGLE COLUMN
        
        <h3 class="browseProductTitle" style="font-size:170% !important;"><a href="<?php echo $product_flypage ?>">
            <?php echo $product_name ?></a>
        </h3>

        <br/> <br/>

<div style="float:left; margin-bottom:-5px;">
		<div class="browsePriceContainer">
            <?php echo $product_price ?>
        </div>
        
		<div class="browseRatingContainer" >
        <?php echo $product_rating ?>
        </div>
		
		</div>
		
		<br/>
		<br/>
		<br/>
        <div class="browseProductDescription">
            <?php echo $product_s_desc ?>&nbsp;
            <a href="<?php echo $product_flypage ?>" title="<?php echo $product_details ?>"><br />
			<?php echo $product_details ?>...</a>
        </div>
       <div>
        <?php echo $form_addtocart ?>
		
			

		
        </div>

</div>


 <div class="browseProductImageContainer">
	<img src="<?php echo "$product_thumb_image"; ?>" />
	
 </div>


 
        </div>