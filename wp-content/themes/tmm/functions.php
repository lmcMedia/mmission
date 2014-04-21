<?php
define( 'TEMPPATH', get_bloginfo('stylesheet_directory'));
define( 'IMAGES', TEMPPATH. "/images");
define( 'JS', TEMPPATH. "/js");
define( 'CSS', TEMPPATH. "/css");

add_theme_support( 'nav-menus' );
add_theme_support( 'post-thumbnails' );

/**
 * Creates a nicely formatted and more specific title element text
 * for output in head of document, based on current view.
 *
 * @since The Midnight Mission 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string Filtered title.
 */
function tmm_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'tmm' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'tmm_wp_title', 10, 2 );



if ( function_exists( 'register_nav_menus' ) ) {
	register_nav_menus(
	array('main' => 'Main')
	);
}

function wp_nav_menu_select( $args = array() ) {
	$defaults = array(
			'theme_location' => '',
			'menu_class' => 'select-menu',
	);

	$args = wp_parse_args( $args, $defaults );

	if ( ( $menu_locations = get_nav_menu_locations() ) && isset( $menu_locations[ $args['theme_location'] ] ) ) {
		$menu = wp_get_nav_menu_object( $menu_locations[ $args['theme_location'] ] );
			
		$menu_items = wp_get_nav_menu_items( $menu->term_id );
		?>
<select id="menu-<?php echo $args['theme_location'] ?>"
	class="<?php echo $args['menu_class'] ?>">
	<option value="">
		<?php _e( 'Navigation' ); ?>
	</option>
	<?php foreach( (array) $menu_items as $key => $menu_item ) : ?>
	<option value="<?php echo $menu_item->url ?>">
		<?php echo $menu_item->title ?>
	</option>
	<?php endforeach; ?>
</select>
<?php
	}

	else {
        ?>
<select class="menu-not-found">
	<option value="">
		<?php _e( 'Menu Not Found' ); ?>
	</option>
</select>
<?php
    }
}


/*****Sidebars!******/

if ( function_exists( 'register_sidebar' ) ) {
	register_sidebar( array (
	'name' => __( 'Primary Sidebar', 'primary-sidebar' ),
	'id' => 'primary-widget-area',
	'description' => __( 'The primary widget area', 'dir' ),
	'before_widget' => '<div class="widget">',
	'after_widget' => "</div>",
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
	) );
}



require_once('theme-options.php');


add_filter( 'wp_nav_menu_objects', 'add_menu_parent_class' );
function add_menu_parent_class( $items ) {

	$parents = array();
	foreach ( $items as $key => $item ) {
		if($item->type == 'custom' && $item->attr_title == 'blog')
		{
			$item->target = "_blank";			
		}
		if ( $item->menu_item_parent && $item->menu_item_parent > 0 ) {
			$parents[] = $item->menu_item_parent;
		}

	}
	// 	id 70	event_content
	foreach ( $items as $key => $item ) {
		if ( in_array( $item->ID, $parents ) ) {
			$item->classes[] = 'menu-parent-item';
		}
		if( $key == count($items) ){
			$item->classes[] = 'lasted';			
		}		
		
		if($item->ID == 70 && get_post_type() == 'event_content') {
			$item->classes[] = 'current-menu-item';
		}
		
		if($item->ID == 165 && get_post_type() == 'staff') {
			$item->classes[] = 'current-menu-item';
		}
		
		if($item->ID == 109 && get_post_type() == 'post') {
			$item->classes[] = 'current-menu-item';
		}
	
		if($item->ID == 398 && get_the_ID() == 288) {
			$item->classes[] = 'current-menu-parent';
		}
	}
	
	return $items;
}

$GLOBALS['parent_comments_count'] = 0;
$GLOBALS['child_comments_count'] = 0;

function count_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	if($comment->comment_parent==0):
	$GLOBALS['parent_comments_count']++;
	else:
	$GLOBALS['child_comments_count']++;
	endif;
}

function count_child_comment($id){
    global $wpdb;
    $query = "SELECT COUNT(comment_post_id) AS count FROM $wpdb->comments WHERE `comment_approved` = 1 AND `comment_parent` = $id";
    $parents = $wpdb->get_row($query);
    return $parents->count;
}

/**
 * Get sub blog
 * @param unknown $more
 * @return string
 */
function tmm_excerpt_more($more) {
	return ' <p><a class="blog-read-more" href="'. get_permalink() .'">Read more</a></p>';
}
add_filter('excerpt_more', 'tmm_excerpt_more', 999);
/**
 * Set legth for sub blog
 * @param int $length
 * @return number
 */
function my_excerpt_length($length) {
	return 80;
}
add_filter('excerpt_length', 'my_excerpt_length');


