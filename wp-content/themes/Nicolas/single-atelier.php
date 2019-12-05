<?php get_header(); ?>
	<?php


		wp_set_object_terms( $post->ID, 'Ateliers', 'category', false );//Ajoute automatiquement la catégorie atelier



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
    
</div>

		<?php
			
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

					$image =  wp_get_attachment_image(get_post_meta($post->ID, _atelier_info_image, true), full);
				
				

					
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
							<h2 class="toggle-box-head title-color gdl-title">Présentation </h2>
							<div class="toggle-box-content active">
								<?php
					if($post->post_content != ""){
					the_content(); 

									}

								else {the_author(); echo ' n\'a pas encore rédigé de présentation';}
								?>

							</div>
						</li>
						<li class="gdl-divider">
							<h2 class="toggle-box-head title-color gdl-title">Note d'intention </h2>
							<div class="toggle-box-content active">

									<?php 
				global $post;
				$noteintentions = get_post_meta($post->ID, '_atelier_info_note_intention', true);

						if ($noteintentions != "") {
									
									echo wpautop($noteintentions, true ); //ajoute <br/>
					
						}else {the_author(); echo ' n\'a pas encore rédigé de note d\'intention';}
									?>
							</div>
						</li>
						<li class="gdl-divider">
							<h2 class="toggle-box-head title-color gdl-title">Les horaires  </h2>
							<div class="toggle-box-content active">
							
								
								
								
								<?php 
				global $post;
				$dateatelier = get_post_meta($post->ID, '_atelier_info_dateatelier', true);

						if ($dateatelier != "") {
									
									echo wpautop($dateatelier, true ); //ajoute <br/>
					
						}else {the_author(); echo ' n\'a pas encore renseigné les horaires';}
									?>
								
								
								
								
							</div>
						</li>
						
						<li class="gdl-divider">
							<h2 class="toggle-box-head title-color gdl-title">Dossier de formation </h2>
								<div class="toggle-box-content active">
								<?php
								$dossier_formation = get_post_meta($post->ID, _atelier_info_dossier_formation, true);
								
								if ($dossier_formation != '') {?>
								
														
					<a href="<?php echo $dossier_formation ?>" target="blank" alt ="Dossier technique <?php echo the_title(); ?>"> <?php echo '<img src="'.get_icon_for_attachment($dossier_formation->ID).'" />   '?> </a> Dossier de formation de l'atelier : <?php the_title();?><br/>

								<?php 	}	


								
	 

							



									else {the_author(); echo ' n\'a pas encore téléchargé de dossier de formation pour son atelier : '; the_title();}
								
								
								
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
				$compagnie =  get_post_meta($post->ID, _atelier_info_compagnie, true);
				$public =  get_post_meta($post->ID, _atelier_info_public, true);
				$telephone =  get_post_meta($post->ID, _atelier_info_telephone, true);
				//$image =  wp_get_attachment_image(get_post_meta($post->ID, _atelier_info_image, true), full);
				$mail =  get_post_meta($post->ID, _atelier_info_email, true);
				$facebook =  get_post_meta($post->ID, _atelier_reseauxsociaux_facebook, true);
				$myspace =  get_post_meta($post->ID, _atelier_reseauxsociaux_myspace, true);
				$googeplus =  get_post_meta($post->ID, _atelier_reseauxsociaux_gplus, true);
				$linkedin =  get_post_meta($post->ID, _atelier_reseauxsociaux_linkedin, true);
				$video =  get_post_meta($post->ID, _atelier_reseauxsociaux_video, true);
				$site =  get_post_meta($post->ID, _atelier_info_siteweb, true);
				$adresse =  get_post_meta($post->ID, _atelier_info_adresse_rue, true);
				$ville =  get_post_meta($post->ID, _atelier_info_adresse_cp, true). ' ' . get_post_meta($post->ID, _atelier_info_adresse_ville, true);
				$prooupas =  get_post_meta($post->ID, _atelier_info_statut, true);
				$partenaires_insitutionnels = get_post_meta($post->ID, _atelier_info_partenaires_insitutionnels, true);
				$url = get_template_directory_uri() . 'includes/images';
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


				// début pro no pro

				if ($prooupas == "yes"){
echo "<br />";

				wp_set_object_terms( $post->ID, 'Professionnel', 'professionnel', false );//Ajoute automatiquement la catégorie professionnel
				the_terms( $post->ID, 'professionnel', 'Statut : ' );
				}

				elseif($prooupas == "no"){
echo "<br />";
				wp_set_object_terms( $post->ID, 'Non professionnel', 'professionnel', false );//Ajoute automatiquement la catégorie non pro
				the_terms( $post->ID, 'professionnel', 'Statut : ' ); 

					}

				else{}

				//fin pronopro
				
				echo "<br />";


					//affiche la taxo discipline
				the_terms( $post->ID, 'discipline', 'Discipline(s) : ' );


/*$disciplines = get_post_meta($post->ID, '_atelier_info_discipline', true);
if ($disciplines != -1) {
echo "Discipline : ";
foreach ($disciplines as $discipline) {
echo $discipline. ' - ' ;
}
}else {}*/
					
				
					echo "<br />";
					
					//affiche la taxo public
				the_terms( $post->ID, 'public', 'Public(s) : ' );


		
