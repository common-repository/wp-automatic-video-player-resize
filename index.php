<?php
/*
Plugin Name: WP automatic video player resize
Plugin URI: https://www.wpajans.net
Description: WordPress automatic video player resize(Youtube,VK,Mail.ru vsvs)
Version: 1.0
Author: Wpajans(Mustafa KÜÇÜK)
Author URI: https://www.wpajans.net
License: GNU
*/

add_action('admin_menu', 'WpAJANS_resize_video_PLAYER_manager_menu');
 
function WpAJANS_resize_video_PLAYER_manager_menu()
 {
 add_options_page('Video Player Resize','Video Player Resize', '8', 'Video-Player-Resize', 'WpAJANS_resize_video_PLAYER_manager_page');
 }
 
 function WpAJANS_resize_video_PLAYER_manager_page() {
				if (strlen($_POST['hiddenoption'] == 'okey')) {
					$get_width = intval($_POST['video-player-width']);
					update_option('get_width_get', $get_width);
					$get_height = intval($_POST['video-player-height']);
					update_option('get_height_get', $get_height);
		?>
					<div class="updated"><p><strong><?php _e('Options saved.'); ?></strong></p></div>
		<?php
				}

 ?>
 <div style="margin-top:10px;">
 <h2>WpAJANS Video player resize manager</h2>
  <form method="post" action='<?php echo $_SERVER["REQUEST_URI"]; ?>'>
                    <label for="video-player-width">Video player Width?</label>
                    <input type="text" id="video-player-width" name="video-player-width" value="<?php echo get_option('get_width_get'); ?>" /><br />
                    <label for="video-player-height">Video player Height?</label>
                    <input type="text" id="video-player-height" name="video-player-height" value="<?php echo get_option('get_height_get'); ?>" /><br />
                    <input type="hidden" id="hiddenoption" name="hiddenoption" value="okey"/><br />
                    <input type="submit" id="submit" name="submit" class="button-primary" value="<?php _e('Save Changes'); ?>" />
                </form>
 </div>
 <?php }

function WpAJANS_resize_video_PLAYER($content)
{$whatwidth = get_option('get_width_get');
$whatheight = get_option('get_height_get');
  //add content that you wish to replace to this array
  $search  = array("width='", "height='", 'width="', 'height="');
  //add content that will replace old content to this array
  $replace = array("width='".$whatwidth."'", "height='".$whatheight."'", 'width="'.$whatwidth.'"', 'height="'.$whatheight.'"');

  $content = str_replace($search, $replace, $content);
  return $content;
}

add_filter('the_content', 'WpAJANS_resize_video_PLAYER');
add_filter('the_excerpt', 'WpAJANS_resize_video_PLAYER');
?>