add_filter ("wp_mail_content_type", "my_awesome_mail_content_type");
function my_awesome_mail_content_type() {
	return "text/html";
}

if ( ! function_exists( 'twentyeleven_comment' ) ) :
/**
 * Template for comments and pingbacks.
*
* To override this walker in a child theme without modifying the comments template
* simply create your own twentyeleven_comment(), and that function will be used instead.
*
* Used as a callback by wp_list_comments() for displaying the comments.
*
* @since Twenty Eleven 1.0
*/
function twentyeleven_comment( $comment, $args, $depth ) {
	//count_comments($comment, $args, $depth);
	//echo $GLOBALS['parent_comments_count'];
	//echo $GLOBALS['child_comments_count'];
	
	//echo "parents: ".$number_of_parents;
	//echo "children: ".$number_of_children;
	global $post;
	$number_of_parents = 0;
	$number_of_children = 0;
	
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
	case 'pingback' :
	case 'trackback' :
		?>
 <li class="post pingback">
  <p><?php _e( 'Pingback:', 'twentyeleven' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?></p>
 <?php
   break;
  default :
 ?>
 <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
  <article id="comment-<?php comment_ID(); ?>" class="comment">
   <footer class="comment-meta">
    <div class="comment-author vcard">
     <?php
     // $avatar_size = 68;
      //if ( '0' != $comment->comment_parent )
      // $avatar_size = 39;

      //echo get_avatar( $comment, $avatar_size );

      /* translators: 1: comment author, 2: date and time */
     
      	printf( __( '%1$s <br/> <span class="comment-time">%2$s</span>', 'twentyeleven' ),
		
       	sprintf( '<span class="fn">%s</span>', strtoupper(get_comment_author_link()) ),
       	sprintf( '<time datetime="%2$s">%3$s</a>',
        esc_url( get_comment_link( $comment->comment_ID ) ),
        get_comment_time( 'c' ),
        /* translators: 1: date, 2: time */
        sprintf( __( '%1$s at %2$s', 'twentyeleven' ), get_comment_date(), get_comment_time() )
       )
      );
     ?>

     <?php //edit_comment_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
    </div><!-- .comment-author .vcard -->

    <?php if ( $comment->comment_approved == '0' ) : ?>
     <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'twentyeleven' ); ?></em>
     <br />
    <?php endif; ?>

   </footer>

   <div class="comment-content"><?php comment_text(); ?></div>

   <div class="reply">
    <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'REPLY', 'twentyeleven' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
   </div><!-- .reply -->
  </article><!-- #comment-## -->
  <?php 
  $number_of_children = count_child_comment($comment->comment_ID);
  if($number_of_children > 0):?>
	<div class="comment-respon">
		<p><?php echo $number_of_children;	?> RESPONSES</p>
	</div>
	<?php endif;?>
 <?php
   break;
 endswitch;
}
endif; // ends check for twentyeleven_comment()

/*************** SHORT CODE *****************/
/*************** DONATE GOODS ***************/
function donate_title ($atts, $content = null) {
	$html = "";
	extract(shortcode_atts(array(
		'title'		=> ''),
	$atts));

	$html .= '<h2 class="ctn-title">'. $title .'</h2>';
	return $html;
}
add_shortcode('dona_title', 'donate_title');

function donate_step_1 ($atts, $content = null) {
	$html = '	<div class="edo-step">
					<ul>
						<li class="step1-good">&nbsp;&#32;</li>
						<li class="arrow-hiden">&nbsp;&#32;</li>
						<li class="step2-good-hiden">&nbsp;&#32;</li>
						<li class="arrow-hiden">&nbsp;&#32;</li>
						<li class="step3-hiden">&nbsp;&#32;</li>
					</ul>
				</div>';
	return $html;
}
add_shortcode('dona_step_1', 'donate_step_1');

function donate_step_2 ($atts, $content = null) {
	$html = '	<div class="edo-step">
					<ul>
						<li class="step1-good-hiden"></li>
						<li class="arrow"></li>
						<li class="step2-good"></li>
						<li class="arrow-hiden"></li>
						<li class="step3-hiden"></li>
					</ul>
				</div>';
	return $html;
}
add_shortcode('dona_step_2', 'donate_step_2');

function donate_step_3 ($atts, $content = null) {
	$html = '	<div class="edo-step">
					<ul>
						<li class="step1-good-hiden"></li>
						<li class="arrow-hiden"></li>
						<li class="step2-good-hiden"></li>
						<li class="arrow"></li>
						<li class="step3"></li>
					</ul>
				</div>';
	return $html;
}
add_shortcode('dona_step_3', 'donate_step_3');

