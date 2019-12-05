<?php
/////////////////////////////////////////////////////////////////////////////////////////////
//    						taxo
////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
// 				Add new taxonomy, Disciplines
////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

add_action( 'init', 'create_book_taxonomies', 0 );

function create_book_taxonomies() {


	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Disciplines', 'taxonomy general name' ),
		'singular_name'     => _x( 'Discipline', 'taxonomy singular name' ),
		'search_items'      => __( 'recherche' ),
		'all_items'         => __( 'Toutes' ),
		'parent_item'       => __( 'Parent' ),
		'parent_item_colon' => __( 'Parent :' ),
		'edit_item'         => __( 'Editer' ),
		'update_item'       => __( 'Mettre à jour' ),
		'add_new_item'      => __( 'Ajouter' ),
		'new_item_name'     => __( 'Nouveau nom' ),
		'menu_name'         => __( 'Disciplines' ),
	);


	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'discipline' ),
	);


	register_taxonomy( 'discipline', array( 'event', 'compagnie', 'production', 'artiste', 'atelier', 'enseignant' ), $args );
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//                     fin de la taxo
///////////////////////////////////////////////////////////////////////////////////////////////////////////////





/////////////////////////////////////////////////////////////////////////////////////////////////////////////
// 				Add new taxonomy, PROOUPAS
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Professionnels', 'taxonomy general name' ),
		'singular_name'     => _x( 'Professionnel', 'taxonomy singular name' ),
		'search_items'      => __( 'recherche' ),
		'all_items'         => __( 'Toutes' ),
		'parent_item'       => __( 'Parent' ),
		'parent_item_colon' => __( 'Parent :' ),
		'edit_item'         => __( 'Editer' ),
		'update_item'       => __( 'Mettre à jour' ),
		'add_new_item'      => __( 'Ajouter' ),
		'new_item_name'     => __( 'Nouveau nom' ),
		'menu_name'         => __( 'Professionnel' ),
	);


	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'professionnel' ),
	);


	register_taxonomy( 'professionnel', array( 'event', 'compagnie', 'production', 'artiste', 'atelier', 'enseignant' ), $args );
//////////////////////////////////////////////////////////////////////////////////////////////////
//						fin de la taxo
///////////////////////////////////////////////////////////////////////////////////////////////////




///////////////////////////////////////////////////////////////////////////////////////////////////////
//					 Add new taxonomy, Public
///////////////////////////////////////////////////////////////////////////////////////////////////////

	$labels = array(
		'name'              => _x( 'Publics', 'taxonomy general name' ),
		'singular_name'     => _x( 'Public', 'taxonomy singular name' ),
		'search_items'      => __( 'recherche' ),
		'all_items'         => __( 'Toutes' ),
		'parent_item'       => __( 'Parent' ),
		'parent_item_colon' => __( 'Parent :' ),
		'edit_item'         => __( 'Editer' ),
		'update_item'       => __( 'Mettre à jour' ),
		'add_new_item'      => __( 'Ajouter' ),
		'new_item_name'     => __( 'Nouveau nom' ),
		'menu_name'         => __( 'Publics' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'public' ),
	);

	register_taxonomy( 'public', array( 'event', 'compagnie', 'production', 'artiste', 'atelier', 'enseignant' ), $args );
//////////////////////////////////////////////////////////////////////////////////////////////////
//				fin de la taxo
///////////////////////////////////////////////////////////////////////////////////////////////////





/////////////////////////////////////////////////////////////////////////////////////////////////////////
//			 Add new taxonomy, Annonces (spectacle, stage)
////////////////////////////////////////////////////////////////////////////////////////////////////////

	$labels = array(
		'name'              => _x( 'Annonces', 'taxonomy general name' ),
		'singular_name'     => _x( 'Annonce', 'taxonomy singular name' ),
		'search_items'      => __( 'recherche' ),
		'all_items'         => __( 'Toutes' ),
		'parent_item'       => __( 'Parent' ),
		'parent_item_colon' => __( 'Parent :' ),
		'edit_item'         => __( 'Editer' ),
		'update_item'       => __( 'Mettre à jour' ),
		'add_new_item'      => __( 'Ajouter' ),
		'new_item_name'     => __( 'Nouveau nom' ),
		'menu_name'         => __( 'Annonces' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'annonce' ),
	);

	register_taxonomy( 'annonce', array( 'post' ), $args );
//////////////////////////////////////////////////////////////////////////////////////////////////
//				fin de la taxo
///////////////////////////////////////////////////////////////////////////////////////////////////



