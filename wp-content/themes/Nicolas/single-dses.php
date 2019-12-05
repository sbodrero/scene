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
			echo '<div class="row">';
			echo '<div class="gdl-page-left ' . $sidebar_array['page_left_class'] . '">';
			
			echo '<div class="row">';
			echo '<div class="gdl-page-item  mb20 gdl-blog-full ' . $sidebar_array['page_item_class'] . '">';
			if ( have_posts() ){
				while (have_posts()){
					the_post();
					
									echo '<div class="blog-content-wrapper">';
					
					// blog thumbnail
					print_single_blog_thumbnail( get_the_ID(), $item_size );



					//affiche l'image à la une si elle est présente

					$image =  wp_get_attachment_image(get_post_meta($post->ID, _dses_info_image, true), full);
				
				

					
					if (!empty($image))	
						{
												 // check if the post has a Post Thumbnail assigned to it.
		?>
					
		<div class="blog-media-wrapper gdl-image" style="height:300px;">

			<?php
				echo $image;
			?>
		</div>

			<?php
						}
					else {
			?>
					
		<div class="blog-media-wrapper gdl-image" style="height:100px;"></div>

			<?php
						}// fin d'affichage de l'image à la une
					// blog content
					echo '<div class="blog-content">';
		?>
					<ul class="gdl-toggle-box">
						<li class="gdl-divider">
							<h2 class="toggle-box-head title-color gdl-title"> Le réseau des Arts Vivants</h2>
							<div class="toggle-box-content active">
								<?php
					the_content(); ?>
							</div>
						</li>
						<?php
						$titrerubrique2 =  get_post_meta($post->ID, '_dses_info_titrerubrique_2', true);
						$texterubrique2 =  get_post_meta($post->ID, '_dses_info_texterubrique_2', true);
						if ($texterubrique2 != "") {
						?>
						<li class="gdl-divider">
							<h2 class="toggle-box-head title-color gdl-title"><?php echo $titrerubrique2 ; ?>  </h2>
							<div class="toggle-box-content active">
								<?php	
								echo  wpautop($texterubrique2, true ); //ajoute <br/>
								?>
							</div>
						</li>
						<?php
						}else {}
	
				$titrerubrique3 =  get_post_meta($post->ID, '_dses_info_titrerubrique_3', true);
				$texterubrique3 =  get_post_meta($post->ID, '_dses_info_texterubrique_3', true);
						if ($titrerubrique3 != "") {?>
						<li class="gdl-divider">
							<h2 class="toggle-box-head title-color gdl-title"><?php echo $titrerubrique3 ; ?>  </h2>
							<div class="toggle-box-content active">
								<?php	
	
				
								echo  wpautop($texterubrique3, true ); //ajoute <br/>
											
								?>
							</div>
						</li>
						<?php } ?>
						<li class="gdl-divider">
							<h2 class="toggle-box-head title-color gdl-title">Le comité de pilotage du réseau des Arts Vivants</h2>
							<div class="toggle-box-content active">
							<?php 

						$equipe = get_post_meta($post->ID, _dses_info_equipe, true);
								if ($equipe) {
									echo  wpautop($equipe, true ); //ajoute <br/>
										}
								else {the_author(); echo ' n\'a pas encore rédigé de présentation de son équipe';}
								?>
							</div>
						</li>
					</ul>
					<?php
					wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'gdl_front_end' ) . '</span>', 'after' => '</div>' ) );
					echo '<div class="clear"></div>';
					echo '</div>';
					
					echo '</div>'; // blog content wrapper
				}
			}
			echo "</div>"; // end of gdl-page-item
			
			get_sidebar('left');	
			echo '<div class="clear"></div>';			
			echo "</div>"; // row
			echo "</div>"; // gdl-page-left
