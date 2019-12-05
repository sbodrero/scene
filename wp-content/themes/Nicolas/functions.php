<?php

    /**
    ** activation theme
    **/
    add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
    function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

    }


    /*
	*	Goodlayers Function File
	*	---------------------------------------------------------------------
	*	This file include all of important function and features of the theme
	*	to make it available for later use.
	*	---------------------------------------------------------------------
	*/

	include( 'include/cuztom/cuztom.php' );
    include('include/veronique/custom_post.php');
    include( 'include/veronique/artiste.php' );
    include( 'include/veronique/compagnie.php' );
    include( 'include/veronique/production.php' );
    include( 'include/veronique/enseignant.php' );
    include( 'include/veronique/atelier.php' );
    include( 'include/veronique/location.php' );
    include( 'include/veronique/event.php' );
    include( 'include/veronique/desceneenscene.php' );
    include( 'plugins/custom-dashboard/welcome-panel.php' );
    include( 'include/veronique/taxonomy.php' );
    include( 'include/veronique/plaholders-perso.php' );
    //include( 'include/veronique/producteur.php' );

    //////////////////////////////////////////////////////////////////////////////////////////////////
// modification de la page de connexion//////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
//image logo//////////////////////////////////////////
function change_my_wp_login_image() {
echo "
<style>
body.login #login h1 a {
background: url('". get_stylesheet_directory_uri() ."/custom/images/logo.png') 8px 0 no-repeat transparent;
height:200px;
width:320px; }
</style>
";
}
add_action("login_head", "change_my_wp_login_image");
//modification du lien du logo de connexion ////////////////////////
function wpc_url_login(){
	return "http://www.desceneenscene.fr/"; // votre URL ici
}
add_filter('login_headerurl', 'wpc_url_login');
//modification du titre//////////////////////////////
function bweb_login_title(){
    return ('De Scène en scène le réseau 65 des arts vivants');
}
add_filter('login_headertitle', 'bweb_login_title');
///////////////////////////////////////////////////////
//1. Add a new form element...
add_action( 'register_form', 'myplugin_register_form' );
function myplugin_register_form() {
    $first_name = ( ! empty( $_POST['first_name'] ) ) ? trim( $_POST['first_name'] ) : '';
        ?>
        <p>
            <label for="first_name"> <?php _e( 'Nom qui apparaîtra sur le site', 'mydomain' ) ?> <br />
                <input type="text" name="first_name" id="first_name" class="input" value="<?php echo esc_attr( wp_unslash( $first_name ) ); ?>" size="25" /> </label>
        </p>
        <?php
    }
    //2. Add validation. In this case, we make sure first_name is required.
    add_filter( 'registration_errors', 'myplugin_registration_errors', 10, 3 );
    function myplugin_registration_errors( $errors, $sanitized_user_login, $user_email ) {
        if ( empty( $_POST['first_name'] ) || ! empty( $_POST['first_name'] ) && trim( $_POST['first_name'] ) == '' ) {
            $errors->add( 'first_name_error', __( '<strong>ERROR</strong>: You must include a first name.', 'mydomain' ) );
        }
        return $errors;
    }
    //3. Finally, save our extra registration user meta.
    add_action( 'user_register', 'myplugin_user_register' );
    function myplugin_user_register( $user_id ) {
        if ( ! empty( $_POST['first_name'] ) ) {
            update_user_meta( $user_id, 'first_name', trim( $_POST['first_name'] ) );
        }
    }
////////////////////////////////////////////////////////
/////Modifs back office
////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
	/* Widget 'Coup d'oeil' avec tous les contenus pour le WebMaster*/
////////////////////////////////////////////////////////////////////////////////////////
/*function ntp_right_now_content_table_end() {

$user = wp_get_current_user();
 if ( ! $user->has_cap( 'manage_options' ) ) {

    $args = array(
        'public' => true ,
        '_builtin' => false
    );
    $output = 'objects';
    $operator = 'and';
    $post_types = get_post_types($args , $output , $operator);
    foreach($post_types as $post_type) {
        $num_posts = wp_count_posts($post_type->name);
        $num = number_format_i18n($num_posts->publish);
        $text = _n($post_type->labels->name, $post_type->labels->name , intval($num_posts->publish));
        if (current_user_can('edit_posts')) {
            $cpt_name = $post_type->name;
        }
        echo '<li> <tr> <a class="'.$cpt_name.'" href="edit.php?post_type='.$cpt_name.'"> <td> </td>' . $num . '&nbsp;<td>' . $text . '</td> </a> </tr> </li>';
    }
    $taxonomies = get_taxonomies($args , $output , $operator);
    foreach($taxonomies as $taxonomy) {
        $num_terms  = wp_count_terms($taxonomy->name);
        $num = number_format_i18n($num_terms);
        $text = _n($taxonomy->labels->name, $taxonomy->labels->name , intval($num_terms));
        if (current_user_can('manage_categories')) {
            $cpt_tax = $taxonomy->name;
        }
        echo '<li> <tr> <a class="'.$cpt_tax.'" href="edit-tags.php?taxonomy='.$cpt_tax.'"> <td> </td>' . $num . '&nbsp;<td>' . $text . '</td> </a> </tr> </li>';
    }
}}
add_action('dashboard_glance_items', 'ntp_right_now_content_table_end');*/
//////////////////////////////////////////////////////////////////////////////////////////
// 			Manage dashboard widgets for relevant users
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////unset widget
function wcs_remove_dashboard_widgets() {
    	global $wp_meta_boxes;
    	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
    	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
    	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
    	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
    	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
    	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
    	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
    	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
    	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
    	unset($wp_meta_boxes['dashboard']['normal']['core']['wpseo-dashboard-overview']);
}
add_action( 'wp_dashboard_setup', 'wcs_remove_dashboard_widgets' );
///////////////////////// force welcome
add_action( 'load-index.php', 'show_welcome_panel' );
function show_welcome_panel() {
 if ( !current_user_can( 'manage_options' ) ) {
    $user_id = get_current_user_id();
    if ( 1 != get_user_meta( $user_id, 'show_welcome_panel', true ) )
        update_user_meta( $user_id, 'show_welcome_panel', 1 );
}}
////////////////pour retirer  'options de l'écran'//////////////////
/*
function myplugin_disable_screen_options( $show_screen ) {
    // Logic to allow admins to still access the menu
    if ( current_user_can( 'manage_options' ) ) {
        return $show_screen;
    }
    return false;
}
add_filter( 'screen_options_show_screen', 'myplugin_disable_screen_options' );*/
////////////////////remove menu page admin
function remove_menus(){
 $user = wp_get_current_user();
 if ( ! $user->has_cap( 'manage_options' ) ) {
  //remove_menu_page( 'index.php' );                  //Dashboard
  //remove_menu_page( 'edit.php' );                   //Posts
  //remove_menu_page( 'upload.php' );                 //Media
  //remove_menu_page( 'edit.php?post_type=page' );    //Pages
 // remove_menu_page( 'edit-comments.php' );          //Comments
  remove_menu_page( 'themes.php' );                 //Appearance
  remove_menu_page( 'wpcf7' );                //
  //remove_menu_page( 'users.php' );                  //Users
 // remove_menu_page( 'tools.php' );                  //Tools
 // remove_menu_page( 'options-general.php' );        //Settings
remove_menu_page('wpseo_dashboard'); // SEO by Yoast
  }
}
add_action( 'admin_menu', 'remove_menus' );
/////////////////////////////////////////////////////////////////////////////////////////
//	manage les subsubsub menu dans les pages admin post, artistes, etc.
////////////////////////////////////////////////////////////////////////////////////////
function remove_add_new(){
        if (is_user_logged_in() && (!current_user_can('update_themes'))) {
            if('artiste' == get_post_type()){
                 echo '<style type="text/css">

                        .add-new-h2{display:none;}
                        #menu-posts-tvr_booking .wp-submenu-wrap {
                          display: none;
                        }
                        .subsubsub .all, .subsubsub .publish, .subsubsub .trash, .page-title-action, .subsubsub .pending, .subsubsub .draft{
                          display: none;
                        }
                        </style>';
            }
            if('compagnie' == get_post_type()){
                 echo '<style type="text/css">
                        .subsubsub .all, .subsubsub .publish, .subsubsub .trash, .page-title-action, .subsubsub .pending, .subsubsub .draft{
                          display: none;
                        }
                        </style>';
            }
	   if('production' == get_post_type()){
                 echo '<style type="text/css">
                        .subsubsub .all, .subsubsub .publish, .subsubsub, .trash, .page-title-action, .subsubsub .pending, .subsubsub .draft {
                          display: none;
                        }
                        </style>';
	  }
	   if('enseignant' == get_post_type()){
                 echo '<style type="text/css">
                        .subsubsub .all, .subsubsub .publish, .subsubsub, .trash, .page-title-action, .subsubsub .pending, .subsubsub .draft {
                          display: none;
                        }
                        </style>';
	  }
	   if('event' == get_post_type()){
                 echo '<style type="text/css">
                        .subsubsub .all, .subsubsub .publish, .subsubsub, .trash, .page-title-action, .subsubsub .pending, .subsubsub .draft {
                          display: none;
                        }
                        </style>';
            }
	   if('location' == get_post_type()){
                 echo '<style type="text/css">
                        .subsubsub .all, .subsubsub .publish, .subsubsub, .trash, .page-title-action, .subsubsub .pending, .subsubsub .draft {
                          display: none;
                        }
                        </style>';
	  }
	   if('atelier' == get_post_type()){
                 echo '<style type="text/css">
                        .subsubsub .all, .subsubsub .publish, .subsubsub, .trash, .page-title-action, .subsubsub .pending, .subsubsub .draft {
                          display: none;
                        }
                        </style>';
	  }
	   if('producteur' == get_post_type()){
                 echo '<style type="text/css">
                        .subsubsub .all, .subsubsub .publish, .subsubsub, .trash, .page-title-action, .subsubsub .pending, .subsubsub .draft {
                          display: none;
                        }
                        </style>';
	  }
	  if('post' == get_post_type()){
                 echo '<style type="text/css">
                        .subsubsub .all, .subsubsub .publish, .subsubsub .trash, .subsubsub .pending {
                          display: none;
                        }
                        </style>';
	  }
            echo '<style>#normal-sortables .versions,#normal-sortables .table_discussion {
                        visibility: hidden;
                }</style>';
        }
    }
    add_action('admin_head','remove_add_new');
/////////////// remove columns in admin table////////////////////////////////////
//manage the columns des page admin Post
function manage_columns_for_post($columns){
if ( current_user_can('contributor') || current_user_can('artiste') || current_user_can('location') || current_user_can('mixte') || current_user_can('tous') || current_user_can('mixte_ee') || current_user_can('mixte_pl') || current_user_can('enseignant') || current_user_can('producteur') ) {
    unset($columns['comments']);
    //unset($columns['author']);
    unset($columns['wpfront-user-role-editor-role-permission-column-key']);
    unset($columns['tags']);
    unset($columns['categories']);
    }elseif ( current_user_can('gerant') ) {
     unset($columns['comments']);
     unset($columns['wpfront-user-role-editor-role-permission-column-key']);
     unset($columns['tags']);
    }
    return $columns;
}
add_action('manage_post_posts_columns','manage_columns_for_post');
//manage the columns des page admin ARTISTE
function manage_columns_for_artiste($columns){
if ( current_user_can('contributor') || current_user_can('gerant') || current_user_can('artiste') || current_user_can('location') || current_user_can('mixte') || current_user_can('tous') || current_user_can('mixte_ee') || current_user_can('mixte_pl') || current_user_can('enseignant') || current_user_can('producteur') ) {
    //remove columns
    //unset($columns['date']);
    unset($columns['comments']);
    //unset($columns['author']);
    unset($columns['wpfront-user-role-editor-role-permission-column-key']);
    unset($columns['tags']);
    unset($columns['categories']);
    }
    return $columns;
}
add_action('manage_artiste_posts_columns','manage_columns_for_artiste');
//manage the columns des page admin COMPAGNIE
function manage_columns_for_compagnie($columns){
if ( current_user_can('contributor') || current_user_can('gerant') || current_user_can('artiste') || current_user_can('location') || current_user_can('mixte') || current_user_can('tous') || current_user_can('mixte_ee') || current_user_can('mixte_pl') || current_user_can('enseignant') || current_user_can('producteur') ) {
    //remove columns
   //unset($columns['date']);
    unset($columns['comments']);
    //unset($columns['author']);
    unset($columns['wpfront-user-role-editor-role-permission-column-key']);
    unset($columns['tags']);
    unset($columns['categories']);
    }
    return $columns;
}
//manage the columns des page admin Producteur
function manage_columns_for_producteur($columns){
if ( current_user_can('contributor') || current_user_can('gerant') || current_user_can('artiste') || current_user_can('location') || current_user_can('mixte') || current_user_can('tous') || current_user_can('mixte_ee') || current_user_can('mixte_pl') || current_user_can('enseignant') || current_user_can('producteur') ) {
    //remove columns
   //unset($columns['date']);
    unset($columns['comments']);
    //unset($columns['author']);
    unset($columns['wpfront-user-role-editor-role-permission-column-key']);
    unset($columns['tags']);
    unset($columns['categories']);
    }
    return $columns;
}
add_action('manage_compagnie_posts_columns','manage_columns_for_producteur');
//manage the columns des page admin PRODUCION
function manage_columns_for_production($columns){
if ( current_user_can('contributor') || current_user_can('gerant') || current_user_can('artiste') || current_user_can('location') || current_user_can('mixte') || current_user_can('tous') || current_user_can('mixte_ee') || current_user_can('mixte_pl') || current_user_can('enseignant') || current_user_can('producteur') ) {
    //remove columns
    //unset($columns['date']);
    unset($columns['comments']);
    //unset($columns['author']);
    unset($columns['wpfront-user-role-editor-role-permission-column-key']);
    unset($columns['tags']);
    unset($columns['categories']);
   }
    return $columns;
}
add_action('manage_production_posts_columns','manage_columns_for_production');

