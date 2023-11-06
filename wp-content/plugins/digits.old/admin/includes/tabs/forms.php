<?php


function show_protected_by_digits() {
	return get_option( 'show_protected_by_digits', 1 );
}

function digits_settings_auth_general() {
	$show_asterisk = get_option( 'dig_show_asterisk', 0 );
	$wp_login_inte = get_option( "dig_wp_login_inte", 0 );
	$login_reg_success_msg = get_option( 'login_reg_success_msg', 1 );

	$dig_mobile_no_formatting = get_option( 'dig_mobile_no_formatting', 1 );

	$dig_mobile_no_placeholder = get_option( 'dig_mobile_no_placeholder', 1 );


	$wp_login_hide = get_option( "dig_wp_login_hide", 0 );

	$show_labels = get_option( 'dig_show_labels', 0 );

	$show_protected_by = show_protected_by_digits();
	?>
	<div class="dig_admin_head"><span>
			<?php _e( 'Forms General', 'digits' ); ?>
		</span></div>

	<div class="dig_admin_tab_grid">
		<div class="dig_admin_tab_grid_elem">
			<table class="form-table">
				<tr>
					<th scope="row"><label class="top-10">
							<?php _e( 'Show Protected by Digits', 'digits' ); ?>
						</label>
					</th>
					<td>
						<?php digits_input_switch( 'show_protected_by_digits', $show_protected_by ); ?>
					</td>
				</tr>

				<tr>
					<th scope="row"><label>
							<?php _e( 'Mobile Number Formatting', 'digits' ); ?>
						</label></th>
					<td>
						<select name="dig_mobile_no_formatting">
							<option value="2" <?php if ( $dig_mobile_no_formatting == 2 ) {
								echo 'selected="selected"';
							} ?>>
								<?php _e( 'Local', 'digits' ); ?>
							</option>
							<option value="1" <?php if ( $dig_mobile_no_formatting == 1 ) {
								echo 'selected="selected"';
							} ?>>
								<?php _e( 'International', 'digits' ); ?>
							</option>
							<option value="0" <?php if ( $dig_mobile_no_formatting == 0 ) {
								echo 'selected="selected"';
							} ?>>
								<?php _e( 'No', 'digits' ); ?>
							</option>
						</select>
						<p class="dig_ecr_desc dig_sel_erc_desc">
							<?php _e( 'This function only works on Digits Native Forms', 'digits' ); ?>
						</p>

					</td>
				</tr>

				<tr>
					<th scope="row"><label class="top-10">
							<?php _e( 'Enable /wp-login.php Integration', 'digits' ); ?>
						</label>
					</th>
					<td>
						<?php digits_input_switch( 'dig_wp_login_inte', $wp_login_inte ); ?>
					</td>
				</tr>


				<tr>
					<th scope="row"><label class="top-10">
							<?php _e( 'Redirect /wp-login.php to Digits', 'digits' ); ?>
						</label>
					</th>
					<td>
						<?php digits_input_switch( 'dig_wp_login_hide', $wp_login_hide ); ?>
					</td>
				</tr>

				<tr>
					<th scope="row"><label class="top-10">
							<?php _e( 'Show Mobile Number Placeholder', 'digits' ); ?>
						</label>
					</th>
					<td>
						<?php digits_input_switch( 'dig_mobile_no_placeholder', $dig_mobile_no_placeholder ); ?>
					</td>
				</tr>

				<tr>
					<th scope="row"><label class="top-10">
							<?php _e( 'Show Field Labels', 'digits' ); ?>
						</label>
					</th>
					<td>
						<?php digits_input_switch( 'dig_show_labels', $show_labels ); ?>
					</td>
				</tr>

				<tr id="showasteriskrow">
					<th scope="row"><label class="top-10">
							<?php _e( 'Show asterisk (*) on required fields', 'digits' ); ?>
						</label>
					</th>
					<td>
						<?php digits_input_switch( 'dig_show_asterisk', $show_asterisk ); ?>
					</td>
				</tr>
				<tr>
					<th scope="row" style="vertical-align:top;"><label for="login_reg_success_msg" class="top-10">
							<?php _e( 'Login/Registration Success Message', 'digits' ); ?>
						</label>
					</th>
					<td>
						<?php digits_input_switch( 'login_reg_success_msg', $login_reg_success_msg ); ?>

						<p class="dig_ecr_desc dig_sel_erc_desc">
							<?php _e( 'This function only works on Digits Native Forms', 'digits' ); ?>
						</p>
					</td>
				</tr>

				<tr>
					<th scope="row"><label for="digits_form_font_family">
							<?php _e( 'Font Family', 'digits' ); ?>
						</label>
					</th>
					<td>
						<select id="digits_form_font_family" name="digits_form_font_family">
							<?php
							require_once dirname( __FILE__ ) . '/fonts.php';
							$digits_form_font_family = digits_get_font_family();
							$digits_font = digits_font_list();
							foreach ( $digits_font as $font_group => $font_list ) {
								$group_name = ucfirst( $font_group );
								?>
								<optgroup label="<?php echo esc_attr( $group_name ); ?>">
									<?php
									foreach ( $font_list as $font ) {
										$font_key = $font_group . '@' . $font;
										$selected = '';
										if ( $digits_form_font_family == $font_key ) {
											$selected = 'selected';
										}
										?>
										<option value="<?php echo esc_attr( $font_key ); ?>" <?php echo $selected; ?>>

											<?php echo ucfirst( $font ); ?>
										</option>
										<?php
									}
									?>
								</optgroup>
								<?php
							}

							?>
						</select>
						<p class="dig_ecr_desc dig_sel_erc_desc">
							<?php _e( 'This function only works on Digits Native Forms', 'digits' ); ?>
						</p>
					</td>
				</tr>

			</table>
		</div>
	</div>
	<?php
}

