<?php

	/*
	*	Goodlayers Blog Item File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		Goodlayers
	* 	@link		http://goodlayers.com
	* 	@copyright	Copyright (c) Goodlayers
	*	---------------------------------------------------------------------
	*	This file contains the function that can print each blog item due to 
	*	different conditions.
	*	---------------------------------------------------------------------
	*/
	
	// Print blog item
	function print_blog_item($item_xml){
		print_item_header( find_xml_value($item_xml, 'header') );
	
		global $paged, $sidebar_type, $blog_div_size_num_class;
		
		if(empty($paged)){ $paged = (get_query_var('page')) ? get_query_var('page') : 1; }
		
		// get the item class and size from array
		$blog_rating = (find_xml_value($item_xml, 'show-rating') == 'Yes')? true: false;
		$item_type = find_xml_value($item_xml, 'item-size');
		$item_class = $blog_div_size_num_class[$item_type]['class'];
		$item_size = $blog_div_size_num_class[$item_type][$sidebar_type];
				
		// get the blog meta value		
		$num_fetch = find_xml_value($item_xml, 'num-fetch');
		$num_excerpt = find_xml_value($item_xml, 'num-excerpt');
		$full_content = find_xml_value($item_xml, 'show-full-blog-post');
		
		$category = find_xml_value($item_xml, 'category');
		$category = ( $category == 'All' )? '': $category;

		$order = find_xml_value($item_xml, 'order');
		$orderby = find_xml_value($item_xml, 'orderby');		
		
		// start fetching database
		query_posts(array('post_type'=>'post', 'paged'=>$paged, 'order'=>$order, 'orderby'=>$orderby,
			 'category_name'=>$category, 'posts_per_page'=>$num_fetch  ));		
		
		// printing each blog function
		echo '<div class="blog-item-holder">';
		if( $item_type == '1/4 Blog Grid Style' ){
			print_blog_grid($item_class, $item_size, $num_excerpt, $full_content, '1/4', $blog_rating);
		}else if( $item_type == '1/3 Blog Grid Style' ){
			print_blog_grid($item_class, $item_size, $num_excerpt, $full_content, '1/3', $blog_rating);
		}else if( $item_type == '1/2 Blog Grid Style' ){
			print_blog_grid($item_class, $item_size, $num_excerpt, $full_content, '1/2', $blog_rating);
		}else if( $item_type == '1/1 Blog Grid Style' ){
			print_blog_grid($item_class, $item_size, $num_excerpt, $full_content, '1/1', $blog_rating);
		}else if( $item_type == '1/1 Medium Thumbnail' ){
			print_blog_medium($item_class, $item_size, $num_excerpt, $full_content, $blog_rating);
		}else if( $item_type == '1/1 Medium Thumbnail With Bullet' ){
			print_blog_medium_bullet($item_class, $item_size, $num_excerpt, $full_content, $blog_rating);
		}else if( $item_type == 'Blog List Style' ){
			print_blog_list($item_class, $item_size, $blog_rating);
		}else if( $item_type == 'Blog Grid List Style' ){
			$wrapper_size = find_xml_value($item_xml, 'size');
			if( $wrapper_size == 'element1-4' ){
				$item_size2 = $blog_div_size_num_class['1/4 Blog Grid Style'][$sidebar_type];;
			}else if( $wrapper_size == 'element1-3' ){
				$item_size2 = $blog_div_size_num_class['1/3 Blog Grid Style'][$sidebar_type];;
			}else if( $wrapper_size == 'element1-2' ){
				$item_size2 = $blog_div_size_num_class['1/2 Blog Grid Style'][$sidebar_type];;
			}else if( $wrapper_size == 'element1-1' ){
				$item_size2 = $blog_div_size_num_class['1/1 Blog Grid Style'][$sidebar_type];;
			}
			print_blog_grid_list($item_class, $item_size2, $item_size, $num_excerpt, $full_content, '1/4', $blog_rating);
		}
		echo '</div>';
		
		echo '<div class="clear"></div>';
		if( find_xml_value($item_xml, "pagination") == "Yes" ){	
			pagination();
		}	
		
		wp_reset_query();
	}	
	
	// print the blog thumbnail
	function print_blog_thumbnail( $post_id, $item_size ){
		$thumbnail_types = get_post_meta( $post_id, 'post-option-thumbnail-types', true);
		
		if( $thumbnail_types == "Image" || empty($thumbnail_types) ){
			$thumbnail_id = get_post_thumbnail_id( $post_id );
			$thumbnail = wp_get_attachment_image_src( $thumbnail_id , $item_size );
			$alt_text = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);
			if( !empty($thumbnail) ){
				echo '<div class="blog-media-wrapper gdl-image">';
				echo '<a href="' . get_permalink() . '"><img src="' . $thumbnail[0] .'" alt="'. $alt_text .'"/></a>';
				echo '</div>';	// blog-media-wrapper
			}
		}else if( $thumbnail_types == "Video" ){
			$video_link = get_post_meta( $post_id, 'post-option-thumbnail-video', true); 
			echo '<div class="blog-media-wrapper gdl-video">';
			echo get_video($video_link, gdl_get_width($item_size), gdl_get_height($item_size));
			echo '</div>';	// blog-media-wrapper
		}else if ( $thumbnail_types == "Slider" ){
			$slider_xml = get_post_meta( $post_id, 'post-option-thumbnail-xml', true); 
			$slider_xml_dom = new DOMDocument();
			$slider_xml_dom->loadXML($slider_xml);
			echo '<div class="blog-media-wrapper gdl-slider">';
			echo print_flex_slider($slider_xml_dom->documentElement, $item_size);
			echo '</div>';	// blog-media-wrapper
		}else if ( $thumbnail_types == "HTML5 Video" ){
			$video = get_post_meta( $post_id, 'post-option-thumbnail-html5-video', true); 
			echo '<div class="blog-media-wrapper gdl-html5-video">';
			get_html5_video($video);
			echo '</div>';	// blog-media-wrapper		
		}	
	}
	
	// print the blog thumbnail
	function print_single_blog_thumbnail( $post_id, $item_size ){
		$thumbnail_types = get_post_meta( $post_id, 'post-option-inside-thumbnail-types', true);
		
		if( $thumbnail_types == "Image" || empty($thumbnail_types) ){
			$thumbnail_id = get_post_meta( $post_id, 'post-option-inside-thumbnial-image', true);
			$thumbnail = wp_get_attachment_image_src( $thumbnail_id , $item_size );
			$thumbnail_full = wp_get_attachment_image_src( $thumbnail_id , 'full' );
			$alt_text = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);
			if( !empty($thumbnail) ){
				echo '<div class="blog-media-wrapper gdl-image">';
				echo '<a href="' . $thumbnail_full[0] . '" data-rel="fancybox" title="' . get_the_title() . '">';
				echo '<img src="' . $thumbnail[0] .'" alt="'. $alt_text .'"/>';
				echo '</a>';
				echo '</div>';	// blog-media-wrapper
			}
		}else if( $thumbnail_types == "Video" ){
			$video_link = get_post_meta( $post_id, 'post-option-inside-thumbnail-video', true);
			echo '<div class="blog-media-wrapper gdl-video">';
			echo get_video($video_link, gdl_get_width($item_size), gdl_get_height($item_size));
			echo '</div>';	// blog-media-wrapper
		}else if ( $thumbnail_types == "Slider" ){
			$slider_xml = get_post_meta( $post_id, 'post-option-inside-thumbnail-xml', true);
			$slider_xml_dom = new DOMDocument();
			$slider_xml_dom->loadXML($slider_xml);
			echo '<div class="blog-media-wrapper gdl-slider">';
			echo print_flex_slider($slider_xml_dom->documentElement, $item_size);
			echo '</div>';	// blog-media-wrapper
		}else if ( $thumbnail_types == "HTML5 Video" ){
			$video = get_post_meta( $post_id, 'post-option-inside-thumbnail-html5-video', true); 
			echo '<div class="blog-media-wrapper gdl-html5-video">';
			get_html5_video($video);
			echo '</div>';	// blog-media-wrapper		
		}		
	}	
	
	// print blog grid style
	function print_blog_grid( $item_class, $item_size, $num_excerpt, $full_content, $blog_size = '1/4', $blog_rating ){
		global $gdl_admin_translator, $date_format, $more;
		
		$blog_row_size = 0;
		if( $full_content == 'Yes' ){ $more = 0; }
		
		if( $gdl_admin_translator == 'enable' ){
			$translator_continue_reading = get_option(THEME_SHORT_NAME.'_translator_continue_reading', 'Read More');
		}else{
			$translator_continue_reading = __('Read More','gdl_front_end');
		}	
		
		while( have_posts() ){ the_post();
		?>
			
			<div class="three columns gdl-blog-grid">
					<div class="blog-content-wrapper">
						<div class="blog-media-wrapper gdl-image" style="height:120px;">
							<!-- affichage image à la une ou Avatar-->
					<?php
					$url = "http://www.desceneenscene.fr/wp-content/themes/desceneenscene/images"; 
					if ( has_post_thumbnail() ) {?>

						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
							
					<?php
					}
					else {?>
						<a href="<?php the_permalink(); ?>"><?php echo "<img src='" .$url. "/avatar-dif.png' />"; ?></a>
					<?php
					}
					?> 
					<!-- fin affichage image à la une ou Avatar-->

						</div>
						<div class="blog-context-wrapper" style="height:150px;">
							<h2 class="blog-title">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h2>
							<div class="blog-info-wrapper">
								<div class="clear"></div>
							</div>
								<a class="blog-continue-reading" href="<?php echo the_permalink(); ?>"> En savoir plus</a>
								<div class="clear"></div>
						</div>
						<div class="clear"></div>
					</div>
	</div>
	<?php
		}	
		echo '</div>'; // row
	}
	
	// print blog list style
	function print_blog_list( $item_class, $item_size, $blog_rating ){
		global $gdl_admin_translator, $date_format;
		
		$blog_row_size = 0;

		while( have_posts() ){ the_post();

			echo '<div class="' . $item_class . '" >';
			echo '<div class="blog-content-wrapper">';
			
			// blog thumbnail
			print_blog_thumbnail( get_the_ID(), $item_size );
			
			echo '<div class="blog-context-wrapper">';
			// blog title
			echo '<h2 class="blog-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';

			// blog information
			echo '<div class="blog-info-wrapper">';
			
			echo '<div class="blog-date-wrapper">';
			echo '<a href="' . get_day_link( get_the_time('Y'), get_the_time('m'), get_the_time('d')) . '" >';
			echo get_the_time($date_format);
			echo '</a>';
			echo '</div>';
			
			echo '<div class="blog-comment">';
			comments_popup_link( __('0','gdl_front_end'),
				__('1','gdl_front_end'),
				__('%','gdl_front_end'), '',
				__('Off','gdl_front_end') );
			echo '</div>';			

			echo '<div class="clear"></div>';
			if( $blog_rating ){
				print_post_rating( get_post_meta(get_the_ID(), 'post-option-rating', true) );
			}
			echo '</div>'; // blog information
			
			echo '</div>'; // blog-context-wrapper
			
			echo '<div class="clear"></div>';
			
			echo '</div>'; // blog-content-wrapper
			echo '</div>'; // blog-list-style
		}	
		
	}	

	// print blog grid list style
	function print_blog_grid_list( $item_class, $item_size, $list_size, $num_excerpt, $full_content, $blog_rating ){
		global $gdl_admin_translator, $date_format, $more;
		
		if( $full_content == 'Yes' ){ $more = 0; }
		
		if( $gdl_admin_translator == 'enable' ){
			$translator_continue_reading = get_option(THEME_SHORT_NAME.'_translator_continue_reading', 'Read More');
		}else{
			$translator_continue_reading = __('Read More','gdl_front_end');
		}	
		
		$item_num = 0;
		
		while( have_posts() ){ the_post();
			
			if( $item_num <= 0 ){
				echo '<div class="gdl-blog-grid mb10" >';
				echo '<div class="blog-content-wrapper">';
				
				// blog thumbnail
				print_blog_thumbnail( get_the_ID(), $item_size );
				
				echo '<div class="blog-context-wrapper">';
				// blog title
				echo '<h2 class="blog-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';

				// blog information
				echo '<div class="blog-info-wrapper">';
				
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
				
				// blog content
				echo '<div class="blog-content">';
				if( $full_content == "No" ){
					echo gdl_get_excerpt( $num_excerpt );
					echo '<div class="clear"></div>';
					echo '<a class="blog-continue-reading" href="' . get_permalink() . '"> ' . $translator_continue_reading . '</a>';
					if( $blog_rating ){
						print_post_rating( get_post_meta(get_the_ID(), 'post-option-rating', true) );
					}
					echo '<div class="clear"></div>';
				}else{
					the_content($translator_continue_reading);
				}
				echo '</div>';
				echo '</div>'; // blog-context-wrapper
				
				echo '<div class="clear"></div>';
				
				echo '</div>'; // blog-content-wrapper
				
				echo '</div>'; // blog-item class
			
			}else{
			
				echo '<div class="gdl-blog-list" >';
				echo '<div class="blog-content-wrapper">';
				
				// blog thumbnail
				print_blog_thumbnail( get_the_ID(), $list_size );
				
				echo '<div class="blog-context-wrapper">';
				// blog title
				echo '<h2 class="blog-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';

				// blog information
				echo '<div class="blog-info-wrapper">';
				
				echo '<div class="blog-date-wrapper">';
				echo '<a href="' . get_day_link( get_the_time('Y'), get_the_time('m'), get_the_time('d')) . '" >';
				echo get_the_time($date_format);
				echo '</a>';
				echo '</div>';
				
				echo '<div class="blog-comment">';
				comments_popup_link( __('0','gdl_front_end'),
					__('1','gdl_front_end'),
					__('%','gdl_front_end'), '',
					__('Off','gdl_front_end') );
				echo '</div>';			

				echo '<div class="clear"></div>';
				if( $blog_rating ){
					print_post_rating( get_post_meta(get_the_ID(), 'post-option-rating', true) );
				}
				echo '</div>'; // blog information
				
				echo '</div>'; // blog-context-wrapper
				
				echo '<div class="clear"></div>';
				
				echo '</div>'; // blog-content-wrapper
				echo '</div>'; // blog-list-style			
				
			}

			$item_num++;
		}	

	}
	
	// print blog medium thumbnail type
	function print_blog_medium( $item_class, $item_size, $num_excerpt, $full_content, $blog_rating ){
		global $gdl_admin_translator, $date_format, $more;
		
		if( $full_content == 'Yes' ){ $more = 0; }
		
		if( $gdl_admin_translator == 'enable' ){
			$translator_continue_reading = get_option(THEME_SHORT_NAME.'_translator_continue_reading', 'Read More');
		}else{
			$translator_continue_reading = __('Read More','gdl_front_end');
		}	

		while( have_posts() ){
			the_post();

			echo '<div class="' . $item_class . '">'; 	

			echo '<div class="blog-content-wrapper">';
			
			// blog thumbnail
			print_blog_thumbnail( get_the_ID(), $item_size );
			
			echo '<div class="blog-context-wrapper">';
			// blog title
			echo '<h2 class="blog-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';

			// blog information
			echo '<div class="blog-info-wrapper">';
			
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
			
			// blog content
			echo '<div class="blog-content">';
			if( $full_content == "No" ){
				echo gdl_get_excerpt( $num_excerpt, '... ' );
				echo '<div class="clear"></div>';
				echo '<a class="blog-continue-reading" href="' . get_permalink() . '"> ' . $translator_continue_reading . '</a>';
				if( $blog_rating ){
					print_post_rating( get_post_meta(get_the_ID(), 'post-option-rating', true) );
				}
				echo '<div class="clear"></div>';
			}else{
				the_content($translator_continue_reading);
			}
			echo '</div>';
			echo '</div>'; // blog-context-wrapper
			
			echo '<div class="clear"></div>';
			
			echo '</div>'; // blog-content-wrapper
			
			echo '</div>'; // blog-item
		
		}
		
	}
	
	// print blog medium thumbnail type
	function print_blog_medium_bullet( $item_class, $item_size, $num_excerpt, $full_content, $blog_rating ){
		global $gdl_admin_translator, $date_format, $more;
		
		$item_num = 0;
		if( $full_content == 'Yes' ){ $more = 0; }
		
		if( $gdl_admin_translator == 'enable' ){
			$translator_continue_reading = get_option(THEME_SHORT_NAME.'_translator_continue_reading', 'Read More');
		}else{
			$translator_continue_reading = __('Read More','gdl_front_end');
		}	

		while( have_posts() ){ the_post();
			
			if( $item_num == 0 ){
				echo '<div class="' . $item_class . ' blog-bullet">'; 	
				echo '<div class="blog-content-wrapper">';
				
				// blog thumbnail
				print_blog_thumbnail( get_the_ID(), $item_size );
				
				echo '<div class="blog-context-wrapper">';
				// blog title
				echo '<h2 class="blog-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';

				// blog information
				echo '<div class="blog-info-wrapper">';
				
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
				
				// blog content
				echo '<div class="blog-content">';
				if( $full_content == "No" ){
					echo gdl_get_excerpt( $num_excerpt, '... ' );
					echo '<div class="clear"></div>';
					echo '<a class="blog-continue-reading" href="' . get_permalink() . '"> ' . $translator_continue_reading . '</a>';
					if( $blog_rating ){
						print_post_rating( get_post_meta(get_the_ID(), 'post-option-rating', true) );
					}
					echo '<div class="clear"></div>';
				}else{
					the_content($translator_continue_reading);
				}
				echo '</div>';
				echo '</div>'; // blog-context-wrapper
				
				echo '<div class="clear"></div>';
				
				echo '</div>'; // blog-content-wrapper
				echo '</div>'; // blog-item
				
				echo '<div class="blog-bullet-wrapper">';
			}else{

				echo '<div class="blog-bullet-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></div>';
				if( $item_num % 2 == 0 ){ echo '<div class="clear"></div>'; }
			}
			
			$item_num++;
		}
		echo '<div class="clear"></div>';
		echo '</div>'; // blog-bullet-wrapper
	}	
	
?>