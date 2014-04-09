<?php 
// create custom plugin settings menu
add_action('admin_menu', 'tmm_create_menu');
function tmm_create_menu() {
	//create new submenu
	add_submenu_page( 'themes.php', 'The Midnight Mission Options', 'TMM Options', 'administrator', "tmm_options", 'tmm_settings_page');

	//call register settings function
	add_action( 'admin_init', 'tmm_register_settings' );
}

function tmm_register_settings() {
	//register our settings
	register_setting( 'tmm-settings-group', 'tmm_newsletter' );
	register_setting( 'tmm-settings-group', 'tmm_facebook' );
	register_setting( 'tmm-settings-group', 'tmm_twitter' );
	register_setting( 'tmm-settings-group', 'tmm_youtube' );
	
	register_setting( 'tmm-settings-group', 'tmm_gethelp' );
	register_setting( 'tmm-settings-group', 'tmm_stories' );
	
	register_setting( 'tmm-settings-group', 'tmm_e_donate' );
	register_setting( 'tmm-settings-group', 'tmm_donate_goods' );
	register_setting( 'tmm-settings-group', 'tmm_volunteer' );
	
	register_setting( 'tmm-settings-group', 'tmm_analytics' );
}

function tmm_settings_page() {

	?>

<div class="wrap">
	<h2>The Midnight Mission Settings</h2>

	<form id="landingOptions" method="post" action="options.php">
		<?php settings_fields( 'tmm-settings-group' ); ?>
		<table class="form-table">
			<tr valign="top">
				<th scope="row">Sign-up Newsletter Link:</th>
				<td><input type="text" style="width: 300px" name="tmm_newsletter"
					value="<?php print get_option('tmm_newsletter'); ?>" />
				</td>
			</tr>
						
			<tr>
				<th scope="row">Facebook Link:</th>
				<td><input type="text" style="width: 300px" name="tmm_facebook"
					value="<?php print get_option('tmm_facebook'); ?>" />
				</td>
			</tr>
			<tr>
				<th scope="row">Twitter Link:</th>
				<td><input type="text" style="width: 300px" name="tmm_twitter"
					value="<?php print get_option('tmm_twitter'); ?>" />
				</td>
			</tr>
			<tr>
				<th scope="row">YouTube Link:</th>
				<td><input type="text" style="width: 300px" name="tmm_youtube"
					value="<?php print get_option('tmm_youtube'); ?>" />
				</td>
			</tr>
			<tr/>
			<tr>
				<th scope="row"></th>
				<td></td>
			</tr>
			
			<!-- 
			<tr>
				<th scope="row">Get Help Link:</th>
				<td><input type="text" style="width: 300px" name="tmm_gethelp"
					value="<?php print get_option('tmm_gethelp'); ?>" />
				</td>
			</tr>
			<tr>
				<th scope="row">The Stories Link:</th>
				<td><input type="text" style="width: 300px" name="tmm_stories"
					value="<?php print get_option('tmm_stories'); ?>" />
				</td>
			</tr>
			<tr/>
			<tr>
				<th scope="row"></th>
				<td></td>
			</tr>
			 -->
			<tr>
				<th scope="row">E-Donate Link:</th>
				<td><input type="text" style="width: 300px" name="tmm_e_donate"
					value="<?php print get_option('tmm_e_donate'); ?>" />
				</td>
			</tr>
			<tr>
				<th scope="row">Donate Goods Link:</th>
				<td><input type="text" style="width: 300px" name="tmm_donate_goods"
					value="<?php print get_option('tmm_donate_goods'); ?>" />
				</td>
			</tr>
			<tr>
				<th scope="row">Volunteer Link:</th>
				<td><input type="text" style="width: 300px" name="tmm_volunteer"
					value="<?php print get_option('tmm_volunteer'); ?>" />
				</td>
			</tr>
			<tr/>  
			<tr>
				<th scope="row"></th>
				<td></td>
			</tr>
			
			<tr>
				<th scope="row">Google Analytics Code:</th>
				<td><textarea style="width: 300px" name="tmm_analytics">
						<?php print get_option('tmm_analytics'); ?>
					</textarea>
				</td>
			</tr>
		</table>
		<p class="submit">
			<input type="submit" class="button-primary"
				value="<?php _e('Save Changes') ?>" />
		</p>

	</form>
</div>
<?php } ?>
