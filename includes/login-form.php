<div class="popup-login-form">
	<div class="title-name">Already a member</div>
	<div class="login_message" style="display: none;"></div>
	<form name="loginform" id="sitemodal-login-submit-form" action="<?php echo site_url('wp-login.php', 'login_post'); ?>" method="post">
		<table class="simplemodal-login-fields">
			<tr>
				<td>Username <input type="text" name="log" class="" value=""  tabindex="10" />&nbsp; &nbsp;</td>
				<td>Password <input class="paw-word" type="password" name="pwd" class="" value="" tabindex="20" />&nbsp; &nbsp; </td>
				<td><input type="submit" value="Login" class="sitemodal-login-submit"></td>
			</tr>
		</table>
	</form>
	
</div>
<div style="clear: both"></div>

<hr/>