function digits_settings_auth_login() {
	$digforgotpass = get_option( 'digforgotpass', 1 );
	$dig_overwrite_forgotpass_link = get_option( 'dig_overwrite_forgotpass_link', 1 );

	$dig_third_party_more_secure = get_option( 'dig_third_party_more_secure', 1 );


	$dig_only_allow_secure_logins = get_option( 'dig_only_allow_secure_logins', 0 );
	?>
	<div class="dig_admin_head"><span>
			<?php _e( 'Login Settings', 'digits' ); ?>
		</span></div>

	<div class="dig_admin_tab_grid">
		<div class="dig_admin_tab_grid_elem">
			<div>
				<table class="form-table">
					<tr>
						<th scope="row"><label class="top-10">
								<?php _e( 'Make Third Party Login Forms More Secure', 'digits' ); ?>
							</label>
						</th>
						<td>
							<?php digits_input_switch( 'dig_third_party_more_secure', $dig_third_party_more_secure ); ?>
						</td>
					</tr>
					<tr>
						<th scope="row"><label class="top-10">
								<?php _e( 'Allow Logins only from Digits Secure Form', 'digits' ); ?>
							</label>
						</th>
						<td>
							<?php digits_input_switch( 'dig_only_allow_secure_logins', $dig_only_allow_secure_logins ); ?>
						</td>
					</tr>
					<tr class="enabledisableforgotpasswordrow">
						<th scope="row"><label class="top-10">
								<?php _e( 'Enable Forgot Password', 'digits' ); ?>
							</label>
						</th>
						<td>
							<?php digits_input_switch( 'dig_enable_forgotpass', $digforgotpass ); ?>

							<p class="dig_ecr_desc dig_sel_erc_desc">
								<?php _e( 'This function only works on Digits Native Forms', 'digits' ); ?>
							</p>
						</td>
					</tr>

					<tr class="enabledisableforgotpasswordrow">
						<th scope="row"><label class="top-10">
								<?php _e( 'Use Digits form as default Forgot Password form', 'digits' ); ?>
							</label>
						</th>
						<td>
							<?php digits_input_switch( 'dig_overwrite_forgotpass_link', $dig_overwrite_forgotpass_link ); ?>
						</td>
					</tr>
				</table>
			</div>

			<div class="dig_admin_sec_head dig_admin_sec_head_margin"><span>
					<?php _e( 'Form Fields', 'digits' ); ?>
				</span>
			</div>

			<table class="form-table">
				<?php
				$dig_login_field_details = digit_get_login_fields();
				foreach ( digit_default_login_fields() as $login_field => $values ) {
					if ( $login_field == 'dig_login_captcha' ) {
						continue;
					}
					$field_value = $dig_login_field_details[ $login_field ];
					?>
					<tr>
						<th scope="row"><label class="top-10">
								<?php _e( $values['name'], "digits" ); ?>
							</label></th>
						<td>
							<?php digits_input_switch( $login_field, $field_value ); ?>
						</td>
					</tr>
					<?php
				}
				?>

				<tr>
					<?php
					$captcha = get_option( 'dig_login_captcha', 0 );
					?>
					<th scope="row"><label>
							<?php _e( 'Captcha', "digits" ); ?>
						</label></th>
					<td>
						<select name="dig_login_captcha" class="dig_custom_field_sel">
							<option value="0" <?php if ( $captcha == 0 ) {
								echo 'selected';
							} ?>>
								<?php _e( 'Disable', 'digits' ); ?>
							</option>
							<option value="2" <?php if ( $captcha == 2 ) {
								echo 'selected';
							} ?>>
								<?php _e( 'ReCaptcha', 'digits' ); ?>
							</option>
							<option value="1" <?php if ( $captcha == 1 ) {
								echo 'selected';
							} ?>>
								<?php _e( 'Simple Captcha', 'digits' ); ?>
							</option>
						</select>
					</td>
				</tr>

				<tr>
					<?php
					$remember_me = get_option( 'dig_login_rememberme', 1 );
					?>
					<th scope="row"><label>
							<?php _e( 'Remember Me', "digits" ); ?>
						</label></th>
					<td>
						<select name="dig_login_rememberme" class="dig_custom_field_sel">
							<option value="2" <?php if ( $remember_me == 2 ) {
								echo 'selected';
							} ?>>
								<?php _e( 'Always', 'digits' ); ?>
							</option>
							<option value="1" <?php if ( $remember_me == 1 ) {
								echo 'selected';
							} ?>>
								<?php _e( 'Yes (Show Checkbox)', 'digits' ); ?>
							</option>
							<option value="0" <?php if ( $remember_me == 0 ) {
								echo 'selected';
							} ?>>
								<?php _e( 'No', 'digits' ); ?>
							</option>
						</select>
					</td>
				</tr>

			</table>
			<div class="dig_admin_sec_head dig_admin_sec_head_margin_top">
			</div>
			<?php
			digits_admin_login_allowed_methods();
			?>

		</div>
		<div class="dig_admin_tab_grid_elem dig_admin_tab_grid_sec">
			<?php
			$hint = __( 'With User / UserRole based login flow you can define unique login methods based on user roles or any particular users.', 'digits' );
			$hint .= "<br /><br />";
			$hint .= __( 'For example, you can only let admin user role to login using OTP and all other user roles should login using password', 'digits' );
			$hint .= "<br /><br />";
			$hint .= '<b>' . __( 'Note:', 'digits' ) . '&nbsp;</b>';
			$hint .= __( 'If Firebase is being used as the SMS gateway, users can only receive an SMS OTP if they log in with their phone number. This means that attempting to log in using an email or username will not trigger the SMS OTP for security reasons.', 'digits' );
			digits_settings_show_hint( $hint );
			?>


		</div>
	</div>
	<?php
}


function digits_settings_form_style() {
	?>
	<div class="dig_admin_head">
		<span>
			<?php _e( 'Native Form Style', 'digits' ); ?>
		</span><span class="dig_admin_tag dig_admin_tag_new">
			<?php esc_attr_e( 'New', 'digits' ); ?>
		</span>
	</div>

	<div class="dig_admin_tab_grid">
		<div class="dig_admin_tab_grid_elem">
			<?php
			digit_customize( false );
			?>
		</div>
	</div>
	<?php
}