function donate_step_1_content ($atts, $content = null) {
	$html = '<div class="edo-box">
				<div class="edo-box-top"></div>
				<div class="edo-box-ctn edo-step-1">
				'. do_shortcode($content) .'
				</div>
				<div class="edo-box-bottom"></div>
			</div>';
	return $html;
}
add_shortcode('dona_step_1_content', 'donate_step_1_content');

function donate_step_2_content ($atts, $content = null) {
	$html = '<div class="edo-box">
				<div class="edo-box-top"></div>
				<div class="edo-box-ctn">
				'. do_shortcode($content) .'
				<div class="clear"></div>
				</div>
				<div class="edo-box-bottom"></div>
			</div>';
	return $html;
}
add_shortcode('dona_step_2_content', 'donate_step_2_content');

function donate_content_left ($atts, $content = null) {
	$html = "";
	extract(shortcode_atts(array(
		'images_url'		=> ''),
	$atts));

	$html .= '	<div class="dona-box-left-st1">
					<img src="'. $images_url .'" alt="">
				</div>';
	return $html;
}
add_shortcode('dona_content_left', 'donate_content_left');

function donate_content_left_2 ($atts, $content = null) {
	$html = "";
	extract(shortcode_atts(array(
	'images_url'		=> ''),
	$atts));

	$html .= '	<div class="dona-box-left">
					<img src="'. $images_url .'" alt="">
				</div>';
	return $html;
}
add_shortcode('dona_content_left_2', 'donate_content_left_2');

function donate_content_right ($atts, $content = null) {
	$html = "";
	$des = "";
	extract(shortcode_atts(array(
		'title'			=> '',
		'descriptions'	=> ''),
	$atts));
	
	if ($descriptions != null) {
		$des = '<p class="dona-st2-txt">'. $descriptions .'</p>';
	}
	
	$html .= '	<div class="edo-box-right">
					<h2 class="edo-right-title-2">'. $title .'</h2>
					'. $des .'
					'. do_shortcode($content) .'
				</div>';
	return $html;
}
add_shortcode('dona_content_right', 'donate_content_right');

function donate_content_right_1 ($atts, $content = null) {
	return '<div class="dona-left">'. do_shortcode($content) .'</div>';
}
add_shortcode('dona_content_right_1', 'donate_content_right_1');

function donate_content_right_2 ($atts, $content = null) {
	return '<div class="dona-right">'. do_shortcode($content) .'</div>';
}
add_shortcode('dona_content_right_2', 'donate_content_right_2');

function donate_right_1_items ($atts, $content = null) {
	$html = "";
	extract(shortcode_atts(array(
		'image_url'	=> '',
		'title'		=> ''),
	$atts));

	$html .= '	<div class="dona-left-icon">
					<img alt="" src="'. $image_url .'" />
					<p>'. $title .'</p>
				</div>';
	return $html;
}
add_shortcode('dona_right_1_items', 'donate_right_1_items');

function donate_cloth ($atts, $content = null) {
	$html = "";
	extract(shortcode_atts(array(
		'item_1'	=> '',
		'item_2'		=> ''),
	$atts));

	$html .= '	<div class="dona-cloth">
					<ul>
						<li>'. $item_1 .'</li>
						<li>'. $item_2 .'</li>
					</ul>
				</div>';
	return $html;
}
add_shortcode('dona_cloth', 'donate_cloth');

function donate_house ($atts, $content = null) {
	$html = "";
	extract(shortcode_atts(array(
		'item_1'	=> '',
		'item_2'	=> '',
		'item_3'	=> '',
		'item_4'	=> '',
		'item_5'	=> '',
		'item_6'	=> '',
		'item_7'	=> ''),
	$atts));

	$html .= '	<div class="dona-house">
					<ul>
						<li>'. $item_1 .'</li>
						<li>'. $item_2 .'</li>
						<li>'. $item_3 .'</li>
						<li>'. $item_4 .'</li>
						<li>'. $item_5 .'</li>
						<li>'. $item_6 .'</li>
						<li>'. $item_7 .'</li>
					</ul>
				</div>';
	return $html;
}
add_shortcode('dona_house', 'donate_house');

function donate_food ($atts, $content = null) {
	$html = "";
	extract(shortcode_atts(array(
		'item_1'	=> '',
		'item_2'	=> ''),
	$atts));

	$html .= '	<div class="dona-food">
					<ul>
						<li>'. $item_1 .'</li>
						<li class="normal-font">'. $item_2 .'</li>
					</ul>
				</div>';
	return $html;
}
add_shortcode('dona_food', 'donate_food');

function donate_car ($atts, $content = null) {
	$html = "";
	extract(shortcode_atts(array(
		'item_1'	=> ''),
	$atts));

	$html .= '	<div class="dona-car">
					<ul>
						<li>'. $item_1 .'</li>
					</ul>
				</div>';
	return $html;
}
add_shortcode('dona_car', 'donate_car');