//manage the columns des page admin ENSEIGNANT
function manage_columns_for_enseignant($columns){
if ( current_user_can('contributor') || current_user_can('gerant') || current_user_can('artiste') || current_user_can('location') || current_user_can('mixte') || current_user_can('tous') || current_user_can('mixte_ee') || current_user_can('mixte_pl') || current_user_can('enseignant') || current_user_can('producteur') ) {
    //remove columns
    //unset($columns['date']);
    unset($columns['comments']);
    //unset($columns['author']);
    unset($columns['wpfront-user-role-editor-role-permission-column-key']);
    unset($columns['categories']);
    unset($columns['tags']);
    }
    return $columns;
}
add_action('manage_enseignant_posts_columns','manage_columns_for_enseignant');
//manage the columns des page admin ATELIER
function manage_columns_for_atelier($columns){
if ( current_user_can('contributor') || current_user_can('gerant') || current_user_can('artiste') || current_user_can('location') || current_user_can('mixte') || current_user_can('tous') || current_user_can('mixte_ee') || current_user_can('mixte_pl') || current_user_can('enseignant') || current_user_can('producteur') ) {
    //remove columns
    //unset($columns['date']);
    unset($columns['comments']);
    //unset($columns['author']);
    unset($columns['wpfront-user-role-editor-role-permission-column-key']);
    unset($columns['categories']);
    unset($columns['tags']);
    }
    return $columns;
}

add_action('manage_atelier_posts_columns','manage_columns_for_atelier');



//manage the columns des page admin dses
function manage_columns_for_dses($columns){
if ( current_user_can('contributor') || current_user_can('gerant') || current_user_can('artiste') || current_user_can('location') || current_user_can('mixte') || current_user_can('tous') || current_user_can('mixte_ee') || current_user_can('mixte_pl') || current_user_can('enseignant') || current_user_can('producteur') ) {
    //remove columns
    //unset($columns['date']);
    unset($columns['comments']);
    unset($columns['author']);
    unset($columns['wpfront-user-role-editor-role-permission-column-key']);
    unset($columns['tags']);
    unset($columns['categories']);
    }
    return $columns;
}

add_action('manage_dses_posts_columns','manage_columns_for_dses');




//manage the columns des page admin EVENT
function manage_columns_for_event($columns){
if ( current_user_can('contributor') || current_user_can('gerant') || current_user_can('artiste') || current_user_can('location') || current_user_can('mixte') || current_user_can('tous') || current_user_can('mixte_ee') || current_user_can('mixte_pl') || current_user_can('enseignant') || current_user_can('producteur') ) {
    //remove columns
    unset($columns['date']);
    unset($columns['comments']);
    //unset($columns['author']);
    unset($columns['tags']);
    unset($columns['wpfront-user-role-editor-role-permission-column-key']);
    }

    return $columns;
}

add_action('manage_event_posts_columns','manage_columns_for_event');


//manage the columns des page admin LOCATION
function manage_columns_for_location($columns){
if ( current_user_can('contributor') || current_user_can('gerant') || current_user_can('artiste') || current_user_can('location') || current_user_can('mixte') || current_user_can('tous') || current_user_can('mixte_ee') || current_user_can('mixte_pl') || current_user_can('enseignant') || current_user_can('producteur') ) {
    //remove columns
    //unset($columns['date']);
    unset($columns['comments']);
    unset($columns['author']);
    unset($columns['wpfront-user-role-editor-role-permission-column-key']);
    unset($columns['state']);
    unset($columns['country']);
    unset($columns['tags']);
    unset($columns['categories']);
    }
    return $columns;
}

add_action('manage_location_posts_columns','manage_columns_for_location');



///////////////////retirer YOAST des admin pages

if ( current_user_can('contributor') || current_user_can('gerant') || current_user_can('artiste') || current_user_can('location') || current_user_can('mixte') || current_user_can('tous') || current_user_can('mixte_ee') || current_user_can('mixte_pl') || current_user_can('enseignant') || current_user_can('producteur') ) {

add_filter( 'wpseo_use_page_analysis', '__return_false' );
}

///////////////////manage Admin Bar////////////////////////////////////

function remove_wp_admin_bar( $wp_admin_bar ) {
$user = wp_get_current_user();
if ( current_user_can('contributor') || current_user_can('gerant') || current_user_can('artiste') || current_user_can('location') || current_user_can('mixte') || current_user_can('tous') || current_user_can('mixte_ee') || current_user_can('mixte_pl') || current_user_can('enseignant') || current_user_can('producteur') ) {
	$wp_admin_bar->remove_node( 'new-content' );
	$wp_admin_bar->remove_menu('wpseo-menu');
	$wp_admin_bar->remove_menu('root-default');
	$wp_admin_bar->remove_menu('wp-logo');
	$wp_admin_bar->remove_menu('wp-admin-bar-widgets');
	//$wp_admin_bar->remove_menu('wp-logo');

}}
add_action( 'admin_bar_menu', 'remove_wp_admin_bar', 999 );

///////////////////////



//le crédit pied de page
function wpc_remove_footer_admin(){
return'réalisé par PCR-Communication';
}
add_filter('admin_footer_text', 'wpc_remove_footer_admin');




///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
//					les articles, pages et CPT
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////


///////////////aides pour les titres des custom posts/////

function change_default_title( $title ){
    $screen = get_current_screen();

    // Aide pour le titre des compagnies
    if  ( 'compagnie' == $screen->post_type ) {
        $title = 'Mettre le nom du groupe artistique';

    // Aide pour le titre des productions
    } elseif ( 'production' == $screen->post_type ) {
        $title = 'Mettre le nom de la production';

    // Aide pour le titre des enseignants
    } elseif ( 'enseignant' == $screen->post_type ) {
        $title = 'Mettre le nom du groupe enseignant';

    // Aide pour le titre des artistes
    }elseif ( 'atelier' == $screen->post_type ) {
        $title = 'Mettre le nom de l\'atelier';

    // Aide pour le titre des emplacements
    }elseif ( 'location' == $screen->post_type ) {
        $title = 'Mettre le nom de l\'emplacement';

   // Aide pour le titre des événements
    }elseif ( 'event' == $screen->post_type ) {
        $title = 'Mettre le nom de l\'événement';

    // Aide pour le titre des ateliers
    } elseif ( 'artiste' == $screen->post_type ) {
        $title = 'Mettre votre nom et / ou prénom';

}
    return $title;
}

add_filter( 'enter_title_here', 'change_default_title' );



////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
// 		pour retirer les metabox des articles, pages et CPT
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////


if (is_admin()) :
function my_remove_meta_boxes() {
 if( !current_user_can('manage_options') ) {
  remove_meta_box('linktargetdiv', 'artiste', 'normal');
  remove_meta_box('categorydiv', 'artiste', 'normal'); //catégories
  remove_meta_box('linkxfndiv', 'artiste', 'normal');
  remove_meta_box('linkadvanceddiv', 'artiste', 'normal');
  //remove_meta_box('postexcerpt', 'artiste', 'normal'); // résumé
  remove_meta_box('trackbacksdiv', 'artiste', 'normal');
  remove_meta_box('postcustom', 'artiste', 'normal');
  remove_meta_box('commentstatusdiv', 'artiste', 'normal'); //statut commentaires
  remove_meta_box('commentsdiv', 'artiste', 'normal'); // commentaires
  //remove_meta_box('revisionsdiv', 'artiste', 'normal');
  remove_meta_box('authordiv', 'artiste', 'normal');
  remove_meta_box('sqpt-meta-tags', 'artiste', 'normal');
  remove_meta_box('tagsdiv-post_tag', 'artiste', 'normal'); // étiquette
  remove_meta_box('pageparentdiv', 'artiste', 'normal');
  remove_meta_box('professionneldiv', 'artiste', 'normal');
  remove_meta_box('publicdiv', 'artiste', 'normal'); //atributs de la page


  // remove_meta_box('linktargetdiv', 'post', 'normal');
  remove_meta_box('categorydiv', 'post', 'normal'); //catégories
  remove_meta_box('linkxfndiv', 'post', 'normal');
  remove_meta_box('linkadvanceddiv', 'post', 'normal');
  //remove_meta_box('postexcerpt', 'post', 'normal'); // résumé
  remove_meta_box('trackbacksdiv', 'post', 'normal');
  remove_meta_box('postcustom', 'post', 'normal');
  remove_meta_box('commentstatusdiv', 'post', 'normal'); //statut commentaires
  remove_meta_box('commentsdiv', 'post', 'normal'); // commentaires
  //remove_meta_box('revisionsdiv', 'post', 'normal');
  remove_meta_box('authordiv', 'post', 'normal');
  remove_meta_box('sqpt-meta-tags', 'post', 'normal');
  remove_meta_box('tagsdiv-post_tag', 'post', 'normal'); // étiquette
  remove_meta_box('pageparentdiv', 'post', 'normal'); //atributs de la page
  remove_meta_box('professionneldiv', 'post', 'normal'); //atributs de la page
  remove_meta_box( 'slugdiv','post','side' );//identifiant


  remove_meta_box('categorydiv', 'enseignant', 'normal'); //catégories
 // remove_meta_box('postexcerpt', 'enseignant', 'normal'); // résumé
  remove_meta_box('trackbacksdiv', 'enseignant', 'normal');
  remove_meta_box('postcustom', 'enseignant', 'normal');
  remove_meta_box('commentstatusdiv', 'enseignant', 'normal'); //statut commentaires
  remove_meta_box('commentsdiv', 'enseignant', 'normal'); // commentaires
  remove_meta_box('authordiv', 'enseignant', 'normal');
  remove_meta_box('sqpt-meta-tags', 'enseignant', 'normal');
  remove_meta_box('tagsdiv-post_tag', 'enseignant', 'normal'); // étiquette
  remove_meta_box('professionneldiv', 'enseignant', 'normal'); //atributs de la page
  remove_meta_box( 'slugdiv','enseignant','side' );//identifiant
  remove_meta_box('pageparentdiv', 'enseignant', 'normal'); //atributs de la page



  remove_meta_box('categorydiv', 'production', 'normal'); //catégories
  //remove_meta_box('postexcerpt', 'production', 'normal'); // résumé
  remove_meta_box('trackbacksdiv', 'production', 'normal');
  remove_meta_box('postcustom', 'production', 'normal');
  remove_meta_box('commentstatusdiv', 'production', 'normal'); //statut commentaires
  remove_meta_box('commentsdiv', 'production', 'normal'); // commentaires
  remove_meta_box('authordiv', 'production', 'normal');
  remove_meta_box('sqpt-meta-tags', 'production', 'normal');
  remove_meta_box('tagsdiv-post_tag', 'production', 'normal'); // étiquette
  remove_meta_box('pageparentdiv', 'production', 'normal'); //atributs de la page
  remove_meta_box('professionneldiv', 'production', 'normal'); //atributs de la page
  remove_meta_box( 'slugdiv','production','side' );//identifiant



  //remove_meta_box('categorydiv', 'event', 'normal'); //catégories
  //remove_meta_box('postexcerpt', 'event', 'normal'); // résumé
  remove_meta_box('trackbacksdiv', 'event', 'normal');
  remove_meta_box('postcustom', 'event', 'normal');
  remove_meta_box('commentstatusdiv', 'event', 'normal'); //statut commentaires
  remove_meta_box('commentsdiv', 'event', 'normal'); // commentaires
  remove_meta_box('authordiv', 'event', 'normal');
  remove_meta_box('sqpt-meta-tags', 'event', 'normal');
  remove_meta_box('tagsdiv-post_tag', 'event', 'normal'); // étiquette
  //remove_meta_box('professionneldiv', 'event', 'normal');
  remove_meta_box( 'slugdiv','event','side' );//identifiant



  remove_meta_box('categorydiv', 'location', 'normal'); //catégories
  //remove_meta_box('postexcerpt', 'location', 'normal'); // résumé
  remove_meta_box('trackbacksdiv', 'location', 'normal');
  remove_meta_box('postcustom', 'location', 'normal');
  remove_meta_box('commentstatusdiv', 'location', 'normal'); //statut commentaires
  remove_meta_box('commentsdiv', 'location', 'normal'); // commentaires
  remove_meta_box('authordiv', 'location', 'normal');
  remove_meta_box('sqpt-meta-tags', 'location', 'normal');
  remove_meta_box('tagsdiv-post_tag', 'location', 'normal'); // étiquette
  remove_meta_box('pageparentdiv', 'location', 'normal'); //atributs de la page
  remove_meta_box( 'slugdiv','location','side' );//identifiant




  remove_meta_box('categorydiv', 'atelier', 'normal'); //catégories
 // remove_meta_box('postexcerpt', 'atelier', 'normal'); // résumé
  remove_meta_box('trackbacksdiv', 'atelier', 'normal');
  remove_meta_box('postcustom', 'atelier', 'normal');
  remove_meta_box('commentstatusdiv', 'atelier', 'normal'); //statut commentaires
  remove_meta_box('commentsdiv', 'atelier', 'normal'); // commentaires
  remove_meta_box('authordiv', 'atelier', 'normal');
  remove_meta_box('sqpt-meta-tags', 'atelier', 'normal');
  remove_meta_box('tagsdiv-post_tag', 'atelier', 'normal'); // étiquette
  remove_meta_box('pageparentdiv', 'atelier', 'normal'); //atributs de la page
  remove_meta_box('professionneldiv', 'atelier', 'normal'); //atributs de la page
  remove_meta_box( 'slugdiv','atelier','side' );//identifiant


  remove_meta_box('linktargetdiv', 'compagnie', 'normal');
  remove_meta_box('categorydiv', 'compagnie', 'normal'); //catégories
  //remove_meta_box('postexcerpt', 'compagnie', 'normal'); // résumé
  remove_meta_box('trackbacksdiv', 'compagnie', 'normal');
  remove_meta_box('postcustom', 'compagnie', 'normal');
  remove_meta_box('commentstatusdiv', 'compagnie', 'normal'); //statut commentaires
  remove_meta_box('commentsdiv', 'compagnie', 'normal'); // commentaires
  remove_meta_box('authordiv', 'compagnie', 'normal');
  remove_meta_box('sqpt-meta-tags', 'compagnie', 'normal');
  remove_meta_box('tagsdiv-post_tag', 'compagnie', 'normal'); // étiquette
  remove_meta_box('pageparentdiv', 'compagnie', 'normal'); //atributs de la page
  remove_meta_box( 'postimagediv','compagnie','side' );
  remove_meta_box('professionneldiv', 'compagnie', 'normal'); //atributs de la page
  remove_meta_box( 'slugdiv','compagnie','side' );//identifiant


  remove_meta_box('linktargetdiv', 'producteur', 'normal');
  remove_meta_box('categorydiv', 'producteur', 'normal'); //catégories
  //remove_meta_box('postexcerpt', 'producteur', 'normal'); // résumé
  remove_meta_box('trackbacksdiv', 'producteur', 'normal');
  remove_meta_box('postcustom', 'producteur', 'normal');
  remove_meta_box('commentstatusdiv', 'producteur', 'normal'); //statut commentaires
  remove_meta_box('commentsdiv', 'producteur', 'normal'); // commentaires
  remove_meta_box('authordiv', 'producteur', 'normal');
  remove_meta_box('sqpt-meta-tags', 'producteur', 'normal');
  remove_meta_box('tagsdiv-post_tag', 'producteur', 'normal'); // étiquette
  remove_meta_box('pageparentdiv', 'producteur', 'normal'); //atributs de la page
  remove_meta_box( 'postimagediv','producteur','side' );
  remove_meta_box('professionneldiv', 'producteur', 'normal'); //atributs de la page
  remove_meta_box( 'slugdiv','producteur','side' );//identifiant


 }
}
add_action( 'admin_menu', 'my_remove_meta_boxes' );
endif;


