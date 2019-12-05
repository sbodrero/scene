<?php

 
// Ajouter une metabox et plusieurs champs

$posts = new Cuztom_Post_Type('production');
 
$posts->add_meta_box(
        'production_info',
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
			'description' => 'Télécharger une photo montrant ce que vous faîtes.',
                ),
				),
		/*'Public' => array (

array(
                        'name' => 'discipline',
                        'label' => 'Discipline(s)',
                        'type' => 'checkboxes',
						'options'       => array(
							'Chant'    => 'Chant',  
							'Cirque'    => 'Cirque', 
							'Clown' => 'Clown',
							'Danse'    => 'Danse',
							'Equestre'    => 'Equestre',
							'Lecture'    => 'Lecture',
							'Marionette & Ombre'    => 'Marionette & Ombre',
							'Musique' 	=> 'Musique',
							'Poésie'    => 'Poésie',
							'Spectacle de rue'    => 'Spectacle de rue',
							'Théâtre'    => 'Théâtre',
                								),

),

array(
                        'name' => 'public',
                        'label' => 'Tranche du public',
                        'type' => 'checkboxes',
						'options'       => array(
							'Petite enfance'    => 'Petite enfance',  
							'Enfance'    => 'Enfance',  
							'Ados'    => 'Ados', 
							'Adulte'    => 'Adulte',
							),
                        'explanation' => 'Cochez les cases pour en selectionner plusieurs'
                ), 
					),*/

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
                
				),

		'Partenaires' => array(

array(
                        'name' => 'partenaires_insitutionnels',
                        'label' => 'Partenaires insitutionnels',
                        'type' => 'image', 
						'repeatable'    => true,
						'description' => 'Insérez les logos de vos partenaires. Taille 50X50 pixels',
					
                			),

array(
                        'name' => 'partenaires',
                        'label' => 'Autres Partenaires',
                        'type' => 'textarea', 
                        'description' => 'Listez vos partenaires en les séparant d\'une virgule ou d\'un tiret.'
                ),

				),


		/*'Qui sont les Membres' => array(

array(
                        'name' => 'equipe',
                        'label' => 'L\'équipe',
                        'type' => 'textarea', 
                        'description' => 'Présentez votre équipe grâce à des images, des textes et des liens.',
					
                			),

				),*/

		'Dossiers' => array(

array(
                        'name' => 'dossier_technique',
                        'label' => 'Dossier technique',
                        'type' => 'file', 
						'explanation' => 'Des photos à montrer ? un PressBook ?',
						'repeatable'    => true,
						'description' => 'Fichiers jpg',
					
       ),

array(
                        'name' => 'dossier_diffusion',
                        'label' => 'Dossier diffusion',
                        'type' => 'file', 
						'repeatable'    => true,
      ),

				),

		'Note d\'intention' => array(

array(
                        'name' => 'note_intention',
                        'label' => 'Note d\'intention',
                        'type' => 'wysiwyg',
      ),

				),

),
)
               
);

$posts->add_meta_box(
        'production_reseauxsociaux',
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
								'explanation' => 'Entrez l\'url dune vidéo (http://...) ou d\'une chaîne que vous désirez voir apparaître sur votre fiche',
							)
						)
					) 
)					
);		

		
?>