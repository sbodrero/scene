<?php
/***************************** 
*Add a custom Welcome Dashboard Panel
*****************************/
function my_welcome_panel() {
    ?>
    <!-- tests si est déjà auteur -->
    <?php 
	$hauteur = get_current_user_id();
	$query = 	array(
					'author' => $hauteur,
					'post_type' => 'production',
					'orderby' => 'date',
					'category_name' => ''
		); 

			$requete = new WP_Query($query);
				if ( $requete->have_posts() ) {$a_une_prod = true; }else{ $a_une_prod = false;} 
				
	$query = 	array(
					'author' => $hauteur,
					'post_type' => 'compagnie',
					'orderby' => 'date',
					'category_name' => ''
		); 

			$requete = new WP_Query($query);
				if ( $requete->have_posts() ) {$a_une_compagnie = true; }else{ $a_une_compagnie = false;} 	
				
	
	$query = 	array(
					'author' => $hauteur,
					'post_type' => 'atelier',
					'orderby' => 'date',
					'category_name' => ''
		); 

			$requete = new WP_Query($query);
				if ( $requete->have_posts() ) {$a_un_atelier = true; }else{ $a_un_atelier = false;} 
	
	
	$query = 	array(
					'author' => $hauteur,
					'post_type' => 'enseignant',
					'orderby' => 'date',
					'category_name' => ''
		); 

			$requete = new WP_Query($query);
				if ( $requete->have_posts() ) {$a_un_enseignant = true; }else{ $a_un_enseignant = false;} 

				
	$query = 	array(
					'author' => $hauteur,
					'post_type' => 'producteur',
					'orderby' => 'date',
					'category_name' => ''
		); 

			$requete = new WP_Query($query);
				if ( $requete->have_posts() ) {$a_un_mixte = true; }else{ $a_un_mixte = false;} 
				
				

				
	$query = 	array(
					'author' => $hauteur,
					'post_type' => 'location',
					'orderby' => 'date',
					'category_name' => ''
		); 

			$requete = new WP_Query($query);
				if ( $requete->have_posts() ) {$a_une_location = true; }else{ $a_une_location = false;} 
				
	
	$query = 	array(
					'author' => $hauteur,
					'post_type' => 'post',
					'orderby' => 'date',
					'category_name' => ''
		); 

			$requete = new WP_Query($query);
				if ( $requete->have_posts() ) {$a_une_annonce = true; }else{ $a_une_annonce = false;} 
				
				
				
	$query = 	array(
					'author' => $hauteur,
					'post_type' => 'event',
					'orderby' => 'date',
					'category_name' => 'spectacle'
		); 

			$requete = new WP_Query($query);
				if ( $requete->have_posts() ) {$a_un_evenement = true; }else{ $a_un_evenement = false;} 
	
	
	$query = 	array(
					'author' => $hauteur,
					'post_type' => 'event',
					'orderby' => 'date',
					'category_name' => 'stage'
		); 

			$requete = new WP_Query($query);
				if ( $requete->have_posts() ) {$a_un_stage = true; }else{ $a_un_stage = false;} 
	
	
	
	$query = 	array(
					'author' => $hauteur,
					'post_type' => 'artiste',
					'orderby' => 'date',
					'category_name' => ''
		); 

			$requete = new WP_Query($query);
				if ( $requete->have_posts() ) {$a_un_artiste = true; }else{ $a_un_artiste = false;} 
				
				
				
				?>
    
    <div class="top-welcome-panel-content">
    
    	<div class="top-welcome-panel-logo" style="height: 120px; padding: 5px; text-align: left;">
      	<!-- Adds a logo top left-->
      	<b>Conçu et réalisé par :</b><br /><a href="https://pcr-communication.fr" target="_blank" style="float: left;"><img src="https://pcr-communication.fr/pcr-ng-0219/wp-content/uploads/2018/11/logo-pcr-communication-agence1.png" title="PCR-Communication Agence de communication 360°"/></a>  <br />

    	
    	<!--<a href="http://advancedwp.org/" target="_blank" style="float: left; padding: 0 40px 20px 40px;"><img src="<?php echo plugins_url( '../assets/img/awp-logo.png', __FILE__) ?>" title="Advanced WordPress web page"/></a> Made by <br />
    	
    	<a href="http://wordpress.org" target="_blank"><img src="<?php echo plugins_url( '../assets/img/WordPress-logo.svg.png', __FILE__) ?>" title="The official home page for WordPress" style="padding: 0; margin: 0 auto;"/></a>-->
	</div>
	  	
    	<!-- using ?php_e makes the string/words translatable http://codex.wordpress.org/Function_Reference/_e -->
    	<div class="title-welcome-panel" style="margin: -50px 0 5px 0px;">
   		 	<h2><?php _e( 'Bienvenu(e) sur le site de "De Scène en Scène". ' ); ?><br /></h2>
   		</div>
  <?php if(current_user_can('contributor') && $a_une_compagnie != true  && $a_un_enseignant != true && $a_une_mixte != true && $a_une_location != true && $a_un_artiste != true){?>
		    <div class="welcome-panel-top">
  		  	 <p>Vous avez demandé à vous inscrire sur le site De Scène en Scène, voici les différentes étapes :</p>
  		  	 
  		  	 <ol>
  		  	 <li>En continuant votre démarche, vous confirmez avoir lu et accepté la <a href="http://www.desceneenscene.fr/charte-de-scene-en-scene/" alt="Charte Sociale du site" target="_blank">charte De Scène en Scène</a> </li>
  		  	 <li>Remplissez votre profil partiellement ou complètement (modifiable à tout moment)</li>
  		  	 <li>Soumettez votre profil</li>
  		  	 <li>Attendez sa validation par mail (2 à 4 jours maxi).<br/>
				Le cas échéant, il vous sera demandé votre cotisation annuelle.</li>
  		  	 <li>Après validation, complétez votre profil, vos productions, évènements ou annonces.</li>
  		  	 <li>Publiez</li>
  		  	 </ol>  		  	
   		  	 
   		  </div>
     	
<?php }?>
     	</div>
     	
     
    <div class="welcome-panel-column-container">
       
    <?php if(current_user_can('contributor') && $a_une_compagnie != true  && $a_un_enseignant != true && $a_une_mixte != true && $a_une_location != true && $a_un_artiste != true){?>



  <!-- Producteurs artistiques -->
<div class="welcome-panel-column welcome-panel-compagnie">
<a href="http://www.desceneenscene.fr/wp-admin/post-new.php?post_type=compagnie" title="Producteurs Artistiques/Techniciens" id="range-logo" align="center">
 <h1 align="center"; STYLE="text-decoration:underline"><?php _e( 'Producteurs artistiques/techniciens' ); ?></h1>
  <p> Vous êtes un groupe ou un artiste seul qui crée et se produit devant un public, <br/> ou bien vous créez des décors, des costumes ou des accessoires : vous pouvez enregistrer votre présentation, mettre en avant vos productions et diffuser vos évènements et annonces.</p>     				
</a>        	
<?php printf( '<div class="dashicons dashicons-admin-page">' . __( ' Créer votre <a href="%1$s">page</a>' ) . '</div>', admin_url( 'post-new.php?post_type=compagnie' ) ); ?>
       	
 </div>
 
 
  <!-- Enseignants -->
<div class="welcome-panel-column welcome-panel-enseignant">
<a href="http://www.desceneenscene.fr/wp-admin/post-new.php?post_type=enseignant" title="Enseignants" id="range-logo" align="center">
 <h1 align="center"; STYLE="text-decoration:underline"><?php _e( 'Enseignants' ); ?></h1>
 <p>Vous êtes un groupe ou un artiste seul et vous proposez des ateliers, des cours ou des stages dans le domaine des Arts Vivants : vous pouvez enregistrer votre présentation, mettre en avant les formations que vous  offrez et diffuser vos évènements et annonces.</p>				
</a>        	
<?php printf( '<div class="dashicons dashicons-admin-page">' . __( ' Créer votre <a href="%1$s">page</a>' ) . '</div>', admin_url( 'post-new.php?post_type=enseignant' ) ); ?>
       	
 </div>
 
 
 
 
 
 <!-- Espace de dif -->
<div class="welcome-panel-column welcome-panel-location">
<a href="http://www.desceneenscene.fr/wp-admin/post-new.php?post_type=location" title="Espaces de diffusion" id="range-logo" align="center">
 <h1 align="center"; STYLE="text-decoration:underline"><?php _e( 'Espaces de diffusion' ); ?></h1>
 <p>Vous représentez un lieu qui reçoit, même occasionnellement,  des spectacles d’Arts Vivants que vous proposez à un public : vous pouvez enregistrer une présentation de cet espace, diffuser vos évènements et annonces.</p>       				
</a>        	
<?php printf( '<div class="dashicons dashicons-admin-page">' . __( ' Créer votre <a href="%1$s">page</a>' ) . '</div>', admin_url( 'post-new.php?post_type=location' ) ); ?>
       	
 </div>
 
 
 <!-- Artistes techniciens -->
<div class="welcome-panel-column welcome-panel-artiste">
<a href="http://www.desceneenscene.fr/wp-admin/post-new.php?post_type=artiste" title="Artistes et techniciens déposez votre CV" id="range-logo" align="center">
 <h1 align="center"; STYLE="text-decoration:underline"><?php _e( 'CV Artistes et Techniciens' ); ?></h1>
 <p>Vous êtes un technicien ou un artiste qui ne se produit pas lui-même : vous pouvez enregistrer votre biographie, déposer votre CV et diffuser des annonces.</p>       				
</a>        	
<?php printf( '<div class="dashicons dashicons-admin-page">' . __( ' Créer votre <a href="%1$s">page</a>' ) . '</div>', admin_url( 'post-new.php?post_type=artiste' ) ); ?>
       	
 </div>
 
 </div>
 
 
 
 <!-- Producteurs artistiques && contributeur-->
 <?php 
 }elseif (current_user_can('contributor') && $a_une_compagnie == true && $a_un_enseignant != true && $a_une_location != true){?>
<div class="welcome-panel-column welcome-panel-compagnie">
<a href="http://www.desceneenscene.fr/wp-admin/edit.php?post_type=compagnie" title="Mettre à jour ma page" id="range-logo" align="center">
 <h1 align="center"; STYLE="text-decoration:underline"><?php _e( 'Producteurs artistiques/technicien' ); ?></h1></a>   
<?php printf( '<div class="dashicons dashicons-admin-post">' . __( ' Mettre à jour <a href="%1$s">ma page</a>' ) . '</div>', admin_url( 'edit.php?post_type=compagnie' ) ); ?>

<?php printf( '<div class="dashicons dashicons-admin-page">' . __( ' Créer votre profil <a href="%1$s">enseignant</a>' ) . '</div>', admin_url( 'post-new.php?post_type=enseignant' ) ); ?>
<?php printf( '<div class="dashicons dashicons-admin-page">' . __( ' Créer la page de <a href="%1$s">l\'espace de diffusion</a>' ) . '</div>', admin_url( 'post-new.php?post_type=location' ) ); ?>

</div>
 <!-- fin Producteurs artistiques && contributeur-->
 
 
  <!-- Enseignant && contributeur-->
 <?php 
 }elseif (current_user_can('contributor') && $a_un_enseignant == true && $a_une_compagnie != true && $a_une_location != true){?>
<div class="welcome-panel-column welcome-panel-enseignant">
<a href="http://www.desceneenscene.fr/wp-admin/edit.php?post_type=enseignant" title="Mettre à jour ma page" id="range-logo" align="center">
 <h1 align="center"; STYLE="text-decoration:underline"><?php _e( 'Enseignant' ); ?></h1></a>   
<?php printf( '<div class="dashicons dashicons-admin-post">' . __( ' Mettre à jour <a href="%1$s">ma page</a>' ) . '</div>', admin_url( 'edit.php?post_type=enseignant' ) ); ?>
<?php printf( '<div class="dashicons dashicons-admin-page">' . __( ' Créer votre profil <a href="%1$s">producteur artistique/technicien</a>' ) . '</div>', admin_url( 'post-new.php?post_type=compagnie' ) ); ?>
<?php printf( '<div class="dashicons dashicons-admin-page">' . __( ' Créer la page de <a href="%1$s">l\'espace de diffusion</a>' ) . '</div>', admin_url( 'post-new.php?post_type=location' ) ); ?>



</div>
 <!-- fin enseignant && contributeur-->
 
 
 
 <!-- location && contributeur-->
 <?php 
 }elseif (current_user_can('contributor') && $a_un_enseignant != true && $a_une_compagnie != true  && $a_une_location == true){?>
<div class="welcome-panel-column welcome-panel-location">
<a href="http://www.desceneenscene.fr/wp-admin/edit.php?post_type=location" title="Mettre à jour ma page" id="range-logo" align="center">
 <h1 align="center"; STYLE="text-decoration:underline"><?php _e( 'Espace de diffusion' ); ?></h1></a>   
<?php printf( '<div class="dashicons dashicons-admin-post">' . __( ' Mettre à jour <a href="%1$s">ma page</a>' ) . '</div>', admin_url( 'edit.php?post_type=location' ) ); ?>
<?php printf( '<div class="dashicons dashicons-admin-page">' . __( ' Créer votre profil <a href="%1$s">producteur artistique/technicien</a>' ) . '</div>', admin_url( 'post-new.php?post_type=compagnie' ) ); ?>
<?php printf( '<div class="dashicons dashicons-admin-page">' . __( ' Créer votre profil <a href="%1$s">enseignant</a>' ) . '</div>', admin_url( 'post-new.php?post_type=enseignant' ) ); ?>

</div>
 <!-- fin location && contributeur-->
 
 
 <!-- artiste && contributeur-->
 <?php 
 }elseif (current_user_can('contributor') && $a_un_artiste == true){?>
<div class="welcome-panel-column welcome-panel-artiste">
<a href="http://www.desceneenscene.fr/wp-admin/edit.php?post_type=artiste" title="Mettre à jour ma page" id="range-logo" align="center">
 <h1 align="center"; STYLE="text-decoration:underline"><?php _e( 'CV Artsite ou technicien' ); ?></h1></a>   
<?php printf( '<div class="dashicons dashicons-admin-post">' . __( ' Mettre à jour <a href="%1$s">ma page</a>' ) . '</div>', admin_url( 'edit.php?post_type=artiste' ) ); ?>
</div>
 <!-- fin location && contributeur-->
 
 
 
 <!-- Enseignant && Producteur && contributeur-->
 <?php 
 }elseif (current_user_can('contributor') && $a_un_enseignant == true && $a_une_compagnie == true && $a_une_location != true){?>
<div class="welcome-panel-column welcome-panel-compagnie">
 <h1 align="center"; STYLE="text-decoration:underline"><?php _e( 'Producteur Artistique et Enseignant' ); ?></h1> 
<?php printf( '<div class="dashicons dashicons-admin-post">' . __( ' Mettre à jour mon profil <a href="%1$s">enseignant</a>' ) . '</div>', admin_url( 'edit.php?post_type=enseignant' ) ); ?>
<?php printf( '<div class="dashicons dashicons-admin-post">' . __( ' Mettre à jour mon profil <a href="%1$s">producteur artistique</a>' ) . '</div>', admin_url( 'edit.php?post_type=compagnie' ) ); ?>
<?php printf( '<div class="dashicons dashicons-admin-page">' . __( ' Créer la page de <a href="%1$s">l\'espace de diffusion</a>' ) . '</div>', admin_url( 'post-new.php?post_type=location' ) ); ?>



</div>
 <!-- fin enseignant && producteur && contributeur-->
 
 
 <!-- Espace dif && Producteur && contributeur-->
 <?php 
 }elseif (current_user_can('contributor') && $a_une_compagnie == true && $a_un_enseignant != true && $a_une_location == true){?>
<div class="welcome-panel-column welcome-panel-enseignant">
 <h1 align="center"; STYLE="text-decoration:underline"><?php _e( 'Producteur Artistique et Espace de diffusion' ); ?></h1> 
<?php printf( '<div class="dashicons dashicons-admin-post">' . __( ' Mettre à jour mon profil <a href="%1$s">producteur artistique</a>' ) . '</div>', admin_url( 'edit.php?post_type=compagnie' ) ); ?>
<?php printf( '<div class="dashicons dashicons-admin-page">' . __( ' Créer un profil <a href="%1$s">enseignant</a>' ) . '</div>', admin_url( 'post-new.php?post_type=enseignant' ) ); ?>
<?php printf( '<div class="dashicons dashicons-admin-post">' . __( ' Mettre à jour la page de <a href="%1$s">l\'espace de diffusion</a>' ) . '</div>', admin_url( 'edit.php?post_type=location' ) ); ?>



</div>
 <!-- fin loc && producteur && contributeur-->
 
 
  <!-- Espace dif && Enseignant-->
 <?php 
 }elseif (current_user_can('contributor') && $a_une_compagnie != true && $a_un_enseignant == true && $a_une_location == true){?>
<div class="welcome-panel-column welcome-panel-location">
 <h1 align="center"; STYLE="text-decoration:underline"><?php _e( 'Enseignant et Espace de diffusion' ); ?></h1> 
<?php printf( '<div class="dashicons dashicons-admin-page">' . __( ' Créer un profil <a href="%1$s">producteur artistique/technicien</a>' ) . '</div>', admin_url( 'post-new.php?post_type=compagnie' ) ); ?>
<?php printf( '<div class="dashicons dashicons-admin-post">' . __( ' Mettre à jour mon profil <a href="%1$s">enseignant</a>' ) . '</div>', admin_url( 'edit.php?post_type=enseignant' ) ); ?>
<?php printf( '<div class="dashicons dashicons-admin-post">' . __( ' Mettre à jour la page de <a href="%1$s">l\'espace de diffusion</a>' ) . '</div>', admin_url( 'edit.php?post_type=location' ) ); ?>



</div>
 <!-- fin loc && producteur && enseignant-->
 
 
 <!-- Espace dif && Producteur && contributeur && loc-->
 <?php 
 }elseif (current_user_can('contributor') && $a_une_compagnie == true && $a_un_enseignant == true && $a_une_location == true){?>
<div class="welcome-panel-column welcome-panel-enseignant">
 <h1 align="center"; STYLE="text-decoration:underline"><?php _e( 'Producteur Artistique, Enseignant et Espace de diffusion' ); ?></h1> 
<?php printf( '<div class="dashicons dashicons-admin-post">' . __( ' Mettre à jour mon profil <a href="%1$s">producteur artistique</a>' ) . '</div>', admin_url( 'edit.php?post_type=compagnie' ) ); ?>
<?php printf( '<div class="dashicons dashicons-admin-post">' . __( ' Mettre à jour mon profil <a href="%1$s">enseignant</a>' ) . '</div>', admin_url( 'edit.php?post_type=enseignant' ) ); ?>
<?php printf( '<div class="dashicons dashicons-admin-post">' . __( ' Mettre à jour la page de <a href="%1$s">l\'espace de diffusion</a>' ) . '</div>', admin_url( 'edit.php?post_type=location' ) ); ?>



</div>
 <!-- fin Espace dif && Producteur && contributeur && loc-->
 
 <?php
 
 
 
 }elseif (current_user_can('producteur') && $a_une_compagnie !== true ){?>
 
 
 <!-- Producteurs artistiques -->
<div class="welcome-panel-column welcome-panel-compagnie">
<a href="http://www.desceneenscene.fr/wp-admin/edit.php?post_type=compagnie" title="Mettre à jour ma page" id="range-logo" align="center">
 <h1 align="center"; STYLE="text-decoration:underline"><?php _e( 'Producteurs artistiques' ); ?></h1>

 </a>   
 
 <table>
 <tr>
 <td>
 </td>
 <td>
<?php printf( '<div class="dashicons dashicons-admin-page">' . __( ' Créer votre <a href="%1$s">page</a>' ) . '</div>', admin_url( 'post-new.php?post_type=compagnie' ) ); ?>
 </td>
  <td>

 </td>
 </tr>
 <tr>
 <td>
 <?php printf( '<div class="dashicons dashicons-admin-page">' . __( ' Proposer <a href="%1$s">un événement</a>' ) . '</div>', admin_url( 'post-new.php?post_type=event' ) ); ?>
 </td>
 <td>
 <?php printf( '<div class="dashicons dashicons-admin-page">' . __( ' Créer une page de  <a href="%1$s">production</a>' ) . '</div>', admin_url( 'post-new.php?post_type=production' ) ); ?><!-- à changer-->
 </td>
  <td>
 <?php printf( '<div class="dashicons dashicons-admin-page">' . __( ' Créer une <a href="%1$s">annonce</a>' ) . '</div>', admin_url( 'post-new.php?post_type=post' ) ); ?>
 </td>
 </tr>
 <tr>
 <td>
 <?php if ($a_un_evenement == true) { printf( '<div class="dashicons dashicons-admin-post">' . __( 'Mettre à jour <a href="%1$s">mes événements</a>' ) . '</div>', admin_url( 'edit.php?post_type=event' ) ); } else{} ?>
 </td>
 <td>
  <?php if ($a_une_prod == true) { printf( '<div class="dashicons dashicons-admin-post">' . __( 'Mettre à jour : <a href="%1$s">mes productions</a>' ) . '</div>', admin_url( 'edit.php?post_type=production' ) ); } else{}?>
 </td>
 <td>
 
 <?php if ($a_une_annonce == true) { printf( '<div class="dashicons dashicons-admin-post">' . __( 'Mettre à jour <a href="%1$s">mes annonces</a>' ) . '</div>', admin_url( 'edit.php?post_type=post' ) );} else{} ?>
 </td>
 </tr>
 </table>
 
       	</div>
 
 
 <?php 
 
 }elseif (current_user_can('producteur') && $a_une_compagnie == true ){?>
 
 
 <!-- Producteurs artistiques -->
<div class="welcome-panel-column welcome-panel-compagnie">
<a href="http://www.desceneenscene.fr/wp-admin/edit.php?post_type=compagnie" title="Mettre à jour ma page" id="range-logo" align="center">
 <h1 align="center"; STYLE="text-decoration:underline"><?php _e( 'Producteurs artistiques' ); ?></h1>

 </a>   
 
 <table>
 <tr>
 <td>
  <?php printf( '<div class="dashicons dashicons-admin-post">' . __( ' Mettre à jour <a href="%1$s">ma page</a>' ) . '</div>', admin_url( 'edit.php?post_type=compagnie' ) ); ?><!-- à changer-->

 </td>
 <td>
 </td>
  <td>

 </td>
 </tr>
 <tr>
 <td>
 <?php printf( '<div class="dashicons dashicons-admin-page">' . __( ' Proposer <a href="%1$s">un événement</a>' ) . '</div>', admin_url( 'post-new.php?post_type=event' ) ); ?>
 </td>
 <td>
 <?php printf( '<div class="dashicons dashicons-admin-page">' . __( ' Créer une page de  <a href="%1$s">production</a>' ) . '</div>', admin_url( 'post-new.php?post_type=production' ) ); ?><!-- à changer-->
 </td>
  <td>
 <?php printf( '<div class="dashicons dashicons-admin-page">' . __( ' Créer une <a href="%1$s">annonce</a>' ) . '</div>', admin_url( 'post-new.php?post_type=post' ) ); ?>
 </td>
 </tr>
 <tr>
 <td>
 <?php if ($a_un_evenement == true) { printf( '<div class="dashicons dashicons-admin-post">' . __( 'Mettre à jour <a href="%1$s">mes événements</a>' ) . '</div>', admin_url( 'edit.php?post_type=event' ) ); } else{} ?>
 </td>
 <td>
  <?php if ($a_une_prod == true) { printf( '<div class="dashicons dashicons-admin-post">' . __( 'Mettre à jour : <a href="%1$s">mes productions</a>' ) . '</div>', admin_url( 'edit.php?post_type=production' ) ); } else{}?>
 </td>
 <td>
 
 <?php if ($a_une_annonce == true) { printf( '<div class="dashicons dashicons-admin-post">' . __( 'Mettre à jour <a href="%1$s">mes annonces</a>' ) . '</div>', admin_url( 'edit.php?post_type=post' ) );} else{} ?>
 </td>
 </tr>
 </table>
 
       	</div>
 
 
 <?php 
 
 
 }elseif (current_user_can('enseignant') && $a_un_enseignant !== true ){?>
 
 
 <!-- Producteurs enseignants -->
<div class="welcome-panel-column welcome-panel-enseignant">
<a href="http://www.desceneenscene.fr/wp-admin/edit.php?post_type=enseignant" title="Mettre à jour ma page" id="range-logo" align="center">
 <h1 align="center"; STYLE="text-decoration:underline"><?php _e( 'Enseignants' ); ?></h1>

 </a>   
 
 <table>
 <tr>
 <td>
 <?php printf( '<div class="dashicons dashicons-admin-page">' . __( ' Créer votre <a href="%1$s">page</a>' ) . '</div>', admin_url( 'post-new.php?post_type=enseignant' ) ); ?>
 </td>
 <td>

 </td>
  <td>

 </td>
 </tr>
 <tr>
 <td>
 <?php printf( '<div class="dashicons dashicons-admin-page">' . __( ' Proposer <a href="%1$s">un stage ou un événement</a>' ) . '</div>', admin_url( 'post-new.php?post_type=event' ) ); ?>
 </td>
 <td>
 <?php printf( '<div class="dashicons dashicons-admin-page">' . __( ' Atelier : créer une <a href="%1$s">page</a>' ) . '</div>', admin_url( 'post-new.php?post_type=atelier' ) ); ?><!-- à changer-->
 </td>
  <td>
 <?php printf( '<div class="dashicons dashicons-admin-page">' . __( ' Créer une <a href="%1$s">annonce</a>' ) . '</div>', admin_url( 'post-new.php?post_type=post' ) ); ?>
 </td>
 </tr>
 <tr>
 <td>
 <?php if ($a_un_stage == true) { printf( '<div class="dashicons dashicons-admin-post">' . __( ' Mettre à jour <a href="%1$s">mes stages</a>' ) . '</div>', admin_url( 'edit.php?post_type=event' ) ); } else{} ?>
 </td>
 <td>
  <?php if ($a_un_atelier == true){ printf( '<div class="dashicons dashicons-admin-post">' . __( ' Mettre à jour : <a href="%1$s">mes ateliers</a>' ) . '</div>', admin_url( 'edit.php?post_type=atelier' ) ); } else{} ?><!-- à changer-->

 </td>
 <td>
 <?php if ($a_une_annonce == true) { printf( '<div class="dashicons dashicons-admin-post">' . __( ' Mettre à jour <a href="%1$s">mes annonces</a>' ) . '</div>', admin_url( 'edit.php?post_type=post' ) ); } else{} ?>
 </td>
 </tr>
 </table>
 
       	</div>
 
  <?php 
  }elseif (current_user_can('enseignant') && $a_un_enseignant == true ){?>
 
 
 <!-- Producteurs enseignants -->
<div class="welcome-panel-column welcome-panel-enseignant">
<a href="http://www.desceneenscene.fr/wp-admin/edit.php?post_type=enseignant" title="Mettre à jour ma page" id="range-logo" align="center">
 <h1 align="center"; STYLE="text-decoration:underline"><?php _e( 'Enseignants' ); ?></h1>

 </a>   
 
 <table>
 <tr>
 <td>
 <?php printf( '<div class="dashicons dashicons-admin-post">' . __( ' Mettre à jour <a href="%1$s">ma page</a>' ) . '</div>', admin_url( 'edit.php?post_type=enseignant' ) ); ?><!-- à changer-->
 </td>
 <td>

 </td>
  <td>

 </td>
 </tr>
 <tr>
 <td>
 <?php printf( '<div class="dashicons dashicons-admin-page">' . __( ' Proposer <a href="%1$s">un stage ou un événement</a>' ) . '</div>', admin_url( 'post-new.php?post_type=event' ) ); ?>
 </td>
 <td>
 <?php printf( '<div class="dashicons dashicons-admin-page">' . __( ' Atelier : créer une <a href="%1$s">page</a>' ) . '</div>', admin_url( 'post-new.php?post_type=atelier' ) ); ?><!-- à changer-->
 </td>
  <td>
 <?php printf( '<div class="dashicons dashicons-admin-page">' . __( ' Créer une <a href="%1$s">annonce</a>' ) . '</div>', admin_url( 'post-new.php?post_type=post' ) ); ?>
 </td>
 </tr>
 <tr>
 <td>
 <?php if ($a_un_stage == true) { printf( '<div class="dashicons dashicons-admin-post">' . __( ' Mettre à jour <a href="%1$s">mes stages</a>' ) . '</div>', admin_url( 'edit.php?post_type=event' ) ); } else{} ?>
 </td>
 <td>
  <?php if ($a_un_atelier == true){ printf( '<div class="dashicons dashicons-admin-post">' . __( ' Mettre à jour : <a href="%1$s">mes ateliers</a>' ) . '</div>', admin_url( 'edit.php?post_type=atelier' ) ); } else{} ?><!-- à changer-->

 </td>
 <td>
 <?php if ($a_une_annonce == true) { printf( '<div class="dashicons dashicons-admin-post">' . __( ' Mettre à jour <a href="%1$s">mes annonces</a>' ) . '</div>', admin_url( 'edit.php?post_type=post' ) ); } else{} ?>
 </td>
 </tr>
 </table>
 
       	</div>
 
  <?php 
  
  
 }elseif (current_user_can('mixte') ){?>
    
    
<!-- Producteurs artistique et enseignants -->
<div class="welcome-panel-column welcome-panel-mixte">

<h1 align="center"; STYLE="text-decoration:underline"><?php _e( 'Producteurs artistique et enseignants' ); ?></h1>

 <table>
 <tr>
 <td>
<?php printf( '<div class="dashicons dashicons-admin-post">' . __( ' Mettre à jour mon profil <a href="%1$s">producteur artistique</a>' ) . '</div>', admin_url( 'edit.php?post_type=compagnie' ) ); ?>
 </td>
 <td>
<?php printf( '<div class="dashicons dashicons-admin-post">' . __( ' Mettre à jour mon profil <a href="%1$s">enseignant</a>' ) . '</div>', admin_url( 'edit.php?post_type=enseignant' ) ); ?>

 </td>
  <td>
   <?php printf( '<div class="dashicons dashicons-admin-page">' . __( ' Proposer <a href="%1$s">un stage ou un événement</a>' ) . '</div>', admin_url( 'post-new.php?post_type=event' ) ); ?>
 </td>
 </tr>
 <tr>
 <td>
  <?php printf( '<div class="dashicons dashicons-admin-page">' . __( ' Créer une page de  <a href="%1$s">production</a>' ) . '</div>', admin_url( 'post-new.php?post_type=production' ) ); ?>
 </td>
 <td>
 <?php printf( '<div class="dashicons dashicons-admin-page">' . __( ' Atelier : créer une <a href="%1$s">page</a>' ) . '</div>', admin_url( 'post-new.php?post_type=atelier' ) ); ?><!-- à changer-->
 </td>
  <td>
  <?php if ($a_un_stage == true) { printf( '<div class="dashicons dashicons-admin-post">' . __( ' Mettre à jour <a href="%1$s">mes stages</a>' ) . '</div>', admin_url( 'edit.php?post_type=event' ) ); } else{}?>
  </td>
 </tr>
 <tr>
 <td>
 <?php if ($a_une_prod == true) { printf( '<div class="dashicons dashicons-admin-post">' . __( ' Mettre à jour : <a href="%1$s">mes productions</a>' ) . '</div>', admin_url( 'edit.php?post_type=production' ) ); } else{}?>
 </td>
 <td>
  <?php if ($a_un_atelier == true) { printf( '<div class="dashicons dashicons-admin-post">' . __( ' Mettre à jour : <a href="%1$s">mes ateliers</a>' ) . '</div>', admin_url( 'edit.php?post_type=atelier' ) ); } else{}?>

 </td>
 <td>
 <?php printf( '<div class="dashicons dashicons-admin-page">' . __( ' Créer une <a href="%1$s">annonce</a>' ) . '</div>', admin_url( 'post-new.php?post_type=post' ) ); ?>
 </td>
 </tr>
 <tr>
 <td>
 </td>
 <td>
 <?php if ($a_un_evenement == true) { printf( '<div class="dashicons dashicons-admin-post">' . __( 'Mettre à jour <a href="%1$s">mes événements</a>' ) . '</div>', admin_url( 'edit.php?post_type=event' ) ); } else{} ?>

 </td>
  <td>
   <?php if ($a_une_annonce == true) { printf( '<div class="dashicons dashicons-admin-post">' . __( ' Mettre à jour <a href="%1$s">mes annonces</a>' ) . '</div>', admin_url( 'edit.php?post_type=post' ) ); } else{}?>
 </td>
 </tr>
 </table>
 
       	</div>
       	
<?php 
 }elseif (current_user_can('mixte_pl') ){?>
    
    
<!-- Producteurs artistique et espaces de dif -->
<div class="welcome-panel-column welcome-panel-mixte">

<h1 align="center"; STYLE="text-decoration:underline"><?php _e( 'Producteurs artistique et Responsables d\'espace de diffusion' ); ?></h1>

 <table>
 <tr>
 <td>
<?php printf( '<div class="dashicons dashicons-admin-post">' . __( ' Mettre à jour mon profil <a href="%1$s">producteur artistique</a>' ) . '</div>', admin_url( 'edit.php?post_type=compagnie' ) ); ?>
 </td>
 <td>

 </td>
  <td>
<?php printf( '<div class="dashicons dashicons-admin-post">' . __( ' Mettre à jour la page de <a href="%1$s">l\'espace de diffusion</a>' ) . '</div>', admin_url( 'edit.php?post_type=location' ) ); ?>

  
  
 </td>
 </tr>
 <tr>
 <td>
  <?php printf( '<div class="dashicons dashicons-admin-page">' . __( ' Créer une page de  <a href="%1$s">production</a>' ) . '</div>', admin_url( 'post-new.php?post_type=production' ) ); ?>
 </td>
 <td>

  <?php printf( '<div class="dashicons dashicons-admin-page">' . __( ' Proposer <a href="%1$s">un événement</a>' ) . '</div>', admin_url( 'post-new.php?post_type=event' ) ); ?>

 
 </td>
  <td>
 <?php printf( '<div class="dashicons dashicons-admin-page">' . __( ' Créer une <a href="%1$s">annonce</a>' ) . '</div>', admin_url( 'post-new.php?post_type=post' ) ); ?>
 </td>
 </tr>
 <tr>
 <td>
 <?php if ($a_une_prod == true) { printf( '<div class="dashicons dashicons-admin-post">' . __( ' Mettre à jour : <a href="%1$s">mes productions</a>' ) . '</div>', admin_url( 'edit.php?post_type=production' ) ); } else{}?>
 </td>
 <td>

 <?php if ($a_un_evenement == true) { printf( '<div class="dashicons dashicons-admin-post">' . __( 'Mettre à jour <a href="%1$s">mes événements</a>' ) . '</div>', admin_url( 'edit.php?post_type=event' ) ); } else{} ?>

 
 </td>
 <td>
   <?php if ($a_une_annonce == true) { printf( '<div class="dashicons dashicons-admin-post">' . __( ' Mettre à jour <a href="%1$s">mes annonces</a>' ) . '</div>', admin_url( 'edit.php?post_type=post' ) ); } else{}?>
 </td>
 </tr>
 <tr>
 <td>
 
 
 </td>
 <td>

 
 
 </td>
  <td>
 </td>
 </tr>
 </table>
 
       	</div>
       	
       	
       	
       	
<?php 
 }elseif (current_user_can('tous') ){?>
    
    
<!-- Producteurs artistique et espaces de dif -->
<div class="welcome-panel-column welcome-panel-mixte">

<h1 align="center"; STYLE="text-decoration:underline"><?php _e( 'Producteurs artistique, Enseignants et Responsables d\'espace de diffusion' ); ?></h1>

 <table>
 <tr>
 <td>
<?php printf( '<div class="dashicons dashicons-admin-post">' . __( ' Mettre à jour mon profil <a href="%1$s">producteur artistique</a>' ) . '</div>', admin_url( 'edit.php?post_type=compagnie' ) ); ?>
 </td>
 <td>
<?php printf( '<div class="dashicons dashicons-admin-post">' . __( ' Mettre à jour mon profil <a href="%1$s">enseignant</a>' ) . '</div>', admin_url( 'edit.php?post_type=enseignant' ) ); ?>

 </td>
  <td>
<?php printf( '<div class="dashicons dashicons-admin-post">' . __( ' Mettre à jour la page de <a href="%1$s">l\'espace de diffusion</a>' ) . '</div>', admin_url( 'edit.php?post_type=location' ) ); ?>

  
  
 </td>
 </tr>
 <tr>
 <td>
  <?php printf( '<div class="dashicons dashicons-admin-page">' . __( ' Créer une page de  <a href="%1$s">production</a>' ) . '</div>', admin_url( 'post-new.php?post_type=production' ) ); ?>
 </td>
 <td>

 <?php printf( '<div class="dashicons dashicons-admin-page">' . __( ' Atelier : créer une <a href="%1$s">page</a>' ) . '</div>', admin_url( 'post-new.php?post_type=atelier' ) ); ?><!-- à changer-->

 
 </td>
  <td>
  
 <?php printf( '<div class="dashicons dashicons-admin-page">' . __( ' Proposer <a href="%1$s">un événement</a>' ) . '</div>', admin_url( 'post-new.php?post_type=event' ) ); ?>

 </td>
 </tr>
 <tr>
 <td>
 <?php if ($a_une_prod == true) { printf( '<div class="dashicons dashicons-admin-post">' . __( ' Mettre à jour : <a href="%1$s">mes productions</a>' ) . '</div>', admin_url( 'edit.php?post_type=production' ) ); } else{}?>
 </td>
 <td>
  <?php if ($a_un_atelier == true){ printf( '<div class="dashicons dashicons-admin-post">' . __( ' Mettre à jour : <a href="%1$s">mes ateliers</a>' ) . '</div>', admin_url( 'edit.php?post_type=atelier' ) ); } else{} ?><!-- à changer-->


 
 </td>
 <td>
 <?php if ($a_un_evenement == true) { printf( '<div class="dashicons dashicons-admin-post">' . __( 'Mettre à jour <a href="%1$s">mes événements</a>' ) . '</div>', admin_url( 'edit.php?post_type=event' ) ); } else{} ?>

 </td>
 </tr>
 <tr>
 <td>
  <?php printf( '<div class="dashicons dashicons-admin-page">' . __( ' Créer une <a href="%1$s">annonce</a>' ) . '</div>', admin_url( 'post-new.php?post_type=post' ) ); ?>

 
 </td>
 <td>
   <?php if ($a_une_annonce == true) { printf( '<div class="dashicons dashicons-admin-post">' . __( ' Mettre à jour <a href="%1$s">mes annonces</a>' ) . '</div>', admin_url( 'edit.php?post_type=post' ) ); } else{}?>
 
 </td>
  <td>
 </td>
 </tr>
 </table>
 
       	</div>
       	
       	
       	
 <?php 
 }elseif (current_user_can('mixte_ee') ){?>
    
    
<!-- Enseignant et espaces de dif -->
<div class="welcome-panel-column welcome-panel-mixte">

<h1 align="center"; STYLE="text-decoration:underline"><?php _e( 'Enseignants et Responsables d\'espace de diffusion' ); ?></h1>

 <table>
 <tr>
 <td>
<?php printf( '<div class="dashicons dashicons-admin-post">' . __( ' Mettre à jour mon profil <a href="%1$s">enseignant</a>' ) . '</div>', admin_url( 'edit.php?post_type=enseignant' ) ); ?>
 </td>
 <td>

 </td>
  <td>
<?php printf( '<div class="dashicons dashicons-admin-post">' . __( ' Mettre à jour la page de <a href="%1$s">l\'espace de diffusion</a>' ) . '</div>', admin_url( 'edit.php?post_type=location' ) ); ?>

  
  
 </td>
 </tr>
 <tr>
 <td>
 <?php printf( '<div class="dashicons dashicons-admin-page">' . __( ' Atelier : créer une <a href="%1$s">page</a>' ) . '</div>', admin_url( 'post-new.php?post_type=atelier' ) ); ?><!-- à changer-->
 </td>
 <td>

  <?php printf( '<div class="dashicons dashicons-admin-page">' . __( ' Proposer <a href="%1$s">un événement</a>' ) . '</div>', admin_url( 'post-new.php?post_type=event' ) ); ?>

 
 </td>
  <td>
 <?php printf( '<div class="dashicons dashicons-admin-page">' . __( ' Créer une <a href="%1$s">annonce</a>' ) . '</div>', admin_url( 'post-new.php?post_type=post' ) ); ?>
 </td>
 </tr>
 <tr>
 <td>
  <?php printf( '<div class="dashicons dashicons-admin-post">' . __( ' Mettre à jour : <a href="%1$s">mes ateliers</a>' ) . '</div>', admin_url( 'edit.php?post_type=atelier' ) ); ?>
 </td>
 <td>

   <?php printf( '<div class="dashicons dashicons-admin-post">' . __( ' Mettre à jour <a href="%1$s">mes événements</a>' ) . '</div>', admin_url( 'edit.php?post_type=event' ) ); ?>

 
 </td>
 <td>
 <?php printf( '<div class="dashicons dashicons-admin-post">' . __( ' Mettre à jour <a href="%1$s">mes annonces</a>' ) . '</div>', admin_url( 'edit.php?post_type=post' ) ); ?>
 </td>
 </tr>
 <tr>
 <td>
 
 
 </td>
 <td>

 
 
 </td>
  <td>
 </td>
 </tr>
 </table>
 
       	</div>
    
    
    
    <?php 
 }elseif (current_user_can('location') ){?>
 
 <!-- Espace de diffusion -->
<div class="welcome-panel-column welcome-panel-location">
<a href="http://www.desceneenscene.fr/wp-admin/edit.php?post_type=location" title="Mettre à jour ma page" id="range-logo" align="center">
 <h1 align="center"; STYLE="text-decoration:underline"><?php _e( 'Espace de diffusion' ); ?></h1>

 </a>   
 
 <table>
 <tr>
 <td>
 <?php printf( '<div class="dashicons dashicons-admin-post">' . __( ' Mettre à jour <a href="%1$s">ma page</a>' ) . '</div>', admin_url( 'edit.php?post_type=location' ) ); ?><!-- à changer-->
 </td>
 <td>

 </td>
  <td>

 </td>
 </tr>
 <tr>
 <td>
 <?php printf( '<div class="dashicons dashicons-admin-page">' . __( ' Proposer <a href="%1$s">un événement</a>' ) . '</div>', admin_url( 'post-new.php?post_type=event' ) ); ?>
 </td>
 <td>
 </td>
  <td>
 <?php printf( '<div class="dashicons dashicons-admin-page">' . __( ' Créer une <a href="%1$s">annonce</a>' ) . '</div>', admin_url( 'post-new.php?post_type=post' ) ); ?>
 </td>
 </tr>
 <tr>
 <td>
 <?php printf( '<div class="dashicons dashicons-admin-post">' . __( ' Mettre à jour <a href="%1$s">mes événements</a>' ) . '</div>', admin_url( 'edit.php?post_type=event' ) ); ?>
 </td>
 <td>
 </td>
 <td>
 <?php printf( '<div class="dashicons dashicons-admin-post">' . __( ' Mettre à jour <a href="%1$s">mes annonces</a>' ) . '</div>', admin_url( 'edit.php?post_type=post' ) ); ?>
 </td>
 </tr>
 </table>
 
       	</div>
 
 
 
 
 <?php 
 }elseif (current_user_can('artiste') ){?>
 
 
 <!-- Artiste -->
<div class="welcome-panel-column welcome-panel-artiste">
<a href="http://www.desceneenscene.fr/wp-admin/edit.php?post_type=artiste" title="Mettre à jour ma page" id="range-logo" align="center">
 <h1 align="center"; STYLE="text-decoration:underline"><?php _e( 'Artistes/Techniciens' ); ?></h1>

 </a>   
 
 <table>
 <tr>
 <td>
 <?php printf( '<div class="dashicons dashicons-admin-post">' . __( ' Mettre à jour <a href="%1$s">ma page</a>' ) . '</div>', admin_url( 'edit.php?post_type=artiste' ) ); ?><!-- à changer-->
 </td>
 <td>

 </td>
  <td>

 </td>
 </tr>
 <tr>
 <td>
  <?php printf( '<div class="dashicons dashicons-admin-page">' . __( ' Créer une <a href="%1$s">annonce</a>' ) . '</div>', admin_url( 'post-new.php?post_type=post' ) ); ?>
 </td>
 <td>
 </td>
  <td>
 </td>
 </tr>
 <tr>
 <td>
  <?php printf( '<div class="dashicons dashicons-admin-post">' . __( ' Mettre à jour <a href="%1$s">mes annonces</a>' ) . '</div>', admin_url( 'edit.php?post_type=post' ) ); ?>
 </td>
 <td>
 </td>
 <td>
 </td>
 </tr>
 </table>
 
       	</div>
 
 
 

   
   <?php }else{}?>
   
   
   
    <div class="welcome-bottom-middle" style="height: 670px; padding: 5px;text-align: center;">
    <!--<h2 align=center><?php _e( 'Getting started series' ); ?></h2>
    <p align=center><?php _e('Taking your first steps with WordPress' ); ?></p>
   
    <p align=center><iframe width="853" height="480" src="https://www.youtube.com/embed/VdvOGV2eIjE?list=PLD3AB608F62AC973C" frameborder="0" allowfullscreen></iframe></p>
     <p align=center><?php _e('Brought to you by.' ); ?></p>
   
    <a href="http://easywebdesigntutorials.com/" target="_blank"><img src="<?php echo plugins_url( '../assets/img/easyweb-logo2.png', __FILE__) ?>" title="The web site for Easy Web Design Tutorials" style="padding: 0; margin: 0 auto;"/></a>   	
    -->
    </div>
<?php
}

remove_action('welcome_panel','wp_welcome_panel');
add_action( 'welcome_panel', 'my_welcome_panel' );
