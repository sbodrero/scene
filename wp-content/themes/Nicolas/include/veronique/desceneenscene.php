<?php

 
// Ajouter une metabox et plusieurs champs

$posts = new Cuztom_Post_Type('dses');
 
$posts->add_meta_box(
        'dses_info',
        'Informations',
        array(

'tabs',
array(
		'Photo en situation' 		=> array(

array(
                        'name' => 'image',
                        'label' => 'Image ou photo',
			'description' => 'formats jpeg ou png Taille 602X300 pixels',
                        'type' => 'image',
			'explanation' => 'Télécharger une photo montrant ce que vous faîtes',
                ),
				),

		'Responsables' => array (

array(
                        'name' => 'resp_legal',
                        'label' => 'Responsable légal',
                        'type' => 'text',
                ),

array(
                        'name' => 'agit_artistique',
                        'label' => 'Agitateur Artistique',
                        'type' => 'text',
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

		
		'Rubrique 2' => array(
				array(
                        'name' => 'titrerubrique_2',
                        'label' => __('Titre de la 2ème rubrique', 'gdl_front_end'),
                        'type' => 'text',
			//'repeatable'    => true,
			'description' => __('Mettre un titre', 'gdl_front_end'),
						
                ),
				array(
                        'name' => 'texterubrique_2',
                        'label' => '',
                        'type' => 'wysiwyg',
			//'repeatable'    => true,
			'description' => '',
						
                ),
				),
				
		'Rubrique 3' => array(
				array(
                        'name' => 'titrerubrique_3',
                        'label' => __('Titre de la 3ème rubrique', 'gdl_front_end'),
                        'type' => 'text',
			//'repeatable'    => true,
			'description' => __('Mettre un titre', 'gdl_front_end'),
						
                ),
				array(
                        'name' => 'texterubrique_3',
                        'label' => '',
                        'type' => 'wysiwyg',
			//'repeatable'    => true,
			'description' => '',
						
                ),
				),
		'Partenaires' => array(

array(
                        'name' => 'partenaires_insitutionnels',
                        'label' => 'Partenaires institutionnels',
                        'type' => 'image', 
						'repeatable'    => true,
						'description' => 'Insérez les logos de vos partenaires. Taille 50X50 pixels',
					
                			),

array(
                        'name' => 'partenaires',
                        'label' => 'Autres Partenaires',
                        'type' => 'textarea', 
                        
                ),

				),


		'Comité de pilotage' => array(

array(
                        'name' => 'equipe',
                        'label' => 'L\'équipe',
                        'type' => 'textarea', 
                       
					
                			),

				),

),

)
               
);

$posts->add_meta_box(
        'dses_reseauxsociaux',
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
								'explanation' => 'Entrez l\'url entière ( http:// ..) de votre page',
							),
						),
						'myspace' => array(
							array(
								'name' => 'myspace',
								'label' => 'My Space',
								'type' => 'text',
								'description' => 'Personnel ou professionnel',
								'explanation' => 'Entrez l\'url entière ( http:// ..) de votre page',
							),
						),
						'gplus' => array(
							array(
								'name' => 'gplus',
								'label' => 'Google +',
								'type' => 'text',
								'description' => 'Personnel ou professionnel',
								'explanation' => 'Entrez l\'url entière ( http:// ..) de votre page',
							),
						),
						'linkedin' => array(
							array(
								'name' => 'linkedin',
								'label' => 'LinkedIn',
								'type' => 'text',
								'description' => 'Personnel ou professionnel',
								'explanation' => 'Entrez l\'url entière ( http:// ..) de votre page',
							)
						),
						'video' => array(
							array(
								'name' => 'video',
								'label' => 'Video',
								'type' => 'text',
								'explanation' => 'Entrez l\'url dune vidéo ou d\'une chaîne que vous désirez voir apparaître sur votre fiche',
							)
						)
					) 
)					
);
?>