?>
<div class="four columns gdl-right-sidebar"><div class="sidebar-wrapper"><div class="custom-sidebar">
				<!--  Récuperer les valeurs dans des variables pour permetre laction au clic -->
				<?php
				global $post;
				$resp_legal =  get_post_meta($post->ID, _dses_info_resp_legal, true);
				$agitateur =  get_post_meta($post->ID, _dses_info_agit_artistique, true);
				$telephone =  get_post_meta($post->ID, _dses_info_telephone, true);
				//$image =  wp_get_attachment_image(get_post_meta($post->ID, _dses_info_image, true), full);
				$mail =  get_post_meta($post->ID, _dses_info_email, true);
				$facebook =  get_post_meta($post->ID, _dses_reseauxsociaux_facebook, true);
				$myspace =  get_post_meta($post->ID, _dses_reseauxsociaux_myspace, true);
				$googeplus =  get_post_meta($post->ID, _dses_reseauxsociaux_gplus, true);
				$linkedin =  get_post_meta($post->ID, _dses_reseauxsociaux_linkedin, true);
				$video =  get_post_meta($post->ID, _dses_reseauxsociaux_video, true);
				$site =  get_post_meta($post->ID, _dses_info_siteweb, true);
				$adresse =  get_post_meta($post->ID, _dses_info_adresse_rue, true). ' ' .get_post_meta($post->ID, _dses_info_adresse_ville, true). ' ' . get_post_meta($post->ID, _dses_info_adresse_cp, true);
				$prooupas =  get_post_meta($post->ID, _dses_info_statut, true);
				$partenaires_insitutionnels = get_post_meta($post->ID, '_dses_info_partenaires_insitutionnels', true);
				$url = get_template_directory_uri() . '/includes/images';
						
				?>
				<?php

				if ( has_post_thumbnail() ) {
				the_post_thumbnail();
				}
				else {
				echo "<img src='" .$url. "/avatar.png' />";
				}
				?> 
				<h2 style="margin-bottom:0px;"> <?php echo the_title(); ?></h2>
				<?php	
				
				/*if ($prooupas == "yes") { echo "professionnelle <br />"; } elseif ($prooupas == "no") { echo "non-professionnelle <br /> "; } ; */

				// début pronopro

				/*if ($prooupas == "yes"){
echo "<br />";

				wp_set_object_terms( $post->ID, 'Professionnel', 'professionnel', false );//Ajoute automatiquement la catégorie professionnel
				the_terms( $post->ID, 'professionnel', 'Statut : ' );

				}

				elseif($prooupas == "no"){
echo "<br />";
				wp_set_object_terms( $post->ID, 'Non professionnel', 'professionnel', false );//Ajoute automatiquement la catégorie non pro
				the_terms( $post->ID, 'professionnel', 'Statut : ' ); 

					}

				else{ }

				//fin pronopro*/

				// début affichage de la taxo : discipline

			$discipline = wp_get_post_terms($post->ID, 'discipline', array("fields" => "names"));
			if ( $discipline != null ){
echo "<br />";
				the_terms( $post->ID, 'discipline', 'Discipline(s) : ' );
				}
				else{}
