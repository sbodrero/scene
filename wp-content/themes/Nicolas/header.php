<?php
/* wp header.php modifié par pcr-mediaservices.fr */
if (!($sTitle = get_post_meta((int) $post->ID, 'title', true))) { // seo title champ personnalisé
        $sTitle = wp_title('', false);
        $sTitle .= ' > ' . get_bloginfo('name'); //*Le nom du site en fin de title non SEO (à commenter ou non)
    $sMetaDescription = get_post_meta((int) $post->ID, 'meta-description', true);
    }
else {
    /*** un seul article (complet) ou une page (y compris l'éventuelle home statique) ***/
    $sTitle = get_post_meta((int) $post->ID, 'title', true); // seo title champ personnalisé
    $sMetaDescription = get_post_meta((int) $post->ID, 'meta-description', true);
    }
//$sTitle .= ' > '.get_bloginfo('name'); //*Le nom du site en fin de title dans tous les cas (si décommentée => commenter tous ceux ci-dessus)
?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php
language_attributes();
?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" <?php
language_attributes();
?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" <?php
language_attributes();
?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php
language_attributes();
?>> <!--<![endif]-->
<head>
	<!-- Basic Page Needs
  ================================================== -->
<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo('charset'); ?>" />
<title><?php echo trim($sTitle); ?></title>
<?php echo '<meta name="description" content="' . $sMetaDescription . '" />' . PHP_EOL; 

/* Anti-duplicate SEO pcr-communication.fr
avec une meta noindex pour : les pages "recherche"  OU (toutes celles d'archives SAUF les catégories)
Pour modifier la condition en fonction de vos besoins consultez : http://codex.wordpress.org/fr:Marqueurs_conditionnels
*/
if (is_search() || (is_archive() && !(is_category()))) {
    echo '<meta name="robots" content="noindex" />' . PHP_EOL;
}
?>

	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- CSS
  ================================================== -->
	<link rel="stylesheet" href="<?php
bloginfo('stylesheet_url');
?>" type="text/css" />
	
	<?php
global $gdl_is_responsive;
?>
	<?php
if ($gdl_is_responsive) {
?>
		<meta name="viewport" content="width=device-width, user-scalable=no">
		<link rel="stylesheet" href="<?php
    echo GOODLAYERS_PATH;
?>/stylesheet/foundation-responsive.css">
	<?php
} else {
?>
		<link rel="stylesheet" href="<?php
    echo GOODLAYERS_PATH;
?>/stylesheet/foundation.css">
	<?php
}
?>
	
	<!--[if IE 7]>
		<link rel="stylesheet" href="<?php
echo GOODLAYERS_PATH;
?>/stylesheet/ie7-style.css" /> 
	<![endif]-->	
	
	<?php
wp_enqueue_script('jquery');
// start calling header script
wp_head();
?>
<script>
jQuery(document).ready(function() {
	jQuery('#slideMe').hide();
   	jQuery('a#clickMe').click(function() {
   		jQuery('#slideMe').slideToggle(400);
   		return false;
   	});
});
</script>
<?php
// include favicon in the header
if (get_option(THEME_SHORT_NAME . '_enable_favicon', 'disable') == "enable") {
    $gdl_favicon = get_option(THEME_SHORT_NAME . '_favicon_image');
    if ($gdl_favicon) {
        $gdl_favicon = wp_get_attachment_image_src($gdl_favicon, 'full');
        echo '<link rel="shortcut icon" href="' . $gdl_favicon[0] . '" type="image/x-icon" />';
    }
}
// add facebook thumbnail to this page
$thumbnail_id = get_post_thumbnail_id();
if (!empty($thumbnail_id)) {
    $thumbnail = wp_get_attachment_image_src($thumbnail_id, '200x200');
    echo '<meta property="og:image" content="' . $thumbnail[0] . '"/>';
}
?>
	
</head>
<body <?php
echo body_class();
?>>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.8";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-70768922-1', 'auto');
  ga('send', 'pageview');

</script>

<?php
// print custom background
$background_style = get_option(THEME_SHORT_NAME . '_background_style', 'Pattern');
if ($background_style == 'Custom Image') {
    $background_id = get_option(THEME_SHORT_NAME . '_background_custom');
    $alt_text      = get_post_meta($background_id, '_wp_attachment_image_alt', true);
    if (!empty($background_id)) {
        $background_image = wp_get_attachment_image_src($background_id, 'full');
        echo '<div class="gdl-custom-full-background">';
        echo '<a href="http://www.google.com"><img src="' . $background_image[0] . '" alt="' . $alt_text . '" /></a>';
        echo '</div>';
    }
}
?>
<div class="body-wrapper">
<div class="container-wrapper">
	<?php
