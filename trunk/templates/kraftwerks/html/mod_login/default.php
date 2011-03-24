<?php // no direct access
defined('_JEXEC') or die('Restricted access'); ?>
<?php if($type == 'logout') : ?>
<form action="index.php" method="post" name="login" id="form-logout">
	<div align="center">
		<input type="submit" name="Submit" class="button" value="<?php echo JText::_( 'BUTTON_LOGOUT'); ?>" />
	</div>

	<input type="hidden" name="option" value="com_user" />
	<input type="hidden" name="task" value="logout" />
	<input type="hidden" name="return" value="<?php echo $return; ?>" />
</form> 

<?php else: ?>

<?php if(JPluginHelper::isEnabled('authentication', 'openid')) :
		$lang->load( 'plg_authentication_openid', JPATH_ADMINISTRATOR );
		$langScript = 	'var JLanguage = {};'.
						' JLanguage.WHAT_IS_OPENID = \''.JText::_( 'WHAT_IS_OPENID' ).'\';'.
						' JLanguage.LOGIN_WITH_OPENID = \''.JText::_( 'LOGIN_WITH_OPENID' ).'\';'.
						' JLanguage.NORMAL_LOGIN = \''.JText::_( 'NORMAL_LOGIN' ).'\';'.
						' var modlogin = 1;';
		$document = &JFactory::getDocument();
		$document->addScriptDeclaration( $langScript );
		JHTML::_('script', 'openid.js');
endif; ?>  

<form action="<?php echo JRoute::_( 'index.php', true, $params->get('usesecure')); ?>" method="post" name="login" id="form-login" >
	<p id="form-login-username">
		<label for="user_pass"><?php echo JText::_('Username') ?></label><br />
		<input id="user_pass" type="text" name="username" class="inputbox" alt="username" size="18" />
	</p>
	<p id="form-login-password">
		<label for="user_login"><?php echo JText::_('Password') ?></label><br />
		<input id="user_login" type="password" name="passwd" class="inputbox" size="18" alt="password" />
	</p>
	<?php if(JPluginHelper::isEnabled('system', 'remember')) : ?>
	<p class="forgetmenot">
		<input id="modlgn_remember" type="checkbox" name="remember" class="inputbox" value="yes" alt="Remember Me" />
		<label for="modlgn_remember"><?php echo JText::_('Remember me') ?></label>
		
	</p>
	<?php endif; ?> 
    <br /><br />
	<ul>
		<li>
			<a style="color:#777;" href="<?php echo JRoute::_( 'index.php?option=com_user&view=reset' ); ?>">
			<?php echo JText::_('FORGOT_YOUR_PASSWORD'); ?></a>	
		</li>
		<li>
			<a  style="color:#777;" href="<?php echo JRoute::_( 'index.php?option=com_user&view=remind' ); ?>">
			<?php echo JText::_('FORGOT_YOUR_USERNAME'); ?></a>
		</li>
	</ul>
	<?php    
	
			$usersConfig = &JComponentHelper::getParams( 'com_users' );
			if ($usersConfig->get('allowUserRegistration')) : ?>
				<a class="register_joomla" href="<?php echo JRoute::_( 'index.php?option=com_user&view=register' ); ?>">
					Not a member yet? <?php echo JText::_('REGISTER'); ?></a>
			<?php endif; ?>
		<?php echo $params->get('posttext'); ?>
	<p class="submit">
	<input type="submit" name="Submit" id="submit" class="button button-primary" value="<?php echo JText::_('LOGIN') ?>" />
    </p>

	<input type="hidden" name="option" value="com_user" />
	<input type="hidden" name="task" value="login" />
	<input type="hidden" name="return" value="<?php echo $return; ?>" />
	<?php echo JHTML::_( 'form.token' ); ?>
</form>
<?php endif; ?> 