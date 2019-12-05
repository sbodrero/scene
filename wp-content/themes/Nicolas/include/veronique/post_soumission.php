<?php

 
// Ajouter une metabox et plusieurs champs

$posts = new Cuztom_Post_Type('simplr_reg_set&regview');


 
$posts->add_meta_box(
        'catégorie_event',
        'Choisir la catégorie',
        array(
                
		array(
			'name'          => 'name_post_checkboxes',
			'label'         => 'Post Checkboxes',
			'description'   => 'Post Checkboxes Description',
			'type'          => 'term_select',
			'args'       => array(
			  'child_of'         => '93',
					),
			'repeatable'    => true,
				    ),
		)
               
);
    
			
?>