$gdl_enable_top_navigation = get_option(THEME_SHORT_NAME . '_enable_top_navigation');
?>
	<?php
if ($gdl_enable_top_navigation == '' || $gdl_enable_top_navigation == 'enable') {
?>
		<div class="top-navigation-wrapper container wrapper">
			<div class="top-navigation ">
				<?php
    echo '<div class="top-navigation-left">';
    wp_nav_menu(array(
        'theme_location' => 'top_menu'
    ));
    echo '</div>';
?>
				<div class="top-navigation-right">
					<!-- Get Social Icons -->
					<div id="gdl-social-icon" class="social-wrapper">
						<div class="social-icon-wrapper">
							<?php
    $gdl_social_icon = array(
        'delicious' => array(
            'name' => THEME_SHORT_NAME . '_delicious',
            'url' => GOODLAYERS_PATH . '/images/icon/social-icon/delicious.png'
        ),
        'deviantart' => array(
            'name' => THEME_SHORT_NAME . '_deviantart',
            'url' => GOODLAYERS_PATH . '/images/icon/social-icon/deviantart.png'
        ),
        'digg' => array(
            'name' => THEME_SHORT_NAME . '_digg',
            'url' => GOODLAYERS_PATH . '/images/icon/social-icon/digg.png'
        ),
        'facebook' => array(
            'name' => THEME_SHORT_NAME . '_facebook',
            'url' => GOODLAYERS_PATH . '/images/icon/social-icon/facebook.png'
        ),
        'flickr' => array(
            'name' => THEME_SHORT_NAME . '_flickr',
            'url' => GOODLAYERS_PATH . '/images/icon/social-icon/flickr.png'
        ),
        'lastfm' => array(
            'name' => THEME_SHORT_NAME . '_lastfm',
            'url' => GOODLAYERS_PATH . '/images/icon/social-icon/lastfm.png'
        ),
        'linkedin' => array(
            'name' => THEME_SHORT_NAME . '_linkedin',
            'url' => GOODLAYERS_PATH . '/images/icon/social-icon/linkedin.png'
        ),
        'picasa' => array(
            'name' => THEME_SHORT_NAME . '_picasa',
            'url' => GOODLAYERS_PATH . '/images/icon/social-icon/picasa.png'
        ),
        'rss' => array(
            'name' => THEME_SHORT_NAME . '_rss',
            'url' => GOODLAYERS_PATH . '/images/icon/social-icon/rss.png'
        ),
        'stumble-upon' => array(
            'name' => THEME_SHORT_NAME . '_stumble_upon',
            'url' => GOODLAYERS_PATH . '/images/icon/social-icon/stumble-upon.png'
        ),
        'tumblr' => array(
            'name' => THEME_SHORT_NAME . '_tumblr',
            'url' => GOODLAYERS_PATH . '/images/icon/social-icon/tumblr.png'
        ),
        'twitter' => array(
            'name' => THEME_SHORT_NAME . '_twitter',
            'url' => GOODLAYERS_PATH . '/images/icon/social-icon/twitter.png'
        ),
        'vimeo' => array(
            'name' => THEME_SHORT_NAME . '_vimeo',
            'url' => GOODLAYERS_PATH . '/images/icon/social-icon/vimeo.png'
        ),
        'youtube' => array(
            'name' => THEME_SHORT_NAME . '_youtube',
            'url' => GOODLAYERS_PATH . '/images/icon/social-icon/youtube.png'
        ),
        'google_plus' => array(
            'name' => THEME_SHORT_NAME . '_google_plus',
            'url' => GOODLAYERS_PATH . '/images/icon/social-icon/google-plus.png'
        ),
        'email' => array(
            'name' => THEME_SHORT_NAME . '_email',
            'url' => GOODLAYERS_PATH . '/images/icon/social-icon/email.png'
        ),
        'pinterest' => array(
            'name' => THEME_SHORT_NAME . '_pinterest',
            'url' => GOODLAYERS_PATH . '/images/icon/social-icon/pinterest.png'
        )
    );
    foreach ($gdl_social_icon as $social_name => $social_icon) {
        $social_link = get_option($social_icon['name']);
        if (!empty($social_link)) {
            echo '<div class="social-icon"><a target="_blank" href="' . $social_link . '">';
            echo '<img src="' . $social_icon['url'] . '" alt="' . $social_name . '"/>';
            echo '</a></div>';
        }
    }
?>
						</div> <!-- social icon wrapper -->
					</div> <!-- social wrapper -->	

					<!-- search form -->
					<?php
    if (get_option(THEME_SHORT_NAME . '_enable_top_search', 'enable') == 'enable') {
?>
					<div class="top-search-form">
						<div class="search-wrapper">
							<div class="gdl-search-form">
								<form method="get" id="searchform" action="<?php
        echo home_url();
?>/">
									<?php
        $search_val = get_search_query();
        if (empty($search_val)) {
            $search_val = __("Rechercher...", "gdl_front_end");
        }
?>
									<div class="search-text">
										<input type="text" value="<?php
        echo $search_val;
?>" name="s" id="s" autocomplete="off" data-default="<?php
        echo $search_val;
?>" />
									</div>
									<input type="submit" id="searchsubmit" />
									<div class="clear"></div>
								</form>
							</div>
						</div>		
					</div>		
					<?php
    }
?>					
					
				</div> <!-- top navigation right -->
				
				<div class="clear"></div>
			</div> <!-- top navigation -->
			<div class="top-navigation-wrapper-gimmick"></div>
		</div> <!-- top navigation wrapper -->
	<?php
}
?> 

	<div class="header-wrapper main container">
			
		<!-- Get Logo -->
		<div>
		<div class="logo-wrapper">
			<?php
