<?php
/* This general search will find matches within event_name, event_notes, and the location_name, address, town, state and country. */ 
$args = !empty($args) ? $args:array(); /* @var $args array */ 
?>
<!-- START General Search -->
<div class="em-search-text em-search-field">
	<input type="text" placeholder="Titre, lieu, etc.." name="em_search" class="em-events-search-text em-search-text" value="<?php echo esc_attr($args['search']); ?>" />

</div>
<!-- END General Search -->