function donate_appliances ($atts, $content = null) {
	$html = "";
	extract(shortcode_atts(array(
		'item_1'	=> ''),
	$atts));

	$html .= '	<div class="dona-appliances">
					<ul>
						<li>'. $item_1 .'</li>
					</ul>
				</div>';
	return $html;
}
add_shortcode('dona_appliances', 'donate_appliances');

function donate_button_step_1 ($atts, $content = null) {
	return  '	<div class="edo-button">
					<a class="edo-button-next" href="../step-2/"></a>
				</div>';
}
add_shortcode('dona_button_step_1', 'donate_button_step_1');

function donate_bottom ($atts, $content = null) {
	$html = "";
	extract(shortcode_atts(array(
		'content_text'	=> ''),
	$atts));

	$html .= '	<p class="dona-text">'. $content_text .'</p>';
	return $html;
}
add_shortcode('dona_bottom', 'donate_bottom');

function remove_tag_br ($atts, $content = null) {
	return '<script>
				$(document).ready(function(){
					$(".right-col br").remove();
				});
			</script>';
}
add_shortcode('remove_tag_br', 'remove_tag_br');

function dona_form ($atts, $content = null) {
	$dona3 = get_page_by_title('Donate Goods 3');
	
	return '<form action="'. get_permalink($dona3->ID) .'" id="edo-doantion" name="edo-doantion" 
      		method="post" enctype="multipart/form-data">
      		'. do_shortcode($content) .'</form>';
}
add_shortcode('dona_form', 'dona_form');

function dona_form_item_text ($atts, $content = null) {
	$html = "";
	$req = "";
	extract(shortcode_atts(array(
		'name'		=> '',
		'label'		=> '',
		'require'	=> ''),
	$atts));
	
	if($require == "true") {
		$req = '<span class="require">*</span>';
	}
	
	$html .= '	<div class="edo-info-line">
        			<label>'. $label . $req .':</label>
					<input id="'. $name .'" name="'. $name .'" class="edo-txt-style1" type="text" />
        		</div>';
	return $html;
}
add_shortcode('dona_form_item_text', 'dona_form_item_text');

function dona_form_item_checkbox ($atts, $content = null) {
	$html = "";
	$chk = "";
	extract(shortcode_atts(array(
		'name'		=> '',
		'label'		=> '',
		'checked'	=> ''),
	$atts));

	if($checked == "true") {
		$chk = 'checked="true"';
	}

	$html .= '	<div class="edo-info-line">
        			<input class="edo-chk-style1" name="'. $name .'" type="checkbox" id="'. $name .'" value="true" '. $chk .' />
    				<label for="'. $name .'" class="dona-chk-text">'. $label .'</label>
        		</div>';
	return $html;
}
add_shortcode('dona_form_item_checkbox', 'dona_form_item_checkbox');

function dona_form_item_button ($atts, $content = null) {
	$html = "";
	$chk = "";
	extract(shortcode_atts(array(
		'name'		=> '',
		'label'		=> ''),
	$atts));

	$html .= '	<div class="edo-button">
        			<input type="submit" id="edo_info" class="edo-button-next" value="" name="'. $name .'"/>
        		</div>';
	return $html;
}
add_shortcode('dona_form_item_button', 'dona_form_item_button');

function dona_content_right_3 ($atts, $content = null) {
	$html = "";
	$chk = "";
	
	$al_options = get_option('al_general_settings');
	$facebook = isset ($al_options['al_fblink']) ? $al_options['al_fblink'] : '';
	$twitter = isset ($al_options['al_twlink']) ? $al_options['al_twlink'] : '';
	
	extract(shortcode_atts(array(
		'title'			=> '',
		'text_1'		=> '',
		'text_2'		=> '',
		'text_3'		=> ''),
	$atts));

	$titleShare = urlencode("Midnight Mission");
	$messageFacebook = urlencode("I just donated goods to The Midnight Mission! Since 1914, The Midnight has been offering a path to self-sufficiency to men, women and children who have lost everything.");
	$messageTwitter = urlencode("I just donated goods to The Midnight Mission! midnightmission.org #TMM");
	$url = "http://www.midnightmission.org";
	
	
	$html .= '	<div class="dona-box-right">
					<form type="post" name="edo-form">
						<div class="edo-button">
							<p class="edo-right-title-3">'. $title .'</p>
							<p class="edo-pra1">'. $text_1 .'</p>
							<p class="edo-pra2">'. $text_2 .'</p>
							<a class="edo-icon-fb" href="http://www.facebook.com/sharer/sharer.php?s=100&p[title]='.$titleShare.'&p[summary]='.$messageFacebook.'&p[url]='.$url.'" target="_blank"></a> 
							<a class="edo-icon-tw" href="http://twitter.com/home?status='.$messageTwitter.'" target="_blank"></a>
							<p class="edo-pra3">'. $text_3 .'</p>
							<a class="edo-button-donanow" href="https://give.cornerstone.cc/The+Midnight+Mission"></a>
						</div>
					</form>
				</div>
				<div class="clear"></div>';
	return $html;
}
add_shortcode('dona_content_right_3', 'dona_content_right_3');
/************* END DONATE GOODS *************/

