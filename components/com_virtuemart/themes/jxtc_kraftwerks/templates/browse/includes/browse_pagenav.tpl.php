<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );

mm_showMyFileName(__FILE__);

if (!@is_object( $pagenav)) return;
?>
<div style="width:730px;float:left;" class="browsebottom">
	<div style="padding-left: 12px; float:left;overflow:auto;">
		<div class="pagination-left"></div>
			<?php $pagenav->writePagesLinks( $search_string ); ?>
		<div class="pagination-right"></div>
	</div>
	<?php 
	if ( $show_limitbox ) { ?>
		<form action="<?php echo $search_string ?>" method="post">
			<div style="padding-right: 12px; float:right;">
				<?php echo $VM_LANG->_('PN_DISPLAY_NR') ?>&nbsp;&nbsp;
			</div>
			<div style="padding-right: 12px; float:right;">
				<?php $pagenav->writeLimitBox( $search_string ); ?>
			</div>
			<div style="padding-right: 12px; float:right;">
				<noscript>
					<input class="button" type="submit" value="<?php echo $VM_LANG->_('PHPSHOP_SUBMIT') ?>" />
				</noscript>
			</div>
		</form>
		<div style="padding-right: 12px; float:right;">
			<?php $pagenav->writePagesCounter(); ?>
		</div>
	<?php
	}
	?>
</div>
<!-- END PAGE NAVIGATION -->