$logo_id = get_option(THEME_SHORT_NAME . '_logo');
if (empty($logo_id)) {
    $alt_text        = 'default-logo';
    $logo_attachment = GOODLAYERS_PATH . '/images/default-logo.png';
} else {
    $alt_text        = get_post_meta($logo_id, '_wp_attachment_image_alt', true);
    $logo_attachment = wp_get_attachment_image_src($logo_id, 'full');
    $logo_attachment = $logo_attachment[0];
}
    echo '<a href="';
    echo bloginfo('url');
    echo '"><img src="' . $logo_attachment . '" alt="' . $alt_text . '"/></a>' ;
    ?>
    </div>

    <div class="h1-wrapper">
    <?php
    if (is_home() || is_single() || is_page()) { ?>
 <h1 style="color: red; font-weight:bold;"> <?php the_title(); ?> </h1>
   <?php
    }
    else { ?>
    <h1> Résultats de votre recherche</h1>
    <?php }
?>
		</div>
		</div>
		<?php
// Marquee
global $gdl_top_sliding;
if ($gdl_top_sliding) {
    $num_fetch = get_option(THEME_SHORT_NAME . '_top_sliding_num_fetch', 5);
    $category  = get_option(THEME_SHORT_NAME . '_top_sliding_category', 'All');
    if ($category == 'All')
        $category = '';
    echo '<div class="header-top-marquee" >';
    echo '<div class="marquee-icon"></div>';
    echo '<div class="marquee-wrapper">';
    echo '<div class="marquee" id="marquee">';
    query_posts(array(
        'category_name' => $category,
        'posts_per_page' => $num_fetch
    ));
    if (have_posts()) {
        while (have_posts()) {
            the_post();
            echo '<div><a href="' . get_permalink() . '" >' . get_the_title() . '</a></div>';
        }
    }
    echo '</div>'; // marquee
    echo '<div class="clear"></div>';
    echo '</div>'; // marquee-wrapper
    echo '</div>'; // header-top-marquee
    wp_reset_query();
}
?>

		<!-- Navigation -->
		<div class="clear"></div>
		<div class="wpsr_floatbts_anchor"></div>
		<div class="gdl-navigation-wrapper">
			<?php
// responsive menu
if ($gdl_is_responsive) {
    dropdown_menu(array(
        'dropdown_title' => '-- Main Menu --',
        'indent_string' => '- ',
        'indent_after' => '',
        'container' => 'div',
        'container_class' => 'responsive-menu-wrapper',
        'theme_location' => 'main_menu'
    ));
}
// main menu
echo '<div class="navigation-wrapper">';
wp_nav_menu( array('container' => 'div', 'container_class' => 'menu-wrapper', 'container_id' => 'main-superfish-wrapper', 'menu_class'=> 'sf-menu',  'theme_location' => 'main_menu' ) );
echo '</div>';
?>
			<div class="clear"></div>
		</div> 
		
	</div> <!-- header wrapper container -->
	
	<div class="content-wrapper main container">