/***************** VOLUNTTER ****************/
function volunteer_step_1 ($atts, $content = null) {
	$html = '	<div class="edo-step">
					<ul>
						<li class="step1-vol"></li>
						<li class="arrow-hiden"></li>
						<li class="step2-good-hiden"></li>
						<li class="arrow-hiden"></li>
						<li class="step3-hiden"></li>
					</ul>
				</div>';
	return $html;
}
add_shortcode('volunteer_step_1', 'volunteer_step_1');

function volunteer_step_2 ($atts, $content = null) {
	$html = '	<div class="edo-step">
					<ul>
						<li class="step1-vol-hiden"></li>
						<li class="arrow"></li>
						<li class="step2-vol"></li>
						<li class="arrow-hiden"></li>
						<li class="step3-hiden"></li>
					</ul>
				</div>';
	return $html;
}
add_shortcode('volunteer_step_2', 'volunteer_step_2');

function volunteer_step_3 ($atts, $content = null) {
	$html = '	<div class="edo-step">
					<ul>
						<li class="step1-vol-hiden"></li>
						<li class="arrow-hiden"></li>
						<li class="step2-good-hiden"></li>
						<li class="arrow"></li>
						<li class="step3-vol"></li>
					</ul>
				</div>';
	return $html;
}
add_shortcode('volunteer_step_3', 'volunteer_step_3');

function volunteer_content ($atts, $content = null) {
	$html = '	<div class="edo-box">
					<div class="vol-box-top"></div>
					<div class="vol-box-ctn">
						'. do_shortcode($content) .'
						<div class="clear"></div>
					</div>
					<div class="clear"></div>
					<div class="vol-box-bottom"></div>
				</div>';
	return $html;
}
add_shortcode('volunteer_content', 'volunteer_content');

function volunteer_left_1 ($atts, $content = null) {
	$html = "";

	extract(shortcode_atts(array(
		'image_url'		=> ''),
	$atts));

	$html .= '	<div class="vol-box-left-st1">
        			<img src="'. $image_url .'" alt="" />
        		</div>';
	return $html;
}
add_shortcode('volunteer_left_1', 'volunteer_left_1');

function volunteer_left_2 ($atts, $content = null) {
	$html = "";

	extract(shortcode_atts(array(
		'image_url'		=> ''),
	$atts));

	$html .= '	<div class="vol-box-left-st2">
        			<img src="'. $image_url .'" alt="" />
        		</div>';
	return $html;
}
add_shortcode('volunteer_left_2', 'volunteer_left_2');

function volunteer_left_3 ($atts, $content = null) {
	$html = "";

	extract(shortcode_atts(array(
		'image_url'		=> ''),
	$atts));

	$html .= '	<div class="vol-box-left">
        			<img src="'. $image_url .'" alt="" />
        		</div>';
	return $html;
}
add_shortcode('volunteer_left_3', 'volunteer_left_3');

function volunteer_main ($atts, $content = null) {
	$volStep2 = get_page_by_title('Volunteer 2');

	$html = '	<form id="edo-doantion" name="edo-doantion" method="post"
					enctype="multipart/form-data"
					action="'. get_permalink($volStep2->ID) .'">
					<div class="dona-box-right vol-step-1">
						'. do_shortcode($content) .'
					</div>
				</form>';
	return $html;
}
add_shortcode('volunteer_main', 'volunteer_main');


function volunteer_main_2 ($atts, $content = null) {
	$volStep3 = get_page_by_title('Volunteer 3');

	$html = '	<div class="dona-box-right">
					<form id="edo-doantion" name="edo-doantion" enctype="multipart/form-data" 
						method="post" action="'. get_permalink($volStep3->ID) .'">
					'. do_shortcode($content) .'
				</form>';
	return $html;
}
add_shortcode('volunteer_main_2', 'volunteer_main_2');

function volunteer_select_act ($atts, $content = null) {
	$html = "";

	extract(shortcode_atts(array(
		'title'		=> '',
		'text'		=> ''),
	$atts));

	$html .= '	<div class="vol-select-act">
        			<p class="vol-title">'. $title .'</p>
					<p>'. $text .'</p>
        		</div>';
	return $html;
}
add_shortcode('volunteer_select_act', 'volunteer_select_act');

