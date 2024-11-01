<?php
global $wpdb;
//sanitize all post values
$flickr_setting_submit= sanitize_text_field( $_POST['flickr_setting_submit'] );
$netgo_flicr_app_id= sanitize_text_field( $_POST['netgo_flicr_app_id'] );
$netgo_flickr_user_id= sanitize_text_field( $_POST['netgo_flickr_user_id'] );
$saved= sanitize_text_field( $_POST['saved'] );

if($flickr_setting_submit!='') { 
    if(isset($netgo_flicr_app_id) ) {
		update_option('netgo_flicr_app_id', $netgo_flicr_app_id);
    }
	if(isset($netgo_flickr_user_id) ) {
		update_option('netgo_flickr_user_id', $netgo_flickr_user_id);
    }
	if($saved==true) {
		$message='saved';
	} 
}
?>
  <?php
        if ( $message == 'saved' ) {
		echo ' <div class="added-success"><p><strong>Settings Saved.</strong></p></div>';
		}
   ?>
   
<div class="wrap netgo-flickr-post-setting">
    <form method="post" id="wpffSettingForm" action="">
	<h2><?php _e('Flickr Feed Setting','');?></h2>
		<table class="form-table">
			<tr valign="top">
				<th scope="row" style="width: 370px;">
					<label for="netgo_flicr_app_id"><?php _e('Flickr App Id','');?></label>
				</th>
				<td><input type="text" name="netgo_flicr_app_id" size="50" value="<?php echo get_option('netgo_flicr_app_id'); ?>" />
			
				</td>
			</tr>
			<tr valign="top">
				<th scope="row" style="width: 370px;">
					<label for="netgo_flickr_user_id"><?php _e('User Id','');?></label>
				</th>
				<td><input type="text" name="netgo_flickr_user_id" size="50" value="<?php echo get_option('netgo_flickr_user_id'); ?>" />
				</td>
			</tr>
		</table>
		
        <p class="submit">
		<input type="hidden" name="saved" value="saved"/>
        <input type="submit" name="flickr_setting_submit" class="button-primary" value="Save Changes" />
		  <?php if(function_exists('wp_nonce_field')) wp_nonce_field('flickr_setting_submit', 'flickr_setting_submit'); ?>
        </p>
    </form>
</div>