///////////////////////////////////////////////////////////////////////
//////////////////rename image à la une////////////////////////////////
///////////////////////////////////////////////////////////////////////

// compagnie

add_action('do_meta_boxes', 'change_image_compagnie');
function change_image_compagnie()
{
    remove_meta_box( 'postimagediv', 'compagnie', 'side' );
    add_meta_box('postimagediv', __('Votre logo : 300 X 163px'), 'post_thumbnail_meta_box', 'compagnie', 'normal', 'high');
}

// enseignant
add_action('do_meta_boxes', 'change_image_enseigant');
function change_image_enseigant()
{
    remove_meta_box( 'postimagediv', 'enseignant', 'side' );
    add_meta_box('postimagediv', __('Votre logo : 300 X 163px'), 'post_thumbnail_meta_box', 'enseignant', 'normal', 'high');
}

// atelier
add_action('do_meta_boxes', 'change_image_atelier');
function change_image_atelier()
{
    remove_meta_box( 'postimagediv', 'atelier', 'side' );
    add_meta_box('postimagediv', __('Image de l\'atelier : 300 X 163px'), 'post_thumbnail_meta_box', 'atelier', 'normal', 'high');
}

// location
add_action('do_meta_boxes', 'change_image_location');
function change_image_location()
{
    remove_meta_box( 'postimagediv', 'location', 'side' );
    add_meta_box('postimagediv', __('Image de l\'espace de diffusion : 300 X 163px'), 'post_thumbnail_meta_box', 'location', 'normal', 'high');
}

// event
add_action('do_meta_boxes', 'change_image_event');
function change_image_event()
{
    remove_meta_box( 'postimagediv', 'event', 'side' );
    add_meta_box('postimagediv', __('Veuillez insérer ci-dessous votre support promotionnel et vous assurer qu\'il respecte les dimensions suivantes : 556px X 269px'), 'post_thumbnail_meta_box', 'event', 'normal', 'high');
}


// production
add_action('do_meta_boxes', 'change_image_production');
function change_image_production()
{
    remove_meta_box( 'postimagediv', 'production', 'side' );
    add_meta_box('postimagediv', __('Image ou affiche de la production : 300 X 420px'), 'post_thumbnail_meta_box', 'production', 'normal', 'high');
}


// artiste
add_action('do_meta_boxes', 'change_image_artiste');
function change_image_artiste()
{
    remove_meta_box( 'postimagediv', 'artiste', 'side' );
    add_meta_box('postimagediv', __('Photo d\'identité : 200 x 250px'), 'post_thumbnail_meta_box', 'artiste', 'normal', 'high');
}

// post
add_action('do_meta_boxes', 'change_image_post');
function change_image_post()
{
    remove_meta_box( 'postimagediv', 'post', 'side' );
    add_meta_box('postimagediv', __('Mettre une image'), 'post_thumbnail_meta_box', 'post', 'normal', 'high');
}

///////////////////////////////////////////////////////////
 //////////////////Début d'origine////////////////////////
//////////////////////////////////////////////////////////

/**
 * Extend WordPress search to include custom fields
 *
 * http://adambalee.com
 */

/**
 * Join posts and postmeta tables
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_join
 */
function cf_search_join( $join ) {
    global $wpdb;

    if ( is_search() ) {
        $join .=' LEFT JOIN '.$wpdb->postmeta. ' ON '. $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
    }

    return $join;
}
add_filter('posts_join', 'cf_search_join' );

// PERMETTRE LES RECHERCHES DANS LES CHAmpS PERSONNALSES */
/**
 * Modify the search query with posts_where
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_where
 */
function cf_search_where( $where ) {
    global $pagenow, $wpdb;

    if ( is_search() ) {
        $where = preg_replace(
            "/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
            "(".$wpdb->posts.".post_title LIKE $1) OR (".$wpdb->postmeta.".meta_value LIKE $1)", $where );
    }

    return $where;
}
add_filter( 'posts_where', 'cf_search_where' );

/**
 * Prevent duplicates
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_distinct
 */
function cf_search_distinct( $where ) {
    global $wpdb;

    if ( is_search() ) {
        return "DISTINCT";
    }

    return $where;
}
add_filter( 'posts_distinct', 'cf_search_distinct' );

	/* FORMULAIRE ANNUAIRE */
	function wpbsearchform( $form ) {
	$form = '<form class="annuaire" role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >

		<label class="screen-reader-text" for="s"> </label>
		<input type="text" placeholder="Recherchez un nom, un numéro de téléphone, .." value="' . get_search_query() . '" name="s" id="s" />
		<input type="submit" id="searchsubmit" value="" />

	</form>';    return $form;}add_shortcode('wpbsearch', 'wpbsearchform');

function jc_post_by_category($atts, $content = null) {
    extract(shortcode_atts(array(
        "nb" => '5',
        "orderby" => 'ID',
        "category" => '1'
    ), $atts));
    global $post;
    $tmp_post = $post;
    $myposts = get_posts('showposts='.$nb.'ORDER BY "id" ASC &category='.$category);
    $out = '';
    foreach($myposts as $post){
        setup_postdata( $post );
		$content = get_the_content('Read more');
        $out .=   '<div class="one-third">' .$content. '</div>';
    }
    wp_reset_postdata();
    $post = $tmp_post;
    return $out;
}
add_shortcode("post-by-category", "jc_post_by_category");
add_filter('widget_text', 'do_shortcode');

function excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), 301);
  if (count($excerpt)>=301) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }
  $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
  return $excerpt;
}

/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
//                    céer un shortcode pour lister les espaces de diffusion
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////

function post_listing_edd( $atts ) {
    ob_start();
    $query = new WP_Query( array(
        'post_type' => 'location',
        'posts_per_page' => -1,
        'order' => 'ASC',
        'orderby' => 'title',
    ) );
    if ( $query->have_posts() ) { ?>
	<div class="row">
	<div class="gdl-page-item mb20 twelve columns">
		<div id="blog-item-holder" class="blog-item-holder">
			<div class="row">
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
				<div class="three columns gdl-blog-grid" style="min-height:380px;max-height:380px;">
				      <div class="blog-content-wrapper" >
						<div class="blog-media-wrapper gdl-image" style="height:120px;">
					<?php
					$url = "http://www.desceneenscene.fr/ng-1906/wp-content/themes/Nicolas/images";
					if ( has_post_thumbnail() ) {?>
						<a href="<?php the_permalink(); ?>"> <?php the_post_thumbnail(); ?> </a>

					<?php
					}
					else {?>
						<a href="<?php the_permalink(); ?>"> <?php echo "<img src='" .$url. "/image_en_attente_diff.png' alt='image temporaire' />"; ?> </a>
					<?php
					}
					?>
						</div>
						<div class="blog-context-wrapper">
							<h2 class="blog-title" style="min-height:70px;max-height:70px;">
								<a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a>
							</h2>
							<div class="blog-info-wrapper">
								<div class="blog-date-wrapper">
									<a href="#"> <?php the_modified_date(); ?> </a>
								</div>
								<div class="clear"> </div>
							</div>
							<div class="blog-content" style="min-height:80px;max-height:80px;" > <?php
							if(has_excerpt()) {
						echo wp_trim_words(get_the_excerpt(),15);
					      } else {$content = get_the_content();
						      echo wp_trim_words( $content , 15 );
					      }
							?>
							<div class="clear"> </div>
								<div class="clear"> </div>
							</div>
							<a class="blog-continue-reading-scene" href="<?php the_permalink(); ?>"> En savoir plus</a>
						</div>
						<div class="clear"> </div>
					</div>
				</div>
            <?php endwhile;
            wp_reset_postdata(); ?>
	</div>
		</div>
		<div class="clear"> </div>
	</div>
	</div>
    <?php $myvariable = ob_get_clean();
    return $myvariable;
    }
}
add_shortcode( 'list-posts-edd', 'post_listing_edd' );

/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
//                    céer un shortcode pour lister les Annonces Emploi Offres
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////

