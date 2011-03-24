<?php

if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );

mm_showMyFileName(__FILE__);

JHTML::_( 'behavior.mootools' );
/*
 * Include the quickinfo.js script
 * Add pop up feature to the browse page
 */
$document = &JFactory::getDocument();
$document->addScript(VM_THEMEURL.'js/quickinfo.js');
$document->addScript(VM_THEMEURL.'js/jxtcpops.js');
$jxtcsettings = "var jxtcsettings = {
  'opacityin':1,
  'opacityout':1,
  'verticalin':0,
  'verticalout':0,
  'horizontalin':0,
  'horizontalout':0,
  'durationin':550,
  'durationout':550,
  'fadein':0.5,
  'fadeout':0.5,
  'pause':1000,
  'transition':'Quad',
  'subtransition':'easeIn',
  'centered':'1'
}
window.addEvent('load', function(){var vmpops = new jxtcpops('product_list',jxtcsettings) });";
$document->addScriptDeclaration($jxtcsettings);

echo $browsepage_header; // The heading, the category description 
$modules =& JModuleHelper::getModules('browsetop');
foreach ($modules as $module) {
//	echo '<div class="contentdiv">';
	echo '<div>';
	echo JModuleHelper::renderModule($module);
	echo '</div>';
}

// Get View Cookie
$cookie = JRequest::getVar('jxtcvmview', 'grid', 'COOKIE', 'STRING');
$gridStart = ($cookie == 'grid') ? 'jxtcViewOn' : 'jxtcViewOff';
$listStart = ($cookie == 'list') ? 'jxtcViewOn' : 'jxtcViewOff';
$browseStart = ($cookie == 'grid') ? 'gridView' : 'listView';
?>
<script type="text/javascript">
<!--
function setView(view) {
	var date = new Date();
	date.setTime(date.getTime() + 7 * 24 * 60 * 60 * 1000);
	var c = "jxtcvmview=" + view + ";expires=" + date.toGMTString();
	document.cookie = c;
	if (view == 'grid') {
		document.getElementById('product_list').className = 'gridView';
		document.getElementById('gridTxt').className = 'jxtcViewOn';
		document.getElementById('listTxt').className = 'jxtcViewOff';
	}
	else {
		document.getElementById('product_list').className = 'listView';
		document.getElementById('listTxt').className = 'jxtcViewOn';
		document.getElementById('gridTxt').className = 'jxtcViewOff';
	}
}
-->
</script>
<div class="browsedesc3">
	<table width="100%">
		<tr>
			<td>
				<?php echo $buttons_header; // The PDF, Email and Print buttons ?>
			</td>
			<td>
				<?php echo $parameter_form; // The Parameter search form ?>
			</td>
			<td align="right" style="padding-right:9px; color: #777;">
				<?php echo $orderby_form; // The sort-by, order-by form PLUS top page navigation ?>
			</td>
			<td>
				&nbsp;&nbsp;
				<span id="gridTxt" class="<?php echo $gridStart ?>" style="cursor:pointer" onclick="javascript:setView('grid');">
				<?php echo Jtext::_('Grid'); ?>
				</span>|
				<span id="listTxt" class="<?php echo $listStart ?>" style="cursor:pointer" onclick="javascript:setView('list');">
				<?php echo Jtext::_('List'); ?>
				</span>
			</td>
			<td align="right" style="padding-right:9px;">
				<?php 
				$position = 'browsesearch';
				jimport( 'joomla.application.module.helper' );
				$attribs['style'] = 'xhtml';
				$modules =& JModuleHelper::getModules($position);
				$html = '';
				foreach ($modules as $module) {
					$html .= JModuleHelper::renderModule( $module, $attribs );
				}
				echo '<div style="float:left;height:20px;position:relative;z-index:900">'.$html.'</div>';
				?>
			</td>
		</tr>
	</table>
</div>
<?php //<div class="browsedesc2"></div> ?>
<div style="margin:0 0 0 -15px;width:732px;overflow:hidden;" >
<div id="product_list" class="<?php echo $browseStart ?>">
<?php
$data =array(); // Holds the rows of products
$i = $row = $tmp_row = 0; // Counters
$products_per_row = 5;
$num_products = count( $products );
foreach( $products as $product ) {
	
		/*** Now echo the filled cell ***/
		if( $tmp_row != $row || $row == 0 ) {
			if ( ($num_products - $i) < $products_per_row ) {
				$cell_count =$num_products - $i;
			}
			else {
				$cell_count = $products_per_row;
			}
			$row++;
			$tmp_row = $row;
		}
		$colspan = $products_per_row - $cell_count + 1;
		if( $cell_count < 1 ) {
			$cell_count = 1;
		}

		echo "<div class=\"box_wrap\" id=\"".uniqid( "row_" ) ."\">";
		foreach( $product as $attr => $val ) {
			// Using this we make all the variables available in the template
			// translated example: $this->set( 'product_name', $product_name );
			$this->set( $attr, $val );
		}
		
		// Parse the product template (usually 'browse_x') for each product
		// and store it in our $data array 
		echo $this->fetch( 'browse/'.$templatefile .'.php' );
		
		$i++;
		if ( ($i) % $products_per_row == 0) {
			$row++;
			/** if yes, close the current "row" ***/
			echo "\n</div><div class=\"clr\"></div>";
		}
		else {
			echo "\n</div>";
			
		}
}
if ($cell_count != $products_per_row) {
	echo "\n<div class=\"clr\"></div>";
}		
?>
</div>
</div>
<?php
echo $browsepage_footer;
// Show Featured Products
if( $this->get_cfg( 'showFeatured', 1 )) {
    /* featuredproducts(random, no_of_products,category_based) no_of_products 0 = all else numeric amount
    edit featuredproduct.tpl.php to edit layout */
    echo $ps_product->featuredProducts(true,10,true);
}
?>