<?php if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 

mm_showMyFileName(__FILE__);
?>
<div style="text-align:left;">
	<?php echo $navigation_childlist; ?>
</div>
<?php
	if (trim(str_replace( "<br />", "" , $desc)) != "" ) {
?>
		<div style="width:698px;float:left;" class="browsedesc">
			<?php echo $desc; ?>
		</div>
		<br class="clr" />
<?php
	}
?>