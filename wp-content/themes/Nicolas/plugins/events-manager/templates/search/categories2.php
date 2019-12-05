<?php $args = !empty($args) ? $args:array(); /* @var $args array */ ?>

<style>
  .conditional_form_part {
    visibility: hidden;
  }
</style>
<div class="em-search-category em-search-field">
	<label><?php echo esc_html($args['category_label']); echo " :" ?></label>
	<?php 
		EM_Object::ms_global_switch(); //in case in global tables mode of MultiSite, grabs main site categories, if not using MS Global, nothing happens
echo "<br>" ;
		wp_dropdown_categories(
					array( 
						'hide_empty' => 0, 
						'orderby' =>'name', 
						//'name' => 'category', 
						'show_option_all' => 'Toutes catégories ',
						'hierarchical' => 0, 
						'taxonomy' => 'discipline', 
						'selected' => $args['category'], 
						//'show_option_none' => $args['categories_label'], 
						'class'=>'em-events-search-category', 
						)
					);
		EM_Object::ms_global_switch_back(); //if switched above, switch back

echo "<br>" ;

		echo "Public :";
echo "<br>" ;
EM_Object::ms_global_switch(); 

		wp_dropdown_categories(
					array( 
						'hide_empty' => 0, 
						'order' =>'DESC', 
						//'name' => 'category', 
						'show_option_all' => 'Toutes catégories ',
						'hierarchical' => 0, 
						'taxonomy' => 'public', 
						'selected' => $args['category'], 
						//'show_option_none' => $args['categories_label'], 
						'class'=>'em-events-search-category', 
						)
					);

		EM_Object::ms_global_switch_back(); //if switched above, switch back
?>

</div>

<div style="visibility:hidden" >
	<?php 
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
						'exclude' => '250',
						'include' => '245'
						//'child_of'=>'193',
						
						)
					);

		EM_Object::ms_global_switch_back(); //if switched above, switch back
	?>
</div>