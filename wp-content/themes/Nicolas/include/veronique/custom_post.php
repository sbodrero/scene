<?php

// Register Custom Post Type
function custom_post_type() {

/* Les artistes */
	$labels = array(
		'name'                => _x( 'Bio des artistes / techniciens', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'Artiste', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'Bio des artistes et Techniciens', 'text_domain' ),
		'name_admin_bar'      => __( 'Bio des artistes et Techniciens', 'text_domain' ),
		'parent_item_colon'   => __( 'Voir au-dessus :', 'text_domain' ),
		'all_items'           => __( 'Tous', 'text_domain' ),
		'add_new_item'        => __( 'Créer un profil Artiste ou Technicien', 'text_domain' ),
		'add_new'             => __( 'Créer', 'text_domain' ),
		'new_item'            => __( 'Créer votre profil', 'text_domain' ),
		'edit_item'           => __( 'Modifier votre profil', 'text_domain' ),
		'update_item'         => __( 'Mettre à jour', 'text_domain' ),
		'view_item'           => __( 'Aperçu', 'text_domain' ),
		'search_items'        => __( 'chercher', 'text_domain' ),
		'not_found'           => __( 'pas trouvé', 'text_domain' ),
		'not_found_in_trash'  => __( 'rien dans la corbeille', 'text_domain' ),
	);
	$args = array(
		'label'               => __( 'artiste', 'text_domain' ),
		'description'         => __( 'Page des artistes et des techniciens', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields', 'page-attributes', 'post-formats', ),
		'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => true,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-admin-users',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,		
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'artiste', $args );

function save_custom_post ( $post_id, $post = null ) {
    if ( !$post ) $post = get_post($post_id);
    if ( !current_user_can( 'edit_posts', $post->ID ) ) return;
    if ( 'artiste' != $post->post_type ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

    wp_set_object_terms( $post->ID, 'prayer-request', 'artiste' );
}
add_action( "save_post", "save_custom_post", 96, 2 );
	/* Les Ateliers */
	$labels = array(
		'name'                => _x( 'Ateliers', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'Atelier', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'Atelier', 'text_domain' ),
		'name_admin_bar'      => __( 'Atelier', 'text_domain' ),
		'parent_item_colon'   => __( 'Voir au-dessus :', 'text_domain' ),
		'all_items'           => __( 'Tous', 'text_domain' ),
		'add_new_item'        => __( 'Créer un atelier', 'text_domain' ),
		'add_new'             => __( 'Ajouter', 'text_domain' ),
		'new_item'            => __( 'Créer la page de l\'atelier', 'text_domain' ),
		'edit_item'           => __( 'Modifier l\'atelier ', 'text_domain' ),
		'update_item'         => __( 'Mettre à jour', 'text_domain' ),
		'view_item'           => __( 'Voir', 'text_domain' ),
		'search_items'        => __( 'chercher', 'text_domain' ),
		'not_found'           => __( 'pas trouvé', 'text_domain' ),
		'not_found_in_trash'  => __( 'rien dans la corbeille', 'text_domain' ),
	);
	$args = array(
		'label'               => __( 'atelier', 'text_domain' ),
		'description'         => __( 'Page des ateliers', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields', 'page-attributes', 'post-formats', ),
		'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => true,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-admin-users',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,		
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'atelier', $args );

/* Les compagnies */
	$labels = array(
		'name'                => _x( 'Producteur artistique / technique', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'Producteur artistique / technique', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'Producteurs artistiques / techniques', 'text_domain' ),
		'name_admin_bar'      => __( 'Producteur artistique / technique', 'text_domain' ),
		'parent_item_colon'   => __( 'Parent Item:', 'text_domain' ),
		'all_items'           => __( 'Tous', 'text_domain' ),
		'add_new_item'        => __( 'Créer un profil', 'text_domain' ),
		'add_new'             => __( 'Créer', 'text_domain' ),
		'new_item'            => __( 'Nouveau', 'text_domain' ),
		'edit_item'           => __( 'Modifier le profil', 'text_domain' ),
		'update_item'         => __( 'Mettre à jour', 'text_domain' ),
		'view_item'           => __( 'Aperçu', 'text_domain' ),
		'search_items'        => __( 'Chercher', 'text_domain' ),
		'not_found'           => __( 'Pas trouvé', 'text_domain' ),
		'not_found_in_trash'  => __( 'Rien dans la corbeille', 'text_domain' ),
	);
	$args = array(
		'label'               => __( 'groupes artistiques', 'text_domain' ),
		'description'         => __( 'les Producteurs artistiques', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields', 'page-attributes', 'post-formats', ),
		'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => true,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_icon'           => 'dashicons-money',
		'menu_position'       => 2,
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,		
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'compagnie', $args );
	
	/* Les mixtes 

$labels = array(
		'name'                => _x( 'Producteurs artistiques et Enseignants', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'Producteur artisitique et Enseignant', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'Producteurs artisitiques et Enseignants', 'text_domain' ),
		'name_admin_bar'      => __( 'Producteurs artisitiques et Enseignants', 'text_domain' ),
		'parent_item_colon'   => __( 'Voir au-dessus :', 'text_domain' ),
		'all_items'           => __( 'Tous', 'text_domain' ),
		'add_new_item'        => __( 'Créer un profil', 'text_domain' ),
		'add_new'             => __( 'Nouveau', 'text_domain' ),
		'new_item'            => __( 'Nouveau', 'text_domain' ),
		'edit_item'           => __( 'Modifier votre profil', 'text_domain' ),
		'update_item'         => __( 'Mettre à jour', 'text_domain' ),
		'view_item'           => __( 'Voir', 'text_domain' ),
		'search_items'        => __( 'chercher', 'text_domain' ),
		'not_found'           => __( 'pas trouvé', 'text_domain' ),
		'not_found_in_trash'  => __( 'rien dans la corbeille', 'text_domain' ),
	);
	$args = array(
		'label'               => __( 'Producteurs artistiques et Enseignants', 'text_domain' ),
		'description'         => __( 'Page de présentation', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields', 'page-attributes', 'post-formats', ),
		'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => true,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 3,
		'menu_icon'           => 'dashicons-welcome-learn-more',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,		
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'producteur', $args );
	*/

/* De Scène En Scène */
	$labels = array(
		'name'                => _x( 'De Scène En Scène', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'De Scène En Scène', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'De Scène En Scène', 'text_domain' ),
		'name_admin_bar'      => __( 'De Scène En Scène', 'text_domain' ),
		'parent_item_colon'   => __( 'Parent Item:', 'text_domain' ),
		//'all_items'           => __( 'Tous', 'text_domain' ),
		'add_new_item'        => __( 'Créer le profil', 'text_domain' ),
		//'add_new'             => __( 'Créer', 'text_domain' ),
		//'new_item'            => __( 'Nouveau', 'text_domain' ),
		'edit_item'           => __( 'Modifier le profil', 'text_domain' ),
		'update_item'         => __( 'Mettre à jour', 'text_domain' ),
		'view_item'           => __( 'Aperçu', 'text_domain' ),
		'search_items'        => __( 'Chercher', 'text_domain' ),
		'not_found'           => __( 'Pas trouvé', 'text_domain' ),
		'not_found_in_trash'  => __( 'Rien dans la corbeille', 'text_domain' ),
	);
	$args = array(
		'label'               => __( 'DSES', 'text_domain' ),
		'description'         => __( 'V', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields', 'page-attributes', 'post-formats', ),
		'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => true,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_icon'           => 'dashicons-money',
		'menu_position'       => 5,
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,		
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'dses', $args );

/* Les productions */
	$labels = array(
		'name'                => _x( 'productions', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'production', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'Les Prods', 'text_domain' ),
		'name_admin_bar'      => __( 'Prod', 'text_domain' ),
		'parent_item_colon'   => __( 'Voir au-dessus :', 'text_domain' ),
		'all_items'           => __( 'Toutes les Prod', 'text_domain' ),
		'add_new_item'        => __( 'Remplir tous les champs et créer une page d\'une production', 'text_domain' ),
		'add_new'             => __( 'Nouveau', 'text_domain' ),
		'new_item'            => __( 'Nouvelle', 'text_domain' ),
		'edit_item'           => __( 'Modifier la production ', 'text_domain' ),
		'update_item'         => __( 'Mettre à jour', 'text_domain' ),
		'view_item'           => __( 'Aperçu', 'text_domain' ),
		'search_items'        => __( 'chercher une Prod', 'text_domain' ),
		'not_found'           => __( 'pas trouvée', 'text_domain' ),
		'not_found_in_trash'  => __( 'rien dans la corbeille', 'text_domain' ),
	);
	$args = array(
		'label'               => __( 'productions', 'text_domain' ),
		'description'         => __( 'Page de présentation des productions', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields', 'page-attributes', 'post-formats', ),
		'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => true,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-megaphone',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,		
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
	);
	register_post_type( 'production', $args );
/* Les enseignants */

$labels = array(
		'name'                => _x( 'Groupe Enseignants', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'Groupe Enseignants', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'Groupes Enseignants', 'text_domain' ),
		'name_admin_bar'      => __( 'Groupe Enseignants', 'text_domain' ),
		'parent_item_colon'   => __( 'Voir au-dessus :', 'text_domain' ),
		'all_items'           => __( 'Tous les groupes', 'text_domain' ),
		'add_new_item'        => __( 'Créer un profil', 'text_domain' ),
		'add_new'             => __( 'Nouveau', 'text_domain' ),
		'new_item'            => __( 'Nouveau', 'text_domain' ),
		'edit_item'           => __( 'Modifier votre profil enseignant', 'text_domain' ),
		'update_item'         => __( 'Mettre à jour', 'text_domain' ),
		'view_item'           => __( 'Voir', 'text_domain' ),
		'search_items'        => __( 'chercher un enseigant', 'text_domain' ),
		'not_found'           => __( 'pas trouvé', 'text_domain' ),
		'not_found_in_trash'  => __( 'rien dans la corbeille', 'text_domain' ),
	);
	$args = array(
		'label'               => __( 'enseignants', 'text_domain' ),
		'description'         => __( 'Page de présentation', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields', 'page-attributes', 'post-formats', ),
		'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => true,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-welcome-learn-more',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,		
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
	);
	register_post_type( 'enseignant', $args );

	
}

// Hook into the 'init' action
add_action( 'init', 'custom_post_type', 0 );

?>