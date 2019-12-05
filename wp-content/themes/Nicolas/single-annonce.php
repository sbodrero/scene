<?php get_header(); ?>
	<?php
		// Check and get Sidebar Class
		$sidebar = get_post_meta($post->ID,'post-option-sidebar-template',true);
		if( empty($sidebar) ){
			global $default_post_sidebar;
			$sidebar = $default_post_sidebar; 
		}
		$sidebar_array = gdl_get_sidebar_size( $sidebar );

		// Translator words
		if( $gdl_admin_translator == 'enable' ){
			$translator_about_author = get_option(THEME_SHORT_NAME.'_translator_about_author', 'About the Author');
			$translator_social_share = get_option(THEME_SHORT_NAME.'_translator_social_shares', 'Social Share');
		}else{
			$translator_about_author = __('About the Author','gdl_front_end');
			$translator_social_share = __('Social Share','gdl_front_end');
		}
	?>
	<div class="page-wrapper single-blog <?php echo $sidebar_array['sidebar_class']; ?>">
		<?php
			global $left_sidebar, $right_sidebar, $default_post_left_sidebar, $default_post_right_sidebar;
			$left_sidebar = get_post_meta( $post->ID , "post-option-choose-left-sidebar", true);
			$right_sidebar = get_post_meta( $post->ID , "post-option-choose-right-sidebar", true);
			if( empty( $left_sidebar )){ $left_sidebar = $default_post_left_sidebar; } 
			if( empty( $right_sidebar )){ $right_sidebar = $default_post_right_sidebar; } 
			
			global $blog_single_size, $sidebar_type;
			$item_size = $blog_single_size[$sidebar_type];
			
			// starting the content
		?>
			<div>
    <p><i>Vous souhaitez partagez ce contenu avec vos amis ? Alors cliquez ci-dessous :</i></p>
    <div>
        <a target="_blank" title="Twitter" href="https://twitter.com/share?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>&via=DeScèneEnScène" rel="nofollow" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=700');return false;"><img src="http://desceneenscene.fr/ng-19-02/wp-content/themes/desceneenscene/images/twitter_icon.png" alt="Twitter" /></a>
        <a target="_blank" title="Facebook" href="https://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>&t=<?php the_title(); ?>" rel="nofollow" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=500,width=700');return false;"><img src="http://desceneenscene.fr/ng-19-02/wp-content/themes/desceneenscene/images/facebook_icon.png" alt="Facebook" /></a>
        <a target="_blank" title="Google +" href="https://plus.google.com/share?url=<?php the_permalink(); ?>&hl=fr" rel="nofollow" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=450,width=650');return false;"><img src="http://desceneenscene.fr/ng-19-02/wp-content/themes/desceneenscene/images/gplus_icon.png" alt="Google Plus" /></a>
        <a target="_blank" title="Linkedin" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=<?php the_title(); ?>" rel="nofollow" onclick="javascript:window.open(this.href, '','menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=450,width=650');return false;"><img src="http://desceneenscene.fr/ng-19-02/wp-content/themes/desceneenscene/images/linkedin_icon.png" alt="Linkedin" /></a>
        <a target="_blank" title="Envoyer par mail" href="mailto:?subject=<?php the_title(); ?>&body=<?php the_permalink(); ?>" rel="nofollow"><img src="http://desceneenscene.fr/ng-19-02/wp-content/themes/desceneenscene/images/email_icon.png" alt="email" /></a>
    </div>
    
</div>

		<?php
			echo '<div class="row">';
			echo '<div class="gdl-page-left ' . $sidebar_array['page_left_class'] . '">';
			
			echo '<div class="row">';
			echo '<div class="gdl-page-item  mb20 gdl-blog-full ' . $sidebar_array['page_item_class'] . '">';
			if ( have_posts() ){
				while (have_posts()){
					the_post();

					// blog title
				//	echo '<h1 class="blog-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h1>';
					
					// blog information
				/*	echo '<div class="blog-info-wrapper">';
					
					echo '<div class="blog-date-wrapper">';
					echo '<a href="' . get_day_link( get_the_time('Y'), get_the_time('m'), get_the_time('d')) . '" >';
					echo get_the_time($date_format);
					echo '</a>';
					echo '</div>';
					
					echo '<div class="blog-author">';
					echo the_author_posts_link();
					echo '</div>';	
					
					echo '<div class="blog-comment">';
					comments_popup_link( __('0','gdl_front_end'),
						__('1','gdl_front_end'),
						__('%','gdl_front_end'), '',
						__('Off','gdl_front_end') );
					echo '</div>';		
					
					$tags_opening = '<div class="blog-tag">';
					$tags_ending = '</div>';
					the_tags( $tags_opening, ', ', $tags_ending );					
					echo '<div class="clear"></div>';
					echo '</div>'; // blog information
*/
					
					echo '<div class="blog-content-wrapper">';
					
					// blog thumbnail
					print_single_blog_thumbnail( get_the_ID(), $item_size );
					
					// blog rating
					echo '<div class="clear"></div>';
					print_post_rating( get_post_meta(get_the_ID(), 'post-option-rating', true) );
					
					// blog content
					echo '<div class="blog-content">';
					the_content();
					wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'gdl_front_end' ) . '</span>', 'after' => '</div>' ) );
					echo '<div class="clear"></div>';
					echo '</div>';
					
					//annonces
					
					$custom_terms = get_terms('annonce');

foreach($custom_terms as $custom_term) {
    wp_reset_query();
    $args = array('post_type' => 'post',
        'tax_query' => array(
            array(
                'taxonomy' => 'annonce',
                'field' => 'slug',
                'terms' => $custom_term->slug,
            ),
        ),
     );

     $loop = new WP_Query($args);
     if($loop->have_posts()) {
        echo '<h2>'.$custom_term->name.'</h2>';

        while($loop->have_posts()) : $loop->the_post();
            echo '<a href="'.get_permalink().'">'.get_the_title().'</a>' .'<br/>';
        endwhile;
     }
}
					// About Author
					if(get_post_meta($post->ID, 'post-option-author-info-enabled', true) != "No"){
						echo "<div class='about-author-wrapper'>";
						echo "<div class='about-author-avartar'>" . get_avatar( get_the_author_meta('ID'), 90 ) . "</div>";
						echo "<div class='about-author-info'>";
						echo "<h5 class='about-author-title'>" . $translator_about_author . "</h5>";
						echo get_the_author_meta('description');
						echo "</div>";
						echo "<div class='clear'></div>";
						echo "</div>";
					}
				
					echo '<div class="comment-wrapper">';
					comments_template(); 
					echo '</div>';
					
					echo '</div>'; // blog content wrapper
				}
			}
			echo "</div>"; // end of gdl-page-item
			
			get_sidebar('left');	
			echo '<div class="clear"></div>';			
			echo "</div>"; // row
			echo "</div>"; // gdl-page-left

			get_sidebar('right');
			echo '<div class="clear"></div>';
			echo "</div>"; // row
		?>
		<div class="clear"></div>
	</div> <!-- page wrapper -->

<?php get_footer(); ?>