function post_listing_emploi_offres( $atts ) {
    ob_start();
    $query = new WP_Query( array(
        'post_type' => 'post',
        'posts_per_page' => -1,
        'order' => 'DEC',
        'orderby' => 'title',
        'post_limits' => 3,
        'tax_query' => array(
		array(
			'taxonomy' => 'annonce',
			'field'    => 'slug',
			'terms'    => array( 'emploi-offres' ),
		),

	),
    ) );
    if ( $query->have_posts() ) { ?>
	<div class="row">
	<div class="gdl-page-item mb20 twelve columns">
		<div id="blog-item-holder" class="blog-item-holder">
			<div class="row">
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
				<div class="blog-item-holder">
	<div class="row">
		<div class="twelve columns gdl-blog-grid">
			<div class="blog-content-wrapper">
			<table class="tg">
  <tr>
    <th style="width: 82px;"> <div class="blog-media-wrapper gdl-image">
					<?php
					$url = "http://www.desceneenscene.fr/ng-1906/wp-content/themes/Nicolas/images";
					if ( has_post_thumbnail() ) {?>
						<a href="<?php the_permalink(); ?>"> <?php the_post_thumbnail(); ?> </a>
					<?php
					}
					else {?>
						<a href="<?php the_permalink(); ?>"> <?php echo "<img src='" .$url. "/annonces-par-defaut.png' alt='image par défaut' />"; ?> </a>
					<?php
					}
					?>
				</div>

   </th>
    <th>
     <div class="blog-context-wrapper">
					<h4>
						<a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a>
					</h4>

				</div>
				<div class="clear"> </div>
    </th>
  </tr>
</table>



			</div>
		</div>
		</div>
</div>
            <?php endwhile;
            wp_reset_postdata(); ?>
	</div>
		</div>
		<div class="clear"> </div>
	</div>
	</div>
    <?php $myvariable = ob_get_clean();
    return $myvariable;
    }
}
add_shortcode( 'list-posts-emploi-offres', 'post_listing_emploi_offres' );
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
//                    céer un shortcode pour lister les Annonces Local Offres
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////

function post_listing_local_offres( $atts ) {
    ob_start();
    $query = new WP_Query( array(
        'post_type' => 'post',
        'posts_per_page' => -1,
        'order' => 'DEC',
        'orderby' => 'title',
        'post_limits' => 3,
        'tax_query' => array(
		array(
			'taxonomy' => 'annonce',
			'field'    => 'slug',
			'terms'    => array( 'local-offres' ),
		),

	),
    ) );
    if ( $query->have_posts() ) { ?>
	<div class="row">
	<div class="gdl-page-item mb20 twelve columns">
		<div id="blog-item-holder" class="blog-item-holder">
			<div class="row">
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
				<div class="blog-item-holder">
	<div class="row">
		<div class="twelve columns gdl-blog-grid">
			<div class="blog-content-wrapper">
			<table class="tg">
 <tr>
    <th style="width: 82px;"> <div class="blog-media-wrapper gdl-image">
					<?php
					$url = "http://www.desceneenscene.fr/ng-1906/wp-content/themes/Nicolas/images";
					if ( has_post_thumbnail() ) {?>
						<a href="<?php the_permalink(); ?>"> <?php the_post_thumbnail(); ?> </a>
					<?php
					}
					else {?>
						<a href="<?php the_permalink(); ?>"> <?php echo "<img src='" .$url. "/annonces-par-defaut.png' alt='image par défaut' />"; ?> </a>
					<?php
					}
					?>
				</div>

   </th>
    <th>
     <div class="blog-context-wrapper">
					<h4>
						<a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a>
					</h4>

				</div>
				<div class="clear"> </div>
    </th>
  </tr>
</table>



			</div>
		</div>
		</div>
</div>
            <?php endwhile;
            wp_reset_postdata(); ?>
	</div>
		</div>
		<div class="clear"> </div>
	</div>
	</div>
    <?php $myvariable = ob_get_clean();
    return $myvariable;
    }
}
add_shortcode( 'list-posts-local-offres', 'post_listing_local_offres' );

/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
//                    céer un shortcode pour lister les Annonces Matériels offres
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////

function post_listing_materiels_offres( $atts ) {
    ob_start();
    $query = new WP_Query( array(
        'post_type' => 'post',
        'posts_per_page' => -1,
        'order' => 'DEC',
        'orderby' => 'title',
        'post_limits' => 3,
        'tax_query' => array(
		array(
			'taxonomy' => 'annonce',
			'field'    => 'slug',
			'terms'    => array( 'materiel-offres' ),
		),

	),
    ) );
    if ( $query->have_posts() ) { ?>
<div class="row">
  <div class="gdl-page-item mb20 twelve columns">
    <div id="blog-item-holder" class="blog-item-holder">
      <div class="row">
	<?php while ( $query->have_posts() ) : $query->the_post(); ?>
	  <div class="blog-item-holder">
	    <div class="row">
	      <div class="twelve columns gdl-blog-grid">
		<div class="blog-content-wrapper">
		  <table class="tg">
		    <tr>
		      <th style="width: 82px;">
			<div class="blog-media-wrapper gdl-image">
			  <?php $url = "http://www.desceneenscene.fr/ng-1906/wp-content/themes/Nicolas/images";
			    if ( has_post_thumbnail() ) {?>
			      <a href="<?php the_permalink(); ?>"> <?php the_post_thumbnail(); ?> </a>
				<?php
			    }
			    else { ?>
						<a href="<?php the_permalink(); ?>"> <?php echo "<img src='" .$url. "/annonces-par-defaut.png' alt='image par défaut' />"; ?> </a>
				<?php
				}
				?>
			</div>

		    </th>
		    <th>
		      <div class="blog-context-wrapper">
			<h4> <a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a> </h4>
		      </div>
		      <div class="clear"> </div>
		    </th>
		  </tr>
		</table>
              </div>
             </div>
           </div>
	  </div>
            <?php endwhile;
            wp_reset_postdata(); ?>
	</div>
		</div>
		<div class="clear"> </div>
	</div>
	</div>
    <?php $myvariable = ob_get_clean();
    return $myvariable;
    }
}
add_shortcode( 'list-posts-materiels-offres', 'post_listing_materiels_offres' );

/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
//                    céer un shortcode pour lister les Annonces Emploi Demande
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////

function post_listing_emploi_demandes( $atts ) {
    ob_start();
    $query = new WP_Query( array(
        'post_type' => 'post',
        'posts_per_page' => -1,
        'order' => 'DEC',
        'orderby' => 'title',
        'post_limits' => 3,
        'tax_query' => array(
		array(
			'taxonomy' => 'annonce',
			'field'    => 'slug',
			'terms'    => array( 'emploi-demandes' ),
		),

	),
    ) );
    if ( $query->have_posts() ) { ?>
	<div class="row">
	<div class="gdl-page-item mb20 twelve columns">
		<div id="blog-item-holder" class="blog-item-holder">
			<div class="row">
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
				<div class="blog-item-holder">
	<div class="row">
		<div class="twelve columns gdl-blog-grid">
			<div class="blog-content-wrapper">
			<table class="tg">
  <tr>
    <th style="width: 82px;"> <div class="blog-media-wrapper gdl-image">
					<?php
					$url = "http://www.desceneenscene.fr/ng-1906/wp-content/themes/Nicolas/images";
					if ( has_post_thumbnail() ) {?>
						<a href="<?php the_permalink(); ?>"> <?php the_post_thumbnail(); ?> </a>
					<?php
					}
					else {?>
						<a href="<?php the_permalink(); ?>"> <?php echo "<img src='" .$url. "/annonces-par-defaut.png' alt='image par défaut' />"; ?> </a>
					<?php
					}
					?>
				</div>

   </th>
    <th>
     <div class="blog-context-wrapper">
					<h4>
						<a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a>
					</h4>

				</div>
				<div class="clear"> </div>
    </th>
  </tr>
</table>



			</div>
		</div>
		</div>
</div>
            <?php endwhile;
            wp_reset_postdata(); ?>
	</div>
		</div>
		<div class="clear"> </div>
	</div>
	</div>
    <?php $myvariable = ob_get_clean();
    return $myvariable;
    }
}
add_shortcode( 'list-posts-emploi-demandes', 'post_listing_emploi_demandes' );
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
//                    céer un shortcode pour lister les Annonces Local Demandes
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////

function post_listing_local_demandes( $atts ) {
    ob_start();
    $query = new WP_Query( array(
        'post_type' => 'post',
        'posts_per_page' => -1,
        'order' => 'DEC',
        'orderby' => 'title',
        'post_limits' => 3,
        'tax_query' => array(
		array(
			'taxonomy' => 'annonce',
			'field'    => 'slug',
			'terms'    => array( 'local-demandes' ),
		),

	),
    ) );
    if ( $query->have_posts() ) { ?>
	<div class="row">
	<div class="gdl-page-item mb20 twelve columns">
		<div id="blog-item-holder" class="blog-item-holder">
			<div class="row">
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
				<div class="blog-item-holder">
	<div class="row">
		<div class="twelve columns gdl-blog-grid">
			<div class="blog-content-wrapper">
			<table class="tg">
  <tr>
    <th style="width: 82px;"> <div class="blog-media-wrapper gdl-image">
					<?php
					$url = "http://www.desceneenscene.fr/ng-1906/wp-content/themes/Nicolas/images";
					if ( has_post_thumbnail() ) {?>
						<a href="<?php the_permalink(); ?>"> <?php the_post_thumbnail(); ?> </a>
					<?php
					}
					else {?>
						<a href="<?php the_permalink(); ?>"> <?php echo "<img src='" .$url. "/annonces-par-defaut.png' alt='image par défaut' />"; ?> </a>
					<?php
					}
					?>
				</div>

   </th>
    <th>
     <div class="blog-context-wrapper">
					<h4>
						<a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a>
					</h4>

				</div>
				<div class="clear"> </div>
    </th>
  </tr>
</table>
			</div>
		</div>
		</div>
</div>
            <?php endwhile;
            wp_reset_postdata(); ?>
	</div>
		</div>
		<div class="clear"> </div>
	</div>
	</div>
    <?php $myvariable = ob_get_clean();
    return $myvariable;
    }
}
add_shortcode( 'list-posts-local-demandes', 'post_listing_local_demandes' );

/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
//                    céer un shortcode pour lister les Annonces Matériels Demandes
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////