function volunteer_checkbox_step_1 ($atts, $content = null) {
	$html = "";

	extract(shortcode_atts(array(
		'title'		=> ''),
	$atts));

	$html .= '	<div class="vol-info-1">
        			<p class="vol-title2">'. $title .'</p>
					'. do_shortcode($content) .'
        		</div>';
	return $html;
}
add_shortcode('volunteer_checkbox_step_1', 'volunteer_checkbox_step_1');

function volunteer_checkbox_item ($atts, $content = null) {
	$html = "";

	extract(shortcode_atts(array(
		'name'		=> '',
		'label'		=> ''),
	$atts));

	$html .= '	<div class="vol-info-line">
					<input id="'. $name .'" type="checkbox" name="'. $name .'" value="'. $label .'" />
        			<label for="'. $name .'" class="vol-chk-title">'. $label .'</label>
        		</div>';
	return $html;
}
add_shortcode('volunteer_checkbox_item', 'volunteer_checkbox_item');

function volunteer_your_kill ($atts, $content = null) {
	$html = "";

	extract(shortcode_atts(array(
		'text_1'		=> '',
		'text_2'		=> ''),
	$atts));

	$html .= "	<div class='vol-your-skill'>
					<p class='vol-title2'>". $text_1 ."</p>
        			<p class='vol-sktext'>". $text_2 ."</p>
			
					<textarea class='vol-textarea' rows='4' cols='50' name='vol-your-skill'></textarea>
					<div class='vol-button'>
						<input type='submit' name='vol-next' value='' class='vol-next' />
					</div>
        		</div>";
	return $html;
}
add_shortcode('volunteer_your_kill', 'volunteer_your_kill');

function volunteer_selected_act ($atts, $content = null) {
	$html = "";

	extract(shortcode_atts(array(
		'text_1'		=> '',
		'text_2'		=> ''),
	$atts));
	
	if(isset($_SESSION['vol-step-2'])){
		$content_chk = $_SESSION['chk-vol-2'];
	} else {
		$content_chk = "";
	}

	$html .= '	<div class="vol-select-act">
					<p class="vol-title">'. $text_1 .'</p>
					'. $content_chk .'
					<div>
						<span class="vol-select-txt2">'. $text_2 .'</span>
						<input class="vol-sel-input" type="text" name="vol-friend" />
					</div>
        		</div>';
	return $html;
}
add_shortcode('volunteer_selected_act', 'volunteer_selected_act');

function volunteer_form_step_2 ($atts, $content = null) {
	extract(shortcode_atts(array(
		'title'		=> '',
		'text'		=> ''),
	$atts));
	
	return '<div class="vol-info">
				<p class="vol-title2">'. $title .'</p>
				<p class="dona-st2-txt">'. $text .'</p>
				'. do_shortcode($content) .'
			</div>';
}
add_shortcode('volunteer_form_step_2', 'volunteer_form_step_2');

function volunteer_button ($atts, $content = null) {
	extract(shortcode_atts(array(
		'name'		=> ''),
	$atts));

	return '<div class="vol-button">
				<input type="submit" value="" name="'. $name .'" class="vol-next" />
			</div>';
}
add_shortcode('volunteer_button', 'volunteer_button');

function volunteer_step_3_content ($atts, $content = null) {
	$tw = "";
	$fb = "";

	extract(shortcode_atts(array(
		'title'		=> '',
		'text_1'	=> '',
		'text_2'	=> '',
		'text_3'	=> ''),
	$atts));
	
	if($facebook_link == "") {
		$fb = "#";
	} else {
		$fb = $facebook_link;
	}
	
	if($twitter_link == "") {
		$tw = "#";
	} else {
		$tw = $twitter_link;
	}
	
	$titleShare = urlencode("Midnight Mission");
	$messageFacebook = urlencode("I just signed up to volunteer at The Midnight Mission! Since 1914, The Midnight has been offering a path to self-sufficiency to men, women and children who have lost everything.");
	$messageTwitter = urlencode("I just signed up to volunteer at The Midnight Mission! midnightmission.org #TMM ");
	$url = "http://www.midnightmission.org";
		
	return '<div class="dona-box-right">
				<form>
					<div class="edo-button">
						<p class="edo-right-title-3">'. $title .'<p>
						<p class="edo-pra1">'. $text_1 .'</p>
						<p class="edo-pra2">'. $text_2 .'</p>
						<a class="edo-icon-fb" href="http://www.facebook.com/sharer/sharer.php?s=100&p[title]='.$titleShare.'&p[summary]='.$messageFacebook.'&p[url]='.$url.'" target="_blank"></a> 
						<a class="edo-icon-tw" href="http://twitter.com/home?status='.$messageTwitter.'" target="_blank"></a>
						<p class="edo-pra3">'. $text_3 .'</p>
						<a class="vol-dona-now" href="https://give.cornerstone.cc/The+Midnight+Mission"></a>
					</div>
				</form>
			</div>
			<div class="clear"></div>';
}
add_shortcode('volunteer_step_3_content', 'volunteer_step_3_content');
/*************** END VOLUNTTER **************/

