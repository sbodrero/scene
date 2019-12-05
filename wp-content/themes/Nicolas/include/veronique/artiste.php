<?php

// Ajouter une metabox et plusieurs champs

$posts = new Cuztom_Post_Type('artiste');
 
$posts->add_meta_box(
        'artiste_info',
        'Informations',
        array(

'tabs',
array(
		'Photo en situation' 		=> array(

array(
                        'name' => 'image',
                        'label' => 'Image ou photo',
			'explanation' => 'formats jpeg ou png Taille 602X300 pixels',
                        'type' => 'image',
			'description' => 'Télécharger une photo montrant ce que vous faîtes',
                ),
				),
		

		'Informations' => array(


 array(
                        'name' => 'telephone',
                        'label' => 'Téléphone',
                        'type' => 'text',
                        'description' => 'Personnel ou professionnel',
                        'explanation' => '',
                ),
                array(
                        'name' => 'email',
                        'label' => 'Adresse E-mail',
                        'type' => 'text',
                        'description' => 'Personnelle ou professionnelle'
                ),
                array(
                        'name' => 'siteweb',
                        'label' => 'Site web',
                        'type' => 'text',
                        'description' => 'Entrez l\'url en entier (http://.. )',
                        'explanation' => 'optionnel',
                ),
                array(
                        'name' => 'adresse_rue',
                        'label' => 'Rue ',
                        'type' => 'text',
                ),
                array(
                        'name' => 'adresse_ville',
                        'label' => 'Ville',
                        'type' => 'text',
                ),
                array(
                        'name' => 'adresse_cp',
                        'label' => 'Code Postal',
                        'type' => 'text',
                ),
                array(
                        'name' => 'statut',
                        'label' => 'Votre statut',
                        'type' => 'yesno',
                        'description' => 'Êtes-vous professionnel ?',
                ), 
),

		'Galerie de photos' => array(
				array(
                        'name' => 'photos',
                        'label' => 'Vos photos',
                        'type' => 'image',
			'repeatable'    => true,
			'description' => 'Cliquez sur \'Ajouter\' pour pouvoir ajouter une photo.',
						
                ),

				),

		'CV' => array(

array(
                       'name' => 'fichier',
                       'label' => 'Télécharger votre CV',
                       'type' => 'file', 
                       'explanation' => 'Si vous avez un fichier décrivant votre activité vous pouvez l\'envoyer ici. Il apparaîtra sur votre fiche.',
					
                			),

	),


),

)
               
);

$posts->add_meta_box(
        'artiste_reseauxsociaux',
        'Vos réseaux sociaux', 
		array(
			'tabs',
			array(
						'facebook' => array(
							array(
								'name' => 'facebook',
								'label' => 'Facebook',
								'type' => 'text',
								'description' => 'Personnel ou professionnel',
								'explanation' => 'Entrez l\'url entière ( http:// ..) de votre page que vous désirez voir apparaître sur votre fiche',
							),
						),
						'myspace' => array(
							array(
								'name' => 'myspace',
								'label' => 'My Space',
								'type' => 'text',
								'description' => 'Personnel ou professionnel',
								'explanation' => 'Entrez l\'url entière ( http:// ..) de votre page que vous désirez voir apparaître sur votre fiche',
							),
						),
						'gplus' => array(
							array(
								'name' => 'gplus',
								'label' => 'Google +',
								'type' => 'text',
								'description' => 'Personnel ou professionnel',
								'explanation' => 'Entrez l\'url entière ( http:// ..) de votre page que vous désirez voir apparaître sur votre fiche',
							),
						),
						'linkedin' => array(
							array(
								'name' => 'linkedin',
								'label' => 'LinkedIn',
								'type' => 'text',
								'description' => 'Personnel ou professionnel',
								'explanation' => 'Entrez l\'url entière ( http:// ..) de votre page que vous désirez voir apparaître sur votre fiche',
							)
						),
						'video' => array(
							array(
								'name' => 'video',
								'label' => 'Video',
								'type' => 'text',
								'explanation' => 'Entrez l\'url (http://...) dune vidéo ou d\'une chaîne que vous désirez voir apparaître sur votre fiche',
							)
						)
					) 
)					
);		

		
?>