function post_listing_materiels_demandes( $atts ) {
    ob_start();
    $query = new WP_Query( array(
        'post_type' => 'post',
        'posts_per_page' => -1,
        'order' => 'DEC',
        'orderby' => 'title',
        'post_limits' => 3,
        'tax_query' => array(
		array(
			'taxonomy' => 'annonce',
			'field'    => 'slug',
			'terms'    => array( 'materiel-demandes' ),
		),
	),
    ) );
    if ( $query->have_posts() ) { ?>
	<div class="row">
	<div class="gdl-page-item mb20 twelve columns">
		<div id="blog-item-holder" class="blog-item-holder">
			<div class="row">
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
				<div class="blog-item-holder">
	<div class="row">
		<div class="twelve columns gdl-blog-grid">
			<div class="blog-content-wrapper">
			<table class="tg">
  <tr>
    <th style="width: 82px;"> <div class="blog-media-wrapper gdl-image">
					<?php
					$url = "http://www.desceneenscene.fr/ng-1906/wp-content/themes/Nicolas/images";
					if ( has_post_thumbnail() ) {?>
						<a href="<?php the_permalink(); ?>"> <?php the_post_thumbnail(); ?> </a>
					<?php
					}
					else {?>
						<a href="<?php the_permalink(); ?>"> <?php echo "<img src='" .$url. "/annonces-par-defaut.png' alt='image par défaut' />"; ?> </a>
					<?php
					}
					?>
				</div>

   </th>
    <th>
     <div class="blog-context-wrapper">
					<h4>
						<a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a>
					</h4>

				</div>
				<div class="clear"> </div>
    </th>
  </tr>
</table>
			</div>
		</div>
		</div>
</div>
            <?php endwhile;
            wp_reset_postdata(); ?>
	</div>
		</div>
		<div class="clear"> </div>
	</div>
	</div>
    <?php $myvariable = ob_get_clean();
    return $myvariable;
    }
}
add_shortcode( 'list-posts-materiels-demandes', 'post_listing_materiels_demandes' );
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
//                      céer un shortcode pour lister les compagnies
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
function post_listing_compagnies( $atts ) {
    ob_start();
    $query = new WP_Query( array(
        'post_type' => array('compagnie', 'producteur'),
        'posts_per_page' => -1,
        'order' => 'ASC',
        'orderby' => 'title',
    ) );
    if ( $query->have_posts() ) { ?>
	<div class="row">
	<div class="gdl-page-item mb20 twelve columns">
		<div id="blog-item-holder" class="blog-item-holder">
			<div class="row">
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
				<div class="three columns gdl-blog-grid" style="min-height:380px;max-height:380px;">
				      <div class="blog-content-wrapper" >
						<div class="blog-media-wrapper gdl-image" style="height:120px;">
					<?php
					$url = "http://www.desceneenscene.fr/ng-1906/wp-content/themes/Nicolas/images";
					if ( has_post_thumbnail() ) {?>
						<a href="<?php the_permalink(); ?>"> <?php the_post_thumbnail(); ?> </a>

					<?php
					}
					else {?>
						<a href="<?php the_permalink(); ?>"> <?php echo "<img src='" .$url. "/120_avatar.png' alt='image temporaire' />"; ?> </a>
					<?php
					}
					?>
						</div>
						<div class="blog-context-wrapper">
							<h2 class="blog-title">
								<a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a>
							</h2>
							<div class="blog-info-wrapper">
								<div class="blog-date-wrapper">
								<?php
								$prooupas1 =  get_post_meta(get_the_ID(), '_compagnie_info_statut', true);
								$prooupas2 =  get_post_meta(get_the_ID(), '_producteur_info_statut', true);
				if ($prooupas1 == "yes" || $prooupas2 == "yes"){
								the_terms( $query->ID, 'professionnel', ' - ', '-', ' - ' );
								echo "<br />";
				}
				elseif($prooupas1 == "no" || $prooupas2 == "no"){
								the_terms( $query->ID, 'professionnel', ' - ', '-', ' - ' );
								echo "<br />";
					}
				else{echo "<br />";}
				//fin pronopro
				?>
									<a href="#"> <?php the_modified_date(); ?> </a>
								</div>
								<div class="clear"> </div>
							</div>
							<div class="blog-content" style="min-height:80px;max-height:80px;" > <?php
							if(has_excerpt()) {
						echo wp_trim_words(get_the_excerpt(),12);
					      } else {$content = get_the_content();
						      echo wp_trim_words( $content , 12 );
					      }
							?>
							<div class="clear"> </div>
								<div class="clear"> </div>
							</div>
							<a class="blog-continue-reading" href="<?php the_permalink(); ?>"> En savoir plus</a>
						</div>
						<div class="clear"> </div>
					</div>
				</div>
            <?php endwhile;
            wp_reset_postdata(); ?>
	</div>
		</div>
		<div class="clear"> </div>
	</div>
	</div>
    <?php $myvariable = ob_get_clean();
    return $myvariable;
    }
}
add_shortcode( 'list-posts-compagnies', 'post_listing_compagnies' );
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
//                     céer un shortcode pour lister les compagnies Pro
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
function post_listing_compagnies_pro( $atts ) {
    ob_start();
    $exclude_ids = array( 4560, 4781 );
    $query = new WP_Query( array(
        'post_type' => array('compagnie', 'producteur'),
        'posts_per_page' => -1,
        'order' => 'ASC',
        'orderby' => 'title',
	'post__not_in' => array( $exclude_ids ),
'meta_query' => array(
		array(
			'key'     => '_compagnie_info_statut',
			'value'   => 'yes',
			'compare' => 'LIKE',
		)),
    ) );
    if ( $query->have_posts() ) { ?>
	<div class="row">
	<div class="gdl-page-item mb20 twelve columns">
		<div id="blog-item-holder" class="blog-item-holder">
			<div class="row">
	<div class="gdl-page-item mb20 twelve columns">
		<div id="blog-item-holder" class="blog-item-holder">
			<div class="row">
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
				<div class="three columns gdl-blog-grid"  style="min-height: 380px;">
					<div class="blog-content-wrapper" >
						<div class="blog-media-wrapper gdl-image" style="height:120px;">
					<?php
					$url = "http://www.desceneenscene.fr/ng-1906/wp-content/themes/Nicolas/images";
					if ( has_post_thumbnail() ) {?>
						<a href="<?php the_permalink(); ?>"> <?php the_post_thumbnail(); ?> </a>

					<?php
					}
					else {?>
						<a href="<?php the_permalink(); ?>"> <?php echo "<img src='" .$url. "/120_avatar.png' alt='image temporaire' />"; ?> </a>
					<?php
					}
					?>
						</div>
						<div class="blog-context-wrapper">
							<h2 class="blog-title">
								<a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a>
							</h2>
							<div class="blog-info-wrapper">
								<div class="blog-date-wrapper">

									<a href="#"> <?php the_modified_date(); ?> </a>
								</div>
								<div class="clear"> </div>
							</div>
							<div class="blog-content" style="min-height:80px;" > <?php
							if(has_excerpt()) {
						echo wp_trim_words(get_the_excerpt(),14);
					      } else {$content = get_the_content();
						      echo wp_trim_words( $content , 14 );
					      }
							?>
							<div class="clear"> </div>
								<div class="clear"> </div>
							</div>
							<a class="blog-continue-reading" href="<?php the_permalink(); ?>"> En savoir plus</a>
						</div>
						<div class="clear"> </div>
					</div>
				</div>
            <?php endwhile;
            wp_reset_postdata(); ?>
	</div>
		</div>
		<div class="clear"> </div>
	</div>
	</div>
		</div>
		<div class="clear"> </div>
	</div>
	</div>
    <?php $myvariable = ob_get_clean();
    return $myvariable;
    }
}
add_shortcode( 'list-posts-compagnies-pro', 'post_listing_compagnies_pro' );
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
//                 céer un shortcode pour lister les compagnies NO Pro
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
function post_listing_compagnies_no_pro( $atts ) {
    ob_start();
    $query = new WP_Query( array(
        'post_type' => 'compagnie',
        'posts_per_page' => -1,
        'order' => 'ASC',
        'orderby' => 'title',
'meta_query' => array(
		array(
			'key'     => '_compagnie_info_statut',
			'value'   => 'no',
			'compare' => 'LIKE',
		)),
    ) );
    if ( $query->have_posts() ) { ?>
	<div class="row">
	<div class="gdl-page-item mb20 twelve columns">
		<div id="blog-item-holder" class="blog-item-holder">
			<div class="row">
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
				<div class="three columns gdl-blog-grid" style="min-height:380px;max-height:380px;">
				      <div class="blog-content-wrapper" >
						<div class="blog-media-wrapper gdl-image" style="height:120px;">
					<?php
					$url = "http://www.desceneenscene.fr/ng-1906/wp-content/themes/Nicolas/images";
					if ( has_post_thumbnail() ) {?>
						<a href="<?php the_permalink(); ?>"> <?php the_post_thumbnail(); ?> </a>

					<?php
					}
					else {?>
						<a href="<?php the_permalink(); ?>"> <?php echo "<img src='" .$url. "/120_avatar.png' alt='image temporaire' />"; ?> </a>
					<?php
					}
					?>
						</div>
						<div class="blog-context-wrapper">
							<h2 class="blog-title">
								<a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a>
							</h2>
							<div class="blog-info-wrapper">
								<div class="blog-date-wrapper">
								<?php
								$prooupas1 =  get_post_meta(get_the_ID(), '_compagnie_info_statut', true);
								$prooupas2 =  get_post_meta(get_the_ID(), '_producteur_info_statut', true);
				if ($prooupas1 == "yes" || $prooupas2 == "yes"){
								the_terms( $query->ID, 'professionnel', ' - ', '-', ' - ' );
								echo "<br />";
				}
				elseif($prooupas1 == "no" || $prooupas2 == "no"){
								the_terms( $query->ID, 'professionnel', ' - ', '-', ' - ' );
								echo "<br />";
					}
				else{echo "<br />";}
				//fin pronopro
				?>
									<a href="#"> <?php the_modified_date(); ?> </a>
								</div>
								<div class="clear"> </div>
							</div>
							<div class="blog-content" style="min-height:80px;max-height:80px;" > <?php
							if(has_excerpt()) {
						echo wp_trim_words(get_the_excerpt(),15);
					      } else {$content = get_the_content();
						      echo wp_trim_words( $content , 15 );
					      }
							?>
							<div class="clear"> </div>
								<div class="clear"> </div>
							</div>
							<a class="blog-continue-reading" href="<?php the_permalink(); ?>"> En savoir plus</a>
						</div>
						<div class="clear"> </div>
					</div>
				</div>
            <?php endwhile;
            wp_reset_postdata(); ?>
	</div>
		</div>
		<div class="clear"> </div>
	</div>
	</div>
    <?php $myvariable = ob_get_clean();
    return $myvariable;
    }
}
add_shortcode( 'list-posts-compagnies-no-pro', 'post_listing_compagnies_no_pro' );
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
//                        céer un shortcode pour lister les enseignants
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
function post_listing_enseignants( $atts ) {
    ob_start();
    $query = new WP_Query( array(
        'post_type' => array('enseignant', 'producteur'),
        'posts_per_page' => -1,
        'order' => 'ASC',
        'orderby' => 'post_title',
    ) );
    if ( $query->have_posts() ) { ?>
	<div class="row">
	<div class="gdl-page-item mb20 twelve columns">
		<div id="blog-item-holder" class="blog-item-holder">
			<div class="row">
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
				<div class="three columns gdl-blog-grid" style="min-height:380px;max-height:380px;">
				      <div class="blog-content-wrapper" >
						<div class="blog-media-wrapper gdl-image" style="height:120px;">
					<?php
					$url = "http://www.desceneenscene.fr/ng-1906/wp-content/themes/Nicolas/images";
					if ( has_post_thumbnail() ) {?>
						<a href="<?php the_permalink(); ?>"> <?php the_post_thumbnail(); ?> </a>

					<?php
					}
					else {?>
						<a href="<?php the_permalink(); ?>"> <?php echo "<img src='" .$url. "/120_avatar.png' alt='image temporaire' />"; ?> </a>
					<?php
					}
					?>
						</div>
						<div class="blog-context-wrapper">
							<h2 class="blog-title">
								<a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a>
							</h2>
							<div class="blog-info-wrapper">
								<div class="blog-date-wrapper">
								<?php
								$prooupas1 =  get_post_meta(get_the_ID(), '_compagnie_info_statut', true);
								$prooupas2 =  get_post_meta(get_the_ID(), '_producteur_info_statut', true);
				if ($prooupas1 == "yes" || $prooupas2 == "yes"){
								the_terms( $query->ID, 'professionnel', ' - ', '-', ' - ' );
								echo "<br />";
				}
				elseif($prooupas1 == "no" || $prooupas2 == "no"){
								the_terms( $query->ID, 'professionnel', ' - ', '-', ' - ' );
								echo "<br />";
					}
				else{echo "<br />";}
				//fin pronopro
				?>
								  <p>Mis à jour le : <a href="#"><?php the_modified_date(); ?> </a> </p>
							</div>
								<div class="clear"> </div>
							</div>
							<div class="blog-content" style="min-height:80px;max-height:80px;text-transform: lowercase;" > <?php
							if(has_excerpt()) {
						echo wp_trim_words(get_the_excerpt(),15);
					      } else {$content = get_the_content();
						      echo wp_trim_words( $content , 15 );
					      }
							?>
							<div class="clear"> </div>
								<div class="clear"> </div>
							</div>
							<a class="blog-continue-reading" href="<?php the_permalink(); ?>"> En savoir plus</a>
						</div>
						<div class="clear"> </div>
					</div>
				</div>
            <?php endwhile;
            wp_reset_postdata(); ?>
	</div>
		</div>
		<div class="clear"> </div>
	</div>
	</div>
    <?php $myvariable = ob_get_clean();
    return $myvariable;
    }else{ echo "Nous sommes désolés, mais il n'y pas d'enseignant dans cette liste";}
}
add_shortcode( 'list-posts-enseignants', 'post_listing_enseignants' );
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
//                        céer un shortcode pour lister les ateliers
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
function post_listing_ateliers( $atts ) {
    ob_start();
    $query = new WP_Query( array(
        'post_type' => 'atelier',
        'posts_per_page' => -1,
        'order' => 'ASC',
        'orderby' => 'post_title',
    ) );
    if ( $query->have_posts() ) { ?>
	<div class="row">
	<div class="gdl-page-item mb20 twelve columns">
		<div id="blog-item-holder" class="blog-item-holder">
			<div class="row">
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
				<div class="three columns gdl-blog-grid" style="min-height:380px;max-height:380px;">
				      <div class="blog-content-wrapper" >
						<div class="blog-media-wrapper gdl-image" style="height:120px;">
					<?php
					$url = "http://www.desceneenscene.fr/ng-1906/wp-content/themes/Nicolas/images";
					if ( has_post_thumbnail() ) {?>
						<a href="<?php the_permalink(); ?>"> <?php the_post_thumbnail(); ?> </a>

					<?php
					}
					else {?>
						<a href="<?php the_permalink(); ?>"> <?php echo "<img src='" .$url. "/120_avatar.png' alt='image temporaire' />"; ?> </a>
					<?php
					}
					?>
						</div>
						<div class="blog-context-wrapper">
							<h2 class="blog-title">
								<a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a>
							</h2>
							<div class="blog-info-wrapper">
								<div class="blog-date-wrapper">
								<?php
								$prooupas1 =  get_post_meta(get_the_ID(), '_compagnie_info_statut', true);
								$prooupas2 =  get_post_meta(get_the_ID(), '_producteur_info_statut', true);
				if ($prooupas1 == "yes" || $prooupas2 == "yes"){
								the_terms( $query->ID, 'professionnel', ' - ', '-', ' - ' );
								echo "<br />";
				}
				elseif($prooupas1 == "no" || $prooupas2 == "no"){
								the_terms( $query->ID, 'professionnel', ' - ', '-', ' - ' );
								echo "<br />";
					}
				else{echo "<br />";}
				//fin pronopro
				?>
									<p>Mis à jour le : <a href="#"><?php the_modified_date(); ?> </a> </p>
								</div>
								<div class="clear"> </div>
							</div>
							<div class="blog-content" style="min-height:80px;max-height:80px;" > <?php
							if(has_excerpt()) {
						echo wp_trim_words(get_the_excerpt(),15);
					      } else {$content = get_the_content();
						      echo wp_trim_words( $content , 15 );
					      }
							?>
							<div class="clear"> </div>
								<div class="clear"> </div>
							</div>
							<a class="blog-continue-reading" href="<?php the_permalink(); ?>"> En savoir plus</a>
						</div>
						<div class="clear"> </div>
					</div>
				</div>
            <?php endwhile;
            wp_reset_postdata(); ?>
	</div>
		</div>
		<div class="clear"> </div>
	</div>
	</div>
    <?php $myvariable = ob_get_clean();
    return $myvariable;
    }
}
add_shortcode( 'list-posts-ateliers', 'post_listing_ateliers' );