/*$disciplines = get_post_meta($post->ID, '_enseignant_info_discipline', true);if ($disciplines != -1) {echo "Discipline : ";foreach ($disciplines as $discipline) {echo $discipline. ' - ' ;}}else {}*/// fin affichage de la taxo : discipline
					?>
				<ul class="infocompagnie">
				<li>
				<?php if($resp_legal != '') { ?> 				
				<h3 style="margin-top:20px;"> <?php echo $resp_legal; ?></h3>
				<?php } else {} ?> 
				<?php if($agitateur != '') { ?> 				
				<h3 style="margin-top:20px;"> <?php echo $agitateur; ?></h3>
				<?php } else {} ?> 
				</li>
				<!--<hr />-->
				<!--<ul class="infocompagnie">-->
					<li><img src="<?php echo $url; ?>/tel.png" title ="icon telephone">
						<?php if($telephone !='') 
							{	?> &nbsp; <?php
								echo $telephone; 
							}  
						   else {
								echo "Téléphone non renseigné";
							} 
						?> 
					</li>
					<li><img src="<?php echo $url; ?>/mail.png" title ="">
						<?php if($mail != '') 
							{ ?> &nbsp; <?php
								echo "<a href='mailto:" .$mail. "'>" .$mail. "</a>"; 
							} 
						   else { 
								echo "Mail non renseigné"; 
							} 
						?>
					</li>

					<li>
					<!--?php if(($facebook != '') && ($myspace != '') && ($googeplus != '') && ($linkedin != '') && ($video != '')){ 
							echo "Aucun réseau social renseigné";
							}?-->
						<?php if($facebook != '') 
								{ 
						?> 
								<a href=" <?php echo $facebook; ?> " alt="facebook <?php echo the_title(); ?>" ><img src="<?php echo $url; ?>/fb.png" title ="facebook <?php echo the_title(); ?>"> </a>
						<?php 
								} 
							else 
								{
						?>
								<img src="<?php echo $url; ?>/fbgris.png" title ="pas de compte facebook">
								
						<?php		} 
						?> 
						
						<?php if($myspace != '') { ?> 
							<a href=" <?php echo $myspace; ?> " alt="myspace <?php echo the_title(); ?>" target=_blank><img src="<?php echo $url; ?>/myspace.png" title ="myspace <?php echo the_title(); ?>"> </a>
						<?php } else {?>
								<img src="<?php echo $url; ?>/myspacegris.png" title ="pas de compte myspace">
								
						<?php		}  ?>	
						
						<?php if($googeplus != '') { ?> 
							<a href=" <?php echo $googeplus; ?> " alt="google plus <?php echo the_title(); ?>" target=_blank><img src="<?php echo $url; ?>/g+.png" title ="googe plus <?php echo the_title(); ?>"> </a>
						<?php } else {?>
								<img src="<?php echo $url; ?>/g+gris.png" title ="pas de compte g+">
								
						<?php		} ?>
						
						<?php if($linkedin != '') { ?> 
							<a href=" <?php echo $linkedin; ?> " alt="linkedin <?php echo the_title(); ?>" target=_blank><img src="<?php echo $url; ?>/linkedin.png" title ="linkedin <?php echo the_title(); ?>"> </a>
						<?php } else {?>
								<img src="<?php echo $url; ?>/linkedingris.png" title ="pas de compte linkedin">
								
						<?php		} ?>
											
						<?php if($video != '') { ?> 
							<a href="<?php echo $video; ?> " target="blank"  alt="chaine de <?php echo the_title(); ?>" target=_blank><img src="<?php echo $url; ?>/youtube.png" title ="youtube <?php echo the_title(); ?>"> </a>
						<?php } else {?>
								<img src="<?php echo $url; ?>/youtubegris.png" title ="pas de compte vidéo">
								
						<?php		} ?>
					</li>
					<li> 
                        <img src="<?php echo $url; ?>/web.png" title ="">&nbsp;
                        <?php					
					
						 if ($site != "") 
							{
								echo "<a href='" .$site. "' target=_blank >" .$site. "</a>"; 
							} 
						   else 
							{ 
								echo "Site Web non renseigné";
							}  
						?>                        
					</li>
					<li style="line-height:30px !important;">
								<img src="<?php echo $url; ?>/adresse.png" title ="">&nbsp;<?php 	
						if ($adresse != "") 
							{
								echo $adresse .'<br/>'; 
								echo $ville; 
							} 
						else 
							{ 
								echo "Adresse non renseignée";
							}  
						?>
					</li>
</li>
								<h4 style="margin-top:10px; margin-bottom:-60px;"> Partenaires institutionnels</h4>
								<?php
	get_sidebar('left');	
			echo '<div class="clear"></div>';			
			echo "</div>"; // row
			echo "</div>"; // gdl-page-left

			get_sidebar('right');
			echo '<div class="clear"></div>';
			echo "</div>"; // row

//echo '<div class="description">';
   // echo '<ul>';

								/*	foreach ($partenaires_insitutionnels as $partenaires_insitutionnel) {
									echo wp_get_attachment_image($partenaires_insitutionnel, array(50,50));
									echo '&nbsp;';
								}
echo '<div id="bg" class="popup_bg"></div>';
    //echo '</ul>';
    echo '<div class="cdiv">';
    echo '</div>';
    echo '<br>';
   // echo '</div>';*/
								?>
				</li></ul>
			<div class="clear"></div>
		
       <div class="clear"></div></div></div></div>

<?php			echo '<div class="clear"></div>';
			echo "</div>"; // row
			?>
			
		<div class="clear"></div>
	</div> <!-- page wrapper -->

<?php get_footer(); ?>