function social_tabs ($atts, $content = null) {
	include 'functions/plugins/twitter/twitters.php';
	
	$html = '<div class="double shadow">
						<div class="tabs">
							<ul class="title">
								<li class="active"><a class="tab-tweets" ></a></li>
								<li><a class="tab-facebook"></a></li>
								<li><a class="tab-tumblr"></a></li>
							</ul>
							<ul class="content">
								<li id="tabs-1" class="tab-content">
									<div id="tabs-1-container" >
										<ul class="tweets">';
											
	foreach($tweetsArr as $tw) {
		$html .= '							<li>										
												<p><span style="font-family: \'HelveticaNeue-Bold\';">#'. $tw['username'] .'</span>'. $tw['created_at'] .'</p>
												<p style="display: block;">'. $tw['text'] .'</p>
												<p><a href="'. $tw['url'] .'" target="_blank" style="color: #8dd6f5; display: block; text-align: right;">Read more</a></p>
											</li>';
	}
												
												
	$html .= '							</ul>
									</div>						
								</li>
								<li id="tabs-2" class="tab-content">							
									<div id="tabs-2-container" >
										<ul class="facebooks">
										</ul>
									</div>
								</li>
								<li id="tabs-3" class="tab-content">								
									<div id="tabs-3-container" >
										<ul class="tumblrs">
										</ul>										
									</div>		
								</li>
							</ul>
						</div>
						<div class="social-nav">
							<a class="social-previous"></a>
							<div class="social-div"></div>
							<a class="social-next"></a>
						</div>
					</div>
					<div class="double-after">
					</div>';
	return $html;
}
add_shortcode('social_tabs', 'social_tabs');

/************* END SHORT CODE ***************/