/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
//                        céer un shortcode pour lister les stages
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
function post_listing_stages( $atts ) {
    ob_start();
   $todaysDate = date('m/d/Y H:i:s');
				$query      = new WP_Query(array(
								'post_type' => array('event'),
								'posts_per_page' => -1,
								'meta_query' => array(
												'key' => '_start_ts',
												'value' => current_time('timestamp'),
												'compare' => '>=',
												'type' => 'numeric'
								),
								'orderby' => 'meta_value_num',
								'key' => '_start_ts',
								'value' => current_time('timestamp'),
								'value_num' => current_time('timestamp'),
								'compare' => '>=',
								'order' => 'ASC',
								'category_name' => 'Stage, Ateliers'
								/*'cat' => 250*/
				));
    if ( $query->have_posts() ) {
    /*
    $query = new WP_Query( array(
        'post_type' => array('event'),
        'posts_per_page' => -1,
        'order' => 'DESC',
		'post_limits' => 1,
        'orderby' => 'modified',
		'category_name' => 'Stage, Ateliers'
    ) );
	$i = 0;
    if ( $query->have_posts() ) {*/ ?>

    <div class="css-events-list">
        <table cellpadding="0" cellspacing="0" class="events-table"  >
            <tbody>
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                <tr style="border-bottom:0px solid silver;">
                    <td>
                        <font size=4><?php the_modified_date(); ?></font>
                    </td>
                    <td>
                        <h3><a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a></h3>
                        <div class="list-event">
                        <p><span style="font:italic 1.0em sans;">Par : <?php the_author();?> </span><br />

                        </p>
                        </td>
                    <td width="40%", align="center", rowspan="2" >
                        <?php
                        $url = "http://www.desceneenscene.fr/ng-1906/";
                            if ( has_post_thumbnail() ) :?>
                                <img width="150" height="150" <?php the_post_thumbnail(); ?>

                            <?php else :?>
                                <iframe width="150" height="150" frameborder="0" scrolling="no" style="overflow-y:hidden;" <?php echo "<img src='" .$url. "wp-content/uploads/2016/07/image_evenement_150x150.png' alt='image temporaire' />"; ?>></iframe>
						<?php endif;   ?>
                </td>
            </tr>

            <tr style="border-bottom:1px solid silver;" >

                <td width="20%", valign="top" >
                </td>
                <td >
                </td>
                <td >
                </td>
            </tr>
        </tbody>
        <?php endwhile;
            wp_reset_postdata(); ?>
        </table>
        </div>
        <?php $myvariable = ob_get_clean();
        return $myvariable;
    }else{ echo "Nous sommes désolés, mais il n'y pas d'enseignant dans cette liste";}
}
add_shortcode( 'list-posts-stages', 'post_listing_stages' );

/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
//                        céer un shortcode pour lister les artistes
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
function post_listing_artistes( $atts ) {
    ob_start();
    $query = new WP_Query( array(
        'post_type' => 'artiste',
        'posts_per_page' => -1,
        'order' => 'ASC',
        'orderby' => 'name',
    ) );
    if ( $query->have_posts() ) { ?>
	<div class="row">
	<div class="gdl-page-item mb20 twelve columns">
		<div id="blog-item-holder" class="blog-item-holder">
			<div class="row">
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
				<div class="three columns gdl-blog-grid" style="min-height:380px;max-height:380px;">
				      <div class="blog-content-wrapper" >
						<div class="blog-media-wrapper gdl-image" style="height:120px;">
					<?php
					$url = "http://www.desceneenscene.fr/ng-1906/wp-content/themes/Nicolas/images";
					if ( has_post_thumbnail() ) {?>
						<a href="<?php the_permalink(); ?>"> <?php the_post_thumbnail(); ?> </a>

					<?php
					}
					else {?>
						<a href="<?php the_permalink(); ?>"> <?php echo "<img src='" .$url. "/120_avatar.png' alt='image temporaire' />"; ?> </a>
					<?php
					}
					?>
						</div>
						<div class="blog-context-wrapper">
							<h2 class="blog-title">
								<a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a>
							</h2>
							<div class="blog-info-wrapper">
								<div class="blog-date-wrapper">
								<?php
								$prooupas1 =  get_post_meta(get_the_ID(), '_compagnie_info_statut', true);
								$prooupas2 =  get_post_meta(get_the_ID(), '_producteur_info_statut', true);
				if ($prooupas1 == "yes" || $prooupas2 == "yes"){
								the_terms( $query->ID, 'professionnel', ' - ', '-', ' - ' );
								echo "<br />";
				}
				elseif($prooupas1 == "no" || $prooupas2 == "no"){
								the_terms( $query->ID, 'professionnel', ' - ', '-', ' - ' );
								echo "<br />";
					}
				else{echo "<br />";}
				//fin pronopro
				?>
									<a href="#"> <?php the_modified_date(); ?> </a>
								</div>
								<div class="clear"> </div>
							</div>
							<div class="blog-content" style="min-height:80px;max-height:80px;" > <?php
							if(has_excerpt()) {
						echo wp_trim_words(get_the_excerpt(),15);
					      } else {$content = get_the_content();
						      echo wp_trim_words( $content , 15 );
					      }
							?>
							<div class="clear"> </div>
								<div class="clear"> </div>
							</div>
							<a class="blog-continue-reading" href="<?php the_permalink(); ?>"> En savoir plus</a>
						</div>
						<div class="clear"> </div>
					</div>
				</div>
            <?php endwhile;
            wp_reset_postdata(); ?>
	</div>
		</div>
		<div class="clear"> </div>
	</div>
	</div>
    <?php $myvariable = ob_get_clean();
    return $myvariable;
    }
}
add_shortcode( 'list-posts-artistes', 'post_listing_artistes' );
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
//                 céer un shortcode pour lister les enseignants dans le menu
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
function post_listing_enseignants_menu( $atts ) {
    ob_start();
    $query = new WP_Query( array(
         'post_type' => array('enseignant', 'producteur'),
        'posts_per_page' => -1,
        'order' => 'ASC',
        'orderby' => 'date',
    ) );
    if ( $query->have_posts() ) { ?>
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
							<h4 class="mega-block-title">
								<a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a>
							</h4>
            <?php endwhile;
            wp_reset_postdata(); ?>
    <?php $myvariable = ob_get_clean();
    return $myvariable;
    }
}
add_shortcode( 'list-posts-enseignants_menu', 'post_listing_enseignants_menu' );
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
//             céer un shortcode pour lister les artistes dans le menu
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
function post_listing_artistes_footer( $atts ) {
    ob_start();
    $query = new WP_Query( array(
        'post_type' => 'artiste',
        'posts_per_page' => -1,
        'order' => 'ASC',
		'limit' => 7,
        'orderby' => 'date',
    ) );
    if ( $query->have_posts() ) { ?>
            <?php while ( $query->have_posts() ) : $query->the_post();
			/* $idheader = get_post_meta($post->ID,'_artiste_info_image',true);
			$url = wp_get_attachment_url( $idheader, full);
			echo wp_get_attachment_image(get_post_meta($post->ID, _artiste_info_image, true)); */?>
<div class="recent-post-widget">
					<div class="recent-post-widget-thumbnail"> <a href="<?php the_permalink(); ?> "> <img src="<?php echo  $url; ?>" alt=""> </a> </div>
					<div class="recent-post-widget-context">
						<h4 class="recent-post-widget-title">
							<a href="<?php the_permalink(); ?> ">
								<?php the_title(); ?>
							</a>
						</h4>
						<div class="recent-post-widget-info">
							<div class="recent-post-widget-date">
								<a href="<?php the_permalink(); ?> "> <?php the_date(); ?> </a>
							</div>
						</div>
						<div class="clear"> </div>
					</div>
</div>
            <?php endwhile;
            wp_reset_postdata(); ?>
    <?php $myvariable = ob_get_clean();
    return $myvariable;
    }
}
add_shortcode( 'list-posts-artistes_footer', 'post_listing_artistes_footer' );
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
//               affichage des groupes artistiques pros a l'accueil
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
function dernier_pro_accueil( $atts ) {
    ob_start();
    $query = new WP_Query( array(
        'post_type' => array('compagnie', 'producteur'),
        'posts_per_page' => -1,
        'order' => 'DESC',
		'post_limits' => 1,
        'orderby' => 'modified',
    ) );
	$i = 0;
    if ( $query->have_posts() ) { ?>
	<div class="row">
            <?php while ( $i < 1 && $query->have_posts()  ) : $query->the_post();  ?>
			<?php
				global $post;
				get_post_custom($post->ID);
				// si la compagnie est pro
				$prooupas1 = get_post_meta($post->ID, _compagnie_info_statut, true);
				$prooupas2 = get_post_meta($post->ID, _producteur_info_statut, true);
				if ($prooupas1 == "yes" || $prooupas2 == "yes") { $i++;
				?>
<div class="blog-item-holder" style="  width: 300px;  margin-left: auto;  margin-bottom:0px !important; margin-right: auto;">
	<div class="row">
		<div class="twelve columns gdl-blog-grid">
			<div class="blog-content-wrapper">
				<div class="blog-media-wrapper gdl-image" style="height:161px;">
					<?php
					$url = "http://www.desceneenscene.fr/ng-1906/wp-content/themes/Nicolas/images";
					if ( has_post_thumbnail() ) {?>
						<a href="<?php the_permalink(); ?>"> <?php the_post_thumbnail(); ?> </a>
					<?php
					}
					else {?>
						<a href="<?php the_permalink(); ?>"> <?php echo "<img src='" .$url. "/120_avatar.png' alt='image temporaire' />"; ?> </a>
					<?php
					}
					?>
				</div>
				<div class="blog-context-wrapper">
					<h4 class="blog-title">
						<a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a>
					</h4>
					<div class="blog-info-wrapper">
						<div class="blog-date-wrapper">
						<p>Mis à jour le : <a href="#"><?php the_modified_date(); ?> </a> </p>
						</div>
						<div class="clear"> </div>
					</div>
					<div class="blog-content" "style"="height:80px;"> <?php
					      if(has_excerpt()) {
						echo wp_trim_words(get_the_excerpt(),30);
					      } else {$content = get_the_content();
						      echo wp_trim_words( $content , '30' );
					      }  ?>
					       </div>
						  <div class="clear"></div>
						  <div>
						      <a class="blog-continue-reading-accueil" href="<?php the_permalink(); ?>"> En savoir plus</a>
							  <div class="clear"></div>
						  </div>
				</div>
				<div class="clear"> </div>
			</div>
		</div>
		</div>
</div>
				<?php
				} else {} ;
			?>
            <?php endwhile;
            wp_reset_postdata(); ?>
	</div>
    <?php $myvariable = ob_get_clean();
    return $myvariable;
    }
}
add_shortcode( 'afficher_pro_accueil', 'dernier_pro_accueil' );
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
//                 affichage des groupes artistiques amateurs a l'accueil
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
function dernier_amateur_accueil( $atts ) {
    ob_start();
    $query = new WP_Query( array(
         'post_type' => array('compagnie', 'producteur'),
        'posts_per_page' => -1,
        'order' => 'DESC',
		'post_limits' => 1,
        'orderby' => 'modified',
    ) );
	$i = 0;
    if ( $query->have_posts() ) { ?>
	<div class="row">
            <?php while ( $i < 1 && $query->have_posts()  ) : $query->the_post();  ?>
			<?php
				global $post;
				get_post_custom($post->ID);
				// si la compagnie est pro
				$prooupas1 = get_post_meta($post->ID, _compagnie_info_statut, true);
				$prooupas2 = get_post_meta($post->ID, _producteur_info_statut, true);
				if ($prooupas1 == "no" || $prooupas2 == "no") { $i++;
				?>
<div class="blog-item-holder" style="  width: 300px;  margin-left: auto; margin-bottom:0px !important;  margin-right: auto;">
	<div class="row">
		<div class="twelve columns gdl-blog-grid">
			<div class="blog-content-wrapper">
				<div class="blog-media-wrapper gdl-image" style="height:161px;">
					<?php
					$url = "http://www.desceneenscene.fr/ng-1906/wp-content/themes/Nicolas/images";
					if ( has_post_thumbnail() ) {?>
						<a href="<?php the_permalink(); ?>"> <?php the_post_thumbnail(); ?> </a>
					<?php
					}
					else {?>
						<a href="<?php the_permalink(); ?>"> <?php echo "<img src='" .$url. "/120_avatar.png' />"; ?> </a>
					<?php
					}
					?>
				</div>
				<div class="blog-context-wrapper">
					<h4 class="blog-title">
						<a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a>
					</h4>
					<div class="blog-info-wrapper">
						<div class="blog-date-wrapper">
							<p>Mis à jour le : <a href="#"><?php the_modified_date(); ?> </a> </p>
						</div>
						<div class="clear"> </div>
					</div>
					<div class="blog-content"> <?php
					      if(has_excerpt()) {
						echo wp_trim_words(get_the_excerpt(),30);
					      } else {$content = get_the_content();
						      echo wp_trim_words( $content , '30' );
					      }  ?>
					       </div>
						  <div class="clear"></div>
						  <div>
						      <a class="blog-continue-reading-accueil" href="<?php the_permalink(); ?>"> En savoir plus</a>
							  <div class="clear"></div>
						  </div>
				</div>
				<div class="clear"> </div>
			</div>
		</div>
		</div>
</div>
				<?php
				} else {} ;
			?>
            <?php endwhile;
            wp_reset_postdata(); ?>
	</div>
    <?php $myvariable = ob_get_clean();
    return $myvariable;
    }
}
add_shortcode( 'afficher_amateur_accueil', 'dernier_amateur_accueil' );

