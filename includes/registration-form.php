<div class="popup-registration-form">
	<div class="title-name"> New Customer </div>	
	<div id="register-ajaxloader" class="popup-login-ajaxloader" ><img src="<?php echo PopUpURL . '/images/ajax-loader.gif'; ?>" alt="ajaxloader" /></div>
	<div id="registration-form-popup">
		<div class="registration-message" style="display: none"></div>
		<div class="registration-successful" style="display: none"></div>
		<form id="popup-registration-form" name="registrationform"  action="<?php echo site_url('wp-login.php?action=register', 'login_post'); ?>" method="post">
			<div class="registration-divs">
				<table class="registration-tables">
					<tr>
						<td>salutation *</td> 
						<td>
							<select id="salutation" style="width: 179px">
								<option value="m">Mr</option>
								<option value="f">Mrs</option>
							</select>
						<td>
					</tr>
					<tr>
						<td>
							First Name 
						</td>
						<td>
							<input type="text" name="fname" value="" />
						</td>
					</tr>
					<tr>
						<td>
							Last Name 
						</td>
						<td>
							<input type="text" name="lname" value="" />
						</td>
					</tr>
					<tr>
						<td>
							Road 
						</td>
						<td>
							<input type="text" name="road" value="" />
						</td>
					</tr>
					<tr>
						<td>
							Place
						</td>
						<td>
							<input type="text" name="place" value="" />
						</td>
					</tr>
					<tr>
						<td>
							Land
						</td>
						<td>
							<input type="text" name="land" value="" />
						</td>
					</tr>

				</table>
			</div>

			<div class="registration-divs-right">
				<table class="registration-tables">
					<tr>
						<td>
							Username
						</td>
						<td>
							<input type="text" name="username" value="" />
						</td>
					</tr>
					<tr>
						<td>
							Email
						</td>
						<td>
							<input type="text" name="email" value="" />
						</td>
					</tr>
					<tr>
						<td>
							Date of Birth
						</td>
						<td>
							<?php
								echo self::select_day();
								echo self::select_month();
								echo self::select_year();
							?>
						</td>
					</tr>
					<tr>
						<td>
							Password
						</td>
						<td>
							<input class="paw-word" type="password" name="password1" value="" />
						</td>
					</tr>
					<tr>
						<td>
							Retype Password
						</td>
						<td>
							<input class="paw-word"  type="password" name="password2" value="" />
						</td>
					</tr>
					<tr>
						<td>
							&nbsp;
						</td>
						<td>
							* mendatory &nbsp; <input type="submit" class="button-register" value="register" />
						</td>
					</tr>
				</table>

			</div>	

		</form>
	</div>
</div>