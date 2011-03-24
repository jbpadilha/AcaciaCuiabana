<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 

mm_showMyFileName(__FILE__);

$iCol = 1;
if( !isset( $categories_per_row )) {
	$categories_per_row = 6;
}
$cellwidth = intval( 100 / $categories_per_row );

if( empty( $categories )) {
	return; // Do nothing, if there are no child categories!
}
?>
<div style="width:732px;overflow:hidden;margin-top:-15px" >
	<table width="100%" cellspacing="0" cellpadding="0">
	<?php
	foreach ( $categories as $category ) {
		if ($iCol == 1) { // this is an indicator wether a row needs to be opened or not
			echo "<tr>\n";
		}
		?>
		<td align="center" width="<?php echo $cellwidth ?>%" >
			<div class="cat_diva">
				<div class="cat_divb">
					<div class="cat_divc">	
         		
         		<?php
							if ( $category["category_thumb_image"] ) {
								echo '<div class="cat_img">';
								echo '<a title="'.$category["category_name"].'" href="'.$sess->url(URL."index.php?option=com_virtuemart&amp;page=shop.browse&amp;category_id=".$category["category_id"]).'">';
								echo ps_product::image_tag( $category["category_thumb_image"], " alt=\"".$category["category_name"]."\"", 0, "category");
								echo '</a></div>';
							}
						?>
                        <div class="cat_name">
	 						<a title="<?php echo $category["category_name"] ?>" href="<?php $sess->purl(URL."index.php?option=com_virtuemart&amp;page=shop.browse&amp;category_id=".$category["category_id"]) ?>">
		         		<?php echo $category["category_name"]; ?>
		         	</a>
						</div>
			 		</div>
			 	</div>
			</div>
		</td>
	<?php
		// Do we need to close the current row now?
		if ($iCol == $categories_per_row) { // If the number of products per row has been reached
			echo "</tr>\n";
			$iCol = 1;
		}
		else {
			$iCol++;
		}
	}
	// Do we need a final closing row tag?
	if ($iCol != 1) {
		echo "</tr>\n";
	}
	?>
	</table>
</div>