/////////// shortcode affichage des ateliers a l'accueil /////////////
function dernier_ateliers_accueil( $atts ) {
    ob_start();
    $query = new WP_Query( array(
        'post_type' => array('event'),
        'posts_per_page' => -1,
        'order' => 'DESC',
		'post_limits' => 1,
        'orderby' => 'modified',
		'category_name' => 'Stage, Ateliers'
    ) );
	$i = 0;
    if ( $query->have_posts() ) { ?>
	<div class="row">
            <?php while ( $i < 1 && $query->have_posts()  ) : $query->the_post();  ?>
			<?php
				global $post;
				get_post_custom($post->ID);$i++;
				?>
<div class="blog-item-holder" style="  width: 300px;  margin-left: auto; margin-bottom:0px !important; margin-right: auto;">
	<div class="row">
		<div class="twelve columns gdl-blog-grid">
			<div class="blog-content-wrapper">
				<div class="blog-media-wrapper gdl-image" style="height:161px;">
					<?php
					$url = "http://www.desceneenscene.fr/ng-1906/wp-content/themes/Nicolas/images";
					if ( has_post_thumbnail() ) {?>
						<a href="<?php the_permalink(); ?>"> <?php the_post_thumbnail(); ?> </a>
					<?php
					}
					else {?>
						<a href="<?php the_permalink(); ?>"> <?php echo "<img src='" .$url. "/120_avatar.png' />"; ?> </a>
					<?php
					}
					?>
				</div>
				<div class="blog-context-wrapper">
					<h4 class="blog-title">
						<a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a>
					</h4>
					<div class="blog-info-wrapper">
						<div class="blog-date-wrapper">
							<p>Mis à jour le : <a href="#"><?php the_modified_date(); ?> </a> </p>
						</div>
						<div class="clear"> </div>
					</div>
					<div class="blog-content"> <?php
					      if(has_excerpt()) {
						echo wp_trim_words(get_the_excerpt(),30);
					      } else {$content = get_the_content();
						      echo wp_trim_words( $content , '30' );
					      }  ?>
					       </div>
						  <div class="clear"></div>
						  <div>
						      <a class="blog-continue-reading-accueil" href="<?php the_permalink(); ?>"> En savoir plus</a>
							  <div class="clear"></div>
						  </div>
				</div>
				<div class="clear"> </div>
			</div>
		</div>
		</div>
</div>
            <?php endwhile;
            wp_reset_postdata(); ?>
	</div>
    <?php $myvariable = ob_get_clean();
    return $myvariable;
    }
}
add_shortcode( 'afficher_ateliers_accueil', 'dernier_ateliers_accueil' );
/////////// shortcode affichage des stages /////////////
function dernier_stage( $atts ) {
    ob_start();
    $query = new WP_Query( array(
        'post_type' => array('event', 'atelier'),
        'posts_per_page' => -1,
        'order' => 'DESC',
		'post_limits' => 100,
        'orderby' => 'modified',
		'category_name' => 'Stage'
    ) );
	$i = 0;
    if ( $query->have_posts() ) { ?>
	<div class="row">
            <?php while ( $i < 1 && $query->have_posts()  ) : $query->the_post();  ?>
			<?php
				global $post;
				get_post_custom($post->ID);$i++;
				?>
<div class="blog-item-holder" style="  width: 300px;  margin-left: auto; margin-bottom:0px !important; margin-right: auto;">
	<div class="row">
		<div class="twelve columns gdl-blog-grid">
			<div class="blog-content-wrapper">
				<div class="blog-media-wrapper gdl-image" style="height:161px;">
					<?php
					$url = "http://www.desceneenscene.fr/ng-1906/wp-content/themes/Nicolas/images";
					if ( has_post_thumbnail() ) {?>
						<a href="<?php the_permalink(); ?>"> <?php the_post_thumbnail(); ?> </a>
					<?php
					}
					else {?>
						<a href="<?php the_permalink(); ?>"> <?php echo "<img src='" .$url. "/120_avatar.png' />"; ?> </a>
					<?php
					}
					?>
				</div>
				<div class="blog-context-wrapper">
					<h4 class="blog-title">
						<a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a>
					</h4>
					<div class="blog-info-wrapper">
						<div class="blog-date-wrapper">
							<p>Mis à jour le : <a href="#"><?php the_modified_date(); ?> </a> </p>
						</div>
						<div class="clear"> </div>
					</div>
					<div class="blog-content"> <?php
					      if(has_excerpt()) {
						echo wp_trim_words(get_the_excerpt(),30);
					      } else {$content = get_the_content();
						      echo wp_trim_words( $content , '30' );
					      }  ?>
					       </div>
						  <div class="clear"></div>
						  <div>
						      <a class="blog-continue-reading-accueil" href="<?php the_permalink(); ?>"> En savoir plus</a>
							  <div class="clear"></div>
						  </div>
				</div>
				<div class="clear"> </div>
			</div>
		</div>
		</div>
</div>
            <?php endwhile;
            wp_reset_postdata(); ?>
	</div>
    <?php $myvariable = ob_get_clean();
    return $myvariable;
    }
}
add_shortcode( 'afficher_stage', 'dernier_stage' );
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
//                            affichage les espaces de dif a l'accueil
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
function dernier_espace_accueil( $atts ) {
    ob_start();
    $query = new WP_Query( array(
        'post_type' => 'location',
        'posts_per_page' => -1,
        'order' => 'DESC',
		'post_limits' => 1,
        'orderby' => 'modified',
		//'category_name' => 'Stage' avatar-dif.jpg
    ) );
	$i = 0;
    if ( $query->have_posts() ) { ?>
	<div class="row">
            <?php while ( $i < 1 && $query->have_posts()  ) : $query->the_post();  ?>
			<?php
				global $post;
				get_post_custom($post->ID);$i++;
				?>
<div class="blog-item-holder" style="  width: 300px;  margin-left: auto; margin-bottom:0px !important; margin-right: auto;">
	<div class="row">
		<div class="twelve columns gdl-blog-grid">
			<div class="blog-content-wrapper">
				<div class="blog-media-wrapper gdl-image" style="height:161px;">
				<?php
					$url = "http://www.desceneenscene.fr/ng-1906/wp-content/themes/Nicolas/images";
					if ( has_post_thumbnail() ) {?>
						<a href="<?php the_permalink(); ?>"> <?php the_post_thumbnail(); ?> </a>
					<?php
					}
					else {?>
						<a href="<?php the_permalink(); ?>"> <?php echo "<img src='" .$url. "/avatar-dif.png' />"; ?> </a>
					<?php
					}
					?>
				</div>
				<div class="blog-context-wrapper">
					<h4 class="blog-title">
						<a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a>
					</h4>
					<div class="blog-info-wrapper">
						<div class="blog-date-wrapper">
							<p>Mis à jour le : <a href="#"><?php the_modified_date(); ?> </a> </p>
						</div>
						<div class="clear"> </div>
					</div>
					<div class="blog-content"> <?php
					      if(has_excerpt()) {
						echo wp_trim_words(get_the_excerpt(),30);
					      } else {$content = get_the_content();
						      echo wp_trim_words( $content , '30' );
					      }  ?>
					       </div>
						  <div class="clear"></div>
						  <div>
						      <a class="blog-continue-reading-accueil" href="<?php the_permalink(); ?>"> En savoir plus</a>
							  <div class="clear"></div>
						  </div>
				</div>
				<div class="clear"> </div>
			</div>
		</div>
		</div>
</div>
            <?php endwhile;
            wp_reset_postdata(); ?>
	</div>
    <?php $myvariable = ob_get_clean();
    return $myvariable;
    }
}
add_shortcode( 'afficher_espace_accueil', 'dernier_espace_accueil' );
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
//////////////// Ajouter la taxonomie aux evenements ////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/*function my_em_own_taxonomy_register(){
	register_taxonomy_for_object_type('category',EM_POST_TYPE_EVENT);
	register_taxonomy_for_object_type('category',EM_POST_TYPE_LOCATION);
}
add_action('init','my_em_own_taxonomy_register',100);*/
function my_em_own_taxonomy_register(){
	register_taxonomy_for_object_type(EM_TAXONOMY_CATEGORY,EM_POST_TYPE_EVENT);
	register_taxonomy_for_object_type('category',EM_POST_TYPE_LOCATION);
	register_taxonomy_for_object_type('category',EM_POST_TYPE_EVENT);
	register_taxonomy_for_object_type('discipline',EM_POST_TYPE_LOCATION);
	register_taxonomy_for_object_type('discipline',EM_POST_TYPE_EVENT);
}
add_action('init','my_em_own_taxonomy_register',100);
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
//              Pouvoir chercher dans les meta box des custom type post
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
class MyPlugin {
	function MyPlugin()
	{
		add_action('posts_where_request', array(&$this, 'search'));
	}
	function search($where)
	{
		if (is_search()) {
			global $wpdb, $wp;
			$where = preg_replace(
				"/(wp_posts.post_title (LIKE '%{$wp->query_vars['s']}%'))/i",
				"$0 OR ($wpdb->postmeta.meta_key = '_{$this->tag}' AND $wpdb->postmeta.meta_value $1)",
				$where
			);
			add_filter('posts_join_request', array(&$this, 'search_join'));
		}
		return $where;
	}
	function search_join($join)
	{
		global $wpdb;
		return $join .= " LEFT JOIN $wpdb->postmeta ON ($wpdb->posts.ID = $wpdb->postmeta.post_id) ";
	}
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
//				liens sur les titres des widget				////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////
add_filter( 'widget_title', 'accept_html_widget_title' );
function accept_html_widget_title( $mytitle ) {
  // The sequence of String Replacement is important!!
	$mytitle = str_replace( '[link', '<a', $mytitle );
	$mytitle = str_replace( '[/link]', '</a>', $mytitle );
    $mytitle = str_replace( ']', '>', $mytitle );
	return $mytitle;
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//              Icon image des fichiers attachés
//////////////////////////////////////////////////////////////////////////////////////////////////////
function get_icon_for_attachment($post_id) {
  $base = "http://www.desceneenscene.fr/ng-1906/wp-content/themes/Nicolas/images/icons/";
  $type = get_post_mime_type($post_id);
  switch ($type) {
    case 'image/jpeg':
    case 'image/png':
    case 'image/gif':
      return $base . "images.jpeg"; break;
    case 'video/mpeg':
    case 'video/mp4':
    case 'video/quicktime':
      return $base . "video.jpeg"; break;
    case 'text/csv':
    case 'text/plain':
    case 'text/xml':
      return $base . "text.png"; break;
    default:
      return $base . "dossiertech.jpeg";
  }
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////
// This is a way to load event sponsors by slug rather than term taxonomy ID, making it easier to shortcode
/////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
function my_em_disciplines_event_load($EM_Event){
	global $wpdb;
	$tax_ids = $wpdb->get_col("SELECT term_taxonomy_id FROM $wpdb->term_relationships WHERE object_id='{$EM_Event->post_id}'", 0	);
	$term_slugs = array();
	foreach($tax_ids as $tax_id){
		$term_ids = $wpdb->get_col("SELECT term_id FROM $wpdb->term_taxonomy WHERE term_taxonomy_id=$tax_id", 0	);
		foreach($term_ids as $term_id){
			$term_slug = $wpdb->get_col("SELECT slug FROM $wpdb->terms WHERE term_id=$term_id", 0	);
			$term_slugs[] = implode( $term_slug);
		}

	}
	$EM_Event->disciplines = $term_slugs;
	//$EM_Event->disciplines = $wpdb->get_col("SELECT term_taxonomy_id FROM $wpdb->term_relationships WHERE object_id='{$EM_Event->post_id}'", 0	); //Use this if you just want to use the term taxonomy ID in the shortcode
}
add_action('em_event','my_em_disciplines_event_load',1,1);
// And make the search attributes for the shortcode
add_filter('em_events_get_default_search','my_em_disciplines_get_default_search',1,2);
function my_em_disciplines_get_default_search($searches, $array){
	if( !empty($array['discipline']) ){
		$searches['discipline'] = $array['discipline'];
	}
	return $searches;
}
add_filter('em_events_get','my_em_disciplines_events_get',1,2);
function my_em_disciplines_events_get($events, $args){
	if( !empty($args['discipline'])  ){
		foreach($events as $event_key => $EM_Event){
			if( !in_array($args['discipline'],$EM_Event->disciplines) ){
				unset($events[$event_key]);
			}
		}
	}
	//print_r($events); // Use this for debugging
	return $events;
}
function an_pagination() { // SEO : anti duplicate title
 global $page, $paged;
 if ( $paged > 1 || $page > 1 ) {
  return  ' - ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );
 }
}
//pour creer un flux rss
add_action('init', 'customRSS');
function customRSS(){
        add_feed('feedname', 'customRSSFunc');
}
function customRSSFunc(){
        get_template_part('rss', 'feedname');
}
// retrieves the attachment ID from the file URL
function get_image_id_by_url($image_url) {
    global $wpdb;
    $attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url ));
        return $attachment[0];
}
// Get placeholder slider image
function get_placeholder_slider_image() {
    $placeholderId = 7948;
    if (function_exists('ot_get_option')) {
        $imageUrl = ot_get_option('image_defaut_slider',true);
        if(!empty($imageUrl)) {
            $placeholderId = get_image_id_by_url($imageUrl);
        }
    }
    return $placeholderId;
}
/////////////////////////////////////////////////////////////////////////////////////////////////
//                        céer un shortcode pour lister les prochains spectacles
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
function list_prochains_spectacles($atts)
{
				ob_start();
?>
<tbody style="display: block; border: 0px solid green; height: 100%; overflow-y: none">
<div>
<ul>
<?php
				$todaysDate = date('m/d/Y H:i:s');
				$query      = new WP_Query(array(
								'post_type' => 'event',
								'posts_per_page' => 6,
								'meta_query' => array(
												'key' => '_start_ts',
												'value' => current_time('timestamp'),
												'compare' => '>=',
												'type' => 'numeric'
								),
								'orderby' => 'meta_value_num',
								'order' => 'ASC',
								'meta_key' => '_start_ts',
								'meta_value' => current_time('timestamp'),
								'meta_value_num' => current_time('timestamp'),
								'meta_compare' => '>=',
								'cat' => 245
				));
				if ($query->have_posts()) {
?>


	 <?php
								while ($query->have_posts()):
												$query->the_post();
?>
		<?php
												global $post;
												$id = $query->post->ID;
?>
<li>
				<a href="<?php	the_permalink(); ?>">
				   <?php echo get_the_title($id); ?>
				  </a>
				<?php
					setlocale (LC_TIME, 'fr_FR');
					print strftime("%d-%m-%Y",strtotime(get_post_meta($id, '_event_start_date', true)));
					$disciplines = wp_get_post_terms($post->ID, 'discipline', array("fields" => "names"));
					$replace     = implode(", ", $disciplines);
					echo ' - ' . $replace . ' -';
?>
	<?php
				endwhile;
				} else {

				}
				wp_reset_postdata();
?>

</li>
</ul>
</div>
   	<?php
				$myvariable = ob_get_clean();
				return $myvariable;
}
add_shortcode('list-next-spectacles', 'list_prochains_spectacles');
// Modify username translation on register action
function login_function() {
    if(isset($_GET['action']) && $_GET['action'] == 'register') {
        add_filter( 'gettext', 'username_change', 20, 3 );
        function username_change( $translated_text, $text, $domain )
        {
            if ($text === 'Username')
            {
                $translated_text = 'Créer un Identifiant';
            }
            return $translated_text;
        }
    }
}
add_action( 'login_head', 'login_function' );
//redirect after registration
function wpse_19692_registration_redirect() {
    return home_url( '/suite-inscription/' );
}

add_filter( 'registration_redirect', 'wpse_19692_registration_redirect' );

// Event custom metaboxe

function suggest_js() {
    global $post_type;
    if ( $post_type == 'event' ) {
        wp_enqueue_script('autocomplete_js', get_stylesheet_directory_uri().'/js/auto-complete.js', array('jquery'));
        wp_enqueue_script('suggest_js', get_stylesheet_directory_uri().'/js/suggestions.js', array('autocomplete_js'));
        wp_localize_script('autocomplete_js', 'ajaxurl', admin_url('admin-ajax.php'));
    }
}

function ajax_listings() {
    global $wpdb; //get access to the WordPress database object variable

    //get names of all businesses
    $name = $wpdb->esc_like(stripslashes($_POST['name'])).'%'; //escape for use in LIKE statement
    $sql = "select post_title
    from $wpdb->posts
    where (post_type='compagnie' or post_type='enseignant') and post_status='publish'";

    $sql = $wpdb->prepare($sql, $name);

    $results = $wpdb->get_results($sql);

    //copy the business titles to a simple array
    $titles = array();
    foreach( $results as $r )
        $titles[] = $r->post_title;

    echo json_encode($titles); //encode into JSON format and output

    die(); //stop "0" from being output
}
add_action('admin_enqueue_scripts', 'suggest_js');
add_action('wp_ajax_nopriv_get_listing_posts', 'ajax_listings');
add_action('wp_ajax_get_listing_posts', 'ajax_listings');


add_action( 'add_meta_boxes', 'event_producteur_box' );
function event_producteur_box() {
    add_meta_box(
                'event_producteur_box_content'
                , 'Producteur'
                , 'event_producteur_box_content'
                , EM_POST_TYPE_EVENT
                , 'normal'
                , 'low'
            );
}
add_action( 'add_meta_boxes', 'event_prod_site_box' );
function event_prod_site_box() {
    add_meta_box(
                'event_prod_site_box_content'
                , 'Site Web du producteur (s\'il existe)'
                , 'event_prod_site_box_content'
                , EM_POST_TYPE_EVENT
                , 'normal'
                , 'low'
            );
}
function event_producteur_box_content($post) {
    wp_nonce_field( plugin_basename( __FILE__ ), 'event_producteur_box_content_nonce' );
    $value = get_post_meta( $post->ID, 'nom_producteur', true);
    echo '<div class="typeahead-wrapper">';
    echo '<input type="text" style="width:100%;" class="typeahead" id="nom_producteur" name="nom_producteur" value="'.$value.'" required>';
    echo '</div>';
}
function event_prod_site_box_content($post) {
    wp_nonce_field( plugin_basename( __FILE__ ), 'event_prod_site_box_content_nonce' );
    $site =  get_post_meta($post->ID, 'enseignant_info_siteweb', true);
    echo '<div class="typeahead-wrapper">';
    echo '<input type="text" style="width:100%;" class="typeahead" id="enseignant_info_siteweb" name="enseignant_info_siteweb" value="'.$site.'" >';
    echo '</div>';
}
// form php validation
add_action( 'save_post', 'event_save_postdata' );
function event_save_postdata($post_id) {
    if(!wp_verify_nonce($_POST['event_producteur_box_content_nonce'], plugin_basename( __FILE__ )))
    return;
    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
      return $post_id;
    }
    if(!current_user_can("edit_post", $post_id))
        return $post_id;
    if ( 'event' == $_POST['post_type'] ) {
        $nom_producteur = $_POST['nom_producteur'];
        if(!empty($nom_producteur)) {
           update_post_meta( $post_id, 'nom_producteur', $nom_producteur);
        }
    }
}
// form php validation
add_action( 'save_post', 'event_save_postdatasite' );
function event_save_postdatasite($post_id) {
    if(!wp_verify_nonce($_POST['event_prod_site_box_content_nonce'], plugin_basename( __FILE__ )))
    return;
    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
      return $post_id;
    }
    if(!current_user_can("edit_post", $post_id))
        return $post_id;
    if ( 'event' == $_POST['post_type'] ) {
        $nom_prod_site = $_POST['enseignant_info_siteweb'];
        if(!empty($nom_prod_site)) {
           update_post_meta( $post_id, 'enseignant_info_siteweb', $nom_prod_site);
        }
    }
}
// improve Native search
add_filter('posts_join', 'advance_event_search_join' );
add_filter('posts_where', 'advance_event_search_where' );
add_filter('posts_groupby', 'advance_event_search_groupby' );

