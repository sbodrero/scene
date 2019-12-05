<?php
//////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
//////////   				placeholders #_DISCIPLINES
////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
add_filter('em_event_output_placeholder','my_em_disciplines_placeholders',1,3);
function my_em_disciplines1_placeholders($replace, $EM_Event, $result){
	global $wp_query, $wp_rewrite;
	switch( $result ){
		case '#_DISCIPLINES':
			$replace = '';
			$disciplines = wp_get_post_terms($EM_Event->post_id, 'discipline', array("fields" => "names"));
			if ( $disciplines != null ){
				foreach( $disciplines as $discipline ) {
				$styles[] = $discipline;
				}
				$replace = "<span style='font:italic 1.0em sans;'>Discipline(s) : </span> " .implode(", ", $styles). "";
			}
			break;
	}
	return $replace;
}
//////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
//////////   				placeholders #_DISCIPLINES1
////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
add_filter('em_event_output_placeholder','my_em_disciplines1_placeholders',1,3);
function my_em_disciplines_placeholders($replace, $EM_Event, $result){
	global $wp_query, $wp_rewrite;
	switch( $result ){
		case '#_DISCIPLINES1':
			$replace = '';
			$disciplines = wp_get_post_terms($EM_Event->post_id, 'discipline', array("fields" => "names"));
			if ( $disciplines != null ){
				foreach( $disciplines as $discipline ) {
				$styles[] = $discipline;
				}
				$replace = "" .implode(", ", $styles). "";
			}
			break;
	}
	return $replace;
}
//////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
//////////   				placeholders #_PUBLICS
////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
add_filter('em_event_output_placeholder','my_em_publics_placeholders',1,3);
function my_em_publics_placeholders($replace, $EM_Event, $result){
	global $wp_query, $wp_rewrite;
	switch( $result ){
		case '#_PUBLICS':
			$replace = '';
			$publics = wp_get_post_terms($EM_Event->post_id, 'public', array("fields" => "names"));
			if ( $publics != null ){
				foreach( $publics as $public ) {
				$styles[] = $public;
				}
				$replace = "<span style='font:italic 1.0em sans;'>Public : </span>" .implode(", ", $styles). "";
			}
			break;
	}
	return $replace;
}
//////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
//////////   				placeholders #_PUBLICS1
////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
add_filter('em_event_output_placeholder','my_em_publics1_placeholders',1,3);
function my_em_publics1_placeholders($replace, $EM_Event, $result){
	global $wp_query, $wp_rewrite;
	switch( $result ){
		case '#_PUBLICS1':
			$replace = '';
			$publics = wp_get_post_terms($EM_Event->post_id, 'public', array("fields" => "names"));
			if ( $publics != null ){
				foreach( $publics as $public ) {
				$styles[] = $public;
				}
				$replace = "" .implode(", ", $styles). "";
			}
			break;
	}
	return $replace;
}
//////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
//////////   placeholders #_PROOUPAS
////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
add_filter('em_event_output_placeholder','my_em_prooupas_placeholders',1,3);
function my_em_prooupas_placeholders($replace, $EM_Event, $result){
	global $wp_query, $wp_rewrite;
	switch( $result ){
		case '#_PROOUPAS':
			$replace = '';
			$prosoupas = wp_get_post_terms($EM_Event->post_id, 'professionnel', array("fields" => "names"));
			if ( $prosoupas != null ){
				foreach( $prosoupas as $prooupas ) {
				$styles[] = $prooupas;
				}
				$replace = "<span style='font:italic 1.0em sans;'>Statut : </span>" .implode(", ", $styles). "";
			}
			break;
	}
	return $replace;
}
//////////////////////////////////////////////////////////////////////////////////////////////
//		placeholders
///////////////////////////////////////////////////////////////////////////////////////////
add_filter('em_location_output_placeholder','my_em_placeholder_mod',1,3);
function my_em_placeholder_mod($replace, $EM_Location, $result){
	if ( $result == '#_LOCATIONPASTEVENTS' ) {
		$events_count = EM_Events::count( array('location'=>$EM_Location->location_id, 'scope'=>$scope) );
		if ( $events_count > 0 ){
					    $args = array('location'=>$EM_Location->location_id, 'scope'=>$scope, 'pagination'=>1, 'ajax'=>0);
					    $args['format_header'] = get_option('dbem_location_event_list_item_header_format');
					    $args['format_footer'] = get_option('dbem_location_event_list_item_footer_format');
					    $args['format'] = get_option('dbem_location_event_list_item_format');
						$args['limit'] = 2;
						$args['page'] = (!empty($_REQUEST['pno']) && is_numeric($_REQUEST['pno']) )? $_REQUEST['pno'] : 1;
						$args['orderby'] = "event_start_date";//ordre d'apparition
						$args['order'] ="DESC";
					    $replace = EM_Events::output($args);
					} else {
						$replace = get_option('dbem_location_no_events_message');
					}

	}
	return $replace;
}
 ?>