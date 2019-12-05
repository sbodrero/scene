<?php get_header(); ?>
	<?php 
		// Check and get Sidebar Class
		$sidebar = get_post_meta($post->ID,'page-option-sidebar-template',true);
		$sidebar_array = gdl_get_sidebar_size( $sidebar );
	?>		
	<div class="page-wrapper single-page <?php echo $sidebar_array['sidebar_class']; ?>">
		<?php
			// Top Slider Part
			global $gdl_top_slider_type, $gdl_top_slider_xml;
			if( empty($gdl_top_slider_type) || $gdl_top_slider_type == "No Slider"  ){
			}else if( $gdl_top_slider_type == "Post Slider" ){
				$category = get_post_meta($post->ID, 'page-option-post-slider-category', true);
				if( $category == 'All' ) $category = '';
				
				$height = get_post_meta($post->ID, 'page-option-post-slider-height', true);
				$thumbnail = (get_post_meta($post->ID, 'page-option-post-slider-thumbnail', true) == 'Yes')? true: false;
				$num_excerpt = get_post_meta($post->ID, 'page-option-post-slider-excerpt-num', true);
				$num_fetch = get_post_meta($post->ID, 'page-option-post-slider-num-fetch', true);
				
				echo '<div class="row gdl-top-slider top-post-slider">';
				echo '<div class="twelve columns mb20">';				
				print_top_post_slider( $category, $height, $thumbnail, $num_excerpt, $num_fetch );
				echo '</div>'; // twelve columns
				echo '<div class="clear"></div>';
				echo '</div>'; // gdl-top-slider				
			}else{
				echo '<div class="row gdl-top-slider">';
				echo '<div class="twelve columns mb10">';
				$slider_xml = "<Slider>" . create_xml_tag('size', 'full-width');
				$slider_xml = $slider_xml . create_xml_tag('height', get_post_meta( $post->ID, 'page-option-top-slider-height', true) );
				$slider_xml = $slider_xml . create_xml_tag('width', 940);
				$slider_xml = $slider_xml . create_xml_tag('slider-type', $gdl_top_slider_type);
				$slider_xml = $slider_xml . $gdl_top_slider_xml;
				$slider_xml = $slider_xml . "</Slider>";
				$slider_xml_dom = new DOMDocument();
				$slider_xml_dom->loadXML($slider_xml);
				print_slider_item($slider_xml_dom->documentElement);
				echo '</div>';
				echo '<div class="clear"></div>';
				echo '</div>';
			}
			
			$left_sidebar = get_post_meta( $post->ID , "page-option-choose-left-sidebar", true);
			$right_sidebar = get_post_meta( $post->ID , "page-option-choose-right-sidebar", true);		
			
			echo '<div class="row">';
			echo '<div class="gdl-page-left mb0 ' . $sidebar_array['page_left_class'] . '">';
			
			echo '<div class="row">';
			echo '<div class="gdl-page-item mb20 ' . $sidebar_array['page_item_class'] . '">';

			// page content
			global $gdl_item_row_size;
			while (have_posts()){ 
				the_post(); 
				
				// print title
				$gdl_show_title = get_post_meta($post->ID, 'page-option-show-title', true);
				if( $gdl_show_title != 'No' ){
					print_page_header(get_the_title());
				}				

				// print content
				$gdl_show_content = get_post_meta($post->ID, 'page-option-show-content', true);
				if( $gdl_show_content != 'No' ){
					$content = get_the_content();
					$content = apply_filters('the_content', $content);
					if(empty($content)){
						$gdl_item_row_size = print_item_size( '1/1', $gdl_item_row_size ,'mb0');
					}else{
						$gdl_item_row_size = print_item_size( '1/1', $gdl_item_row_size);
					}				
					
					echo '<div class="gdl-page-content">';
					echo $content;
					wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'gdl_front_end' ) . '</span>', 'after' => '</div>' ) );
					echo '</div>';
					
					echo '</div>'; // print_item_size
				}
			}
			
			// Page Item Part
			if(!empty($gdl_page_xml) && !post_password_required()){
				$page_xml_val = new DOMDocument();
				$page_xml_val->loadXML($gdl_page_xml);
				foreach( $page_xml_val->documentElement->childNodes as $item_xml){
					if( $item_xml->nodeName == 'Title' || $item_xml->nodeName == 'Blog' || $item_xml->nodeName == 'Portfolio'){
						$additional_class = 'mb15';
					}else{
						$additional_class = '';
					}
					$gdl_item_row_size = print_item_size(find_xml_value($item_xml, 'size'), $gdl_item_row_size, $additional_class);
					switch($item_xml->nodeName){
						case 'Accordion' : print_accordion_item($item_xml); break;
						case 'Blog' : print_blog_item($item_xml); break;
						case 'Contact-Form' : print_contact_form($item_xml); break;
						case 'Column': print_column_item($item_xml); break;
						case 'Column-Service' : print_column_service($item_xml); break;
						case 'Content' : print_content_item($item_xml); break;
						case 'Divider' : print_divider($item_xml); break;
						case 'Gallery' : print_gallery_item($item_xml); break;								
						case 'Message-Box' : print_message_box($item_xml); break;
						case 'Page': print_page_item($item_xml); break;
						case 'Personnal': print_personnal_item($item_xml); break;							
						case 'Portfolio' : print_portfolio($item_xml); break;
						case 'Post-Slider' : print_post_slider_item($item_xml); break;
						case 'Price-Item': print_price_item($item_xml); break;						
						case 'Slider' : print_slider_item($item_xml); break;
						case 'Stunning-Text' : print_stunning_text($item_xml); break;
						case 'Tab' : print_tab_item($item_xml); break;
						case 'Testimonial' : print_testimonial($item_xml); break;
						case 'Title' : print_title_item($item_xml); break;
						case 'Toggle-Box' : print_toggle_box_item($item_xml); break;
						default: break;
					}
					echo "</div>"; // close column from print_item_size()
				}
			}
			echo '<div class="clear"></div>';
			echo "</div>"; // close row from print_item_size()
			echo "</div>"; // end of gdl-page-item
			
			get_sidebar('left');	
			echo '<div class="clear"></div>';			
			echo "</div>"; // row
			echo "</div>"; // gdl-page-left

			get_sidebar('right');
			echo '<div class="clear"></div>';
			echo "</div>"; // row
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





		<div class="clear"></div>
	</div> <!-- page wrapper -->
<?php get_footer(); ?>