function advance_event_search_join( $join )
{
  global $wpdb;

  if( is_search() ) {
    $join .= " LEFT JOIN wp_em_locations ON " .
       $wpdb->posts . ".ID = wp_em_locations.post_id";
  }

  return $join;
}

function advance_event_search_where( $where )
{
  if( is_search() ) {
    $where = preg_replace(
       "/\(\s*post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
       "(post_title LIKE $1) OR (location_name LIKE $1) OR (location_slug LIKE $1)", $where );
   }

  return $where;
}

function advance_event_search_groupby( $groupby )
{
  global $wpdb;

  if( !is_search() ) {
    return $groupby;
  }

  // we need to group on post ID

  $mygroupby = "{$wpdb->posts}.ID";

  if( preg_match( "/$mygroupby/", $groupby )) {
    // grouping we need is already there
    return $groupby;
  }

  if( !strlen(trim($groupby))) {
    // groupby was empty, use ours
    return $mygroupby;
  }

  // wasn't empty, append ours
  return $groupby . ", " . $mygroupby;
}
// Custom events rss feed scope
add_filter( 'em_events_build_sql_conditions', 'my_em_scope_conditions',1,2);
function my_em_scope_conditions($conditions, $args){
    if( !empty($args['scope']) && $args['scope']=='next-seven' ){
        $start_date = date('Y-m-d',current_time('timestamp'));
        $end_date = date('Y-m-d',strtotime("+7 day", current_time('timestamp')));
        $conditions['scope'] = " (event_start_date BETWEEN CAST('$start_date' AS DATE) AND CAST('$end_date' AS DATE)) OR (event_end_date BETWEEN CAST('$end_date' AS DATE) AND CAST('$start_date' AS DATE))";
    }
    return $conditions;
}
add_filter( 'em_get_scopes','my_em_scopes',1,1);
function my_em_scopes($scopes){
    $my_scopes = array(
        'next-seven' => '7 prochains jours'
    );
    return $scopes + $my_scopes;
}
// Show time if different than 00:00:00
add_action('em_event_output_condition', 'my_em_time_event_output_condition', 1, 4);
function my_em_time_event_output_condition($replacement, $condition, $match, $EM_Event){
    if( is_object($EM_Event) && preg_match('/^has_time$/',$condition, $matches) ){
        if($EM_Event->event_start_time != "00:00:00") {
            $replacement = preg_replace("/\{\/?$condition\}/", '', $match);
        } else {
            $replacement = '';
        }
    }
    return $replacement;
}
add_action('wp_insert_post', 'wpc_champs_personnalises_defaut');
 function wpc_champs_personnalises_defaut($post_id)
 {
 if ( $_GET['post_type'] != 'event' ) {
 add_post_meta($post_id, 'custom_field_1', '', true);
 add_post_meta($post_id, 'custom_field_2', '', true);
 add_post_meta($post_id, 'meta-description', get_the_excerpt(), true);
 }
 return true;
 }

/*
 *  Search Form Toggle
 */

 add_action('wp_enqueue_scripts', 'dses_enqueue_scripts');
 function dses_enqueue_scripts () {

        wp_enqueue_script (
            'form-search-toggle',
            get_stylesheet_directory_uri().'/js/jquery.form-search-toggle.js',
            array('jquery'),
            '1.0.0',    // version
            true        // charger dans le footer
        );

 }



