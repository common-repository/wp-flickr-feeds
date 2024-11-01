<?php
/*
Plugin Name: WP Flickr Feeds
Plugin URI: http://www.netattingo.com/
Description: This plugin helps to display latest feeds of your Flickr feeds on the site.
Author: NetAttingo Technologies
Version: 1.0.0
Author URI: http://www.netattingo.com/
*/
define('WP_DEBUG',true);
define('WPFF_DIR', plugin_dir_path(__FILE__));
define('WPFF_URL', plugin_dir_url(__FILE__));
define('WPFF_PAGE_DIR', plugin_dir_path(__FILE__).'pages/');
define('WPFF_INCLUDE_URL', plugin_dir_url(__FILE__).'includes/');

//Include menu and assign page
function wpff_plugin_menu() {
    $icon = WPFF_URL. 'includes/icon.png';
	add_menu_page("Flickr Wall Post", "Flickr Wall Post", "administrator", "wp-flickr-feed-setting", "wpff_plugin_pages", $icon ,30);
	add_submenu_page("wp-flickr-feed-setting", "About Us", "About Us", "administrator", "wpff-about-us", "wpff_plugin_pages");
}
add_action("admin_menu", "wpff_plugin_menu");

function wpff_plugin_pages() {

   $itm = WPFF_PAGE_DIR.$_GET["page"].'.php';
   include($itm);
}

//Include front css 
function wpff_js_css_add_init() {
    wp_enqueue_style("wpff_css", plugins_url('includes/wpff-front-style.css',__FILE__ )); 
	wp_enqueue_script('wpff_css');
}
add_action( 'wp_enqueue_scripts', 'wpff_js_css_add_init' );


//add admin css
function wpff_admin_css() {
  wp_register_style('fl_admin_css', plugins_url('includes/flickr-admin-style.css',__FILE__ ));
  wp_enqueue_style('fl_admin_css');
}
add_action( 'admin_init','wpff_admin_css' );


//Netgo Shortcode list view
add_shortcode( 'flickr-feeds-list', 'wpff_shortcode_function_list_view' );
function wpff_shortcode_function_list_view( $atts ) {

	$api_key = get_option('netgo_flicr_app_id');
	$user_id = get_option('netgo_flickr_user_id');
	$url = 'https://api.flickr.com/services/rest/?method=flickr.photos.search';
	$url.= '&api_key='.$api_key;
	$url.= '&user_id='.$user_id;
	$url.= '&format=json';
	$url.= '&nojsoncallback=1';
	
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	$output = curl_exec($ch);
	curl_close($ch);
	$response =  json_decode($output);
	$photo_array = $response->photos->photo;
	
	//trigger exception in a "try" block
	try {
		$photo_array = $response->photos->photo;
		if(!empty($photo_array))
		{
		  $flag=1;
		?>
		<div class="main-flickr-feeds-div">
		<h1>Flickr Feeds</h1>
		<ul id="list_flickr_feed" class="flickr-feed-list-view">
			<?php
				foreach($photo_array as $single_photo):
					$farm_id = $single_photo->farm;
					$owner_id = $single_photo->owner;
					$server_id = $single_photo->server;
					$photo_id = $single_photo->id;
					$secret_id = $single_photo->secret;
					$size = 'm';
					$title = $single_photo->title;
					$photo_url = 'http://farm'.$farm_id.'.staticflickr.com/'.$server_id.'/'.$photo_id.'_'.$secret_id.'_'.$size.'.'.'jpg';							
			?>
				<li  id="<?php echo $flag; ?><?php echo ($flag%4); ?>">
					<div class="flickr_single_box">
						<div class="img_box">
							<a target="_blank" href="https://www.flickr.com/photos/<?php echo $owner_id; ?>/<?php echo $photo_id; ?>">
								<img title='<?php echo $title; ?>' src='<?php echo $photo_url; ?>' />
							</a>
						</div>
						<div class="content"> 
							<div class="contant_box1"><?php echo $title; ?></div>
						</div>
					</div>
				</li>
			<?php
				$flag++;
			endforeach;  
		 ?>
		 </ul>
		 </div>
			 
		 <?php
		}
		else
		{
		?>
		<div class="nopost"><h3>No Feed Found!</h3></div> 
		<?php
		}
	}
	catch(Exception $e) {
	  echo '<b>Message:</b> Invalid "Flickr App Id" or "Flickr User Id"';
	}
	?>
	<?php	
}

//Netgo Shortcode  grid view
add_shortcode( 'flickr-feeds-grid', 'wpff_shortcode_function_grid_view' );
function wpff_shortcode_function_grid_view( $atts ) {

	$api_key = get_option('netgo_flicr_app_id');
	$user_id = get_option('netgo_flickr_user_id');
	$url = 'https://api.flickr.com/services/rest/?method=flickr.photos.search';
	$url.= '&api_key='.$api_key;
	$url.= '&user_id='.$user_id;
	$url.= '&format=json';
	$url.= '&nojsoncallback=1';
	
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	$output = curl_exec($ch);
	curl_close($ch);
	$response =  json_decode($output);
	$photo_array = $response->photos->photo;
	
	//trigger exception in a "try" block
	try {
    $photo_array = $response->photos->photo;
	if(!empty($photo_array))
		{
		  $flag=1;
		?>
		<div class="main-flickr-feeds-div">
		<h1>Flickr Feeds</h1>
		<ul id="grid_flickr_feed" class="flickr-feed-grid-view">
			<?php
				foreach($photo_array as $single_photo):
					$farm_id = $single_photo->farm;
					$owner_id = $single_photo->owner;
					$server_id = $single_photo->server;
					$photo_id = $single_photo->id;
					$secret_id = $single_photo->secret;
					$size = 'm';
					$title = $single_photo->title;
					$photo_url = 'http://farm'.$farm_id.'.staticflickr.com/'.$server_id.'/'.$photo_id.'_'.$secret_id.'_'.$size.'.'.'jpg';							
			?>
					<li  id="<?php echo $flag; ?><?php echo ($flag%4); ?>">
						<div class="flickr_single_box">
							<div class="img_box">
							<a target="_blank" href="https://www.flickr.com/photos/<?php echo $owner_id; ?>/<?php echo $photo_id; ?>">
								<img title='<?php echo $title; ?>' src='<?php echo $photo_url; ?>' />
							</a>
							</div>
							<div class="content"> 
								<div class="contant_box1"><?php echo $title; ?></div>
							</div>
						</div>
					</li>
					<?php
					$flag++;
				  endforeach;  
		 ?>
		 </ul> 
		 </div>
		 <div style="clear:both;"></div>
         		 
		 <?php
		 }else
		  {
		 ?>
		 <div class="nopost"><h3>No Feed Found!</h3></div> 
		 <?php
		 }	
	}
    //catch exception
	catch(Exception $e) {
	  echo '<b>Message:</b> Invalid "Flickr App Id" or "Flickr User Id"';
	}
	?>
<?php		
}
?>