/////////////////////////////////////////////////////////////////////////////////////////////////////
// 				Add new taxonomy, Métier
//////////////////////////////////////////////////////////////////////////////////////////////////////
	$labels = array(
		'name'              => _x( 'Métiers', 'taxonomy general name' ),
		'singular_name'     => _x( 'Métier', 'taxonomy singular name' ),
		'search_items'      => __( 'recherche' ),
		'all_items'         => __( 'Toutes' ),
		'parent_item'       => __( 'Parent' ),
		'parent_item_colon' => __( 'Parent :' ),
		'edit_item'         => __( 'Editer' ),
		'update_item'       => __( 'Mettre à jour' ),
		'add_new_item'      => __( 'Ajouter' ),
		'new_item_name'     => __( 'Nouveau nom' ),
		'menu_name'         => __( 'Métiers' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'metiers' ),
	);

	register_taxonomy( 'metier', array( 'artiste' ), $args );

//////////////////////////////////////////////////////////////////////////////////////////////////
//				fin de la taxo
///////////////////////////////////////////////////////////////////////////////////////////////////

}

////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
//					fin générale des taxo
////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////////////
////////////   Taxo complète + filtre dropdown etc. pour essayer n'est pas utilisé si besoin...
//////////////////////////////////////////////////////////////////////////////////////////////////


/*


// custom Artist taxonomy for events
add_action( 'init', 'register_my_taxonomies', 0 );

function register_my_taxonomies() {
$labels = array(
    'name'                          => 'artists',
    'singular_name'                 => 'artist',
    'search_items'                  => 'Search Artists',
    'popular_items'                 => 'Popular Artists',
    'all_items'                     => 'All Artists',
    'parent_item'                   => 'Parent Artist',
    'edit_item'                     => 'Edit Artist',
    'update_item'                   => 'Update Artist',
    'add_new_item'                  => 'Add New Artist',
    'new_item_name'                 => 'New Artist',
    'separate_items_with_commas'    => 'Separate Artists with commas',
    'add_or_remove_items'           => 'Add or remove Artists',
    'choose_from_most_used'         => 'Choose from most used Artists'
    );

$args = array(
    'label'                         => 'Artists',
    'labels'                        => $labels,
    'public'                        => true,
    'hierarchical'                  => true,
    'show_ui'                       => true,
    'show_in_nav_menus'             => true,
    'args'                          => array( 'orderby' => 'term_order' ),
    'rewrite'                       => array( 'slug' => 'events/artists', 'with_front' => false ),
    'query_var'                     => true
);

register_taxonomy( 'artists', EM_POST_TYPE_EVENT, $args );
}

// custom taxonomy search and display
add_action('em_template_events_search_form_ddm', 'artists_search_form');
function artists_search_form(){
	$artists = (is_array(get_option('artists'))) ? get_option('artists'):array();
	?>
	<!-- START artists Search -->
	<select name="artist" id="artist_search">
		<option value="" selected="selected">Artists</option>
		<?php
		$taxonomies = array('artists');
		$args = array('orderby'=>'count','hide_empty'=>true);
		echo get_terms_dropdown($taxonomies, $args);
		?>
	</select>
	<!-- END artists Search -->
	<?php
}

function my_em_artists_event_load($EM_Event){
	global $wpdb;
	$EM_Event->artists = $wpdb->get_col("SELECT term_taxonomy_id FROM $wpdb->term_relationships WHERE object_id='{$EM_Event->post_id}'", 0	);
}
add_action('em_event','my_em_artists_event_load',1,1);

// And make the search attributes for the shortcode
add_filter('em_events_get_default_search','my_em_artists_get_default_search',1,2);
function my_em_artists_get_default_search($searches, $array){
	if( !empty($array['artist']) ){
		$searches['artist'] = $array['artist'];
	}
	return $searches;
}

add_filter('em_events_get','my_em_artists_events_get',1,2);
function my_em_artists_events_get($events, $args){
	if( !empty($args['artist'])  ){
		foreach($events as $event_key => $EM_Event){
			if( !in_array($args['artist'],$EM_Event->artists) ){
				unset($events[$event_key]);
			}
		}
	}
	return $events;
}

function get_terms_dropdown($taxonomies, $args){
	$myterms = get_terms($taxonomies, $args);

	foreach($myterms as $term){
		$root_url = get_bloginfo('url');
		$term_taxonomy=$term->taxonomy;
		$term_slug=$term->slug;
		$term_name =$term->name;
		$value = $term->term_id;
		$output .="<option value='".$value."'>".$term_name."</option>";
	}

return $output;
}

*/



?>