/*echo "Public : ";
if (is_array($public) || is_object($public)){
foreach ($public as $pub) {
echo ' - ' .$pub ;
}}
else 
{
echo "non renseigné";
}*/
					?>
				
			<!-- 	Affiche le nom de la compagnie avec son lien -->		
			
<?php			
			$hauteur = get_the_author_meta( 'ID');
	$query = 	array(
					'author' => $hauteur,
					'post_type' => 'enseignant',
					//'orderby' => 'date',
					//'s'       => $titreprod,
					//'category_name' => 'Spectacle',
		); 

										
			$requete = new WP_Query($query);
				if ( $requete->have_posts() ) { 
					while ( $requete->have_posts()  ) : $requete->the_post(); 
?> 
					<h3>	<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
<?php			
					endwhile;
					wp_reset_postdata();	
}
            
?>

			  <!-- 	fin Affiche le nom de la compagnie avec son lien -->


				<ul class="infocompagnie">
					<li><img src="<?php echo $url; ?>/tel.png" title ="">&nbsp;	
						<?php if($telephone !='')
							{
								echo $telephone; 
							} 
							else 
							{
								echo "Téléphone non renseigné";
							} 
						?> </li> 
				    <li><img src="<?php echo $url; ?>/mail.png" title ="">&nbsp;
						<?php  if($mail != '') 
							{     
								echo "<a href='mailto:" .$mail. "'>" .$mail. "</a>"; 
							} 
							else 
							{ 
								echo "Mail non renseigné"; 
							} 
						?></li>
					<li style="background:none !important;">

<!--?php if(($facebook != '') && ($myspace != '') && ($googeplus != '') && ($linkedin != '') && ($video != '')){ 
echo "Aucun réseau social renseigné";
}?-->
						<?php if($facebook != '') 
							{ 
						?> 
							<a href=" <?php echo $facebook; ?> " alt="facebook <?php echo the_title(); ?>" target=_blank><img src="<?php echo $url; ?>/fb.png" title ="facebook <?php echo the_title(); ?>"> </a>
							<?php 
							}
							else 
							{
						?>
								<img src="<?php echo $url; ?>/fbgris.png" title ="pas de compte facebook">
								
						<?php		
							} 
						?>  
						
						<?php if($myspace != '') 
							{ 
						?> 
							<a href=" <?php echo $myspace; ?> " alt="myspace <?php echo the_title(); ?>" target=_blank><img src="<?php echo $url; ?>/myspace.png" title ="myspace <?php echo the_title(); ?>"> </a>
						<?php 
							}
							else 
							{?>
								<img src="<?php echo $url; ?>/myspacegris.png" title ="pas de compte myspace">
								
						<?php	
							}
						?>	
						
						<?php if($googeplus != '') 
							{ 
						?> 
							<a href=" <?php echo $googeplus; ?> " alt="google plus <?php echo the_title(); ?>" target=_blank><img src="<?php echo $url; ?>/g+.png" title ="googe plus <?php echo the_title(); ?>"> </a>
						<?php 
							} 
							else 
							{?>
								<img src="<?php echo $url; ?>/g+gris.png" title ="pas de compte g+">
								
						<?php		
							} 
						?>
						
						<?php if($linkedin != '') 
							{ 
						?> 
							<a href=" <?php echo $linkedin; ?> " alt="linkedin <?php echo the_title(); ?>" target=_blank><img src="<?php echo $url; ?>/linkedin.png" title ="linkedin <?php echo the_title(); ?>"> </a>
						<?php 
							} 
							else 
							{?>
								<img src="<?php echo $url; ?>/linkedingris.png" title ="pas de compte linkedin">
								
						<?php		
							} 
						?>
												
						<?php if($video != '') 
							{ ?> 
							<a href="<?php echo $video; ?> " target="blank"  alt="chaine de <?php echo the_title(); ?>" target=_blank><img src="<?php echo $url; ?>/youtube.png" title ="youtube <?php echo the_title(); ?>"> </a>
						<?php 
							} 
							else 
							{?>
								<img src="<?php echo $url; ?>/youtubegris.png" title ="pas de compte vidéo">
								
						<?php		
							} 
						?>
					</li>
					<li> 
                        <img src="<?php echo $url; ?>/web.png" title ="">&nbsp;<?php
						 if ($site != "") 
							{
								echo "<a href='" .$site. "' target=_blank>" .$site. "</a>"; 
							} 
						   else 
							{ 
								echo "Site Web non renseigné";
							}  ?>
							
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
							}  ?>
					</li>
					
								<h4 style="margin-top:10px;"> Partenaires institutionnels</h4>
								<?php



//echo '<div class="description">';
   // echo '<ul>';

									foreach ($partenaires_insitutionnels as $partenaires_insitutionnel) {
									echo wp_get_attachment_image($partenaires_insitutionnel, array(50,50));
									echo '&nbsp;';
								}
echo '<div id="bg" class="popup_bg"></div>';
    //echo '</ul>';
    echo '<div class="cdiv">';
    echo '</div>';
    echo '<br>';
   // echo '</div>';

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
