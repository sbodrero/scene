<?php $args = !empty($args) ? $args:array(); /* @var $args array */ ?>

<div class="em-search-category em-search-field">
	<label><?php echo esc_html($args['category_label']); echo " :" ?></label>
	<?php 
		EM_Object::ms_global_switch(); //in case in global tables mode of MultiSite, grabs main site categories, if not using MS Global, nothing happens

echo "<br>" ;
		wp_dropdown_categories(
					array( 
						'hide_empty' => 0, 
						'orderby' =>'name', 
						//'name' => 'discipline', 
						'show_option_all' => 'Toutes catégories',
						'hierarchical' => true, 
						'taxonomy' => 'discipline', 
						//'selected' => $args['category'], 
						//'show_option_none' => $args['categories_label'], 
						'class'=>'em-events-search-category', 
						
						)
					);
echo "<br>" ;

echo "Public ";
echo "<br>" ;

		wp_dropdown_categories(
					array( 
						'hide_empty' => 0, 
						'order' =>'DESC', 
						'name' => 'public', 
						'show_option_all' => 'Toutes catégories',
						'hierarchical' => true, 
						'taxonomy' => 'public', 
						//'selected' => $args['category'], 
						//'show_option_none' => $args['categories_label'], 
						'class'=>'em-events-search-category', 
						
						
						)
					);

		EM_Object::ms_global_switch_back(); //if switched above, switch back


?>

</div>

<div style="visibility:hidden" >
	
	<?php 

//echo "Matière ";

		wp_dropdown_categories(
					array( 
						'hide_empty' => 0, 
						'orderby' =>'name', 
						'name' => 'category', 
						'hierarchical' => true, 
						//'taxonomy' => 'matieres', 
						'selected' => $args['category'], 
						//'show_option_none' => $args['categories_label'], 
						'class'=>'em-events-search-category', 
						'exclude_tree' => '245',
						//'exclude' => '245',
						'include' => '250'
						//'child_of'=>'193'
						
						)

					);

		EM_Object::ms_global_switch_back(); //if switched above, switch back
	?>


</div>