// export csv data
class CSVExport
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
	if(isset($_GET['page']) && $_GET['page'] == 'donate_goods_export')
		{
			$csv = $this->generate_csv();

			header("Pragma: public");
			header("Expires: 0");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
			header("Cache-Control: private", false);
			header("Content-Type: application/octet-stream");
			header("Content-Disposition: attachment; filename=\"report.csv\";" );
			header("Content-Transfer-Encoding: binary");

			echo $csv;
			exit;
		}
		
		if(isset($_GET['page']) && $_GET['page'] == 'volunteer_export')
		{
			$csv = $this->generate_csv_volunteer();
		
			header("Pragma: public");
			header("Expires: 0");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
			header("Cache-Control: private", false);
			header("Content-Type: application/octet-stream");
			header("Content-Disposition: attachment; filename=\"volunteer.csv\";" );
			header("Content-Transfer-Encoding: binary");
		
			echo $csv;
			exit;
		}

		// Add extra menu items for admins
		add_action('admin_menu', array($this, 'admin_menu'));

		// Create end-points
		add_filter('query_vars', array($this, 'query_vars'));
		add_action('parse_request', array($this, 'parse_request'));
	}

	/**
	 * Add extra menu items for admins
	 */
	public function admin_menu()
	{
		//add_menu_page('Download Report', 'Download Report', 'manage_options', 'download_report', array($this, 'download_report'));
		add_submenu_page('edit.php?post_type=donate_goods', 'Export CSV', 'Export CSV', 'manage_options', 'donate_goods_export', array($this, 'donate_goods_export'));
		add_submenu_page('edit.php?post_type=volunteer', 'Export CSV', 'Export CSV', 'manage_options', 'volunteer_export', array($this, 'volunteer_export'));
	}
	
	/**
	 * Allow for custom query variables
	 */
	public function query_vars($query_vars)
	{
		$query_vars[] = 'donate_goods_export';
		$query_vars[] = 'volunteer_export';
		return $query_vars;
	}

	/**
	 * Parse the request
	 */
	public function parse_request(&$wp)
	{
		if(array_key_exists('donate_goods_export', $wp->query_vars))
		{
			$this->donate_goods_export();
			exit;
		}
	}

	/**
	 * Download report
	 */
	public function donate_goods_export()
	{
		echo '<div class="wrap">';
		echo '<div id="icon-tools" class="icon32">
			</div>';
		echo '<h2>Download Report</h2>';
		echo '<p>Export the Subscribers';
	}
	
	/**
	 * Download report
	 */
	public function volunteer_export()
	{
		echo '<div class="wrap">';
		echo '<div id="icon-tools" class="icon32">
			</div>';
		echo '<h2>Download Report</h2>';
		echo '<p>Export the Subscribers';
	}

	/**
	 * Converting data to CSV
	 */
	public function generate_csv()
	{
		// Headings and rows
		$headings = array('First Name', 'Last Name', 'Phone', 'Email', 'Receive Email');
		
		// Open the output stream
		$fh = fopen('php://output', 'w');
		
		// Start output buffering (to capture stream contents)
		ob_start();
		fputcsv($fh, $headings);
		
		$args = array( 'post_type' => 'donate_goods', 'posts_per_page' => -1 );
		$loop = new WP_Query( $args );
		
		while ( $loop->have_posts() ) : $loop->the_post();
			$contentBody = get_the_content();
			if(strpos($contentBody, "<br/>") !== false) {
				$contentBody = explode("<br/>", $contentBody);
			} else if(strpos($contentBody, "<br />") !== false) {
				$contentBody = explode("<br />", $contentBody);
			} else if(strpos($contentBody, "<br>") !== false) {
				$contentBody = explode("<br>", $contentBody);
			}
			$contentBody[0] = str_replace("First Name: ", "", $contentBody[0]);
			$contentBody[1] = str_replace("Last Name: ", "", $contentBody[1]);
			$contentBody[2] = str_replace("Phone: ", "", $contentBody[2]);
			$contentBody[3] = str_replace("Email: ", "", $contentBody[3]);
			$contentBody[4] = str_replace("Receive Email: ", "", $contentBody[4]);
			
			fputcsv($fh, $contentBody);
		endwhile;
		
		// Get the contents of the output buffer
		$string = ob_get_clean();
		

		return $string;
	}
	
	/**
	 * Converting data to CSV
	 */
	public function generate_csv_volunteer()
	{
		// Headings and rows
		$headings = array('First Name', 'Last Name', 'Phone', 'Email', 'Receive Email', 'Volunteering Opportunities', 'Your Skills', 'Friends Coming');
	
		// Open the output stream
		$fh = fopen('php://output', 'w');
	
		// Start output buffering (to capture stream contents)
		ob_start();
		fputcsv($fh, $headings);
	
		$args = array( 'post_type' => 'volunteer', 'posts_per_page' => -1 );
		$loop = new WP_Query( $args );
	
		while ( $loop->have_posts() ) : $loop->the_post();
		$contentBody = get_the_content();
		
		if(strpos($contentBody, "<br/>") !== false) {
			$contentBody = explode("<br/>", $contentBody);
		} else if(strpos($contentBody, "<br />") !== false) {
			$contentBody = explode("<br />", $contentBody);
		} else if(strpos($contentBody, "<br>") !== false) {
			$contentBody = explode("<br>", $contentBody);
		}
		$contentBody[0] = str_replace("Volunteering Opportunities: ", "", $contentBody[0]);
		$contentBody[0] = str_replace(array("<ol>", "</ol>", "</li>"), "", $contentBody[0]);
		$contentBody[0] = preg_replace("/<li>/", "Opportunities: \n- ", $contentBody[0], 1);
		$contentBody[0] = preg_replace("/<li>/", "\n- ", $contentBody[0]);
		
		
		$contentBody[1] = str_replace("Your Skills: ", "", $contentBody[1]);
		$contentBody[2] = str_replace("Friends Coming:", "", $contentBody[2]);
		
		$contentBody[3] = str_replace("First Name: ", "", $contentBody[3]);
		$contentBody[4] = str_replace("Last Name: ", "", $contentBody[4]);
		$contentBody[5] = str_replace("Phone: ", "", $contentBody[5]);
		$contentBody[6] = str_replace("Email: ", "", $contentBody[6]);
		$contentBody[7] = str_replace("Receive Email: ", "", $contentBody[7]);
		
		$body0 = $contentBody[0];
		$body1 = $contentBody[1];
		$body2 = $contentBody[2];
		
		$contentBody[0] = $contentBody[3];
		$contentBody[1] = $contentBody[4];
		$contentBody[2] = $contentBody[5];
		$contentBody[3] = $contentBody[6];
		$contentBody[4] = $contentBody[7];
		
		$contentBody[5] = $body0;
		$contentBody[6] = $body1;
		$contentBody[7] = $body2;
		
		fputcsv($fh, $contentBody);
		endwhile;
	
		// Get the contents of the output buffer
		$string = ob_get_clean();
	
	
		return $string;
	}
	
}

// Instantiate a singleton of this plugin
$csvExport = new CSVExport();